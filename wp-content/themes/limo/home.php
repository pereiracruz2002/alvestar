<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Codex Coder
 */

get_header(); ?>

<?php
// Slider include
include 'slider.php'; ?>

<?php if(codex_option('cc_works_enable') == 1 ) { ?>  
<section id="somework" class="element_from_bottom">
	<div class="worksection">
		<div class="container-full">

			<div class="works">
				<div class="container">
					<h3><?php $our_works = (codex_option('ccr_our_works_title')) ? codex_option('ccr_our_works_title') : 'Our Works' ; echo $our_works; ?></h3>
				</div>
			</div> <!-- /.works -->

			<div class="container">
				<div class="works-img">
					<div id="work-slide" class="carousel slide">

						<div class="slide2nev">
							<a class="carousel-control left" href="#work-slide" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
							<a class="carousel-control right" href="#work-slide" data-slide="next"><i class="fa fa-chevron-right"></i></a>
						</div> <!-- /.slide2nev -->

						<!-- Slider items -->
						<div class="carousel-inner">

							<div class="item active">
								<?php 
								$loop = new WP_Query('post_type=work&posts_per_page=4');
								while ($loop->have_posts()) {
									$loop->the_post();
									?>	
									<div class="col-sm-3">
										<figure>
											<?php the_post_thumbnail(); ?>
											<figcaption>
												<h4><?php the_title(); ?></h4>
											</figcaption>							
										</figure>	
									</div>
									<?php } ?>
								</div> <!-- /.active /.item -->
								<div class="item">
									<?php 
									$loop = new WP_Query('post_type=work&posts_per_page=4&offset=4');
									while ($loop->have_posts()) {
										$loop->the_post();
										?>	
										<div class="col-sm-3">
											<figure>
												<?php the_post_thumbnail(); ?>
												<figcaption>
													<h4><?php the_title(); ?></h4>
												</figcaption>							
											</figure>	
										</div>
										<?php } ?>
									</div> <!-- /.active /.item -->
									
								</div>  <!-- /.carousel-inner -->
								<!--/.carousel -->

							</div> <!-- /#work-slide -->
						</div> <!-- /.works-img -->
					</div> <!--/.container-->
				</div> <!-- /.container-full -->
			</div> <!-- /.worksection -->
		</section><!-- /#somework -->
		<?php } ?>

		<?php if(codex_option('cc_dream_enable') == 1 ) { ?> 
		<section id="aboveportfolio" class="element_from_left">
			<div class="container-full">
				<div class="shadow">
					<div class="container">

						<h2 class="text-center">
							<?php echo codex_option('ccr_our_dream_title'); ?>
						</h2>

						<p class="text-center">
							<?php echo codex_option('ccr_our_dream_text'); ?>
						</p>

						<div>
							<ul>
								<li class="btn"><a href="<?php echo codex_option('ccr_our_dream_learn'); ?>" class="btn left">Learn more</a></li>
								<li class="btn"><a href="<?php echo codex_option('ccr_our_dream_getit'); ?>" class="btn right">Get it now</a></li>
							</ul>
						</div>	

					</div> <!-- /.container -->
				</div> <!-- /.shadow -->
			</div> <!-- /.container-full -->
		</section><!-- /#aboveportfolio -->
		<?php } ?>

		<?php if(codex_option('cc_service_enable')==1) { ?>
		<section id="service">
			<div class="servicediv">
				<div class="container-full">
					<div class="container">
						<h3><?php $service = (codex_option('ccr_our_service_title')) ? codex_option('ccr_our_service_title') : 'Our services' ; echo $service; ?></h3>

						<ul>

							<li class="col-xs-3 element_from_left">
								<div>
									<p class="faicons"><i class="fa fa-wrench"></i></p>
									<h4><?php echo codex_option('ccr_our_1st_service_title'); ?></h4>
									<p><?php echo codex_option('ccr_our_1st_service_content'); ?></p>
								</div>
							</li>

							<li class="col-xs-3 element_from_left">
								<div>
									<p class="faicons"><i class="fa fa-film"></i></p>
									<h4><?php echo codex_option('ccr_our_2nd_service_title'); ?></h4>
									<p><?php echo codex_option('ccr_our_2nd_service_content'); ?></p>
								</div>
							</li>

							<li class="col-xs-3 element_from_right">
								<div>
									<p class="faicons"><i class="fa fa-th-large"></i></p>
									<h4><?php echo codex_option('ccr_our_3rd_service_title'); ?></h4>
									<p><?php echo codex_option('ccr_our_3rd_service_content'); ?></p>
								</div>
							</li>

							<li class="col-xs-3 element_from_right">
								<div>
									<p class="faicons"><i class="fa fa-pencil-square-o"></i></p>
									<h4><?php echo codex_option('ccr_our_4th_service_title'); ?></h4>
									<p><?php echo codex_option('ccr_our_4th_service_content'); ?></p>
								</div>
							</li>

						</ul>

					</div><!-- /.container -->
				</div><!-- /.container-full -->
			</div> <!-- /.servicediv -->
		</section><!-- /#Service -->
		<?php } ?>

		<?php if(codex_option('cc_portfolio_enable') == 1 ) { ?>
		<section id="portfolio" class="element_from_bottom">
			<div class="container-full">

				<div class="container">
					<h2 class="text-center"><?php $portfolio = (codex_option('cc_portfolio_title')) ? codex_option('cc_portfolio_title') : 'Our Portfolio Gallery' ; echo $portfolio; ?></h2>
					<p class="text-center">
						<?php echo codex_option('cc_portfolio_title'); ?>
					</p>

					<div class="portfolio-type portfolio-nav">

						<ul class="list-inline">
							<li><a class="filter" data-filter="all"><?php _e('All');?></a></li>
							<?php  $tags = get_terms("ccrtags");

							foreach ($tags as $tag) { ?>     

							<li><a class="filter" data-filter="<?php echo trim($tag->slug) ?>"><?php echo $tag->name ?></a></li>

							<?php } ?>
						</ul>

					</div> <!-- /.portfolio-type -->
				</div> <!-- /.container -->

				<div class="container">
					<div class="portfolio-img">

						<ul id="Grid">

							<?php query_posts('post_type=portfolio' ); ?>

							<?php if(have_posts()) { while(have_posts()) { the_post();

								$terms = wp_get_post_terms(get_the_ID(), 'ccrtags' );
								$t = array();
								foreach($terms as $term) $t[] = $term->slug;
								?>
								<li class="mix <?php echo implode(' ', $t); $t = array(); ?>">
									<figure>
										<?php the_post_thumbnail(); ?>
										<figcaption>
											<h4><?php the_title(); ?></h4>
										</figcaption>							
									</figure>	
								</li>							
								<?php }} ?>	

								<?php wp_reset_postdata();?>	
							</ul> <!-- /#Grid -->

						</div> <!-- /.portfolio-img -->
					</div> <!-- /.container -->

					<div class="clear-bottom"></div>

				</div> <!-- /.container-full -->
			</section><!-- #portfolio -->
			<?php } ?>

			<?php if(codex_option('cc_testimonial_enable')==1) { ?>
			<section id="testimonial">
				<div class="testsection">
					<div class="container-full">

						<div class="heading element_from_left">
							<div class="container">
								<h3><?php $testi = (codex_option('cc_testimonial_title')) ? codex_option('cc_testimonial_title') : 'Our Clint testimonial' ; echo $testi; ?></h3>
							</div>
						</div> <!-- /.heading -->

						<div class="container element_from_right">
							<?php 
							$loop = new WP_Query('post_type=testimonial&posts_per_page=' . codex_option('cc_testimonial_number'));
							if($loop->have_posts()) { while ($loop->have_posts()) {
								$loop->the_post();
								?>	
								<div class="col-xs-6">
									<div class="clint-div">
										<div class="avatar">
											<?php the_post_thumbnail(array(80,80), true); ?>
										</div>
										<P class="name"><?php the_title(); ?></P>
										<P class="designation "><?php echo get_post_meta( get_the_id(), 'testimonial_designation_name', true ); ?></P>
									</div>
									<p><?php the_content(); ?></p>
								</div>
								<?php }} ?>

							</div> <!-- /.container -->
						</div> <!-- /.container-full -->
					</div>   <!-- /.testsection -->
				</section><!-- /#testimonial -->
				<?php } ?>
				<?php if(codex_option('cc_skill_enable') == 1 ) { ?>
				<section id="aboutus">
					<div class="container-full">
						<div class="container">

							<div id="aboutusleft" class="col-xs-6 element_from_right">
								<div class="heading">
									<h3><?php echo codex_option('cc_about_us_title'); ?></h3>
								</div>
								<p>
									<?php echo codex_option('cc_about_us_des'); ?>
								</p>	
							</div> <!-- /#aboutusleft -->

							<div id="aboutusright" class="col-xs-6 element_from_left">
								<div class="heading">
									<h3><?php echo codex_option('cc_skill_title'); ?></h3>
								</div>

								<p><?php echo codex_option('cc_skill_one'); ?></p>
								<div class="progress">
									<div class="progress-bar progress-web-development" role="progressbar" aria-valuenow="<?php echo codex_option('slider_skill_1'); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo codex_option('slider_skill_1'); ?>%">
										<span class="percent"><?php echo codex_option('slider_skill_1'); ?>%</span>
									</div>
								</div>

								<p><?php echo codex_option('cc_skill_two'); ?></p>
								<div class="progress">
									<div class="progress-bar progress-web-desingn" role="progressbar" aria-valuenow="<?php echo codex_option('slider_skill_2'); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo codex_option('slider_skill_2'); ?>%">
										<span class="percent"><?php echo codex_option('slider_skill_2'); ?>%</span>
									</div>
								</div>

								<p><?php echo codex_option('cc_skill_three'); ?></p>
								<div class="progress">
									<div class="progress-bar progress-photoshop" role="progressbar" aria-valuenow="<?php echo codex_option('slider_skill_3'); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo codex_option('slider_skill_3'); ?>%">
										<span class="percent"><?php echo codex_option('slider_skill_3'); ?>%</span>
									</div>
								</div>

								<p><?php echo codex_option('cc_skill_four'); ?></p>
								<div class="progress">
									<div class="progress-bar progress-issustrator" role="progressbar" aria-valuenow="<?php echo codex_option('slider_skill_4'); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo codex_option('slider_skill_4'); ?>%">
										<span class="percent"><?php echo codex_option('slider_skill_4'); ?>%</span>
									</div>
								</div>

							</div> <!-- /#aboutusright -->

						</div> <!-- /.container -->
						<div class="clear-bottom"></div>
					</div> <!-- /.container-full -->
				</section><!-- /.aboutus -->
				<?php } ?>
				<?php if(codex_option('cc_pricing_enable') ==1) { ?>
				<section id="pricing" class="element_fade_in">
					<div class="container-full">

						<div class="clear-top"></div>

						<div class="container">
							<h3><?php $table = (codex_option('cc_pricing_title')) ? codex_option('cc_pricing_title') : 'Our Pricing' ; echo $table; ?></h3>
							<p class="text-center"><?php $pricing_des = (codex_option('cc_pricing_des')) ? codex_option('cc_pricing_des') : 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled' ; echo $pricing_des; ?></p>
							<div class="clear-top"></div>

							<ul>
								<?php 
								$loop = new WP_Query('post_type=pricing-table');
								if($loop->have_posts()) { while ($loop->have_posts()) {
									$loop->the_post();
									?>
									<li class="col-xs-3">
										<div>
											<h4><?php the_title(); ?></h4>
											<h5><?php echo get_post_meta( get_the_id(), 'pricing_table_select_price', true); ?></h5>
											<p><?php echo get_post_meta( get_the_id(), 'pricing_table_select_field1', true); ?></p>
											<p><?php echo get_post_meta( get_the_id(), 'pricing_table_select_field2', true); ?></p>
											<p><?php echo get_post_meta( get_the_id(), 'pricing_table_select_field3', true); ?></p>
											<p><?php echo get_post_meta( get_the_id(), 'pricing_table_select_field4', true); ?></p>
											<p><?php echo get_post_meta( get_the_id(), 'pricing_table_select_field5', true); ?></p>
											<p><?php echo get_post_meta( get_the_id(), 'pricing_table_select_field6', true); ?></p>
											<p><a class="btn" href="<?php echo get_post_meta( get_the_id(), 'pricing_table_select_field10', true); ?>">Subscribe</a></p>
										</div>
									</li>

									<?php }}?>
								</ul>

							</div> <!-- /.container -->
						</div> <!-- /.container-full -->
					</section> <!-- /#pricing -->
					<?php } ?>

					<?php if(codex_option('cc_team_enable') == 1 ) { ?>
					<section id="team">
						<div class="container-full element_from_left">

							<div class="clear-top"></div>

							<div class="container">
								<h3><?php $team = (codex_option('cc_team_title')) ? codex_option('cc_team_title') : 'Our Team' ; echo $team; ?></h3>
								<p class="text-center"><?php echo codex_option('cc_team_des'); ?></p>

								<div class="clear-top"></div>

								<ul>
									<?php query_posts('post_type=team'); 
									if(have_posts()) { while (have_posts()) { the_post(); 	
										?>
										<li class="col-xs-3">
											<div class="stafcontainer">

												<div class="staf">
													<div class="avatar">
														<?php the_post_thumbnail(); ?>
													</div>
													<h5 class="text-center"><?php the_title(); ?></h5>
													<h6 class="text-center"><?php echo get_post_meta(get_the_id(), 'team_member_designation', true ); ?></h6>
													<p>
														<?php the_content(); ?>
													</p>
												</div> <!-- /.staf -->

												<div class="social-icons">
													<ul>

														<li class="facebook">
															<a href="<?php echo get_post_meta(get_the_id(), 'team_member_fb_id', true ); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
														</li><!-- /.facebook -->

														<li class="twitter">
															<a href="<?php echo get_post_meta(get_the_id(), 'team_member_tw_id', true ); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
														</li> <!-- /.twitter -->

														<li class="googleplus">
															<a href="<?php echo get_post_meta(get_the_id(), 'team_member_g_plus', true ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
														</li><!-- /.googleplus -->

														<li class="linkedin">
															<a href="<?php echo get_post_meta(get_the_id(), 'team_member_linkedin', true ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
														</li><!-- /.linkedin -->

													</ul>
												</div> <!-- /.social-icons -->

											</div> <!-- /.stafcontainer -->
										</li><!-- /.col-xs-3 -->
										<?php }} ?>
									</ul>
								</div> <!-- /.container -->
							</div><!-- /.container-full -->
						</section><!-- /#team -->
						<?php } ?>

						<section id="contactus">
							<div class="container-full clearfix">

							<div id="map"></div>

									<div class="shadowcontainer">
										<div class="shadow">

											<div class="clear-top"></div>

											<div class="container">
												<div class="col-xs-12 col-md-6 pull-left element_from_left">
													<?php dynamic_sidebar('contact-form' ); ?>
												</div> <!-- /.col-md-6 -->

												<div class="col-xs-12 col-md-3 gettouch pull-right element_from_right"> 
													<?php dynamic_sidebar('map-right-sidebar' ); ?>
												</div> <!-- /.col-md-3 /.gettouch -->

											</div> <!-- /.container -->
										</div><!-- /.shadow -->
									</div> <!-- /.shadowcontainer -->
								</div> <!-- /.container-full -->
							</section> <!-- /.contactus-->

							<?php get_footer(); ?>
