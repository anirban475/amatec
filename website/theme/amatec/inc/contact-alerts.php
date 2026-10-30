<?php
/**
 * Enquiry alerts — each contact form message is POSTed to an n8n webhook,
 * which emails Anirban through Microsoft 365 (lands in the inbox, Reply goes
 * to the lead) and sends him a Slack DM. The webhook is the n8n workflow
 * "Amatec website: contact form alerts".
 *
 * The webhook URL is a secret, so it is stored in the database
 * (Settings → General → Enquiry alerts webhook), never in the theme or repo.
 * Saving a new URL sends one test alert and shows the result.
 *
 * Every message records the outcome in post meta cf_alert (sent / failed /
 * not_set), shown in the Alert column of WP Admin → Contact Messages.
 *
 * @package AMATEC
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * POST one enquiry to the alerts webhook.
 *
 * @param array $data name, email, company, phone, interest, message, admin_url, received, test.
 * @return string sent|failed|not_set
 */
function amatec_send_enquiry_alert( array $data ) {
	$url = trim( (string) get_option( 'amatec_enquiry_webhook', '' ) );
	if ( '' === $url ) {
		return 'not_set';
	}
	$response = wp_remote_post( $url, array(
		'timeout' => 8,
		'headers' => array( 'Content-Type' => 'application/json' ),
		'body'    => wp_json_encode( array_merge( array( 'type' => 'contact', 'site' => home_url( '/' ) ), $data ) ),
	) );
	$code = is_wp_error( $response ) ? 0 : (int) wp_remote_retrieve_response_code( $response );
	return ( $code >= 200 && $code < 300 ) ? 'sent' : 'failed';
}

/* ------------------------------------------------------------------
 * Settings → General: the webhook URL field.
 * ------------------------------------------------------------------ */
function amatec_enquiry_webhook_setting() {
	register_setting( 'general', 'amatec_enquiry_webhook', array(
		'type'              => 'string',
		'sanitize_callback' => 'esc_url_raw',
		'default'           => '',
	) );
	add_settings_field( 'amatec_enquiry_webhook', __( 'Enquiry alerts webhook', 'amatec' ), 'amatec_enquiry_webhook_field', 'general' );
}
add_action( 'admin_init', 'amatec_enquiry_webhook_setting' );

function amatec_enquiry_webhook_field() {
	printf(
		'<input type="url" class="regular-text code" id="amatec_enquiry_webhook" name="amatec_enquiry_webhook" value="%s" placeholder="https://n8n.amatec.in/webhook/...">',
		esc_attr( get_option( 'amatec_enquiry_webhook', '' ) )
	);
	echo '<p class="description">' . esc_html__( 'The n8n webhook that emails you and sends a Slack DM for each contact form message. Saving a new URL sends a test alert.', 'amatec' ) . '</p>';
}

/**
 * Saving a new webhook URL sends one test alert; the result shows as a notice.
 *
 * @param mixed $old Previous value.
 * @param mixed $new New value.
 */
function amatec_enquiry_webhook_saved( $old, $new ) {
	if ( '' === (string) $new || $old === $new ) {
		return;
	}
	$result = amatec_send_enquiry_alert( array(
		'test'      => true,
		'name'      => 'Test alert',
		'email'     => get_option( 'admin_email' ),
		'message'   => 'This is a test sent from Settings, General on amatec.in. New contact form messages will arrive like this.',
		'admin_url' => admin_url( 'edit.php?post_type=amatec_message' ),
		'received'  => current_time( 'Y-m-d H:i' ),
	) );
	set_transient( 'amatec_enquiry_webhook_test', $result, 120 );
}
add_action( 'update_option_amatec_enquiry_webhook', 'amatec_enquiry_webhook_saved', 10, 2 );

function amatec_enquiry_webhook_added( $option, $value ) {
	amatec_enquiry_webhook_saved( '', $value );
}
add_action( 'add_option_amatec_enquiry_webhook', 'amatec_enquiry_webhook_added', 10, 2 );

function amatec_enquiry_webhook_notice() {
	$result = get_transient( 'amatec_enquiry_webhook_test' );
	if ( ! $result ) {
		return;
	}
	delete_transient( 'amatec_enquiry_webhook_test' );
	$ok = 'sent' === $result;
	printf(
		'<div class="notice notice-%s is-dismissible"><p>%s</p></div>',
		$ok ? 'success' : 'error',
		esc_html( $ok
			? __( 'Test enquiry alert sent. Check your email and Slack.', 'amatec' )
			: __( 'The test enquiry alert could not be sent. Check the webhook URL and that the n8n workflow is active.', 'amatec' ) )
	);
}
add_action( 'admin_notices', 'amatec_enquiry_webhook_notice' );

/* ------------------------------------------------------------------
 * Contact Messages list: Alert column.
 * ------------------------------------------------------------------ */
function amatec_message_columns( $columns ) {
	$out = array();
	foreach ( $columns as $key => $label ) {
		$out[ $key ] = $label;
		if ( 'title' === $key ) {
			$out['cf_alert'] = __( 'Alert', 'amatec' );
		}
	}
	return $out;
}
add_filter( 'manage_amatec_message_posts_columns', 'amatec_message_columns' );

function amatec_message_column( $column, $post_id ) {
	if ( 'cf_alert' !== $column ) {
		return;
	}
	$labels = array(
		'sent'    => __( 'Sent', 'amatec' ),
		'failed'  => __( 'Failed', 'amatec' ),
		'not_set' => __( 'No webhook set', 'amatec' ),
	);
	$value = get_post_meta( $post_id, 'cf_alert', true );
	echo esc_html( isset( $labels[ $value ] ) ? $labels[ $value ] : __( 'Not tracked', 'amatec' ) );
}
add_action( 'manage_amatec_message_posts_custom_column', 'amatec_message_column', 10, 2 );
