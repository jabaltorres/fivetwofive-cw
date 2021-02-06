<?php
    $cta_show_logo = get_sub_field('cta_show_logo');
    $cta_bg_color = get_sub_field('cta_bg_color');
    $cta_bg_img = get_sub_field('cta_bg_img');

    $cta_heading = get_sub_field('cta_heading');
    $cta_subheading = get_sub_field('cta_subheading');
    $cta_body_copy = get_sub_field('cta_body_copy');
    $cta_button_text = get_sub_field('cta_button_text');
    $cta_button_link = get_sub_field('cta_button_link');

    if ($cta_bg_img) {
        $image = $cta_bg_img;
        $background = "url('" . $image['sizes']['large'] . "') center center no-repeat";
    } else {
        $background = $cta_bg_color;
    }
?>
<div class="sst-module cta-module-section" style="background:<?php echo $background; ?>;background-size:cover;">
    <div class="container p-y-lg">
        <div class="row">
            <div class="col-xs-12 col-md-10 offset-md-1">
                <?php if ($cta_show_logo): ?>
                    <img class="cta-img-logo d-block m-x-auto m-b-md" src="/wp-content/uploads/2019/09/shotspotter_logo.png" alt="ShotSpotter Logo" width="80" height="80" />
                <?php endif;?>

                <?php if ($cta_heading): ?>
                    <h3 class="cta-heading h1 text-center m-b-sm"><?php echo $cta_heading; ?></h3>
                <?php endif; ?>

                <?php if ($cta_subheading): ?>
                    <h4 class="cta-subheading h3 text-center m-b-sm"><?php echo $cta_subheading; ?></h4>
                <?php endif; ?>

                <?php if ($cta_body_copy): ?>
                    <p class="cta-body-copy text-center"><?php echo $cta_body_copy; ?></p>
                <?php endif; ?>

                <?php if ($cta_button_link): ?>
                    <p class="text-center m-b-0">
                        <a href="<?php echo $cta_button_link; ?>" class="button cta-button text-red"><?php echo $cta_button_text; ?></a>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>