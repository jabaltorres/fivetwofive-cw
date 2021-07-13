<?php
/**
 * FiveTwoFive Theme Admin
 *
 * @package FiveTwoFive_Theme
 */

 /**
  * Undocumented function
  */
function fivetwofive_theme_admin_styles() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/assets/dist/css/admin/admin.css', array( 'acf-pro-input' ), FIVETWOFIVE_THEME_VERSION );
}
add_action( 'admin_enqueue_scripts', 'fivetwofive_theme_admin_styles' );
