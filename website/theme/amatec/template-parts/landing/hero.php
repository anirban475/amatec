<?php
/**
 * Landing hero — navy panel, copy left, live "automation flow" mock right.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$data = $args['data'];
$h    = $data['hero'];
$card = $h['card'];
?>
<section id="lp-hero" class="lp-hero">
	<div class="dotgrid" aria-hidden="true"></div>
	<div class="grad" aria-hidden="true"></div>
	<div class="glow" aria-hidden="true"></div>

	<div class="wrap inner">
		<div class="lp-hero-grid">

			<div>
				<div class="hero-badge reveal">
					<span class="dot orange"></span> <?php echo esc_html( $data['eyebrow'] ); ?>
				</div>

				<h1 class="h1 reveal" style="animation-delay:.05s;">
					<?php echo esc_html( $h['lead'] ); ?>
					<span class="accent"><?php echo esc_html( $h['accent'] ); ?></span><?php
					if ( ! empty( $h['tail'] ) ) {
						echo ' ' . esc_html( $h['tail'] );
					}
					?>
				</h1>

				<p class="lead lp-hero-lead reveal" style="animation-delay:.1s;"><?php echo esc_html( $h['intro'] ); ?></p>

				<div class="lp-outcome reveal" style="animation-delay:.12s;">
					<i data-lucide="arrow-right"></i>
					<span><?php echo esc_html( $h['outcome'] ); ?></span>
				</div>

				<div class="lp-hero-actions reveal" style="animation-delay:.15s;">
					<a href="#contact" class="btn btn-accent"><i data-lucide="calendar-clock"></i> <?php esc_html_e( 'Book a meeting', 'amatec' ); ?></a>
					<a href="#lp-benefits" class="btn btn-outline-light"><i data-lucide="arrow-down"></i>
						<?php echo esc_html( ! empty( $h['secondaryCta'] ) ? $h['secondaryCta'] : __( 'See what we automate', 'amatec' ) ); ?>
					</a>
				</div>
			</div>

			<div class="reveal" style="animation-delay:.2s;">
				<div class="lp-flow">
					<div class="lp-flow-top">
						<span class="ic"><i data-lucide="<?php echo esc_attr( ! empty( $card['icon'] ) ? $card['icon'] : 'workflow' ); ?>"></i></span>
						<span class="name"><?php echo esc_html( $card['label'] ); ?></span>
						<span class="run"><span class="dot success"></span> <?php esc_html_e( 'running', 'amatec' ); ?></span>
					</div>

					<div class="lp-flow-items">
						<?php foreach ( $card['items'] as $it ) : ?>
							<div class="lp-flow-item">
								<span class="ic" style="color:<?php echo esc_attr( ! empty( $it['c'] ) ? $it['c'] : 'var(--blue-600)' ); ?>;">
									<i data-lucide="<?php echo esc_attr( $it['icon'] ); ?>"></i>
								</span>
								<span class="txt">
									<span class="lbl"><?php echo esc_html( $it['label'] ); ?></span>
									<span class="sub"><?php echo esc_html( $it['sub'] ); ?></span>
								</span>
								<span class="tag"><i data-lucide="check"></i><?php echo esc_html( $it['tag'] ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="lp-flow-foot">
						<span>
							<?php
							/* translators: %d: number of automated steps in the mock. */
							printf( esc_html__( '%d steps handled · 0 human touches', 'amatec' ), count( $card['items'] ) );
							?>
						</span>
						<span class="self"><i data-lucide="zap"></i><?php esc_html_e( 'self-running', 'amatec' ); ?></span>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
