<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * <?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package FiveTwoFive
 */

namespace Fivetwofive\CustomHeader;

use Fivetwofive\Component_Interface;

/**
 * Undocumented class
 */
class CustomHeader implements Component_Interface {

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'after_setup_theme', array( $this, 'custom_header_setup' ) );
	}

	/**
	 * Set up the WordPress core custom header feature.
	 *
	 * @uses fivetwofive_header_style()
	 */
	public function custom_header_setup() {
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
					'wp-head-callback'   => array( $this, 'header_style' ),
				)
			)
		);
	}

	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see fivetwofive_custom_header_setup().
	 */
	public function header_style() {
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

}
