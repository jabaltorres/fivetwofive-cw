<?php
/**
 * Altitude Pro.
 *
 * This file adds the required WooCommerce setup functions to the Altitude Pro Theme.
 *
 * @package Altitude Pro
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/altitude/
 */

// Adds product gallery support.
if ( class_exists( 'WooCommerce' ) ) {

	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'wc-product-gallery-zoom' );

}

add_action( 'wp_enqueue_scripts', 'altitude_products_match_height', 99 );
/**
 * Prints an inline script to the footer to keep products the same height.
 *
 * @since 1.1.0
 */
function altitude_products_match_height() {

	// If WooCommerce is not activated, or a product isn't showing, exit early.
	if ( ! class_exists( 'WooCommerce' ) || ( ! is_shop() && ! is_woocommerce() && ! is_cart() ) ) {
		return;
	}

	wp_enqueue_script(
		'altitude-match-height',
		get_stylesheet_directory_uri() . '/js/jquery.matchHeight.min.js',
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

	wp_add_inline_script(
		'altitude-match-height',
		"jQuery(document).ready( function() { jQuery( '.product .woocommerce-LoopProduct-link').matchHeight(); });"
	);

}

add_filter( 'genesiswooc_default_products_per_page', 'altitude_default_products_per_page' );
/**
 * Sets the shop default products per page count.
 *
 * @since 1.1.0
 *
 * @return int Number of products per page.
 */
function altitude_default_products_per_page() {
	return 8;
}

add_filter( 'loop_shop_columns', 'altitude_product_archive_columns' );
/**
 * Modifies the default WooCommerce column count for product thumbnails.
 *
 * @since 1.1.0
 *
 * @return int Number of columns for product archives.
 */
function altitude_product_archive_columns() {

	$current = genesis_site_layout();
	$layouts = array(
		'content-sidebar',
		'sidebar-content',
	);

	if ( in_array( $current, $layouts, true ) ) {
		return 3;
	} else {
		return 4;
	}

}

add_filter( 'woocommerce_pagination_args', 'altitude_woocommerce_pagination' );
/**
 * Updates the next and previous arrows to the default Genesis style.
 *
 * @since 1.1.0
 *
 * @param array $args The previous and next text strings.
 * @return array New next and previous text strings.
 */
function altitude_woocommerce_pagination( $args ) {

	$args['prev_text'] = sprintf( '&laquo; %s', __( 'Previous Page', 'altitude-pro' ) );
	$args['next_text'] = sprintf( '%s &raquo;', __( 'Next Page', 'altitude-pro' ) );

	return $args;

}

add_action( 'after_switch_theme', 'altitude_woocommerce_image_dimensions_after_theme_setup', 1 );
/**
 * Defines WooCommerce image sizes on theme activation.
 *
 * @since 1.1.0
 */
function altitude_woocommerce_image_dimensions_after_theme_setup() {

	global $pagenow;

	if ( ! isset( $_GET['activated'] ) || 'themes.php' !== $pagenow || ! class_exists( 'WooCommerce' ) ) { // phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification -- low risk, follows official snippet at https://goo.gl/nnHHQa.
		return;
	}

	altitude_update_woocommerce_image_dimensions();

}

add_action( 'activated_plugin', 'altitude_woocommerce_image_dimensions_after_woo_activation', 10, 2 );
/**
 * Defines the WooCommerce image sizes on WooCommerce activation.
 *
 * @since 1.1.0
 *
 * @param string $plugin The path of the plugin being activated.
 */
function altitude_woocommerce_image_dimensions_after_woo_activation( $plugin ) {

	// Checks to see if WooCommerce is being activated.
	if ( 'woocommerce/woocommerce.php' !== $plugin ) {
		return;
	}

	altitude_update_woocommerce_image_dimensions();

}

/**
 * Updates WooCommerce image dimensions.
 *
 * @since 1.1.0
 */
function altitude_update_woocommerce_image_dimensions() {

	// Updates image size options.
	update_option( 'woocommerce_single_image_width', 700 );    // Single product image.
	update_option( 'woocommerce_thumbnail_image_width', 550 ); // Catalog image.

	// Updates image cropping option.
	update_option( 'woocommerce_thumbnail_cropping', '1:1' );

}

add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'altitude_gallery_image_thumbnail' );
/**
 * Filters the WooCommerce gallery image dimensions.
 *
 * @since 1.2.0
 *
 * @param array $size The gallery image size and crop arguments.
 * @return array The modified gallery image size and crop arguments.
 */
function altitude_gallery_image_thumbnail( $size ) {

	$size = array(
		'width'  => 180,
		'height' => 180,
		'crop'   => 1,
	);

	return $size;

}
