<?php
/**
 * Home — services grid (six cards, one featured).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$services = array(
	array( 'icon' => 'workflow',   'tint' => 'blue',   'title' => 'Workflow automation', 'body' => 'Map a process once, then let n8n and Make run it on autopilot: triggers, routing, retries and all.', 'items' => array( 'Lead & form intake', 'Order-to-invoice', 'Approval routing' ) ),
	array( 'icon' => 'git-merge',  'tint' => 'orange', 'title' => 'System integration',  'body' => 'Connect the tools that don’t talk to each other. One workflow, every system in sync.', 'items' => array( 'CRM ↔ billing', 'Inbox ↔ tasks', 'Webhooks & APIs' ), 'featured' => true ),
	array( 'icon' => 'database',   'tint' => 'blue',   'title' => 'CRM build-outs',      'body' => 'Monday and Zoho configured around how your team actually sells, with automations baked in.', 'items' => array( 'Pipeline design', 'Zoho (Partner)', 'Reporting dashboards' ) ),
	array( 'icon' => 'bot',        'tint' => 'blue',   'title' => 'AI-assisted ops',     'body' => 'Drop AI into the workflow where it earns its place: enrichment, drafting, screening, triage.', 'items' => array( 'Lead scoring', 'Doc extraction', 'Draft replies' ) ),
	array( 'icon' => 'refresh-cw', 'tint' => 'blue',   'title' => 'Data sync & migration','body' => 'Move and mirror records between platforms cleanly, with no copy-paste and no drift.', 'items' => array( 'Two-way sync', 'Bulk migration', 'Dedup & cleanup' ) ),
	array( 'icon' => 'life-buoy',  'tint' => 'blue',   'title' => 'Managed automation',  'body' => 'We monitor, maintain and evolve your workflows so they keep running as your business changes.', 'items' => array( 'Monitoring & alerts', 'SLA support', 'Continuous tuning' ) ),
);
?>
<section id="services" class="section services">
	<div class="wrap">
		<div class="sec-head">
			<div class="eyebrow">WHAT WE DO</div>
			<h2 class="h2">Automation, end to end</h2>
			<p class="lead">From a single annoying handoff to a fully connected back office, we build, integrate and run it.</p>
		</div>
		<div class="services-grid">
			<?php foreach ( $services as $s ) : ?>
				<div class="card service<?php echo ! empty( $s['featured'] ) ? ' featured' : ''; ?>">
					<span class="ic <?php echo esc_attr( $s['tint'] ); ?>"><i data-lucide="<?php echo esc_attr( $s['icon'] ); ?>"></i></span>
					<h3 class="h3"><?php echo esc_html( $s['title'] ); ?></h3>
					<p><?php echo esc_html( $s['body'] ); ?></p>
					<ul>
						<?php foreach ( $s['items'] as $it ) : ?>
							<li><i data-lucide="check"></i><?php echo esc_html( $it ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
