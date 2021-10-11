<?php
/**
 * FiveTwoFive Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FiveTwoFive_Theme
 */

if ( ! defined( 'FIVETWOFIVE_THEME_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'FIVETWOFIVE_THEME_VERSION', '0.6.1' );
}

/**
 * Define all the admin functions here.
 */
require get_template_directory() . '/inc/admin/admin.php';

/**
 * Define all the theme setup functions here.
 */
require get_template_directory() . '/inc/public/theme.php';

/**
 * Define all the assets related functions here.
 */
require get_template_directory() . '/inc/public/assets.php';

/**
 * Define all Widgets related code.
 */
require get_template_directory() . '/inc/admin/widgets.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/public/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/public/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/admin/customizer.php';

/**
 * SVG Icons
 */
require get_template_directory() . '/inc/public/svg-icons.php';

/**
 * Share Buttons
 */
require get_template_directory() . '/inc/public/share-buttons.php';

/**
 * Options Page
 */
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(
		array(
			'page_title' => 'Theme Options',
			'menu_title' => 'Theme options',
			'menu_slug'  => 'options',
			'capability' => 'edit_posts',
			'redirect'   => false,
		)
	);

	acf_add_options_page(
		array(
			'page_title' => 'Business Information',
			'menu_title' => 'Business Information',
			'menu_slug'  => 'business_information',
			'capability' => 'edit_posts',
			'redirect'   => false,
		)
	);

}
