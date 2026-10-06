# Amatec website: copy and AI search (AIO) rewrite

Brief for a Claude Code session. Prepared 6 Oct 2026. Every find string below was tested against the theme snapshot in this repo and matched exactly once.

## 1. What you are doing

You are rewriting the visible copy of the Amatec WordPress theme so it reads like a person wrote it and so AI answer engines (ChatGPT, Perplexity, Claude, Gemini, Google AI Overviews) can lift clear, accurate statements about Amatec. You are also adding FAQ sections with FAQPage schema, Organization schema, and an `/llms.txt` file.

| Item | Value |
|---|---|
| Repo | `anirban475/amatec` |
| Theme snapshot (untouched baseline) | `website/theme/amatec/` |
| Edit list (source of truth) | `website/tools/edits.py` |
| New files | `website/tools/new-files/` (copied into the theme at the same paths) |
| Apply script | `website/tools/apply_edits.py` |
| Tests | `website/tools/test_render.php`, `website/tools/dump_lp.php` |
| Live site | https://amatec.in (WordPress, Yoast SEO, LiteSpeed) |
| Size of change | 102 edits in 41 theme files, 3 new files, 11 Yoast title and description updates |

### Rules you must not break

1. Change only the strings in section 4 and add only the files in section 5. No CSS, JS, layout, class names, section IDs, slugs or URLs.
2. Never edit a client testimonial quote. Quotes are the client's words, typos included.
3. Never add a claim, number, client name or certification that is not in this brief. If something looks wrong, stop and ask Anirban.
4. Inside PHP single-quoted strings keep the typographic apostrophe `’` exactly as written here. A straight `'` would end the string and break the page. In raw HTML keep `&rsquo;`.
5. No em dash or en dash in any visible text. Code comments do not matter.
6. Do not deploy if any test in section 3, step 3 fails.

## 2. Decisions already made

Anirban answered these on 6 Oct 2026 and the edit list already reflects them. Apply every edit in section 4. Do not skip any and do not reopen these.

| ID | Claim | Decision |
|---|---|---|
| F1 | Years in business (site said 9 years and 5+ years) | Since 2020 everywhere. |
| F2 | Free call length (site said 45 and 30 minutes) | 30 minutes, matching the Cal.com event amatec/meeting. |
| F3 | '250+ workflows shipped' and '120+ satisfied clients' | True. Keep both. Only the '9 yrs' card changes to 2020. |
| F4 | Homepage '40+ hrs saved per workflow' and '2 wks typical' | No data behind them. Replace with checkable facts (H06 to H08). |
| F5 | Certifications: Make Advanced, Zoho Certified Partner, monday Work Management Core, and 'certified on all four' | All real. Keep every certification claim. |
| F6 | Blink Energy Services listed as a client | Keep it. |
| F7 | Make.com public app (Aurora Solar) | Real. Copy says 'an app on Make'. |
| F8 | Anonymous 'Operations lead' quote on /hr-operations-automation/ | Delete it (L24). |
| F9 | T-Chat channels | SMS and MMS only. Never mention WhatsApp. |
| F10 | MCP server work | Real client work. Keep. |
| F11 | AI page 'Built on' list | OpenAI GPT, Whisper, Claude, n8n AI agents (AI05). |
| F12 | 'Case Studies' menu item pointing to #case-studies | Keep the menu item. Do not remove or change it. |

## 3. Steps

### Step 1. Prepare a working copy

```bash
cd <repo root>
rm -rf /tmp/amatec-build && mkdir -p /tmp/amatec-build
cp -r website/theme/amatec /tmp/amatec-build/amatec
```

Before editing, check the live site still matches the snapshot. If the homepage H1 below is missing, the live theme has changed since 6 Oct 2026. Stop and ask Anirban for a fresh theme zip.

```bash
curl -s https://amatec.in/ | grep -c 'Stop doing what'   # must print 1 or more
```

### Step 2. Apply the edits

```bash
python3 website/tools/apply_edits.py /tmp/amatec-build/amatec --dry-run
python3 website/tools/apply_edits.py /tmp/amatec-build/amatec
```

The script refuses to write anything if a single find string fails to match, so a partial apply cannot happen.

If you cannot run Python, apply section 4 by hand in order, and copy the section 5 files into the theme. Each find string must match exactly once (edit L27 matches 14 times and replaces all of them).

### Step 3. Test

```bash
cd /tmp/amatec-build/amatec
# 1. Every PHP file must lint clean
find . -name '*.php' -exec php -l {} \; | grep -v 'No syntax errors' ; echo lint-done
# 2. Landing data still loads, no em dash left in any H1
php <repo>/website/tools/dump_lp.php inc/lp-pages.php | grep '^HERO' | grep -c '—'   # must print 0
# 3. FAQ, summary and schema render, and the FAQPage JSON is valid
php <repo>/website/tools/test_render.php .   # every line must end in a number or 'yes'
# 4. No dash pauses left in visible template strings
grep -rn "esc_html_e( '[^']*—" --include=*.php . ; echo dash-check-done
```

Expected from test 3: eight FAQ sets with counts 7, 5, 5, 4, 5, 5, 4, 4, then `FAQPage valid: yes`, a summary character count, and `Org valid: yes`.

### Step 4. Update Yoast titles and descriptions

Page titles and meta descriptions live in the WordPress database (Yoast), not in the theme. `inc/lp-pages.php` 'meta' and `amatec_site_pages()` only apply when a page is first created, so editing them changes nothing on the live site. Set these in WP Admin, Pages, edit page, Yoast SEO box, or through the REST API (the mu-plugin `yoast-rest-meta.php` exposes `_yoast_wpseo_title` and `_yoast_wpseo_metadesc` as writable meta).

| URL | SEO title | Meta description |
|---|---|---|
| `/` | Workflow Automation Agency for Make, n8n and Zoho \| Amatec | Amatec builds and runs automated workflows on Make.com, n8n, Zoho and monday.com for growing teams in the US and Europe. Book a free 30-minute audit. |
| `/about/` | About Amatec, the Automation Studio in Vadodara | Founder-led automation studio building on Make.com, n8n, Zoho and monday.com since 2020. Meet Anirban Sinha and see how we work. |
| `/make-com-automation/` | Make.com Automation Experts \| Amatec | We design, build and fix Make.com scenarios with error handling and documentation, and move Zaps over from Zapier. Book a free 30-minute call. |
| `/n8n-workflow-automation/` | n8n Automation Services, Self-Hosted or Cloud \| Amatec | Amatec sets up self-hosted n8n and builds secure workflows for APIs, databases and AI. Your data stays on your servers. Book a free call. |
| `/monday-com-workflow-automation/` | monday.com Automation and Board Setup \| Amatec | We fix monday.com board structure, build automation recipes and connect monday.com to Slack, HubSpot and your other tools. Book a free call. |
| `/zoho-workflow-automation/` | Zoho Automation, Deluge and Extensions \| Amatec | Deluge scripts, Zoho Flow and custom extensions across Zoho CRM, Books, Inventory and Creator, from a team with two Zoho Marketplace apps. |
| `/ai-powered-task-automation/` | AI Workflow Automation and MCP Servers \| Amatec | Add AI steps that sort email, read invoices and score leads, or connect ChatGPT and Claude to your Zoho data with an MCP server. |
| `/crm-automation/` | CRM Automation for Zoho CRM and More \| Amatec | Lead capture, routing, follow-ups and pipeline reports that run on their own, built by Zoho specialists. Book a free 30-minute CRM audit. |
| `/t-chat-zoho-extension/` | T-Chat: Twilio SMS and MMS in Zoho CRM \| Amatec | Send and receive Twilio SMS and MMS from Zoho CRM records, with the full chat history on every lead and contact. Install from the Zoho Marketplace. |
| `/stock-procurement-for-zoho-inventory/` | Stock Procurement for Zoho Inventory \| Amatec | Turn a production target into an exact raw-material purchase list for composite items, right inside Zoho Inventory. Built and supported by Amatec. |
| `/contact/` | Contact Amatec, Workflow Automation Agency | Email hello@amatec.in, call +91 72659 69478 or book a 30-minute call. An automation engineer replies within one business day. |

In the titles, `\|` is only Markdown escaping. Type a plain `|` in Yoast.

The current T-Chat description claims WhatsApp messaging, and the Stock Procurement one describes reorder and purchase-order automation the product does not do. Those two rows matter most. For the 14 landing pages under Services, Industries and Solutions, open each Yoast box and remove any em dash from the title. Leave the wording otherwise.

