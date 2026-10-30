# ACTION-001 — Republish two n8n workflows whose monthly schedule trigger has never fired

Owner: Anirban
Repo: anirban475/amatec
Working copy on VPS: `/root/projects/amatec`

## Why this exists

Two "Important"-tagged n8n workflows on n8n.amatec.in have been **active** for
months but have **zero executions ever**, confirmed by querying
`workflow_entity` / `execution_entity` directly in the `n8n` Postgres database
on the `shared-postgres` container:

- `Marketing 360 - Monthly Cost Carry-Forward` (id `MktCst0CarryFwd1`) — a
  Schedule Trigger node (`30 0 1 * *`, i.e. 1st of the month). Active since
  2026-07-14. Should have fired on Aug 1, Sep 1 and Oct 1. It has never run
  once.
- `Attendence / Salary -Team Logger - Amatec` (id `rDoTnibHHAnivBpK`) — a
  Schedule Trigger node (monthly interval). Active since 2026-04-24. Should
  have fired 6 times since. It has never run once.

n8n normally re-registers every active workflow's schedule trigger on
process startup. The most likely explanation is that the trigger was never
actually (re-)registered in the running process — e.g. it was activated once
and the n8n process has since restarted without picking the cron back up.
Toggling a workflow inactive → active forces n8n to re-run its trigger
registration code for that workflow right now, which is the only way to
check this without waiting for the 1st of next month.

This is a diagnose-and-nudge task, not a code fix: the workflow definitions
themselves are not to be touched, only their active/inactive state.

## Step 1 — report only, no changes

Read the current state and report, with real command output and exit codes:

1. Confirm `docker ps` shows a container literally named `n8n` (image
   `n8nio/n8n:2.17.8`) and a separate `n8n-client1` (image
   `n8nio/n8n:latest`). We believe the workflows above live on the `n8n`
   container talking to the `n8n` database on the `shared-postgres`
   container. Confirm or correct this.
2. Read-only, via `docker exec shared-postgres psql -U admin -d n8n -c`:
   `SELECT id, name, active, "updatedAt" FROM workflow_entity WHERE id IN
   ('MktCst0CarryFwd1','rDoTnibHHAnivBpK');` — paste the real output.
3. Does an n8n REST/public API key already exist on this VPS (in an `.env`,
   a secrets file, or a config this process can read) that can authenticate
   to `https://n8n.amatec.in/api/v1/...`? Report the key's **name and file
   location only**, never its value. If none exists, report that plainly —
   do not create one.
4. Run `docker exec n8n n8n --help` and report whether the n8n CLI exposes
   any subcommand that can activate/deactivate a workflow by id (recent n8n
   versions generally do not — confirm what is actually there, don't assume).
5. Run `docker logs n8n --since 24h 2>&1 | grep -iE "schedule|cron|trigger|MktCst0CarryFwd1|rDoTnibHHAnivBpK"` and paste whatever it returns (or confirm it returned nothing).

Report key names only where credentials are involved. Never print a value,
not even partially.

Stop after reporting. Do not toggle, activate, deactivate, or modify any
workflow yet, and do not write anything.

## Step 2 — toggle and verify, with a committed script

Based on what Step 1 found for the auth method (REST API key, or n8n's
internal API via an authenticated session — pick whichever is real and
already available; do not create new credentials), create
`scripts/n8n-republish-workflow.sh` in this repo:

- Takes one argument: a workflow id.
- Reads its current `active` state.
- Sets it to `false`, confirms the response/state shows `false`.
- Waits 2 seconds.
- Sets it back to `true`, confirms the response/state shows `true`.
- Prints the before state and the after state as plain JSON lines.
- Exits `0` only if the final confirmed state is `true` for that workflow id,
  non-zero otherwise.

Run it once for `MktCst0CarryFwd1` and paste the full real output and exit
code. Run it once for `rDoTnibHHAnivBpK` and paste the full real output and
exit code. Then run `docker logs n8n --since 5m 2>&1 | grep -iE "MktCst0CarryFwd1|rDoTnibHHAnivBpK|schedule"` and paste that too.

**Leave the script uncommitted.** Committing is the operator's step.

## Rules for this task

- Work only inside `/root/projects/amatec`. Touch nothing else on the VPS.
- The only two workflow ids in scope are `MktCst0CarryFwd1` and
  `rDoTnibHHAnivBpK`. Do not activate, deactivate, edit, export, or otherwise
  touch any other workflow, on the `n8n` container or on `n8n-client1`.
- Do not edit the nodes, connections, or parameters of either workflow. This
  is an active/inactive toggle only, nothing else.
- Do not restart, stop, reconfigure, or upgrade the `n8n`, `n8n-client1`, or
  `shared-postgres` containers, or any other running service. If reaching the
  goal seems to require a restart, stop and report that instead of doing it.
- Do not write to the `shared-postgres` database directly (no `UPDATE`/
  `INSERT`/`DELETE`). Reads only. All writes go through the n8n API/CLI you
  found in Step 1.
- Do not create, rotate, or print any credential, token, or API key value.
  Names and file paths only.
- Do not commit or push. Paste real output and stop.
- One step per reply. Finish a step, report, and wait.

## Acceptance

Done when, for both `MktCst0CarryFwd1` and `rDoTnibHHAnivBpK`:
`scripts/n8n-republish-workflow.sh <id>` runs, exits `0`, and its pasted
output shows the workflow's state going `true → false → true` with real API
responses (not a summary) for each hop.
