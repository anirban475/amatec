<?php
/**
 * Blog list — a single post card (used inside the WP loop).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$cats = get_the_category();
$cat_names = array();
foreach ( $cats as $c ) { $cat_names[] = $c->name; }

// Featured image, or the bundled blog banner as a graceful fallback.
$thumb = get_the_post_thumbnail_url( get_the_ID(), 'large' );
if ( ! $thumb ) { $thumb = get_theme_file_uri( 'assets/img/blog-banner.jpg' ); }
?>
<article <?php post_class( 'blog-card reveal' ); ?>>
	<a class="bc-img" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
	</a>
	<a class="bc-body" href="<?php the_permalink(); ?>">
		<?php if ( $cat_names ) : ?>
			<div class="bc-cats"><?php echo esc_html( implode( ', ', $cat_names ) ); ?></div>
		<?php endif; ?>
		<h3 class="bc-title"><?php the_title(); ?></h3>
		<p class="bc-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 30 ) ); ?></p>
		<span class="bc-more">Read article <i data-lucide="arrow-right"></i></span>
	</a>
</article>
