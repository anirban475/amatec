<?php
/**
 * Archives (category, tag, author, date) — reuse the blog-list design.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
get_template_part( 'template-parts/blog/list' );
get_footer();
