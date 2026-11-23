<?php
/**
 * Multi Vendor SKU — six feature cards with screenshots, plus the extras row.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Every card's media box is 16:10 (images crop from the top left), so all six cards match.
$section  = amatec_mvs()['features'];
$features = $section['items'];
$extras   = $section['extras'];
?>
<section id="mvs-features" class="section" style="background:var(--bg-subtle);">
	<div class="wrap">
		<div class="sec-head center" style="max-width:680px;">
			<div class="eyebrow"><?php esc_html_e( 'WHAT IT DOES', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'What Multi Vendor SKU does on your POs and bills', 'amatec' ); ?></h2>
			<p class="lead"><?php echo esc_html( $section['lead'] ); ?></p>
		</div>

		<div class="mvs-feat-grid">
			<?php foreach ( $features as $f ) : ?>
				<div class="card mvs-feat">
					<?php get_template_part(
						'template-parts/products/mvs-media',
						null,
						array(
							'file'  => $f['file'],
							'ratio' => '16 / 10',
							'zoom'  => true,
							'sizes' => '(max-width: 640px) 100vw, (max-width: 980px) 50vw, 380px',
						)
					); ?>
					<div class="body">
						<h3 class="h3"><?php echo esc_html( $f['t'] ); ?></h3>
						<p><?php echo esc_html( $f['d'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="card mvs-extras">
			<div>
				<div class="eyebrow"><?php esc_html_e( 'ALSO IN THE APP', 'amatec' ); ?></div>
				<ul class="prod-benefits">
					<?php foreach ( $extras as $x ) : ?>
						<li>
							<span class="ic"><i data-lucide="<?php echo esc_attr( $x['icon'] ); ?>"></i></span>
							<span>
								<span class="t"><?php echo esc_html( $x['t'] ); ?></span>
								<span class="d"><?php echo esc_html( $x['d'] ); ?></span>
							</span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php get_template_part( 'template-parts/products/mvs-media', null, array( 'file' => $section['extras_file'], 'zoom' => true, 'sizes' => '(max-width: 980px) 100vw, 560px' ) ); ?>
		</div>
	</div>
</section>
