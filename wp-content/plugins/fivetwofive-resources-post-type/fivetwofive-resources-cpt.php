<?php
/**
 * Plugin Name: FiveTwoFive Resources Custom Post Type
 * Description: A simple plug in that adds an resources custom post type
 * Version: 0.1
 * Author:  Jabal Torres
 * License: GPL2
 */

/*
	Copyright 2020: Jabal Torres

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

function ftf_resource_cpt() {

	/**
	 * Post Type: Resources.
	 */

	$labels = array(
		"name" => __( "Resources", "" ),
		"singular_name" => __( "Resource", "" ),
		"menu_name" => __( "Resources", "" ),
		"all_items" => __( "All Resources", "" ),
		"add_new" => __( "Add New Resource", "" ),
		"add_new_item" => __( "Add New Resource", "" ),
		"edit_item" => __( "Edit Resource", "" ),
		"new_item" => __( "New Resource", "" ),
		"view_item" => __( "View Resource", "" ),
		"view_items" => __( "View Resources", "" ),
		"search_items" => __( "Search Resource", "" ),
		"not_found" => __( "Resource Not Found", "" ),
		"not_found_in_trash" => __( "No Resources found in trash", "" ),
		"parent_item_colon" => __( "Parent Resource", "" ),
		"featured_image" => __( "Featured image for this Resource", "" ),
		"set_featured_image" => __( "Set featured image for this Resource", "" ),
		"remove_featured_image" => __( "Remove featured image for this Resource", "" ),
		"use_featured_image" => __( "Use featured image for this Resource", "" ),
		"archives" => __( "Resource archives", "" ),
		"insert_into_item" => __( "Insert into Resource", "" ),
		"uploaded_to_this_item" => __( "Uploaded to this Resource", "" ),
		"filter_items_list" => __( "Filter Resources list", "" ),
		"items_list_navigation" => __( "Resources list navigation", "" ),
		"items_list" => __( "Resources list", "" ),
		"attributes" => __( "Resources Attributes", "" ),
		"parent_item_colon" => __( "Parent Resource", "" ),
	);

	$args = array(
		"label" => __( "Resources", "" ),
		"labels" => $labels,
		"description" => "Resource Description",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"menu_position" => '5',
		"menu_icon" => 'dashicons-pressthis',
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "resources", "with_front" => false ),
		"query_var" => true,
		"supports" => array( "title", "editor", "author", "thumbnail", "excerpt", "page-attributes" ),
		"taxonomies" => array( "category", "post_tag" ),
	);

	register_post_type( "resources", $args );
}

add_action( 'init', 'ftf_resource_cpt' );


//* Flush everything
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'ftf_resource_flush_rewrites' );
function ftf_resource_flush_rewrites() {
	// call your CPT registration function here (it should also be hooked into 'init')
	ftf_resource_cpt();
	flush_rewrite_rules();
}