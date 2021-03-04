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
        // Register a Testimonial block.
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

    acf_add_local_field_group(
        array(
            'key'                   => 'group_603f899c07f11',
            'title'                 => 'Block: Testimonial',
            'fields'                => array(
                array(
                    'key'               => 'field_603f89b93ef28',
                    'label'             => 'Message',
                    'name'              => 'message',
                    'type'              => 'textarea',
                    'instructions'      => '',
                    'required'          => 0,
                    'conditional_logic' => 0,
                    'wrapper'           => array(
                        'width' => '',
                        'class' => '',
                        'id'    => '',
                    ),
                    'default_value'     => '',
                    'placeholder'       => '',
                    'maxlength'         => '',
                    'rows'              => '',
                    'new_lines'         => '',
                ),
                array(
                    'key'               => 'field_603f89cc3ef29',
                    'label'             => 'Name',
                    'name'              => 'name',
                    'type'              => 'text',
                    'instructions'      => '',
                    'required'          => 0,
                    'conditional_logic' => 0,
                    'wrapper'           => array(
                        'width' => '',
                        'class' => '',
                        'id'    => '',
                    ),
                    'default_value'     => '',
                    'placeholder'       => '',
                    'prepend'           => '',
                    'append'            => '',
                    'maxlength'         => '',
                ),
                array(
                    'key'               => 'field_603f89d23ef2a',
                    'label'             => 'Job Title',
                    'name'              => 'job_title',
                    'type'              => 'text',
                    'instructions'      => '',
                    'required'          => 0,
                    'conditional_logic' => 0,
                    'wrapper'           => array(
                        'width' => '',
                        'class' => '',
                        'id'    => '',
                    ),
                    'default_value'     => '',
                    'placeholder'       => '',
                    'prepend'           => '',
                    'append'            => '',
                    'maxlength'         => '',
                ),
                array(
                    'key'               => 'field_603f8a5c180ba',
                    'label'             => 'Avatar',
                    'name'              => 'avatar',
                    'type'              => 'image',
                    'instructions'      => '',
                    'required'          => 0,
                    'conditional_logic' => 0,
                    'wrapper'           => array(
                        'width' => '',
                        'class' => '',
                        'id'    => '',
                    ),
                    'return_format'     => 'id',
                    'preview_size'      => 'thumbnail',
                    'library'           => 'all',
                    'min_width'         => '',
                    'min_height'        => '',
                    'min_size'          => '',
                    'max_width'         => '',
                    'max_height'        => '',
                    'max_size'          => '',
                    'mime_types'        => '',
                ),
            ),
            'location'              => array(
                array(
                    array(
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => 'acf/testimonial',
                    ),
                ),
            ),
            'menu_order'            => 0,
            'position'              => 'normal',
            'style'                 => 'default',
            'label_placement'       => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen'        => '',
            'active'                => true,
            'description'           => '',
        )
    );

}
