# ACTION-002 — Roll out n8n MCP access to every active workflow

Owner: Anirban
Repo: anirban475/amatec
Working copy on VPS: `/root/projects/amatec`

## Why this exists

ACTION-001 fixed 5 specific workflows that were invisible to the n8n MCP tool.
Anirban then asked for the same fix everywhere: every active, non-archived
workflow in this n8n instance should have `settings.availableInMCP = true`,
so that any future health check or debugging session can actually read
execution data instead of hitting "Workflow is not available in MCP" for an
unknown subset of workflows. Today there are 72 such workflows (`active =
true AND "isArchived" = false` in `workflow_entity`); more will be added
later, so this should be repeatable, not a one-off list.

This depends on `scripts/n8n-enable-mcp-access.sh` from ACTION-001 already
being merged to `main` in this repo. If it is not there yet, stop and say so
instead of rebuilding it — read `git log` / the file list first.

## Step 1 — report only, no changes

Run against Postgres (same `docker exec shared-postgres psql -U admin -d n8n`
pattern as the existing scripts):

```sql
SELECT id, name, active, "isArchived",
       (settings->>'availableInMCP') AS available_in_mcp
FROM workflow_entity
WHERE active = true AND "isArchived" = false
ORDER BY name;
```

Report: total count, how many already show `available_in_mcp = true`, and
the full list of ids that do NOT (these are the ones that need the change).
Also confirm `scripts/n8n-enable-mcp-access.sh` exists in this working copy
and is executable.

Stop after reporting. Do not write anything yet.

## Step 2 — dry run

Create `scripts/n8n-enable-mcp-access-batch.sh`.

Usage: `scripts/n8n-enable-mcp-access-batch.sh [--dry-run]`

Requirements:

- Pull the id list itself, from the exact same SQL query as Step 1 — do not
  hardcode a list of ids in the script, since this needs to stay correct as
  workflows are added later.
- For each id where `available_in_mcp` is not already `true`:
  - In `--dry-run` mode: GET the workflow, print `id | name | current
    settings.availableInMCP value (or "missing") | active | node count`.
    Make no write of any kind.
  - Without `--dry-run`: call `scripts/n8n-enable-mcp-access.sh <id>` for
    that id (don't re-implement its logic — shell out to it) and capture its
    exit code.
- Ids where `available_in_mcp` is already `true` are skipped, printed once in
  a one-line "already enabled, skipping" summary, not one line each.
- At the end, print a summary table: total considered, already-enabled count,
  changed count, failed count, and the specific ids of any failures.
- Exit 0 only if every attempted id succeeded; otherwise exit 1 listing which
  ids failed.

Run it with `--dry-run` against the real 72-workflow list and paste the full
output. **Do not run it for real in this step.** This is the point where
Claude reviews the planned change list before anything is written.

**Leave the file uncommitted.**

## Step 3 — real run (only after Claude replies "proceed" in this thread)

Run `scripts/n8n-enable-mcp-access-batch.sh` for real (no `--dry-run`) against
the full active, non-archived workflow list. Paste the full real output,
including the summary table at the end. If anything failed, say which ids and
why — do not retry failed ids on your own; stop and report them.

## Step 4 — verification sweep

Re-run the Step 1 SQL query. Report the new count of
`available_in_mcp = true` vs the total active, non-archived count. For the 5
workflows named in ACTION-001 plus 5 more picked at random from the full
list, report `.active` and `.nodes | length` from a fresh GET on each,
compared against what the earlier GETs in this thread showed, to confirm
nothing besides `.settings` moved.

## Rules for this task

- Work only inside `/root/projects/amatec`. Touch nothing else on the VPS.
- Do not edit `scripts/n8n-enable-mcp-access.sh` from ACTION-001 — call it,
  don't modify it, unless Step 1's health check in that script is actually
  broken, in which case stop and report rather than patching it here.
- Never deactivate, archive, or touch nodes/connections on any workflow. The
  only field that should ever change is `.settings.availableInMCP`.
- Do not restart, stop or reconfigure n8n or the shared-postgres container.
- Do not commit or push. Build it, run it, paste the output, stop.
- One step per reply. Finish a step, report, and wait — especially the gap
  between Step 2 (dry run) and Step 3 (real run): do not run Step 3 until
  explicitly told "proceed" in this thread.

## Acceptance

Done when the Step 1 query, re-run at the end, shows
`available_in_mcp = true` for all active, non-archived workflows, and the
sampled before/after `.active` / node-count checks in Step 4 show no
unintended changes.
