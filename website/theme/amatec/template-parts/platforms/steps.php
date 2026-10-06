<?php
/**
 * Shared platform "how we work" — numbered step cards + optional CTA button.
 * Args: id, bg, title, sub, steps[{n, icon, t, d}], cta (button label, optional).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<section id="<?php echo esc_attr( $args['id'] ); ?>" class="section" style="background:<?php echo esc_attr( $args['bg'] ); ?>;">
	<div class="wrap">
		<div class="sec-head center" style="max-width:640px;">
			<div class="eyebrow"><?php esc_html_e( 'HOW WE WORK', 'amatec' ); ?></div>
			<h2 class="h2"><?php echo esc_html( $args['title'] ); ?></h2>
			<?php if ( ! empty( $args['sub'] ) ) : ?>
				<p class="lead"><?php echo esc_html( $args['sub'] ); ?></p>
			<?php endif; ?>
		</div>

		<div class="ai-step-grid">
			<?php foreach ( $args['steps'] as $s ) : ?>
				<div class="card ai-step">
					<div class="top">
						<span class="ic"><i data-lucide="<?php echo esc_attr( $s['icon'] ); ?>"></i></span>
						<span class="num"><?php echo esc_html( $s['n'] ); ?></span>
					</div>
					<h3 class="h3"><?php echo esc_html( $s['t'] ); ?></h3>
					<p><?php echo esc_html( $s['d'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if ( ! empty( $args['cta'] ) ) : ?>
			<div style="text-align:center;margin-top:40px;">
				<a href="#contact" class="btn btn-accent"><i data-lucide="calendar-clock"></i> <?php echo esc_html( $args['cta'] ); ?></a>
			</div>
		<?php endif; ?>
	</div>
</section>
