<?php 
	$title = get_sub_field('title');
	$sub_title = get_sub_field('sub_title');
	$background_color = get_sub_field('background_color');
	$text_color = get_sub_field('text_color');
	$images = get_sub_field('images');
	$layout = get_sub_field('layout');
	$carousel = get_sub_field('carousel');
	$id = rand(0,100);
?>
<div class="ftf-module module-image-mosaic py-5" style="background-color:<?php echo $background_color; ?>;">
    <?php if ($title || $sub_title) : ?>
        <div class="container text-center">
            <div class="row">
                <div class="col-12">
                    <?php if ($title) : ?><h2 style="color:<?php echo $text_color; ?>;"><?php echo $title; ?></h2><?php endif; ?>
                    <?php if ($sub_title) : ?><h4 style="color:<?php echo $text_color; ?>;"><?php echo $sub_title; ?></h4><?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

	<?php if ($carousel == 'yes') { ?>
		<div class="carousel-gallery" id="carousel-<?php echo $id; ?>">
			<?php foreach ($images as $image) : ?>
				<a href="<?php echo $image['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>"><img src="<?php echo $image['sizes']['medium']; ?>" alt="" /></a>
			<?php endforeach; ?>
		</div>	
	<?php } elseif ($carousel == 'no' && $layout == 'even') { ?>
		<div class="mosaic-gallery <?php echo $layout; ?>">
			<?php foreach ($images as $image) : ?>
				<a href="<?php echo $image['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $image['sizes']['medium']; ?>');"></a>
			<?php endforeach; ?>
		</div>
	<?php } elseif ($carousel == 'no' && $layout == 'mosaic1') { ?>
		<div class="mosaic-gallery <?php echo $layout; ?>">
			<div class="column-1">
				<a href="<?php echo $images[0]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[0]['sizes']['medium']; ?>');"></a>
				<a href="<?php echo $images[1]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[1]['sizes']['medium']; ?>');"></a>
				<a href="<?php echo $images[2]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[2]['sizes']['medium']; ?>');"></a>
			</div>
			<div class="column-2">
				<a href="<?php echo $images[3]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[3]['sizes']['medium']; ?>');"></a>
			</div>
			<div class="column-3">
				<a href="<?php echo $images[4]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[4]['sizes']['medium']; ?>');"></a>
				<a href="<?php echo $images[5]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[5]['sizes']['medium']; ?>');"></a>
			</div>
		</div>
	<?php } elseif ($carousel == 'no' && $layout == 'mosaic2') { ?>
		<div class="mosaic-gallery <?php echo $layout; ?>">
			<div class="column-1">
				<a href="<?php echo $images[0]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[0]['sizes']['medium']; ?>');"></a>
				<a href="<?php echo $images[1]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[1]['sizes']['medium']; ?>');"></a>
			</div>
			<div class="column-2">
				<a href="<?php echo $images[2]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[2]['sizes']['medium']; ?>');"></a>
				<a href="<?php echo $images[3]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[3]['sizes']['medium']; ?>');"></a>
			</div>
			<div class="column-3">
				<a href="<?php echo $images[4]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[4]['sizes']['medium']; ?>');"></a>
				<a href="<?php echo $images[5]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[5]['sizes']['medium']; ?>');"></a>
			</div>
			<div class="column-4">
				<a href="<?php echo $images[6]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[6]['sizes']['medium']; ?>');"></a>
				<a href="<?php echo $images[7]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[7]['sizes']['medium']; ?>');"></a>
			</div>
		</div>
	<?php } elseif ($carousel == 'no' && $layout == 'mosaic3') { ?>
		<div class="mosaic-gallery <?php echo $layout; ?>">
			<div class="column-1">
				<a href="<?php echo $images[0]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[0]['sizes']['medium']; ?>');"></a>
				<a href="<?php echo $images[1]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[1]['sizes']['medium']; ?>');"></a>
			</div>
			<div class="column-2">
				<a href="<?php echo $images[2]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[2]['sizes']['medium']; ?>');"></a>
				<a href="<?php echo $images[3]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[3]['sizes']['medium']; ?>');"></a>
			</div>
			<div class="column-3">
				<a href="<?php echo $images[4]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[4]['sizes']['medium']; ?>');"></a>
				<a href="<?php echo $images[5]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[5]['sizes']['medium']; ?>');"></a>
				<a href="<?php echo $images[6]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[6]['sizes']['medium']; ?>');"></a>
			</div>
			<div class="column-4">				
				<a href="<?php echo $images[7]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[7]['sizes']['medium']; ?>');"></a>
				<a href="<?php echo $images[8]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[8]['sizes']['medium']; ?>');"></a>
				<a href="<?php echo $images[9]['url']; ?>" class="various" rel="mosaic-gallery-<?php echo $id; ?>" style="background-image:url('<?php echo $images[9]['sizes']['medium']; ?>');"></a>
			</div>
		</div>
	<?php } ?>
</div>

<?php if ($carousel == 'yes') { ?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			if($('#carousel-<?php echo $id; ?>').length) {
				$('#carousel-<?php echo $id; ?>').slick({
					dots: false,
					arrows: true,
					infinite: true,
					speed: 300,
					slidesToShow: 1,
					centerMode: true,
					variableWidth: true
				});
			}
		});
	</script>
<?php } ?>
