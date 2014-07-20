<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Codex Coder
 */

get_header(); ?>

	<div class="container">
		<main id="main" class="col-xs-12 col-sm-8" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	<?php get_sidebar(); ?>

</div><!-- /.container -->
<?php get_footer(); ?>
