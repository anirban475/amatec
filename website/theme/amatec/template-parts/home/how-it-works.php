<?php
/**
 * Home — "How it works" interactive 4-step stepper.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$steps = array(
	array( 'n' => '01', 'icon' => 'search',    'title' => 'Map',    'heading' => 'We map the process you hate',  'body' => 'A short workflow audit. We trace every manual step, handoff and copy-paste across your current tools, and find where the hours leak.', 'meta' => 'Free workflow audit · 30 min' ),
	array( 'n' => '02', 'icon' => 'pen-tool',  'title' => 'Design', 'heading' => 'We design the automation',     'body' => 'You get a clear before/after map: which steps disappear, which systems connect, what the workflow looks like in n8n, Make, Monday or Zoho.', 'meta' => 'Automation blueprint + quote' ),
	array( 'n' => '03', 'icon' => 'zap',       'title' => 'Build',  'heading' => 'We build and connect it',       'body' => 'We wire it up in your stack (triggers, routing, enrichment, error handling) and test it against real data before anything goes live.', 'meta' => 'Go-live date agreed in the quote' ),
	array( 'n' => '04', 'icon' => 'life-buoy', 'title' => 'Run',    'heading' => 'We keep it running',            'body' => 'Monitoring, alerts and ongoing tuning. As your business changes, the workflow changes with it, with no silent breakages.', 'meta' => 'Managed support & SLAs' ),
);
?>
<section id="how-it-works" class="section how">
	<div class="wrap">
		<div class="sec-head center">
			<div class="eyebrow">HOW IT WORKS</div>
			<h2 class="h2">Four steps from busywork to autopilot</h2>
			<p class="lead">No rip-and-replace. We work with the tools you already have.</p>
		</div>
		<div class="how-grid" data-stepper>
			<div class="how-steps">
				<?php foreach ( $steps as $i => $st ) : ?>
					<button type="button" class="how-step<?php echo 0 === $i ? ' on' : ''; ?>">
						<span class="num"><?php echo esc_html( $st['n'] ); ?></span>
						<span class="ic"><i data-lucide="<?php echo esc_attr( $st['icon'] ); ?>"></i></span>
						<span class="title"><?php echo esc_html( $st['title'] ); ?></span>
					</button>
				<?php endforeach; ?>
			</div>
			<div class="card how-detail">
				<?php foreach ( $steps as $i => $st ) : ?>
					<div class="how-detail-item<?php echo 0 === $i ? ' reveal' : ''; ?>" style="<?php echo 0 === $i ? 'display:flex;' : 'display:none;'; ?>flex-direction:column;justify-content:center;">
						<span class="ic"><i data-lucide="<?php echo esc_attr( $st['icon'] ); ?>"></i></span>
						<h3 class="h2"><?php echo esc_html( $st['heading'] ); ?></h3>
						<p class="lead"><?php echo esc_html( $st['body'] ); ?></p>
						<div class="how-meta"><i data-lucide="arrow-right"></i><?php echo esc_html( $st['meta'] ); ?></div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
