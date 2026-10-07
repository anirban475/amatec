<?php
/**
 * Default page template — standard WordPress page content in the brand frame.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>
<section class="section">
	<div class="wrap" style="max-width:840px;">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<header class="sec-head" style="margin-bottom:32px;">
					<h1 class="h1" style="font-size:clamp(34px,4vw,52px);"><?php the_title(); ?></h1>
				</header>
				<div class="entry-content">
					<?php
					the_content();
					wp_link_pages();
					?>
				</div>
			</article>
			<?php
		endwhile;
		?>
	</div>
</section>
<?php
get_footer();
