<?php 
	$title = get_sub_field('title');
	$video = get_sub_field('video');
	$image = get_sub_field('image');
	$background = get_sub_field('background_color');
	$caption = get_sub_field('caption');
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
?>
<div class="section content-block-section featured-video-section" style="background:<?php echo $background; ?>">
	<div class="inner-content row <?php echo $order; ?>">
		<div class="col-md-8 col-md-offset-2 col-sm-12">
			<?php if($title) : ?><h2 class="title text-center"><?php echo $title; ?></h2><?php endif; ?>			
			<div class="light video-thumb">
				<div class="thumb-wrap">
					<a class="various fancybox.iframe" href="<?php echo $video; ?>"><img border="0" src="<?php echo $image['sizes']['medium']; ?>"></a>
				</div>
				<div class="text-wrap">
					<?php echo get_sub_field('content'); ?>
				</div>
			</div>			
			<?php if($caption) : ?>
				<p class="centered"><strong><?php echo $caption; ?></strong></p>
			<?php endif; ?>
		</div>
	</div>
</div>