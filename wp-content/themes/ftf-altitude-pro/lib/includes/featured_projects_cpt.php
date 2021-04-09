<?php
    $project_client = get_field('project_client');
    $project_url = get_field('project_url');
    $project_button_text = get_field('project_button_text');
//    $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

    $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
?>

<div class="featured-project-list-item mb-4 col-12 col-md-4">
    <div class="border p-4 has-hover project-card" style="background-image: url('<?php echo $backgroundImg[0]; ?>');">
	    <a href="<?php echo get_permalink(); ?>" class="article-title-wrapper">
            <h3 class="article-title text-center"><?php echo the_title();?></h3>
        </a>

        <a class="project-url btn border" href="<?php echo get_permalink(); ?>">
            <?php echo $project_button_text;?>
        </a>
    </div>

  <?php echo edit_post_link('(Edit)', '<span>', '</span>'); ?>
</div>