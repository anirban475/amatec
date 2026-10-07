<?php
/**
 * Home — contact / CTA with embedded Cal.com scheduler.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$points = array(
	'30-minute call with the engineer who would build it',
	'A before/after map of your process',
	'A fixed-scope quote, or an honest "you don’t need us"',
);
?>
<section id="contact" class="section">
	<div class="wrap">
		<div class="contact-card">
			<div class="contact-copy">
				<div class="eyebrow">GET STARTED</div>
				<h2 class="h2">Book a free workflow audit</h2>
				<p class="lead">
					Tell us the process that drains your week. We&rsquo;ll map it and show you exactly what to automate.
					No commitment, no jargon.
				</p>
				<ul class="contact-list">
					<?php foreach ( $points as $t ) : ?>
						<li><i data-lucide="circle-check-big"></i><?php echo esc_html( $t ); ?></li>
					<?php endforeach; ?>
				</ul>
				<div class="contact-note">
					<i data-lucide="calendar-clock"></i>
					Pick any open slot. Instant confirmation to your inbox.
				</div>
			</div>
			<div class="contact-cal">
				<div id="cal-home" class="cal-inline" data-cal-inline data-cal-ns="meeting" data-cal-link="amatec/meeting"></div>
			</div>
		</div>
	</div>
</section>
