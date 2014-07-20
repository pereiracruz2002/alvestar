	<?php if(codex_option('cc_slider') == 1) { ?>
	<section id="slider">
		<div class="container-full">
			<div class="slider">			
				<div id="main-slider" class="carousel slide">
					<?php 
					$args = array( 'post_type'=>'slider', 'orderby' => 'menu_order','order' => 'ASC');
					$sliders = get_posts( $args );
					$cc_slider_num = codex_option('cc_slider_num');
					$cc_slider_order = codex_option('cc_slider_order');
					?>

					<ol class="carousel-indicators">
						<?php for($i = 0; $i<$cc_slider_num; $i++){ ?>
						<li data-target="#main-slider" data-slide-to="<?php echo $i ?>" class="<?php echo ($i==0)?'active':'';?>"></li>
						<?php } ?>
					</ol> <!-- /.carousel-indicators -->

					<!-- Carousel items -->
					<div class="carousel-inner">
						<?php $i = 0; ?>
						<?php 
						$loop = new WP_Query('post_type=slider&posts_per_page=' . $cc_slider_num . '&order=' . $cc_slider_order);
						while ($loop->have_posts()) :
							$loop->the_post();
						?>
						<div class="item <?php echo !$i ? "active":"";?>">
							<div class="container slide-element">
								<img class="img-responsive" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(),array(900,200)) );?>" alt="Responsive Banner for Slider">
								<?php if( codex_option('cc_slider_caption') ){ ?>
								<h1><?php the_title(); ?></h1>
								<?php the_content(); ?>

								<?php } ?>
							</div> <!-- /.slide-element -->
						</div> <!--/.active /.item -->
						<?php $i = 1;?>
					<?php endwhile; ?>
				</div> <!-- /.carousel-inner -->

				<!-- slider nav -->
				<a class="carousel-control left" href="#main-slider" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
				<a class="carousel-control right" href="#main-slider" data-slide="next"><i class="fa fa-chevron-right"></i></a>
				
			</div> <!-- /#main-slider -->
		</div> <!-- /.slider -->
	</div> <!-- /.container-full -->
</section><!-- /#Slider -->
<?php } ?>