<?php
/**
 * monday.com — what we automate (capability grid).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$services = array(
	array( 'icon' => 'zap', 't' => 'Smart automation recipes', 'd' => 'Notify stakeholders, create recurring tasks, update statuses, trigger reminders, and move items on conditions.' ),
	array( 'icon' => 'columns-3', 't' => 'Board & column design', 'd' => 'Custom boards, formula and status columns, and structures tuned to how your team actually works.' ),
	array( 'icon' => 'blocks', 't' => 'Integrations that connect your stack', 'd' => 'Two-way sync with Slack, Teams, Zoom, Google Workspace, Salesforce, HubSpot, and more.' ),
	array( 'icon' => 'bar-chart-3', 't' => 'Dashboards & reporting', 'd' => 'Centralized dashboards giving managers a bird’s-eye view of projects, resources, and team performance.' ),
	array( 'icon' => 'layout-template', 't' => 'Use-case templates', 'd' => 'Ready flows for marketing campaigns, HR onboarding, and sales pipelines, built around your goals.' ),
	array( 'icon' => 'graduation-cap', 't' => 'Training & adoption', 'd' => 'Documentation, testing, and user training so your team confidently runs and grows the workflows.' ),
);
?>
<section id="monday-services" class="section" style="background:var(--bg-page);">
	<div class="wrap">
		<div class="sec-head center" style="max-width:720px;">
			<div class="eyebrow"><?php esc_html_e( 'WHAT WE AUTOMATE', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'Your Work OS, working for you', 'amatec' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'Boards that update themselves and stay in sync with the tools your team already uses.', 'amatec' ); ?></p>
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
