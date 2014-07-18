<div class="fullcontent">
<div class="ltitle"> Accessories </div>




<div class="box">
<div class='tabbed_content'>
		<div class='tabs'>
						<div class='moving_bg'>		
						</div>
						<span class='tab_item'>
							About Us
						</span>
						<span class='tab_item'>
							 Twitter Feeds
						</span>
						<span class='tab_item'>
							Links
						</span>
				
					
						
		</div>
					
		<div class='slide_content'>						
				<div class='tabslider '>
				<ul>
	<div class="about">
	<?php 
	$img = get_option('lbr_img'); 
	$about = get_option('lbr_about'); 
	?>	
	<img src="<?php echo ($img); ?>"  alt="" />
	<p><?php echo ($about); ?> </p>			
	</div>
				</ul>
				
				<ul>
	<?php
$twit = get_option('lbr_twit'); 
include('twitter.php');?>
<?php if(function_exists('twitter_messages')) : ?>
       <?php twitter_messages("$twit") ?>
       <?php endif; ?>
				</ul>
				<ul>
	<?php get_links(-1, '<li>', '</li>', 'between', FALSE, 'name', FALSE, FALSE, -1, FALSE); ?>
				</ul>

				</div>
						
		</div>
	</div>


</div>

<div class="box">
	<div class='tabbed_content'>
		<div class='tabs'>
						<div class='moving_bg'>		
						</div>
							<span class='tab_item'>
							Recent
						</span>
						<span class='tab_item'>
						 Comments
						</span>
						<span class='tab_item'>
							Popular 
						</span>
					
						
		</div>
					
		<div class='slide_content'>						
				<div class='tabslider '>
<ul>
								<?php
$myposts = get_posts('numberposts=10&offset=1');
foreach($myposts as $post) :
?>
<li><a href="<?php the_permalink(); ?>"><?php the_title();
?></a></li>
<?php endforeach; ?>
				</ul>
				<ul>
				<?php dp_recent_comments(); ?>
				</ul>
				<ul>
					<?php popular_posts(); ?>
				</ul>
				

				</div>
						
		</div>
	</div>
</div>



<div class="box">
	<div class='tabbed_content'>
		<div class='tabs'>
						<div class='moving_bg'>				</div>
						<span class='tab_item'>
						  Categories
						</span>
						<span class='tab_item'>
							Tags
						</span>
						<span class='tab_item'>
							Archives
						</span>
						
		</div>
					
		<div class='slide_content'>						
				<div class='tabslider subtab'>
		
				<ul>
					<?php wp_list_categories('orderby=name&hierarchical=0&title_li='); ?>
		</ul>
				<ul>
					<?php wp_tag_cloud('smallest=8&largest=22'); ?>
				</ul>
				<ul>
					<?php wp_get_archives('type=monthly&limit=12'); ?>
				</ul>

				</div>
						
		</div>
	</div>
</div>


<div class="clear"></div>
</div>