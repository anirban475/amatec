<?php
/**
 * Multi Vendor SKU: "Your data" section (where the data lives and what
 * Amatec receives). Built from existing components, no CSS of its own.
 * Prints nothing when the page's settings have no 'data' entry.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$section = amatec_mvs()['data'];
if ( empty( $section ) ) {
	return;
}
?>
<section id="mvs-data" class="section" style="background:var(--bg-page);">
	<div class="wrap" style="max-width:900px;">
		<div class="sec-head center" style="max-width:680px;">
			<div class="eyebrow"><?php echo esc_html( $section['eyebrow'] ); ?></div>
			<h2 class="h2"><?php echo esc_html( $section['h2'] ); ?></h2>
		</div>

		<div class="card mvs-glance" style="margin-top:44px;">
			<ul class="prod-benefits" style="margin-top:4px;">
				<?php foreach ( $section['items'] as $x ) : ?>
					<li>
						<span class="ic"><i data-lucide="<?php echo esc_attr( $x['icon'] ); ?>"></i></span>
						<span class="d" style="margin-top:5px;">
							<?php echo esc_html( $x['d'] ); ?>
							<?php if ( ! empty( $x['href'] ) ) : ?>
								<a href="<?php echo esc_url( $x['href'] ); ?>" style="color:var(--blue-600);font-weight:500;"><?php echo esc_html( $x['link'] ); ?></a>.
							<?php endif; ?>
						</span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>
