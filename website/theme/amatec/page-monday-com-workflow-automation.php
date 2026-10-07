<?php
/**
 * monday.com Workflow Automation — platform page (matched by slug).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part( 'template-parts/platforms/monday-hero' );
get_template_part( 'template-parts/platforms/monday-services' );
get_template_part( 'template-parts/platforms/monday-why' );
get_template_part( 'template-parts/platforms/monday-testimonial' );
get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'monday' ) ) ) );
get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
	'cta' => array(
		'eyebrow' => __( 'LET’S OPTIMIZE YOUR PROCESSES', 'amatec' ),
		'title'   => __( 'Book a free monday.com consultation', 'amatec' ),
		'sub'     => __( 'Thirty minutes with a certified monday.com builder. We’ll map your boards, spot the bottlenecks, and show you exactly which recipes and integrations will save your team the most time.', 'amatec' ),
		'points'  => array(
			__( '30-minute call with a certified monday.com builder', 'amatec' ),
			__( 'A map of the automations that would save you the most time', 'amatec' ),
			__( 'A fixed-scope quote, or an honest “you don’t need us”', 'amatec' ),
		),
	),
) ) );

get_footer();
