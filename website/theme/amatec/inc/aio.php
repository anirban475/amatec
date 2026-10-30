<?php
/**
 * AI search (AIO) helpers: FAQ content for the homepage, platform and product
 * pages, Organization structured data, and the /llms.txt route.
 *
 * FAQ arrays feed template-parts/landing/faq.php, which prints both the visible
 * accordion and matching FAQPage JSON-LD from the same data.
 *
 * @package AMATEC
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Homepage FAQ.
 *
 * @return array
 */
function amatec_home_faqs() {
	return array(
		array(
			'q' => __( 'What does Amatec do?', 'amatec' ),
			'a' => __( 'Amatec is a workflow automation agency based in Vadodara, India. We build automations on Make.com, n8n, Zoho and monday.com that move data between a company’s tools so nobody has to copy it by hand. Most of our clients are small and mid-sized businesses in the US and Europe.', 'amatec' ),
		),
		array(
			'q' => __( 'Should I use Make.com, n8n or Zapier?', 'amatec' ),
			'a' => __( 'Zapier is the quickest to set up for simple, low-volume tasks. Make.com handles branching logic and larger volumes at a lower cost per task. n8n suits teams that want to run automation on their own server or need custom code. We recommend one after looking at your tools, your volume and your data rules on the first call.', 'amatec' ),
		),
		array(
			'q' => __( 'How long does an automation project take?', 'amatec' ),
			'a' => __( 'A single workflow, such as sending web leads into a CRM with a follow-up email, usually goes live in one to three weeks. Projects that connect several systems or need custom code take longer. You get a go-live date in the fixed-scope quote before any work starts.', 'amatec' ),
		),
		array(
			'q' => __( 'How much does workflow automation cost?', 'amatec' ),
			'a' => __( 'We quote a fixed price for each project after the free audit, based on how many steps, systems and edge cases the workflow has. Many clients start with one workflow, see the hours it saves, then automate the next one.', 'amatec' ),
		),
		array(
			'q' => __( 'Do we have to replace the tools we already use?', 'amatec' ),
			'a' => __( 'No. We build on the software you already pay for, such as your CRM, accounting tool, inbox and spreadsheets, and connect them so they share data.', 'amatec' ),
		),
		array(
			'q' => __( 'What happens if an automation breaks?', 'amatec' ),
			'a' => __( 'Every workflow we build has error handling and alerts, so a failed run gets flagged the moment it happens. On a support plan we monitor your workflows, fix failures and update them when your process or one of your tools changes.', 'amatec' ),
		),
		array(
			'q' => __( 'Do you work with companies outside India?', 'amatec' ),
			'a' => __( 'Yes. Most of our clients are in the US and Europe. We work remotely, agree on meeting hours that overlap with your time zone, and run every call in English.', 'amatec' ),
		),
	);
}

/**
 * About page FAQ. Facts only from the About page itself.
 *
 * @return array
 */
function amatec_about_faqs() {
	return array(
		array(
			'q' => __( 'Who founded Amatec?', 'amatec' ),
			'a' => __( 'Amatec was founded by Anirban Sinha. He has built client automations since 2020 on Make.com, n8n, Zoho and monday.com, and started Amatec on one idea: if software can do the work, a person should not have to.', 'amatec' ),
		),
		array(
			'q' => __( 'Where is Amatec based, and where are its clients?', 'amatec' ),
			'a' => __( 'Amatec is an automation studio in Vadodara, Gujarat, India. It works remotely with clients in the US, Europe and Asia.', 'amatec' ),
		),
		array(
			'q' => __( 'Which platforms is Amatec certified on?', 'amatec' ),
			'a' => __( 'Amatec is certified on Make.com, Zoho and monday.com. It also builds production and self-hosted workflows on n8n.', 'amatec' ),
		),
		array(
			'q' => __( 'Has Amatec published its own apps?', 'amatec' ),
			'a' => __( 'Yes. Amatec has published two extensions on the Zoho Marketplace, Stock Procurement for Zoho Inventory and T-Chat for Zoho CRM, and a public app on Make.com for Aurora Solar.', 'amatec' ),
		),
		array(
			'q' => __( 'How does Amatec run a project?', 'amatec' ),
			'a' => __( 'It starts with a free 30-minute call and a fixed-scope quote. Amatec builds on the tools you already pay for, ships in small steps that fit your budget, and includes monitoring and alerts so a workflow does not break silently.', 'amatec' ),
		),
	);
}

