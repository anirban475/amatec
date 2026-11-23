<?php
/**
 * Multi Vendor SKU — numbered flow of the app's parts inside Zoho Inventory.
 * Doubles as the flow document for the Zoho Marketplace review.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$section = amatec_mvs()['flow'];
$flow    = $section['items'];
?>
<section id="mvs-flow" class="section" style="background:var(--bg-subtle);">
	<div class="wrap" style="max-width:900px;">
		<div class="sec-head center" style="max-width:680px;">
			<div class="eyebrow"><?php echo esc_html( $section['eyebrow'] ); ?></div>
			<h2 class="h2"><?php echo esc_html( $section['h2'] ); ?></h2>
			<p class="lead"><?php echo esc_html( $section['lead'] ); ?></p>
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
