<?php
/**
 * FiveTwoFive Child Theme Functions
 *
 * This file contains the main functions for the FiveTwoFive child theme.
 * It handles style and script enqueuing, including GSAP animations.
 *
 * @package FiveTwoFive
 * @subpackage FiveTwoFive_Child
 * @since 1.1.0
 */

/**
 * Enqueue child theme styles and scripts
 *
 * This function handles:
 * 1. Child theme stylesheet enqueuing
 * 2. SASS-generated styles
 * 3. GSAP library and plugins
 * 4. Custom animation scripts
 *
 * @since 1.0.0
 * @since 1.1.0 Added GSAP and animation scripts
 */
add_action( 'wp_enqueue_scripts', 'fivetwofive_child_enqueue_styles' );
function fivetwofive_child_enqueue_styles() {
    $parenthandle = 'fivetwofive-theme';
    $theme        = wp_get_theme();

    // Enqueue main child theme stylesheet
    wp_enqueue_style( 
        'fivetwofive-theme-child', 
        get_stylesheet_uri(), 
        array(), 
        $theme->parent()->get( 'Version' ) 
    );

    // Enqueue SASS-generated styles
    wp_enqueue_style( 
        'fivetwofive-theme-child-sass',
        get_stylesheet_directory_uri() . '/assets/dist/css/style.css', 
        array(),  
        $theme->parent()->get( 'Version' )
    );

    // Enqueue child theme styles with parent dependency
    wp_enqueue_style( 
        'fivetwofive-theme-child-style',
        get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get( 'Version' ) // Uses version from style header
    );

    // Enqueue GSAP core library
    wp_enqueue_script(
        'gsap',
        get_stylesheet_directory_uri() . '/node_modules/gsap/dist/gsap.min.js',
        array(), // No dependencies
        '3.12.7',
        true    // Load in footer
    );

    // Enqueue GSAP ScrollTrigger plugin
    wp_enqueue_script(
        'gsap-scrolltrigger',
        get_stylesheet_directory_uri() . '/node_modules/gsap/dist/ScrollTrigger.min.js',
        array('gsap'), // Depends on GSAP core
        '3.12.7',
        true
    );

    // Register ScrollTrigger plugin with GSAP
    wp_add_inline_script(
        'gsap-scrolltrigger', 
        'gsap.registerPlugin(ScrollTrigger);', 
        'after'
    );

    // Enqueue custom animations
    wp_enqueue_script(
        'fivetwofive-animations',
        get_stylesheet_directory_uri() . '/assets/dist/js/animations.js',
        array('gsap'), // Depends on GSAP core
        $theme->get('Version'),
        true
    );
}