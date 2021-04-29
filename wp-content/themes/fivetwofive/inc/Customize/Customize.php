<?php
/**
 * Customize class.
 *
 * @package Fivetwofive
 * @subpackage FivetwofiveTheme/Customize
 * @since 1.0.0
 */

namespace Fivetwofive\FivetwofiveTheme\Customize;

use Fivetwofive\FivetwofiveTheme\Interfaces\Component_Interface;
use Fivetwofive\FivetwofiveTheme\Customize\Customize_Select2_Control;
use Fivetwofive\FivetwofiveTheme\Config\Config;


/**
 * Customize class.
 *
 * @since 1.0.0
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
		$this->add_site_identity_options( $wp_customize );
		$this->add_layout_options( $wp_customize );
		$this->add_layout_header_options( $wp_customize );
		$this->add_layout_primary_navigation_options( $wp_customize );
		$this->add_layout_footer_options( $wp_customize );
		$this->add_layout_sidebars_options( $wp_customize );
		$this->add_typography_options( $wp_customize );
		$this->add_color_options( $wp_customize );
		$this->add_color_header_options( $wp_customize );
		$this->add_color_primary_navigation_options( $wp_customize );
		$this->add_color_footer_options( $wp_customize );
	}

	/**
	 * Add Site Identity fields in the customizer api.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_site_identity_options( $wp_customize ) {
		$config = Config::get_instance()->get_settings();

		$wp_customize->get_control( 'blogname' )->priority         = 1;
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_control( 'blogdescription' )->priority  = 3;

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

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[site_identity][hide_blogname]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['site_identity']['hide_blogname'],
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'fivetwofive_theme_mods[site_identity][hide_blogname]',
			array(
				'label'    => __( 'Hide site title', 'fivetwofive' ),
				'section'  => 'title_tagline',
				'type'     => 'checkbox',
				'priority' => 2,
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[site_identity][hide_blogdescription]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['site_identity']['hide_blogdescription'],
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'fivetwofive_theme_mods[site_identity][hide_blogdescription]',
			array(
				'label'    => __( 'Hide tagline', 'fivetwofive' ),
				'section'  => 'title_tagline',
				'type'     => 'checkbox',
				'priority' => 4,
			)
		);
	}

	/**
	 * Add Layout panel in the customizer api.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_layout_options( $wp_customize ) {
		$config = Config::get_instance()->get_settings();

		$wp_customize->add_panel(
			'fivetwofive_layout_panel',
			array(
				'title'    => __( 'Layout', 'fivetwofive' ),
				'priority' => 30,
			)
		);

	}

	/**
	 * Add Header Layout panel in the customizer api.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_layout_header_options( $wp_customize ) {
		$config = Config::get_instance()->get_settings();

		$wp_customize->add_section(
			'fivetwofive_layout_header_section',
			array(
				'title'      => __( 'Header', 'fivetwofive' ),
				'panel'      => 'fivetwofive_layout_panel',
				'priority'   => 10,
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[layout][header][presets]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['layout']['header']['presets'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'fivetwofive_theme_mods[layout][header][presets]',
			array(
				'label'    => __( 'Presets', 'fivetwofive' ),
				'section'  => 'fivetwofive_layout_header_section',
				'type'     => 'select',
				'priority' => 2,
				'choices'  => array(
					'default'                    => 'Default',
					'navigation_before'          => 'Navigation Before',
					'navigation_after'           => 'Navigation After',
					'navigation_before_centered' => 'Navigation Before - Centered',
					'navigation_after_centered'  => 'Navigation After - Centered',
					'navigation_left'            => 'Navigation Left',
				),
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[layout][header][alignment]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['layout']['header']['alignment'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'fivetwofive_theme_mods[layout][header][alignment]',
			array(
				'label'    => __( 'Alignment', 'fivetwofive' ),
				'section'  => 'fivetwofive_layout_header_section',
				'type'     => 'select',
				'priority' => 3,
				'choices'  => array(
					'left'     => 'Left',
					'right'    => 'Right',
					'centered' => 'Centered',
				),
			)
		);

	}

	/**
	 * Add Primary Navigation layout settings in the customizer api.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_layout_primary_navigation_options( $wp_customize ) {
		$config = Config::get_instance()->get_settings();

		$wp_customize->add_section(
			'fivetwofive_layout_navigation_section',
			array(
				'title'      => __( 'Primary Navigation', 'fivetwofive' ),
				'panel'      => 'fivetwofive_layout_panel',
				'priority'   => 20,
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[layout][primary_navigation][location]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['layout']['primary_navigation']['location'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'fivetwofive_theme_mods[layout][primary_navigation][location]',
			array(
				'label'    => __( 'Navigation Location', 'fivetwofive' ),
				'section'  => 'fivetwofive_layout_navigation_section',
				'type'     => 'select',
				'priority' => 1,
				'choices'  => array(
					'below_header'  => 'Below Header',
					'above_header'  => 'Above Header',
					'float_right'   => 'Float Right',
					'float_left'    => 'Float Left',
					'inline'        => 'Inline',
					'no_navigation' => 'No Navigation',
				),
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[layout][primary_navigation][width]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['layout']['primary_navigation']['width'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'fivetwofive_theme_mods[layout][primary_navigation][width]',
			array(
				'label'    => __( 'Navigation width', 'fivetwofive' ),
				'section'  => 'fivetwofive_layout_navigation_section',
				'type'     => 'select',
				'priority' => 2,
				'choices'  => array(
					'contained' => 'Contained',
					'full'      => 'Full',
				),
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[layout][primary_navigation][inner_width]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['layout']['primary_navigation']['inner_width'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'fivetwofive_theme_mods[layout][primary_navigation][inner_width]',
			array(
				'label'    => __( 'Inner Navigation width', 'fivetwofive' ),
				'section'  => 'fivetwofive_layout_navigation_section',
				'type'     => 'select',
				'priority' => 3,
				'choices'  => array(
					'contained' => 'Contained',
					'full'      => 'Full',
				),
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[layout][primary_navigation][alignment]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['layout']['primary_navigation']['alignment'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'fivetwofive_theme_mods[layout][primary_navigation][alignment]',
			array(
				'label'    => __( 'Navigation Alignment', 'fivetwofive' ),
				'section'  => 'fivetwofive_layout_navigation_section',
				'type'     => 'select',
				'priority' => 4,
				'choices'  => array(
					'left'   => 'Left',
					'right'  => 'Right',
					'center' => 'Center',
				),
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[layout][primary_navigation][search]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['layout']['primary_navigation']['search'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'fivetwofive_theme_mods[layout][primary_navigation][search]',
			array(
				'label'    => __( 'Navigation Search', 'fivetwofive' ),
				'section'  => 'fivetwofive_layout_navigation_section',
				'type'     => 'select',
				'priority' => 5,
				'choices'  => array(
					'enable'  => 'Enable',
					'disable' => 'Disable',
				),
			)
		);
	}

	/**
	 * Add Footer Layout panel in the customizer api.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_layout_footer_options( $wp_customize ) {
		$config = Config::get_instance()->get_settings();

		$wp_customize->add_section(
			'fivetwofive_layout_footer_section',
			array(
				'title'      => __( 'Footer', 'fivetwofive' ),
				'panel'      => 'fivetwofive_layout_panel',
				'priority'   => 30,
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[layout][footer][width]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['layout']['footer']['width'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'fivetwofive_theme_mods[layout][footer][width]',
			array(
				'label'    => __( 'Footer Width', 'fivetwofive' ),
				'section'  => 'fivetwofive_layout_footer_section',
				'type'     => 'select',
				'priority' => 10,
				'choices'  => array(
					'contained' => 'Contained',
					'full'      => 'Full',
				),
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[layout][footer][inner_width]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['layout']['footer']['inner_width'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'fivetwofive_theme_mods[layout][footer][inner_width]',
			array(
				'label'    => __( 'Footer Inner Width', 'fivetwofive' ),
				'section'  => 'fivetwofive_layout_footer_section',
				'type'     => 'select',
				'priority' => 20,
				'choices'  => array(
					'contained' => 'Contained',
					'full'      => 'Full',
				),
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[layout][footer][widgets]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['layout']['footer']['widgets'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'fivetwofive_theme_mods[layout][footer][widgets]',
			array(
				'label'    => __( 'Footer Widgets', 'fivetwofive' ),
				'section'  => 'fivetwofive_layout_footer_section',
				'type'     => 'select',
				'priority' => 30,
				'choices'  => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				),
			)
		);

	}

	/**
	 * Add Sidebar Layout panel in the customizer api.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_layout_sidebars_options( $wp_customize ) {
		$config = Config::get_instance()->get_settings();

		$wp_customize->add_section(
			'fivetwofive_layout_sidebars_section',
			array(
				'title'      => __( 'Sidebars', 'fivetwofive' ),
				'panel'      => 'fivetwofive_layout_panel',
				'priority'   => 40,
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[layout][sidebars][sidebar_layout]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['layout']['sidebars']['sidebar_layout'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'fivetwofive_theme_mods[layout][sidebars][sidebar_layout]',
			array(
				'label'    => __( 'Sidebar Layout', 'fivetwofive' ),
				'section'  => 'fivetwofive_layout_sidebars_section',
				'type'     => 'select',
				'priority' => 10,
				'choices'  => array(
					'sidebar_content'    => 'Sidebar / Content',
					'content_sidebar'    => 'Content / Sidebar',
					'content_no_sidebar' => 'Content (no sidebars)',
				),
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[layout][sidebars][blog_sidebar_layout]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['layout']['sidebars']['blog_sidebar_layout'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'fivetwofive_theme_mods[layout][sidebars][blog_sidebar_layout]',
			array(
				'label'    => __( 'Blog Sidebar Layout', 'fivetwofive' ),
				'section'  => 'fivetwofive_layout_sidebars_section',
				'type'     => 'select',
				'priority' => 20,
				'choices'  => array(
					'sidebar_content'    => 'Sidebar / Content',
					'content_sidebar'    => 'Content / Sidebar',
					'content_no_sidebar' => 'Content (no sidebars)',
				),
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[layout][sidebars][single_post_sidebar_layout]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['layout']['sidebars']['single_post_sidebar_layout'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'fivetwofive_theme_mods[layout][sidebars][single_post_sidebar_layout]',
			array(
				'label'    => __( 'Single Post Sidebar Layout', 'fivetwofive' ),
				'section'  => 'fivetwofive_layout_sidebars_section',
				'type'     => 'select',
				'priority' => 20,
				'choices'  => array(
					'sidebar_content'    => 'Sidebar / Content',
					'content_sidebar'    => 'Content / Sidebar',
					'content_no_sidebar' => 'Content (no sidebars)',
				),
			)
		);

	}

	/**
	 * Add Typography fields in the customizer api.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_typography_options( $wp_customize ) {
		$config = Config::get_instance()->get_settings();

		$wp_customize->add_section(
			'fivetwofive_typography_section',
			array(
				'title'          => __( 'Typography', 'fivetwofive' ),
				'description'    => __( 'Customize the site\'s fonts.<br/> You can choose to all fonts provided by <a href="https://fonts.google.com/" rel="no-follow" target="_blank">Google Fonts</a>.', 'fivetwofive' ),
				'panel'          => '', // Not typically needed.
				'priority'       => 50,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '', // Rarely needed.
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[typography][body_font]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['typography']['body_font'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Customize_Select2_Control(
				$wp_customize,
				'fivetwofive_theme_mods[typography][body_font]',
				array(
					'priority'    => 10,
					'section'     => 'fivetwofive_typography_section',
					'label'       => __( 'Body Font', 'fivetwofive' ),
					'description' => __( 'The body font to use for all the text elements in the site except headings.', 'fivetwofive' ),
					'choices'     => $config['google_fonts'],
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[typography][body_font_variants]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['typography']['body_font_variants'],
				'sanitize_callback' => array( $this, 'sanitize_multiple_select' ),
			)
		);

		$wp_customize->add_control(
			new Customize_Select2_Control(
				$wp_customize,
				'fivetwofive_theme_mods[typography][body_font_variants]',
				array(
					'priority'    => 10,
					'section'     => 'fivetwofive_typography_section',
					'description' => __( 'Font Variants', 'fivetwofive' ),
					'choices'     => $config['font_variants'],
					'input_attrs' => array(
						'multiple' => 'multiple',
					),
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[typography][body_font_category]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['typography']['body_font_category'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Customize_Select2_Control(
				$wp_customize,
				'fivetwofive_theme_mods[typography][body_font_category]',
				array(
					'priority'    => 10,
					'section'     => 'fivetwofive_typography_section',
					'description' => __( 'Font Category', 'fivetwofive' ),
					'choices'     => $config['font_categories'],
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[typography][body_font_weight]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['typography']['body_font_weight'],
				'sanitize_callback' => array( $this, 'sanitize_multiple_select' ),
			)
		);

		$wp_customize->add_control(
			new Customize_Select2_Control(
				$wp_customize,
				'fivetwofive_theme_mods[typography][body_font_weight]',
				array(
					'priority'    => 10,
					'section'     => 'fivetwofive_typography_section',
					'description' => __( 'Font weight', 'fivetwofive' ),
					'choices'     => $config['font_weights'],
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[typography][heading_font]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['typography']['heading_font'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Customize_Select2_Control(
				$wp_customize,
				'fivetwofive_theme_mods[typography][heading_font]',
				array(
					'priority'    => 15,
					'section'     => 'fivetwofive_typography_section',
					'label'       => __( 'Heading Font', 'fivetwofive' ),
					'description' => __( 'The font to use for headings (h1, h2, h3, h4, h5, h6).', 'fivetwofive' ),
					'choices'     => $config['google_fonts'],
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[typography][heading_font_variants]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['typography']['heading_font_variants'],
				'sanitize_callback' => array( $this, 'sanitize_multiple_select' ),
			)
		);

		$wp_customize->add_control(
			new Customize_Select2_Control(
				$wp_customize,
				'fivetwofive_theme_mods[typography][heading_font_variants]',
				array(
					'priority'    => 15,
					'section'     => 'fivetwofive_typography_section',
					'description' => __( 'Font Variants', 'fivetwofive' ),
					'choices'     => $config['font_variants'],
					'input_attrs' => array(
						'multiple' => 'multiple',
					),
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[typography][heading_font_category]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['typography']['heading_font_category'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Customize_Select2_Control(
				$wp_customize,
				'fivetwofive_theme_mods[typography][heading_font_category]',
				array(
					'priority'    => 15,
					'section'     => 'fivetwofive_typography_section',
					'description' => __( 'Font Category', 'fivetwofive' ),
					'choices'     => $config['font_categories'],
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[typography][heading_font_weight]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['typography']['heading_font_weight'],
				'sanitize_callback' => array( $this, 'sanitize_multiple_select' ),
			)
		);

		$wp_customize->add_control(
			new Customize_Select2_Control(
				$wp_customize,
				'fivetwofive_theme_mods[typography][heading_font_weight]',
				array(
					'priority'    => 15,
					'section'     => 'fivetwofive_typography_section',
					'description' => __( 'Font weight', 'fivetwofive' ),
					'choices'     => $config['font_weights'],
				)
			)
		);
	}

	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_color_options( $wp_customize ) {
		$config = Config::get_instance()->get_settings();

		$wp_customize->add_panel(
			'fivetwofive_color_panel',
			array(
				'title'    => __( 'Colors', 'fivetwofive' ),
				'priority' => 40,
			)
		);

		$wp_customize->add_section(
			'fivetwofive_body_color_section',
			array(
				'title'      => __( 'Body', 'fivetwofive' ),
				'panel'      => 'fivetwofive_color_panel',
				'priority'   => 10,
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[colors][body][background_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['colors']['body']['background_color'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[colors][body][background_color]',
				array(
					'label'   => __( 'Body Background Color', 'fivetwofive' ),
					'section' => 'fivetwofive_body_color_section',
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[colors][body][text_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['colors']['body']['text_color'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[colors][body][text_color]',
				array(
					'label'   => __( 'Text Color', 'fivetwofive' ),
					'section' => 'fivetwofive_body_color_section',
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[colors][body][heading_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['colors']['body']['heading_color'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[colors][body][heading_color]',
				array(
					'label'   => __( 'Heading Color', 'fivetwofive' ),
					'section' => 'fivetwofive_body_color_section',
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[colors][body][link_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['colors']['body']['link_color'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[colors][body][link_color]',
				array(
					'label'   => __( 'Link Color', 'fivetwofive' ),
					'section' => 'fivetwofive_body_color_section',
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[colors][body][link_color_hover]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['colors']['body']['link_color_hover'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[colors][body][link_color_hover]',
				array(
					'label'   => __( 'Link Color Hover', 'fivetwofive' ),
					'section' => 'fivetwofive_body_color_section',
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[colors][body][link_color_visited]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['colors']['body']['link_color_visited'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[colors][body][link_color_visited]',
				array(
					'label'   => __( 'Link Color Visited', 'fivetwofive' ),
					'section' => 'fivetwofive_body_color_section',
				)
			)
		);

	}

	/**
	 * Add Header color fields in the customizer api.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_color_header_options( $wp_customize ) {
		$config = Config::get_instance()->get_settings();

		$wp_customize->add_section(
			'fivetwofive_header_color_section',
			array(
				'title'      => __( 'Header', 'fivetwofive' ),
				'panel'      => 'fivetwofive_color_panel',
				'priority'   => 20,
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[colors][header][background_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['colors']['header']['background_color'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[colors][header][background_color]',
				array(
					'label'   => __( 'Header Background Color', 'fivetwofive' ),
					'section' => 'fivetwofive_header_color_section',
				)
			)
		);
	}

	/**
	 * Add Primary Navigation color fields in the customizer api.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_color_primary_navigation_options( $wp_customize ) {
		$config = Config::get_instance()->get_settings();

		$wp_customize->add_section(
			'fivetwofive_primary_navigation_color_section',
			array(
				'title'      => __( 'Primary Navigation', 'fivetwofive' ),
				'panel'      => 'fivetwofive_color_panel',
				'priority'   => 30,
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[colors][primary_navigation][background_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['colors']['primary_navigation']['background_color'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[colors][primary_navigation][background_color]',
				array(
					'label'   => __( 'Primary Navigation Background Color', 'fivetwofive' ),
					'section' => 'fivetwofive_primary_navigation_color_section',
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[colors][primary_navigation][link_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['colors']['primary_navigation']['link_color'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[colors][primary_navigation][link_color]',
				array(
					'label'   => __( 'Primary Navigation Link Color', 'fivetwofive' ),
					'section' => 'fivetwofive_primary_navigation_color_section',
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[colors][primary_navigation][active_link_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['colors']['primary_navigation']['active_link_color'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[colors][primary_navigation][active_link_color]',
				array(
					'label'   => __( 'Primary Navigation Active Link Color', 'fivetwofive' ),
					'section' => 'fivetwofive_primary_navigation_color_section',
				)
			)
		);
	}

	/**
	 * Add Footer color fields in the customizer api.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_color_footer_options( $wp_customize ) {
		$config = Config::get_instance()->get_settings();

		$wp_customize->add_section(
			'fivetwofive_footer_color_section',
			array(
				'title'      => __( 'Footer', 'fivetwofive' ),
				'panel'      => 'fivetwofive_color_panel',
				'priority'   => 40,
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[colors][footer][background_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['colors']['footer']['background_color'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[colors][footer][background_color]',
				array(
					'label'   => __( 'Footer Background Color', 'fivetwofive' ),
					'section' => 'fivetwofive_footer_color_section',
				)
			)
		);

		$wp_customize->add_setting(
			'fivetwofive_theme_mods[colors][footer][text_color]',
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'default'           => $config['default_theme_mods']['colors']['footer']['text_color'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'fivetwofive_theme_mods[colors][footer][text_color]',
				array(
					'label'   => __( 'Footer Text Color', 'fivetwofive' ),
					'section' => 'fivetwofive_footer_color_section',
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
