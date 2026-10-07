<?php
/**
 * Template Name: AMATEC Landing Page
 *
 * Data-driven landing page (services / industries / solutions) from the
 * AMATEC design system's SitePageKit. The page slug selects its content
 * entry in inc/lp-pages.php — create the WP page with a matching slug,
 * assign this template, and the whole page renders.
 *
 * Sections: hero (automation-flow mock) → benefits → what-we-automate →
 * delivery steps → why AMATEC (+ optional quote) → FAQ → book a meeting.
 *
 * @package AMATEC
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$amatec_lp_data = amatec_lp_page_data( get_post_field( 'post_name' ) );

get_header();

if ( $amatec_lp_data ) {
	get_template_part( 'template-parts/landing/hero', null, array( 'data' => $amatec_lp_data ) );
	get_template_part( 'template-parts/landing/benefits', null, array( 'data' => $amatec_lp_data ) );
	get_template_part( 'template-parts/landing/automate', null, array( 'data' => $amatec_lp_data ) );
	get_template_part( 'template-parts/landing/delivery', null, array( 'data' => $amatec_lp_data ) );
	get_template_part( 'template-parts/landing/why', null, array( 'data' => $amatec_lp_data ) );
	get_template_part( 'template-parts/landing/faq', null, array( 'data' => $amatec_lp_data ) );
	get_template_part( 'template-parts/landing/testimonial', null, array( 'data' => $amatec_lp_data ) );
	get_template_part( 'template-parts/landing/book', null, array( 'data' => $amatec_lp_data ) );
} else {
	?>
	<section class="section">
		<div class="wrap" style="max-width:840px;">
			<header class="sec-head" style="margin-bottom:24px;">
				<h1 class="h1" style="font-size:clamp(34px,4vw,52px);"><?php the_title(); ?></h1>
			</header>
			<p class="lead">
				<?php
				printf(
					/* translators: %s: page slug. */
					esc_html__( 'No landing-page content found for the slug “%s”. Add an entry with this key to inc/lp-pages.php, or rename the page slug to match an existing entry.', 'amatec' ),
					esc_html( get_post_field( 'post_name' ) )
				);
				?>
			</p>
		</div>
	</section>
	<?php
}

get_footer();
