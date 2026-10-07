<?php
/**
 * Home — hero: dark navy panel, interactive WebGL mesh gradient, live workflow diagram.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$nodes = array(
	array( 'icon' => 'file-text',  'label' => 'Form',     'sub' => 'new lead',      'color' => 'var(--slate-500)' ),
	array( 'icon' => 'webhook',    'label' => 'Trigger',  'sub' => 'n8n',           'color' => 'var(--blue-500)' ),
	array( 'icon' => 'git-branch', 'label' => 'Route',    'sub' => 'enrich + score','color' => 'var(--orange-500)' ),
	array( 'icon' => 'database',   'label' => 'Zoho CRM', 'sub' => 'create deal',   'color' => 'var(--success)' ),
);
$last = count( $nodes ) - 1;
?>
<section id="home" class="hero">
	<canvas class="hero-canvas" data-mesh aria-hidden="true"></canvas>
	<div class="hero-dotgrid dotgrid"></div>
	<div class="wrap hero-grid">
		<div class="reveal">
			<div class="hero-badge">
				<span class="dot orange"></span>
				ZOHO PARTNER · n8n · MAKE · MONDAY
			</div>
			<h1 class="h1">Stop doing what <span class="accent">software</span> should do for you.</h1>
			<p class="lead hero-lead">
				Amatec builds automated workflows on Make.com, n8n, Zoho and monday.com. Your CRM, inbox,
				invoices and spreadsheets start passing data to each other, and nobody copies it by hand again.
			</p>
			<div class="hero-actions">
				<a class="btn btn-accent" href="#contact" data-scroll="#contact"><i data-lucide="zap"></i> Book a free workflow audit</a>
				<a class="btn btn-outline-light" href="#how-it-works" data-scroll="#how-it-works"><i data-lucide="play"></i> See how it works</a>
			</div>
			<div class="hero-assure">
				<span><i data-lucide="check" style="color:var(--orange-400);width:16px;height:16px;"></i> No rip-and-replace</span>
				<span><i data-lucide="check" style="color:var(--orange-400);width:16px;height:16px;"></i> Fixed-scope quote before we build</span>
			</div>
		</div>

		<div class="reveal" style="animation-delay:.12s;">
			<div class="wf dotgrid">
				<div class="wf-top">
					<span class="name">lead-intake.workflow</span>
					<span class="run"><span class="dot success"></span>running</span>
				</div>
				<div class="wf-flow">
					<?php foreach ( $nodes as $i => $n ) : ?>
						<div class="wf-node">
							<div class="row">
								<span class="ic" style="background:<?php echo esc_attr( $n['color'] ); ?>;"><i data-lucide="<?php echo esc_attr( $n['icon'] ); ?>"></i></span>
								<span class="lbl"><?php echo esc_html( $n['label'] ); ?></span>
							</div>
							<div class="sub"><?php echo esc_html( $n['sub'] ); ?></div>
						</div>
						<?php if ( $i < $last ) : ?>
							<div class="wf-wire"><span class="flow-dot" style="animation-delay:<?php echo esc_attr( $i * 0.5 ); ?>s;"></span></div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
				<div class="wf-stats">
					<span>⚡ 1,284 runs / wk</span><span>⏱ avg 1.4s</span><span class="ok">● 0 errors</span>
				</div>
			</div>
		</div>
	</div>
</section>
