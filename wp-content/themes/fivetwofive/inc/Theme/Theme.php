<?php
/**
 * Handle all the functions need in theme setup.
 *
 * @package Fivetwofive
 * @subpackage FivetwofiveTheme/Theme
 * @since 1.0.0
 */

namespace Fivetwofive\FivetwofiveTheme\Theme;

use Fivetwofive\FivetwofiveTheme\Config\Config;
use Fivetwofive\FivetwofiveTheme\Interfaces\Component_Interface;
use Fivetwofive\FivetwofiveTheme\Interfaces\Templating_Component_Interface;

/**
 * Handle all the functions need in theme setup.
 */
class Theme implements Component_Interface, Templating_Component_Interface {

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function register() {
		add_action( 'after_setup_theme', array( $this, 'content_width' ), 0 );
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
		add_filter( 'body_class', array( $this, 'body_class' ) );
		add_action( 'fivetwofive_before_content', array( $this, 'before_content' ) );
		add_action( 'fivetwofive_after_content', array( $this, 'after_content' ) );
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `wp_rig()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags() : array {
		return array(
			'get_theme_mods' => array( $this, 'get_theme_mods' ),
		);
	}

	/**
	 * Expose the theme settings in the template files.
	 *
	 * @return class Config class.
	 */
	public function get_theme_mods() {
		return Config::get_instance()->get_theme_mods();
	}

	/**
	 * Expose the theme settings in the template files.
	 *
	 * @return class Config class.
	 */
	public function get_theme_config() {
		return Config::get_instance()->get_theme_config();
	}

	/**
	 * Add the appropriate classes depending on the theme settings.
	 *
	 * @param array $classes default WordPress body classes.
	 * @return array $classes default WordPress body classes with theme settings classes.
	 */
	public function body_class( $classes ) {
		$theme_mods   = Config::get_instance()->get_theme_mods();
		$theme_config = Config::get_instance()->get_theme_config();

		if ( ! is_array( $theme_mods ) ) {
			return $classes;
		}

		if ( is_home() ) {
			$classes[] = str_replace( '_', '-', 'fivetwofive-' . $theme_mods['layout']['sidebars']['sidebar_layout'] );
		}

		if ( is_singular( $theme_config['single_posts'] ) ) {
			$classes[] = str_replace( '_', '-', 'fivetwofive_' . $theme_mods['layout']['sidebars']['single_post_sidebar_layout'] );
		}

		if ( ! is_single( $theme_config['single_posts'] ) && ! is_home() ) {
			$classes[] = str_replace( '_', '-', 'fivetwofive_' . $theme_mods['layout']['sidebars']['sidebar_layout'] );
		}

		return $classes;
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
	 * Manipulate the page content
	 *
	 * @return void
	 */
	public function before_content() {
		$theme_mods   = Config::get_instance()->get_theme_mods();
		$sidebar_mods = $theme_mods['layout']['sidebars'];
		$theme_config = Config::get_instance()->get_theme_config();

		if ( is_home() && 'sidebar_content' === $sidebar_mods['blog_sidebar_layout'] ) {
			get_sidebar();
		}

		if ( is_singular( $theme_config['single_posts'] ) && 'sidebar_content' === $sidebar_mods['single_post_sidebar_layout'] ) {
			get_sidebar();
		}

		if ( ( ! is_single( $theme_config['single_posts'] ) && ! is_home() )
		&& 'sidebar_content' === $sidebar_mods['sidebar_layout'] ) {
			get_sidebar();
		}
	}

	/**
	 * Manipulate the page content
	 *
	 * @return void
	 */
	public function after_content() {
		$theme_mods   = Config::get_instance()->get_theme_mods();
		$sidebar_mods = $theme_mods['layout']['sidebars'];
		$theme_config = Config::get_instance()->get_theme_config();

		if ( is_home() && 'content_sidebar' === $sidebar_mods['blog_sidebar_layout'] ) {
			get_sidebar();
		}

		if ( is_singular( $theme_config['single_posts'] ) && 'content_sidebar' === $sidebar_mods['single_post_sidebar_layout'] ) {
			get_sidebar();
		}

		if ( ( ! is_single( $theme_config['single_posts'] ) && ! is_home() )
		&& 'content_sidebar' === $sidebar_mods['sidebar_layout'] ) {
			get_sidebar();
		}
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
