<?php
/**
 * FiveTwoFive
 *
 * This file adds the functions to the FiveTwoFive Theme.
 *
 * @package FiveTwoFive
 * @author  FiveTwoFive
 * @license GPL-2.0-or-later
 * @link    https://fivetwofive.com/
 */

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'FiveTwoFive Theme' );
define( 'CHILD_THEME_URL', 'https://fivetwofive.com/' );
define( 'CHILD_THEME_VERSION', '1.0.6' );
define( 'CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );

// Start the engine.
require_once get_template_directory() . '/lib/init.php';

// Setup Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

// Set Localization (do not remove).
load_child_theme_textdomain( 'fivetwofive', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'fivetwofive' ) );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Include Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

require_once CHILD_THEME_DIR . '/lib/functions/shortcodes.php';

/**
 * Enqueue scripts and styles
 *
 * @link https://www.tipsandtricks-hq.com/a-simple-guide-to-adding-font-awesome-icons-to-your-wordpress-site-9617
 * @return void
 */
function fivetwofive_enqueue_scripts_styles() {
	wp_enqueue_script( 'fivetwofive-global', get_bloginfo( 'stylesheet_directory' ) . '/lib/assets/js/scripts.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'fancybox', CHILD_THEME_URI . '/lib/assets/js/vendor/fancybox/fancybox.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'fancybox_css', CHILD_THEME_URI . '/lib/assets/js/vendor/fancybox/fancybox.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'custom-fa', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_script( 'bootstrap-scripts', get_bloginfo( 'stylesheet_directory' ) . '/lib/assets/js/vendor/bootstrap.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_enqueue_style( 'custom-stylesheet', CHILD_THEME_URI . '/lib/assets/css/main.css', array(), CHILD_THEME_VERSION );
}
add_action( 'wp_enqueue_scripts', 'fivetwofive_enqueue_scripts_styles' );

/**
 * Add HTML5 markup structure
 */
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

/**
 * Add viewport meta tag for mobile browsers
 */
add_theme_support( 'genesis-responsive- viewport' );

/**
 * Add new image sizes
 */
add_image_size( 'featured-page', 1140, 400, true );

/**
 * Add support for 1-column footer widget area
 */
add_theme_support( 'genesis-footer-widgets', 1 );

/**
 * Add support for footer menu
 */
add_theme_support(
	'genesis-menus',
	array(
		'primary' => __( 'Header Navigation Menu', 'fivetwofive' ),
		'secondary' => __( 'Above Header Navigation Menu', 'fivetwofive' ),
		'footer' => __( 'Footer Navigation Menu', 'fivetwofive' ),
	)
);

// Add support for custom header.
add_theme_support(
	'custom-header',
	array(
		'flex-height'     => true,
		'width'           => 360,
		'height'          => 76,
		'header-selector' => '.site-title a',
		'header-text'     => false,
	)
);

// Add support for structural wraps.
add_theme_support(
	'genesis-structural-wraps',
	array(
		'header',
		'nav',
		'subnav',
		'footer-widgets',
		'footer',
	)
);

/**
 * Unregister the header right widget area
 */
unregister_sidebar( 'header-right' );

/**
 * Reposition the primary navigation menu
 */
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

/**
 * Remove output of primary navigation right extras
 */
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

/**
 * Reposition the secondary navigation menu
 */
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_header', 'genesis_do_subnav', 5 );

/**
 * Add secondary-nav class if secondary navigation is used
 *
 * @param array $classes Secondary nav classes.
 * @return array $classes Secondary nav classes.
 */
function fivetwofive_secondary_nav_class( $classes ) {
	$menu_locations = get_theme_mod( 'nav_menu_locations' );

	if ( ! empty( $menu_locations['secondary'] ) ) {
		$classes[] = 'secondary-nav';
	}
	return $classes;
}
add_filter( 'body_class', 'fivetwofive_secondary_nav_class' );

/**
 * Hook menu in footer
 *
 * @return void
 */
function fivetwofive_footer_menu() {
	genesis_nav_menu(
		array(
			'theme_location' => 'footer',
			'container'      => false,
			'depth'          => 1,
			'fallback_cb'    => false,
			'menu_class'     => 'genesis-nav-menu',
		)
	);
}
add_action( 'genesis_footer', 'fivetwofive_footer_menu', 7 );


/**
 * Undocumented function
 *
 * @link https://wordpress.stackexchange.com/questions/1403/organizing-code-in-your-wordpress-themes-functions-php-file
 * @return void
 */
function fivetwofive_modal() {
	locate_template( array( 'lib/views/modal.php' ), true, true );
}
add_action( 'genesis_after_footer', 'fivetwofive_modal' );

/**
 * FiveTwoFive custom footer - Example on single blog posts
 *
 * @return void
 */
function fivetwowfive_custom_footer() {
	if ( ! is_front_page() && is_singular() ) {
		locate_template( array( 'lib/views/footer.php' ), true, true );
	}
}
add_action( 'genesis_before_footer', 'fivetwowfive_custom_footer' );

/**
 * Change the footer text
 *
 * @param string $creds Site Footer credits.
 * @return string $creds Site Footer credits.
 */
function fivetwofive_footer_creds_filter( $creds ) {
	$creds = '[footer_copyright] &middot; FiveTwoFive &middot; Powered by Fries';
	return $creds;
}
add_filter( 'genesis_pre_get_option_footer_text', 'fivetwofive_footer_creds_filter' );

// Add Attributes for Footer Navigation.
add_filter( 'genesis_attr_nav-footer', 'genesis_attributes_nav' );

// Unregister layout settings.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Unregister secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

/**
 * Modify the size of the Gravatar in the author box.
 *
 * @param int $size gravatar author size.
 * @return int gravatar author size.
 */
function fivetwofive_author_box_gravatar( $size ) {
	return 176;
}
add_filter( 'genesis_author_box_gravatar_size', 'fivetwofive_author_box_gravatar' );

/**
 * Modify the size of the Gravatar in the entry comments
 *
 * @param array $args Comment list arguments.
 * @return array $args Comment list arguments.
 */
function fivetwofive_comments_gravatar( $args ) {
	$args['avatar_size'] = 120;
	return $args;
}
add_filter( 'genesis_comment_list_args', 'fivetwofive_comments_gravatar' );

/**
 * Remove comment form allowed tags
 *
 * @param array $defaults Comment form defaults.
 * @return array defaults Comment form defaults.
 */
function fivetwofive_remove_comment_form_allowed_tags( $defaults ) {
	$defaults['comment_field']       = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'fivetwofive' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
	$defaults['comment_notes_after'] = '';
	return $defaults;
}
add_filter( 'comment_form_defaults', 'fivetwofive_remove_comment_form_allowed_tags' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Relocate after entry widget.
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

/**
 * Counts widgets in given sidebar.
 *
 * @since 1.0.0
 *
 * @param string $id The id of the widget area.
 * @return void|int The number of widgets, or nothing.
 */
function fivetwofive_count_widgets( $id ) {
	global $sidebars_widgets;
	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}
}

/**
 * Gets class name for widget areas based on widget count.
 *
 * Used by front-page.php.
 *
 * @since 1.0.0
 *
 * @param string $id The ID of the widget area.
 * @return string The class name to use based on the widget count.
 */
function fivetwofive_widget_area_class( $id ) {
	$count = fivetwofive_count_widgets( $id );
	$class = '';

	if ( $count == 1 ) {
		$class .= ' widget-full';
	} elseif ( $count % 3 == 1 ) {
		$class .= ' widget-thirds';
	} elseif ( $count % 4 == 1 ) {
		$class .= ' widget-fourths';
	} elseif ( $count % 2 == 0 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves';
	}
	return $class;
}

// Relocate the post info.
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_post_info', 5 );

/**
 * Customize the entry meta in the entry header.
 *
 * @param string $post_info Post entry meta.
 * @return string $post_info Post entry meta.
 */
function fivetwofive_post_info_filter( $post_info ) {
	$post_info = '[post_date format="M d Y"] [post_edit]';
	return $post_info;
}
add_filter( 'genesis_post_info', 'fivetwofive_post_info_filter' );

/**
 * Customize the entry meta in the entry footer
 *
 * @param string $post_meta Post meta in footer.
 * @return string $post_meta Post meta in footer.
 */
function fivetwofive_post_meta_filter( $post_meta ) {
	$post_meta = 'Written by [post_author_posts_link] [post_categories before=" &middot; Categorized Under: "]  [post_tags before=" &middot; Tagged: "]';
	return $post_meta;
}
add_filter( 'genesis_post_meta', 'fivetwofive_post_meta_filter' );

// Register widget areas.
genesis_register_sidebar(
	array(
		'id'          => 'front-page-1',
		'name'        => __( 'Front Page 1', 'altitude' ),
		'description' => __( 'This is the front page 1 section.', 'altitude' ),
	)
);

genesis_register_sidebar(
	array(
		'id'          => 'front-page-2',
		'name'        => __( 'Front Page 2', 'altitude' ),
		'description' => __( 'This is the front page 2 section.', 'altitude' ),
	)
);

genesis_register_sidebar(
	array(
		'id'          => 'front-page-3',
		'name'        => __( 'Front Page 3', 'altitude' ),
		'description' => __( 'This is the front page 3 section.', 'altitude' ),
	)
);

genesis_register_sidebar(
	array(
		'id'          => 'front-page-4',
		'name'        => __( 'Front Page 4', 'altitude' ),
		'description' => __( 'This is the front page 4 section.', 'altitude' ),
	)
);

// Add widget before blog roll.
genesis_register_sidebar(
	array(
		'id'          => 'before-blog',
		'name'        => __( 'Before Blog Widget', 'fivetwofive' ),
		'description' => __( 'This is the before post widget area on the blog page only.', 'fivetwofive' ),
	)
);

/**
 * Change favicon location and add touch icons
 */
function fivetwofive_favicon_filter() {
	echo '<link rel="Shortcut Icon" href="' . esc_url( CHILD_THEME_URI ) . '/lib/assets/images/favicon.ico" type="image/x-icon" />';
	echo '<link rel="Shortcut Icon" type="image/png" href="' . esc_url( CHILD_THEME_URI ) . '/lib/assets/images/favicon.png" type="image/x-icon" sizes="50x50"/>';
	echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="' . esc_url( CHILD_THEME_URI ) . '/lib/assets/images/apple-touch-icon-144x144-precomposed.png" />';
	echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="' . esc_url( CHILD_THEME_URI ) . '/lib/assets/images/apple-touch-icon-114x114-precomposed.png" />';
	echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="' . esc_url( CHILD_THEME_URI ) . '/lib/assets/images/apple-touch-icon-72x72-precomposed.png" />';
	echo '<link rel="apple-touch-icon-precomposed" href="' . esc_url( CHILD_THEME_URI ) . '/lib/assets/images/apple-touch-icon-precomposed.png" />';
}
add_filter( 'genesis_pre_load_favicon', 'fivetwofive_favicon_filter' );

/**
 * Display Featured Image on top of the post
 */
function fivetwofive_featured_post_image() {
	if ( is_singular( 'post' ) ) {
		the_post_thumbnail( 'post-image' );
	}
}
add_action( 'genesis_entry_content', 'fivetwofive_featured_post_image', 8 );

/**
 * Disable auto paragraphs and line breaks
 *
 * @return void
 */
function fivetwofive_remove_wpautop() {
	if ( is_page( array( 'home', 'work', 'about-me', 'process', 'modal-test' ) ) ){
		remove_filter( 'the_content', 'wpautop' );
		remove_filter( 'the_excerpt', 'wpautop' );
	}
}
add_action( 'wp_head', 'fivetwofive_remove_wpautop' );

/**
 * Remove wpautop filter in the featured projects content.
 *
 * @param string $content Featured Projects content.
 * @return string $content Featured Projects content.
 */
function fivetowfive_remove_wpautop( $content ) {
	if ( 'featured-projects' === get_post_type() ) {
		remove_filter( 'the_content', 'wpautop' );
	}
	return $content;
}
// add_filter( 'the_content', 'fivetowfive_remove_wpautop', 0 );

/**
 * Add the before blog widget area on blog page.
 *
 * @return void
 */
function fivetwofive_before_blog_widget() {
	$classes = get_body_class();
	if ( in_array( 'blog', $classes, true ) ) {
		genesis_widget_area(
			'before-blog',
			array(
				'before' => '<div class="before-blog widget-area">',
				'after'  => '</div>',
			)
		);
	}
}
add_action( 'genesis_before_loop', 'fivetwofive_before_blog_widget', 9 );

/**
 * Featured image link to post
 *
 * @link http://www.wpbeginner.com/wp-themes/how-to-automatically-link-featured-images-to-posts-in-wordpress/
 * @param string $html featured image html.
 * @param int $post_id post id.
 * @param int $post_image_id featured image id.
 * @return void
 */
function fivetwofive_autolink_featured_images( $html, $post_id, $post_image_id ) {
	if ( ! is_singular() ) {
		$html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . $html . '</a>';
		return $html;
	} else {
		return $html;
	}
}
add_filter( 'post_thumbnail_html', 'fivetwofive_autolink_featured_images', 10, 3 );

/**
 * Custom Dashboard Widget
 *
 * @return void
 */
function fivetwofive_custom_dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
}
add_action( 'wp_dashboard_setup', 'fivetwofive_custom_dashboard_widgets' );

