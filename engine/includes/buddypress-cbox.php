<?php
/**
 * Commons In A Box Theme: BuddyPress setup
 */

// abort if bp not active
if ( false == function_exists( 'buddypress' ) ) {
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

/*
 * Tell BuddyPress to use bp-legacy template pack.
 *
 * Even though we are using a bp-default-derived theme, there are some places
 * where theme compatibility creeps in, namely photo upload functionality.
 * As of BuddyPress 3.0, bp-nouveau is the default template pack. However,
 * photo uploads do not work with bp-nouveau and bp-default themes. So tell,
 * BP to use bp-legacy.
 *
 * See https://buddypress.trac.wordpress.org/ticket/7905
 *
 * @todo Remove after BuddyPress 3.2.0 or 4.0.0, whichever comes first.
 */
add_theme_support( 'buddypress-use-legacy' );

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
	if ( bp_is_active( 'blogs' ) ) {
		register_widget( "CBox_BP_Blogs_Recent_Posts_Widget" );
	}
}
add_action( 'widgets_init', 'cbox_theme_register_widgets' );

/**
 * Enqueue scripts meant for certain BuddyPress pages.
 */
add_action( 'bp_enqueue_scripts', function() {
	if ( bp_is_register_page() || bp_is_user_settings_general() ) {
		wp_enqueue_script( 'user-profile' );
	}
} );

/**
 * Add Activity Tabs on the Stream Directory
 */
function cbox_theme_activity_tabs()
{
	if ( bp_is_activity_component() && bp_is_directory() ):
		infinity_get_template_part( 'templates/parts/activity-tabs' );
	endif;
}
add_action( 'open_sidebar', 'cbox_theme_activity_tabs' );

/**
 * Add Group Navigation Items to Group Pages
 */
function cbox_theme_group_navigation()
{
	if ( bp_is_group() ) :
		cbox_populate_group_global();
		infinity_get_template_part( 'templates/parts/group-navigation' );
	endif;
}
add_action( 'open_sidebar', 'cbox_theme_group_navigation' );

/**
 * Add Member Navigation to Member Pages
 */
function cbox_theme_member_navigation()
{
	if ( bp_is_user() ) :
		infinity_get_template_part( 'templates/parts/member-navigation' );
	endif;
}
add_action( 'open_sidebar', 'cbox_theme_member_navigation' );

/**
 * Add a filter for every displayed user navigation item
 */
function cbox_theme_member_navigation_filter_setup()
{
	// call helper function in core
	infinity_bp_nav_inject_options_setup();
}
add_action( 'bp_setup_nav', 'cbox_theme_member_navigation_filter_setup', 999 );

/**
 * Filter the options nav on a user's profile only.
 *
 * We want to remove the options nav on user pages because Infinity does a
 * neat job in nesting child items under the parent nav menu.
 */
function cbox_theme_remove_user_options_nav() {
	global $bp;

	$bp->cbox_theme = new stdClass;
	$bp->cbox_theme->removed_nav_items = array();

	// BP 2.6+
	if ( function_exists( 'bp_core_get_directory_page_id' ) ) {
		$nav = $bp->members->nav->get_secondary( array( 'parent_slug' => bp_current_component() ) );
	} else {
		$current_component = bp_current_component();
		$nav               = $bp->bp_options_nav[ $current_component ];
	}

	foreach ( $nav as $component => $nav_item ) {

		switch ( $component ) {
			// remove everything by default
			// in the future, we could do this on a component-by-component basis
			// but we probably won't have to do this.
			default :
				// get all 'css_id' values as the options nav filter relies on this
				$bp->cbox_theme->removed_nav_items[] = $nav_item['css_id'];

				add_filter(
					'bp_get_options_nav_' . $nav_item['css_id'],
					'__return_false'
				);

				break;
		}
	}
}
add_action( 'bp_before_member_body', 'cbox_theme_remove_user_options_nav' );

/**
 * Reinstate the options nav on a user's profile.
 *
 * {@link cbox_theme_remove_user_options_nav()} removes the options nav, but we
 * need to reinstate it so {@link infinity_bp_nav_inject_options_filter()}
 * can do its nesting thang in the sidebar.
 *
 * The sidebar gets rendered after the regular options nav, which is why
 * we have to do this.
 */
function cbox_theme_reinstate_user_options_nav() {
	global $bp;

	if ( empty( $bp->cbox_theme->removed_nav_items ) ) {
		return;
	}

	foreach ( (array) $bp->cbox_theme->removed_nav_items as $options_nav_item ) {
		remove_filter(
			'bp_get_options_nav_' . $options_nav_item,
			'__return_false'
		);
	}
}
add_action( 'bp_after_member_body', 'cbox_theme_reinstate_user_options_nav' );

/**
 * Render tour feature markup
 */
function cbox_theme_buddypress_tour()
{
	if ( bp_is_activity_component() && !bp_is_user() && is_user_logged_in() ) {
		infinity_feature( 'cbox-buddypress-tour' );
	}
}
add_action( 'close_body', 'cbox_theme_buddypress_tour' );

