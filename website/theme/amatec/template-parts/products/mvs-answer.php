<?php
/**
 * Multi Vendor SKU — quotable answer block (AIO) + at-a-glance facts card.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$answer = amatec_mvs()['answer'];
$facts  = $answer['facts'];
?>
<section id="mvs-answer" class="section" style="background:var(--bg-page);">
	<div class="wrap">
		<div class="mvs-answer-grid">

			<div>
				<div class="eyebrow"><?php esc_html_e( 'IN SHORT', 'amatec' ); ?></div>
				<h2 class="h2" style="margin-top:14px;"><?php esc_html_e( 'What is Multi Vendor SKU?', 'amatec' ); ?></h2>
				<p class="lead mvs-answer" style="margin-top:18px;">
					<?php echo esc_html( $answer['text'] ); ?>
				</p>
			</div>

			<div class="card mvs-glance">
				<div class="mvs-glance-head"><i data-lucide="clipboard-list"></i> <?php esc_html_e( 'At a glance', 'amatec' ); ?></div>
				<dl>
					<?php foreach ( $facts as $f ) : ?>
						<div class="row">
							<dt><?php echo esc_html( $f['k'] ); ?></dt>
							<dd>
								<?php if ( ! empty( $f['href'] ) ) : ?>
									<a href="<?php echo esc_url( $f['href'] ); ?>"><?php echo esc_html( $f['v'] ); ?></a>
								<?php else : ?>
									<?php echo esc_html( $f['v'] ); ?>
								<?php endif; ?>
							</dd>
						</div>
					<?php endforeach; ?>
				</dl>
			</div>

		</div>
	</div>
</section>
