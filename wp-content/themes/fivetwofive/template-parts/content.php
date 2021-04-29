<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive
 */

namespace Fivetwofive\FivetwofiveTheme;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'entry' ) ); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				fivetwofive()->posted_on();
				fivetwofive()->posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php fivetwofive()->post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		if ( is_archive() || is_home() || is_category() ) {
			the_excerpt();
		} else {
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'fivetwofive' ),
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
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fivetwofive' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php fivetwofive()->entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
