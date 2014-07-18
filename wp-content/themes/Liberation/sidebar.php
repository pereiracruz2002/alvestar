<div class="left">



<div class="sidebox">
	<h3 class="sidetitl"> Featured Video </h3>

<?php $vid = get_option('lbr_video'); echo stripslashes($vid); ?>

</div>

<?php include (TEMPLATEPATH . '/sponsors.php'); ?>	
<div class="sidebar">

	
	<ul>
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar("Sidebar") ) : ?>    
		<div class="sidebox">
		<li>
			<h3 class="sidetitl">Pages</h3>
			<ul>
			<?php wp_list_pages('title_li='); ?>
			</ul>
		</li>
	</div>
	
	<?php endif; ?>
	</ul>

</div>





</div>