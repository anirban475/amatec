<?php
/**
 * monday.com — Core Certified callout + reasons + numbers strip.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$reasons = array(
	array( 'icon' => 'badge-check', 't' => 'Work Management Core Certified', 'd' => 'Certified in monday.com’s Work Management Core, so you get builders who know the platform inside out.' ),
	array( 'icon' => 'sliders-horizontal', 't' => 'Recipes that fit your process', 'd' => 'Automations modelled on how your team actually works, not generic, off-the-shelf templates.' ),
	array( 'icon' => 'blocks', 't' => 'Connected to your stack', 'd' => 'monday.com wired into Slack, Teams, Salesforce, HubSpot and more, so data moves without copy-paste.' ),
	array( 'icon' => 'users-round', 't' => 'Built for adoption', 'd' => 'Documentation, testing, and training so the whole team confidently runs the workflows long-term.' ),
);
$stats = array(
	array( 'n' => '250+', 'l' => 'Workflows shipped' ),
	array( 'n' => '120+', 'l' => 'Satisfied clients' ),
	array( 'n' => '2020', 'l' => 'Building client automations since' ),
	array( 'n' => '3', 'l' => 'Continents served' ),
);
?>
<section id="monday-why" class="section" style="background:var(--bg-subtle);">
	<div class="wrap">
		<div class="pf-why-grid">

			<div class="pf-cert-card">
				<div class="dotgrid" aria-hidden="true"></div>
				<div class="inner">
					<span class="medal"><i data-lucide="badge-check"></i></span>
					<div class="k"><?php esc_html_e( 'monday.com Certified', 'amatec' ); ?></div>
					<div class="t" style="font-size:30px;"><?php esc_html_e( 'Work Management', 'amatec' ); ?><br><?php esc_html_e( 'Core', 'amatec' ); ?></div>
					<p><?php esc_html_e( 'Certified by monday.com on the fundamentals of building and automating its Work OS, with proven, hands-on expertise.', 'amatec' ); ?></p>
				</div>
			</div>

			<div>
				<div class="eyebrow"><?php esc_html_e( 'WHY monday.com WITH AMATEC', 'amatec' ); ?></div>
				<h2 class="h2" style="margin-top:14px;"><?php esc_html_e( 'Certified, tailored, and built to stick', 'amatec' ); ?></h2>
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
