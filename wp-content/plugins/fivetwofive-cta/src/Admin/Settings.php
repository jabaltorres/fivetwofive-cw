<?php
/**
 * The Settings page functionality of the plugin.
 *
 * @since 1.0.0
 *
 * @package FiveTwoFive_CTA
 * @subpackage FiveTwoFive_CTA/src/Admin
 */

namespace FiveTwoFive\FiveTwoFive_CTA\Admin;

defined( 'ABSPATH' ) || exit;

/**
 * The Settings page functionality of the plugin.
 *
 * Defines the call to actions settings fields and page.
 *
 * @package    FiveTwoFive_CTA
 * @subpackage FiveTwoFive_CTA/src/Admin
 */
class Settings {

	/**
	 * The ID of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Default settings.
	 *
	 * @return array default settings.
	 */
	protected function default_settings() {
		return array(
			'cta_title'         => __( 'Powered by FiveTwoFive.', 'fivetwofive-cta' ),
			'cta_message'       => '<p class="custom-message">' . __( 'My custom message.', 'fivetwofive-cta' ) . '</p>',
			'cta_button_link'   => 'https://fivetwofive.com',
			'cta_button_text'   => 'Learn More',
			'cta_button_target' => '_self',
		);
	}

	/**
	 * Radio field options.
	 *
	 * @return array Radio field options.
	 */
	protected function options_radio() {
		return array(
			'_self'  => __( 'Open the anchor in the SAME tab: target=self', 'fivetwofive-cta' ),
			'_blank' => __( 'Open the anchor in a NEW tab: target=blank', 'fivetwofive-cta' ),
		);
	}

	/**
	 * Add the Call To Action menu in the WP dashboard.
	 *
	 * @return void
	 */
	public function add_menu() {
		add_menu_page(
			__( 'Call To Action', 'fivetwofive-cta' ),
			__( 'Call To Action', 'fivetwofive-cta' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'settings_page' ),
			'dashicons-star-filled',
			6
		);
	}

	/**
	 * Page content of the Call To Action page.
	 *
	 * @return void
	 */
	public function settings_page() {
		include_once dirname( FTF_CTA_PLUGIN_FILE ) . '/resources/views/admin/settings-page.php';
	}

	/**
	 * Register Plugin settings, section and fields.
	 *
	 * @return void
	 */
	public function register_settings() {
		register_setting(
			$this->plugin_name,
			$this->plugin_name . '_options',
			array( $this, 'sanitize_fields' )
		);

		add_settings_section(
			$this->plugin_name . 'section',
			__( 'Customize the CTA', 'fivetwofive-cta' ),
			array( $this, 'settings_section' ),
			$this->plugin_name
		);

		add_settings_field(
			'cta_title',
			__( 'CTA Title', 'fivetwofive-cta' ),
			array( $this, 'field_text' ),
			$this->plugin_name,
			$this->plugin_name . 'section',
			array(
				'id'    => 'cta_title',
				'label' => __( 'Custom title attribute for the CTA', 'fivetwofive-cta' ),
			)
		);

		add_settings_field(
			'cta_message',
			__( 'CTA Message', 'fivetwofive-cta' ),
			array( $this, 'field_textarea' ),
			$this->plugin_name,
			$this->plugin_name . 'section',
			array(
				'id'    => 'cta_message',
				'label' => __( 'Custom text and/or markup', 'fivetwofive-cta' ),
			)
		);

		add_settings_field(
			'cta_button_text',
			__( 'CTA Button Text', 'fivetwofive-cta' ),
			array( $this, 'field_text' ),
			$this->plugin_name,
			$this->plugin_name . 'section',
			array(
				'id'    => 'cta_button_text',
				'label' => __( 'Custom button text for the CTA', 'fivetwofive-cta' ),
			)
		);

		add_settings_field(
			'cta_button_link',
			__( 'CTA URL', 'fivetwofive-cta' ),
			array( $this, 'field_text' ),
			$this->plugin_name,
			$this->plugin_name . 'section',
			array(
				'id'    => 'cta_button_link',
				'label' => __( 'Custom URL for the CTA link', 'fivetwofive-cta' ),
			)
		);

		add_settings_field(
			'cta_button_target',
			__( 'CTA Target', 'fivetwofive-cta' ),
			array( $this, 'field_radio' ),
			$this->plugin_name,
			$this->plugin_name . 'section',
			array(
				'id'    => 'cta_button_target',
				'label' => __( 'Custom target for the CTA', 'fivetwofive-cta' ),
			)
		);
	}

