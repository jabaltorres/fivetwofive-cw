<?php
/**
 * Altitude Pro.
 *
 * This file adds the functions to the Altitude Pro Theme.
 *
 * @package Altitude Pro
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/altitude/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Defines the child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Altitude Pro' );
define( 'CHILD_THEME_URL', 'https://my.studiopress.com/themes/altitude/' );
define( 'CHILD_THEME_VERSION', '1.2.2' );

// Sets up theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'altitude_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function altitude_localization_setup() {
	load_child_theme_textdomain( 'altitude-pro', get_stylesheet_directory() . '/languages' );
}

// Adds the theme helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds Image upload and Color select to WordPress Theme Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Includes the WooCommerce setup functions.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Includes the WooCommerce custom CSS if customized.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Includes notice to install Genesis Connect for WooCommerce.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * @since 1.2.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

add_action( 'wp_enqueue_scripts', 'altitude_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function altitude_enqueue_scripts_styles() {

	wp_enqueue_script(
		'altitude-global',
		get_stylesheet_directory_uri() . '/js/global.js',
		array( 'jquery' ),
		'1.0.0',
		true
	);

	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style(
		'altitude-google-fonts',
		'https://fonts.googleapis.com/css?family=Ek+Mukta:200,800',
		array(),
		CHILD_THEME_VERSION
	);

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script(
		'altitude-responsive-menu',
		get_stylesheet_directory_uri() . '/js/responsive-menus' . $suffix . '.js',
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

	wp_localize_script(
		'altitude-responsive-menu',
		'genesis_responsive_menu',
		altitude_responsive_menu_settings()
	);

}

/**
 * Defines responsive menu settings.
 *
 * @since 1.1.0
 */
function altitude_responsive_menu_settings() {

	$settings = array(
		'mainMenu'    => __( 'Menu', 'altitude-pro' ),
		'subMenu'     => __( 'Submenu', 'altitude-pro' ),
		'menuClasses' => array(
			'combine' => array(
				'.nav-primary',
				'.nav-secondary',
			),
		),
	);

	return $settings;

}

// Adds HTML5 markup structure.
add_theme_support( 'html5', genesis_get_config( 'html5' ) );

// Adds Accessibility support.
add_theme_support( 'genesis-accessibility', genesis_get_config( 'accessibility' ) );

// Adds viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Adds new image sizes.
add_image_size( 'featured-page', 1140, 400, true );

// Adds support for 1-column footer widget area.
add_theme_support( 'genesis-footer-widgets', 1 );

// Adds support for footer menu.
add_theme_support( 'genesis-menus', genesis_get_config( 'menus' ) );

// Unregisters the header right widget area.
unregister_sidebar( 'header-right' );

// Repositions the primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Removes output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );


add_action( 'genesis_theme_settings_metaboxes', 'altitude_remove_genesis_metaboxes' );
/**
 * Removes output of unused admin settings metaboxes.
 *
 * @since 1.0.3
 *
 * @param string $_genesis_admin_settings The admin screen to remove meta boxes from.
 */
function altitude_remove_genesis_metaboxes( $_genesis_admin_settings ) {
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_admin_settings, 'main' );
}

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_header', 'genesis_do_subnav', 5 );

add_filter( 'genesis_skip_links_output', 'altitude_skip_links_output' );
/**
 * Removes skip link for primary navigation and adds a skip link for footer widgets.
 *
 * @since 1.1.0
 *
 * @param array $links The list of skip links.
 * @return array The modified list of skip links.
 */
function altitude_skip_links_output( $links ) {

	if ( isset( $links['genesis-nav-primary'] ) ) {
		unset( $links['genesis-nav-primary'] );
	}

	return $links;

}

add_filter( 'body_class', 'altitude_secondary_nav_class' );
/**
 * Adds secondary-nav class if secondary navigation is used.
 *
 * @since 1.0.0
 *
 * @param array $classes Original body classes.
 * @return array Modified body classes.
 */
function altitude_secondary_nav_class( $classes ) {

	$menu_locations = get_theme_mod( 'nav_menu_locations' );

	if ( ! empty( $menu_locations['secondary'] ) ) {
		$classes[] = 'secondary-nav';
	}

	return $classes;

}

add_action( 'genesis_footer', 'altitude_footer_menu', 7 );
/**
 * Hooks footer menu in footer.
 *
 * @since 1.1.0
 */
function altitude_footer_menu() {

	genesis_nav_menu(
		array(
			'theme_location' => 'footer',
			'container'      => false,
			'depth'          => 1,
			'fallback_cb'    => false,
			'menu_class'     => 'genesis-nav-menu',
		)
	);

}

