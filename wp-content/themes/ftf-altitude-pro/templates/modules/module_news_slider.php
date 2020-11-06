<?php
    $news_slider_module_heading = get_sub_field('news_slider_module_heading');
    $news_slider_module_subheading = get_sub_field('news_slider_module_subheading');
?>

<div class="sst-module module-news-slider p-y-lg" style="background:#eee;">
    <div class="container">
        <div class="row">
            <div class="inner-content">
                <div class="col-xs-12">
                    <?php if ($news_slider_module_heading) :?>
                        <h3 class="news-slider-module-heading h2 text-center m-t-0 m-b-sm"><?= $news_slider_module_heading; ?></h3>
                    <?php endif; ?>

                    <?php if ($news_slider_module_subheading) :?>
                        <h4 class="news-slider-module-heading h3 text-center m-t-0 m-b-sm"><?= $news_slider_module_subheading; ?></h4>
                    <?php endif; ?>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="slider-holder">
                <?php while ( have_rows('news_slider_items') ) : the_row();
                    $news_item_title = get_sub_field('news_item_title');
                    $news_item_sub_title = get_sub_field('news_item_sub_title');
                    $news_item_copy = get_sub_field('news_item_copy');
                    $news_item_cta = get_sub_field('news_item_cta');
                    $news_item_cta_text = $news_item_cta['news_item_cta_text'];
                    $news_item_cta_url = $news_item_cta['news_item_cta_url'];
                ?>
                    <div class="slider-item">
                        <?php if ($news_item_sub_title) : ?>
                            <h4 class="text-gray-dark h3 font-weight-lighter"><?php echo $news_item_sub_title; ?></h4>
                        <?php endif; ?>

                        <?php if ($news_item_title) : ?>
                            <h3 class="h2"><a href="<?= $news_item_cta['news_item_cta_url']; ?>" target="_blank" title="<?= $news_item_title; ?>"><?= $news_item_title; ?></a></h3>
                        <?php endif; ?>

                        <?php if ($news_item_copy) : ?>
                            <div class="news-item-copy m-b-sm"><?= $news_item_copy; ?></div>
                        <?php endif; ?>

                        <?php if ($news_item_cta_text && $news_item_cta_url) : ?>
                            <a class="font-weight-bold text-uppercase" href="<?= $news_item_cta_url; ?>" target="_blank"><?= $news_item_cta_text; ?></a>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    jQuery(document).ready(function($) {
        if ( $('.slider-holder').length ) {
            $('.slider-holder').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                fade: true,
                adaptiveHeight: false,
                autoplay: false,
                autoplaySpeed: 3000
            });
        }
    });
</script>

