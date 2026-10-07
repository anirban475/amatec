<?php
/**
 * Case study visual: the featured image when set, otherwise a branded
 * navy panel showing the lead platform and the headline result.
 *
 * Args: 'post_id' (int), 'size' (image size), 'tag' ('div' or 'figure').
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$post_id   = (int) $args['post_id'];
$platforms = amatec_cs_terms( $post_id, 'cs_platform' );
$lead      = $platforms ? $platforms[0] : null;
$thumb     = get_the_post_thumbnail_url( $post_id, isset( $args['size'] ) ? $args['size'] : 'large' );
$headline  = (string) get_post_meta( $post_id, '_cs_headline', true );

if ( $thumb ) : ?>
	<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>" loading="lazy">
<?php else : ?>
	<div class="cs-art<?php echo $lead ? ' cs-art--' . esc_attr( $lead->slug ) : ''; ?>" aria-hidden="true">
		<div class="dotgrid"></div>
		<?php if ( $lead ) : ?>
			<span class="cs-art-plat"><i data-lucide="<?php echo esc_attr( amatec_cs_platform_icon( $lead->slug ) ); ?>"></i><?php echo esc_html( $lead->name ); ?></span>
		<?php endif; ?>
		<?php if ( '' !== $headline ) : ?>
			<span class="cs-art-fig"><?php echo esc_html( $headline ); ?></span>
		<?php endif; ?>
	</div>
<?php endif;
