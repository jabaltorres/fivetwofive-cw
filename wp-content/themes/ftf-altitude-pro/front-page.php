<?php
/**
 * This file adds the Home Page to the FiveTwoFive Theme.
 *
 * @author StudioPress
 * @package FiveTwoFive
 * @subpackage Customizations
 */

add_action( 'genesis_meta', 'fivetwofive_front_page_genesis_meta' );

/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 */
function fivetwofive_front_page_genesis_meta() {

	if ( is_active_sidebar( 'front-page-1' ) || is_active_sidebar( 'front-page-2' ) || is_active_sidebar( 'front-page-3' ) || is_active_sidebar( 'front-page-4' ) ) {

		// Enqueue scripts
		add_action( 'wp_enqueue_scripts', 'fivetwofive_enqueue_front_page_script' );

		// Add front-page body class
		add_filter( 'body_class', 'fivetwofive_body_class' );

		// Force full width content layout
		add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

		// Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		// Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		// Add homepage widgets
		add_action( 'genesis_loop', 'fivetwofive_front_page_widgets' );

		// Add featured-section body class
		if ( is_active_sidebar( 'front-page-1' ) ) {

			//* Add image-section-start body class
			add_filter( 'body_class', 'fivetwofive_featured_body_class' );

		}

	}

	// Add contact form section
	add_action( 'genesis_loop', 'fivetwofive_contact_us_section', 20 );

}

/**
 * Defines front page scripts.
 *
 * @since 1.0.0
 */
function fivetwofive_enqueue_front_page_script() {
	wp_enqueue_script( 'localScroll', get_stylesheet_directory_uri() . '/lib/assets/js/vendor/jquery.localScroll.min.js', array( 'scrollTo' ), '1.2.8b', true );
	wp_enqueue_script( 'scrollTo', get_stylesheet_directory_uri() . '/lib/assets/js/vendor/jquery.scrollTo.min.js', array( 'jquery' ), '1.4.5-beta', true );
}

/**
 * Defines front-page body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Original body classes.
 * @return array $classes Updated body classes.
 */
function fivetwofive_body_class( $classes ) {
	$classes[] = 'front-page';
	return $classes;
}

/**
 * Adds markup for front page widget areas.
 *
 * @since 1.0.0
 */
function fivetwofive_front_page_widgets() {

	genesis_widget_area( 'front-page-1', array(
		'before' => '<div id="front-page-1" class="front-page-1"><div class="image-section"><div class="flexible-widgets widget-area' . fivetwofive_widget_area_class( 'front-page-1' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'front-page-2', array(
		'before' => '<div id="front-page-2" class="front-page-2"><div class="solid-section"><div class="flexible-widgets widget-area' . fivetwofive_widget_area_class( 'front-page-2' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'front-page-3', array(
		'before' => '<div id="front-page-3" class="front-page-3"><div class="solid-section"><div class="flexible-widgets widget-area ' . fivetwofive_widget_area_class( 'front-page-3' ) . '">',
		'after'  => '</div></div></div>',
	) );

	genesis_widget_area( 'front-page-4', array(
		'before' => '<div id="front-page-4" class="front-page-4"><div class="solid-section"><div class="flexible-widgets widget-area' . fivetwofive_widget_area_class( 'front-page-4' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

}

/**
 * Add contact us section in the homepage.
 */
function fivetwofive_contact_us_section() {
	ob_start();
	?>
	<div id="front-page-contact-form" class="front-page-contact-form text-white">
		<div class="inner-wrapper">
			<div class="container">
				<div class="col-12 py-5">
					<div class="form mx-auto">
						<h4 class="text-center text-uppercase"><?php echo esc_html__( 'Let\'s Work Together', 'fivetwofive' ); ?></h4>
                        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/shell.js"></script>
                        <script>
                            hbspt.forms.create({
                                region: "na1",
                                portalId: "7921289",
                                formId: "deb3b177-d77f-4c7e-8686-cc8ffc540be8"
                            });
                        </script>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	echo ob_get_clean();
}

/**
 * Defines featured-section body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Original body classes.
 * @return array $classes Modified body classes.
 */
function fivetwofive_featured_body_class( $classes ) {
	$classes[] = 'featured-section';
	return $classes;
}

genesis();
