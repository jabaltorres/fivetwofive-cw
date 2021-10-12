<?php
/**
 * FiveTwoFive Theme Admin
 *
 * @package FiveTwoFive_Theme
 */

/**
 * Enqueue Admin stylesheet.
 */
function fivetwofive_theme_admin_styles() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/assets/dist/css/admin/admin.css', array( 'acf-pro-input' ), FIVETWOFIVE_THEME_VERSION );
}
add_action( 'admin_enqueue_scripts', 'fivetwofive_theme_admin_styles' );

/**
 * Make the page-template column sortable in admin pages table.
 *
 * @param array $columns array of columns.
 * @return array $columns updated columns with page-template set as sortable.
 */
function fivetwofive_sortable_page_template_column( $columns ) {
	$columns['page-template'] = 'page-template';
	return $columns;
}
add_filter( 'manage_edit-page_sortable_columns', 'fivetwofive_sortable_page_template_column' );

/**
 * Sort the pages table by page template.
 *
 * @param object $query instance of WP_Query class.
 * @return void
 */
function fivetwofive_sort_page_template_column_query( $query ) {
	global $pagenow;

	if ( is_admin() && 'edit.php' === $pagenow && 'page' === $_GET['post_type'] ) {
		$orderby = $query->get( 'orderby' );

		if ( 'page-template' === $orderby ) {
			$query->set( 'meta_key', '_wp_page_template' );
			$query->set( 'orderby', 'meta_value' );
		}
	}
}
add_action( 'pre_get_posts', 'fivetwofive_sort_page_template_column_query' );

/**
 * Custom Column with Currently Active Page Template
 * https://www.isitwp.com/custom-column-with-currently-active-page-template/
 */
function fivetwofive_page_column_views( $defaults ) {
	$defaults['page-template'] = __( 'Template' );
	return $defaults;
}
add_filter( 'manage_pages_columns', 'fivetwofive_page_column_views' );

/**
 * Undocumented function
 *
 * @param [type] $column_name
 * @param [type] $id
 * @return void
 */
function fivetwofive_page_template_views( $column_name, $id ) {
	if ( 'page-template' === $column_name ) {
		$set_template = get_post_meta( $id, '_wp_page_template', true );

		if ( 'default' === $set_template ) {
			echo 'Default';
		}

		$templates = get_page_templates();

		ksort( $templates );

		foreach ( array_keys( $templates ) as $template ) {
			if ( $set_template === $templates[ $template ] ) {
				echo esc_html( $template );
			}
		}
	}
}
add_action( 'manage_pages_custom_column', 'fivetwofive_page_template_views', 5, 2 );
