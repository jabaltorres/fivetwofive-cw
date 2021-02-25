<?php

remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

add_action( 'genesis_footer', 'genesis_footer_widget_areas', 8 );

function genesis_fivetwofive_footer_copyright_wrap_open() {
	genesis_markup(
		[
			'open'    => '<div %s>',
			'context' => 'site-footer-copyright',
		]
	);
}
add_action( 'genesis_footer', 'genesis_fivetwofive_footer_copyright_wrap_open', 8 );

function genesis_fivetwofive_footer_copyright_wrap_close() {
	genesis_markup(
		[
			'close'   => '</div>',
			'context' => 'site-footer-copyright',
		]
	);
}
add_action( 'genesis_footer', 'genesis_fivetwofive_footer_copyright_wrap_close', 11 );


function genesis_fivetwofive_footer_title( $heading, $id ) {
    if ( 'Footer' !== $id ) return;

    $heading = '<h2 class="genesis-sidebar-title genesis-fivetwofive-has-dot">' . __( 'Let\'s Work Together', 'genesis-fivetwofive' ) . '</h2>';

    return $heading;
}
add_filter( 'genesis_sidebar_title_output', 'genesis_fivetwofive_footer_title', 10, 2 );
