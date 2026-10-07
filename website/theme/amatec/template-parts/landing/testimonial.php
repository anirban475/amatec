<?php
/**
 * Landing testimonial — editorial two-column with portrait.
 *
 * Mirrors template-parts/platforms/monday-testimonial.php, but data-driven from
 * the landing-page entry's optional `testimonial` array (inc/lp-pages.php).
 * Renders nothing if no testimonial is defined for the page.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$data = $args['data'];
if ( empty( $data['testimonial'] ) ) {
	return;
}
$t = $data['testimonial'];

$photo = get_theme_file_uri( 'assets/img/' . $t['photo'] );
?>
<section id="lp-testimonial" class="testi section" style="background:var(--bg-page);border-top:0;">
	<div class="wrap">
		<div class="testi-grid">

			<div class="testi-photo reveal">
				<div class="testi-frame" style="background:transparent;">
					<img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $t['alt'] ); ?>" style="object-position:50% 22%;">
					<div class="scrim"></div>
				</div>
				<?php if ( ! empty( $t['platform'] ) ) : ?>
				<div class="float-chip">
					<span class="badge"><i data-lucide="<?php echo esc_attr( ! empty( $t['platform_icon'] ) ? $t['platform_icon'] : 'calendar-check-2' ); ?>"></i></span>
					<span>
						<span class="k"><?php esc_html_e( 'Platform', 'amatec' ); ?></span>
						<span class="v"><?php echo esc_html( $t['platform'] ); ?></span>
					</span>
				</div>
				<?php endif; ?>
			</div>

			<div class="reveal" style="animation-delay:.1s;">
				<div class="eyebrow"><?php esc_html_e( 'TESTIMONIAL', 'amatec' ); ?></div>
				<div style="display:flex;align-items:center;gap:12px;margin-top:16px;flex-wrap:wrap;">
					<span class="t-industry"><?php echo esc_html( $t['industry'] ); ?></span>
					<span class="t-stars" style="display:inline-flex;gap:2px;margin-left:auto;">
						<?php for ( $i = 0; $i < 5; $i++ ) : ?>
							<i data-lucide="star" style="width:16px;height:16px;color:var(--orange-500);fill:var(--orange-500);"></i>
						<?php endfor; ?>
					</span>
				</div>

				<i data-lucide="quote" style="width:32px;height:32px;color:var(--orange-500);fill:var(--orange-500);display:block;margin-top:14px;"></i>

				<blockquote class="t-quote" style="margin-top:12px;">
					<?php
					foreach ( $t['quote'] as $seg ) :
						$style = $seg[0];
						$text  = $seg[1];
						if ( 'b' === $style || 'o' === $style ) :
							?>
							<span class="<?php echo esc_attr( $style ); ?>"><?php echo esc_html( $text ); ?></span>
							<?php
						else :
							echo ' ' . esc_html( $text ) . ' ';
						endif;
					endforeach;
					?>
				</blockquote>

				<figcaption class="t-cap">
					<img src="<?php echo esc_url( $photo ); ?>" alt="" style="object-position:50% 20%;">
					<span>
						<span class="t-name"><?php echo esc_html( $t['name'] ); ?></span>
						<span class="t-role"><?php echo esc_html( $t['role'] ); ?></span>
					</span>
				</figcaption>
			</div>

		</div>
	</div>
</section>
