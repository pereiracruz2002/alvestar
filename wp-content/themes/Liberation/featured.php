<script type="text/javascript">
var $jx = jQuery.noConflict(); 
$jx(document).ready(function(){


	$jx(".vthumb").click(function(){
		$jx(this).next(".video-box").slideToggle(300);
	});
});
</script>

<div id="video-frame">



<div class="video-list">

	<?php	
	$featucat = get_option('ang_featured_category'); 
	?>
	
	<?php $my_query = new WP_Query('showposts=3&category_name=' . $featucat .'');	 ?>
	
	<?php if ($my_query->have_posts()) :?>
	
	<ul class="idTabs">
	<?php while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID; ?>	
	
	<li>
	<a class="vthumb" href="#video-<?php the_ID(); ?>">
	<?php stitch_home_image();?> </a>
	<h3> <?php the_title(); ?></h3>
<span class="fclock"> Posted on <?php the_time('F - j - Y'); ?></span> 
	</li>
	<?php endwhile; ?>
	</ul>	
	<?php endif; ?>
	
</div>


<?php if ($my_query->have_posts()) :?>


	<div class="video-box">
	<?php while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID; ?>	
	<div id="video-<?php the_ID(); ?>" class="videoid">
	
<?php $thumb = get_post_meta($post->ID, 'thumb', $single = true); ?>

<?php stitch_slider_image();?>
	<div class="vidopost">
		<?php the_excerpt(); ?> 
		</div>
		</div>
<?php endwhile; ?>
</div>
<?php endif; ?>
</div>
<div class="clear"></div>