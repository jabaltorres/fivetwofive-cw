<?php 
	$title = get_sub_field('title');
	$subtitle = get_sub_field('subtitle');
	$background_color = get_sub_field('background_color');
	$color = get_sub_field('text_color');
	$column_count = count(get_sub_field('news_items'));
?>
<div class="homepage-module module-container multi-column-module news-item-module section-news-home" style="background-color:<?php echo $background_color; ?>;">
	<div class="container">
		<?php if ($title || $subtitle) : ?>
			<div class="row">
                <div class="col-xs-12 m-b">
                    <?php if ($title) : ?><h3 class="section-heading h3 text-red text-uppercase p-t-0 m-t-0"><?php echo $title; ?></h3><?php endif; ?>
                    <?php if ($subtitle) : ?><p class="section-subheading h2 font-weight-bold p-t-0" style="color:<?php echo $color; ?>"><?php echo $subtitle; ?></p><?php endif; ?>
                </div>
			</div>
		<?php endif; ?>

		<div class="row news-spotlight">
            <div class="col-xs-12">
                <?php while(have_rows('news_items')) : the_row();
                    $thumbnail = get_sub_field('thumbnail');
                    $title = get_sub_field('title');
                    $link = get_sub_field('link');
                    $link_text = get_sub_field('link_text');
                    ?>
                    <div class="shotspotter_works col-xs-12 col-md-4" style="background: url('<?php echo $thumbnail['sizes']['medium']; ?>') no-repeat center center transparent; background-size:cover;">
                        <div class="inner-wrapper">
                            <h4><a href="<?php echo $link; ?>" target="_blank" title="<?php echo $title; ?>"><?php echo $title; ?></a></h4>
                            <div><a href="<?php echo $link; ?>" target="_blank" class="btn btn-primary" title="<?php echo $title; ?>"><?php echo $link_text; ?></a></div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
		</div>
	</div>
</div>