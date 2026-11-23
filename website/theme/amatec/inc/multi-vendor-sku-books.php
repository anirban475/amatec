<?php
/**
 * Multi Vendor SKU for Zoho Books: settings and page copy.
 *
 * Renders from page-multi-vendor-sku-for-zoho-books.php with the same
 * template-parts/products/mvs-*.php partials as the Zoho Inventory page (see
 * inc/multi-vendor-sku.php). Copy from the brief of 23 Nov 2026
 * (Multi-Vendor-SKU-Books-Webpage-23Nov2026.md). Media: originals in
 * mvs-media/source-books/ (project folder), built into
 * assets/media/multi-vendor-sku-books/ by mvs-media/build_media.py --books.
 *
 * Open placeholders:
 *   'price'        [PRICE] until the price is set; then also set 'offer_price'
 *                  so the schema gets an Offer.
 *   'marketplace'  the Zoho Marketplace listing URL once Zoho approves it. It
 *                  turns the main button into "Get it on Zoho Marketplace".
 *
 * @package AMATEC
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Multi Vendor SKU for Zoho Books: settings and page copy.
 *
 * @return array
 */
function amatec_mvs_books() {
	$c = array(
		'slug'           => 'multi-vendor-sku-for-zoho-books',
		'name'           => 'Multi Vendor SKU for Zoho Books',
		'zoho_app'       => 'Zoho Books extension',
		// Marketplace link slot: empty until Zoho approves the listing.
		'marketplace'    => '',
		'demo'           => 'https://cal.com/amatec/vendor-skus-setup',
		// Placeholder until the price is set. Never put a guessed number here.
		'price'          => '[PRICE]',
		// Free trial, e.g. '30 day free trial'. Fill it only if the Marketplace
		// listing has one; the price FAQ then says "with a ...".
		'trial'          => '',
		// Offer in the SoftwareApplication schema; empty = no Offer until the price is set.
		'offer_price'    => '',
		'offer_currency' => 'USD',
		'email'          => 'hello@amatec.in',
		// Demo video on YouTube (https://youtu.be/o4oe3qTwOQ0, 23 Nov 2026). The
		// Demo section shows its thumbnail and loads the player on click; the
		// page gets a VideoObject schema with the chapters below. Empty
		// 'video_id' = "Demo video coming soon" placeholder.
		'video_id'       => 'o4oe3qTwOQ0',
		'video_title'    => 'Vendor SKUs on Zoho Books Purchase Orders and Bills | Multi Vendor SKU Demo',
		'video_text'     => 'Save each vendor\'s SKU for your items once, and Multi Vendor SKU fills it on every Zoho Books purchase order and matches vendor bills by it. This video walks through the full flow, from setup to Bill Check.',
		'video_date'     => '2026-11-23T06:06:40-08:00',
		'video_duration' => 'PT5M7S',
		// Chapters from the YouTube description: start second => title.
		'video_chapters' => array(
			0   => 'Intro',
			10  => 'One item, a different code at every vendor',
			34  => 'What the extension adds to Zoho Books',
			57  => 'Install',
			82  => 'Setup from your Vendors and Bills exports',
			112 => 'Vendor SKU auto fill on purchase orders',
			132 => 'Vendor change and minimum order qty',
			151 => 'Quick add with a duplicate check',
			173 => 'Vendor SKU on the PO PDF',
			185 => 'Paste vendor invoice lines into a bill',
			215 => 'Bill Check against the purchase order',
			228 => 'Vendor SKUs module',
			240 => 'Search, bulk import and export',
			267 => 'App settings',
			281 => 'Uninstall',
		),
		'description'    => 'Save each vendor\'s SKU once. Multi Vendor SKU fills it on Zoho Books purchase orders and bills and matches vendor bills to your items.',
		'faqs'           => 'mvs-books',
		'media_dir'      => 'assets/media/multi-vendor-sku-books/',
		'og'             => 'og-multi-vendor-sku-books.jpg',
		'screenshots'    => array( 'books-01-po-autofill.webp', 'books-06-bill-paste-match-card.webp' ),
	);

	// Media list: file name => type + alt text. The -card files are 16:10
	// close-ups of the same screenshots for the feature cards.
	// Alt text from the brief (version 2, section 6).
	$c['media'] = array(
		'books-01-po-autofill'             => array( 'type' => 'screenshot', 'alt' => 'Vendor SKU SHK-1000 and vendor price filled on a Zoho Books purchase order line' ),
		'books-02-setup-drop-files'        => array( 'type' => 'screenshot', 'alt' => 'Dropping exported Vendors and Bills files into Multi Vendor SKU setup in Zoho Books' ),
		'books-03-my-sku-list'             => array( 'type' => 'screenshot', 'alt' => 'My SKU list showing items bought from each vendor with your SKU and last price' ),
		'books-04-vendor-switch-card'      => array( 'type' => 'screenshot', 'alt' => 'New vendor\'s SKU filled, Missing SKU card and minimum order warning after changing the vendor on a Zoho Books PO' ),
		'books-05-duplicate-block-card'    => array( 'type' => 'screenshot', 'alt' => 'Side panel blocking a vendor SKU that the vendor already uses for another item' ),
		'books-06-bill-paste-match'        => array( 'type' => 'screenshot', 'alt' => 'Vendor bill lines pasted and matched to items by vendor SKU in Zoho Books' ),
		'books-06-bill-paste-match-card'   => array( 'type' => 'screenshot', 'alt' => 'Vendor bill lines pasted and matched to items by vendor SKU in Zoho Books' ),
		'books-07-price-change-card'       => array( 'type' => 'screenshot', 'alt' => 'Card offering to update a vendor\'s saved price from a new bill' ),
		'books-08-bill-check-card'         => array( 'type' => 'screenshot', 'alt' => 'Bill Check panel confirming a Zoho Books bill matches its purchase order' ),
		'books-09-po-pdf-column-card'      => array( 'type' => 'screenshot', 'alt' => 'Vendor SKU column printed on a Zoho Books purchase order PDF' ),
		'books-10-search-import-export'    => array( 'type' => 'screenshot', 'alt' => 'Searching vendor SKUs in the Multi Vendor SKU tab in Zoho Books' ),
	);

	$c['hero'] = array(
		'badge'  => __( 'Zoho Books Extension', 'amatec' ),
		'h1'     => __( 'Multi Vendor SKU for', 'amatec' ),
		'accent' => __( 'Zoho Books', 'amatec' ),
		'lead'   => __( 'Multi Vendor SKU is a Zoho Books extension that fills each vendor\'s own SKU on your purchase orders and bills, built for businesses that buy the same items from several vendors.', 'amatec' ),
		'bar'    => 'books.zoho.com · purchase order',
		'file'   => 'books-01-po-autofill',
	);

	$c['answer'] = array(
		'text'  => __( 'Multi Vendor SKU for Zoho Books is an extension that stores a different SKU for each vendor you buy an item from. It fills those vendor SKUs on purchase orders and bills, so your team stops typing vendor codes by hand and stops matching vendor bills to items by eye. It runs inside Zoho Books, installs from Zoho Marketplace, and keeps every SKU in your own Zoho account.', 'amatec' ),
		'facts' => array(
			array( 'k' => 'Works with', 'v' => 'Zoho Books with purchase orders turned on, any data centre' ),
			array( 'k' => 'Install from', 'v' => 'Zoho Marketplace', 'href' => $c['marketplace'] ),
			array( 'k' => 'Built for', 'v' => 'Traders, small distributors, workshops, contractors and service firms that buy parts from several vendors in Zoho Books' ),
			array( 'k' => 'Your data', 'v' => 'Stays in your Zoho Books account' ),
			array( 'k' => 'Language', 'v' => 'English' ),
			array( 'k' => 'Price', 'v' => $c['price'] ),
			array( 'k' => 'Support', 'v' => $c['email'], 'href' => 'mailto:' . $c['email'] ),
			array( 'k' => 'Also by Amatec', 'v' => 'Multi Vendor SKU for Zoho Inventory', 'href' => home_url( '/' . amatec_mvs_slugs()['inventory'] . '/' ) ),
			array( 'k' => 'Custom work', 'v' => 'Zoho workflow automation', 'href' => home_url( '/zoho-workflow-automation/' ) ),
		),
	);

	$c['problem'] = array(
		'lead'  => __( 'Your item "Hex Bolt M8x40" is "SHK-1000" at one vendor and "BB-77" at another. Zoho Books stores one SKU per item, so the vendor codes have nowhere to go.', 'amatec' ),
		'pains' => array(
			array( 't' => 'A spreadsheet on the side', 'd' => 'Your team keeps vendor codes in a sheet outside Zoho Books and looks them up for every order.' ),
			array( 't' => 'Codes typed by hand', 'd' => 'Each purchase order line gets the vendor\'s code typed in, one line at a time.' ),
			array( 't' => 'Bills matched by eye', 'd' => 'When the vendor\'s bill arrives, someone reads each line and works out which of your items it is.' ),
		),
		'note'  => __( 'Zoho Books has one SKU field per item. Without the app, these codes live in a spreadsheet.', 'amatec' ),
	);

	$c['steps'] = array(
		'lead'  => __( 'You set it up once, from the purchase history already in your Zoho Books account.', 'amatec' ),
		'items' => array(
			array(
				'n'    => '01',
				't'    => 'Export two files and drop them in',
				'd'    => 'Export Vendors and Bills from Zoho Books as CSV files and drop both into setup. The app lists every item you have bought from each vendor, with your own SKU, how often you bought it and the last price you paid.',
				'file' => 'books-02-setup-drop-files',
				'bar'  => 'Vendor SKUs · setup',
			),
			array(
				'n'    => '02',
				't'    => 'Type each vendor\'s SKU once',
				'd'    => 'Type the vendor\'s SKU next to each item and click Save SKUs. Rows you have not finished stay in My SKU list until you come back to them.',
				'file' => 'books-03-my-sku-list',
				'bar'  => 'Vendor SKUs · My SKU list',
			),
			array(
				'n'    => '03',
				't'    => 'SKUs fill on every PO and bill',
				'd'    => 'Pick a vendor on a new purchase order and that vendor\'s SKU appears on each line. When the vendor\'s bill arrives, paste its lines and the app finds your items by the vendor\'s SKU.',
				'file' => 'books-06-bill-paste-match',
				'bar'  => 'Bill · Vendor SKUs panel',
			),
		),
	);

	$c['features'] = array(
		'lead'        => __( 'The six features teams use most, then three more that come with the app.', 'amatec' ),
		'items'       => array(
			array( 'file' => 'books-04-vendor-switch-card', 't' => 'SKUs switch with the vendor', 'd' => 'Pick a vendor on a new PO and its SKU appears on each line. Change the vendor and the SKUs switch to the new vendor\'s codes.' ),
			array( 'file' => 'books-05-duplicate-block-card', 't' => 'Add a missing SKU from the PO', 'd' => 'Add a SKU from the PO side panel without leaving the order. The app blocks a SKU that the same vendor already uses for another item.' ),
			array( 'file' => 'books-06-bill-paste-match-card', 't' => 'Match vendor bills by SKU', 'd' => 'Paste the lines from a vendor\'s bill. The app finds your items by the vendor\'s SKU, in upper or lower case, and fills the bill lines.' ),
			array( 'file' => 'books-07-price-change-card', 't' => 'Spot a price change', 'd' => 'When a bill\'s rate differs from the price saved for that vendor, a card offers to update the saved price in one click.' ),
			array( 'file' => 'books-08-bill-check-card', 't' => 'Check a bill against its PO', 'd' => 'On a saved bill, the Bill Check side panel compares every line, quantity and rate with its purchase order.' ),
			array( 'file' => 'books-09-po-pdf-column-card', 't' => 'Vendor SKU on the PO PDF', 'd' => 'The vendor\'s SKU prints on the purchase order you send, so the vendor recognises every line.' ),
		),
		'extras'      => array(
			array( 'icon' => 'triangle-alert', 't' => 'Minimum order warning', 'd' => 'Warns when a PO line is below the vendor\'s minimum order quantity. You set minimum orders with Bulk Import.' ),
			array( 'icon' => 'search', 't' => 'Search, Bulk Import and Export', 'd' => 'Find any SKU, load many at once from a CSV file, and export them all.' ),
			array( 'icon' => 'gauge', 't' => 'Usage counter', 'd' => 'Shows how many SKUs the app filled this month.' ),
		),
		'extras_file' => 'books-10-search-import-export',
	);

	$c['compare'] = array(
		'h2'   => __( 'Buying in Zoho Books with and without Multi Vendor SKU', 'amatec' ),
		'rows' => array(
			array( 'task' => 'Vendor codes on a PO', 'before' => 'Looked up in a spreadsheet and typed on each line', 'after' => 'Filled on each line when you pick the vendor' ),
			array( 'task' => 'Changing the vendor on a PO', 'before' => 'Every code retyped for the new vendor', 'after' => 'The SKUs switch to the new vendor\'s codes' ),
			array( 'task' => 'Matching a vendor\'s bill', 'before' => 'Each line matched to an item by eye', 'after' => 'Paste the bill lines and the app finds your items by vendor SKU' ),
			array( 'task' => 'Where vendor codes are kept', 'before' => 'A spreadsheet outside Zoho', 'after' => 'A Vendor SKUs module in your own Zoho Books account' ),
			array( 'task' => 'Getting the right item', 'before' => 'The vendor reads your item code and has to work out which of theirs you mean', 'after' => 'The vendor\'s own SKU prints on the PO PDF, so they recognise every line' ),
		),
	);

	$c['video'] = array(
		'h2'         => __( 'Watch Multi Vendor SKU in Zoho Books', 'amatec' ),
		// Lead text with the video, and while no video is set.
		'lead_video' => __( 'A five minute walkthrough of the full flow, from setup to Bill Check.', 'amatec' ),
		'lead_empty' => __( 'A short walkthrough of the full flow, from setup to matching vendor bills.', 'amatec' ),
		'bar'        => 'books.zoho.com · multi-vendor-sku',
	);

	// Doubles as the flow document for the Zoho Marketplace review.
	$c['flow'] = array(
		'eyebrow' => __( 'INSIDE ZOHO BOOKS', 'amatec' ),
		'h2'      => __( 'How Multi Vendor SKU works inside Zoho Books', 'amatec' ),
		'lead'    => __( 'The parts of the app, in the order you meet them. Each one runs inside your Zoho Books account.', 'amatec' ),
		'items'   => array(
			array( 'icon' => 'download', 't' => 'Install from Zoho Marketplace', 'd' => 'You install Multi Vendor SKU in Zoho Books from Zoho Marketplace and authorize one Zoho Books connection.' ),
			array( 'icon' => 'layout-list', 't' => 'Vendor SKUs tab', 'd' => 'The app\'s own tab in Zoho Books. Run the guided setup here, work through My SKU list, change app settings, and search, import or export your SKUs.' ),
			array( 'icon' => 'database', 't' => 'Vendor SKUs module', 'd' => 'Every SKU you save is a record in a custom module called Vendor SKUs, inside your own Zoho Books account.' ),
			array( 'icon' => 'tag', 't' => 'Vendor SKU item field', 'd' => 'A custom item field called Vendor SKU. It shows on purchase order lines and prints on the PO PDF.' ),
			array( 'icon' => 'shopping-cart', 't' => 'Purchase order side panel', 'd' => 'Pick a vendor on a purchase order and each line gets that vendor\'s SKU. Add a missing SKU from the side panel. The app warns when a line is below the vendor\'s minimum order quantity.' ),
			array( 'icon' => 'receipt', 't' => 'Bill side panel', 'd' => 'Paste the lines from the vendor\'s bill. The app finds your items by vendor SKU, fills the bill lines and adds the vendor\'s own item name to the description. A price change card shows when the bill\'s rate differs from the price saved for that vendor.' ),
			array( 'icon' => 'clipboard-check', 't' => 'Bill Check panel', 'd' => 'On a saved bill, the Bill Check panel compares every line, quantity and rate with the linked purchase order.' ),
			array( 'icon' => 'undo-2', 't' => 'Uninstall', 'd' => 'Remove the extension from Zoho Books settings. Export your SKUs to CSV first if you want to keep a copy.' ),
		),
	);

	// "Your data" section (template-parts/products/mvs-data.php).
	$c['data'] = array(
		'eyebrow' => __( 'YOUR DATA', 'amatec' ),
		'h2'      => __( 'Where your data lives', 'amatec' ),
		'items'   => array(
			array( 'icon' => 'database', 'd' => 'Every vendor SKU is stored in your own Zoho Books account, in the Vendor SKUs module.' ),
			array( 'icon' => 'lock', 'd' => 'The app reads your items, vendors, purchase orders and bills inside Zoho to do its job. It does not copy them out of Zoho.' ),
			array( 'icon' => 'send', 'd' => 'On install and uninstall only, the app sends Amatec your organization ID, organization name, the installer\'s email (install only), the date and the app version. We use it to send one setup guide email, give support and manage the subscription.' ),
			array(
				'icon'   => 'file-text',
				'd'      => 'Full details:',
				'link'   => 'Privacy Policy, section 07 Zoho Marketplace apps',
				'href'   => home_url( '/privacypolicy/#zoho-apps' ),
			),
		),
	);

	$c['cta'] = array(
		'text_marketplace' => __( 'Install Multi Vendor SKU from Zoho Marketplace, or talk to the team that built it about your purchasing process in Zoho.', 'amatec' ),
		'text_demo'        => __( 'Book a demo to see Multi Vendor SKU in Zoho Books, or talk to the team that built it about your purchasing process in Zoho.', 'amatec' ),
		'assures'          => array(
			array( 'icon' => 'puzzle', 't' => 'Runs inside Zoho Books' ),
			array( 'icon' => 'database', 't' => 'Your SKUs stay in your Zoho account' ),
			array( 'icon' => 'life-buoy', 't' => 'Support from the team that built it' ),
		),
	);

	return $c;
}
