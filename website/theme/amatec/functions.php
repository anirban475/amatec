<?php
/**
 * AMATEC theme functions.
 *
 * @package AMATEC
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'AMATEC_VERSION', '1.9.1' );

/* ------------------------------------------------------------------
 * Landing-page content (services / industries / solutions).
 * Data lives in inc/lp-pages.php; template-lp.php renders it.
 * ------------------------------------------------------------------ */
require_once get_theme_file_path( 'inc/lp-pages.php' );
require_once get_theme_file_path( 'inc/legal-pages.php' );
require_once get_theme_file_path( 'inc/aio.php' );
require_once get_theme_file_path( 'inc/case-studies.php' );

/**
 * Bespoke designed pages (each has its own page-{slug}.php template).
 * slug => array( post title, Yoast SEO title ).
 */
function amatec_site_pages() {
	return array(
		'contact'                              => array( 'Contact', 'Contact — Amatec' ),
		'ai-powered-task-automation'           => array( 'AI-Powered Task Automation', 'AI-Powered Task Automation — Amatec' ),
		'make-com-automation'                  => array( 'Make.com Automation', 'Make.com Automation — Amatec' ),
		'n8n-workflow-automation'              => array( 'n8n Workflow Automation', 'n8n Workflow Automation — Amatec' ),
		'monday-com-workflow-automation'       => array( 'monday.com Workflow Automation', 'monday.com Workflow Automation — Amatec' ),
		'zoho-workflow-automation'             => array( 'Zoho Workflow Automation', 'Zoho Workflow Automation — Amatec' ),
		'stock-procurement-for-zoho-inventory' => array( 'Stock Procurement for Zoho Inventory', 'Stock Procurement for Zoho Inventory — Amatec' ),
		't-chat-zoho-extension'                => array( 'T-Chat for Zoho CRM', 'T-Chat for Zoho CRM — Amatec' ),
		'termsandconditions'                   => array( 'Terms & Conditions', 'Terms & Conditions — Amatec' ),
		'privacypolicy'                        => array( 'Privacy Policy', 'Privacy Policy — Amatec' ),
		'refundpolicy'                         => array( 'Refund Policy', 'Refund Policy — Amatec' ),
		'cancellationpolicy'                   => array( 'Cancellation Policy', 'Cancellation Policy — Amatec' ),
	);
}

/**
 * Content entry for a landing page, or null when the slug has none.
 *
 * @param string $slug Page slug (post_name).
 * @return array|null
 */
function amatec_lp_page_data( $slug ) {
	$pages = amatec_lp_pages();
	return isset( $pages[ $slug ] ) ? $pages[ $slug ] : null;
}

/**
 * Create any missing landing pages (one per entry in inc/lp-pages.php):
 * slug = data key, template = template-lp.php, Yoast SEO title +
 * meta description from the design bundle.
 *
 * Runs on theme activation, and once per theme version on admin_init so
 * uploading an updated build to an already-active theme also creates them.
 */
function amatec_ensure_lp_pages() {
	if ( get_option( 'amatec_lp_pages_version' ) === AMATEC_VERSION ) {
		return;
	}

	foreach ( amatec_lp_pages() as $slug => $data ) {
		if ( get_page_by_path( $slug ) ) {
			continue;
		}
		$meta    = isset( $data['meta'] ) ? $data['meta'] : array();
		$page_id = wp_insert_post( array(
			'post_title'   => ! empty( $meta['post_title'] ) ? $meta['post_title'] : ucwords( str_replace( '-', ' ', $slug ) ),
			'post_name'    => $slug,
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		) );
		if ( ! $page_id || is_wp_error( $page_id ) ) {
			continue;
		}
		update_post_meta( $page_id, '_wp_page_template', 'template-lp.php' );
		if ( ! empty( $meta['seo_title'] ) ) {
			update_post_meta( $page_id, '_yoast_wpseo_title', $meta['seo_title'] );
		}
		if ( ! empty( $meta['description'] ) ) {
			update_post_meta( $page_id, '_yoast_wpseo_metadesc', $meta['description'] );
		}
	}

	// Bespoke pages (contact, AI, platforms, products, legal) — their layout
	// comes from page-{slug}.php templates, so only the page row is needed.
	foreach ( amatec_site_pages() as $slug => $titles ) {
		if ( get_page_by_path( $slug ) ) {
			continue;
		}
		$page_id = wp_insert_post( array(
			'post_title'   => $titles[0],
			'post_name'    => $slug,
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		) );
		if ( $page_id && ! is_wp_error( $page_id ) ) {
			update_post_meta( $page_id, '_yoast_wpseo_title', $titles[1] );
		}
	}

	update_option( 'amatec_lp_pages_version', AMATEC_VERSION );
}
add_action( 'after_switch_theme', 'amatec_ensure_lp_pages' );
add_action( 'admin_init', 'amatec_ensure_lp_pages' );

