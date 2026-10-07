<?php
/**
 * Case study card (used inside the loop and for related case studies).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$cs_id     = get_the_ID();
$cs        = amatec_cs_data( $cs_id );
$platforms = amatec_cs_terms( $cs_id, 'cs_platform' );
?>
<article <?php post_class( 'blog-card cs-card reveal' ); ?>>
	<a class="bc-img" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php get_template_part( 'template-parts/case-studies/art', null, array( 'post_id' => $cs_id ) ); ?>
	</a>
	<a class="bc-body" href="<?php the_permalink(); ?>">
		<?php if ( $platforms ) : ?>
			<div class="bc-cats"><?php echo esc_html( implode( ' · ', wp_list_pluck( $platforms, 'name' ) ) ); ?></div>
		<?php endif; ?>
		<h3 class="bc-title"><?php the_title(); ?></h3>
		<p class="cs-client"><i data-lucide="building-2"></i><?php echo esc_html( amatec_cs_client_line( $cs ) ); ?></p>
		<?php if ( '' !== $cs['headline'] ) : ?>
			<p class="cs-headline"><?php echo esc_html( $cs['headline'] ); ?></p>
		<?php endif; ?>
		<span class="bc-more"><?php esc_html_e( 'Read case study', 'amatec' ); ?> <i data-lucide="arrow-right"></i></span>
	</a>
</article>
