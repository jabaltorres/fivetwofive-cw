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
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WV9BWXZ');</script>
    <!-- End Google Tag Manager -->

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WV9BWXZ"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

<?php wp_body_open(); ?>
<div id="page" class="site">
	<ul class="fivetwovive-skip-link">
		<li><a href="#masthead" class="screen-reader-shortcut"> Skip to primary navigation</a></li>
		<li><a href="#primary" class="screen-reader-shortcut"> Skip to main content</a></li>
		<li><a href="#colophon" class="screen-reader-shortcut"> Skip to footer</a></li>
	</ul>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="row align-items-center">
				<div class="site-branding col-12 col-md-3">
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
				<?php if ( has_nav_menu( 'primary_menu' ) ) : ?>
					<nav id="site-navigation" class="main-navigation col-12 col-md-9">
						<button class="menu-toggle hamburger hamburger--slider d-none" type="button" aria-label="Menu" aria-controls="primary-menu" aria-expanded="false">
							<span class="menu-toggle__text screen-reader-text"><?php esc_html_e( 'Menu', 'fivetwofive' ); ?></span>
							<span class="hamburger-box">
								<span class="hamburger-inner"></span>
							</span>
						</button>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary_menu',
								'menu_id'        => 'primary-menu',
							)
						);
						?>
					</nav><!-- #site-navigation -->
				<?php endif; ?>
			</div>
		</div>
	</header><!-- #masthead -->

	<div class="content-sidebar-wrap">
	<?php do_action( 'fivetwofive_before_content' ); ?>