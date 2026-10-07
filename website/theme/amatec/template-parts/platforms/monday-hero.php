<?php
/**
 * monday.com hero — Core Certified badge + live board mockup whose status
 * pills cycle (initMondayBoard in amatec.js).
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$rows = array(
	array( 'item' => 'Launch landing page', 'who' => 'AS', 'wc' => '#7A5AF5', 'due' => 'Jun 12', 'seq' => 'work,work,done', 'off' => 0 ),
	array( 'item' => 'QA automation recipes', 'who' => 'RZ', 'wc' => '#22B07D', 'due' => 'Jun 10', 'seq' => 'work,done,done', 'off' => 1 ),
	array( 'item' => 'Client onboarding', 'who' => 'NB', 'wc' => '#E2445C', 'due' => 'Jun 14', 'seq' => 'stuck,work,done', 'off' => 0 ),
	array( 'item' => 'Draft case study', 'who' => 'MK', 'wc' => '#2D77F0', 'due' => 'Jun 16', 'seq' => 'work,stuck,done', 'off' => 2 ),
);
?>
<section id="monday-hero" class="lp-hero" style="text-align:center;">
	<div class="dotgrid" aria-hidden="true"></div>
	<div class="grad" aria-hidden="true"></div>
	<div class="glow" aria-hidden="true"></div>

	<div class="wrap" style="position:relative;padding-top:50px;padding-bottom:54px;">
		<div class="hero-badge reveal">
			<span class="dot orange"></span> <?php esc_html_e( 'monday.com Workflow Automation', 'amatec' ); ?>
		</div>

		<h1 class="h1 reveal" style="margin-top:20px;max-width:1040px;font-size:clamp(34px,4.4vw,54px);margin-left:auto;margin-right:auto;animation-delay:.05s;">
			<?php esc_html_e( 'Turn monday.com boards into', 'amatec' ); ?><br>
			<span class="accent"><?php esc_html_e( 'automated workflow engines', 'amatec' ); ?></span>
		</h1>

		<p class="lead reveal" style="margin-top:20px;color:var(--blue-100);max-width:720px;margin-left:auto;margin-right:auto;animation-delay:.1s;">
			<?php esc_html_e( 'We set up monday.com boards, automation recipes and integrations so status updates, handoffs and reports happen on their own. Managers see where every project stands without asking.', 'amatec' ); ?>
		</p>

		<div class="pf-cert-badge reveal" style="animation-delay:.12s;">
			<span class="ic"><i data-lucide="badge-check"></i></span>
			<span class="txt">
				<span class="k"><?php esc_html_e( 'monday.com Certified', 'amatec' ); ?></span>
				<span class="v"><?php esc_html_e( 'Work Management · Core', 'amatec' ); ?></span>
			</span>
		</div>

		<div class="reveal" style="display:flex;gap:14px;margin-top:24px;justify-content:center;flex-wrap:wrap;animation-delay:.15s;">
			<a href="#contact" class="btn btn-accent"><i data-lucide="calendar-clock"></i> <?php esc_html_e( 'Book a free consultation', 'amatec' ); ?></a>
			<a href="#monday-services" class="btn btn-outline-light"><i data-lucide="arrow-down"></i> <?php esc_html_e( 'See what we build', 'amatec' ); ?></a>
		</div>

		<div class="pf-canvas-card reveal" style="max-width:880px;animation-delay:.2s;">
			<div class="bar">
				<span class="dot" style="background:var(--orange-500);"></span>
				<span class="name"><?php esc_html_e( 'Marketing Sprint · board', 'amatec' ); ?></span>
				<span class="run"><span class="dot success"></span> <?php esc_html_e( 'Automations · on', 'amatec' ); ?></span>
			</div>
			<div class="scroll">
				<div class="monday-board" data-monday-board>
					<div class="group-head">
						<span class="rail"></span>
						<span class="g"><?php esc_html_e( 'In progress', 'amatec' ); ?></span>
						<span class="n"><?php esc_html_e( '4 items', 'amatec' ); ?></span>
					</div>
					<div class="cols-head">
						<span><?php esc_html_e( 'Item', 'amatec' ); ?></span>
						<span style="text-align:center;"><?php esc_html_e( 'Owner', 'amatec' ); ?></span>
						<span style="text-align:center;"><?php esc_html_e( 'Status', 'amatec' ); ?></span>
						<span style="text-align:center;"><?php esc_html_e( 'Due', 'amatec' ); ?></span>
					</div>
					<?php foreach ( $rows as $r ) : ?>
						<div class="row">
							<span class="item"><?php echo esc_html( $r['item'] ); ?></span>
							<span class="who" style="background:<?php echo esc_attr( $r['wc'] ); ?>;"><?php echo esc_html( $r['who'] ); ?></span>
							<span class="status" data-seq="<?php echo esc_attr( $r['seq'] ); ?>" data-off="<?php echo esc_attr( $r['off'] ); ?>"></span>
							<span class="due"><?php echo esc_html( $r['due'] ); ?></span>
						</div>
					<?php endforeach; ?>
					<div class="recipe">
						<i data-lucide="zap"></i>
						<span><span class="k"><?php esc_html_e( 'Recipe', 'amatec' ); ?></span>&nbsp; <?php esc_html_e( 'When status →', 'amatec' ); ?> <b><?php esc_html_e( 'Done', 'amatec' ); ?></b>, <?php esc_html_e( 'notify owner & move to', 'amatec' ); ?> <b><?php esc_html_e( 'Shipped', 'amatec' ); ?></b></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
