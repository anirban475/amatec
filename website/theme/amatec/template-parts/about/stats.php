<?php
/**
 * About — by-the-numbers strip.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$stats = array(
	array( 'fig' => '9', 'unit' => 'years',      'label' => 'doing nothing but automation' ),
	array( 'fig' => '4', 'unit' => 'platforms',  'label' => 'certified: Make · n8n · Zoho · Monday' ),
	array( 'fig' => '3', 'unit' => 'continents', 'label' => 'live clients in the US, EU & Asia' ),
	array( 'fig' => '1', 'unit' => 'public app', 'label' => 'Make.com app published (Aurora Solar)' ),
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
