<?php
/**
 * Commons in a Box Theme: BuddyPress setup
 */

// abort if bp not active
if ( false == function_exists( 'bp_is_member' ) ) {
	// return to calling script
	return;
}

/**
 * Change Default Avatar Size
 */
if ( !defined( 'BP_AVATAR_THUMB_WIDTH' ) ) {
	define( 'BP_AVATAR_THUMB_WIDTH', 80 );
}
 
if ( !defined( 'BP_AVATAR_THUMB_HEIGHT' ) ) {
	define( 'BP_AVATAR_THUMB_HEIGHT', 80 );
}
 
if ( !defined( 'BP_AVATAR_FULL_WIDTH' ) ) {
	define( 'BP_AVATAR_FULL_WIDTH', 300 );
}
 
if ( !defined( 'BP_AVATAR_FULL_HEIGHT' ) ) {
	define( 'BP_AVATAR_FULL_HEIGHT', 300 );
}

//
// Actions
//

/**
 * Automagically set up sidebars
 */
function cbox_theme_magic_sidebars()
{
	// load requirements
	require_once 'classes/cbox-widget-setter.php';
	require_once 'buddypress/bp-sidebars.php';
	
	// auto sidebar population
	cbox_theme_populate_sidebars();
}
add_action( 'infinity_dashboard_activated', 'cbox_theme_magic_sidebars' );

/**
 * Automagically set up menus
 */
function cbox_theme_magic_menus()
{
	// load requirements
	require_once 'buddypress/bp-menus.php';

	// add our default sub-menu
	cbox_theme_add_default_sub_menu();
}
add_action( 'get_header', 'cbox_theme_magic_menus' );

/**
 * Register custom cbox widgets
 */
function cbox_theme_register_widgets()
{
	// load requirements
	require_once 'buddypress/bp-widgets.php';

	// register it
	return register_widget( "CBox_BP_Blogs_Recent_Posts_Widget" );
}
add_action( 'widgets_init', 'cbox_theme_register_widgets' );

/**
 * Add Activity Tabs on the Stream Directory
 */
function cbox_activity_tabs()
{
	if ( bp_is_activity_component() && bp_is_directory() ):
		infinity_get_template_part( 'templates/parts/activity-tabs' );
	endif;
}
add_action('open_sidebar','cbox_activity_tabs');

/**
 * Add Group Navigation Items to Group Pages
 */
function cbox_group_navigation()
{
	if ( bp_is_group() ) :
		infinity_get_template_part( 'templates/parts/group-navigation' );
	endif;
}
add_action('open_sidebar','cbox_group_navigation');

/**
 * Add Member Navigation to Member Pages
 */
function cbox_member_navigation()
{
	if ( bp_is_user() ) :
		infinity_get_template_part( 'templates/parts/member-navigation' );
	endif;
}
add_action('open_sidebar','cbox_member_navigation');

/**
 * Add a filter for every displayed user navigation item
 */
function cbox_member_navigation_filter_setup()
{
	// call helper function in core
	infinity_bp_nav_inject_options_setup();
}
add_action( 'bp_setup_nav', 'cbox_member_navigation_filter_setup', 999 );

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

//
// Helpers
//

if ( false == function_exists( 'is_activity_page' ) ) {
	/**
	 * Activity Stream Conditional
	 */
	function is_activity_page() {
		return ( bp_is_activity_component() && !bp_is_user() );
	}
}

?>