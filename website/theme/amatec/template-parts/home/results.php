<?php
/**
 * Home — results: dark stats band.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$stats = array(
	array( 'fig' => '40+',  'unit' => 'hrs / month',   'label' => 'saved per workflow, on average' ),
	array( 'fig' => '3→1',  'unit' => 'systems',       'label' => 'disconnected tools, one workflow' ),
	array( 'fig' => '2 wks','unit' => 'typical',       'label' => 'from audit to live automation' ),
	array( 'fig' => '0',    'unit' => 'rip & replace', 'label' => 'we build on your current stack' ),
);
?>
<section id="results" class="results">
	<div class="dotgrid"></div>
	<div class="wrap section inner">
		<div class="sec-head on-dark">
			<div class="eyebrow on-dark">RESULTS</div>
			<h2 class="h2">Fewer manual steps. Measurable hours back.</h2>
			<p class="lead">What an AMATEC automation typically returns to a team.</p>
		</div>
		<div class="stats-grid">
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