/**
 * Custom dashboard help.
 *
 * @return void
 */
function custom_dashboard_help() {
	echo '<p>Welcome to my custom genesis theme! Need help? Contact the developer <a href="mailto:info@jabaltorres.com">here</a>.</p>';
}

/* Add next/previous post links on single posts
*  https://eugenoprea.com/code-snippets/genesis-how-to-add-previousnext-post-navigation/
----------------------------------------------------------------------------------------*/
function fivetwofive_prev_next_post_nav() {
	if ( is_single() ) {

		echo '<div class="prev-next-navigation py-4 mb-4">';
		previous_post_link( '<div class="previous">Previous article: %link</div>', '%title' );
		next_post_link( '<div class="next">Next article: %link</div>', '%title' );
		echo '</div><!-- .prev-next-navigation -->';

	}
}
add_action( 'genesis_after_entry', 'fivetwofive_prev_next_post_nav' );

/**
 * Add navigation to the featured projects single page.
 *
 * @return void
 */
function fivetwofive_single_cpt_navigation() {
	if ( ! is_singular( 'featured-projects' ) ) {
		return;
	}

	genesis_markup(
		array(
			'html5'   => '<div %s>',
			'xhtml'   => '<div class="navigation">',
			'context' => 'adjacent-entry-pagination',
		)
	);

	echo '<div class="pagination-previous alignleft">';
	previous_post_link();
	echo '</div>';

	echo '<div class="pagination-next alignright">';
	next_post_link();
	echo '</div>';

	echo '</div>';
}
add_action( 'genesis_entry_footer', 'fivetwofive_single_cpt_navigation' );