/* ------------------------------------------------------------------
 * Theme setup
 * ------------------------------------------------------------------ */
function amatec_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'amatec' ),
	) );
}
add_action( 'after_setup_theme', 'amatec_setup' );

/* ------------------------------------------------------------------
 * Default favicon / site icon — the AMATEC hourglass mark.
 * Only output when no Site Icon is set in the Customizer (that takes
 * precedence and already emits its own <link> tags).
 * ------------------------------------------------------------------ */
function amatec_favicon() {
	if ( has_site_icon() ) {
		return;
	}
	$mark = get_theme_file_uri( 'assets/img/amatec-mark.png' );
	printf( '<link rel="icon" type="image/png" href="%s">' . "\n", esc_url( $mark ) );
	printf( '<link rel="apple-touch-icon" href="%s">' . "\n", esc_url( $mark ) );
}
add_action( 'wp_head', 'amatec_favicon' );

/* ------------------------------------------------------------------
 * Google Tag Manager (container GTM-M6GL4DDD).
 * Script prints as high in <head> as possible (priority 1, before
 * favicon/styles); the <noscript> fallback prints right after the
 * opening <body> via wp_body_open. Edit AMATEC_GTM_ID to change/disable.
 * ------------------------------------------------------------------ */
if ( ! defined( 'AMATEC_GTM_ID' ) ) {
	define( 'AMATEC_GTM_ID', 'GTM-M6GL4DDD' );
}

function amatec_gtm_head() {
	if ( ! AMATEC_GTM_ID ) {
		return;
	}
	?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo esc_js( AMATEC_GTM_ID ); ?>');</script>
<!-- End Google Tag Manager -->
	<?php
}
add_action( 'wp_head', 'amatec_gtm_head', 1 );

function amatec_gtm_body() {
	if ( ! AMATEC_GTM_ID ) {
		return;
	}
	?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr( AMATEC_GTM_ID ); ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<?php
}
add_action( 'wp_body_open', 'amatec_gtm_body' );

/* ------------------------------------------------------------------
 * Contact form backend — stores every submission as a private
 * "Contact Message" (WP Admin → Contact Messages) AND emails the admin.
 * Front-end posts JSON to /wp-json/amatec/v1/contact (see initContactForm).
 * Recipient: AMATEC_CONTACT_TO if defined, else the site admin email.
 * ------------------------------------------------------------------ */
function amatec_register_messages_cpt() {
	register_post_type( 'amatec_message', array(
		'labels' => array(
			'name'          => __( 'Contact Messages', 'amatec' ),
			'singular_name' => __( 'Contact Message', 'amatec' ),
			'menu_name'     => __( 'Contact Messages', 'amatec' ),
			'all_items'     => __( 'All Messages', 'amatec' ),
		),
		'public'        => false,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'menu_icon'     => 'dashicons-email-alt',
		'menu_position' => 26,
		'supports'      => array( 'title', 'editor' ),
		'capability_type' => 'post',
		// Submissions are created by the form handler only, never typed in admin.
		'capabilities'  => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap'  => true,
	) );
}
add_action( 'init', 'amatec_register_messages_cpt' );

function amatec_register_contact_route() {
	register_rest_route( 'amatec/v1', '/contact', array(
		'methods'             => 'POST',
		'callback'            => 'amatec_handle_contact',
		'permission_callback' => '__return_true',
	) );
}
add_action( 'rest_api_init', 'amatec_register_contact_route' );

