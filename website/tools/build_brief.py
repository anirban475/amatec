#!/usr/bin/env python3
"""Builds website/AMATEC-WEBSITE-AIO-BRIEF.md from edits.py and new-files/."""
import os
import sys

HERE = os.path.dirname(os.path.abspath(__file__))
sys.path.insert(0, HERE)
from edits import EDITS  # noqa: E402

OUT = os.path.join(os.path.dirname(HERE), "AMATEC-WEBSITE-AIO-BRIEF.md")

YOAST = [
    ("/", "Workflow Automation Agency for Make, n8n and Zoho | Amatec",
     "Amatec builds and runs automated workflows on Make.com, n8n, Zoho and monday.com for growing teams in the US and Europe. Book a free 30-minute audit."),
    ("/about/", "About Amatec, the Automation Studio in Vadodara",
     "Founder-led automation studio building on Make.com, n8n, Zoho and monday.com since 2020. Meet Anirban Sinha and see how we work."),
    ("/make-com-automation/", "Make.com Automation Experts | Amatec",
     "We design, build and fix Make.com scenarios with error handling and documentation, and move Zaps over from Zapier. Book a free 30-minute call."),
    ("/n8n-workflow-automation/", "n8n Automation Services, Self-Hosted or Cloud | Amatec",
     "Amatec sets up self-hosted n8n and builds secure workflows for APIs, databases and AI. Your data stays on your servers. Book a free call."),
    ("/monday-com-workflow-automation/", "monday.com Automation and Board Setup | Amatec",
     "We fix monday.com board structure, build automation recipes and connect monday.com to Slack, HubSpot and your other tools. Book a free call."),
    ("/zoho-workflow-automation/", "Zoho Automation, Deluge and Extensions | Amatec",
     "Deluge scripts, Zoho Flow and custom extensions across Zoho CRM, Books, Inventory and Creator, from a team with two Zoho Marketplace apps."),
    ("/ai-powered-task-automation/", "AI Workflow Automation and MCP Servers | Amatec",
     "Add AI steps that sort email, read invoices and score leads, or connect ChatGPT and Claude to your Zoho data with an MCP server."),
    ("/crm-automation/", "CRM Automation for Zoho CRM and More | Amatec",
     "Lead capture, routing, follow-ups and pipeline reports that run on their own, built by Zoho specialists. Book a free 30-minute CRM audit."),
    ("/t-chat-zoho-extension/", "T-Chat: Twilio SMS and MMS in Zoho CRM | Amatec",
     "Send and receive Twilio SMS and MMS from Zoho CRM records, with the full chat history on every lead and contact. Install from the Zoho Marketplace."),
    ("/stock-procurement-for-zoho-inventory/", "Stock Procurement for Zoho Inventory | Amatec",
     "Turn a production target into an exact raw-material purchase list for composite items, right inside Zoho Inventory. Built and supported by Amatec."),
    ("/contact/", "Contact Amatec, Workflow Automation Agency",
     "Email hello@amatec.in, call +91 72659 69478 or book a 30-minute call. An automation engineer replies within one business day."),
]

