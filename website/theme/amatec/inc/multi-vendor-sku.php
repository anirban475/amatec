<?php
/**
 * Multi Vendor SKU for Zoho Inventory — page settings, media list and
 * SoftwareApplication structured data.
 *
 * The page renders from page-multi-vendor-sku-for-zoho-inventory.php and the
 * template-parts/products/mvs-*.php partials. The Marketplace link, the demo
 * link and the price live here only.
 *
 * Media: originals go in mvs-media/source/ (project folder) and
 * mvs-media/build_media.py writes assets/media/multi-vendor-sku/. A file
 * dropped straight into that folder under its slot name also works; see
 * template-parts/products/mvs-media.php.
 *
 * @package AMATEC
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page settings.
 *
 * @return array
 */
function amatec_mvs() {
	return array(
		'slug'           => 'multi-vendor-sku-for-zoho-inventory',
		'name'           => 'Multi Vendor SKU for Zoho Inventory',
		'marketplace'    => '',
		'demo'           => 'https://cal.com/amatec/vendor-skus-setup',
		'price'          => '$29 per organization per month',
		'trial'          => '30 day free trial',
		// Offer in the SoftwareApplication schema; leave either empty to drop it.
		'offer_price'    => '29',
		'offer_currency' => 'USD',
		'email'          => 'hello@amatec.in',
		'description'    => 'Save each vendor\'s SKU once. Multi Vendor SKU fills it on Zoho Inventory POs and bills and matches vendor bills to your items.',
	);
}

/**
 * The main button in the hero and the closing band: the Marketplace listing
 * when amatec_mvs()['marketplace'] is set, otherwise a demo booking.
 *
 * @return array href, label, icon.
 */
function amatec_mvs_primary_cta() {
	$mvs = amatec_mvs();
	if ( '' !== $mvs['marketplace'] ) {
		return array( 'href' => $mvs['marketplace'], 'label' => __( 'Get it on Zoho Marketplace', 'amatec' ), 'icon' => 'external-link' );
	}
	return array( 'href' => $mvs['demo'], 'label' => __( 'Book a demo', 'amatec' ), 'icon' => 'calendar-check' );
}

/**
 * Media list: file name => type + alt text (brief section 8).
 *
 * @return array
 */
function amatec_mvs_media() {
	return array(
		'01-po-autofill'          => array( 'type' => 'animation', 'alt' => 'Vendor SKUs filling in automatically on a Zoho Inventory purchase order' ),
		'02-setup-drop-files'     => array( 'type' => 'animation', 'alt' => 'Dropping exported Vendors and Bills files into Multi Vendor SKU setup' ),
		'03-my-sku-list'          => array( 'type' => 'animation', 'alt' => 'My SKU list showing items bought from each vendor with last price' ),
		'04-vendor-switch'        => array( 'type' => 'animation', 'alt' => 'Vendor SKUs switching when the vendor is changed on a purchase order' ),
		'05-duplicate-block'      => array( 'type' => 'screenshot', 'alt' => 'Warning that a vendor already uses this SKU for another item' ),
		'06-bill-paste-match'     => array( 'type' => 'animation', 'alt' => 'Pasting vendor bill lines and matching them to items by vendor SKU' ),
		// Close-up of the same screen for the 16:10 feature card.
		'06-bill-paste-match-card' => array( 'type' => 'screenshot', 'alt' => 'Pasting vendor bill lines and matching them to items by vendor SKU' ),
		'07-price-change-card'    => array( 'type' => 'screenshot', 'alt' => 'Price change card showing a vendor price different from last time' ),
		'08-bill-check'           => array( 'type' => 'screenshot', 'alt' => 'Bill Check panel on a saved bill in Zoho Inventory' ),
		'09-po-pdf-column'        => array( 'type' => 'screenshot', 'alt' => 'Vendor SKU column printed on a purchase order PDF' ),
		'10-search-import-export' => array( 'type' => 'animation', 'alt' => 'Search, Bulk Import and Export tabs in Multi Vendor SKU' ),
	);
}

