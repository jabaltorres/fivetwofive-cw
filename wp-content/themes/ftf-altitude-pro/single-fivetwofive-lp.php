<?php
/**
* Template Name: Single FiveTwoFive LP
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package The Authority
*/

add_filter( 'body_class', 'custom_class' );

function custom_class( $classes ) {
	if ( is_singular( 'fivetwofive-lp' ) ) {
		$classes[] = 'fivetwofive-lp-template';
	}
	return $classes;
}

// get_template_part('header-landing.php');
get_header('landing'); ?>

<style>.intercom-launcher { display:none !important; }</style>

<div class="hero m-b-lg p-y-lg">
	<div class="container">
		<div class="container_inner">
			<h1 class="text-center"><?php the_title(); ?></h1>
		</div>
	</div>
</div>

<div class="content">

    <div id="primary" class="content-area-full">
        <main id="main" class="site-main m-b-md d-none" role="main">
            <div class="content-wrapper m-b-lg">
                <div class="content-container">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </main><!-- #main -->


        <?php while ( have_rows('modules') ) : the_row();
            switch (get_row_layout()) {
                case 'hero_section':
                    get_template_part('templates/modules/module-hero');
                    break;
                case 'announcement_section':
                    get_template_part('templates/modules/announcement-section');
                    break;
                case 'multi_column_section':
                    get_template_part('templates/modules/module-multi-column');
                    break;
                case 'carousel_section':
                    get_template_part('templates/modules/carousel-section');
                    break;
                case 'image_with_overlay_section':
                    get_template_part('templates/modules/module-image-overlay');
                    break;
                case 'multi_column_video_section':
                    get_template_part('templates/modules/multi-column-video-section');
                    break;
                case 'image_mosaic_section':
                    get_template_part('templates/modules/image-mosaic-section');
                    break;
                case 'content_block_module':
                    get_template_part('templates/modules/content-block-section');
                    break;
                case 'featured_image_module':
                    get_template_part('templates/modules/module-featured-image');
                    break;
                case 'raw_code':
                    get_template_part('templates/modules/raw-code-section');
                    break;
                case 'resources_section':
                    get_template_part('templates/modules/resources-section');
                    break;
                case 'cta_module':
                    get_template_part('templates/modules/cta-module-section');
                    break;
                case 'multi_column_video_quotes':
                    get_template_part('templates/modules/multi-column-video-quotes');
                    break;
                case 'news_slider_module':
                    get_template_part('templates/modules/module_news_slider');
                    break;
                default:
                    echo 'no match';
            }
        endwhile; ?>

        <?php if ( is_active_sidebar( 'custom-side-bar' ) ) { ?>
            <aside id="sidebar" class="m-b-md">
                <?php dynamic_sidebar( 'custom-side-bar' ); ?>
            </aside>
        <?php } ?>
    </div><!-- #primary -->

</div>

<?php include_once get_stylesheet_directory() . '/includes/lp_three_col_cta_section.php'; ?>


<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {

        $(".various").fancybox({

            afterShow: function(){
                if( ($( window ).width()) > 800 ){  $('#main video').css('display','none'); }
            },
            afterClose: function(){
                if( ($( window ).width()) > 800 ){ $('#main video').css('display','block'); }
            },
            helpers: {
                overlay: {
                    locked: false
                }
            }
        });
    });
</script>

<?php get_footer('landing'); ?>