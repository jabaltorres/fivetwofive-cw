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

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/functions/template-tags.php';

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

if ( class_exists( 'Fivetwofive\\Init' ) ) :
	/**
	 * When called for the first time, the function will initialize the theme.
	 */
	function fivetwofive() {
		static $theme = null;

		if ( null === $theme ) {
			$theme = new Fivetwofive\Init();
			$theme->register();
		}
	}

	fivetwofive();
endif;