/**
 * SoftwareApplication JSON-LD in the head of the Multi Vendor SKU page.
 * Yoast already prints WebPage and BreadcrumbList; the FAQPage block comes
 * from template-parts/landing/faq.php.
 */
function amatec_mvs_schema() {
	$mvs = amatec_mvs();
	if ( ! is_page( $mvs['slug'] ) ) {
		return;
	}
	$home = home_url( '/' );
	$data = array(
		'@context'            => 'https://schema.org',
		'@type'               => 'SoftwareApplication',
		'name'                => $mvs['name'],
		'alternateName'       => 'Multi Vendor SKU',
		'applicationCategory' => 'BusinessApplication',
		'applicationSubCategory' => 'Zoho Inventory extension',
		'operatingSystem'     => 'Web',
		'url'                 => home_url( '/' . $mvs['slug'] . '/' ),
		'description'         => $mvs['description'],
		'image'               => get_theme_file_uri( 'assets/media/multi-vendor-sku/og-multi-vendor-sku.jpg' ),
		'screenshot'          => array(
			get_theme_file_uri( 'assets/media/multi-vendor-sku/01-po-autofill.webp' ),
			get_theme_file_uri( 'assets/media/multi-vendor-sku/06-bill-paste-match-card.webp' ),
		),
		'inLanguage'          => 'en',
		'featureList'         => array(
			'Guided setup from exported Vendors and Bills CSV files',
			'A different SKU for each vendor of an item',
			'Vendor SKUs filled on purchase orders',
			'Vendor bill lines matched to items by vendor SKU',
			'Price change card',
			'Bill Check against the purchase order',
			'Vendor SKU printed on the purchase order PDF',
			'Search, Bulk Import and Export',
		),
		'publisher'           => array(
			'@type' => 'Organization',
			'@id'   => $home . '#organization',
			'name'  => 'Amatec',
			'url'   => $home,
		),
	);
	if ( '' !== $mvs['offer_price'] && '' !== $mvs['offer_currency'] ) {
		$data['offers'] = array(
			'@type'         => 'Offer',
			'price'         => $mvs['offer_price'],
			'priceCurrency' => $mvs['offer_currency'],
			'description'   => $mvs['price'] . ', ' . $mvs['trial'],
		);
	}
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}
add_action( 'wp_head', 'amatec_mvs_schema', 20 );

/**
 * One-time update of the live page's Yoast title and description to the
 * values in amatec_site_pages() (theme 1.10.2). Only replaces what the theme
 * wrote when it created the page, so an edit made in the Yoast box stays.
 */
function amatec_mvs_update_seo() {
	if ( '1.10.2' === get_option( 'amatec_mvs_seo' ) ) {
		return;
	}
	$slug  = amatec_mvs()['slug'];
	$pages = amatec_site_pages();
	$page  = get_page_by_path( $slug );
	if ( $page && isset( $pages[ $slug ][2]['desc'] ) ) {
		$was     = array(
			'_yoast_wpseo_title'    => 'Multi Vendor SKU: Vendor SKUs on POs and Bills in Zoho Inventory | Amatec',
			'_yoast_wpseo_metadesc' => 'Save each vendor\'s SKU for your items once. Multi Vendor SKU fills them on purchase orders and bills in Zoho Inventory and matches vendor bills back to your items.',
		);
		$now     = array(
			'_yoast_wpseo_title'    => $pages[ $slug ][1],
			'_yoast_wpseo_metadesc' => $pages[ $slug ][2]['desc'],
		);
		$changed = false;
		foreach ( $now as $key => $value ) {
			$current = get_post_meta( $page->ID, $key, true );
			if ( '' === $current || $was[ $key ] === $current ) {
				update_post_meta( $page->ID, $key, $value );
				$changed = true;
			}
		}
		if ( $changed ) {
			// A save makes Yoast rebuild its stored SEO data for the page.
			wp_update_post( array( 'ID' => $page->ID ) );
		}
	}
	update_option( 'amatec_mvs_seo', '1.10.2' );
}
add_action( 'admin_init', 'amatec_mvs_update_seo' );

