<?php
/**
 * T-Chat for Zoho CRM (Twilio) — product page (matched by slug).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part( 'template-parts/products/tchat-hero' );
get_template_part( 'template-parts/products/tchat-overview' );
get_template_part( 'template-parts/products/tchat-features' );
get_template_part( 'template-parts/products/tchat-cta' );

get_footer();
