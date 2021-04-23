<?php
/**
 * Custom icons for this theme.
 *
 * @package WordPress
 * @subpackage FiveTwoFive
 * @since FiveTwoFive 1.0
 */

namespace Fivetwofive\Customize;

use Fivetwofive\Component_Interface;
use Fivetwofive\Customize\Customize_Select2_Control;
use Fivetwofive\Config\Config;

/**
 * Customize class.
 */
class Customize implements Component_Interface {

	/**
	 * Constructor. Instantiate the object.
	 *
	 * @access public
	 *
	 * @since Twenty Twenty-One 1.0
	 */
	public function register() {
		add_action( 'customize_register', array( $this, 'customize_register' ) );
		add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
	}

	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

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

		$this->add_font_options( $wp_customize );
		$this->add_color_options( $wp_customize );
		$this->add_footer_options( $wp_customize );
		$this->add_header_options( $wp_customize );
	}

	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_color_options( $wp_customize ) {
		$config = Config::get_instance()->get_settings();

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[accent_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['accent_color'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[default_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['default_color'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[heading_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['heading_color'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[accent_color]',
				array(
					'label'       => __( 'Accent Color', 'fivetwofive' ),
					'description' => __( 'The color to for links and buttons.', 'fivetwofive' ),
					'section'     => 'colors',
				)
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[default_color]',
				array(
					'label'       => __( 'Default Color', 'fivetwofive' ),
					'description' => __( 'The default color to use on all text elements on the site.', 'fivetwofive' ),
					'section'     => 'colors',
				)
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[heading_color]',
				array(
					'label'       => __( 'Heading Color', 'fivetwofive' ),
					'description' => __( 'The color to use for all the site headings.', 'fivetwofive' ),
					'section'     => 'colors',
				)
			)
		);
	}

	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_font_options( $wp_customize ) {
		$config = Config::get_instance()->get_settings();

		$wp_customize->add_section(
			'fivetwofive_fonts_section',
			array(
				'title'          => __( 'Fonts', 'fivetwofive' ),
				'description'    => __( 'Customize the site\'s fonts.<br/> You can choose to all fonts provided by <a href="https://fonts.google.com/" rel="no-follow" target="_blank">Google Fonts</a>.', 'fivetwofive' ),
				'panel'          => '', // Not typically needed.
				'priority'       => 50,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '', // Rarely needed.
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[default_font]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['default_font'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[default_font_style]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['default_font_style'],
				'sanitize_callback' => array( $this, 'sanitize_multiple_select' ),
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[default_font_category]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['default_font_category'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[heading_font]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['heading_font'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[heading_font_style]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['heading_font_style'],
				'sanitize_callback' => array( $this, 'sanitize_multiple_select' ),
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[heading_font_category]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['heading_font_category'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Customize_Select2_Control(
				$wp_customize,
				'fivetwofive_theme_mods[default_font]',
				array(
					'priority'    => 10,
					'section'     => 'fivetwofive_fonts_section',
					'label'       => __( 'Default Font', 'fivetwofive' ),
					'description' => __( 'The default font to use for all the text elements in the site except headings.', 'fivetwofive' ),
					'choices'     => $config['google_fonts'],
				)
			)
		);

		$wp_customize->add_control(
			new Customize_Select2_Control(
				$wp_customize,
				'fivetwofive_theme_mods[default_font_style]',
				array(
					'priority'    => 10,
					'section'     => 'fivetwofive_fonts_section',
					'label'       => __( 'Default Font Style', 'fivetwofive' ),
					'description' => __( 'Refer to Google fonts for the desired font style of the default font.', 'fivetwofive' ),
					'choices'     => $config['font_styles'],
					'input_attrs' => array(
						'multiple' => 'multiple',
					),
				)
			)
		);

		$wp_customize->add_control(
			new Customize_Select2_Control(
				$wp_customize,
				'fivetwofive_theme_mods[default_font_category]',
				array(
					'priority'    => 15,
					'section'     => 'fivetwofive_fonts_section',
					'label'       => __( 'Default Font Category', 'fivetwofive' ),
					'description' => __( 'Refer to Google fonts for the category of your default font.', 'fivetwofive' ),
					'choices'     => $config['font_categories'],
				)
			)
		);

		$wp_customize->add_control(
			new Customize_Select2_Control(
				$wp_customize,
				'fivetwofive_theme_mods[heading_font]',
				array(
					'priority'    => 15,
					'section'     => 'fivetwofive_fonts_section',
					'label'       => __( 'Heading Font', 'fivetwofive' ),
					'description' => __( 'The font to use for headings (h1, h2, h3, h4, h5, h6).', 'fivetwofive' ),
					'choices'     => $config['google_fonts'],
				)
			)
		);

		$wp_customize->add_control(
			new Customize_Select2_Control(
				$wp_customize,
				'fivetwofive_theme_mods[heading_font_style]',
				array(
					'priority'    => 15,
					'section'     => 'fivetwofive_fonts_section',
					'label'       => __( 'Heading Font Style', 'fivetwofive' ),
					'description' => __( 'Refer to Google fonts for the desired font style of the heading font.', 'fivetwofive' ),
					'choices'     => $config['font_styles'],
					'input_attrs' => array(
						'multiple' => 'multiple',
					),
				)
			)
		);

		$wp_customize->add_control(
			new Customize_Select2_Control(
				$wp_customize,
				'fivetwofive_theme_mods[heading_font_category]',
				array(
					'priority'    => 15,
					'section'     => 'fivetwofive_fonts_section',
					'label'       => __( 'Heading Font Category', 'fivetwofive' ),
					'description' => __( 'Refer to Google fonts for the category of your heading font.', 'fivetwofive' ),
					'choices'     => $config['font_categories'],
				)
			)
		);
	}

	/**
	 * Add Footer fields in the customizer api.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_footer_options( $wp_customize ) {
		$config = Config::get_instance()->get_settings();

		$wp_customize->add_section(
			'fivetwofive_footer_section',
			array(
				'title'          => __( 'Footer', 'fivetwofive' ),
				'panel'          => '', // Not typically needed.
				'priority'       => 50,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '', // Rarely needed.
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[footer][background_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['footer']['background_color'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[footer][background_color]',
				array(
					'label'       => __( 'Footer Background Color', 'fivetwofive' ),
					'description' => __( 'Set the footer background color.', 'fivetwofive' ),
					'section'     => 'fivetwofive_footer_section',
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[footer][text_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['footer']['text_color'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[footer][text_color]',
				array(
					'label'       => __( 'Footer Text Color', 'fivetwofive' ),
					'description' => __( 'Set the footer text color.', 'fivetwofive' ),
					'section'     => 'fivetwofive_footer_section',
				)
			)
		);
	}

	/**
	 * Add Header fields in the customizer api.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_header_options( $wp_customize ) {
		$config = Config::get_instance()->get_settings();

		$wp_customize->add_section(
			'fivetwofive_header_section',
			array(
				'title'          => __( 'Header', 'fivetwofive' ),
				'panel'          => '', // Not typically needed.
				'priority'       => 50,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '', // Rarely needed.
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[header][background_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['header']['background_color'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[header][background_color]',
				array(
					'label'       => __( 'Header Background Color', 'fivetwofive' ),
					'description' => __( 'Set the header background color.', 'fivetwofive' ),
					'section'     => 'fivetwofive_header_section',
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[header][text_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['header']['text_color'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[header][text_color]',
				array(
					'label'       => __( 'Header Text Color', 'fivetwofive' ),
					'description' => __( 'Set the header text color.', 'fivetwofive' ),
					'section'     => 'fivetwofive_header_section',
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[header][active_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['header']['active_color'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[header][active_color]',
				array(
					'label'       => __( 'Header Active Text Color', 'fivetwofive' ),
					'description' => __( 'Set the header active text color.', 'fivetwofive' ),
					'section'     => 'fivetwofive_header_section',
				)
			)
		);
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
	 * Sanitize Customizer controls that have multiple fields.
	 *
	 * @param array $values User input options.
	 * @return array Sanitized options.
	 */
	public function sanitize_multiple_select( $values ) {
		$multi_values = ! is_array( $values ) ? explode( ',', $values ) : $values;

		return ! empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
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
		wp_enqueue_script( 'fivetwofive-customizer', get_template_directory_uri() . '/assets/dist/js/customize.js', array( 'customize-preview' ), FIVETWOFIVE_VERSION, true );
	}
}
