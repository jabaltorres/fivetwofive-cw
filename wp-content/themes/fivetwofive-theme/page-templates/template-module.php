<?php
/**
 * Template Name: Modules Template
 * Template Post Type: page, featured-projects, fivetwofive-lp
 *
 * @package FiveTwoFive_Theme
 * @since FiveTwoFive Theme 1.0.0
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			while ( have_rows( 'modules' ) ) :
				the_row();
				get_template_part( 'template-parts/modules/module', str_replace( 'module-', '', get_row_layout() ) );
			endwhile;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
