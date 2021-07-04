<?php
/**
 * Template Name: Events Single
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Authority
 */

get_header(); ?>

	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">
			<div class="content-wrapper">
				<div class="content-container m-b-lg">
					<?php while ( have_posts() ) : the_post();

                        get_template_part( '/includes/single_fivetwofive_event' );
//                        get_template_part( '/includes/ftf_events_cpt' );

					endwhile; ?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php // include_once get_stylesheet_directory() . '/jt_templates/ftf-sandbox-cta.php'; ?>

<?php get_footer(); ?>