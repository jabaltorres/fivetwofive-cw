<?php
/**
 * This file adds functions to the Fivetwofive WordPress theme.
 *
 * @package Fivetwofive
 * @author  WP Engine
 * @license GNU General Public License v2 or later
 * @link    https://fivetwofivewp.com/
 */

if ( ! function_exists( 'fivetwofive_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since 0.8.0
	 *
	 * @return void
	 */
	function fivetwofive_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'fivetwofive', get_template_directory() . '/languages' );

		// Enqueue editor styles and fonts.
		add_editor_style(
			array(
				'./style.css',
			)
		);

		// Remove core block patterns.
		remove_theme_support( 'core-block-patterns' );

	}
}
add_action( 'after_setup_theme', 'fivetwofive_setup' );

// Enqueue style sheet.
add_action( 'wp_enqueue_scripts', 'fivetwofive_enqueue_style_sheet' );
function fivetwofive_enqueue_style_sheet() {

	wp_enqueue_style( 'fivetwofive', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );

}

/**
 * Register block styles.
 *
 * @since 0.9.2
 */
function fivetwofive_register_block_styles() {
	/**
	 * prefix block styles with "button" if the element is
	 * adds the block style classes directly to the element's class
	 * to make sure that button styles are applied correctly.
	 * e.g. .wp-block-read-more.is-style-button-[variation]
	**/

	$block_styles = array(
		'core/button'          => array(
			'fill-base'    => __( 'Fill Base', 'fivetwofive' ),
			'outline-base' => __( 'Outline Base', 'fivetwofive' ),
		),
		'core/group'           => array(
			'full-height' => __( 'Full-height', 'fivetwofive' )
		),
		'core/list'            => array(
			'no-disc' => __( 'No Disc', 'fivetwofive' ),
		),
		'core/navigation-link' => array(
			'outline'      => __( 'Outline', 'fivetwofive' ),
			'fill-primary' => __( 'Fill Primary', 'fivetwofive' ),
		),
		'core/read-more'           => array(
			'button-outline' => __( 'Outline', 'fivetwofive' ),
			'button-fill' => __( 'Fill', 'fivetwofive' ),
		),
	);

	foreach ( $block_styles as $block => $styles ) {
		foreach ( $styles as $style_name => $style_label ) {
			register_block_style(
				$block,
				array(
					'name'  => $style_name,
					'label' => $style_label,
				)
			);
		}
	}
}
add_action( 'init', 'fivetwofive_register_block_styles' );

/**
 * Registers block categories, and type.
 *
 * @since 0.9.2
 */
function fivetwofive_register_block_pattern_categories() {

	/* Functionality specific to the Block Pattern Explorer plugin. */
	if ( function_exists( 'register_block_pattern_category_type' ) ) {
		register_block_pattern_category_type( 'fivetwofive', array( 'label' => __( 'Fivetwofive', 'fivetwofive' ) ) );
	}

	$block_pattern_categories = array(
		'fivetwofive-footer'  => array(
			'label'         => __( 'Footer', 'fivetwofive' ),
			'categoryTypes' => array( 'fivetwofive' ),
		),
		'fivetwofive-general' => array(
			'label'         => __( 'General', 'fivetwofive' ),
			'categoryTypes' => array( 'fivetwofive' ),
		),
		'fivetwofive-header'  => array(
			'label'         => __( 'Header', 'fivetwofive' ),
			'categoryTypes' => array( 'fivetwofive' ),
		),
		'fivetwofive-page'    => array(
			'label'         => __( 'Page', 'fivetwofive' ),
			'categoryTypes' => array( 'fivetwofive' ),
		),
		'fivetwofive-query'   => array(
			'label'         => __( 'Query', 'fivetwofive' ),
			'categoryTypes' => array( 'fivetwofive' ),
		),
	);

	foreach ( $block_pattern_categories as $name => $properties ) {
		register_block_pattern_category( $name, $properties );
	}
}
add_action( 'init', 'fivetwofive_register_block_pattern_categories', 9 );

/**
 * @return void
 */
function fivetwofive_enqueue_block_styles() {
	// Add the block name (with namespace) for each style.
	$blocks = array(
		'core/button',
		'core/table',
		'core/spacer',
		'core/separator',
        'core/navigation',
		'core/read-more',
		'core/quote',
    );

    // Loop through each block and enqueue its styles.
    foreach ( $blocks as $block ) {

	    // Replace slash with hyphen for filename.
	    $slug = str_replace( '/', '-', $block );

	    wp_enqueue_block_style( $block, array(
		    'handle' => "fivetwofive-block-{$slug}",
		    'src'    => get_theme_file_uri( "assets/blocks/{$slug}.css" ),
		    'path'   => get_theme_file_path( "assets/blocks/{$slug}.css" )
	    ) );
    }
}
add_action( 'init', 'fivetwofive_enqueue_block_styles' );

/**
 * Change post excerpt more text.
 *
 * @return string
 */
function fivetwofive_excerpt_more() {
	return '&hellip;';
}
add_filter('excerpt_more', 'fivetwofive_excerpt_more');