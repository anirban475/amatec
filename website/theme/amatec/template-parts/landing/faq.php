<?php
/**
 * Landing FAQ — single-open accordion (first item open; toggled by initLpFaq).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$data = $args['data'];
?>
<section id="lp-faq" class="section" style="background:var(--bg-page);">
	<div class="wrap" style="max-width:880px;">
		<div class="sec-head center" style="max-width:620px;">
			<div class="eyebrow"><?php esc_html_e( 'FAQ', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'Questions, answered', 'amatec' ); ?></h2>
		</div>

		<div class="lp-faq" data-lp-faq>
			<?php foreach ( $data['faqs'] as $i => $f ) : ?>
				<div class="lp-faq-item<?php echo 0 === $i ? ' open' : ''; ?>">
					<button class="lp-faq-q" type="button" aria-expanded="<?php echo 0 === $i ? 'true' : 'false'; ?>">
						<span class="q"><?php echo esc_html( $f['q'] ); ?></span>
						<span class="toggle" aria-hidden="true"><span></span><span></span></span>
					</button>
					<div class="lp-faq-a" <?php echo 0 === $i ? '' : 'hidden'; ?>>
						<p><?php echo esc_html( $f['a'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
