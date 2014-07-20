<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
			$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
			$categories_tmp 	= array_unshift($of_categories, "Select a category:");    

		//Access the WordPress Pages via an Array
			$of_pages 			= array();
			$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
			foreach ($of_pages_obj as $of_page) {
				$of_pages[$of_page->ID] = $of_page->post_name; }
				$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       

		//Testing 
				$of_options_select 	= array("one","two","three","four","five"); 
				$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");

		//Sample Homepage blocks for the layout manager (sorter)
				$of_options_homepage_blocks = array
				( 
					"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
				), 
					"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
				),
					);


		//Stylesheets Reader
				$alt_stylesheet_path = LAYOUT_PATH;
				$alt_stylesheets = array();

				if ( is_dir($alt_stylesheet_path) ) 
				{
					if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
					{ 
						while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
						{
							if(stristr($alt_stylesheet_file, ".css") !== false)
							{
								$alt_stylesheets[] = $alt_stylesheet_file;
							}
						}    
					}
				}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
			if ($bg_images_dir = opendir($bg_images_path) ) { 
				while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
					if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($bg_images); //Sorts the array into a natural order
		            	$bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


		/*-----------------------------------------------------------------------------------*/
		/* The Options Array */
		/*-----------------------------------------------------------------------------------*/

		// Set the Options Array

		global $of_options;
		$of_options = array();

		$of_options[] = array( 	"name" 		=> "Home Settings",
			"type" 		=> "heading",
			"icon"		=> ADMIN_IMAGES . "icon-home.png"
			);

		$url =  ADMIN_DIR . 'assets/images/';

		$of_options[]   = array(  
			"name"      => __("Logo option heading"),
			"desc"      => "",
			"id"        => "cc_logo_opt_info",
			"std"       => "<h3 style=\"margin: 3px; color: #fff;\">Logo options</h3>",
			"icon"      => true,
			"type"      => "info"
			);
		
		$of_options[]  = array( 	"name" 		=> "Enable Logo",
			"desc" 		=> "This checkbox will hide/show a couple of options group. Try it out!",
			"id" 		=> "ccr_text_logo_enable",
			"std" 		=> 0,
			"folds" 	=> 1,
			"type" 		=> "switch"
			);

		$of_options[]  = array( 	"name" 		=> "Upload Your Logo",
			"desc" 		=> "Upload your logo here",
			"id" 		=> "ccr_logo",
			"std" 		=> "",
			"fold" 		=> "ccr_text_logo_enable", /* the checkbox hook */
			"type" 		=> "upload",
			"mod" 		=> "min"
			);

		$of_options[]   = array(  
			"name"      => __("Favicon options"),
			"desc"      => "",
			"id"        => "cc_apple_logo",
			"std"       => "<h3 style=\"margin: 3px;color: #fff;\">Favicon options</h3>",
			"icon"      => true,
			"type"      => "info",
			);

		$of_options[]   = array(  
			"name"      => __("Favicon"),
			"desc"      => __("Upload favicon image"),
			"id"        => "cc_favicon",
			"type"      => "upload",
			"mod"       => "min"
			);	

		$of_options[]   = array(  
			"name"      => __("Apple Icon"),
			"desc"      => __("Show or hide Apple Icon"),
			"id"        => "cc_show_apple_logo",
			"std"       => 0,
			"folds"     => 1,
			"type"      => "switch"
			);

		$of_options[]   = array(  
			"name"      => __("iPhone icon"),
			"desc"      => __("Upload iPhone icon"),
			"id"        => "cc_apple_iphone_icon",
			"type"      => "upload",
			"mod"       => "min",
			"fold"      => "cc_show_apple_logo"
			);

		$of_options[]   = array(  
			"name"      => __("iPhone retina icon"),
			"desc"      => __("Upload 114x114 px iPhone retina icon"),
			"id"        => "cc_apple_iphone_retina_icon",
			"type"      => "upload",
			"mod"       => "min",
			"fold"      => "cc_show_apple_logo"
			);

		$of_options[]   = array(  
			"name"      => __("iPad icon"),
			"desc"      => __("Upload 72x72 px iPad icon"),
			"id"        => "cc_apple_ipad_icon",
			"type"      => "upload",
			"mod"       => "min",
			"fold"      => "cc_show_apple_logo"
			);

		$of_options[]   = array(  
			"name"      => __("iPad retina icon"),
			"desc"      => __("Upload 144x144 px iPad retina icon"),
			"id"        => "cc_apple_ipad_retina_icon",
			"type"      => "upload",
			"mod"       => "min",
			"fold"      => "cc_show_apple_logo"
			);
		$of_options[]   = array(  
			"name"      => __("Google Map Setting"),
			"desc"      => "",
			"id"        => "g_map",
			"std"       => "<h3 style=\"margin: 3px;color: #fff;\">Google Map</h3>",
			"icon"      => true,
			"type"      => "info"
			);
		$of_options[] = array( 	"name" 		=> "Name of the place",
			"desc" 		=> "Write the name of your place",
			"id" 		=> "cc_place",
			"std" 		=> "CodexCoder",
			"type" 		=> "text"
			);
		$of_options[] = array( 	"name" 		=> "Latitude",
			"desc" 		=> "Paste your DD (decimal degrees) tracking code here. <a target=\"_blank\" href=\"http://www.gps-coordinates.net/\">Click here</a> for help.",
			"id" 		=> "cc_lati",
			"std" 		=> "23.7322302",
			"type" 		=> "text"
			);
		$of_options[] = array( 	"name" 		=> "Longitude",
			"desc" 		=> "Paste your DD (decimal degrees) tracking code here. <a target=\"_blank\" href=\"http://www.gps-coordinates.net/\">Click here</a> for help.",
			"id" 		=> "cc_longi",
			"std" 		=> "90.418276",
			"type" 		=> "text"
			);
		$of_options[]   = array(  
			"name"      => __("Footer Options"),
			"desc"      => "",
			"id"        => "cc_logo_opt_info",
			"std"       => "<h3 style=\"margin: 3px;color: #fff;\">Footer options</h3>",
			"icon"      => true,
			"type"      => "info"
			);

		$of_options[] = array( 	"name" 		=> "Google Analaytics Code",
			"desc" 		=> "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
			"id" 		=> "cc_google_analytics",
			"std" 		=> "",
			"type" 		=> "textarea"
			);

		$of_options[] = array( 	"name" 		=> "Footer Text",
			"desc" 		=> "Footer Copyright Text.",
			"id" 		=> "cc_footer_text",
			"std" 		=> "&copy; and All Rights Reserved 2014 <a href=\"http://codexcoder.com\">CodexCoder.Com</a>.",
			"type" 		=> "textarea"
			);
		//menubar management
					// General Settings
		$of_options[] = array( 	"name" 		=> "Menubar Settings",
			"type" 		=> "heading",
			"icon" =>	ADMIN_DIR . "assets/images/law.gif"
			);

		$of_options[] = array( 	
			"name" 		=> "Service Menu",
			"desc" 		=> "This will display as a menu",
			"id" 		=> "ccr_service_menu",
			"std" 		=> "Service",
			"type" 		=> "text"
			);
		$of_options[] = array( 	
			"name" 		=> "Portfolio Menu",
			"desc" 		=> "This will display as a menu",
			"id" 		=> "ccr_portfolio_menu",
			"std" 		=> "Portfolio",
			"type" 		=> "text"
			);
		$of_options[] = array( 	
			"name" 		=> "About Us Menu",
			"desc" 		=> "This will display as a menu",
			"id" 		=> "ccr_about_us_menu",
			"std" 		=> "About Us",
			"type" 		=> "text"
			);
		$of_options[] = array( 	
			"name" 		=> "Pricing Menu",
			"desc" 		=> "This will display as a menu",
			"id" 		=> "ccr_pricing_menu",
			"std" 		=> "Pricing",
			"type" 		=> "text"
			);
		$of_options[] = array( 	
			"name" 		=> "Team Menu",
			"desc" 		=> "This will display as a menu",
			"id" 		=> "ccr_team_menu",
			"std" 		=> "Team",
			"type" 		=> "text"
			);

		// General Settings
		$of_options[] = array( 	"name" 		=> "Work's Settings",
			"type" 		=> "heading",
			"icon" =>	ADMIN_DIR . "assets/images/db.gif"
			);
		$of_options[]   = array(  
			"name"      => __("Our work Option heading"),
			"desc"      => "",
			"id"        => "cc_logo_opt_info",
			"std"       => "<h3 style=\"margin: 3px; color: #fff; font-weight:bold;\">Our works Options</h3>",								
			"type"      => "info"
			);
		$of_options[]   = array(  
			"name"      => __("Our works section ON/OFF"),
			"desc"      => __("Our works enable here"),
			"id"        => "cc_works_enable",
			"std"		=> 1,		
			"type" 		=> "switch"																											
			);
		$of_options[] = array( 	
			"name" 		=> "Our Works",
			"desc" 		=> "You can change the title of our works",
			"id" 		=> "ccr_our_works_title",
			"std" 		=> "Our works",
			"type" 		=> "text"
			);
		
		$of_options[]   = array(  
			"name"      => __("Welcome Option heading"),
			"desc"      => "",
			"id"        => "cc_logo_opt_info",
			"std"       => "<h3 style=\"margin: 3px; color: #fff; font-weight:bold;\">Welcome massage</h3>",								
			"type"      => "info"
			);
		$of_options[]   = array(  
			"name"      => __("Welcome section ON/OFF"),
			"desc"      => __("Our works enable here"),
			"id"        => "cc_dream_enable",
			"std"		=> 1,		
			"type" 		=> "switch"																											
			);
		$of_options[] = array( 	
			"name" 		=> "Welcome massage Title",
			"desc" 		=> "You can change the title of our dream",
			"id" 		=> "ccr_our_dream_title",
			"std" 		=> "We Code to Fulfil your Dream...",
			"type" 		=> "text"
			);
		$of_options[] = array( 	
			"name" 		=> "Welcome massage Description",
			"desc" 		=> "You can change the title of our dream",
			"id" 		=> "ccr_our_dream_text",
			"std" 		=> "",
			"type" 		=> "textarea"
			);
		$of_options[] = array( 	
			"name" 		=> "Button link",
			"desc" 		=> "You can change the link of learn now",
			"id" 		=> "ccr_our_dream_learn",
			"std" 		=> "",
			"type" 		=> "text"
			);
		$of_options[] = array( 	
			"name" 		=> "Button Title",
			"desc" 		=> "You can change the link of getit",
			"id" 		=> "ccr_our_dream_getit",
			"std" 		=> "",
			"type" 		=> "text"
			);

		$of_options[] = array( 	"name" 		=> "Services Settings",
			"type" 		=> "heading",
			"icon" =>	ADMIN_DIR . "assets/images/icon-notice.png"
			);

		$of_options[]   = array(  
			"name"      => __("Service ON/OFF"),
			"desc"      => __("Slider enable here"),
			"id"        => "cc_service_enable",
			"std"		=> 1,		
			"type" 		=> "switch"																											
			);	
		$of_options[] = array( 	
			"name" 		=> "Service title",
			"desc" 		=> "You can change the title of service",
			"id" 		=> "ccr_our_service_title",
			"std" 		=> "",
			"type" 		=> "text"
			);
		$of_options[] = array( 	
			"name" 		=> "1st service title",
			"desc" 		=> "",
			"id" 		=> "ccr_our_1st_service_title",
			"std" 		=> "",
			"type" 		=> "text"
			);
		$of_options[] = array( 	
			"name" 		=> "1st service content",
			"desc" 		=> "",
			"id" 		=> "ccr_our_1st_service_content",
			"std" 		=> "",
			"type" 		=> "textarea"
			);

		$of_options[] = array( 	
			"name" 		=> "2nd service title",
			"desc" 		=> "",
			"id" 		=> "ccr_our_2nd_service_title",
			"std" 		=> "",
			"type" 		=> "text"
			);
		$of_options[] = array( 	
			"name" 		=> "2nd service content",
			"desc" 		=> "",
			"id" 		=> "ccr_our_2nd_service_content",
			"std" 		=> "",
			"type" 		=> "textarea"
			);
		$of_options[] = array( 	
			"name" 		=> "3rd service title",
			"desc" 		=> "",
			"id" 		=> "ccr_our_3rd_service_title",
			"std" 		=> "",
			"type" 		=> "text"
			);
		$of_options[] = array( 	
			"name" 		=> "3rd service content",
			"desc" 		=> "",
			"id" 		=> "ccr_our_3rd_service_content",
			"std" 		=> "",
			"type" 		=> "textarea"
			);
		$of_options[] = array( 	
			"name" 		=> "4th service title",
			"desc" 		=> "",
			"id" 		=> "ccr_our_4th_service_title",
			"std" 		=> "",
			"type" 		=> "text"
			);
		$of_options[] = array( 	
			"name" 		=> "4th service content",
			"desc" 		=> "",
			"id" 		=> "ccr_our_4th_service_content",
			"std" 		=> "",
			"type" 		=> "textarea"
			);
		$of_options[] = array( 	"name" 		=> "Portfolio",
			"type" 		=> "heading",
			"icon" =>	ADMIN_DIR . "assets/images/icon-docs.png"
			);
		$of_options[]   = array(  
			"name"      => __("Portfolio ON/OFF"),
			"desc"      => __("Portfolio enable here"),
			"id"        => "cc_portfolio_enable",
			"std"		=> 1,		
			"type" 		=> "switch"																											
			);
		$of_options[] = array( 	
			"name" 		=> "Portfolio title",
			"desc" 		=> "",
			"id" 		=> "cc_portfolio_title",
			"std" 		=> "",
			"type" 		=> "text"
			);
		$of_options[] = array( 	
			"name" 		=> "Portfolio Description",
			"desc" 		=> "Portfolio Description goes here",
			"id" 		=> "cc_portfolio_des",
			"std" 		=> "",
			"type" 		=> "textarea"
			);	
		$of_options[] = array( 	"name" 		=> "About Us & Skill",
			"type" 		=> "heading",
			"icon" =>	ADMIN_DIR . "assets/images/icon-edit.png"
			);
		$of_options[]   = array(  
			"name"      => __("About Us & Skill ON/OFF"),
			"desc"      => __("About Us & Skill section enable here"),
			"id"        => "cc_skill_enable",
			"std"		=> 1,		
			"type" 		=> "switch"																											
			);
		$of_options[]   = array(  
			"name"      => __("About Us"),
			"desc"      => "",
			"std"       => "<h3 style=\"margin: 3px;color: #fff;\">About Us</h3>",
			"icon"      => true,
			"type"      => "info"
			);
		$of_options[] = array( 	
			"name" 		=> "About US Title",
			"desc" 		=> "about us Description goes here",
			"id" 		=> "cc_about_us_title",
			"std" 		=> "",
			"type" 		=> "text"
			);
		$of_options[] = array( 	
			"name" 		=> "About US Description",
			"desc" 		=> "about us Description goes here",
			"id" 		=> "cc_about_us_des",
			"std" 		=> "",
			"type" 		=> "textarea"
			);
		$of_options[]   = array(  
			"name"      => __("skills"),
			"desc"      => "",
			"std"       => "<h3 style=\"margin: 3px;color: #fff;\">Skill</h3>",
			"icon"      => true,
			"type"      => "info"
			);
		$of_options[] = array( 	
			"name" 		=> "Skill Title",
			"desc" 		=> "Skill title goes here",
			"id" 		=> "cc_skill_title",
			"std" 		=> "",
			"type" 		=> "text"
			);
		$of_options[] = array( 	
			"name" 		=> "Skill one Title",
			"desc" 		=> "",
			"id" 		=> "cc_skill_one",
			"std" 		=> "",
			"type" 		=> "text"
			);
		$of_options[] = array( 	"name" 		=> "Skill measurement",
			"desc" 		=> "JQuery UI slider description.<br /> Min: 1, max: 100, step: 3, default value: 45",
			"id" 		=> "slider_skill_1",
			"std" 		=> "45",
			"min" 		=> "1",
			"step"		=> "3",
			"max" 		=> "100",
			"type" 		=> "sliderui" 
			);
		$of_options[] = array( 	
			"name" 		=> "Skill two title",
			"desc" 		=> "",
			"id" 		=> "cc_skill_two",
			"std" 		=> "",
			"type" 		=> "text"
			);
		$of_options[] = array( 	"name" 		=> "Skill measurement",
			"desc" 		=> "JQuery UI slider description.<br /> Min: 1, max: 100, step: 3, default value: 45",
			"id" 		=> "slider_skill_2",
			"std" 		=> "45",
			"min" 		=> "1",
			"step"		=> "3",
			"max" 		=> "100",
			"type" 		=> "sliderui" 
			);
		$of_options[] = array( 	
			"name" 		=> "Skill three title",
			"desc" 		=> "",
			"id" 		=> "cc_skill_three",
			"std" 		=> "",
			"type" 		=> "text"
			);
		$of_options[] = array( 	"name" 		=> "Skill measurement",
			"desc" 		=> "JQuery UI slider description.<br /> Min: 1, max: 100, step: 3, default value: 45",
			"id" 		=> "slider_skill_3",
			"std" 		=> "45",
			"min" 		=> "1",
			"step"		=> "3",
			"max" 		=> "100",
			"type" 		=> "sliderui" 
			);
		$of_options[] = array( 	
			"name" 		=> "Skill four title",
			"desc" 		=> "",
			"id" 		=> "cc_skill_four",
			"std" 		=> "",
			"type" 		=> "text"
			);
		$of_options[] = array( 	"name" 		=> "Skill measurement",
			"desc" 		=> "JQuery UI slider description.<br /> Min: 1, max: 100, step: 3, default value: 45",
			"id" 		=> "slider_skill_4",
			"std" 		=> "45",
			"min" 		=> "1",
			"step"		=> "3",
			"max" 		=> "100",
			"type" 		=> "sliderui" 
			);
		$of_options[] = array( 	"name" 		=> "Testimonial",
			"type" 		=> "heading",
			"icon" =>	ADMIN_DIR . "assets/images/icon-slider.png"
			);
		$of_options[]   = array(  
			"name"      => __("Testimonial ON/OFF"),
			"desc"      => __("Testimonial enable here"),
			"id"        => "cc_testimonial_enable",
			"std"		=> 1,		
			"type" 		=> "switch"																											
			);

		$of_options[]   = array(  
			"name"      => __("How many Testimonial"),
			"desc"      => __("Write the number Testimonial"),
			"id"        => "cc_testimonial_number",
			"std"		=> "",		
			"type" 		=> "text"																											
			);
		$of_options[]   = array(  
			"name"      => __("Testimonial Title"),
			"desc"      => __("Write the Testimonial Title"),
			"id"        => "cc_testimonial_title",
			"std"		=> "",		
			"type" 		=> "text"																											
			);
		$of_options[] = array( 	"name" 		=> "Team Settings",
			"type" 		=> "heading",
			"icon" =>	ADMIN_DIR . "assets/images/icon-docs.png"
			);

		$of_options[]   = array(  
			"name"      => __("Team ON/OFF"),
			"desc"      => __("Team enable here"),
			"id"        => "cc_team_enable",
			"std"		=> 1,		
			"type" 		=> "switch"																											
			);

		$of_options[]   = array(  
			"name"      => __("Team Title"),
			"desc"      => __("Write the Team Title"),
			"id"        => "cc_team_title",
			"std"		=> "",		
			"type" 		=> "text"																											
			);
		$of_options[]   = array(  
			"name"      => __("Team Description"),
			"desc"      => __("Write the Team description"),
			"id"        => "cc_team_des",
			"std"		=> "",		
			"type" 		=> "textarea"																											
			);

		$of_options[] = array( 	"name" 		=> "Slider Settings",
			"type" 		=> "heading",
			"icon" =>	ADMIN_DIR . "assets/images/slider-control.png"
			);


		$of_options[]   = array(  
			"name"      => __("Slider Option heading"),
			"desc"      => "",
			"id"        => "cc_logo_opt_info",
			"std"       => "<h3 style=\"margin: 3px; color: #fff;\">Slider Options</h3>",								
			"type"      => "info"
			);

		$of_options[]   = array(  
			"name"      => __("Slider ON/OFF"),
			"desc"      => __("Slider enable here"),
			"id"        => "cc_slider",
			"std"		=> 1,		
			"type" 		=> "switch"																											
			);

		$of_options[]   = array(  
			"name"      => __("Number Of Slider"),
			"desc"      => __("Select Number Of Slider"),
			"id"        => "cc_slider_num",
			"type" 		=> "select",
			"std"		=> 3,
			"options"	=> $other_entries														
			);

		$of_options[]   = array(  
			"name"      => __("Title Caption"),
			"desc"      => __("Show Title Caption."),
			"id"        => "cc_slider_caption",
			"std"		=> 1,
			"type" 		=> "switch"													
			);

		$of_options[]   = array(  
			"name"      => __("Slider Order"),
			"desc"      => __("Order of showing Slider."),
			"id"        => "cc_slider_order",
			"type" 		=> "select",
			"options"	=> array(
				"asc"	=> "ASC",
				"desc"	=> "DESC"
				)														
			);

		$of_options[] = array( 	"name" 		=> "Pricing table",
			"type" 		=> "heading",
			"icon" =>	ADMIN_DIR . "assets/images/icon-paint.png"
			);

		$of_options[]   = array(  
			"name"      => __("Pricing table ON/OFF"),
			"desc"      => __("Pricing table display enable here"),
			"id"        => "cc_pricing_enable",
			"std"		=> 1,		
			"type" 		=> "switch"																											
			);

		$of_options[]   = array(  
			"name"      => __("Pricing table section Title"),
			"desc"      => __("Write the pricing table section Title"),
			"id"        => "cc_pricing_title",
			"std"		=> "",		
			"type" 		=> "text"																											
			);
		$of_options[]   = array(  
			"name"      => __("Pricing table section Description"),
			"desc"      => __("Write the pricing description"),
			"id"        => "cc_pricing_des",
			"std"		=> "",		
			"type" 		=> "textarea"																											
			);


//Advanced Settings
		$of_options[] = array( 	
			"name" 		=> "Advanced Settings",
			"type" 		=> "heading"
			);

		$of_options[] = array( 	
			"name" 		=> "Excerpt Length",
			"desc" 		=> "Enter Excerpt Length in Characters. Default: 35",
			"id" 		=> "cc_custom_length",
			"std" 		=> "35",
			"type" 		=> "text"
			);

		$of_options[]   = array(  
			"name"      => __("WP Login Logo"),
			"desc"      => __("Upload Admin Logo and select from media manager."),
			"id"        => "cc_admin_logo",
			"std"       => "",
			"type"      => "upload",			                    
			"mod"       => "min"                        
			);

	// Backup Options
		$of_options[] = array( 	"name" 		=> "Backup Options",
			"type" 		=> "heading",
			"icon"		=> ADMIN_IMAGES . "icon-slider.png"
			);

		$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
			"id" 		=> "of_backup",
			"std" 		=> "",
			"type" 		=> "backup",
			"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
			);

		$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
			"id" 		=> "of_transfer",
			"std" 		=> "",
			"type" 		=> "transfer",
			"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
			);

						}//End function: of_options()
					}//End chack if function exists: of_options()
					?>
