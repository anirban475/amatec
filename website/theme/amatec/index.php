<?php
/**
 * Fallback template — blog / archive / search listing.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>
<section class="section">
	<div class="wrap" style="max-width:900px;">
		<?php if ( have_posts() ) : ?>
			<header class="sec-head" style="margin-bottom:40px;">
				<div class="eyebrow"><?php is_search() ? esc_html_e( 'Search results', 'amatec' ) : esc_html_e( 'Latest', 'amatec' ); ?></div>
				<h1 class="h2" style="margin-top:12px;">
					<?php
					if ( is_search() ) {
						/* translators: %s: search query. */
						printf( esc_html__( 'Results for &ldquo;%s&rdquo;', 'amatec' ), esc_html( get_search_query() ) );
					} elseif ( is_archive() ) {
						the_archive_title();
					} else {
						bloginfo( 'name' );
					}
					?>
				</h1>
			</header>

			<div style="display:flex;flex-direction:column;gap:28px;">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article <?php post_class( 'card' ); ?> style="padding:28px 30px;">
						<h2 class="h3" style="font-size:24px;">
							<a href="<?php the_permalink(); ?>" style="color:var(--fg1);"><?php the_title(); ?></a>
						</h2>
						<div style="font-family:var(--font-mono);font-size:12.5px;color:var(--fg3);margin-top:8px;letter-spacing:.04em;text-transform:uppercase;">
							<?php echo esc_html( get_the_date() ); ?>
						</div>
						<div style="margin-top:14px;color:var(--fg2);line-height:1.6;"><?php the_excerpt(); ?></div>
						<a class="btn btn-secondary" href="<?php the_permalink(); ?>" style="margin-top:18px;">Read more <i data-lucide="arrow-right"></i></a>
					</article>
					<?php
				endwhile;
				?>
			</div>

			<div style="margin-top:40px;"><?php the_posts_pagination(); ?></div>
		<?php else : ?>
			<header class="sec-head">
				<h1 class="h2"><?php esc_html_e( 'Nothing found', 'amatec' ); ?></h1>
				<p class="lead"><?php esc_html_e( 'No content matched your request.', 'amatec' ); ?></p>
			</header>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
