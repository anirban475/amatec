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
get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'n8n' ) ) ) );
get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
	'cta' => array(
		'eyebrow' => __( 'LET’S OPTIMIZE YOUR PROCESSES', 'amatec' ),
		'title'   => __( 'Book a free n8n consultation', 'amatec' ),
		'sub'     => __( 'Thirty minutes with the engineer who would build it. We’ll map your data flows and show you which ones are worth automating first.', 'amatec' ),
		'points'  => array(
			__( '30-minute call with an n8n engineer', 'amatec' ),
			__( 'A map of the workflow that would save you the most time', 'amatec' ),
			__( 'A fixed-scope quote, or an honest “you don’t need us”', 'amatec' ),
		),
	),
) ) );

get_footer();
