<?php
/**
 * Multi Vendor SKU hero — navy, centered, framed PO auto-fill animation.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$cta = amatec_mvs_primary_cta();
?>
<section id="mvs-hero" class="lp-hero" style="text-align:center;">
	<div class="dotgrid" aria-hidden="true"></div>
	<div class="grad" aria-hidden="true"></div>
	<div class="glow" aria-hidden="true"></div>

	<div class="wrap" style="position:relative;padding-top:80px;padding-bottom:92px;">
		<div class="hero-badge reveal">
			<span class="dot orange"></span> <?php esc_html_e( 'Zoho Inventory Extension', 'amatec' ); ?>
		</div>

		<h1 class="h1 reveal" style="margin-top:24px;max-width:940px;margin-left:auto;margin-right:auto;animation-delay:.05s;">
			<?php esc_html_e( 'Multi Vendor SKU for', 'amatec' ); ?><br>
			<span class="accent"><?php esc_html_e( 'Zoho Inventory', 'amatec' ); ?></span>
		</h1>

		<p class="lead reveal" style="margin-top:22px;color:var(--blue-100);max-width:680px;margin-left:auto;margin-right:auto;animation-delay:.1s;">
			<?php esc_html_e( 'Multi Vendor SKU is a Zoho Inventory extension that fills each vendor\'s own SKU on your purchase orders and bills, built for businesses that buy the same items from several vendors.', 'amatec' ); ?>
		</p>

		<div class="reveal" style="display:flex;gap:14px;margin-top:32px;justify-content:center;flex-wrap:wrap;animation-delay:.15s;">
			<a href="<?php echo esc_url( $cta['href'] ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-accent"><i data-lucide="<?php echo esc_attr( $cta['icon'] ); ?>"></i> <?php echo esc_html( $cta['label'] ); ?></a>
			<a href="#mvs-steps" class="btn btn-outline-light"><i data-lucide="arrow-down"></i> <?php esc_html_e( 'See how it works', 'amatec' ); ?></a>
		</div>

		<div id="mvs-demo" class="reveal" style="margin-top:56px;max-width:960px;margin-left:auto;margin-right:auto;animation-delay:.2s;">
			<div class="prod-frame">
				<div class="bar">
					<span class="d" style="background:#FF5F57;"></span>
					<span class="d" style="background:#FEBC2E;"></span>
					<span class="d" style="background:#28C840;"></span>
					<span class="addr">inventory.zoho.com · purchase order</span>
				</div>
				<?php get_template_part( 'template-parts/products/mvs-media', null, array( 'file' => '01-po-autofill', 'eager' => true, 'dark' => true, 'sizes' => '(max-width: 1000px) 100vw, 960px' ) ); ?>
			</div>
		</div>
	</div>
</section>
