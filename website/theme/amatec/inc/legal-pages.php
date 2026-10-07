<?php
/**
 * Legal page content (terms, privacy, refund, cancellation) — generated from
 * the AMATEC design-system bundle. Rendered by template-parts/legal/page.php.
 * Section keys: n, id, title, and any of: intro (p), body (p[]), list
 * (orange-dot bullets), email (mailto card).
 *
 * @package AMATEC
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function amatec_legal_pages() {
	return array(
		'termsandconditions' => array(
			'title' => 'Terms & Conditions',
			'effective' => 'Effective 15 May 2023',
			'read' => '~1 min read',
			'lead' => 'By accessing or using our website and services, you agree to comply with and be bound by the following Terms and Conditions. Please read them carefully before continuing.',
			'intro' => 'Welcome to Amatec. These terms govern your access to and use of our website, products, and automation services.',
			'cta_title' => 'Questions about these terms?',
			'cta_sub' => 'Reach our team and we’ll walk you through anything.',
			'sections' => array(
				array(
					'n' => '01',
					'id' => 'service',
					'title' => 'Service Description',
					'body' => array(
						'Amatec is an automation studio building custom low-code and no-code workflows, applications, and integrations for business operations.',
						'All services are delivered digitally and are subject to availability and platform limitations.',
					),
				),
				array(
					'n' => '02',
					'id' => 'eligibility',
					'title' => 'Eligibility',
					'body' => array(
						'You must be at least 18 years old and legally capable of entering into binding contracts to use our services.',
					),
				),
				array(
					'n' => '03',
					'id' => 'account',
					'title' => 'Account Responsibility',
					'body' => array(
						'Users are responsible for maintaining the confidentiality of their account credentials and all activities conducted under their account.',
					),
				),
				array(
					'n' => '04',
					'id' => 'payments',
					'title' => 'Payments',
					'body' => array(
						'All payments for subscriptions or services are processed online via secure payment gateways. Prices are displayed on the website and are subject to change with prior notice.',
					),
				),
				array(
					'n' => '05',
					'id' => 'ip',
					'title' => 'Intellectual Property',
					'body' => array(
						'All content, software, and trademarks on Amatec are the exclusive property of Amatec and may not be copied or redistributed without permission.',
					),
				),
				array(
					'n' => '06',
					'id' => 'liability',
					'title' => 'Limitation of Liability',
					'body' => array(
						'Amatec shall not be liable for any indirect, incidental, or consequential damages arising from the use of our services.',
					),
				),
				array(
					'n' => '07',
					'id' => 'termination',
					'title' => 'Termination',
					'body' => array(
						'We reserve the right to suspend or terminate access if users violate these terms.',
					),
				),
				array(
					'n' => '08',
					'id' => 'law',
					'title' => 'Governing Law',
					'body' => array(
						'These terms shall be governed by and interpreted in accordance with the laws of India.',
					),
				),
			),
		),
		'privacypolicy' => array(
			'title' => 'Privacy Policy',
			'effective' => 'Effective 15 May 2023',
			'read' => '~1 min read',
			'lead' => 'Amatec respects your privacy and is committed to protecting your personal information. This policy explains what we collect, how we use it, and the choices you have.',
			'intro' => 'At Amatec, protecting the data you trust us with is fundamental to how we build and operate our automation services.',
			'cta_title' => 'Questions about your data?',
			'cta_sub' => 'Reach our team and we’ll walk you through anything.',
			'sections' => array(
				array(
					'n' => '01',
					'id' => 'collect',
					'title' => 'Information We Collect',
					'list' => array(
						'Name, email address, and phone number',
						'Company and recruitment-related data',
						'Payment-related details (processed securely via third-party gateways)',
					),
				),
				array(
					'n' => '02',
					'id' => 'use',
					'title' => 'Use of Information',
					'intro' => 'We use collected data to:',
					'list' => array(
						'Provide and improve our services',
						'Process payments',
						'Communicate updates and support messages',
					),
				),
				array(
					'n' => '03',
					'id' => 'security',
					'title' => 'Data Security',
					'body' => array(
						'We implement industry-standard security measures to protect your information.',
					),
				),
				array(
					'n' => '04',
					'id' => 'sharing',
					'title' => 'Third-Party Sharing',
					'body' => array(
						'We do not sell or rent your personal data. Information is shared only with trusted service providers for operational purposes.',
					),
				),
				array(
					'n' => '05',
					'id' => 'cookies',
					'title' => 'Cookies',
					'body' => array(
						'We may use cookies to improve user experience and analyze website performance.',
					),
				),
				array(
					'n' => '06',
					'id' => 'rights',
					'title' => 'User Rights',
					'body' => array(
						'You may request access, correction, or deletion of your personal data by contacting us.',
					),
				),
			),
		),
		'refundpolicy' => array(
			'title' => 'Refund Policy',
			'effective' => 'Effective 15 May 2023',
			'read' => '~1 min read',
			'lead' => 'Amatec offers digital services and subscription-based products. This policy explains when refunds apply, which cases are non-refundable, and how approved refunds are processed.',
			'intro' => 'Amatec offers digital services and subscription-based products. Please review the terms below before requesting a refund.',
			'cta_title' => 'Need to request a refund?',
			'cta_sub' => 'Get in touch within 7 days of purchase and we’ll review it.',
			'sections' => array(
				array(
					'n' => '01',
					'id' => 'eligibility',
					'title' => 'Refund Eligibility',
					'list' => array(
						'Refunds are applicable only if requested within 7 days of purchase',
						'The service must not be substantially used',
					),
				),
				array(
					'n' => '02',
					'id' => 'non-refundable',
					'title' => 'Non-Refundable Cases',
					'list' => array(
						'Partial usage of subscription',
						'Custom setup or configuration services',
						'Promotional or discounted plans',
					),
				),
				array(
					'n' => '03',
					'id' => 'process',
					'title' => 'Refund Process',
					'body' => array(
						'Approved refunds will be credited to the original payment method within 7–10 business days.',
					),
				),
			),
		),
		'cancellationpolicy' => array(
			'title' => 'Cancellation Policy',
			'effective' => 'Effective 15 May 2023',
			'read' => '~1 min read',
			'lead' => 'Users may cancel their subscription at any time from their account dashboard or by contacting support. Here’s what happens when you cancel.',
			'intro' => 'You stay in control of your subscription. Cancel whenever you need to, with no lock-in.',
			'cta_title' => 'Need help cancelling?',
			'cta_sub' => 'Reach our team and we’ll sort it out.',
			'sections' => array(
				array(
					'n' => '01',
					'id' => 'terms',
					'title' => 'Cancellation Terms',
					'list' => array(
						'Cancellation stops all future billing cycles',
						'Access to services remains active until the end of the current billing period',
						'No partial refunds are provided for unused subscription periods',
					),
				),
				array(
					'n' => '02',
					'id' => 'contact',
					'title' => 'Contact',
					'body' => array(
						'For cancellation assistance, please contact:',
					),
					'email' => 'hello@amatec.in',
				),
			),
		),
	);
}
