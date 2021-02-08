<?php
/**
* Template Name: Events Archive
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package The Authority
*/

add_filter( 'body_class', 'custom_class' );
function custom_class( $classes ) {
	if ( is_page_template( 'archive-events.php' ) ) {
		$classes[] = 'ftf-events-template';
	}
	return $classes;
}


get_header(); ?>

<div id="primary" class="content-area-full">
	<main id="main" class="site-main" role="main">
        <div class="content-wrapper mb-3">
            <div class="content-container">
		        <?php while ( have_posts() ) : the_post(); ?>
                    <h1><?php the_title(); ?></h1>

			        <?php the_content(); ?>
		        <?php endwhile; ?>
            </div>
        </div>

        <div class="events-wrapper mb-3">
            <div class="events-container">
                <div id="future-events" class="future-events">
                    <?php // <h2 class="section-heading">Future Events:</h2> ?>
					<?php
					$todaysDate = current_time('Ymd');

					$ftf_events_args = array(
						'post_type'  => 'fivetwofive-events',
						'posts_per_page' => '-1',
//						'meta_key' => 'event_date',
//						'orderby' => 'meta_value_num',
						'order' => 'DESC',
//						'meta_query' => array(
//							array(
//								'key'   => 'event_date',
//								'compare' => '>=',
//								'value'   => $todaysDate,
//							),
//						),
					);

					$ftf_events = new WP_Query($ftf_events_args);

					if ($ftf_events -> have_posts()) {

						while($ftf_events -> have_posts()): $ftf_events ->the_post();
							get_template_part( '/includes/ftf_events_cpt' );
						endwhile;
						wp_reset_postdata();
					}
					?>
                </div>

            </div>
        </div>

	</main><!-- #main -->
</div><!-- #primary -->

<?php include_once get_stylesheet_directory() . '/jt_templates/ftf-sandbox-cta.php'; ?>

<?php get_footer(); ?>