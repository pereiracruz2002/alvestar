<?php
/**
 * Codex Coder functions and definitions
 *
 * @package Codex Coder
 */

// include theme option
include 'admin/index.php';

require_once( get_template_directory()  . '/admin/plugin-setup.php');


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'codex_coder_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function codex_coder_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Codex Coder, use a find and replace
	 * to change 'codexcoder' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'codexcoder', get_template_directory() . '/languages' );

	

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	

	//This theme uses wp_nav_menu() in one location.
	// register_nav_menus( array(
	// 	'primary' => __( 'Primary Menu', 'codexcoder' ),
	// 	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Enable feature image
	add_theme_support('post-thumbnails' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'codex_coder_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
		) ) );
}
endif; // codex_coder_setup
add_action( 'after_setup_theme', 'codex_coder_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function codex_coder_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'codexcoder' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
		) );
}
add_action( 'widgets_init', 'codex_coder_widgets_init' );


/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

add_filter('widget_text', 'do_shortcode');

if ( function_exists('register_sidebar') )
	register_sidebar(array('name'=>'Contact Form',
		'id'			=> 'contact-form',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
		));
if ( function_exists('register_sidebar') )
	register_sidebar(array('name'=>'Map right sidebar',
		'id'			=> 'map-right-sidebar',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
		));


if ( function_exists('register_sidebar') )
	register_sidebar(array('name'=>'Footer-1',
		'id'			=> 'footer1',
		'before_widget' => '<div class="col-md-3">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
		));

if ( function_exists('register_sidebar') )
	register_sidebar(array('name'=>'Footer-2',
		'id'			=> 'footer2',
		'before_widget' => '<div class="col-md-3">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
		));

if ( function_exists('register_sidebar') )
	register_sidebar(array('name'=>'Footer-3',
		'id'			=> 'footer3',
		'before_widget' => '<div class="col-md-3 recent-post">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
		));

if ( function_exists('register_sidebar') )
	register_sidebar(array('name'=>'Footer-4',
		'id'			=> 'footer4',
		'before_widget' => '<div class="col-md-3">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
		));

