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
	'name' => 'Homepage right',
	'id' => 'homepage-right',
	'description' => "The right Widget on the Homepage",
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>'
	));
}
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
		// is slug the current component?
		if ( bp_is_current_component( $user_nav_item['slug'] ) ) {
	
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
function infinity_buttons() { { 
$cbox_button_color = infinity_option_get( 'cbox_button_color' );
?>
<!-- html -->
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
</script>
<!-- end -->
<?php }} 
// Hook into action
add_action('close_body','infinity_buttons');

/*
 * Include custom functionality.
 *
 * These will eventually become extensions!
 */

// BuddyPress
if ( function_exists('bp_is_member') )
{
	require_once( 'buddypress/bp-options.php' );
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
	function be_initialize_cmb_meta_boxes() {
		if ( !class_exists( 'cmb_Meta_Box' ) ) {
			require_once( 'metaboxes/init.php' );
		}
	}
	add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
	// load slider setup
	require_once( 'feature-slider/setup.php' );
}

// Responsive *turn this into a feature class*
require_once( 'responsive/setup.php' );

// Dashboard
require_once( 'dashboard/setup.php' );

?>