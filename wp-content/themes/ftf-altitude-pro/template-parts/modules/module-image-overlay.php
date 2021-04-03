<?php 
	$image = get_sub_field('image');
	$content = get_sub_field('content');
	$alignment = get_sub_field('alignment');
	$overlay_color = get_sub_field('overlay_color');

    $offset_class = '';
	if ($alignment == 'right'){
        $offset_class = 'offset-md-6';
    }
?>
<div class="ftf-module image-overlay-module py-5 <?php echo $alignment . '-align'; ?>" style="background:url('<?php echo $image['sizes']['large']; ?>') center center no-repeat;background-size:cover;">
	<div class="half-overlay" style="background-color:<?php echo $overlay_color; ?>"></div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-6 <?= $offset_class; ?>">
				<?php echo $content; ?>
			</div>
		</div>
	</div>
</div>

