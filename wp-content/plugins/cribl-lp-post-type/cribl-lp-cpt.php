<?php
/**
 * Plugin Name: Cribl LP Custom Post Type
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

function cribl_lp_cpt() {

	/**
	 * Post Type: Cribl LPs.
	 */

	$labels = array(
		"name" => __( "Cribl LPs", "" ),
		"singular_name" => __( "Cribl LP", "" ),
		"menu_name" => __( "Cribl LPs", "" ),
		"all_items" => __( "All Cribl LPs", "" ),
		"add_new" => __( "Add New Cribl LP", "" ),
		"add_new_item" => __( "Add New Cribl LP", "" ),
		"edit_item" => __( "Edit Cribl LP", "" ),
		"new_item" => __( "New Cribl LP", "" ),
		"view_item" => __( "View Cribl LP", "" ),
		"view_items" => __( "View Cribl LPs", "" ),
		"search_items" => __( "Search Cribl LP", "" ),
		"not_found" => __( "Cribl LP Not Found", "" ),
		"not_found_in_trash" => __( "No Cribl LPs found in trash", "" ),
		"parent_item_colon" => __( "Parent Cribl LP", "" ),
		"featured_image" => __( "Featured image for this Cribl LP", "" ),
		"set_featured_image" => __( "Set featured image for this Cribl LP", "" ),
		"remove_featured_image" => __( "Remove featured image for this Cribl LP", "" ),
		"use_featured_image" => __( "Use featured image for this Cribl LP", "" ),
		"archives" => __( "Cribl LP archives", "" ),
		"insert_into_item" => __( "Insert into Cribl LP", "" ),
		"uploaded_to_this_item" => __( "Uploaded to this Cribl LP", "" ),
		"filter_items_list" => __( "Filter Cribl LPs list", "" ),
		"items_list_navigation" => __( "Cribl LPs list navigation", "" ),
		"items_list" => __( "Cribl LPs list", "" ),
		"attributes" => __( "Cribl LPs Attributes", "" ),
		"parent_item_colon" => __( "Parent Cribl LP", "" ),
	);

	$args = array(
		"label" => __( "Cribl LPs", "" ),
		"labels" => $labels,
		"description" => "Cribl LP Description",
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

	register_post_type( "cribl-lp", $args );
}

add_action( 'init', 'cribl_lp_cpt' );


//* Flush everything
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'cribl_lp_flush_rewrites' );
function cribl_lp_flush_rewrites() {
	// call your CPT registration function here (it should also be hooked into 'init')
	cribl_lp_cpt();
	flush_rewrite_rules();
}