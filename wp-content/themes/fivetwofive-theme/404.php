<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package FiveTwoFive_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found text-center">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'fivetwofive-theme' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content ">

				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try to search what your looking for?', 'fivetwofive-theme' ); ?></p>

				<?php get_search_form(); ?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();