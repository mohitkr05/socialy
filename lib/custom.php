<?php
/**
 * Custom functions
 */
add_filter('roots_wrap_base', 'roots_wrap_base_cpts'); // Add our function to the roots_wrap_base filter

  function roots_wrap_base_cpts($templates) {
    $cpt = get_post_type(); // Get the current post type
    if ($cpt) {
       array_unshift($templates, 'base-' . $cpt . '.php'); // Shift the template to the front of the array
    }
	 
	if(is_buddypress()) {
		 array_unshift($templates, 'base-buddypress.php'); // Shift the template to the front of the array
		 
	 }  
    return $templates; // Return our modified array with base-$cpt.php at the front of the queue
	  
	
  }





// Use your own external URL logo link
function wpc_url_login(){
	return "http://socialy.in/"; // your URL here


}
add_filter('login_headerurl', 'wpc_url_login');
 

function remove_dashboard_widgets() {
    // Globalize the metaboxes array, this holds all the widgets for wp-admin

    global $wp_meta_boxes;
    //remove all default dashboard apps
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);



}

 
// Hoook into the 'wp_dashboard_setup' action to register our function

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');
//Add webconnect dashboard widget

//Remove update notifications
add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );

//Change posts name
// hook the translation filters
add_filter( 'gettext', 'change_post_to_article' );
add_filter( 'ngettext', 'change_post_to_article' );

function change_post_to_article( $translated ) {
$translated = str_ireplace( 'Post', 'Blog Post', $translated ); // ireplace is PHP5 only
return $translated;
}

// Do not display the admin bar
function wps_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    $wp_admin_bar->remove_menu('view-site');
 $wp_admin_bar->remove_menu('updates');

}
add_action( 'wp_before_admin_bar_render', 'wps_admin_bar' );

//Custom colours

//Remove 
remove_action('wp_head', 'wp_generator');

// Custom WordPress Login Logo
function login_css() {
wp_register_style('login_css', get_template_directory_uri() . '/assets/css/login.css', '', '20140506', 'all' );
	wp_enqueue_style( 'login_css');

}
add_action('login_head', 'login_css');

// Custom WordPress Footer
function remove_footer_admin () {
	echo '<strong>&copy; 2012 - <a href="http://socialy.in">Socialy a Project by Web Connect Digital Services</a> - For Support please contact  - Support at <a href="mailto:business@socialy.in">business@socialy.in</a></strong>';
}
add_filter('admin_footer_text', 'remove_footer_admin');




// Redefine user notification function
if ( !function_exists('wp_new_user_notification') ) {
    function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
        $user = new WP_User($user_id);

        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);

        $message  = sprintf(__('New user registration on  %s:'), get_option('blogname')) . "\r\n\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
        $message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";

        @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), get_option('blogname')), $message);

        if ( empty($plaintext_pass) )
            return;

        $message  = __('Hi there,') . "\r\n\r\n";
        $message .= sprintf(__("Welcome to %s! Here's how to log in:"), get_option('blogname')) . "\r\n\r\n";
        $message .= wp_login_url() . "\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n";
        $message .= sprintf(__('Password: %s'), $plaintext_pass) . "\r\n\r\n";
        $message .= sprintf(__('If you have any problems, please contact me at %s.'), get_option('admin_email')) . "\r\n\r\n";
        $message .= __('Adios!');

        wp_mail($user_email, sprintf(__('[%s] Your username and password'), get_option('blogname')), $message);

    }
}

    //email from name function
function my_wp_mail_from_name($name) {
    return 'Team Socialy';
}

//email from email function
function my_wp_mail_from($content_type) {
  return 'no-reply@socialy.in';
}

add_filter('wp_mail_from','my_wp_mail_from');
add_filter('wp_mail_from_name','my_wp_mail_from_name');



// Function for the related events

function display_related_events($post) {
 
//Get array of terms
$terms = get_the_terms( $post->ID , 'category', 'string');
//Pluck out the IDs to get an array of IDS
$term_ids = wp_list_pluck($terms,'term_id');

//Query posts with tax_query. Choose in 'IN' if want to query posts with any of the terms
//Chose 'AND' if you want to query for posts with all terms
  $second_query = new WP_Query( array(
      'post_type' => 'event',
      'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'id',
                        'terms' => $term_ids,
                        'operator'=> 'IN' //Or 'AND' or 'NOT IN'
                     )),
      'posts_per_page' => 3,
      'ignore_sticky_posts' => 1,
      'orderby' => 'rand',
      'post__not_in'=>array($post->ID)
   ) );

    if($second_query->have_posts()) { ?>
		<div class="well row">
     <?php while ($second_query->have_posts() ) : $second_query->the_post(); ?>
      <div class="single related col-xs-6 col-md-4">
           <?php if (has_post_thumbnail()) { ?>
            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"> <?php 
				  the_post_thumbnail( 'related_sm', array( 'class' => 'img-responsive thumbnail img-home-portfolio' ,'alt' => get_the_title()) );  		?>
				<h4><?php the_title(); ?></h4>
									 </a>
            <?php } else { ?>
                 <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            <?php } ?>
       </div>
   <?php endwhile; wp_reset_query(); ?>
									 </div>
  <?php  }
	
}

 

// Define what post types to search
function searchAll( $query ) {
	if ( $query->is_search ) {
		$query->set( 'post_type', array( 'post', 'page', 'feed', 'event', 'location'));
	}
	return $query;
}

// The hook needed to search ALL content
add_filter( 'the_search_query', 'searchAll' );
 


// Page views on Events

 
function setAndViewPostViews($postID) {
    $count_key = 'event_views';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
    return $count; /* so you can show it */
}


	/*
// Display the RSVP button
<fieldset>

    <input type="button" value="rsvp" name="event_userlist" id="event_userlist" value="<?php if(isset($_POST['event_userlist'])) echo $_POST['event_userlist'];?>" class="required" />
	
	
	<?php 
function can_register_for_event($post) {
	$data = unserialize(get_post_meta($post->ID, 'event_userlist', true));
	  
	  // If no one has registered or if the id is not found in the field
	if(( count($data) != 0 ) || ( !in_array( $current_user->ID, $data ) )) {
	
		echo  '<a class="btn btn-primary btn-lg" href=" '. register_for_event() .'">Register for Event</a> <br/><br/><hr>';
		
	}
		
	
}


  //Function to register for the event 
 function register_for_event($post) {
 	global $user , $post;
	$data = unserialize(get_post_meta($post->ID, 'event_userlist', true));
	if( count($data) != 0 ) {
	if ( !in_array( $current_user->ID, $data ) ) {
	$data[] = $current_user->ID;
	}
	$data = array_unique($data); // remove duplicates
	sort( $data ); // sort array
	$data = serialize($data);
	update_post_meta($post->ID, 'event_userlist', $data);
} else {
	$data = array();
		$data[0] = $current_user->ID;
		$data = serialize($data);
		update_post_meta($post->ID, 'event_userlist', $data);
	}	
} 
*/
?>