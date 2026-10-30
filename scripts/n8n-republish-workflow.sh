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
trap 'unset API_KEY' EXIT

BASE_URL="https://n8n.amatec.in/api/v1/workflows/$WORKFLOW_ID"

echo "=== 1. Initial State ==="
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

INIT_ACTIVE=$(echo "$GET_BODY" | jq '.active')
echo "Initial .active: $INIT_ACTIVE"

echo "=== 2. Deactivating ==="
PATCH_RESP=$(curl -s -w "\n%{http_code}" -X PATCH -H "X-N8N-API-KEY: $API_KEY" -H "Content-Type: application/json" -d '{"active": false}' "$BASE_URL")
PATCH_CODE=$(echo "$PATCH_RESP" | tail -n1)
PATCH_BODY=$(echo "$PATCH_RESP" | sed '$d')

if [ "$PATCH_CODE" = "405" ]; then
  echo "PATCH status: $PATCH_CODE (n8n public API does not support PATCH; using POST /deactivate)"
  DEACT_RESP=$(curl -s -w "\n%{http_code}" -X POST -H "X-N8N-API-KEY: $API_KEY" "$BASE_URL/deactivate")
  DEACT_CODE=$(echo "$DEACT_RESP" | tail -n1)
  DEACT_BODY=$(echo "$DEACT_RESP" | sed '$d')
  echo "HTTP status: $DEACT_CODE"
  DEACT_ACTIVE=$(echo "$DEACT_BODY" | jq '.active')
  echo ".active: $DEACT_ACTIVE"
else
  echo "HTTP status: $PATCH_CODE"
  DEACT_ACTIVE=$(echo "$PATCH_BODY" | jq '.active')
  echo ".active: $DEACT_ACTIVE"
fi

sleep 2

echo "=== 3. Reactivating ==="
PATCH_RESP=$(curl -s -w "\n%{http_code}" -X PATCH -H "X-N8N-API-KEY: $API_KEY" -H "Content-Type: application/json" -d '{"active": true}' "$BASE_URL")
PATCH_CODE=$(echo "$PATCH_RESP" | tail -n1)
PATCH_BODY=$(echo "$PATCH_RESP" | sed '$d')

if [ "$PATCH_CODE" = "405" ]; then
  echo "PATCH status: $PATCH_CODE (n8n public API does not support PATCH; using POST /activate)"
  ACT_RESP=$(curl -s -w "\n%{http_code}" -X POST -H "X-N8N-API-KEY: $API_KEY" "$BASE_URL/activate")
  ACT_CODE=$(echo "$ACT_RESP" | tail -n1)
  ACT_BODY=$(echo "$ACT_RESP" | sed '$d')
  echo "HTTP status: $ACT_CODE"
  ACT_ACTIVE=$(echo "$ACT_BODY" | jq '.active')
  echo ".active: $ACT_ACTIVE"
else
  echo "HTTP status: $PATCH_CODE"
  ACT_ACTIVE=$(echo "$PATCH_BODY" | jq '.active')
  echo ".active: $ACT_ACTIVE"
fi

echo "=== 4. Re-confirming via Postgres ==="
DB_ACTIVE=$(docker exec shared-postgres psql -U admin -d n8n -t -A -c "SELECT active FROM workflow_entity WHERE id='$WORKFLOW_ID';")
echo "DB active: $DB_ACTIVE"

if [ "$ACT_ACTIVE" = "true" ] && [ "$DB_ACTIVE" = "t" ]; then
  echo "Workflow $WORKFLOW_ID successfully republished and active."
  exit 0
else
  echo "Error: Verification failed (API active: $ACT_ACTIVE, DB active: $DB_ACTIVE)" >&2
  exit 1
fi
