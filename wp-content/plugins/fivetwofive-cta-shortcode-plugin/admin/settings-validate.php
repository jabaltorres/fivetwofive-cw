<?php // FiveTwoFive - Validate Settings


// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// callback: validate options
function fivetwofive_callback_validate_options( $input ) {
	
	// custom title
	if ( isset( $input['custom_title'] ) ) {
		
		$input['custom_title'] = sanitize_text_field( $input['custom_title'] );
		
	}

	// custom message
	if ( isset( $input['custom_message'] ) ) {
		
		$input['custom_message'] = wp_kses_post( $input['custom_message'] );
		
	}

	// custom url
	if ( isset( $input['custom_url'] ) ) {

		$input['custom_url'] = esc_url( $input['custom_url'] );

	}

	// custom target
	$radio_options = fivetwofive_options_radio();

	if ( ! isset( $input['custom_target'] ) ) {

		$input['custom_target'] = null;

	}
	if ( ! array_key_exists( $input['custom_target'], $radio_options ) ) {

		$input['custom_target'] = null;

	}
	
	return $input;
	
}