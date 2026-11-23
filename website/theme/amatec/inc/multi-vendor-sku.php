<?php
/**
 * Multi Vendor SKU product pages: settings, page copy, media list,
 * SoftwareApplication structured data and the page-only CSS and JS.
 *
 * Two pages, one per Zoho app, share the template-parts/products/mvs-*.php
 * partials:
 *   Zoho Inventory  page-multi-vendor-sku-for-zoho-inventory.php, settings below.
 *   Zoho Books      page-multi-vendor-sku-for-zoho-books.php, settings in
 *                   inc/multi-vendor-sku-books.php.
 * The partials hold the markup only. Every line of copy comes from
 * amatec_mvs(), which returns the settings of the page being shown. The
 * Marketplace link, the demo link, the price and the video live here only.
 *
 * Media: originals go in mvs-media/source/ (Inventory) and
 * mvs-media/source-books/ (Books), both in the project folder, and
 * mvs-media/build_media.py writes the theme's assets/media/multi-vendor-sku/
 * and assets/media/multi-vendor-sku-books/. A file dropped straight into
 * those folders under its slot name also works; see
 * template-parts/products/mvs-media.php.
 *
 * @package AMATEC
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page slug of each app.
 *
 * @return array app => slug.
 */
function amatec_mvs_slugs() {
	return array(
		'inventory' => 'multi-vendor-sku-for-zoho-inventory',
		'books'     => 'multi-vendor-sku-for-zoho-books',
	);
}

/**
 * The app whose page is being shown: 'books' on the Books page, otherwise
 * 'inventory'.
 *
 * @return string
 */
function amatec_mvs_app() {
	$slugs = amatec_mvs_slugs();
	return is_page( $slugs['books'] ) ? 'books' : 'inventory';
}

/**
 * True on either Multi Vendor SKU page.
 *
 * @return bool
 */
function amatec_mvs_is_page() {
	return is_page( array_values( amatec_mvs_slugs() ) );
}

/**
 * Settings and copy of one app's page.
 *
 * @param string $app 'inventory' or 'books'; empty = the page being shown.
 * @return array
 */
function amatec_mvs( $app = '' ) {
	static $cache = array();
	if ( '' === $app ) {
		$app = amatec_mvs_app();
	}
	if ( ! isset( $cache[ $app ] ) ) {
		$cache[ $app ] = 'books' === $app ? amatec_mvs_books() : amatec_mvs_inventory();
	}
	return $cache[ $app ];
}

/**
 * Multi Vendor SKU for Zoho Inventory: settings and page copy.
 *
 * @return array
 */
