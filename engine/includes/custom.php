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
		jQuery('input[type="submit"],.submit,#item-buttons .generic-button,#aw-whats-new-submit,.activity-comments submit,#item-header-content .activity').addClass('button <?php echo $cbox_button_color ?>');
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
?>
