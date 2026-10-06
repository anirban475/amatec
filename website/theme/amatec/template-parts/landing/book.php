<?php
/**
 * Landing "book a meeting" — dark band with white split card:
 * pitch + checklist left, inline Cal.com scheduler right (light theme).
 * The embed is initialised by initCal() in assets/js/amatec.js.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$data = $args['data'];
$c    = isset( $data['cta'] ) ? $data['cta'] : array();

$points = ! empty( $c['points'] ) ? $c['points'] : array(
	__( 'A 30-minute call with an automation engineer', 'amatec' ),
	__( 'A shortlist of your highest-impact automation opportunities', 'amatec' ),
	__( 'A clear, no-obligation plan: start small, scale as ROI proves out', 'amatec' ),
);
?>
<section id="contact" class="lp-book">
	<div class="dotgrid" aria-hidden="true"></div>
	<div class="grad" aria-hidden="true"></div>
	<div class="wrap section inner">
		<div class="lp-consult-grid">

			<div class="copy">
				<div class="eyebrow"><?php echo esc_html( ! empty( $c['eyebrow'] ) ? $c['eyebrow'] : __( 'BOOK A MEETING', 'amatec' ) ); ?></div>
				<h2 class="h2"><?php echo esc_html( ! empty( $c['title'] ) ? $c['title'] : __( 'Book a free automation audit', 'amatec' ) ); ?></h2>
				<?php if ( ! empty( $c['sub'] ) ) : ?>
					<p class="lead"><?php echo esc_html( $c['sub'] ); ?></p>
				<?php endif; ?>

				<ul class="contact-list">
					<?php foreach ( $points as $t ) : ?>
						<li><i data-lucide="circle-check-big"></i> <?php echo esc_html( $t ); ?></li>
					<?php endforeach; ?>
				</ul>

				<div class="contact-note">
					<i data-lucide="calendar-clock"></i>
					<?php esc_html_e( 'Pick any open slot. Instant confirmation to your inbox.', 'amatec' ); ?>
				</div>
			</div>

			<div class="cal">
				<div id="lp-cal-inline" class="cal-inline" data-cal-inline data-cal-ns="lp-meeting" data-cal-link="amatec/meeting"></div>
			</div>

		</div>
	</div>
</section>
