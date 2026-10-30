<?php
/**
 * Multi Vendor SKU — the problem (Hex Bolt example) + vendor-code card.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$pains = array(
	array( 't' => 'A spreadsheet on the side', 'd' => 'Buyers keep the vendor codes in a sheet outside Zoho and look them up for every order.' ),
	array( 't' => 'Codes typed by hand', 'd' => 'Each purchase order line gets the vendor\'s code typed in, one line at a time.' ),
	array( 't' => 'Bills matched by eye', 'd' => 'When the vendor\'s bill arrives, someone reads each line and works out which of your items it is.' ),
);
$codes = array(
	array( 'who' => 'One vendor', 'sku' => 'SHK-1000' ),
	array( 'who' => 'Another vendor', 'sku' => 'BB-77' ),
);
?>
<section id="mvs-problem" class="section" style="background:var(--bg-subtle);">
	<div class="wrap">
		<div class="prod-overview-grid">

			<div>
				<div class="eyebrow"><?php esc_html_e( 'THE PROBLEM', 'amatec' ); ?></div>
				<h2 class="h2" style="margin-top:14px;"><?php esc_html_e( 'Your vendors use their own codes for your items', 'amatec' ); ?></h2>
				<p class="lead" style="margin-top:18px;">
					<?php esc_html_e( 'Your item "Hex Bolt M8x40" is "SHK-1000" at one vendor and "BB-77" at another. Zoho Inventory stores one SKU per item, so the vendor codes have nowhere to go.', 'amatec' ); ?>
				</p>
				<ul class="prod-benefits mvs-pains">
					<?php foreach ( $pains as $p ) : ?>
						<li>
							<span class="ic"><i data-lucide="x"></i></span>
							<span>
								<span class="t"><?php echo esc_html( $p['t'] ); ?></span>
								<span class="d"><?php echo esc_html( $p['d'] ); ?></span>
							</span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="card mvs-codes">
				<div class="mvs-codes-item">
					<span class="k"><?php esc_html_e( 'Your item', 'amatec' ); ?></span>
					<span class="v">Hex Bolt M8x40</span>
				</div>
				<ul class="mvs-codes-list">
					<?php foreach ( $codes as $c ) : ?>
						<li>
							<span class="who"><i data-lucide="truck"></i><?php echo esc_html( $c['who'] ); ?></span>
							<span class="sku"><?php echo esc_html( $c['sku'] ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
				<div class="mvs-codes-note">
					<i data-lucide="info"></i>
					<span><?php esc_html_e( 'Zoho Inventory has one SKU field per item. Without the app, these codes live in a spreadsheet.', 'amatec' ); ?></span>
				</div>
			</div>

		</div>
	</div>
</section>
