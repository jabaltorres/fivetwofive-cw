<?php 
	$title = get_sub_field('title');
	$content = get_sub_field('content');
	$link = get_sub_field('link');
	$link_text = get_sub_field('link_text');
	if(get_sub_field('background_image')) {		
		$image = get_sub_field('background_image'); 
		$background = "url('" . $image['sizes']['large'] . "') center center no-repeat"; 
	} else {
		$background = get_sub_field('background_color'); 
	}	
?>
<div class="sst-module section content-block-section" style="background:<?php echo $background; ?>;background-size:cover;">
	<div class="inner-content row">
		<div class="col-md-12">
			<?php if ($title): ?><h3 class="h1 title text-center m-b"><?php echo $title; ?></h3><?php endif; ?>

			<?php echo $content; ?>

			<?php if ($link): ?>
				<p class="text-center">
					<a href="<?php echo $link; ?>" class="button cta-button text-red"><?php echo $link_text; ?></a>
				</p>			
			<?php endif; ?>
		</div>
	</div>
</div>