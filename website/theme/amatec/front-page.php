<?php
/**
 * Front page — the AMATEC marketing homepage.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part( 'template-parts/home/hero' );
get_template_part( 'template-parts/home/platforms' );
get_template_part( 'template-parts/home/summary' );
get_template_part( 'template-parts/home/services' );
get_template_part( 'template-parts/home/how-it-works' );
get_template_part( 'template-parts/home/results' );
get_template_part( 'template-parts/home/testimonial' );
get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_home_faqs() ) ) );
get_template_part( 'template-parts/home/contact' );

get_footer();
