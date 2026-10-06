<?php
/**
 * About — closing CTA band with embedded Cal.com scheduler.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$points = array(
	'45-minute call with the builder, not a sales rep',
	'A before/after map of your process',
	'A fixed-scope quote, or an honest "you don’t need us"',
);
?>
<section id="about-cta" class="about-cta">
	<div class="dotgrid"></div>
	<div class="grad"></div>
	<div class="wrap section inner">
		<div class="contact-card">
			<div class="contact-copy">
				<div class="eyebrow">LET&rsquo;S TALK</div>
				<h2 class="h2">Tell us the process that drains your week.</h2>
				<p class="lead">
					Forty-five minutes with the person who&rsquo;ll actually build it. We&rsquo;ll map the busywork and show
					you exactly what&rsquo;s worth automating. No commitment, no jargon.
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
				<div id="cal-about" class="cal-inline" data-cal-inline data-cal-ns="about-meeting" data-cal-link="amatec/meeting"></div>
			</div>
		</div>
	</div>
</section>
