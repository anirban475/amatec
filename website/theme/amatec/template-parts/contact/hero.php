<?php
/**
 * Contact hero — navy, centered, with three quick-contact rails.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$rails = array(
	array( 'icon' => 'mail', 'label' => 'Email us', 'value' => 'hello@amatec.in', 'href' => 'mailto:hello@amatec.in' ),
	array( 'icon' => 'phone', 'label' => 'Call the studio', 'value' => '+91 72659 69478', 'href' => 'tel:+917265969478' ),
	array( 'icon' => 'map-pin', 'label' => 'Find us', 'value' => 'Vadodara · Gujarat · IN', 'href' => '#contact-form' ),
);
?>
<section id="contact-hero" class="lp-hero" style="text-align:center;">
	<div class="dotgrid" aria-hidden="true"></div>
	<div class="grad" aria-hidden="true"></div>
	<div aria-hidden="true" style="position:absolute;right:-8%;bottom:-30%;width:520px;height:520px;border-radius:50%;background:radial-gradient(circle,rgba(242,147,35,0.20),transparent 62%);pointer-events:none;"></div>

	<div class="wrap" style="position:relative;padding-top:92px;padding-bottom:80px;">
		<div class="hero-badge reveal">
			<span class="dot orange"></span> <?php esc_html_e( 'Contact Amatec', 'amatec' ); ?>
		</div>

		<h1 class="h1 reveal" style="margin-top:24px;max-width:940px;margin-left:auto;margin-right:auto;animation-delay:.05s;">
			<?php esc_html_e( 'Let’s map the busywork', 'amatec' ); ?><br>
			<span class="accent"><?php esc_html_e( 'worth automating', 'amatec' ); ?></span>.
		</h1>

		<p class="lead reveal" style="margin-top:22px;color:var(--blue-100);max-width:620px;margin-left:auto;margin-right:auto;animation-delay:.1s;">
			<?php esc_html_e( 'Tell us about the process that drains your week. A real automation engineer reads every message. Most get a reply within one business day.', 'amatec' ); ?>
		</p>

		<div class="contact-rails reveal" style="animation-delay:.15s;">
			<?php foreach ( $rails as $r ) : ?>
				<a href="<?php echo esc_url( $r['href'] ); ?>">
					<span class="ic"><i data-lucide="<?php echo esc_attr( $r['icon'] ); ?>"></i></span>
					<span class="txt">
						<span class="k"><?php echo esc_html( $r['label'] ); ?></span>
						<span class="v"><?php echo esc_html( $r['value'] ); ?></span>
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
