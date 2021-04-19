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

	public function fonts_url() {
		$config = Config::get_instance()->get_settings();
		return $config['default_theme_mods']['font_url'];
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function theme_styles_and_scripts() {
		wp_enqueue_style( 'fivetwofive-fonts', $this->fonts_url(), array(), FIVETWOFIVE_VERSION );
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
