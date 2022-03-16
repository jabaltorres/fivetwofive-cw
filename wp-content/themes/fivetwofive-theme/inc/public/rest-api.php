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
}
add_action( 'rest_api_init', 'fivetwofive_theme_rest_api_init' );
