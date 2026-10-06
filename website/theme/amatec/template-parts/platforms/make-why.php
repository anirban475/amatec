<?php
/**
 * Make.com — Advanced Certified callout card + why-AMATEC reasons.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$reasons = array(
	array( 'icon' => 'badge-check', 't' => 'Advanced Certified expertise', 'd' => 'Our team has earned Make’s Advanced certification, so you get builders who know the platform to its edges.' ),
	array( 'icon' => 'gauge', 't' => 'Built for reliability', 'd' => 'Error handling, retries, and monitoring come standard, not as an afterthought.' ),
	array( 'icon' => 'file-text', 't' => 'Documented & yours', 'd' => 'Every scenario is clearly documented and handed over. No black boxes, no lock-in.' ),
	array( 'icon' => 'globe', 't' => 'Trusted worldwide', 'd' => 'We build for teams across the US, EU, and Asia, in industries from eCommerce to healthcare.' ),
);
?>
<section id="make-why" class="section" style="background:var(--bg-page);">
	<div class="wrap">
		<div class="pf-why-grid">

			<div class="pf-cert-card">
				<div class="dotgrid" aria-hidden="true"></div>
				<div class="inner">
					<span class="medal"><i data-lucide="shield-check"></i></span>
					<div class="k"><?php esc_html_e( 'Make Partner', 'amatec' ); ?></div>
					<div class="t"><?php esc_html_e( 'Advanced', 'amatec' ); ?><br><?php esc_html_e( 'Certified', 'amatec' ); ?></div>
					<p><?php esc_html_e( 'One of the higher tiers of Make’s partner program, earned by proven, hands-on scenario expertise.', 'amatec' ); ?></p>
				</div>
			</div>

			<div>
				<div class="eyebrow"><?php esc_html_e( 'WHY AMATEC FOR MAKE', 'amatec' ); ?></div>
				<h2 class="h2" style="margin-top:14px;"><?php esc_html_e( 'Certified, reliable, and built to hand over', 'amatec' ); ?></h2>
				<div class="pf-reason-grid">
					<?php foreach ( $reasons as $r ) : ?>
						<div class="pf-reason">
							<span class="ic"><i data-lucide="<?php echo esc_attr( $r['icon'] ); ?>"></i></span>
							<span class="t"><?php echo esc_html( $r['t'] ); ?></span>
							<span class="d"><?php echo esc_html( $r['d'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

		</div>
	</div>
</section>
