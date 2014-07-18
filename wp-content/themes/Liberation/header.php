<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<meta name="description" content="<?php bloginfo('description') ?>" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php 
wp_enqueue_script('jquery');
wp_enqueue_script('idtabs', '/wp-content/themes/Liberation/js/tabs.js');
wp_enqueue_script('tabs', '/wp-content/themes/Liberation/js/tabbed.js');
wp_enqueue_script('cufon', '/wp-content/themes/Liberation/js/cufon.js');
wp_enqueue_script('Myriad', '/wp-content/themes/Liberation/js/Myriad_Pro_700.font.js');
wp_enqueue_script('Effects', '/wp-content/themes/Liberation/js/effects.js');
?>

  
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php //comments_popup_script(); // off by default ?>
<?php 
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="wrapper">

<div id="topbar">
	<div class="today"><?php echo date('l, F j, Y'); ?></div>
	<div class="feeds">
		<ul>
			<li><a href="<?php bloginfo('rss2_url'); ?>">Subscribe to News</a></li>
			<li><a href="<?php bloginfo('comments_rss2_url'); ?>">Subscribe to Comments</a></li>
		</ul>
	</div>
</div>
<div class="clear"> </div>
<div id="header">
		
		<h1 id="blog-title"><span><a href="<?php bloginfo('home') ?>/" title="<?php echo wp_specialchars( get_bloginfo('name'), 1 ) ?>" rel="home"><?php bloginfo('name') ?></a></span></h1>
<?php include (TEMPLATEPATH . '/searchform.php'); ?>	
		</div>

<?php sandbox_globalnav() ?>
	<div class="clear"> </div>
<div id="casing">	