<?php
// Intro text for BBPress
function cbox_bbpress_intro() { { ?>
<!-- html -->
	<div class="info-box bbpress-intro">
		This is a BBPress Specific sidebar! It can be used to create an awesome forum homepage!

For instance you can show the most recent replies and most popular topics. You can do all kinds of stuff!
	</div>
<!-- end -->
<?php }} 
// Hook into action
add_action('bbp_template_before_forums_loop','cbox_bbpress_intro');

// ! // Add Recent Topics to BBPress  
function cbox_recent_bbpress() { { ?>
<!-- html -->
	<h4>Recent Topics</h4>			
	<?php
	if ( bbp_has_topics( array( 'author' => 0, 'show_stickies' => false, 'order' => 'DESC', 'post_parent' => 'any', 'posts_per_page' => 10 ) ) )
		bbp_get_template_part( 'bbpress/loop', 'topics' );
	?>
<!-- end -->
<?php }} 
// Hook into action
add_action('bbp_template_after_forums_loop','cbox_recent_bbpress');
?>