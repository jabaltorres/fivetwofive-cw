<?php
/**
 * Plugin Name: FiveTwoFive Featured Projects Custom Post Type
 * Description: A simple plug in that adds a featured project custom post type
 * Version: 0.1
 * Author:  Jabal Torres
 * License: GPL2
 * Text Domain: fivetwofive-featured-projects
 */

/*
	Copyright 2018: Jabal Torres

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 2 of the License, or
	any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program. If not, see someone who cares.
*/

/**
 * Register featured projects custom post type.
 *
 * @return void
 */
function ftf_featured_projects_register_cpt() {

	/**
	 * Post Type: Featured Projects.
	 */

	$labels = array(
		'name'                  => __( 'Featured Projects', 'jt-featured-projects' ),
		'singular_name'         => __( 'Featured Project', 'jt-featured-projects' ),
		'menu_name'             => __( 'Featured Projects', 'jt-featured-projects' ),
		'all_items'             => __( 'All Featured Projects', 'jt-featured-projects' ),
		'add_new'               => __( 'Add New Featured Project', 'jt-featured-projects' ),
		'add_new_item'          => __( 'Add New Featured Project', 'jt-featured-projects' ),
		'edit_item'             => __( 'Edit Featured Project', 'jt-featured-projects' ),
		'new_item'              => __( 'New Featured Project', 'jt-featured-projects' ),
		'view_item'             => __( 'View Featured Project', 'jt-featured-projects' ),
		'view_items'            => __( 'View Featured Projects', 'jt-featured-projects' ),
		'search_items'          => __( 'Search Featured Project', 'jt-featured-projects' ),
		'not_found'             => __( 'Featured Project Not Found', 'jt-featured-projects' ),
		'not_found_in_trash'    => __( 'No Featured Projects found in trash', 'jt-featured-projects' ),
		'parent_item_colon'     => __( 'Parent Featured Project', 'jt-featured-projects' ),
		'featured_image'        => __( 'Featured image for this Featured Project', 'jt-featured-projects' ),
		'set_featured_image'    => __( 'Set featured image for this Featured Project', 'jt-featured-projects' ),
		'remove_featured_image' => __( 'Remove featured image for this Featured Project', 'jt-featured-projects' ),
		'use_featured_image'    => __( 'Use featured image for this Featured Project', 'jt-featured-projects' ),
		'archives'              => __( 'Featured Project archives', 'jt-featured-projects' ),
		'insert_into_item'      => __( 'Insert into Featured Project', 'jt-featured-projects' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Featured Project', 'jt-featured-projects' ),
		'filter_items_list'     => __( 'Filter Featured Projects list', 'jt-featured-projects' ),
		'items_list_navigation' => __( 'Featured Projects list navigation', 'jt-featured-projects' ),
		'items_list'            => __( 'Featured Projects list', 'jt-featured-projects' ),
		'attributes'            => __( 'Featured Projects Attributes', 'jt-featured-projects' ),
		'parent_item_colon'     => __( 'Parent Featured Project', 'jt-featured-projects' ),
	);

	$args = array(
		'label'               => __( 'Featured Projects', 'jt-featured-projects' ),
		'labels'              => $labels,
		'description'         => __( 'Featured Project Description', 'jt-featured-projects' ),
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => false,
		'rest_base'           => "",
		'has_archive'         => false,
		'show_in_menu'        => true,
		'menu_position'       => '5',
		'menu_icon'           => 'dashicons-megaphone',
		'show_in_nav_menus'   => true,
		'exclude_from_search' => false,
		'capability_type'     => "post",
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array( 'slug' => 'work', 'with_front' => false ),
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
	);

	register_post_type( 'featured-projects', $args );
}
add_action( 'init', 'ftf_featured_projects_register_cpt' );

/**
 * Register custom taxonomies for featured projects custom post type.
 *
 * @return void
 */
function ftf_featured_projects_register_custom_taxonomies() {

	// Type of Product/Service taxonomy
	$labels = array(
		'name'              => __( 'Type of Products/Services', 'jt-featured-projects' ),
		'singular_name'     => __( 'Type of Product/Service', 'jt-featured-projects' ),
		'search_items'      => __( 'Search Types of Products/Services', 'jt-featured-projects' ),
		'all_items'         => __( 'All Types of Products/Services', 'jt-featured-projects' ),
		'parent_item'       => __( 'Parent Type of Product/Service', 'jt-featured-projects' ),
		'parent_item_colon' => __( 'Parent Type of Product/Service:', 'jt-featured-projects' ),
		'edit_item'         => __( 'Edit Type of Product/Service', 'jt-featured-projects' ),
		'update_item'       => __( 'Update Type of Product/Service', 'jt-featured-projects' ),
		'add_new_item'      => __( 'Add New Type of Product/Service', 'jt-featured-projects' ),
		'new_item_name'     => __( 'New Type of Product/Service Name', 'jt-featured-projects' ),
		'menu_name'         => __( 'Type of Product/Service', 'jt-featured-projects' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'product-types' ),
	);

	register_taxonomy( 'product-type', array( 'featured-projects' ), $args );

	// Mood taxonomy (non-hierarchical)
	$labels = array(
		'name'                       => __( 'JT Custom Tags', 'jt-featured-projects' ),
		'singular_name'              => __( 'JT Custom Tag', 'jt-featured-projects' ),
		'search_items'               => __( 'Search JT Custom Tags', 'jt-featured-projects' ),
		'popular_items'              => __( 'Popular JT Custom Tags', 'jt-featured-projects' ),
		'all_items'                  => __( 'All JT Custom Tags', 'jt-featured-projects' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit JT Custom Tag', 'jt-featured-projects' ),
		'update_item'                => __( 'Update JT Custom Tag', 'jt-featured-projects' ),
		'add_new_item'               => __( 'Add New JT Custom Tag', 'jt-featured-projects' ),
		'new_item_name'              => __( 'New JT Custom Tag Name', 'jt-featured-projects' ),
		'separate_items_with_commas' => __( 'Separate JT Custom Tags with commas', 'jt-featured-projects' ),
		'add_or_remove_items'        => __( 'Add or remove JT Custom Tags', 'jt-featured-projects' ),
		'choose_from_most_used'      => __( 'Choose from the most used JT Custom Tags', 'jt-featured-projects' ),
		'not_found'                  => __( 'No JT Custom Tags found.', 'jt-featured-projects' ),
		'menu_name'                  => __( 'JT Custom Tags', 'jt-featured-projects' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'jt-custom-tags' ),
	);

	register_taxonomy( 'jt-custom-tag', array( 'featured-projects', 'post' ), $args );
}
add_action( 'init', 'ftf_featured_projects_register_custom_taxonomies' );

/**
 * Register custom post type and custom taxonomy on plugin activation.
 *
 * @return void
 */
function ftf_featured_projects_setup_custom_post_type() {
	ftf_featured_projects_register_cpt();
	ftf_featured_projects_register_custom_taxonomies();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'ftf_featured_projects_setup_custom_post_type' );

/**
 * Unregister custom post type and custom taxonomy on plugin deactivation.
 *
 * @link https://core.trac.wordpress.org/ticket/42563
 * @return void
 */
function ftf_featured_projects_unregister_cpt() {
    unregister_post_type( 'featured-projects' );
	unregister_taxonomy( 'product-type' );
	unregister_taxonomy( 'jt-custom-tag' );
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'ftf_featured_projects_unregister_cpt' );

/**
 * Add featured project shortcode.
 */
function ftf_featured_projects_shortcode() {
	$projects = '';
	global $post;

	// Check for transient. If none, then execute WP_Query
	if ( false === ( $featured_projects = get_transient( 'fivetwofive_featured_projects' ) ) ) {

		$featured_projects_args = array(
			'post_type'      => 'featured-projects',
			'posts_per_page' => 3,
			'orderby'        => 'menu_order',
			'order'          => 'DESC',
			'meta_query'	 => array(
				array(
					'key'	  	=> 'project_is_featured',
					'value'	  	=> '1',
					'compare' 	=> '=',
				),
			),
		);

		$featured_projects = get_posts( $featured_projects_args );

		// Put the results in a transient. Expire after 12 hours.
		set_transient( 'fivetwofive_featured_projects', $featured_projects, 12 * HOUR_IN_SECONDS );
	}

	if  ( $featured_projects ) {
		ob_start();
		?>
		<div id="fivetwofive-featured-projects" class="fivetwofive-featured-projects featured-projects-homepage-wrapper d-block clearboth text-center">
			<div class="featured-projects-inner-wrapper py-5">
				<h4 class="title text-white"><?php echo esc_html__( 'Recent Projects', 'fivetwofive' ); ?></h4>
				<?php
					foreach ( $featured_projects as $post ) :
						setup_postdata( $post );
						get_template_part( '/includes/featured_projects_homepage_items' );
					endforeach;
					wp_reset_postdata();
				?>
				<a class="btn btn-primary mx-auto my-4" href="<?php echo esc_url(  get_permalink( get_page_by_path( 'work' ) ) ); ?>">View All Projects</a>
			</div>
		</div>
		<?php
		$projects = ob_get_clean();
	}
	return $projects;
}
add_shortcode( 'fivetwofive_featured_projects', 'ftf_featured_projects_shortcode' );

/**
 * Register ACF blocks.
 *
 * @return void
 */
function ftf_featured_projects_register_acf_blocks() {

    // Check function exists.
    if ( function_exists('acf_register_block_type') ) {

        // Register a Featured Project block.
        acf_register_block_type(array(
            'name'              => 'featured-projects',
            'title'             => __('Featured Projects'),
            'description'       => __('Display Featured Projects'),
            'render_template'   => plugin_dir_path( __FILE__ ) . 'acf/blocks/featured-projects/featured-projects.php',
			'enqueue_style'     => plugin_dir_url( __FILE__ ) . 'acf/blocks/featured-projects/featured-projects.css',
            'category'          => 'formatting',
        ));

    }

	acf_add_local_field_group(
		array(
			'key'                   => 'group_603ed99cda827',
			'title'                 => 'Block: Featured Projects',
			'fields'                => array(
				array(
					'key'               => 'field_603ed9be8fe98',
					'label'             => 'Number of Projects to show',
					'name'              => 'number_of_projects_to_show',
					'type'              => 'number',
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
					'min'               => '',
					'max'               => '',
					'step'              => '',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'block',
						'operator' => '==',
						'value'    => 'acf/featured-projects',
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
add_action('acf/init', 'ftf_featured_projects_register_acf_blocks');

/**
 * Register Featured Projects image sizes
 *
 * @return void
 */
function ftf_featured_projects_theme_setup() {
    add_image_size( 'fivetwofive-featured-project', 600, 450, true );
}
add_action( 'after_setup_theme', 'ftf_featured_projects_theme_setup' );