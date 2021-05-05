<?php
$fivetwofive_footer = get_post( 1691 );

if ( $fivetwofive_footer ) {
	echo do_shortcode( $fivetwofive_footer->post_content );
}
