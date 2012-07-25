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
				<!-- <?php bp_get_displayed_user_nav(); ?> -->
				<li id="activity-personal-li">
					<a href="http://foksite.dev/cuny/members/bowe/activity/" id="user-activity">Activity</a>
				</li>
				<li class="current selected" id="xprofile-personal-li">
					<a href="http://foksite.dev/cuny/members/bowe/profile/" id="user-xprofile">Profile</a>
					<ul class="profile-subnav">
						<li>
							<a href="http://foksite.dev/cuny/members/bowe/messages/">Public</a>
						</li>
						<li>
							<a href="http://foksite.dev/cuny/members/bowe/friends/">Edit</a>
						</li>
						<li>
							<a href="http://foksite.dev/cuny/members/bowe/forums/">Change Avatar</a>
						</li>			
					</ul>
				</li>
				<li id="messages-personal-li">
					<a href="http://foksite.dev/cuny/members/bowe/messages/" id="user-messages">Messages <span>16</span></a>
				</li>
				<li id="friends-personal-li">
					<a href="http://foksite.dev/cuny/members/bowe/friends/" id="user-friends">Friends <span>18</span></a>
				</li>
				<li id="groups-personal-li">
					<a href="http://foksite.dev/cuny/members/bowe/groups/" id="user-groups">Groups <span>5</span></a>
				</li>
				<li id="forums-personal-li">
					<a href="http://foksite.dev/cuny/members/bowe/forums/" id="user-forums">Forums</a>
				</li>
				<li id="settings-personal-li">
					<a href="http://foksite.dev/cuny/members/bowe/settings/" id="user-settings">Settings</a>
				</li>					
			</ul>
		</div>	
    </div>
</div>    