<?php

/**
 * Add a Formatted Date to the WordPress REST API JSON Post Object
 */
function fivetwofive_theme_rest_api_init() {
	register_rest_field(
		apply_filters( 'fivetwofive_rest_api_formatted_date', array( 'post' ) ),
		'ftf_formatted_date',
		array(
			'get_callback'    => function() {
				$date_format = get_option( 'date_format' );
				return get_the_date( $date_format );
			},
			'update_callback' => null,
			'schema'          => null,
		)
	);

	register_rest_field(
		apply_filters( 'fivetwofive_rest_api_ftf_resource_categories', array( 'ftf_resource' ) ),
		'ftf_resource_categories',
		array(
			'get_callback'    => function() {
				$resource_categories = get_the_terms( get_the_ID(), 'ftf_resource_category' );
				$categories          = array();

				foreach ( $resource_categories as $resource_category ) {
					$categories[] = array(
						'name' => esc_html( $resource_category->name ),
						'link' => esc_url( get_category_link( $resource_category->term_id ) ),
					);
				}

				return $categories;
			},
			'update_callback' => null,
			'schema'          => null,
		)
	);
}
add_action( 'rest_api_init', 'fivetwofive_theme_rest_api_init' );
