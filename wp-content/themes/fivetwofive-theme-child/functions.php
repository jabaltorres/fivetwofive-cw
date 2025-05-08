<?php
/**
 * FiveTwoFive Child Theme Functions
 *
 * @package FiveTwoFive
 * @subpackage FiveTwoFive_Child
 * @since 1.1.0
 */

/**
 * Enqueue child theme styles and GSAP scripts
 *
 * This function handles:
 * - SASS-generated child styles
 * - GSAP library and plugins
 * - Custom animation scripts
 */
add_action( 'wp_enqueue_scripts', 'fivetwofive_child_enqueue_assets' );
function fivetwofive_child_enqueue_assets() {
    $theme = wp_get_theme();

    // Enqueue child theme style.css (for metadata and light overrides)
    wp_enqueue_style(
        'fivetwofive-theme-style',
        get_stylesheet_uri(),
        array( 'fivetwofive-theme-main', 'fivetwofive-theme-template-module' ),
        $theme->get( 'Version' )
    );

    // Enqueue compiled SASS stylesheet, dependent on child theme style.css
    wp_enqueue_style(
        'fivetwofive-theme-child-sass',
        get_stylesheet_directory_uri() . '/assets/dist/css/style.css',
        array( 'fivetwofive-theme-style' ),
        $theme->get( 'Version' )
    );

    // Enqueue GSAP core library
    wp_enqueue_script(
        'gsap',
        get_stylesheet_directory_uri() . '/assets/dist/js/vendor/gsap.min.js',
        array(),
        '3.12.7',
        true
    );

    // Enqueue GSAP ScrollTrigger plugin
    wp_enqueue_script(
        'gsap-scrolltrigger',
        get_stylesheet_directory_uri() . '/assets/dist/js/vendor/ScrollTrigger.min.js',
        array( 'gsap' ),
        '3.12.7',
        true
    );

    // Register ScrollTrigger plugin with GSAP
    wp_add_inline_script(
        'gsap-scrolltrigger',
        'gsap.registerPlugin(ScrollTrigger);',
        'after'
    );

    // Enqueue custom animation scripts
    wp_enqueue_script(
        'fivetwofive-animations',
        get_stylesheet_directory_uri() . '/assets/dist/js/animations.js',
        array( 'gsap', 'gsap-scrolltrigger' ),
        $theme->get( 'Version' ),
        true
    );
}