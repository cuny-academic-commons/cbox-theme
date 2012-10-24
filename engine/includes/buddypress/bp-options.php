<?php

/**
 * Change Default Avatar Size
 */
if ( !defined( 'BP_AVATAR_THUMB_WIDTH' ) )
define( 'BP_AVATAR_THUMB_WIDTH', 80 );
 
if ( !defined( 'BP_AVATAR_THUMB_HEIGHT' ) )
define( 'BP_AVATAR_THUMB_HEIGHT', 80 );
 
if ( !defined( 'BP_AVATAR_FULL_WIDTH' ) )
define( 'BP_AVATAR_FULL_WIDTH', 300 );
 
if ( !defined( 'BP_AVATAR_FULL_HEIGHT' ) )
define( 'BP_AVATAR_FULL_HEIGHT', 300 );


if ( false == function_exists( 'is_activity_page' ) ) {
	/**
	 * Activity Stream Conditional
	 */
	function is_activity_page() { 
		return ( bp_is_activity_component() && !bp_is_user() );
	}
}

/**
 * Render tour feature markup
 */
function cbox_buddypress_tour()
{
	if ( bp_is_activity_component() && !bp_is_user() && is_user_logged_in() ) {
		infinity_feature( 'cbox-buddypress-tour' );
	}
}
add_action( 'close_body', 'cbox_buddypress_tour' );
?>