<?php
/**
 * Plugin Name:       Fivetwofive Blocks
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       fivetwofive-blocks
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_fivetwofive_blocks_block_init() {
	register_block_type( __DIR__ . '/build/blocks/accordion' );
	register_block_type( __DIR__ . '/build/blocks/panel' );
}
add_action( 'init', 'create_block_fivetwofive_blocks_block_init' );

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