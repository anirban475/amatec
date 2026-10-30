<?php
/**
 * Multi Vendor SKU for Zoho Inventory — page settings, media list and
 * SoftwareApplication structured data.
 *
 * The page renders from page-multi-vendor-sku-for-zoho-inventory.php and the
 * template-parts/products/mvs-*.php partials. Placeholders that Anirban fills
 * later (Marketplace link, price) live here only.
 *
 * Media: drop files into assets/media/multi-vendor-sku/ using the names below.
 * Screenshots as {name}.webp; animations as {name}.mp4 and/or {name}.webm with
 * a {name}.webp poster. Until a file exists the slot shows a grey placeholder.
 *
 * @package AMATEC
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page settings. Replace the placeholders before publishing.
 *
 * @return array
 */
function amatec_mvs() {
	return array(
		'slug'           => 'multi-vendor-sku-for-zoho-inventory',
		'name'           => 'Multi Vendor SKU for Zoho Inventory',
		'marketplace'    => '#marketplace-link',
		'price'          => '[PRICE]',
		// Set both to add an Offer to the SoftwareApplication schema, e.g. '9' and 'USD'.
		'offer_price'    => '',
		'offer_currency' => '',
		'email'          => 'hello@amatec.in',
		'description'    => 'Save each vendor\'s SKU for your items once. Multi Vendor SKU fills them on purchase orders and bills in Zoho Inventory and matches vendor bills back to your items.',
	);
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
		'03-my-sku-list'          => array( 'type' => 'screenshot', 'alt' => 'My SKU list showing items bought from each vendor with last price' ),
		'04-vendor-switch'        => array( 'type' => 'animation', 'alt' => 'Vendor SKUs switching when the vendor is changed on a purchase order' ),
		'05-duplicate-block'      => array( 'type' => 'screenshot', 'alt' => 'Warning that a vendor already uses this SKU for another item' ),
		'06-bill-paste-match'     => array( 'type' => 'animation', 'alt' => 'Pasting vendor bill lines and matching them to items by vendor SKU' ),
		'07-price-change-card'    => array( 'type' => 'screenshot', 'alt' => 'Price change card showing a vendor price different from last time' ),
		'08-bill-check'           => array( 'type' => 'screenshot', 'alt' => 'Bill Check panel on a saved bill in Zoho Inventory' ),
		'09-po-pdf-column'        => array( 'type' => 'screenshot', 'alt' => 'Vendor SKU column printed on a purchase order PDF' ),
		'10-search-import-export' => array( 'type' => 'screenshot', 'alt' => 'Search, Bulk Import and Export tabs in Multi Vendor SKU' ),
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
		);
	}
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}
add_action( 'wp_head', 'amatec_mvs_schema', 20 );
