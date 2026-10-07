<?php
/**
 * Plugin Name: Yoast Meta for REST
 * Description: Registers Yoast SEO title/description/focus keyphrase as writable REST meta on posts and pages, so they can be set via the WP REST API. Safe to remove once meta is populated.
 */
add_action( 'init', function () {
	$keys = array( '_yoast_wpseo_title', '_yoast_wpseo_metadesc', '_yoast_wpseo_focuskw' );
	foreach ( array( 'post', 'page' ) as $type ) {
		foreach ( $keys as $key ) {
			register_post_meta( $type, $key, array(
				'type'          => 'string',
				'single'        => true,
				'show_in_rest'  => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			) );
		}
	}
}, 20 );
