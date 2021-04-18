<?php 
	$title = get_sub_field('title');
	$show_hide = get_sub_field('show_thumbnails');
	$navid = rand(100,200);
	$forid = rand(200,300);
?>

<div class="ftf-module module-carousel text-center py-5">
	<div class="container">
		<?php if ($title) : ?>
            <div class="row">
                <div class="col-12 mb-4">
                    <h3 class="module-heading h2"><?php echo $title; ?></h3>
                </div>
            </div>
		<?php endif; ?>

		<?php if (have_rows('slides')) : ?>
            <div class="row">
                <div class="col-12">
                    <div class="carousel-testimonials">
                        <div class="slider-for <?php if($show_hide == 'hide') echo 'single-slider'; ?>" id="carousel-<?php echo $forid; ?>">
                            <?php while(have_rows('slides')) : the_row();
                                $image = get_sub_field('image');
                                $button = get_sub_field('button');
                                $button_link = get_sub_field('button_link');
                                $text = get_sub_field('text');
                                $cite = get_sub_field('cite');
                                $image_alt_text = get_sub_field('image_alt_text');
                                ?>
                                <div class="testimonial">
                                    <div class="testimonial-wrap row">
                                        <div class="col-12 col-sm-4">
                                            <img class="testimonial-img rounded-circle p-5" src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image_alt_text; ?>" />
                                        </div>
                                        <div class="col-12 col-sm-8">
                                            <?php if ($cite) : ?>
                                                <span class="quote">
                                                    <span class="visible-mobile-inline">"</span>
                                                        <?php echo $text; ?>
                                                    <span class="visible-mobile-inline">"</span>
                                                </span>
                                                <div class="text-dark d-block my-3"><?php echo $cite; ?></div>
                                            <?php else : ?>
                                                <span class="quote no-quotes">
                                                    <?php echo $text; ?>
                                                </span>
                                            <?php endif; ?>

                                            <?php if ($button_link) : ?>
                                                <a href="<?php echo $button_link; ?>" class="btn btn-primary"><?php echo $button; ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>

                        <?php if ($show_hide == 'show') : ?>
                        <div class="slider-nav multiple-nav"  id="carousel-<?php echo $navid; ?>">
                            <?php while(have_rows('slides')) : the_row();
                                $image = get_sub_field('image');
                                $image_alt_text = get_sub_field('image_alt_text');
                                ?>
                                <div class="thumb">
                                    <img class="testimonial-thumb p-2" src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image_alt_text; ?>" />
                                    <div class="location"><?php echo $image_alt_text; ?></div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

		<?php endif; ?>
	</div>
</div>
<script type="text/javascript">	
	jQuery(document).ready(function($) {
	
		if ($('#carousel-<?php echo $navid; ?>').length) {
			$('#carousel-<?php echo $forid; ?>').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: true,
				fade: true,
				adaptiveHeight: true,
				asNavFor: '#carousel-<?php echo $navid; ?>'
			});
			$('#carousel-<?php echo $navid; ?>').slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				asNavFor: '#carousel-<?php echo $forid; ?>',
				arrows: true,
				dots: false,
				focusOnSelect: true,
				responsive: [
					{
						breakpoint: 991,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: true
						}
					},
					{
						breakpoint: 767,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1
						}
					}
				]
			});
		} else {
			$('#carousel-<?php echo $forid; ?>').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: true,
				fade: true,
				adaptiveHeight: true
			});
		}
	});
</script>