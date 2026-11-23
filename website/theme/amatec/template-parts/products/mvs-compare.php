<?php
/**
 * Multi Vendor SKU — before and after table (stacks into cards on mobile).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$section = amatec_mvs()['compare'];
$rows    = $section['rows'];
?>
<section id="mvs-compare" class="section" style="background:var(--bg-page);">
	<div class="wrap" style="max-width:1080px;">
		<div class="sec-head center" style="max-width:680px;">
			<div class="eyebrow"><?php esc_html_e( 'BEFORE AND AFTER', 'amatec' ); ?></div>
			<h2 class="h2"><?php echo esc_html( $section['h2'] ); ?></h2>
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