### Step 5. Deploy

1. Back up the live theme first: WP Admin cannot export a theme, so download `wp-content/themes/amatec/` from the hosting file manager, or keep `website/theme/amatec/` from this repo as the rollback copy.
2. Zip the built theme so the archive contains the `amatec/` folder at its root:

```bash
cd /tmp/amatec-build && zip -qr amatec-1.8.0.zip amatec
```

3. WP Admin, Appearance, Themes, Add New, Upload Theme, choose the zip, then click 'Replace active with uploaded'.
4. LiteSpeed Cache, Toolbox, Purge All.

### Step 6. Check the live site

```bash
curl -s -o /dev/null -w '%{http_code} %{content_type}\n' https://amatec.in/llms.txt   # 200 text/plain
curl -s https://amatec.in/ | grep -c 'What Amatec does'                              # 1
curl -s https://amatec.in/ | grep -c '"@type":"FAQPage"'                            # 1
curl -s https://amatec.in/ | grep -c '"Organization"'                                # 1 or more
for p in make-com-automation n8n-workflow-automation monday-com-workflow-automation zoho-workflow-automation ai-powered-task-automation t-chat-zoho-extension stock-procurement-for-zoho-inventory workflow-automation; do
  printf '%s ' $p; curl -s https://amatec.in/$p/ | grep -c '"@type":"FAQPage"'; done          # each 1
```

Then open the homepage and the Make page in a browser: click two FAQ questions and confirm they open and close, and confirm no layout shifted. Paste https://amatec.in/ into https://validator.schema.org and confirm FAQPage and Organization show with no errors.

If anything looks broken, reinstall the backup zip and purge the cache.

### Step 7. Report back

Tell Anirban which edits were applied, the result of every check in step 6, and anything you stopped on.

## 4. Edit catalogue

Paths are relative to the theme folder. Indentation in multi-line finds is tabs. Tags in brackets refer to the decisions in section 2.

### `template-parts/home/hero.php`

**H01** [F5]. Zoho partner status confirmed by Anirban. Leave as is.

Check only, no change by default. Confirm this text exists:

```
ZOHO PARTNER · n8n · MAKE · MONDAY
```

**H02**. First sentence now names the company, the category and the four platforms. AI engines lift this line as the entity description.

Find:

```
We connect your tools into workflows that run themselves, so your team stops copy-pasting
				between systems and starts shipping real work.
```

Replace with:

```
Amatec builds automated workflows on Make.com, n8n, Zoho and monday.com. Your CRM, inbox,
				invoices and spreadsheets start passing data to each other, and nobody copies it by hand again.
```

**H03**. Removes a 'not X' contrast and a timing promise we cannot prove on every job.

Find:

```
Live in weeks, not months</span>
```

Replace with:

```
Fixed-scope quote before we build</span>
```

### `template-parts/home/how-it-works.php`

**H04**. The Cal.com event (amatec/meeting) is 30 minutes. The site said 45 in some places and 30 in others.

Find:

```
'meta' => 'Free workflow audit · ~45 min' ),
```

Replace with:

```
'meta' => 'Free workflow audit · 30 min' ),
```

**H05**. Same reason as H03.

Find:

```
'meta' => 'Live in weeks, not months' ),
```

Replace with:

```
'meta' => 'Go-live date agreed in the quote' ),
```

### `template-parts/home/results.php`

**H06** [F4]. Default swaps unsourced averages for facts anyone can check. If F4 = YES (Anirban has the data behind 40+ hrs and 2 wks), skip this edit.

Find:

```
array( 'fig' => '40+',  'unit' => 'hrs / month',   'label' => 'saved per workflow, on average' ),
	array( 'fig' => '3→1',  'unit' => 'systems',       'label' => 'disconnected tools, one workflow' ),
	array( 'fig' => '2 wks','unit' => 'typical',       'label' => 'from audit to live automation' ),
```

Replace with:

```
array( 'fig' => '2020', 'unit' => 'since',         'label' => 'building client automations' ),
	array( 'fig' => '4',    'unit' => 'platforms',     'label' => 'Make.com, n8n, Zoho and monday.com' ),
	array( 'fig' => '3',    'unit' => 'published apps','label' => 'two on the Zoho Marketplace, one on Make' ),
```

**H07** [F4]. Matches the new stat set from H06. Skip if H06 is skipped.

Find:

```
<h2 class="h2">Fewer manual steps. Measurable hours back.</h2>
```

Replace with:

```
<h2 class="h2">The track record, in four numbers</h2>
```

**H08** [F4]. Same as H07. Skip if H06 is skipped.

Find:

```
<p class="lead">What an AMATEC automation typically returns to a team.</p>
```

Replace with:

```
<p class="lead">Every number here can be checked on a marketplace listing or a client reference.</p>
```

### `template-parts/home/contact.php`

**H09**. Call length fix (F2) and a concrete promise about who is on the call.

Find:

```
'45-minute call with an automation expert',
```

Replace with:

```
'30-minute call with the engineer who would build it',
```

### `front-page.php`

**H10**. Inserts the new plain-English 'What Amatec does' block (new file N01). This is the paragraph AI answers quote when someone asks who Amatec is.

Find:

```
get_template_part( 'template-parts/home/platforms' );
```

Replace with:

```
get_template_part( 'template-parts/home/platforms' );
get_template_part( 'template-parts/home/summary' );
```

**H11**. Adds a homepage FAQ (data in N04, function amatec_home_faqs). FAQs are the most-cited block type in AI answers.

Find:

```
get_template_part( 'template-parts/home/contact' );
```

Replace with:

```
get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_home_faqs() ) ) );
get_template_part( 'template-parts/home/contact' );
```

### `template-parts/about/hero.php`

**A01**. The old H1 is the 'it isn't X, it's Y' pattern, the second most common AI tell.

Find:

```
Automation isn&rsquo;t a department here.<br>
			It&rsquo;s the <span class="accent">whole company</span>.
```

Replace with:

```
Automation is the <span class="accent">only thing</span> we do.
```

**A02** [F1]. Removes the rule-of-three line and the unproven 'nine years'. Uses the year the client testimonial confirms.

Find:

```
We&rsquo;re a Vadodara-based automation studio building no-code and low-code workflows for teams
			around the world. One focus, four platforms, nine years of doing nothing but this.
```

Replace with:

```
We&rsquo;re an automation studio in Vadodara, India. Since 2020 we have built workflows on Make.com,
			n8n, Zoho and monday.com for teams in the US, Europe and Asia.
```

### `template-parts/about/stats.php`

**A03** [F1]. Years claim made consistent across the site (F1).

Find:

```
array( 'fig' => '9', 'unit' => 'years',      'label' => 'doing nothing but automation' ),
```

Replace with:

```
array( 'fig' => '2020', 'unit' => 'since',   'label' => 'building client automations' ),
```

**A05** [F7]. The two Zoho Marketplace extensions were missing from the About page entirely.

Find:

```
array( 'fig' => '1', 'unit' => 'public app', 'label' => 'Make.com app published (Aurora Solar)' ),
```

Replace with:

```
array( 'fig' => '3', 'unit' => 'published apps', 'label' => 'Two on the Zoho Marketplace, one on Make' ),
```

### `template-parts/about/founder.php`

**A06** [F1]. Removes the unproven 'nine years and hundreds of workflows'.

Find:

```
if software can do the work, a human shouldn't. Nine years and hundreds of workflows later, that
						conviction is the whole company.
```

Replace with:

```
if software can do the work, a human shouldn't. He has built client workflows since 2020, and that
						conviction still decides which jobs we take.
```

**A07**. Adds the two Zoho Marketplace extensions, which the About page never mentioned. Certification kept (confirmed by Anirban, 6 Oct 2026).

Find:

```
He builds in <strong>Make.com, n8n, Zoho and Monday.com</strong>, certified
						across all four, with a public app on the Make marketplace.
```

Replace with:

```
He builds in <strong>Make.com, n8n, Zoho and Monday.com</strong>, is certified
						on all four, and has published two extensions on the Zoho Marketplace and an app on Make.
```

**A08** [F10]. Adds the MCP work, which is current and specific, and is what people now ask AI assistants about.

Find:

```
its place: GPT-4o pipelines, Whisper transcription, Postgres-and-Slack coaching bots.
```

Replace with:

