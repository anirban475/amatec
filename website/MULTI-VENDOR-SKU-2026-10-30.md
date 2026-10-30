# Multi Vendor SKU page + Privacy Policy section 07 (theme 1.10.0)

Built 30 Oct 2026 from the brief "Build the Multi Vendor SKU app page on amatec.in". Not deployed yet.

## What changed in `theme/amatec/`

| File | Change |
|---|---|
| `page-multi-vendor-sku-for-zoho-inventory.php` | New slug template, same method as Stock Procurement (page 26) |
| `template-parts/products/mvs-*.php` | New sections: hero, answer + at-a-glance, problem, 3 steps, features + extras, before/after table, video, flow inside Zoho, data and privacy, CTA, and a media slot |
| `inc/multi-vendor-sku.php` | New. Placeholders (`#marketplace-link`, `[PRICE]`) in one place, media list with alt text, SoftwareApplication JSON-LD in the head. An Offer is added once `offer_price` and `offer_currency` are set |
| `inc/aio.php` | FAQ set `mvs` (8 questions). llms.txt hides lines for draft pages until they are published |
| `functions.php` | Version 1.10.0. `amatec_site_pages()` takes optional `status`, `desc`, `focuskw`, so the page is created as a draft with its Yoast title, description and keyphrase on upload. `amatec_page_is_live()` gates the Application menu item |
| `template-parts/landing/faq.php` | Optional `q_tag` wraps each question in an H3 (used on this page only) |
| `inc/legal-pages.php`, `template-parts/legal/page.php` | Privacy Policy: effective date and "Last updated" chip, "recruitment-related data" removed, section 07 Zoho Marketplace apps (`#zoho-apps`) |
| `llms.txt`, `assets/css/amatec.css` | Product line for the new page; CSS block at the end of the file |

Tools: `tools/local-preview/router.php` treats bespoke site pages as published so gated links show locally; `tools/test_render.php` also loads `inc/multi-vendor-sku.php` and checks the `mvs` FAQ set.

## Open placeholders

- `#marketplace-link` and `[PRICE]` in `inc/multi-vendor-sku.php`
- `[RETENTION]` in Privacy Policy section 07 (`inc/legal-pages.php`)
- Demo video (placeholder block)
- Media: drop files into `theme/amatec/assets/media/multi-vendor-sku/` as `{name}.webp` for screenshots, or `{name}.mp4` / `{name}.webm` plus a `{name}.webp` poster for animations. Names and alt text are in `amatec_mvs_media()`. Until a file exists the slot shows a grey placeholder with its name.

## Deploy notes

1. Uploading the theme makes the Privacy Policy changes live at once, because legal pages render from the theme. Fill `[RETENTION]` and have section 07 reviewed first.
2. After upload, open wp-admin once. The theme creates the page "Multi Vendor SKU for Zoho Inventory" as a draft with Yoast meta.
3. When the page is published, the Application menu item and the llms.txt line appear on their own.
4. Purge SpeedyCache.

## Checks run locally (localhost:8080)

- 1 H1, 10 H2, 8 FAQ questions as H3; FAQPage 8 = visible 8; SoftwareApplication in the head
- No dashes, banned words or curly quotes in body copy; focus keyword words in the first 100 words
- No horizontal scroll at 375 px; table stacks into cards on mobile; FAQ opens and closes; no console errors
- Draft gate: with the page stubbed as draft, the menu item and llms.txt line are hidden
- `php tools/test_render.php theme/amatec` passes; `python3 tools/check_site.py` passes on the existing pages

Still to run on the live draft: Yoast SEO and readability, Google Rich Results Test (both schemas), PageSpeed mobile 85+.