/**
 * Contact page FAQ. Facts only from the Contact page itself.
 *
 * @return array
 */
function amatec_contact_faqs() {
	return array(
		array(
			'q' => __( 'How do I contact Amatec?', 'amatec' ),
			'a' => __( 'Email hello@amatec.in, call +91 72659 69478, or use the form on this page. The studio is at Kplex, Alkapuri, Vadodara, Gujarat 390007, India.', 'amatec' ),
		),
		array(
			'q' => __( 'How quickly does Amatec reply?', 'amatec' ),
			'a' => __( 'Most messages get a reply within one business day. An automation engineer reads every message, not a ticketing bot.', 'amatec' ),
		),
		array(
			'q' => __( 'Can I book a call instead of writing?', 'amatec' ),
			'a' => __( 'Yes. Pick any open slot for a free 30-minute workflow audit with the engineer who would build it. You get an instant confirmation by email.', 'amatec' ),
		),
		array(
			'q' => __( 'What happens on the free audit call?', 'amatec' ),
			'a' => __( 'We map the process that takes up your week, show you a before and after, and follow up with a fixed-scope quote, or tell you honestly if you do not need us.', 'amatec' ),
		),
		array(
			'q' => __( 'What should I put in my message?', 'amatec' ),
			'a' => __( 'Describe the process you want to automate and the tools it touches. No field is required to start, but the more detail you give, the more useful the first reply is.', 'amatec' ),
		),
	);
}

/**
 * FAQ sets for the platform, AI and product pages.
 *
 * @param string $key make|n8n|monday|zoho|ai|tchat|stock|mvs.
 * @return array
 */
