<?php 
	$image = get_sub_field('image');
	$content = get_sub_field('content');
	$alignment = get_sub_field('alignment');
	$overlay_color = get_sub_field('overlay_color');
?>
<div class="sst-module image-overlay-module section <?php echo $alignment . '-align'; ?>" style="background:url('<?php echo $image['sizes']['large']; ?>') center center no-repeat;background-size:cover;">
	<div class="half-overlay" style="background-color:<?php echo $overlay_color; ?>"></div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-6">
				<?php echo $content; ?>
			</div>
		</div>
	</div>
</div>