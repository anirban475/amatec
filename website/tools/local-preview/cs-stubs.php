<?php
/**
 * Local preview: case study data and the WordPress functions the case study
 * templates need. Loaded by router.php. Case studies come from
 * case-studies/content/*.json (or AMATEC_CS_DIR).
 */

class WP_Term {
	public $term_id;
	public $name;
	public $slug;
	public $taxonomy;
	public $count = 0;
	public function __construct( $taxonomy, $slug, $name ) {
		$this->taxonomy = $taxonomy;
		$this->slug     = $slug;
		$this->name     = $name;
		$this->term_id  = crc32( $taxonomy . ':' . $slug );
	}
}

function am_cs_dir() {
	return am_first_path( array( getenv( 'AMATEC_CS_DIR' ), __DIR__ . '/../case-studies/content', __DIR__ . '/../../case-studies/content' ) );
}

function am_slugify( $s ) {
	return trim( preg_replace( '/[^a-z0-9]+/', '-', strtolower( $s ) ), '-' );
}

/** All case studies as post objects, newest first. */
function am_case_studies() {
	static $posts = null;
	if ( null !== $posts ) { return $posts; }
	$posts = array();
	$dir   = am_cs_dir();
	if ( ! $dir ) { return $posts; }
	$names = array( 'make' => 'Make.com', 'n8n' => 'n8n', 'zoho' => 'Zoho', 'monday' => 'monday.com', 'ai' => 'AI' );
	foreach ( glob( $dir . '/*.json' ) as $i => $file ) {
		$d = json_decode( file_get_contents( $file ), true );
		if ( ! $d || empty( $d['slug'] ) ) { continue; }
		$faq_text = '';
		foreach ( (array) $d['faqs'] as $f ) {
			$faq_text .= 'Q: ' . $f['q'] . "\nA: " . $f['a'] . "\n\n";
		}
		$plat = array();
		foreach ( (array) $d['platforms'] as $p ) {
			$plat[] = new WP_Term( 'cs_platform', $p, isset( $names[ $p ] ) ? $names[ $p ] : $p );
		}
		$posts[] = (object) array(
			'ID'           => 5000 + $i,
			'post_type'    => 'amatec_case_study',
			'post_name'    => $d['slug'],
			'post_title'   => $d['title'],
			'post_content' => $d['body_html'],
			'excerpt'      => $d['excerpt'],
			'post_date'    => date( 'Y-m-d H:i:s', filemtime( $file ) ),
			'image'        => '',
			'cats'         => array(),
			'meta'         => array(
				'_cs_client_name' => $d['client_name'],
				'_cs_client_desc' => $d['client_desc'],
				'_cs_country'     => $d['country'],
				'_cs_year'        => $d['year'],
				'_cs_headline'    => $d['headline_result'],
				'_cs_results'     => implode( "\n", (array) $d['results'] ),
				'_cs_tools'       => implode( "\n", (array) $d['tools'] ),
				'_cs_faqs'        => trim( $faq_text ),
			),
			'terms'        => array(
				'cs_platform' => $plat,
				'cs_industry' => $d['industry'] ? array( new WP_Term( 'cs_industry', am_slugify( $d['industry'] ), $d['industry'] ) ) : array(),
			),
		);
	}
	usort( $posts, function ( $a, $b ) { return strcmp( $b->post_date, $a->post_date ) ?: strcmp( $a->post_name, $b->post_name ); } );
	return $posts;
}

function am_cs_by_id( $id ) {
	foreach ( am_case_studies() as $p ) {
		if ( $p->ID === (int) $id ) { return $p; }
	}
	return null;
}

function get_post_meta( $id, $key = '', $single = false ) {
	$p = am_cs_by_id( $id );
	return ( $p && isset( $p->meta[ $key ] ) ) ? $p->meta[ $key ] : '';
}

function get_the_terms( $id, $taxonomy ) {
	$p = am_cs_by_id( is_object( $id ) ? $id->ID : $id );
	return ( $p && ! empty( $p->terms[ $taxonomy ] ) ) ? $p->terms[ $taxonomy ] : false;
}

function get_terms( $args = array() ) {
	$tax = is_array( $args ) ? $args['taxonomy'] : $args;
	$out = array();
	foreach ( am_case_studies() as $p ) {
		foreach ( $p->terms[ $tax ] as $t ) {
			if ( ! isset( $out[ $t->slug ] ) ) { $out[ $t->slug ] = clone $t; }
			$out[ $t->slug ]->count++;
		}
	}
	ksort( $out );
	return array_values( $out );
}