```
its place: GPT-4o pipelines, Whisper transcription, Postgres-and-Slack coaching bots, and MCP
						servers that let ChatGPT and Claude read a company&rsquo;s Zoho data.
```

**A09** [F10]. Same as A08.

Find:

```
array( 'icon' => 'bot',         'text' => 'AI pipelines: GPT-4o · Whisper · Postgres' ),
```

Replace with:

```
array( 'icon' => 'bot',         'text' => 'AI builds: GPT-4o · Whisper · MCP servers' ),
```

### `template-parts/about/values.php`

**A11**. Removes the 'not X, not Y' pattern.

Find:

```
'body' => 'We sell time back and fewer errors, not seats, not buzzwords. If a workflow doesn’t remove real work, it doesn’t ship.' ),
```

Replace with:

```
'body' => 'We judge a project by the hours it gives back and the errors it removes. If a workflow doesn’t remove real work, it doesn’t ship.' ),
```

### `template-parts/about/certs.php`

**A12**. Adds the Zoho Marketplace proof. Certification kept (confirmed by Anirban).

Find:

```
<p class="lead">Certified across all four platforms we build on, with a public app on the Make marketplace to prove it.</p>
```

Replace with:

```
<p class="lead">Certified on all four platforms we build on, with two Zoho Marketplace extensions and a Make app you can install today.</p>
```

**A14**. Plainer and matches the shorter list.

Find:

```
<span class="kicker">Trusted by teams worldwide</span>
```

Replace with:

```
<span class="kicker">Some of the teams we work with</span>
```

### `template-parts/about/cta.php`

**A15**. Call length fix (F2). Drops the 'not X' contrast.

Find:

```
'45-minute call with the builder, not a sales rep',
```

Replace with:

```
'30-minute call with the person who will build it',
```

**A16**. Call length fix (F2).

Find:

```
Forty-five minutes with the person who&rsquo;ll actually build it.
```

Replace with:

```
Thirty minutes with the person who&rsquo;ll actually build it.
```

### `template-parts/platforms/monday-why.php`

**P01** [F1]. Years made consistent with the rest of the site. The 250+ workflows and 120+ clients cards stay (confirmed by Anirban).

Find:

```
array( 'n' => '9 yrs', 'l' => 'Doing only automation' ),
```

Replace with:

```
array( 'n' => '2020', 'l' => 'Building client automations since' ),
```

### `template-parts/platforms/n8n-control.php`

**P02** [F1]. Years made consistent with the rest of the site. The 250+ workflows and 120+ clients cards stay (confirmed by Anirban).

Find:

```
array( 'n' => '9 yrs', 'l' => 'Doing only automation' ),
```

Replace with:

```
array( 'n' => '2020', 'l' => 'Building client automations since' ),
```

### `template-parts/platforms/zoho-why.php`

**P03** [F1]. Years made consistent with the rest of the site. The 250+ workflows and 120+ clients cards stay (confirmed by Anirban).

Find:

```
array( 'n' => '9 yrs', 'l' => 'Doing only automation' ),
```

Replace with:

```
array( 'n' => '2020', 'l' => 'Building client automations since' ),
```

### `template-parts/platforms/make-services.php`

**M01**. Make's app count changes often. A stale number is worse than none when an AI engine quotes it.

Find:

```
'd' => 'Connect 1,500+ apps (CRMs, sheets, email, payments, AI) into one reliable end-to-end flow.' ),
```

Replace with:

```
'd' => 'Connect your CRM, sheets, email, payments and AI tools into one flow that runs on its own.' ),
```

**M02**. Removes 'Not just'.

Find:

```
Not just wired-together modules. These are scenarios designed to survive real volume, edge cases, and the next person who opens them.
```

Replace with:

```
Scenarios built to survive real volume, odd edge cases, and the next person who has to open them.
```

### `template-parts/platforms/make-why.php`

**M03**. Swaps a false range for two real, named examples.

Find:

```
'd' => 'We build for teams across the US, EU, and Asia, in industries from eCommerce to healthcare.' ),
```

Replace with:

```
'd' => 'Clients in the US, Europe and Asia, including a Miami medical practice and a food producer we have worked with since 2020.' ),
```

### `page-make-com-automation.php`

**M04**. Adds a Make.com FAQ above the booking block (data in N04).

Find:

```
get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
```

Replace with:

```
get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'make' ) ) ) );
get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
```

### `template-parts/platforms/n8n-hero.php`

**N8_01**. Definition first. Also fixes a factual error: n8n is fair-code (Sustainable Use License), not open source. AI engines repeat whatever we say here.

Find:

```
Enterprise-grade, open-source workflow automation for data-sensitive and IT-heavy teams. Orchestrate complex data flows across cloud and on-premise systems, with total control over where your data lives.
```

Replace with:

```
n8n is a fair-code automation platform you can run on your own server. We set it up, build the workflows and keep them running, so sensitive data never passes through a third-party automation service.
```

**N8_02**. Same licence fix.

Find:

```
$badges = array( 'Self-hosted', 'Open-source', 'Secure by design' );
```

Replace with:

```
$badges = array( 'Self-hosted', 'Fair-code', 'Your data stays on your servers' );
```

### `template-parts/platforms/n8n-control.php`

**N8_03**. Concrete reason instead of a vague claim.

Find:

```
'd' => 'A preferred fit for data-sensitive industries with strict security and governance requirements.' ),
```

Replace with:

```
'd' => 'When data must stay in your own cloud or office network, self-hosting is the simplest way to keep it there.' ),
```

**N8_04**. Licence fix plus a plainer sentence.

Find:

```
'd' => 'Open-source and modular: extend with custom nodes and grow without per-task SaaS pricing.' ),
```

Replace with:

```
'd' => 'Self-hosted n8n has no per-task pricing, and custom nodes let you extend it when the built-in ones run out.' ),
```

### `page-n8n-workflow-automation.php`

**N8_05**. Removes a rule-of-three line.

Find:

```
'sub'     => __( 'Thirty minutes with an automation engineer. We’ll map your data flows and show you exactly what to automate to reduce manual work, cut costs, and scale operations, securely.', 'amatec' ),
```

Replace with:

```
'sub'     => __( 'Thirty minutes with the engineer who would build it. We’ll map your data flows and show you which ones are worth automating first.', 'amatec' ),
```

**N8_06**. Adds an n8n FAQ.

Find:

```
get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
```

Replace with:

```
get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'n8n' ) ) ) );
get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
```

### `template-parts/platforms/monday-hero.php`

**MO01**. Drops the 'Work OS' jargon and the stacked benefit list.

Find:

```
We automate the busywork inside your Work OS: recipes, integrations, and dashboards that keep teams aligned, cut manual data entry, and give managers a real-time view of every project.
```

Replace with:

```
We set up monday.com boards, automation recipes and integrations so status updates, handoffs and reports happen on their own. Managers see where every project stands without asking.
```

### `template-parts/platforms/monday-services.php`

**MO02**. Removes a rule-of-three line.

Find:

```
We turn monday.com boards into intelligent workflow engines, eliminating redundant tasks, improving visibility, and keeping every team aligned.
```

Replace with:

```
Boards that update themselves and stay in sync with the tools your team already uses.
```

### `page-monday-com-workflow-automation.php`

**MO03**. Adds a monday.com FAQ.

Find:

```
get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
```

Replace with:

```
get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'monday' ) ) ) );
get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
```

### `template-parts/platforms/zoho-hero.php`

**Z01** [F5]. Zoho partner status confirmed by Anirban. Leave as is.

Check only, no change by default. Confirm this text exists:

```
<span class="accent"><?php esc_html_e( 'certified partners', 'amatec' ); ?></span>
```

### `template-parts/platforms/zoho-why.php`

**Z02**. Specific promise instead of three adjectives.

Find:

```
array( 'icon' => 'shield-check', 't' => 'Secure, reliable, ROI-first', 'd' => 'Every workflow is documented, tested, and optimized to cut cost and improve efficiency.' ),
```

Replace with:

```
array( 'icon' => 'shield-check', 't' => 'Tested on real records', 'd' => 'Every workflow is documented and tested on real records before it touches live data.' ),
```

### `page-zoho-workflow-automation.php`

**Z03**. Adds a Zoho FAQ.

Find:

```
get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
```

Replace with:

```
get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'zoho' ) ) ) );
get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
```

### `template-parts/ai/hero.php`

**AI01**. Names the real tools we use instead of textbook categories.

Find:

```
$badges = array( 'Machine learning', 'Natural language', 'Data analytics' );
```

