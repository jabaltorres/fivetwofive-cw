<?php
    /**
    * Template Name: Single FiveTwoFive LP
    *
    * @link https://codex.wordpress.org/Template_Hierarchy
    *
    * @package The Authority
    */

    $lp_hubspot_form_heading = get_field('lp_hubspot_form_heading');
    $lp_hubspot_form_embed = get_field('lp_hubspot_form_embed');

    add_filter( 'body_class', 'custom_class' );

    function custom_class( $classes ) {
        if ( is_singular( 'fivetwofive-lp' ) ) {
            $classes[] = 'fivetwofive-lp-template';
        }
        return $classes;
    }

    get_header('landing');
?>

<div class="hero py-5">
	<div class="container">
		<div class="container_inner">
			<h1 class="text-center"><?php the_title(); ?></h1>
		</div>
	</div>
</div>

<div class="container">
    <div class="row">
        <main id="main" class="site-main col-12 col-md-8" role="main">
            <div class="content-wrapper m-b-lg">
                <div class="content-container">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </main><!-- #main -->

        <aside id="sidebar" class="col-12 col-md-4">
            <?php if ($lp_hubspot_form_heading): ?>
                <h3 class="lp-hs-form-heading"><?= $lp_hubspot_form_heading ;?></h3>
            <?php endif; ?>
            <?php echo $lp_hubspot_form_embed; ?>
        </aside><!-- #sidebar -->
    </div>
</div>

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
        case 'module_carousel_quote':
            get_template_part('templates/modules/module-quote-carousel');
            break;
        case 'image_with_overlay_section':
            get_template_part('templates/modules/module-image-overlay');
            break;
        case 'multi_column_video_section':
            get_template_part('templates/modules/multi-column-video-section');
            break;
        case 'image_mosaic_section':
            get_template_part('templates/modules/module-image-mosaic');
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
        case 'news_slider_module':
            get_template_part('templates/modules/module_news_slider');
            break;
        default:
            echo 'no match';
    }
endwhile; ?>

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