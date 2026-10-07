<?php
/**
 * Landing "what we automate" — copy + dark stack panel left, checklist right.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$data  = $args['data'];
$a     = $data['automate'];
$stack = $data['stack'];
?>
<section id="lp-automate" class="section" style="background:var(--bg-page);">
	<div class="wrap">
		<div class="lp-automate-grid">

			<div>
				<div class="sec-head">
					<div class="eyebrow"><?php echo esc_html( $a['eyebrow'] ); ?></div>
					<h2 class="h2"><?php echo esc_html( $a['title'] ); ?></h2>
					<p class="lead"><?php echo esc_html( $a['sub'] ); ?></p>
				</div>

				<div class="lp-stack">
					<div class="dotgrid" aria-hidden="true"></div>
					<div class="inner">
						<div class="k"><?php esc_html_e( 'Built on your stack', 'amatec' ); ?></div>
						<p><?php echo esc_html( $stack['text'] ); ?></p>
						<div class="chips">
							<?php foreach ( $stack['chips'] as $c ) : ?>
								<span class="lp-chip"><span class="dot"></span><?php echo esc_html( $c ); ?></span>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>

			<div class="lp-automate-list">
				<?php foreach ( $a['items'] as $t ) : ?>
					<div class="lp-check">
						<span class="ic"><i data-lucide="check"></i></span>
						<span><?php echo esc_html( $t ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>

		</div>
	</div>
</section>
