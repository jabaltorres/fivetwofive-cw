<?php
/**
 * Plugin Name: FiveTwoFive Featured Projects Custom Post Type
 * Description: A simple plug in that adds a featured project custom post type
 * Version: 0.1
 * Author:  Jabal Torres
 * License: GPL2
 * Text Domain: fivetwofive-featured-projects
 */

/*
	Copyright 2018: Jabal Torres

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
 * Register featured projects custom post type.
 *
 * @return void
 */
function ftf_featured_projects_register_cpt() {

	/**
	 * Post Type: Featured Projects.
	 */

	$labels = array(
		'name'                  => __( 'Featured Projects', 'jt-featured-projects' ),
		'singular_name'         => __( 'Featured Project', 'jt-featured-projects' ),
		'menu_name'             => __( 'Featured Projects', 'jt-featured-projects' ),
		'all_items'             => __( 'All Featured Projects', 'jt-featured-projects' ),
		'add_new'               => __( 'Add New Featured Project', 'jt-featured-projects' ),
		'add_new_item'          => __( 'Add New Featured Project', 'jt-featured-projects' ),
		'edit_item'             => __( 'Edit Featured Project', 'jt-featured-projects' ),
		'new_item'              => __( 'New Featured Project', 'jt-featured-projects' ),
		'view_item'             => __( 'View Featured Project', 'jt-featured-projects' ),
		'view_items'            => __( 'View Featured Projects', 'jt-featured-projects' ),
		'search_items'          => __( 'Search Featured Project', 'jt-featured-projects' ),
		'not_found'             => __( 'Featured Project Not Found', 'jt-featured-projects' ),
		'not_found_in_trash'    => __( 'No Featured Projects found in trash', 'jt-featured-projects' ),
		'parent_item_colon'     => __( 'Parent Featured Project', 'jt-featured-projects' ),
		'featured_image'        => __( 'Featured image for this Featured Project', 'jt-featured-projects' ),
		'set_featured_image'    => __( 'Set featured image for this Featured Project', 'jt-featured-projects' ),
		'remove_featured_image' => __( 'Remove featured image for this Featured Project', 'jt-featured-projects' ),
		'use_featured_image'    => __( 'Use featured image for this Featured Project', 'jt-featured-projects' ),
		'archives'              => __( 'Featured Project archives', 'jt-featured-projects' ),
		'insert_into_item'      => __( 'Insert into Featured Project', 'jt-featured-projects' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Featured Project', 'jt-featured-projects' ),
		'filter_items_list'     => __( 'Filter Featured Projects list', 'jt-featured-projects' ),
		'items_list_navigation' => __( 'Featured Projects list navigation', 'jt-featured-projects' ),
		'items_list'            => __( 'Featured Projects list', 'jt-featured-projects' ),
		'attributes'            => __( 'Featured Projects Attributes', 'jt-featured-projects' ),
		'parent_item_colon'     => __( 'Parent Featured Project', 'jt-featured-projects' ),
	);

	$args = array(
		'label'               => __( 'Featured Projects', 'jt-featured-projects' ),
		'labels'              => $labels,
		'description'         => __( 'Featured Project Description', 'jt-featured-projects' ),
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'rest_base'           => "",
		'has_archive'         => false,
		'show_in_menu'        => true,
		'menu_position'       => '5',
		'menu_icon'           => 'dashicons-megaphone',
		'show_in_nav_menus'   => true,
		'exclude_from_search' => false,
		'capability_type'     => "post",
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
	);

	register_post_type( 'featured-projects', $args );
}
add_action( 'init', 'ftf_featured_projects_register_cpt' );

/**
 * Make the featured projects archive full width.
 *
 * @return boolean $enable Make the featured projects archive full width.
 */
function ftf_featured_projects_archive_disable_sidebar( $enable_sidebar ) {
	if ( is_post_type_archive( 'featured-projects' ) ) {
		$enable_sidebar = false;
	}

	return $enable_sidebar;
}
add_filter( 'fivetwofive_theme_enable_sidebar', 'ftf_featured_projects_archive_disable_sidebar' );

/**
 * Register custom post type on plugin activation.
 *
 * @return void
 */
function ftf_featured_projects_setup_custom_post_type() {
	ftf_featured_projects_register_cpt();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'ftf_featured_projects_setup_custom_post_type' );

/**
 * Unregister custom post type on plugin deactivation.
 *
 * @link https://core.trac.wordpress.org/ticket/42563
 * @return void
 */
function ftf_featured_projects_unregister_cpt() {
	unregister_post_type( 'featured-projects' );
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'ftf_featured_projects_unregister_cpt' );

/**
 * Add featured project shortcode.
 */
function ftf_featured_projects_shortcode( $a ) {
	$projects = '';

	$atts = shortcode_atts( array( 'archive' => null ), $a );

	global $post;

	// Check for transient. If none, then execute WP_Query
	if ( false === ( $featured_projects = get_transient( 'fivetwofive_featured_projects' ) ) ) {

		$featured_projects_args = array(
			'post_type'      => 'featured-projects',
			'posts_per_page' => 3,
			'orderby'        => 'menu_order',
			'order'          => 'DESC',
			'meta_query'	 => array(
				array(
					'key'	  	=> 'project_is_featured',
					'value'	  	=> '1',
					'compare' 	=> '=',
				),
			),
		);

		$featured_projects = get_posts( $featured_projects_args );

		// Put the results in a transient. Expire after 12 hours.
		set_transient( 'fivetwofive_featured_projects', $featured_projects, 12 * HOUR_IN_SECONDS );
	}

	if  ( $featured_projects ) {
		ob_start();
		?>
		<section id="fivetwofive-featured-projects" class="fivetwofive-featured-projects featured-projects-homepage-wrapper text-center">
			<div class="featured-projects-inner-wrapper py-5">
				<h2 class="title mb-5"><?php echo esc_html__( 'Recent Projects', 'fivetwofive' ); ?></h2>
				<?php
				foreach ( $featured_projects as $post ) :
					setup_postdata( $post );
					$homepage_toggle = get_field( 'homepage_toggle' );
					?>
						<div class="container featured-projects-homepage-item mb-4">
							<div class="row align-items-center">
								<?php if ( $homepage_toggle ) : ?>

									<div class="col-12 col-md-7 has-img">
										<?php if ( has_post_thumbnail() ) : ?>
											<a class="has-hover" href="<?php echo esc_url_raw( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
												<img class="thumbnail" src="<?php echo esc_url_raw( get_the_post_thumbnail_url() ); ?>" alt="<?php echo esc_attr( get_the_post_thumbnail_caption() ); ?>" />
											</a>
										<?php endif; ?>
									</div>
									<div class="col-12 col-md-5 has-text">

										<a href="<?php echo esc_url_raw( get_permalink() ); ?>"><h3 class="article-title"><?php the_title(); ?></h3></a>

										<?php if ( has_excerpt() ) : ?>
											<div class="project-excerpt mb-4"><?php echo wp_kses_post( the_excerpt() ); ?></div>
										<?php endif; ?>

										<a class="button" href="<?php echo esc_url_raw( get_permalink() ); ?>"><?php echo esc_html__( 'Learn More', 'fivetwofive-featured-projects' ); ?></a>

									</div>

								<?php else: ?>

									<div class="col-12 col-md-7 has-image order-md-last">
										<?php if ( has_post_thumbnail() ) : ?>
											<a class="has-hover" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<img class="thumbnail" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_post_thumbnail_caption(); ?>" />
											</a>
										<?php endif; ?>
									</div>
									<div class="col-12 col-md-5 has-text order-md-first">

										<a href="<?php echo esc_url_raw( get_permalink() ); ?>"><h3 class="article-title"><?php the_title(); ?></h3></a>

										<?php if ( has_excerpt() ) : ?>
											<div class="project-excerpt mb-4"><?php echo wp_kses_post( the_excerpt() ); ?></div>
										<?php endif; ?>

										<a class="button" href="<?php echo esc_url_raw( get_permalink() ); ?>"><?php echo esc_html__( 'Learn More', 'fivetwofive-featured-projects' ); ?></a>

									</div>
								<?php endif; ?>

							</div>
						</div>
					<?php
				endforeach;
				wp_reset_postdata();
				?>

				<?php if ( $atts['archive'] ) : ?>
					<a class="button mx-auto my-4" href="<?php echo esc_url( get_the_permalink( intval( $atts['archive'] ) ) ); ?>"><?php echo esc_html__( 'View All Projects', 'jt-featured-projects' ); ?></a>
				<?php endif; ?>
			</div>
		</section>
		<?php
		$projects = ob_get_clean();
	}
	return $projects;
}
add_shortcode( 'fivetwofive_featured_projects', 'ftf_featured_projects_shortcode' );

/**
 * Register Featured Projects image sizes
 *
 * @return void
 */
function ftf_featured_projects_theme_setup() {
    add_image_size( 'fivetwofive-featured-project', 600, 450, true );
}
add_action( 'after_setup_theme', 'ftf_featured_projects_theme_setup' );