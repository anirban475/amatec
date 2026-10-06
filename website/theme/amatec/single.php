<?php
/**
 * Single blog post — AMATEC design, driven entirely by the WP post.
 * Title, featured image, date, categories and body all come from WordPress,
 * so new posts are written from Posts → Add New.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

while ( have_posts() ) :
	the_post();

	$cats      = get_the_category();
	$blog_url  = get_permalink( get_option( 'page_for_posts' ) );
	if ( ! $blog_url ) { $blog_url = home_url( '/' ); }
	$banner    = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	if ( ! $banner ) { $banner = get_theme_file_uri( 'assets/img/blog-banner.jpg' ); }
	?>

	<article <?php post_class(); ?>>

		<!-- ===== HERO ===== -->
		<section class="post-hero">
			<div class="glow-a"></div>
			<div class="glow-b"></div>
			<div class="wrap inner">
				<a class="post-back reveal" href="<?php echo esc_url( $blog_url ); ?>"><i data-lucide="arrow-left"></i> <?php esc_html_e( 'Blogs', 'amatec' ); ?></a>

				<figure class="post-banner reveal" style="animation-delay:.04s;">
					<div class="frame"><img src="<?php echo esc_url( $banner ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>"></div>
					<?php
					$caption = get_the_post_thumbnail_caption();
					if ( $caption ) :
						?>
						<figcaption><?php echo esc_html( $caption ); ?></figcaption>
					<?php endif; ?>
				</figure>

				<?php if ( $cats ) : ?>
					<div class="post-chips reveal" style="animation-delay:.08s;">
						<?php foreach ( $cats as $c ) : ?>
							<a class="chip" href="<?php echo esc_url( get_category_link( $c->term_id ) ); ?>"><?php echo esc_html( $c->name ); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<h1 class="h1 reveal" style="animation-delay:.12s;"><?php the_title(); ?></h1>

				<div class="post-meta reveal" style="animation-delay:.16s;">
					<span class="post-date"><i data-lucide="calendar"></i> <?php echo esc_html( get_the_date() ); ?></span>
					<div class="post-share">
						<span class="lbl"><?php esc_html_e( 'Share', 'amatec' ); ?></span>
						<?php amatec_share_links(); ?>
					</div>
				</div>
			</div>
		</section>

		<!-- ===== BODY ===== -->
		<section class="post-body section" style="padding-top:72px;">
			<div class="wrap">
				<div class="blog-layout">

					<div class="prose" data-prose>
						<?php the_content(); ?>
						<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'amatec' ),
							'after'  => '</div>',
						) );
						?>

						<!-- end-of-article CTA -->
						<div id="cal-booking" class="post-cta">
							<div class="dotgrid"></div>
							<div class="inner">
								<div class="eyebrow on-dark"><?php esc_html_e( 'Ready to automate', 'amatec' ); ?></div>
								<h3><?php esc_html_e( 'Book your free workflow audit', 'amatec' ); ?></h3>
								<p><?php esc_html_e( 'Pick a time that works for you and talk to an automation expert — or fill the form below and we’ll call you back.', 'amatec' ); ?></p>
								<div class="cal-wrap">
									<div id="cal-single" class="cal-inline" data-cal-inline data-cal-ns="meeting" data-cal-link="amatec/meeting" data-cal-theme="dark"></div>
								</div>
							</div>
						</div>

						<!-- previous / next -->
						<?php
						$prev = get_previous_post();
						$next = get_next_post();
						if ( $prev || $next ) :
							?>
							<div class="postnav">
								<?php if ( $prev ) : ?>
									<a class="card prev-post" href="<?php echo esc_url( get_permalink( $prev ) ); ?>">
										<span class="ic"><i data-lucide="arrow-left"></i></span>
										<span><span class="k"><?php esc_html_e( 'Previous post', 'amatec' ); ?></span><span class="t"><?php echo esc_html( get_the_title( $prev ) ); ?></span></span>
									</a>
								<?php else : ?><span></span><?php endif; ?>
								<?php if ( $next ) : ?>
									<a class="card prev-post next" href="<?php echo esc_url( get_permalink( $next ) ); ?>">
										<span class="ic"><i data-lucide="arrow-right"></i></span>
										<span><span class="k"><?php esc_html_e( 'Next post', 'amatec' ); ?></span><span class="t"><?php echo esc_html( get_the_title( $next ) ); ?></span></span>
									</a>
								<?php else : ?><span></span><?php endif; ?>
							</div>
						<?php endif; ?>
					</div>

					<!-- sticky sidebar -->
					<aside class="blog-aside">
						<div data-toc-wrap>
							<div class="side-label"><?php esc_html_e( 'On this page', 'amatec' ); ?></div>
							<ul class="toc-list" data-toc></ul>
						</div>

						<div class="aside-block">
							<div class="side-label"><?php esc_html_e( 'Newsletter', 'amatec' ); ?></div>
							<p><?php esc_html_e( 'Join our newsletter for expert tips on no-code and AI automation.', 'amatec' ); ?></p>
							<form class="newsletter-form" data-newsletter-form>
								<input type="text" name="ns_website" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0;">
								<input type="email" name="ns_email" class="fld" placeholder="you@company.com" required>
								<button class="btn btn-primary" type="submit" style="justify-content:center;"><?php esc_html_e( 'Subscribe', 'amatec' ); ?></button>
								<p class="newsletter-msg" role="status" hidden></p>
							</form>
						</div>

						<div class="aside-quote">
							<i data-lucide="quote"></i>
							<p><?php esc_html_e( '“Don’t work harder — automate smarter. Innovation begins where repetition ends.”', 'amatec' ); ?></p>
						</div>
					</aside>

				</div>
			</div>
		</section>
	</article>

	<?php get_template_part( 'template-parts/blog/consultation' ); ?>

	<!-- ===== COMMENTS ===== -->
	<section class="comments">
		<div class="wrap">
			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
		</div>
	</section>

	<?php
endwhile;

get_footer();