function amatec_handle_contact( WP_REST_Request $request ) {
	$p = $request->get_json_params();
	if ( empty( $p ) ) {
		$p = $request->get_params();
	}
	// Honeypot: bots fill the hidden cf_website field — accept silently, store nothing.
	if ( ! empty( $p['cf_website'] ) ) {
		return new WP_REST_Response( array( 'ok' => true ), 200 );
	}

	$name     = sanitize_text_field( $p['cf_name'] ?? '' );
	$email    = sanitize_email( $p['cf_email'] ?? '' );
	$company  = sanitize_text_field( $p['cf_company'] ?? '' );
	$phone    = sanitize_text_field( $p['cf_phone'] ?? '' );
	$interest = sanitize_text_field( $p['cf_interest'] ?? '' );
	$message  = sanitize_textarea_field( $p['cf_message'] ?? '' );

	if ( ! is_email( $email ) || '' === $message ) {
		return new WP_Error( 'amatec_invalid', __( 'Please add a valid email and a short message.', 'amatec' ), array( 'status' => 422 ) );
	}

	// 1) Store the submission (never lost, even if email delivery fails).
	$post_id = wp_insert_post( array(
		'post_type'    => 'amatec_message',
		'post_status'  => 'private',
		'post_title'   => sprintf( '%s — %s', $name ? $name : __( 'Anonymous', 'amatec' ), $email ),
		'post_content' => $message,
	), true );
	if ( ! is_wp_error( $post_id ) ) {
		$fields = array( 'cf_name' => $name, 'cf_email' => $email, 'cf_company' => $company, 'cf_phone' => $phone, 'cf_interest' => $interest );
		foreach ( $fields as $k => $v ) {
			if ( '' !== $v ) {
				update_post_meta( $post_id, $k, $v );
			}
		}
		update_post_meta( $post_id, 'cf_ip', sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' ) );
	}

	// 2) Email the admin (best effort).
	$to     = ( defined( 'AMATEC_CONTACT_TO' ) && AMATEC_CONTACT_TO ) ? AMATEC_CONTACT_TO : get_option( 'admin_email' );
	$domain = preg_replace( '/^www\./', '', (string) wp_parse_url( home_url(), PHP_URL_HOST ) );
	$subject = sprintf( '[AMATEC] New enquiry from %s', $name ? $name : $email );
	$body = implode( "\n", array(
		'New enquiry from the website contact form:', '',
		'Name:       ' . $name,
		'Email:      ' . $email,
		'Company:    ' . $company,
		'Phone:      ' . $phone,
		'Focus area: ' . $interest,
		'', 'Message:', '--------', $message, '--------', '',
		'Saved in WP Admin → Contact Messages' . ( is_wp_error( $post_id ) ? '' : ' (#' . $post_id . ')' ) . '.',
	) );
	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		'From: AMATEC Website <noreply@' . $domain . '>',
	);
	if ( is_email( $email ) ) {
		$headers[] = sprintf( 'Reply-To: %s <%s>', $name ? $name : $email, $email );
	}
	$sent = wp_mail( $to, $subject, $body, $headers );

	return new WP_REST_Response( array(
		'ok'      => true,
		'stored'  => ! is_wp_error( $post_id ),
		'emailed' => (bool) $sent,
	), 200 );
}

/* ------------------------------------------------------------------
 * Newsletter subscribe — stores each email as a "Subscriber"
 * (WP Admin → Subscribers), de-duplicated, and pings the admin.
 * Front-end posts to /wp-json/amatec/v1/subscribe (single-post sidebar).
 * ------------------------------------------------------------------ */
function amatec_register_subscribers_cpt() {
	register_post_type( 'amatec_subscriber', array(
		'labels' => array(
			'name'          => __( 'Subscribers', 'amatec' ),
			'singular_name' => __( 'Subscriber', 'amatec' ),
			'menu_name'     => __( 'Subscribers', 'amatec' ),
		),
		'public'        => false,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'menu_icon'     => 'dashicons-email-alt2',
		'menu_position' => 27,
		'supports'      => array( 'title' ),
		'capability_type' => 'post',
		'capabilities'  => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap'  => true,
	) );
}
add_action( 'init', 'amatec_register_subscribers_cpt' );

function amatec_register_subscribe_route() {
	register_rest_route( 'amatec/v1', '/subscribe', array(
		'methods'             => 'POST',
		'callback'            => 'amatec_handle_subscribe',
		'permission_callback' => '__return_true',
	) );
}
add_action( 'rest_api_init', 'amatec_register_subscribe_route' );

