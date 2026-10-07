<?php
/**
 * Contact page (matched by slug "contact").
 * Navy hero with quick-contact rails → message form + direct details →
 * "skip the inbox" booking band (reuses the home contact section).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part( 'template-parts/contact/hero' );
get_template_part( 'template-parts/contact/form' );
?>
<?php get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_contact_faqs() ) ) ); ?>
<div id="book">
	<div class="wrap" style="padding-top:8px;">
		<div class="sec-head center" style="max-width:620px;margin:0 auto;">
			<div class="eyebrow"><?php esc_html_e( 'PREFER TO TALK LIVE?', 'amatec' ); ?></div>
			<h2 class="h2" style="margin-top:12px;font-size:clamp(26px,3vw,38px);"><?php esc_html_e( 'Skip the inbox, grab a slot', 'amatec' ); ?></h2>
		</div>
	</div>
	<?php get_template_part( 'template-parts/home/contact' ); ?>
</div>
<?php
get_footer();
