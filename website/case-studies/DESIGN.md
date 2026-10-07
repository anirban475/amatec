# Case studies section: design (approved 7 Oct 2026)

## Goal
A browsable, AI-search-friendly case studies section on amatec.in that keeps growing: each new project is added in wp-admin like a blog post.

## Decisions (Anirban, 7 Oct 2026)
- Client naming: name the client when a company name appears in the Outline source docs; otherwise anonymise by industry and country. Never name individual people.
- Numbers: use every number stated in the source docs, verbatim.
- First batch: all 12 shortlisted projects.
- Build approach A: a dedicated Case Study post type in the theme.
- The "Case Studies" menu item now links to /case-studies/ (reverses brief item F12).

## Content model (theme 1.9.0)
- Post type `amatec_case_study`, URL base `/case-studies/`, archive on, REST on. Supports title, editor, excerpt, featured image, revisions.
- Taxonomies: `cs_platform` (Make.com, n8n, Zoho, monday.com, AI; URL `/case-studies/platform/<slug>/`) and `cs_industry` (URL `/case-studies/industry/<slug>/`).
- Meta (REST-visible, edited in a "Case study details" box): `_cs_client_name`, `_cs_client_desc`, `_cs_country`, `_cs_year`, `_cs_headline`, `_cs_results` (one per line), `_cs_tools` (one per line), `_cs_faqs` (blocks of `Q: ...` / `A: ...`).
- Yoast title/description meta registered for REST on the post type.

## Pages
- Archive and taxonomy lists: navy hero with an answer-first summary; platform and industry filter links (plain links, crawlable); card grid (platform chips, title, client line, headline result); pagination; booking band; ItemList JSON-LD.
- Single: hero with back link, platform chips, H1, excerpt as summary; "At a glance" panel (client, industry, country, platforms, year, results as tiles); body with sticky table of contents (sections: The challenge, What we built, The results); tools used chips; FAQ (reuses `template-parts/landing/faq.php`, which prints matching FAQPage JSON-LD); 3 related case studies (same platform); Cal.com booking.
- Images: featured image if set, otherwise a branded CSS graphic per platform.
- `/llms.txt`: theme appends a "Case studies" section generated from published case studies.

## Content pipeline
Fact sheet per project from Outline (secrets, IDs, emails, people removed) → Maven writes copy to `content/<slug>.json` under WRITING-RULES.md → `lint_case_study.py` (dashes, banned words, secrets, lengths, structure) → my fact check against the fact sheet.

## Release
Local preview (router stubs the post type from `content/*.json`) → PHP lint, render and schema checks → commit to `anirban475/amatec` → zip `amatec-1.9.0.zip` → upload → rewrite rules flush automatically on version change → create the 12 case studies via REST with terms, meta and Yoast fields → live checks and validator.schema.org.

## Adding a case study later
wp-admin → Case Studies → Add New: write the three sections, fill the details box, tick platform and industry, set the excerpt, publish.
