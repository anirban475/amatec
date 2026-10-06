<?php
/**
 * Home — platforms / partner-stack band.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$platforms = array(
	array( 'name' => 'n8n',        'icon' => 'workflow',    'tint' => 'var(--blue-600)',   'note' => 'Self-hosted automation' ),
	array( 'name' => 'Make.com',   'icon' => 'git-merge',   'tint' => 'var(--orange-500)', 'note' => 'Visual scenarios' ),
	array( 'name' => 'Monday CRM', 'icon' => 'layout-grid', 'tint' => 'var(--blue-500)',   'note' => 'CRM & ops boards' ),
	array( 'name' => 'Zoho',       'icon' => 'briefcase',   'tint' => 'var(--success)',    'note' => 'Official partner' ),
);
?>
<section id="platforms" class="platforms">
	<div class="wrap">
		<div class="kicker">Built on the platforms you already trust</div>
		<div class="platforms-grid">
			<?php foreach ( $platforms as $p ) : ?>
				<div class="card platform">
					<span class="ic" style="background:<?php echo esc_attr( $p['tint'] ); ?>;"><i data-lucide="<?php echo esc_attr( $p['icon'] ); ?>"></i></span>
					<div>
						<div class="nm"><?php echo esc_html( $p['name'] ); ?></div>
						<div class="note"><?php echo esc_html( $p['note'] ); ?></div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
