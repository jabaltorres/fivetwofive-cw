<?php
/**
 * The blog archive template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive Theme
 * @subpackage FiveTwoFive Theme
 * @since FiveTwoFive Theme 0.9.1
 */
global $wp;

get_header();
$header_styles = '';
$blog_page_id  = get_queried_object_id();

if ( has_post_thumbnail( $blog_page_id ) ) {
	$header_styles = sprintf( 'background: url("%s") center / cover no-repeat;', get_the_post_thumbnail_url( $blog_page_id, 'full' ) );
}
?>

<?php if ( ! empty( single_post_title( '', false ) ) ) : ?>
	<header class="page-header" style="<?php echo esc_attr( $header_styles ); ?>">
		<div class="container">
            <h1 class="page-header__title mb-3 mb-sm-4"><?php echo get_the_title($blog_page_id); ?></h1>

            <div class="excerpt mb-3"><?php echo get_the_excerpt($blog_page_id); ?></div>

			<form role="search" method="get" class="search-form row g-3 justify-content-center align-items-center" action="<?php echo esc_url( home_url( '/blog' ) ); ?>">
				<div class="col-md-3">
					<label class="screen-reader-text" for="searchInput">Search Blog</label>
					<input type="search" class="form-control" name="s" id="searchInput" placeholder="<?php echo esc_attr_x( 'Search Blog', 'placeholder', 'fivetwofive' ); ?>"  value="<?php echo get_search_query(); ?>"  title="<?php echo esc_attr_x( 'Search for:', 'label' ); ?>" />
				</div>

				<div class="col-auto">
					<?php
					wp_dropdown_categories(
						array(
							'show_option_none'  => 'All Tags',
							'option_none_value' => '',
							'hide_if_empty'     => true,
							'taxonomy'          => 'post_tag',
							'name'              => 'tag',
							'class'             => 'ftf-select',
							'selected'          => get_query_var( 'tag' ),
							'value_field'       => 'slug',
							'orderby'           => 'name',
						)
					);
					?>
				</div>

				<div class="col-auto">
					<button aria-label="search submit button" type="submit" class="search-submit btn btn-primary">
						<?php echo esc_attr_x( 'Search', 'submit button' ); ?>
					</button>
				</div>
			</form>
		</div>
	</header><!-- .page-header -->
<?php endif; ?>

<main id="primary" class="site-main">
	<?php
	if ( have_posts() ) : ?>
		<div class="container">
			<div class="view-toggle mt-2">
				<button class="view-toggle__btn view-toggle__btn--grid" data-view="grid" aria-label="Grid View">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
						<path d="M3 3h7v7H3zm11 0h7v7h-7zm0 11h7v7h-7zM3 14h7v7H3z"/>
					</svg>
				</button>
				<button class="view-toggle__btn view-toggle__btn--list active" data-view="list" aria-label="List View">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
						<path d="M3 4h18v2H3zm0 7h18v2H3zm0 7h18v2H3z"/>
					</svg>
				</button>
			</div>

			<div class="posts-container view-list">
				<div class="row">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						?>

						<div class="post-item col-lg-4 col-md-6 col-sm-6 mb-3 mb-sm-4">
							<?php
								get_template_part(
									'template-parts/post-type/post-card',
									null,
									array(
										'id'       => get_the_ID(),
										'taxonomy' => 'post_tag',
										'excerpt'  => 'true',
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
			?>
		</div>
		<?php

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

</main><!-- #main -->

<?php get_footer(); ?>
