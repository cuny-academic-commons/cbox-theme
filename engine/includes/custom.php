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
		global $bp;
	
		// loop all nav components
		foreach ( (array)$bp->bp_nav as $user_nav_item ) {
			// add navigation filter
			add_filter( 'bp_get_displayed_user_nav_' . $user_nav_item['css_id'], 'cbox_member_navigation_filter', 999, 2 );
		}
	}
	add_action( 'bp_setup_nav', 'cbox_member_navigation_filter_setup', 999 );
	
	/**
	 * Inject options nav onto end of active displayed user nav component
	 *
	 * @param string $html
	 * @param array $user_nav_item
	 * @return string
	 */
	function cbox_member_navigation_filter( $html, $user_nav_item )
	{
		// component slugs to show subnavs for
		$show = array(
			'activity' => true,
			'blogs' => true,
			'forums' => true
		);

		// add these slugs for logged in users viewing their own profile
		if ( bp_is_my_profile() ) {
			$show['friends'] = true;
			$show['groups'] = true;
			$show['messages'] = true;
			$show['profile'] = true;
			$show['settings'] = true;
		}

		// is slug the current component and should we show it?
		if (
			bp_is_current_component( $user_nav_item['slug'] ) &&
			array_key_exists( $user_nav_item['slug'], $show )
		) {

			// yes, need to capture options nav output
			ob_start();
	
			// run options nav template tag
			bp_get_options_nav();
	
			// grab buffer and wipe it
			$nav = ob_get_clean();
	
			// inject nav onto end of list item wrapped in special <ul>
			return preg_replace(
				'/(<\/li>.*)$/',
				'<ul class="profile-subnav">' . $nav . '</ul>' . '$1',
				$html,
				1
			);
		}
	
		// no changes
		return $html;
	}
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
}

// bbPress
if ( function_exists('is_bbpress()') )
{
	require_once( 'bbpress/setup.php' );
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



// Dashboard
require_once( 'dashboard/setup.php' );

?>