<?php
/**
 * Home — testimonial: editorial client story.
 * Portrait uses a branded placeholder frame (drop a real photo into
 * assets/img/testimonial-nicholas-baron.jpg to replace it).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$photo      = get_theme_file_path( 'assets/img/testimonial-nicholas-baron.jpg' );
$photo_uri  = get_theme_file_uri( 'assets/img/testimonial-nicholas-baron.jpg' );
$has_photo  = file_exists( $photo );
?>
<section id="testimonial" class="section testi">
	<div class="wrap">
		<div class="testi-grid">

			<div class="testi-photo reveal">
				<div class="testi-frame">
					<?php if ( $has_photo ) : ?>
						<img src="<?php echo esc_url( $photo_uri ); ?>" alt="Nicholas Baron, produitsducap.com">
						<div class="scrim"></div>
					<?php else : ?>
						<div class="founder-frame stripes" style="position:absolute;inset:0;"></div>
						<div class="ph-label" style="position:absolute;inset:0;display:grid;place-items:center;">
							<span style="font-family:var(--font-mono);font-size:12px;letter-spacing:.08em;text-transform:uppercase;color:var(--blue-200);border:1px dashed rgba(255,255,255,0.28);padding:8px 14px;border-radius:8px;">Client portrait</span>
						</div>
					<?php endif; ?>
				</div>
				<div class="float-chip">
					<span class="badge"><i data-lucide="sprout"></i></span>
					<span>
						<span class="k">Partner since</span>
						<span class="v">2020</span>
					</span>
				</div>
			</div>

			<div class="testi-copy reveal" style="animation-delay:.1s;">
				<div class="eyebrow">TESTIMONIAL</div>
				<div style="display:flex;align-items:center;gap:10px;margin-top:18px;">
					<i data-lucide="quote" style="color:var(--orange-500);fill:var(--orange-500);width:30px;height:30px;"></i>
					<span class="t-industry">Agriculture &amp; food processing</span>
				</div>
				<blockquote class="t-quote">
					We&rsquo;re a small business in the agriculture and food processing industry, growing while
					keeping overhead small, and that is exactly where
					<span class="b">AMATEC has become a partner since 2020</span>.
					Whether connecting our three main work tools, creating file and calendar automations, or building a
					custom production-management application, we work with them
					<span class="o">small steps at a time</span>, depending on
					our budget and needs. They are now an important part of our resources whenever problem-solving is
					required to improve our operations and systems.
				</blockquote>
				<figcaption class="t-cap">
					<?php if ( $has_photo ) : ?>
						<img src="<?php echo esc_url( $photo_uri ); ?>" alt="">
					<?php else : ?>
						<span style="width:52px;height:52px;border-radius:999px;background:var(--grad-blue);color:#fff;display:grid;place-items:center;font-family:var(--font-display);font-weight:700;box-shadow:var(--shadow-sm);">NB</span>
					<?php endif; ?>
					<span>
						<span class="t-name">Nicholas Baron</span>
						<span class="t-role">CEO, <a href="https://produitsducap.com" target="_blank" rel="noopener noreferrer">produitsducap.com</a></span>
					</span>
				</figcaption>
			</div>

		</div>
	</div>
</section>
