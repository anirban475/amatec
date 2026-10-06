<?php
/**
 * T-Chat hero — navy, centered, framed YouTube demo (links out to YouTube).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$marketplace = 'https://marketplace.zoho.com/app/crm/twilio-chat-for-zoho-crm';
$video_id    = 'Ao1q_e1N5Eo';
?>
<section id="tc-hero" class="lp-hero" style="text-align:center;">
	<div class="dotgrid" aria-hidden="true"></div>
	<div class="grad" aria-hidden="true"></div>
	<div class="glow" aria-hidden="true"></div>

	<div class="wrap" style="position:relative;padding-top:80px;padding-bottom:92px;">
		<div class="hero-badge reveal">
			<span class="dot orange"></span> <?php esc_html_e( 'Zoho CRM Extension · Twilio', 'amatec' ); ?>
		</div>

		<h1 class="h1 reveal" style="margin-top:24px;max-width:960px;margin-left:auto;margin-right:auto;animation-delay:.05s;">
			<?php esc_html_e( 'Turn Zoho CRM into a', 'amatec' ); ?><br>
			<span class="accent"><?php esc_html_e( 'real-time chat hub', 'amatec' ); ?></span>
		</h1>

		<p class="lead reveal" style="margin-top:22px;color:var(--blue-100);max-width:640px;margin-left:auto;margin-right:auto;animation-delay:.1s;">
			<?php esc_html_e( 'Engage leads and customers with Twilio-powered SMS & MMS messaging, without ever leaving your CRM. Every conversation stays linked to the right contact.', 'amatec' ); ?>
		</p>

		<div class="reveal" style="display:flex;gap:14px;margin-top:32px;justify-content:center;flex-wrap:wrap;animation-delay:.15s;">
			<a href="<?php echo esc_url( $marketplace ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-accent"><i data-lucide="external-link"></i> <?php esc_html_e( 'Go to Extension', 'amatec' ); ?></a>
			<a href="#tc-demo" class="btn btn-outline-light"><i data-lucide="play"></i> <?php esc_html_e( 'Watch the demo', 'amatec' ); ?></a>
		</div>

		<div id="tc-demo" class="reveal" style="margin-top:56px;max-width:920px;margin-left:auto;margin-right:auto;animation-delay:.2s;">
			<div class="prod-frame">
				<div class="bar">
					<span class="d" style="background:#FF5F57;"></span>
					<span class="d" style="background:#FEBC2E;"></span>
					<span class="d" style="background:#28C840;"></span>
					<span class="addr">crm.zoho.com · twilio-chat</span>
				</div>
				<a class="media yt" href="<?php echo esc_url( 'https://www.youtube.com/watch?v=' . $video_id ); ?>" target="_blank" rel="noopener noreferrer"
					aria-label="<?php esc_attr_e( 'Watch the product demo on YouTube', 'amatec' ); ?>"
					style="background-image:linear-gradient(rgba(6,28,48,0.30),rgba(6,28,48,0.55)),url('<?php echo esc_url( 'https://i.ytimg.com/vi/' . $video_id . '/maxresdefault.jpg' ); ?>');">
					<span class="ph">
						<span class="play"><i data-lucide="play"></i></span>
						<span class="cap" style="color:#fff;"><?php esc_html_e( 'Watch the 2-min product demo', 'amatec' ); ?></span>
					</span>
					<span class="yt-tag"><?php esc_html_e( 'Watch on YouTube', 'amatec' ); ?> <i data-lucide="external-link"></i></span>
				</a>
			</div>
		</div>
	</div>
</section>
