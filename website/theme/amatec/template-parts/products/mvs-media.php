<?php
/**
 * Multi Vendor SKU — one media slot (screenshot or looping video).
 *
 * Args: 'file' (name from amatec_mvs_media()), 'eager' (true for the hero),
 * 'dark' (true on navy sections), 'still' (show the still even when a video
 * exists), 'ratio' (CSS aspect-ratio, e.g. '5 / 2'; default = the file's own),
 * 'sizes' (img sizes attribute), 'zoom' (click or Enter opens the full-size
 * file in an overlay; see amatec_mvs_zoom_script()).
 *
 * Files come from assets/media/multi-vendor-sku/ (built by
 * mvs-media/build_media.py): {name}.webp plus optional {name}-800w.webp /
 * {name}-1000w.webp for srcset, and {name}.webm / {name}.mp4 for animations
 * (the {name}.webp is their poster). A raw {name}.png, .jpg or .gif dropped in
 * also works. With no file the slot shows a grey placeholder with the name.
 *
 * Videos load after first paint (hero) or when scrolled near (the rest);
 * see initMvsVideos() in assets/js/amatec.js.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$name       = $args['file'];
$media      = amatec_mvs_media();
$item       = isset( $media[ $name ] ) ? $media[ $name ] : array( 'type' => 'screenshot', 'alt' => '' );
$eager      = ! empty( $args['eager'] );
$dark       = ! empty( $args['dark'] );
$still_only = ! empty( $args['still'] );
$sizes      = ! empty( $args['sizes'] ) ? $args['sizes'] : '100vw';
$dir        = 'assets/media/multi-vendor-sku/';
$animated   = 'animation' === $item['type'] && ! $still_only;

$still = '';
foreach ( array( 'webp', 'png', 'jpg' ) as $ext ) {
	if ( is_file( get_theme_file_path( $dir . $name . '.' . $ext ) ) ) {
		$still = $dir . $name . '.' . $ext;
		break;
	}
}
$size = $still ? getimagesize( get_theme_file_path( $still ) ) : false;
$w    = $size ? (int) $size[0] : 1600;
$h    = $size ? (int) $size[1] : 1000;

$srcset = array();
if ( $still ) {
	foreach ( (array) glob( get_theme_file_path( $dir . $name . '-*w.webp' ) ) as $file ) {
		if ( preg_match( '/-(\d+)w\.webp$/', $file, $m ) && (int) $m[1] < $w ) {
			$srcset[ (int) $m[1] ] = get_theme_file_uri( $dir . basename( $file ) ) . ' ' . $m[1] . 'w';
		}
	}
	if ( $srcset ) {
		$srcset[ $w ] = get_theme_file_uri( $still ) . ' ' . $w . 'w';
		ksort( $srcset );
	}
}

$videos = array();
if ( $animated ) {
	// WebM first (smaller); the codecs hint lets Safari versions without VP9 fall back to MP4.
	foreach ( array( 'webm' => 'video/webm; codecs="vp9"', 'mp4' => 'video/mp4' ) as $ext => $mime ) {
		if ( is_file( get_theme_file_path( $dir . $name . '.' . $ext ) ) ) {
			$videos[ $mime ] = get_theme_file_uri( $dir . $name . '.' . $ext );
		}
	}
}
// A GIF dropped in without a video conversion still animates, as an image.
$gif = ( $animated && ! $videos && is_file( get_theme_file_path( $dir . $name . '.gif' ) ) ) ? $dir . $name . '.gif' : '';
if ( $gif ) {
	$size = getimagesize( get_theme_file_path( $gif ) );
	$w    = $size ? (int) $size[0] : $w;
	$h    = $size ? (int) $size[1] : $h;
}

$ratio = ! empty( $args['ratio'] ) ? $args['ratio'] : ( ( $size || $videos ) ? $w . ' / ' . $h : '' );
$img   = $gif ? $gif : $still;
$zoom  = '';
if ( ! empty( $args['zoom'] ) && ( $videos || $img ) ) {
	/* translators: %s: media description. */
	$label = sprintf( __( 'Enlarge: %s', 'amatec' ), $item['alt'] );
	$zoom  = ' data-zoom="' . esc_url( $img ? get_theme_file_uri( $img ) : '' ) . '" tabindex="0" role="button" aria-label="' . esc_attr( $label ) . '"';
}
?>
<figure class="mvs-media<?php echo $dark ? ' on-dark' : ''; ?>"<?php echo $ratio ? ' style="--mvs-ratio:' . esc_attr( $ratio ) . ';"' : ''; ?><?php echo $zoom; // phpcs:ignore WordPress.Security.EscapeOutput -- escaped above. ?>>
	<?php if ( $videos ) : ?>
		<video class="mvs-shot" data-mvs-video<?php echo $eager ? ' data-eager="1"' : ''; ?> muted autoplay loop playsinline preload="none"
			width="<?php echo esc_attr( $w ); ?>" height="<?php echo esc_attr( $h ); ?>"
			<?php
			if ( $still ) {
				echo ( $eager ? 'poster="' : 'data-poster="' ) . esc_url( get_theme_file_uri( $still ) ) . '"';
			}
			?>
			aria-label="<?php echo esc_attr( $item['alt'] ); ?>">
			<?php foreach ( $videos as $mime => $src ) : ?>
				<source data-src="<?php echo esc_url( $src ); ?>" type="<?php echo esc_attr( $mime ); ?>">
			<?php endforeach; ?>
		</video>
		<?php if ( $still && ! $eager ) : ?>
			<noscript><img class="mvs-shot" src="<?php echo esc_url( get_theme_file_uri( $still ) ); ?>" alt="<?php echo esc_attr( $item['alt'] ); ?>" width="<?php echo esc_attr( $w ); ?>" height="<?php echo esc_attr( $h ); ?>" loading="lazy"></noscript>
		<?php endif; ?>
	<?php elseif ( $img ) : ?>
		<img class="mvs-shot" src="<?php echo esc_url( get_theme_file_uri( $img ) ); ?>"
			<?php if ( $srcset && ! $gif ) : ?>
				srcset="<?php echo esc_attr( implode( ', ', $srcset ) ); ?>" sizes="<?php echo esc_attr( $sizes ); ?>"
			<?php endif; ?>
			alt="<?php echo esc_attr( $item['alt'] ); ?>" width="<?php echo esc_attr( $w ); ?>" height="<?php echo esc_attr( $h ); ?>"
			<?php echo $eager ? 'fetchpriority="high"' : 'loading="lazy"'; ?> decoding="async">
	<?php else : ?>
		<div class="mvs-ph" role="img" aria-label="<?php echo esc_attr( $item['alt'] ); ?>">
			<i data-lucide="<?php echo 'animation' === $item['type'] ? 'film' : 'image'; ?>"></i>
			<span class="nm"><?php echo esc_html( $name ); ?></span>
			<span class="alt"><?php echo esc_html( $item['alt'] ); ?></span>
		</div>
	<?php endif; ?>
</figure>
