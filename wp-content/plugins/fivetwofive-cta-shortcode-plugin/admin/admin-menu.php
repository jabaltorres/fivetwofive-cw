<?php // FiveTwoFive - Admin Menu

// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// add sub-level administrative menu
function fivetwofive_add_sublevel_menu() {

	add_submenu_page(
		'options-general.php',
		esc_html__('CTA Settings', 'fivetwofive'),
		esc_html__('FiveTwoFive CTA', 'fivetwofive'),
		'manage_options',
		'fivetwofive',
		'fivetwofive_display_settings_page'
	);
}
add_action( 'admin_menu', 'fivetwofive_add_sublevel_menu' );