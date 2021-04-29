<?php
/**
 * Handle all the functions need in theme setup.
 *
 * @package Fivetwofive
 * @subpackage FivetwofiveTheme/Theme
 * @since 1.0.0
 */

namespace Fivetwofive\FivetwofiveTheme\Theme;

use Fivetwofive\FivetwofiveTheme\Interfaces\Component_Interface;

/**
 * Handle all the functions need in theme setup.
 */
class Theme implements Component_Interface {

	public function register() {
		add_action( 'after_setup_theme', array( $this, 'content_width' ), 0 );
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	public function theme_setup() {
		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /lib/languages/ directory.
		 * If you're building a theme based on FiveTwoFive, use a find and replace
		 * to change 'fivetwofive' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'fivetwofive', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Primary', 'fivetwofive' ),
			)
		);

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

	}

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	public function content_width() {
		$GLOBALS['content_width'] = apply_filters( 'fivetwofive_content_width', 640 );
	}
}
