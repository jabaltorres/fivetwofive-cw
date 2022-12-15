<?php
/**
 * Plugin Name:       Fivetwofive Blocks
 * Description:       Open source block library for everyone
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.2
 * Author:            FiveTwoFive Creative
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       fivetwofive-blocks
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function ftfb_create_block_init() {
	$ftf_blocks = array(
		array(
			'name'            => 'accordion',
			'render_callback' => true,
		),
		array(
			'name'            => 'panel',
			'render_callback' => true,
		)
	);

	foreach ( $ftf_blocks as $ftf_block ) {
		$args = array();

		if ( isset( $ftf_block['render_callback'] ) && true === $ftf_block['render_callback'] ) {
			$render_callback = function( $attributes, $content, $block ) use ( $ftf_block ) {
				ob_start();
				require plugin_dir_path( __FILE__ ) . 'src/blocks/' . $ftf_block['name'] . '/render.php';
				return ob_get_clean();
			};

			$args['render_callback'] = $render_callback;
		}

		register_block_type( __DIR__ . '/build/blocks/' . $ftf_block['name'], $args );
	}

}
add_action( 'init', 'ftfb_create_block_init' );

/**
 * Adding FiveTwoFive Blocks category.
 *
 * @param array $block_categories Array of categories for block types.
 */
function fivetwofive_blocks_add_new_block_category( array $block_categories ) {
	return array_merge(
		$block_categories,
		[
			[
				'slug'  => 'fivetwofive-blocks',
				'title' => esc_html__( 'FiveTwoFive Blocks', 'fivetwofive-blocks' ),
				'icon'  => 'wordpress', // Slug of a WordPress Dashicon or custom SVG
			],
		]
	);
}

add_filter( 'block_categories_all', 'fivetwofive_blocks_add_new_block_category' );