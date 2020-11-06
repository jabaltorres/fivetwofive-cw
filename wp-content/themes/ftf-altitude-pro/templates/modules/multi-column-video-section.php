<?php 
	$title = get_sub_field('title');
	$sub_title = get_sub_field('sub_title');
	$button = get_sub_field('button');
	$button_link = get_sub_field('button_link');
	$background_color = get_sub_field('background_color');
?>
<div class="sst-module multi-column-video-module" style="background-color:<?php echo $background_color; ?>;">
	<div class="container p-y-lg">
        <?php if($title || $sub_title) : ?>
        <div class="row section-heading m-b">
            <div class="col-xs-12">
                <?php if ($title) : ?><h2 class="centered"><?php echo $title; ?></h2><?php endif; ?>
                <?php if ($sub_title) : ?><h4 class="centered"><?php echo $sub_title; ?></h4><?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

		<div class="row">
			<?php while (have_rows('videos')) : the_row();
				$image = get_sub_field('thumbnail'); 
				$video = get_sub_field('video');
				if ($video) :
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
				<div class="col-xs-12 col-md-4 m-b-md">
					<div class="thumb-wrap m-b-sm">
						<a class="various fancybox.iframe" href="<?php echo $video; ?>">
                            <img border="0" src="<?php echo $image['sizes']['medium']; ?>">
                        </a>
					</div>
					<div class="text-wrap">
						<?php echo get_sub_field('content'); ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>

		<?php if ($button_link) : ?>
			<div class="text-center">
				<a class="button big-brackets text-center" href="<?php echo $button_link; ?>"><?php echo $button; ?></a>
			</div>
		<?php endif; ?>
	</div>
</div>