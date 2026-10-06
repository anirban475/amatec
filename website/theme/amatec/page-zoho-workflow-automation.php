<?php
/**
 * Zoho Workflow Automation — platform page (matched by slug).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part( 'template-parts/platforms/zoho-hero' );
get_template_part( 'template-parts/platforms/zoho-services' );
get_template_part( 'template-parts/platforms/zoho-why' );
get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
	'cta' => array(
		'eyebrow' => __( 'LET’S OPTIMIZE YOUR PROCESSES', 'amatec' ),
		'title'   => __( 'Book a free Zoho consultation', 'amatec' ),
		'sub'     => __( 'Thirty minutes with a certified Zoho partner. We’ll audit your current processes, find the high-impact automations, and show you exactly what Deluge and Zoho Flow can take off your plate.', 'amatec' ),
		'points'  => array(
			__( '30-minute call with a certified Zoho partner', 'amatec' ),
			__( 'A quick audit of your highest-impact workflows', 'amatec' ),
			__( 'A fixed-scope quote, or an honest “you don’t need us”', 'amatec' ),
		),
	),
) ) );

get_footer();
