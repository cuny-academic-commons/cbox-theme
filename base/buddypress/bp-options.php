<?php
/**
 * Disable the BuddyPress Widgets for Sub Blogs in MultiSite
 *
 * @package Infinity
 * @subpackage cbox
 */
function bp_hide_widgets_unregister() {

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
 *
 * @package Infinity
 * @subpackage cbox
 */
function is_activity_page() { 
	return ( bp_is_activity_component() && !bp_is_user() );
}

function cbox_forum_intro() { { ?>
<!-- html -->
<?php if ( infinity_option_get( 'cbox_forum_intro' ) ): ?>
	<div class="info-box forum-intro">
		<?php echo infinity_option_get( 'cbox_forum_intro' ); ?>
	</div>
<?php endif; ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('bp_before_topics','cbox_forum_intro');

function cbox_group_intro() { { ?>
<!-- html -->
<?php if ( infinity_option_get( 'cbox_group_intro' ) ): ?>
	<div class="info-box group-intro">
		<?php echo infinity_option_get( 'cbox_group_intro' ); ?>
	</div>
<?php endif; ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('bp_before_directory_groups_content','cbox_group_intro');

function cbox_activity_intro() { { ?>
<!-- html -->
<?php if ( infinity_option_get( 'cbox_activity_intro' ) ): ?>
	<div class="info-box activity-intro">
		<?php echo infinity_option_get( 'cbox_activity_intro' ); ?>
	</div>
<?php endif; ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('bp_before_directory_activity_list','cbox_activity_intro');

function cbox_register_intro() { { ?>
<!-- html -->
<?php if ( infinity_option_get( 'cbox_register_intro' )): ?>
	<div class="info-box register-intro">
		<?php echo infinity_option_get( 'cbox_register_intro' ); ?>
		<?php if ( infinity_option_get( 'cbox_register_facebook' ) == "yes"  ): ?>
			<?php if ( function_exists( 'jfb_output_facebook_btn' ) ): ?>
			<div id="facebook-connect-button">
			<?php jfb_output_facebook_btn(); ?>
			</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
<?php endif; ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('bp_before_account_details_fields','cbox_register_intro');

function cbox_member_intro() { { ?>
<!-- html -->
<?php if ( infinity_option_get( 'cbox_member_intro' ) ): ?>
	<div class="info-box member-intro">
		<?php echo infinity_option_get( 'cbox_member_intro' ); ?>
	</div>
<?php endif; ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('bp_before_directory_members_content','cbox_member_intro');

//Default Profile Avatars
function bn_new_mysteryman () {
return infinity_option_image_url( 'cbox_default_avatar' );
}
add_filter('bp_core_mysteryman_src','bn_new_mysteryman',2,7 );

//Default Group Avatar
function my_default_get_group_avatar($avatar) {
global $bp, $groups_template;
if( strpos($avatar,'group-avatars') ) {
return $avatar;
}
else {
$custom_avatar = infinity_option_image_url( 'cbox_default_group_avatar' );

if($bp->current_action == "")
return '<img width="'.BP_AVATAR_THUMB_WIDTH.'" height="'.BP_AVATAR_THUMB_HEIGHT.'" src="'.$custom_avatar.'" class="avatar" alt="' . esc_attr( $groups_template->group->name ) . '" />';
else
return '<img width="'.BP_AVATAR_FULL_WIDTH.'" height="'.BP_AVATAR_FULL_HEIGHT.'" src="'.$custom_avatar.'" class="avatar" alt="' . esc_attr( $groups_template->group->name ) . '" />';
}
}
add_filter( 'bp_get_group_avatar', 'my_default_get_group_avatar');

/* Protects BuddyPress pages from being access by non-registered members. Thanks to Travel-Junkie for this code snippet provided on BP.org: http://bit.ly/9uUpwE */
function cbox_buddypress_protect() { { ?>
<?php if ( infinity_option_get( 'cbox_buddypress_protect' ) == "on" ): ?>
<?php
	global $bp;
	if( bp_is_register_page() || bp_is_activation_page() )
		return;

	if( ! bp_is_blog_page() && ! is_user_logged_in() )
		bp_core_redirect( $bp->root_domain .'/'. BP_REGISTER_SLUG );
?>
<?php endif; ?>
<?php }} 
// Hook into action
add_action( 'get_header', 'cbox_buddypress_protect' );
?>