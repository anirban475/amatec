<?php
/**
 * Stock Procurement hero — navy, centered, framed product demo slot.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$marketplace = 'https://marketplace.zoho.in/app/inventory/stock-procurement-for-zoho-inventory';
?>
<section id="sp-hero" class="lp-hero" style="text-align:center;">
	<div class="dotgrid" aria-hidden="true"></div>
	<div class="grad" aria-hidden="true"></div>
	<div class="glow" aria-hidden="true"></div>

	<div class="wrap" style="position:relative;padding-top:80px;padding-bottom:92px;">
		<div class="hero-badge reveal">
			<span class="dot orange"></span> <?php esc_html_e( 'Zoho Inventory Extension', 'amatec' ); ?>
		</div>

		<h1 class="h1 reveal" style="margin-top:24px;max-width:940px;margin-left:auto;margin-right:auto;animation-delay:.05s;">
			<?php esc_html_e( 'Stock Procurement for', 'amatec' ); ?><br>
			<span class="accent"><?php esc_html_e( 'Zoho Inventory', 'amatec' ); ?></span>
		</h1>

		<p class="lead reveal" style="margin-top:22px;color:var(--blue-100);max-width:640px;margin-left:auto;margin-right:auto;animation-delay:.1s;">
			<?php esc_html_e( 'Automate raw-material planning for composite items with precision and ease. Break down any bundle into exactly what you need to purchase, in seconds, inside Zoho.', 'amatec' ); ?>
		</p>

		<div class="reveal" style="display:flex;gap:14px;margin-top:32px;justify-content:center;flex-wrap:wrap;animation-delay:.15s;">
			<a href="<?php echo esc_url( $marketplace ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-accent"><i data-lucide="external-link"></i> <?php esc_html_e( 'Go to Extension', 'amatec' ); ?></a>
			<a href="#sp-features" class="btn btn-outline-light"><i data-lucide="arrow-down"></i> <?php esc_html_e( 'See what it does', 'amatec' ); ?></a>
		</div>

		<div id="sp-demo" class="reveal" style="margin-top:56px;max-width:920px;margin-left:auto;margin-right:auto;animation-delay:.2s;">
			<div class="prod-frame">
				<div class="bar">
					<span class="d" style="background:#FF5F57;"></span>
					<span class="d" style="background:#FEBC2E;"></span>
					<span class="d" style="background:#28C840;"></span>
					<span class="addr">inventory.zoho.com · stock-procurement</span>
				</div>
				<div class="media dark">
					<div class="ph">
						<span class="play"><i data-lucide="play"></i></span>
						<span class="cap"><?php esc_html_e( 'Demo video coming soon', 'amatec' ); ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
