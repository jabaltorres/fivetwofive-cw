<?php include 'gating_logic.php'; ?>

<article class="gated-page-content">
    <h1 class="article-title"><?php echo the_title();?></h1>

    <?php if ( $assetUngated && $gated_asset_type === "Webinar" ): ?>
        <div class="m-b vimeo-player-wrapper">
            <div style="padding:56.25% 0 0 0;position:relative;">
                <iframe src="https://player.vimeo.com/video/<?php echo $vimeo_video_id; ?>" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
            </div>
            <script src="https://player.vimeo.com/api/player.js"></script>
        </div>
	<?php endif; ?>

    <?php if ( has_post_thumbnail() && !($assetUngated && $gated_asset_type === "Webinar") ): ?>
        <?php // Thumbnail for ungated Webinar assets ?>
        <img class="thumbnail featured-img <?php echo $gated_asset_type_val;?>" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_post_thumbnail_caption(); ?>" />
    <?php endif; ?>

    <div class="page-content"><?php the_content(); ?></div>

  <?php echo edit_post_link('(Edit)', '<span>', '</span>'); ?>
</article>