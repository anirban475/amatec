# ACTION-001: Search Console tool in the Google Analytics MCP workflow

Owner: Anirban
Repo: anirban475/amatec
Working copy on VPS: `/root/projects/amatec`
n8n workflow: "Google Analytics MCP Server", id `kLE2MrhdbVHVgwAu` (MCP Server Trigger, path `google-analytics-mcp`, 7 HTTP Request Tool nodes, auth is the `googleApi` service account credential)

## Why this exists

Anirban cannot see which Google search query brought a visitor to jobdrive.ai. GA4 and Clarity do not expose queries, so a Jobdrive signup on 16 Oct 2026 from google / organic could only be traced to the homepage, not to the search that found it. The GA MCP already runs on this n8n instance and is wired into Claude. Adding a Search Console tool to it gives Claude queries, pages, clicks and impressions without a new server.

## Step 1: report only, no changes

Report, with pasted command output:

1. How n8n runs on this VPS (docker container name or systemd service, and the base URL it listens on).
2. How you can reach the n8n public API from here (which env var or config key holds the API key). Report key names only. Never print a value, not even partially.
3. Whether workflow `kLE2MrhdbVHVgwAu` exists and is active. Paste its node names and the connections list.
4. The name and type of the credential used by the `run_report` node. Do not open or print the credential contents.

Stop after reporting. Do not write anything yet.

## Step 2: build

Add one node to workflow `kLE2MrhdbVHVgwAu`:

- Name: `run_search_analytics`
- Type: `n8n-nodes-base.httpRequestTool`, typeVersion 4.4, same pattern as the existing `run_report` node
- Credential: reuse the same `googleApi` credential the other nodes use
- Method: POST
- URL: `https://www.googleapis.com/webmasters/v3/sites/{{ encodeURIComponent($fromAI("site_url", "The Search Console property exactly as registered, e.g. https://jobdrive.ai/ for a URL prefix property", "string")) }}/searchAnalytics/query`
- Body: JSON, taken from a `$fromAI('request', ...)` input, a serialized searchAnalytics.query request body containing startDate, endDate, dimensions (query, page, date, country, device), rowLimit and optional dimensionFilterGroups
- Tool description: say plainly that Search Console data lags about 2 days, dates are YYYY-MM-DD, and give one example request body
- Connect it to the MCP Server Trigger node with an `ai_tool` connection, exactly like the other seven

Then export the workflow JSON to `/root/projects/amatec/n8n/google-analytics-mcp.workflow.json`, check the file contains no key, token or password strings (credential id and name are fine), and paste the output of the check and `git status --short`.

Requirements:

- Do not edit any other node, and do not edit any other workflow.
- The credential's scope list is edited by Anirban in the n8n UI. If the node needs the `webmasters.readonly` scope and the credential lacks it, say so in your report. Do not touch the credential.
- Do not restart, stop or reconfigure n8n.
- Leave the exported file uncommitted.

## Step 3: test (only after Anirban confirms the credential scope and Search Console access are set)

Run the `run_search_analytics` node once through n8n with this input and paste the raw response and HTTP status:

- site_url: `https://jobdrive.ai/`
- request: `{"startDate":"2026-10-10","endDate":"2026-10-14","dimensions":["query","page"],"rowLimit":25}`

Expect HTTP 200 and a `rows` array. A 403 means the service account is not added to the Search Console property, and a 400 with an API-disabled message means the Search Console API is not enabled. Report either one exactly as returned, with no secrets.

## Rules for this task

- Work only inside `/root/projects/amatec` and the n8n workflow named above. Touch nothing else on the VPS.
- Do not edit `website/` or `README.md`.
- Never print credential values, tokens or the service account JSON, not even partially. Report key names only.
- Do not commit or push. Build it, run it, paste the output, stop.
- One step per reply. Finish a step, report, and wait.

## Acceptance

Done when the n8n API returns the workflow with a `run_search_analytics` node connected to the MCP trigger through `ai_tool`, and the Step 3 test returns HTTP 200 with rows for `https://jobdrive.ai/`.
