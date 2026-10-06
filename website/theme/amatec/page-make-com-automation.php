<?php
/**
 * Make.com Automation — platform page (matched by slug).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part( 'template-parts/platforms/make-hero' );
get_template_part( 'template-parts/platforms/make-services' );
get_template_part( 'template-parts/platforms/make-why' );
get_template_part( 'template-parts/platforms/steps', null, array(
	'id'     => 'make-process',
	'bg'     => 'var(--bg-subtle)',
	'title'  => __( 'From busywork to automated in three steps', 'amatec' ),
	'sub'    => __( 'It starts with a conversation: no commitment, no jargon.', 'amatec' ),
	'cta'    => __( 'Start with a free consultation', 'amatec' ),
	'steps'  => array(
		array( 'n' => '01', 'icon' => 'phone-call', 't' => __( 'Free consultation', 'amatec' ), 'd' => __( 'A 30-minute call where we map the process that drains your week and spot the highest-leverage automation.', 'amatec' ) ),
		array( 'n' => '02', 'icon' => 'pencil-ruler', 't' => __( 'Scope & blueprint', 'amatec' ), 'd' => __( 'You get a clear scenario blueprint, a fixed-scope quote, and an honest take on what is (and isn’t) worth automating.', 'amatec' ) ),
		array( 'n' => '03', 'icon' => 'rocket', 't' => __( 'Build, test & hand over', 'amatec' ), 'd' => __( 'We build it on Make, test against real edge cases, then hand it over with documentation and monitoring in place.', 'amatec' ) ),
	),
) );
get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
	'cta' => array(
		'eyebrow' => __( 'BOOK A CONSULTATION', 'amatec' ),
		'title'   => __( 'Let’s scope your first Make scenario', 'amatec' ),
		'sub'     => __( 'Thirty minutes with a Make Advanced Certified builder. We’ll map the busywork and show you exactly what’s worth automating, with no commitment and no jargon.', 'amatec' ),
		'points'  => array(
			__( '30-minute call with a certified Make builder', 'amatec' ),
			__( 'A before/after map of your process', 'amatec' ),
			__( 'A fixed-scope quote, or an honest “you don’t need us”', 'amatec' ),
		),
	),
) ) );

get_footer();
