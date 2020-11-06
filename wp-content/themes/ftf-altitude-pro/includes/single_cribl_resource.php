<?php include 'resource_gating_logic.php'; ?>

<?php
//    $resource_type = get_field('resource_type');
//    $active_campaign_form_id = get_field('active_campaign_form_id');
//    $active_campaign_form_class = "_form_" . $active_campaign_form_id;
//
//    $today = date('F j, Y');
//    $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
//    $backgroundImg = $backgroundImg[0];
?>

<div class="header-wrap">
    <header class="entry-header">
	    <?php if ( $resource_type ) : ?>
	        <div class="text-center d-block"><?php echo $resource_type; ?></div>
	    <?php endif; ?>
        <h1 class="entry-title text-center" itemprop="headline"><?php echo the_title();?></h1>
    </header>
</div>

<div class="content-container m-b-lg">
    <div class="single-resource-content">

	    <?php if ( ($assetUngated) && (($resource_type === "Pre-Recorded Webinar") || ($resource_type === "Demo"))): ?>
            <div class="m-b vimeo-player-wrapper">
                <div style="padding:56.25% 0 0 0;position:relative;">
                    <iframe src="https://player.vimeo.com/video/<?php echo $vimeo_video_id; ?>" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                </div>
                <script src="https://player.vimeo.com/api/player.js"></script>
            </div>
	    <?php endif; ?>

        <?php
            if ( has_post_thumbnail() ) {
	            if ( !(($assetUngated) && (($resource_type === "Pre-Recorded Webinar") || ($resource_type === "Demo")))) { ?>
                    <img class="thumbnail border m-b d-block m-x-auto img-responsive <?php echo $resource_type_val; ?>" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_post_thumbnail_caption(); ?>"/>
	            <?php }
            }
        ?>

        <?php the_content(); ?>

	    <?php if ($share_this_post === "Yes") { include( 'cribl_share_this_post.php' ); } ?>

    </div>

    <div style="clear: both;"></div>

</div>

<?php echo edit_post_link('(Edit)', '<span>', '</span>'); ?>