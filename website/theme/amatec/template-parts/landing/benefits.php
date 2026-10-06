<?php
/**
 * Landing benefits — "why automate" 3×2 icon-card grid.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$data = $args['data'];
$b    = $data['benefits'];
?>
<section id="lp-benefits" class="section" style="background:var(--bg-subtle);">
	<div class="wrap">
		<div class="sec-head center" style="max-width:720px;">
			<div class="eyebrow"><?php echo esc_html( $b['eyebrow'] ); ?></div>
			<h2 class="h2"><?php echo esc_html( $b['title'] ); ?></h2>
			<p class="lead"><?php echo esc_html( $b['sub'] ); ?></p>
		</div>

		<div class="lp-benefit-grid">
			<?php foreach ( $b['items'] as $f ) : ?>
				<div class="card lp-benefit">
					<span class="ic"><i data-lucide="<?php echo esc_attr( $f['icon'] ); ?>"></i></span>
					<h3 class="h3"><?php echo esc_html( $f['t'] ); ?></h3>
					<p><?php echo esc_html( $f['d'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
