# Case study writing rules (amatec.in)

Every case study is produced in two files in `case-studies/content/`:

1. `<slug>.facts.md`: the fact sheet. Facts pulled from the Outline source docs, nothing else.
2. `<slug>.json`: the case study, written only from the fact sheet.

## Step 1. Fact sheet

Read every source doc in full with the Outline MCP tool `mcp__6f3ec064-7f9e-4950-a2c1-fc635dbdadaa__fetch` (resource "document"). READ ONLY: never create, edit, move or comment on anything in Outline.

The fact sheet lists, with the source doc id after each fact:
- Client: see the naming rule below.
- Industry, country or region (only if stated).
- Year (only if stated or clearly dated in the doc).
- The problem, in the doc's terms.
- What was built: platforms, apps, triggers, steps, schedules, clever details, workarounds for platform limits.
- Results: every number and outcome the doc states, quoted verbatim. Anirban decided to use every number in the docs, so keep them all, word for word. Never round, extend or invent a number.
- What must NOT be published (see "Never publish").

### Client naming rule
- If a client company name appears anywhere in the source docs (title, prose, a connection or organisation label such as "Xero - BASCUDA LIMITED"), use that company name.
- Do not derive a company name from an email address or web domain alone. In that case, and when no name appears, anonymise: describe the client by industry and country, for example "a UK web hosting company". If the country is not stated, leave it out.
- Never name individual people (client staff, executives, Amatec staff), even if they appear in the doc.

### Never publish
API keys, tokens, passwords, webhook URLs, scenario or app URLs, org/account/board/list/sheet IDs, email addresses, phone numbers, people's names, prices, customer names of the client's own customers, and personal data fields. Do not describe scraping techniques (spoofed headers, bypassing site protections); say "public company data" or "job board listings" instead.

## Step 2. Write the case study (use Maven)

Invoke the `anthropic-skills:maven` skill with the Skill tool and use it to choose the angle and write the copy. Give it the fact sheet and these constraints. If the skill cannot be loaded, write it yourself following these rules.

AI-search (AIO) rules:
- `excerpt`: 40 to 60 words, answer first. Names the client (or the anonymised description), what Amatec built, on which platform, and the main result. It must make sense quoted on its own.
- Each body section starts with a sentence that stands alone if an AI engine quotes it.
- Concrete beats vague: real tool names, real steps, the doc's numbers.
- 600 to 900 words of body text.
- Use "Amatec" (not "AMATEC") in new copy.

House style (from the website brief, section 7):
1. No em dash or en dash anywhere. Use a comma, a full stop or "and".
2. Banned words: delve, underscore, foster, enhance, leverage, utilise, spearhead, embark, pivotal, crucial, intricate, seamless, seamlessly, robust, vibrant, tapestry, landscape, realm, testament, journey, ecosystem, game changer, paradigm shift, overall, in summary, in conclusion, streamline, boost, cutting-edge, unlock, empower, revolutionise, supercharge.
3. Banned shapes: "not X, it is Y", "not just", "not only ... but also", three stacked adjectives, vague sources like "studies show".
4. Say the thing, then stop. Short sentences next to longer ones.
5. No facts beyond the fact sheet. If a detail is missing (time saved, volume), do not invent it; describe the outcome in words.

## JSON format

```json
{
  "slug": "given in your brief",
  "title": "Plain, specific, under 80 characters. No colon-and-subtitle clickbait.",
  "excerpt": "40 to 60 words, answer first",
  "client_name": "Company name, or empty string when anonymised",
  "client_desc": "Short description, e.g. 'Hong Kong electronics distributor' or 'UK web hosting company'",
  "country": "Country or region, or empty string",
  "year": "e.g. '2025', or empty string",
  "headline_result": "The single strongest result for the card, max 40 characters, e.g. '271 containers tracked'. Use a doc number if one exists, otherwise a short concrete outcome.",
  "results": ["3 to 5 results, each one line, numbers verbatim from the docs"],
  "tools": ["Every app/platform used, e.g. 'Zoho Creator', 'Deluge', 'Make.com'"],
  "platforms": ["one or more of: make, n8n, zoho, monday, ai"],
  "industry": "Exactly one of: Ecommerce, Logistics and distribution, Web hosting, Recruitment, Real estate, Marketing agencies, Food production, Retail and trading, Accounting and finance, Property management, Sales teams, SaaS, Customer support",
  "seo_title": "Under 60 characters, ends with ' | Amatec'",
  "seo_description": "140 to 160 characters, no dashes",
  "body_html": "Gutenberg block HTML (see below)",
  "faqs": [{"q": "...", "a": "..."}],
  "sources": ["outline doc ids used"]
}
```

`body_html` uses Gutenberg block markup, exactly three H2 sections in this order: "The challenge", "What we built", "The results". Use paragraphs and lists only:

```html
<!-- wp:heading --><h2 class="wp-block-heading">The challenge</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>...</p><!-- /wp:paragraph -->
<!-- wp:list --><ul class="wp-block-list"><!-- wp:list-item --><li>...</li><!-- /wp:list-item --></ul><!-- /wp:list -->
```

`faqs`: 3 to 5 questions a buyer would type into ChatGPT or Google about this kind of project ("How do you sync Etsy sales into Xero automatically?"), answered in 2 to 4 sentences from the fact sheet only.

## Before you finish
Run this check and fix anything it reports, then re-run until it prints `OK`:

```bash
python3 case-studies/lint_case_study.py <path-to-json>
```
