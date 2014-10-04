<?php 
add_action( 'init', 'create_location_type' );
function create_location_type() {
	$labels = array(
    'name' => _x('Locations', 'post type general name'),
    'singular_name' => _x('Location', 'post type singular name'),
    'add_new' => _x('Add New', 'location'),
    'add_new_item' => __('Add New Location'),
    'edit_item' => __('Edit Location'),
    'new_item' => __('New Location'),
    'all_items' => __('All Locations'),
    'view_item' => __('View Location'),
    'search_items' => __('Search Locations'),
    'not_found' =>  __('No locations found'),
    'not_found_in_trash' => __('No locations found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Locations'
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields')
  ); 
 
  register_post_type('location',$args);
}
add_filter('post_updated_messages', 'create_location_type_messages');

function create_location_type_messages( $messages ) {
  global $post, $post_ID;

  $messages['location'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Location updated. <a href="%s">View location</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Location updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Location relocationd to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Location published. <a href="%s">View location</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Location saved.'),
    8 => sprintf( __('Location submitted. <a target="_blank" href="%s">Preview location</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Location scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview location</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Location draft updated. <a target="_blank" href="%s">Preview location</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

?>