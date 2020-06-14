<?php
/*
Taxonomy index template
*/
get_header(); ?>

	<div id="container">
		<div id="content" role="main">

			<h1 class="entry-title">
				<?php
					$current_term = get_queried_object();
					$taxonomy = get_taxonomy($current_term->taxonomy);
					echo $taxonomy->label . ': ' . $current_term->name;
				?>
			</h1>

			<?php while( have_posts() ) : the_post(); ?>
				<?php get_template_part( '/includes/featured_projects_cpt' ); ?>
			<?php endwhile; ?>


			<?php get_search_form(); ?>

			<h2>Archives by Month:</h2>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>

			<h2>Archives by Subject:</h2>
			<ul>
				<?php wp_list_categories(); ?>
			</ul>

		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>