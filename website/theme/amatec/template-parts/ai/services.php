<?php
/**
 * AI page — capability grid + "built on" platforms strip.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$caps = array(
	array( 'icon' => 'mail-search', 't' => 'Email classification & routing', 'd' => 'Incoming mail is read, categorized, and routed automatically to support, billing, sales, or escalation.' ),
	array( 'icon' => 'bot-message-square', 't' => 'Chatbots & query handling', 'd' => 'AI bots answer customer questions, start workflows, and open tickets around the clock.' ),
	array( 'icon' => 'gauge', 't' => 'Sentiment analysis', 'd' => 'Understand the tone behind messages and reviews to prioritize responses and spot risk early.' ),
	array( 'icon' => 'receipt', 't' => 'Invoice & document processing', 'd' => 'Extract, validate, and file data from invoices and documents, with no manual data entry.' ),
	array( 'icon' => 'trending-up', 't' => 'Predictive lead scoring', 'd' => 'Rank inbound leads by likelihood to convert so your team focuses on the highest-value prospects.' ),
	array( 'icon' => 'users-round', 't' => 'Customer segmentation', 'd' => 'Group customers intelligently for sharper targeting, personalization, and engagement.' ),
);
$platforms = array(
	array( 'icon' => 'sparkles', 'name' => 'OpenAI' ),
	array( 'icon' => 'cloud', 'name' => 'Google Cloud AI' ),
	array( 'icon' => 'brain-circuit', 'name' => 'Azure Cognitive Services' ),
	array( 'icon' => 'settings-2', 'name' => 'Custom-trained models' ),
);
?>
<section id="ai-services" class="section" style="background:var(--bg-subtle);">
	<div class="wrap">
		<div class="sec-head center" style="max-width:720px;">
			<div class="eyebrow"><?php esc_html_e( 'WHAT WE AUTOMATE', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'Intelligent automation, end to end', 'amatec' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'We automate the repetitive, judgment-heavy tasks that slow teams down, using machine learning, NLP, and analytics tuned to your data.', 'amatec' ); ?></p>
		</div>

		<div class="lp-benefit-grid">
			<?php foreach ( $caps as $f ) : ?>
				<div class="card lp-benefit">
					<span class="ic"><i data-lucide="<?php echo esc_attr( $f['icon'] ); ?>"></i></span>
					<h3 class="h3"><?php echo esc_html( $f['t'] ); ?></h3>
					<p><?php echo esc_html( $f['d'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="ai-strip">
			<span class="k"><?php esc_html_e( 'Built on', 'amatec' ); ?></span>
			<div class="row">
				<?php foreach ( $platforms as $p ) : ?>
					<span class="pill"><i data-lucide="<?php echo esc_attr( $p['icon'] ); ?>"></i><?php echo esc_html( $p['name'] ); ?></span>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
