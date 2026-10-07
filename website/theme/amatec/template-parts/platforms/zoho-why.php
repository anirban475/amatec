<?php
/**
 * Zoho — Certified Partner callout + reasons + numbers strip.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$reasons = array(
	array( 'icon' => 'badge-check', 't' => 'Zoho Certified & Partner', 'd' => 'A certified Zoho partner, so you get builders accredited by Zoho, not generalists guessing at Deluge.' ),
	array( 'icon' => 'terminal', 't' => 'Real Deluge engineering', 'd' => 'Custom scripts and functions tailored to your operations, not just point-and-click recipes.' ),
	array( 'icon' => 'shield-check', 't' => 'Tested on real records', 'd' => 'Every workflow is documented and tested on real records before it touches live data.' ),
	array( 'icon' => 'blocks', 't' => 'Connected beyond Zoho', 'd' => 'WhatsApp, QuickBooks, Stripe, Twilio and more wired in via Zoho Flow or custom APIs.' ),
);
$stats = array(
	array( 'n' => '250+', 'l' => 'Workflows shipped' ),
	array( 'n' => '120+', 'l' => 'Satisfied clients' ),
	array( 'n' => '2020', 'l' => 'Building client automations since' ),
	array( 'n' => '3', 'l' => 'Continents served' ),
);
?>
<section id="zoho-why" class="section" style="background:var(--bg-subtle);">
	<div class="wrap">
		<div class="pf-why-grid">

			<div class="pf-cert-card">
				<div class="dotgrid" aria-hidden="true"></div>
				<div class="inner">
					<span class="medal"><i data-lucide="badge-check"></i></span>
					<div class="k"><?php esc_html_e( 'Accredited', 'amatec' ); ?></div>
					<div class="t" style="font-size:30px;"><?php esc_html_e( 'Zoho Certified', 'amatec' ); ?><br>&amp; <?php esc_html_e( 'Partner', 'amatec' ); ?></div>
					<p><?php esc_html_e( 'Officially recognized by Zoho, with proven, hands-on expertise across CRM, Books, Creator, and Deluge.', 'amatec' ); ?></p>
				</div>
			</div>

			<div>
				<div class="eyebrow"><?php esc_html_e( 'WHY ZOHO WITH AMATEC', 'amatec' ); ?></div>
				<h2 class="h2" style="margin-top:14px;"><?php esc_html_e( 'Certified partners, real Deluge expertise', 'amatec' ); ?></h2>
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

		<div class="pf-stats">
			<?php foreach ( $stats as $st ) : ?>
				<div class="card stat-card">
					<div class="n"><?php echo esc_html( $st['n'] ); ?></div>
					<div class="l"><?php echo esc_html( $st['l'] ); ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
