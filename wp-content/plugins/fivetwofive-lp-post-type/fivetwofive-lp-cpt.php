<?php
/**
 * Plugin Name: FiveTwoFive - Landing Page Custom Post Type
 * Plugin URI: https://fivetwofive.com/
 * Description: A simple plug in that adds an lp custom post type
 * Version: 0.1
 * Author: FiveTwoFive Creative Team
 * Author URI: https://fivetwofive.com/
 * License: GPL2
 * Text Domain: ftf-lps
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
 * Register FiveTwoFive LP custom post type.
 *
 * @return void
 */
function fivetwofive_lp_cpt() {

	/**
	 * Post Type: FiveTwoFive LPs.
	 */

	$labels = array(
		'name'                  => __( 'FiveTwoFive LPs', 'ftf-lps' ),
		'singular_name'         => __( 'FiveTwoFive LP', 'ftf-lps' ),
		'menu_name'             => __( 'FiveTwoFive LPs', 'ftf-lps' ),
		'all_items'             => __( 'All FiveTwoFive LPs', 'ftf-lps' ),
		'add_new'               => __( 'Add New FiveTwoFive LP', 'ftf-lps' ),
		'add_new_item'          => __( 'Add New FiveTwoFive LP', 'ftf-lps' ),
		'edit_item'             => __( 'Edit FiveTwoFive LP', 'ftf-lps' ),
		'new_item'              => __( 'New FiveTwoFive LP', 'ftf-lps' ),
		'view_item'             => __( 'View FiveTwoFive LP', 'ftf-lps' ),
		'view_items'            => __( 'View FiveTwoFive LPs', 'ftf-lps' ),
		'search_items'          => __( 'Search FiveTwoFive LP', 'ftf-lps' ),
		'not_found'             => __( 'FiveTwoFive LP Not Found', 'ftf-lps' ),
		'not_found_in_trash'    => __( 'No FiveTwoFive LPs found in trash', 'ftf-lps' ),
		'parent_item_colon'     => __( 'Parent FiveTwoFive LP', 'ftf-lps' ),
		'featured_image'        => __( 'Featured image for this FiveTwoFive LP', 'ftf-lps' ),
		'set_featured_image'    => __( 'Set featured image for this FiveTwoFive LP', 'ftf-lps' ),
		'remove_featured_image' => __( 'Remove featured image for this FiveTwoFive LP', 'ftf-lps' ),
		'use_featured_image'    => __( 'Use featured image for this FiveTwoFive LP', 'ftf-lps' ),
		'archives'              => __( 'FiveTwoFive LP archives', 'ftf-lps' ),
		'insert_into_item'      => __( 'Insert into FiveTwoFive LP', 'ftf-lps' ),
		'uploaded_to_this_item' => __( 'Uploaded to this FiveTwoFive LP', 'ftf-lps' ),
		'filter_items_list'     => __( 'Filter FiveTwoFive LPs list', 'ftf-lps' ),
		'items_list_navigation' => __( 'FiveTwoFive LPs list navigation', 'ftf-lps' ),
		'items_list'            => __( 'FiveTwoFive LPs list', 'ftf-lps' ),
		'attributes'            => __( 'FiveTwoFive LPs Attributes', 'ftf-lps' ),
		'parent_item_colon'     => __( 'Parent FiveTwoFive LP', 'ftf-lps' ),
	);

	$args = array(
		'label'               => __( 'FiveTwoFive LPs', 'ftf-lps' ),
		'labels'              => $labels,
		'description'         => __( 'FiveTwoFive LP Description', 'ftf-lps' ),
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => false,
		'rest_base'           => '',
		'has_archive'         => false,
		'show_in_menu'        => true,
		'menu_position'       => '5',
		'menu_icon'           => 'dashicons-pressthis',
		'show_in_nav_menus'   => true,
		'exclude_from_search' => false,
		'capability_type'     => "post",
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array( 'slug' => 'lp', 'with_front' => false ),
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
	);

	register_post_type( 'fivetwofive-lp', $args );
}

add_action( 'init', 'fivetwofive_lp_cpt' );


/**
 * Register custom post type on plugin activation.
 *
 * @return void
 */
function ftf_setup_fivetwofive_lp_custom_post_type() {
	fivetwofive_lp_cpt();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'ftf_setup_fivetwofive_lp_custom_post_type' );

/**
 * Unregister custom post type on plugin deactivation.
 *
 * @link https://core.trac.wordpress.org/ticket/42563
 * @return void
 */
function ftf_unregister_fivetwofive_lp_custom_post_type() {
	unregister_post_type( 'fivetwofive-lp' );
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'ftf_unregister_fivetwofive_lp_custom_post_type' );

/**
 * Don't support content editor if modules template is used in landing pages.
 *
 * @link https://developer.wordpress.org/reference/functions/remove_post_type_support/
 * @return void
 */
function ftf_remove_editor_init() {
    // If not in the admin, return.
    if ( ! is_admin() ) {
       return;
    }
 
    // Get the post ID on edit post with filter_input super global inspection.
    $current_post_id = filter_input( INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT );
    // Get the post ID on update post with filter_input super global inspection.
    $update_post_id = filter_input( INPUT_POST, 'post_ID', FILTER_SANITIZE_NUMBER_INT );
 
    // Check to see if the post ID is set, else return.
    if ( isset( $current_post_id ) ) {
       $post_id = absint( $current_post_id );
    } else if ( isset( $update_post_id ) ) {
       $post_id = absint( $update_post_id );
    } else {
       return;
    }
 
    // Don't do anything unless there is a post_id.
    if ( ! isset( $post_id ) ) {
		return;
    }

	// make sure the post type is correct.
	if ( 'fivetwofive-lp' !== get_post_type( $post_id ) ) {
		return;
	}

	// Get the template of the current post.
	$template_file = get_post_meta( $post_id, '_wp_page_template', true );

	// Example of removing page editor for page-templates/template-module.php template.
	if (  'page-templates/template-module.php' === $template_file ) {
		remove_post_type_support( 'fivetwofive-lp', 'editor' );
	}
}
add_action( 'init', 'ftf_remove_editor_init' );
