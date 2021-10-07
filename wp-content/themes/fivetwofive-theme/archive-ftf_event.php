<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<div class="container">
				<div class="row">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						echo '<div class="col-md-4 mb-3 mb-md-5">';
							get_template_part( 'template-parts/post-type/post-card', null, array( 'id' => get_the_ID() ) );
						echo '</div>';

					endwhile;
					?>
				</div>
				<?php the_posts_navigation(); ?>
			</div>
			<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php

get_footer();
