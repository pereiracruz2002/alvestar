<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Codex Coder
 */
?>

<section id="scroller">
	<div class="container-full">

		<div class="gototop"></div>

		<div class="gotobottom">
			<div class="goup">
				<div class="gotoup">
					<a class="header" href="#header"><i class="fa fa-arrow-circle-up"></i></a>
				</div> <!-- /.gotoup -->
			</div> <!-- /.goup -->
		</div> <!-- /.gotobottom -->
	</div> <!-- /.container-full -->
</section> <!--   /#scroller  -->

<section id="scroller2">
	<div class="gotop">
		<a class="header" href="#header"><i class="fa fa-arrow-circle-o-up"></i></a>
	</div> <!-- /.gotop -->
</section> <!--   /#scroller2  -->


<section id="footer">
	<footer class="container-full">
		<div class="container">

			<?php

			if(!function_exists('dynamic_sidebar')
				|| !dynamic_sidebar('footer1')) :
				endif;

			if(!function_exists('dynamic_sidebar')
				|| !dynamic_sidebar('Footer-2')) :
				endif;

			if(!function_exists('dynamic_sidebar')
				|| !dynamic_sidebar('Footer-3')) :
				endif;

			if(!function_exists('dynamic_sidebar')
				|| !dynamic_sidebar('Footer-4')) :
				endif;

				?>
			</div> <!-- /.container -->

			<div class="clear-bottom copyright">
				<?php do_action( 'codex_coder_credits' ); ?>
				<p>
					<?php printf( __( 'Theme: %1$s by %2$s.', 'codex-coder' ), 'Limo WP', '<a href="http://www.codexcoder.com" rel="designer">CodexCoder.com</a>' ); ?>
				</p>
			</div> <!-- /.clear-bottom /.copyright -->

		</footer> <!-- /.container-full -->
	</section> <!-- /.footer -->

	
	<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.mixitup.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.fancybox.js"></script>
	<!-- Include gmaps.js for Google Map -->
	<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/gmaps.js"></script>
	<!-- Include custom js file -->
	<script src="<?php bloginfo('template_url'); ?>/js/custom.js"></script>
	<script type="text/javascript">
		var map;
		$(document).ready(function(){
			map = new GMaps({
				div: '#map',
				lat: <?php $lati = (codex_option('cc_lati')) ? codex_option('cc_lati') : 23.7322302 ; echo $lati; ?>,
				lng: <?php $longi = (codex_option('cc_longi')) ? codex_option('cc_longi') : 90.418276 ; echo $longi; ?>,
				scrollwheel: false,
				panControl: false,
				zoomControl: false,
			});

			map.addMarker({
				lat: <?php $lati = (codex_option('cc_lati')) ? codex_option('cc_lati') : 23.7322302 ; echo $lati; ?>,
				lng: <?php $longi = (codex_option('cc_longi')) ? codex_option('cc_longi') : 90.418276 ; echo $longi; ?>,
				title: "<?php $place = (codex_option('cc_place')) ? codex_option('cc_place') : CodexCoder; echo $place; ?>",
				infoWindow: { 
					content: "<?php $place = (codex_option('cc_place')) ? codex_option('cc_place') : CodexCoder; echo $place; ?>"
				},
			});
		});
	</script>
	
	<?php wp_footer(); ?>

</body>
</html>