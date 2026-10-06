<?php
/**
 * About — how we work / values.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$values = array(
	array( 'icon' => 'target',                  'title' => 'Outcomes, not hours',      'body' => 'We sell time back and fewer errors, not seats, not buzzwords. If a workflow doesn’t remove real work, it doesn’t ship.' ),
	array( 'icon' => 'layers',                  'title' => 'Build on your stack',      'body' => 'No rip-and-replace. We automate the tools you already pay for and connect them so they finally talk to each other.' ),
	array( 'icon' => 'git-commit-horizontal',   'title' => 'Small steps, real budgets','body' => 'We ship in increments that fit what you can spend: one annoying handoff at a time, not a six-month rebuild.' ),
	array( 'icon' => 'shield-check',            'title' => 'We stay on the hook',      'body' => 'Monitoring, alerts, and tuning come with it. As your business changes, the workflow changes with it without silent breakages.' ),
);
?>
<section id="values" class="section values">
	<div class="wrap">
		<div class="sec-head center">
			<div class="eyebrow">HOW WE WORK</div>
			<h2 class="h2">Four rules we don&rsquo;t bend</h2>
			<p class="lead">They&rsquo;re why clients stay, and why we turn down work that doesn&rsquo;t fit.</p>
		</div>
		<div class="values-grid">
			<?php foreach ( $values as $i => $v ) : ?>
				<div class="card value">
					<div class="top">
						<span class="ic"><i data-lucide="<?php echo esc_attr( $v['icon'] ); ?>"></i></span>
						<span class="num">0<?php echo esc_html( $i + 1 ); ?></span>
					</div>
					<h3 class="h3"><?php echo esc_html( $v['title'] ); ?></h3>
					<p><?php echo esc_html( $v['body'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
