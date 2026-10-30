<?php
/**
 * Multi Vendor SKU — closing conversion band (Marketplace or demo + consultation).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$mvs     = amatec_mvs();
$cta     = amatec_mvs_primary_cta();
$assures = array(
	array( 'icon' => 'puzzle', 't' => 'Runs inside Zoho Inventory' ),
	array( 'icon' => 'database', 't' => 'Your SKUs stay in your Zoho account' ),
	array( 'icon' => 'life-buoy', 't' => 'Support from the team that built it' ),
);
?>
<section id="mvs-cta" class="prod-cta">
	<div class="dotgrid" aria-hidden="true"></div>
	<div class="grad" aria-hidden="true"></div>
	<div class="glow-l" aria-hidden="true"></div>
	<div class="wrap section inner" style="text-align:center;">
		<div class="eyebrow on-dark"><?php esc_html_e( 'READY WHEN YOU ARE', 'amatec' ); ?></div>
		<h2 class="h2" style="margin-top:14px;color:#fff;max-width:760px;margin-left:auto;margin-right:auto;"><?php esc_html_e( 'Stop typing vendor codes by hand', 'amatec' ); ?></h2>
		<p class="lead" style="margin-top:18px;color:var(--blue-100);max-width:600px;margin-left:auto;margin-right:auto;">
			<?php
			if ( '' !== $mvs['marketplace'] ) {
				esc_html_e( 'Install Multi Vendor SKU from Zoho Marketplace, or talk to the team that built it about your purchasing process in Zoho.', 'amatec' );
			} else {
				esc_html_e( 'Book a demo to see Multi Vendor SKU in Zoho Inventory, or talk to the team that built it about your purchasing process in Zoho.', 'amatec' );
			}
			?>
		</p>

		<div style="display:flex;gap:14px;margin-top:32px;justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( $cta['href'] ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-accent"><i data-lucide="<?php echo esc_attr( $cta['icon'] ); ?>"></i> <?php echo esc_html( $cta['label'] ); ?></a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline-light"><i data-lucide="calendar-clock"></i> <?php esc_html_e( 'Book a consultation', 'amatec' ); ?></a>
		</div>

		<div class="prod-assure">
			<?php foreach ( $assures as $r ) : ?>
				<span><i data-lucide="<?php echo esc_attr( $r['icon'] ); ?>"></i><?php echo esc_html( $r['t'] ); ?></span>
			<?php endforeach; ?>
		</div>
	</div>
</section>
