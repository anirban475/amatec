<?php
/**
 * Local preview router for the AMATEC theme — no WordPress or database needed.
 *
 * Stubs just enough of the WordPress API to render the theme's templates, and
 * feeds the blog from ../blog-batch/posts.json. Read-only: forms and REST
 * endpoints are not wired up.
 *
 * Run:  php -S localhost:8080 local-preview/router.php   (from "Amatec Website/")
 *
 * Paths: the theme is found at AMATEC_THEME (env), ../amatec (OneDrive layout) or
 * ../../theme/amatec (repo layout); the blog feed at AMATEC_POSTS_JSON (env) or
 * ../blog-batch/posts.json. With no feed the blog renders empty.
 */

define( 'ABSPATH', __DIR__ . '/' );
define( 'AMATEC_GTM_ID', '' ); // keep analytics off for local previews
function am_first_path( $candidates ) {
	foreach ( $candidates as $c ) {
		if ( $c && file_exists( $c ) ) { return realpath( $c ); }
	}
	return false;
}
define( 'AM_THEME_DIR', am_first_path( array( getenv( 'AMATEC_THEME' ), __DIR__ . '/../amatec', __DIR__ . '/../../theme/amatec' ) ) );
define( 'AM_THEME_URI', '/wp-content/themes/amatec' );
define( 'AM_POSTS_JSON', am_first_path( array( getenv( 'AMATEC_POSTS_JSON' ), __DIR__ . '/../blog-batch/posts.json' ) ) );
if ( ! AM_THEME_DIR ) {
	http_response_code( 500 );
	exit( 'AMATEC theme folder not found. Set AMATEC_THEME to its path.' );
}
define( 'AM_PER_PAGE', 9 );

$am_path = rawurldecode( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) );

/* ------------------------------------------------------------------
 * Theme assets
 * ------------------------------------------------------------------ */
if ( 0 === strpos( $am_path, AM_THEME_URI . '/' ) ) {
	$file = realpath( AM_THEME_DIR . substr( $am_path, strlen( AM_THEME_URI ) ) );
	if ( ! $file || 0 !== strpos( $file, AM_THEME_DIR . '/' ) || ! is_file( $file ) || preg_match( '/\.php$/', $file ) ) {
		http_response_code( 404 );
		exit;
	}
	$types = array( 'css' => 'text/css', 'js' => 'application/javascript', 'png' => 'image/png', 'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'svg' => 'image/svg+xml', 'webp' => 'image/webp', 'woff2' => 'font/woff2' );
	$ext   = strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );
	header( 'Content-Type: ' . ( isset( $types[ $ext ] ) ? $types[ $ext ] : 'application/octet-stream' ) );
	readfile( $file );
	exit;
}
if ( '/favicon.ico' === $am_path ) {
	header( 'Content-Type: image/png' );
	readfile( AM_THEME_DIR . '/assets/img/amatec-mark.png' );
	exit;
}

/* ------------------------------------------------------------------
 * WordPress API stubs
 * ------------------------------------------------------------------ */
$GLOBALS['am_actions'] = array();
$GLOBALS['am_styles']  = array();
$GLOBALS['am_scripts'] = array();
$GLOBALS['am_inline']  = array();
$GLOBALS['am_ctx']     = array( 'type' => 'page', 'title' => '' );
$GLOBALS['am_loop']    = array();
$GLOBALS['am_idx']     = -1;
$GLOBALS['post']       = null;

function add_action( $hook, $cb, $prio = 10 ) { $GLOBALS['am_actions'][ $hook ][ $prio ][] = $cb; }
function add_filter( $hook, $cb, $prio = 10 ) {}
function apply_filters( $hook, $value ) { return $value; }
function am_do_action_arg( $hook, $arg ) {
	if ( empty( $GLOBALS['am_actions'][ $hook ] ) ) { return; }
	ksort( $GLOBALS['am_actions'][ $hook ] );
	foreach ( $GLOBALS['am_actions'][ $hook ] as $cbs ) {
		foreach ( $cbs as $cb ) { call_user_func( $cb, $arg ); }
	}
}
function do_action( $hook ) {
	if ( empty( $GLOBALS['am_actions'][ $hook ] ) ) { return; }
	ksort( $GLOBALS['am_actions'][ $hook ] );
	foreach ( $GLOBALS['am_actions'][ $hook ] as $cbs ) {
		foreach ( $cbs as $cb ) { call_user_func( $cb ); }
	}
}

