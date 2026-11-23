<?php
/**
 * Multi Vendor SKU — how it works in 3 steps, each with its animation or screenshot.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$section = amatec_mvs()['steps'];
$steps   = $section['items'];
?>
<section id="mvs-steps" class="section" style="background:var(--bg-page);scroll-margin-top:72px;">
	<div class="wrap">
		<div class="sec-head center" style="max-width:680px;">
			<div class="eyebrow"><?php esc_html_e( 'HOW IT WORKS', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'How it works, in 3 steps', 'amatec' ); ?></h2>
			<p class="lead"><?php echo esc_html( $section['lead'] ); ?></p>
		</div>

		<ol class="mvs-steps">
			<?php foreach ( $steps as $s ) : ?>
				<li class="mvs-step">
					<div class="txt">
						<span class="num"><?php echo esc_html( $s['n'] ); ?></span>
						<h3 class="h3"><?php echo esc_html( $s['t'] ); ?></h3>
						<p><?php echo esc_html( $s['d'] ); ?></p>
					</div>
					<div class="card prod-frame mvs-frame">
						<div class="bar light">
							<span class="d"></span><span class="d"></span><span class="d"></span>
							<span class="addr"><?php echo esc_html( $s['bar'] ); ?></span>
						</div>
						<?php get_template_part( 'template-parts/products/mvs-media', null, array( 'file' => $s['file'], 'ratio' => '32 / 15', 'zoom' => true, 'sizes' => '(max-width: 980px) 100vw, 640px' ) ); ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
