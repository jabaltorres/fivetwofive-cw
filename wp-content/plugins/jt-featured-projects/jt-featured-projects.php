<?php
/**
 * Plugin Name: JT's Featured Projects Custom Post Type
 * Description: A simple plug in that adds a featured project custom post type
 * Version: 0.1
 * Author:  Jabal Torres
 * License: GPL2
 * Text Domain: jt-featured-projects
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
function jtfp_featured_projects() {

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
		'rewrite'             => array( 'slug' => 'work', 'with_front' => true ),
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
	);

	register_post_type( 'featured-projects', $args );
}
add_action( 'init', 'jtfp_featured_projects' );

/**
 * Register custom taxonomies for featured projects custom post type.
 *
 * @return void
 */
function jtfp_featured_projects_taxonomies() {

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
add_action( 'init', 'jtfp_featured_projects_taxonomies' );


//* Add Featured Projects to home page
add_action('genesis_after_content', 'featured_projects_loop_homepage');

function featured_projects_loop_homepage(){
	/* START - Featured Projects */
	$featured_projects_args = array(
		'post_type'  => 'featured-projects',
		'posts_per_page' => 3,
		'orderby' => 'menu_order',
		'order' => 'DESC',
		'meta_query'	=> array(
			array(
				'key'	  	=> 'project_is_featured',
				'value'	  	=> '1',
				'compare' 	=> '=',
			),
		),
	);

	$featured_projects = new WP_Query($featured_projects_args);

	$featured_projects_title = "Recent Projects";

	if  ( ($featured_projects -> have_posts()) && is_front_page()) {
		echo '<div class="featured-projects-homepage-wrapper d-block clearboth text-center">';
			echo '<div class="featured-projects-inner-wrapper py-5">';
				echo '<h4 class="title text-white">' . $featured_projects_title .'</h4>';

				while ($featured_projects -> have_posts()) : $featured_projects ->the_post();
					get_template_part( '/includes/featured_projects_homepage_items');
				endwhile;

				echo '<a class="btn btn-primary mx-auto my-4" href="' . get_permalink( get_page_by_path( 'work' ) ) . '">View All Projects</a>';
			echo '</div>'; // end featured-projects-inner-wrapper
		echo '</div>'; // end featured-projects-homepage-wrapper
	}
	/* END - Featured Projects */
}

/**
 * Register custom post type and custom taxonomy on plugin activation.
 *
 * @return void
 */
function jtfp_setup_custom_post_type() {
	jtfp_featured_projects();
	jtfp_featured_projects_taxonomies();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'jtfp_setup_custom_post_type' );

/**
 * Unregister custom post type and custom taxonomy on plugin deactivation.
 *
 * @link https://core.trac.wordpress.org/ticket/42563
 * @return void
 */
function jtfp_unregister_custom_post_type() {
    unregister_post_type( 'featured-projects' );
	unregister_taxonomy( 'product-type' );
	unregister_taxonomy( 'jt-custom-tag' );
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'jtfp_unregister_custom_post_type' );