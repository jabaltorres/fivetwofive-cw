<?php
/**
 * Plugin Name: FiveTwoFive - Resource Custom Post Type
 * Plugin URI: https://fivetwofive.com/
 * Description: A simple plug in that adds an resources custom post type
 * Version: 0.1
 * Author: FiveTwoFive Creative Team
 * Author URI: https://fivetwofive.com/
 * License: GPL2
 * Text Domain: ftf-resources
 */

/*
	Copyright 2020: FiveTwoFive Creative Team

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
 * Register resource custom post type.
 *
 * @return void
 */
function ftf_register_resource_cpt() {

	/**
	 * Post Type: Resource.
	 */

	$labels = array(
		'name'                  => __( 'Resources', 'ftf-resources' ),
		'singular_name'         => __( 'Resource', 'ftf-resources' ),
		'menu_name'             => __( 'Resources', 'ftf-resources' ),
		'all_items'             => __( 'All Resources', 'ftf-resources' ),
		'add_new'               => __( 'Add New Resource', 'ftf-resources' ),
		'add_new_item'          => __( 'Add New Resource', 'ftf-resources' ),
		'edit_item'             => __( 'Edit Resource', 'ftf-resources' ),
		'new_item'              => __( 'New Resource', 'ftf-resources' ),
		'view_item'             => __( 'View Resource', 'ftf-resources' ),
		'view_items'            => __( 'View Resources', 'ftf-resources' ),
		'search_items'          => __( 'Search Resource', 'ftf-resources' ),
		'not_found'             => __( 'Resource Not Found', 'ftf-resources' ),
		'not_found_in_trash'    => __( 'No Resources found in trash', 'ftf-resources' ),
		'parent_item_colon'     => __( 'Parent Resource', 'ftf-resources' ),
		'featured_image'        => __( 'Featured image for this Resource', 'ftf-resources' ),
		'set_featured_image'    => __( 'Set featured image for this Resource', 'ftf-resources' ),
		'remove_featured_image' => __( 'Remove featured image for this Resource', 'ftf-resources' ),
		'use_featured_image'    => __( 'Use featured image for this Resource', 'ftf-resources' ),
		'archives'              => __( 'Resource archives', 'ftf-resources' ),
		'insert_into_item'      => __( 'Insert into Resource', 'ftf-resources' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Resource', 'ftf-resources' ),
		'filter_items_list'     => __( 'Filter Resources list', 'ftf-resources' ),
		'items_list_navigation' => __( 'Resources list navigation', 'ftf-resources' ),
		'items_list'            => __( 'Resources list', 'ftf-resources' ),
		'attributes'            => __( 'Resources Attributes', 'ftf-resources' ),
		'parent_item_colon'     => __( 'Parent Resource', 'ftf-resources' ),
	);

	$args = array(
		'label'               => __( 'Resources', 'ftf-resources' ),
		'labels'              => $labels,
		'description'         => __( 'Resource Description', 'ftf-resources' ),
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'rest_base'           => 'ftf-resources',
		'has_archive'         => false,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-pressthis',
		'show_in_nav_menus'   => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array(
			'slug'       => 'resources',
			'with_front' => false,
		),
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'ftf_resource', $args );

	unset( $args );
	unset( $labels );

	$labels = array(
		'name'              => _x( 'Types', 'taxonomy general name', 'ftf-resources' ),
		'singular_name'     => _x( 'Type', 'taxonomy singular name', 'ftf-resources' ),
		'search_items'      => __( 'Search Types', 'ftf-resources' ),
		'all_items'         => __( 'All Types', 'ftf-resources' ),
		'parent_item'       => __( 'Parent Type', 'ftf-resources' ),
		'parent_item_colon' => __( 'Parent Type:', 'ftf-resources' ),
		'edit_item'         => __( 'Edit Type', 'ftf-resources' ),
		'update_item'       => __( 'Update Type', 'ftf-resources' ),
		'add_new_item'      => __( 'Add New Type', 'ftf-resources' ),
		'new_item_name'     => __( 'New Type Name', 'ftf-resources' ),
		'menu_name'         => __( 'Types', 'ftf-resources' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => true,
		'rest_base'         => 'ftf-resource-types',
		'rewrite'           => array(
			'slug'       => 'type',
			'with_front' => false,
		),
		'default_term'      => array(
			'name' => __( 'Uncategorized', 'ftf-resources' ),
			'slug' => 'uncategorized',
		),
	);

	register_taxonomy( 'ftf_resource_type', 'ftf_resource', $args );
}
add_action( 'init', 'ftf_register_resource_cpt' );

/**
 * Register custom post type on plugin activation.
 *
 * @return void
 */
function ftf_setup_resources_custom_post_type() {
	ftf_register_resource_cpt();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'ftf_setup_resources_custom_post_type' );

/**
 * Unregister custom post type on plugin deactivation.
 *
 * @link https://core.trac.wordpress.org/ticket/42563
 * @return void
 */
function ftf_unregister_resource_custom_post_type() {
	unregister_post_type( 'ftf_resource' );
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'ftf_unregister_resource_custom_post_type' );

/**
 * Add resource item thumbnail.
 */
function ftf_resource_image_size() {
	add_image_size( 'ftf-resource-thumb', 415, 245, true );
}
add_action( 'after_setup_theme', 'ftf_resource_image_size' );

/**
 * Add resource post meta in fivetwofive theme.
 *
 * @param int    $post_item_id post item id.
 * @param string $post_type post type.
 * @return void
 */
function ftf_resource_post_meta( $post_item_id, $post_type ) {
	if ( 'ftf_resource' === $post_type ) {
		ob_start();
		fivetwofive_theme_posted_on( $post_item_id );
		echo ob_get_clean();
	}
}
add_action( 'fivetwofive_theme_after_post_meta', 'ftf_resource_post_meta', 10, 2 );

/**
 * Add ftf_resource post type to have formatted date field in rest API.
 *
 * @param array $post_array post array.
 * @return array $post_array post array.
 */
function ftf_resource_rest_api_formatted_date_field( $post_array ) {
	$post_array[] = 'ftf_resource';
	return $post_array;
}
add_filter( 'fivetwofive_rest_api_formatted_date', 'ftf_resource_rest_api_formatted_date_field' );
