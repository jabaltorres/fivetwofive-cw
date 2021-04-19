<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php // include "includes/gtm_antiflicker.php";?>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KXPPRXM" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <header class="lp-header">
        <div class="container">
            <div class="row header-wrapper">
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
<!--                        <img src="/wp-content/uploads/2019/06/logo-black.png" alt="Logo" />-->
                        <div class="site-title">525 Creative</div>
                    </a>
                </div>
                <div id="phone-number-and-cta-button" class="col-md-5 col-lg-4 col-xl-3">
                    <div class="phone-number-wrapper">
                        <a class="font-weight-bold" href="tel:916-399-3117">1 (916) 399-3117</a>
                    </div>
                    <div class="button-wrapper">
                        <a href="/contact-us/" class="btn btn-primary">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php // echoHello(); ?>