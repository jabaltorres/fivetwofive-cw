<?php
/**
 * FiveTwoFive functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FiveTwoFive
 */

if ( ! defined( 'FIVETWOFIVE_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'FIVETWOFIVE_VERSION', '1.0.0' );
}

define( 'FIVETWOFIVE_MINIMUM_WP_VERSION', '4.5' );
define( 'FIVETWOFIVE_MINIMUM_PHP_VERSION', '7.0' );

// Bail if requirements are not met.
if ( version_compare( $GLOBALS['wp_version'], FIVETWOFIVE_MINIMUM_WP_VERSION, '<' ) || version_compare( phpversion(), FIVETWOFIVE_MINIMUM_PHP_VERSION, '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

// Include WordPress shims.
require get_template_directory() . '/inc/wordpress-shims.php';

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

// Load the `fivetwofive()` entry point function.
require get_template_directory() . '/inc/functions.php';

// Initialize the theme.
call_user_func( 'Fivetwofive\FivetwofiveTheme\fivetwofive' );
