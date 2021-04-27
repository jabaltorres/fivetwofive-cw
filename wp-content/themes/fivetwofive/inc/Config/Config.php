<?php
/**
 * Google Fonts list for customize font controls.
 *
 * @package WordPress
 * @subpackage FiveTwoFive
 * @since FiveTwoFive 1.0
 */

namespace Fivetwofive\FivetwofiveTheme\Config;

use Fivetwofive\FivetwofiveTheme\Config\Typography;

/**
 * The Singleton class defines the `GetInstance` method that serves as an
 * alternative to constructor and lets clients access the same instance of this
 * class over and over.
 */
class Config {

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
			'header' => array(
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
		),
	);

	private $preconnect_urls = array( 'https://fonts.gstatic.com' );

	/**
	 * The Singleton's instance is stored in a static field. This field is an
	 * array, because we'll allow our Singleton to have subclasses. Each item in
	 * this array will be an instance of a specific Singleton's subclass.
	 */
	private static $instances = array();

	/**
	 * The Singleton's constructor should always be private to prevent direct
	 * construction calls with the `new` operator.
	 */
	protected function __construct() { }

	/**
	 * Singletons should not be cloneable.
	 */
	protected function __clone() { }

	/**
	 * Singletons should not be restorable from strings.
	 */
	public function __wakeup() {
		throw new \Exception( 'Cannot unserialize a singleton.' );
	}

	/**
	 * This is the static method that controls the access to the singleton
	 * instance. On the first run, it creates a singleton object and places it
	 * into the static field. On subsequent runs, it returns the client existing
	 * object stored in the static field.
	 *
	 * This implementation lets you subclass the Singleton class while keeping
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
	 * Finally, any singleton should define some business logic, which can be
	 * executed on its instance.
	 */
	public function get_settings() {
		$typography_config = new Typography();

		return array(
			'google_fonts'       => $typography_config->get_google_font_names(),
			'font_variants'      => $typography_config->get_font_variants(),
			'font_weights'       => $typography_config->get_font_weights(),
			'font_categories'    => $typography_config->get_font_categories(),
			'default_theme_mods' => apply_filters( 'fivetwofive_default_theme_mods', $this->default_theme_mods ),
			'preconnect_urls'    => apply_filters( 'fivetwofive_preconnect_urls', $this->preconnect_urls ),
		);
	}
}
