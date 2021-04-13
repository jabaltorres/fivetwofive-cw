<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package FiveTwoFive
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses fivetwofive_header_style()
 */
function fivetwofive_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'fivetwofive_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '000000',
				'width'              => 1000,
				'height'             => 250,
				'flex-height'        => true,
				'header-text'        => false,
				'wp-head-callback'   => 'fivetwofive_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'fivetwofive_custom_header_setup' );

if ( ! function_exists( 'fivetwofive_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see fivetwofive_custom_header_setup().
	 */
	function fivetwofive_header_style() {
		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
