<?php
/**
 * Multi Vendor SKU — data and privacy summary, linked to the Privacy Policy.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$points = array(
	array( 'icon' => 'database', 'd' => 'Your vendor SKUs are stored in your own Zoho Inventory account, in the Vendor SKUs module and the Vendor SKU item field.' ),
	array( 'icon' => 'shield-check', 'd' => 'The app does not copy your purchase orders, bills, items or vendors out of Zoho.' ),
	array( 'icon' => 'send', 'd' => 'On install and uninstall only, the app sends Amatec your organization ID, organization name, the installer\'s email, the date and the app version.' ),
	array( 'icon' => 'mail', 'd' => 'Amatec uses those details to send you a setup guide and to give support.' ),
);
?>
<section id="mvs-data" class="section" style="background:var(--bg-subtle);">
	<div class="wrap">
		<div class="prod-overview-grid" style="align-items:start;">

			<div>
				<div class="eyebrow"><?php esc_html_e( 'DATA AND PRIVACY', 'amatec' ); ?></div>
				<h2 class="h2" style="margin-top:14px;"><?php esc_html_e( 'Where your data lives', 'amatec' ); ?></h2>
				<p class="lead" style="margin-top:18px;"><?php esc_html_e( 'Your SKUs stay in your Zoho account. Amatec receives five details about your organization, and only when you install or uninstall.', 'amatec' ); ?></p>
				<a class="mvs-link" href="<?php echo esc_url( home_url( '/privacypolicy/#zoho-apps' ) ); ?>">
					<?php esc_html_e( 'Read the Zoho Marketplace apps section of our Privacy Policy', 'amatec' ); ?> <i data-lucide="arrow-right"></i>
				</a>
			</div>

			<ul class="card mvs-data-list">
				<?php foreach ( $points as $p ) : ?>
					<li>
						<span class="ic"><i data-lucide="<?php echo esc_attr( $p['icon'] ); ?>"></i></span>
						<span><?php echo esc_html( $p['d'] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>

		</div>
	</div>
</section>
