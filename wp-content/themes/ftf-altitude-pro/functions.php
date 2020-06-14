<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'altitude', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'altitude' ) );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Altitude Pro Theme' );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/altitude/' );
define( 'CHILD_THEME_VERSION', '1.0.2' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'altitude_enqueue_scripts_styles' );
function altitude_enqueue_scripts_styles() {
	wp_enqueue_script( 'altitude-global', get_bloginfo( 'stylesheet_directory' ) . '/dist/js/scripts.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'altitude-google-fonts', '//fonts.googleapis.com/css?family=Lato|Montserrat&display=swap', array(), CHILD_THEME_VERSION );
}


// https://www.tipsandtricks-hq.com/a-simple-guide-to-adding-font-awesome-icons-to-your-wordpress-site-9617
add_action( 'wp_enqueue_scripts', 'jt_add_custom_fa_css' );

function jt_add_custom_fa_css() {
    wp_enqueue_style( 'custom-fa', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css' );
}

//* Load custom stylesheet
add_action( 'wp_enqueue_scripts', 'custom_load_custom_style_sheet' );
function custom_load_custom_style_sheet() {
	wp_enqueue_script( 'bootstrap-scripts', get_bloginfo( 'stylesheet_directory' ) . '/dist/js/vendor/bootstrap.min.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_style( 'custom-stylesheet', CHILD_URL . '/dist/css/jt-styles.css', array());
}


//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive- viewport' );

//* Add new image sizes
add_image_size( 'featured-page', 1140, 400, TRUE );

//* Add support for 1-column footer widget area
add_theme_support( 'genesis-footer-widgets', 1 );

//* Add support for footer menu
add_theme_support ( 'genesis-menus' , array ( 'primary' => __( 'Header Navigation Menu', 'altitude' ), 'secondary' => __( 'Above Header Navigation Menu', 'altitude' ), 'footer' => __( 'Footer Navigation Menu', 'altitude' ) ) );

//* Unregister the header right widget area
unregister_sidebar( 'header-right' );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

//* Remove output of primary navigation right extras
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_header', 'genesis_do_subnav', 5 );

//* Add secondary-nav class if secondary navigation is used
add_filter( 'body_class', 'altitude_secondary_nav_class' );
function altitude_secondary_nav_class( $classes ) {

	$menu_locations = get_theme_mod( 'nav_menu_locations' );

	if ( ! empty( $menu_locations['secondary'] ) ) {
		$classes[] = 'secondary-nav';
	}
	return $classes;

}

//* Hook menu in footer
add_action( 'genesis_footer', 'altitude_footer_menu', 7 );
function altitude_footer_menu() {

	genesis_nav_menu( array(
		'theme_location' => 'footer',
		'container'      => false,
		'depth'          => 1,
		'fallback_cb'    => false,
		'menu_class'     => 'genesis-nav-menu',	
	) );

}



// https://wordpress.stackexchange.com/questions/1403/organizing-code-in-your-wordpress-themes-functions-php-file
function jtModal() {
	locate_template( array( 'includes/jt-modal.php' ), true, true );
}
add_action( 'genesis_after_footer', 'jtModal' );


// My custom footer
function jtCustomFooter(){
    if( ! is_front_page() && is_singular() ){
	    locate_template( array( 'includes/jt-footer.php' ), true, true );
    }
}
add_action( 'genesis_before_footer', 'jtCustomFooter' );


//* Change the footer text
add_filter('genesis_pre_get_option_footer_text', 'sp_footer_creds_filter');
function sp_footer_creds_filter( $creds ) {
	$creds = '[footer_copyright] &middot; FiveTwoFive &middot; Powered by Fries';
	return $creds;
}

//* Add Attributes for Footer Navigation
add_filter( 'genesis_attr_nav-footer', 'genesis_attributes_nav' ); 

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'flex-height'     => true,
	'width'           => 360,
	'height'          => 76,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'footer-widgets',
	'footer',
) );

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'altitude_author_box_gravatar' );
function altitude_author_box_gravatar( $size ) {

	return 176;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'altitude_comments_gravatar' );
