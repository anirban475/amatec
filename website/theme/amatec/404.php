<?php
/**
 * 404 — not found.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>
<section class="hero" style="min-height:60vh;display:grid;place-items:center;">
	<div class="hero-dotgrid dotgrid"></div>
	<div class="wrap" style="position:relative;text-align:center;padding:120px 0;">
		<div class="eyebrow on-dark">ERROR 404</div>
		<h1 class="h1" style="margin-top:14px;color:#fff;">This page took the day <span style="color:var(--orange-400);">off</span>.</h1>
		<p class="lead" style="margin:18px auto 0;color:var(--blue-100);max-width:480px;">
			The page you&rsquo;re after doesn&rsquo;t exist, but your busywork still does. Let&rsquo;s fix that instead.
		</p>
		<div style="margin-top:30px;display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
			<a class="btn btn-accent" href="<?php echo esc_url( home_url( '/' ) ); ?>"><i data-lucide="home"></i> Back home</a>
		</div>
	</div>
</section>
<?php
get_footer();
