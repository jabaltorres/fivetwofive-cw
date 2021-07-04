<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this
 * file under any circumstances. Do all modifications via a child theme.
 *
 * @package Genesis\Admin\WidgetImport
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

namespace StudioPress\Genesis\Admin\WidgetImport;

/**
 * Inserts a widget into the named sidebar by updating the `wp_options` table.
 *
 * @since 3.1.0
 *
 * @param string $sidebar The slug of the widget area to add the widget to.
 * @param string $type The type of widget. The value after 'widget_' in the
 *                     `wp_options` table option_name column.
 * @param array  $args The widget's properties. The unserialized content of a
 *                     single widget in the `widget_{$type}` row in `wp_options`.
 */
function insert_widget( $sidebar, $type, $args = [] ) {
	if ( empty( $args ) ) {
		return;
	}

	$widgets = get_option( "widget_{$type}" );

	if ( ! $widgets ) {
		$widgets = [ '_multiwidget' => 1 ];
	}

	// Store the new widget with those of the same type.
	$next_widget_id             = get_next_widget_id( $widgets );
	$widgets[ $next_widget_id ] = $args;
	update_option( "widget_{$type}", $widgets );

	// Add the new widget to the given sidebar.
	$sidebars               = get_option( 'sidebars_widgets', [] );
	$sidebars[ $sidebar ][] = "{$type}-{$next_widget_id}";
	update_option( 'sidebars_widgets', $sidebars );
}

/**
 * Clears widgets from named widget areas, moving widgets they contain
 * to the 'Inactive Widgets' area.
 *
 * @since 3.1.0
 *
 * @param array $areas The widget areas to remove widgets from.
 */
function clear_widget_areas( $areas = [] ) {
	$sidebars = get_option( 'sidebars_widgets', [] );

	foreach ( $areas as $area ) {
		if ( ! isset( $sidebars[ $area ] ) ) {
			continue;
		}
		if ( 'wp_inactive_widgets' === $area ) {
			continue;
		}
		$sidebars['wp_inactive_widgets'] = array_merge(
			$sidebars['wp_inactive_widgets'],
			$sidebars[ $area ]
		);
		unset( $sidebars[ $area ] );
	}

	update_option( 'sidebars_widgets', $sidebars );
}

/**
 * Gets the next widget ID for widgets of a given type.
 *
 * This is the ID that would be used to insert a new widget of that type into
 * the `widget_[type]` row in the `wp_options` table.
 *
 * Since 3.1.0
 *
 * @param array $widgets Widgets of one type, typically retrieved via
 *                       `get_option( "widget_[type]" );`.
 * @return int The next ID to use for a new widget.
 */
function get_next_widget_id( $widgets ) {
	// Strip non-numeric keys such as '_multiwidget'.
	$widgets = array_filter( $widgets, 'is_numeric', ARRAY_FILTER_USE_KEY );

	if ( ! $widgets ) {
		return 1;
	}

	ksort( $widgets ); // Highest index last.
	end( $widgets ); // Pointer to last widget.

	return key( $widgets ) + 1;
}

/**
 * Swaps placeholder strings representing an imported post with the post's ID.
 *
 * Strings of the form '$imported_posts_slug' are replaced by the value
 * of `$imported_posts['slug']`.
 *
 * For example, an onboarding config might add a Featured Page widget with the
 * `page_id` of an 'about' page that will be imported during theme setup:
 *
 * [
 *  'type' => 'featured-page',
 *  'args' => [
 *      'title'           => 'A Genesis Featured Page Widget',
 *      'page_id'         => '$imported_posts_about',
 *      'show_image'      => 1,
 *      'image_size'      => 'featured-image',
 *      'image_alignment' => 'aligncenter',
 *      'show_title'      => 1,
 *      'content_limit'   => '',
 *      'more_text'       => '',
 *  ],
 * ],
 *
 * @since 3.1.0
 *
 * @param array $widget_arguments Properties of a single widget.
 * @param array $imported_posts Imported posts with content short name as keys and IDs as values.
 * @return array Widget arguments with placeholder strings replaced with imported IDs.
 */
function swap_placeholders( $widget_arguments, $imported_posts ) {
	foreach ( $widget_arguments as $key => $value ) {

		if ( ! is_string( $value ) ) {
			continue;
		}

		if ( false === strpos( $value, '$imported_posts_' ) ) {
			continue;
		}

		$post_slug = str_replace( '$imported_posts_', '', trim( $value ) );

		if ( isset( $imported_posts[ $post_slug ] ) ) {
			$widget_arguments[ $key ] = $imported_posts[ $post_slug ];
		} else {
			$widget_arguments[ $key ] = '';
		}

	}

	return $widget_arguments;
}