FACTS = [
    ("F1", "Years in business. Site says '9 years' (About, platform pages) and '5+ years' (landing pages).",
     "Use 'since 2020' everywhere. The Produits du Cap testimonial already says 'partner since 2020'.",
     "If the real first-client year differs, replace 2020 with it in every edit tagged F1 and in summary.php, llms.txt and inc/aio.php."),
    ("F2", "Free call length. Site says 45 minutes in some places, 30 in others.",
     "30 minutes. Verified 6 Oct 2026: the Cal.com event amatec/meeting is 30 minutes.",
     "No decision needed."),
    ("F3", "Stat cards '250+ workflows shipped' and '120+ satisfied clients' on the Make, monday and Zoho pages.",
     "Replace with checkable facts (edits P01 to P03).",
     "YES (Anirban can show the count): skip P01, P02, P03, then by hand change only the '9 yrs' card to '2020' / 'Building client automations since'."),
    ("F4", "Homepage results: '40+ hrs/month saved per workflow on average' and '2 wks typical from audit to live'.",
     "Replace with checkable facts (edits H06 to H08).",
     "YES (there is data behind both): skip H06, H07, H08."),
    ("F5", "Certifications: Make Advanced Certified Partner, Zoho Certified Partner, monday.com Work Management Core.",
     "Keep the platform-page badges (Make, Zoho, monday) as they are. Remove the blanket 'certified across all four' lines (A04, A07, A10, A12).",
     "YES for all four platforms including n8n: skip A04, A07, A10, A12. NO for Zoho partner: also change H01 and Z01 as their notes say. NO for Make Advanced or monday Core: tell Anirban, do not ship those pages until the badge text is fixed."),
    ("F6", "Blink Energy Services (TX) listed as a client on About.",
     "Remove it (edit A13). The deal was lost on 6 Jul 2026.",
     "YES (paid work was delivered and they agree to be named): skip A13."),
    ("F7", "Make.com public app 'Aurora Solar' claimed on About.",
     "Keep. New copy also says 'an app on Make'.",
     "NO (app is not live): remove 'one on Make' / 'an app on Make' from A05, A07, H06, summary.php, llms.txt, and change the counts from 3 to 2."),
    ("F8", "Anonymous quote 'Operations lead, Multi-department onboarding rollout' on /hr-operations-automation/.",
     "Delete it (edit L24). No name and no company reads as invented.",
     "No decision needed."),
    ("F9", "T-Chat channels. Product copy says Twilio SMS and MMS. The live meta description says WhatsApp.",
     "Treat T-Chat as SMS and MMS only (TC01, TC02, Yoast row).",
     "YES (T-Chat also sends WhatsApp through Twilio): skip TC01 and TC02 and add WhatsApp to the T-Chat FAQ answer in inc/aio.php."),
    ("F10", "MCP server work (ChatGPT or Claude reading Zoho data).",
     "Keep. This is live client work (Zoho Inventory and Books MCP, Sep 2026).",
     "NO: skip A08, A09, AI04 and delete the MCP FAQ items in inc/aio.php ('Can ChatGPT or Claude read our Zoho data?' and 'What is an MCP server?')."),
    ("F11", "AI page 'Built on' list showed Google Cloud AI, Azure Cognitive Services and custom-trained models.",
     "Replace with OpenAI Whisper, Anthropic Claude and n8n AI agents (edit AI05).",
     "If Amatec has shipped Google Cloud AI or Azure work for a client, skip AI05."),
    ("F12", "'Case Studies' menu item points to #case-studies, which exists on no page.",
     "Remove the menu item (edit NAV01).",
     "If a case studies page exists, skip NAV01 and change that line's href to the page URL instead."),
]


def fence(text, lang=""):
    return f"```{lang}\n{text}\n```"