// i18n + escaping
function __( $t, $d = '' ) { return $t; }
function _e( $t, $d = '' ) { echo $t; }
function esc_html( $t ) { return htmlspecialchars( (string) $t, ENT_QUOTES, 'UTF-8', false ); }
function esc_attr( $t ) { return esc_html( $t ); }
function esc_html__( $t, $d = '' ) { return esc_html( $t ); }
function esc_html_e( $t, $d = '' ) { echo esc_html( $t ); }
function esc_attr__( $t, $d = '' ) { return esc_attr( $t ); }
function esc_attr_e( $t, $d = '' ) { echo esc_attr( $t ); }
function esc_url( $u ) { return esc_attr( $u ); }
function esc_url_raw( $u ) { return $u; }
function esc_js( $t ) { return addslashes( $t ); }
function wp_kses_post( $t ) { return $t; }
function sanitize_text_field( $t ) { return trim( strip_tags( $t ) ); }
function sanitize_textarea_field( $t ) { return trim( strip_tags( $t ) ); }
function sanitize_email( $t ) { return filter_var( $t, FILTER_SANITIZE_EMAIL ); }
function is_email( $t ) { return (bool) filter_var( $t, FILTER_VALIDATE_EMAIL ); }
function wp_strip_all_tags( $t ) { return trim( strip_tags( $t ) ); }
function wp_parse_url( $u, $c = -1 ) { return parse_url( $u, $c ); }
function wp_json_encode( $d, $o = 0 ) { return json_encode( $d, $o ); }
function status_header( $code ) { http_response_code( $code ); }
function wp_trim_words( $t, $n = 55, $more = '&hellip;' ) {
	$words = preg_split( '/\s+/', trim( strip_tags( $t ) ) );
	return count( $words ) > $n ? implode( ' ', array_slice( $words, 0, $n ) ) . html_entity_decode( $more ) : implode( ' ', $words );
}

// site + theme
function home_url( $p = '' ) { return '/' . ltrim( $p, '/' ); }
function rest_url( $p = '' ) { return '/wp-json/' . ltrim( $p, '/' ); }
function get_theme_file_uri( $f = '' ) { return AM_THEME_URI . '/' . ltrim( $f, '/' ); }
function get_theme_file_path( $f = '' ) { return AM_THEME_DIR . '/' . ltrim( $f, '/' ); }
function get_bloginfo( $k = '' ) { return 'charset' === $k ? 'UTF-8' : ( 'description' === $k ? 'Workflow automation agency' : 'AMATEC' ); }
function bloginfo( $k = '' ) { echo get_bloginfo( $k ); }
function language_attributes() { echo 'lang="en-GB"'; }
function body_class( $c = '' ) { echo 'class="' . esc_attr( trim( 'amatec-local ' . $GLOBALS['am_ctx']['type'] . ' ' . $c ) ) . '"'; }
function wp_body_open() { do_action( 'wp_body_open' ); }
function get_option( $k, $default = false ) { return 'page_for_posts' === $k ? 'blog' : $default; }
function update_option() { return true; }
function get_theme_mod( $k, $default = false ) { return $default; }
function set_theme_mod() {}
function has_custom_logo() { return false; }
function has_site_icon() { return false; }
function current_user_can() { return false; }
function wp_create_nonce() { return 'local-preview'; }
function is_wp_error( $x ) { return false; }
function add_theme_support() {}
function register_nav_menus() {}
function register_post_type() {}
function register_post_meta() {}
function register_rest_route() {}
function get_page_by_path() { return null; }
function wp_insert_post() { return 0; }
function update_post_meta() {}
function wp_mail() { return false; }
function wp_get_nav_menu_object() { return false; }
function wp_create_nav_menu() { return 0; }
function wp_update_nav_menu_item() {}
function wp_get_attachment_image_url() { return false; }

