<?php
/*
Template Name: Fullwide
*/
?>
<?php get_header(); ?>

<div id="fullcontent">


<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

<div class="widepost" id="post-<?php the_ID(); ?>">
<div class="title">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
</div>

<div class="cover">

<?php the_content('Read the rest of this entry &raquo;'); ?>

<div class="clear"></div>
 <?php wp_link_pages(array('before' => '<p><strong>Pages: </strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
</div>


</div>
<div class="clear"> </div>
<?php //comments_template(); ?>  <!--Comment template is disabled -->

	<?php endwhile; else: ?>

	<div class="title"><h2>Oops.. Nothing Found !</h2></div>
	<div class="cover">	<p>I think what you are looking for is not here or it has been moved. Please try a different search..</p> </div>

<?php endif; ?>

 
 
</div>




<?php get_footer(); ?>
