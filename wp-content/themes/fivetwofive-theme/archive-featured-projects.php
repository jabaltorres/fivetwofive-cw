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

			<header class="page-header mb-5">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="row">
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					?>
					<article id="card-<?php the_ID(); ?>" <?php post_class( 'col-md-6 mb-3 mb-md-5' ); ?>>
						<a class="card__image-link" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
							<?php
								the_post_thumbnail(
									'post-thumbnail',
									array(
										'alt' => the_title_attribute(
											array(
												'echo' => false,
											)
										),
										'class' => 'card__image mb-2',
									)
								);
							?>
						</a>

						<header class="card__header">
							<?php the_title( '<h2 class="card__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
						</header><!-- .card-header -->

						<div class="card__content">
							<?php the_excerpt(); ?>
						</div><!-- .carc-content -->

					</article><!-- #card-<?php the_ID(); ?> -->
					<?php
				endwhile;
				?>
			</div>

			<?php
			the_posts_navigation(
				array(
					'prev_text'          => __( 'Older projects', 'fivetwofive-theme' ),
					'next_text'          => __( 'Newer projects', 'fivetwofive-theme' ),
					'screen_reader_text' => __( 'Projects navigation', 'fivetwofive-theme' ),
					'aria_label'         => __( 'Projects', 'fivetwofive-theme' ),
					'class'              => 'post-navigation',
				)
			);

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php

get_footer();
