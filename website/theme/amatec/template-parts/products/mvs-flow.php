<?php
/**
 * Multi Vendor SKU — numbered flow of the app's parts inside Zoho Inventory.
 * Doubles as the flow document for the Zoho Marketplace review.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$flow = array(
	array( 'icon' => 'download', 't' => 'Install from Zoho Marketplace', 'd' => 'You install Multi Vendor SKU in Zoho Inventory from Zoho Marketplace. The app sends Amatec your organization ID, organization name, the installer\'s email, the date and the app version.' ),
	array( 'icon' => 'layout-list', 't' => 'Vendor SKUs tab', 'd' => 'The app\'s own tab in Zoho Inventory. Run the guided setup here, work through My SKU list, and search, import or export your SKUs.' ),
	array( 'icon' => 'database', 't' => 'Vendor SKUs module', 'd' => 'Every SKU you save is a record in a custom module called Vendor SKUs, inside your own Zoho Inventory account.' ),
	array( 'icon' => 'tag', 't' => 'Vendor SKU item field', 'd' => 'A custom item field called Vendor SKU, also stored in your Zoho Inventory account.' ),
	array( 'icon' => 'shopping-cart', 't' => 'Purchase order side panel', 'd' => 'Pick a vendor on a purchase order and each line gets that vendor\'s SKU. Add a missing SKU from the side panel. The app warns when a line is below the vendor\'s minimum order quantity.' ),
	array( 'icon' => 'receipt', 't' => 'Bill side panel', 'd' => 'Paste the lines from the vendor\'s bill. The app finds your items by vendor SKU and fills the bill lines. A price change card shows when a price differs from what you paid before.' ),
	array( 'icon' => 'clipboard-check', 't' => 'Bill Check panel', 'd' => 'On a saved bill, the Bill Check panel checks the bill against its purchase order.' ),
);
?>
<section id="mvs-flow" class="section" style="background:var(--bg-subtle);">
	<div class="wrap" style="max-width:900px;">
		<div class="sec-head center" style="max-width:680px;">
			<div class="eyebrow"><?php esc_html_e( 'INSIDE ZOHO INVENTORY', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'How Multi Vendor SKU works inside Zoho Inventory', 'amatec' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'The parts of the app, in the order you meet them. Each one runs inside your Zoho Inventory account.', 'amatec' ); ?></p>
		</div>

		<ol class="mvs-flow">
			<?php foreach ( $flow as $i => $f ) : ?>
				<li>
					<span class="node"><i data-lucide="<?php echo esc_attr( $f['icon'] ); ?>"></i></span>
					<div class="card body">
						<span class="num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
						<h3 class="h3"><?php echo esc_html( $f['t'] ); ?></h3>
						<p><?php echo esc_html( $f['d'] ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
