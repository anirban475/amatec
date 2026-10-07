<?php
/**
 * Case study filters: plain links (crawlable, no JavaScript) to the
 * platform and industry lists. The current filter is highlighted.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$current    = get_queried_object();
$current_id = ( $current instanceof WP_Term ) ? $current->term_id : 0;
$all_url    = get_post_type_archive_link( AMATEC_CS_TYPE );
$groups     = array(
	'cs_platform' => __( 'Platform', 'amatec' ),
	'cs_industry' => __( 'Industry', 'amatec' ),
);
?>
<nav class="cs-filters" aria-label="<?php esc_attr_e( 'Filter case studies', 'amatec' ); ?>">
	<?php
	$first = true;
	foreach ( $groups as $taxonomy => $label ) :
		$terms = get_terms( array( 'taxonomy' => $taxonomy, 'hide_empty' => true ) );
		if ( ! $terms || is_wp_error( $terms ) ) {
			continue;
		}
		?>
		<div class="cs-filter-row">
			<span class="cs-filter-label"><?php echo esc_html( $label ); ?></span>
			<?php if ( $first ) : ?>
				<a class="cs-pill<?php echo 0 === $current_id ? ' is-active' : ''; ?>" href="<?php echo esc_url( $all_url ); ?>"><?php esc_html_e( 'All', 'amatec' ); ?></a>
			<?php endif; ?>
			<?php foreach ( $terms as $t ) : ?>
				<a class="cs-pill<?php echo $t->term_id === $current_id ? ' is-active' : ''; ?>" href="<?php echo esc_url( get_term_link( $t ) ); ?>"><?php echo esc_html( $t->name ); ?> <span class="n"><?php echo (int) $t->count; ?></span></a>
			<?php endforeach; ?>
		</div>
		<?php
		$first = false;
	endforeach;
	?>
</nav>
