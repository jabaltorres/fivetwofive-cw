<?php
/**
 * Plugin Name: Template Column Display
 * Plugin URI:  https://fivetwofive.com/
 * Description: Adds a sortable column in the Pages admin area to display the template used for each page.
 * Version:     1.0.0
 * Author:      Jabal Torres
 * Author URI:  https://jabaltorres.com/
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Ensure direct file access is prevented.
defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

/**
 * Add a new column for page template to the Pages admin area.
 */
function add_template_column( $columns ) {
    $columns['page_template'] = 'Template';
    return $columns;
}
add_filter( 'manage_pages_columns', 'add_template_column' );

/**
 * Display the page template for each page in our custom column.
 */
function display_template_column( $column, $post_id ) {
    if ( 'page_template' === $column ) {
        $template = get_post_meta( $post_id, '_wp_page_template', true );
        if ( $template ) {
            $all_templates = get_page_templates( get_post( $post_id ) );
            echo isset( $all_templates[ $template ] ) ? $all_templates[ $template ] : $template;
        } else {
            echo 'Default Template';
        }
    }
}
add_action( 'manage_pages_custom_column', 'display_template_column', 10, 2 );

/**
 * Make our custom 'Template' column sortable.
 */
function make_template_column_sortable( $columns ) {
    $columns['page_template'] = 'page_template';
    return $columns;
}
add_filter( 'manage_edit-page_sortable_columns', 'make_template_column_sortable' );

/**
 * Adjust the main query when pages are sorted by template in the admin area.
 */
function sort_pages_by_template( $query ) {
    if ( ! is_admin() ) {
        return;
    }

    $orderby = $query->get( 'orderby' );
    if ( 'page_template' === $orderby ) {
        $query->set( 'meta_key', '_wp_page_template' );
        $query->set( 'orderby', 'meta_value' );
    }
}
add_action( 'pre_get_posts', 'sort_pages_by_template' );
