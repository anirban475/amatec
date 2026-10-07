<?php
/**
 * AI page — how-we-work step cards + governance/enablement pillar band.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$steps = array(
	array( 'n' => '01', 'icon' => 'search', 't' => 'Identify high-impact areas', 'd' => 'We collaborate with you to find the tasks where AI delivers the most leverage, fast.' ),
	array( 'n' => '02', 'icon' => 'pencil-ruler', 't' => 'Design & deploy', 'd' => 'We pick the model and build the workflow around it, starting with the cheapest model that does the job well.' ),
	array( 'n' => '03', 'icon' => 'plug', 't' => 'Integrate with your stack', 'd' => 'It plugs into your CRM, helpdesk or inbox through the tools you already use.' ),
);
$pillars = array(
	array( 'icon' => 'shield-check', 't' => 'Responsible AI', 'd' => 'Every AI step logs what it read and what it decided. We test it on your real data before go-live and keep a person in the loop wherever a wrong answer would cost money.' ),
	array( 'icon' => 'graduation-cap', 't' => 'Team enablement', 'd' => 'Training modules help your staff work confidently alongside AI systems, so adoption sticks and your team stays in control.' ),
);
?>
<section id="ai-approach" class="section" style="background:var(--bg-page);">
	<div class="wrap">
		<div class="sec-head center" style="max-width:640px;">
			<div class="eyebrow"><?php esc_html_e( 'HOW WE WORK', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'From idea to intelligent automation', 'amatec' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'Three steps, and a person stays in control at each one.', 'amatec' ); ?></p>
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
