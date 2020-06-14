<?php
/*
Template Name: Single Featured Project
*/

remove_action('genesis_loop', 'genesis_do_loop');

add_action('genesis_loop', 'singleFeaturedProject_loop');

function singleFeaturedProject_loop() {

	$featured_projects_args = array(
		'post_type'  => 'featured-projects',
		'orderby'=> 'menu_order',
		'order', 'ASC',
	);

	$featured_projects = new WP_Query($featured_projects_args);

	if ($featured_projects -> have_posts()) {
		get_template_part( '/includes/single_featured_projects_cpt' );
	}
}

genesis();