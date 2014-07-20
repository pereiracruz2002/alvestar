<?php
/**
 * The Header for the Limo WP Theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Codex Coder
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/custom.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/jquery.fancybox.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style.css">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'before' ); ?>
	<header id="header">
		<section id="headnev" class="navbar topnavbar" >		
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<i class="fa fa-bars"></i>
					</button>
					<?php

					if (codex_option('ccr_text_logo_enable') == 0) { ?>
					<a class="header" href="<?php bloginfo('url' ); ?>" class="navbar-brand header"><?php bloginfo( 'name' ); ?></a>
					
					<?php } else { ?>
					
					<a href="<?php bloginfo('url'); ?>"><?php $logo = (codex_option('ccr_logo') <> '') ? codex_option('ccr_logo') : get_bloginfo('template_directory').'/images/logo.png'; ?><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>" id="logo"/></a>

					<?php } ?>


				</div> <!-- /.navbar-header -->

				<nav class="collapse navbar-collapse" data-role="navbar">
					
					<ul id="headernavigation" class="nav pull-right navbar-nav">
						<li class="first">
							<a class="header" href="<?php echo home_url(); ?>/#header">Home</a>
						</li>
						<li class="second">
							<a class="service" href="<?php echo home_url(); ?>/#service"><?php $service = (codex_option('ccr_service_menu')) ? codex_option('ccr_service_menu') : 'Service' ; echo $service; ?></a>
						</li>
						<li class="third">
							<a class="portfolio" href="<?php echo home_url(); ?>/#portfolio"><?php $portfolio = (codex_option('ccr_portfolio_menu')) ? codex_option('ccr_portfolio_menu') : 'Portfolio' ; echo $portfolio; ?></a>
						</li>
						<li class="fourth">
							<a class="aboutus" href="<?php echo home_url(); ?>/#aboutus"><?php $aboutus = (codex_option('ccr_about_us_menu')) ? codex_option('ccr_about_us_menu') : 'About us' ; echo $aboutus; ?></a>
						</li>
						<li class="five">
							<a class="pricing" href="<?php echo home_url(); ?>/#pricing"><?php $pricing = (codex_option('ccr_pricing_menu')) ? codex_option('ccr_pricing_menu') : 'Price' ; echo $pricing; ?></a>
						</li>
						<li class="six">
							<a class="team" href="<?php echo home_url(); ?>/#team"><?php $team = (codex_option('ccr_team_menu')) ? codex_option('ccr_team_menu') : 'Team'; echo $team; ?></a>
						</li>
					</ul>
				</nav> <!-- /.collapse /.navbar-collapse -->
			</div> <!-- /.container -->	
		</section><!-- /#headnev -->
	</header><!-- /#Header-->

	<?php do_action( 'before' ); ?>