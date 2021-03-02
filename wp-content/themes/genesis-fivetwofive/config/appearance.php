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
	'fonts-url'            => 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@700&family=Roboto:ital@0;1&display=swap',
	'content-width'        => 1200,
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
		[
			'name'  => __( 'Mirage', 'genesis-fivetwofive' ),
			'slug'  => 'mirage',
			'color' => '#1A2238',
		],
		[
			'name'  => __( 'Supernova', 'genesis-fivetwofive' ),
			'slug'  => 'supernova',
			'color' => '#FFCB05',
		],
		[
			'name'  => __( 'Radical Red', 'genesis-fivetwofive' ),
			'slug'  => 'radical-red',
			'color' => '#F53868',
		],
		[
			'name'  => __( 'Caribbean Green', 'genesis-fivetwofive' ),
			'slug'  => 'caribbean-green',
			'color' => '#00C483',
		],
		[
			'name'  => __( 'Downriver', 'genesis-fivetwofive' ),
			'slug'  => 'downriver',
			'color' => '#082C4E',
		],
		[
			'name'  => __( 'Azure Radiance', 'genesis-fivetwofive' ),
			'slug'  => 'azure-radiance',
			'color' => '#0088FE',
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
			'size' => 16,
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
		[
			'name' => __( 'Extra Large', 'genesis-fivetwofive' ),
			'size' => 48,
			'slug' => 'extra-large',
		],
	],
];
