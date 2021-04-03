<?php 
	/* Template Name: Modules Template */
?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div id="content" class="homepage">
	<div id="main-wrap" role="main">
		<?php //the_content(); ?>
        <?php get_template_part('template-parts/modules');?>
	</div>
</div>
<?php endwhile; endif; ?>	

<?php get_footer(); ?>