<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FiveTwoFive_Theme
 */

?>
	<?php do_action( 'fivetwofive_after_content' ); ?>
	</div><!-- .content-sidebar-wrap -->
	<?php do_action( 'fivetwofive_before_footer' ); ?>
	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="site-footer__widgets">
				<?php if ( is_active_sidebar( 'footer-widgets' ) ) : ?>
					<?php dynamic_sidebar( 'footer-widgets' ); ?>
				<?php endif; ?>
			</div>
			<div class="row site-footer__bottom">
				<div class="col-md-6">
					<p class="site-footer__copyright">
						<?php
						/* translators: %1$s: Copyright year, %2$s: Site name */
						echo sprintf( esc_html__( 'Copyright © %1$s. %2$s. All rights reserved.', 'fivetwofive' ), esc_html( wp_date( 'Y' ) ), esc_html( get_bloginfo( 'name' ) ) );
						?>
					</p><!-- .site-footer__copyright -->
				</div>
				<?php if ( has_nav_menu( 'footer_menu' ) ) : ?>
					<div class="col-md-6">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer_menu',
								'menu_id'        => 'footer-menu',
								'menu_class'     => 'site-footer-menu',
							)
						);
						?>
					</div>
				<?php endif; ?>
			</div><!-- .site-footer__bottom -->
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
