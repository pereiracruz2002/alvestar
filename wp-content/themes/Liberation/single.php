<?php get_header(); ?>

<div id="content">


<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">
<div class="title">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
</div>
<div class="postmeta"><span class="author"> Posted by <?php the_author(); ?></span> <span class="clock"> On <?php the_time('F - j - Y'); ?></span> <span class="comm"><?php comments_popup_link('ADD COMMENTS', '1 COMMENT', '% COMMENTS'); ?></span>	</div>	

<div class="cover">
<?php include (TEMPLATEPATH . '/ad.php'); ?>	
<?php the_content('Read the rest of this entry &raquo;'); ?>

<div class="clear"></div>
 <?php wp_link_pages(array('before' => '<p><strong>Pages: </strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
</div>

<div class="postinfo">
<?php the_category(' '); ?> 
</div>


</div>
<div class="clear"> </div>
<?php comments_template(); ?>

	<?php endwhile; else: ?>

	<div class="title"><h2>Oops.. Nothing Found !</h2></div>
	<div class="cover">	<p>I think what you are looking for is not here or it has been moved. Please try a different search..</p> </div>

<?php endif; ?>

 
 
</div>

<?php get_sidebar(); ?>


<?php get_footer(); ?>
