<?php
/**
 * Stock Procurement for Zoho Inventory — product page (matched by slug).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part( 'template-parts/products/stock-hero' );
get_template_part( 'template-parts/products/stock-overview' );
get_template_part( 'template-parts/products/stock-features' );
get_template_part( 'template-parts/products/stock-cta' );

get_footer();
