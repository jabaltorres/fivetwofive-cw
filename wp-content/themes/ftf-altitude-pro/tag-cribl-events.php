<?php
/**
 * Template Name: Events Tag
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Authority
 */

get_header(); ?>

	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">
			<div class="content-wrapper">
				<div class="content-container">
					<?php while ( have_posts() ) : the_post();

						get_template_part( '/includes/single_cribl_event' );

					endwhile; ?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php include_once get_stylesheet_directory() . '/rs_templates/blog/cribl-sandbox-cta.php'; ?>

<?php get_footer(); ?>