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
		<div class="container site-footer__bottom">

            <?php
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $custom_logo_image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
            $theme_logo = $custom_logo_image[0];
            ?>

            <img src="<?= $theme_logo; ?>" alt="Theme Logo">

            <?php if (get_field('business_name', 'option')): ?>
                <div class="site-footer__business_name"><?php the_field('business_name', 'option'); ?></div><!-- .site-footer__business_name -->
            <?php endif; ?>

            <p class="site-footer__copyright">
				<?php
				/* translators: %1$s: Copyright year, %2$s: Site name */
				echo sprintf( esc_html__( 'Copyright © %1$s. %2$s. All rights reserved.', 'fivetwofive' ), esc_html( wp_date( 'Y' ) ), esc_html( get_bloginfo( 'name' ) ) );
				?>
            </p><!-- .site-footer__copyright -->

		</div><!-- .site-footer__bottom -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
