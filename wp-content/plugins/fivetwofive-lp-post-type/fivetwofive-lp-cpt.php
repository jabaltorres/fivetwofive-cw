<?php
/**
 * Plugin Name: FiveTwoFive LP Custom Post Type
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

function fivetwofive_lp_cpt() {

	/**
	 * Post Type: FiveTwoFive LPs.
	 */

	$labels = array(
		"name" => __( "FiveTwoFive LPs", "" ),
		"singular_name" => __( "FiveTwoFive LP", "" ),
		"menu_name" => __( "FiveTwoFive LPs", "" ),
		"all_items" => __( "All FiveTwoFive LPs", "" ),
		"add_new" => __( "Add New FiveTwoFive LP", "" ),
		"add_new_item" => __( "Add New FiveTwoFive LP", "" ),
		"edit_item" => __( "Edit FiveTwoFive LP", "" ),
		"new_item" => __( "New FiveTwoFive LP", "" ),
		"view_item" => __( "View FiveTwoFive LP", "" ),
		"view_items" => __( "View FiveTwoFive LPs", "" ),
		"search_items" => __( "Search FiveTwoFive LP", "" ),
		"not_found" => __( "FiveTwoFive LP Not Found", "" ),
		"not_found_in_trash" => __( "No FiveTwoFive LPs found in trash", "" ),
		"parent_item_colon" => __( "Parent FiveTwoFive LP", "" ),
		"featured_image" => __( "Featured image for this FiveTwoFive LP", "" ),
		"set_featured_image" => __( "Set featured image for this FiveTwoFive LP", "" ),
		"remove_featured_image" => __( "Remove featured image for this FiveTwoFive LP", "" ),
		"use_featured_image" => __( "Use featured image for this FiveTwoFive LP", "" ),
		"archives" => __( "FiveTwoFive LP archives", "" ),
		"insert_into_item" => __( "Insert into FiveTwoFive LP", "" ),
		"uploaded_to_this_item" => __( "Uploaded to this FiveTwoFive LP", "" ),
		"filter_items_list" => __( "Filter FiveTwoFive LPs list", "" ),
		"items_list_navigation" => __( "FiveTwoFive LPs list navigation", "" ),
		"items_list" => __( "FiveTwoFive LPs list", "" ),
		"attributes" => __( "FiveTwoFive LPs Attributes", "" ),
		"parent_item_colon" => __( "Parent FiveTwoFive LP", "" ),
	);

	$args = array(
		"label" => __( "FiveTwoFive LPs", "" ),
		"labels" => $labels,
		"description" => "FiveTwoFive LP Description",
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
		"rewrite" => array( "slug" => "lp", "with_front" => false ),
		"query_var" => true,
		"supports" => array( "title", "editor", "author", "thumbnail", "excerpt", "page-attributes" ),
		"taxonomies" => array( "category", "post_tag" ),
	);

	register_post_type( "fivetwofive-lp", $args );
}

add_action( 'init', 'fivetwofive_lp_cpt' );


//* Flush everything
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'fivetwofive_lp_flush_rewrites' );
function fivetwofive_lp_flush_rewrites() {
	// call your CPT registration function here (it should also be hooked into 'init')
    fivetwofive_lp_cpt();
	flush_rewrite_rules();
}