Replace with:

```
$badges = array( 'OpenAI GPT', 'Whisper speech-to-text', 'MCP servers' );
```

**AI02**. The old line was the most machine-sounding sentence on the site.

Find:

```
We blend machine learning, natural language processing, and data analytics into automation that goes far beyond simple scripting, so your B2B team boosts productivity, cuts manual effort, and decides with intelligence.
```

Replace with:

```
We add AI steps to the workflows you already run. A model reads the email, pulls the fields off the invoice or scores the lead, and the workflow carries on without a person in the middle. You can see every decision it made.
```

### `template-parts/ai/services.php`

**AI03**. Plain language.

Find:

```
We automate the repetitive, judgment-heavy tasks that slow teams down, using machine learning, NLP, and analytics tuned to your data.
```

Replace with:

```
Reading, sorting and scoring used to need a person. A model can now do the first pass, and your team checks the cases that matter.
```

**AI04** [F10]. Swaps a generic card for real, current work that buyers are searching for.

Find:

```
array( 'icon' => 'users-round', 't' => 'Customer segmentation', 'd' => 'Group customers intelligently for sharper targeting, personalization, and engagement.' ),
```

Replace with:

```
array( 'icon' => 'plug-zap', 't' => 'MCP servers for your data', 'd' => 'Let ChatGPT or Claude answer questions from your Zoho Books, Inventory or CRM data through an MCP server we build, read-only by default.' ),
```

**AI05** [F11]. Lists only what we actually build with. If Anirban has shipped Google Cloud AI or Azure work, keep those.

Find:

```
array( 'icon' => 'cloud', 'name' => 'Google Cloud AI' ),
	array( 'icon' => 'brain-circuit', 'name' => 'Azure Cognitive Services' ),
	array( 'icon' => 'settings-2', 'name' => 'Custom-trained models' ),
```

Replace with:

```
array( 'icon' => 'audio-lines', 'name' => 'OpenAI Whisper' ),
	array( 'icon' => 'brain-circuit', 'name' => 'Anthropic Claude' ),
	array( 'icon' => 'workflow', 'name' => 'n8n AI agents' ),
```

### `template-parts/ai/approach.php`

**AI06**. Specific stance instead of a false range.

Find:

```
'd' => 'We design and ship solutions tailored to your needs, from off-the-shelf models to custom-trained ones.' ),
```

Replace with:

```
'd' => 'We pick the model and build the workflow around it, starting with the cheapest model that does the job well.' ),
```

**AI07**. Removes 'seamlessly' (banned word).

Find:

```
'd' => 'CRM, ERP, support, or comms tools: our AI fits in seamlessly, no rip-and-replace.' ),
```

Replace with:

```
'd' => 'It plugs into your CRM, helpdesk or inbox through the tools you already use.' ),
```

**AI08**. Concrete practice instead of governance buzzwords.

Find:

```
'd' => 'We practice responsible AI development by using clear governance frameworks for transparency, data protection, and compliance. Every solution is rigorously tested, monitored, and fine-tuned for accuracy.' ),
```

Replace with:

```
'd' => 'Every AI step logs what it read and what it decided. We test it on your real data before go-live and keep a person in the loop wherever a wrong answer would cost money.' ),
```

**AI09**. Plainer.

Find:

```
<?php esc_html_e( 'We integrate smoothly with your existing tech stack, and deploy responsibly.', 'amatec' ); ?>
```

Replace with:

```
<?php esc_html_e( 'Three steps, and a person stays in control at each one.', 'amatec' ); ?>
```

### `page-ai-powered-task-automation.php`

**AI10**. Removes rule of three.

Find:

```
'sub'     => __( 'Thirty minutes with an automation engineer. We’ll pinpoint where AI can reduce manual work, cut costs, and scale your operations, intelligently.', 'amatec' ),
```

Replace with:

```
'sub'     => __( 'Thirty minutes with the engineer who would build it. We’ll find the two or three tasks where AI would save your team the most time.', 'amatec' ),
```

**AI11**. Adds an AI FAQ, including 'What is an MCP server?'.

Find:

```
get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
```

Replace with:

```
get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'ai' ) ) ) );
get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
```

### `template-parts/products/tchat-overview.php`

**TC01** [F9]. 'WhatsApp-style' has already led the live meta description to claim WhatsApp support, which the product does not describe. The last sentence ties the two product names together for search and AI.

Find:

```
T-Chat brings a WhatsApp-style chat interface and direct Twilio integration into Zoho CRM. Send, receive, and track SMS/MMS without leaving the platform. Sales and support teams communicate faster and smarter.
```

Replace with:

```
T-Chat adds a chat window and a direct Twilio connection to Zoho CRM. Your team sends, receives and tracks SMS and MMS without leaving the record they are working on. On the Zoho Marketplace it is listed as Twilio Chat for Zoho CRM.
```

### `template-parts/products/tchat-features.php`

**TC02** [F9]. Same WhatsApp confusion fix.

Find:

```
array( 'icon' => 'message-circle', 't' => 'WhatsApp-style chat UI', 'd' => 'A familiar, intuitive chat experience that makes every customer conversation feel effortless.' ),
```

Replace with:

```
array( 'icon' => 'message-circle', 't' => 'Familiar chat window', 'd' => 'Messages appear as a chat thread on the record, so nobody needs training to use it.' ),
```

### `template-parts/products/tchat-cta.php`

**TC03**. The product had three names on one page. One name helps people and AI engines match it.

Find:

```
<?php esc_html_e( 'Install Twilio Chat Messenger today', 'amatec' ); ?>
```

Replace with:

```
<?php esc_html_e( 'Install T-Chat for Zoho CRM', 'amatec' ); ?>
```

**TC04**. Removes a slogan triplet.

Find:

```
Boost productivity and customer satisfaction with direct messaging inside Zoho CRM. Get started in minutes: no coding, no clutter, just clear communication.
```

Replace with:

```
Text your leads from inside Zoho CRM using your own Twilio number. Setup takes a few minutes and needs no code.
```

### `page-t-chat-zoho-extension.php`

**TC05**. Adds a T-Chat FAQ.

Find:

```
get_template_part( 'template-parts/products/tchat-cta' );
```

Replace with:

```
get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'tchat' ) ) ) );
get_template_part( 'template-parts/products/tchat-cta' );
```

### `template-parts/products/stock-hero.php`

**SP01**. A developer placeholder is showing to visitors on the live page.

Find:

```
<?php esc_html_e( 'product demo · drop AMATEC.mp4 here', 'amatec' ); ?>
```

Replace with:

```
<?php esc_html_e( 'Demo video coming soon', 'amatec' ); ?>
```

**SP02**. The button promised a demo that does not exist yet. It now scrolls to the features section.

Find:

```
<a href="#sp-demo" class="btn btn-outline-light"><i data-lucide="play"></i> <?php esc_html_e( 'Watch the demo', 'amatec' ); ?></a>
```

Replace with:

```
<a href="#sp-features" class="btn btn-outline-light"><i data-lucide="arrow-down"></i> <?php esc_html_e( 'See what it does', 'amatec' ); ?></a>
```

### `template-parts/products/stock-features.php`

**SP03**. Removes 'Seamless' (banned word).

Find:

```
array( 'icon' => 'plug', 't' => 'Seamless Zoho integration', 'd' => 'Lives natively inside Zoho Inventory using your existing items and bills of materials. Nothing to migrate.' ),
```

Replace with:

```
array( 'icon' => 'plug', 't' => 'Runs inside Zoho Inventory', 'd' => 'Uses the items and bills of materials you already have. Nothing to migrate.' ),
```

### `page-stock-procurement-for-zoho-inventory.php`

**SP04**. Adds a Stock Procurement FAQ.

Find:

```
get_template_part( 'template-parts/products/stock-cta' );
```

Replace with:

```
get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'stock' ) ) ) );
get_template_part( 'template-parts/products/stock-cta' );
```

### `inc/lp-pages.php`

**L01**. Page /workflow-automation/ H1. Removes the em dash. Renders as: Hand the busywork to [workflows] that run themselves

Find:

```
				'lead' => 'Unload your workload —',
				'accent' => 'your operations',
				'tail' => 'run themselves',
```

Replace with:

```
				'lead' => 'Hand the busywork to',
				'accent' => 'workflows',
				'tail' => 'that run themselves',
```

**L02**. Page /crm-automation/ H1. Removes the em dash. Renders as: A CRM that [updates itself] so your reps can sell