function get_term_link( $t ) {
	return '/case-studies/' . ( 'cs_platform' === $t->taxonomy ? 'platform' : 'industry' ) . '/' . $t->slug . '/';
}
function get_post_type_archive_link( $type ) { return '/case-studies/'; }
function is_post_type_archive( $type = '' ) { return am_is( 'cs_archive' ); }
function is_singular( $type = '' ) { return am_is( 'single' ) || am_is( 'cs_single' ); }
function get_queried_object() { return isset( $GLOBALS['am_ctx']['term'] ) ? $GLOBALS['am_ctx']['term'] : null; }
function wp_list_pluck( $list, $field ) {
	return array_map( function ( $o ) use ( $field ) { return is_object( $o ) ? $o->$field : $o[ $field ]; }, (array) $list );
}
function has_excerpt() { $p = am_post(); return $p && ! empty( $p->excerpt ); }
function setup_postdata( $p ) { $GLOBALS['post'] = $p; }
function wp_reset_postdata() {
	$GLOBALS['post'] = isset( $GLOBALS['am_loop'][ $GLOBALS['am_idx'] ] ) ? $GLOBALS['am_loop'][ $GLOBALS['am_idx'] ] : null;
}
function is_admin() { return false; }
function term_exists() { return true; }
function wp_insert_term() {}
function flush_rewrite_rules() {}
function register_taxonomy() {}
function add_meta_box() {}
function wp_nonce_field() {}

function get_posts( $args = array() ) {
	if ( ( isset( $args['post_type'] ) ? $args['post_type'] : 'post' ) !== 'amatec_case_study' ) {
		return array();
	}
	$exclude = isset( $args['post__not_in'] ) ? array_map( 'intval', $args['post__not_in'] ) : array();
	$out     = array();
	foreach ( am_case_studies() as $p ) {
		if ( in_array( $p->ID, $exclude, true ) ) { continue; }
		if ( ! empty( $args['tax_query'][0] ) ) {
			$q    = $args['tax_query'][0];
			$have = wp_list_pluck( $p->terms[ $q['taxonomy'] ], 'term_id' );
			if ( ! array_intersect( $have, (array) $q['terms'] ) ) { continue; }
		}
		$out[] = $p;
	}
	$n = isset( $args['numberposts'] ) ? (int) $args['numberposts'] : 5;
	return $n > 0 ? array_slice( $out, 0, $n ) : $out;
}

/**
 * Route /case-studies/... URLs. Returns the template file name or null.
 *
 * @param string $slug Request path without slashes.
 */
function am_cs_route( $slug ) {
	if ( ! preg_match( '#^case-studies(?:/(.*))?$#', $slug, $m ) ) {
		return null;
	}
	$rest = isset( $m[1] ) ? $m[1] : '';
	if ( preg_match( '#^(?:page/(\d+))?$#', $rest, $pm ) ) {
		am_list( am_case_studies(), '/case-studies/', isset( $pm[1] ) ? max( 1, (int) $pm[1] ) : 1, 'cs_archive', 'Case studies' );
		return 'archive-amatec_case_study.php';
	}
	if ( preg_match( '#^(platform|industry)/([a-z0-9-]+)(?:/page/(\d+))?$#', $rest, $tm ) ) {
		$tax   = 'cs_' . $tm[1];
		$found = array();
		$term  = null;
		foreach ( am_case_studies() as $p ) {
			foreach ( $p->terms[ $tax ] as $t ) {
				if ( $t->slug === $tm[2] ) { $found[] = $p; $term = $t; }
			}
		}
		if ( ! $found ) { return null; }
		foreach ( get_terms( array( 'taxonomy' => $tax ) ) as $t ) {
			if ( $t->slug === $term->slug ) { $term = $t; }
		}
		am_list( $found, '/case-studies/' . $tm[1] . '/' . $tm[2] . '/', isset( $tm[3] ) ? max( 1, (int) $tm[3] ) : 1, 'cs_tax', $term->name );
		$GLOBALS['am_ctx']['term']     = $term;
		$GLOBALS['am_ctx']['taxonomy'] = $tax;
		return 'taxonomy-' . $tax . '.php';
	}
	foreach ( am_case_studies() as $p ) {
		if ( $p->post_name === $rest ) {
			$GLOBALS['am_ctx']  = array( 'type' => 'cs_single', 'title' => $p->post_title );
			$GLOBALS['am_loop'] = array( $p );
			return 'single-amatec_case_study.php';
		}
	}
	return null;
}

function get_query_var( $var, $default = '' ) {
	return 'paged' === $var && isset( $GLOBALS['am_ctx']['paged'] ) ? $GLOBALS['am_ctx']['paged'] : $default;
}