	/**
	 * Sanitize the values of the input fields before saving.
	 *
	 * @param array $input Key value pair of the input fields values.
	 * @return array $input Key value pair of the input fields sanitized values.
	 */
	public function sanitize_fields( $input ) {

		if ( isset( $input['cta_title'] ) ) {
			$input['cta_title'] = sanitize_text_field( $input['cta_title'] );
		}

		if ( isset( $input['cta_message'] ) ) {
			$input['cta_message'] = wp_kses_post( $input['cta_message'] );
		}

		if ( isset( $input['cta_button_link'] ) ) {
			$input['cta_button_link'] = esc_url( $input['cta_button_link'] );
		}

		$radio_options = $this->options_radio();
		if ( ! array_key_exists( $input['cta_button_target'], $radio_options ) || ! isset( $input['cta_button_target'] ) ) {
			$input['cta_button_target'] = null;
		} else {
			$input['cta_button_target'] = sanitize_text_field( $input['cta_button_target'] );
		}

		return $input;
	}

	/**
	 * Plugin Settings section text.
	 *
	 * @return void
	 */
	public function settings_section() {
		echo '<p>' . esc_html__( 'These settings enable you to customize the CTA.', 'fivetwofive-cta' ) . '</p>';
	}

	/**
	 * Settings API text field.
	 *
	 * Generate the text field needed for the settings api.
	 *
	 * @param array $args Fields arguments.
	 * @return void
	 */
	public function field_text( $args ) {
		$options = get_option( 'fivetwofive_cta_options', $this->default_settings() );

		$id    = isset( $args['id'] ) ? $args['id'] : '';
		$label = isset( $args['label'] ) ? $args['label'] : '';
		$value = isset( $options[ $id ] ) ? sanitize_text_field( $options[ $id ] ) : '';

		echo '<input id="fivetwofive_cta_options_' . esc_attr( $id ) . '" name="fivetwofive_cta_options[' . esc_attr( $id ) . ']" type="text" size="40" value="' . esc_attr( $value ) . '"><br />';
		echo '<label for="fivetwofive_cta_options_' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label>';
	}

	/**
	 * Settings API textarea field.
	 *
	 * Generate the textarea field needed for the settings api.
	 *
	 * @param array $args Fields arguments.
	 * @return void
	 */
	public function field_textarea( $args ) {
		$options = get_option( 'fivetwofive_cta_options', $this->default_settings() );

		$id    = isset( $args['id'] ) ? $args['id'] : '';
		$label = isset( $args['label'] ) ? $args['label'] : '';

		$allowed_tags = wp_kses_allowed_html( 'post' );

		$value = isset( $options[ $id ] ) ? wp_kses( stripslashes_deep( $options[ $id ] ), $allowed_tags ) : '';

		echo '<textarea id="fivetwofive_cta_options_' . esc_attr( $id ) . '" name="fivetwofive_cta_options[' . esc_attr( $id ) . ']" rows="5" cols="50">' . wp_kses_post( $value ) . '</textarea><br />';
		echo '<label for="fivetwofive_cta_options_' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label>';
	}

	/**
	 * Settings API radio field.
	 *
	 * Generate the radio field needed for the settings api.
	 *
	 * @param array $args Fields arguments.
	 * @return void
	 */
	public function field_radio( $args ) {

		$options = get_option( 'fivetwofive_cta_options', $this->default_settings() );

		$id    = isset( $args['id'] ) ? $args['id'] : '';
		$label = isset( $args['label'] ) ? $args['label'] : '';

		$selected_option = isset( $options[ $id ] ) ? sanitize_text_field( $options[ $id ] ) : '';

		$radio_options = $this->options_radio();

		foreach ( $radio_options as $value => $label ) {

			$checked = checked( $selected_option === $value, true, false );

			echo '<label><input name="fivetwofive_cta_options[' . esc_attr( $id ) . ']" type="radio" value="' . esc_attr( $value ) . '"' . esc_attr( $checked ) . '> ';
			echo '<span>' . esc_html( $label ) . '</span></label><br />';

		}

	}
}
