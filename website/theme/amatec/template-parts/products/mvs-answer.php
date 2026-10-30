<?php
/**
 * Multi Vendor SKU — quotable answer block (AIO) + at-a-glance facts card.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$mvs   = amatec_mvs();
$facts = array(
	array( 'k' => 'Works with', 'v' => 'Zoho Inventory, any edition and data centre' ),
	array( 'k' => 'Install from', 'v' => 'Zoho Marketplace', 'href' => $mvs['marketplace'] ),
	array( 'k' => 'Built for', 'v' => 'Distributors, wholesalers, manufacturers, spare parts and industrial supply companies' ),
	array( 'k' => 'Your data', 'v' => 'Stays in your Zoho Inventory account' ),
	array( 'k' => 'Language', 'v' => 'English' ),
	array( 'k' => 'Price', 'v' => $mvs['price'] ),
	array( 'k' => 'Support', 'v' => $mvs['email'], 'href' => 'mailto:' . $mvs['email'] ),
	array( 'k' => 'Also by Amatec', 'v' => 'Stock Procurement for Zoho Inventory', 'href' => home_url( '/stock-procurement-for-zoho-inventory/' ) ),
	array( 'k' => 'Custom work', 'v' => 'Zoho workflow automation', 'href' => home_url( '/zoho-workflow-automation/' ) ),
);
?>
<section id="mvs-answer" class="section" style="background:var(--bg-page);">
	<div class="wrap">
		<div class="mvs-answer-grid">

			<div>
				<div class="eyebrow"><?php esc_html_e( 'IN SHORT', 'amatec' ); ?></div>
				<h2 class="h2" style="margin-top:14px;"><?php esc_html_e( 'What is Multi Vendor SKU?', 'amatec' ); ?></h2>
				<p class="lead mvs-answer" style="margin-top:18px;">
					<?php esc_html_e( 'Multi Vendor SKU for Zoho Inventory is an extension that stores a different SKU for each vendor you buy an item from. It fills those vendor SKUs on purchase orders and bills, so your buyers stop typing vendor codes by hand and stop matching vendor bills to items by eye. It runs inside Zoho Inventory, installs from Zoho Marketplace, and keeps every SKU in your own Zoho account.', 'amatec' ); ?>
				</p>
			</div>

			<div class="card mvs-glance">
				<div class="mvs-glance-head"><i data-lucide="clipboard-list"></i> <?php esc_html_e( 'At a glance', 'amatec' ); ?></div>
				<dl>
					<?php foreach ( $facts as $f ) : ?>
						<div class="row">
							<dt><?php echo esc_html( $f['k'] ); ?></dt>
							<dd>
								<?php if ( ! empty( $f['href'] ) ) : ?>
									<a href="<?php echo esc_url( $f['href'] ); ?>"><?php echo esc_html( $f['v'] ); ?></a>
								<?php else : ?>
									<?php echo esc_html( $f['v'] ); ?>
								<?php endif; ?>
							</dd>
						</div>
					<?php endforeach; ?>
				</dl>
			</div>

		</div>
	</div>
</section>