function amatec_mvs_inventory() {
	$c = array(
		'slug'           => 'multi-vendor-sku-for-zoho-inventory',
		'name'           => 'Multi Vendor SKU for Zoho Inventory',
		'zoho_app'       => 'Zoho Inventory extension',
		'marketplace'    => '',
		'demo'           => 'https://cal.com/amatec/vendor-skus-setup',
		'price'          => '$29 per organization per month',
		'trial'          => '30 day free trial',
		// Offer in the SoftwareApplication schema; leave either empty to drop it.
		'offer_price'    => '29',
		'offer_currency' => 'USD',
		'email'          => 'hello@amatec.in',
		// Demo video on YouTube; leave 'video_id' empty to show the placeholder.
		'video_id'       => 'EDrB33dqJx8',
		'video_title'    => 'Multi Vendor SKU Zoho Inventory Explainer',
		'video_text'     => 'Save each vendor\'s SKU for your items once, and Multi Vendor SKU fills it on every Zoho Inventory purchase order and bill. This video walks through the full flow, from setup to bills.',
		'video_date'     => '2026-11-22T04:57:25-08:00',
		'video_duration' => 'PT5M52S',
		// Chapters from the YouTube description: start second => title.
		'video_chapters' => array(
			0   => 'Intro',
			10  => 'One item, a different code at every vendor',
			34  => 'What the extension adds to Zoho Inventory',
			89  => 'Install',
			114 => 'Setup from your Vendors and Bills exports',
			158 => 'Vendor SKU auto fill on purchase orders',
			188 => 'Vendor change and quick add',
			214 => 'Vendor SKU on the PO PDF',
			226 => 'Matching vendor bills by vendor SKU',
			253 => 'Bill Check against the purchase order',
			264 => 'Vendor SKUs module and item view',
			280 => 'Search, delete, bulk import and export',
			303 => 'App settings',
			326 => 'Uninstall',
		),
		'description'    => 'Save each vendor\'s SKU once. Multi Vendor SKU fills it on Zoho Inventory POs and bills and matches vendor bills to your items.',
		'faqs'           => 'mvs',
		'media_dir'      => 'assets/media/multi-vendor-sku/',
		'og'             => 'og-multi-vendor-sku.jpg',
		'screenshots'    => array( '01-po-autofill.webp', '06-bill-paste-match-card.webp' ),
	);

	// Media list: file name => type + alt text.
	$c['media'] = array(
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

	$c['hero'] = array(
		'badge'  => __( 'Zoho Inventory Extension', 'amatec' ),
		'h1'     => __( 'Multi Vendor SKU for', 'amatec' ),
		'accent' => __( 'Zoho Inventory', 'amatec' ),
		'lead'   => __( 'Multi Vendor SKU is a Zoho Inventory extension that fills each vendor\'s own SKU on your purchase orders and bills, built for businesses that buy the same items from several vendors.', 'amatec' ),
		'bar'    => 'inventory.zoho.com · purchase order',
		'file'   => '01-po-autofill',
	);

	$facts = array(
		array( 'k' => 'Works with', 'v' => 'Zoho Inventory, any edition and data centre' ),
		array( 'k' => 'Install from', 'v' => 'Zoho Marketplace', 'href' => $c['marketplace'] ),
		array( 'k' => 'Built for', 'v' => 'Distributors, wholesalers, manufacturers, spare parts and industrial supply companies' ),
		array( 'k' => 'Your data', 'v' => 'Stays in your Zoho Inventory account' ),
		array( 'k' => 'Language', 'v' => 'English' ),
		array( 'k' => 'Price', 'v' => $c['price'] . ', ' . $c['trial'] ),
		array( 'k' => 'Support', 'v' => $c['email'], 'href' => 'mailto:' . $c['email'] ),
		array( 'k' => 'Also by Amatec', 'v' => 'Stock Procurement for Zoho Inventory', 'href' => home_url( '/stock-procurement-for-zoho-inventory/' ) ),
	);
	// The Books page starts as a draft; link to it only once it is published.
	$books = amatec_mvs_slugs()['books'];
	if ( amatec_page_is_live( $books ) ) {
		$facts[] = array( 'k' => 'Zoho Books version', 'v' => 'Multi Vendor SKU for Zoho Books', 'href' => home_url( '/' . $books . '/' ) );
	}
	$facts[] = array( 'k' => 'Custom work', 'v' => 'Zoho workflow automation', 'href' => home_url( '/zoho-workflow-automation/' ) );

	$c['answer'] = array(
		'text'  => __( 'Multi Vendor SKU for Zoho Inventory is an extension that stores a different SKU for each vendor you buy an item from. It fills those vendor SKUs on purchase orders and bills, so your buyers stop typing vendor codes by hand and stop matching vendor bills to items by eye. It runs inside Zoho Inventory, installs from Zoho Marketplace, and keeps every SKU in your own Zoho account.', 'amatec' ),
		'facts' => $facts,
	);

	$c['problem'] = array(
		'lead'  => __( 'Your item "Hex Bolt M8x40" is "SHK-1000" at one vendor and "BB-77" at another. Zoho Inventory stores one SKU per item, so the vendor codes have nowhere to go.', 'amatec' ),
		'pains' => array(
			array( 't' => 'A spreadsheet on the side', 'd' => 'Buyers keep the vendor codes in a sheet outside Zoho and look them up for every order.' ),
			array( 't' => 'Codes typed by hand', 'd' => 'Each purchase order line gets the vendor\'s code typed in, one line at a time.' ),
			array( 't' => 'Bills matched by eye', 'd' => 'When the vendor\'s bill arrives, someone reads each line and works out which of your items it is.' ),
		),
		'note'  => __( 'Zoho Inventory has one SKU field per item. Without the app, these codes live in a spreadsheet.', 'amatec' ),
	);

	$c['steps'] = array(
		'lead'  => __( 'You set it up once, from the purchase history already in your Zoho Inventory account.', 'amatec' ),
		'items' => array(
			array(
				'n'    => '01',
				't'    => 'Export two files and drop them in',
				'd'    => 'Export Vendors and Bills from Zoho Inventory as CSV files and drop both into setup. The app lists every item you have bought from each vendor, with how often you bought it and the last price you paid.',
				'file' => '02-setup-drop-files',
				'bar'  => 'Vendor SKUs · setup',
			),
			array(
				'n'    => '02',
				't'    => 'Type each vendor\'s SKU once',
				'd'    => 'Type the vendor\'s SKU next to each item and click Save SKUs. Rows you have not finished stay in My SKU list until you come back to them.',
				'file' => '03-my-sku-list',
				'bar'  => 'Vendor SKUs · My SKU list',
			),
			array(
				'n'    => '03',
				't'    => 'SKUs fill on every PO and bill',
				'd'    => 'Pick a vendor on a new purchase order and that vendor\'s SKU appears on each line. When the vendor\'s bill arrives, paste its lines and the app finds your items by the vendor\'s SKU.',
				'file' => '06-bill-paste-match',
				'bar'  => 'Bill · Vendor SKUs panel',
			),
		),
	);

	// Every card's media box is 16:10 (images crop from the top left), so all six cards match.
	$c['features'] = array(
		'lead'        => __( 'The six features buyers use most, then three more that come with the app.', 'amatec' ),
		'items'       => array(
			array( 'file' => '04-vendor-switch', 't' => 'SKUs switch with the vendor', 'd' => 'Pick a vendor on a new PO and its SKU appears on each line. Change the vendor and the SKUs switch to the new vendor\'s codes.' ),
			array( 'file' => '05-duplicate-block', 't' => 'Add a missing SKU from the PO', 'd' => 'Add a SKU from the PO side panel without leaving the order. The app blocks a SKU that the same vendor already uses for another item.' ),
			array( 'file' => '06-bill-paste-match-card', 't' => 'Match vendor bills by SKU', 'd' => 'Paste the lines from a vendor\'s bill. The app finds your items by the vendor\'s SKU, in upper or lower case, and fills the bill lines.' ),
			array( 'file' => '07-price-change-card', 't' => 'Spot a price change', 'd' => 'A card shows when a vendor\'s price differs from what you paid before.' ),
			array( 'file' => '08-bill-check', 't' => 'Check a bill against its PO', 'd' => 'On a saved bill, the Bill Check side panel checks the bill against its purchase order.' ),
			array( 'file' => '09-po-pdf-column', 't' => 'Vendor SKU on the PO PDF', 'd' => 'The vendor\'s SKU prints on the purchase order you send, so the vendor recognises every line.' ),
		),
		'extras'      => array(
			array( 'icon' => 'triangle-alert', 't' => 'Minimum order warning', 'd' => 'Warns when a PO line is below the vendor\'s minimum order quantity.' ),
			array( 'icon' => 'search', 't' => 'Search, Bulk Import and Export', 'd' => 'Find any SKU, load many at once from a CSV file, and export them all.' ),
			array( 'icon' => 'gauge', 't' => 'Usage counter', 'd' => 'Shows how many SKUs the app filled this month.' ),
		),
		'extras_file' => '10-search-import-export',
	);

	$c['compare'] = array(
		'h2'   => __( 'Buying with and without Multi Vendor SKU', 'amatec' ),
		'rows' => array(
			array( 'task' => 'Vendor codes on a PO', 'before' => 'Looked up in a spreadsheet and typed on each line', 'after' => 'Filled on each line when you pick the vendor' ),
			array( 'task' => 'Changing the vendor on a PO', 'before' => 'Every code retyped for the new vendor', 'after' => 'The SKUs switch to the new vendor\'s codes' ),
			array( 'task' => 'Matching a vendor\'s bill', 'before' => 'Each line matched to an item by eye', 'after' => 'Paste the bill lines and the app finds your items by vendor SKU' ),
			array( 'task' => 'Where vendor codes are kept', 'before' => 'A spreadsheet outside Zoho', 'after' => 'A Vendor SKUs module in your own Zoho Inventory account' ),
			array( 'task' => 'Getting the right item', 'before' => 'The vendor reads your item code and has to work out which of theirs you mean', 'after' => 'The vendor\'s own SKU prints on the PO PDF, so they recognise every line' ),
		),
	);

	$c['video'] = array(
		'h2'         => __( 'Watch Multi Vendor SKU in Zoho Inventory', 'amatec' ),
		// Lead text while no video is set.
		'lead_empty' => __( 'A short demo video is on the way. Until then, the steps above show each screen.', 'amatec' ),
		'bar'        => 'inventory.zoho.com · multi-vendor-sku',
	);

	$c['flow'] = array(
		'eyebrow' => __( 'INSIDE ZOHO INVENTORY', 'amatec' ),
		'h2'      => __( 'How Multi Vendor SKU works inside Zoho Inventory', 'amatec' ),
		'lead'    => __( 'The parts of the app, in the order you meet them. Each one runs inside your Zoho Inventory account.', 'amatec' ),
		'items'   => array(
			array( 'icon' => 'download', 't' => 'Install from Zoho Marketplace', 'd' => 'You install Multi Vendor SKU in Zoho Inventory from Zoho Marketplace.' ),
			array( 'icon' => 'layout-list', 't' => 'Vendor SKUs tab', 'd' => 'The app\'s own tab in Zoho Inventory. Run the guided setup here, work through My SKU list, and search, import or export your SKUs.' ),
			array( 'icon' => 'database', 't' => 'Vendor SKUs module', 'd' => 'Every SKU you save is a record in a custom module called Vendor SKUs, inside your own Zoho Inventory account.' ),
			array( 'icon' => 'tag', 't' => 'Vendor SKU item field', 'd' => 'A custom item field called Vendor SKU, also stored in your Zoho Inventory account.' ),
			array( 'icon' => 'shopping-cart', 't' => 'Purchase order side panel', 'd' => 'Pick a vendor on a purchase order and each line gets that vendor\'s SKU. Add a missing SKU from the side panel. The app warns when a line is below the vendor\'s minimum order quantity.' ),
			array( 'icon' => 'receipt', 't' => 'Bill side panel', 'd' => 'Paste the lines from the vendor\'s bill. The app finds your items by vendor SKU and fills the bill lines. A price change card shows when a price differs from what you paid before.' ),
			array( 'icon' => 'clipboard-check', 't' => 'Bill Check panel', 'd' => 'On a saved bill, the Bill Check panel checks the bill against its purchase order.' ),
		),
	);

	// No "Your data" section on this page.
	$c['data'] = array();

	$c['cta'] = array(
		'text_marketplace' => __( 'Install Multi Vendor SKU from Zoho Marketplace, or talk to the team that built it about your purchasing process in Zoho.', 'amatec' ),
		'text_demo'        => __( 'Book a demo to see Multi Vendor SKU in Zoho Inventory, or talk to the team that built it about your purchasing process in Zoho.', 'amatec' ),
		'assures'          => array(
			array( 'icon' => 'puzzle', 't' => 'Runs inside Zoho Inventory' ),
			array( 'icon' => 'database', 't' => 'Your SKUs stay in your Zoho account' ),
			array( 'icon' => 'life-buoy', 't' => 'Support from the team that built it' ),
		),
	);

	return $c;
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
 * Media list of the page being shown: file name => type + alt text.
 *
 * @return array
 */
function amatec_mvs_media() {
	return amatec_mvs()['media'];
}

/**
 * What every version of the app does, for the schema featureList.
 *
 * @return array
 */
function amatec_mvs_feature_list() {
	return array(
		'Guided setup from exported Vendors and Bills CSV files',
		'A different SKU for each vendor of an item',
		'Vendor SKUs filled on purchase orders',
		'Vendor bill lines matched to items by vendor SKU',
		'Price change card',
		'Bill Check against the purchase order',
		'Vendor SKU printed on the purchase order PDF',
		'Search, Bulk Import and Export',
	);
}

/**
 * SoftwareApplication JSON-LD in the head of a Multi Vendor SKU page.
 * Yoast already prints WebPage and BreadcrumbList; the FAQPage block comes
 * from template-parts/landing/faq.php.
 */
function amatec_mvs_schema() {
	if ( ! amatec_mvs_is_page() ) {
		return;
	}
	$mvs  = amatec_mvs();
	$home = home_url( '/' );
	$dir  = $mvs['media_dir'];
	$data = array(
		'@context'            => 'https://schema.org',
		'@type'               => 'SoftwareApplication',
		'name'                => $mvs['name'],
		'alternateName'       => 'Multi Vendor SKU',
		'applicationCategory' => 'BusinessApplication',
		'applicationSubCategory' => $mvs['zoho_app'],
		'operatingSystem'     => 'Web',
		'url'                 => home_url( '/' . $mvs['slug'] . '/' ),
		'description'         => $mvs['description'],
		'image'               => get_theme_file_uri( $dir . $mvs['og'] ),
		'screenshot'          => array_map(
			function ( $file ) use ( $dir ) {
				return get_theme_file_uri( $dir . $file );
			},
			$mvs['screenshots']
		),
		'inLanguage'          => 'en',
		'featureList'         => amatec_mvs_feature_list(),
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
			'description'   => implode( ', ', array_filter( array( $mvs['price'], $mvs['trial'] ) ) ),
		);
	}
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";

	if ( '' === $mvs['video_id'] ) {
		return;
	}
	$id     = $mvs['video_id'];
	$watch  = 'https://www.youtube.com/watch?v=' . $id;
	$starts = array_keys( $mvs['video_chapters'] );
	$total  = amatec_mvs_video_seconds();
	$clips  = array();
	foreach ( $starts as $i => $start ) {
		$clips[] = array(
			'@type'       => 'Clip',
			'name'        => $mvs['video_chapters'][ $start ],
			'startOffset' => $start,
			'endOffset'   => isset( $starts[ $i + 1 ] ) ? $starts[ $i + 1 ] : $total,
			'url'         => $watch . '&t=' . $start . 's',
		);
	}
	$video = array(
		'@context'     => 'https://schema.org',
		'@type'        => 'VideoObject',
		'name'         => $mvs['video_title'],
		'description'  => $mvs['video_text'],
		'thumbnailUrl' => array(
			'https://i.ytimg.com/vi/' . $id . '/maxresdefault.jpg',
			'https://i.ytimg.com/vi/' . $id . '/hqdefault.jpg',
		),
		'uploadDate'   => $mvs['video_date'],
		'duration'     => $mvs['video_duration'],
		'embedUrl'     => 'https://www.youtube.com/embed/' . $id,
		'publisher'    => array(
			'@type' => 'Organization',
			'@id'   => $home . '#organization',
			'name'  => 'Amatec',
			'url'   => $home,
		),
	);
	if ( $clips ) {
		$video['hasPart'] = $clips;
	}
	echo '<script type="application/ld+json">' . wp_json_encode( $video, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}
add_action( 'wp_head', 'amatec_mvs_schema', 20 );

/**
 * Length of the demo video in seconds, from its ISO 8601 duration.
 *
 * @return int
 */
function amatec_mvs_video_seconds() {
	$m = array();
	preg_match( '/PT(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?/', amatec_mvs()['video_duration'], $m );
	return ( isset( $m[1] ) ? (int) $m[1] * 3600 : 0 ) + ( isset( $m[2] ) ? (int) $m[2] * 60 : 0 ) + ( isset( $m[3] ) ? (int) $m[3] : 0 );
}

/**
 * One-time update of the live Inventory page's Yoast title and description to
 * the values in amatec_site_pages() (theme 1.10.2). Only replaces what the
 * theme wrote when it created the page, so an edit made in the Yoast box stays.
 */
function amatec_mvs_update_seo() {
	if ( '1.10.2' === get_option( 'amatec_mvs_seo' ) ) {
		return;
	}
	$slug  = amatec_mvs( 'inventory' )['slug'];
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
 * Printed on the Multi Vendor SKU pages only, so other pages carry none of it.
 */
function amatec_mvs_zoom_style() {
	if ( ! amatec_mvs_is_page() ) {
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
.mvs-yt{overflow:hidden}
.mvs-yt .mvs-yt-thumb,.mvs-yt iframe{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border:0}
a.mvs-yt::after{content:"";position:absolute;inset:0;background:linear-gradient(rgba(6,28,48,.25),rgba(6,28,48,.55))}
a.mvs-yt .ph,a.mvs-yt .yt-tag{z-index:1}
a.mvs-yt:hover .play{transform:scale(1.06)}
a.mvs-yt .play{transition:transform var(--dur-base) var(--ease-standard)}
a.mvs-yt .play svg{transform:translateX(2px)}
</style>
	<?php
}
add_action( 'wp_head', 'amatec_mvs_zoom_style', 30 );

function amatec_mvs_zoom_script() {
	if ( ! amatec_mvs_is_page() ) {
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

/**
 * Click-to-play demo video: the page shows only the YouTube thumbnail, and the
 * player (youtube-nocookie.com) loads when someone clicks, so the video costs
 * nothing until then. Without JavaScript the link opens the video on YouTube.
 */
function amatec_mvs_video_script() {
	if ( ! amatec_mvs_is_page() || '' === amatec_mvs()['video_id'] ) {
		return;
	}
	?>
<script id="mvs-video-js">
(function () {
  Array.prototype.slice.call(document.querySelectorAll('a.mvs-yt[data-yt]')).forEach(function (a) {
    a.addEventListener('click', function (e) {
      e.preventDefault();
      var f = document.createElement('iframe');
      f.src = 'https://www.youtube-nocookie.com/embed/' + a.getAttribute('data-yt') + '?autoplay=1&rel=0&playsinline=1';
      f.title = a.getAttribute('data-title') || '';
      f.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
      f.referrerPolicy = 'strict-origin-when-cross-origin';
      f.allowFullscreen = true;
      var box = document.createElement('div');
      box.className = 'media yt mvs-yt';
      box.appendChild(f);
      a.parentNode.replaceChild(box, a);
      f.focus();
    });
  });
})();
</script>
	<?php
}
add_action( 'wp_footer', 'amatec_mvs_video_script', 30 );
