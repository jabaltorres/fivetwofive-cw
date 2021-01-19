<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php include "includes/gtm_antiflicker.php";?>
	<?php include "includes/hotjar.php";?>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KXPPRXM" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <header>
        <div class="container">
            <div class="container_inner clearfix header-wrapper">
                <div id="header-image">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
<!--                        <img src="/wp-content/uploads/2019/06/logo-black.png" alt="Logo" />-->
                        <h1>525 Creative</h1>
                    </a>
                </div>
                <div class="button-wrapper">
                    <a href="/download/" class="button">Download</a>
                </div>
            </div>
        </div>
    </header>

	<div class="wrapper">
		<div class="wrapper_inner">

            <?php //echoHello(); ?>