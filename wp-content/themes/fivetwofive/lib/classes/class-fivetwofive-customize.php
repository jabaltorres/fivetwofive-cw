<?php
/**
 * Custom icons for this theme.
 *
 * @package WordPress
 * @subpackage FiveTwoFive
 * @since FiveTwoFive 1.0
 */

if ( ! class_exists( 'FiveTwoFive_Customize' ) ) {
	/**
	 * SVG ICONS CLASS
	 * Retrieve the SVG code for the specified icon. Based on a solution in Twenty Nineteen.
	 */
	class FiveTwoFive_Customize {

		/**
		 * Constructor. Instantiate the object.
		 *
		 * @access public
		 *
		 * @since Twenty Twenty-One 1.0
		 */
		public function __construct() {
			add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register( $wp_customize ) {
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial(
					'blogname',
					array(
						'selector'        => '.site-title a',
						'render_callback' => array( $this, 'customize_partial_blogname' ),
					)
				);
				$wp_customize->selective_refresh->add_partial(
					'blogdescription',
					array(
						'selector'        => '.site-description',
						'render_callback' => array( $this, 'customize_partial_blogdescription' ),
					)
				);
			}

			$wp_customize->add_section(
				'fivetwofive_fonts_section',
				array(
					'title'          => __( 'Fonts', 'fivetwofive' ),
					'description'    => __( 'define the site fonts here', 'fivetwofive' ),
					'panel'          => '', // Not typically needed.
					'priority'       => 50,
					'capability'     => 'edit_theme_options',
					'theme_supports' => '', // Rarely needed.
				)
			);

			$wp_customize->add_setting(
				'fivetwofive_options[primary_font]',
				array(
					'type'              => 'theme_mod',
					'capability'        => 'edit_theme_options',
					'default'           => 'abeezee',
					'sanitize_callback' => array( $this, 'sanitize_font' ),
				)
			);

			$wp_customize->add_setting(
				'fivetwofive_options[heading_font]',
				array(
					'type'              => 'theme_mod',
					'capability'        => 'edit_theme_options',
					'default'           => 'abeezee',
					'sanitize_callback' => array( $this, 'sanitize_font' ),
				)
			);

			// Include the custom select2 class.
			include_once get_theme_file_path( 'lib/classes/class-fivetwofive-customize-select2-control.php' );

			$wp_customize->add_control(
				new FiveTwoFive_Customize_Select2_Control(
					$wp_customize,
					'fivetwofive_options[primary_font]',
					array(
						'priority'    => 10,
						'section'     => 'fivetwofive_fonts_section',
						'label'       => __( 'Primary Font', 'fivetwofive' ),
						'description' => __( 'This is the primary font.', 'fivetwofive' ),
						'choices'     => array(
							'abeezee'       => 'ABeeZee',
							'abel'          => 'Abel',
							'abhaya_libre'  => 'Abhaya Libre',
							'abril_fatface' => 'Abril Fatface',
							'aclonica'      => 'Aclonica',
						),
					)
				)
			);

			$wp_customize->add_control(
				new FiveTwoFive_Customize_Select2_Control(
					$wp_customize,
					'fivetwofive_options[heading_font]',
					array(
						'priority'    => 15,
						'section'     => 'fivetwofive_fonts_section',
						'label'       => __( 'Heading Font', 'fivetwofive' ),
						'description' => __( 'This is the heading font.', 'fivetwofive' ),
						'choices'     => array(
							'abeezee'       => 'ABeeZee',
							'abel'          => 'Abel',
							'abhaya_libre'  => 'Abhaya Libre',
							'abril_fatface' => 'Abril Fatface',
							'aclonica'      => 'Aclonica',
						),
					)
				)
			);

		}

		/**
		 * Undocumented function
		 *
		 * @param string $setting Font string from customizer.
		 * @return string $setting Sanitized user Font string input.
		 */
		public function sanitize_font( $setting ) {
			return sanitize_text_field( $setting );
		}

		/**
		 * Render the site title for the selective refresh partial.
		 *
		 * @return void
		 */
		public function customize_partial_blogname() {
			bloginfo( 'name' );
		}

		/**
		 * Render the site tagline for the selective refresh partial.
		 *
		 * @return void
		 */
		public function customize_partial_blogdescription() {
			bloginfo( 'description' );
		}

		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		public function customize_preview_js() {
			wp_enqueue_script( 'fivetwofive-customizer', get_template_directory_uri() . '/lib/assets/js/customize.js', array( 'customize-preview' ), FIVETWOFIVE_VERSION, true );
		}

	}

}