Find:

```
				'lead' => 'A CRM that works for your team —',
				'accent' => 'not one',
				'tail' => 'your team has to feed',
```

Replace with:

```
				'lead' => 'A CRM that',
				'accent' => 'updates itself',
				'tail' => 'so your reps can sell',
```

**L03**. Page /it-company/ H1. Removes the em dash. Renders as: Grow client delivery [without growing] the admin

Find:

```
				'lead' => 'Scale delivery —',
				'accent' => 'without scaling',
				'tail' => 'admin',
```

Replace with:

```
				'lead' => 'Grow client delivery',
				'accent' => 'without growing',
				'tail' => 'the admin',
```

**L04**. Page /ecommerce/ H1. Removes the em dash. Renders as: Orders, stock and shipping [in sync] at any volume

Find:

```
				'lead' => 'Run operations —',
				'accent' => 'at any',
				'tail' => 'volume',
```

Replace with:

```
				'lead' => 'Orders, stock and shipping',
				'accent' => 'in sync',
				'tail' => 'at any volume',
```

**L05**. Page /startups/ H1. Removes the em dash. Renders as: Do the work of a bigger team [without hiring] one

Find:

```
				'lead' => 'Scale lean —',
				'accent' => 'grow',
				'tail' => 'fast',
```

Replace with:

```
				'lead' => 'Do the work of a bigger team',
				'accent' => 'without hiring',
				'tail' => 'one',
```

**L06**. Page /healthcare/ H1. Removes the em dash. Renders as: Less admin, [more time] with patients

Find:

```
				'lead' => 'Spend more time —',
				'accent' => 'on',
				'tail' => 'patients',
```

Replace with:

```
				'lead' => 'Less admin,',
				'accent' => 'more time',
				'tail' => 'with patients',
```

**L07**. Page /real-estate/ H1. Removes the em dash. Renders as: Reply to every lead [within seconds]

Find:

```
				'lead' => 'Be first —',
				'accent' => 'to every',
				'tail' => 'lead',
```

Replace with:

```
				'lead' => 'Reply to every lead',
				'accent' => 'within seconds',
				'tail' => '',
```

**L08**. Page /small-business/ H1. Removes the em dash. Renders as: Get [hours back] every week

Find:

```
				'lead' => 'Get hours back —',
				'accent' => 'every',
				'tail' => 'week',
```

Replace with:

```
				'lead' => 'Get',
				'accent' => 'hours back',
				'tail' => 'every week',
```

**L09**. Page /enterprise/ H1. Removes the em dash. Renders as: Make your CRM, ERP and finance systems [work as one]

Find:

```
				'lead' => 'Connect your systems —',
				'accent' => 'scale your',
				'tail' => 'processes',
```

Replace with:

```
				'lead' => 'Make your CRM, ERP and finance systems',
				'accent' => 'work as one',
				'tail' => '',
```

**L10**. Page /lead-sales-automation/ H1. Removes the em dash. Renders as: Answer every lead [while it is still warm]

Find:

```
				'lead' => 'Stop —',
				'accent' => 'losing',
				'tail' => 'leads',
```

Replace with:

```
				'lead' => 'Answer every lead',
				'accent' => 'while it is still warm',
				'tail' => '',
```

**L11**. Page /marketing-automation/ H1. Removes the em dash. Renders as: Campaigns and follow-ups that [send themselves]

Find:

```
				'lead' => 'Put your marketing —',
				'accent' => 'on',
				'tail' => 'autopilot',
```

Replace with:

```
				'lead' => 'Campaigns and follow-ups that',
				'accent' => 'send themselves',
				'tail' => '',
```

**L12**. Page /finance-accounting-automation/ H1. Removes the em dash. Renders as: Invoices, payments and reconciliation [without re-keying]

Find:

```
				'lead' => 'Close your books —',
				'accent' => 'faster',
				'tail' => '',
```

Replace with:

```
				'lead' => 'Invoices, payments and reconciliation',
				'accent' => 'without re-keying',
				'tail' => '',
```

**L13**. Page /hr-operations-automation/ H1. Removes the em dash. Renders as: Onboarding, approvals and paperwork [on autopilot]

Find:

```
				'lead' => 'Run operations —',
				'accent' => 'on',
				'tail' => 'autopilot',
```

Replace with:

```
				'lead' => 'Onboarding, approvals and paperwork',
				'accent' => 'on autopilot',
				'tail' => '',
```

**L14**. Page /customer-support-automation/ H1. Removes the em dash. Renders as: Route every ticket [to the right person] the moment it arrives

Find:

```
				'lead' => 'Resolve faster —',
				'accent' => 'scale',
				'tail' => 'smarter',
```

Replace with:

```
				'lead' => 'Route every ticket',
				'accent' => 'to the right person',
				'tail' => 'the moment it arrives',
```

**L15**. /workflow-automation/. Removes 'not just'.

Find:

```
'sub' => 'We are consulting-led, not just builders. We automate the highest-ROI processes first, on the right platform for your stack.',
```

Replace with:

```
'sub' => 'We start with the processes that pay back fastest, then build them on the platform that suits your stack.',
```

**L16**. /workflow-automation/. Removes 'not just'.

Find:

```
'title' => 'Automation partners, not just builders',
```

Replace with:

```
'title' => 'We stay after go-live',
```

**L17**. /it-company/. Removes 'not just'.

Find:

```
'title' => 'Technical fluency, not just no-code',
```

Replace with:

```
'title' => 'We write code when no-code runs out',
```

**L18**. /enterprise/. Removes 'not just'.

Find:

```
'title' => 'Integration expertise, not just no-code',
```

Replace with:

```
'title' => 'Built for systems without clean APIs',
```

**L19** [F1]. The site said 5+ years here and 9 years elsewhere. One consistent, checkable year.

Find:

```
't' => '5+ years in the field',
```

Replace with:

```
't' => 'Building automations since 2020',
```

**L20** [F1]. The site said 5+ years here and 9 years elsewhere. One consistent, checkable year.

Find:

```
't' => '5+ years building',
```

Replace with:

```
't' => 'Building automations since 2020',
```

**L21** [F1]. The site said 5+ years here and 9 years elsewhere. One consistent, checkable year.

Find:

```
't' => '5+ years with small teams',
```

Replace with:

```
't' => 'Building automations since 2020',
```

**L22** [F1]. The site said 5+ years here and 9 years elsewhere. One consistent, checkable year.

Find:

```
't' => '5+ years with small business',
```

Replace with:

```
't' => 'Building automations since 2020',
```

**L23** [F1]. The site said 5+ years here and 9 years elsewhere. One consistent, checkable year.

Find:

```
't' => '5+ years in sales ops',
```

Replace with:

```
't' => 'Building automations since 2020',
```

**L24**. /hr-operations-automation/. Deletes an anonymous quote with no name or company. It reads as invented and hurts trust. The template already handles a page with no quote.

Find:

```
			'quote' => array(
				'text' => 'AMATEC automated our entire onboarding flow, saving hours and boosting accuracy across departments.',
				'name' => 'Operations lead',
				'role' => 'Multi-department onboarding rollout',
			),

```

Replace with nothing (delete the found text).

**L25**. /customer-support-automation/. Removes 'enhance, not replace'.

Find:

```
't' => 'Protects the experience',
						'd' => 'Designed to enhance, not replace.',
```

Replace with:

```
't' => 'Humans keep the hard cases',
						'd' => 'Automation takes the routine tickets so agents handle the ones that need judgment.',
```

**L26**. /customer-support-automation/ FAQ. Same fix.

Find:

```
We design workflows to enhance, not replace, the experience.
```

Replace with:

```
Agents still handle anything that needs judgment.
```

**L27** (replace all occurrences). Fixes 14 FAQ answers that start a sentence in lower case.

Find:

```
'a' => 'Yes. we 
```

Replace with:

```
'a' => 'Yes. We 
```

**L28**. Same capitalisation fix.

Find:

```
'a' => 'No. that is
```

Replace with:

```
'a' => 'No. That is
```

**L29**. Same capitalisation fix.

Find:

```
'a' => 'No. done well,
```

Replace with:

```
'a' => 'No. Done well,
```

**L30**. Same capitalisation fix.

Find:

```
'a' => 'Instantly. automated
```

Replace with:

```
'a' => 'Instantly. Automated
```

### `single.php`

**B01**. Removes an em dash.

Find:

