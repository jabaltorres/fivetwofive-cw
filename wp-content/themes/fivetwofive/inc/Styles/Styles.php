<?php
/**
 * Custom icons for this theme.
 *
 * @package WordPress
 * @subpackage FiveTwoFive
 * @since FiveTwoFive 1.0
 */

namespace Fivetwofive\Styles;

use Fivetwofive\Component_Interface;
use Fivetwofive\Config\Config;

class Styles implements Component_Interface {

	public function register() {
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_styles_and_scripts' ) );
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
			$font_uri = '';
			$font_uri_weights = array();
			$has_italic = false;
			// check if there is an italic
			foreach ( $font['weights'] as $font_weight ) {
				if ( strpos( $font_weight, 'i' ) !== false ) {
					$has_italic = true;
					break;
				}
			}

			if ( $has_italic ) {
				$font_uri = wp_sprintf(
					'family=%s:ital,wght@',
					urlencode( $font['name'] )
				);

				foreach ( $font['weights'] as $weight ) {
					if ( strpos( $weight, 'i' ) === false ) {
						$font_uri_weights[] = '0,' . $weight;
					} else {
						$font_uri_weights[] = '1,' . str_replace( 'i', '', $weight );
					}
				}

				$font_uri .= implode( ';', $font_uri_weights );
			} else {
				$font_uri = wp_sprintf(
					'family=%s:wght@',
					urlencode( $font['name'] )
				);

				foreach ( $font['weights'] as $weight ) {
					$font_uri_weights[] = $weight;
				}

				$font_uri .= implode( ';', $font_uri_weights );
			}

			$font_args[] = $font_uri;
		}


		$google_fonts_url .= '?' . implode( '&', $font_args );
		$google_fonts_url .= '&display=swap';

		return $google_fonts_url;
	}

	public function fonts_url() {
		$defaults = Config::get_instance()->get_settings();
		$theme_mods = get_theme_mod( 'fivetwofive_theme_mods', $defaults['default_theme_mods'] );

		$fonts = array(
			array(
				'name'    => $theme_mods['default_font'],
				'weights' =>  $theme_mods['default_font_style'],
			),
			array(
				'name'    => $theme_mods['heading_font'],
				'weights' =>  $theme_mods['heading_font_style'],
			)
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
