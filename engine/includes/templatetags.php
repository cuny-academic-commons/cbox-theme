<?php
/**
 * Infinity Theme: template tags
 *
 * @author Marshall Sorenson <marshall@presscrew.com>
 * @link http://infinity.presscrew.com/
 * @copyright Copyright (C) 2010-2011 Marshall Sorenson
 * @license http://www.gnu.org/licenses/gpl.html GPLv2 or later
 * @package Infinity
 * @subpackage base
 * @since 1.0
 */

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

/**
 * Output a custom user navigation menu
 *
 * @package Infinity
 * @subpackage cbox
 */
 function cbox_user_nav() { { ?>
	<div role="navigation" id="main-menu-wrap">
		<nav class="base-menu main-menu">
			<ul class="sf-menu sf-js-enabled" id="user-header-nav">	
				<li class="notifications"><?php bp_adminbar_notifications_menu(); ?></li>
				
				<li class="header-avatar"><a title="View your Public Profile" href="<?php echo bp_get_loggedin_user_link();?>"><?php bp_loggedin_user_avatar('type=full'); ?></a></li>
				<li class="name"><a href="<?php echo bp_get_loggedin_user_link();?>"><?php echo bp_profile_field_data( array('field'=> 'First Name', 'user_id' => bp_loggedin_user_id()));?> <?php echo bp_profile_field_data( array('field'=> 'Last Name', 'user_id' => bp_loggedin_user_id()));?></a></li>
				<li class="class-year"><a href="<?php echo $site_url . '/groups/usma-' . xprofile_get_field_data( 'Class Year', bp_loggedin_user_id() );?>"><?php echo xprofile_get_field_data( 'Class Year', bp_loggedin_user_id() );?></a></li>
				<li class="divider">/</li>
				<li class="cadet-co"><a href="<?php echo site_url() . '/groups/' . strtolower(xprofile_get_field_data( 'Cadet Company', bp_loggedin_user_id() )) ?>"><?php echo xprofile_get_field_data( 'Cadet Company', bp_loggedin_user_id() );?></a></li>
				<li class="divider">|</li>
				<li class="account"><?php bp_adminbar_account_menu(); ?></li>
				<li class="divider">|</li>
				<li class="logout-button"><a href="<?php echo wp_logout_url(get_bloginfo('url')) ?>"><?php _e( 'Log Out', 'buddypress' ) ?></a></li>
			</ul>	
		</nav>
	</div>
<!-- end -->
<?php }} 
?>