```
<?php esc_html_e( 'Pick a time that works for you and talk to an automation expert — or fill the form below and we’ll call you back.', 'amatec' ); ?>
```

Replace with:

```
<?php esc_html_e( 'Pick a time to talk to an automation engineer, or fill in the form below and we’ll call you back.', 'amatec' ); ?>
```

**B02**. Replaces a slogan with an em dash and a 'not X, Y' line.

Find:

```
<?php esc_html_e( '“Don’t work harder — automate smarter. Innovation begins where repetition ends.”', 'amatec' ); ?>
```

Replace with:

```
<?php esc_html_e( 'If someone on your team does the same task every day, a workflow can probably do it for them.', 'amatec' ); ?>
```

**B03**. Adds an author byline and a visible 'Updated' date to every post. AI engines favour content with a named author and a recent date.

Find:

```
<span class="post-date"><i data-lucide="calendar"></i> <?php echo esc_html( get_the_date() ); ?></span>
```

Replace with:

```
<span class="post-date"><i data-lucide="calendar"></i> <?php echo esc_html( get_the_date() ); ?></span>
					<?php if ( get_the_modified_date( 'Y-m-d' ) !== get_the_date( 'Y-m-d' ) ) : ?>
					<span class="post-date"><i data-lucide="refresh-cw"></i> <?php echo esc_html( sprintf( __( 'Updated %s', 'amatec' ), get_the_modified_date() ) ); ?></span>
					<?php endif; ?>
					<span class="post-date"><i data-lucide="user-round"></i> <?php echo esc_html( get_the_author() ); ?></span>
```

### `template-parts/blog/list.php`

**B04**. Removes two em dashes.

Find:

```
'Practical playbooks on workflow automation — n8n, Make, Monday and Zoho — to help your team stop doing what software should do for them.'
```

Replace with:

```
'Practical guides to workflow automation on n8n, Make, Monday and Zoho, written by the people who build it.'
```

**B05**. Removes an em dash.

Find:

```
'New automation guides are on the way — check back soon.'
```

Replace with:

```
'New automation guides are on the way. Check back soon.'
```

### `template-parts/blog/consultation.php`

**B06**. Removes an em dash.

Find:

```
We’ll map your process and show you what’s worth automating — no obligation.
```

Replace with:

```
We’ll map your process and show you what’s worth automating. No obligation.
```

### `template-parts/landing/faq.php`

**S01**. Every FAQ block now also prints FAQPage structured data built from the same questions, so the visible text and the schema can never drift apart.

Find:

```
		</div>
	</div>
</section>
```

Replace with:

```
		</div>
	</div>
	<?php
	$amatec_faq_ld = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => array_map(
			function ( $f ) {
				return array(
					'@type'          => 'Question',
					'name'           => $f['q'],
					'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ),
				);
			},
			$data['faqs']
		),
	);
	?>
	<script type="application/ld+json"><?php echo wp_json_encode( $amatec_faq_ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>
</section>
```

### `functions.php`

**S02**. Loads the new inc/aio.php (N03): Organization schema, llms.txt route, and FAQ data.

Find:

```
require_once get_theme_file_path( 'inc/legal-pages.php' );
```

Replace with:

```
require_once get_theme_file_path( 'inc/legal-pages.php' );
require_once get_theme_file_path( 'inc/aio.php' );
```

**S03**. Version bump so browsers and LiteSpeed fetch fresh CSS and JS. The page-creation routine it also triggers only creates pages that are missing, so it is safe.

Find:

```
define( 'AMATEC_VERSION', '1.7.0' );
```

Replace with:

```
define( 'AMATEC_VERSION', '1.8.0' );
```

## 5. New files

Create each file at this path inside the theme folder, with exactly this content.

### `inc/aio.php`

