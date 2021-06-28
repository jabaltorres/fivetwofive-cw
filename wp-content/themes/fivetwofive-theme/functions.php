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
	define( 'FIVETWOFIVE_THEME_VERSION', '0.3.8' );
}

/**
 * Define all the theme setup functions here.
 */
require get_template_directory() . '/inc/theme.php';

/**
 * Define all the assets related functions here.
 */
require get_template_directory() . '/inc/assets.php';

/**
 * Define all Widgets related code.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * SVG Icons
 */
require get_template_directory() . '/inc/svg-icons.php';

/**
 * Share Buttons
 */
require get_template_directory() . '/inc/share-buttons.php';