// assets
function wp_enqueue_style( $h, $src = '', $deps = array(), $ver = false ) { $GLOBALS['am_styles'][ $h ] = $ver ? $src . '?ver=' . $ver : $src; }
function wp_enqueue_script( $h, $src = '', $deps = array(), $ver = false ) { $GLOBALS['am_scripts'][ $h ] = $ver ? $src . '?ver=' . $ver : $src; }
function wp_localize_script( $h, $name, $data ) { $GLOBALS['am_inline'][ $h ] = 'var ' . $name . ' = ' . json_encode( $data ) . ';'; }
function wp_head() {
	do_action( 'wp_enqueue_scripts' );
	echo '<title>' . esc_html( $GLOBALS['am_ctx']['title'] ? $GLOBALS['am_ctx']['title'] . ' | AMATEC' : 'AMATEC | Workflow Automation' ) . "</title>\n";
	foreach ( $GLOBALS['am_styles'] as $h => $src ) { printf( "<link rel=\"stylesheet\" id=\"%s-css\" href=\"%s\">\n", esc_attr( $h ), esc_url( $src ) ); }
	do_action( 'wp_head' );
}
function wp_footer() {
	foreach ( $GLOBALS['am_scripts'] as $h => $src ) {
		if ( isset( $GLOBALS['am_inline'][ $h ] ) ) { echo '<script>' . $GLOBALS['am_inline'][ $h ] . "</script>\n"; }
		printf( "<script id=\"%s-js\" src=\"%s\"></script>\n", esc_attr( $h ), esc_url( $src ) );
	}
	do_action( 'wp_footer' );
}

// templates
function get_template_part( $slug, $name = null, $args = array() ) {
	$file = AM_THEME_DIR . '/' . $slug . ( $name ? '-' . $name : '' ) . '.php';
	if ( is_file( $file ) ) { include $file; }
}
function get_header() { include AM_THEME_DIR . '/header.php'; }
function get_footer() { include AM_THEME_DIR . '/footer.php'; }

// conditionals
function am_is( $t ) { return $GLOBALS['am_ctx']['type'] === $t; }
function is_front_page() { return am_is( 'front' ); }
function is_home() { return am_is( 'blog' ); }
function is_category() { return am_is( 'category' ); }
function is_archive() { return am_is( 'category' ) || am_is( 'cs_archive' ) || am_is( 'cs_tax' ); }
function is_single() { return am_is( 'single' ); }
function is_page( $slugs = null ) {
	if ( ! am_is( 'page' ) ) { return false; }
	return null === $slugs || in_array( get_post_field( 'post_name' ), (array) $slugs, true );
}
function is_search() { return false; }
function is_tag() { return false; }
function is_tax( $tax = null ) {
	return am_is( 'cs_tax' ) && ( null === $tax || in_array( $GLOBALS['am_ctx']['taxonomy'], (array) $tax, true ) );
}
function is_author() { return false; }
function is_date() { return false; }
function get_search_query() { return ''; }
function single_term_title( $p = '', $echo = true ) { $t = $GLOBALS['am_ctx']['title']; if ( $echo ) { echo $t; } return $t; }
function term_description() { return ''; }
function get_the_archive_title() { return $GLOBALS['am_ctx']['title']; }
function the_archive_title() { echo get_the_archive_title(); }
function get_the_author() { return 'AMATEC'; }

