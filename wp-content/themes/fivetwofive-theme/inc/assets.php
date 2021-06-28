<?php
/**
 * Define all the assets related functions here.
 *
 * @package FiveTwoFive_Theme
 */

/**
 * Generate the Google fonts URL from the passed fonts.
 *
 * @param array $fonts Array of google fonts.
 * @return string $google_fonts_url Google fonts URL.
 */
function fivetwofive_theme_generate_google_fonts_url( $fonts ) {
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

/**
 * Get the theme mods typography settings and generate the google fonts URL.
 * see fivetwofive_theme_generate_google_fonts_url.
 *
 * @return string Google fonts URL.
 */
function fivetwofive_theme_fonts_url() {
	$theme_mods = fivetwofive_theme_mods();

	$fonts = array(
		array(
			'name'     => $theme_mods['typography_body_font'],
			'variants' => $theme_mods['typography_body_font_variants'],
		),
		array(
			'name'     => $theme_mods['typography_heading_font'],
			'variants' => $theme_mods['typography_heading_font_variants'],
		),
	);

	return fivetwofive_theme_generate_google_fonts_url( $fonts );
}

/**
 * Enqueue scripts and styles.
 */
function fivetwofive_theme_assets() {
	wp_enqueue_style( 'fivetwofive-theme-fonts', fivetwofive_theme_fonts_url(), array(), null );
	wp_enqueue_style( 'fivetwofive-theme-style', get_stylesheet_uri(), array( 'fivetwofive-theme-fonts' ), FIVETWOFIVE_THEME_VERSION );
	wp_enqueue_style( 'fivetwofive-theme-main', get_template_directory_uri() . '/assets/dist/css/main.css', array( 'fivetwofive-theme-style', 'fivetwofive-theme-fonts' ), FIVETWOFIVE_THEME_VERSION );

	wp_enqueue_script( 'fivetwofive-theme-navigation', get_template_directory_uri() . '/assets/dist/js/navigation.js', array(), FIVETWOFIVE_THEME_VERSION, true );

	if ( is_page_template( 'page-templates/template-module.php' ) ) {
		wp_enqueue_style( 'fivetwofive-theme-fancybox', get_template_directory_uri() . '/assets/dist/js/plugins/fancybox/jquery.fancybox.min.css', array(), FIVETWOFIVE_THEME_VERSION );
		wp_enqueue_style( 'fivetwofive-theme-swiper', get_template_directory_uri() . '/assets/dist/js/plugins/swiper/swiper-bundle.min.css', array(), FIVETWOFIVE_THEME_VERSION );
		wp_enqueue_style( 'fivetwofive-theme-template-module', get_template_directory_uri() . '/assets/dist/css/template-modules.css', array( 'fivetwofive-theme-fancybox', 'fivetwofive-theme-swiper', 'fivetwofive-theme-main' ), FIVETWOFIVE_THEME_VERSION );

		wp_enqueue_script( 'fivetwofive-theme-fancybox', get_template_directory_uri() . '/assets/dist/js/plugins/fancybox/jquery.fancybox.min.js', array( 'jquery' ), FIVETWOFIVE_THEME_VERSION, true );
		wp_enqueue_script( 'fivetwofive-theme-swiper', get_template_directory_uri() . '/assets/dist/js/plugins/swiper/swiper-bundle.min.js', array( 'jquery' ), FIVETWOFIVE_THEME_VERSION, true );
		wp_enqueue_script( 'fivetwofive-theme-template-module', get_template_directory_uri() . '/assets/dist/js/template-module.min.js', array( 'jquery', 'fivetwofive-theme-fancybox', 'fivetwofive-theme-swiper' ), FIVETWOFIVE_THEME_VERSION, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fivetwofive_theme_assets' );

/**
 * Add preconnect urls to the head.
 *
 * @return void
 */
function fivetwofive_theme_preconnect() {
	$preconnect_urls = array( 'https://fonts.gstatic.com' );

	foreach ( $preconnect_urls as $preconnect_url ) {
		echo sprintf( '<link rel="preconnect" href="1$%s">', esc_url( $preconnect_url ) );
	}
}
add_action( 'wp_head', 'fivetwofive_theme_preconnect', 5 );
