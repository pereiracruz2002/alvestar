<?php
$themename = "Liberation";
$shortname = "lbr";
$zm_categories_obj = get_categories('hide_empty=0');
$zm_categories = array();
foreach ($zm_categories_obj as $zm_cat) {
	$zm_categories[$zm_cat->cat_ID] = $zm_cat->category_nicename;
}
$categories_tmp = array_unshift($zm_categories, "Select a category:");	
$number_entries = array("Select a Number:","1","2","3","4","5","6","7","8","9","10", "12","14", "16", "18", "20");
$options = array (

    array(  "name" => "Featured Post settings",
            "type" => "heading",
			"desc" => "This section customizes the featured posts.",
       ),

	array( 	"name" => "Featured post Category",
			"desc" => "Select the category from which you want to display featured posts.",
			"id" => $shortname."_featucat",
			"std" => "Select a category:",
			"type" => "select",
			"options" => $zm_categories),
			
	array(  "name" => "Latest posts",
            "type" => "heading",
			"desc" => "This section customizes the latest post section.",
       ),

	array( 	"name" => "Number of posts",
			"desc" => "How many posts do you want to display as latest posts.( Multiples of 3)",
			"id" => $shortname."_postnum",
			"std" => "3",
			"type" => "text",
		),
			

    array(  "name" => "Front Page categories",
            "type" => "heading",
			"desc" => "This section customizes the categories of posts to display on the front page.",
       ),

	array( 	"name" => "Frontpage category 1",
			"desc" => "Select the category from the list.",
			"id" => $shortname."_featcat1",
			"std" => "Select a category:",
			"type" => "select",
			"options" => $zm_categories),
			
	array( 	"name" => "Frontpage category 2",
			"desc" => "Select the category from the list.",
			"id" => $shortname."_featcat2",
			"std" => "Select a category:",
			"type" => "select",
			"options" => $zm_categories),

	array( 	"name" => "Frontpage category 3",
			"desc" => "Select the category from the list.",
			"id" => $shortname."_featcat3",
			"std" => "Select a category:",
			"type" => "select",
			"options" => $zm_categories),			

	array(  "name" => "Twitter widget",
            "type" => "heading",
			"desc" => " Displays a twitter widget on your sidebar .",
       ),		
	
	array("name" => "Twitter Id",
			"desc" => "Enter your twitter ID.",
            "id" => $shortname."_twit",
            "std" => "twitter",
            "type" => "text"),   

	array(  "name" => "Featured Video",
            "type" => "heading",
			"desc" => " Displays a video embedded on your sidebar .",
       ),
	   
	array("name" => "Video embed code",
			"desc" => "You can find the embed code for videos on all video sharing sites.",
            "id" => $shortname."_video",
            "std" => "Enter the video embed code here. Remember to change the size to 260 x 220 in the embed code.",
            "type" => "textarea"),   			
			
			
	array(  "name" => "About Us",
            "type" => "heading",
			"desc" => "This section customizes the About us section.",
       ),	
	
	array("name" => "About Us Image",
			"desc" => "Add an image to your About us section",
            "id" => $shortname."_img",
            "std" => "",
            "type" => "textarea"),   
			
	array("name" => "About Us Text",
			"desc" => "Write something that you want to display on the about us section.",
            "id" => $shortname."_about",
            "std" => "",
            "type" => "textarea"),   			

	array(  "name" => "125 x 125 banner Settings",
            "type" => "heading",
			"desc" => "You can setup four 125 x 125 banners on your sidebar from here",
       ), 
	   
	array("name" => "Banner-1 Image",
			"desc" => "Enter your 125 x 125 banner image url here.",
            "id" => $shortname."_banner1",
            "std" => "http://bit.ly/7iyDXQ",
            "type" => "text"),    
	   
	array("name" => "Banner-1 Url",
			"desc" => "Enter the banner-1 url here.",
            "id" => $shortname."_url1",
            "std" => "Banner-1 url",
            "type" => "text"),    
	      
	 
	array("name" => "Banner-2 Image",
			"desc" => "Enter your 125 x 125 banner image url here.",
            "id" => $shortname."_banner2",
            "std" => "http://bit.ly/7iyDXQ",
            "type" => "text"),    
	   
	array("name" => "Banner-2 Url",
			"desc" => "Enter the banner-2 url here.",
            "id" => $shortname."_url2",
            "std" => "Banner-2 url",
            "type" => "text"), 

	array("name" => "Banner-3 Image",
			"desc" => "Enter your 125 x 125 banner image url here.",
            "id" => $shortname."_banner3",
            "std" => "http://bit.ly/7iyDXQ",
            "type" => "text"),    
	   
	array("name" => "Banner-3 Url",
			"desc" => "Enter the banner-3 url here.",
            "id" => $shortname."_url3",
            "std" => "Banner-3 url",
            "type" => "text"),

	array("name" => "Banner-4 Image",
			"desc" => "Enter your 125 x 125 banner image url here.",
            "id" => $shortname."_banner4",
            "std" => "http://bit.ly/7iyDXQ",
            "type" => "text"),    
	   
	array("name" => "Banner-4 Url",
			"desc" => "Enter the banner-4 url here.",
            "id" => $shortname."_url4",
            "std" => "Banner-4 url",
            "type" => "text"),
			 		
			
			
	array(  "name" => "Banner ad",
            "type" => "heading",
			"desc" => "Setup the ad banner on posts.",
       ),
  
    array("name" => "468x60 banner on posts ",
			"desc" => "adsense 468 x 60 banner script .",
            "id" => $shortname."_ad1",
            "std" => "",
            "type" => "textarea"), 
			 
	array(  "name" => "Footer entry",
            "type" => "heading",
			"desc" => "Add stuff to footer .",
       ),
  
    array("name" => "Add any text or script to footer ",
			"desc" => "You can add your analytic code, privacy policy text etc to the footer ",
            "id" => $shortname."_foot",
            "std" => "",
            "type" => "textarea"), 
	 
);

 
function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=theme_options.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); 
                update_option( $value['id'], $value['std'] );}

            header("Location: themes.php?page=theme_options.php&reset=true");
            die;

        }
    }

      add_theme_page($themename." Options", "$themename Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}




function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
    
    
?>
<div class="wrap">
<h2><b><?php echo $themename; ?> theme options</b></h2>

<form method="post">

<table class="optiontable">

<?php foreach ($options as $value) { 
    
	
if ($value['type'] == "text") { ?>
        
<tr align="left"> 
    <th scope="row"><?php echo $value['name']; ?>:</th>
    <td>
        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" size="40" />
				
    </td>
	
</tr>
<tr><td colspan=2> <small><?php echo $value['desc']; ?> </small> <hr /></td></tr>

<?php } elseif ($value['type'] == "textarea") { ?>
<tr align="left"> 
    <th scope="row"><?php echo $value['name']; ?>:</th>
    <td>
<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="50" rows="8"/>
<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes (get_settings( $value['id'] )); } 
else { echo $value['std']; 
} ?>
</textarea>

				
    </td>
	
</tr>
<tr><td colspan=2> <small><?php echo $value['desc']; ?> </small> <hr /></td></tr>


<?php } elseif ($value['type'] == "select") { ?>

    <tr align="left"> 
        <th scope="top"><?php echo $value['name']; ?>:</th>
	        <td>
            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                <?php foreach ($value['options'] as $option) { ?>
                <option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; }?>><?php echo $option; ?></option>
                <?php } ?>
            </select>
			
        </td>
	
</tr>
<tr><td colspan=2> <small><?php echo $value['desc']; ?> </small> <hr /></td></tr>


<?php } elseif ($value['type'] == "checkbox") { ?>

    <tr align="left"> 
        <th scope="top"><?php echo $value['name']; ?>:</th>
        <td>
               
		<?php	if(get_settings($value['id'])){
							$checked = "checked=\"checked\"";
						}else{
							$checked = "";
						}
					?>   
			   
			   
      <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?>/>

        </td>
    </tr>
<tr><td colspan=2> <small><?php echo $value['desc']; ?> </small> <hr /></td></tr>

<?php } elseif ($value['type'] == "heading") { ?>

   <tr valign="top"> 
		    <td colspan="2" style="text-align: left;"><h2 style="color:green;"><?php echo $value['name']; ?></h2></td>
		</tr>
<tr><td colspan=2> <small> <p style="color:red; margin:0 0;" > <?php echo $value['desc']; ?> </P> </small> <hr /></td></tr>

<?php } ?>
<?php 
}
?>
</table>
<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
<?php
}
add_action('admin_menu', 'mytheme_add_admin'); ?>