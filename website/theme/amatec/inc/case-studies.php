<?php
/**
 * Case studies: post type, taxonomies, detail fields and helpers.
 *
 * URLs: /case-studies/ (list), /case-studies/<slug>/ (single),
 * /case-studies/platform/<slug>/ and /case-studies/industry/<slug>/ (filters).
 * Templates: archive-amatec_case_study.php, taxonomy-cs_platform.php,
 * taxonomy-cs_industry.php, single-amatec_case_study.php, template-parts/case-studies/.
 *
 * @package AMATEC
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'AMATEC_CS_TYPE', 'amatec_case_study' );

/**
 * Detail fields shown in the "Case study details" box.
 * key => array( label, input type, help text ).
 *
 * @return array
 */
function amatec_cs_fields() {
	return array(
		'_cs_client_name' => array( __( 'Client name', 'amatec' ), 'text', __( 'Leave empty to keep the client anonymous.', 'amatec' ) ),
		'_cs_client_desc' => array( __( 'Client description', 'amatec' ), 'text', __( 'e.g. Hong Kong electronics distributor', 'amatec' ) ),
		'_cs_country'     => array( __( 'Country or region', 'amatec' ), 'text', '' ),
		'_cs_year'        => array( __( 'Year', 'amatec' ), 'text', '' ),
		'_cs_headline'    => array( __( 'Headline result', 'amatec' ), 'text', __( 'Shown big on the card, e.g. 271 containers tracked. Max 40 characters.', 'amatec' ) ),
		'_cs_results'     => array( __( 'Results', 'amatec' ), 'textarea', __( 'One result per line.', 'amatec' ) ),
		'_cs_tools'       => array( __( 'Tools used', 'amatec' ), 'textarea', __( 'One tool per line.', 'amatec' ) ),
		'_cs_faqs'        => array( __( 'FAQ', 'amatec' ), 'textarea', __( 'Each question on a line starting "Q:", its answer on the next line starting "A:". Blank line between pairs.', 'amatec' ) ),
	);
}

/**
 * Platform terms seeded on activation. slug => name.
 *
 * @return array
 */
function amatec_cs_platforms() {
	return array(
		'make'   => 'Make.com',
		'n8n'    => 'n8n',
		'zoho'   => 'Zoho',
		'monday' => 'monday.com',
		'ai'     => 'AI',
	);
}

function amatec_register_case_studies() {
	// Taxonomies first: their /case-studies/platform/... rules must sit above the
	// post type's attachment rule, which would otherwise swallow those URLs.
	register_taxonomy( 'cs_platform', AMATEC_CS_TYPE, array(
		'labels'            => array(
			'name'          => __( 'Platforms', 'amatec' ),
			'singular_name' => __( 'Platform', 'amatec' ),
		),
		'hierarchical'      => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'case-studies/platform', 'with_front' => false ),
	) );

	register_taxonomy( 'cs_industry', AMATEC_CS_TYPE, array(
		'labels'            => array(
			'name'          => __( 'Industries', 'amatec' ),
			'singular_name' => __( 'Industry', 'amatec' ),
		),
		'hierarchical'      => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'case-studies/industry', 'with_front' => false ),
	) );

	register_post_type( AMATEC_CS_TYPE, array(
		'labels'        => array(
			'name'          => __( 'Case Studies', 'amatec' ),
			'singular_name' => __( 'Case Study', 'amatec' ),
			'menu_name'     => __( 'Case Studies', 'amatec' ),
			'add_new_item'  => __( 'Add New Case Study', 'amatec' ),
			'edit_item'     => __( 'Edit Case Study', 'amatec' ),
			'all_items'     => __( 'All Case Studies', 'amatec' ),
			'view_item'     => __( 'View Case Study', 'amatec' ),
		),
		'public'        => true,
		'has_archive'   => 'case-studies',
		'rewrite'       => array( 'slug' => 'case-studies', 'with_front' => false ),
		'menu_icon'     => 'dashicons-portfolio',
		'menu_position' => 6,
		'show_in_rest'  => true,
		'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields' ),
	) );

	$auth = function () {
		return current_user_can( 'edit_posts' );
	};
	foreach ( array_keys( amatec_cs_fields() ) as $key ) {
		register_post_meta( AMATEC_CS_TYPE, $key, array(
			'type'          => 'string',
			'single'        => true,
			'show_in_rest'  => true,
			'auth_callback' => $auth,
		) );
	}
	// Yoast title/description/keyphrase writable over REST, as for posts and pages.
	foreach ( array( '_yoast_wpseo_title', '_yoast_wpseo_metadesc', '_yoast_wpseo_focuskw' ) as $key ) {
		register_post_meta( AMATEC_CS_TYPE, $key, array(
			'type'          => 'string',
			'single'        => true,
			'show_in_rest'  => true,
			'auth_callback' => $auth,
		) );
	}
}
add_action( 'init', 'amatec_register_case_studies' );

