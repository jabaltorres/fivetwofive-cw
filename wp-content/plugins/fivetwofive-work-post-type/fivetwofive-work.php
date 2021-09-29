<?php
/**
 * Plugin Name: FiveTwoFive Work Custom Post Type
 * Description: A simple plug in that adds a Work custom post type
 * Version: 0.1
 * Author:  Jabal Torres
 * License: GPL2
 * Text Domain: fivetwofive-work
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
 * Register work custom post type.
 *
 * @return void
 */
function ftf_work_register_cpt() {

	/**
	 * Post Type: Work.
	 */

	$labels = array(
		'name'                  => __( 'Works', 'fivetwofive-work' ),
		'singular_name'         => __( 'Work', 'fivetwofive-work' ),
		'menu_name'             => __( 'Works', 'fivetwofive-work' ),
		'all_items'             => __( 'All Works', 'fivetwofive-work' ),
		'add_new'               => __( 'Add New Work', 'fivetwofive-work' ),
		'add_new_item'          => __( 'Add New Work', 'fivetwofive-work' ),
		'edit_item'             => __( 'Edit Work', 'fivetwofive-work' ),
		'new_item'              => __( 'New Work', 'fivetwofive-work' ),
		'view_item'             => __( 'View Work', 'fivetwofive-work' ),
		'view_items'            => __( 'View Works', 'fivetwofive-work' ),
		'search_items'          => __( 'Search Work', 'fivetwofive-work' ),
		'not_found'             => __( 'Work Not Found', 'fivetwofive-work' ),
		'not_found_in_trash'    => __( 'No Works found in trash', 'fivetwofive-work' ),
		'parent_item_colon'     => __( 'Parent Work', 'fivetwofive-work' ),
		'featured_image'        => __( 'Featured image for this Work', 'fivetwofive-work' ),
		'set_featured_image'    => __( 'Set featured image for this Work', 'fivetwofive-work' ),
		'remove_featured_image' => __( 'Remove featured image for this Work', 'fivetwofive-work' ),
		'use_featured_image'    => __( 'Use featured image for this Work', 'fivetwofive-work' ),
		'archives'              => __( 'Work archives', 'fivetwofive-work' ),
		'insert_into_item'      => __( 'Insert into Work', 'fivetwofive-work' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Work', 'fivetwofive-work' ),
		'filter_items_list'     => __( 'Filter Works list', 'fivetwofive-work' ),
		'item_published'        => __( 'Work published.', 'fivetwofive-work' ),
		'item_updated'          => __( 'Work updated.', 'fivetwofive-work' ),
		'items_list_navigation' => __( 'Works list navigation', 'fivetwofive-work' ),
		'items_list'            => __( 'Works list', 'fivetwofive-work' ),
		'item_link'             => __( 'Work Link', 'fivetwofive-work' ),
		'attributes'            => __( 'Works Attributes', 'fivetwofive-work' ),
		'parent_item_colon'     => __( 'Parent Work', 'fivetwofive-work' ),
	);

	$args = array(
		'label'               => __( 'Works', 'fivetwofive-work' ),
		'labels'              => $labels,
		'description'         => __( 'Work Description', 'fivetwofive-work' ),
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'rest_base'           => '',
		'has_archive'         => true,
		'show_in_menu'        => true,
		'menu_position'       => '5',
		'menu_icon'           => 'dashicons-hammer',
		'show_in_nav_menus'   => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'rewrite'             => array(
			'slug' => 'work',
		),
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
	);

	register_post_type( 'ftf_work', $args );
}
add_action( 'init', 'ftf_work_register_cpt' );

/**
 * Make the work archive full width.
 *
 * @return boolean $enable Make the work archive full width.
 */
function ftf_work_archive_disable_sidebar( $enable_sidebar ) {
	if ( is_post_type_archive( 'ftf_work' ) ) {
		$enable_sidebar = false;
	}

	return $enable_sidebar;
}
add_filter( 'fivetwofive_theme_enable_sidebar', 'ftf_work_archive_disable_sidebar' );

/**
 * Register custom post type on plugin activation.
 *
 * @return void
 */
function ftf_work_setup_custom_post_type() {
	ftf_work_register_cpt();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'ftf_work_setup_custom_post_type' );

/**
 * Unregister custom post type on plugin deactivation.
 *
 * @link https://core.trac.wordpress.org/ticket/42563
 * @return void
 */
function ftf_work_unregister_cpt() {
	unregister_post_type( 'featured-projects' );
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'ftf_work_unregister_cpt' );

/**
 * Works shortcode.
 */
function ftf_featured_works_shortcode() {
	$projects = '';

	global $post;

	// Check for transient. If none, then execute WP_Query
	if ( false === ( $works = get_transient( 'fivetwofive_featured_works' ) ) ) {

		$work_args = array(
			'post_type'      => 'ftf_work',
			'posts_per_page' => 3,
			'orderby'        => 'menu_order',
			'order'          => 'DESC',
			'meta_query'	 => array(
				array(
					'key'	  	=> 'ftf_featured_work',
					'value'	  	=> '1',
					'compare' 	=> '=',
				),
			),
		);

		$works = get_posts( $work_args );

		// Put the results in a transient. Expire after 12 hours.
		set_transient( 'fivetwofive_featured_works', $works, 12 * HOUR_IN_SECONDS );
	}

	if  ( $works ) {
		ob_start();
		$work_counter = 0;
		?>
		<section id="fivetwofive-featured-projects" class="fivetwofive-featured-projects featured-projects-homepage-wrapper text-center">
			<div class="featured-projects-inner-wrapper py-5">
				<h2 class="title mb-5"><?php echo esc_html__( 'Recent Projects', 'fivetwofive' ); ?></h2>
				<?php
				foreach ( $works as $post ) :
					setup_postdata( $post );
					$work_counter++;
					?>
						<div class="container featured-projects-homepage-item mb-4">
							<div class="row align-items-center">
								<?php if ( $work_counter % 2 !== 0 ) : ?>

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

				<a class="button mx-auto my-4" href="<?php echo esc_url( get_post_type_archive_link( 'ftf_work' ) ); ?>"><?php echo esc_html__( 'View All Projects', 'fivetwofive-work' ); ?></a>
			</div>
		</section>
		<?php
		$projects = ob_get_clean();
	}
	return $projects;
}
add_shortcode( 'fivetwofive_featured_works', 'ftf_featured_works_shortcode' );

/**
 * Works Archive shortcode.
 */
function ftf_work_archive_shortcode() {
	$args = array(
		'post_type' => 'ftf_works',
		'orderby'   => 'menu_order',
		'order'     => 'DESC',
		'paged'     => max( 1, get_query_var( 'paged' ) ),
	);
	$work_query = new WP_Query( $args );

	ob_start();

	if ( $work_query->have_posts() ) :
		?>

		<div class="container">
			<div class="row">
				<?php
				/* Start the Loop */
				while ( $work_query->have_posts() ) :
					$work_query->the_post();
					?>
					<div class="col-md-4 mb-3 mb-md-5">
						<article id="card-<?php the_ID(); ?>" <?php post_class( 'card' ); ?>>
							<div class="card__image-wrap mb-4">
								<?php
									the_post_thumbnail(
										'large',
										array(
											'alt' => the_title_attribute(
												array(
													'echo' => false,
												)
											),
											'class' => 'card__image img-responsive',
										)
									);
								?>
								<div class="card__image-overlay">
									<a class="button card__image-link" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">Read More</a>
								</div>
							</div>
							<header class="card__header">
								<?php the_title( sprintf( '<h2 class="card__title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							</header><!-- .card-header -->
							<div class="card__content">
								<?php the_excerpt(); ?>
							</div>
						</article><!-- #card-<?php the_ID(); ?> -->
					</div>
					<?php
				endwhile;
				?>
			</div>

			<div class="featured-projects-pagination pagination">
				<?php
					echo paginate_links(
						array(
							'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
							'total'        => $work_query->max_num_pages,
							'current'      => max( 1, get_query_var( 'paged' ) ),
							'format'       => '?page=%#%',
							'show_all'     => false,
							'type'         => 'plain',
							'end_size'     => 2,
							'mid_size'     => 1,
							'prev_next'    => true,
							'prev_text'    => sprintf( '<i></i> %1$s', __( 'Newer Projects', 'fivetwofive-theme' ) ),
							'next_text'    => sprintf( '%1$s <i></i>', __( 'Older Projects', 'fivetwofive-theme' ) ),
							'add_args'     => false,
							'add_fragment' => '',
						)
					);
				?>
			</div>
		</div>

		<?php
	endif;

	return ob_get_clean();
}
add_shortcode( 'fivetwofive_work_archive', 'ftf_work_archive_shortcode' );

/**
 * Register Works image sizes
 *
 * @return void
 */
function ftf_work_theme_setup() {
    add_image_size( 'fivetwofive-work-thumbnail', 600, 450, true );
}
add_action( 'after_setup_theme', 'ftf_work_theme_setup' );