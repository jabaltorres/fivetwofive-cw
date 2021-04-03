<?php 
	$title = get_sub_field('title');
	$subtitle = get_sub_field('subtitle');
	$image = get_sub_field('image');
	$copy = get_sub_field('copy');
	$order = get_sub_field('order');
	$background = get_sub_field('background_color');
?>
<div class="ftf-module featured-image-section" style="background:<?php echo $background; ?>">
    <div class="container">
        <div class="row <?php echo $order; ?>">

            <?php if ($title || $subtitle) : ?>
                <div class="col-12">
                    <?php if ($title) : ?><h3 class="h1 text-center"><?php echo $title; ?></h3><?php endif; ?>
                    <?php if ($subtitle) : ?><h4 class="h2 text-center"><?php echo $subtitle; ?></h4><?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="featured-image-section-container">
                <div class="flex-box image-box">
                    <a href="<?php echo $image['sizes']['large']; ?>" class="various fancybox">
                        <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
                    </a>
                </div>
                <div class="flex-box copy-box">
                    <?php echo $copy; ?>

                    <?php get_template_part('template-parts/modules/ftfGlobalButton'); ?>
                </div>
            </div>
        </div>
    </div>
</div>