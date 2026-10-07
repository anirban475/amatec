<?php
/**
 * Template Name: About Page
 * The founder-led AMATEC About page.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part( 'template-parts/about/hero' );
get_template_part( 'template-parts/about/stats' );
get_template_part( 'template-parts/about/founder' );
get_template_part( 'template-parts/about/values' );
get_template_part( 'template-parts/about/certs' );
get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_about_faqs() ) ) );
get_template_part( 'template-parts/about/cta' );

get_footer();
