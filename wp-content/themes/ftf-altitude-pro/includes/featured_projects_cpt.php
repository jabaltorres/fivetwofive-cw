<?php
    $project_client = get_field('project_client');
//    $project_url = get_field('project_url');
//    $project_button_text = get_field('project_button_text');
?>

<article class="featured-project-list-item border has-hover p-4 mb-4">
  
    <a href="<?php echo get_permalink(); ?>"><h1 class="article-title"><?php echo the_title();?></h1></a>

	<?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="fp-thumbnail">
            <img class="thumbnail border mb-2" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_post_thumbnail_caption(); ?>" />
        </a>
	<?php endif; ?>


	<?php if ($project_client) : ?>
        <div class="project-title h4">Client: <?php echo $project_client;?></div>
	<?php endif; ?>

    <div class="project-excerpt"><?php the_excerpt(); ?></div>

	<?php if ($project_url) : ?>
        <a class="project-url btn border" href="<?php echo $project_url;?>">
            <?php echo $project_button_text;?>
        </a>
	<?php endif; ?>

  <?php echo edit_post_link('(Edit)', '<span>', '</span>'); ?>
</article>