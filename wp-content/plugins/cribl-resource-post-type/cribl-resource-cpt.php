<?php
/**
 * Plugin Name: Cribl Resource Custom Post Type
 * Description: A simple plug in that adds an lp custom post type
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

function cribl_resource_cpt() {

	/**
	 * Post Type: Cribl Resource.
	 */

	$labels = array(
		"name" => __( "Cribl Resources", "" ),
		"singular_name" => __( "Cribl Resource", "" ),
		"menu_name" => __( "Cribl Resources", "" ),
		"all_items" => __( "All Cribl Resources", "" ),
		"add_new" => __( "Add New Cribl Resource", "" ),
		"add_new_item" => __( "Add New Cribl Resource", "" ),
		"edit_item" => __( "Edit Cribl Resource", "" ),
		"new_item" => __( "New Cribl Resource", "" ),
		"view_item" => __( "View Cribl Resource", "" ),
		"view_items" => __( "View Cribl Resources", "" ),
		"search_items" => __( "Search Cribl Resource", "" ),
		"not_found" => __( "Cribl Resource Not Found", "" ),
		"not_found_in_trash" => __( "No Cribl Resources found in trash", "" ),
		"parent_item_colon" => __( "Parent Cribl Resource", "" ),
		"featured_image" => __( "Featured image for this Cribl Resource", "" ),
		"set_featured_image" => __( "Set featured image for this Cribl Resource", "" ),
		"remove_featured_image" => __( "Remove featured image for this Cribl Resource", "" ),
		"use_featured_image" => __( "Use featured image for this Cribl Resource", "" ),
		"archives" => __( "Cribl Resource archives", "" ),
		"insert_into_item" => __( "Insert into Cribl Resource", "" ),
		"uploaded_to_this_item" => __( "Uploaded to this Cribl Resource", "" ),
		"filter_items_list" => __( "Filter Cribl Resources list", "" ),
		"items_list_navigation" => __( "Cribl Resources list navigation", "" ),
		"items_list" => __( "Cribl Resources list", "" ),
		"attributes" => __( "Cribl Resources Attributes", "" ),
		"parent_item_colon" => __( "Parent Cribl Resource", "" ),
	);

	$args = array(
		"label" => __( "Cribl Resources", "" ),
		"labels" => $labels,
		"description" => "Cribl Resource Description",
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

	register_post_type( "cribl-resource", $args );
}

add_action( 'init', 'cribl_resource_cpt' );


//* Flush everything
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'cribl_resource_flush_rewrites' );
function cribl_resource_flush_rewrites() {
	// call your CPT registration function here (it should also be hooked into 'init')
	cribl_resource_cpt();
	flush_rewrite_rules();
}