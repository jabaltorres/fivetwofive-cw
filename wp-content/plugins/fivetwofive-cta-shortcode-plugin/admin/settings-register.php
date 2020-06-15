<?php // FiveTwoFive - Register Settings


// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// register plugin settings
function fivetwofive_register_settings() {

	register_setting( 
		'fivetwofive_options',
		'fivetwofive_options',
		'fivetwofive_callback_validate_options'
	); 


	/* Login Page Section */
	add_settings_section( 
		'fivetwofive_section_cta',
		esc_html__('Customize the CTA', 'fivetwofive'),
		'fivetwofive_callback_section_login',
		'fivetwofive'
	);


	/* Login Page Fields */
	add_settings_field(
		'custom_title',
		esc_html__('CTA Title', 'fivetwofive'),
		'fivetwofive_callback_field_text',
		'fivetwofive',
		'fivetwofive_section_cta',
		[ 'id' => 'custom_title', 'label' => esc_html__('Custom title attribute for the CTA', 'fivetwofive') ]
	);

	add_settings_field(
		'custom_message',
		esc_html__('CTA Message', 'fivetwofive'),
		'fivetwofive_callback_field_textarea',
		'fivetwofive',
		'fivetwofive_section_cta',
		[ 'id' => 'custom_message', 'label' => esc_html__('Custom text and/or markup', 'fivetwofive') ]
	);

	add_settings_field(
		'custom_button_text',
		esc_html__('CTA Button Text', 'fivetwofive'),
		'fivetwofive_callback_field_text',
		'fivetwofive',
		'fivetwofive_section_cta',
		[ 'id' => 'custom_button_text', 'label' => esc_html__('Custom button text for the CTA', 'fivetwofive') ]
	);

	add_settings_field(
		'custom_url',
		esc_html__('CTA URL', 'fivetwofive'),
		'fivetwofive_callback_field_text',
		'fivetwofive',
		'fivetwofive_section_cta',
		[ 'id' => 'custom_url', 'label' => esc_html__('Custom URL for the CTA link', 'fivetwofive') ]
	);

	add_settings_field(
		'custom_target',
		esc_html__('CTA Target', 'fivetwofive'),
		'fivetwofive_callback_field_radio',
		'fivetwofive',
		'fivetwofive_section_cta',
		[ 'id' => 'custom_target', 'label' => esc_html__('Custom target for the CTA', 'fivetwofive') ]
	);

}

add_action( 'admin_init', 'fivetwofive_register_settings' );