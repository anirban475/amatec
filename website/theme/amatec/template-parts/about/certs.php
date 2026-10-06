<?php
/**
 * About — platforms we're certified in + client proof.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$platforms = array(
	array( 'name' => 'Make',   'tld' => '.com', 'color' => '#6E3AD6', 'note' => 'Public app published' ),
	array( 'name' => 'n8n',    'tld' => '',     'color' => '#E2476A', 'note' => 'Self-hosted builds' ),
	array( 'name' => 'Zoho',   'tld' => '',     'color' => '#E42527', 'note' => 'Partner & full suite' ),
	array( 'name' => 'monday', 'tld' => '.com', 'color' => '#5C5CF0', 'note' => 'CRM build-outs' ),
);
$clients = array( 'Blink Energy Services · TX', 'Chaoshi Limited', 'Recurring EU clients' );
?>
<section id="platforms-certs" class="section certs">
	<div class="wrap">
		<div class="sec-head center">
			<div class="eyebrow">CERTIFIED &amp; PROVEN</div>
			<h2 class="h2">We only recommend tools we&rsquo;ve mastered</h2>
			<p class="lead">Certified across all four platforms we build on, with a public app on the Make marketplace to prove it.</p>
		</div>
		<div class="certs-grid">
			<?php foreach ( $platforms as $p ) : ?>
				<div class="cert">
					<div class="badge-row"><span><i data-lucide="badge-check"></i>Certified</span></div>
					<div class="nm" style="color:<?php echo esc_attr( $p['color'] ); ?>;">
						<?php echo esc_html( $p['name'] ); ?><?php if ( $p['tld'] ) : ?><span class="tld"><?php echo esc_html( $p['tld'] ); ?></span><?php endif; ?>
					</div>
					<div class="note"><?php echo esc_html( $p['note'] ); ?></div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="certs-proof">
			<span class="kicker">Trusted by teams worldwide</span>
			<div class="clients">
				<?php foreach ( $clients as $c ) : ?>
					<span><i data-lucide="building-2"></i><?php echo esc_html( $c ); ?></span>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