/**
 * Once per theme version: seed the platform terms and refresh rewrite rules,
 * so /case-studies/ works straight after uploading a new build.
 */
function amatec_cs_maybe_setup() {
	if ( get_option( 'amatec_cs_setup_version' ) === AMATEC_VERSION ) {
		return;
	}
	foreach ( amatec_cs_platforms() as $slug => $name ) {
		if ( ! term_exists( $slug, 'cs_platform' ) ) {
			wp_insert_term( $name, 'cs_platform', array( 'slug' => $slug ) );
		}
	}
	flush_rewrite_rules( false );
	update_option( 'amatec_cs_setup_version', AMATEC_VERSION );
}
add_action( 'init', 'amatec_cs_maybe_setup', 20 );

/**
 * Case study lists show 9 per page so the 3-column grid stays full.
 *
 * @param WP_Query $q Query.
 */
function amatec_cs_per_page( $q ) {
	if ( ! is_admin() && $q->is_main_query() && ( $q->is_post_type_archive( AMATEC_CS_TYPE ) || $q->is_tax( array( 'cs_platform', 'cs_industry' ) ) ) ) {
		$q->set( 'posts_per_page', 9 );
	}
}
add_action( 'pre_get_posts', 'amatec_cs_per_page' );

/* ------------------------------------------------------------------
 * "Case study details" box in the editor.
 * ------------------------------------------------------------------ */
function amatec_cs_add_meta_box() {
	add_meta_box( 'amatec-cs-details', __( 'Case study details', 'amatec' ), 'amatec_cs_render_meta_box', AMATEC_CS_TYPE, 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'amatec_cs_add_meta_box' );

function amatec_cs_render_meta_box( $post ) {
	wp_nonce_field( 'amatec_cs_save', 'amatec_cs_nonce' );
	echo '<table class="form-table" role="presentation"><tbody>';
	foreach ( amatec_cs_fields() as $key => $f ) {
		$value = get_post_meta( $post->ID, $key, true );
		printf( '<tr><th scope="row"><label for="%1$s">%2$s</label></th><td>', esc_attr( $key ), esc_html( $f[0] ) );
		if ( 'textarea' === $f[1] ) {
			printf( '<textarea class="large-text" rows="%3$d" id="%1$s" name="%1$s">%2$s</textarea>', esc_attr( $key ), esc_textarea( $value ), '_cs_faqs' === $key ? 12 : 5 );
		} else {
			printf( '<input class="regular-text" type="text" id="%1$s" name="%1$s" value="%2$s">', esc_attr( $key ), esc_attr( $value ) );
		}
		if ( $f[2] ) {
			printf( '<p class="description">%s</p>', esc_html( $f[2] ) );
		}
		echo '</td></tr>';
	}
	echo '</tbody></table>';
}

function amatec_cs_save_meta_box( $post_id ) {
	if ( ! isset( $_POST['amatec_cs_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['amatec_cs_nonce'] ) ), 'amatec_cs_save' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	foreach ( amatec_cs_fields() as $key => $f ) {
		if ( ! isset( $_POST[ $key ] ) ) {
			continue;
		}
		$raw = wp_unslash( $_POST[ $key ] );
		update_post_meta( $post_id, $key, 'textarea' === $f[1] ? sanitize_textarea_field( $raw ) : sanitize_text_field( $raw ) );
	}
}
add_action( 'save_post_' . AMATEC_CS_TYPE, 'amatec_cs_save_meta_box' );

/* ------------------------------------------------------------------
 * Helpers used by the templates.
 * ------------------------------------------------------------------ */

/**
 * All detail fields of a case study, with list fields split into arrays.
 *
 * @param int $post_id Post ID.
 * @return array
 */
function amatec_cs_data( $post_id ) {
	$lines = function ( $s ) {
		return array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) $s ) ) ) );
	};
	$d = array();
	foreach ( array_keys( amatec_cs_fields() ) as $key ) {
		$d[ substr( $key, 4 ) ] = (string) get_post_meta( $post_id, $key, true );
	}
	$d['results'] = $lines( $d['results'] );
	$d['tools']   = $lines( $d['tools'] );
	$d['faqs']    = amatec_cs_parse_faqs( $d['faqs'] );
	return $d;
}

/**
 * Parse "Q: ... / A: ..." text into array( array( 'q' => , 'a' => ) ).
 *
 * @param string $text Raw FAQ field.
 * @return array
 */
function amatec_cs_parse_faqs( $text ) {
	$faqs = array();
	$cur  = null;
	foreach ( preg_split( '/\r\n|\r|\n/', (string) $text ) as $line ) {
		$line = trim( $line );
		if ( preg_match( '/^Q:\s*(.+)$/i', $line, $m ) ) {
			if ( $cur && '' !== $cur['a'] ) { $faqs[] = $cur; }
			$cur = array( 'q' => $m[1], 'a' => '' );
		} elseif ( $cur && preg_match( '/^A:\s*(.+)$/i', $line, $m ) ) {
			$cur['a'] = $m[1];
		} elseif ( $cur && '' !== $line && '' !== $cur['a'] ) {
			$cur['a'] .= ' ' . $line;
		}
	}
	if ( $cur && '' !== $cur['a'] ) { $faqs[] = $cur; }
	return $faqs;
}

