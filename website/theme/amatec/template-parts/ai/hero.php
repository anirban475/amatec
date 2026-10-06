<?php
/**
 * AI page hero — navy panel with AI task-triage mock (reuses lp-flow styles).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$badges = array( 'Machine learning', 'Natural language', 'Data analytics' );
$tasks  = array(
	array( 'icon' => 'mail', 'label' => 'Support email', 'sub' => 'Billing · high priority', 'tag' => 'Classified', 'c' => 'var(--blue-600)' ),
	array( 'icon' => 'receipt', 'label' => 'Vendor invoice', 'sub' => '12 fields · 99.4%', 'tag' => 'Extracted', 'c' => '#0F9D58' ),
	array( 'icon' => 'user-round-search', 'label' => 'Inbound lead', 'sub' => 'Routed to sales', 'tag' => 'Scored 0.92', 'c' => 'var(--orange-500)' ),
);
?>
<section id="ai-hero" class="lp-hero">
	<div class="dotgrid" aria-hidden="true"></div>
	<div class="grad" aria-hidden="true"></div>
	<div class="glow" aria-hidden="true"></div>

	<div class="wrap inner">
		<div class="lp-hero-grid">

			<div>
				<div class="hero-badge reveal">
					<span class="dot orange"></span> <?php esc_html_e( 'AI-Powered Automation', 'amatec' ); ?>
				</div>

				<h1 class="h1 reveal" style="animation-delay:.05s;">
					<?php esc_html_e( 'Smarter operations with', 'amatec' ); ?><br>
					<span class="accent"><?php esc_html_e( 'AI-powered', 'amatec' ); ?></span> <?php esc_html_e( 'task automation', 'amatec' ); ?>
				</h1>

				<p class="lead lp-hero-lead reveal" style="animation-delay:.1s;">
					<?php esc_html_e( 'We blend machine learning, natural language processing, and data analytics into automation that goes far beyond simple scripting, so your B2B team boosts productivity, cuts manual effort, and decides with intelligence.', 'amatec' ); ?>
				</p>

				<div class="ai-badges reveal" style="animation-delay:.12s;">
					<?php foreach ( $badges as $b ) : ?>
						<span class="lp-chip"><i data-lucide="check"></i><?php echo esc_html( $b ); ?></span>
					<?php endforeach; ?>
				</div>

				<div class="lp-hero-actions reveal" style="animation-delay:.15s;">
					<a href="#contact" class="btn btn-accent"><i data-lucide="calendar-clock"></i> <?php esc_html_e( 'Book a free consultation', 'amatec' ); ?></a>
					<a href="#ai-services" class="btn btn-outline-light"><i data-lucide="arrow-down"></i> <?php esc_html_e( 'See what we automate', 'amatec' ); ?></a>
				</div>
			</div>

			<div class="reveal" style="animation-delay:.2s;">
				<div class="lp-flow">
					<div class="lp-flow-top">
						<span class="ic"><i data-lucide="sparkles"></i></span>
						<span class="name">ai.tasks</span>
						<span class="run"><span class="dot success"></span> <?php esc_html_e( 'running', 'amatec' ); ?></span>
					</div>

					<div class="lp-flow-items">
						<?php foreach ( $tasks as $t ) : ?>
							<div class="lp-flow-item">
								<span class="ic" style="color:<?php echo esc_attr( $t['c'] ); ?>;"><i data-lucide="<?php echo esc_attr( $t['icon'] ); ?>"></i></span>
								<span class="txt">
									<span class="lbl"><?php echo esc_html( $t['label'] ); ?></span>
									<span class="sub"><?php echo esc_html( $t['sub'] ); ?></span>
								</span>
								<span class="tag"><i data-lucide="check"></i><?php echo esc_html( $t['tag'] ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="lp-flow-foot">
						<span><?php esc_html_e( '3 tasks handled · 0 human touches', 'amatec' ); ?></span>
						<span class="self"><i data-lucide="zap"></i><?php esc_html_e( 'no human intervention', 'amatec' ); ?></span>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
