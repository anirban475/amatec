<?php
/**
 * Multi Vendor SKU — the problem (Hex Bolt example) + vendor-code card.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$problem = amatec_mvs()['problem'];
$pains   = $problem['pains'];
$codes   = array(
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
					<?php echo esc_html( $problem['lead'] ); ?>
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
					<span><?php echo esc_html( $problem['note'] ); ?></span>
				</div>
			</div>

		</div>
	</div>
</section>
