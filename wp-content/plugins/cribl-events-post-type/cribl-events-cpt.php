<?php
/**
 * Plugin Name: Cribl Events Custom Post Type
 * Description: A simple plug in that adds an event custom post type
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

function cribl_events_cpt() {

	/**
	 * Post Type: Cribl Events.
	 */

	$labels = array(
		"name" => __( "Cribl Events", "" ),
		"singular_name" => __( "Cribl Event", "" ),
		"menu_name" => __( "Cribl Events", "" ),
		"all_items" => __( "All Cribl Events", "" ),
		"add_new" => __( "Add New Cribl Event", "" ),
		"add_new_item" => __( "Add New Cribl Event", "" ),
		"edit_item" => __( "Edit Cribl Event", "" ),
		"new_item" => __( "New Cribl Event", "" ),
		"view_item" => __( "View Cribl Event", "" ),
		"view_items" => __( "View Cribl Events", "" ),
		"search_items" => __( "Search Cribl Event", "" ),
		"not_found" => __( "Cribl Event Not Found", "" ),
		"not_found_in_trash" => __( "No Cribl Events found in trash", "" ),
		"parent_item_colon" => __( "Parent Cribl Event", "" ),
		"featured_image" => __( "Featured image for this Cribl Event", "" ),
		"set_featured_image" => __( "Set featured image for this Cribl Event", "" ),
		"remove_featured_image" => __( "Remove featured image for this Cribl Event", "" ),
		"use_featured_image" => __( "Use featured image for this Cribl Event", "" ),
		"archives" => __( "Cribl Event archives", "" ),
		"insert_into_item" => __( "Insert into Cribl Event", "" ),
		"uploaded_to_this_item" => __( "Uploaded to this Cribl Event", "" ),
		"filter_items_list" => __( "Filter Cribl Events list", "" ),
		"items_list_navigation" => __( "Cribl Events list navigation", "" ),
		"items_list" => __( "Cribl Events list", "" ),
		"attributes" => __( "Cribl Events Attributes", "" ),
		"parent_item_colon" => __( "Parent Cribl Event", "" ),
	);

	$args = array(
		"label" => __( "Cribl Events", "" ),
		"labels" => $labels,
		"description" => "Cribl Event Description",
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
		"rewrite" => array( "slug" => "events", "with_front" => false ),
		"query_var" => true,
		"supports" => array( "title", "editor", "author", "thumbnail", "excerpt", "page-attributes" ),
		"taxonomies" => array( "category", "post_tag" ),
	);

	register_post_type( "cribl-events", $args );
}

add_action( 'init', 'cribl_events_cpt' );


//* Flush everything
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'cribl_events_flush_rewrites' );
function cribl_events_flush_rewrites() {
	// call your CPT registration function here (it should also be hooked into 'init')
	cribl_events_cpt();
	flush_rewrite_rules();
}


// Custom Taxonomies
function cribl_events_custom_taxonomies() {

	// Mood taxonomy (non-hierarchical)
	$labels = array(
		'name'                       => 'Cribl Event Custom Tags',
		'singular_name'              => 'Cribl Event Custom Tag',
		'search_items'               => 'Search Cribl Event Custom Tags',
		'popular_items'              => 'Popular Cribl Event Custom Tags',
		'all_items'                  => 'All Cribl Event Custom Tags',
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => 'Edit Cribl Event Custom Tag',
		'update_item'                => 'Update Cribl Event Custom Tag',
		'add_new_item'               => 'Add New Cribl Event Custom Tag',
		'new_item_name'              => 'New Cribl Event Custom Tag Name',
		'separate_items_with_commas' => 'Separate Cribl Event Custom Tags with commas',
		'add_or_remove_items'        => 'Add or remove Cribl Event Custom Tags',
		'choose_from_most_used'      => 'Choose from the most used Cribl Event Custom Tags',
		'not_found'                  => 'No Cribl Event Custom Tags found.',
		'menu_name'                  => 'Cribl Event Custom Tags',
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'events-tags', 'with_front' => false ),
	);

	register_taxonomy( 'cribl-events-custom-tag', array( 'cribl-events', 'post' ), $args );
}

add_action( 'init', 'cribl_events_custom_taxonomies' );