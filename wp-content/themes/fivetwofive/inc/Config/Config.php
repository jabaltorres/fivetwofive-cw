<?php
/**
 * Handle all the theme configuration settings - Config class.
 *
 * @package Fivetwofive
 * @subpackage FivetwofiveTheme/Config
 * @since 1.0.0
 */

namespace Fivetwofive\FivetwofiveTheme\Config;

use Fivetwofive\FivetwofiveTheme\Config\Typography;

/**
 * Handle all the theme configuration settings.
 */
class Config {

	/**
	 * Default Theme mods - see get_theme_mods to add or override default theme mods.
	 *
	 * @var array
	 */
	private $default_theme_mods = array(
		'typography'    => array(
			'body_font'             => 'DM sans',
			'body_font_variants'    => array( '400', 'italic' ),
			'body_font_category'    => 'sans-serif',
			'body_font_weight'      => '400',
			'heading_font'          => 'Roboto',
			'heading_font_variants' => array( '700', '700italic' ),
			'heading_font_category' => 'sans-serif',
			'heading_font_weight'   => '700',
		),
		'colors'        => array(
			'body'               => array(
				'background_color'   => '#ffffff',
				'text_color'         => '#000000',
				'heading_color'      => '#000000',
				'link_color'         => '#ffcb05',
				'link_color_hover'   => '#ffcb05',
				'link_color_visited' => '#ffcb05',
			),
			'header'             => array(
				'background_color' => '#ffffff',
			),
			'primary_navigation' => array(
				'background_color'  => '#ffffff',
				'link_color'        => '#000000',
				'active_link_color' => '#FFCB05',
			),
			'footer'             => array(
				'background_color' => '#ffffff',
				'text_color'       => '#000000',
			),
		),
		'site_identity' => array(
			'hide_blogname'        => '',
			'hide_blogdescription' => '',
		),
		'layout'        => array(
			'header'             => array(
				'width'     => 'full',
				'presets'   => 'default',
				'alignment' => 'right',
			),
			'primary_navigation' => array(
				'location'    => 'float_right',
				'width'       => 'full',
				'inner_width' => 'contained',
				'alignment'   => 'right',
				'search'      => 'enable',
			),
			'footer'             => array(
				'width'       => 'full',
				'inner_width' => 'contained',
				'widgets'     => '3',
			),
			'sidebars'           => array(
				'sidebar_layout'             => 'content_no_sidebar',
				'blog_sidebar_layout'        => 'content_sidebar',
				'single_post_sidebar_layout' => 'content_sidebar',
			),
		),
	);

	/**
	 * Preconnect URLs
	 *
	 * @var array
	 */
	private $preconnect_urls = array( 'https://fonts.gstatic.com' );

	/**
	 * The post types where the single post sidebar layout will be applied.
	 *
	 * @var array
	 */
	private $single_posts = array( 'post' );

	/**
	 * Config instance.
	 *
	 * @var array
	 */
	private static $instances = array();

	/**
	 * The Config's constructor should always be private to prevent direct
	 * construction calls with the `new` operator.
	 */
	protected function __construct() { }

	/**
	 * Config class should not be cloneable.
	 */
	protected function __clone() { }

	/**
	 * Config class should not be restorable from strings.
	 *
	 * @throws \Exception Throws an exception when the config class is serialized.
	 */
	public function __wakeup() {
		throw new \Exception( 'Cannot unserialize a config class.' );
	}

	/**
	 * This is the static method that controls the access to the config
	 * instance. On the first run, it creates a config object and places it
	 * into the static field. On subsequent runs, it returns the client existing
	 * object stored in the static field.
	 *
	 * This implementation lets you subclass the config class while keeping
	 * just one instance of each subclass around.
	 */
	public static function get_instance(): Config {
		$cls = static::class;
		if ( ! isset( self::$instances[ $cls ] ) ) {
			self::$instances[ $cls ] = new static();
		}

		return self::$instances[ $cls ];
	}

	/**
	 * Get the Theme configuration settings.
	 *
	 * @return array Various configuration of the theme.
	 */
	public function get_default_theme_mods() {
		return apply_filters( 'fivetwofive_default_theme_mods', $this->default_theme_mods );
	}

	/**
	 * Get the Theme mods with the default theme mods as fallback.
	 *
	 * @return array $theme_mods Theme mods.
	 */
	public function get_theme_mods() {
		$defaults   = $this->get_default_theme_mods();
		$theme_mods = wp_parse_args(
			get_theme_mod( 'fivetwofive_theme_mods', array() ),
			$defaults
		);

		return $theme_mods;
	}

	/**
	 * Get the Theme configuration settings.
	 *
	 * @return array Various configuration of the theme.
	 */
	public function get_theme_config() {
		$typography_config = new Typography();

		return array(
			'google_fonts'    => $typography_config->get_google_font_names(),
			'font_variants'   => $typography_config->get_font_variants(),
			'font_weights'    => $typography_config->get_font_weights(),
			'font_categories' => $typography_config->get_font_categories(),
			'preconnect_urls' => apply_filters( 'fivetwofive_preconnect_urls', $this->preconnect_urls ),
			'single_posts'    => apply_filters( 'fivetwofive_single_post_sidebar', $this->single_posts ),
		);
	}
}
