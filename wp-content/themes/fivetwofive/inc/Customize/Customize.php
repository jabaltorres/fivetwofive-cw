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
		add_action( 'wp_enqueue_scripts', array( $this, 'customize_css' ) );
	}

	/**
	 * Checks the settings for the colors and fonts of the theme.
	 *
	 * @since 1.0
	 */
	public function customize_css() {
		$css        = '';
		$theme_mods = get_theme_mod( 'fivetwofive_theme_mods', fivetwofive_default_theme_mods() );

		if ( ! is_array( $theme_mods ) || empty( $theme_mods ) ) {
			return;
		}

		$css .= sprintf(
			'
				a,
				a:focus,
				a:hover {
					color: %1$s;
				}
			',
			$theme_mods['accent_color']
		);

		$css .= sprintf(
			'
				body {
					color: %1$s;
					font-family: \'%2$s\',%3$s;
				}
			',
			$theme_mods['default_color'],
			$theme_mods['default_font'],
			$theme_mods['default_font_category']
		);

		$css .= sprintf(
			'
				h1,
				h2,
				h3,
				h4,
				h5,
				h6 {
					color: %1$s;
					font-family: \'%2$s\',%3$s;
				}
			',
			$theme_mods['heading_color'],
			$theme_mods['heading_font'],
			$theme_mods['heading_font_category']
		);

		if ( $css ) {
			wp_add_inline_style( 'fivetwofive-global-style', $css );
		}
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
	}

	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_color_options( $wp_customize ) {
		$wp_customize->add_setting(
			'fivetwofive_theme_mods[accent_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => '#FEC904',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[default_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => '#000000',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[heading_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => '#000000',
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
			'fivetwofive_theme_mods[font_url]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => '',
				'sanitize_callback' => 'sanitize_url',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[default_font]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => 'abeezee',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[default_font_category]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => 'sans-serif',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[heading_font]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => 'DM Sans',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[heading_font_category]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => 'sans-serif',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'fivetwofive_theme_mods[font_url]',
			array(
				'priority'    => 10,
				'type'        => 'url',
				'section'     => 'fivetwofive_fonts_section',
				'label'       => __( 'Font URL', 'fivetwofive' ),
				'description' => __( 'Google fonts URL.', 'fivetwofive' ),
			)
		);

		// Fonts Choices.
		include_once get_theme_file_path( 'config/fonts.php' );

		$wp_customize->add_control(
			new Customize_Select2_Control(
				$wp_customize,
				'fivetwofive_theme_mods[default_font]',
				array(
					'priority'    => 10,
					'section'     => 'fivetwofive_fonts_section',
					'label'       => __( 'Default Font', 'fivetwofive' ),
					'description' => __( 'The default font to use for all the text elements in the site except headings.', 'fivetwofive' ),
					'choices'     => $google_fonts,
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
					'choices'     => $font_categories,
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
					'choices'     => $google_fonts,
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
					'choices'     => $font_categories,
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
		wp_enqueue_script( 'fivetwofive-customizer', get_template_directory_uri() . '/assets/js/customize.js', array( 'customize-preview' ), FIVETWOFIVE_VERSION, true );
	}
}
