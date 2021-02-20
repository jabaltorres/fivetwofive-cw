<?php
/**
 * Genesis FiveTwoFive appearance settings.
 *
 * @package Genesis FiveTwoFive
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

$genesis_fivetwofive_default_colors = [
	'link'   => '#0073e5',
	'accent' => '#0073e5',
];

$genesis_fivetwofive_link_color = get_theme_mod(
	'genesis_fivetwofive_link_color',
	$genesis_fivetwofive_default_colors['link']
);

$genesis_fivetwofive_accent_color = get_theme_mod(
	'genesis_fivetwofive_accent_color',
	$genesis_fivetwofive_default_colors['accent']
);

$genesis_fivetwofive_link_color_contrast   = genesis_fivetwofive_color_contrast( $genesis_fivetwofive_link_color );
$genesis_fivetwofive_link_color_brightness = genesis_fivetwofive_color_brightness( $genesis_fivetwofive_link_color, 35 );

return [
	'fonts-url'            => 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,700&display=swap',
	'content-width'        => 1062,
	'button-bg'            => $genesis_fivetwofive_link_color,
	'button-color'         => $genesis_fivetwofive_link_color_contrast,
	'button-outline-hover' => $genesis_fivetwofive_link_color_brightness,
	'link-color'           => $genesis_fivetwofive_link_color,
	'default-colors'       => $genesis_fivetwofive_default_colors,
	'editor-color-palette' => [
		[
			'name'  => __( 'Custom color', 'genesis-fivetwofive' ), // Called “Link Color” in the Customizer options. Renamed because “Link Color” implies it can only be used for links.
			'slug'  => 'theme-primary',
			'color' => $genesis_fivetwofive_link_color,
		],
		[
			'name'  => __( 'Accent color', 'genesis-fivetwofive' ),
			'slug'  => 'theme-secondary',
			'color' => $genesis_fivetwofive_accent_color,
		],
	],
	'editor-font-sizes'    => [
		[
			'name' => __( 'Small', 'genesis-fivetwofive' ),
			'size' => 12,
			'slug' => 'small',
		],
		[
			'name' => __( 'Normal', 'genesis-fivetwofive' ),
			'size' => 18,
			'slug' => 'normal',
		],
		[
			'name' => __( 'Large', 'genesis-fivetwofive' ),
			'size' => 20,
			'slug' => 'large',
		],
		[
			'name' => __( 'Larger', 'genesis-fivetwofive' ),
			'size' => 24,
			'slug' => 'larger',
		],
	],
];
