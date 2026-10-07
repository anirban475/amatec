<?php
/**
 * Zoho — what we automate across the suite (capability grid).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$services = array(
	array( 'icon' => 'contact', 't' => 'CRM automation', 'd' => 'Lead assignment, behaviour-based follow-ups, and pipeline updates that keep sales moving on autopilot.' ),
	array( 'icon' => 'code', 't' => 'Custom Deluge scripts', 'd' => 'Tailored Deluge logic that eliminates repetitive tasks and moves data cleanly between systems.' ),
	array( 'icon' => 'receipt', 't' => 'Finance & invoicing', 'd' => 'Automated invoices, approvals, and reminders in Zoho Books mean fewer errors and faster cash flow.' ),
	array( 'icon' => 'layers', 't' => 'Full-suite workflows', 'd' => 'Connected flows across CRM, Creator, Books, Campaigns, and Projects for smooth inter-app communication.' ),
	array( 'icon' => 'blocks', 't' => 'Third-party integrations', 'd' => 'Zoho linked to WhatsApp, Mailchimp, QuickBooks, Twilio, and Stripe via Zoho Flow or custom APIs.' ),
	array( 'icon' => 'search-check', 't' => 'Process audit & optimization', 'd' => 'We start with an audit, find high-impact opportunities, and design workflows around your business logic.' ),
);
?>
<section id="zoho-services" class="section" style="background:var(--bg-page);">
	<div class="wrap">
		<div class="sec-head center" style="max-width:720px;">
			<div class="eyebrow"><?php esc_html_e( 'WHAT WE AUTOMATE', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'Your whole Zoho suite, automated', 'amatec' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'From CRM to finance to custom apps: intelligent, scalable workflows built with Deluge and tuned to your operations.', 'amatec' ); ?></p>
		</div>

		<div class="lp-benefit-grid">
			<?php foreach ( $services as $f ) : ?>
				<div class="card lp-benefit">
					<span class="ic"><i data-lucide="<?php echo esc_attr( $f['icon'] ); ?>"></i></span>
					<h3 class="h3"><?php echo esc_html( $f['t'] ); ?></h3>
					<p><?php echo esc_html( $f['d'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
