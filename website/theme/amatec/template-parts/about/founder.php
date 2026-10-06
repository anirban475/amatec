<?php
/**
 * About — founder story (Anirban Sinha).
 * Portrait uses a branded placeholder; drop a real photo into
 * assets/img/founder-anirban-sinha.jpg to replace it.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$creds = array(
	array( 'icon' => 'badge-check', 'text' => 'Certified: Make · n8n · Zoho · Monday' ),
	array( 'icon' => 'package',     'text' => 'Published Make.com app: Aurora Solar' ),
	array( 'icon' => 'star',        'text' => 'Upwork Expert: Make & n8n Architect' ),
	array( 'icon' => 'bot',         'text' => 'AI pipelines: GPT-4o · Whisper · Postgres' ),
);
$photo     = get_theme_file_path( 'assets/img/founder-anirban-sinha.jpg' );
$photo_uri = get_theme_file_uri( 'assets/img/founder-anirban-sinha.jpg' );
$has_photo = file_exists( $photo );
?>
<section id="founder" class="section founder">
	<div class="wrap">
		<div class="founder-grid">

			<div class="founder-photo reveal">
				<div class="founder-frame">
					<?php if ( $has_photo ) : ?>
						<img src="<?php echo esc_url( $photo_uri ); ?>" alt="Anirban Sinha, founder of AMATEC">
						<div class="scrim"></div>
					<?php else : ?>
						<div class="stripes"></div>
						<div class="grad"></div>
						<div class="ph-label"><span>Founder portrait</span></div>
					<?php endif; ?>
				</div>
				<div class="float-chip">
					<span class="badge"><i data-lucide="workflow"></i></span>
					<span>
						<span class="k">Founder</span>
						<span class="v">Anirban Sinha</span>
					</span>
				</div>
			</div>

			<div class="founder-copy reveal" style="animation-delay:.1s;">
				<div class="eyebrow">The founder</div>
				<h2 class="h2">One person obsessed with automation, now a studio that lives it.</h2>
				<div class="body">
					<p>
						AMATEC started with <strong>Anirban Sinha</strong> and a simple conviction:
						if software can do the work, a human shouldn't. Nine years and hundreds of workflows later, that
						conviction is the whole company.
					</p>
					<p>
						He builds in <strong>Make.com, n8n, Zoho and Monday.com</strong>, certified
						across all four, with a public app on the Make marketplace. Through Upwork and Fiverr he&rsquo;s wired up
						CRM, finance and marketing automations for clients from Texas to the EU, and he drops AI in where it earns
						its place: GPT-4o pipelines, Whisper transcription, Postgres-and-Slack coaching bots.
					</p>
				</div>
				<div class="founder-creds">
					<?php foreach ( $creds as $c ) : ?>
						<div class="cred">
							<span class="ic"><i data-lucide="<?php echo esc_attr( $c['icon'] ); ?>"></i></span>
							<span class="txt"><?php echo esc_html( $c['text'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

		</div>
	</div>
</section>
