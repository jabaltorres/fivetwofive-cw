<?php
/**
 * The template for displaying all single posts
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
			?>

			<article id="resource-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php get_template_part( 'template-parts/resource/banner' ); ?>
				<div class="ftf-resource__content container pt-3 pt-sm-5">
					<?php
					get_template_part( 'template-parts/resource/content', get_field( 'ftf_resource_type' ) );

					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'fivetwofive-theme' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						)
					);

					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'fivetwofive-theme' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'fivetwofive-theme' ) . '</span> <span class="nav-title">%title</span>',
						)
					);
					?>
				</div>
			</article>

			<?php

			get_template_part(
				'template-parts/resource/related',
				null,
				array(
					'resource_id'         => get_the_ID(),
					'resource_categories' => wp_get_post_terms( get_the_ID(), 'ftf_resource_category', array( 'fields' => 'ids' ) ),
				)
			);

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
