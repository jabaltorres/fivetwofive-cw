<?php 
	$title = get_sub_field('title');
	$product_title = get_sub_field('product_title');
	$subtitle = get_sub_field('sub_title');
	$button = get_sub_field('button');
	$button_link = get_sub_field('button_link');
	$background_image = get_sub_field('background_image'); 
	$video = get_sub_field('video'); 
	if($video) :
		preg_match('/src="([^"]+)"/', $video, $match);
		$video = $match[1];
		$video = remove_query_arg('feature',$video); 
		$params = array(
			'autoplay'    => 1,
			'rel'        => 0
		);
		$video = add_query_arg($params, $video);
	endif; 
	$video_thumbnail = get_sub_field('video_thumbnail'); 
	$video_caption = get_sub_field('video_caption'); 	
?>
<div class="ftf-module module-hero hero-section <?php echo ($video) ? 'with-video' : 'without-video'; ?>" style="background:url('<?php echo $background_image['sizes']['large']; ?>') center center no-repeat; background-size:cover;">
	<div class="container">
        <div class="hero-module-inner-wrapper p-y-lg p-x m-x-auto">
            <div class="copy">
                <?php if ($product_title) : ?><h5 class="hero-label product-name"><?php echo $product_title; ?></h5><?php endif; ?>
                <?php if ($title) : ?><h1 class="hero-module-title"><?php echo $title; ?></h1><?php endif; ?>
                <?php if ($subtitle) : ?><h3 class="hero-module-subtitle"><?php echo $subtitle; ?></h3><?php endif; ?>
                <?php if ($button_link) : ?>
                    <a class="button btn btn-primary" href="<?php echo $button_link; ?>"><?php echo $button; ?></a>
                <?php endif; ?>
            </div>

            <?php if ($video) : ?>
                <div class="img-wrap">
                    <img class="screen d-block" src="<?php echo $video_thumbnail['sizes']['medium']; ?>" />

                    <a class="video-play-button various fancybox.iframe" href="<?php echo $video; ?>">
                        <img src="<?php echo bloginfo('url'); ?>/assets/img/play_button.png" />
                    </a>

                    <?php if($video_caption) : ?>
                        <h4><?php echo $video_caption; ?></h4>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>