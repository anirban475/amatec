<?php
/**
 * Landing-page content data — one entry per page slug, generated from the
 * AMATEC design-system bundle (SitePageKit pages: services, industries, solutions).
 * Consumed by template-lp.php, which looks up the entry for the current page slug.
 *
 * @package AMATEC
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function amatec_lp_pages() {
	return array(
		'workflow-automation' => array(
			'eyebrow' => 'Workflow Automation',
			'hero' => array(
				'lead' => 'Hand the busywork to',
				'accent' => 'workflows',
				'tail' => 'that run themselves',
				'intro' => 'We design and build self-running workflows end-to-end on Make.com, Zapier, n8n, and Zoho, so your team stops copying data between tools and focuses on work that grows the business.',
				'outcome' => 'Save time, cut errors, and scale without hiring.',
				'card' => array(
					'icon' => 'workflow',
					'label' => 'workflow.run',
					'items' => array(
						array(
							'icon' => 'mail',
							'label' => 'New form lead',
							'sub' => 'Captured → CRM',
							'tag' => 'Synced',
							'c' => 'var(--blue-600)',
						),
						array(
							'icon' => 'file-spreadsheet',
							'label' => 'Data entry',
							'sub' => '3 apps · no copy-paste',
							'tag' => 'Automated',
							'c' => '#0F9D58',
						),
						array(
							'icon' => 'bell',
							'label' => 'Status alert',
							'sub' => 'Slack · real-time',
							'tag' => 'Sent',
							'c' => 'var(--orange-500)',
						),
					),
				),
			),
			'benefits' => array(
				'eyebrow' => 'WHY AUTOMATE',
				'title' => 'What workflow automation does for your business',
				'sub' => 'Manual processes quietly cost hours every week and introduce errors no one notices until they are expensive. Automation fixes that at the root.',
				'items' => array(
					array(
						'icon' => 'timer',
						't' => 'Save time',
						'd' => 'Eliminate repetitive data entry, follow-ups, and report-building across your tools.',
					),
					array(
						'icon' => 'shield-check',
						't' => 'Reduce errors',
						'd' => 'Remove the human handoffs where mistakes quietly slip in.',
					),
					array(
						'icon' => 'trending-up',
						't' => 'Scale without hiring',
						'd' => 'Handle more volume with the same team. No extra headcount.',
					),
					array(
						'icon' => 'workflow',
						't' => 'Connect everything',
						'd' => 'Make your CRM, email, spreadsheets, and finance tools talk to each other.',
					),
					array(
						'icon' => 'gauge',
						't' => 'Get visibility',
						'd' => 'Trigger real-time alerts, dashboards, and status updates automatically.',
					),
					array(
						'icon' => 'rocket',
						't' => 'Unload your workload',
						'd' => 'Hand the busywork to software that runs it the same way, every time.',
					),
				),
			),
			'automate' => array(
				'eyebrow' => 'WHAT WE BUILD',
				'title' => 'Workflows we automate',
				'sub' => 'We start with the processes that pay back fastest, then build them on the platform that suits your stack.',
				'items' => array(
					'Repetitive data entry across apps',
					'Lead capture, routing & follow-ups',
					'Report building and live dashboards',
					'Real-time alerts and notifications',
					'Approvals and multi-step handoffs',
					'Custom RPA for legacy systems',
				),
			),
			'stack' => array(
				'text' => 'We choose the platform that fits your stack and budget, not the one that is easiest to sell. From visual no-code to self-hosted, developer-grade workflows and custom RPA.',
				'chips' => array(
					'Make.com',
					'Zapier',
					'n8n',
					'Zoho',
					'Monday.com',
					'Custom RPA',
				),
			),
			'delivery' => array(
				'title' => 'How we build your automation',
				'sub' => 'Every engagement follows a clear, consulting-led path, and we scale in small, budget-friendly steps as ROI proves out.',
				'items' => array(
					array(
						'icon' => 'search',
						't' => 'Audit',
						'd' => 'We map your processes and find the highest-ROI tasks to automate.',
					),
					array(
						'icon' => 'pencil-ruler',
						't' => 'Design',
						'd' => 'We architect the workflow logic, integrations, and data flow.',
					),
					array(
						'icon' => 'blocks',
						't' => 'Build',
						'd' => 'We implement on the right platform: no-code, low-code, or custom RPA.',
					),
					array(
						'icon' => 'clipboard-check',
						't' => 'Test & handover',
						'd' => 'We validate, document, and train your team.',
					),
					array(
						'icon' => 'life-buoy',
						't' => 'Support',
						'd' => 'We monitor and refine as your business grows.',
					),
				),
			),
			'why' => array(
				'title' => 'We stay after go-live',
				'items' => array(
					array(
						'icon' => 'award',
						't' => 'Building automations since 2020',
						'd' => 'Automating real businesses across industries and countries.',
					),
					array(
						'icon' => 'git-compare',
						't' => 'Platform-agnostic',
						'd' => 'We recommend what works, not what we resell.',
					),
					array(
						'icon' => 'puzzle',
						't' => 'Right-sized engagements',
						'd' => 'Start small, scale as the ROI proves out.',
					),
					array(
						'icon' => 'handshake',
						't' => 'End-to-end ownership',
						'd' => 'Strategy, build, documentation, and ongoing support.',
					),
				),
			),
			'quote' => array(
				'text' => 'Whether connecting our three main work tools, building file and calendar automations, or a custom production-management app, we work with Amatec small steps at a time. They are now an important part of our resources.',
				'name' => 'Nicholas Baron',
				'role' => 'CEO, produitsducap.com · partner since 2020',
			),
			'faqs' => array(
				array(
					'q' => 'What is workflow automation?',
					'a' => 'Workflow automation uses software to run repetitive, multi-step business processes automatically: moving data between apps, triggering actions, and handling tasks without manual effort.',
				),
				array(
					'q' => 'Which automation platform is best for my business?',
					'a' => 'It depends on your tools, technical needs, and budget. Make.com and Zapier suit most no-code needs; n8n suits teams wanting control and self-hosting; Zoho fits businesses that already run on Zoho apps. We help you decide during your free audit.',
				),
				array(
					'q' => 'Do I need coding skills to use automation?',
					'a' => 'No. We build and maintain the workflows for you, and most run on no-code or low-code platforms your team can manage with light training.',
				),
				array(
					'q' => 'How long does a workflow automation project take?',
					'a' => 'Simple integrations can go live in days; complex, multi-system workflows take a few weeks. We scope timelines during the audit.',
				),
				array(
					'q' => 'How much does workflow automation cost?',
					'a' => 'Cost depends on complexity and the number of processes. We work in small, budget-aligned steps so you see ROI before scaling.',
				),
			),
			'cta' => array(
				'title' => 'Ready to unload your workload?',
				'sub' => 'Book a free 30-minute automation audit. We will review your workflows and tech stack, identify your highest-impact opportunities, and give you a clear plan. No obligation.',
			),
			'meta' => array(
				'seo_title' => 'Workflow Automation Services | AMATEC — Make, Zapier, n8n, Zoho',
				'description' => 'AMATEC builds custom workflow automation that removes repetitive work, cuts errors, and connects your apps using Make.com, Zapier, n8n & Zoho. Book a free automation audit.',
				'post_title' => 'Workflow Automation Services',
			),
		),
		'crm-automation' => array(
			'eyebrow' => 'CRM Automation',
			'hero' => array(
				'lead' => 'A CRM that',
				'accent' => 'updates itself',
				'tail' => 'so your reps can sell',
				'intro' => 'We configure and automate your CRM, with deep Zoho CRM expertise, capturing leads, routing deals, and triggering follow-ups so no lead slips through the cracks and reps spend time selling.',
				'outcome' => 'Never lose a lead. Forecast you can actually trust.',
				'card' => array(
					'icon' => 'contact',
					'label' => 'crm.flow',
					'items' => array(
						array(
							'icon' => 'user-round-plus',
							'label' => 'Inbound lead',
							'sub' => 'Captured from form & ad',
							'tag' => 'Logged',
							'c' => 'var(--blue-600)',
						),
						array(
							'icon' => 'split',
							'label' => 'Deal routed',
							'sub' => 'By territory · to rep',
							'tag' => 'Assigned',
							'c' => '#0F9D58',
						),
						array(
							'icon' => 'send',
							'label' => 'Follow-up',
							'sub' => 'Email + task triggered',
							'tag' => 'Scheduled',
							'c' => 'var(--orange-500)',
						),
					),
				),
			),
			'benefits' => array(
				'eyebrow' => 'WHY AUTOMATE',
				'title' => 'What CRM automation solves',
				'sub' => 'Most CRMs become a chore: reps forget to log activity, leads sit unassigned, and managers cannot trust the pipeline. Automation bridges these gaps.',
				'items' => array(
					array(
						'icon' => 'magnet',
						't' => 'Never lose a lead',
						'd' => 'Auto-capture from forms, ads, email, and chat straight into the CRM.',
					),
					array(
						'icon' => 'split',
						't' => 'Instant lead routing',
						'd' => 'Assign deals to the right rep by territory, source, or value.',
					),
					array(
						'icon' => 'send',
						't' => 'Automated follow-ups',
						'd' => 'Trigger emails, reminders, and tasks at exactly the right stage.',
					),
					array(
						'icon' => 'database',
						't' => 'Clean, reliable data',
						'd' => 'Eliminate duplicate entry and sync records across every tool.',
					),
					array(
						'icon' => 'bar-chart-3',
						't' => 'Accurate forecasting',
						'd' => 'Live dashboards and pipeline reports without manual updates.',
					),
					array(
						'icon' => 'target',
						't' => 'Lead scoring',
						'd' => 'Prioritise the hottest prospects so reps focus where it counts.',
					),
				),
			),
			'automate' => array(
				'eyebrow' => 'WHAT WE BUILD',
				'title' => 'CRM workflows we automate',
				'sub' => 'Sales-aware automation designed around how deals actually close. Built on Zoho, and connected to everything else.',
				'items' => array(
					'Lead capture & enrichment',
					'Lead scoring & instant assignment',
					'Sales pipeline stage automation',
					'Quote, invoice & document flows',
					'Onboarding & post-sale handover',
					'CRM ↔ tool sync (email, finance, support)',
				),
			),
			'stack' => array(
				'text' => 'AMATEC has deep, hands-on Zoho expertise, including custom Zoho extensions like our Stock Procurement and T-Chat apps. Already on a different CRM? We work with your platform and connect it to the rest of your stack.',
				'chips' => array(
					'Zoho CRM',
					'Make.com',
					'Zapier',
					'n8n',
					'Custom development',
				),
			),
			'delivery' => array(
				'title' => 'How we deliver',
				'items' => array(
					array(
						'icon' => 'search',
						't' => 'CRM audit',
						'd' => 'Review your setup, data hygiene, and where leads or deals leak.',
					),
					array(
						'icon' => 'pencil-ruler',
						't' => 'Automation blueprint',
						'd' => 'Map the workflows that save the most time and revenue.',
					),
					array(
						'icon' => 'blocks',
						't' => 'Build & integrate',
						'd' => 'Configure the CRM and connect it to your wider stack.',
					),
					array(
						'icon' => 'clipboard-check',
						't' => 'Test & train',
						'd' => 'Validate every flow and get your team confident using it.',
					),
					array(
						'icon' => 'sliders-horizontal',
						't' => 'Optimize',
						'd' => 'Refine scoring, routing, and reporting as you scale.',
					),
				),
			),
			'why' => array(
				'title' => 'CRM automation built around how deals close',
				'items' => array(
					array(
						'icon' => 'layers',
						't' => 'Specialist Zoho knowledge',
						'd' => 'We have built and published our own Zoho applications.',
					),
					array(
						'icon' => 'trending-up',
						't' => 'Sales-aware automation',
						'd' => 'Workflows designed around how deals actually close.',
					),
					array(
						'icon' => 'git-compare',
						't' => 'Platform-agnostic',
						'd' => 'Your CRM connected to everything else in your stack.',
					),
					array(
						'icon' => 'puzzle',
						't' => 'Step-by-step rollout',
						'd' => 'Start with quick wins, then expand.',
					),
				),
			),
			'faqs' => array(
				array(
					'q' => 'What is CRM automation?',
					'a' => 'CRM automation uses rules and integrations to handle repetitive CRM tasks automatically, capturing leads, updating records, assigning deals, and triggering follow-ups, so your team does not do it by hand.',
				),
				array(
					'q' => 'Which CRM do you specialize in?',
					'a' => 'We have deep expertise in Zoho CRM and have built custom Zoho applications, but we also automate and integrate other major CRMs.',
				),
				array(
					'q' => 'Can you connect my CRM to my other tools?',
					'a' => 'Yes. Using Make.com, Zapier, n8n, and custom integrations, we sync your CRM with email, accounting, support, marketing, and more.',
				),
				array(
					'q' => 'Will automation help my sales team close more deals?',
					'a' => 'Yes. By ensuring fast lead response, no missed follow-ups, and a clean pipeline, automation directly improves conversion and rep productivity.',
				),
				array(
					'q' => 'How do we get started?',
					'a' => 'Book a free CRM audit. We will review your current setup and show you exactly which automations will deliver the fastest return.',
				),
			),
			'cta' => array(
				'title' => 'Turn your CRM into a sales engine',
				'sub' => 'Book a free 30-minute CRM audit. We will find the gaps costing you leads and revenue, and map the automations to fix them. No obligation.',
			),
			'meta' => array(
				'seo_title' => 'CRM Automation Services | AMATEC — Zoho CRM, Pipeline & Sales Automation',
				'description' => 'Automate your CRM with AMATEC. Capture leads, route deals, trigger follow-ups, and sync data automatically across Zoho CRM and your sales stack. Book a free CRM audit.',
				'post_title' => 'CRM Automation Services',
			),
		),
		'it-company' => array(
			'eyebrow' => 'Industries · IT Companies',
			'hero' => array(
				'lead' => 'Grow client delivery',
				'accent' => 'without growing',
				'tail' => 'the admin',
				'intro' => 'IT companies run on repeatable processes, like onboarding, ticketing, project tracking, and billing, that are perfect for automation. We connect your tools into self-running workflows so your technical team focuses on delivery.',
				'outcome' => 'Smoother delivery, faster onboarding, operations that scale.',
				'card' => array(
					'icon' => 'server',
					'label' => 'it.ops',
					'items' => array(
						array(
							'icon' => 'user-round-plus',
							'label' => 'New client',
							'sub' => 'Accounts + docs provisioned',
							'tag' => 'Onboarded',
							'c' => 'var(--blue-600)',
						),
						array(
							'icon' => 'ticket',
							'label' => 'Support ticket',
							'sub' => 'Tagged · routed · SLA set',
							'tag' => 'Routed',
							'c' => '#0F9D58',
						),
						array(
							'icon' => 'receipt',
							'label' => 'Time tracked',
							'sub' => 'Pushed to invoice',
							'tag' => 'Billed',
							'c' => 'var(--orange-500)',
						),
					),
				),
			),
			'benefits' => array(
				'eyebrow' => 'WHY AUTOMATE',
				'title' => 'Why IT companies choose automation',
				'sub' => 'Even technical teams lose hours to manual coordination, such as tracking status updates, managing handoffs, and shuffling data between tools. Automation removes this friction.',
				'items' => array(
					array(
						'icon' => 'user-round-plus',
						't' => 'Faster client onboarding',
						'd' => 'Auto-provision accounts, docs, and kickoff tasks.',
					),
					array(
						'icon' => 'ticket',
						't' => 'Smarter ticketing',
						'd' => 'Route, tag, and escalate support automatically.',
					),
					array(
						'icon' => 'kanban',
						't' => 'Project visibility',
						'd' => 'Real-time status across boards without manual updates.',
					),
					array(
						'icon' => 'receipt',
						't' => 'Automated billing',
						'd' => 'Connect time tracking straight to invoicing.',
					),
					array(
						'icon' => 'bell',
						't' => 'Internal ops',
						'd' => 'Alerts, reporting, and approvals on autopilot.',
					),
					array(
						'icon' => 'code-2',
						't' => 'Speaks your language',
						'd' => 'We build custom apps and integrations ourselves.',
					),
				),
			),
			'automate' => array(
				'eyebrow' => 'WHAT WE AUTOMATE',
				'title' => 'What we automate for IT companies',
				'sub' => 'From client onboarding to incident notifications, we connect your CRM, project tools, helpdesk, and billing into one workflow.',
				'items' => array(
					'Client & employee onboarding / offboarding',
					'Support ticket routing and SLA escalation',
					'Project & sprint tracking (Monday.com, Zoho)',
					'Time-tracking-to-invoice and billing',
					'Deployment & incident notifications to Slack',
					'Internal approvals and reporting',
				),
			),
			'stack' => array(
				'text' => 'We automate using Make.com, n8n, Zapier, Zoho, Monday.com and Slack, connecting your CRM, project tools, helpdesk, and billing. As a team that builds custom apps ourselves, we speak your language.',
				'chips' => array(
					'Make.com',
					'n8n',
					'Zapier',
					'Zoho',
					'Monday.com',
					'Slack',
				),
			),
			'delivery' => array(
				'items' => array(
					array(
						'icon' => 'search',
						't' => 'Audit',
						'd' => 'Your delivery and operations workflows.',
					),
					array(
						'icon' => 'map',
						't' => 'Map',
						'd' => 'The highest-ROI automations.',
					),
					array(
						'icon' => 'blocks',
						't' => 'Build & integrate',
						'd' => 'Across your tool stack.',
					),
					array(
						'icon' => 'clipboard-check',
						't' => 'Test & train',
						'd' => 'Your team, end to end.',
					),
					array(
						'icon' => 'sliders-horizontal',
						't' => 'Optimize',
						'd' => 'As you scale clients and headcount.',
					),
				),
			),
			'why' => array(
				'title' => 'We write code when no-code runs out',
				'items' => array(
					array(
						'icon' => 'award',
						't' => 'Building automations since 2020',
						'd' => 'Automations and custom apps across industries.',
					),
					array(
						'icon' => 'git-merge',
						't' => 'Deep integration expertise',
						'd' => 'No-code, low-code, and custom RPA.',
					),
					array(
						'icon' => 'code-2',
						't' => 'We understand IT',
						'd' => 'We work in these workflows firsthand.',
					),
					array(
						'icon' => 'puzzle',
						't' => 'Quick wins first',
						'd' => 'Start small, then scale.',
					),
				),
			),
			'faqs' => array(
				array(
					'q' => 'How can automation help an IT company?',
					'a' => 'It removes repetitive coordination work, like onboarding, ticketing, project updates, and billing, so technical teams focus on delivery and the business scales without proportional admin overhead.',
				),
				array(
					'q' => 'Do you work with our existing IT tools?',
					'a' => 'Yes. We integrate with your CRM, helpdesk, project boards, and billing using Make.com, n8n, and Zapier.',
				),
				array(
					'q' => 'Can you automate client onboarding for our services?',
					'a' => 'Yes. We trigger account setup, document collection, and kickoff tasks automatically when a new client signs.',
				),
				array(
					'q' => 'Is custom development available if no-code is not enough?',
					'a' => 'Yes. We build custom integrations and applications when off-the-shelf automation falls short.',
				),
			),
			'cta' => array(
				'title' => 'Scale delivery without scaling admin',
				'sub' => 'Book a free 30-minute automation audit. We will review your IT operations, find the bottlenecks, and map the automations to fix them. No obligation.',
			),
			'meta' => array(
				'seo_title' => 'Automation for IT Companies | AMATEC — Onboarding, Tickets & Project Ops',
				'description' => 'AMATEC automates IT company operations: client onboarding, ticketing, project tracking, billing and internal workflows using Make.com, n8n & Zoho. Book a free audit.',
				'post_title' => 'Automation for IT Companies',
			),
		),
		'ecommerce' => array(
			'eyebrow' => 'Industries · eCommerce',
			'hero' => array(
				'lead' => 'Orders, stock and shipping',
				'accent' => 'in sync',
				'tail' => 'at any volume',
				'intro' => 'Ecommerce lives or dies on operations: orders, inventory, fulfilment, and customer communication. We connect your store, inventory, and back-office tools so orders flow smoothly and stock never falls out of sync.',
				'outcome' => 'Fewer errors, faster fulfilment, happier customers.',
				'card' => array(
					'icon' => 'shopping-cart',
					'label' => 'orders.flow',
					'items' => array(
						array(
							'icon' => 'package',
							'label' => 'New order',
							'sub' => 'Routed to fulfilment',
							'tag' => 'Processed',
							'c' => 'var(--blue-600)',
						),
						array(
							'icon' => 'boxes',
							'label' => 'Inventory',
							'sub' => 'Synced across channels',
							'tag' => 'In sync',
							'c' => '#0F9D58',
						),
						array(
							'icon' => 'truck',
							'label' => 'Shipping update',
							'sub' => 'Customer notified',
							'tag' => 'Sent',
							'c' => 'var(--orange-500)',
						),
					),
				),
			),
			'benefits' => array(
				'eyebrow' => 'WHY AUTOMATE',
				'title' => 'Why ecommerce brands automate',
				'sub' => 'Manual order handling and stock updates do not scale, and mistakes cost sales and reviews. Automation handles the operational load as you grow.',
				'items' => array(
					array(
						'icon' => 'package',
						't' => 'Order processing',
						'd' => 'Auto-route orders from store to fulfilment.',
					),
					array(
						'icon' => 'boxes',
						't' => 'Inventory sync',
						'd' => 'Keep stock accurate across channels in real time.',
					),
					array(
						'icon' => 'repeat',
						't' => 'Procurement',
						'd' => 'Trigger reordering before you run out.',
					),
					array(
						'icon' => 'bell',
						't' => 'Customer notifications',
						'd' => 'Automated order, shipping, and delivery updates.',
					),
					array(
						'icon' => 'undo-2',
						't' => 'Returns & support',
						'd' => 'Returns (RMA) and support workflows that run on their own.',
					),
					array(
						'icon' => 'bar-chart-3',
						't' => 'Reporting',
						'd' => 'Sales, inventory, and performance on autopilot.',
					),
				),
			),
			'automate' => array(
				'eyebrow' => 'WHAT WE AUTOMATE',
				'title' => 'What we automate for ecommerce',
				'sub' => 'We connect your storefront, payment, shipping, and accounting tools, and we have even built our own Stock Procurement app for Zoho Inventory.',
				'items' => array(
					'Order capture, routing & fulfilment triggers',
					'Multi-channel inventory synchronization',
					'Stock procurement & reorder workflows',
					'Shipping and delivery notifications',
					'Returns, refunds, and support routing',
					'Sales, inventory & performance reporting',
				),
			),
			'stack' => array(
				'text' => 'We automate using Zoho Inventory, Make.com, n8n and Zapier, connecting storefront, payment, shipping, and accounting. We have even built our own Stock Procurement app for Zoho Inventory.',
				'chips' => array(
					'Zoho Inventory',
					'Make.com',
					'n8n',
					'Zapier',
					'Shopify',
					'Razorpay',
				),
			),
			'delivery' => array(
				'items' => array(
					array(
						'icon' => 'search',
						't' => 'Audit',
						'd' => 'Your order-to-delivery workflow.',
					),
					array(
						'icon' => 'map',
						't' => 'Map',
						'd' => 'Automations that cut errors and speed fulfilment.',
					),
					array(
						'icon' => 'blocks',
						't' => 'Build & integrate',
						'd' => 'Store, inventory, and back office.',
					),
					array(
						'icon' => 'clipboard-check',
						't' => 'Test & train',
						'd' => 'Your team, end to end.',
					),
					array(
						'icon' => 'sliders-horizontal',
						't' => 'Optimize',
						'd' => 'As order volume grows.',
					),
				),
			),
			'why' => array(
				'title' => 'Operations automation that scales with volume',
				'items' => array(
					array(
						'icon' => 'package',
						't' => 'Purpose-built Zoho tools',
						'd' => 'Our own Stock Procurement app for Zoho Inventory.',
					),
					array(
						'icon' => 'trending-up',
						't' => 'Scales with orders',
						'd' => 'Operations automation built for growth.',
					),
					array(
						'icon' => 'git-merge',
						't' => 'Stack-wide integrations',
						'd' => 'Storefront, payments, shipping, accounting.',
					),
					array(
						'icon' => 'puzzle',
						't' => 'Step-by-step rollout',
						'd' => 'Start small, then scale.',
					),
				),
			),
			'faqs' => array(
				array(
					'q' => 'How does automation help an ecommerce business?',
					'a' => 'It automates order processing, inventory sync, procurement, and customer notifications: reducing errors, speeding fulfilment, and letting you scale without proportional manual work.',
				),
				array(
					'q' => 'Can you keep inventory in sync across channels?',
					'a' => 'Yes. We set up real-time inventory synchronization so stock stays accurate everywhere you sell.',
				),
				array(
					'q' => 'Do you work with Zoho Inventory?',
					'a' => 'Yes. We have deep Zoho Inventory expertise and have built our own Stock Procurement app for it.',
				),
				array(
					'q' => 'Can you automate reordering and procurement?',
					'a' => 'Yes. We trigger reorder and procurement workflows automatically based on stock levels.',
				),
			),
			'cta' => array(
				'title' => 'Run operations at any volume',
				'sub' => 'Book a free 30-minute automation audit. We will review your order and inventory workflows and map the automations to scale smoothly. No obligation.',
			),
			'meta' => array(
				'seo_title' => 'Automation for Ecommerce | AMATEC — Orders, Inventory & Customer Flows',
				'description' => 'AMATEC automates ecommerce operations: order processing, inventory sync, procurement, returns, and customer notifications using Zoho Inventory, Make.com & n8n. Book a free audit.',
				'post_title' => 'Automation for Ecommerce',
			),
		),
		'startups' => array(
			'eyebrow' => 'Industries · Startups',
			'hero' => array(
				'lead' => 'Do the work of a bigger team',
				'accent' => 'without hiring',
				'tail' => 'one',
				'intro' => 'For startups, automation is how a small team does the work of a big one, without burning runway on headcount. We build lean, affordable workflows so founders and early teams focus on product, customers, and growth.',
				'outcome' => 'More output per person. Faster experiments.',
				'card' => array(
					'icon' => 'rocket',
					'label' => 'startup.ops',
					'items' => array(
						array(
							'icon' => 'user-round-plus',
							'label' => 'New signup',
							'sub' => 'CRM + onboarding kicked off',
							'tag' => 'Onboarded',
							'c' => 'var(--blue-600)',
						),
						array(
							'icon' => 'send',
							'label' => 'Nurture email',
							'sub' => 'Sequence triggered',
							'tag' => 'Sent',
							'c' => '#0F9D58',
						),
						array(
							'icon' => 'line-chart',
							'label' => 'Founder report',
							'sub' => 'Dashboard refreshed',
							'tag' => 'Updated',
							'c' => 'var(--orange-500)',
						),
					),
				),
			),
			'benefits' => array(
				'eyebrow' => 'WHY AUTOMATE',
				'title' => 'Why startups automate early',
				'sub' => 'Every hour a founder spends on manual admin is an hour not spent growing the business. Automation buys back that time cheaply.',
				'items' => array(
					array(
						'icon' => 'users-round',
						't' => 'Do more with less',
						'd' => 'Handle volume without early hires.',
					),
					array(
						'icon' => 'timer',
						't' => 'Reclaim founder time',
						'd' => 'Automate the busywork that eats your day.',
					),
					array(
						'icon' => 'rocket',
						't' => 'Move fast',
						'd' => 'Launch and iterate on workflows in days, not months.',
					),
					array(
						'icon' => 'wallet',
						't' => 'Stay lean',
						'd' => 'Pay for outcomes, not headcount.',
					),
					array(
						'icon' => 'trending-up',
						't' => 'Build to scale',
						'd' => 'Set up systems that grow with you.',
					),
					array(
						'icon' => 'zap',
						't' => 'Quick ROI',
						'd' => 'Simple automations go live in days.',
					),
				),
			),
			'automate' => array(
				'eyebrow' => 'WHAT WE AUTOMATE',
				'title' => 'What we automate for startups',
				'sub' => 'We deliver in small, budget-friendly steps, the same way we have grown automation for clients since 2020, so you see ROI before committing more.',
				'items' => array(
					'Lead capture, CRM setup & sales follow-ups',
					'Customer and user onboarding flows',
					'Billing, invoicing & payment tracking',
					'Marketing and nurture sequences',
					'Internal ops, reporting & notifications',
					'Founder / investor reporting dashboards',
				),
			),
			'stack' => array(
				'text' => 'We automate using Make.com, Zapier, n8n and Zoho, connecting the lean toolset startups actually use. We deliver in small, budget-friendly steps so you see ROI before committing more.',
				'chips' => array(
					'Make.com',
					'Zapier',
					'n8n',
					'Zoho',
					'Airtable',
					'Slack',
				),
			),
			'delivery' => array(
				'items' => array(
					array(
						'icon' => 'search',
						't' => 'Audit',
						'd' => 'Your processes and biggest time sinks.',
					),
					array(
						'icon' => 'map',
						't' => 'Map',
						'd' => 'Quick-win automations with clear ROI.',
					),
					array(
						'icon' => 'blocks',
						't' => 'Build & integrate',
						'd' => 'Fast, on affordable platforms.',
					),
					array(
						'icon' => 'clipboard-check',
						't' => 'Test & hand over',
						'd' => 'With light training.',
					),
					array(
						'icon' => 'sliders-horizontal',
						't' => 'Scale',
						'd' => 'Automations as you grow.',
					),
				),
			),
			'why' => array(
				'title' => 'Startup-friendly, step by step',
				'items' => array(
					array(
						'icon' => 'puzzle',
						't' => 'Step-by-step engagements',
						'd' => 'Start small, prove ROI, expand.',
					),
					array(
						'icon' => 'award',
						't' => 'Building automations since 2020',
						'd' => 'Helping growing businesses scale lean.',
					),
					array(
						'icon' => 'git-compare',
						't' => 'Platform-agnostic',
						'd' => 'We pick what fits your budget.',
					),
					array(
						'icon' => 'zap',
						't' => 'Fast delivery',
						'd' => 'Real, measurable time savings.',
					),
				),
			),
			'faqs' => array(
				array(
					'q' => 'Why should a startup invest in automation early?',
					'a' => 'Because it lets a small team handle more without hiring: saving runway, reclaiming founder time, and building systems that scale as you grow.',
				),
				array(
					'q' => 'Is automation affordable for an early-stage startup?',
					'a' => 'Yes. We work in small, budget-aligned steps so you start with high-ROI quick wins and expand only as it pays off.',
				),
				array(
					'q' => 'Which tools do you use for startups?',
					'a' => 'Lean, cost-effective platforms like Make.com, Zapier, n8n, and Zoho, connected to the tools you already use.',
				),
				array(
					'q' => 'How fast can we see results?',
					'a' => 'Simple automations can go live in days, delivering time savings almost immediately.',
				),
			),
			'cta' => array(
				'title' => 'Scale lean, grow fast',
				'sub' => 'Book a free 30-minute automation audit. We will find the busywork draining your team and map affordable automations to fix it. No obligation.',
			),
			'meta' => array(
				'seo_title' => 'Automation for Startups | AMATEC — Scale Lean Without Hiring',
				'description' => 'AMATEC helps startups automate operations, sales, and onboarding so lean teams do more without hiring. Affordable, step-by-step automation with Make.com, n8n & Zoho. Book a free audit.',
				'post_title' => 'Automation for Startups',
			),
		),
		'healthcare' => array(
			'eyebrow' => 'Industries · Healthcare',
			'hero' => array(
				'lead' => 'Less admin,',
				'accent' => 'more time',
				'tail' => 'with patients',
				'intro' => 'Healthcare practices lose time to scheduling, intake, reminders, and back-office coordination. We build workflows that take routine admin off your practice so your team spends more time with patients and less on paperwork.',
				'outcome' => 'Fewer no-shows, faster intake, smoother operations.',
				'card' => array(
					'icon' => 'heart-pulse',
					'label' => 'practice.ops',
					'items' => array(
						array(
							'icon' => 'calendar-check',
							'label' => 'Appointment',
							'sub' => 'Booked + confirmed',
							'tag' => 'Scheduled',
							'c' => 'var(--blue-600)',
						),
						array(
							'icon' => 'clipboard-list',
							'label' => 'Patient intake',
							'sub' => 'Digital form → system',
							'tag' => 'Filed',
							'c' => '#0F9D58',
						),
						array(
							'icon' => 'bell-ring',
							'label' => 'Reminder',
							'sub' => 'Email + SMS sent',
							'tag' => 'Notified',
							'c' => 'var(--orange-500)',
						),
					),
				),
			),
			'benefits' => array(
				'eyebrow' => 'WHY AUTOMATE',
				'title' => 'Why healthcare practices automate',
				'sub' => 'Administrative load is one of the biggest drains on healthcare teams. Automating the routine, non-clinical workflows frees staff and improves the patient experience.',
				'items' => array(
					array(
						'icon' => 'calendar-check',
						't' => 'Appointment scheduling',
						'd' => 'Automated booking, confirmations, and reminders.',
					),
					array(
						'icon' => 'clipboard-list',
						't' => 'Patient intake',
						'd' => 'Digital forms that flow straight into your systems.',
					),
					array(
						'icon' => 'bell-ring',
						't' => 'No-show reduction',
						'd' => 'Timely reminders across email and SMS.',
					),
					array(
						'icon' => 'route',
						't' => 'Back-office coordination',
						'd' => 'Referrals, follow-ups, and task routing.',
					),
					array(
						'icon' => 'kanban',
						't' => 'Operations tracking',
						'd' => 'Organized boards and real-time status.',
					),
					array(
						'icon' => 'shield-check',
						't' => 'Privacy-conscious',
						'd' => 'Workflows designed with care for data handling.',
					),
				),
			),
			'automate' => array(
				'eyebrow' => 'WHAT WE AUTOMATE',
				'title' => 'What we automate for healthcare',
				'sub' => 'We connect scheduling, forms, communication, and operations tools, building workflows with care for data handling and your practice privacy requirements.',
				'items' => array(
					'Appointment booking, confirmations & reminders',
					'Patient intake and form collection',
					'Follow-up and recall sequences',
					'Internal task and referral routing',
					'Operations and project boards (Monday.com)',
					'Reporting and administrative workflows',
				),
			),
			'stack' => array(
				'text' => 'We automate using Monday.com, Make.com, n8n, Zapier and Zoho, connecting scheduling, forms, communication, and operations tools, with care for data handling and your privacy requirements.',
				'chips' => array(
					'Monday.com',
					'Make.com',
					'n8n',
					'Zapier',
					'Zoho',
					'Twilio SMS',
				),
			),
			'delivery' => array(
				'items' => array(
					array(
						'icon' => 'search',
						't' => 'Audit',
						'd' => 'Your administrative and operational workflows.',
					),
					array(
						'icon' => 'map',
						't' => 'Map',
						'd' => 'Automations that save the most staff time.',
					),
					array(
						'icon' => 'shield-check',
						't' => 'Build with care',
						'd' => 'Appropriate data-handling throughout.',
					),
					array(
						'icon' => 'clipboard-check',
						't' => 'Test & train',
						'd' => 'Your team, end to end.',
					),
					array(
						'icon' => 'sliders-horizontal',
						't' => 'Optimize',
						'd' => 'As your practice grows.',
					),
				),
			),
			'why' => array(
				'title' => 'Proven healthcare operations experience',
				'items' => array(
					array(
						'icon' => 'kanban',
						't' => 'Practice workflows',
						'd' => 'We optimized Monday.com boards for a healthcare practice.',
					),
					array(
						'icon' => 'shield-check',
						't' => 'Privacy-conscious',
						'd' => 'Careful, considered workflow design.',
					),
					array(
						'icon' => 'git-merge',
						't' => 'Stack-wide integrations',
						'd' => 'Scheduling, forms, and operations.',
					),
					array(
						'icon' => 'puzzle',
						't' => 'Fits a busy practice',
						'd' => 'Step-by-step rollout.',
					),
				),
			),
			'testimonial' => array(
				'photo'         => 'testimonial-rosy-zion.jpg',
				'alt'           => 'Rosy Zion, Practice Manager for Dr. Miami',
				'industry'      => 'Healthcare & medical practice',
				'platform'      => 'monday.com',
				'platform_icon' => 'calendar-check-2',
				'quote'         => array(
					array( 'b', 'Amatec has been an incredible asset' ),
					array( '', 'in helping us optimize and program our monday.com boards. Their expertise streamlined our workflow, making project management more efficient and organized. The team’s' ),
					array( 'o', 'dedication and problem-solving skills' ),
					array( '', 'have truly enhanced our operations. Highly recommend!' ),
				),
				'name'          => 'Rosy Zion',
				'role'          => 'Practice Manager for Dr. Miami',
			),
			'faqs' => array(
				array(
					'q' => 'How can automation help a healthcare practice?',
					'a' => 'It takes over non-clinical work, like scheduling, intake, reminders, and back-office coordination, reducing admin load, cutting no-shows, and improving the patient experience.',
				),
				array(
					'q' => 'Is patient data handled carefully?',
					'a' => 'Yes. We design workflows with care for data handling and integrate with the secure systems your practice already uses. We align the approach with your specific privacy requirements during the audit.',
				),
				array(
					'q' => 'Can you reduce patient no-shows?',
					'a' => 'Yes. automated, timely reminders across email and SMS are one of the most effective ways to reduce no-shows.',
				),
				array(
					'q' => 'Which tools do you use for healthcare operations?',
					'a' => 'We commonly use Monday.com, Zoho, Make.com, n8n, and Zapier, connected to your scheduling and communication tools.',
				),
			),
			'cta' => array(
				'title' => 'Spend more time on patients',
				'sub' => 'Book a free 30-minute automation audit. We will review your practice administrative workflows and map the automations to save your team time. No obligation.',
			),
			'meta' => array(
				'seo_title' => 'Automation for Healthcare | AMATEC — Scheduling, Intake & Practice Ops',
				'description' => 'AMATEC automates healthcare practice operations: appointment scheduling, patient intake, reminders, and back-office workflows using Monday.com, Make.com & Zoho. Book a free audit.',
				'post_title' => 'Automation for Healthcare',
			),
		),
		'real-estate' => array(
			'eyebrow' => 'Industries · Real Estate',
			'hero' => array(
				'lead' => 'Reply to every lead',
				'accent' => 'within seconds',
				'tail' => '',
				'intro' => 'In real estate, the agent who responds first usually wins the deal. We build workflows that capture leads from every portal, follow up instantly, schedule viewings, and handle paperwork, so you never lose a buyer to a slow reply.',
				'outcome' => 'Faster response, more viewings, less admin.',
				'card' => array(
					'icon' => 'building-2',
					'label' => 'leads.flow',
					'items' => array(
						array(
							'icon' => 'user-round-search',
							'label' => 'Portal lead',
							'sub' => 'Captured → CRM',
							'tag' => 'Logged',
							'c' => 'var(--blue-600)',
						),
						array(
							'icon' => 'message-square',
							'label' => 'Instant reply',
							'sub' => 'Auto text + email',
							'tag' => 'Sent',
							'c' => '#0F9D58',
						),
						array(
							'icon' => 'calendar-check',
							'label' => 'Viewing',
							'sub' => 'Booked + reminder set',
							'tag' => 'Scheduled',
							'c' => 'var(--orange-500)',
						),
					),
				),
			),
			'benefits' => array(
				'eyebrow' => 'WHY AUTOMATE',
				'title' => 'Why real estate teams automate',
				'sub' => 'Leads come from portals, ads, and referrals at all hours, and manual follow-up means missed deals. Automation keeps every lead warm.',
				'items' => array(
					array(
						'icon' => 'user-round-search',
						't' => 'Instant lead capture',
						'd' => 'From property portals, websites, and ads.',
					),
					array(
						'icon' => 'message-square',
						't' => 'Immediate follow-up',
						'd' => 'Auto-text and email new leads in seconds.',
					),
					array(
						'icon' => 'calendar-check',
						't' => 'Viewing scheduling',
						'd' => 'Automated booking and reminders.',
					),
					array(
						'icon' => 'repeat',
						't' => 'Nurture sequences',
						'd' => 'Stay top-of-mind until they are ready.',
					),
					array(
						'icon' => 'file-signature',
						't' => 'Document & contract flows',
						'd' => 'Generate and route paperwork automatically.',
					),
					array(
						'icon' => 'bell',
						't' => 'Deal alerts',
						'd' => 'Pipeline tracking and timely notifications.',
					),
				),
			),
			'automate' => array(
				'eyebrow' => 'WHAT WE AUTOMATE',
				'title' => 'What we automate for real estate',
				'sub' => 'We connect property portals, your website, email, SMS, and calendars into one speed-to-lead workflow. Already using a real estate CRM? We integrate with it.',
				'items' => array(
					'Lead capture & CRM entry from all sources',
					'Instant lead response & agent assignment',
					'Property-viewing scheduling & reminders',
					'Buyer / seller nurture campaigns',
					'Document generation & e-signature flows',
					'Deal pipeline tracking and alerts',
				),
			),
			'stack' => array(
				'text' => 'We automate using Zoho CRM, Make.com, n8n and Zapier, connecting property portals, your website, email, SMS, and calendars into one workflow. Already using a real estate CRM? We integrate with it.',
				'chips' => array(
					'Zoho CRM',
					'Make.com',
					'n8n',
					'Zapier',
					'Twilio SMS',
					'Calendars',
				),
			),
			'delivery' => array(
				'items' => array(
					array(
						'icon' => 'search',
						't' => 'Audit',
						'd' => 'Your lead-to-close process.',
					),
					array(
						'icon' => 'map',
						't' => 'Map',
						'd' => 'Automations that capture and convert more leads.',
					),
					array(
						'icon' => 'blocks',
						't' => 'Build & integrate',
						'd' => 'Portals, CRM, and comms.',
					),
					array(
						'icon' => 'clipboard-check',
						't' => 'Test & train',
						'd' => 'Your agents, end to end.',
					),
					array(
						'icon' => 'sliders-horizontal',
						't' => 'Optimize',
						'd' => 'Follow-up and scheduling over time.',
					),
				),
			),
			'why' => array(
				'title' => 'Speed-to-lead workflows that win deals',
				'items' => array(
					array(
						'icon' => 'layers',
						't' => 'Deep Zoho CRM expertise',
						'd' => 'And lead-automation know-how.',
					),
					array(
						'icon' => 'zap',
						't' => 'Speed-to-lead',
						'd' => 'Workflows that win more deals.',
					),
					array(
						'icon' => 'git-merge',
						't' => 'Stack-wide integrations',
						'd' => 'Portals, calendars, and documents.',
					),
					array(
						'icon' => 'puzzle',
						't' => 'Quick-win rollout',
						'd' => 'Then scale.',
					),
				),
			),
			'faqs' => array(
				array(
					'q' => 'How does automation help real estate agents?',
					'a' => 'It captures leads from every source and follows up instantly, booking viewings and nurturing prospects automatically, so agents respond faster and close more deals.',
				),
				array(
					'q' => 'Can you connect property portals to my CRM?',
					'a' => 'Yes. We capture leads from portals, websites, and ads and push them straight into your CRM with instant follow-up.',
				),
				array(
					'q' => 'Can automation schedule property viewings?',
					'a' => 'Yes. We set up automated booking and reminder workflows so viewings get scheduled without back-and-forth.',
				),
				array(
					'q' => 'Which CRM do you use for real estate?',
					'a' => 'We specialize in Zoho CRM and integrate with most real estate CRMs using Make.com, n8n, and Zapier.',
				),
			),
			'cta' => array(
				'title' => 'Be first to every lead',
				'sub' => 'Book a free 30-minute automation audit. We will review your lead flow and follow-up, then map the automations to help you win more deals. No obligation.',
			),
			'meta' => array(
				'seo_title' => 'Automation for Real Estate | AMATEC — Lead Follow-up, Scheduling & Deals',
				'description' => 'AMATEC automates real estate workflows: lead capture from portals, instant follow-up, viewing scheduling, and document flows using Zoho CRM, Make.com & n8n. Book a free audit.',
				'post_title' => 'Automation for Real Estate',
			),
		),
		'small-business' => array(
			'eyebrow' => 'Industries · Small Business',
			'hero' => array(
				'lead' => 'Get',
				'accent' => 'hours back',
				'tail' => 'every week',
				'intro' => 'For a small business, automation is like adding team members without the payroll. We build affordable, practical workflows that save you hours every week, delivered in small steps that fit your budget.',
				'outcome' => 'Less admin, fewer errors, more time for customers.',
				'card' => array(
					'icon' => 'store',
					'label' => 'business.ops',
					'items' => array(
						array(
							'icon' => 'user-round-plus',
							'label' => 'New customer',
							'sub' => 'Captured + onboarded',
							'tag' => 'Logged',
							'c' => 'var(--blue-600)',
						),
						array(
							'icon' => 'receipt',
							'label' => 'Invoice',
							'sub' => 'Generated + reminder set',
							'tag' => 'Sent',
							'c' => '#0F9D58',
						),
						array(
							'icon' => 'calendar-check',
							'label' => 'Appointment',
							'sub' => 'Booked + confirmed',
							'tag' => 'Scheduled',
							'c' => 'var(--orange-500)',
						),
					),
				),
			),
			'benefits' => array(
				'eyebrow' => 'WHY AUTOMATE',
				'title' => 'Why small businesses automate',
				'sub' => 'When you wear every hat, manual admin steals time from the work that actually grows your business. Automation gives that time back, affordably.',
				'items' => array(
					array(
						'icon' => 'timer',
						't' => 'Save hours weekly',
						'd' => 'Eliminate repetitive data entry and follow-ups.',
					),
					array(
						'icon' => 'sparkles',
						't' => 'Look bigger',
						'd' => 'Professional, consistent customer communication.',
					),
					array(
						'icon' => 'shield-check',
						't' => 'Reduce errors',
						'd' => 'No more missed invoices or forgotten follow-ups.',
					),
					array(
						'icon' => 'wallet',
						't' => 'Affordable',
						'd' => 'Pay for outcomes, scale step by step.',
					),
					array(
						'icon' => 'hand-helping',
						't' => 'No tech team needed',
						'd' => 'We build and maintain it for you.',
					),
					array(
						'icon' => 'trending-up',
						't' => 'Built to grow',
						'd' => 'Systems that scale as the business does.',
					),
				),
			),
			'automate' => array(
				'eyebrow' => 'WHAT WE AUTOMATE',
				'title' => 'What we automate for small business',
				'sub' => 'We connect the everyday tools small businesses rely on, and we have supported small businesses since 2020, even building custom apps as needs expand.',
				'items' => array(
					'Lead capture and customer follow-ups',
					'Invoicing, payment tracking & reminders',
					'Customer and client onboarding',
					'Appointment booking and reminders',
					'File, document, and data workflows',
					'Reports and team / owner notifications',
				),
			),
			'stack' => array(
				'text' => 'We automate using Make.com, Zapier, n8n and Zoho, connecting the everyday tools small businesses rely on. We have supported small businesses since 2020, even building a custom production-management app as needs expanded.',
				'chips' => array(
					'Make.com',
					'Zapier',
					'n8n',
					'Zoho',
					'Google Workspace',
					'QuickBooks',
				),
			),
			'delivery' => array(
				'items' => array(
					array(
						'icon' => 'search',
						't' => 'Audit',
						'd' => 'Your daily tasks and biggest time sinks.',
					),
					array(
						'icon' => 'map',
						't' => 'Map',
						'd' => 'Affordable, high-impact quick wins.',
					),
					array(
						'icon' => 'blocks',
						't' => 'Build & integrate',
						'd' => 'On cost-effective platforms.',
					),
					array(
						'icon' => 'clipboard-check',
						't' => 'Hand over',
						'd' => 'With simple training.',
					),
					array(
						'icon' => 'sliders-horizontal',
						't' => 'Scale',
						'd' => 'As the business grows.',
					),
				),
			),
			'why' => array(
				'title' => 'Budget-friendly automation that pays off',
				'items' => array(
					array(
						'icon' => 'award',
						't' => 'Building automations since 2020',
						'd' => 'Budget-friendly automation that works.',
					),
					array(
						'icon' => 'puzzle',
						't' => 'Step-by-step',
						'd' => 'Start small, prove ROI, expand.',
					),
					array(
						'icon' => 'hand-helping',
						't' => 'Fully managed',
						'd' => 'We build and maintain everything. No tech team required.',
					),
					array(
						'icon' => 'timer',
						't' => 'Real time savings',
						'd' => 'Measurable, every week.',
					),
				),
			),
			'quote' => array(
				'text' => 'Whether connecting our work tools, building file and calendar automations, or a custom production-management app, we work with Amatec small steps at a time, depending on our budget and needs.',
				'name' => 'Nicholas Baron',
				'role' => 'CEO, produitsducap.com · partner since 2020',
			),
			'faqs' => array(
				array(
					'q' => 'Is automation worth it for a small business?',
					'a' => 'Yes. even simple automations save hours each week, reduce errors, and let a small team deliver a bigger, more professional experience.',
				),
				array(
					'q' => 'Is it affordable?',
					'a' => 'Yes. We work in small, budget-aligned steps so you start with high-ROI quick wins and scale only as it pays off.',
				),
				array(
					'q' => 'Do I need technical skills?',
					'a' => 'No. we build, integrate, and maintain the workflows for you, with light training so your team can use them confidently.',
				),
				array(
					'q' => 'Where should a small business start with automation?',
					'a' => 'Usually with the most repetitive, time-consuming task. We identify the best starting point in your free audit.',
				),
			),
			'cta' => array(
				'title' => 'Get hours back every week',
				'sub' => 'Book a free 30-minute automation audit. We will find the busywork eating your time and map affordable automations to fix it. No obligation.',
			),
			'meta' => array(
				'seo_title' => 'Automation for Small Business | AMATEC — Affordable, Do-More-With-Less Workflows',
				'description' => 'AMATEC helps small businesses automate admin, sales, invoicing, and operations affordably using Make.com, Zapier, n8n & Zoho. Save hours every week. Book a free audit.',
				'post_title' => 'Automation for Small Business',
			),
		),
		'enterprise' => array(
			'eyebrow' => 'Industries · Enterprise',
			'hero' => array(
				'lead' => 'Make your CRM, ERP and finance systems',
				'accent' => 'work as one',
				'tail' => '',
				'intro' => 'Enterprises run on complex, interconnected systems, and the biggest gains come from automating the workflows that span them. We integrate your tools, automate cross-department processes, and apply custom RPA to legacy systems.',
				'outcome' => 'Fewer handoffs, connected systems, processes that scale.',
				'card' => array(
					'icon' => 'building',
					'label' => 'enterprise.ops',
					'items' => array(
						array(
							'icon' => 'cable',
							'label' => 'System sync',
							'sub' => 'CRM ↔ ERP ↔ finance',
							'tag' => 'Connected',
							'c' => 'var(--blue-600)',
						),
						array(
							'icon' => 'git-pull-request-arrow',
							'label' => 'Approval',
							'sub' => 'Routed cross-team',
							'tag' => 'Cleared',
							'c' => '#0F9D58',
						),
						array(
							'icon' => 'bot',
							'label' => 'Legacy task',
							'sub' => 'RPA · no API needed',
							'tag' => 'Automated',
							'c' => 'var(--orange-500)',
						),
					),
				),
			),
			'benefits' => array(
				'eyebrow' => 'WHY AUTOMATE',
				'title' => 'Why enterprises automate',
				'sub' => 'At scale, manual handoffs between departments and disconnected systems create delays, errors, and hidden costs. Automation connects the dots reliably.',
				'items' => array(
					array(
						'icon' => 'cable',
						't' => 'System integration',
						'd' => 'Make CRM, ERP, finance, and ops tools talk to each other.',
					),
					array(
						'icon' => 'git-pull-request-arrow',
						't' => 'Cross-department workflows',
						'd' => 'Automate processes that span teams.',
					),
					array(
						'icon' => 'bot',
						't' => 'Legacy automation (RPA)',
						'd' => 'Automate systems without modern APIs.',
					),
					array(
						'icon' => 'shield-check',
						't' => 'Governance & reliability',
						'd' => 'Documented, auditable, monitored workflows.',
					),
					array(
						'icon' => 'trending-up',
						't' => 'Scale',
						'd' => 'Handle high volume without adding headcount.',
					),
					array(
						'icon' => 'server-cog',
						't' => 'Self-hosted control',
						'd' => 'n8n self-hosted for security and data governance.',
					),
				),
			),
			'automate' => array(
				'eyebrow' => 'WHAT WE AUTOMATE',
				'title' => 'What we automate for enterprise',
				'sub' => 'We integrate with your existing enterprise systems, and when off-the-shelf tools cannot reach a system, we build custom integrations and applications.',
				'items' => array(
					'Multi-system integration (CRM, ERP, finance, HR)',
					'Cross-department approval & handoff workflows',
					'Custom RPA for legacy & back-office systems',
					'Data sync, migration & consolidation',
					'Automated reporting & compliance workflows',
					'High-volume operational processes',
				),
			),
			'stack' => array(
				'text' => 'We automate using n8n (self-hosted for control and security), Make.com, custom RPA and Zoho, integrating with your existing enterprise systems. When tools cannot reach a system, we build custom.',
				'chips' => array(
					'n8n (self-hosted)',
					'Make.com',
					'Custom RPA',
					'Zoho',
					'REST / API',
					'Webhooks',
				),
			),
			'delivery' => array(
				'items' => array(
					array(
						'icon' => 'search',
						't' => 'Audit',
						'd' => 'Systems, processes, and integration gaps.',
					),
					array(
						'icon' => 'pencil-ruler',
						't' => 'Architect',
						'd' => 'A reliable, governed automation design.',
					),
					array(
						'icon' => 'blocks',
						't' => 'Build & integrate',
						'd' => 'Across systems with proper testing.',
					),
					array(
						'icon' => 'file-check-2',
						't' => 'Document & hand over',
						'd' => 'With full transparency.',
					),
					array(
						'icon' => 'activity',
						't' => 'Monitor & optimize',
						'd' => 'At scale.',
					),
				),
			),
			'why' => array(
				'title' => 'Built for systems without clean APIs',
				'items' => array(
					array(
						'icon' => 'code-2',
						't' => 'Custom-development depth',
						'd' => 'Integration expertise beyond no-code.',
					),
					array(
						'icon' => 'server-cog',
						't' => 'Self-hosted options',
						'd' => 'n8n for control and data governance.',
					),
					array(
						'icon' => 'file-check-2',
						't' => 'Documented & auditable',
						'd' => 'Maintainable workflows.',
					),
					array(
						'icon' => 'shield-check',
						't' => 'De-risked rollout',
						'd' => 'Phased delivery for large programs.',
					),
				),
			),
			'faqs' => array(
				array(
					'q' => 'What does enterprise automation involve?',
					'a' => 'It involves integrating multiple business systems, automating processes that span departments, and applying RPA to legacy tools, so work flows reliably across a large organization.',
				),
				array(
					'q' => 'Can you integrate our legacy systems?',
					'a' => 'Yes. using custom RPA and integrations, we automate systems that lack modern APIs.',
				),
				array(
					'q' => 'Do you offer self-hosted automation for data control?',
					'a' => 'Yes. We use n8n self-hosted when control, security, or data governance is a priority.',
				),
				array(
					'q' => 'How do you handle reliability and governance?',
					'a' => 'We build documented, auditable, and monitored workflows, with phased delivery and proper testing to de-risk large rollouts.',
				),
			),
			'cta' => array(
				'title' => 'Connect your systems, scale your processes',
				'sub' => 'Book a free 30-minute automation audit. We will review your systems and cross-team workflows and map a reliable automation plan. No obligation.',
			),
			'meta' => array(
				'seo_title' => 'Enterprise Automation | AMATEC — System Integration, RPA & Cross-Team Workflows',
				'description' => 'AMATEC delivers enterprise automation: connecting legacy and modern systems, RPA, and cross-department workflows using n8n, Make.com & custom development. Book a free audit.',
				'post_title' => 'Enterprise Automation',
			),
		),
		'lead-sales-automation' => array(
			'eyebrow' => 'Solutions · Lead & Sales',
			'hero' => array(
				'lead' => 'Answer every lead',
				'accent' => 'while it is still warm',
				'tail' => '',
				'intro' => 'Lead and sales automation captures every lead, routes it to the right rep instantly, and triggers timely follow-ups, automatically. We build these revenue workflows across your CRM and marketing tools so no opportunity is missed.',
				'outcome' => 'More leads converted, with less manual chasing.',
				'card' => array(
					'icon' => 'trending-up',
					'label' => 'sales.flow',
					'items' => array(
						array(
							'icon' => 'user-round-plus',
							'label' => 'New lead',
							'sub' => 'Form · ad · chat',
							'tag' => 'Captured',
							'c' => 'var(--blue-600)',
						),
						array(
							'icon' => 'target',
							'label' => 'Scored 0.92',
							'sub' => 'Hot prospect',
							'tag' => 'Routed',
							'c' => '#0F9D58',
						),
						array(
							'icon' => 'send',
							'label' => 'Follow-up',
							'sub' => 'Sequence triggered',
							'tag' => 'Sent',
							'c' => 'var(--orange-500)',
						),
					),
				),
			),
			'benefits' => array(
				'eyebrow' => 'THE PROBLEM WE SOLVE',
				'title' => 'Speed-to-lead, automated',
				'sub' => 'Leads slip through the cracks every day: slow responses, unassigned inquiries, forgotten follow-ups. Speed-to-lead is one of the biggest drivers of conversion, yet most teams respond manually. Automation removes that gap.',
				'items' => array(
					array(
						'icon' => 'magnet',
						't' => 'Instant lead capture',
						'd' => 'From website forms, ads, email, chat, and landing pages.',
					),
					array(
						'icon' => 'target',
						't' => 'Automatic lead scoring',
						'd' => 'Prioritise the hottest prospects automatically.',
					),
					array(
						'icon' => 'split',
						't' => 'Smart routing',
						'd' => 'To the right rep by territory, product, or value.',
					),
					array(
						'icon' => 'send',
						't' => 'Sequenced follow-ups',
						'd' => 'Emails, reminders, and tasks that never get forgotten.',
					),
					array(
						'icon' => 'arrow-right-left',
						't' => 'Clean handoffs',
						'd' => 'From marketing to sales to onboarding.',
					),
					array(
						'icon' => 'bar-chart-3',
						't' => 'Pipeline you can trust',
						'd' => 'Live stage automation and deal alerts.',
					),
				),
			),
			'automate' => array(
				'eyebrow' => 'WHAT WE AUTOMATE',
				'title' => 'Sales workflows we automate',
				'sub' => 'We connect your CRM to email, calendars, payment tools, and marketing platforms. Already have a tech stack? We integrate with it rather than forcing a rebuild.',
				'items' => array(
					'Lead capture & enrichment into your CRM',
					'Lead scoring, qualification & instant assignment',
					'Automated follow-up & nurture sequences',
					'Quote, proposal & e-signature flows',
					'Pipeline stage automation & deal alerts',
					'Won-deal triggers that kick off onboarding',
				),
			),
			'stack' => array(
				'text' => 'We automate sales workflows using Zoho CRM, Make.com, Zapier and n8n, connecting your CRM to email, calendars, payment tools, and marketing platforms. Already have a stack? We integrate with it.',
				'chips' => array(
					'Zoho CRM',
					'Make.com',
					'Zapier',
					'n8n',
					'Email',
					'Calendars',
				),
			),
			'delivery' => array(
				'items' => array(
					array(
						'icon' => 'search',
						't' => 'Audit',
						'd' => 'Your lead-to-close process and where it leaks.',
					),
					array(
						'icon' => 'map',
						't' => 'Map',
						'd' => 'The highest-ROI automations.',
					),
					array(
						'icon' => 'blocks',
						't' => 'Build & integrate',
						'd' => 'Across your CRM and tools.',
					),
					array(
						'icon' => 'clipboard-check',
						't' => 'Test & train',
						'd' => 'Your sales team.',
					),
					array(
						'icon' => 'sliders-horizontal',
						't' => 'Optimize',
						'd' => 'Scoring and routing as you scale.',
					),
				),
			),
			'why' => array(
				'title' => 'Automation around how deals close',
				'items' => array(
					array(
						'icon' => 'award',
						't' => 'Building automations since 2020',
						'd' => 'Automating real sales operations.',
					),
					array(
						'icon' => 'layers',
						't' => 'Deep Zoho CRM expertise',
						'd' => 'Plus platform-agnostic integrations.',
					),
					array(
						'icon' => 'trending-up',
						't' => 'Deal-aware design',
						'd' => 'Workflows built around how deals close.',
					),
					array(
						'icon' => 'puzzle',
						't' => 'Quick wins first',
						'd' => 'Start small, then expand.',
					),
				),
			),
			'faqs' => array(
				array(
					'q' => 'What is lead and sales automation?',
					'a' => 'It is the use of software to automatically capture, qualify, route, and follow up on leads, and to move deals through your sales pipeline without manual data entry.',
				),
				array(
					'q' => 'Will it integrate with my existing CRM?',
					'a' => 'Yes. We specialize in Zoho CRM and integrate with most major CRMs using Make.com, Zapier, and n8n.',
				),
				array(
					'q' => 'How quickly can I respond to leads with automation?',
					'a' => 'Instantly. Automated routing and alerts can notify and assign the right rep the moment a lead arrives.',
				),
				array(
					'q' => 'Does this replace my sales team?',
					'a' => 'No. It removes the admin work so your team spends more time selling and less on data entry and follow-up tracking.',
				),
			),
			'cta' => array(
				'eyebrow' => 'BOOK A MEETING',
				'title' => 'Stop losing leads',
				'sub' => 'Book a free 30-minute sales audit. We will map your lead-to-close process, find where revenue leaks, and show you the automations to fix it. No obligation.',
			),
			'meta' => array(
				'seo_title' => 'Lead & Sales Automation | AMATEC — Capture, Route & Close Faster',
				'description' => 'Automate lead capture, scoring, routing and follow-ups with AMATEC. Stop losing leads and shorten your sales cycle using Zoho, Make.com, n8n & Zapier. Book a free audit.',
				'post_title' => 'Lead & Sales Automation',
			),
		),
		'marketing-automation' => array(
			'eyebrow' => 'Solutions · Marketing',
			'hero' => array(
				'lead' => 'Campaigns and follow-ups that',
				'accent' => 'send themselves',
				'tail' => '',
				'intro' => 'Marketing automation runs your campaigns, nurture sequences, and lead handoffs automatically, across email, social, ads, and your CRM. We build connected workflows so the right message reaches the right person at the right time.',
				'outcome' => 'More engaged leads, consistent nurturing, a clean pipeline.',
				'card' => array(
					'icon' => 'megaphone',
					'label' => 'marketing.flow',
					'items' => array(
						array(
							'icon' => 'mail',
							'label' => 'Nurture email',
							'sub' => 'Behavior-triggered',
							'tag' => 'Sent',
							'c' => 'var(--blue-600)',
						),
						array(
							'icon' => 'users-round',
							'label' => 'Segment',
							'sub' => 'Personalised at scale',
							'tag' => 'Targeted',
							'c' => '#0F9D58',
						),
						array(
							'icon' => 'arrow-right-left',
							'label' => 'CRM sync',
							'sub' => 'Lead handed to sales',
							'tag' => 'Synced',
							'c' => 'var(--orange-500)',
						),
					),
				),
			),
			'benefits' => array(
				'eyebrow' => 'THE PROBLEM WE SOLVE',
				'title' => 'Nurturing that never goes cold',
				'sub' => 'Marketing teams juggle disconnected tools: leads sit in spreadsheets, campaigns go out late, and follow-up is inconsistent. Automation connects the dots so no lead goes cold.',
				'items' => array(
					array(
						'icon' => 'workflow',
						't' => 'Automated nurture',
						'd' => 'Sequences triggered by behavior and lead stage.',
					),
					array(
						'icon' => 'radio',
						't' => 'Multi-channel campaigns',
						'd' => 'Across email, SMS, and social.',
					),
					array(
						'icon' => 'magnet',
						't' => 'Lead capture & sync',
						'd' => 'Straight into your CRM.',
					),
					array(
						'icon' => 'users-round',
						't' => 'Segmentation',
						'd' => 'Personalisation at scale.',
					),
					array(
						'icon' => 'bar-chart-3',
						't' => 'Closed-loop reporting',
						'd' => 'From campaign to closed deal.',
					),
					array(
						'icon' => 'calendar-clock',
						't' => 'Always on time',
						'd' => 'No more late or missed sends.',
					),
				),
			),
			'automate' => array(
				'eyebrow' => 'WHAT WE AUTOMATE',
				'title' => 'Marketing workflows we automate',
				'sub' => 'We connect your forms, email tools, ad platforms, and CRM into one workflow, working with your existing martech rather than replacing it.',
				'items' => array(
					'Email and drip nurture campaigns',
					'Lead capture, scoring & CRM sync',
					'Behavior-triggered follow-ups',
					'Social media scheduling & posting',
					'Webinar / event registration & reminders',
					'Campaign performance reporting',
				),
			),
			'stack' => array(
				'text' => 'We automate marketing using Zoho Marketing Automation, Make.com, n8n and Zapier, connecting your forms, email tools, ad platforms, and CRM into one workflow. We work with your existing martech rather than replacing it.',
				'chips' => array(
					'Zoho Marketing',
					'Make.com',
					'n8n',
					'Zapier',
					'Mailchimp',
					'Meta Ads',
				),
			),
			'delivery' => array(
				'items' => array(
					array(
						'icon' => 'search',
						't' => 'Audit',
						'd' => 'Your marketing funnel and tools.',
					),
					array(
						'icon' => 'map',
						't' => 'Map',
						'd' => 'Automations that improve engagement and conversion.',
					),
					array(
						'icon' => 'blocks',
						't' => 'Build & integrate',
						'd' => 'Across channels and CRM.',
					),
					array(
						'icon' => 'clipboard-check',
						't' => 'Test & train',
						'd' => 'Your marketing team.',
					),
					array(
						'icon' => 'sliders-horizontal',
						't' => 'Optimize',
						'd' => 'Segments and sequences with performance data.',
					),
				),
			),
			'why' => array(
				'title' => 'Automation tied to revenue',
				'items' => array(
					array(
						'icon' => 'layers',
						't' => 'Zoho & martech expertise',
						'd' => 'Across the marketing stack.',
					),
					array(
						'icon' => 'trending-up',
						't' => 'Revenue, not vanity',
						'd' => 'Automation tied to outcomes.',
					),
					array(
						'icon' => 'arrow-right-left',
						't' => 'Connected funnel',
						'd' => 'First touch to closed deal.',
					),
					array(
						'icon' => 'puzzle',
						't' => 'Start small',
						'd' => 'Scale with results.',
					),
				),
			),
			'faqs' => array(
				array(
					'q' => 'What is marketing automation?',
					'a' => 'It is using software to automatically run marketing tasks, like sending campaigns, nurturing leads, segmenting audiences, and syncing data to your CRM, based on triggers and rules rather than manual effort.',
				),
				array(
					'q' => 'Which marketing tools do you integrate?',
					'a' => 'We work with Zoho Marketing Automation and connect email, social, ad, and form tools to your CRM using Make.com, n8n, and Zapier.',
				),
				array(
					'q' => 'Can you connect marketing to my sales pipeline?',
					'a' => 'Yes. We build closed-loop workflows so marketing leads flow cleanly into sales and you can track campaigns through to closed deals.',
				),
				array(
					'q' => 'Do I need a big team to run marketing automation?',
					'a' => 'No. That is the point. Automation lets a small team run consistent, multi-channel marketing without manual sending.',
				),
			),
			'cta' => array(
				'eyebrow' => 'BOOK A MEETING',
				'title' => 'Put your marketing on autopilot',
				'sub' => 'Book a free 30-minute marketing audit. We will review your funnel and tools, find the gaps, and map the automations to grow engagement and conversions. No obligation.',
			),
			'meta' => array(
				'seo_title' => 'Marketing Automation | AMATEC — Campaigns, Nurture & Lead Flow on Autopilot',
				'description' => 'Automate email campaigns, lead nurturing, and multi-channel marketing with AMATEC using Make.com, n8n, Zapier & Zoho Marketing. Turn leads into customers. Book a free audit.',
				'post_title' => 'Marketing Automation',
			),
		),
		'finance-accounting-automation' => array(
			'eyebrow' => 'Solutions · Finance & Accounting',
			'hero' => array(
				'lead' => 'Invoices, payments and reconciliation',
				'accent' => 'without re-keying',
				'tail' => '',
				'intro' => 'Finance and accounting automation removes manual bookkeeping work: generating invoices, recording payments, reconciling transactions, and building reports automatically. We connect your accounting platform, with deep Zoho Books expertise, to the rest of your business.',
				'outcome' => 'Faster closes, fewer errors, real-time visibility.',
				'card' => array(
					'icon' => 'receipt',
					'label' => 'finance.flow',
					'items' => array(
						array(
							'icon' => 'file-text',
							'label' => 'Invoice',
							'sub' => 'Generated on deal close',
							'tag' => 'Sent',
							'c' => 'var(--blue-600)',
						),
						array(
							'icon' => 'banknote',
							'label' => 'Payment',
							'sub' => 'Recorded automatically',
							'tag' => 'Logged',
							'c' => '#0F9D58',
						),
						array(
							'icon' => 'scale',
							'label' => 'Reconciliation',
							'sub' => 'Matched to records',
							'tag' => 'Balanced',
							'c' => 'var(--orange-500)',
						),
					),
				),
			),
			'benefits' => array(
				'eyebrow' => 'THE PROBLEM WE SOLVE',
				'title' => 'Bookkeeping without the data entry',
				'sub' => 'Finance teams lose hours re-keying data between systems, chasing approvals, and reconciling line by line, and every manual step is a chance for error. Automation handles the repetitive work so your team focuses on analysis.',
				'items' => array(
					array(
						'icon' => 'file-text',
						't' => 'Automated invoicing',
						'd' => 'Generate and send invoices the moment a deal closes.',
					),
					array(
						'icon' => 'bell',
						't' => 'Payment tracking & reminders',
						'd' => 'Auto-record payments and chase overdue accounts.',
					),
					array(
						'icon' => 'scale',
						't' => 'Bank reconciliation',
						'd' => 'Match transactions automatically against records.',
					),
					array(
						'icon' => 'check-check',
						't' => 'Expense & bill workflows',
						'd' => 'Capture, categorize, and route for approval.',
					),
					array(
						'icon' => 'bar-chart-3',
						't' => 'Live reporting',
						'd' => 'Dashboards and P&L without manual spreadsheets.',
					),
					array(
						'icon' => 'shield-check',
						't' => 'Accuracy-first',
						'd' => 'Validation and audit trails on every flow.',
					),
				),
			),
			'automate' => array(
				'eyebrow' => 'WHAT WE AUTOMATE',
				'title' => 'Finance workflows we automate',
				'sub' => 'We connect accounting to your CRM, sales, and operations tools, and we have built our own Zoho applications, so we know Zoho inside out.',
				'items' => array(
					'Quote-to-invoice & recurring billing',
					'Customer & vendor payment recording',
					'Bank transaction categorization & reconciliation',
					'Expense capture & approval routing',
					'Payment reminders & dunning sequences',
					'Financial report generation & distribution',
				),
			),
			'stack' => array(
				'text' => 'We automate finance operations using Zoho Books, Make.com, n8n and payment platforms like Razorpay and PayPal, connecting accounting to your CRM, sales, and operations tools. We have even built our own Zoho applications.',
				'chips' => array(
					'Zoho Books',
					'Make.com',
					'n8n',
					'Razorpay',
					'PayPal',
					'Stripe',
				),
			),
			'delivery' => array(
				'items' => array(
					array(
						'icon' => 'search',
						't' => 'Audit',
						'd' => 'Your finance processes and data flows.',
					),
					array(
						'icon' => 'map',
						't' => 'Map',
						'd' => 'Workflows that save time and reduce risk.',
					),
					array(
						'icon' => 'blocks',
						't' => 'Build & integrate',
						'd' => 'Accounting, payments, and operations.',
					),
					array(
						'icon' => 'clipboard-check',
						't' => 'Test & validate',
						'd' => 'Every flow for accuracy.',
					),
					array(
						'icon' => 'sliders-horizontal',
						't' => 'Optimize',
						'd' => 'As transaction volume grows.',
					),
				),
			),
			'why' => array(
				'title' => 'Accuracy-first finance automation',
				'items' => array(
					array(
						'icon' => 'layers',
						't' => 'Specialist Zoho Books',
						'd' => 'Deep expertise across Zoho apps.',
					),
					array(
						'icon' => 'shield-check',
						't' => 'Accuracy-first',
						'd' => 'Proper validation and audit trails.',
					),
					array(
						'icon' => 'git-merge',
						't' => 'Stack-wide integrations',
						'd' => 'Payments, CRM, and operations.',
					),
					array(
						'icon' => 'puzzle',
						't' => 'Protects your books',
						'd' => 'Step-by-step rollout.',
					),
				),
			),
			'faqs' => array(
				array(
					'q' => 'What is finance and accounting automation?',
					'a' => 'It is using software to automatically handle bookkeeping tasks, like invoicing, payment recording, reconciliation, and reporting, so financial data flows between systems without manual entry.',
				),
				array(
					'q' => 'Which accounting software do you work with?',
					'a' => 'We have deep expertise in Zoho Books and integrate with payment platforms such as Razorpay and PayPal, plus your CRM and operations tools.',
				),
				array(
					'q' => 'Is automated bookkeeping accurate and safe?',
					'a' => 'Yes. We build validation, matching rules, and audit trails into every workflow so your records stay reliable.',
				),
				array(
					'q' => 'Can you automate bank reconciliation?',
					'a' => 'Yes. We set up rules to automatically categorize and match bank transactions against your records, drastically reducing manual reconciliation.',
				),
			),
			'cta' => array(
				'eyebrow' => 'BOOK A MEETING',
				'title' => 'Close your books faster',
				'sub' => 'Book a free 30-minute finance audit. We will review your accounting workflows, find the manual bottlenecks, and map the automations to fix them. No obligation.',
			),
			'meta' => array(
				'seo_title' => 'Finance & Accounting Automation | AMATEC — Invoicing, Reconciliation & Reporting',
				'description' => 'Automate invoicing, payments, reconciliation and financial reporting with AMATEC. Cut manual data entry and errors using Zoho Books, Make.com & n8n. Book a free audit.',
				'post_title' => 'Finance & Accounting Automation',
			),
		),
		'hr-operations-automation' => array(
			'eyebrow' => 'Solutions · HR & Operations',
			'hero' => array(
				'lead' => 'Onboarding, approvals and paperwork',
				'accent' => 'on autopilot',
				'tail' => '',
				'intro' => 'HR and operations automation handles the repetitive back-office work, like onboarding, approvals, document flows, and daily task coordination, automatically. We connect your HR, project, and operations tools so processes run consistently.',
				'outcome' => 'Smoother ops, faster onboarding, nothing falling through.',
				'card' => array(
					'icon' => 'users-round',
					'label' => 'ops.flow',
					'items' => array(
						array(
							'icon' => 'user-round-plus',
							'label' => 'New hire',
							'sub' => 'Accounts + docs + tasks',
							'tag' => 'Onboarded',
							'c' => 'var(--blue-600)',
						),
						array(
							'icon' => 'check-check',
							'label' => 'Leave request',
							'sub' => 'Routed for approval',
							'tag' => 'Approved',
							'c' => '#0F9D58',
						),
						array(
							'icon' => 'kanban',
							'label' => 'Task assigned',
							'sub' => 'Board updated',
							'tag' => 'Tracked',
							'c' => 'var(--orange-500)',
						),
					),
				),
			),
			'benefits' => array(
				'eyebrow' => 'THE PROBLEM WE SOLVE',
				'title' => 'Back-office work that runs itself',
				'sub' => 'HR and ops are full of repeatable, multi-step processes that eat hours and depend on people remembering to act. Automation makes them reliable and hands-off.',
				'items' => array(
					array(
						'icon' => 'user-round-plus',
						't' => 'Employee onboarding',
						'd' => 'Trigger accounts, documents, and tasks the moment someone is hired.',
					),
					array(
						'icon' => 'check-check',
						't' => 'Approval workflows',
						'd' => 'Route leave, expenses, and purchase requests automatically.',
					),
					array(
						'icon' => 'file-signature',
						't' => 'Document & file automation',
						'd' => 'Generate, file, and share paperwork without manual steps.',
					),
					array(
						'icon' => 'kanban',
						't' => 'Task & project coordination',
						'd' => 'Auto-assign and track work across teams.',
					),
					array(
						'icon' => 'calendar-clock',
						't' => 'Scheduled operations',
						'd' => 'Recurring reports, reminders, and data syncs.',
					),
					array(
						'icon' => 'bell',
						't' => 'Operational alerts',
						'd' => 'The right people notified at the right time.',
					),
				),
			),
			'automate' => array(
				'eyebrow' => 'WHAT WE AUTOMATE',
				'title' => 'HR & ops workflows we automate',
				'sub' => 'We connect HR tools, project boards, document storage, and communication channels like Slack, and have built custom production and operations apps for clients.',
				'items' => array(
					'Employee & client onboarding / offboarding',
					'Leave, expense & purchase approvals',
					'Document generation & e-signature flows',
					'Task assignment & project status updates',
					'Calendar, file & data automations',
					'Recurring reports & operational alerts',
				),
			),
			'stack' => array(
				'text' => 'We automate HR and operations using Monday.com, Make.com, n8n, Zapier and Zoho, connecting HR tools, project boards, document storage, and channels like Slack. We have built custom operations apps across industries.',
				'chips' => array(
					'Monday.com',
					'Make.com',
					'n8n',
					'Zapier',
					'Zoho',
					'Slack',
				),
			),
			'delivery' => array(
				'items' => array(
					array(
						'icon' => 'search',
						't' => 'Audit',
						'd' => 'Your HR and operational processes.',
					),
					array(
						'icon' => 'map',
						't' => 'Map',
						'd' => 'The highest-impact workflows to automate.',
					),
					array(
						'icon' => 'blocks',
						't' => 'Build & integrate',
						'd' => 'Across your tools and boards.',
					),
					array(
						'icon' => 'clipboard-check',
						't' => 'Test & train',
						'd' => 'Your team, end to end.',
					),
					array(
						'icon' => 'sliders-horizontal',
						't' => 'Optimize',
						'd' => 'As headcount and operations grow.',
					),
				),
			),
			'why' => array(
				'title' => 'Reliable workflows your team can trust',
				'items' => array(
					array(
						'icon' => 'award',
						't' => 'Proven onboarding ops',
						'd' => 'Real operations automation experience.',
					),
					array(
						'icon' => 'layers',
						't' => 'Monday.com & Zoho',
						'd' => 'Plus custom app development.',
					),
					array(
						'icon' => 'file-check-2',
						't' => 'Documented & reliable',
						'd' => 'Workflows your team can trust.',
					),
					array(
						'icon' => 'puzzle',
						't' => 'Right-sized',
						'd' => 'Start small, scale up.',
					),
				),
			),
			'faqs' => array(
				array(
					'q' => 'What is HR and operations automation?',
					'a' => 'It is using software to automatically run repetitive back-office processes, like onboarding, approvals, document handling, and task coordination, so they happen consistently without manual effort.',
				),
				array(
					'q' => 'Can you automate employee onboarding?',
					'a' => 'Yes. We trigger account setup, document collection, task assignment, and notifications automatically the moment a new hire is added.',
				),
				array(
					'q' => 'Which tools do you use for operations automation?',
					'a' => 'We commonly use Monday.com, Zoho, Make.com, n8n, and Zapier, and connect them to your document storage and communication tools.',
				),
				array(
					'q' => 'Can you build a custom operations app if needed?',
					'a' => 'Yes. when off-the-shelf tools are not enough, we build custom applications, as we have done for clients’ production-management needs.',
				),
			),
			'cta' => array(
				'eyebrow' => 'BOOK A MEETING',
				'title' => 'Run operations on autopilot',
				'sub' => 'Book a free 30-minute operations audit. We will review your HR and ops processes, find the repetitive bottlenecks, and map the automations to fix them. No obligation.',
			),
			'meta' => array(
				'seo_title' => 'HR & Operations Automation | AMATEC — Onboarding, Approvals & Daily Ops',
				'description' => 'Automate employee onboarding, approvals, and daily operations with AMATEC using Make.com, n8n, Monday.com & Zoho. Cut admin work and run smoother. Book a free audit.',
				'post_title' => 'HR & Operations Automation',
			),
		),
		'customer-support-automation' => array(
			'eyebrow' => 'Solutions · Customer Support',
			'hero' => array(
				'lead' => 'Route every ticket',
				'accent' => 'to the right person',
				'tail' => 'the moment it arrives',
				'intro' => 'Customer support automation routes tickets, triggers responses, and escalates issues automatically, so customers get faster answers and your team handles more with less effort. We connect your helpdesk, email, chat, and CRM into one workflow.',
				'outcome' => 'Faster resolution, happier customers, no extra headcount.',
				'card' => array(
					'icon' => 'headset',
					'label' => 'support.flow',
					'items' => array(
						array(
							'icon' => 'ticket',
							'label' => 'New ticket',
							'sub' => 'Email · chat · form',
							'tag' => 'Captured',
							'c' => 'var(--blue-600)',
						),
						array(
							'icon' => 'split',
							'label' => 'Routed',
							'sub' => 'By topic + priority',
							'tag' => 'Assigned',
							'c' => '#0F9D58',
						),
						array(
							'icon' => 'message-square',
							'label' => 'First reply',
							'sub' => 'Templated · instant',
							'tag' => 'Sent',
							'c' => 'var(--orange-500)',
						),
					),
				),
			),
			'benefits' => array(
				'eyebrow' => 'THE PROBLEM WE SOLVE',
				'title' => 'Routine handled, humans freed',
				'sub' => 'Support teams drown in repetitive tickets, manual routing, and copy-paste replies, while customers wait. Automation handles the routine so your agents focus on the conversations that need a human.',
				'items' => array(
					array(
						'icon' => 'ticket',
						't' => 'Auto-capture tickets',
						'd' => 'From email, chat, forms, and social.',
					),
					array(
						'icon' => 'split',
						't' => 'Smart routing',
						'd' => 'By topic, priority, or customer tier.',
					),
					array(
						'icon' => 'message-square',
						't' => 'Instant acknowledgements',
						'd' => 'And templated first responses.',
					),
					array(
						'icon' => 'alarm-clock',
						't' => 'Auto-escalation',
						'd' => 'When SLAs are at risk.',
					),
					array(
						'icon' => 'arrow-right-left',
						't' => 'CRM sync',
						'd' => 'So support sees the full customer context.',
					),
					array(
						'icon' => 'smile',
						't' => 'CSAT follow-up',
						'd' => 'Satisfaction surveys triggered automatically.',
					),
				),
			),
			'automate' => array(
				'eyebrow' => 'WHAT WE AUTOMATE',
				'title' => 'Support workflows we automate',
				'sub' => 'We connect your helpdesk to CRM, chat, and notification channels like Slack. Whatever tools you use, we link them into one workflow.',
				'items' => array(
					'Ticket creation, tagging & routing',
					'Auto-responses & canned-reply triggers',
					'SLA monitoring & escalation alerts',
					'Follow-up & satisfaction (CSAT) surveys',
					'Knowledge-base deflection & FAQ routing',
					'Support-to-sales & support-to-ops handoffs',
				),
			),
			'stack' => array(
				'text' => 'We automate support using Zoho Desk, Make.com, n8n and Zapier, connecting your helpdesk to CRM, chat, and notification channels like Slack. Whatever tools you use, we link them into one workflow.',
				'chips' => array(
					'Zoho Desk',
					'Make.com',
					'n8n',
					'Zapier',
					'Slack',
					'Live chat',
				),
			),
			'delivery' => array(
				'items' => array(
					array(
						'icon' => 'search',
						't' => 'Audit',
						'd' => 'Your support process and ticket flow.',
					),
					array(
						'icon' => 'map',
						't' => 'Map',
						'd' => 'Automations that cut response and resolution time.',
					),
					array(
						'icon' => 'blocks',
						't' => 'Build & integrate',
						'd' => 'Helpdesk, CRM, and channels.',
					),
					array(
						'icon' => 'clipboard-check',
						't' => 'Test & train',
						'd' => 'Your support team.',
					),
					array(
						'icon' => 'sliders-horizontal',
						't' => 'Optimize',
						'd' => 'Routing and SLAs as volume grows.',
					),
				),
			),
			'why' => array(
				'title' => 'Automation that protects the experience',
				'items' => array(
					array(
						'icon' => 'layers',
						't' => 'Zoho Desk expertise',
						'd' => 'Deep knowledge of Zoho apps.',
					),
					array(
						'icon' => 'heart-handshake',
						't' => 'Humans keep the hard cases',
						'd' => 'Automation takes the routine tickets so agents handle the ones that need judgment.',
					),
					array(
						'icon' => 'git-merge',
						't' => 'Stack-wide integrations',
						'd' => 'Chat, CRM, and team notifications.',
					),
					array(
						'icon' => 'puzzle',
						't' => 'Quick-win rollout',
						'd' => 'Then scale.',
					),
				),
			),
			'faqs' => array(
				array(
					'q' => 'What is customer support automation?',
					'a' => 'It is using software to automatically handle support tasks, like capturing tickets, routing them, sending responses, and escalating issues, so customers get faster help and agents focus on complex cases.',
				),
				array(
					'q' => 'Will automation make support feel robotic?',
					'a' => 'No. Done well, it speeds up routine handling and frees agents for the human conversations that matter. Agents still handle anything that needs judgment.',
				),
				array(
					'q' => 'Which helpdesk tools do you support?',
					'a' => 'We specialize in Zoho Desk and integrate with email, chat, CRM, and notification tools using Make.com, n8n, and Zapier.',
				),
				array(
					'q' => 'Can automation reduce my response times?',
					'a' => 'Yes. instant ticket routing, acknowledgements, and templated responses dramatically cut first-response and resolution times.',
				),
			),
			'cta' => array(
				'eyebrow' => 'BOOK A MEETING',
				'title' => 'Resolve faster, scale smarter',
				'sub' => 'Book a free 30-minute support audit. We will review your ticket flow, find the bottlenecks, and map the automations to speed up resolution. No obligation.',
			),
			'meta' => array(
				'seo_title' => 'Customer Support Automation | AMATEC — Tickets, Routing & Faster Replies',
				'description' => 'Automate ticket routing, responses and escalations with AMATEC. Resolve customer queries faster across Zoho Desk, email and chat using Make.com & n8n. Book a free audit.',
				'post_title' => 'Customer Support Automation',
			),
		),
	);
}
