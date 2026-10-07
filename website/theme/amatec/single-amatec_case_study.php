<?php
/**
 * Single case study: answer-first hero, "At a glance" panel, body with
 * table of contents, tools used, FAQ (with FAQPage data), related case
 * studies and booking. Content comes from the editor plus the
 * "Case study details" fields (inc/case-studies.php).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

while ( have_posts() ) :
	the_post();

	$cs_id      = get_the_ID();
	$cs         = amatec_cs_data( $cs_id );
	$platforms  = amatec_cs_terms( $cs_id, 'cs_platform' );
	$industries = amatec_cs_terms( $cs_id, 'cs_industry' );
	$list_url   = get_post_type_archive_link( AMATEC_CS_TYPE );
	?>

	<article <?php post_class( 'cs-single' ); ?>>

		<!-- ===== HERO ===== -->
		<section class="post-hero cs-single-hero">
			<div class="glow-a"></div>
			<div class="glow-b"></div>
			<div class="wrap inner">
				<a class="post-back reveal" href="<?php echo esc_url( $list_url ); ?>"><i data-lucide="arrow-left"></i> <?php esc_html_e( 'All case studies', 'amatec' ); ?></a>

				<?php if ( $platforms ) : ?>
					<div class="post-chips reveal" style="animation-delay:.04s;">
						<?php foreach ( $platforms as $t ) : ?>
							<a class="chip" href="<?php echo esc_url( get_term_link( $t ) ); ?>"><?php echo esc_html( $t->name ); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<h1 class="h1 reveal" style="animation-delay:.08s;"><?php the_title(); ?></h1>

				<?php if ( has_excerpt() ) : ?>
					<p class="lead cs-summary reveal" style="animation-delay:.12s;"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>

				<!-- At a glance -->
				<div class="cs-glance reveal" style="animation-delay:.16s;">
					<dl class="cs-facts">
						<div><dt><?php esc_html_e( 'Client', 'amatec' ); ?></dt><dd><?php echo esc_html( '' !== $cs['client_name'] ? $cs['client_name'] : ucfirst( $cs['client_desc'] ) ); ?></dd></div>
						<?php if ( $industries ) : ?>
							<div><dt><?php esc_html_e( 'Industry', 'amatec' ); ?></dt><dd><?php echo esc_html( implode( ', ', wp_list_pluck( $industries, 'name' ) ) ); ?></dd></div>
						<?php endif; ?>
						<?php if ( '' !== $cs['country'] ) : ?>
							<div><dt><?php esc_html_e( 'Country', 'amatec' ); ?></dt><dd><?php echo esc_html( $cs['country'] ); ?></dd></div>
						<?php endif; ?>
						<?php if ( $platforms ) : ?>
							<div><dt><?php esc_html_e( 'Platforms', 'amatec' ); ?></dt><dd><?php echo esc_html( implode( ', ', wp_list_pluck( $platforms, 'name' ) ) ); ?></dd></div>
						<?php endif; ?>
						<?php if ( '' !== $cs['year'] ) : ?>
							<div><dt><?php esc_html_e( 'Year', 'amatec' ); ?></dt><dd><?php echo esc_html( $cs['year'] ); ?></dd></div>
						<?php endif; ?>
					</dl>
					<?php if ( $cs['results'] ) : ?>
						<div class="cs-results">
							<div class="side-label"><?php esc_html_e( 'Results', 'amatec' ); ?></div>
							<ul>
								<?php foreach ( $cs['results'] as $r ) : ?>
									<li><i data-lucide="circle-check-big"></i><span><?php echo esc_html( $r ); ?></span></li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<!-- ===== BODY ===== -->
		<section class="post-body section" style="padding-top:72px;">
			<div class="wrap">
				<div class="blog-layout">

					<div class="prose" data-prose>
						<?php the_content(); ?>

						<?php if ( $cs['tools'] ) : ?>
							<div class="cs-tools">
								<div class="side-label"><?php esc_html_e( 'Tools used', 'amatec' ); ?></div>
								<div class="post-chips">
									<?php foreach ( $cs['tools'] as $tool ) : ?>
										<span class="chip"><?php echo esc_html( $tool ); ?></span>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>

					<aside class="blog-aside">
						<div data-toc-wrap>
							<div class="side-label"><?php esc_html_e( 'On this page', 'amatec' ); ?></div>
							<ul class="toc-list" data-toc></ul>
						</div>
						<div class="aside-block">
							<div class="side-label"><?php esc_html_e( 'Have a similar problem?', 'amatec' ); ?></div>
							<p><?php esc_html_e( 'Book a free 30-minute call with the engineer who would build it.', 'amatec' ); ?></p>
							<a class="btn btn-accent" href="#contact" data-scroll="#contact"><i data-lucide="calendar"></i> <?php esc_html_e( 'Book a call', 'amatec' ); ?></a>
						</div>
					</aside>

				</div>
			</div>
		</section>
	</article>

	<?php
	if ( $cs['faqs'] ) {
		get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => $cs['faqs'] ) ) );
	}

	get_template_part( 'template-parts/case-studies/related', null, array( 'post_id' => $cs_id, 'platforms' => $platforms ) );

	get_template_part( 'template-parts/landing/book', null, array( 'data' => array(
		'cta' => array(
			'eyebrow' => __( 'BOOK A CONSULTATION', 'amatec' ),
			'title'   => __( 'Want a result like this?', 'amatec' ),
			'sub'     => __( 'Thirty minutes with the engineer who would build it. We map your process and show you what is worth automating first.', 'amatec' ),
		),
	) ) );

endwhile;

get_footer();
