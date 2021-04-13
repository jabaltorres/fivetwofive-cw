<?php
/**
 * Plugin Name: FiveTwoFive Events Custom Post Type
 * Description: A simple plug in that adds an event custom post type
 * Version: 0.1
 * Author:  Jabal Torres
 * License: GPL2
 * Text Domain: ftf-events
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
 * Register events custom post type.
 *
 * @return void
 */
function fivetwofive_events_cpt() {

	/**
	 * Post Type: FiveTwoFive Events.
	 */
	$labels = array(
		'name'                  => __( 'FiveTwoFive Events', 'ftf-events' ),
		'singular_name'         => __( 'FiveTwoFive Event', 'ftf-events' ),
		'menu_name'             => __( 'FiveTwoFive Events', 'ftf-events' ),
		'all_items'             => __( 'All FiveTwoFive Events', 'ftf-events' ),
		'add_new'               => __( 'Add New FiveTwoFive Event', 'ftf-events' ),
		'add_new_item'          => __( 'Add New FiveTwoFive Event', 'ftf-events' ),
		'edit_item'             => __( 'Edit FiveTwoFive Event', 'ftf-events' ),
		'new_item'              => __( 'New FiveTwoFive Event', 'ftf-events' ),
		'view_item'             => __( 'View FiveTwoFive Event', 'ftf-events' ),
		'view_items'            => __( 'View FiveTwoFive Events', 'ftf-events' ),
		'search_items'          => __( 'Search FiveTwoFive Event', 'ftf-events' ),
		'not_found'             => __( 'FiveTwoFive Event Not Found', 'ftf-events' ),
		'not_found_in_trash'    => __( 'No FiveTwoFive Events found in trash', 'ftf-events' ),
		'parent_item_colon'     => __( 'Parent FiveTwoFive Event', 'ftf-events' ),
		'featured_image'        => __( 'Featured image for this FiveTwoFive Event', 'ftf-events' ),
		'set_featured_image'    => __( 'Set featured image for this FiveTwoFive Event', 'ftf-events' ),
		'remove_featured_image' => __( 'Remove featured image for this FiveTwoFive Event', 'ftf-events' ),
		'use_featured_image'    => __( 'Use featured image for this FiveTwoFive Event', 'ftf-events' ),
		'archives'              => __( 'FiveTwoFive Event archives', 'ftf-events' ),
		'insert_into_item'      => __( 'Insert into FiveTwoFive Event', 'ftf-events' ),
		'uploaded_to_this_item' => __( 'Uploaded to this FiveTwoFive Event', 'ftf-events' ),
		'filter_items_list'     => __( 'Filter FiveTwoFive Events list', 'ftf-events' ),
		'items_list_navigation' => __( 'FiveTwoFive Events list navigation', 'ftf-events' ),
		'items_list'            => __( 'FiveTwoFive Events list', 'ftf-events' ),
		'attributes'            => __( 'FiveTwoFive Events Attributes', 'ftf-events' ),
		'parent_item_colon'     => __( 'Parent FiveTwoFive Event', 'ftf-events' ),
	);

	$args = array(
		'label'               => __( 'FiveTwoFive Events', 'ftf-events' ),
		'labels'              => $labels,
		'description'         => __( 'FiveTwoFive Event Description', 'ftf-events' ),
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => false,
		'rest_base'           => '',
		'has_archive'         => false,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-megaphone',
		'show_in_nav_menus'   => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array( 'slug' => 'events', 'with_front' => false ),
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
	);

	register_post_type( 'fivetwofive-events', $args );
}
add_action( 'init', 'fivetwofive_events_cpt' );

/**
 * Register custom post type on plugin activation.
 *
 * @return void
 */
function ftf_setup_events_custom_post_type() {
	fivetwofive_events_cpt();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'ftf_setup_events_custom_post_type' );

/**
 * Unregister custom post type on plugin deactivation.
 *
 * @link https://core.trac.wordpress.org/ticket/42563
 * @return void
 */
function ftf_unregister_events_custom_post_type() {
    unregister_post_type( 'fivetwofive-events' );
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'ftf_unregister_events_custom_post_type' );