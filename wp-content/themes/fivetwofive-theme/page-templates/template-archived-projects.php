<?php
/**
 * Template Name: Archived Projects Template
 *
 * @package FiveTwoFive_Theme
 * @since FiveTwoFive Theme 1.0.0
 */

get_header();

$args = array(
	'post_type' => 'featured-projects',
	'orderby'   => 'menu_order',
	'order'     => 'DESC',
	'paged'     => max( 1, get_query_var( 'paged' ) ),
);

$work_query = new WP_Query( $args );
?>

	<main id="primary" class="site-main">

		<?php if ( $work_query->have_posts() ) : ?>

			<div class="row">
				<?php
				/* Start the Loop */
				while ( $work_query->have_posts() ) :
					$work_query->the_post();
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
				?>
			</div>

			<div class="featured-projects-pagination">
				<?php
					echo paginate_links(
						array(
							'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
							'total'        => $work_query->max_num_pages,
							'current'      => max( 1, get_query_var( 'paged' ) ),
							'format'       => '?page=%#%',
							'show_all'     => false,
							'type'         => 'plain',
							'end_size'     => 2,
							'mid_size'     => 1,
							'prev_next'    => true,
							'prev_text'    => sprintf( '<i></i> %1$s', __( 'Newer Projects', 'fivetwofive-theme' ) ),
							'next_text'    => sprintf( '%1$s <i></i>', __( 'Older Projects', 'fivetwofive-theme' ) ),
							'add_args'     => false,
							'add_fragment' => '',
						)
					);
				?>
			</div>

			<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php

get_footer();
