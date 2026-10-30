<?php
/**
 * Multi Vendor SKU — one media slot (screenshot or looping animation).
 *
 * Args: 'file' (name from amatec_mvs_media()), 'eager' (true for the hero),
 * 'dark' (true on navy sections). Renders the real file from
 * assets/media/multi-vendor-sku/ when present, else a grey placeholder box
 * labelled with the file name.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$name  = $args['file'];
$media = amatec_mvs_media();
$item  = isset( $media[ $name ] ) ? $media[ $name ] : array( 'type' => 'screenshot', 'alt' => '' );
$eager = ! empty( $args['eager'] );
$dark  = ! empty( $args['dark'] );
$dir   = 'assets/media/multi-vendor-sku/';

$poster = is_file( get_theme_file_path( $dir . $name . '.webp' ) ) ? $dir . $name . '.webp' : '';
$videos = array();
foreach ( array( 'webm' => 'video/webm', 'mp4' => 'video/mp4' ) as $ext => $mime ) {
	if ( 'animation' === $item['type'] && is_file( get_theme_file_path( $dir . $name . '.' . $ext ) ) ) {
		$videos[ $mime ] = $dir . $name . '.' . $ext;
	}
}
$size = $poster ? getimagesize( get_theme_file_path( $poster ) ) : false;
$w    = $size ? (int) $size[0] : 1600;
$h    = $size ? (int) $size[1] : 1000;
?>
<figure class="mvs-media<?php echo $dark ? ' on-dark' : ''; ?>">
	<?php if ( $videos ) : ?>
		<video class="mvs-shot" autoplay muted loop playsinline preload="<?php echo $eager ? 'auto' : 'none'; ?>"
			width="<?php echo esc_attr( $w ); ?>" height="<?php echo esc_attr( $h ); ?>"
			<?php echo $poster ? 'poster="' . esc_url( get_theme_file_uri( $poster ) ) . '"' : ''; ?>
			aria-label="<?php echo esc_attr( $item['alt'] ); ?>">
			<?php foreach ( $videos as $mime => $src ) : ?>
				<source src="<?php echo esc_url( get_theme_file_uri( $src ) ); ?>" type="<?php echo esc_attr( $mime ); ?>">
			<?php endforeach; ?>
		</video>
	<?php elseif ( $poster ) : ?>
		<img class="mvs-shot" src="<?php echo esc_url( get_theme_file_uri( $poster ) ); ?>" alt="<?php echo esc_attr( $item['alt'] ); ?>"
			width="<?php echo esc_attr( $w ); ?>" height="<?php echo esc_attr( $h ); ?>"
			<?php echo $eager ? 'fetchpriority="high"' : 'loading="lazy"'; ?> decoding="async">
	<?php else : ?>
		<div class="mvs-ph" role="img" aria-label="<?php echo esc_attr( $item['alt'] ); ?>">
			<i data-lucide="<?php echo 'animation' === $item['type'] ? 'film' : 'image'; ?>"></i>
			<span class="nm"><?php echo esc_html( $name ); ?></span>
			<span class="alt"><?php echo esc_html( $item['alt'] ); ?></span>
		</div>
	<?php endif; ?>
</figure>
