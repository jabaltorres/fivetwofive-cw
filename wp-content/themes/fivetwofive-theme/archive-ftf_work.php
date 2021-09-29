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

				the_posts_navigation();
				?>

				</div>
			</div>

			<?php

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php

get_footer();
