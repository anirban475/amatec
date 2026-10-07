=== AMATEC ===
Contributors: amatec
Requires at least: 6.0
Tested up to: 6.7
Requires PHP: 7.4
Version: 1.0.0
License: GPLv2 or later

AMATEC — Business Process Automation marketing theme, built from the AMATEC
Design System. Standalone classic theme (no parent theme required).

== What you get ==
* Homepage (front-page.php): WebGL mesh-gradient hero + live workflow diagram,
  partner-platform band, six-card services grid, interactive 4-step "How it works"
  stepper, dark results stats, client testimonial, Cal.com booking section.
* About page (page-about.php, "About Page" template): hero, by-the-numbers stats,
  founder story (Anirban Sinha), values, certifications + client proof, Cal.com CTA.
* Blog list (home.php) + single post (single.php): driven entirely by WordPress —
  see "Adding blog posts" below.
* Frosted sticky mega-menu nav + mobile drawer (full AMATEC sitemap).
* Dark navy footer with the full sitemap, social links and audit CTA.
* Real AMATEC logo bundled — shows in header and footer by default.

== Adding blog posts (from WordPress itself) ==
On activation the theme creates a "Blog" page and sets it as your Posts page.
To publish an article:
  1. Posts → Add New.
  2. Write the body. Use Heading 2 (H2) blocks for each section — they become the
     numbered sections AND the "On this page" sidebar automatically.
  3. Set a Featured Image (becomes the article banner + the card thumbnail).
  4. Assign one or more Categories (shown as the tag chips / card labels).
  5. Publish.
The post appears in the blog list and renders in the single-post design. Comments
use native WordPress comments (moderate them under Comments in wp-admin).
The blog list lives at /blog/.

== Install ==
1. WordPress Admin → Appearance → Themes → Add New → Upload Theme.
2. Choose amatec.zip → Install Now → Activate.
3. On activation the theme:
   - shows the homepage automatically (front-page.php), and
   - auto-creates an "About" page using the "About Page" template.
   The About page is then live at /about/.

== Set up the booking ==
The Hero / Contact / About CTA embed Cal.com using calLink "amatec/meeting".
Edit the data-cal-link attribute in:
  template-parts/home/contact.php  and  template-parts/about/cta.php
to your own Cal.com event link if different.

== Logo ==
Appearance → Customize → Site Identity → Logo. If no logo is set, an "amatec"
wordmark is shown.

== Replace placeholder photos (optional) ==
The testimonial and founder portraits show a branded placeholder until you add:
  assets/img/testimonial-nicholas-baron.jpg
  assets/img/founder-anirban-sinha.jpg

== Fonts & icons ==
Fonts (Sora, IBM Plex Sans, IBM Plex Mono) load from Google Fonts.
Icons load from the Lucide CDN (unpkg). Both require outbound internet on the
front end; self-host them later if you prefer no third-party requests.