def main():
    L = []
    w = L.append
    w("# Amatec website: copy and AI search (AIO) rewrite")
    w("")
    w("Brief for a Claude Code session. Prepared 6 Oct 2026. Every find string below was tested against the theme snapshot in this repo and matched exactly once.")
    w("")
    w("## 1. What you are doing")
    w("")
    w("You are rewriting the visible copy of the Amatec WordPress theme so it reads like a person wrote it and so AI answer engines (ChatGPT, Perplexity, Claude, Gemini, Google AI Overviews) can lift clear, accurate statements about Amatec. You are also adding FAQ sections with FAQPage schema, Organization schema, and an `/llms.txt` file.")
    w("")
    w("| Item | Value |")
    w("|---|---|")
    w("| Repo | `anirban475/amatec` |")
    w("| Theme snapshot (untouched baseline) | `website/theme/amatec/` |")
    w("| Edit list (source of truth) | `website/tools/edits.py` |")
    w("| New files | `website/tools/new-files/` (copied into the theme at the same paths) |")
    w("| Apply script | `website/tools/apply_edits.py` |")
    w("| Tests | `website/tools/test_render.php`, `website/tools/dump_lp.php` |")
    w("| Live site | https://amatec.in (WordPress, Yoast SEO, LiteSpeed) |")
    w(f"| Size of change | {len(EDITS)} edits in {len({e['file'] for e in EDITS})} theme files, 3 new files, 11 Yoast title and description updates |")
    w("")
    w("### Rules you must not break")
    w("")
    w("1. Change only the strings in section 4 and add only the files in section 5. No CSS, JS, layout, class names, section IDs, slugs or URLs.")
    w("2. Never edit a client testimonial quote. Quotes are the client's words, typos included.")
    w("3. Never add a claim, number, client name or certification that is not in this brief. If something looks wrong, stop and ask Anirban.")
    w("4. Inside PHP single-quoted strings keep the typographic apostrophe `’` exactly as written here. A straight `'` would end the string and break the page. In raw HTML keep `&rsquo;`.")
    w("5. No em dash or en dash in any visible text. Code comments do not matter.")
    w("6. Do not deploy if any test in section 3, step 3 fails.")
    w("")
    w("## 2. Fact gate (Anirban fills this in before handing over)")
    w("")
    w("Some current claims could not be verified. Each row has a default. If Anirban leaves the answer blank, use the default. If he writes YES or NO, follow the last column.")
    w("")
    w("| ID | Claim | Default (blank answer) | If Anirban answers | Anirban's answer |")
    w("|---|---|---|---|---|")
    for fid, claim, default, alt in FACTS:
        w(f"| {fid} | {claim} | {default} | {alt} | |")
    w("")
    w("## 3. Steps")
    w("")
    w("### Step 1. Prepare a working copy")
    w("")
    w(fence(
        "cd <repo root>\n"
        "rm -rf /tmp/amatec-build && mkdir -p /tmp/amatec-build\n"
        "cp -r website/theme/amatec /tmp/amatec-build/amatec", "bash"))
    w("")
    w("Before editing, check the live site still matches the snapshot. If the homepage H1 below is missing, the live theme has changed since 6 Oct 2026. Stop and ask Anirban for a fresh theme zip.")
    w("")
    w(fence("curl -s https://amatec.in/ | grep -c 'Stop doing what'   # must print 1 or more", "bash"))
    w("")
    w("### Step 2. Apply the edits")
    w("")
    w("Build the skip list from section 2 (empty if every answer is blank), then run:")
    w("")
    w(fence(
        "python3 website/tools/apply_edits.py /tmp/amatec-build/amatec --dry-run --skip <IDS>\n"
        "python3 website/tools/apply_edits.py /tmp/amatec-build/amatec --skip <IDS>", "bash"))
    w("")
    w("Leave out `--skip <IDS>` when there is nothing to skip. The script refuses to write anything if a single find string fails to match, so a partial apply cannot happen. Then make any by-hand changes that section 2 asked for.")
    w("")
    w("If you cannot run Python, apply section 4 by hand in order, and copy the section 5 files into the theme. Each find string must match exactly once (edit L27 matches 14 times and replaces all of them).")
    w("")
    w("### Step 3. Test")
    w("")
    w(fence(
        "cd /tmp/amatec-build/amatec\n"
        "# 1. Every PHP file must lint clean\n"
        "find . -name '*.php' -exec php -l {} \\; | grep -v 'No syntax errors' ; echo lint-done\n"
        "# 2. Landing data still loads, no em dash left in any H1\n"
        "php <repo>/website/tools/dump_lp.php inc/lp-pages.php | grep '^HERO' | grep -c '—'   # must print 0\n"
        "# 3. FAQ, summary and schema render, and the FAQPage JSON is valid\n"
        "php <repo>/website/tools/test_render.php .   # every line must end in a number or 'yes'\n"
        "# 4. No dash pauses left in visible template strings\n"
        "grep -rn \"esc_html_e( '[^']*—\" --include=*.php . ; echo dash-check-done", "bash"))
    w("")
    w("Expected from test 3: eight FAQ sets with counts 7, 5, 5, 4, 5, 5, 4, 4, then `FAQPage valid: yes`, a summary character count, and `Org valid: yes`.")
    w("")
    w("### Step 4. Update Yoast titles and descriptions")
    w("")
    w("Page titles and meta descriptions live in the WordPress database (Yoast), not in the theme. `inc/lp-pages.php` 'meta' and `amatec_site_pages()` only apply when a page is first created, so editing them changes nothing on the live site. Set these in WP Admin, Pages, edit page, Yoast SEO box, or through the REST API (the mu-plugin `yoast-rest-meta.php` exposes `_yoast_wpseo_title` and `_yoast_wpseo_metadesc` as writable meta).")
    w("")
    w("| URL | SEO title | Meta description |")
    w("|---|---|---|")
    for url, t, d in YOAST:
        assert len(t) <= 60, (url, len(t))
        assert len(d) <= 158, (url, len(d))
        w(f"| `{url}` | {t.replace('|', chr(92) + '|')} | {d} |")
    w("")
    w("In the titles, `\\|` is only Markdown escaping. Type a plain `|` in Yoast.")
    w("")
    w("The current T-Chat description claims WhatsApp messaging, and the Stock Procurement one describes reorder and purchase-order automation the product does not do. Those two rows matter most. For the 14 landing pages under Services, Industries and Solutions, open each Yoast box and remove any em dash from the title. Leave the wording otherwise.")
    w("")
    w("### Step 5. Deploy")
    w("")
    w("1. Back up the live theme first: WP Admin cannot export a theme, so download `wp-content/themes/amatec/` from the hosting file manager, or keep `website/theme/amatec/` from this repo as the rollback copy.")
    w("2. Zip the built theme so the archive contains the `amatec/` folder at its root:")
    w("")
    w(fence("cd /tmp/amatec-build && zip -qr amatec-1.8.0.zip amatec", "bash"))
    w("")
    w("3. WP Admin, Appearance, Themes, Add New, Upload Theme, choose the zip, then click 'Replace active with uploaded'.")
    w("4. LiteSpeed Cache, Toolbox, Purge All.")
    w("")
    w("### Step 6. Check the live site")
    w("")
    w(fence(
        "curl -s -o /dev/null -w '%{http_code} %{content_type}\\n' https://amatec.in/llms.txt   # 200 text/plain\n"
        "curl -s https://amatec.in/ | grep -c 'What Amatec does'                              # 1\n"
        "curl -s https://amatec.in/ | grep -c '\"@type\":\"FAQPage\"'                            # 1\n"
        "curl -s https://amatec.in/ | grep -c '\"Organization\"'                                # 1 or more\n"
        "for p in make-com-automation n8n-workflow-automation monday-com-workflow-automation zoho-workflow-automation ai-powered-task-automation t-chat-zoho-extension stock-procurement-for-zoho-inventory workflow-automation; do\n"
        "  printf '%s ' $p; curl -s https://amatec.in/$p/ | grep -c '\"@type\":\"FAQPage\"'; done          # each 1", "bash"))
    w("")
    w("Then open the homepage and the Make page in a browser: click two FAQ questions and confirm they open and close, and confirm no layout shifted. Paste https://amatec.in/ into https://validator.schema.org and confirm FAQPage and Organization show with no errors.")
    w("")
    w("If anything looks broken, reinstall the backup zip and purge the cache.")
    w("")
    w("### Step 7. Report back")
    w("")
    w("Tell Anirban which edits were applied or skipped, the result of every check in step 6, and anything you stopped on.")
    w("")
    w("## 4. Edit catalogue")
    w("")
    w("Paths are relative to the theme folder. Indentation in multi-line finds is tabs. Facts in brackets refer to section 2.")
    w("")
    current = None
    for ed in EDITS:
        if ed["file"] != current:
            current = ed["file"]
            w(f"### `{current}`")
            w("")
        tag = f" [{ed['fact']}]" if ed["fact"] else ""
        mult = " (replace all occurrences)" if ed["all"] else ""
        w(f"**{ed['id']}**{tag}{mult}. {ed['why']}")
        w("")
        if ed["find"] == ed["replace"]:
            w("Check only, no change by default. Confirm this text exists:")
            w("")
            w(fence(ed["find"]))
            w("")
            continue
        w("Find:")
        w("")
        w(fence(ed["find"]))
        w("")
        if ed["replace"] == "":
            w("Replace with nothing (delete the found text).")
        else:
            w("Replace with:")
            w("")
            w(fence(ed["replace"]))
        w("")
    w("## 5. New files")
    w("")
    w("Create each file at this path inside the theme folder, with exactly this content.")
    w("")
    nf = os.path.join(HERE, "new-files")
    for rel, lang in (("inc/aio.php", "php"), ("template-parts/home/summary.php", "php"), ("llms.txt", "markdown")):
        with open(os.path.join(nf, rel), encoding="utf-8") as fh:
            body = fh.read().rstrip("\n")
        w(f"### `{rel}`")
        w("")
        w(fence(body, lang))
        w("")
    w("## 6. Not in this brief")
    w("")
    w("These need Anirban or a separate brief. Do not start them in this session.")
    w("")
    w("1. Blog. 118 posts and about 58,000 words in the WordPress database. Em dashes appear in 59 posts and 'streamline' in 61, and many posts are near-duplicate city pages (Miami, Denver, Phoenix and others), which Google can treat as scaled content. This needs its own pass: merge the duplicates, give each kept post a 40 to 60 word answer under its H1, and add real examples.")
    w("2. Yoast Site representation. Setting Organization in Yoast settings would make Yoast own the organisation entity. If anyone does that later, remove `amatec_org_schema()` from `inc/aio.php` so there are not two.")
    w("3. Third-party presence. AI engines cite review sites, marketplaces and LinkedIn more than a company's own site. The Zoho Marketplace listings have no reviews, no tags and empty Key Features. Zoho featured Twilio Chat in an App Spotlight post on 20 Apr 2026; once Anirban supplies that URL it should go on the T-Chat page as proof.")
    w("4. Stock Procurement demo video. Edit SP01 changes the placeholder to 'Demo video coming soon'. Recording the video is still to do.")
    w("5. Brand casing. The site mixes 'AMATEC' and 'Amatec'. New copy uses 'Amatec'. A full sweep is a design decision for Anirban.")
    w("")
    w("## 7. House style for any copy you touch")
    w("")
    w("If you must write a word that is not in this brief, it has to pass these checks.")
    w("")
    w("1. No dash used as a pause. Use a comma, a full stop or 'and'.")
    w("2. Banned words: delve, underscore, foster, enhance, leverage, utilise, spearhead, embark, pivotal, crucial, intricate, seamless, robust, vibrant, tapestry, landscape, realm, testament, journey, ecosystem, game changer, paradigm shift, overall, in summary, in conclusion.")
    w("3. Banned shapes: 'not X, it is Y', 'not just', 'not only... but also', three stacked adjectives, vague sources like 'studies show'.")
    w("4. Say the thing, then stop. Concrete names and numbers beat adjectives. Short sentences next to longer ones.")
    w("")
    with open(OUT, "w", encoding="utf-8") as fh:
        fh.write("\n".join(L))
    print(f"Wrote {OUT} ({sum(len(x) for x in L)} chars)")


if __name__ == "__main__":
    main()
