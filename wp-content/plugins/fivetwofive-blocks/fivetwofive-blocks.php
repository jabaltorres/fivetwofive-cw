<?php
/**
 * Plugin Name:       Fivetwofive Blocks
 * Description:       Open source block library for everyone
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.6
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

function fivetwofive_blocks_icons() {
	?>
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="position:absolute;width:0;height:0;overflow:hidden;display:none;">
			<symbol id="ftfb_accordion_icon_chevron" viewBox="0 0 60 25"><path d="M11.1 19.1c.7.7 1.8.7 2.5 0L24.3 8.4c.7-.7.7-1.8 0-2.5s-1.8-.7-2.5 0l-9.4 9.4L3 5.9c-.7-.7-1.8-.7-2.5 0s-.7 1.8 0 2.5l10.6 10.7zM46.3 5.9c.7-.7 1.8-.7 2.5 0l10.7 10.7c.7.7.7 1.8 0 2.5s-1.8.7-2.5 0l-9.4-9.4-9.4 9.4c-.7.7-1.8.7-2.5 0s-.7-1.8 0-2.5L46.3 5.9z"/></symbol>
			<symbol id="ftfb_accordion_icon_chevron_circle" viewBox="0 0 60 25"><path d="M12.5 25c7 0 12.5-5.6 12.5-12.5S19.5 0 12.5 0 0 5.6 0 12.5 5.6 25 12.5 25zm6-11.8c.5.5.5 1.2 0 1.7s-1.2.5-1.7 0l-4.2-4.2-4.2 4.2c-.5.5-1.2.5-1.7 0s-.5-1.2 0-1.7l5.1-5.1c.5-.5 1.2-.5 1.7 0-.1 0 4.9 5.1 5 5.1zM47.4 0c-6.9 0-12.5 5.6-12.5 12.5S40.5 25 47.4 25 60 19.4 60 12.5 54.4 0 47.4 0zm-5.9 11.8c-.5-.5-.5-1.2 0-1.7s1.2-.5 1.7 0l4.2 4.2 4.2-4.2c.5-.5 1.2-.5 1.7 0s.5 1.2 0 1.7l-5.1 5.1c-.5.5-1.2.5-1.7 0l-5-5.1z"/></symbol>
			<symbol id="ftfb_accordion_icon_plus_minus" viewBox="0 0 60 25"><path d="M14.4 1.9c0-1.1-.9-1.9-1.9-1.9s-1.9.9-1.9 1.9v8.7H1.9c-1.1 0-1.9.9-1.9 1.9s.9 1.9 1.9 1.9h8.7v8.7c0 1.1.9 1.9 1.9 1.9s1.9-.9 1.9-1.9v-8.7h8.7c1.1 0 1.9-.9 1.9-1.9s-.9-1.9-1.9-1.9h-8.7V1.9zM60 12.5c0 1.1-.9 1.9-1.9 1.9H36.9c-1.1 0-1.9-.9-1.9-1.9s.9-1.9 1.9-1.9h21.2c1 0 1.9.8 1.9 1.9z"/></symbol>
			<symbol id="ftfb_accordion_icon_plus_minus_circle" viewBox="0 0 60 25"><path d="M47.5 25C54.4 25 60 19.4 60 12.5S54.4 0 47.5 0 35 5.6 35 12.5 40.6 25 47.5 25zM44 11.3h7c.6 0 1.2.5 1.2 1.2 0 .6-.5 1.2-1.2 1.2h-7c-.6 0-1.2-.5-1.2-1.2s.5-1.2 1.2-1.2zM12.5 25C19.4 25 25 19.4 25 12.5S19.4 0 12.5 0 0 5.6 0 12.5 5.6 25 12.5 25zm-1.2-8.2v-3.1H8.2c-.6 0-1.2-.5-1.2-1.2s.5-1.2 1.2-1.2h3.1V8.2c0-.6.5-1.2 1.2-1.2.6 0 1.2.5 1.2 1.2v3.1h3.1c.6 0 1.2.5 1.2 1.2 0 .6-.5 1.2-1.2 1.2h-3.1v3.1c0 .6-.5 1.2-1.2 1.2s-1.2-.6-1.2-1.2z"/></symbol>
		</svg>
	<?php
}
add_action( 'admin_footer', 'fivetwofive_blocks_icons' );