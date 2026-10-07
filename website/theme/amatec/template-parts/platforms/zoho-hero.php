<?php
/**
 * Zoho hero — Certified Partner badge + Deluge code editor with a looping
 * typewriter animation (initZohoTyping in amatec.js).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Each line is a list of [text, token-class] pairs (classes in amatec.css).
$code = array(
	array( array( '// Auto-assign new leads by region', 'com' ) ),
	array( array( 'region', 'var' ), array( ' = ', 'pun' ), array( 'lead', 'var' ), array( '.', 'pun' ), array( 'get', 'fn' ), array( '(', 'pun' ), array( '"Region"', 'str' ), array( ');', 'pun' ) ),
	array( array( 'owner', 'var' ), array( ' = ', 'pun' ), array( 'if', 'key' ), array( '(', 'pun' ), array( 'region == ', 'var' ), array( '"EU"', 'str' ), array( ', ', 'pun' ), array( '"maria@acme.co"', 'str' ), array( ', ', 'pun' ), array( '"sam@acme.co"', 'str' ), array( ');', 'pun' ) ),
	array( array( '', 'pun' ) ),
	array( array( 'rec', 'var' ), array( ' = ', 'pun' ), array( 'Map', 'fn' ), array( '();', 'pun' ) ),
	array( array( 'rec', 'var' ), array( '.', 'pun' ), array( 'put', 'fn' ), array( '(', 'pun' ), array( '"Owner"', 'str' ), array( ', ', 'pun' ), array( 'owner', 'var' ), array( ');', 'pun' ) ),
	array( array( 'zoho.crm.updateRecord', 'fn' ), array( '(', 'pun' ), array( '"Leads"', 'str' ), array( ', ', 'pun' ), array( 'leadId', 'var' ), array( ', ', 'pun' ), array( 'rec', 'var' ), array( ');', 'pun' ) ),
	array( array( 'notify', 'fn' ), array( '(', 'pun' ), array( 'owner', 'var' ), array( ');', 'pun' ), array( '  // behaviour-based follow-up', 'com' ) ),
);
?>
<section id="zoho-hero" class="lp-hero" style="text-align:center;">
	<div class="dotgrid" aria-hidden="true"></div>
	<div class="grad" aria-hidden="true"></div>
	<div class="glow" aria-hidden="true"></div>

	<div class="wrap" style="position:relative;padding-top:50px;padding-bottom:54px;">
		<div class="hero-badge reveal">
			<span class="dot orange"></span> <?php esc_html_e( 'Zoho Workflow Automation', 'amatec' ); ?>
		</div>

		<h1 class="h1 reveal" style="margin-top:20px;max-width:1040px;font-size:clamp(34px,4.4vw,54px);margin-left:auto;margin-right:auto;animation-delay:.05s;">
			<?php esc_html_e( 'Automate your Zoho suite,', 'amatec' ); ?><br>
			<?php esc_html_e( 'built by', 'amatec' ); ?> <span class="accent"><?php esc_html_e( 'certified partners', 'amatec' ); ?></span>
		</h1>

		<p class="lead reveal" style="margin-top:20px;color:var(--blue-100);max-width:720px;margin-left:auto;margin-right:auto;animation-delay:.1s;">
			<?php esc_html_e( 'Custom Deluge scripts and connected workflows across CRM, Books, Creator, Campaigns, and Projects, so your data flows automatically and your teams stop doing software’s job by hand.', 'amatec' ); ?>
		</p>

		<div class="pf-cert-badge reveal" style="animation-delay:.12s;">
			<span class="ic"><i data-lucide="badge-check"></i></span>
			<span class="txt">
				<span class="k"><?php esc_html_e( 'Zoho', 'amatec' ); ?></span>
				<span class="v"><?php esc_html_e( 'Certified Partner', 'amatec' ); ?></span>
			</span>
		</div>

		<div class="reveal" style="display:flex;gap:14px;margin-top:24px;justify-content:center;flex-wrap:wrap;animation-delay:.15s;">
			<a href="#contact" class="btn btn-accent"><i data-lucide="calendar-clock"></i> <?php esc_html_e( 'Book a free consultation', 'amatec' ); ?></a>
			<a href="#zoho-services" class="btn btn-outline-light"><i data-lucide="arrow-down"></i> <?php esc_html_e( 'See what we build', 'amatec' ); ?></a>
		</div>

		<div class="pf-canvas-card reveal" style="max-width:760px;padding:16px 18px 18px;animation-delay:.2s;">
			<div class="bar">
				<span class="dot" style="background:var(--orange-500);"></span>
				<span class="name">lead_assignment.deluge</span>
				<span class="run"><span class="dot success"></span> <?php esc_html_e( 'Zoho CRM · function', 'amatec' ); ?></span>
			</div>
			<div class="zoho-editor" data-zoho-code>
				<div class="code">
					<?php foreach ( $code as $i => $line ) : ?>
						<div class="ln">
							<span class="no"><?php echo (int) ( $i + 1 ); ?></span>
							<span class="tx"><?php foreach ( $line as $tok ) : ?><span class="tok <?php echo esc_attr( $tok[1] ); ?>" data-text="<?php echo esc_attr( $tok[0] ); ?>"></span><?php endforeach; ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>
