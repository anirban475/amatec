#!/usr/bin/env bash
set -e

DRY_RUN=false
if [ "$1" = "--dry-run" ]; then
  DRY_RUN=true
elif [ -n "$1" ]; then
  echo "Usage: $0 [--dry-run]" >&2
  exit 1
fi

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

KEY_LABEL="Claude"
API_KEY=$(docker exec shared-postgres psql -U admin -d n8n -t -A -c "SELECT \"apiKey\" FROM user_api_keys WHERE label='$KEY_LABEL' LIMIT 1;")
if [ -z "$API_KEY" ]; then
  echo "Error: Failed to retrieve API key for label '$KEY_LABEL'" >&2
  exit 1
fi
trap 'unset API_KEY' EXIT

QUERY_OUTPUT=$(docker exec shared-postgres psql -U admin -d n8n -t -A -F '|' -c "
SELECT id, name, active, \"isArchived\",
       (settings->>'availableInMCP') AS available_in_mcp
FROM workflow_entity
WHERE active = true AND \"isArchived\" = false
ORDER BY name;
")

TOTAL_COUNT=0
ALREADY_ENABLED_COUNT=0
CHANGED_COUNT=0
FAILED_IDS=()

declare -a PENDING_IDS=()
declare -a PENDING_NAMES=()

while IFS='|' read -r WID WNAME WACTIVE WIS_ARCHIVED WMCP; do
  [ -z "$WID" ] && continue
  # Skip orphaned workflow SheetExport09 (zero rows in shared_workflow, out of scope)
  if [ "$WID" = "SheetExport09" ]; then
    continue
  fi
  TOTAL_COUNT=$((TOTAL_COUNT + 1))
  if [ "$WMCP" = "true" ]; then
    ALREADY_ENABLED_COUNT=$((ALREADY_ENABLED_COUNT + 1))
  else
    PENDING_IDS+=("$WID")
    PENDING_NAMES+=("$WNAME")
  fi
done <<< "$QUERY_OUTPUT"

echo "Skipping SheetExport09 (orphaned workflow, no owner in shared_workflow)."
echo "Skipping $ALREADY_ENABLED_COUNT workflows that already have availableInMCP=true."
echo ""

if [ "$DRY_RUN" = "true" ]; then
  echo "=== Dry Run: Planned Updates (${#PENDING_IDS[@]} workflows) ==="
  echo "id | name | current settings.availableInMCP | active | node count"
  echo "------------------------------------------------------------------"
  for i in "${!PENDING_IDS[@]}"; do
    WID="${PENDING_IDS[$i]}"
    WNAME="${PENDING_NAMES[$i]}"
    BASE_URL="https://n8n.amatec.in/api/v1/workflows/$WID"
    GET_RESP=$(curl -s -w "\n%{http_code}" -H "X-N8N-API-KEY: $API_KEY" "$BASE_URL")
    GET_CODE=$(echo "$GET_RESP" | tail -n1)
    GET_BODY=$(echo "$GET_RESP" | sed '$d')

    if [ "$GET_CODE" != "200" ]; then
      echo "Error fetching $WID: HTTP $GET_CODE" >&2
      FAILED_IDS+=("$WID")
      continue
    fi

    MCP_VAL=$(echo "$GET_BODY" | jq -r 'if .settings.availableInMCP == null then "missing" else (.settings.availableInMCP | tostring) end')
    ACTIVE_VAL=$(echo "$GET_BODY" | jq -r '.active')
    NODE_COUNT=$(echo "$GET_BODY" | jq -r '.nodes | length')

    echo "$WID | $WNAME | $MCP_VAL | $ACTIVE_VAL | $NODE_COUNT"
  done
else
  echo "=== Running Batch Updates (${#PENDING_IDS[@]} workflows) ==="
  for i in "${!PENDING_IDS[@]}"; do
    WID="${PENDING_IDS[$i]}"
    WNAME="${PENDING_NAMES[$i]}"
    echo "--- Updating $WID ($WNAME) ---"
    if "$SCRIPT_DIR/n8n-enable-mcp-access.sh" "$WID"; then
      CHANGED_COUNT=$((CHANGED_COUNT + 1))
    else
      echo "Failed to update $WID" >&2
      FAILED_IDS+=("$WID")
    fi
  done
fi

echo ""
echo "========================================"
echo "Summary Table"
echo "========================================"
echo "Total considered:       $TOTAL_COUNT (plus 1 skipped: SheetExport09)"
echo "Already-enabled count:  $ALREADY_ENABLED_COUNT"
if [ "$DRY_RUN" = "true" ]; then
  echo "Changed count:          0 (dry-run: ${#PENDING_IDS[@]} planned)"
else
  echo "Changed count:          $CHANGED_COUNT"
fi
echo "Failed count:           ${#FAILED_IDS[@]}"
if [ ${#FAILED_IDS[@]} -gt 0 ]; then
  echo "Failed IDs:             ${FAILED_IDS[*]}"
fi
echo "========================================"

if [ ${#FAILED_IDS[@]} -gt 0 ]; then
  exit 1
fi

exit 0
