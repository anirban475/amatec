<?php
/**
 * Blog list body — navy hero + 3-up card grid + pagination.
 * Shared by home.php (posts page) and archive.php.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Work out the hero title/subtitle for the current context.
$title = __( 'Automation insights &amp; guides', 'amatec' );
$sub   = __( 'Practical playbooks on workflow automation — n8n, Make, Monday and Zoho — to help your team stop doing what software should do for them.', 'amatec' );
$badge = __( 'Blog', 'amatec' );

if ( is_category() || is_tag() || is_tax() ) {
	$title = single_term_title( '', false );
	$sub   = term_description() ? wp_strip_all_tags( term_description() ) : $sub;
	$badge = is_category() ? __( 'Category', 'amatec' ) : __( 'Topic', 'amatec' );
} elseif ( is_search() ) {
	/* translators: %s: search query. */
	$title = sprintf( __( 'Results for &ldquo;%s&rdquo;', 'amatec' ), get_search_query() );
	$badge = __( 'Search', 'amatec' );
} elseif ( is_author() ) {
	$title = get_the_author();
	$badge = __( 'Author', 'amatec' );
} elseif ( is_date() ) {
	$title = get_the_archive_title();
	$badge = __( 'Archive', 'amatec' );
}
?>
<section class="blog-hero">
	<div class="dotgrid" style="position:absolute;inset:0;opacity:.28;pointer-events:none;"></div>
	<div class="grad"></div>
	<div class="glow"></div>
	<div class="wrap inner">
		<div class="badge reveal"><span class="dot orange"></span> <?php echo esc_html( $badge ); ?></div>
		<h1 class="h1 reveal" style="animation-delay:.05s;"><?php echo wp_kses_post( $title ); ?></h1>
		<p class="lead reveal" style="animation-delay:.1s;"><?php echo wp_kses_post( $sub ); ?></p>
	</div>
</section>

<section class="section" style="background:var(--bg-page);">
	<div class="wrap">
		<?php if ( have_posts() ) : ?>
			<div class="blog-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/blog/card' );
				endwhile;
				?>
			</div>

			<?php
			the_posts_pagination( array(
				'class'              => 'blog-pager',
				'mid_size'           => 1,
				'prev_text'          => __( 'Prev', 'amatec' ),
				'next_text'          => __( 'Next', 'amatec' ),
				'screen_reader_text' => __( 'Blog pagination', 'amatec' ),
			) );
			?>
		<?php else : ?>
			<div class="sec-head" style="text-align:center;margin:0 auto;">
				<h2 class="h2"><?php esc_html_e( 'No posts yet', 'amatec' ); ?></h2>
				<p class="lead"><?php esc_html_e( 'New automation guides are on the way — check back soon.', 'amatec' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</section>