```php
<?php
/**
 * AI search (AIO) helpers: FAQ content for the homepage, platform and product
 * pages, Organization structured data, and the /llms.txt route.
 *
 * FAQ arrays feed template-parts/landing/faq.php, which prints both the visible
 * accordion and matching FAQPage JSON-LD from the same data.
 *
 * @package AMATEC
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Homepage FAQ.
 *
 * @return array
 */
function amatec_home_faqs() {
	return array(
		array(
			'q' => __( 'What does Amatec do?', 'amatec' ),
			'a' => __( 'Amatec is a workflow automation agency based in Vadodara, India. We build automations on Make.com, n8n, Zoho and monday.com that move data between a company’s tools so nobody has to copy it by hand. Most of our clients are small and mid-sized businesses in the US and Europe.', 'amatec' ),
		),
		array(
			'q' => __( 'Should I use Make.com, n8n or Zapier?', 'amatec' ),
			'a' => __( 'Zapier is the quickest to set up for simple, low-volume tasks. Make.com handles branching logic and larger volumes at a lower cost per task. n8n suits teams that want to run automation on their own server or need custom code. We recommend one after looking at your tools, your volume and your data rules on the first call.', 'amatec' ),
		),
		array(
			'q' => __( 'How long does an automation project take?', 'amatec' ),
			'a' => __( 'A single workflow, such as sending web leads into a CRM with a follow-up email, usually goes live in one to three weeks. Projects that connect several systems or need custom code take longer. You get a go-live date in the fixed-scope quote before any work starts.', 'amatec' ),
		),
		array(
			'q' => __( 'How much does workflow automation cost?', 'amatec' ),
			'a' => __( 'We quote a fixed price for each project after the free audit, based on how many steps, systems and edge cases the workflow has. Many clients start with one workflow, see the hours it saves, then automate the next one.', 'amatec' ),
		),
		array(
			'q' => __( 'Do we have to replace the tools we already use?', 'amatec' ),
			'a' => __( 'No. We build on the software you already pay for, such as your CRM, accounting tool, inbox and spreadsheets, and connect them so they share data.', 'amatec' ),
		),
		array(
			'q' => __( 'What happens if an automation breaks?', 'amatec' ),
			'a' => __( 'Every workflow we build has error handling and alerts, so a failed run gets flagged the moment it happens. On a support plan we monitor your workflows, fix failures and update them when your process or one of your tools changes.', 'amatec' ),
		),
		array(
			'q' => __( 'Do you work with companies outside India?', 'amatec' ),
			'a' => __( 'Yes. Most of our clients are in the US and Europe. We work remotely, agree on meeting hours that overlap with your time zone, and run every call in English.', 'amatec' ),
		),
	);
}

/**
 * FAQ sets for the platform, AI and product pages.
 *
 * @param string $key make|n8n|monday|zoho|ai|tchat|stock.
 * @return array
 */
function amatec_platform_faqs( $key ) {
	$sets = array(
		'make'   => array(
			array(
				'q' => __( 'What is a Make.com scenario?', 'amatec' ),
				'a' => __( 'A scenario is an automated workflow in Make.com. It starts with a trigger, such as a new form entry or a set time, then runs a chain of modules that read, change and send data between apps. Routers split it into branches, and error handlers decide what happens when a step fails.', 'amatec' ),
			),
			array(
				'q' => __( 'Is Make.com better than Zapier?', 'amatec' ),
				'a' => __( 'For simple two-step tasks, Zapier is quicker to set up. Make.com is the better fit once a workflow needs branches, loops, data transformation or high volume, because it shows the whole flow on one canvas and usually costs less per operation.', 'amatec' ),
			),
			array(
				'q' => __( 'Can you fix a scenario someone else built?', 'amatec' ),
				'a' => __( 'Yes. We audit the existing scenario, remove wasted operations, add error handling and document it. A cleaner build usually uses fewer operations, which also lowers your Make.com bill.', 'amatec' ),
			),
			array(
				'q' => __( 'Can you move our Zaps from Zapier to Make.com?', 'amatec' ),
				'a' => __( 'Yes. We map each Zap, rebuild it as a Make.com scenario, run both side by side on real data, and switch the Zap off once the results match.', 'amatec' ),
			),
			array(
				'q' => __( 'Do we own the scenarios you build?', 'amatec' ),
				'a' => __( 'Yes. We build in your own Make.com organisation, document every scenario and walk your team through it at handover.', 'amatec' ),
			),
		),
		'n8n'    => array(
			array(
				'q' => __( 'What is n8n?', 'amatec' ),
				'a' => __( 'n8n is a workflow automation platform with a visual editor that also accepts custom JavaScript and Python code. It uses a fair-code licence, so you can host it on your own server and keep the data in your workflows inside your own infrastructure.', 'amatec' ),
			),
			array(
				'q' => __( 'Should we self-host n8n or use n8n Cloud?', 'amatec' ),
				'a' => __( 'n8n Cloud is quicker to start, and n8n runs the servers for you. Self-hosting suits companies with strict data rules, high run volumes or a need for custom nodes. We set up and maintain either option.', 'amatec' ),
			),
			array(
				'q' => __( 'Is self-hosted n8n secure?', 'amatec' ),
				'a' => __( 'It is when it is set up properly. We deploy it behind HTTPS with access controls, encrypted credentials, scheduled backups and regular updates, and keep the editor off the public internet wherever the workflows allow.', 'amatec' ),
			),
			array(
				'q' => __( 'Can n8n connect to our internal database or API?', 'amatec' ),
				'a' => __( 'Yes. n8n has nodes for common databases such as Postgres and MySQL, an HTTP Request node for any REST API, and webhooks for systems that push data out. When a system has no API, we look at other routes, such as file drops or email parsing.', 'amatec' ),
			),
			array(
				'q' => __( 'Can n8n run AI workflows?', 'amatec' ),
				'a' => __( 'Yes. n8n has built-in nodes for OpenAI, Anthropic and other model providers, plus AI agent nodes. We use them to sort email, extract invoice data and summarise call transcripts.', 'amatec' ),
			),
		),
		'monday' => array(
			array(
				'q' => __( 'What can monday.com automations do?', 'amatec' ),
				'a' => __( 'monday.com automations are rules written as "when this happens, do that". They can change a status, assign an owner, create an item, send a notification or move an item to another board. Integrations extend the same rules to tools like Slack, Gmail and HubSpot.', 'amatec' ),
			),
			array(
				'q' => __( 'Why do monday.com boards get messy?', 'amatec' ),
				'a' => __( 'Boards usually grow one column at a time with no plan, so the same data ends up in three places and nobody trusts the status. We fix the board structure first and add automations second, because automating a messy board only makes the mess move faster.', 'amatec' ),
			),
			array(
				'q' => __( 'Can monday.com sync with our CRM or accounting tool?', 'amatec' ),
				'a' => __( 'Yes. We use monday.com’s own integrations where they exist and Make.com or n8n where they don’t, so records stay in step without anyone copying them across.', 'amatec' ),
			),
			array(
				'q' => __( 'Do you train our team?', 'amatec' ),
				'a' => __( 'Yes. Every build ends with documentation and a training session, so your team can run the boards and adjust simple automations without waiting for us.', 'amatec' ),
			),
		),
		'zoho'   => array(
			array(
				'q' => __( 'What is Deluge in Zoho?', 'amatec' ),
				'a' => __( 'Deluge is Zoho’s scripting language. It runs custom functions inside Zoho CRM, Books, Creator and other Zoho apps for logic that the built-in workflow rules can’t handle, such as assigning leads by region or syncing records between apps.', 'amatec' ),
			),
			array(
				'q' => __( 'Zoho Flow or Make.com: which should we use?', 'amatec' ),
				'a' => __( 'Zoho Flow fits when most of your tools are Zoho apps and the logic is simple. Make.com or n8n is the better choice when you connect many non-Zoho tools or need complex branching. We often use Deluge inside Zoho and Make.com or n8n for everything outside it.', 'amatec' ),
			),
			array(
				'q' => __( 'Do you build custom Zoho extensions?', 'amatec' ),
				'a' => __( 'Yes. We have published two extensions on the Zoho Marketplace: Stock Procurement for Zoho Inventory and Twilio Chat for Zoho CRM. We also build private extensions for a single company’s Zoho account.', 'amatec' ),
			),
			array(
				'q' => __( 'Can you automate Zoho Books?', 'amatec' ),
				'a' => __( 'Yes. We automate invoices created from CRM deals, payment reminders, bank transaction rules and reporting in Zoho Books, and connect it to payment gateways such as Razorpay, PayPal and Stripe.', 'amatec' ),
			),
			array(
				'q' => __( 'Can ChatGPT or Claude read our Zoho data?', 'amatec' ),
				'a' => __( 'Yes, through an MCP server. We build MCP servers that give an AI assistant read-only access to your Zoho Books, Inventory or CRM data, so you can ask questions about your business in plain English.', 'amatec' ),
			),
		),
		'ai'     => array(
			array(
				'q' => __( 'What is AI task automation?', 'amatec' ),
				'a' => __( 'AI task automation adds a language model to a workflow so it can handle steps that need some judgment, like reading an email, pulling fields from an invoice or scoring a lead. The rest of the workflow stays rule-based, so every AI decision has an input and an output you can check.', 'amatec' ),
			),
			array(
				'q' => __( 'Which AI models do you use?', 'amatec' ),
				'a' => __( 'Mostly OpenAI models for text and Whisper for speech-to-text, with Anthropic Claude where it fits better. We pick the cheapest model that does the task reliably and switch when a better option appears.', 'amatec' ),
			),
			array(
				'q' => __( 'What is an MCP server?', 'amatec' ),
				'a' => __( 'MCP (Model Context Protocol) is an open standard that lets AI assistants such as ChatGPT and Claude connect to outside tools and data. An MCP server we build for your Zoho account or database lets the assistant look up your real records when it answers.', 'amatec' ),
			),
			array(
				'q' => __( 'Is our data safe with AI automation?', 'amatec' ),
				'a' => __( 'We send a model only the fields a task needs, use API providers whose terms exclude training on your data, and log every request. For sensitive data we can run the workflow on self-hosted n8n.', 'amatec' ),
			),
			array(
				'q' => __( 'Will AI replace our staff?', 'amatec' ),
				'a' => __( 'No. It takes the repetitive first pass off their plate. People still review anything where a wrong answer would cost money or upset a customer.', 'amatec' ),
			),
		),
		'tchat'  => array(
			array(
				'q' => __( 'What is T-Chat for Zoho CRM?', 'amatec' ),
				'a' => __( 'T-Chat is a Zoho CRM extension built by Amatec. It connects your Twilio account to Zoho CRM so your team can send and receive SMS and MMS from a lead or contact record. On the Zoho Marketplace it is listed as Twilio Chat for Zoho CRM.', 'amatec' ),
			),
			array(
				'q' => __( 'Do I need a Twilio account?', 'amatec' ),
				'a' => __( 'Yes. T-Chat uses your own Twilio account and phone number, so Twilio bills your messages at your normal Twilio rates.', 'amatec' ),
			),
			array(
				'q' => __( 'Where can we see past messages?', 'amatec' ),
				'a' => __( 'Each conversation is linked to the matching lead or contact in Zoho CRM, so anyone with access to that record can see the full message history.', 'amatec' ),
			),
			array(
				'q' => __( 'How do I install T-Chat?', 'amatec' ),
				'a' => __( 'Install it from the Zoho Marketplace, add your Twilio credentials in the extension settings and choose the number to send from. Setup takes a few minutes and needs no code.', 'amatec' ),
			),
		),
		'stock'  => array(
			array(
				'q' => __( 'What does Stock Procurement for Zoho Inventory do?', 'amatec' ),
				'a' => __( 'It works out which raw materials to buy for a production target. You enter how many composite items you plan to make, and it breaks each one down through its bill of materials and gives you a purchase list you can download.', 'amatec' ),
			),
			array(
				'q' => __( 'Does it handle multi-level composite items?', 'amatec' ),
				'a' => __( 'Yes. It breaks bundles and kits down level by level, the same way Zoho Inventory stores them.', 'amatec' ),
			),
			array(
				'q' => __( 'Do I need to move my data anywhere?', 'amatec' ),
				'a' => __( 'No. The extension runs inside Zoho Inventory and reads the items and bills of materials you already have.', 'amatec' ),
			),
			array(
				'q' => __( 'Who supports the extension?', 'amatec' ),
				'a' => __( 'Amatec built it and supports it directly. Book a call through our contact page if you need it adapted to your setup.', 'amatec' ),
			),
		),
	);
	return isset( $sets[ $key ] ) ? $sets[ $key ] : array();
}

/**
 * Organization + ProfessionalService structured data on the homepage,
 * About and Contact. Remove this if Yoast "Site representation" is later
 * set to Organization, to avoid two organisation entities.
 */
function amatec_org_schema() {
	if ( ! ( is_front_page() || is_page( array( 'about', 'contact' ) ) ) ) {
		return;
	}
	$home = home_url( '/' );
	$data = array(
		'@context'     => 'https://schema.org',
		'@type'        => array( 'Organization', 'ProfessionalService' ),
		'@id'          => $home . '#organization',
		'name'         => 'Amatec',
		'url'          => $home,
		'logo'         => get_theme_file_uri( 'assets/img/amatec-logo-full.png' ),
		'image'        => get_theme_file_uri( 'assets/img/amatec-logo-full.png' ),
		'description'  => 'Amatec is a workflow automation agency in Vadodara, India. It builds and maintains automated workflows on Make.com, n8n, Zoho and monday.com, adds AI steps and MCP servers to them, and publishes extensions on the Zoho Marketplace.',
		'email'        => 'hello@amatec.in',
		'telephone'    => '+91 72659 69478',
		'address'      => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'Kplex, Alkapuri',
			'addressLocality' => 'Vadodara',
			'addressRegion'   => 'Gujarat',
			'postalCode'      => '390007',
			'addressCountry'  => 'IN',
		),
		'founder'      => array(
			'@type'    => 'Person',
			'name'     => 'Anirban Sinha',
			'jobTitle' => 'Founder',
			'url'      => home_url( '/about/' ),
		),
		'areaServed'   => array( 'United States', 'United Kingdom', 'European Union', 'India' ),
		'knowsAbout'   => array( 'Workflow automation', 'Make.com', 'n8n', 'Zoho CRM', 'Zoho Books', 'Zoho Inventory', 'Deluge', 'monday.com', 'Zapier', 'AI automation', 'Model Context Protocol' ),
		'sameAs'       => array(
			'https://www.linkedin.com/company/amatec83',
			'https://www.youtube.com/@AMATEC-automation',
			'https://www.instagram.com/amatec.in/',
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}
add_action( 'wp_head', 'amatec_org_schema', 20 );

/**
 * Serve the theme's llms.txt at https://amatec.in/llms.txt.
 *
 * @param WP $wp Current WordPress environment.
 */
function amatec_llms_txt( $wp ) {
	if ( 'llms.txt' !== $wp->request ) {
		return;
	}
	$file = get_theme_file_path( 'llms.txt' );
	if ( ! file_exists( $file ) ) {
		return;
	}
	status_header( 200 );
	header( 'Content-Type: text/plain; charset=utf-8' );
	header( 'X-Robots-Tag: noindex' );
	readfile( $file );
	exit;
}
add_action( 'parse_request', 'amatec_llms_txt' );
```

