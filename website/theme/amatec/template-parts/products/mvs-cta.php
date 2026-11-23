<?php
/**
 * Multi Vendor SKU — closing conversion band (Marketplace or demo + consultation).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$mvs     = amatec_mvs();
$cta     = amatec_mvs_primary_cta();
$section = $mvs['cta'];
$assures = $section['assures'];
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
				echo esc_html( $section['text_marketplace'] );
			} else {
				echo esc_html( $section['text_demo'] );
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
