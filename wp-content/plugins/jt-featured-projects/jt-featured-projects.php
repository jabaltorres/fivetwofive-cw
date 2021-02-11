<?php
/**
 * Plugin Name: JT's Featured Projects Custom Post Type
 * Description: A simple plug in that adds a featured project custom post type
 * Version: 0.1
 * Author:  Jabal Torres
 * License: GPL2
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

function jt_featured_projects() {

	/**
	 * Post Type: Featured Projects.
	 */

	$labels = array(
		"name" => __( "Featured Projects", "" ),
		"singular_name" => __( "Featured Project", "" ),
		"menu_name" => __( "Featured Projects", "" ),
		"all_items" => __( "All Featured Projects", "" ),
		"add_new" => __( "Add New Featured Project", "" ),
		"add_new_item" => __( "Add New Featured Project", "" ),
		"edit_item" => __( "Edit Featured Project", "" ),
		"new_item" => __( "New Featured Project", "" ),
		"view_item" => __( "View Featured Project", "" ),
		"view_items" => __( "View Featured Projects", "" ),
		"search_items" => __( "Search Featured Project", "" ),
		"not_found" => __( "Featured Project Not Found", "" ),
		"not_found_in_trash" => __( "No Featured Projects found in trash", "" ),
		"parent_item_colon" => __( "Parent Featured Project", "" ),
		"featured_image" => __( "Featured image for this Featured Project", "" ),
		"set_featured_image" => __( "Set featured image for this Featured Project", "" ),
		"remove_featured_image" => __( "Remove featured image for this Featured Project", "" ),
		"use_featured_image" => __( "Use featured image for this Featured Project", "" ),
		"archives" => __( "Featured Project archives", "" ),
		"insert_into_item" => __( "Insert into Featured Project", "" ),
		"uploaded_to_this_item" => __( "Uploaded to this Featured Project", "" ),
		"filter_items_list" => __( "Filter Featured Projects list", "" ),
		"items_list_navigation" => __( "Featured Projects list navigation", "" ),
		"items_list" => __( "Featured Projects list", "" ),
		"attributes" => __( "Featured Projects Attributes", "" ),
		"parent_item_colon" => __( "Parent Featured Project", "" ),
	);

	$args = array(
		"label" => __( "Featured Projects", "" ),
		"labels" => $labels,
		"description" => "Featured Project Description",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"menu_position" => '5',
		"menu_icon" => 'dashicons-megaphone',
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "work", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "author", "thumbnail", "excerpt", "page-attributes" ),
		"taxonomies" => array( "category", "post_tag" ),
	);

	register_post_type( "featured-projects", $args );
}
add_action( 'init', 'jt_featured_projects' );

//* Flush everything
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'myplugin_flush_rewrites' );

function myplugin_flush_rewrites() {
	// call your CPT registration function here (it should also be hooked into 'init')
	jt_featured_projects();
	flush_rewrite_rules();
}


// Custom Taxonomies
function jt_custom_taxonomies() {

	// Type of Product/Service taxonomy
	$labels = array(
		'name'              => 'Type of Products/Services',
		'singular_name'     => 'Type of Product/Service',
		'search_items'      => 'Search Types of Products/Services',
		'all_items'         => 'All Types of Products/Services',
		'parent_item'       => 'Parent Type of Product/Service',
		'parent_item_colon' => 'Parent Type of Product/Service:',
		'edit_item'         => 'Edit Type of Product/Service',
		'update_item'       => 'Update Type of Product/Service',
		'add_new_item'      => 'Add New Type of Product/Service',
		'new_item_name'     => 'New Type of Product/Service Name',
		'menu_name'         => 'Type of Product/Service',
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
		'name'                       => 'JT Custom Tags',
		'singular_name'              => 'JT Custom Tag',
		'search_items'               => 'Search JT Custom Tags',
		'popular_items'              => 'Popular JT Custom Tags',
		'all_items'                  => 'All JT Custom Tags',
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => 'Edit JT Custom Tag',
		'update_item'                => 'Update JT Custom Tag',
		'add_new_item'               => 'Add New JT Custom Tag',
		'new_item_name'              => 'New JT Custom Tag Name',
		'separate_items_with_commas' => 'Separate JT Custom Tags with commas',
		'add_or_remove_items'        => 'Add or remove JT Custom Tags',
		'choose_from_most_used'      => 'Choose from the most used JT Custom Tags',
		'not_found'                  => 'No JT Custom Tags found.',
		'menu_name'                  => 'JT Custom Tags',
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

add_action( 'init', 'jt_custom_taxonomies' );

/**
 * Add featured project section in the homepage.
 */
function fivetwofive_featured_projects_section() {
	global $post;

	if ( ! is_front_page() ) {
		return;
	}

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
		<div id="front-page-featured-projects" class="front-page-featured-projects featured-projects-homepage-wrapper d-block clearboth text-center">
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
		echo ob_get_clean();
	}
}
add_action( 'fivetwofive_front_page_before_widget_4', 'fivetwofive_featured_projects_section' );