<?php
/**
 * Multi Vendor SKU — how it works in 3 steps, each with its animation or screenshot.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$steps = array(
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
);
?>
<section id="mvs-steps" class="section" style="background:var(--bg-page);scroll-margin-top:72px;">
	<div class="wrap">
		<div class="sec-head center" style="max-width:680px;">
			<div class="eyebrow"><?php esc_html_e( 'HOW IT WORKS', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'How it works, in 3 steps', 'amatec' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'You set it up once, from the purchase history already in your Zoho Inventory account.', 'amatec' ); ?></p>
		</div>

		<ol class="mvs-steps">
			<?php foreach ( $steps as $s ) : ?>
				<li class="mvs-step">
					<div class="txt">
						<span class="num"><?php echo esc_html( $s['n'] ); ?></span>
						<h3 class="h3"><?php echo esc_html( $s['t'] ); ?></h3>
						<p><?php echo esc_html( $s['d'] ); ?></p>
					</div>
					<div class="card prod-frame mvs-frame">
						<div class="bar light">
							<span class="d"></span><span class="d"></span><span class="d"></span>
							<span class="addr"><?php echo esc_html( $s['bar'] ); ?></span>
						</div>
						<?php get_template_part( 'template-parts/products/mvs-media', null, array( 'file' => $s['file'], 'ratio' => '32 / 15', 'zoom' => true, 'sizes' => '(max-width: 980px) 100vw, 640px' ) ); ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
