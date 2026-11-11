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

BEFORE_MCP=$(echo "$GET_BODY" | jq '.settings.availableInMCP // false')
BEFORE_ACTIVE=$(echo "$GET_BODY" | jq '.active')
BEFORE_NODES=$(echo "$GET_BODY" | jq '.nodes | length')

if [ "$BEFORE_MCP" = "true" ]; then
  echo "=== Before / After Verification ==="
  echo "  .settings.availableInMCP: true -> true (already enabled, no-op)"
  echo "  .active: $BEFORE_ACTIVE -> $BEFORE_ACTIVE"
  echo "  .nodes | length: $BEFORE_NODES -> $BEFORE_NODES"
  echo "Success: $WORKFLOW_ID already has MCP access enabled."
  exit 0
fi

# n8n's public API returns 405 for PATCH, so update via a full PUT,
# round-tripping every field exactly as GET returned it except settings.
PAYLOAD=$(echo "$GET_BODY" | jq '{
  name: .name,
  nodes: .nodes,
  connections: .connections,
  settings: (.settings + {availableInMCP: true}),
  staticData: .staticData,
  pinData: .pinData
}')

PUT_RESP=$(curl -s -w "\n%{http_code}" -X PUT -H "X-N8N-API-KEY: $API_KEY" -H "Content-Type: application/json" -d "$PAYLOAD" "$BASE_URL")
PUT_CODE=$(echo "$PUT_RESP" | tail -n1)
PUT_BODY=$(echo "$PUT_RESP" | sed '$d')

if [ "$PUT_CODE" != "200" ]; then
  echo "Error: PUT failed with HTTP $PUT_CODE" >&2
  echo "$PUT_BODY" >&2
  exit 1
fi

VERIFY_RESP=$(curl -s -w "\n%{http_code}" -H "X-N8N-API-KEY: $API_KEY" "$BASE_URL")
VERIFY_CODE=$(echo "$VERIFY_RESP" | tail -n1)
VERIFY_BODY=$(echo "$VERIFY_RESP" | sed '$d')

if [ "$VERIFY_CODE" != "200" ]; then
  echo "Error: post-update GET failed with HTTP $VERIFY_CODE" >&2
  exit 1
fi

AFTER_MCP=$(echo "$VERIFY_BODY" | jq '.settings.availableInMCP // false')
AFTER_ACTIVE=$(echo "$VERIFY_BODY" | jq '.active')
AFTER_NODES=$(echo "$VERIFY_BODY" | jq '.nodes | length')

echo "=== Before / After Verification ==="
echo "  .settings.availableInMCP: $BEFORE_MCP -> $AFTER_MCP"
echo "  .active: $BEFORE_ACTIVE -> $AFTER_ACTIVE"
echo "  .nodes | length: $BEFORE_NODES -> $AFTER_NODES"

if [ "$AFTER_MCP" = "true" ] && [ "$BEFORE_ACTIVE" = "$AFTER_ACTIVE" ] && [ "$BEFORE_NODES" = "$AFTER_NODES" ]; then
  echo "Success: $WORKFLOW_ID successfully updated and verified."
  exit 0
else
  echo "Error: Verification failed (availableInMCP: $AFTER_MCP, active before/after: $BEFORE_ACTIVE/$AFTER_ACTIVE, nodes before/after: $BEFORE_NODES/$AFTER_NODES)" >&2
  exit 1
fi
