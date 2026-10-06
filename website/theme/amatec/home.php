<?php
/**
 * Blog index — the "Posts page" (Settings → Reading).
 * Renders the AMATEC blog-list design from the WP loop.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
get_template_part( 'template-parts/blog/list' );
get_footer();
