<?php
/**
 * Modules Template
 *
 * Template Name: Modules Template
 *
 * This is the template that displays all the modules of the page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive templates
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			while ( have_rows( 'modules' ) ) :
				the_row();
				switch ( get_row_layout() ) {
					case 'hero':
						get_template_part( 'template-parts/modules/module', 'hero' );
						break;
					case 'announcement':
						get_template_part( 'template-parts/modules/module', 'announcement' );
						break;
					case 'cta':
						get_template_part( 'template-parts/modules/module', 'cta' );
						break;
				}
			endwhile;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
