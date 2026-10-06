<?php
/**
 * Sticky frosted mega-menu navigation. Driven by amatec_site_menu().
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$menu      = amatec_site_menu();
$home_url  = home_url( '/' );
$resolve   = function ( $href ) use ( $home_url ) {
	// In-page anchors only work on the homepage; elsewhere point them home.
	if ( is_string( $href ) && isset( $href[0] ) && '#' === $href[0] && ! ( is_front_page() || is_home() ) ) {
		return $home_url . $href;
	}
	return $href;
};
?>
<header class="site-header">
	<div class="nav-wrap">
		<div class="nav-row">
			<a href="<?php echo esc_url( $home_url ); ?>" class="nav-logo" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> home">
				<?php amatec_logo( 'header' ); ?>
			</a>

			<ul class="nav-list">
				<?php foreach ( $menu as $item ) :
					$has = ! empty( $item['items'] );
					$two = $has && count( $item['items'] ) > 4;
					$align_right = ! empty( $item['align'] ) && 'right' === $item['align'];
					?>
					<li class="nav-item">
						<a href="<?php echo esc_url( $resolve( $item['href'] ) ); ?>" class="nav-trigger">
							<?php echo esc_html( $item['label'] ); ?>
							<?php if ( $has ) : ?><i class="chev" data-lucide="chevron-down"></i><?php endif; ?>
						</a>
						<?php if ( $has ) : ?>
							<div class="mega<?php echo $two ? ' two-col' : ''; ?><?php echo $align_right ? ' align-right' : ''; ?>">
								<?php if ( ! empty( $item['eyebrow'] ) ) : ?>
									<div class="mega-eyebrow"><?php echo esc_html( $item['eyebrow'] ); ?></div>
								<?php endif; ?>
								<div class="mega-grid">
									<?php foreach ( $item['items'] as $sub ) : ?>
										<a href="<?php echo esc_url( $resolve( $sub['href'] ) ); ?>" class="mega-link">
											<span class="mega-ico"><i data-lucide="<?php echo esc_attr( $sub['icon'] ); ?>"></i></span>
											<span class="mega-label"><?php echo esc_html( $sub['label'] ); ?></span>
										</a>
									<?php endforeach; ?>
								</div>
								<div class="mega-foot">
									<a href="<?php echo esc_url( $resolve( $item['href'] ) ); ?>">Explore <?php echo esc_html( $item['label'] ); ?> <i data-lucide="arrow-right"></i></a>
									<a class="audit" href="<?php echo esc_url( $resolve( '#contact' ) ); ?>">Book a free audit</a>
								</div>
							</div>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>

			<div class="nav-cta-desktop">
				<a class="btn btn-primary" href="<?php echo esc_url( $resolve( '#contact' ) ); ?>" data-scroll="#contact">
					<i data-lucide="zap"></i> Book Free Audit
				</a>
			</div>

			<button class="nav-burger" aria-label="Menu"><i data-lucide="menu"></i></button>
		</div>
	</div>

	<!-- mobile drawer -->
	<div class="mobile-drawer">
		<div class="mobile-inner">
			<?php foreach ( $menu as $item ) :
				$has = ! empty( $item['items'] );
				if ( $has ) : ?>
					<button class="m-acc-head" data-acc>
						<?php echo esc_html( $item['label'] ); ?>
						<i class="chev" data-lucide="chevron-down"></i>
					</button>
					<div class="m-acc-panel">
						<?php foreach ( $item['items'] as $sub ) : ?>
							<a href="<?php echo esc_url( $resolve( $sub['href'] ) ); ?>" class="m-acc-link">
								<i data-lucide="<?php echo esc_attr( $sub['icon'] ); ?>"></i><?php echo esc_html( $sub['label'] ); ?>
							</a>
						<?php endforeach; ?>
					</div>
				<?php else : ?>
					<a href="<?php echo esc_url( $resolve( $item['href'] ) ); ?>" class="m-acc-head"><?php echo esc_html( $item['label'] ); ?></a>
				<?php endif;
			endforeach; ?>
			<div class="mobile-cta">
				<a class="btn btn-primary" href="<?php echo esc_url( $resolve( '#contact' ) ); ?>" data-scroll="#contact"><i data-lucide="zap"></i> Book Free Audit</a>
			</div>
		</div>
	</div>
</header>
