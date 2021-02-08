<?php
    $event_type = get_field('event_type');
    $event_date = get_field('event_date');
    $event_start_time = get_field('event_start_time');
    $event_description = get_field('event_description');
    $event_abstract_wysiwyg = get_field('event_abstract_wysiwyg');
    $event_registration_form_id = get_field('event_registration_form_id');
    $event_registration_form_class = "_form_" . $event_registration_form_id;

    // $today = date('F j, Y');
    // $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
    // $backgroundImg = $backgroundImg[0];
?>

<div class="header-wrap"">
    <header class="entry-header">
        <h1 class="entry-title" itemprop="headline"><?php echo the_title();?></h1>
	    <?php if ($event_type): ?>
            <div class="event-detail event-type"><strong><?php echo $event_type; ?></strong></div>
	    <?php endif; ?>

        <div class="event-detail">
            <strong><span class="event-date"><?php echo $event_date; ?></span>  @  <span class="event-start-time"><?php echo $event_start_time; ?> PT</span></strong>
        </div>
    </header>
</div>

<div class="single-event-content">
	<?php if ( has_post_thumbnail() ) : ?>
        <img class="thumbnail border m-b d-block m-x-auto img-responsive" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_post_thumbnail_caption(); ?>" />
	<?php endif; ?>

	<?php
        $event_reg_group = get_field('event_reg_group');
        if ($event_reg_group['event_reg_ext'] === 'Yes'){
            $extLink = '_blank';
        } else {
            $extLink = '_self';
        }
	?>
	<?php if ($event_reg_group['event_reg_text']): ?>
        <div class="event-registration-url has-boxshadow">
            <div class="text-wrapper">
				<?php echo $event_reg_group['event_reg_text'] ; ?>
            </div>
            <div class="button-wrapper">
                <a class="btn button" target="<?php echo $extLink; ?>" href="<?php echo $event_reg_group['event_reg_url'] ; ?>"><?php echo $event_reg_group['event_reg_button_text'] ; ?></a>
            </div>
        </div>
	<?php endif; ?>

    <div class="d-none">
	    <?php //the_tags( '<div class="tags">Tagged With: ', ', ', '</div>' ); ?>
    </div>

    <?php the_content(); ?>
</div>

<?php if ($event_registration_form_id): ?>
    <div class="ac-form-container d-none">
		<?php /* Start -  modification of Active Campaign's Simple Embed  */?>
        <div class="form <?php echo $event_registration_form_class; ?>"></div>
        <script src="https://jabaltorres.activehosted.com/f/embed.php?id=<?php echo $event_registration_form_id; ?>" type="text/javascript" charset="utf-8"></script>
		<?php /* End -  modification of Active Campaign's Simple Embed  */?>
    </div>
<?php endif; ?>

<div class="single-event-details">

	<?php
//        $terms = get_the_term_list( get_the_ID(), 'cribl-events-custom-tag', '<strong>Tags:</strong> ', ', ' );
//        if ($terms){ echo "<div class=\"event-detail terms d-none\">{$terms}</div>"; }
	?>

	<?php if ($event_abstract_wysiwyg): ?>
        <div class="event-abstract m-b"><strong>Abstract:</strong><?php echo $event_abstract_wysiwyg; ?></div>
	<?php endif; ?>



	<?php
	// Event Speaker Logic
	// check if the repeater field has rows of data
	if ( have_rows('event_speaker') ): ?>
		<div class="event-speakers-container m-b-lg">
			<h4 class="text-gray-900 m-b-sm">Speakers:</h4>
			<?php

				// loop through the rows of data
				while ( have_rows('event_speaker') ) : the_row();

				// display a sub field value
				$event_speaker_image = get_sub_field('event_speaker_image'); ?>

	            <div class="event-speaker">
	                <div class="event-speaker-img-wrapper">
						<?php  echo wp_get_attachment_image( $event_speaker_image['ID'], 'full' ); ?>
	                </div>

	                <h4 class="event-speaker-name"><?php the_sub_field('event_speaker_name'); ?></h4>
	                <div class="event-speaker-bio">
						<?php the_sub_field('event_speaker_bio');?>
	                </div>
	            </div>

			<?php endwhile; ?>
		</div><!-- end .event-speakers-container -->

	<?php else : ?>

        <div class="nothing-found">
            <h3>No Speakers for this event.</h3>
        </div>

	<?php endif; ?>

	<?php echo edit_post_link('(Edit)', '<span>', '</span>'); ?>

</div><!-- end .single-event-details -->