function amatec_platform_faqs( $key ) {
	$mvs  = amatec_mvs();
	$sets = array(
		'make'   => array(
			array(
				'q' => __( 'What is a Make.com scenario?', 'amatec' ),
				'a' => __( 'A scenario is an automated workflow in Make.com. It starts with a trigger, such as a new form entry or a set time, then runs a chain of modules that read, change and send data between apps. Routers split it into branches, and error handlers decide what happens when a step fails.', 'amatec' ),
			),
			array(
				'q' => __( 'Is Make.com better than Zapier?', 'amatec' ),
				'a' => __( 'For simple two-step tasks, Zapier is quicker to set up. Make.com is the better fit once a workflow needs branches, loops, data transformation or high volume, because it shows the whole flow on one canvas and usually costs less per operation.', 'amatec' ),
			),
			array(
				'q' => __( 'Can you fix a scenario someone else built?', 'amatec' ),
				'a' => __( 'Yes. We audit the existing scenario, remove wasted operations, add error handling and document it. A cleaner build usually uses fewer operations, which also lowers your Make.com bill.', 'amatec' ),
			),
			array(
				'q' => __( 'Can you move our Zaps from Zapier to Make.com?', 'amatec' ),
				'a' => __( 'Yes. We map each Zap, rebuild it as a Make.com scenario, run both side by side on real data, and switch the Zap off once the results match.', 'amatec' ),
			),
			array(
				'q' => __( 'Do we own the scenarios you build?', 'amatec' ),
				'a' => __( 'Yes. We build in your own Make.com organisation, document every scenario and walk your team through it at handover.', 'amatec' ),
			),
		),
		'n8n'    => array(
			array(
				'q' => __( 'What is n8n?', 'amatec' ),
				'a' => __( 'n8n is a workflow automation platform with a visual editor that also accepts custom JavaScript and Python code. It uses a fair-code licence, so you can host it on your own server and keep the data in your workflows inside your own infrastructure.', 'amatec' ),
			),
			array(
				'q' => __( 'Should we self-host n8n or use n8n Cloud?', 'amatec' ),
				'a' => __( 'n8n Cloud is quicker to start, and n8n runs the servers for you. Self-hosting suits companies with strict data rules, high run volumes or a need for custom nodes. We set up and maintain either option.', 'amatec' ),
			),
			array(
				'q' => __( 'Is self-hosted n8n secure?', 'amatec' ),
				'a' => __( 'It is when it is set up properly. We deploy it behind HTTPS with access controls, encrypted credentials, scheduled backups and regular updates, and keep the editor off the public internet wherever the workflows allow.', 'amatec' ),
			),
			array(
				'q' => __( 'Can n8n connect to our internal database or API?', 'amatec' ),
				'a' => __( 'Yes. n8n has nodes for common databases such as Postgres and MySQL, an HTTP Request node for any REST API, and webhooks for systems that push data out. When a system has no API, we look at other routes, such as file drops or email parsing.', 'amatec' ),
			),
			array(
				'q' => __( 'Can n8n run AI workflows?', 'amatec' ),
				'a' => __( 'Yes. n8n has built-in nodes for OpenAI, Anthropic and other model providers, plus AI agent nodes. We use them to sort email, extract invoice data and summarise call transcripts.', 'amatec' ),
			),
		),
		'monday' => array(
			array(
				'q' => __( 'What can monday.com automations do?', 'amatec' ),
				'a' => __( 'monday.com automations are rules written as "when this happens, do that". They can change a status, assign an owner, create an item, send a notification or move an item to another board. Integrations extend the same rules to tools like Slack, Gmail and HubSpot.', 'amatec' ),
			),
			array(
				'q' => __( 'Why do monday.com boards get messy?', 'amatec' ),
				'a' => __( 'Boards usually grow one column at a time with no plan, so the same data ends up in three places and nobody trusts the status. We fix the board structure first and add automations second, because automating a messy board only makes the mess move faster.', 'amatec' ),
			),
			array(
				'q' => __( 'Can monday.com sync with our CRM or accounting tool?', 'amatec' ),
				'a' => __( 'Yes. We use monday.com’s own integrations where they exist and Make.com or n8n where they don’t, so records stay in step without anyone copying them across.', 'amatec' ),
			),
			array(
				'q' => __( 'Do you train our team?', 'amatec' ),
				'a' => __( 'Yes. Every build ends with documentation and a training session, so your team can run the boards and adjust simple automations without waiting for us.', 'amatec' ),
			),
		),
		'zoho'   => array(
			array(
				'q' => __( 'What is Deluge in Zoho?', 'amatec' ),
				'a' => __( 'Deluge is Zoho’s scripting language. It runs custom functions inside Zoho CRM, Books, Creator and other Zoho apps for logic that the built-in workflow rules can’t handle, such as assigning leads by region or syncing records between apps.', 'amatec' ),
			),
			array(
				'q' => __( 'Zoho Flow or Make.com: which should we use?', 'amatec' ),
				'a' => __( 'Zoho Flow fits when most of your tools are Zoho apps and the logic is simple. Make.com or n8n is the better choice when you connect many non-Zoho tools or need complex branching. We often use Deluge inside Zoho and Make.com or n8n for everything outside it.', 'amatec' ),
			),
			array(
				'q' => __( 'Do you build custom Zoho extensions?', 'amatec' ),
				'a' => __( 'Yes. We have published two extensions on the Zoho Marketplace: Stock Procurement for Zoho Inventory and Twilio Chat for Zoho CRM. We also build private extensions for a single company’s Zoho account.', 'amatec' ),
			),
			array(
				'q' => __( 'Can you automate Zoho Books?', 'amatec' ),
				'a' => __( 'Yes. We automate invoices created from CRM deals, payment reminders, bank transaction rules and reporting in Zoho Books, and connect it to payment gateways such as Razorpay, PayPal and Stripe.', 'amatec' ),
			),
			array(
				'q' => __( 'Can ChatGPT or Claude read our Zoho data?', 'amatec' ),
				'a' => __( 'Yes, through an MCP server. We build MCP servers that give an AI assistant read-only access to your Zoho Books, Inventory or CRM data, so you can ask questions about your business in plain English.', 'amatec' ),
			),
		),
		'ai'     => array(
			array(
				'q' => __( 'What is AI task automation?', 'amatec' ),
				'a' => __( 'AI task automation adds a language model to a workflow so it can handle steps that need some judgment, like reading an email, pulling fields from an invoice or scoring a lead. The rest of the workflow stays rule-based, so every AI decision has an input and an output you can check.', 'amatec' ),
			),
			array(
				'q' => __( 'Which AI models do you use?', 'amatec' ),
				'a' => __( 'Mostly OpenAI models for text and Whisper for speech-to-text, with Anthropic Claude where it fits better. We pick the cheapest model that does the task reliably and switch when a better option appears.', 'amatec' ),
			),
			array(
				'q' => __( 'What is an MCP server?', 'amatec' ),
				'a' => __( 'MCP (Model Context Protocol) is an open standard that lets AI assistants such as ChatGPT and Claude connect to outside tools and data. An MCP server we build for your Zoho account or database lets the assistant look up your real records when it answers.', 'amatec' ),
			),
			array(
				'q' => __( 'Is our data safe with AI automation?', 'amatec' ),
				'a' => __( 'We send a model only the fields a task needs, use API providers whose terms exclude training on your data, and log every request. For sensitive data we can run the workflow on self-hosted n8n.', 'amatec' ),
			),
			array(
				'q' => __( 'Will AI replace our staff?', 'amatec' ),
				'a' => __( 'No. It takes the repetitive first pass off their plate. People still review anything where a wrong answer would cost money or upset a customer.', 'amatec' ),
			),
		),
		'tchat'  => array(
			array(
				'q' => __( 'What is T-Chat for Zoho CRM?', 'amatec' ),
				'a' => __( 'T-Chat is a Zoho CRM extension built by Amatec. It connects your Twilio account to Zoho CRM so your team can send and receive SMS and MMS from a lead or contact record. On the Zoho Marketplace it is listed as Twilio Chat for Zoho CRM.', 'amatec' ),
			),
			array(
				'q' => __( 'Do I need a Twilio account?', 'amatec' ),
				'a' => __( 'Yes. T-Chat uses your own Twilio account and phone number, so Twilio bills your messages at your normal Twilio rates.', 'amatec' ),
			),
			array(
				'q' => __( 'Where can we see past messages?', 'amatec' ),
				'a' => __( 'Each conversation is linked to the matching lead or contact in Zoho CRM, so anyone with access to that record can see the full message history.', 'amatec' ),
			),
			array(
				'q' => __( 'How do I install T-Chat?', 'amatec' ),
				'a' => __( 'Install it from the Zoho Marketplace, add your Twilio credentials in the extension settings and choose the number to send from. Setup takes a few minutes and needs no code.', 'amatec' ),
			),
		),
		'stock'  => array(
			array(
				'q' => __( 'What does Stock Procurement for Zoho Inventory do?', 'amatec' ),
				'a' => __( 'It works out which raw materials to buy for a production target. You enter how many composite items you plan to make, and it breaks each one down through its bill of materials and gives you a purchase list you can download.', 'amatec' ),
			),
			array(
				'q' => __( 'Does it handle multi-level composite items?', 'amatec' ),
				'a' => __( 'Yes. It breaks bundles and kits down level by level, the same way Zoho Inventory stores them.', 'amatec' ),
			),
			array(
				'q' => __( 'Do I need to move my data anywhere?', 'amatec' ),
				'a' => __( 'No. The extension runs inside Zoho Inventory and reads the items and bills of materials you already have.', 'amatec' ),
			),
			array(
				'q' => __( 'Who supports the extension?', 'amatec' ),
				'a' => __( 'Amatec built it and supports it directly. Book a call through our contact page if you need it adapted to your setup.', 'amatec' ),
			),
		),
		'mvs'    => array(
			array(
				'q' => __( 'What is Multi Vendor SKU for Zoho Inventory?', 'amatec' ),
				'a' => __( 'It is a Zoho Inventory extension that stores the SKU each vendor uses for your items. It fills those SKUs on purchase orders and bills, and matches vendor bills back to your items by the vendor\'s SKU. You install it from Zoho Marketplace.', 'amatec' ),
			),
			array(
				'q' => __( 'Can one item have a different SKU for each vendor?', 'amatec' ),
				'a' => __( 'Yes. Save a separate SKU for every vendor you buy the item from. Your "Hex Bolt M8x40" can be "SHK-1000" at one vendor and "BB-77" at another, and each purchase order shows the code for the vendor on that order.', 'amatec' ),
			),
			array(
				'q' => __( 'Does it change my own item SKU in Zoho Inventory?', 'amatec' ),
				'a' => __( 'No. Vendor SKUs are stored separately, in a custom module called Vendor SKUs and a custom item field called Vendor SKU. The SKU field on your item stays as it is.', 'amatec' ),
			),
			array(
				'q' => __( 'How do I add SKUs for items I already buy?', 'amatec' ),
				'a' => __( 'Export Vendors and Bills from Zoho Inventory as CSV files and drop both into setup. The app lists every item you have bought from each vendor, with how often you bought it and the last price. Type each vendor\'s SKU and click Save SKUs. To load many at once, use Bulk Import with a CSV file.', 'amatec' ),
			),
			array(
				'q' => __( 'Does it work with bills from vendors?', 'amatec' ),
				'a' => __( 'Yes. Paste the lines from a vendor\'s bill and the app finds your items by the vendor\'s SKU, in upper or lower case, and fills the bill lines. On a saved bill, the Bill Check panel checks the bill against its purchase order.', 'amatec' ),
			),
			array(
				'q' => __( 'Which Zoho Inventory editions and regions does it support?', 'amatec' ),
				'a' => __( 'It works with any Zoho Inventory edition in any Zoho data centre. You install it from Zoho Marketplace, and the interface is in English. A Zoho Books version is planned.', 'amatec' ),
			),
			array(
				'q' => __( 'How much does it cost and how do I get support?', 'amatec' ),
				/* translators: 1: price, 2: support email. */
				'a' => sprintf( __( 'Multi Vendor SKU costs %1$s. For help, email %2$s. Amatec built the app and gives support directly.', 'amatec' ), $mvs['price'], $mvs['email'] ),
			),
		),
	);
	return isset( $sets[ $key ] ) ? $sets[ $key ] : array();
}

