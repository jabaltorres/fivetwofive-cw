<?php
/**
 * FiveTwoFive Theme Theme Customizer
 *
 * @package FiveTwoFive_Theme
 */

// SVG ICONS.
require get_template_directory() . '/classes/class-fivetwofive-theme-svg-icons.php';
new Fivetwofive_Theme_SVG_Icons();

/**
 * Detects the social network from a URL and returns the SVG code for its icon.
 *
 * @since FiveTwoFive Theme 1.0
 *
 * @param string $uri Social link.
 * @param int    $size The icon size in pixels.
 *
 * @return string
 */
function fivetwofive_theme_get_social_link_svg( $uri, $size = 24 ) {
	return Fivetwofive_Theme_SVG_Icons::get_social_link_svg( $uri, $size );
}

/**
 * Gets the SVG code for a given icon.
 *
 * @since FiveTwoFive Theme 1.0
 *
 * @param string $group The icon group, social or ui.
 * @param string $icon The icon name depending on the group.
 * @param int    $size The icon size in pixels.
 *
 * @return string
 */
function fivetwofive_theme_get_icon_svg( $group, $icon, $size = 24 ) {
	return Fivetwofive_Theme_SVG_Icons::get_svg( $group, $icon, $size );
}

/**
 * Embed shortcode in modules content through shortcode.
 *
 * @param array $a fivetwofive_theme_get_icon_svg parameters.
 * @uses fivetwofive_theme_get_icon_svg()
 * @return string SVG icon.
 */
function fivetwofive_icon_shortcode_func( $a ) {
	$atts = shortcode_atts(
		array(
			'group' => 'ui',
			'icon'  => 'close',
			'size'  => 30,
		),
		$a
	);

	return fivetwofive_theme_get_icon_svg( $atts['group'], $atts['icon'], $atts['size'] );
}
add_shortcode( 'fivetwofive_icon', 'fivetwofive_icon_shortcode_func' );
