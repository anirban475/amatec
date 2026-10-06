<?php
/**
 * AI page — how-we-work step cards + governance/enablement pillar band.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$steps = array(
	array( 'n' => '01', 'icon' => 'search', 't' => 'Identify high-impact areas', 'd' => 'We collaborate with you to find the tasks where AI delivers the most leverage, fast.' ),
	array( 'n' => '02', 'icon' => 'pencil-ruler', 't' => 'Design & deploy', 'd' => 'We design and ship solutions tailored to your needs, from off-the-shelf models to custom-trained ones.' ),
	array( 'n' => '03', 'icon' => 'plug', 't' => 'Integrate with your stack', 'd' => 'CRM, ERP, support, or comms tools: our AI fits in seamlessly, no rip-and-replace.' ),
);
$pillars = array(
	array( 'icon' => 'shield-check', 't' => 'Responsible AI', 'd' => 'We practice responsible AI development by using clear governance frameworks for transparency, data protection, and compliance. Every solution is rigorously tested, monitored, and fine-tuned for accuracy.' ),
	array( 'icon' => 'graduation-cap', 't' => 'Team enablement', 'd' => 'Training modules help your staff work confidently alongside AI systems, so adoption sticks and your team stays in control.' ),
);
?>
<section id="ai-approach" class="section" style="background:var(--bg-page);">
	<div class="wrap">
		<div class="sec-head center" style="max-width:640px;">
			<div class="eyebrow"><?php esc_html_e( 'HOW WE WORK', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'From idea to intelligent automation', 'amatec' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'We integrate smoothly with your existing tech stack, and deploy responsibly.', 'amatec' ); ?></p>
		</div>

		<div class="ai-step-grid">
			<?php foreach ( $steps as $s ) : ?>
				<div class="card ai-step">
					<div class="top">
						<span class="ic"><i data-lucide="<?php echo esc_attr( $s['icon'] ); ?>"></i></span>
						<span class="num"><?php echo esc_html( $s['n'] ); ?></span>
					</div>
					<h3 class="h3"><?php echo esc_html( $s['t'] ); ?></h3>
					<p><?php echo esc_html( $s['d'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="ai-pillar-grid">
			<?php foreach ( $pillars as $p ) : ?>
				<div class="ai-pillar">
					<span class="ic"><i data-lucide="<?php echo esc_attr( $p['icon'] ); ?>"></i></span>
					<div>
						<h3 class="h3"><?php echo esc_html( $p['t'] ); ?></h3>
						<p><?php echo esc_html( $p['d'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
