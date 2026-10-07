<?php
/**
 * Legal page renderer — navy hero + numbered prose sections + sticky sidebar
 * (on-this-page TOC + legal links). Content entry selected by page slug from
 * inc/legal-pages.php.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$pages = amatec_legal_pages();
$slug  = get_post_field( 'post_name' );
$page  = isset( $pages[ $slug ] ) ? $pages[ $slug ] : null;

if ( ! $page ) {
	return;
}

$legal_links = array(
	array( 'label' => 'Terms & Conditions', 'slug' => 'termsandconditions' ),
	array( 'label' => 'Privacy Policy', 'slug' => 'privacypolicy' ),
	array( 'label' => 'Refund Policy', 'slug' => 'refundpolicy' ),
	array( 'label' => 'Cancellation Policy', 'slug' => 'cancellationpolicy' ),
);
?>
<section class="lp-hero">
	<div class="dotgrid" aria-hidden="true"></div>
	<div class="grad" aria-hidden="true"></div>
	<div class="glow" aria-hidden="true"></div>

	<div class="wrap" style="position:relative;padding-top:88px;padding-bottom:64px;">
		<div class="hero-badge reveal">
			<span class="dot orange"></span> <?php esc_html_e( 'Legal', 'amatec' ); ?>
		</div>

		<h1 class="h1 reveal" style="margin-top:22px;max-width:880px;animation-delay:.05s;"><?php echo esc_html( $page['title'] ); ?></h1>

		<div class="reveal" style="display:flex;flex-wrap:wrap;gap:12px;margin-top:26px;animation-delay:.1s;">
			<span class="chip legal-chip"><i data-lucide="calendar-check"></i> <?php echo esc_html( $page['effective'] ); ?></span>
			<span class="chip legal-chip"><i data-lucide="clock"></i> <?php echo esc_html( $page['read'] ); ?></span>
		</div>

		<p class="lead reveal" style="margin-top:26px;color:var(--blue-100);max-width:720px;animation-delay:.15s;"><?php echo esc_html( $page['lead'] ); ?></p>
	</div>
</section>

<section class="section" style="background:var(--bg-page);">
	<div class="wrap">
		<div class="legal-layout">

			<div>
				<?php if ( ! empty( $page['intro'] ) ) : ?>
					<p class="lead" style="padding-bottom:30px;margin-bottom:38px;border-bottom:1px solid var(--border-subtle);"><?php echo esc_html( $page['intro'] ); ?></p>
				<?php endif; ?>

				<div style="display:flex;flex-direction:column;gap:40px;">
					<?php foreach ( $page['sections'] as $s ) : ?>
						<div id="<?php echo esc_attr( $s['id'] ); ?>" style="scroll-margin-top:96px;">
							<div style="display:flex;align-items:baseline;gap:14px;">
								<span class="legal-num"><?php echo esc_html( $s['n'] ); ?></span>
								<h2 class="h3" style="font-size:23px;"><?php echo esc_html( $s['title'] ); ?></h2>
							</div>
							<div class="legal-body">
								<?php if ( ! empty( $s['intro'] ) ) : ?>
									<p><?php echo esc_html( $s['intro'] ); ?></p>
								<?php endif; ?>
								<?php if ( ! empty( $s['body'] ) ) : ?>
									<?php foreach ( $s['body'] as $p ) : ?>
										<p><?php echo esc_html( $p ); ?></p>
									<?php endforeach; ?>
								<?php endif; ?>
								<?php if ( ! empty( $s['list'] ) ) : ?>
									<ul class="legal-list">
										<?php foreach ( $s['list'] as $li ) : ?>
											<li><span class="dot"></span><span><?php echo esc_html( $li ); ?></span></li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
								<?php if ( ! empty( $s['email'] ) ) : ?>
									<a class="legal-email" href="mailto:<?php echo esc_attr( $s['email'] ); ?>">
										<span class="ic"><i data-lucide="mail"></i></span>
										<span class="addr"><?php echo esc_html( $s['email'] ); ?></span>
									</a>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="card legal-cta">
					<div>
						<div class="h3"><?php echo esc_html( $page['cta_title'] ); ?></div>
						<p class="muted" style="margin:6px 0 0;font-size:15px;"><?php echo esc_html( $page['cta_sub'] ); ?></p>
					</div>
					<a class="btn btn-accent" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><i data-lucide="mail"></i> <?php esc_html_e( 'Contact us', 'amatec' ); ?></a>
				</div>
			</div>

			<aside class="legal-aside">
				<div>
					<div class="side-k"><?php esc_html_e( 'On this page', 'amatec' ); ?></div>
					<ul>
						<?php foreach ( $page['sections'] as $s ) : ?>
							<li>
								<a class="legal-toc" href="#<?php echo esc_attr( $s['id'] ); ?>">
									<span class="n"><?php echo esc_html( $s['n'] ); ?></span><?php echo esc_html( $s['title'] ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<div style="border-top:1px solid var(--border-subtle);padding-top:24px;">
					<div class="side-k"><?php esc_html_e( 'Important links', 'amatec' ); ?></div>
					<ul>
						<?php foreach ( $legal_links as $l ) : ?>
							<?php $current = $l['slug'] === $slug; ?>
							<li>
								<a class="legal-link<?php echo $current ? ' current' : ''; ?>" href="<?php echo esc_url( home_url( '/' . $l['slug'] . '/' ) ); ?>">
									<i data-lucide="<?php echo $current ? 'file-check-2' : 'file-text'; ?>"></i><?php echo esc_html( $l['label'] ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</aside>

		</div>
	</div>
</section>