function amatec_handle_subscribe( WP_REST_Request $request ) {
	$p = $request->get_json_params();
	if ( empty( $p ) ) {
		$p = $request->get_params();
	}
	if ( ! empty( $p['ns_website'] ) ) { // honeypot
		return new WP_REST_Response( array( 'ok' => true ), 200 );
	}
	$email = sanitize_email( $p['ns_email'] ?? '' );
	if ( ! is_email( $email ) ) {
		return new WP_Error( 'amatec_invalid', __( 'Please enter a valid email address.', 'amatec' ), array( 'status' => 422 ) );
	}

	// De-dupe by email (stored as the post title).
	$existing = get_posts( array(
		'post_type'   => 'amatec_subscriber',
		'post_status' => 'private',
		'title'       => $email,
		'fields'      => 'ids',
		'numberposts' => 1,
	) );
	if ( $existing ) {
		return new WP_REST_Response( array( 'ok' => true, 'already' => true ), 200 );
	}

	$post_id = wp_insert_post( array(
		'post_type'   => 'amatec_subscriber',
		'post_status' => 'private',
		'post_title'  => $email,
	), true );
	if ( ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, 'ns_source', esc_url_raw( (string) ( $p['ns_source'] ?? '' ) ) );
		update_post_meta( $post_id, 'ns_ip', sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' ) );
	}

	$to     = ( defined( 'AMATEC_CONTACT_TO' ) && AMATEC_CONTACT_TO ) ? AMATEC_CONTACT_TO : get_option( 'admin_email' );
	$domain = preg_replace( '/^www\./', '', (string) wp_parse_url( home_url(), PHP_URL_HOST ) );
	wp_mail(
		$to,
		__( '[AMATEC] New newsletter subscriber', 'amatec' ),
		sprintf( "New subscriber: %s\n\nSaved in WP Admin → Subscribers.", $email ),
		array( 'Content-Type: text/plain; charset=UTF-8', 'From: AMATEC Website <noreply@' . $domain . '>' )
	);

	return new WP_REST_Response( array( 'ok' => true, 'already' => false, 'stored' => ! is_wp_error( $post_id ) ), 200 );
}

/* ------------------------------------------------------------------
 * Styles & scripts
 * ------------------------------------------------------------------ */
