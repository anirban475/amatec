<?php
/**
 * monday.com — Rosy Zion (Dr. Miami) testimonial, editorial two-column.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$photo = get_theme_file_uri( 'assets/img/testimonial-rosy-zion.jpg' );
?>
<section id="monday-testimonial" class="testi section" style="background:var(--bg-page);border-top:0;">
	<div class="wrap">
		<div class="testi-grid">

			<div class="testi-photo reveal">
				<div class="testi-frame" style="background:transparent;">
					<img src="<?php echo esc_url( $photo ); ?>" alt="<?php esc_attr_e( 'Rosy Zion, Practice Manager for Dr. Miami', 'amatec' ); ?>" style="object-position:50% 22%;">
					<div class="scrim"></div>
				</div>
				<div class="float-chip">
					<span class="badge"><i data-lucide="calendar-check-2"></i></span>
					<span>
						<span class="k"><?php esc_html_e( 'Platform', 'amatec' ); ?></span>
						<span class="v">monday.com</span>
					</span>
				</div>
			</div>

			<div class="reveal" style="animation-delay:.1s;">
				<div class="eyebrow"><?php esc_html_e( 'TESTIMONIAL', 'amatec' ); ?></div>
				<div style="display:flex;align-items:center;gap:12px;margin-top:16px;flex-wrap:wrap;">
					<span class="t-industry"><?php esc_html_e( 'Healthcare & medical practice', 'amatec' ); ?></span>
					<span class="t-stars" style="display:inline-flex;gap:2px;margin-left:auto;">
						<?php for ( $i = 0; $i < 5; $i++ ) : ?>
							<i data-lucide="star" style="width:16px;height:16px;color:var(--orange-500);fill:var(--orange-500);"></i>
						<?php endfor; ?>
					</span>
				</div>

				<i data-lucide="quote" style="width:32px;height:32px;color:var(--orange-500);fill:var(--orange-500);display:block;margin-top:14px;"></i>

				<blockquote class="t-quote" style="margin-top:12px;">
					<span class="b"><?php esc_html_e( 'Amatec has been an incredible asset', 'amatec' ); ?></span>
					<?php esc_html_e( 'in helping us optimize and program our monday.com boards. Their expertise streamlined our workflow, making project management more efficient and organized. The team’s', 'amatec' ); ?>
					<span class="o"><?php esc_html_e( 'dedication and problem-solving skills', 'amatec' ); ?></span>
					<?php esc_html_e( 'have truly enhanced our operations. Highly recommend!', 'amatec' ); ?>
				</blockquote>

				<figcaption class="t-cap">
					<img src="<?php echo esc_url( $photo ); ?>" alt="" style="object-position:50% 20%;">
					<span>
						<span class="t-name">Rosy Zion</span>
						<span class="t-role"><?php esc_html_e( 'Practice Manager for Dr. Miami', 'amatec' ); ?></span>
					</span>
				</figcaption>
			</div>

		</div>
	</div>
</section>
