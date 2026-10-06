<?php
/**
 * Make.com hero — centered copy, Advanced Certified badge, animated scenario canvas.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$modules = array(
	array( 'x' => 46, 'y' => 158, 'c' => '#E84393', 'icon' => 'webhook', 'label' => 'Webhook' ),
	array( 'x' => 130, 'y' => 158, 'c' => '#2D77F0', 'icon' => 'globe', 'label' => 'HTTP' ),
	array( 'x' => 212, 'y' => 158, 'c' => '#22B07D', 'icon' => 'wrench', 'label' => 'Tools' ),
	array( 'x' => 294, 'y' => 158, 'c' => '#E5484D', 'icon' => 'package', 'label' => 'Zoho' ),
	array( 'x' => 380, 'y' => 158, 'c' => '#12B886', 'icon' => 'split', 'label' => 'Router' ),
	array( 'x' => 476, 'y' => 86, 'c' => '#E5484D', 'icon' => 'package', 'label' => 'Zoho' ),
	array( 'x' => 562, 'y' => 86, 'c' => '#22B07D', 'icon' => 'list', 'label' => 'Iterator' ),
	array( 'x' => 642, 'y' => 86, 'c' => '#fff', 'icon' => 'rotate-ccw', 'label' => 'Resume', 'ring' => '#E5484D' ),
	array( 'x' => 476, 'y' => 168, 'c' => '#7A5AF5', 'icon' => 'braces', 'label' => 'JSON' ),
	array( 'x' => 562, 'y' => 168, 'c' => '#2D77F0', 'icon' => 'calendar', 'label' => 'Calendar' ),
	array( 'x' => 476, 'y' => 244, 'c' => '#E5484D', 'icon' => 'mail', 'label' => 'Email' ),
	array( 'x' => 562, 'y' => 244, 'c' => '#22B07D', 'icon' => 'check', 'label' => 'Done' ),
);
$amatec_link = function ( $x1, $y1, $x2, $y2 ) {
	$mx = ( $x1 + $x2 ) / 2;
	return "M{$x1},{$y1} C{$mx},{$y1} {$mx},{$y2} {$x2},{$y2}";
};
$links = array(
	$amatec_link( 46, 158, 130, 158 ), $amatec_link( 130, 158, 212, 158 ), $amatec_link( 212, 158, 294, 158 ), $amatec_link( 294, 158, 380, 158 ),
	$amatec_link( 380, 158, 476, 86 ), $amatec_link( 476, 86, 562, 86 ), $amatec_link( 562, 86, 642, 86 ),
	$amatec_link( 380, 158, 476, 168 ), $amatec_link( 476, 168, 562, 168 ),
	$amatec_link( 380, 158, 476, 244 ), $amatec_link( 476, 244, 562, 244 ),
);
?>
<section id="make-hero" class="lp-hero" style="text-align:center;">
	<div class="dotgrid" aria-hidden="true"></div>
	<div class="grad" aria-hidden="true"></div>
	<div class="glow" aria-hidden="true"></div>

	<div class="wrap" style="position:relative;padding-top:50px;padding-bottom:54px;">
		<div class="hero-badge reveal">
			<span class="dot orange"></span> <?php esc_html_e( 'Make.com Automation', 'amatec' ); ?>
		</div>

		<h1 class="h1 reveal" style="margin-top:20px;max-width:1040px;font-size:clamp(34px,4.4vw,54px);margin-left:auto;margin-right:auto;animation-delay:.05s;">
			<?php esc_html_e( 'Make.com automation,', 'amatec' ); ?><br>
			<?php esc_html_e( 'built by', 'amatec' ); ?> <span class="accent"><?php esc_html_e( 'certified experts', 'amatec' ); ?></span>
		</h1>

		<p class="lead reveal" style="margin-top:20px;color:var(--blue-100);max-width:720px;margin-left:auto;margin-right:auto;animation-delay:.1s;">
			<?php esc_html_e( 'We design, build, and maintain Make.com scenarios that connect your apps and run your busywork on autopilot, with the error-handling and documentation to keep them running.', 'amatec' ); ?>
		</p>

		<div class="pf-cert-badge reveal" style="animation-delay:.12s;">
			<span class="ic"><i data-lucide="shield-check"></i></span>
			<span class="txt">
				<span class="k"><?php esc_html_e( 'Make Partner', 'amatec' ); ?></span>
				<span class="v"><?php esc_html_e( 'Advanced Certified', 'amatec' ); ?></span>
			</span>
		</div>

		<div class="reveal" style="display:flex;gap:14px;margin-top:24px;justify-content:center;flex-wrap:wrap;animation-delay:.15s;">
			<a href="#contact" class="btn btn-accent"><i data-lucide="calendar-clock"></i> <?php esc_html_e( 'Book a free consultation', 'amatec' ); ?></a>
			<a href="#make-services" class="btn btn-outline-light"><i data-lucide="arrow-down"></i> <?php esc_html_e( 'See what we build', 'amatec' ); ?></a>
		</div>

		<div class="pf-canvas-card reveal" style="animation-delay:.2s;">
			<div class="bar">
				<span class="dot" style="background:var(--orange-500);"></span>
				<span class="name">order-fulfilment</span>
				<span class="run"><span class="dot success"></span> <?php esc_html_e( 'Scheduling · every 15 min', 'amatec' ); ?></span>
			</div>
			<div class="scroll">
				<div class="pf-canvas" style="width:700px;height:300px;">
					<svg viewBox="0 0 700 300" width="700" height="300" style="position:absolute;inset:0;overflow:visible;">
						<?php foreach ( $links as $i => $d ) : ?>
							<g>
								<path d="<?php echo esc_attr( $d ); ?>" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="2.5" stroke-linecap="round" stroke-dasharray="0.1 8"/>
								<circle r="3.2" fill="var(--orange-500)">
									<animateMotion dur="2.6s" begin="<?php echo esc_attr( ( $i % 5 ) * 0.4 ); ?>s" repeatCount="indefinite" path="<?php echo esc_attr( $d ); ?>"/>
								</circle>
							</g>
						<?php endforeach; ?>
					</svg>
					<?php foreach ( $modules as $m ) : ?>
						<div class="node" style="left:<?php echo (int) $m['x'] - 18; ?>px;top:<?php echo (int) $m['y'] - 18; ?>px;background:<?php echo esc_attr( $m['c'] ); ?>;border-color:<?php echo esc_attr( ! empty( $m['ring'] ) ? $m['ring'] : '#fff' ); ?>;color:<?php echo esc_attr( ! empty( $m['ring'] ) ? $m['ring'] : '#fff' ); ?>;">
							<i data-lucide="<?php echo esc_attr( $m['icon'] ); ?>"></i>
						</div>
						<span class="node-label" style="left:<?php echo (int) $m['x']; ?>px;top:<?php echo (int) $m['y'] + 24; ?>px;"><?php echo esc_html( $m['label'] ); ?></span>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>
