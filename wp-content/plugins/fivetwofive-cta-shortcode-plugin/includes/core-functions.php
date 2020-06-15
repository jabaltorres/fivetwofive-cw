<?php // fivetwofive - Core Functionality

// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Custom CTA
 * shortcode: [ftf-cta]
 */
function fivetwofive_cta(){

	$options = get_option( 'fivetwofive_options', fivetwofive_options_default() );

	$fivetwofive_default_options_array = fivetwofive_options_default();

	/*
	 * $fivetwofive_cta_default_title = $fivetwofive_default_options_array['custom_title'];
	 * $fivetwofive_cta_default_message = $fivetwofive_default_options_array['custom_message'];
	 * $fivetwofive_cta_default_button_text = $fivetwofive_default_options_array['custom_button_text'];
	 * $fivetwofive_cta_default_url = $fivetwofive_default_options_array['custom_url'];
	 * $fivetwofive_cta_default_target = $fivetwofive_default_options_array['custom_target'];
	 */

	$custom_cta_html = "<div class='cta ftf-cta'>";
		$custom_cta_html .= "<div class='ftf-cta-inner'>";
			$custom_cta_html .= "<div class='cta-column-1'>";

				if ( isset( $options['custom_title'] ) && ! empty( $options['custom_title'] ) ) {
					$custom_cta_html .= "<h3 class='cta-title'>". $options['custom_title'] ."</h3>";
				} else {
					$custom_cta_html .= "<h3 class='cta-title'>". $fivetwofive_default_options_array['custom_title'] ."</h3>";
				}

				$custom_cta_html .= "<div class='cta-content'>";
					if ( isset( $options['custom_message'] ) && ! empty( $options['custom_message'] ) ) {
						$cta_message =  wp_kses_post( $options['custom_message'] );
					} else {
						$cta_message = wp_kses_post( $fivetwofive_default_options_array['custom_message'] );
					}
					$custom_cta_html .= $cta_message;
				$custom_cta_html .= "</div><!-- end .cta-content -->";

			$custom_cta_html .= "</div><!-- end .cta-column-1 -->";

			$custom_cta_html .= "<div class='cta-column-2'>";

				if ( isset( $options['custom_url'] ) && ! empty( $options['custom_url'] ) ) {
					$cta_link = esc_url( $options['custom_url'] );
				} else {
					$cta_link = esc_url( $fivetwofive_default_options_array['custom_url'] );
				}

				if ( isset( $options['custom_button_text'] ) && ! empty( $options['custom_button_text'] ) ) {
					$cta_button_text = sanitize_text_field( $options['custom_button_text'] );
				} else {
					$cta_button_text = sanitize_text_field( $fivetwofive_default_options_array['custom_button_text'] );
				}

				if ( isset( $options['custom_target'] ) && ! empty( $options['custom_target'] ) ) {
					$target = sanitize_text_field( $options['custom_target'] );
				} else {
					$target = sanitize_text_field( $fivetwofive_default_options_array['custom_target'] );
				}

				if ( 'blank' === $target ) {
					$cta_target = "_blank";
				} else {
					$cta_target = "_self";
				}

				$custom_cta_html .= "<a class='cta-btn has-shadow' href='". $cta_link ."' target='". $cta_target ."'>". $cta_button_text ."</a>";

			$custom_cta_html .= "</div><!-- end .cta-column-2 -->";
		$custom_cta_html .= "</div><!-- end .cta-download-inner -->";
	$custom_cta_html .= "</div><!-- end .cta-download -->";

	return $custom_cta_html;
}


function fivetwofive_register_cta_shortcodes() {
	/* Adding Shortcodes */
	add_shortcode('ftf-cta', 'fivetwofive_cta');

	/* Adding Styles */
	wp_register_style( 'fivetwofive_cta_styles', plugins_url('../public/css/fivetwofive-cta-styles.css', __FILE__), false, '1.0.0', 'all');
	wp_enqueue_style( 'fivetwofive_cta_styles' );

	/* Adding Scripts */
	wp_register_script( 'fivetwofive_cta_scripts', plugins_url('../public/js/fivetwofive-cta-scripts.js',__FILE__ ));
	wp_enqueue_script('fivetwofive_cta_scripts');
}

add_action( 'init', 'fivetwofive_register_cta_shortcodes');