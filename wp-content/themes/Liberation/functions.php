<?php
include 'theme_options.php';
if ( function_exists('register_sidebar') )
    register_sidebar(array(
	'name' => 'Sidebar',
    'before_widget' => '<div class="sidebox">',
    'after_widget' => '</div>',
	'before_title' => '<h3 class="sidetitl">',
    'after_title' => '</h3>',
    ));
function new_excerpt_more($more) {
return '<a href="'. get_permalink($post->ID) . '">' . '&nbsp;&nbsp;[ Read More ]' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function sandbox_globalnav() {
	if ( $menu = str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages('title_li=&sort_column=menu_order&echo=0') ) )
		$menu = '<ul>' . $menu . '</ul>';
	$menu = '<div id="menu">' . $menu . "</div>\n";
	echo apply_filters( 'globalnav_menu', $menu ); // Filter to override default globalnav: globalnav_menu
}
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'liber_slider', 550, 238, true );
	add_image_size( 'liber_home', 80, 60, true ); 
	add_image_size( 'liber_box', 280, 100, true ); 
}
function liber_slider_image(){

if ( has_post_thumbnail() ) {
			 the_post_thumbnail( 'liber_slider', array('class' => 'slidim') );
} else {

};
}
function liber_home_image(){

if ( has_post_thumbnail() ) {
	 the_post_thumbnail( 'liber_home', array('class' => 'postim') );
} else {

};

}
function liber_box_image(){

if ( has_post_thumbnail() ) {
	 the_post_thumbnail( 'liber_box', array('class' => 'boxim') );
} else {

};

}
function featured_section(){
?>

<div class="feature-list">
	<?php $featucat = get_option('lbr_featucat');?>
	<?php $my_query = new WP_Query('showposts=3&category_name=' . $featucat .'');	 ?>
	<?php if ($my_query->have_posts()) :?>
	<ul class="idTabs">
	<?php while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID; ?>	
	<li>
	<a class="vthumb" href="#feature-<?php the_ID(); ?>">
	<?php liber_home_image();?> </a>
<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
	<span class="fclock"> Posted on <?php the_time('F - j - Y'); ?></span> 
	</li>
	<?php endwhile; ?>
	</ul>	
	<?php endif; ?>
</div>
<?php if ($my_query->have_posts()) :?>
	<div class="feature-box">
	<?php while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID; ?>	
	<div id="feature-<?php the_ID(); ?>" class="videoid">
	<?php $thumb = get_post_meta($post->ID, 'thumb', $single = true); ?>
	<?php liber_slider_image();?>
	<div class="featpost">
		<?php the_excerpt(); ?> 
		</div>
		</div>
<?php endwhile; ?>
</div>
<?php endif; ?>

<?php
}
function latest_stories(){
?>

<?php $postnumber = get_option('lbr_postnum');?>
<?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts('paged=' . $paged . '&posts_per_page='.$postnumber.''); ?>
<?php $count = 0; ?>


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
<?php if(++$counter % 3 == 0) : ?>
<div class="clear"></div>
<?php endif; ?>


<?php endwhile; ?>
<div class="clear"></div>
<div id="navigation">
<?php if(function_exists('wp_pagenavi')) : ?>
        <?php wp_pagenavi() ?>
 	   <?php else : ?>
        <div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries','arclite')) ?></div>
        <div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;','arclite')) ?></div>
        <div class="clear"></div>
       <?php endif; ?>

</div>
<div class="clear"></div>
<?php wp_reset_query();?>
<?php endif; ?>
<?php
}
function dp_recent_comments($no_comments = 10, $comment_len = 35) {
    global $wpdb;
	$request = "SELECT * FROM $wpdb->comments";
	$request .= " JOIN $wpdb->posts ON ID = comment_post_ID";
	$request .= " WHERE comment_approved = '1' AND post_status = 'publish' AND post_password =''";
	$request .= " ORDER BY comment_date DESC LIMIT $no_comments";
	$comments = $wpdb->get_results($request);
	if ($comments) {
		foreach ($comments as $comment) {
			ob_start();
			?>
				<li>
					<a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID; ?>"><?php echo dp_get_author($comment); ?>:</a>
					<?php echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len)); ?>
				</li>
			<?php
			ob_end_flush();
		}
	} else {
		echo '<li>'.__('No comments', '').'';
	}
}
function dp_get_author($comment) {
	$author = "";
	if ( empty($comment->comment_author) )
		$author = __('Anonymous', '');
	else
		$author = $comment->comment_author;
	return $author;
}

function popular_posts($no_posts = 6, $before = '<li>', $after = '</li>', $show_pass_post = false, $duration='') {
global $wpdb;
$request = "SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS 'comment_count' FROM $wpdb->posts, $wpdb->comments";
$request .= " WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish'";
if(!$show_pass_post) $request .= " AND post_password =''";
if($duration !="") { $request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
}
$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
$posts = $wpdb->get_results($request);
$output = '';
if ($posts) {
foreach ($posts as $post) {
$post_title = stripslashes($post->post_title);
$comment_count = $post->comment_count;
$permalink = get_permalink($post->ID);
$output .= $before . ' <a href="' . $permalink . '" title="' . $post_title.'">' . $post_title . '</a> ' . $after;
}
} else {
$output .= $before . "None found" . $after;
}
echo $output;
} 
?>
