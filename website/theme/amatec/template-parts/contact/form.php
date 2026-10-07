<?php
/**
 * Contact — message form (left) + direct contact details & assurance (right).
 * Submission opens a prefilled email via initContactForm() in amatec.js.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$interests = array(
	'Workflow automation',
	'AI-powered automation',
	'CRM automation',
	'A specific platform (Make / n8n / Zoho)',
	'Not sure yet, help me scope it',
);
$details = array(
	array( 'icon' => 'mail', 'label' => 'Email', 'value' => 'hello@amatec.in', 'href' => 'mailto:hello@amatec.in' ),
	array( 'icon' => 'phone', 'label' => 'Phone', 'value' => '+91 72659 69478', 'href' => 'tel:+917265969478' ),
	array( 'icon' => 'map-pin', 'label' => 'Studio', 'value' => "Kplex, Alkapuri · Vadodara\nGujarat 390007 · India", 'href' => '' ),
);
$socials = array(
	array( 'name' => 'youtube', 'href' => 'https://www.youtube.com/@AMATEC-automation', 'label' => 'YouTube', 'path' => 'M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z' ),
	array( 'name' => 'linkedin', 'href' => 'https://www.linkedin.com/company/amatec83', 'label' => 'LinkedIn', 'path' => 'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z' ),
	array( 'name' => 'instagram', 'href' => 'https://www.instagram.com/amatec.in/', 'label' => 'Instagram', 'path' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.012-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z' ),
);
?>
<section id="contact-form" class="section" style="background:var(--bg-subtle);">
	<div class="wrap">
		<div class="contact-grid">

			<!-- message form -->
			<div class="cf-card">
				<div class="eyebrow"><?php esc_html_e( 'SEND A MESSAGE', 'amatec' ); ?></div>
				<h2 class="h2" style="margin-top:14px;font-size:clamp(26px,3vw,34px);"><?php esc_html_e( 'Tell us what to automate', 'amatec' ); ?></h2>
				<p class="cf-sub"><?php esc_html_e( 'The more you tell us about the process, the sharper our first reply. No fields are required to start a conversation.', 'amatec' ); ?></p>

				<form data-contact-form>
					<?php // Honeypot — hidden from humans; bots that fill it are silently dropped. ?>
					<input type="text" name="cf_website" tabindex="-1" autocomplete="off" aria-hidden="true"
						style="position:absolute;left:-9999px;top:-9999px;width:1px;height:1px;opacity:0;">
					<div class="cf-row">
						<div>
							<label class="cf-label" for="cf_name"><?php esc_html_e( 'Name', 'amatec' ); ?></label>
							<input class="cf-field" id="cf_name" name="cf_name" placeholder="<?php esc_attr_e( 'Your name', 'amatec' ); ?>">
						</div>
						<div>
							<label class="cf-label" for="cf_email"><?php esc_html_e( 'Work email', 'amatec' ); ?></label>
							<input class="cf-field" id="cf_email" name="cf_email" type="email" placeholder="you@company.com">
						</div>
					</div>
					<div class="cf-row">
						<div>
							<label class="cf-label" for="cf_company"><?php esc_html_e( 'Company', 'amatec' ); ?></label>
							<input class="cf-field" id="cf_company" name="cf_company" placeholder="<?php esc_attr_e( 'Company name', 'amatec' ); ?>">
						</div>
						<div>
							<label class="cf-label" for="cf_phone"><?php esc_html_e( 'Phone', 'amatec' ); ?> <span><?php esc_html_e( '(optional)', 'amatec' ); ?></span></label>
							<input class="cf-field" id="cf_phone" name="cf_phone" placeholder="+91 …">
						</div>
					</div>
					<div>
						<label class="cf-label" for="cf_interest"><?php esc_html_e( 'What do you want to automate?', 'amatec' ); ?></label>
						<div class="cf-select">
							<select class="cf-field" id="cf_interest" name="cf_interest">
								<option value="" disabled selected><?php esc_html_e( 'Choose a focus area…', 'amatec' ); ?></option>
								<?php foreach ( $interests as $o ) : ?>
									<option value="<?php echo esc_attr( $o ); ?>"><?php echo esc_html( $o ); ?></option>
								<?php endforeach; ?>
							</select>
							<i data-lucide="chevron-down"></i>
						</div>
					</div>
					<div>
						<label class="cf-label" for="cf_message"><?php esc_html_e( 'The process that drains your week', 'amatec' ); ?></label>
						<textarea class="cf-field" id="cf_message" name="cf_message" placeholder="<?php esc_attr_e( 'e.g. Every new lead from our website gets copied by hand into the CRM, then into a spreadsheet, then someone emails sales…', 'amatec' ); ?>"></textarea>
					</div>
					<div class="cf-actions">
						<button class="btn btn-accent" type="submit"><i data-lucide="send"></i> <?php esc_html_e( 'Send message', 'amatec' ); ?></button>
						<span class="cf-privacy"><i data-lucide="lock"></i><?php esc_html_e( 'Your details stay private. No spam, ever.', 'amatec' ); ?></span>
					</div>
					<p class="cf-error" role="alert" hidden></p>
				</form>

				<div class="cf-sent" hidden>
					<span class="ic"><i data-lucide="check"></i></span>
					<h3 class="h3"><?php esc_html_e( 'Message on its way.', 'amatec' ); ?></h3>
					<p><?php esc_html_e( 'An automation engineer will read it and reply within one business day, usually with a few questions and a rough sense of what’s worth automating.', 'amatec' ); ?></p>
					<button class="btn btn-secondary" type="button" data-contact-again><i data-lucide="arrow-left"></i> <?php esc_html_e( 'Send another', 'amatec' ); ?></button>
				</div>
			</div>

			<!-- direct details -->
			<div class="cf-side">
				<div class="cf-direct">
					<div class="dotgrid" aria-hidden="true"></div>
					<div class="inner">
						<div class="eyebrow on-dark"><?php esc_html_e( 'REACH US DIRECTLY', 'amatec' ); ?></div>
						<div class="rows">
							<?php foreach ( $details as $d ) : ?>
								<?php $tag = $d['href'] ? 'a' : 'div'; ?>
								<<?php echo $tag; // phpcs:ignore ?> class="row" <?php echo $d['href'] ? 'href="' . esc_url( $d['href'] ) . '"' : ''; // phpcs:ignore ?>>
									<span class="ic"><i data-lucide="<?php echo esc_attr( $d['icon'] ); ?>"></i></span>
									<span class="txt">
										<span class="k"><?php echo esc_html( $d['label'] ); ?></span>
										<span class="v"><?php echo nl2br( esc_html( $d['value'] ) ); ?></span>
									</span>
								</<?php echo $tag; // phpcs:ignore ?>>
							<?php endforeach; ?>
						</div>

						<div class="follow">
							<span class="k"><?php esc_html_e( 'Follow along', 'amatec' ); ?></span>
							<div class="icons">
								<?php foreach ( $socials as $s ) : ?>
									<a href="<?php echo esc_url( $s['href'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $s['label'] ); ?>">
										<svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="<?php echo esc_attr( $s['path'] ); ?>"/></svg>
									</a>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>

				<div class="cf-assure">
					<span class="ic"><i data-lucide="message-circle-reply"></i></span>
					<div>
						<div class="t"><?php esc_html_e( 'Replies within one business day', 'amatec' ); ?></div>
						<div class="d"><?php esc_html_e( 'An engineer answers, not a ticketing bot.', 'amatec' ); ?></div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
