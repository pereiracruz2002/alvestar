<?php get_header(); ?>
<div id="featured">
<?php featured_section(); ?>
</div>
<div class="clear"></div>
<div class="fullcontent">
<div class="ltitle">Latest Posts</div>
 <?php latest_stories(); ?>
</div>

<div class="fullcontent">


<?php $featcat1 = get_option('lbr_featcat1');?>
<div class="ltitle"><?php echo($featcat1);?> </div>
<?php query_posts('category_name=' . $featcat1 .'&posts_per_page=3'); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="box" id="post-<?php the_ID(); ?>">
<div class="cover">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<div class="sentry">
<?php liber_box_image();?>
<?php the_excerpt(); ?> 
<div class="clear"></div>
</div>
</div>

</div>

<?php endwhile; ?>
<?php wp_reset_query();?>
<div class="clear"></div>
<?php endif; ?>

</div>

<div class="fullcontent">

<?php $featcat2 = get_option('lbr_featcat2');?>
<div class="ltitle"><?php echo($featcat2);?> </div>
<?php query_posts('category_name=' . $featcat2 .'&posts_per_page=3'); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="box" id="post-<?php the_ID(); ?>">
<div class="cover">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<div class="sentry">
<?php liber_box_image();?>
<?php the_excerpt(); ?> 
<div class="clear"></div>
</div>
</div>

</div>

<?php endwhile; ?>
<?php wp_reset_query();?>
<div class="clear"></div>
<?php endif; ?>

</div>

<div class="fullcontent">

<?php $featcat3 = get_option('lbr_featcat3');?>
<div class="ltitle"><?php echo($featcat3);?> </div>
<?php query_posts('category_name=' . $featcat3 .'&posts_per_page=3'); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="box" id="post-<?php the_ID(); ?>">
<div class="cover">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<div class="sentry">
<?php liber_box_image();?>
<?php the_excerpt(); ?> 
<div class="clear"></div>
</div>
</div>

</div>

<?php endwhile; ?>
<?php wp_reset_query();?>
<div class="clear"></div>
<?php endif; ?>

</div>



<?php get_footer(); ?>
