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

$fivetwofive_theme_mods = fivetwofive_theme_mods();
?>
	<?php do_action( 'fivetwofive_after_content' ); ?>
	</div><!-- .content-sidebar-wrap -->
	<?php do_action( 'fivetwofive_before_footer' ); ?>
	<footer id="colophon" class="site-footer">
        <div class="site-footer__widgets">
            <?php if ( is_active_sidebar( 'footer-widgets' ) ) : ?>
                <div class="container">
                    <?php dynamic_sidebar( 'footer-widgets' ); ?>
                </div>
            <?php endif; ?>
        </div><!-- .site-footer__widgets -->
        <div class="site-footer__bottom">
            <div class="container">
                <div class="row">
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
                </div>
            </div>
        </div><!-- .site-footer__bottom -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<?php

// Output any custom closing body scripts from theme mods, after sanitizing through extended kses ruleset
if (isset($fivetwofive_theme_mods['scripts_body_closing']) && $fivetwofive_theme_mods['scripts_body_closing'] !== '') {
    echo wp_kses($fivetwofive_theme_mods['scripts_body_closing'], fivetwofive_kses_extended_ruleset());
}
?>

</body>
</html>
