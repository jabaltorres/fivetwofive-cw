<?php
/**
 * The template for displaying all single events.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package FiveTwoFive_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/event/content', get_post_type() );

			while ( have_rows( 'modules' ) ) :
				the_row();
				get_template_part( 'template-parts/modules/module', str_replace( 'module-', '', get_row_layout() ) );
			endwhile;

			get_template_part(
				'template-parts/event/related',
				null,
				array(
					'event_id'   => get_the_ID(),
					'event_type' => get_field( 'ftf_event_type' ),
				)
			);

			// If comments are open, or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
