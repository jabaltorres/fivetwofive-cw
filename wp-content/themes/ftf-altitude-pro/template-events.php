<?php
/**
* Template Name: Events
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package The Authority
*/

add_filter( 'body_class', 'custom_class' );
function custom_class( $classes ) {
	if ( is_page_template( 'template-events.php' ) ) {
		$classes[] = 'cribl-events-template';
	}
	return $classes;
}


get_header(); ?>

<div id="primary" class="content-area-full">
	<main id="main" class="site-main" role="main">
        <div class="content-wrapper m-b-lg">
            <div class="content-container">
		        <?php while ( have_posts() ) : the_post(); ?>
                    <h1><?php the_title(); ?></h1>

			        <?php the_content(); ?>
		        <?php endwhile; ?>
            </div>
        </div>

        <div class="events-wrapper">
            <div class="events-container">
                <div id="future-events" class="future-events">
                    <?php // <h2 class="section-heading">Future Events:</h2> ?>
					<?php
					$todaysDate = current_time('Ymd');

					$cribl_events_args = array(
						'post_type'  => 'cribl-events',
						'posts_per_page' => '-1',
						'meta_key' => 'event_date',
						'orderby' => 'meta_value_num',
						'order' => 'DESC',
						'meta_query' => array(
							array(
								'key'   => 'event_date',
								'compare' => '>=',
								'value'   => $todaysDate,
							),
						),
					);

					$cribl_events = new WP_Query($cribl_events_args);

					if ($cribl_events -> have_posts()) {

						while($cribl_events -> have_posts()): $cribl_events ->the_post();
							get_template_part( '/includes/cribl_events_cpt' );
						endwhile;
						wp_reset_postdata();
					}
					?>
                </div>
                <div id="past-events" class="past-events">
                    <h2 class="section-heading text-center">Past Events</h2>
					<?php
					$todaysDate = current_time('Ymd');

					$cribl_events_args = array(
						'post_type'  => 'cribl-events',
						'posts_per_page' => '-1',
						'meta_key' => 'event_date',
						'orderby' => 'meta_value_num',
						'order' => 'DESC',
						'meta_query' => array(
							array(
								'key'   => 'event_date',
								'compare' => '<',
								'value'   => $todaysDate,
							),
						),
					);

					$cribl_events = new WP_Query($cribl_events_args);

					if ($cribl_events -> have_posts()) {

						while($cribl_events -> have_posts()): $cribl_events ->the_post();
							get_template_part( '/includes/cribl_events_cpt' );
						endwhile;
						wp_reset_postdata();
					}
					?>
                </div>
            </div>
        </div>

	</main><!-- #main -->
</div><!-- #primary -->

<?php include_once get_stylesheet_directory() . '/rs_templates/blog/cribl-sandbox-cta.php'; ?>

<?php get_footer(); ?>