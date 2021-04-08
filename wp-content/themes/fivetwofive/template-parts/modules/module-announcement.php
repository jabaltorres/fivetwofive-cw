<?php
/**
 * Announcement Module template part.
 *
 * @package FiveTwoFive/modules/template_parts
 */

$title                   = get_sub_field( 'title' );
$body_copy               = get_sub_field( 'announcement_body_copy' );
$sticky                  = get_sub_field( 'sticky' );
$background_image        = get_sub_field( 'background_image' );
$background_color        = get_sub_field( 'background_color' );
$border_color            = get_sub_field( 'border_color' );
$text_color              = get_sub_field( 'text_color' );
$button_background_color = get_sub_field( 'button_color' );
$button_text_color       = get_sub_field( 'button_text_color' );
$button_link             = get_sub_field( 'button_link' );
$button_text             = get_sub_field( 'button_text' );

if ( $bgimage ) {
	$bg = 'background:url(' . $bgimage['sizes']['large'] . ') center center no-repeat;background-size:cover;';
} else {
	$bg = 'background:' . $bgcolor . ';';
}

if ( $bordercolor ) {
	$border = 'border-top:2px ' . $bordercolor . ' solid;border-bottom:2px ' . $bordercolor . ' solid;';
} else {
	$border = 'none;';
}

?>
<div class="ftf-module module-announcement sticky-<?php echo $sticky; ?>" style="<?php echo $bg; echo $border; ?>">
	<div class="container">
		<div class="row">
			<?php if ( ! $button_text || ! $button_link ) : ?>
				<div class="col-12 text-center">
					<h3 class="title" style="color:<?php echo $color; ?>;"><?php echo $title; ?></h3>
					<p class="m-b-0" style="color:<?php echo $color; ?>;"><?php echo $announcement_body_copy; ?></p>
				</div>
			<?php else: ?>
				<div class="col-12 col-sm-9">
					<h3 class="title" style="color:<?php echo $color; ?>;"><?php echo $title; ?></h3>
					<p class="mb-0" style="color:<?php echo $color; ?>;"><?= $announcement_body_copy; ?></p>
				</div>
				<div class="col-12 col-sm-3 text-right">
					<a class="btn btn-primary" href="<?php echo get_sub_field('button_link'); ?>" role="button" style="background:<?php echo $buttoncolor; ?>;color:<?php echo $buttontextcolor; ?>;"><?php echo get_sub_field('button_text'); ?></a>
				</div>
			<?php endif;?>
		</div>
	</div>

	<a href="javascript:void(0);" class="close-announcement-bar"><i class="fa fa-times"></i></a>
</div>

<script type="text/javascript">	
	jQuery(document).ready(function($) {
		if( $('.module-announcement').hasClass('sticky-yes') ) {
			var height = $('.module-announcement').outerHeight(true);
			$('.module-announcement').wrap('<div class="sticky-announcement-spacer"></div>');
			$('.sticky-announcement-spacer').css({ "height" : height });
			$('body').prepend($('.sticky-announcement-spacer'));
		}
		$('.close-announcement-bar').click(function(e) {
			e.preventDefault();
			$(this).parent('.module-announcement').slideUp(400);
			if($('.sticky-announcement-spacer').length) { 
				$('.sticky-announcement-spacer').slideUp(400);
			}
		});
	});
</script>
