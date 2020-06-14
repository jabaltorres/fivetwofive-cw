<?php
/**
 * Gutenberg theme support.
 *
 * @package Altitude Pro
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/altitude/
 */

add_action( 'wp_enqueue_scripts', 'altitude_pro_enqueue_gutenberg_frontend_styles' );
/**
 * Enqueues Gutenberg front-end styles.
 *
 * @since 1.2.0
 */
function altitude_pro_enqueue_gutenberg_frontend_styles() {

	$child_theme_slug = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'altitude-pro';

	wp_enqueue_style(
		'altitude-pro-gutenberg',
		get_stylesheet_directory_uri() . '/lib/gutenberg/front-end.css',
		array( $child_theme_slug ),
		CHILD_THEME_VERSION
	);

}

add_action( 'enqueue_block_editor_assets', 'altitude_pro_block_editor_styles' );
/**
 * Enqueues Gutenberg admin editor fonts and styles.
 *
 * @since 1.2.0
 */
function altitude_pro_block_editor_styles() {

	$block_editor_settings = genesis_get_config( 'block-editor-settings' );

	wp_enqueue_style(
		'altitude-gutenberg-fonts',
		$block_editor_settings['admin-fonts-url'],
		array(),
		CHILD_THEME_VERSION
	);

}

add_theme_support( 'editor-styles' );

add_editor_style( '/lib/gutenberg/style-editor.css' );

add_theme_support( 'align-wide' );

add_theme_support( 'responsive-embeds' );

$altitude_block_editor_settings = genesis_get_config( 'block-editor-settings' );

add_theme_support( 'editor-font-sizes', $altitude_block_editor_settings['editor-font-sizes'] );

add_theme_support( 'editor-color-palette', $altitude_block_editor_settings['editor-color-palette'] );

require_once get_stylesheet_directory() . '/lib/gutenberg/inline-styles.php';

add_action( 'after_setup_theme', 'altitude_pro_content_width', 0 );
/**
 * Sets content width to match the “wide” Gutenberg block width.
 */
function altitude_pro_content_width() {

	$block_editor_settings = genesis_get_config( 'block-editor-settings' );

	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- See https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/924
	$GLOBALS['content_width'] = apply_filters( 'altitude_pro_content_width', $block_editor_settings['content-width'] );

}