// posts + loop
function am_post( $p = null ) { return is_object( $p ) ? $p : $GLOBALS['post']; }
function have_posts() { return $GLOBALS['am_idx'] + 1 < count( $GLOBALS['am_loop'] ); }
function the_post() { $GLOBALS['am_idx']++; $GLOBALS['post'] = $GLOBALS['am_loop'][ $GLOBALS['am_idx'] ]; }
function get_the_ID() { return $GLOBALS['post'] ? $GLOBALS['post']->ID : 0; }
function get_the_title( $p = null ) { $p = am_post( $p ); return $p ? $p->post_title : ''; }
function the_title() { echo get_the_title(); }
function get_permalink( $p = null ) {
	if ( 'blog' === $p ) { return '/blog/'; }
	$p = am_post( $p );
	if ( $p && isset( $p->post_type ) && 'amatec_case_study' === $p->post_type ) {
		return '/case-studies/' . $p->post_name . '/';
	}
	return $p ? '/' . $p->post_name . '/' : '/';
}
function the_permalink() { echo esc_url( get_permalink() ); }
function get_post_field( $f, $p = null ) { $p = am_post( $p ); return ( $p && isset( $p->$f ) ) ? $p->$f : ''; }
function post_class( $c = '' ) { echo 'class="' . esc_attr( trim( 'post type-post ' . $c ) ) . '"'; }
function get_the_category() { $p = am_post(); return $p && isset( $p->cats ) ? $p->cats : array(); }
function get_category_link( $id ) { return '/category/' . $id . '/'; }
function get_the_post_thumbnail_url( $id = null, $size = '' ) { $p = am_post(); return $p && ! empty( $p->image ) ? $p->image : false; }
function get_the_post_thumbnail_caption() { return ''; }
function get_the_date( $f = 'F j, Y' ) { $p = am_post(); return $p && $p->post_date ? date( $f ? $f : 'F j, Y', strtotime( $p->post_date ) ) : ''; }
function get_the_modified_date( $f = 'F j, Y' ) { return get_the_date( $f ); } // posts.json has no modified date
function get_the_excerpt( $p = null ) { $p = am_post( $p ); return $p ? ( $p->excerpt ? $p->excerpt : wp_trim_words( $p->post_content, 40 ) ) : ''; }
function the_excerpt() { echo '<p>' . esc_html( get_the_excerpt() ) . '</p>'; }
function the_content() { $p = am_post(); echo $p ? $p->post_content : ''; }
function wp_link_pages() {}
function am_neighbour( $step ) {
	$all = am_all_posts();
	foreach ( $all as $i => $p ) {
		if ( $GLOBALS['post'] && $p->ID === $GLOBALS['post']->ID ) { return isset( $all[ $i + $step ] ) ? $all[ $i + $step ] : null; }
	}
	return null;
}
function get_previous_post() { return am_neighbour( 1 ); } // older
function get_next_post() { return am_neighbour( -1 ); }    // newer
function the_posts_pagination( $args = array() ) {
	$ctx = $GLOBALS['am_ctx'];
	if ( empty( $ctx['pages'] ) || $ctx['pages'] < 2 ) { return; }
	$base = $ctx['base'];
	$url  = function ( $n ) use ( $base ) { return 1 === $n ? $base : $base . 'page/' . $n . '/'; };
	echo '<nav class="navigation pagination ' . esc_attr( isset( $args['class'] ) ? $args['class'] : '' ) . '" aria-label="Posts pagination"><div class="nav-links">';
	if ( $ctx['paged'] > 1 ) { echo '<a class="prev page-numbers" href="' . $url( $ctx['paged'] - 1 ) . '">' . $args['prev_text'] . '</a>'; }
	for ( $n = 1; $n <= $ctx['pages']; $n++ ) {
		echo $n === $ctx['paged'] ? '<span aria-current="page" class="page-numbers current">' . $n . '</span>' : '<a class="page-numbers" href="' . $url( $n ) . '">' . $n . '</a>';
	}
	if ( $ctx['paged'] < $ctx['pages'] ) { echo '<a class="next page-numbers" href="' . $url( $ctx['paged'] + 1 ) . '">' . $args['next_text'] . '</a>'; }
	echo '</div></nav>';
}

// comments (disabled locally)
function comments_open() { return false; }
function get_comments_number() { return 0; }
function comments_template() {}
function have_comments() { return false; }
function post_password_required() { return false; }
function wp_list_comments() {}
function comment_form() {}
function the_comments_pagination() {}
function wp_get_current_commenter() { return array( 'comment_author' => '', 'comment_author_email' => '', 'comment_author_url' => '' ); }

/* ------------------------------------------------------------------
 * Blog data from blog-batch/posts.json (newest first)
 * ------------------------------------------------------------------ */
function am_all_posts() {
	static $posts = null;
	if ( null !== $posts ) { return $posts; }
	$posts = array();
	$raw   = AM_POSTS_JSON ? json_decode( file_get_contents( AM_POSTS_JSON ), true ) : array();
	foreach ( (array) $raw as $i => $r ) {
		$cats = array();
		foreach ( isset( $r['categories'] ) ? (array) $r['categories'] : array() as $name ) {
			$cats[] = (object) array( 'name' => $name, 'term_id' => strtolower( preg_replace( '/[^a-z0-9]+/i', '-', $name ) ) );
		}
		$posts[] = (object) array(
			'ID'           => 1000 + $i,
			'post_type'    => 'post',
			'post_name'    => $r['slug'],
			'post_title'   => $r['title'],
			'post_content' => $r['content'],
			'post_date'    => isset( $r['published'] ) ? $r['published'] : '',
			'excerpt'      => isset( $r['meta_description'] ) ? $r['meta_description'] : '',
			'image'        => isset( $r['image_url'] ) ? $r['image_url'] : '',
			'cats'         => $cats,
		);
	}
	usort( $posts, function ( $a, $b ) { return strcmp( $b->post_date, $a->post_date ); } );
	return $posts;
}

