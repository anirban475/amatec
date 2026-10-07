<?php
/**
 * Case studies list: navy hero, filter links, card grid, pagination,
 * booking band and ItemList structured data. Used by the post type
 * archive and both taxonomy (platform / industry) views.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$title = __( 'Automation projects we have shipped', 'amatec' );
$sub   = __( 'Real projects Amatec has built on Make.com, n8n, Zoho and monday.com. Each case study shows the problem the client had, what we built and what changed.', 'amatec' );
$badge = __( 'Case studies', 'amatec' );

if ( is_tax( 'cs_platform' ) || is_tax( 'cs_industry' ) ) {
	$term  = get_queried_object();
	/* translators: %s: platform or industry name. */
	$title = sprintf( __( '%s case studies', 'amatec' ), $term->name );
	if ( term_description() ) {
		$sub = wp_strip_all_tags( term_description() );
	} elseif ( is_tax( 'cs_platform' ) ) {
		/* translators: %s: platform name. */
		$sub = sprintf( __( 'Automation projects Amatec has built on %s: the problem, what we built and the result.', 'amatec' ), $term->name );
	} else {
		/* translators: %s: industry name, lower case. */
		$sub = sprintf( __( 'Automation projects Amatec has built for clients in %s: the problem, what we built and the result.', 'amatec' ), strtolower( $term->name ) );
	}
}

$items = array();
?>
<section class="blog-hero cs-hero">
	<div class="dotgrid" style="position:absolute;inset:0;opacity:.28;pointer-events:none;"></div>
	<div class="grad"></div>
	<div class="glow"></div>
	<div class="wrap inner">
		<div class="badge reveal"><span class="dot orange"></span> <?php echo esc_html( $badge ); ?></div>
		<h1 class="h1 reveal" style="animation-delay:.05s;"><?php echo esc_html( $title ); ?></h1>
		<p class="lead reveal" style="animation-delay:.1s;"><?php echo esc_html( $sub ); ?></p>
	</div>
</section>

<section class="section" style="background:var(--bg-page);padding-top:48px;">
	<div class="wrap">
		<?php get_template_part( 'template-parts/case-studies/filters' ); ?>

		<?php if ( have_posts() ) : ?>
			<div class="blog-grid cs-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					$items[] = array(
						'@type'    => 'ListItem',
						'position' => count( $items ) + 1,
						'url'      => get_permalink(),
						'name'     => get_the_title(),
					);
					get_template_part( 'template-parts/case-studies/card' );
				endwhile;
				?>
			</div>

			<?php
			the_posts_pagination( array(
				'class'              => 'blog-pager',
				'mid_size'           => 1,
				'prev_text'          => __( 'Prev', 'amatec' ),
				'next_text'          => __( 'Next', 'amatec' ),
				'screen_reader_text' => __( 'Case study pagination', 'amatec' ),
			) );
			?>
		<?php else : ?>
			<div class="sec-head center" style="margin-top:48px;">
				<h2 class="h2"><?php esc_html_e( 'No case studies here yet', 'amatec' ); ?></h2>
				<p class="lead"><?php esc_html_e( 'New projects are written up as they go live. Check back soon.', 'amatec' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
if ( $items ) {
	$amatec_cs_ld = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'ItemList',
		'name'            => $title,
		'itemListElement' => $items,
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $amatec_cs_ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}

get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
	'cta' => array(
		'eyebrow' => __( 'YOUR PROJECT NEXT', 'amatec' ),
		'title'   => __( 'Tell us what eats your team’s week', 'amatec' ),
		'sub'     => __( 'Thirty minutes with the engineer who would build it. We map the process and tell you what is worth automating first.', 'amatec' ),
	),
) ) );