/**
 * Change the Login Form logo.
 *
 * @link https://codex.wordpress.org/Customizing_the_Login_Form#Styling_Your_Login
 * @return void
 */
function fivetwofive_login_logo() {
	?>
	<style type="text/css">
		#login h1 a, .login h1 a {
			background-image: url(<?php echo CHILD_THEME_URI; ?>/dist/images/site-login-logo.png);
			height: 65px;
			width: 320px;
			background-size: 320px 65px;
			background-repeat: no-repeat;
		}
	</style>
	<?php
}
add_action( 'login_enqueue_scripts', 'fivetwofive_login_logo' );

/**
 * Change the login logo link.
 *
 * @return string home page url.
 */
function fivetwofive_login_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'fivetwofive_login_logo_url' );

/**
 * Change the Login logo url title attribute.
 *
 * @return string login logo url title.
 */
function fivetwofive_login_logo_url_title() {
	return '525 FTW!!!';
}
add_filter( 'login_headertitle', 'fivetwofive_login_logo_url_title' );

/**
 * FiveTwoFive Custom login scripts and styles.
 *
 * @return void
 */
function fivetwofive_login_stylesheet() {
	wp_enqueue_style( 'fivetwofive-custom-login', CHILD_THEME_URI . '/style-login.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_script( 'fivetwofive-custom-login', CHILD_THEME_URI . '/style-login.js', array(), CHILD_THEME_VERSION, true );
}
add_action( 'login_enqueue_scripts', 'fivetwofive_login_stylesheet' );

/**
 * Add Featured Projects custom post type to main query
 *
 * @param object $query Query object.
 * @return void
 */
function fivetwofive_query_post_type( $query ) {
	if ( $query->is_main_query() && ( is_category() || is_tag() ) ) {
		$query->set( 'post_type', array( 'post', 'featured-projects' ) );
	}
}
add_action( 'pre_get_posts', 'fivetwofive_query_post_type' );

/**
 * Add Google Tag Manager code in <head>
 *
 * @return void
 */
function fivetwofive_google_tag_manager_head() {
	?>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
					new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-WV9BWXZ');</script>
		<!-- End Google Tag Manager -->
	<?php
}
add_action( 'wp_head', 'fivetwofive_google_tag_manager_head' );

/**
 * Add Google Tag Manager code immediately below opening <body> tag
 *
 * @return void
 */
function fivetwofive_google_tag_manager_body() {
	?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WV9BWXZ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?php
}
add_action( 'genesis_before', 'fivetwofive_google_tag_manager_body' );

/**
 * Custom Column with Currently Active Page Template
 *
 * @link https://www.isitwp.com/custom-column-with-currently-active-page-template/
 * @param array $defaults active page template default.
 * @return array $defaults active page template default.
 */
function fivetwofive_page_column_views( $defaults ) {
	$defaults['page-layout'] = __( 'Template' );
	return $defaults;
}
add_filter( 'manage_pages_columns', 'fivetwofive_page_column_views' );

/**
 * Show the page template in the admin table.
 *
 * @param string $column_name table column name.
 * @param int $id post id.
 * @return string template name.
 */
function fivetwofive_page_custom_column_views( $column_name, $id ) {
	if ( 'page-layout' === $column_name ) {
		$set_template = get_post_meta( $id, '_wp_page_template', true );

		if ( 'default' === $set_template ) {
			echo 'Default';
		}

		$templates = get_page_templates();
		ksort( $templates );

		foreach ( array_keys( $templates ) as $template ) {
			if ( $set_template === $templates[ $template ] ) {
				echo $template;
			}
		}
	}
}
add_action( 'manage_pages_custom_column', 'fivetwofive_page_custom_column_views', 5, 2 );

/**
 * Make the page-layout column sortable in admin pages table.
 *
 * @author Danilo Parra Jr. <danilo@ripplepop.com>
 * @param array $columns array of columns.
 * @return array $columns updated columns with page-layout set as sortable.
 */
function fivetwofive_make_page_template_column_sortable( $columns ) {
	$columns['page-layout'] = 'page-layout';
	return $columns;
}
add_filter( 'manage_edit-page_sortable_columns', 'fivetwofive_make_page_template_column_sortable' );

/**
 * Sort the pages table by page template.
 *
 * @author Danilo Parra Jr. <danilo@ripplepop.com>
 * @param object $query instance of WP_Query class.
 * @return void
 */
function fivetwofive_sort_page_template_column_query( $query ) {
	global $pagenow;

	if ( is_admin() && 'edit.php' === $pagenow && 'page' === $_GET['post_type'] ) {
		$orderby = $query->get( 'orderby' );

		if ( 'page-layout' === $orderby ) {
			$query->set( 'meta_key', '_wp_page_template' );
			$query->set( 'orderby', 'meta_value' );
		}
	}
}
add_action( 'pre_get_posts', 'fivetwofive_sort_page_template_column_query' );
