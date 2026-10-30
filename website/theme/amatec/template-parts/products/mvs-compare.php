<?php
/**
 * Multi Vendor SKU — before and after table (stacks into cards on mobile).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$rows = array(
	array( 'task' => 'Vendor codes on a PO', 'before' => 'Looked up in a spreadsheet and typed on each line', 'after' => 'Filled on each line when you pick the vendor' ),
	array( 'task' => 'Changing the vendor on a PO', 'before' => 'Every code retyped for the new vendor', 'after' => 'The SKUs switch to the new vendor\'s codes' ),
	array( 'task' => 'Matching a vendor\'s bill', 'before' => 'Each line matched to an item by eye', 'after' => 'Paste the bill lines and the app finds your items by vendor SKU' ),
	array( 'task' => 'Where vendor codes are kept', 'before' => 'A spreadsheet outside Zoho', 'after' => 'A Vendor SKUs module in your own Zoho Inventory account' ),
	array( 'task' => 'Getting the right item', 'before' => 'The vendor reads your item code and has to work out which of theirs you mean', 'after' => 'The vendor\'s own SKU prints on the PO PDF, so they recognise every line' ),
);
?>
<section id="mvs-compare" class="section" style="background:var(--bg-page);">
	<div class="wrap" style="max-width:1080px;">
		<div class="sec-head center" style="max-width:680px;">
			<div class="eyebrow"><?php esc_html_e( 'BEFORE AND AFTER', 'amatec' ); ?></div>
			<h2 class="h2"><?php esc_html_e( 'Buying with and without Multi Vendor SKU', 'amatec' ); ?></h2>
		</div>

		<div class="card mvs-table-wrap">
			<table class="mvs-table">
				<thead>
					<tr>
						<th scope="col"><?php esc_html_e( 'Task', 'amatec' ); ?></th>
						<th scope="col"><span class="tag before"><i data-lucide="x"></i><?php esc_html_e( 'Without the app', 'amatec' ); ?></span></th>
						<th scope="col"><span class="tag after"><i data-lucide="check"></i><?php esc_html_e( 'With Multi Vendor SKU', 'amatec' ); ?></span></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $rows as $r ) : ?>
						<tr>
							<th scope="row"><?php echo esc_html( $r['task'] ); ?></th>
							<td data-label="<?php esc_attr_e( 'Without the app', 'amatec' ); ?>"><?php echo esc_html( $r['before'] ); ?></td>
							<td data-label="<?php esc_attr_e( 'With Multi Vendor SKU', 'amatec' ); ?>"><?php echo esc_html( $r['after'] ); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
