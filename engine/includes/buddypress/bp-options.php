<?php
/**
 * Disable the BuddyPress Widgets for Sub Blogs in MultiSite
 */
function balance_hide_bp_widgets() {

  //ignore main site
  if (is_main_site())
    return;

    add_action('widgets_init', create_function('', 'return unregister_widget("BP_Blogs_Recent_Posts_Widget");'), 21 ); //run after bp
	
    add_action('widgets_init', create_function('', 'return unregister_widget("BP_Groups_Widget");'), 21 ); //run after bp

    add_action('widgets_init', create_function('', 'return unregister_widget("BP_Core_Members_Widget");'), 21 ); //run after bp

    add_action('widgets_init', create_function('', 'return unregister_widget("BP_Core_Whos_Online_Widget");'), 21 ); //run after bp

    add_action('widgets_init', create_function('', 'return unregister_widget("BP_Core_Recently_Active_Widget");'), 21 ); //run after bp

}

/**
 * Add Activity Stream Conditional
 */
function is_activity_page() { 
	return ( bp_is_activity_component() && !bp_is_user() );
}

/**
 * Render tour feature markup
 */
function balance_buddypress_tour()
{
	if ( bp_is_activity_component() && !bp_is_user() && is_user_logged_in() ) {
		infinity_feature( 'balance-buddypress-tour' );
	}
}
add_action( 'close_body', 'balance_buddypress_tour' );
?>