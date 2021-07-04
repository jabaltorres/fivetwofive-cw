<?php
/**
 * Block Editor settings specific to Altitude Pro.
 *
 * @package Altitude Pro
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/altitude/
 */

$altitude_link_color            = get_theme_mod( 'altitude_link_color', altitude_customizer_get_default_link_color() );
$altitude_link_color_contrast   = altitude_color_contrast( $altitude_link_color );
$altitude_link_color_brightness = altitude_color_brightness( $altitude_link_color, 35 );

return array(
	'admin-fonts-url'              => 'https://fonts.googleapis.com/css?family=Ek+Mukta:200,800',
	'content-width'                => 1060,
	'default-button-bg'            => $altitude_link_color,
	'default-button-color'         => $altitude_link_color_contrast,
	'default-button-outline-hover' => $altitude_link_color_brightness,
	'default-link-color'           => $altitude_link_color,
	'editor-color-palette'         => array(
		array(
			'name'  => __( 'Custom color', 'altitude-pro' ), // Called “Link Color” in the Customizer options.
			'slug'  => 'theme-primary',
			'color' => get_theme_mod( 'altitude_link_color', altitude_customizer_get_default_link_color() ),
		),
		array(
			'name'  => __( 'Accent color', 'altitude-pro' ),
			'slug'  => 'theme-secondary',
			'color' => get_theme_mod( 'altitude_accent_color', altitude_customizer_get_default_accent_color() ),
		),
	),
	'editor-font-sizes'            => array(
		array(
			'name' => __( 'Small', 'altitude-pro' ),
			'size' => 16,
			'slug' => 'small',
		),
		array(
			'name' => __( 'Normal', 'altitude-pro' ),
			'size' => 20,
			'slug' => 'normal',
		),
		array(
			'name' => __( 'Large', 'altitude-pro' ),
			'size' => 24,
			'slug' => 'large',
		),
		array(
			'name' => __( 'Larger', 'altitude-pro' ),
			'size' => 28,
			'slug' => 'larger',
		),
	),
);
