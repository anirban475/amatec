<?php
/**
 * Make.com — what we build (capability grid).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$services = array(
	array( 'icon' => 'workflow', 't' => 'Scenario design & build', 'd' => 'From a blank canvas to a production scenario: mapped, modular, and documented so anyone can follow it.' ),
	array( 'icon' => 'blocks', 't' => 'Multi-app integrations', 'd' => 'Connect 1,500+ apps (CRMs, sheets, email, payments, AI) into one reliable end-to-end flow.' ),
	array( 'icon' => 'shield-alert', 't' => 'Error handling & monitoring', 'd' => 'Retries, fallbacks, and alerting so a failed run never silently breaks your business.' ),
	array( 'icon' => 'sparkles', 't' => 'AI-powered steps', 'd' => 'Drop GPT and other AI modules into scenarios for summaries, classification, and content, all safely scoped.' ),
	array( 'icon' => 'repeat', 't' => 'Migrations & rebuilds', 'd' => 'Move off Zapier or untangle a brittle scenario into something maintainable and cost-efficient.' ),
	array( 'icon' => 'graduation-cap', 't' => 'Enablement & handover', 'd' => 'Clear documentation and a walkthrough so your team can own and extend what we build.' ),
);
?>
<section id="make-services" class="section" style="background:var(--bg-page);">
	<div class="wrap">
		<div class="sec-head center" style="max-width:700px;">
			<div class="eyebrow"><?php esc_html_e( 'WHAT WE BUILD', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'Make.com, done properly', 'amatec' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'Not just wired-together modules. These are scenarios designed to survive real volume, edge cases, and the next person who opens them.', 'amatec' ); ?></p>
		</div>

		<div class="lp-benefit-grid">
			<?php foreach ( $services as $f ) : ?>
				<div class="card lp-benefit">
					<span class="ic"><i data-lucide="<?php echo esc_attr( $f['icon'] ); ?>"></i></span>
					<h3 class="h3"><?php echo esc_html( $f['t'] ); ?></h3>
					<p><?php echo esc_html( $f['d'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
