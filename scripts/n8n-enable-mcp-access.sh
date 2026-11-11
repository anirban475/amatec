#!/usr/bin/env bash
set -e

WORKFLOW_ID="$1"
if [ -z "$WORKFLOW_ID" ]; then
  echo "Usage: $0 <workflow_id>" >&2
  exit 1
fi

KEY_LABEL="Claude"
API_KEY=$(docker exec shared-postgres psql -U admin -d n8n -t -A -c "SELECT \"apiKey\" FROM user_api_keys WHERE label='$KEY_LABEL' LIMIT 1;")
if [ -z "$API_KEY" ]; then
  echo "Error: Failed to retrieve API key for label '$KEY_LABEL'" >&2
  exit 1
fi

TMP_PAYLOAD=""
cleanup() {
  [ -n "$TMP_PAYLOAD" ] && [ -f "$TMP_PAYLOAD" ] && rm -f "$TMP_PAYLOAD"
  unset API_KEY
}
trap cleanup EXIT

BASE_URL="https://n8n.amatec.in/api/v1/workflows/$WORKFLOW_ID"

# 1. Initial State
GET_RESP=$(curl -s -w "\n%{http_code}" -H "X-N8N-API-KEY: $API_KEY" "$BASE_URL")
GET_CODE=$(echo "$GET_RESP" | tail -n1)
GET_BODY=$(echo "$GET_RESP" | sed '$d')

if [ "$GET_CODE" = "401" ] || [ "$GET_CODE" = "403" ]; then
  echo "Error: Key under label '$KEY_LABEL' returned HTTP $GET_CODE" >&2
  exit 1
fi

if [ "$GET_CODE" != "200" ]; then
  echo "Error: GET failed with HTTP $GET_CODE" >&2
  exit 1
fi

BEFORE_SETTINGS=$(echo "$GET_BODY" | jq -c '.settings')
BEFORE_MCP=$(echo "$GET_BODY" | jq -r '.settings.availableInMCP // false')
BEFORE_ACTIVE=$(echo "$GET_BODY" | jq -r '.active')
BEFORE_NODES_LEN=$(echo "$GET_BODY" | jq -r '.nodes | length')

# Idempotency check: if availableInMCP is already true, no-op
if [ "$BEFORE_MCP" = "true" ]; then
  echo "Workflow $WORKFLOW_ID already has availableInMCP=true (no-op)"
  echo "=== Before / After Verification ==="
  echo "  .settings: $BEFORE_SETTINGS -> $BEFORE_SETTINGS"
  echo "  .settings.availableInMCP: $BEFORE_MCP -> $BEFORE_MCP"
  echo "  .active: $BEFORE_ACTIVE -> $BEFORE_ACTIVE"
  echo "  .nodes | length: $BEFORE_NODES_LEN -> $BEFORE_NODES_LEN"
  echo "Success: $WORKFLOW_ID already configured."
  exit 0
fi

# 2. Prepare PUT payload
TMP_PAYLOAD=$(mktemp)
echo "$GET_BODY" | jq -c '{
  name: .name,
  nodes: .nodes,
  connections: .connections,
  settings: ((.settings + {availableInMCP: true}) | del(.binaryMode, .timeSavedMode))
} + (if .staticData != null then {staticData: .staticData} else {} end)
  + (if .pinData != null then {pinData: .pinData} else {} end)
  + (if .description != null then {description: .description} else {} end)
' > "$TMP_PAYLOAD"

# 3. Send PUT request
PUT_RESP=$(curl -s -w "\n%{http_code}" -X PUT \
  -H "X-N8N-API-KEY: $API_KEY" \
  -H "Content-Type: application/json" \
  --data-binary "@$TMP_PAYLOAD" \
  "$BASE_URL")
PUT_CODE=$(echo "$PUT_RESP" | tail -n1)
PUT_BODY=$(echo "$PUT_RESP" | sed '$d')

rm -f "$TMP_PAYLOAD"
TMP_PAYLOAD=""

if [ "$PUT_CODE" != "200" ]; then
  echo "Error: PUT failed with HTTP $PUT_CODE: $PUT_BODY" >&2
  exit 1
fi

# 4. Verify via re-GET
VERIFY_RESP=$(curl -s -w "\n%{http_code}" -H "X-N8N-API-KEY: $API_KEY" "$BASE_URL")
VERIFY_CODE=$(echo "$VERIFY_RESP" | tail -n1)
VERIFY_BODY=$(echo "$VERIFY_RESP" | sed '$d')

if [ "$VERIFY_CODE" != "200" ]; then
  echo "Error: Verification GET failed with HTTP $VERIFY_CODE" >&2
  exit 1
fi

AFTER_SETTINGS=$(echo "$VERIFY_BODY" | jq -c '.settings')
AFTER_MCP=$(echo "$VERIFY_BODY" | jq -r '.settings.availableInMCP // false')
AFTER_ACTIVE=$(echo "$VERIFY_BODY" | jq -r '.active')
AFTER_NODES_LEN=$(echo "$VERIFY_BODY" | jq -r '.nodes | length')

echo "=== Before / After Verification ==="
echo "  .settings: $BEFORE_SETTINGS -> $AFTER_SETTINGS"
echo "  .settings.availableInMCP: $BEFORE_MCP -> $AFTER_MCP"
echo "  .active: $BEFORE_ACTIVE -> $AFTER_ACTIVE"
echo "  .nodes | length: $BEFORE_NODES_LEN -> $AFTER_NODES_LEN"

# Check 1: availableInMCP is true
if [ "$AFTER_MCP" != "true" ]; then
  echo "Error: Verification check failed: .settings.availableInMCP is not true (got $AFTER_MCP)" >&2
  exit 1
fi

# Check 2: active status unchanged
if [ "$AFTER_ACTIVE" != "$BEFORE_ACTIVE" ]; then
  echo "Error: Verification check failed: .active changed ($BEFORE_ACTIVE -> $AFTER_ACTIVE)" >&2
  exit 1
fi

# Check 3: nodes length unchanged
if [ "$AFTER_NODES_LEN" != "$BEFORE_NODES_LEN" ]; then
  echo "Error: Verification check failed: .nodes | length changed ($BEFORE_NODES_LEN -> $AFTER_NODES_LEN)" >&2
  exit 1
fi

echo "Success: $WORKFLOW_ID successfully updated and verified."
exit 0
