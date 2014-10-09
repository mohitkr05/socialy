<?php 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// If BuddyPress is not activated, switch back to the default WP theme and bail out
if ( ! function_exists( 'bp_is_active' ) ) {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	return;
}
/**
 * Define Avatar Size.
 */
if ( !defined( 'BP_AVATAR_THUMB_WIDTH' ) )
	define( 'BP_AVATAR_THUMB_WIDTH', 150 );

if ( !defined( 'BP_AVATAR_THUMB_HEIGHT' ) )
	define( 'BP_AVATAR_THUMB_HEIGHT', 150 );

/**
 * Don't show the toolbar on front end by default
 */
add_filter('show_admin_bar', '__return_false');
