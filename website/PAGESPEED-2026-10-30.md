# Mobile PageSpeed pass (theme 1.10.1)

Built 30 Oct 2026 on top of theme 1.10.0 (PR #9, Multi Vendor SKU). Goal: mobile PageSpeed 85+ on the product and platform pages without changing how they look. Not deployed.

## Results

Lighthouse 12.8.2, mobile preset, `--only-categories=performance`, headless Chrome, median of 3 runs. Local preview: `PHP_CLI_SERVER_WORKERS=8 php -S localhost:8093 tools/local-preview/router.php` (no gzip, no plugins, no GTM).

| Page (local) | Before | After | FCP | LCP | TBT | CLS |
|---|---|---|---|---|---|---|
| Home | 75 | **88** | 3.07 → 1.80 s | 4.96 → 3.46 s | 17 → 155 ms | 0.023 → 0 |
| Stock Procurement | 89 | **96** | 1.81 → 1.65 s | 3.65 → 2.71 s | 0 → 0 ms | 0.016 → 0 |
| Make.com Automation | 84 | **94** | 1.81 → 1.80 s | 4.36 → 2.86 s | 4 → 0 ms | 0.034 → 0 |
| Multi Vendor SKU | 78 | **92** | 3.08 → 1.95 s | 4.57 → 3.16 s | 0 → 0 ms | 0.002 → 0 |

Home TBT rises locally because the WebGL shader now compiles after `load`, inside the measured window (headless Chrome renders WebGL in software); the score still goes up 13 points. The Multi Vendor SKU "after" includes media work that landed in PR #9 at the same time.

Live today (1.9.2): Stock Procurement 76 (FCP 2.2 s, LCP 3.8 s, TBT 277 ms), home 72.

Live can only be measured after upload. To estimate it, the live Stock Procurement HTML was replayed locally with the live plugin files, real GTM, gzip and a 550 ms server delay (median of 3 to 5 runs):

| Replica of live Stock Procurement | Score | FCP | LCP | TBT |
|---|---|---|---|---|
| As live today | 85 | 1.81 s | 4.06 s | 141 ms |
| Theme 1.10.1 | **89** | 1.36 s | 2.57 s | 340 ms |
| 1.10.1 without the GTM pixels (Facebook, Clarity, LinkedIn) | 94 | 1.96 s | 2.56 s | 136 ms |

The replica reads high (85 against 76 on live) because live TBT and server latency are worse, so treat it as a direction, not a forecast. With FCP about 1.9 s, LCP 2.6 to 3.4 s and TBT 250 to 350 ms on live, the Lighthouse formula gives 84 to 89. TBT from the GTM pixels decides which end.

## What changed in `theme/amatec/`

| File | Change |
|---|---|
| `functions.php` | Version 1.10.1. `amatec_assets()`: Google Fonts and `unpkg.com/lucide@latest` removed; `fonts.css` + `amatec.css` print inline in `<head>` through `amatec_inline_css()` (comments and whitespace stripped, nothing else, read on each uncached request so edits show at once; `AMATEC_INLINE_CSS` false loads them as files again); icons and `amatec.js` load deferred in the footer. `amatec_preload_fonts()` preloads Sora and IBM Plex Sans (latin). `amatec_logo()` serves the 420 px logo through srcset with width and height (header `fetchpriority="high"`, footer `loading="lazy"`). `amatec_jquery_in_footer()` and `amatec_async_plugin_styles()`: see Plugin assets |
| `assets/fonts/`, `assets/css/fonts.css` | New. The exact woff2 files and `@font-face` rules Google Fonts serves (all subsets, `font-display: swap`), plus the OFL licences. A page only downloads the subsets it uses |
| `assets/js/icons.js` | New. The 158 Lucide icons the theme uses, from Lucide 1.65.0 (what `@latest` was today), with Lucide's own `createIcons()` code, so the SVG markup is the same. 37 KB instead of 473 KB. An icon name missing from the file makes the page load the full pinned bundle, so nothing breaks if someone forgets to rebuild |
| `assets/img/amatec-logo-full-420.png`, `amatec-logo-full-white-420.png` | New. 420x168 copies of the 1200x480 logos (15.6 KB and 9.6 KB instead of 53 KB and 34 KB). The header logo became the LCP element once the hero text stopped counting (see below) |
| `assets/js/amatec.js` | The WebGL hero and the Cal.com embed start after the page `load` event (`afterLoad()`), the same pattern as the Multi Vendor SKU videos. Without this, home got slower: the shader compile ran before the first paint |

Why the logo is the LCP now: the hero text sits inside `.reveal` (opacity 0 to 1 animation). Before, the Google font arrived after the animation and the repaint counted as LCP. With the fonts local and preloaded, the text is painted only during the fade, which Chrome does not count, so the logo is the largest element painted.

## Plugin assets

Checked on all 39 sitemap pages of the live site (30 Oct 2026): no page renders a FormLayer form and no page has inline jQuery, yet every page loads jQuery, jQuery Migrate, Dashicons and the FormLayer CSS render-blocking in `<head>`. jQuery's only front-end user is FormLayer's footer script.

- jQuery and jQuery Migrate move to the footer. If a head script lists jQuery as a dependency, WordPress pulls it back into `<head>`, so the load order cannot break.
- Dashicons and the FormLayer CSS load with `media="print" onload` (plus `<noscript>`), so they no longer block rendering. Logged-in users with the admin bar keep them as they were.
- CookieAdmin's CSS and scripts are untouched: the consent banner shows at first paint and must stay styled.

The local preview has no plugins, so this part is checked by unit test and the replica only. After upload, check in view-source that jQuery prints before `</body>` and the two stylesheets carry `media="print"`.

## GTM-M6GL4DDD (TBT on live)

Live TBT on Stock Procurement was 268 to 302 ms, all of it third-party code loaded by the container, which fires every tag on All Pages:

| Tag | Main-thread blocking (live, 3 runs) |
|---|---|
| GTM + GA4 (`G-RNZ5YTGNHJ`, two Google tags, Conversion Linker) | 143 to 172 ms |
| Facebook Pixel (Custom HTML, `fbevents.js` + signals config) | 121 to 135 ms |
| Microsoft Clarity (`s8s20luh6n`) | 79 to 113 ms |
| LinkedIn Insight (partner 10420321) | about 0 ms blocking, 32 ms main thread |

Lucide was 55 ms of main-thread time; it is gone. The container is 468 KB (162 KB compressed). Not changed here, because it changes what analytics records. Options for Anirban:

1. In GTM, fire the Facebook Pixel, Clarity and LinkedIn tags on a later trigger (Window Loaded plus a short timer, or first scroll or click). Replica without them: TBT 340 to 136 ms, score 89 to 94. Costs pageviews from visitors who leave within a few seconds.
2. Load GTM itself after the first interaction, with a timeout fallback. Biggest gain, biggest analytics change.

## Tools

`tools/pagespeed/`:

- `build_fonts.py <theme>`: downloads the Google Fonts files and writes `assets/css/fonts.css`. Re-run only if the families or weights change.
- `build_icons.js <theme> [lucide-version]` (with `icons-runtime.js`): scans every quoted kebab-case string in the theme's PHP and JS, keeps the Lucide icon names, writes `assets/js/icons.js`. **Re-run after adding an icon.**
- `build_logos.py <theme>`: writes the 420 px logo copies (Pillow).

`tools/local-preview/router.php`: `wp_register_style()` / `wp_add_inline_style()` (inline `<style>`), the `strategy` argument of `wp_enqueue_script()` (`defer`), theme `wp_head` callbacks before priority 8 print ahead of the styles as in WordPress, stubs for `wp_script_add_data()` and `is_admin_bar_showing()`.

## Visual check

Full-page screenshots at 1440 and 375 px (reduced motion) of the four pages, theme without these changes against with them, compared pixel by pixel: identical except the logo edges (resampled from 420 instead of 1200 px; same look when zoomed), the animated flow dots on the Make hero, and on home the Cal.com calendar, which now fills in a moment later. 240 local pages crawled: every `data-lucide` name is in `icons.js`. Same SVG count per page before and after, no console errors, no sideways scroll at 375 px.

## Deploy notes

- Upload the zip as usual, then purge SpeedyCache (the inline CSS lives in the cached HTML).
- Then run PageSpeed Insights (mobile) on `/stock-procurement-for-zoho-inventory/`, `/make-com-automation/` and the home page, 3 times each.
- Rollback: the previous zip, or define `AMATEC_INLINE_CSS` as false to go back to a CSS file while keeping the rest.
