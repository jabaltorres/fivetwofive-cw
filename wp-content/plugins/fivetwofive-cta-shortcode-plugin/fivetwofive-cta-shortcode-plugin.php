<?php
/**
 * Plugin Name:       FiveTwoFive CTA Shortcode Plugin
 * Plugin URI:        https://github.com/capitalJT/fivetwofive-cta-shortcode-plugin
 * Description:       FiveTwoFive CTA Shortcode Plugin.
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Jabal Torres
 * Author URI:        https://jabaltorres.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */


/* disable direct file access */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// include plugin dependencies: admin only
if ( is_admin() ) {

	require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-validate.php';

}

// include plugin dependencies: admin and public
require_once plugin_dir_path( __FILE__ ) . 'includes/core-functions.php';

// default plugin options
function fivetwofive_options_default() {

	return array(
		'custom_title'        => esc_html__('Powered by FiveTwoFive', 'fivetwofive'),
		'custom_message'      => '<p class="custom-message">'. esc_html__('My custom message.', 'fivetwofive') .'</p>',
		'custom_url'          => 'https://fivetwofive.com',
		'custom_button_text'  => 'Learn More',
		'custom_target'       => 'self',
	);

}