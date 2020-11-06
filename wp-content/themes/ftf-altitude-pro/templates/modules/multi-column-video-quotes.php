<?php
$module_heading = get_sub_field('module_heading');
$module_sub_heading = get_sub_field('module_sub_heading');

$testimonials = get_sub_field('video_quote');
$testimonials_count = count(get_sub_field('video_quote'));

$module_bg_color = get_sub_field('module_bg_color');

$module_cta_button = get_sub_field('module_cta_button');
?>
<div class="sst-module multi-column-video-quotes p-y-lg" style="background-color:<?php echo $module_bg_color; ?>;">
    <?php if($module_heading || $module_sub_heading) : ?>
        <div class="container text-center m-b">
            <?php if ($module_heading) : ?><h2 style="color:<?php echo $color; ?>"><?php echo $module_heading; ?></h2><?php endif; ?>
            <?php if ($module_sub_heading) : ?><h3 style="color:<?php echo $color; ?>"><?php echo $module_sub_heading; ?></h3><?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($testimonials): ?>
    <div class="container">
        <div class="row">
            <?php
            if ($testimonials) {
                foreach ($testimonials as $testimonial) {
                    echo '<div class="col-md-4 light video-thumb">
                        <a class="various fancybox.iframe" href="'.$testimonial['url'].'">
                            <img class="img-responsive m-b-sm" border="0" src="'.$testimonial['thumbnail'].'">
                        </a>
                       
                        <div class="text-wrap">
                            <h4 class="italic m-b-sm">'.$testimonial['quote'].'</h4>
                            <div class="name">'.$testimonial['name'].'</div>
                            <div class="title">'.$testimonial['title'].'</div>
                        </div>
                    </div>';
                }
            }
            ?>
        </div>

        <?php if ($module_cta_button['module_cta_button_url'] && $module_cta_button['module_cta_button_text']): ?>
        <div class="row">
            <div class="col-sm-12">
                <p class="text-center m-t m-b-0"><a class="button cta-button text-red" href="<?php echo $module_cta_button['module_cta_button_url'];?>"><?php echo $module_cta_button['module_cta_button_text'];?></a></p>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>