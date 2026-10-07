<?php
/**
 * About — by-the-numbers strip.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$stats = array(
	array( 'fig' => '2020', 'unit' => 'since',   'label' => 'building client automations' ),
	array( 'fig' => '4', 'unit' => 'platforms',  'label' => 'Make · n8n · Zoho · Monday, certified on three' ),
	array( 'fig' => '3', 'unit' => 'continents', 'label' => 'live clients in the US, EU & Asia' ),
	array( 'fig' => '3', 'unit' => 'published apps', 'label' => 'Two on the Zoho Marketplace, one on Make' ),
);
?>
<section class="about-stats">
	<div class="wrap">
		<div class="about-stats-grid">
			<?php foreach ( $stats as $s ) : ?>
				<div class="stat">
					<div class="top">
						<span class="fig"><?php echo esc_html( $s['fig'] ); ?></span>
						<span class="unit"><?php echo esc_html( $s['unit'] ); ?></span>
					</div>
					<div class="lbl"><?php echo esc_html( $s['label'] ); ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
