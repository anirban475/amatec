# ACTION-001 — Enable n8n MCP access on 5 workflows (and confirm they're healthy)

Owner: Anirban
Repo: anirban475/amatec
Working copy on VPS: `/root/projects/amatec`

## Why this exists

Today's Important-workflow health check found 5 active n8n workflows where the
n8n MCP server refuses to return execution data: "Workflow is not available in
MCP. Enable MCP access in workflow settings." Postgres confirms their
`workflow_entity.settings` JSON is simply missing the `availableInMCP` key
(workflows that *do* work, e.g. `ClarityDailySync01`, have
`"availableInMCP":true` in that same column). Until this is set, nobody —
Claude or Anirban — can inspect these workflows' execution data through the
MCP tool, which is exactly how today's gap was found. There's also an existing
precedent script in this repo, `scripts/n8n-republish-workflow.sh`, which
already knows how to auth against the n8n API — read it first.

The 5 workflows:

| Name | id |
|---|---|
| Cal.com Bookings to Database Sync | `CalComBookingsSync` |
| GA4 Daily Session & Conversion Sync | `Ga4DailySync01` |
| Marketing360 - Data Health Alert | `DataHealthAlert01` |
| Marketing360 - Human Sessions Roll-up | `HumanSessRollup01` |
| Rehire Alert Poster | `YYWQuqkTKc6yf0JU` |

Postgres already shows zero errored/crashed executions for any of these 5 in
the last 24h — this job is about the MCP-visibility setting, not a functional
bug. But confirm that in Step 1 anyway, independently, before touching anything.

## Step 1 — report only, no changes

Read `scripts/n8n-republish-workflow.sh` in this repo to see the existing auth
pattern (API key retrieved from Postgres `user_api_keys` table, label
`Claude`; base URL `https://n8n.amatec.in/api/v1/workflows/<id>`; header
`X-N8N-API-KEY`).

For each of the 5 workflow ids above, call `GET /api/v1/workflows/<id>` with
that key and report, per workflow:

1. `active` and the number of nodes (`.nodes | length`)
2. the full `.settings` object as it stands today
3. whether any node looks disabled, or references a credential that the GET
   response flags as missing/invalid (the API response includes enough to
   tell — report what you see, don't guess)

Also try one exploratory call: `PATCH /api/v1/workflows/<id>` with body
`{"settings": {...the workflow's current settings merged with
"availableInMCP": true...}}` against **one** of the 5 (`DataHealthAlert01`)
and report the raw HTTP status and body. Do not treat this as the real fix —
just report what status code n8n's API gives for a PATCH that only touches
`settings` (the existing script found PATCH returns 405 for `active` and
falls back to `/activate`; `settings` may behave differently). If it returns
anything other than a clean 200 with the new settings in the body, say so and
stop — do not retry with PUT or any other verb yet.

Report key names only where credentials are involved. Never print a value,
not even partially.

Stop after reporting. Do not write anything yet.

## Step 2 — build and test on one workflow

Create `scripts/n8n-enable-mcp-access.sh`, modeled on
`scripts/n8n-republish-workflow.sh`'s auth and error-handling style.

Usage: `scripts/n8n-enable-mcp-access.sh <workflow_id>`

Requirements:

- `GET /api/v1/workflows/<id>` first. Fail loudly (non-zero exit, message to
  stderr) on anything other than HTTP 200, exactly like the existing script
  does for 401/403/non-200.
- Take the `.settings` object from that response and produce a new settings
  object identical in every other key, with `availableInMCP` set to `true`.
  Use `jq '.settings + {availableInMCP: true}'` or equivalent — do not
  hand-construct the settings object, or it WILL drop keys like
  `callerPolicy` or `timezone` that some workflows already carry.
- Send the update using whichever verb Step 1 found actually works for a
  settings-only change (PATCH if it returned 200 there; otherwise fall back
  the same way the existing script falls back from PATCH 405 to a dedicated
  endpoint — if there is no dedicated settings endpoint, this likely means a
  full `PUT` with the complete workflow object as returned by the GET, with
  only `.settings` swapped and `nodes`/`connections`/`name`/`active` passed
  back byte-identical to what GET returned. If it comes to that, say so
  explicitly in your Step 2 reply before running it, since a PUT round-trip
  is the one place a bug could silently drop nodes.)
- After the write, `GET` again and verify: `.settings.availableInMCP == true`,
  `.active` unchanged from before the write, and `.nodes | length` unchanged
  from before the write. Print all three before/after pairs.
- Exit 0 only if all three checks pass; otherwise exit 1 with a clear message
  naming which check failed.
- Idempotent: running it twice on the same id is a no-op the second time and
  still exits 0.

Run it once against `DataHealthAlert01` and paste the real output — not a
summary.

**Leave the file uncommitted.** Committing is the operator's step.

## Step 3 — run it on the remaining 4

Run `scripts/n8n-enable-mcp-access.sh` once each against:

- `CalComBookingsSync`
- `Ga4DailySync01`
- `HumanSessRollup01`
- `YYWQuqkTKc6yf0JU`

Paste the real output of all four runs.

## Rules for this task

- Work only inside `/root/projects/amatec`. Touch nothing else on the VPS.
- Do not edit `scripts/n8n-republish-workflow.sh`. Read it, don't change it.
- Do not deactivate, archive, or edit the nodes/connections of any of these 5
  workflows. The only field that should ever change is `.settings`.
- Do not touch any workflow outside this list of 5 in this brief. (A larger
  rollout to every active workflow is a separate, already-planned brief —
  do not pre-empt it here.)
- Do not restart, stop or reconfigure n8n or the shared-postgres container.
- Do not commit or push. Build it, run it, paste the output, stop.
- One step per reply. Finish a step, report, and wait.

## Acceptance

Done when, for each of the 5 workflow ids above, `GET /api/v1/workflows/<id>`
shows `settings.availableInMCP == true`, `.active` and `.nodes | length` match
what Step 1 recorded, and `scripts/n8n-enable-mcp-access.sh <id>` exits 0 when
run again on that id.
