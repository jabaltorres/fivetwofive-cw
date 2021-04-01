<?php 
	/* Template Name: Modules Template */
?>
<?php get_header(); ?>

<?php
    // Removing Paragraph Tags from WYSIWYG Fields
    remove_filter('acf_the_content', 'wpautop');
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="clearfix"></div>
<div id="content" class="homepage">
	<div id="main-wrap" role="main">
		<?php //the_content(); ?>
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
					get_template_part('templates/modules/image-overlay-section'); 
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
					get_template_part('templates/modules/featured-image-section'); 
					break;
				case 'featured_video_module':
					get_template_part('templates/modules/featured-video-section'); 
					break;
				case 'news_highlight_module':
					get_template_part('templates/modules/news-item-section'); 
					break;
				case 'raw_code':
					get_template_part('templates/modules/module-raw-code');
					break;
				case 'resources_section':
					get_template_part('templates/modules/resources-section'); 
					break;
				case 'resources_section_legacy':
					get_template_part('templates/modules/resources-section-legacy'); 
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
	</div>
</div>
<?php endwhile; endif; ?>	

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

<?php get_footer(); ?>