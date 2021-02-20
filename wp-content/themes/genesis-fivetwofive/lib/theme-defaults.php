<?php
/**
 * Genesis FiveTwoFive.
 *
 * This file adds the default theme settings to the Genesis FiveTwoFive Theme.
 *
 * @package Genesis FiveTwoFive
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

add_filter( 'simple_social_default_styles', 'genesis_fivetwofive_social_default_styles' );
/**
 * Set Simple Social Icon defaults.
 *
 * @since 1.0.0
 *
 * @param array $defaults Social style defaults.
 * @return array Modified social style defaults.
 */
function genesis_fivetwofive_social_default_styles( $defaults ) {

	$args = genesis_get_config( 'simple-social-icons-settings' );

	return wp_parse_args( $args, $defaults );

}
