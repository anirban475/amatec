<?php
/**
 * Multi Vendor SKU — demo video. Shows the YouTube thumbnail with a play
 * button; the player loads only on click (see amatec_mvs_video_script()).
 * With no amatec_mvs()['video_id'] it shows the placeholder instead.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$mvs     = amatec_mvs();
$section = $mvs['video'];
$vid     = $mvs['video_id'];
$minutes = max( 1, (int) round( amatec_mvs_video_seconds() / 60 ) );
?>
<section id="mvs-video" class="prod-cta">
	<div class="dotgrid" aria-hidden="true"></div>
	<div class="grad" aria-hidden="true"></div>
	<div class="wrap section inner">
		<div class="sec-head center on-dark" style="max-width:680px;">
			<div class="eyebrow on-dark"><?php esc_html_e( 'DEMO', 'amatec' ); ?></div>
			<h2 class="h2"><?php echo esc_html( $section['h2'] ); ?></h2>
			<p class="lead">
				<?php
				if ( $vid && ! empty( $section['lead_video'] ) ) {
					echo esc_html( $section['lead_video'] );
				} elseif ( $vid ) {
					/* translators: %d: video length in minutes. */
					echo esc_html( sprintf( __( 'A %d minute walkthrough of the full flow, from setup to matching vendor bills.', 'amatec' ), $minutes ) );
				} else {
					echo esc_html( $section['lead_empty'] );
				}
				?>
			</p>
		</div>

		<div style="margin-top:44px;max-width:920px;margin-left:auto;margin-right:auto;">
			<div class="prod-frame">
				<div class="bar">
					<span class="d" style="background:#FF5F57;"></span>
					<span class="d" style="background:#FEBC2E;"></span>
					<span class="d" style="background:#28C840;"></span>
					<span class="addr"><?php echo esc_html( $section['bar'] ); ?></span>
				</div>
				<?php if ( $vid ) : ?>
					<a class="media yt mvs-yt" href="<?php echo esc_url( 'https://www.youtube.com/watch?v=' . $vid ); ?>" target="_blank" rel="noopener noreferrer"
						data-yt="<?php echo esc_attr( $vid ); ?>" data-title="<?php echo esc_attr( $mvs['video_title'] ); ?>"
						aria-label="<?php esc_attr_e( 'Play the Multi Vendor SKU demo video', 'amatec' ); ?>">
						<img class="mvs-yt-thumb" src="<?php echo esc_url( 'https://i.ytimg.com/vi/' . $vid . '/maxresdefault.jpg' ); ?>"
							alt="" width="1280" height="720" loading="lazy" decoding="async">
						<span class="ph">
							<span class="play"><i data-lucide="play"></i></span>
						</span>
						<span class="yt-tag"><?php esc_html_e( 'YouTube', 'amatec' ); ?></span>
					</a>
				<?php else : ?>
					<div class="media dark">
						<div class="ph">
							<span class="play"><i data-lucide="play"></i></span>
							<span class="cap"><?php esc_html_e( 'Demo video coming soon', 'amatec' ); ?></span>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
