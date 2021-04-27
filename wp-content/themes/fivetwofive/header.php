<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FiveTwoFive
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'fivetwofive' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="row">
				<div class="site-branding col-3">
					<div class="site-branding__logo">
						<?php the_custom_logo(); ?>
					</div>
					<div class="site-branding__text">
						<?php
						$fivetwofive_theme_mod = get_theme_mod( 'fivetwofive_theme_mods' );
						$hide_site_title       = $fivetwofive_theme_mod['site_identity']['hide_blogname'];
						$hide_site_description = $fivetwofive_theme_mod['site_identity']['hide_blogdescription'];

						if ( ! $hide_site_title ) {
							if ( is_front_page() && is_home() ) {
								echo sprintf( '<h1 class="site-title"><a href="%1$s" rel="home">%2$s</a></h1>', esc_url( home_url( '/' ) ), esc_html( get_bloginfo( 'name' ) ) );
							} else {
								echo sprintf( '<p class="site-title"><a href="%1$s" rel="home">%2$s</a></p>', esc_url( home_url( '/' ) ), esc_html( get_bloginfo( 'name' ) ) );
							}
						}

						if ( ! $hide_site_description ) {
							$fivetwofive_description = get_bloginfo( 'description', 'display' );
							if ( $fivetwofive_description || is_customize_preview() ) {
								echo sprintf( '<p class="site-description">%1$s</p>', esc_html( $fivetwofive_description ) );
							}
						}

						?>
					</div>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation col-9">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'fivetwofive' ); ?></button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary-menu',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</header><!-- #masthead -->
