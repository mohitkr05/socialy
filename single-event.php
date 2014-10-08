<?php get_template_part('templates/event', 'single'); ?>
<?php

global $post;

?>

<fieldset>
 	
    <input type="button" value="rsvp" name="event_userlist" id="event_userlist" value="<?php if(isset($_POST['event_userlist'])) echo $_POST['event_userlist'];?>" class="required" />
 
</fieldset>
<?php 
if($post_id) {
    // Update Custom Meta
    update_post_meta($post_id, 'event_userlist', esc_attr(strip_tags($_POST['event_userlist'])));
  
 
    // Redirect
    wp_redirect(home_url());
    exit;
} 
?>