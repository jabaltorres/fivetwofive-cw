<?php // FiveTwoFive - Settings Callbacks


// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// callback: login section
function fivetwofive_callback_section_login() {

	echo '<p>'. esc_html__('These settings enable you to customize the CTA.', 'fivetwofive') .'</p>';

}


// callback: text field
function fivetwofive_callback_field_text( $args ) {
	
	$options = get_option( 'fivetwofive_options', fivetwofive_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	
	echo '<input id="fivetwofive_options_'. $id .'" name="fivetwofive_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
	echo '<label for="fivetwofive_options_'. $id .'">'. $label .'</label>';
	
}


// radio field options
function fivetwofive_options_radio() {

	return array(
		'self'  => esc_html__('Open the anchor in the SAME tab: target=self', 'fivetwofive'),
		'blank' => esc_html__('Open the anchor in a NEW tab: target=blank', 'fivetwofive')
	);

}


// callback: radio field
function fivetwofive_callback_field_radio( $args ) {

	$options = get_option( 'fivetwofive_options', fivetwofive_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	$radio_options = fivetwofive_options_radio();

	foreach ( $radio_options as $value => $label ) {

		$checked = checked( $selected_option === $value, true, false );

		echo '<label><input name="fivetwofive_options['. $id .']" type="radio" value="'. $value .'"'. $checked .'> ';
		echo '<span>'. $label .'</span></label><br />';

	}

}


// callback: textarea field
function fivetwofive_callback_field_textarea( $args ) {
	
	$options = get_option( 'fivetwofive_options', fivetwofive_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$allowed_tags = wp_kses_allowed_html( 'post' );
	
	$value = isset( $options[$id] ) ? wp_kses( stripslashes_deep( $options[$id] ), $allowed_tags ) : '';
	
	echo '<textarea id="fivetwofive_options_'. $id .'" name="fivetwofive_options['. $id .']" rows="5" cols="50">'. $value .'</textarea><br />';
	echo '<label for="fivetwofive_options_'. $id .'">'. $label .'</label>';
	
}