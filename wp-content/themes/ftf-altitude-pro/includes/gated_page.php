<article class="gated-page-content">

    <h1 class="article-title"><?php echo the_title();?></h1>

	<?php if ( has_post_thumbnail() ) : ?>
        <img class="thumbnail featured-img" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_post_thumbnail_caption(); ?>" />
	<?php endif; ?>

    <div class="page-content"><?php the_content(); ?></div>

  <?php echo edit_post_link('(Edit)', '<span>', '</span>'); ?>
</article>