<?php 
	$hero_id = get_sub_field('module_hero_id');
	$hero_class = get_sub_field('module_hero_class');

	$title = get_sub_field('title');
	$hero_copy = get_sub_field('module_hero_copy');

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

		$hero_copy_class = 'col-md-7 order-md-1';
		$hero_video_class = '';
	endif;
	$video_thumbnail = get_sub_field('video_thumbnail'); 
	$video_caption = get_sub_field('video_caption'); 	
?>
<div id="<?= $hero_id; ?>" class="ftf-module module-hero <?php echo ($video) ? 'with-video' : 'without-video'; ?> <?= $hero_class; ?>" style="background:url('<?php echo $background_image['sizes']['large']; ?>') center center no-repeat; background-size:cover;">
	<div class="container">
        <div class="row py-5">

            <?php if ($video) : ?>
            <div class="col-12 col-md-5 order-md-2">
                <div class="img-wrap">
                    <img class="screen d-block" src="<?php echo $video_thumbnail['sizes']['medium']; ?>" />

                    <a class="video-play-button various fancybox.iframe" href="<?php echo $video; ?>">
                        <img src="<?php echo bloginfo('url'); ?>/assets/img/play_button.png" />
                    </a>
                </div>
                <?php if ($video_caption) : ?>
                    <h4 class="hero-video-caption"><?php echo $video_caption; ?></h4>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="col-12 <?= $hero_copy_class ;?>">
                <div class="copy">
                    <?php if ($title) : ?><h1 class="hero-module-title"><?php echo $title; ?></h1><?php endif; ?>
                    <?php if ($hero_copy) : ?><div class="hero-module-copy"><?php echo $hero_copy; ?></div><?php endif; ?>

                    <?php get_template_part('template-parts/modules/ftfGlobalButton'); ?>
                </div>
            </div>
        </div>
    </div>
</div>