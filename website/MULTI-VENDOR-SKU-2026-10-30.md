# Multi Vendor SKU page + Privacy Policy section 07 (theme 1.10.0)

Built 30 Oct 2026 from the brief "Build the Multi Vendor SKU app page on amatec.in", then updated the same day with the page review fixes and the media. Every slot now has real media. Not deployed yet.

## What changed in `theme/amatec/`

| File | Change |
|---|---|
| `page-multi-vendor-sku-for-zoho-inventory.php` | New slug template, same method as Stock Procurement (page 26) |
| `template-parts/products/mvs-*.php` | New sections: hero, answer + at-a-glance, problem, 3 steps, features + extras, before/after table, video, flow inside Zoho (7 steps), CTA, and a media slot. Removed on Anirban's request: the Uninstall flow step, the data and privacy section, and the FAQ on data storage |
| `inc/multi-vendor-sku.php` | New. Marketplace link placeholder and the price ($29 per organization per month, 30 day free trial) in one place, media list with alt text, SoftwareApplication JSON-LD in the head with an Offer of 29 USD per month |
| `inc/aio.php` | FAQ set `mvs` (7 questions). llms.txt hides lines for draft pages until they are published |
| `functions.php` | Version 1.10.0. `amatec_site_pages()` takes optional `status`, `desc`, `focuskw`, `ogimage`, so the page is created as a draft with its Yoast title, description, keyphrase and Open Graph / Twitter image, written with the insert (`meta_input`) so Yoast's head tags are right on the first view. `amatec_page_is_live()` gates the Application menu item |
| `template-parts/landing/faq.php` | Optional `q_tag` wraps each question in an H3 (used on this page only) |
| `inc/legal-pages.php`, `template-parts/legal/page.php` | Privacy Policy: effective date and "Last updated" chip, "recruitment-related data" removed, section 07 Zoho Marketplace apps (`#zoho-apps`) |
| `llms.txt`, `assets/css/amatec.css` | Product line for the new page (with price); CSS block at the end of the file, including the step 2 column fix and `object-fit: cover; object-position: top left` on media |
| `template-parts/products/mvs-media.php`, `assets/js/amatec.js` | Media slot: WebP with srcset, videos (WebM + MP4, muted, autoplay, loop, playsinline) whose sources load after first paint (hero) or when scrolled near (`initMvsVideos()`), off-screen videos pause, reduced motion keeps the poster. Accepts a raw `.png`, `.jpg` or `.gif` dropped in under the slot name |
| `assets/media/multi-vendor-sku/` | Built media: videos (WebM + MP4 + WebP poster) for 01 hero, 02, 03 and 06 steps, 04 feature, 10 extras; 16:10 stills for features 05, 06 (`06-bill-paste-match-card`), 07, 08, 09; `og-multi-vendor-sku.jpg` |
| `template-parts/products/mvs-features.php` | Every feature card media box is 16:10 (cover, top left) and the grid uses equal row heights, so all 6 cards are the same height |
| `template-parts/products/mvs-steps.php` | The 3 step media boxes are 32:15 (cover, top left), so all steps are the same height |
| `inc/multi-vendor-sku.php` (zoom) | Click-to-enlarge on step, feature and extras media: a native `<dialog>` with the full-size file (video plays muted in a loop), closes on Esc, a click outside or the close button, opens with Enter on a focused card. CSS and JS print on this page only |

Tools: `tools/local-preview/router.php` treats bespoke site pages as published so gated links show locally, stands in for Yoast's head tags on pages with Yoast settings, and answers byte-range requests (Safari needs them for video); `tools/test_render.php` also loads `inc/multi-vendor-sku.php` and checks the `mvs` FAQ set; `tools/build_mvs_media.py` builds the WebP / MP4 / WebM files from the originals (`python build_mvs_media.py <theme>/assets/media/multi-vendor-sku <originals dir>`).

## Open placeholders

- `#marketplace-link` in `inc/multi-vendor-sku.php`
- `[RETENTION]` in Privacy Policy section 07 (`inc/legal-pages.php`)
- Demo video (placeholder block)
- Media: none missing. To replace one, add the original and run `build_mvs_media.py`, or drop a file with the slot name into `assets/media/multi-vendor-sku/`. Names and alt text are in `amatec_mvs_media()`. Note: `01-po-autofill.png` and `04-vendor-switch-still.png` are pixel-identical, so the hero and feature 04 share a poster.

## Deploy notes

1. Uploading the theme makes the Privacy Policy changes live at once, because legal pages render from the theme. Fill `[RETENTION]` and have section 07 reviewed first.
2. After upload, open wp-admin once. The theme creates the page "Multi Vendor SKU for Zoho Inventory" as a draft with Yoast meta.
3. When the page is published, the Application menu item and the llms.txt line appear on their own.
4. Purge SpeedyCache.

## Checks run locally (localhost:8080)

- 1 H1, 9 H2, 7 FAQ questions as H3; FAQPage 7 = visible 7; SoftwareApplication (29 USD) in the head; meta description, canonical, og and twitter tags in the head (local Yoast stand-in)
- Step frames 621 px each at 1440 px, one column (916 px) at 980 px
- Headless Chrome 156 at 1440 and 375 px: all 6 feature cards the same height (383 / 411 px), media 362x227 / 333x209, no placeholders, no sideways scroll; every video's poster is set while it is still 650 px away, then it plays muted in a loop in view. iPhone Safari not tested (no simulator on this Mac)
- Lighthouse mobile (local, multi-worker PHP server, median of 3): this page 85, Stock Procurement 86. Live Stock Procurement today: 78
- No dashes, banned words or curly quotes in body copy; focus keyword words in the first 100 words
- No horizontal scroll at 375 px; table stacks into cards on mobile; FAQ opens and closes; no console errors
- Draft gate: with the page stubbed as draft, the menu item and llms.txt line are hidden
- `php tools/test_render.php theme/amatec` passes; `python3 tools/check_site.py` passes on the existing pages

Still to run on the live draft: Yoast SEO and readability, Google Rich Results Test (both schemas), PageSpeed mobile 85+.
