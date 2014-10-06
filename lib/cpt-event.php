<?php 
add_action( 'init', 'create_event_type' );
function create_event_type() {
	$labels = array(
    'name' => _x('Events', 'post type general name'),
    'singular_name' => _x('Event', 'post type singular name'),
    'add_new' => _x('Add New', 'event'),
    'add_new_item' => __('Add New Event'),
    'edit_item' => __('Edit Event'),
    'new_item' => __('New Event'),
    'all_items' => __('All Events'),
    'view_item' => __('View Event'),
    'search_items' => __('Search Events'),
    'not_found' =>  __('No events found'),
    'not_found_in_trash' => __('No events found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Events'
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
	'taxonomies' => array ('event_category','location'),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields')
  ); 
 
  register_post_type('event',$args);
}


add_filter('post_updated_messages', 'create_event_type_messages');


function create_event_type_messages( $messages ) {
  global $post, $post_ID;

  $messages['event'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Event updated. <a href="%s">View event</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Event updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Event reeventd to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Event published. <a href="%s">View event</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Event saved.'),
    8 => sprintf( __('Event submitted. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview event</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Event draft updated. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

//Configure the metaboxes

add_filter( 'cmb2_meta_boxes', 'cmb2_event_metaboxes' );

function cmb2_event_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'event_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['event_metabox'] = array(
		'id'            => 'event_metabox',
		'title'         => __( 'Event Metabox', 'cmb2' ),
		'object_types'  => array( 'event', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'        => array(
	 array(
				'name' => __( 'Event Timing', 'cmb2' ),
				'desc' => __( 'This is a title description', 'cmb2' ),
				'id'   => $prefix . 'timing',
				'type' => 'title',
			),
			array(
				'name' => __( 'Event Start Date and time', 'cmb2' ),
				'desc' => __( 'Please select the event start date and time', 'cmb2' ),
				'id'   => $prefix . 'start_time',
				'type' => 'text_datetime_timestamp',
			),
			
			array(
				'name' => __( 'Event End Date and time', 'cmb2' ),
				'desc' => __( 'Please select the event end date and time', 'cmb2' ),
				'id'   => $prefix . 'end_time',
				'type' => 'text_datetime_timestamp',
			),
			
			 array(
				'name' => __( 'Organiser', 'cmb2' ),
				'desc' => __( 'Event Organiser', 'cmb2' ),
				'id'   => $prefix . 'organiser',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Booking URL', 'cmb2' ),
				'desc' => __( 'Booking URL or website of Organiser', 'cmb2' ),
				'id'   => $prefix . 'url',
				'type' => 'text_url',
				// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Ticket Price', 'cmb2' ),
				'desc' => __( 'The basic ticket price', 'cmb2' ),
				'id'   => $prefix . 'price',
				'type' => 'text_money',
				'before_field' => 'INR', // override '$' symbol if needed
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Video', 'cmb2' ),
				'desc' => __( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'cmb2' ),
				'id'   => $prefix . 'embed',
				'type' => 'oembed',
			),
			array(
				'name' => __( 'Attending Users', 'cmb2' ),
				'desc' => __( 'List of attending users', 'cmb2' ),
				'id'   => $prefix . 'userlist',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Venue', 'cmb2' ),
				'desc' => __( 'The venue of the event', 'cmb2' ),
				'id'   => 'geo_address',
				'type' => 'pw_map',
    			'sanitization_cb' => 'pw_map_sanitise',
			),
			 array(
				'name' => __( 'Lattitude', 'cmb2' ),
				'desc' => __( 'The lattitude and longitude', 'cmb2' ),
				'id'   => 'geo_lattitude',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			 array(
				'name' => __( 'Longitude', 'cmb2' ),
				'desc' => __( 'The venue of the event', 'cmb2' ),
				'id'   => 'geo_longitude',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			
			array(
				'name'    => __( 'Event Display Colour', 'cmb2' ),
				'desc'    => __( 'Display colour of event on frontend', 'cmb2' ),
				'id'      => $prefix . 'frontcolor',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
			
		),
	);

	
	return $meta_boxes;
}

add_action( 'init', 'create_event_cat_tax' );
add_action( 'init', 'create_location_cat_tax' );

function create_event_cat_tax() {
	register_taxonomy(
		'event-category',
		'event',
		array(
			'label' => __( 'Event Category' ),
			'rewrite' => array( 'slug' => 'event-category' ),
			'hierarchical' => true,
		)
	);
}
function create_location_cat_tax() {
	register_taxonomy(
		'location',
		'event',
		array(
			'label' => __( 'Location' ),
			'rewrite' => array( 'slug' => 'location' ),
			'hierarchical' => true,
		)
	);
}


?>