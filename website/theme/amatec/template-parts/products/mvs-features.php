<?php
/**
 * Multi Vendor SKU — six feature cards with screenshots, plus the extras row.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$features = array(
	array( 'file' => '04-vendor-switch', 't' => 'SKUs switch with the vendor', 'd' => 'Pick a vendor on a new PO and its SKU appears on each line. Change the vendor and the SKUs switch to the new vendor\'s codes.' ),
	array( 'file' => '05-duplicate-block', 't' => 'Add a missing SKU from the PO', 'd' => 'Add a SKU from the PO side panel without leaving the order. The app blocks a SKU that the same vendor already uses for another item.' ),
	array( 'file' => '06-bill-paste-match', 't' => 'Match vendor bills by SKU', 'd' => 'Paste the lines from a vendor\'s bill. The app finds your items by the vendor\'s SKU, in upper or lower case, and fills the bill lines.' ),
	array( 'file' => '07-price-change-card', 't' => 'Spot a price change', 'd' => 'A card shows when a vendor\'s price differs from what you paid before.' ),
	array( 'file' => '08-bill-check', 't' => 'Check a bill against its PO', 'd' => 'On a saved bill, the Bill Check side panel checks the bill against its purchase order.' ),
	array( 'file' => '09-po-pdf-column', 't' => 'Vendor SKU on the PO PDF', 'd' => 'The vendor\'s SKU prints on the purchase order you send, so the vendor recognises every line.' ),
);
$extras = array(
	array( 'icon' => 'triangle-alert', 't' => 'Minimum order warning', 'd' => 'Warns when a PO line is below the vendor\'s minimum order quantity.' ),
	array( 'icon' => 'search', 't' => 'Search, Bulk Import and Export', 'd' => 'Find any SKU, load many at once from a CSV file, and export them all.' ),
	array( 'icon' => 'gauge', 't' => 'Usage counter', 'd' => 'Shows how many SKUs the app filled this month.' ),
);
?>
<section id="mvs-features" class="section" style="background:var(--bg-subtle);">
	<div class="wrap">
		<div class="sec-head center" style="max-width:680px;">
			<div class="eyebrow"><?php esc_html_e( 'WHAT IT DOES', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'What Multi Vendor SKU does on your POs and bills', 'amatec' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'The six features buyers use most, then three more that come with the app.', 'amatec' ); ?></p>
		</div>

		<div class="mvs-feat-grid">
			<?php foreach ( $features as $f ) : ?>
				<div class="card mvs-feat">
					<?php get_template_part( 'template-parts/products/mvs-media', null, array( 'file' => $f['file'] ) ); ?>
					<div class="body">
						<h3 class="h3"><?php echo esc_html( $f['t'] ); ?></h3>
						<p><?php echo esc_html( $f['d'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="card mvs-extras">
			<div>
				<div class="eyebrow"><?php esc_html_e( 'ALSO IN THE APP', 'amatec' ); ?></div>
				<ul class="prod-benefits">
					<?php foreach ( $extras as $x ) : ?>
						<li>
							<span class="ic"><i data-lucide="<?php echo esc_attr( $x['icon'] ); ?>"></i></span>
							<span>
								<span class="t"><?php echo esc_html( $x['t'] ); ?></span>
								<span class="d"><?php echo esc_html( $x['d'] ); ?></span>
							</span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php get_template_part( 'template-parts/products/mvs-media', null, array( 'file' => '10-search-import-export' ) ); ?>
		</div>
	</div>
</section>
