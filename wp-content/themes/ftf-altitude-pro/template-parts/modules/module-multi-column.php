<?php 
	$title = get_sub_field('title');
	$subtitle = get_sub_field('sub_title');
	$caption = get_sub_field('caption');
	$background_color = get_sub_field('background_color');
	$color = get_sub_field('text_color');
	$column_classes = get_sub_field('column_classes');
	$column_count = count(get_sub_field('columns'));

    switch ($column_count) {
        case '1':
            $bootstrap_col_class_val = '12';
            break;
        case '2':
            $bootstrap_col_class_val = '6';
            break;
        case '3':
            $bootstrap_col_class_val = '4';
            break;
        case '4':
            $bootstrap_col_class_val = '3';
            break;
        default:
            $bootstrap_col_class_val = '0';
    }

	$button = get_sub_field('button');
	$button_link = get_sub_field('button_link');
?>
<div class="ftf-module multi-column-module py-5" style="background-color:<?php echo $background_color; ?>;">
    <?php if ($title || $subtitle) : ?>
    <div class="container text-center mb-4">
        <div class="row">
            <div class="col-12">
                <?php if ($title) : ?><h2 style="color:<?php echo $color; ?>"><?php echo $title; ?></h2><?php endif; ?>
                <?php if ($subtitle) : ?><h3 style="color:<?php echo $color; ?>"><?php echo $subtitle; ?></h3><?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="container">
        <div class="row">
            <?php while (have_rows('columns')) : the_row();
                $image = get_sub_field('image');
                $text = get_sub_field('text');
                $title = get_sub_field('title');
                ?>
                <div class="col-12 mb-2 col-md-<?= $bootstrap_col_class_val; ?>">
                    <div class="<?= $column_classes ;?>">
                        <?php if ($image) : ?>
                            <div class="module-multi-col-img-wrapper mb-3">
                                <img src="<?php echo $image['sizes']['thumbnail']; ?>" />
                            </div>
                        <?php endif; ?>

                        <?php if ($title) : ?>
                            <h3 style="color:<?php echo $color; ?>"><?php echo $title; ?></h3>
                            <p style="color:<?php echo $color; ?>"><?php echo $text; ?></p>
                        <?php else : ?>
                            <div style="color:<?php echo $color; ?>"><?php echo $text; ?></div>
                        <?php endif; ?>

                        <?php get_template_part('template-parts/modules/ftfGlobalButton'); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php if ($caption) : ?>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <p class="footnote mt-3" style="color:<?php echo $color; ?>"><sup>*</sup> <?php echo $caption; ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($button_link) : ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center button-wrapper">
                    <a class="btn btn-primary" href="<?php echo $button_link; ?>" target="_blank"><?php echo $button; ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>