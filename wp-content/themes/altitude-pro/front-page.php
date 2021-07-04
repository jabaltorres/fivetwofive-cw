<?php
/**
 * Altitude Pro.
 *
 * This file adds the front page to the Altitude Pro Theme.
 *
 * @package Altitude Pro
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/altitude/
 */

add_action( 'genesis_meta', 'altitude_front_page_genesis_meta' );
/**
 * Adds widget support for homepage. If no widgets active, display the default loop.
 *
 * @since 1.0.0
 */
function altitude_front_page_genesis_meta() {

	if ( is_active_sidebar( 'front-page-1' ) || is_active_sidebar( 'front-page-2' ) || is_active_sidebar( 'front-page-3' ) || is_active_sidebar( 'front-page-4' ) || is_active_sidebar( 'front-page-5' ) || is_active_sidebar( 'front-page-6' ) || is_active_sidebar( 'front-page-7' ) ) {

		// Enqueues scripts.
		add_action( 'wp_enqueue_scripts', 'altitude_enqueue_altitude_script' );

		// Adds front-page body class.
		add_filter( 'body_class', 'altitude_body_class' );

		// Forces full width content layout.
		add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

		// Removes breadcrumbs.
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		// Removes the default Genesis loop.
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		// Removes rel links in the head when loop is not present.
		remove_action( 'wp_head', 'genesis_paged_rel' );

		// Adds homepage widgets.
		add_action( 'genesis_loop', 'altitude_front_page_widgets' );

		// Adds featured-section body class.
		if ( is_active_sidebar( 'front-page-1' ) ) {

			// Adds image-section-start body class.
			add_filter( 'body_class', 'altitude_featured_body_class' );

		}
	}

}

/**
 * Defines front page scripts.
 *
 * @since 1.0.0
 */
function altitude_enqueue_altitude_script() {
	wp_enqueue_script( 'altitude-script', get_stylesheet_directory_uri() . '/js/home.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
}

/**
 * Defines front-page body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Original body classes.
 * @return array $classes Updated body classes.
 */
function altitude_body_class( $classes ) {

	$classes[] = 'front-page';
	return $classes;

}

/**
 * Defines featured-section body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Original body classes.
 * @return array $classes Modified body classes.
 */
function altitude_featured_body_class( $classes ) {

	$classes[] = 'featured-section';
	return $classes;

}

/**
 * Adds markup for front page widget areas.
 *
 * @since 1.0.0
 */
function altitude_front_page_widgets() {

	echo '<h2 class="screen-reader-text">' . esc_html__( 'Main Content', 'altitude-pro' ) . '</h2>';

	genesis_widget_area(
		'front-page-1',
		array(
			'before' => '<div id="front-page-1" class="front-page-1" tabindex="-1"><div class="image-section"><div class="flexible-widgets widget-area' . altitude_widget_area_class( 'front-page-1' ) . '"><div class="wrap">',
			'after'  => '</div></div></div></div>',
		)
	);

	genesis_widget_area(
		'front-page-2',
		array(
			'before' => '<div id="front-page-2" class="front-page-2" tabindex="-1"><div class="solid-section"><div class="flexible-widgets widget-area' . altitude_widget_area_class( 'front-page-2' ) . '"><div class="wrap">',
			'after'  => '</div></div></div></div>',
		)
	);

	genesis_widget_area(
		'front-page-3',
		array(
			'before' => '<div id="front-page-3" class="front-page-3" tabindex="-1"><div class="image-section"><div class="flexible-widgets widget-area' . altitude_widget_area_class( 'front-page-3' ) . '"><div class="wrap">',
			'after'  => '</div></div></div></div>',
		)
	);

	genesis_widget_area(
		'front-page-4',
		array(
			'before' => '<div id="front-page-4" class="front-page-4" tabindex="-1"><div class="solid-section"><div class="flexible-widgets widget-area' . altitude_widget_area_class( 'front-page-4' ) . '"><div class="wrap">',
			'after'  => '</div></div></div></div>',
		)
	);

	genesis_widget_area(
		'front-page-5',
		array(
			'before' => '<div id="front-page-5" class="front-page-5" tabindex="-1"><div class="image-section"><div class="flexible-widgets widget-area' . altitude_widget_area_class( 'front-page-5' ) . '"><div class="wrap">',
			'after'  => '</div></div></div></div>',
		)
	);

	genesis_widget_area(
		'front-page-6',
		array(
			'before' => '<div id="front-page-6" class="front-page-6" tabindex="-1"><div class="solid-section"><div class="flexible-widgets widget-area' . altitude_widget_area_class( 'front-page-6' ) . '"><div class="wrap">',
			'after'  => '</div></div></div></div>',
		)
	);

	genesis_widget_area(
		'front-page-7',
		array(
			'before' => '<div id="front-page-7" class="front-page-7" tabindex="-1"><div class="image-section"><div class="flexible-widgets widget-area' . altitude_widget_area_class( 'front-page-7' ) . '"><div class="wrap">',
			'after'  => '</div></div></div></div>',
		)
	);

}

// Runs the Genesis loop.
genesis();
