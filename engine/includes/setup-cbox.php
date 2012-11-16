<?php
#Add Homepage Sidebars (only registered on WP Single & Main Blog in MultiSite
if ( is_main_site( $blog_id ) ) 
{
	register_sidebar(array(
	'name' => 'Homepage Top Right',
	'id' => 'homepage-top-right',
	'description' => "The Top Right Widget next to the Slider",
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>'
	));
	
	register_sidebar(array(
	'name' => 'Homepage Center Widget',
	'id' => 'homepage-center-widget',
	'description' => "The Full Width Center Widget on the Homepage",
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>'
	));
	
	register_sidebar(array(
	'name' => 'Homepage Left',
	'id' => 'homepage-left',
	'description' => "The Left Widget on the Homepage",
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>'
	));
	
	register_sidebar(array(
	'name' => 'Homepage Middle',
	'id' => 'homepage-middle',
	'description' => "The Middle Widget on the Homepage",
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>'
	));

	register_sidebar(array(
	'name' => 'Homepage Right',
	'id' => 'homepage-right',
	'description' => "The right Widget on the Homepage",
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>'
	));
}

// Options page title and menu title
function cbox_menu_title() {
	return __( 'CBox Theme Options', 'cbox' );
}
add_filter( 'infinity_dashboard_menu_setup_page_title', 'cbox_menu_title' );
add_filter( 'infinity_dashboard_menu_setup_menu_title', 'cbox_menu_title' );

// BuddyPress
if ( function_exists('bp_is_member') )
{
	/**
	 * Add Activity Tabs on the Stream Directory
	 *
	 * @package Infinity
	 * @subpackage base
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
	 *
	 * @package Infinity
	 * @subpackage base
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
	 *
	 * @package Infinity
	 * @subpackage base
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
	
}

/**
 * Custom jQuery Buttons
 *
 * @package Infinity
 * @subpackage cbox
 */
function cbox_custom_buttons()
{
	// get button color option
	$cbox_button_color = infinity_option_get( 'cbox_button_color' );

	// render script tag ?>
	<script>
	// Adds color button classes to buttons depening on preset style/option
	jQuery(document).ready(function() {
			//buttons
			jQuery('.bp-primary-action,div.group-button').addClass('button white');
			jQuery('.generic-button .acomment-reply,div.not_friends').addClass('button white');
			jQuery('.bp-secondary-action, .view-post,.comment-reply-link').addClass('button white');
			jQuery('.standard-form .button,.not_friends,.group-button,.dir-form .button,.not-following,#item-buttons .group-button').addClass('<?php echo $cbox_button_color ?>');
			jQuery('input[type="submit"],.submit,#item-buttons .generic-button,#aw-whats-new-submit,.activity-comments submit').addClass('button <?php echo $cbox_button_color ?>');
			jQuery('div.pending,.dir-list .group-button,.dir-list .friendship-button').removeClass('<?php echo $cbox_button_color ?>');
			jQuery('#previous-next,#upload, div.submit,div,reply,#groups_search_submit').removeClass('<?php echo $cbox_button_color ?> button');
			jQuery('div.pending,.dir-list .group-button,.dir-list .friendship-button').addClass('white');
			jQuery('#upload').addClass('button green');
	});
	</script><?php
}
add_action( 'close_body', 'cbox_custom_buttons' );

/**
 * Compiler configuration callback, DO NOT TOUCH
 */
function infinity_compiler_config()
{
	return array(
		'output' => 'cbox-build',
		'refs' => array(
			'infinity' => 'buddypress',
			'cbox-theme' => 'master'
	));
}

/*
 * Include custom functionality.
 *
 * These will eventually become extensions!
 */

// BuddyPress
if ( function_exists('bp_is_member') )
{
	require_once( 'buddypress/bp-options.php' );
	require_once( 'buddypress/bp-widgets.php' );
	require_once( 'buddypress/bp-menus.php' );
}

// Slider
if ( is_main_site() )
{
	// load metaboxes class
	function cbox_custom_init_cmb() {
		if ( !class_exists( 'cmb_Meta_Box' ) ) {
			require_once( 'metaboxes/init.php' );
		}
	}
	add_action( 'init', 'cbox_custom_init_cmb', 9999 );

	// load slider setup
	require_once( 'feature-slider/setup.php' );
}

// Template Tags

if ( false === function_exists( 'the_post_name' ) ) {
	/**
	* Echo the post name (slug)
	*/
	function the_post_name()
	{
		// use global post
		global $post;

		// post_name property is the slug
		echo $post->post_name;
	}
}

?>
