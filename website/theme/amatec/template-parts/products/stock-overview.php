<?php
/**
 * Stock Procurement — problem/benefits copy + product-shot frame.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$benefits = array(
	array( 't' => 'No more manual BOM math', 'd' => 'Stop calculating component quantities in spreadsheets every time an order changes.' ),
	array( 't' => 'Built for composite items', 'd' => 'Handles multi-level bundles and kits the way Zoho Inventory actually stores them.' ),
	array( 't' => 'Procurement-ready in seconds', 'd' => 'Turn a finished-goods target into an exact purchase list your team can act on.' ),
);
?>
<section id="sp-overview" class="section" style="background:var(--bg-page);">
	<div class="wrap">
		<div class="prod-overview-grid">

			<div>
				<div class="eyebrow"><?php esc_html_e( 'PLAN SMARTER · PROCURE FASTER', 'amatec' ); ?></div>
				<h2 class="h2" style="margin-top:14px;"><?php esc_html_e( 'Instant raw-material planning for composite products', 'amatec' ); ?></h2>
				<p class="lead" style="margin-top:18px;">
					<?php esc_html_e( 'When you build composite items, every sales order hides a tangle of raw materials. Stock Procurement reads your bill of materials, multiplies it out against what you plan to make, and hands back a clean, downloadable purchase list, without leaving Zoho Inventory.', 'amatec' ); ?>
				</p>
				<ul class="prod-benefits">
					<?php foreach ( $benefits as $b ) : ?>
						<li>
							<span class="ic"><i data-lucide="check"></i></span>
							<span>
								<span class="t"><?php echo esc_html( $b['t'] ); ?></span>
								<span class="d"><?php echo esc_html( $b['d'] ); ?></span>
							</span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="card prod-frame" style="padding:0;border-radius:18px;">
				<div class="bar light">
					<span class="d"></span><span class="d"></span><span class="d"></span>
					<span class="addr"><?php esc_html_e( 'Procurement Report', 'amatec' ); ?></span>
				</div>
				<div class="media light" style="aspect-ratio:4/3;">
					<div class="ph">
						<span class="chipicon"><i data-lucide="table-2"></i></span>
						<span class="cap" style="color:var(--blue-600);"><?php esc_html_e( 'extension UI · procurement report', 'amatec' ); ?></span>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
