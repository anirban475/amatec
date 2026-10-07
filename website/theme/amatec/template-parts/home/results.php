<?php
/**
 * Home — results: dark stats band.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$stats = array(
	array( 'fig' => '2020', 'unit' => 'since',         'label' => 'building client automations' ),
	array( 'fig' => '4',    'unit' => 'platforms',     'label' => 'Make.com, n8n, Zoho and monday.com' ),
	array( 'fig' => '3',    'unit' => 'published apps','label' => 'two on the Zoho Marketplace, one on Make' ),
	array( 'fig' => '0',    'unit' => 'rip & replace', 'label' => 'we build on your current stack' ),
);
?>
<section id="results" class="results">
	<div class="dotgrid"></div>
	<div class="wrap section inner">
		<div class="sec-head on-dark">
			<div class="eyebrow on-dark">RESULTS</div>
			<h2 class="h2">The track record, in four numbers</h2>
			<p class="lead">Every number here can be checked on a marketplace listing or a client reference.</p>
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
