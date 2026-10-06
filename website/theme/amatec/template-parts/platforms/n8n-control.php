<?php
/**
 * n8n — data-control callout + reasons + numbers strip.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$reasons = array(
	array( 'icon' => 'lock', 't' => 'Your data stays yours', 'd' => 'Self-hosted on your cloud or on-premise, with full control over where data is stored and how it’s processed.' ),
	array( 'icon' => 'shield-check', 't' => 'Built for compliance', 'd' => 'A preferred fit for data-sensitive industries with strict security and governance requirements.' ),
	array( 'icon' => 'scaling', 't' => 'Scales without lock-in', 'd' => 'Open-source and modular: extend with custom nodes and grow without per-task SaaS pricing.' ),
	array( 'icon' => 'file-text', 't' => 'Documented & supported', 'd' => 'Workflow docs, backup configs, performance tuning, and team training for long-term sustainability.' ),
);
$stats = array(
	array( 'n' => '250+', 'l' => 'Workflows shipped' ),
	array( 'n' => '120+', 'l' => 'Satisfied clients' ),
	array( 'n' => '9 yrs', 'l' => 'Doing only automation' ),
	array( 'n' => '3', 'l' => 'Continents served' ),
);
?>
<section id="n8n-control" class="section" style="background:var(--bg-subtle);">
	<div class="wrap">
		<div class="pf-why-grid">

			<div class="pf-cert-card">
				<div class="dotgrid" aria-hidden="true"></div>
				<div class="inner">
					<span class="medal" style="border-radius:22px;"><i data-lucide="server-cog"></i></span>
					<div class="k"><?php esc_html_e( 'Own your stack', 'amatec' ); ?></div>
					<div class="t" style="font-size:30px;"><?php esc_html_e( 'Your data.', 'amatec' ); ?><br><?php esc_html_e( 'Your servers.', 'amatec' ); ?></div>
					<p><?php esc_html_e( 'With self-hosted n8n, automation runs inside your own infrastructure, with no third party sitting between you and your data.', 'amatec' ); ?></p>
				</div>
			</div>

			<div>
				<div class="eyebrow"><?php esc_html_e( 'WHY n8n WITH AMATEC', 'amatec' ); ?></div>
				<h2 class="h2" style="margin-top:14px;"><?php esc_html_e( 'Secure, scalable, and fully in your control', 'amatec' ); ?></h2>
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
