<?php 
	$title = get_sub_field('title');
	$sub_title = get_sub_field('sub_title');
	$background_color = get_sub_field('background_color');
	$text_color = get_sub_field('text_color');
?>
<div class="section law-enforcement-inner law-testimonials resources-module" style="background-color:<?php echo $background_color; ?>;">
	<div class="inner-content">
		<?php if($title) : ?><h2 class="centered" style="color:<?php echo $text_color; ?>;"><?php echo $title; ?></h2><?php endif; ?>
		<?php if($sub_title) : ?><h4 class="centered" style="color:<?php echo $text_color; ?>;"><?php echo $sub_title; ?></h4><?php endif; ?>
		<div class="row-div">
			<?php while(have_rows('resources')) : the_row(); 
				$image = get_sub_field('image'); 
				$file = get_sub_field('file'); 
				$site_resource = get_sub_field('site_resource'); 
				$title = get_sub_field('title'); 
				if($file) {
					$filetype = pathinfo($file, PATHINFO_EXTENSION);
					$path = $file;
					$target = "_blank";
				}
				if($site_resource) {
					$filetype = get_post_type($site_resource);
					$path = get_permalink($site_resource);
					$target = "_self";
				}
			?>
				<div class="col-3 light video-thumb resource">
					<div class="thumb-wrap" style="background:url('<?php echo $image['sizes']['medium']; ?>') center center no-repeat; background-size:cover;">
						<span class="file-type"><?php echo $filetype; ?></span>
						<a href="<?php echo $path; ?>" target="<?php echo $target; ?>"></a>
					</div>
					<div class="text-wrap">
						<h4><a href="<?php echo $path; ?>" target="<?php echo $target; ?>"><?php echo $title; ?></a></h4>
						<a href="<?php echo $path; ?>" target="<?php echo $target; ?>" class="cta-button">Learn More</a>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
	<div class="clearfix"></div>
</div>