/**
* Registers Resposive slider
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function ccr_resposive_slider() {

	$labels = array(
		'name'                => __( 'Sliders', 'codexcoder' ),
		'singular_name'       => __( 'Slider', 'codexcoder' ),
		'add_new'             => _x( 'Add New Slider', 'codexcoder', 'codexcoder' ),
		'add_new_item'        => __( 'Add New Slider', 'codexcoder' ),
		'edit_item'           => __( 'Edit Slider', 'codexcoder' ),
		'new_item'            => __( 'New Slider', 'codexcoder' ),
		'view_item'           => __( 'View Slider', 'codexcoder' ),
		'search_items'        => __( 'Search Sliders', 'codexcoder' ),
		'not_found'           => __( 'No Sliders found', 'codexcoder' ),
		'not_found_in_trash'  => __( 'No Sliders found in Trash', 'codexcoder' ),
		'parent_item_colon'   => __( 'Parent Slider:', 'codexcoder' ),
		'menu_name'           => __( 'Slider', 'codexcoder' ),
		);

	$args = array(
		'labels'                   => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title', 'editor', 'thumbnail'
			)
		);

	register_post_type( 'slider', $args );
}

add_action( 'init', 'ccr_resposive_slider' );



// our works

/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function ccr_our_works() {

	$labels = array(
		'name'                => __( 'Our works', 'codexcoder' ),
		'singular_name'       => __( 'Our work', 'codexcoder' ),
		'add_new'             => _x( 'Add New Work', 'codexcoder', 'codexcoder' ),
		'add_new_item'        => __( 'Add New Work', 'codexcoder' ),
		'edit_item'           => __( 'Edit Our Work', 'codexcoder' ),
		'new_item'            => __( 'New Our Work', 'codexcoder' ),
		'view_item'           => __( 'View Our Work', 'codexcoder' ),
		'search_items'        => __( 'Search Our works', 'codexcoder' ),
		'not_found'           => __( 'No Our works found', 'codexcoder' ),
		'not_found_in_trash'  => __( 'No Our works found in Trash', 'codexcoder' ),
		'parent_item_colon'   => __( 'Parent Our Work:', 'codexcoder' ),
		'menu_name'           => __( 'Works', 'codexcoder' ),
		);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title', 'editor', 'thumbnail'
			)
		);

	register_post_type( 'work', $args );
}

add_action( 'init', 'ccr_our_works' );

/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function ccr_portfolio_isotop() {

	$labels = array(
		'name'               => _x( 'Portfolio', 'post type general name' ),
		'singular_name'      => _x( 'Portfolio', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Portfolio' ),
		'edit_item'          => __( 'Edit Portfolio' ),
		'new_item'           => __( 'New Portfolio Items' ),
		'all_items'          => __( 'All Portfolio' ),
		'view_item'          => __( 'View Portfolio' ),
		'search_items'       => __( 'Search Portfolio' ),
		'not_found'          => __( 'No Portfolio Items found' ),
		'not_found_in_trash' => __( 'No Portfolio Items found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Portfolio'
		);

	$args = array(
		'labels'        	=> $labels,
		'description'   	=> 'Holds Portfolio specific data',
		'public'        	=> true,
		'show_ui'       	=> true,
		'show_in_menu'  	=> true,
		'query_var'     	=> true,
		'rewrite'       	=> true,
		'capability_type'	=> 'post',
		'has_archive'   	=> true,
		'hierarchical'  	=> false,
		'menu_position' 	=> 5,
		'supports'      	=> array( 'title', 'editor', 'thumbnail'),
        'menu_icon' 		=> null  // Icon Path
        );
	register_post_type( 'portfolio', $args ); 


// Custom taxonomy for Portfolio Tags  

	$labels = array(  
		'name' => _x( 'Categories', 'taxonomy general name' ),  
		'singular_name' => _x( 'Category', 'taxonomy singular name' ),  
		'search_items' =>  __( 'Search Types' ),  
		'all_items' => __( 'All Categories' ),  
		'parent_item' => __( 'Parent Category' ),  
		'parent_item_colon' => __( 'Parent Category:' ),  
		'edit_item' => __( 'Edit Category' ),  
		'update_item' => __( 'Update Category' ),  
		'add_new_item' => __( 'Add New Category' ),  
		'new_item_name' => __( 'New Category Name' ),  
		);  

	// Custom taxonomy for Project Tags  
	register_taxonomy('ccrtags', array('portfolio'), array(  
		'hierarchical' => true,  
		'labels' => $labels,  
		'show_ui' => true,  
		'query_var' => true,  
		'rewrite' =>true,  
		));

}
add_action( 'init', 'ccr_portfolio_isotop' );

//testimonial

/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function ccr_custom_testimonial() {

	$labels = array(
		'name'                => __( 'Testimonials', 'codexcoder' ),
		'singular_name'       => __( 'Testimonial', 'codexcoder' ),
		'add_new'             => _x( 'Add New Testimonial', 'codexcoder', 'codexcoder' ),
		'add_new_item'        => __( 'Add New Testimonial', 'codexcoder' ),
		'edit_item'           => __( 'Edit Testimonial', 'codexcoder' ),
		'new_item'            => __( 'New Testimonial', 'codexcoder' ),
		'view_item'           => __( 'View Testimonial', 'codexcoder' ),
		'search_items'        => __( 'Search Testimonials', 'codexcoder' ),
		'not_found'           => __( 'No Testimonials found', 'codexcoder' ),
		'not_found_in_trash'  => __( 'No Testimonials found in Trash', 'codexcoder' ),
		'parent_item_colon'   => __( 'Parent Testimonial:', 'codexcoder' ),
		'menu_name'           => __( 'Testimonials', 'codexcoder' ),
		);

	$args = array(
		'labels'                   => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title', 'editor', 'thumbnail'
			)
		);

	register_post_type( 'testimonial', $args );
}

add_action( 'init', 'ccr_custom_testimonial' );

add_action ('add_meta_boxes', 'testimonial_meta_box');

function testimonial_meta_box() {
	add_meta_box( 'add_meta_boxes_id', 'Designation', 'testimonial_designation','testimonial', 'normal', 'high' );
}

// create a meta box input field

function testimonial_designation($post){ 

	$value = get_post_meta( get_the_id(), 'testimonial_designation_name', true); ?>
	<input type="text" class="widefat" name="testimonial_designation_name" value="<?php if($value) { echo $value;} ?>" placeholder="Write the designation" />

	<?php }

//save meta data value
	add_action( 'save_post', 'designation_meta_box_save' ); 

//save meta field
	function designation_meta_box_save($post_id) {
		if (isset($_POST['testimonial_designation_name'])){
			update_post_meta( $post_id, 'testimonial_designation_name', $_POST['testimonial_designation_name'] );	
		}
	}

/**
* Registers pricing table
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function ccr_pricing_table() {

	$labels = array(
		'name'                => __( 'Pricing table', 'codexcoder' ),
		'singular_name'       => __( 'Pricing table', 'codexcoder' ),
		'add_new'             => _x( 'Add New Pricing table', 'codexcoder', 'codexcoder' ),
		'add_new_item'        => __( 'Add New Pricing table', 'codexcoder' ),
		'edit_item'           => __( 'Edit Pricing table', 'codexcoder' ),
		'new_item'            => __( 'New Pricing table', 'codexcoder' ),
		'view_item'           => __( 'View Pricing table', 'codexcoder' ),
		'search_items'        => __( 'Search Pricing table', 'codexcoder' ),
		'not_found'           => __( 'No Pricing table found', 'codexcoder' ),
		'not_found_in_trash'  => __( 'No Pricing table found in Trash', 'codexcoder' ),
		'parent_item_colon'   => __( 'Parent Pricing table:', 'codexcoder' ),
		'menu_name'           => __( 'Pricing table', 'codexcoder' ),
		);

	$args = array(
		'labels'                   => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => 'title'
		);

	register_post_type( 'pricing-table', $args );
}

add_action( 'init', 'ccr_pricing_table' );

add_action('add_meta_boxes', 'pricing_table_metabox' );

function pricing_table_metabox(){
	add_meta_box( 'pricing_table_id', 'Pricing table', 'pricing_table_field', 'pricing-table', 'normal', 'high' );
}
// Field Array
function pricing_table_field($post){ 

	$value = get_post_meta( get_the_id(), 'pricing_table_select_price', true); 
	$value1 = get_post_meta( get_the_id(), 'pricing_table_select_field1', true); 
	$value2 = get_post_meta( get_the_id(), 'pricing_table_select_field2', true);
	$value3 = get_post_meta( get_the_id(), 'pricing_table_select_field3', true);
	$value4 = get_post_meta( get_the_id(), 'pricing_table_select_field4', true);
	$value5 = get_post_meta( get_the_id(), 'pricing_table_select_field5', true);
	$value6 = get_post_meta( get_the_id(), 'pricing_table_select_field6', true);
	$value10 = get_post_meta( get_the_id(), 'pricing_table_select_field10', true);
	?>
	<p>
		<label for="price"><h3 class="hndle">Price</h3></label><br/>
		<input class="widefat" type="text"  name="pricing_table_select_price" value="<?php if($value) { echo $value;} ?>" placeholder="Write the price" />
	</p>
	<p>
		<label for="feature"><h3 class="hndle">Feature item title</h3></label><br/>	
		<input class="widefat" type="text" name="pricing_table_select_field1" value="<?php if($value1) { echo $value1;} ?>" placeholder="" />
	</p>
	<p>
		<input class="widefat" type="text" name="pricing_table_select_field2" value="<?php if($value2) { echo $value2;} ?>" placeholder="" />
	</p>
	<p>
		<input class="widefat" type="text" name="pricing_table_select_field3" value="<?php if($value3) { echo $value3;} ?>" placeholder="" />
	</p>
	<p>
		<input class="widefat" type="text" name="pricing_table_select_field4" value="<?php if($value4) { echo $value4;} ?>" placeholder="" />
	</p>
	<p>
		<input class="widefat" type="text" name="pricing_table_select_field5" value="<?php if($value5) { echo $value5;} ?>" placeholder="" />
	</p>
	<p>
		<label for="extra"><h3 class="hndle">Your Extra field</h3></label><br/>
		<textarea class="widefat" rows="4" cols="50" name="pricing_table_select_field6" placeholder="Extra Field. You can your html also." ><?php if($value6) { echo $value6;} ?></textarea>
	</p>
	
	<p>
		<label for="subs"><h3 class="hndle">Your Subscribtion link here</h3></label><br/>
		<input class="widefat" type="text" name="pricing_table_select_field10" value="<?php if($value10) { echo $value10;} ?>" placeholder="Subscribe link here. for example:http://yourlink.com" /> Write your subscribe link here.
	</p>
	<?php }

//save meta data value
	add_action( 'save_post', 'pricing_table_meta_box_save' ); 

//save meta field
	function pricing_table_meta_box_save($post_id) {
		if (isset($_POST['pricing_table_select_price'])){
			update_post_meta( $post_id, 'pricing_table_select_price', $_POST['pricing_table_select_price'] );	
		}

		if (isset($_POST['pricing_table_select_field1'])){
			update_post_meta( $post_id, 'pricing_table_select_field1', $_POST['pricing_table_select_field1'] );	
		}

		if (isset($_POST['pricing_table_select_field2'])){
			update_post_meta( $post_id, 'pricing_table_select_field2', $_POST['pricing_table_select_field2'] );	
		}

		if (isset($_POST['pricing_table_select_field3'])){
			update_post_meta( $post_id, 'pricing_table_select_field3', $_POST['pricing_table_select_field3'] );	
		}

		if (isset($_POST['pricing_table_select_field4'])){
			update_post_meta( $post_id, 'pricing_table_select_field4', $_POST['pricing_table_select_field4'] );	
		}

		if (isset($_POST['pricing_table_select_field5'])){
			update_post_meta( $post_id, 'pricing_table_select_field5', $_POST['pricing_table_select_field5'] );	
		}

		if (isset($_POST['pricing_table_select_field6'])){
			update_post_meta( $post_id, 'pricing_table_select_field6', $_POST['pricing_table_select_field6'] );	
		}

		if (isset($_POST['pricing_table_select_field10'])){
			update_post_meta( $post_id, 'pricing_table_select_field10', $_POST['pricing_table_select_field10'] );	
		}
	}

// our team

/**
* Registers Our team
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function ccr_our_team() {

	$labels = array(
		'name'                => __( 'Team members', 'codexcoder' ),
		'singular_name'       => __( 'Team member', 'codexcoder' ),
		'add_new'             => _x( 'Add New Team member', 'codexcoder', 'codexcoder' ),
		'add_new_item'        => __( 'Add New Team member', 'codexcoder' ),
		'edit_item'           => __( 'Edit Team member', 'codexcoder' ),
		'new_item'            => __( 'New Team member', 'codexcoder' ),
		'view_item'           => __( 'View Team member', 'codexcoder' ),
		'search_items'        => __( 'Search Team members', 'codexcoder' ),
		'not_found'           => __( 'No Team members found', 'codexcoder' ),
		'not_found_in_trash'  => __( 'No Team members found in Trash', 'codexcoder' ),
		'parent_item_colon'   => __( 'Parent Team member:', 'codexcoder' ),
		'menu_name'           => __( 'Team members', 'codexcoder' ),
		);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title', 'editor', 'thumbnail'
			)
		);

	register_post_type( 'team', $args );
}

add_action( 'init', 'ccr_our_team' );

// team meta box register
add_action('add_meta_boxes', 'ccr_team_metabox' );


function ccr_team_metabox(){
	add_meta_box( 'ccr_team_metabox_id', 'Our team ','show_ccr_team_metabox', 'team', 'normal', 'high');
}

//register the team field
function show_ccr_team_metabox($post){
	$value= get_post_meta(get_the_id(), 'team_member_designation', true ); 
	$fb= get_post_meta(get_the_id(), 'team_member_g_plus', true ); 
	$tw= get_post_meta(get_the_id(), 'team_member_tw_id', true );
	$g_plus= get_post_meta(get_the_id(), 'team_member_g_plus', true );
	$linkdin= get_post_meta(get_the_id(), 'team_member_linkedin', true );
	?>
	
	<p>
		<input type="text" class="widefat" name="team_member_designation" value="<?php if($value){echo $value;} ?>" placeholder="Type the designation">
	</p>
	<p style="background: #444; padding:5px;color: #fff; text-align:center;">SOCIAL PROFILE</p>
	<p>
		<input type="text" class="widefat" name="team_member_fb_id" value="<?php if($fb){echo $fb;} ?>" placeholder="Write facebook id">
	</p>
	<p>
		<input type="text" class="widefat" name="team_member_tw_id" value="<?php if($tw){echo $tw;} ?>" placeholder="Write twitter id">
	</p>
	<p>
		<input type="text" class="widefat" name="team_member_g_plus" value="<?php if($g_plus){echo $g_plus;} ?>" placeholder="Write google plus">
	</p>
	<p>
		<input type="text" class="widefat" name="team_member_linkedin" value="<?php if($linkdin){echo $linkdin;} ?>" placeholder="Write the linkedin">
	</p>
	<?php }

	// save team value
	add_action('save_post', 'ccr_team_member_save' );

	function ccr_team_member_save($post_id){
		if(isset($_POST['team_member_designation'])) {
			update_post_meta($post_id,'team_member_designation', $_POST['team_member_designation']);
		}
		//save fb value
		if(isset($_POST['team_member_fb_id'])) {
			update_post_meta($post_id,'team_member_fb_id', $_POST['team_member_fb_id']);
		}
		// save tw value
		if(isset($_POST['team_member_tw_id'])) {
			update_post_meta($post_id,'team_member_tw_id', $_POST['team_member_tw_id']);
		}
		//save g plus value
		if(isset($_POST['team_member_g_plus'])) {
			update_post_meta($post_id,'team_member_g_plus', $_POST['team_member_g_plus']);
		}
		// save linkedin
		if(isset($_POST['team_member_linkedin'])) {
			update_post_meta($post_id,'team_member_linkedin', $_POST['team_member_linkedin']);
		}
	}

// theme function
	if( !function_exists('codex_option') ){
		function codex_option($index1=false, $index2=false){
			global $data;
			if($index2){
				return ( isset( $data[$index1] ) and isset( $data[$index2] ) ) ? $data[$index1][$index2]:'';
			} else {
				return isset( $data[$index1] ) ? $data[$index1]:'';
			}
		}
	}



//Favicon Image
	if (!function_exists("cc_favicon")) {
		function cc_favicon(){
			if(codex_option('cc_favicon') == ""){
				echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/favicon.png" >';
			} else {
				echo '<link rel="shortcut icon" href="' . codex_option('cc_favicon') .'" >';
			}
			if (codex_option('cc_show_apple_logo')) {
				echo codex_option('cc_apple_iphone_icon') != "" ? ('<link rel="apple-touch-icon" href="' . codex_option('cc_apple_iphone_icon') . '"/>') : '';
				echo codex_option('cc_apple_iphone_retina_icon') != "" ? ('<link rel="apple-touch-icon" sizes="114x114" href="' . codex_option('cc_apple_iphone_retina_icon') . '"/>') : '';
				echo codex_option('cc_apple_ipad_icon') != "" ? ('<link rel="apple-touch-icon" sizes="72x72" href="' . codex_option('cc_apple_ipad_icon') . '"/>') : '';
				echo codex_option('cc_apple_ipad_retina_icon') != "" ? ('<link rel="apple-touch-icon" sizes="144x144" href="' . codex_option('cc_apple_ipad_retina_icon') . '"/>') : '';
			}
		}
	}




//Copyright Text 
	if( !function_exists('cc_footer')){
		function cc_footer(){
			if(codex_option( 'cc_footer_text' )){
				echo codex_option( 'cc_footer_text' );
			}
		}
	}

//Google Analytics
	if( !function_exists('google_analytics') ){
		function google_analytics(){
			echo codex_option('cc_google_analytics');
		}
	}


	if(!function_exists('cc_admin_logo')){
		function cc_admin_logo(){
			if(codex_option('cc_admin_logo')){
				?>
				<style type="text/css">
					body.login div#login h1 a {
						background-image: url(<?php echo codex_option('cc_admin_logo');?>);
						padding-bottom: 30px;
					}
				</style>

				<?php } else { ?>

				<style type="text/css">
					body.login div#login h1 a {
						background-image: url(<?php echo admin_url('/images/wordpress-logo.png');?>);
						padding-bottom: 30px;
					}
				</style>

				<?php }
			}
			add_action( 'login_enqueue_scripts', 'cc_admin_logo' );
		}


		if(!function_exists('cc_logo_login_url')){
			function cc_logo_login_url(){
				return site_url();
			}
			add_filter( 'login_headerurl', 'cc_logo_login_url' );
		}

//smooth scrolling menu
		// add_filter('wp_nav_menu', 'post_link_attributes' );

		// function post_link_attributes($output) {
		// 	$injection = 'href="#' . get_the_title() .'"';
		// 	return str_replace('<a href=', '<a '.$injection.' href=', $output);
		// }


