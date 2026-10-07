<?php
/**
 * AI-Powered Task Automation — service page (matched by slug).
 * Hero (AI task-triage mock) → capabilities + platform strip → approach →
 * testimonial → consultation booking.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part( 'template-parts/ai/hero' );
get_template_part( 'template-parts/ai/services' );
get_template_part( 'template-parts/ai/approach' );
get_template_part( 'template-parts/home/testimonial' );
get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'ai' ) ) ) );
get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
	'cta' => array(
		'eyebrow' => __( 'LET’S OPTIMIZE YOUR PROCESSES', 'amatec' ),
		'title'   => __( 'Book a free AI consultation', 'amatec' ),
		'sub'     => __( 'Thirty minutes with the engineer who would build it. We’ll find the two or three tasks where AI would save your team the most time.', 'amatec' ),
		'points'  => array(
			__( '30-minute call with an automation engineer', 'amatec' ),
			__( 'A shortlist of your highest-impact AI use cases', 'amatec' ),
			__( 'A fixed-scope quote, or an honest “you don’t need us”', 'amatec' ),
		),
	),
) ) );

get_footer();
