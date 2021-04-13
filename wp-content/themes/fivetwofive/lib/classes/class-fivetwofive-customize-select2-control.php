<?php
/**
 * Custom icons for this theme.
 *
 * @package WordPress
 * @subpackage FiveTwoFive
 * @since FiveTwoFive 1.0
 */

/**
 * Custom icons for this theme.
 *
 * @package WordPress
 * @subpackage FiveTwoFive
 * @since FiveTwoFive 1.0
 */
class FiveTwoFive_Customize_Select2_Control extends WP_Customize_Control {
	/**
	 * Control's Type.
	 *
	 * @since 3.4.0
	 * @var string
	 */
	public $type = 'fivetwofive-select2';

	/**
	 * Render the control's content.
	 *
	 * Allows the content to be overridden without having to rewrite the wrapper in `$this::render()`.
	 * Control content can alternately be rendered in JS. See WP_Customize_Control::print_template().
	 *
	 * @since 3.4.0
	 */
	public function render_content() {
		$input_id         = '_customize-input-' . $this->id;
		$description_id   = '_customize-description-' . $this->id;
		$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . $description_id . '" ' : '';

		if ( empty( $this->choices ) ) {
			return;
		}

		?>
			<?php if ( ! empty( $this->label ) ) : ?>
				<label for="<?php echo esc_attr( $input_id ); ?>" class="customize-control-title"><?php echo esc_html( $this->label ); ?></label>
			<?php endif; ?>

			<?php if ( ! empty( $this->description ) ) : ?>
				<span id="<?php echo esc_attr( $description_id ); ?>" class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>

			<select id="<?php echo esc_attr( $input_id ); ?>" class="js-customize-control-fivetwofive-select2" <?php echo esc_attr( $describedby_attr ); ?> <?php $this->link(); ?>>
				<?php
				foreach ( $this->choices as $value => $label ) {
					echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html( $label ) . '</option>';
				}
				?>
			</select>
		<?php
	}

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @since 3.4.0
	 */
	public function enqueue() {
		wp_enqueue_style(
			'fivetwofive-customize-select2',
			get_theme_file_uri( 'lib/assets/js/plugins/select2/select2.min.css' ),
			array(),
			FIVETWOFIVE_VERSION
		);

		wp_enqueue_script(
			'fivetwofive-customize-select2',
			get_theme_file_uri( 'lib/assets/js/plugins/select2/select2.min.js' ),
			array( 'customize-controls', 'jquery', 'customize-base', 'wp-color-picker' ),
			FIVETWOFIVE_VERSION,
			false
		);

		wp_enqueue_script(
			'fivetwofive-select2-control',
			get_theme_file_uri( 'lib/assets/js/customize-select2-control.js' ),
			array( 'customize-controls', 'jquery', 'customize-base', 'fivetwofive-customize-select2' ),
			FIVETWOFIVE_VERSION,
			false
		);
	}
}