function altitude_comments_gravatar( $args ) {

	$args['avatar_size'] = 120;

	return $args;

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'altitude_remove_comment_form_allowed_tags' );
function altitude_remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'altitude' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
	$defaults['comment_notes_after'] = '';

	return $defaults;

}

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Relocate after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

//* Setup widget counts
function altitude_count_widgets( $id ) {
	global $sidebars_widgets;

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}

}

function altitude_widget_area_class( $id ) {
	$count = altitude_count_widgets( $id );

	$class = '';
	
	if( $count == 1 ) {
		$class .= ' widget-full';
	} elseif( $count % 3 == 1 ) {
		$class .= ' widget-thirds';
	} elseif( $count % 4 == 1 ) {
		$class .= ' widget-fourths';
	} elseif( $count % 2 == 0 ) {
		$class .= ' widget-halves uneven';
	} else {	
		$class .= ' widget-halves';
	}
	return $class;
	
}

//* Relocate the post info
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_post_info', 5 );

//* Customize the entry meta in the entry header
add_filter( 'genesis_post_info', 'altitude_post_info_filter' );
function altitude_post_info_filter( $post_info ) {

    $post_info = '[post_date format="M d Y"] [post_edit]';

    return $post_info;

}

//* Customize the entry meta in the entry footer
add_filter( 'genesis_post_meta', 'altitude_post_meta_filter' );
function altitude_post_meta_filter( $post_meta ) {

	$post_meta = 'Written by [post_author_posts_link] [post_categories before=" &middot; Categorized Under: "]  [post_tags before=" &middot; Tagged: "]';

	return $post_meta;
	
}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'front-page-1',
	'name'        => __( 'Front Page 1', 'altitude' ),
	'description' => __( 'This is the front page 1 section.', 'altitude' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-2',
	'name'        => __( 'Front Page 2', 'altitude' ),
	'description' => __( 'This is the front page 2 section.', 'altitude' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-3',
	'name'        => __( 'Front Page 3', 'altitude' ),
	'description' => __( 'This is the front page 3 section.', 'altitude' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-4',
	'name'        => __( 'Front Page 4', 'altitude' ),
	'description' => __( 'This is the front page 4 section.', 'altitude' ),
) );


// Change favicon location and add touch icons
add_filter( 'genesis_pre_load_favicon', 'gregr_favicon_filter' );
function gregr_favicon_filter( $favicon ) {
  echo '<link rel="Shortcut Icon" href="'. CHILD_URL .'/dist/images/favicon.ico" type="image/x-icon" />' . "\n";
  echo '<link rel="Shortcut Icon" type="image/png" href="'. CHILD_URL .'/dist/images/favicon.png" type="image/x-icon" sizes="50x50"/>' . "\n";
  echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="'. CHILD_URL .'/dist/images/apple-touch-icon-144x144-precomposed.png" />'."\n";
  echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="'. CHILD_URL .'/dist/images/apple-touch-icon-114x114-precomposed.png" />'."\n";
  echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="'. CHILD_URL .'/dist/images/apple-touch-icon-72x72-precomposed.png" />'."\n";
  echo '<link rel="apple-touch-icon-precomposed" href="'. CHILD_URL .'/dist/images/apple-touch-icon-precomposed.png" />'."\n";
}

/*This is for the social icons*/
// add_filter( 'genesis_pre_load_favicon', 'dm_fontastic_icons' );
// function dm_fontastic_icons() {
// 	echo '<link href="https://file.myfontastic.com/fs6eZssmB29PigPnTfXwBG/icons.css" rel="stylesheet">';	
// }

/* Code to Display Featured Image on top of the post */
add_action( 'genesis_entry_content', 'featured_post_image', 8 );
function featured_post_image() {

	if (is_singular('post')) {

		//your code here...
		the_post_thumbnail('post-image');

	}
}


/* Disable auto paragraphs and line breaks*/
// remove_filter( ‘the_content’, ‘wpautop’ );
// remove_filter( ‘the_excerpt’, ‘wpautop’ );

// function remove_p_on_pages() {
// 	if ( is_page( 'portfolio-template' ) ) {
// 		remove_filter( 'the_content', 'wpautop' );
// 		remove_filter( 'the_excerpt', 'wpautop' );
// 	}
// }

function remove_p_on_pages() {
	if ( is_page( array( 'home', 'work', 'about-me', 'process', 'modal-test' ) ) ){
		remove_filter( 'the_content', 'wpautop' );
		remove_filter( 'the_excerpt', 'wpautop' );
	}
}

add_action( 'wp_head', 'remove_p_on_pages' );


/**
 * Snippet Name: Remove wpautop only for custom post types
 * Snippet URL: http://www.wpcustoms.net/snippets/remove-wpautop-custom-post-types/
 */
 function wpc_remove_autop_for_posttype( $content )
 {
	 // edit the post type here
	 'featured-projects' === get_post_type() && remove_filter( 'the_content', 'wpautop' );
	 return $content;
 }
add_filter( 'the_content', 'wpc_remove_autop_for_posttype', 0 );




// Add widget before blog roll
genesis_register_sidebar( array(
	'id' => 'before-blog',
	'name' => __( 'Before Blog Widget', 'wpsites' ),
	'description' =>  __( 'This is the before post widget area on the blog page only.', 'wpsites' )
) );
add_action( 'genesis_before_loop', 'wpsites_before_blog_widget', 9 );
function wpsites_before_blog_widget() {
	$classes = get_body_class();
	if (in_array('blog',$classes)) {
		genesis_widget_area( 'before-blog', array(
			'before' => '<div class="before-blog widget-area">',
			'after'  => '</div>'
		) );
	}
}


// featured image link to post
// http://www.wpbeginner.com/wp-themes/how-to-automatically-link-featured-images-to-posts-in-wordpress/
function wpb_autolink_featured_images( $html, $post_id, $post_image_id ) {
    if (! is_singular()) {
        $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . $html . '</a>';
        return $html;
    } else {
        return $html;
    }
}
add_filter( 'post_thumbnail_html', 'wpb_autolink_featured_images', 10, 3 );


// Custom Dashboard Widget
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
    global $wp_meta_boxes;
    wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
}

