<?php
/**
 * Genesis FiveTwoFive.
 *
 * This file adds the Customizer additions to the Genesis FiveTwoFive Theme.
 *
 * @package Genesis FiveTwoFive
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

add_action( 'customize_register', 'genesis_fivetwofive_customizer_register' );
/**
 * Registers settings and controls with the Customizer.
 *
 * @since 2.2.3
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function genesis_fivetwofive_customizer_register( $wp_customize ) {

	$appearance = genesis_get_config( 'appearance' );

	$wp_customize->add_setting(
		'genesis_fivetwofive_link_color',
		[
			'default'           => $appearance['default-colors']['link'],
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_fivetwofive_link_color',
			[
				'description' => __( 'Change the color of post info links and button blocks, the hover color of linked titles and menu items, and more.', 'genesis-fivetwofive' ),
				'label'       => __( 'Link Color', 'genesis-fivetwofive' ),
				'section'     => 'colors',
				'settings'    => 'genesis_fivetwofive_link_color',
			]
		)
	);

	$wp_customize->add_setting(
		'genesis_fivetwofive_accent_color',
		[
			'default'           => $appearance['default-colors']['accent'],
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_fivetwofive_accent_color',
			[
				'description' => __( 'Change the default hover color for button links, menu buttons, and submit buttons. The button block uses the Link Color.', 'genesis-fivetwofive' ),
				'label'       => __( 'Accent Color', 'genesis-fivetwofive' ),
				'section'     => 'colors',
				'settings'    => 'genesis_fivetwofive_accent_color',
			]
		)
	);

	$wp_customize->add_setting(
		'genesis_fivetwofive_logo_width',
		[
			'default'           => 50,
			'sanitize_callback' => 'absint',
			'validate_callback' => 'genesis_fivetwofive_validate_logo_width',
		]
	);

	// Add a control for the logo size.
	$wp_customize->add_control(
		'genesis_fivetwofive_logo_width',
		[
			'label'       => __( 'Logo Width', 'genesis-fivetwofive' ),
			'description' => __( 'The maximum width of the logo in pixels.', 'genesis-fivetwofive' ),
			'priority'    => 9,
			'section'     => 'title_tagline',
			'settings'    => 'genesis_fivetwofive_logo_width',
			'type'        => 'number',
			'input_attrs' => [
				'min' => 50,
			],
		]
	);

}

/**
 * Displays a message if the entered width is not numeric or greater than 100.
 *
 * @param object $validity The validity status.
 * @param int    $width The width entered by the user.
 * @return int The new width.
 */
function genesis_fivetwofive_validate_logo_width( $validity, $width ) {

	if ( empty( $width ) || ! is_numeric( $width ) ) {
		$validity->add( 'required', __( 'You must supply a valid number.', 'genesis-fivetwofive' ) );
	} elseif ( $width < 50 ) {
		$validity->add( 'logo_too_small', __( 'The logo width cannot be less than 50.', 'genesis-fivetwofive' ) );
	}

	return $validity;

}
