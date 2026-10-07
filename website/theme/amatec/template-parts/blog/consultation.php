<?php
/**
 * Blog single — free-consultation band with "Request a call back" form.
 * The form opens a prefilled email (handled in amatec.js).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$points = array(
	__( 'Reduce operational costs', 'amatec' ),
	__( 'Eliminate repetitive tasks', 'amatec' ),
	__( 'Scalable, connected systems', 'amatec' ),
);
?>
<section id="contact" class="consult">
	<span id="consultation" style="position:absolute;top:-90px;"></span>
	<div class="dotgrid"></div>
	<div class="grad"></div>
	<div class="glow"></div>
	<div class="wrap inner">
		<div class="consult-grid">
			<div>
				<div class="eyebrow on-dark"><?php esc_html_e( 'Free consultation', 'amatec' ); ?></div>
				<h2 class="h2"><?php esc_html_e( 'Book a meeting or fill the form', 'amatec' ); ?></h2>
				<p class="lead"><?php esc_html_e( 'Tell us where the manual work piles up. We’ll map your process and show you what’s worth automating. No obligation.', 'amatec' ); ?></p>
				<ul>
					<?php foreach ( $points as $p ) : ?>
						<li><span class="ic"><i data-lucide="check"></i></span><?php echo esc_html( $p ); ?></li>
					<?php endforeach; ?>
				</ul>
				<div class="actions">
					<a class="btn btn-accent" href="#cal-booking" data-scroll="#cal-booking"><i data-lucide="calendar-check"></i> Book a meeting</a>
					<a class="alt" href="#consult-form" data-scroll="#consult-form">or fill the form <i data-lucide="arrow-right"></i></a>
				</div>
			</div>

			<form id="consult-form" class="consult-form" data-callback-form data-mailto="anirban@amatec.in">
				<div class="k"><?php esc_html_e( 'Request a Call Back', 'amatec' ); ?></div>
				<div class="fields">
					<div>
						<label class="fld-label" for="cb_name"><?php esc_html_e( 'Name', 'amatec' ); ?></label>
						<input class="fld fld-dark" type="text" id="cb_name" name="cb_name" placeholder="Jane Doe">
					</div>
					<div>
						<label class="fld-label" for="cb_email"><?php esc_html_e( 'Work Email', 'amatec' ); ?> <span class="req">*</span></label>
						<input class="fld fld-dark" type="email" id="cb_email" name="cb_email" required placeholder="jane@company.com">
					</div>
					<div>
						<label class="fld-label" for="cb_phone"><?php esc_html_e( 'Contact No.', 'amatec' ); ?> <span class="req">*</span></label>
						<input class="fld fld-dark" type="tel" id="cb_phone" name="cb_phone" required placeholder="+49 …">
					</div>
					<div>
						<label class="fld-label" for="cb_service"><?php esc_html_e( 'Service required', 'amatec' ); ?></label>
						<textarea class="fld fld-dark" id="cb_service" name="cb_service" rows="4" style="resize:vertical;" placeholder="Tell us which service you need and a bit about your current workflows…"></textarea>
					</div>
					<button class="btn btn-accent" type="submit" style="justify-content:center;margin-top:4px;"><i data-lucide="phone-call"></i> Request a Call Back</button>
					<p class="consult-sent" data-callback-sent style="display:none;"><i data-lucide="mail-check"></i> Opening your email app to send this to anirban@amatec.in…</p>
				</div>
			</form>
		</div>
	</div>
</section>
