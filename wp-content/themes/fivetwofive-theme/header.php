<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FiveTwoFive_Theme
 */

$fivetwofive_theme_mods = fivetwofive_theme_mods();
$hide_site_title        = $fivetwofive_theme_mods['site_identity_hide_blogname'];
$hide_site_description  = $fivetwofive_theme_mods['site_identity_hide_blogdescription'];
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
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'fivetwofive-theme' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="row">
				<div class="site-branding col-3">
					<div class="site-branding__logo">
						<?php the_custom_logo(); ?>
					</div>

					<?php if ( ! $hide_site_title || ! $hide_site_description ) : ?>
						<div class="site-branding__text">
							<?php
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
					<?php endif; ?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation col-9">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="menu-toggle__text"><?php esc_html_e( 'Menu', 'fivetwofive' ); ?></span></button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary_menu',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</header><!-- #masthead -->

	<div class="content-sidebar-wrap">
	<?php do_action( 'fivetwofive_before_content' ); ?>