/* ------------------------------------------------------------------
 * Routing
 * ------------------------------------------------------------------ */
require __DIR__ . '/cs-stubs.php';
require AM_THEME_DIR . '/functions.php';
do_action( 'after_setup_theme' );
do_action( 'init' );

// Lets theme code answer custom routes (e.g. /llms.txt) before normal routing.
$GLOBALS['am_actions_arg'] = (object) array( 'request' => trim( $am_path, '/' ) );
am_do_action_arg( 'parse_request', $GLOBALS['am_actions_arg'] );

function am_page( $slug, $title ) {
	$GLOBALS['post'] = (object) array( 'ID' => 1, 'post_type' => 'page', 'post_name' => $slug, 'post_title' => $title, 'post_content' => '', 'post_date' => '' );
	$GLOBALS['am_ctx']['title'] = $title;
}
function am_list( $posts, $base, $paged, $type, $title = '' ) {
	$pages = max( 1, (int) ceil( count( $posts ) / AM_PER_PAGE ) );
	$GLOBALS['am_ctx']  = array( 'type' => $type, 'title' => $title, 'base' => $base, 'paged' => $paged, 'pages' => $pages );
	$GLOBALS['am_loop'] = array_slice( $posts, ( $paged - 1 ) * AM_PER_PAGE, AM_PER_PAGE );
}

$am_slug     = trim( $am_path, '/' );
$am_pages    = amatec_site_pages();
$am_lp       = amatec_lp_pages();
$am_template = null;

if ( '' === $am_slug ) {
	$GLOBALS['am_ctx']['type'] = 'front';
	$am_template = 'front-page.php';
} elseif ( preg_match( '#^blog(?:/page/(\d+))?$#', $am_slug, $m ) ) {
	am_list( am_all_posts(), '/blog/', isset( $m[1] ) ? max( 1, (int) $m[1] ) : 1, 'blog', 'Blog' );
	$am_template = 'home.php';
} elseif ( preg_match( '#^category/([a-z0-9-]+)(?:/page/(\d+))?$#', $am_slug, $m ) ) {
	$name  = '';
	$found = array_values( array_filter( am_all_posts(), function ( $p ) use ( $m, &$name ) {
		foreach ( $p->cats as $c ) { if ( $c->term_id === $m[1] ) { $name = $c->name; return true; } }
		return false;
	} ) );
	if ( $found ) {
		am_list( $found, '/category/' . $m[1] . '/', isset( $m[2] ) ? max( 1, (int) $m[2] ) : 1, 'category', $name );
		$am_template = 'archive.php';
	}
} elseif ( null !== ( $am_cs_tpl = am_cs_route( $am_slug ) ) ) {
	$am_template = $am_cs_tpl;
} elseif ( 'about' === $am_slug ) {
	am_page( 'about', 'About' );
	$am_template = 'page-about.php';
} elseif ( isset( $am_pages[ $am_slug ] ) && is_file( AM_THEME_DIR . '/page-' . $am_slug . '.php' ) ) {
	am_page( $am_slug, $am_pages[ $am_slug ][0] );
	$am_template = 'page-' . $am_slug . '.php';
} elseif ( isset( $am_lp[ $am_slug ] ) ) {
	am_page( $am_slug, isset( $am_lp[ $am_slug ]['eyebrow'] ) ? $am_lp[ $am_slug ]['eyebrow'] : ucwords( str_replace( '-', ' ', $am_slug ) ) );
	$am_template = 'template-lp.php';
} else {
	foreach ( am_all_posts() as $p ) {
		if ( $p->post_name === $am_slug ) {
			$GLOBALS['am_ctx']  = array( 'type' => 'single', 'title' => $p->post_title );
			$GLOBALS['am_loop'] = array( $p );
			$am_template        = 'single.php';
			break;
		}
	}
}

if ( ! $am_template ) {
	http_response_code( 404 );
	$GLOBALS['am_ctx'] = array( 'type' => 'error404', 'title' => 'Page not found' );
	$am_template       = '404.php';
}

header( 'Content-Type: text/html; charset=UTF-8' );
include AM_THEME_DIR . '/' . $am_template;
