<?php
/**
 * "More case studies": up to 3 others, same platform first, newest first.
 *
 * Args: 'post_id' (int), 'platforms' (WP_Term[]).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$exclude = array( (int) $args['post_id'] );
$related = array();

if ( ! empty( $args['platforms'] ) ) {
	$related = get_posts( array(
		'post_type'    => AMATEC_CS_TYPE,
		'numberposts'  => 3,
		'post__not_in' => $exclude,
		'tax_query'    => array( array(
			'taxonomy' => 'cs_platform',
			'field'    => 'term_id',
			'terms'    => wp_list_pluck( $args['platforms'], 'term_id' ),
		) ),
	) );
}
if ( count( $related ) < 3 ) {
	$related = array_merge( $related, get_posts( array(
		'post_type'    => AMATEC_CS_TYPE,
		'numberposts'  => 3 - count( $related ),
		'post__not_in' => array_merge( $exclude, wp_list_pluck( $related, 'ID' ) ),
	) ) );
}

if ( ! $related ) {
	return;
}

global $post;
?>
<section class="section cs-related" style="background:var(--bg-subtle);">
	<div class="wrap">
		<div class="sec-head" style="margin-bottom:36px;">
			<div class="eyebrow"><?php esc_html_e( 'MORE CASE STUDIES', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'Other projects like this', 'amatec' ); ?></h2>
		</div>
		<div class="blog-grid cs-grid">
			<?php
			foreach ( $related as $post ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				setup_postdata( $post );
				get_template_part( 'template-parts/case-studies/card' );
			endforeach;
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
