<?php
/**
 * Multi Vendor SKU for Zoho Inventory — product page (matched by slug).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part( 'template-parts/products/mvs-hero' );
get_template_part( 'template-parts/products/mvs-answer' );
get_template_part( 'template-parts/products/mvs-problem' );
get_template_part( 'template-parts/products/mvs-steps' );
get_template_part( 'template-parts/products/mvs-features' );
get_template_part( 'template-parts/products/mvs-compare' );
get_template_part( 'template-parts/products/mvs-video' );
get_template_part( 'template-parts/products/mvs-flow' );
get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'mvs' ), 'q_tag' => 'h3' ) ) );
get_template_part( 'template-parts/products/mvs-cta' );

get_footer();
