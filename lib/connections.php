<?php 


//Connect Event with locations

function events_locations() {
	// Make sure the Posts 2 Posts plugin is active.
	if ( !function_exists( 'p2p_register_connection_type' ) )
		return;

	p2p_register_connection_type( array(
		'id' => 'events_to_locations',
		'from' => 'event',
		'to' => 'location'
	) );
}
add_action( 'init', 'events_locations', 100 );

?>