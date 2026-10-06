<?php
/**
 * n8n Workflow Automation — platform page (matched by slug).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part( 'template-parts/platforms/n8n-hero' );
get_template_part( 'template-parts/platforms/n8n-services' );
get_template_part( 'template-parts/platforms/n8n-control' );
get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
	'cta' => array(
		'eyebrow' => __( 'LET’S OPTIMIZE YOUR PROCESSES', 'amatec' ),
		'title'   => __( 'Book a free n8n consultation', 'amatec' ),
		'sub'     => __( 'Thirty minutes with an automation engineer. We’ll map your data flows and show you exactly what to automate to reduce manual work, cut costs, and scale operations, securely.', 'amatec' ),
		'points'  => array(
			__( '30-minute call with an n8n engineer', 'amatec' ),
			__( 'A map of your highest-leverage workflow', 'amatec' ),
			__( 'A fixed-scope quote, or an honest “you don’t need us”', 'amatec' ),
		),
	),
) ) );

get_footer();
