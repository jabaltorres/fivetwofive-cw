<?php 
	$title = get_sub_field('title');
	$subtitle = get_sub_field('sub_title');
	$caption = get_sub_field('caption');
	$background_color = get_sub_field('background_color');
	$color = get_sub_field('text_color');
	$column_count = count(get_sub_field('columns'));
	$button = get_sub_field('button');
	$button_link = get_sub_field('button_link');
?>
<div class="sst-module multi-column-module m-y-lg" style="background-color:<?php echo $background_color; ?>;">
	<div class="section_new">
		<?php if($title || $subtitle) : ?>
        <div class="container text-center m-b">
            <?php if($title) : ?><h2 style="color:<?php echo $color; ?>"><?php echo $title; ?></h2><?php endif; ?>
            <?php if($subtitle) : ?><h3 style="color:<?php echo $color; ?>"><?php echo $subtitle; ?></h3><?php endif; ?>
        </div>
		<?php endif; ?>

        <div class="container">
            <?php while(have_rows('columns')) : the_row();
                $icon = get_sub_field('icon');
                $text = get_sub_field('text');
                $title = get_sub_field('title');
                ?>
                <div class="column-module col-<?php echo $column_count; ?>">
                    <div><img src="<?php echo $icon['sizes']['thumbnail']; ?>" /></div>
                    <?php if($title) : ?>
                        <h3 style="color:<?php echo $color; ?>"><?php echo $title; ?></h3>
                        <p style="color:<?php echo $color; ?>"><?php echo $text; ?></p>
                    <?php else : ?>
                        <h4 style="color:<?php echo $color; ?>"><?php echo $text; ?></h4>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>

		<div class="clearfix"></div>
		<?php if($caption) : ?><p class="footnote" style="color:<?php echo $color; ?>"><sup>*</sup> <?php echo $caption; ?></p><?php endif; ?>

		<div class="clearfix"></div>
		<?php if($button_link) : ?>
			<div class="centered button-wrapper">
				<a class="button big-brackets" href="<?php echo $button_link; ?>" target="_blank"><?php echo $button; ?></a>
			</div>
		<?php endif; ?>
	</div>
<div class="clearfix"></div>
</div>