function amatec_assets() {
	// Google Fonts — Sora (display), IBM Plex Sans (body), IBM Plex Mono (mono).
	wp_enqueue_style(
		'amatec-fonts',
		'https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=IBM+Plex+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=IBM+Plex+Mono:wght@400;500;600&display=swap',
		array(),
		null
	);

	// Theme stylesheet (the real one lives in assets/css).
	wp_enqueue_style( 'amatec-main', get_theme_file_uri( 'assets/css/amatec.css' ), array( 'amatec-fonts' ), AMATEC_VERSION );

	// Lucide icons (CDN) — the design system renders icons via data-lucide.
	wp_enqueue_script( 'amatec-lucide', 'https://unpkg.com/lucide@latest', array(), null, true );

	// Theme interactions (depends on lucide so createIcons exists).
	wp_enqueue_script( 'amatec-main', get_theme_file_uri( 'assets/js/amatec.js' ), array( 'amatec-lucide' ), AMATEC_VERSION, true );

	// Contact-form endpoint + nonce for the AJAX submit.
	wp_localize_script( 'amatec-main', 'AMATEC_CF', array(
		'url'       => esc_url_raw( rest_url( 'amatec/v1/contact' ) ),
		'subscribe' => esc_url_raw( rest_url( 'amatec/v1/subscribe' ) ),
		'nonce'     => wp_create_nonce( 'wp_rest' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'amatec_assets' );

/* ------------------------------------------------------------------
 * Site navigation data — single source of truth for the mega-menu
 * (Nav) and the footer sitemap. Mirrors the AMATEC sitemap.
 * ------------------------------------------------------------------ */
function amatec_site_menu() {
	return array(
		array( 'label' => 'About', 'href' => home_url( '/about/' ) ),
		array(
			'label' => 'Services', 'href' => '#services', 'eyebrow' => 'What we build',
			'items' => array(
				array( 'label' => 'Workflow Automation', 'icon' => 'workflow', 'href' => home_url( '/workflow-automation/' ) ),
				array( 'label' => 'AI-Powered Automation', 'icon' => 'sparkles', 'href' => home_url( '/ai-powered-task-automation/' ) ),
				array( 'label' => 'CRM Automation', 'icon' => 'contact', 'href' => home_url( '/crm-automation/' ) ),
			),
		),
		array(
			'label' => 'Industries', 'href' => '#industries', 'eyebrow' => 'Who we serve',
			'items' => array(
				array( 'label' => 'IT Industry', 'icon' => 'server', 'href' => home_url( '/it-company/' ) ),
				array( 'label' => 'eCommerce', 'icon' => 'shopping-cart', 'href' => home_url( '/ecommerce/' ) ),
				array( 'label' => 'Startups', 'icon' => 'rocket', 'href' => home_url( '/startups/' ) ),
				array( 'label' => 'Healthcare', 'icon' => 'heart-pulse', 'href' => home_url( '/healthcare/' ) ),
				array( 'label' => 'Real Estate', 'icon' => 'building-2', 'href' => home_url( '/real-estate/' ) ),
				array( 'label' => 'Small Business', 'icon' => 'store', 'href' => home_url( '/small-business/' ) ),
				array( 'label' => 'Enterprise', 'icon' => 'building', 'href' => home_url( '/enterprise/' ) ),
			),
		),
		array(
			'label' => 'Platforms', 'href' => '#platforms', 'eyebrow' => 'Tools we master',
			'items' => array(
				array( 'label' => 'Make.com', 'icon' => 'boxes', 'href' => home_url( '/make-com-automation/' ) ),
				array( 'label' => 'Monday.com', 'icon' => 'calendar', 'href' => home_url( '/monday-com-workflow-automation/' ) ),
				array( 'label' => 'n8n', 'icon' => 'git-merge', 'href' => home_url( '/n8n-workflow-automation/' ) ),
				array( 'label' => 'Zoho', 'icon' => 'layers', 'href' => home_url( '/zoho-workflow-automation/' ) ),
			),
		),
		array(
			'label' => 'Application', 'href' => '#applications', 'eyebrow' => 'Our products',
			'items' => array(
				array( 'label' => 'Stock Procurement for Zoho Inventory', 'icon' => 'package', 'href' => home_url( '/stock-procurement-for-zoho-inventory/' ) ),
				array( 'label' => 'T-Chat for Zoho CRM', 'icon' => 'message-square', 'href' => home_url( '/t-chat-zoho-extension/' ) ),
			),
		),
		array(
			'label' => 'Solutions', 'href' => '#solutions', 'eyebrow' => 'By function',
			'items' => array(
				array( 'label' => 'Lead & Sales Automation', 'icon' => 'trending-up', 'href' => home_url( '/lead-sales-automation/' ) ),
				array( 'label' => 'Marketing Automation', 'icon' => 'megaphone', 'href' => home_url( '/marketing-automation/' ) ),
				array( 'label' => 'Finance & Accounting Automation', 'icon' => 'receipt', 'href' => home_url( '/finance-accounting-automation/' ) ),
				array( 'label' => 'HR & Operations Automation', 'icon' => 'users-round', 'href' => home_url( '/hr-operations-automation/' ) ),
				array( 'label' => 'Customer Support Automation', 'icon' => 'headset', 'href' => home_url( '/customer-support-automation/' ) ),
			),
		),
		array( 'label' => 'Case Studies', 'href' => home_url( '/case-studies/' ) ),
		array( 'label' => 'Blog', 'href' => home_url( '/blog/' ) ),
		array( 'label' => 'Contact Us', 'href' => home_url( '/contact/' ) ),
	);
}

/**
 * Brand logo: the WP custom logo if set, otherwise an "amatec" wordmark.
 *
 * @param string $context 'header' or 'footer'.
 */
function amatec_logo( $context = 'header' ) {
	if ( has_custom_logo() ) {
		$id  = get_theme_mod( 'custom_logo' );
		$src = wp_get_attachment_image_url( $id, 'full' );
		if ( $src ) {
			// Footer sits on dark navy, so its logo image is whitened via CSS.
			$class = 'footer' === $context ? 'logo foot-logo-img' : 'logo';
			printf(
				'<img class="%s" src="%s" alt="%s" />',
				esc_attr( $class ),
				esc_url( $src ),
				esc_attr( get_bloginfo( 'name' ) )
			);
			return;
		}
	}
	// Bundled brand logos ship with the theme (footer version is already white).
	$file = 'footer' === $context ? 'assets/img/amatec-logo-full-white.png' : 'assets/img/amatec-logo-full.png';
	if ( file_exists( get_theme_file_path( $file ) ) ) {
		printf(
			'<img class="logo" src="%s" alt="%s" />',
			esc_url( get_theme_file_uri( $file ) ),
			esc_attr( get_bloginfo( 'name' ) )
		);
		return;
	}
	// Final fallback wordmark (CSS colours it per context: blue in header, white in footer).
	echo '<span class="wordmark">amate<span>c</span></span>';
}

/* ------------------------------------------------------------------
 * Helper: open a Lucide icon tag.
 * ------------------------------------------------------------------ */
function amatec_icon( $name ) {
	return '<i data-lucide="' . esc_attr( $name ) . '"></i>';
}

/* ------------------------------------------------------------------
 * Social share buttons for the current post.
 * ------------------------------------------------------------------ */
function amatec_share_links() {
	$url   = rawurlencode( get_permalink() );
	$title = rawurlencode( get_the_title() );
	$paths = array(
		'facebook' => 'M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z',
		'x'        => 'M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z',
		'linkedin' => 'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z',
		'whatsapp' => 'M.057 24l1.687-6.163a11.867 11.867 0 0 1-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 0 1 8.413 3.488 11.824 11.824 0 0 1 3.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 0 1-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 0 0 1.51 5.26l-.999 3.648 3.978-1.607zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z',
		'mail'     => 'M1.5 4.5h21A1.5 1.5 0 0 1 24 6v12a1.5 1.5 0 0 1-1.5 1.5h-21A1.5 1.5 0 0 1 0 18V6a1.5 1.5 0 0 1 1.5-1.5zm10.5 8.25L21 7.05V6H3v1.05l9 5.7zM3 9.3V18h18V9.3l-9 5.7-9-5.7z',
	);
	$links = array(
		'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . $url,
		'x'        => 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title,
		'linkedin' => 'https://www.linkedin.com/sharing/share-offsite/?url=' . $url,
		'whatsapp' => 'https://wa.me/?text=' . $title . '%20' . $url,
		'mail'     => 'mailto:?subject=' . $title . '&body=' . $url,
	);
	echo '<div class="share-row">';
	foreach ( $paths as $name => $d ) {
		printf(
			'<a href="%s" target="_blank" rel="noopener noreferrer" aria-label="Share on %s"><svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="%s"/></svg></a>',
			esc_url( $links[ $name ] ),
			esc_attr( $name ),
			esc_attr( $d )
		);
	}
	echo '</div>';
}

/* ------------------------------------------------------------------
 * On activation: create the About page (using the About template) and
 * a Sample / fallback so the site reflects the design out of the box.
 * The Home page renders automatically via front-page.php.
 * ------------------------------------------------------------------ */
function amatec_after_switch() {
	// About page.
	$about = get_page_by_path( 'about' );
	if ( ! $about ) {
		$about_id = wp_insert_post( array(
			'post_title'   => 'About',
			'post_name'    => 'about',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		) );
		if ( $about_id && ! is_wp_error( $about_id ) ) {
			update_post_meta( $about_id, '_wp_page_template', 'page-about.php' );
		}
	}

	// Static front page (Home) + Posts page (Blog). front-page.php renders the
	// homepage design; home.php renders the blog list. New posts appear in Blog
	// automatically — manage everything from Posts → Add New.
	$home = get_page_by_path( 'home' );
	$home_id = $home ? $home->ID : wp_insert_post( array(
		'post_title'  => 'Home',
		'post_name'   => 'home',
		'post_status' => 'publish',
		'post_type'   => 'page',
	) );

	$blog = get_page_by_path( 'blog' );
	$blog_id = $blog ? $blog->ID : wp_insert_post( array(
		'post_title'  => 'Blog',
		'post_name'   => 'blog',
		'post_status' => 'publish',
		'post_type'   => 'page',
	) );

	if ( $home_id && ! is_wp_error( $home_id ) && $blog_id && ! is_wp_error( $blog_id ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
		update_option( 'page_for_posts', $blog_id );
	}

	// Ensure a primary menu exists with Home + About (optional, for completeness).
	if ( ! wp_get_nav_menu_object( 'Primary' ) ) {
		$menu_id = wp_create_nav_menu( 'Primary' );
		if ( ! is_wp_error( $menu_id ) ) {
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title'  => 'Home',
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish',
			) );
			$about = get_page_by_path( 'about' );
			if ( $about ) {
				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title'     => 'About',
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $about->ID,
					'menu-item-type'      => 'post_type',
					'menu-item-status'    => 'publish',
				) );
			}
			$locations = get_theme_mod( 'nav_menu_locations', array() );
			$locations['primary'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}
}
add_action( 'after_switch_theme', 'amatec_after_switch' );

/* ------------------------------------------------------------------
 * Content width
 * ------------------------------------------------------------------ */
if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}
