<?php
/**
 * Handle all the outputting of styles need in the site.
 *
 * @package Fivetwofive
 * @subpackage FivetwofiveTheme/Styles
 * @since 1.0.0
 */

namespace Fivetwofive\FivetwofiveTheme\Styles;

use Fivetwofive\FivetwofiveTheme\Interfaces\Component_Interface;
use Fivetwofive\FivetwofiveTheme\Config\Config;
use Fivetwofive\FivetwofiveTheme\Styles\CSS;

/**
 * Handle all the outputting of styles need in the site.
 */
class Styles implements Component_Interface {

	public function register() {
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_styles_and_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_mods_css' ), 11 );
		add_action( 'wp_head', array( $this, 'preconnect' ), 5 );
	}

	public function generate_google_fonts_url( $fonts ) {
		$google_fonts_url = 'https://fonts.googleapis.com/css2';
		$font_args        = array();

		// Make sure we are dealing with an array.
		if ( ! is_array( $fonts ) && empty( $fonts ) ) {
			return false;
		}

		foreach ( $fonts as $font ) {
			$font_uri          = '';
			$font_uri_variants = array();
			$has_italic        = false;

			// check if there is an italic.
			foreach ( $font['variants'] as $font_weight ) {
				if ( strpos( $font_weight, 'italic' ) !== false ) {
					$has_italic = true;
					break;
				}
			}

			if ( $has_italic ) {
				$font_uri = wp_sprintf(
					'family=%s:ital,wght@',
					rawurlencode( $font['name'] )
				);

				foreach ( $font['variants'] as $variant ) {
					if ( strpos( $variant, 'italic' ) === false ) {
						$font_uri_variants[] = '0,' . $variant;
					} else {
						$font_uri_variants[] = '1,' . str_replace( 'italic', '', $variant );
					}
				}

				$font_uri .= implode( ';', $font_uri_variants );
			} else {
				$font_uri = wp_sprintf(
					'family=%s:wght@',
					rawurlencode( $font['name'] )
				);

				foreach ( $font['variants'] as $variant ) {
					$font_uri_variants[] = $variant;
				}

				$font_uri .= implode( ';', $font_uri_variants );
			}

			$font_args[] = $font_uri;
		}

		$google_fonts_url .= '?' . implode( '&', $font_args );
		$google_fonts_url .= '&display=swap';

		return $google_fonts_url;
	}

	public function fonts_url() {
		$defaults   = Config::get_instance()->get_settings();
		$theme_mods = wp_parse_args(
			get_theme_mod( 'fivetwofive_theme_mods', array() ),
			$defaults['default_theme_mods']
		);

		$fonts = array(
			array(
				'name'     => $theme_mods['typography']['body_font'],
				'variants' => $theme_mods['typography']['body_font_variants'],
			),
			array(
				'name'     => $theme_mods['typography']['heading_font'],
				'variants' => $theme_mods['typography']['heading_font_variants'],
			),
		);

		return $this->generate_google_fonts_url( $fonts );
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function theme_styles_and_scripts() {
		wp_enqueue_style( 'fivetwofive-fonts', $this->fonts_url(), array(), null );
		wp_enqueue_style( 'fivetwofive-global-style', get_stylesheet_uri(), array( 'fivetwofive-fonts' ), FIVETWOFIVE_VERSION );
		wp_enqueue_script( 'fivetwofive-navigation', get_template_directory_uri() . '/assets/dist/js/navigation.js', array(), FIVETWOFIVE_VERSION, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Checks the settings for the colors and fonts of the theme.
	 *
	 * @since 1.0
	 */
	public function theme_mods_css() {
		$defaults   = Config::get_instance()->get_settings();
		$css        = new CSS();
		$theme_mods = wp_parse_args(
			get_theme_mod( 'fivetwofive_theme_mods', array() ),
			$defaults['default_theme_mods']
		);

		if ( ! is_array( $theme_mods ) || empty( $theme_mods ) ) {
			return;
		}

		$css->set_selector( 'a, a:focus' );
		$css->add_property( 'color', $theme_mods['colors']['body']['link_color'] );

		$css->set_selector( 'a:hover' );
		$css->add_property( 'color', $theme_mods['colors']['body']['link_color_hover'] );

		$css->set_selector( 'a:visited' );
		$css->add_property( 'color', $theme_mods['colors']['body']['link_color_visited'] );

		$css->set_selector( '.site-header' );
		$css->add_property( 'background-color', $theme_mods['colors']['header']['background_color'] );

		$css->set_selector( '.main-navigation' );
		$css->add_property( 'background-color', $theme_mods['colors']['primary_navigation']['background_color'] );

		$css->set_selector( '.main-navigation a' );
		$css->add_property( 'color', $theme_mods['colors']['primary_navigation']['link_color'] );

		$css->set_selector( '.main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a, .main-navigation .current-menu-ancestor > a' );
		$css->add_property( 'color', $theme_mods['colors']['primary_navigation']['active_link_color'] );

		$css->set_selector( '.main-navigation a:focus, .main-navigation a:hover' );
		$css->add_property( 'color', $theme_mods['colors']['primary_navigation']['active_link_color'] );

		$css->set_selector( 'body' );
		$css->add_property( 'color', $theme_mods['colors']['body']['text_color'] );
		$css->add_property( 'background-color', $theme_mods['colors']['body']['background_color'] );
		$css->add_property( 'font-family', $theme_mods['typography']['body_font'] . ', ' . $theme_mods['typography']['body_font_category'] );

		$css->set_selector( 'h1, h2, h3, h4, h5, h6' );
		$css->add_property( 'color', $theme_mods['colors']['body']['heading_color'] );
		$css->add_property( 'font-family', $theme_mods['typography']['heading_font'] . ', ' . $theme_mods['typography']['heading_font_category'] );

		$css->set_selector( '.site-footer' );
		$css->add_property( 'background-color', $theme_mods['colors']['footer']['background_color'] );
		$css->add_property( 'color', $theme_mods['colors']['footer']['text_color'] );

		if ( $css ) {
			wp_add_inline_style( 'fivetwofive-global-style', $css->css_output() );
		}
	}

	/**
	 * Add preconnect urls to the head.
	 *
	 * @return void
	 */
	public function preconnect() {
		$config = Config::get_instance()->get_settings();

		if ( ! is_array( $config['preconnect_urls'] ) ) {
			return;
		}

		foreach ( $config['preconnect_urls'] as $preconnect_url ) {
			echo sprintf( '<link rel="preconnect" href="1$%s">', esc_url( $preconnect_url ) );
		}
	}

}
