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
}