<?php
/**
 * Add the extra Div for the tour!
 *
 * @package Infinity
 * @subpackage cbox
 */
function infinity_tour_activity() { { ?>
<!-- html -->
	<div align="center" id="activity-tour"></div>
<!-- end -->
<?php }} 
// Hook into action
add_action('bp_before_activity_loop','infinity_tour_activity');

/**
 * Load the tour JS on Activity Pages
 *
 * @package Infinity
 * @subpackage cbox
 */
function infinity_activity_tour_css() { { ?>
<?php if ( bp_is_activity_component() && !bp_is_user() && is_user_logged_in() ) : ?>
	<style type="text/css">
	#activity-tour {
		left: 30%;
		position: relative;
		top: 211px;
	}
	</style>	
<?php endif; // end primary widget area ?>
<?php }} 
// Hook into action
add_action('wp_head','infinity_activity_tour_css');


/**
 * The Actual Content for the ToolTips
 *
 * @package Infinity
 * @subpackage cbox
 */
function infinity_activity_tour() { { ?>
<?php if ( bp_is_activity_component() && !bp_is_user() && is_user_logged_in() ) : ?>
<ol id="joyRideTipContent">

	  <li data-id="whats-new-avatar" data-text="&rarr;">
			<?php echo infinity_option_get( 'infinity_tour_start' ); ?>
  	  </li>	

  	  <li data-id="activity-all" data-text="&rarr;">
			<?php echo infinity_option_get( 'infinity_tour_all' ); ?>
  	  </li>
  	  
  	  <?php if ( bp_is_active( 'friends' ) ) : ?>
  	  <li data-id="activity-friends" data-text="&rarr;">
		 <?php echo infinity_option_get( 'infinity_tour_friends' ); ?>
  	  </li>
  	  <?php endif; ?>
  	  
  	  <?php if ( bp_is_active( 'groups' ) ) : ?>
  	  <li data-id="activity-groups" data-text="&rarr;">
  	  	<?php echo infinity_option_get( 'infinity_tour_groups' ); ?>
  	  </li>
  	  <?php endif; ?>
  	  
  	  <li data-id="activity-mentions" data-text="&rarr;">
		<?php echo infinity_option_get( 'infinity_tour_mentions' ); ?>
  	  </li>
  	   	  
  	  <li data-id="activity-tour" data-text="&rarr;">
  	   	<?php echo infinity_option_get( 'infinity_tour_favorites' ); ?>
  	  </li>
  	    	  
  	  <li data-id="activity-filter-by" data-text="&rarr;">
  	  	<?php echo infinity_option_get( 'infinity_tour_filter' ); ?>
  	  </li> 
  	    	  
  	  <li data-id="whats-new-textarea" data-text="&#8730;">
		<?php echo infinity_option_get( 'infinity_tour_update' ); ?>
  	  </li>

  	  
  	</ol>
<!-- load template for the slider-->

<script type="text/javascript">
jQuery(window).load(function() {
   /* Setting your options to override the defaults */
	jQuery(this).joyride({
		'tipLocation': 'bottom',       // 'top' or 'bottom' in relation to parent
		'cookieMonster': true,         // true/false for whether cookies are used
		'cookieName': 'ActivityTour',         // choose your own cookie name
		'startTimerOnClick': true,     // true/false to start timer on first click
		'nextButton': true,            // true/false for next button visibility
		'tipAnimation': 'pop',         // 'pop' or 'fade' in each tip
		'tipAnimationFadeSpeed': 300,  // if 'fade'- speed in ms of transition
		'cookieDomain': false,         // set to false or yoursite.com
		'tipContainer': 'body'          // Where the tip be attached if not inline	
	});   
});
</script>
<!-- end -->
<?php endif; // end primary widget area ?>
<?php }} 
// Hook into action
add_action('close_body','infinity_activity_tour');
?>