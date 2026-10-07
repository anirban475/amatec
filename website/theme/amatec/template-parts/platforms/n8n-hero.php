<?php
/**
 * n8n hero — centered copy, security badges, n8n-style workflow canvas
 * (square nodes, side ports, curved wires with travelling dots).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$s     = 58; // node size
$nodes = array(
	array( 'x' => 30, 'y' => 96, 'c' => '#2D77F0', 'icon' => 'clock', 'label' => 'Daily 8AM', 'trigger' => true, 'out' => 'single' ),
	array( 'x' => 200, 'y' => 96, 'c' => '#2D77F0', 'icon' => 'globe', 'label' => 'List Campaigns', 'sub' => 'POST /campaigns', 'out' => 'single' ),
	array( 'x' => 370, 'y' => 96, 'c' => '#12B886', 'icon' => 'repeat', 'label' => 'Loop Campaigns', 'out' => 'fork' ),
	array( 'x' => 548, 'y' => 30, 'c' => '#22B07D', 'icon' => 'check', 'label' => 'All Done' ),
	array( 'x' => 548, 'y' => 160, 'c' => '#2D77F0', 'icon' => 'globe', 'label' => 'Get Analytics', 'sub' => 'GET /analytics', 'badge' => true, 'out' => 'single' ),
	array( 'x' => 706, 'y' => 160, 'c' => '#0F9D58', 'icon' => 'table-2', 'label' => 'Update Sheet', 'badge' => true ),
);
$mid   = function ( $n ) use ( $s ) { return $n['y'] + $s / 2; };
$curve = function ( $x1, $y1, $x2, $y2 ) {
	$a = $x1 + 40;
	$b = $x2 - 40;
	return "M{$x1},{$y1} C{$a},{$y1} {$b},{$y2} {$x2},{$y2}";
};
$wires = array(
	$curve( $nodes[0]['x'] + $s, $mid( $nodes[0] ), $nodes[1]['x'], $mid( $nodes[1] ) ),
	$curve( $nodes[1]['x'] + $s, $mid( $nodes[1] ), $nodes[2]['x'], $mid( $nodes[2] ) ),
	$curve( $nodes[2]['x'] + $s, $nodes[2]['y'] + 18, $nodes[3]['x'], $mid( $nodes[3] ) ),
	$curve( $nodes[2]['x'] + $s, $nodes[2]['y'] + 40, $nodes[4]['x'], $mid( $nodes[4] ) ),
	$curve( $nodes[4]['x'] + $s, $mid( $nodes[4] ), $nodes[5]['x'], $mid( $nodes[5] ) ),
);
$badges = array( 'Self-hosted', 'Fair-code', 'Your data stays on your servers' );
?>
<section id="n8n-hero" class="lp-hero" style="text-align:center;">
	<div class="dotgrid" aria-hidden="true"></div>
	<div class="grad" aria-hidden="true"></div>
	<div class="glow" aria-hidden="true"></div>

	<div class="wrap" style="position:relative;padding-top:50px;padding-bottom:54px;">
		<div class="hero-badge reveal">
			<span class="dot orange"></span> <?php esc_html_e( 'n8n Workflow Automation', 'amatec' ); ?>
		</div>

		<h1 class="h1 reveal" style="margin-top:20px;max-width:1040px;font-size:clamp(34px,4.4vw,54px);margin-left:auto;margin-right:auto;animation-delay:.05s;">
			<?php esc_html_e( 'Secure, self-hosted automation', 'amatec' ); ?><br>
			<?php esc_html_e( 'with', 'amatec' ); ?> <span class="accent">n8n</span>
		</h1>

		<p class="lead reveal" style="margin-top:20px;color:var(--blue-100);max-width:720px;margin-left:auto;margin-right:auto;animation-delay:.1s;">
			<?php esc_html_e( 'n8n is a fair-code automation platform you can run on your own server. We set it up, build the workflows and keep them running, so sensitive data never passes through a third-party automation service.', 'amatec' ); ?>
		</p>

		<div class="ai-badges reveal" style="justify-content:center;animation-delay:.12s;">
			<?php foreach ( $badges as $b ) : ?>
				<span class="lp-chip"><i data-lucide="check"></i><?php echo esc_html( $b ); ?></span>
			<?php endforeach; ?>
		</div>

		<div class="reveal" style="display:flex;gap:14px;margin-top:24px;justify-content:center;flex-wrap:wrap;animation-delay:.15s;">
			<a href="#contact" class="btn btn-accent"><i data-lucide="calendar-clock"></i> <?php esc_html_e( 'Book a free consultation', 'amatec' ); ?></a>
			<a href="#n8n-services" class="btn btn-outline-light"><i data-lucide="arrow-down"></i> <?php esc_html_e( 'See what we build', 'amatec' ); ?></a>
		</div>

		<div class="pf-canvas-card reveal" style="animation-delay:.2s;">
			<div class="bar">
				<span class="dot" style="background:var(--orange-500);"></span>
				<span class="name">orders.workflow</span>
				<span class="run"><span class="dot success"></span> <?php esc_html_e( 'Self-hosted · active', 'amatec' ); ?></span>
			</div>
			<div class="scroll">
				<div class="pf-canvas" style="width:820px;height:256px;background-size:20px 20px;background-position:4px 4px;">
					<svg viewBox="0 0 820 256" width="820" height="256" style="position:absolute;inset:0;overflow:visible;">
						<?php foreach ( $wires as $i => $d ) : ?>
							<g>
								<path d="<?php echo esc_attr( $d ); ?>" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="2" stroke-linecap="round"/>
								<circle r="3.2" fill="var(--orange-500)">
									<animateMotion dur="2.4s" begin="<?php echo esc_attr( $i * 0.4 ); ?>s" repeatCount="indefinite" path="<?php echo esc_attr( $d ); ?>"/>
								</circle>
							</g>
						<?php endforeach; ?>
						<?php foreach ( $nodes as $i => $n ) : ?>
							<?php
							$ports = array();
							if ( 0 !== $i ) { $ports[] = array( $n['x'], $n['y'] + $s / 2 ); }
							if ( isset( $n['out'] ) && 'single' === $n['out'] ) { $ports[] = array( $n['x'] + $s, $n['y'] + $s / 2 ); }
							if ( isset( $n['out'] ) && 'fork' === $n['out'] ) { $ports[] = array( $n['x'] + $s, $n['y'] + 18 ); $ports[] = array( $n['x'] + $s, $n['y'] + 40 ); }
							foreach ( $ports as $p ) :
								?>
								<circle cx="<?php echo esc_attr( $p[0] ); ?>" cy="<?php echo esc_attr( $p[1] ); ?>" r="3.4" fill="var(--blue-950)" stroke="rgba(255,255,255,0.45)" stroke-width="1.4"/>
							<?php endforeach; ?>
						<?php endforeach; ?>
					</svg>
					<?php foreach ( $nodes as $n ) : ?>
						<?php if ( ! empty( $n['trigger'] ) ) : ?>
							<span style="position:absolute;left:<?php echo (int) $n['x'] - 17; ?>px;top:<?php echo (int) ( $n['y'] + $s / 2 - 8 ); ?>px;color:var(--orange-400);"><i data-lucide="zap" style="width:15px;height:15px;"></i></span>
						<?php endif; ?>
						<div class="n8n-node" style="left:<?php echo (int) $n['x']; ?>px;top:<?php echo (int) $n['y']; ?>px;">
							<i data-lucide="<?php echo esc_attr( $n['icon'] ); ?>" style="color:<?php echo esc_attr( $n['c'] ); ?>;"></i>
							<?php if ( ! empty( $n['badge'] ) ) : ?>
								<span class="retry"><i data-lucide="refresh-cw"></i></span>
							<?php endif; ?>
						</div>
						<span class="n8n-label" style="left:<?php echo (int) ( $n['x'] + $s / 2 ); ?>px;top:<?php echo (int) ( $n['y'] + $s + 8 ); ?>px;"><?php echo esc_html( $n['label'] ); ?></span>
						<?php if ( ! empty( $n['sub'] ) ) : ?>
							<span class="n8n-sub" style="left:<?php echo (int) ( $n['x'] + $s / 2 ); ?>px;top:<?php echo (int) ( $n['y'] + $s + 24 ); ?>px;"><?php echo esc_html( $n['sub'] ); ?></span>
						<?php endif; ?>
						<?php if ( isset( $n['out'] ) && 'fork' === $n['out'] ) : ?>
							<span class="n8n-port-lbl" style="left:<?php echo (int) ( $n['x'] + $s + 9 ); ?>px;top:<?php echo (int) ( $n['y'] + 11 ); ?>px;">done</span>
							<span class="n8n-port-lbl" style="left:<?php echo (int) ( $n['x'] + $s + 9 ); ?>px;top:<?php echo (int) ( $n['y'] + 33 ); ?>px;">loop</span>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>
