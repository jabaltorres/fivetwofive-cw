<?php
/**
 * Plugin Name: FiveTwoFive Events Custom Post Type
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

function fivetwofive_events_cpt() {

	/**
	 * Post Type: FiveTwoFive Events.
	 */

	$labels = array(
		"name" => __( "FiveTwoFive Events", "" ),
		"singular_name" => __( "FiveTwoFive Event", "" ),
		"menu_name" => __( "FiveTwoFive Events", "" ),
		"all_items" => __( "All FiveTwoFive Events", "" ),
		"add_new" => __( "Add New FiveTwoFive Event", "" ),
		"add_new_item" => __( "Add New FiveTwoFive Event", "" ),
		"edit_item" => __( "Edit FiveTwoFive Event", "" ),
		"new_item" => __( "New FiveTwoFive Event", "" ),
		"view_item" => __( "View FiveTwoFive Event", "" ),
		"view_items" => __( "View FiveTwoFive Events", "" ),
		"search_items" => __( "Search FiveTwoFive Event", "" ),
		"not_found" => __( "FiveTwoFive Event Not Found", "" ),
		"not_found_in_trash" => __( "No FiveTwoFive Events found in trash", "" ),
		"parent_item_colon" => __( "Parent FiveTwoFive Event", "" ),
		"featured_image" => __( "Featured image for this FiveTwoFive Event", "" ),
		"set_featured_image" => __( "Set featured image for this FiveTwoFive Event", "" ),
		"remove_featured_image" => __( "Remove featured image for this FiveTwoFive Event", "" ),
		"use_featured_image" => __( "Use featured image for this FiveTwoFive Event", "" ),
		"archives" => __( "FiveTwoFive Event archives", "" ),
		"insert_into_item" => __( "Insert into FiveTwoFive Event", "" ),
		"uploaded_to_this_item" => __( "Uploaded to this FiveTwoFive Event", "" ),
		"filter_items_list" => __( "Filter FiveTwoFive Events list", "" ),
		"items_list_navigation" => __( "FiveTwoFive Events list navigation", "" ),
		"items_list" => __( "FiveTwoFive Events list", "" ),
		"attributes" => __( "FiveTwoFive Events Attributes", "" ),
		"parent_item_colon" => __( "Parent FiveTwoFive Event", "" ),
	);

	$args = array(
		"label" => __( "FiveTwoFive Events", "" ),
		"labels" => $labels,
		"description" => "FiveTwoFive Event Description",
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

	register_post_type( "fivetwofive-events", $args );
}

add_action( 'init', 'fivetwofive_events_cpt' );


//* Flush everything
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'FiveTwoFive_events_flush_rewrites' );
function FiveTwoFive_events_flush_rewrites() {
	// call your CPT registration function here (it should also be hooked into 'init')
	FiveTwoFive_events_cpt();
	flush_rewrite_rules();
}


// Custom Taxonomies
function FiveTwoFive_events_custom_taxonomies() {

	// Mood taxonomy (non-hierarchical)
	$labels = array(
		'name'                       => 'FiveTwoFive Event Custom Tags',
		'singular_name'              => 'FiveTwoFive Event Custom Tag',
		'search_items'               => 'Search FiveTwoFive Event Custom Tags',
		'popular_items'              => 'Popular FiveTwoFive Event Custom Tags',
		'all_items'                  => 'All FiveTwoFive Event Custom Tags',
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => 'Edit FiveTwoFive Event Custom Tag',
		'update_item'                => 'Update FiveTwoFive Event Custom Tag',
		'add_new_item'               => 'Add New FiveTwoFive Event Custom Tag',
		'new_item_name'              => 'New FiveTwoFive Event Custom Tag Name',
		'separate_items_with_commas' => 'Separate FiveTwoFive Event Custom Tags with commas',
		'add_or_remove_items'        => 'Add or remove FiveTwoFive Event Custom Tags',
		'choose_from_most_used'      => 'Choose from the most used FiveTwoFive Event Custom Tags',
		'not_found'                  => 'No FiveTwoFive Event Custom Tags found.',
		'menu_name'                  => 'FiveTwoFive Event Custom Tags',
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

	register_taxonomy( 'FiveTwoFive-events-custom-tag', array( 'FiveTwoFive-events', 'post' ), $args );
}

add_action( 'init', 'FiveTwoFive_events_custom_taxonomies' );