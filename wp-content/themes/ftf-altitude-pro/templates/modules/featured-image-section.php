<?php 
	$title = get_sub_field('title');
	$subtitle = get_sub_field('subtitle');
	$image = get_sub_field('image');
	$copy = get_sub_field('copy');
	$order = get_sub_field('order');
	$background = get_sub_field('background_color'); 
?>
<div class="sst-module section content-block-section featured-image-section" style="background:<?php echo $background; ?>">
    <div class="container">
        <div class="row <?php echo $order; ?>">
            <?php if($title || $subtitle) : ?>
                <div class="col-md-12">
                    <?php if($title) : ?><h1 class="title text-center"><?php echo $title; ?></h1><?php endif; ?>
                    <?php if($subtitle) : ?><h3 class="title text-center"><?php echo $subtitle; ?></h3><?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="featured-image-section-container">
                <div class="flex-box image-box">
                    <a href="<?php echo $image['sizes']['large']; ?>" class="various fancybox"><img src="<?php echo $image['sizes']['large']; ?>" alt="" /></a>
                </div>
                <div class="flex-box copy-box">
                    <?php echo $copy; ?>
                </div>
            </div>
        </div>
    </div>
</div>