<?php
/**
 * Create a nice and simple BuddyPress Navigation Widget
 *
 * @author Bowe Frankema <bowe@presscrew.com>
 * @link http://shop.presscrew.com/
 * @copyright Copyright (C) 2010-2011 Bowe Frankema
 * @license http://www.gnu.org/licenses/gpl.html GPLv2 or later
 */ 
class BalanceBPWidget extends WP_Widget {
 
    function BalanceBPWidget() {
          $widget_ops = array( 'classname' => 'balance_bp_profile_widget', 'description' => __( "Displays a basic member widget" ) );
          $this->WP_Widget('BalanceBPWidget', __('Balance BP Member Widget'), $widget_ops);
    }
 
    function widget($args, $instance) {
          extract($args);
?>
<!-- html -->
<?php
	if (is_user_logged_in()) :
				do_action('bp_before_sidebar_me'); ?>
<div id="bp-profile-widget" class="widget">
				
				<div id="sidebar-me">
								
				<div id="user-info">
					<ul id="bp-avatar">
						<li><a title="View your Public Profile" href="<?php echo bp_get_loggedin_user_link();?>"><?php bp_loggedin_user_avatar('type=full'); ?></li></a>
					</ul>
					<ul id="bp-profile">
						<li class="bp-module-link"><a href="<?php echo bp_loggedin_user_domain() . BP_XPROFILE_SLUG ?>/edit">Edit Profile</a></li>
						<li class="bp-module-link"><a href="<?php echo bp_loggedin_user_domain() . BP_XPROFILE_SLUG ?>/change-avatar">Change Picture</a></li>
						<li class="bp-module-link"><a href="<?php echo bp_loggedin_user_domain() ?>settings/general">Change Email / Password</a></li>
						<li class="bp-module-link"><a href="<?php echo wp_logout_url( bp_get_root_domain() ) ?>"><?php _e( 'Log Out', 'buddypress' ) ?></a></li>
					</ul>
				</div>	
			<?php do_action('bp_sidebar_me'); ?>
				</div>
				</div>
				<?php do_action('bp_after_sidebar_me');
			
			/***** If the user is not logged in, show the log form and account creation link *****/
			
			else :
			
				do_action('bp_before_sidebar_login_form'); ?>
				
				<div id="bp-login-widget" class="widget">
								
									<h4>
Sign in below!
							
					</h4>
				
				<form name="login-form" id="sidebar-login-form" class="standard-form" action="<?php echo site_url('wp-login.php', 'login-post'); ?>" method="post">
					<label><?php _e('Username', 'buddypress'); ?><br />
					<input type="text" name="log" id="side-user-login" class="input" value="<?php echo esc_attr(stripslashes($user_login)); ?>" /></label>
					
					<label><?php _e('Password', 'buddypress'); ?><br />
					<input type="password" name="pwd" id="sidebar-user-pass" class="input" value="" /></label>
					
					<div class="sidebar-login-button"><label><input name="rememberme" type="checkbox" id="sidebar-rememberme" value="forever" /><?php _e('Remember Me', 'buddypress'); ?></label></div>
					
					<?php do_action('bp_sidebar_login_form'); ?>
					<input type="submit" name="wp-submit" id="sidebar-wp-submit" value="<?php _e('Log In'); ?>" tabindex="100" />
					<input type="hidden" name="testcookie" value="1" />
				</form>
				<div id="bp-connect-buttons">
				<?php do_action('bp_after_sidebar_login_form');?>
				</div>
				</div>
				<?php endif;?>	

<!-- end -->       

          
<?php
    }
 
 
    function update($new_instance, $old_instance) {
            return $new_instance;
    }
 
}
add_action('widgets_init', create_function('', 'return register_widget("BalanceBPWidget");'));
?>