/**
 * "Chaoshi Limited · Hong Kong" or "UK web hosting company" for cards and the glance panel.
 *
 * @param array $d Case study data from amatec_cs_data().
 * @return string
 */
function amatec_cs_client_line( $d ) {
	if ( '' !== $d['client_name'] ) {
		return $d['client_name'] . ( '' !== $d['country'] ? ' · ' . $d['country'] : '' );
	}
	return '' !== $d['client_desc'] ? ucfirst( $d['client_desc'] ) : __( 'Confidential client', 'amatec' );
}

/**
 * Terms of a case study for one taxonomy (empty array when none).
 *
 * @param int    $post_id  Post ID.
 * @param string $taxonomy Taxonomy name.
 * @return WP_Term[]
 */
function amatec_cs_terms( $post_id, $taxonomy ) {
	$terms = get_the_terms( $post_id, $taxonomy );
	return ( $terms && ! is_wp_error( $terms ) ) ? $terms : array();
}

/**
 * Icon for a platform term slug (Lucide names, matching the nav).
 *
 * @param string $slug Platform slug.
 * @return string
 */
function amatec_cs_platform_icon( $slug ) {
	$icons = array( 'make' => 'boxes', 'n8n' => 'git-merge', 'zoho' => 'layers', 'monday' => 'calendar', 'ai' => 'sparkles' );
	return isset( $icons[ $slug ] ) ? $icons[ $slug ] : 'workflow';
}

/**
 * Published case studies for /llms.txt (title, URL, excerpt).
 *
 * @return array
 */
function amatec_cs_llms_lines() {
	$out = array();
	foreach ( get_posts( array( 'post_type' => AMATEC_CS_TYPE, 'post_status' => 'publish', 'numberposts' => 200 ) ) as $p ) {
		$out[] = sprintf( '- [%s](%s): %s', get_the_title( $p ), get_permalink( $p ), wp_strip_all_tags( get_the_excerpt( $p ) ) );
	}
	return $out;
}

/* ------------------------------------------------------------------
 * SEO titles and descriptions for the case study lists. Yoast's
 * defaults ("Case Studies Archive", "Zoho Archives") say nothing to a
 * searcher or an AI engine, so the lists get specific ones here.
 * Single case studies keep their own Yoast title and description.
 * ------------------------------------------------------------------ */

/**
 * Title and description for the current case study list, or null elsewhere.
 *
 * @return array|null array( 'title' => , 'desc' => )
 */
function amatec_cs_list_seo() {
	if ( is_post_type_archive( AMATEC_CS_TYPE ) ) {
		$title = __( 'Workflow Automation Case Studies and Results', 'amatec' );
		$desc  = __( 'Real automation projects Amatec built on Make.com, n8n, Zoho and monday.com. Each one shows the client’s problem, what we built and the result.', 'amatec' );
	} elseif ( is_tax( 'cs_platform' ) ) {
		$term = get_queried_object();
		/* translators: %s: platform name. */
		$title = sprintf( __( '%s Automation Case Studies', 'amatec' ), $term->name );
		/* translators: %s: platform name. */
		$desc = sprintf( __( 'Automation projects Amatec built on %s for real clients: the problem, what we built and the result, with the numbers from each project.', 'amatec' ), $term->name );
	} elseif ( is_tax( 'cs_industry' ) ) {
		$term = get_queried_object();
		/* translators: %s: industry name. */
		$title = sprintf( __( '%s Automation Case Studies', 'amatec' ), $term->name );
		/* translators: %s: industry name, lower case. */
		$desc = sprintf( __( 'Workflow automation projects Amatec built for clients in %s on Make.com, n8n, Zoho and monday.com: the problem, the build and the result.', 'amatec' ), strtolower( $term->name ) );
	} else {
		return null;
	}
	$paged = (int) get_query_var( 'paged' );
	if ( $paged > 1 ) {
		/* translators: %d: page number. */
		$title .= sprintf( __( ', Page %d', 'amatec' ), $paged );
	}
	return array( 'title' => $title . ' | Amatec', 'desc' => $desc );
}

function amatec_cs_seo_title( $title ) {
	$seo = amatec_cs_list_seo();
	return $seo ? $seo['title'] : $title;
}
add_filter( 'wpseo_title', 'amatec_cs_seo_title' );
add_filter( 'wpseo_opengraph_title', 'amatec_cs_seo_title' );

function amatec_cs_seo_desc( $desc ) {
	$seo = amatec_cs_list_seo();
	return $seo ? $seo['desc'] : $desc;
}
add_filter( 'wpseo_metadesc', 'amatec_cs_seo_desc' );
add_filter( 'wpseo_opengraph_desc', 'amatec_cs_seo_desc' );
