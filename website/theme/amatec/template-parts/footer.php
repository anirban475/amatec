<?php
/**
 * Site footer — brand + audit CTA, sitemap columns, legal bar.
 * Driven by amatec_site_menu().
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$menu     = amatec_site_menu();
$home_url = home_url( '/' );
$resolve  = function ( $href ) use ( $home_url ) {
	if ( is_string( $href ) && isset( $href[0] ) && '#' === $href[0] && ! ( is_front_page() || is_home() ) ) {
		return $home_url . $href;
	}
	return $href;
};
$cols = array_values( array_filter( $menu, function ( $m ) { return ! empty( $m['items'] ); } ) );
$flat = array_values( array_filter( $menu, function ( $m ) { return empty( $m['items'] ); } ) );

$socials = array(
	'youtube'   => array( 'href' => 'https://www.youtube.com/@AMATEC-automation', 'label' => 'YouTube', 'path' => 'M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z' ),
	'linkedin'  => array( 'href' => 'https://www.linkedin.com/company/amatec83', 'label' => 'LinkedIn', 'path' => 'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z' ),
	'instagram' => array( 'href' => 'https://www.instagram.com/amatec.in/', 'label' => 'Instagram', 'path' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.012-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z' ),
);
?>
<footer class="site-footer">
	<div class="dotgrid">
		<div class="wrap" style="padding-top:72px;padding-bottom:40px;">

			<div class="foot-top">
				<div class="foot-brand">
					<?php amatec_logo( 'footer' ); ?>
					<p>Business process automation for teams that are done doing software&rsquo;s job by hand.</p>
					<div class="foot-social">
						<?php foreach ( $socials as $name => $s ) : ?>
							<a href="<?php echo esc_url( $s['href'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $s['label'] ); ?>">
								<svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="<?php echo esc_attr( $s['path'] ); ?>"/></svg>
							</a>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="foot-audit">
					<div class="k">Free automation audit</div>
					<div class="t">Find the busywork worth automating</div>
					<a class="btn btn-accent" href="<?php echo esc_url( $resolve( '#contact' ) ); ?>" data-scroll="#contact"><i data-lucide="zap"></i> Book Free Audit</a>
				</div>
			</div>

			<div class="foot-cols" style="--foot-cols:<?php echo (int) count( $cols ); ?>;">
				<?php foreach ( $cols as $c ) : ?>
					<div class="foot-col">
						<div class="head"><?php echo esc_html( $c['label'] ); ?></div>
						<ul>
							<?php foreach ( $c['items'] as $l ) : ?>
								<li><a href="<?php echo esc_url( $resolve( $l['href'] ) ); ?>"><?php echo esc_html( $l['label'] ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="foot-legal">
				<span class="copy">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>. All rights reserved.</span>
				<span class="links">
					<?php foreach ( $flat as $f ) : ?>
						<a href="<?php echo esc_url( $resolve( $f['href'] ) ); ?>"><?php echo esc_html( $f['label'] ); ?></a>
					<?php endforeach; ?>
					<?php
					$legal = array(
						array( 'label' => 'Terms & Conditions', 'href' => home_url( '/termsandconditions/' ) ),
						array( 'label' => 'Privacy Policy', 'href' => home_url( '/privacypolicy/' ) ),
						array( 'label' => 'Refund Policy', 'href' => home_url( '/refundpolicy/' ) ),
						array( 'label' => 'Cancellation Policy', 'href' => home_url( '/cancellationpolicy/' ) ),
					);
					foreach ( $legal as $l ) :
						?>
						<a href="<?php echo esc_url( $resolve( $l['href'] ) ); ?>"><?php echo esc_html( $l['label'] ); ?></a>
					<?php endforeach; ?>
				</span>
			</div>

		</div>
	</div>
</footer>
