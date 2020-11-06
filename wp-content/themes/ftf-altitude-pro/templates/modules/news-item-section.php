<?php 
	$title = get_sub_field('title');
	$subtitle = get_sub_field('subtitle');
	$background_color = get_sub_field('background_color');
	$color = get_sub_field('text_color');
	$column_count = count(get_sub_field('news_items'));
?>
<div class="module-container multi-column-module news-item-module section-news-home" style="background-color:<?php echo $background_color; ?>;">
	<div class="section_new">
		<?php if($title || $subtitle) : ?>
			<div class="text">
				<?php if($title) : ?><h2 style="color:<?php echo $color; ?>"><?php echo $title; ?></h2><?php endif; ?>
				<?php if($subtitle) : ?><h3 style="color:<?php echo $color; ?>"><?php echo $subtitle; ?></h3><?php endif; ?>
			</div>
		<?php endif; ?>
		<div class="clearfix"></div>
		<div class="news-spotlight">
			<?php while(have_rows('news_items')) : the_row(); 
				$thumbnail = get_sub_field('thumbnail'); 
				$title = get_sub_field('title'); 
				$link = get_sub_field('link'); 
				$link_text = get_sub_field('link_text'); 
			?>			
				<div class="shotspotter_works" style="background: url('<?php echo $thumbnail['sizes']['medium']; ?>') no-repeat center center transparent; background-size:cover;">
					<h4><a href="<?php echo $link; ?>" target="_blank" title="<?php echo $title; ?>"><?php echo $title; ?></a></h4>
					<div><a href="<?php echo $link; ?>" target="_blank" class="button small-brackets-button" title="<?php echo $title; ?>"><?php echo $link_text; ?></a></div>
				</div>			
			<?php endwhile; ?>
		</div>
		<div class="clearfix"></div>
	</div>
<div class="clearfix"></div>
</div>