/**
 * Click-to-enlarge for the step and feature media (figures with data-zoom,
 * see template-parts/products/mvs-media.php): a native <dialog> shows the
 * full-size file and closes on Esc, a click outside it or the close button.
 * Printed on this page only, so other pages carry none of it.
 */
function amatec_mvs_zoom_style() {
	if ( ! is_page( amatec_mvs()['slug'] ) ) {
		return;
	}
	?>
<style id="mvs-zoom-css">
.mvs-media[data-zoom]{cursor:zoom-in}
.mvs-media[data-zoom]:focus-visible{outline:3px solid var(--orange-500);outline-offset:3px}
.mvs-zoom{padding:0;border:0;border-radius:14px;background:#fff;max-width:94vw;max-height:92vh;overflow:hidden;box-shadow:var(--shadow-xl)}
.mvs-zoom::backdrop{background:rgba(6,28,48,.84)}
.mvs-zoom img,.mvs-zoom video{display:block;width:auto;height:auto;max-width:94vw;max-height:92vh}
.mvs-zoom-x{position:absolute;top:10px;right:10px;width:38px;height:38px;border:0;border-radius:50%;background:rgba(6,28,48,.72);color:#fff;font-size:24px;line-height:1;cursor:pointer}
.mvs-zoom-x:focus-visible{outline:3px solid var(--orange-500);outline-offset:2px}
</style>
	<?php
}
add_action( 'wp_head', 'amatec_mvs_zoom_style', 30 );

function amatec_mvs_zoom_script() {
	if ( ! is_page( amatec_mvs()['slug'] ) ) {
		return;
	}
	?>
<script id="mvs-zoom-js">
(function () {
  var figs = Array.prototype.slice.call(document.querySelectorAll('.mvs-media[data-zoom]'));
  if (!figs.length || typeof HTMLDialogElement !== 'function') return;
  var dlg = document.createElement('dialog');
  dlg.className = 'mvs-zoom';
  dlg.innerHTML = '<button type="button" class="mvs-zoom-x" aria-label="<?php echo esc_js( __( 'Close', 'amatec' ) ); ?>">&times;</button>';
  document.body.appendChild(dlg);

  function open(fig) {
    var v = fig.querySelector('video');
    var el;
    if (v) {
      el = document.createElement('video');
      el.muted = true; el.loop = true; el.autoplay = true; el.playsInline = true;
      el.setAttribute('playsinline', '');
      el.width = v.width; el.height = v.height;
      el.poster = v.getAttribute('poster') || v.getAttribute('data-poster') || '';
      Array.prototype.slice.call(v.querySelectorAll('source')).forEach(function (s) {
        var n = document.createElement('source');
        n.src = s.getAttribute('data-src') || s.src;
        n.type = s.type;
        el.appendChild(n);
      });
    } else {
      el = document.createElement('img');
      el.src = fig.getAttribute('data-zoom');
      el.alt = (fig.querySelector('img') || {}).alt || '';
    }
    el.className = 'mvs-zoom-media';
    dlg.appendChild(el);
    dlg.setAttribute('aria-label', fig.getAttribute('aria-label') || '');
    dlg.showModal();
    if (v) { var p = el.play(); if (p && p.catch) p.catch(function () {}); }
  }

  // Removing the media on close also stops the enlarged video.
  dlg.addEventListener('close', function () {
    var m = dlg.querySelector('.mvs-zoom-media');
    if (m) dlg.removeChild(m);
  });
  // A click on the backdrop lands on the dialog itself.
  dlg.addEventListener('click', function (e) {
    if (e.target === dlg || e.target.className === 'mvs-zoom-x') dlg.close();
  });
  figs.forEach(function (f) {
    f.addEventListener('click', function () { open(f); });
    f.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); open(f); }
    });
  });
})();
</script>
	<?php
}
add_action( 'wp_footer', 'amatec_mvs_zoom_script', 30 );
