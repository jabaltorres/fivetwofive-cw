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

	/* Featured Projects Field Group
	----------------------------------------------------------------------------------------*/
	if( function_exists('acf_add_local_field_group') ):

		acf_add_local_field_group(array(
			'key' => 'group_5b78c757949e2',
			'title' => 'Featured Projects',
			'fields' => array(
				array(
					'key' => 'field_5b78c76066f15',
					'label' => 'Project Client',
					'name' => 'project_client',
					'type' => 'text',
					'instructions' => 'Add project client',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => 'add title here',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5b78c97cf09fd',
					'label' => 'Project URL',
					'name' => 'project_url',
					'type' => 'url',
					'instructions' => 'Add project url',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
				array(
					'key' => 'field_5b78ca549e71b',
					'label' => 'Project Button Text',
					'name' => 'project_button_text',
					'type' => 'text',
					'instructions' => 'Add project button text',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => 'View Project',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5c41922c64e3b',
					'label' => 'Homepage toggle',
					'name' => 'homepage_toggle',
					'type' => 'true_false',
					'instructions' => 'Choose if image is going to be on the left',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => 'The True / False field allows you to select a value that is either 1 or 0.',
					'default_value' => 1,
					'ui' => 1,
					'ui_on_text' => '',
					'ui_off_text' => '',
				),
				array(
					'key' => 'field_5c42c26b502c8',
					'label' => 'Project Featured',
					'name' => 'project_is_featured',
					'type' => 'true_false',
					'instructions' => 'Select YES if you want this project to be featured on the homepage?',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => 'project-is-featured',
						'id' => '',
					),
					'message' => 'Yes or No',
					'default_value' => 0,
					'ui' => 1,
					'ui_on_text' => '',
					'ui_off_text' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'featured-projects',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'acf_after_title',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		));

	endif;
}

add_action( 'init', 'jt_featured_projects' );


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

				echo '<a class="btn btn-primary mx-auto my-4" href="' . get_permalink( get_page_by_path( 'projects' ) ) . '">View All Projects</a>';
			echo '</div>'; // end featured-projects-inner-wrapper
		echo '</div>'; // end featured-projects-homepage-wrapper
	}
	/* END - Featured Projects */
}


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