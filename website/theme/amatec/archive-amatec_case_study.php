<?php
/**
 * Case studies list (all case studies, /case-studies/).
 * Layout lives in template-parts/case-studies/list.php.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
get_template_part( 'template-parts/case-studies/list' );
get_footer();
