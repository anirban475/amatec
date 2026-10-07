<?php
/**
 * About — hero anchor panel.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$chips = array( 'EST. VADODARA · INDIA', 'CLIENTS IN US · EU · ASIA', 'Make · n8n · Zoho · Monday' );
?>
<section id="about-hero" class="about-hero">
	<div class="dotgrid" style="position:absolute;inset:0;opacity:.28;pointer-events:none;"></div>
	<div class="grad"></div>
	<div class="glow"></div>
	<div class="wrap inner">
		<div class="badge reveal"><span class="dot orange"></span> About AMATEC</div>
		<h1 class="h1 reveal" style="animation-delay:.05s;">
			Automation is the <span class="accent">only thing</span> we do.
		</h1>
		<p class="lead reveal" style="animation-delay:.1s;">
			We&rsquo;re an automation studio in Vadodara, India. Since 2020 we have built workflows on Make.com,
			n8n, Zoho and monday.com for teams in the US, Europe and Asia.
		</p>
		<div class="actions reveal" style="animation-delay:.15s;">
			<a class="btn btn-accent" href="#about-cta" data-scroll="#about-cta"><i data-lucide="zap"></i> Book a free audit</a>
			<a class="btn btn-outline-light" href="#founder" data-scroll="#founder"><i data-lucide="arrow-down"></i> Meet the founder</a>
		</div>
		<div class="chips reveal" style="animation-delay:.2s;">
			<?php foreach ( $chips as $c ) : ?>
				<span><?php echo esc_html( $c ); ?></span>
			<?php endforeach; ?>
		</div>
	</div>
</section>