// Adds Attributes for Footer Navigation.
add_filter( 'genesis_attr_nav-footer', 'genesis_attributes_nav' );

// Unregisters layout settings.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Unregisters secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Adds support for custom header.
add_theme_support( 'custom-header', genesis_get_config( 'custom-header' ) );

// Adds support for structural wraps.
add_theme_support( 'genesis-structural-wraps', genesis_get_config( 'structural-wraps' ) );

add_filter( 'genesis_author_box_gravatar_size', 'altitude_author_box_gravatar' );
/**
 * Modifies the size of the Gravatar in the author box.
 *
 * @since 1.0.0
 *
 * @return int The new author box Gravatar size.
 */
function altitude_author_box_gravatar() {
	return 176;
}

add_filter( 'genesis_comment_list_args', 'altitude_comments_gravatar' );
/**
 * Modifies the size of the Gravatar in the entry comments.
 *
 * @since 1.0.0
 *
 * @param array $args Comment list arguments.
 * @return array Comment list arguments with modified avatar size.
 */
function altitude_comments_gravatar( $args ) {

	$args['avatar_size'] = 120;

	return $args;

}

// Adds support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Relocates after entry widget.
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

/**
 * Counts widgets in given sidebar.
 *
 * @since 1.0.0
 *
 * @param string $id The id of the widget area.
 * @return void|int The number of widgets, or nothing.
 */
function altitude_count_widgets( $id ) {

	$sidebars_widgets = wp_get_sidebars_widgets();

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}

}

/**
 * Gets class name for widget areas based on widget count.
 *
 * Used by front-page.php.
 *
 * @since 1.0.0
 *
 * @param string $id The ID of the widget area.
 * @return string The class name to use based on the widget count.
 */
function altitude_widget_area_class( $id ) {

	$count = altitude_count_widgets( $id );

	$class = '';

	if ( 1 === $count ) {
		$class .= ' widget-full';
	} elseif ( 1 === $count % 3 ) {
		$class .= ' widget-thirds';
	} elseif ( 1 === $count % 4 ) {
		$class .= ' widget-fourths';
	} elseif ( 0 === $count % 2 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves';
	}

	return $class;

}

// Relocates the post info.
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_post_info', 5 );

add_filter( 'genesis_post_info', 'altitude_post_info_filter' );
/**
 * Modifies the entry meta in the entry header.
 *
 * @since 1.0.0
 *
 * @return string New post info.
 */
function altitude_post_info_filter() {

	return '[post_date format="M d Y"] [post_edit]';

}

add_filter( 'genesis_post_meta', 'altitude_post_meta_filter' );
/**
 * Modifies the entry meta in the entry footer.
 *
 * @return string The new entry meta.
 */
function altitude_post_meta_filter() {

	return 'Written by [post_author_posts_link] [post_categories before=" &middot; Categorized: "]  [post_tags before=" &middot; Tagged: "]';

}

// Registers widget areas.
genesis_register_sidebar(
	array(
		'id'          => 'front-page-1',
		'name'        => __( 'Front Page 1', 'altitude-pro' ),
		'description' => __( 'This is the front page 1 section.', 'altitude-pro' ),
	)
);
genesis_register_sidebar(
	array(
		'id'          => 'front-page-2',
		'name'        => __( 'Front Page 2', 'altitude-pro' ),
		'description' => __( 'This is the front page 2 section.', 'altitude-pro' ),
	)
);
genesis_register_sidebar(
	array(
		'id'          => 'front-page-3',
		'name'        => __( 'Front Page 3', 'altitude-pro' ),
		'description' => __( 'This is the front page 3 section.', 'altitude-pro' ),
	)
);
genesis_register_sidebar(
	array(
		'id'          => 'front-page-4',
		'name'        => __( 'Front Page 4', 'altitude-pro' ),
		'description' => __( 'This is the front page 4 section.', 'altitude-pro' ),
	)
);
genesis_register_sidebar(
	array(
		'id'          => 'front-page-5',
		'name'        => __( 'Front Page 5', 'altitude-pro' ),
		'description' => __( 'This is the front page 5 section.', 'altitude-pro' ),
	)
);
genesis_register_sidebar(
	array(
		'id'          => 'front-page-6',
		'name'        => __( 'Front Page 6', 'altitude-pro' ),
		'description' => __( 'This is the front page 6 section.', 'altitude-pro' ),
	)
);
genesis_register_sidebar(
	array(
		'id'          => 'front-page-7',
		'name'        => __( 'Front Page 7', 'altitude-pro' ),
		'description' => __( 'This is the front page 7 section.', 'altitude-pro' ),
	)
);
