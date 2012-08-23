<?php
/**
 * ICE API: feature extensions, bp hooks feature class file
 *
 * This extension is PREMIUM and purchase is required to get support!
 *
 * @author Marshall Sorenson <marshall@presscrew.com>
 * @link http://infinity.presscrew.com/
 * @copyright Copyright (C) 2010-2011 Marshall Sorenson
 * @license http://www.gnu.org/licenses/gpl.html GPLv2 or later
 * @package ICE-extensions
 * @subpackage features
 * @since 1.0
 */

ICE_Loader::load_ext( 'features/echo' );

/**
 * BuddyPress hooks feature
 *
 * @package ICE-extensions
 * @subpackage features
 */
class ICE_Ext_Feature_Bp_Hooks
	extends ICE_Ext_Feature_Echo
{

	/**
	 */
	public function check_reqs()
	{
		// is buddypress active?
		if ( true === parent::check_reqs() ) {
			return class_exists( 'BP_Component' );
		}

		return false;
	}
	
	/**
	 */
	protected function init()
	{
		// run parent init method
		parent::init();

		// init properties
		$this->title = __( 'BuddyPress Hooks', infinity_text_domain );
		$this->description = __( 'Easily inject content into BuddyPress templates which extend from Infinity Base', infinity_text_domain );
	}

	/**
	 */
	public function get_action_list()
	{
		switch ( true ) {
			case bp_is_activity_component():
				return array(
					'bp_before_directory_activity_page' => 'activity-page-before',
					'bp_after_directory_activity_page' => 'activity-page-after',
					'bp_before_directory_activity' => 'activity-before',
					'bp_after_directory_activity' => 'activity-after',
					'bp_before_directory_activity_list' => 'activity-list-before',
					'bp_after_directory_activity_list' => 'activity-list-after',
					'bp_before_directory_activity_content' => 'activity-content-before',
					'bp_after_directory_activity_content' => 'activity-content-after',
				);
			case bp_is_blogs_component():
				return array(
					'bp_before_directory_blogs_page' => 'blogs-page-before',
					'bp_after_directory_blogs_page' => 'blogs-page-after',
					'bp_before_directory_blogs' => 'blogs-before',
					'bp_after_directory_blogs' => 'blogs-after',
					'bp_before_directory_blogs_list' => 'blogs-list-before',
					'bp_after_directory_blogs_list' => 'blogs-list-after',
					'bp_before_directory_blogs_content' => 'blogs-content-before',
					'bp_after_directory_blogs_content' => 'blogs-content-after',
				);
			case bp_is_forums_component():
				return array(
					'bp_before_directory_forums_page' => 'forums-page-before',
					'bp_after_directory_forums_page' => 'forums-page-after',
					'bp_before_directory_forums' => 'forums-before',
					'bp_after_directory_forums' => 'forums-after',
					'bp_before_directory_forums_list' => 'forums-list-before',
					'bp_after_directory_forums_list' => 'forums-list-after',
					'bp_before_directory_forums_content' => 'forums-content-before',
					'bp_after_directory_forums_content' => 'forums-content-after',
					'bp_before_topics' => 'forums-topics-before',
				);
			case bp_is_groups_component():
				return array(
					'bp_before_directory_groups_page' => 'groups-page-before',
					'bp_after_directory_groups_page' => 'groups-page-after',
					'bp_before_directory_groups' => 'groups-before',
					'bp_after_directory_groups' => 'groups-after',
					'bp_before_directory_groups_list' => 'groups-list-before',
					'bp_after_directory_groups_list' => 'groups-list-after',
					'bp_before_directory_groups_content' => 'groups-content-before',
					'bp_after_directory_groups_content' => 'groups-content-after',
				);
			case bp_is_members_component():
				return array(
					'bp_before_directory_members_page' => 'members-page-before',
					'bp_after_directory_members_page' => 'members-page-after',
					'bp_before_directory_members' => 'members-before',
					'bp_after_directory_members' => 'members-after',
					'bp_before_directory_members_list' => 'members-list-before',
					'bp_after_directory_members_list' => 'members-list-after',
					'bp_before_directory_members_content' => 'members-content-before',
					'bp_after_directory_members_content' => 'members-content-after',
				);
			case bp_is_register_page():
				return array(
					'bp_before_register_page' => 'register-page-before',
					'bp_after_register_page' => 'register-page-after',
					'bp_before_registration_disabled' => 'register-disabled-before',
					'bp_after_registration_disabled' => 'register-disabled-after',
					'bp_before_account_details_fields' => 'register-account-before',
					'bp_after_account_details_fields' => 'register-account-after',
					'bp_before_signup_profile_fields' => 'register-signup-before',
					'bp_after_signup_profile_fields' => 'register-signup-after',
					'bp_before_blog_details_fields' => 'register-blog-before',
					'bp_after_blog_details_fields' => 'register-blog-after',
					'bp_before_registration_submit_buttons' => 'register-submit-before',
					'bp_after_registration_submit_buttons' => 'register-submit-after',
					'bp_before_registration_confirmed' => 'register-confirmed-before',
					'bp_after_registration_confirmed' => 'register-confirmed-after',
				);
		}
	}

}

?>
