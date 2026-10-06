<?php
/**
 * n8n — what we build (capability grid).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$services = array(
	array( 'icon' => 'workflow', 't' => 'Custom workflow development', 'd' => 'Tailored n8n workflows with JavaScript functions, conditional logic, and custom nodes for your exact process.' ),
	array( 'icon' => 'webhook', 't' => 'API & system integration', 'd' => 'Connect internal databases, SaaS tools, CRMs, ERPs, webhooks, and third-party APIs into one intelligent system.' ),
	array( 'icon' => 'database', 't' => 'ETL & data pipelines', 'd' => 'Extract, transform, and load across multiple sources, with clean, resilient pipelines that scale with your data.' ),
	array( 'icon' => 'sparkles', 't' => 'AI-powered workflows', 'd' => 'Blend LLMs and AI steps into automations for classification, enrichment, and intelligent routing.' ),
	array( 'icon' => 'server', 't' => 'Self-hosting & deployment', 'd' => 'Cloud or on-premise setup with backups, performance tuning, and a hardened, compliant environment.' ),
	array( 'icon' => 'activity', 't' => 'Monitoring & maintenance', 'd' => 'Documentation, alerting, and ongoing tuning so your workflows stay healthy and observable over time.' ),
);
?>
<section id="n8n-services" class="section" style="background:var(--bg-page);">
	<div class="wrap">
		<div class="sec-head center" style="max-width:720px;">
			<div class="eyebrow"><?php esc_html_e( 'WHAT WE BUILD', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'Automation with full control', 'amatec' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'Unlike closed SaaS tools, n8n gives you ownership of your data and logic. We build workflows engineered for security, scale, and the long run.', 'amatec' ); ?></p>
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