/**
 * Organization + ProfessionalService structured data on the homepage,
 * About and Contact. Remove this if Yoast "Site representation" is later
 * set to Organization, to avoid two organisation entities.
 */
function amatec_org_schema() {
	if ( ! ( is_front_page() || is_page( array( 'about', 'contact' ) ) ) ) {
		return;
	}
	$home = home_url( '/' );
	$data = array(
		'@context'     => 'https://schema.org',
		'@type'        => array( 'Organization', 'ProfessionalService' ),
		'@id'          => $home . '#organization',
		'name'         => 'Amatec',
		'url'          => $home,
		'logo'         => get_theme_file_uri( 'assets/img/amatec-logo-full.png' ),
		'image'        => get_theme_file_uri( 'assets/img/amatec-logo-full.png' ),
		'description'  => 'Amatec is a workflow automation agency in Vadodara, India. It builds and maintains automated workflows on Make.com, n8n, Zoho and monday.com, adds AI steps and MCP servers to them, and publishes extensions on the Zoho Marketplace.',
		'email'        => 'hello@amatec.in',
		'telephone'    => '+91 72659 69478',
		'address'      => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'Kplex, Alkapuri',
			'addressLocality' => 'Vadodara',
			'addressRegion'   => 'Gujarat',
			'postalCode'      => '390007',
			'addressCountry'  => 'IN',
		),
		'founder'      => array(
			'@type'    => 'Person',
			'name'     => 'Anirban Sinha',
			'jobTitle' => 'Founder',
			'url'      => home_url( '/about/' ),
		),
		'areaServed'   => array( 'United States', 'United Kingdom', 'European Union', 'India' ),
		'knowsAbout'   => array( 'Workflow automation', 'Make.com', 'n8n', 'Zoho CRM', 'Zoho Books', 'Zoho Inventory', 'Deluge', 'monday.com', 'Zapier', 'AI automation', 'Model Context Protocol' ),
		'sameAs'       => array(
			'https://www.linkedin.com/company/amatec83',
			'https://www.youtube.com/@AMATEC-automation',
			'https://www.instagram.com/amatec.in/',
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}
add_action( 'wp_head', 'amatec_org_schema', 20 );

/**
 * Serve the theme's llms.txt at https://amatec.in/llms.txt.
 *
 * @param WP $wp Current WordPress environment.
 */
function amatec_llms_txt( $wp ) {
	if ( 'llms.txt' !== $wp->request ) {
		return;
	}
	$file = get_theme_file_path( 'llms.txt' );
	if ( ! file_exists( $file ) ) {
		return;
	}
	// Hide lines for pages that start as drafts until they are published.
	$body = file_get_contents( $file );
	foreach ( amatec_site_pages() as $slug => $titles ) {
		if ( isset( $titles[2]['status'] ) && 'draft' === $titles[2]['status'] && ! amatec_page_is_live( $slug ) ) {
			$body = preg_replace( '#^.*\]\(https?://[^)]*/' . preg_quote( $slug, '#' ) . '/\).*\R#m', '', $body );
		}
	}
	status_header( 200 );
	header( 'Content-Type: text/plain; charset=utf-8' );
	header( 'X-Robots-Tag: noindex' );
	echo $body; // phpcs:ignore WordPress.Security.EscapeOutput -- plain-text file shipped with the theme.
	$cases = function_exists( 'amatec_cs_llms_lines' ) ? amatec_cs_llms_lines() : array();
	if ( $cases ) {
		echo "\n## Case studies\n\n" . implode( "\n", $cases ) . "\n";
	}
	exit;
}
add_action( 'parse_request', 'amatec_llms_txt' );
