# ACTION-001 — Check Attendance/Salary n8n workflow health

Owner: Anirban
Repo: anirban475/amatec
Working copy on VPS: `/root/projects/amatec`

## Why this exists

The n8n workflow "Attendence / Salary -Team Logger - Amatec" (workflow id
`rDoTnibHHAnivBpK`, on n8n.amatec.in) drives attendance/salary processing and
is currently active. Claude's n8n tooling cannot read its config or execution
history because the workflow's "Available in MCP" setting is off, and no tool
exposed to Claude can flip that flag. Nobody has checked whether this
workflow's recent runs actually succeeded, so a silent failure could be
shipping wrong attendance or salary numbers with no one noticing.

## Step 1 — report only, no changes

Read the current state and report:

1. Is n8n (n8n.amatec.in) hosted on this VPS? Check with `docker ps`,
   `systemctl status`, or however it actually runs here.
2. If it is local, do you have access to its database (e.g. Postgres) or its
   CLI (the `n8n` command) that could read a specific workflow's definition
   and its execution history by workflow id, without needing the n8n web UI?
3. Separately, does any n8n REST API key or credential already exist in a
   config file, secrets store, or `.env` on this VPS that could authenticate
   to https://n8n.amatec.in's REST API? Report only the key's name and file
   location if one exists.
4. Is https://n8n.amatec.in reachable from this VPS at all, e.g.
   `curl -sS -o /dev/null -w "%{http_code}\n" https://n8n.amatec.in`?

Report key names only where credentials are involved. Never print a value,
not even partially.

Stop after reporting. Do not write anything, do not query any database, do
not call the n8n API, and do not toggle any workflow setting yet.

## Rules for this task

- Work only inside `/root/projects/amatec`. Touch nothing else on the VPS.
- Do not restart, stop, reconfigure, or upgrade n8n or any other running
  service.
- Do not modify, activate, deactivate, or export the "Attendence / Salary
  -Team Logger - Amatec" workflow (id `rDoTnibHHAnivBpK`) or any other
  workflow.
- Do not print any secret, token, password, or API key value. Names and file
  paths only.
- Do not commit or push. Report the findings from Step 1 and stop.
- One step per reply. Finish Step 1, report, and wait for the next
  instruction.

## Acceptance

Done when all four questions above are answered with the real command output
(not a summary) and its exit code, and no write of any kind has happened on
the VPS or in n8n.
