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

			$header_background = '';

			if ( has_post_thumbnail() ) {
				$header_background = sprintf(
					'background-image: url(%1$s);',
					esc_url_raw( get_the_post_thumbnail_url( get_the_ID(), 'full' ) )
				);
			}
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="page-header" style="<?php echo esc_attr( $header_background ); ?>">
					<div class="container">
						<?php the_title( '<h1 class="page-header__title mb-2 mb-sm-3">', '</h1>' ); ?>
						<?php fivetwofive_theme_post_meta( get_the_ID() ); ?>
					</div>
				</header>

				<div class="entry-content">
					<?php
					if ( is_single() ) {
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
					}

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fivetwofive-theme' ),
							'after'  => '</div>',
						)
					);
					?>
				</div><!-- .entry-content -->
                
                <?php if ( is_active_sidebar( 'primary-sidebar' ) ) : ?>
                    <div class="sidebar-wrapper">
	                    <?php get_sidebar(); ?>
                    </div><!-- .sidebar -->
                <?php endif; ?>

				<footer class="entry-footer">
					<?php fivetwofive_theme_entry_footer(); ?>
				</footer><!-- .entry-footer -->
			</article><!-- #post-<?php the_ID(); ?> -->

			<?php
			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'fivetwofive-theme' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'fivetwofive-theme' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
