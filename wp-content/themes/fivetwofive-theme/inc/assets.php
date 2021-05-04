<?php
/**
 * Define all the assets related functions here.
 *
 * @package FiveTwoFive_Theme
 */

/**
 * Enqueue scripts and styles.
 */
function fivetwofive_theme_scripts() {
	wp_enqueue_style( 'fivetwofive-theme-fonts', 'https://fonts.googleapis.com/css2?family=Anton&family=Roboto:ital@0;1&display=swap', array(), FIVETWOFIVE_THEME_VERSION );
	wp_enqueue_style( 'fivetwofive-theme-style', get_stylesheet_uri(), array( 'fivetwofive-theme-fonts' ), FIVETWOFIVE_THEME_VERSION );

	wp_enqueue_script( 'fivetwofive-theme-navigation', get_template_directory_uri() . '/assets/dist/js/navigation.js', array(), FIVETWOFIVE_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fivetwofive_theme_scripts' );

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
