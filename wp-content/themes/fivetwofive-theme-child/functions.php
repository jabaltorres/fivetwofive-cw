<?php
add_action( 'wp_enqueue_scripts', 'fivetwofive_child_enqueue_styles' );
function fivetwofive_child_enqueue_styles() {
    $parenthandle = 'fivetwofive-theme';
    $theme        = wp_get_theme();

    wp_enqueue_style( 'fivetwofive-theme-child', get_stylesheet_uri(), array(), $theme->parent()->get( 'Version' ) );

    wp_enqueue_style( 'fivetwofive-theme-child-sass',
        get_stylesheet_directory_uri() . '/assets/dist/css/style.css', array(),  $theme->parent()->get( 'Version' )
    );

    wp_enqueue_style( 'fivetwofive-theme-child-style',
        get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get( 'Version' ) // This only works if you have Version defined in the style header.
    );

    // Enqueue GSAP
    wp_enqueue_script(
        'gsap',
        get_stylesheet_directory_uri() . '/node_modules/gsap/dist/gsap.min.js',
        array(),
        '3.12.7',
        true
    );

    // Enqueue custom animations
    wp_enqueue_script(
        'fivetwofive-animations',
        get_stylesheet_directory_uri() . '/assets/dist/js/animations.js',
        array('gsap'),
        $theme->get('Version'),
        true
    );
}