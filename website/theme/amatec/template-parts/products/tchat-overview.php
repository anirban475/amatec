<?php
/**
 * T-Chat — overview copy + WhatsApp-style chat mockup.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$benefits = array(
	array( 't' => 'Chat in real time via SMS/MMS', 'd' => 'Message leads and customers from your own Twilio number, right inside Zoho CRM.' ),
	array( 't' => 'Full history on every record', 'd' => 'Each conversation auto-links to the matching contact or lead. Nothing gets lost.' ),
	array( 't' => 'Faster conversions, happier customers', 'd' => 'Instant notifications mean your team replies while intent is still hot.' ),
);
$thread = array(
	array( 'side' => 'in', 'text' => 'Hi! Is the enterprise plan still 20% off this week?', 'time' => '10:24' ),
	array( 'side' => 'out', 'text' => 'It is 🎉 I can send you a quote in two minutes. What team size?', 'time' => '10:25' ),
	array( 'side' => 'in', 'text' => 'Around 40 seats.', 'time' => '10:26' ),
	array( 'side' => 'out', 'text' => 'Perfect. Quote on its way to your inbox now.', 'time' => '10:27' ),
);
?>
<section id="tc-overview" class="section" style="background:var(--bg-page);">
	<div class="wrap">
		<div class="prod-overview-grid">

			<div>
				<div class="eyebrow"><?php esc_html_e( 'CENTRALIZE CUSTOMER CONVERSATIONS', 'amatec' ); ?></div>
				<h2 class="h2" style="margin-top:14px;"><?php esc_html_e( 'Real-time Twilio messaging inside Zoho CRM', 'amatec' ); ?></h2>
				<p class="lead" style="margin-top:18px;">
					<?php esc_html_e( 'T-Chat brings a WhatsApp-style chat interface and direct Twilio integration into Zoho CRM. Send, receive, and track SMS/MMS without leaving the platform. Sales and support teams communicate faster and smarter.', 'amatec' ); ?>
				</p>
				<ul class="prod-benefits">
					<?php foreach ( $benefits as $b ) : ?>
						<li>
							<span class="ic"><i data-lucide="check"></i></span>
							<span>
								<span class="t"><?php echo esc_html( $b['t'] ); ?></span>
								<span class="d"><?php echo esc_html( $b['d'] ); ?></span>
							</span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="card tc-chat">
				<div class="head">
					<span class="avatar">RK</span>
					<span class="who">
						<span class="n">Riya Kapoor</span>
						<span class="s"><span class="dot success"></span> <?php esc_html_e( 'Lead · +1 (415) 555-0182', 'amatec' ); ?></span>
					</span>
					<span class="call"><i data-lucide="phone"></i></span>
				</div>
				<div class="msgs">
					<?php foreach ( $thread as $m ) : ?>
						<div class="msg <?php echo esc_attr( $m['side'] ); ?>">
							<div class="bubble">
								<?php echo esc_html( $m['text'] ); ?>
								<span class="time"><?php echo esc_html( $m['time'] ); ?></span>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="composer">
					<div class="fld-ph"><?php esc_html_e( 'Type a message…', 'amatec' ); ?></div>
					<span class="send"><i data-lucide="send"></i></span>
				</div>
			</div>

		</div>
	</div>
</section>