### `template-parts/home/summary.php`

```php
<?php
/**
 * Home: "What Amatec does", a plain-language summary of who we are,
 * written so a reader or an AI answer engine can quote it on its own.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<section id="what-is-amatec" class="section" style="background:var(--bg-page);">
	<div class="wrap" style="max-width:880px;">
		<div class="sec-head">
			<div class="eyebrow"><?php esc_html_e( 'IN SHORT', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'What Amatec does', 'amatec' ); ?></h2>
			<p class="lead">
				<?php esc_html_e( 'Amatec is a workflow automation agency based in Vadodara, India. We build and run automated workflows on Make.com, n8n, Zoho and monday.com for small and mid-sized companies, most of them in the US and Europe. A typical project connects three or four tools that don’t talk to each other, so data moves between them without anyone copying it.', 'amatec' ); ?>
			</p>
			<p class="lead">
				<?php esc_html_e( 'We have worked this way since 2020. We have published two extensions on the Zoho Marketplace and an app on Make, and we add AI steps and MCP servers where they save real time. The person on your first call is the engineer who would build your workflow.', 'amatec' ); ?>
			</p>
		</div>
	</div>
</section>
```

### `llms.txt`

```markdown
# Amatec

> Amatec is a workflow automation agency based in Vadodara, India. Since 2020 it has built and maintained automated workflows on Make.com, n8n, Zoho and monday.com for small and mid-sized businesses, mostly in the US and Europe. It also adds AI steps to workflows, builds MCP servers that connect ChatGPT and Claude to Zoho data, and publishes extensions on the Zoho Marketplace.

- Founder: Anirban Sinha
- Email: hello@amatec.in
- Phone: +91 72659 69478
- Address: Kplex, Alkapuri, Vadodara, Gujarat 390007, India
- Free 30-minute automation audit: https://cal.com/amatec/meeting

## Services

- [Workflow automation](https://amatec.in/workflow-automation/): Self-running workflows that move data between your CRM, inbox, finance tools and spreadsheets.
- [AI-powered task automation](https://amatec.in/ai-powered-task-automation/): AI steps for email sorting, invoice extraction and lead scoring, plus MCP servers for Zoho data.
- [CRM automation](https://amatec.in/crm-automation/): Lead capture, routing, follow-ups and pipeline reporting, with a focus on Zoho CRM.

## Platforms

- [Make.com automation](https://amatec.in/make-com-automation/): Scenario design, fixes, error handling and Zapier migrations.
- [n8n workflow automation](https://amatec.in/n8n-workflow-automation/): Self-hosted or cloud n8n, APIs, databases and AI agents.
- [monday.com workflow automation](https://amatec.in/monday-com-workflow-automation/): Board design, automation recipes and integrations.
- [Zoho workflow automation](https://amatec.in/zoho-workflow-automation/): Deluge scripts, Zoho Flow and custom extensions across CRM, Books, Inventory and Creator.

## Products

- [T-Chat for Zoho CRM](https://amatec.in/t-chat-zoho-extension/): Twilio SMS and MMS inside Zoho CRM records. Listed on the Zoho Marketplace as Twilio Chat for Zoho CRM.
- [Stock Procurement for Zoho Inventory](https://amatec.in/stock-procurement-for-zoho-inventory/): Turns a production target into a raw-material purchase list for composite items.

## Solutions by function

- [Lead and sales automation](https://amatec.in/lead-sales-automation/)
- [Marketing automation](https://amatec.in/marketing-automation/)
- [Finance and accounting automation](https://amatec.in/finance-accounting-automation/)
- [HR and operations automation](https://amatec.in/hr-operations-automation/)
- [Customer support automation](https://amatec.in/customer-support-automation/)

## Industries

- [IT companies](https://amatec.in/it-company/)
- [Ecommerce](https://amatec.in/ecommerce/)
- [Startups](https://amatec.in/startups/)
- [Healthcare practices](https://amatec.in/healthcare/)
- [Real estate](https://amatec.in/real-estate/)
- [Small business](https://amatec.in/small-business/)
- [Enterprise](https://amatec.in/enterprise/)

## Company

- [About Amatec](https://amatec.in/about/)
- [Contact](https://amatec.in/contact/)
- [Blog](https://amatec.in/blog/)
```

## 6. Not in this brief

These need Anirban or a separate brief. Do not start them in this session.

1. Blog. 118 posts and about 58,000 words in the WordPress database. Em dashes appear in 59 posts and 'streamline' in 61, and many posts are near-duplicate city pages (Miami, Denver, Phoenix and others), which Google can treat as scaled content. This needs its own pass: merge the duplicates, give each kept post a 40 to 60 word answer under its H1, and add real examples.
2. Yoast Site representation. Setting Organization in Yoast settings would make Yoast own the organisation entity. If anyone does that later, remove `amatec_org_schema()` from `inc/aio.php` so there are not two.
3. Third-party presence. AI engines cite review sites, marketplaces and LinkedIn more than a company's own site. The Zoho Marketplace listings have no reviews, no tags and empty Key Features. Zoho featured Twilio Chat in an App Spotlight post on 20 Apr 2026; once Anirban supplies that URL it should go on the T-Chat page as proof.
4. Stock Procurement demo video. Edit SP01 changes the placeholder to 'Demo video coming soon'. Recording the video is still to do.
5. Brand casing. The site mixes 'AMATEC' and 'Amatec'. New copy uses 'Amatec'. A full sweep is a design decision for Anirban.

## 7. House style for any copy you touch

If you must write a word that is not in this brief, it has to pass these checks.

1. No dash used as a pause. Use a comma, a full stop or 'and'.
2. Banned words: delve, underscore, foster, enhance, leverage, utilise, spearhead, embark, pivotal, crucial, intricate, seamless, robust, vibrant, tapestry, landscape, realm, testament, journey, ecosystem, game changer, paradigm shift, overall, in summary, in conclusion.
3. Banned shapes: 'not X, it is Y', 'not just', 'not only... but also', three stacked adjectives, vague sources like 'studies show'.
4. Say the thing, then stop. Concrete names and numbers beat adjectives. Short sentences next to longer ones.