/**
 * Temporarily fix the "New Topic" button when using bbPress with BP.
 *
 * @todo Remove this when bbPress addresses this.
 */
function cbox_fix_bbp_new_topic_button() {
	// If groups component or bbPress isn't active, stop now!
	if ( ! bp_is_active( 'groups' ) || ! function_exists( 'bbpress' ) ) {
		return;
	}

	// Version of bp_is_group_forum() that works with bbPress 2.
	$is_group_forum = bp_is_single_item() && bp_is_groups_component() && bp_is_current_action( 'forum' );
	$is_group_topic = $is_group_forum && bp_is_action_variable( 'topic' );

	// If these conditions are met, this button should not be displayed.
	if ( ! is_user_logged_in() || ! $is_group_forum || $is_group_topic || bp_group_is_user_banned( groups_get_current_group() ) ) {
		return;
	}

	// Add our customized 'New Topic' button.
	add_action( 'bp_group_header_actions', function() {
		// Do not show in sidebar.
		if ( did_action( 'open_sidebar' ) ) {
			return;
		}

		// Render the button.
		bp_button( array(
			'id'                => 'new_topic',
			'component'         => 'groups',
			'must_be_logged_in' => true,
			'block_self'        => true,
			'wrapper_class'     => 'group-button',
			'link_href'         => '#new-post',    // anchor modified
			'link_class'        => 'group-button', // removed a link_class here
			'link_id'           => 'new-topic-button',
			'link_text'         => __( 'New Topic', 'buddypress' ),
			'link_title'        => __( 'New Topic', 'buddypress' ),
		) );
	} );

}
add_action( 'bp_actions', 'cbox_fix_bbp_new_topic_button' );

/**
 * Make sure BuddyPress items that are attached to 'bp_head' are added to CBOX
 * Theme.
 *
 * 'bp_head' is a hook that is hardcoded in bp-default's header.php.  So we
 * add the same hook here attached to the 'wp_head' action.
 *
 * This hook is used by BP to add activity item feeds.  Other plugins like
 * BuddyPress Courseware also uses this hook.
 */
function cbox_add_bp_head() {
	do_action( 'bp_head' );
}
add_action( 'wp_head', 'cbox_add_bp_head' );

/**
 * Populate the $groups_template global for use outside the loop
 *
 * We build the group navigation outside the groups loop. In order to use BP's
 * group template functions while building the nav, we must have the template
 * global populated. In this function, we fill in any missing data, based on
 * the current group.
 *
 * This issue should be fixed more elegantly upstream in BuddyPress, ideally
 * by making the template functions fall back on the current group when the
 * loop global is not populated.
 *
 * @see cbox-theme#155
 */
function cbox_populate_group_global() {
	global $groups_template;

	if ( bp_is_group() && isset( $groups_template->groups[0]->group_id ) && empty( $groups_template->groups[0]->name ) ) {
		$current_group = groups_get_current_group();

		// Fill in all missing properties
		foreach ( $current_group as $cur_key => $cur_value ) {
			if ( ! isset( $groups_template->groups[0]->{$cur_key} ) ) {
				$groups_template->groups[0]->{$cur_key} = $cur_value;
			}
		}
	}
}

/**
 * When running BuddyPress Docs, don't allow theme compatibility mode to kick in
 *
 * @since 1.0.5
 */
add_filter( 'bp_docs_do_theme_compat', '__return_false' );

/**
 * Output a comma-delimited list of all profile field IDs.
 *
 * Subject to removal after BuddyPress address #5666.
 *
 * @since 1.0.8
 * @deprecated 1.2.0
 */
function cbox_theme_the_profile_group_field_ids() {
	bp_the_profile_field_ids();
}

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

/*
 * Adds proper <label> to directory search forms.
 *
 * Default BuddyPress directory search form labels uses the <label> element
 * improperly.  Labels require some form of text for accessibility.
 *
 * @link https://github.com/cuny-academic-commons/cbox-theme/issues/261
 *
 * @param  string $retval Current directory search form HTML markup.
 * @return string
 */
function cbox_theme_replace_directory_search_form_label( $retval ) {
	// Get current component.
	$component = str_replace( array( 'bp_directory_', '_search_form' ), '', current_filter() );

	// Default search text is our label.
	$label = bp_get_search_default_text( $component );

	// Remove ellipsis... eek.
	$label = str_replace( '...', '', $label );

	// Add screen reader text.
	$retval = str_replace(
		'<label for="' . $component . '_search">',
		'<label for="' . $component . '_search"><span class="screen-reader-text">' . $label . '</span>',
		$retval
	);

	return $retval;
}
add_filter( 'bp_directory_members_search_form', 'cbox_theme_replace_directory_search_form_label' );
add_filter( 'bp_directory_blogs_search_form',   'cbox_theme_replace_directory_search_form_label' );
add_filter( 'bp_directory_groups_search_form',  'cbox_theme_replace_directory_search_form_label' );
