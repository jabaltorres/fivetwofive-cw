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
			sort( $font_uri_variants, SORT_NUMERIC );
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
	wp_enqueue_style( 'fivetwofive-theme-main', get_template_directory_uri() . '/assets/dist/css/main.css', array( 'fivetwofive-theme-fonts' ), FIVETWOFIVE_THEME_VERSION );
	wp_register_script( 'fivetwofive-theme-popperjs', 'https://unpkg.com/@popperjs/core@2', array(), FIVETWOFIVE_THEME_VERSION, true );
	wp_enqueue_script( 'fivetwofive-theme-navigation', get_template_directory_uri() . '/assets/dist/js/navigation.js', array(), FIVETWOFIVE_THEME_VERSION, true );

	if ( is_singular( 'ftf_event' ) ) {
		wp_enqueue_style( 'fivetwofive-theme-single-event', get_template_directory_uri() . '/assets/dist/css/single-event.css', array( 'fivetwofive-theme-main' ), FIVETWOFIVE_THEME_VERSION );
	}

	if ( is_singular( 'ftf_resource' ) ) {
		wp_enqueue_style( 'fivetwofive-theme-single-resource', get_template_directory_uri() . '/assets/dist/css/single-resource.css', array( 'fivetwofive-theme-main' ), FIVETWOFIVE_THEME_VERSION );
	}

    if ( is_singular( 'music' ) ) {
        wp_enqueue_style( 'fivetwofive-theme-single-music', get_template_directory_uri() . '/assets/dist/css/single-music.css', array( 'fivetwofive-theme-main' ), FIVETWOFIVE_THEME_VERSION );
    }

	if ( is_singular( 'post' ) ) {
		wp_enqueue_script( 'fivetwofive-theme-single-post', get_template_directory_uri() . '/assets/dist/js/single-post.js', array( 'fivetwofive-theme-popperjs' ), FIVETWOFIVE_THEME_VERSION, true );
	}

	if ( is_page_template( 'page-templates/template-module.php' ) || is_singular( 'ftf_event' ) ) {
		// Register 3rd party modules dependencies.
		wp_register_style( 'fivetwofive-theme-fancybox', get_template_directory_uri() . '/assets/dist/js/plugins/fancybox/jquery.fancybox.min.css', array(), FIVETWOFIVE_THEME_VERSION );
		wp_register_style( 'fivetwofive-theme-swiper', get_template_directory_uri() . '/assets/dist/js/plugins/swiper/swiper-bundle.min.css', array(), FIVETWOFIVE_THEME_VERSION );
		wp_register_script( 'fivetwofive-theme-fancybox', get_template_directory_uri() . '/assets/dist/js/plugins/fancybox/jquery.fancybox.min.js', array( 'jquery' ), FIVETWOFIVE_THEME_VERSION, true );
		wp_register_script( 'fivetwofive-theme-swiper', get_template_directory_uri() . '/assets/dist/js/plugins/swiper/swiper-bundle.min.js', array( 'jquery' ), FIVETWOFIVE_THEME_VERSION, true );
		wp_enqueue_script( 'fivetwofive-theme-scrollreveal', 'https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js', array(), FIVETWOFIVE_THEME_VERSION, false );

		// Announcement module.
		wp_register_script( 'fivetwofive-theme-module-announcement', get_template_directory_uri() . '/assets/dist/js/modules/module-announcement.min.js', array( 'jquery' ), FIVETWOFIVE_THEME_VERSION, true );
		// Testimonials Carousel module.
		wp_register_script( 'fivetwofive-theme-module-testimonials-carousel', get_template_directory_uri() . '/assets/dist/js/modules/module-testimonials-carousel.min.js', array( 'jquery', 'fivetwofive-theme-swiper' ), FIVETWOFIVE_THEME_VERSION, true );
		// Accordion Carousel module.
		wp_register_script( 'fivetwofive-theme-module-accordion', get_template_directory_uri() . '/assets/dist/js/modules/module-accordion.min.js', array( 'jquery', 'jquery-ui-accordion' ), FIVETWOFIVE_THEME_VERSION, true );
		// Resources module.
		wp_register_script( 'fivetwofive-theme-module-resources', get_template_directory_uri() . '/assets/dist/js/modules/module-resource.min.js', array( 'jquery', 'fivetwofive-theme-scrollreveal' ), FIVETWOFIVE_THEME_VERSION, true );
		wp_add_inline_script( 'fivetwofive-theme-module-resources', 'const FiveTwoFive = ' . wp_json_encode( array( 'restBase' => get_rest_url( null, 'wp/v2/ftf-resources' ) ) ), 'before' );
		// Works module.
		wp_register_script( 'fivetwofive-theme-module-works', get_template_directory_uri() . '/assets/dist/js/modules/module-works.min.js', array( 'jquery', 'fivetwofive-theme-scrollreveal' ), FIVETWOFIVE_THEME_VERSION, true );

		// Enqueue module style and script.
		wp_enqueue_style( 'fivetwofive-theme-template-module', get_template_directory_uri() . '/assets/dist/css/template-modules.css', array( 'fivetwofive-theme-main' ), FIVETWOFIVE_THEME_VERSION );
		wp_enqueue_script( 'fivetwofive-theme-template-module', get_template_directory_uri() . '/assets/dist/js/template-modules.min.js', array( 'jquery', 'fivetwofive-theme-scrollreveal' ), FIVETWOFIVE_THEME_VERSION, true );

		// module custom styles.
		$current_page_id       = get_queried_object_id();
		$module_custom_styles  = get_field( 'ftf_custom_styles', $current_page_id );
		$module_styles         = get_field( 'ftf_module_styles', $current_page_id );
		$module_custom_scripts = get_field( 'ftf_custom_scripts', $current_page_id );
		$module_scripts        = get_field( 'ftf_module_scripts', $current_page_id );

		if ( $module_custom_styles && $module_styles ) {
			wp_add_inline_style( 'fivetwofive-theme-template-module', $module_styles );
		}

		if ( $module_custom_scripts && $module_scripts ) {
			wp_add_inline_script( 'fivetwofive-theme-template-module', $module_scripts );
		}
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( ! is_user_logged_in() ) {
		wp_dequeue_style( 'dashicons' );
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
		echo sprintf( '<link rel="preconnect" href="%1$s">', esc_url( $preconnect_url ) );
	}
}
add_action( 'wp_head', 'fivetwofive_theme_preconnect', 5 );

function fivetwofive_theme_defer_scripts( $tag, $handle, $src ) {
	if ( is_admin() ) {
		return $tag;
	}

	// The handles of the enqueued scripts we want to defer.
	$defer_scripts = array(
		'fivetwofive-theme-template-module',
		'fivetwofive-theme-swiper',
		'fivetwofive-theme-fancybox',
		'fivetwofive-theme-scrollreveal',
		'fivetwofive-theme-module-resources',
		'fivetwofive-theme-module-works',
		'fivetwofive-theme-module-testimonials-carousel',
	);

	if ( in_array( $handle, $defer_scripts, true ) ) {
		$tag = str_replace( '></script>', ' defer></script>', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'fivetwofive_theme_defer_scripts', 10, 3 );
