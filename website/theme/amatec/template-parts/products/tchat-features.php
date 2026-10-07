<?php
/**
 * T-Chat — six-feature capability grid.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$features = array(
	array( 'icon' => 'plug-zap', 't' => 'Twilio account integration', 'd' => 'Securely connect your Twilio account to Zoho CRM with simple credentials. No complex setup needed.' ),
	array( 'icon' => 'message-circle', 't' => 'Familiar chat window', 'd' => 'Messages appear as a chat thread on the record, so nobody needs training to use it.' ),
	array( 'icon' => 'messages-square', 't' => 'Real-time two-way messaging', 'd' => 'Send and receive SMS/MMS instantly: no switching tabs, no jumping between platforms.' ),
	array( 'icon' => 'history', 't' => 'Integrated chat history', 'd' => 'See the full message history right inside each contact or lead record, with context for every interaction.' ),
	array( 'icon' => 'bell-ring', 't' => 'Incoming message alerts', 'd' => 'Instant notifications for new messages inside Zoho CRM, so you never miss a customer update.' ),
	array( 'icon' => 'headset', 't' => 'Built for sales & support', 'd' => 'From lead nurturing to customer service, respond faster, track interactions, and close more deals.' ),
);
?>
<section id="tc-features" class="section" style="background:var(--bg-subtle);">
	<div class="wrap">
		<div class="sec-head center" style="max-width:680px;">
			<div class="eyebrow"><?php esc_html_e( 'WHAT IT DOES', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'Everything you need to chat where you sell', 'amatec' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'Six capabilities that fold real-time messaging straight into the CRM your team already lives in.', 'amatec' ); ?></p>
		</div>

		<div class="lp-benefit-grid">
			<?php foreach ( $features as $f ) : ?>
				<div class="card lp-benefit">
					<span class="ic"><i data-lucide="<?php echo esc_attr( $f['icon'] ); ?>"></i></span>
					<h3 class="h3"><?php echo esc_html( $f['t'] ); ?></h3>
					<p><?php echo esc_html( $f['d'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
