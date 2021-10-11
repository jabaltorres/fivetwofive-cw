<?php
/**
 * All Widgets related code is defined here.
 *
 * @package FiveTwoFive_Theme
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fivetwofive_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'fivetwofive-theme' ),
			'id'            => 'primary-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'fivetwofive-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets', 'fivetwofive-theme' ),
			'id'            => 'footer-widgets',
			'description'   => esc_html__( 'Add widgets here.', 'fivetwofive-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
		)
	);
}
add_action( 'widgets_init', 'fivetwofive_theme_widgets_init' );
