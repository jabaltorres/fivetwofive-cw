<?php
    $event_type = get_field('event_type');
    $event_date = get_field('event_date');
    $event_start_time = get_field('event_start_time');
    $event_description = get_field('event_description');
?>

<article class="cribl-event-single">
    <a href="<?php echo get_permalink(); ?>">
        <h3 class="article-title m-b-sm"><?php echo the_title();?></h3>
    </a>

    <div class="d-block m-b-sm">
        <strong><?php echo $event_type; ?></strong>  |  <strong><?php echo $event_date; ?></strong>  |  <strong><?php echo $event_start_time; ?> PT</strong>
    </div>

	<?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="thumbnail m-b d-none">
            <img class="thumbnail border mb-2" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_post_thumbnail_caption(); ?>" />
        </a>
	<?php endif; ?>

	<?php if ($event_description): ?>
        <div class="event-detail event-description"><?php echo $event_description; ?></div>
	<?php endif; ?>

    <div class="event-learn-more">
        <strong><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="">Learn More <i class="fas fa-chevron-right"></i></a></strong>
    </div>
</article>