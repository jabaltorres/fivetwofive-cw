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
		<header class="page-header">
			<div class="container">
				<?php
				the_archive_title( '<h1 class="page-header__title">', '</h1>' );
				the_archive_description( '<div class="page-header__description">', '</div>' );
				?>
				<div class="view-toggle mt-4">
					<button class="view-toggle__btn view-toggle__btn--grid active" data-view="grid" aria-label="Grid View">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
							<path d="M3 3h7v7H3zm11 0h7v7h-7zm0 11h7v7h-7zM3 14h7v7H3z"/>
						</svg>
					</button>
					<button class="view-toggle__btn view-toggle__btn--list" data-view="list" aria-label="List View">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
							<path d="M3 4h18v2H3zm0 7h18v2H3zm0 7h18v2H3z"/>
						</svg>
					</button>
				</div>
			</div>
		</header><!-- .page-header -->

		<?php
		if ( have_posts() ) : ?>
			<div class="posts-container view-grid">
				<div class="row">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						?>

						<div class="col-lg-4 col-md-6 col-sm-6 mb-3 mb-sm-4 grid-item">
							<?php
							get_template_part(
								'template-parts/post-type/post-card',
								null,
								array(
									'id'       => get_the_ID(),
									'taxonomy' => 'post_tag',
								)
							);
							?>
						</div>

						<div class="col-12 list-item" style="display: none;">
							<?php
							get_template_part(
								'template-parts/post-type/post-list',
								null,
								array(
									'id'       => get_the_ID(),
									'taxonomy' => 'post_tag',
								)
							);
							?>
						</div>

					<?php
					endwhile;
					?>
				</div>
			</div>

			<?php
			the_posts_pagination( array( 'mid_size'  => 2 ) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php

get_footer();