function custom_dashboard_help() {
    echo '<p>Welcome to my custom genesis theme! Need help? Contact the developer <a href="mailto:info@jabaltorres.com">here</a>.</p>';
}


include_once get_stylesheet_directory() . '/jt_functions/jt_google_tag_manager.php';


/* Add next/previous post links on single posts
*  https://eugenoprea.com/code-snippets/genesis-how-to-add-previousnext-post-navigation/
----------------------------------------------------------------------------------------*/
add_action( 'genesis_after_entry', 'eo_prev_next_post_nav' );

function eo_prev_next_post_nav() {
	if ( is_single() ) {

		echo '<div class="prev-next-navigation py-4 mb-4">';
		    previous_post_link( '<div class="previous">Previous article: %link</div>', '%title' );
		    next_post_link( '<div class="next">Next article: %link</div>', '%title' );
		echo '</div><!-- .prev-next-navigation -->';

	}
}



add_action( 'genesis_entry_footer', 'wpsites_single_cpt_navigation' );
function wpsites_single_cpt_navigation() {

	if ( ! is_singular( 'featured-projects' ) )
		return;

	genesis_markup( array(
		'html5'   => '<div %s>',
		'xhtml'   => '<div class="navigation">',
		'context' => 'adjacent-entry-pagination',
	) );

	echo '<div class="pagination-previous alignleft">';
	previous_post_link();
	echo '</div>';

	echo '<div class="pagination-next alignright">';
	next_post_link();
	echo '</div>';

	echo '</div>';

}
/* Customizing the Login Form
* https://codex.wordpress.org/Customizing_the_Login_Form#Styling_Your_Login
----------------------------------------------------------------------------------------*/
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/dist/images/site-login-logo.png);
            height:65px;
            width:320px;
            background-size: 320px 65px;
            background-repeat: no-repeat;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Jabal Torres MuthaFucka!!!';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css' );
    wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style-login.js' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );


// Add custom post type to main query
add_action('pre_get_posts', 'query_post_type');
function query_post_type($query) {
    if($query->is_main_query()
       && ( is_category() || is_tag() )) {
        $query->set( 'post_type', array('post','featured-projects') );
    }
}



include_once get_stylesheet_directory() . '/jt_functions/jt_shortcodes.php';