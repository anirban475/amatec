<?php
/**
 * Stock Procurement — six-feature capability grid.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$features = array(
	array( 'icon' => 'calculator', 't' => 'Raw-material auto-calculation', 'd' => 'Enter how many composite units you want to build. The extension computes every component quantity instantly.' ),
	array( 'icon' => 'layers', 't' => 'Composite item breakdown', 'd' => 'Explodes bundles and kits into their underlying raw materials, level by level, exactly as Zoho stores them.' ),
	array( 'icon' => 'clipboard-list', 't' => 'Custom procurement form', 'd' => 'A purpose-built form inside Zoho Inventory: pick items, set targets, and generate a plan in a few clicks.' ),
	array( 'icon' => 'file-down', 't' => 'Real-time downloadable report', 'd' => 'Export a clean, shareable procurement report the moment your plan is ready. No copy-paste required.' ),
	array( 'icon' => 'shield-check', 't' => 'Built-in data validation', 'd' => 'Catches missing quantities and broken mappings before they turn into purchasing mistakes.' ),
	array( 'icon' => 'plug', 't' => 'Runs inside Zoho Inventory', 'd' => 'Uses the items and bills of materials you already have. Nothing to migrate.' ),
);
?>
<section id="sp-features" class="section" style="background:var(--bg-subtle);">
	<div class="wrap">
		<div class="sec-head center" style="max-width:680px;">
			<div class="eyebrow"><?php esc_html_e( 'WHAT IT DOES', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'Everything you need to procure with confidence', 'amatec' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'Six capabilities that turn composite-item planning from a spreadsheet chore into a one-click step.', 'amatec' ); ?></p>
		</div>

		<div class="lp-benefit-grid">
			<?php foreach ( $features as $f ) : ?>
				<div class="card lp-benefit">
					<span class="ic"><i data-lucide="<?php echo esc_attr( $f['icon'] ); ?>"></i></span>
					<h3 class="h3"><?php echo esc_html( $f['t'] ); ?></h3>
					<p><?php echo esc_html( $f['d'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
