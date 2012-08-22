<div id="profile-navigation">     
    <div id="profile_sidebar">
		<div id="item-header-avatar">
			<a href="<?php bp_user_link(); ?>"><?php bp_displayed_user_avatar( 'type=full' ); ?></a>
		</div><!-- #item-header-avatar -->

  		<?php /* Show Quick Menu for own Profile page */ if ( bp_is_my_profile() ) : ?>
        <div id="profile-nav-menu">
            <?php $userLink = bp_get_loggedin_user_link();?>
            <ul>
                <li id="edit-profile">
                	<a href="<?php echo $userLink; ?>profile/edit">Edit My Profile</a>
                </li>
                <li id="edit-avatar">
                	<a href="<?php echo $userLink; ?>profile/change-avatar">Change Avatar</a>
                </li>
                <li id="edit-password">
                	<a href="<?php echo $userLink; ?>settings">Email/Password settings</a>
                </li>
                <li id="become-premium">
                	<a href="<?php echo $userLink; ?>settings/notifications/">Profile settings</a>
                </li>
            </ul>
        </div>  
		<?php endif; ?>
		<!-- Profile Tabs -->
		<div class="sidebar-activity-tabs no-ajax" id="subnav" role="navigation">
			<ul>
				<?php bp_get_displayed_user_nav(); ?>
			</ul>
		</div>	
    </div>
</div>    