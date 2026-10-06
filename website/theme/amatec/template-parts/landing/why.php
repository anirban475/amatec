<?php
/**
 * Landing "Why AMATEC" — dark band with reason list and optional client quote.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$data  = $args['data'];
$w     = $data['why'];
$quote = isset( $data['quote'] ) ? $data['quote'] : null;
?>
<section id="lp-why" class="lp-why">
	<div class="dotgrid" aria-hidden="true"></div>
	<div class="grad" aria-hidden="true"></div>
	<div class="wrap section inner">
		<div class="lp-why-grid<?php echo $quote ? ' has-quote' : ''; ?>">

			<div>
				<div class="eyebrow on-dark"><?php esc_html_e( 'WHY AMATEC', 'amatec' ); ?></div>
				<h2 class="h2"><?php echo esc_html( ! empty( $w['title'] ) ? $w['title'] : __( 'Automation partners, not just builders', 'amatec' ) ); ?></h2>
				<ul class="lp-why-list">
					<?php foreach ( $w['items'] as $r ) : ?>
						<li>
							<span class="ic"><i data-lucide="<?php echo esc_attr( $r['icon'] ); ?>"></i></span>
							<span>
								<span class="t"><?php echo esc_html( $r['t'] ); ?></span>
								<span class="d"><?php echo esc_html( $r['d'] ); ?></span>
							</span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<?php if ( $quote ) : ?>
				<div class="lp-quote">
					<i data-lucide="quote"></i>
					<blockquote><?php echo esc_html( $quote['text'] ); ?></blockquote>
					<div class="who">
						<span class="badge"><i data-lucide="sprout"></i></span>
						<span>
							<span class="n"><?php echo esc_html( $quote['name'] ); ?></span>
							<span class="r"><?php echo esc_html( $quote['role'] ); ?></span>
						</span>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>
</section>
