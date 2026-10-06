<?php
/**
 * T-Chat — closing conversion band (marketplace + consultation).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$marketplace = 'https://marketplace.zoho.com/app/crm/twilio-chat-for-zoho-crm';
$assures     = array(
	array( 'icon' => 'puzzle', 't' => 'Native Zoho CRM extension' ),
	array( 'icon' => 'rocket', 't' => 'Set up in minutes' ),
	array( 'icon' => 'life-buoy', 't' => 'Support from the makers' ),
);
?>
<section id="tc-cta" class="prod-cta">
	<div class="dotgrid" aria-hidden="true"></div>
	<div class="grad" aria-hidden="true"></div>
	<div class="glow-l" aria-hidden="true"></div>
	<div class="wrap section inner" style="text-align:center;">
		<div class="eyebrow on-dark"><?php esc_html_e( 'READY TO STREAMLINE CRM MESSAGING?', 'amatec' ); ?></div>
		<h2 class="h2" style="margin-top:14px;color:#fff;max-width:760px;margin-left:auto;margin-right:auto;"><?php esc_html_e( 'Install Twilio Chat Messenger today', 'amatec' ); ?></h2>
		<p class="lead" style="margin-top:18px;color:var(--blue-100);max-width:600px;margin-left:auto;margin-right:auto;">
			<?php esc_html_e( 'Boost productivity and customer satisfaction with direct messaging inside Zoho CRM. Get started in minutes: no coding, no clutter, just clear communication.', 'amatec' ); ?>
		</p>

		<div style="display:flex;gap:14px;margin-top:32px;justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( $marketplace ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-accent"><i data-lucide="external-link"></i> <?php esc_html_e( 'Get the extension', 'amatec' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline-light"><i data-lucide="calendar-clock"></i> <?php esc_html_e( 'Book a consultation', 'amatec' ); ?></a>
		</div>

		<div class="prod-assure">
			<?php foreach ( $assures as $r ) : ?>
				<span><i data-lucide="<?php echo esc_attr( $r['icon'] ); ?>"></i><?php echo esc_html( $r['t'] ); ?></span>
			<?php endforeach; ?>
		</div>
	</div>
</section>
