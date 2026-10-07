<?php
/**
 * Landing delivery steps — numbered icon cards, one per engagement phase.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$data = $args['data'];
$s    = $data['delivery'];
?>
<section id="lp-delivery" class="section" style="background:var(--bg-subtle);">
	<div class="wrap">
		<div class="sec-head center" style="max-width:680px;">
			<div class="eyebrow"><?php esc_html_e( 'HOW WE DELIVER', 'amatec' ); ?></div>
			<h2 class="h2"><?php echo esc_html( ! empty( $s['title'] ) ? $s['title'] : __( 'A clear path from audit to autopilot', 'amatec' ) ); ?></h2>
			<p class="lead"><?php echo esc_html( ! empty( $s['sub'] ) ? $s['sub'] : __( 'Every engagement is consulting-led and right-sized: start with quick wins, then scale as ROI proves out.', 'amatec' ) ); ?></p>
		</div>

		<div class="lp-step-grid" style="--lp-steps:<?php echo (int) count( $s['items'] ); ?>;">
			<?php foreach ( $s['items'] as $i => $st ) : ?>
				<div class="lp-step">
					<div class="top">
						<span class="ic"><i data-lucide="<?php echo esc_attr( $st['icon'] ); ?>"></i></span>
						<span class="num"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					</div>
					<h3 class="h3"><?php echo esc_html( $st['t'] ); ?></h3>
					<p><?php echo esc_html( $st['d'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
