<?php
/**
 * ACF Blocks
 *
 * @package Genesis FiveTwoFive
 * @author  Danilo Parra Jr.
 * @license GPL-2.0-or-later
 * @link    https://daniloparrajr.com/
 */

add_action('acf/init', 'genesis_fivetwofive_register_acf_blocks');
/**
 * Register ACF blocks.
 *
 * @return void
 */
function genesis_fivetwofive_register_acf_blocks() {

    // Check function exists.
    if ( function_exists('acf_register_block_type') ) {
        // Register a Featured Project block.
        acf_register_block_type(array(
            'name'              => 'testimonial',
            'title'             => __('Testimonial'),
            'description'       => __('Display Testimonial'),
            'render_template'   => 'lib/acf/blocks/testimonial/testimonial.php',
			'enqueue_style'     => get_stylesheet_directory_uri() . '/lib/acf/blocks/testimonial/testimonial.css',
            'category'          => 'formatting',
            'supports'          => array(
                'align'      => false,
                'align_text' => true
            )
        ));
    }

}
