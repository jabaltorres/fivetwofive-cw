<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package FiveTwoFive_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function fivetwofive_theme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'fivetwofive_theme_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function fivetwofive_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'fivetwofive_theme_pingback_header' );

/**
 * Allow SVG in kses ruleset.
 *
 * @return array kses ruleset.
 */
function fivetwofive_kses_extended_ruleset() {
	$kses_defaults = wp_kses_allowed_html( 'post' );

	$svg_args = array(
		'svg'   => array(
			'class'           => true,
			'aria-hidden'     => true,
			'aria-labelledby' => true,
			'role'            => true,
			'xmlns'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true, // <= Must be lower case!
		),
		'g'     => array( 'fill' => true ),
		'title' => array( 'title' => true ),
		'path'  => array(
			'd'    => true,
			'fill' => true,
		),
		'iframe' => array(
			'src'             => true,
			'height'          => true,
			'width'           => true,
			'frameborder'     => true,
			'allowfullscreen' => true,
		),
	);
	return array_merge( $kses_defaults, $svg_args );
}

/**
 * Undocumented function
 *
 * @param string $iframe ACF Oembed field.
 * @param array  $params Iframe attributes.
 * @return void
 */
function fivetwofive_get_acf_oembed_iframe(
	$iframe,
	$params = array(
		'controls' => 0,
		'hd'       => 1,
		'autohide' => 1,
	) ) {

	// Use preg_match to find iframe src.
	preg_match( '/src="(.+?)"/', $iframe, $matches );
	$src     = $matches[1];
	$new_src = add_query_arg( $params, $src );
	$iframe  = str_replace( $src, $new_src, $iframe );

	// Add extra attributes to iframe HTML.
	$attributes   = 'frameborder="0"';
	$iframe = str_replace( '></iframe>', ' ' . $attributes . '></iframe>', $iframe );

	// Display customized HTML.
	return $iframe;
}