<?php
/**
 * Easy Hooks Extension
 *
 * @package Infinity
 * @subpackage cbox
 */
function infinity_easy_hook_open_content() { { ?>
<!-- html -->
<?php if ( infinity_option_get( 'infinity_easy_hook_open_content' ) ): ?> 
	<?php echo infinity_option_get( 'infinity_easy_hook_open_content' ); ?>
<?php endif; ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('open_content','infinity_easy_hook_open_content');

function infinity_easy_hook_close_content() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_close_content' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('close_content','infinity_easy_hook_close_content');

function infinity_easy_hook_open_sidebar() { { ?>
<!-- html -->
<?php if ( infinity_option_get( 'infinity_easy_hook_open_sidebar' ) ): ?> 
	<div class="widget"><?php echo infinity_option_get( 'infinity_easy_hook_open_sidebar' ); ?></div>
<?php endif; ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('open_sidebar','infinity_easy_hook_open_sidebar');

function infinity_easy_hook_close_sidebar() { { ?>
<!-- html -->
<?php if ( infinity_option_get( 'infinity_easy_hook_close_sidebar' ) ): ?> 
	<div class="widget"><?php echo infinity_option_get( 'infinity_easy_hook_close_sidebar' ); ?></div>
<?php endif; ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('close_sidebar','infinity_easy_hook_close_sidebar');

function infinity_easy_hook_open_footer() { { ?>
<!-- html -->
<?php if ( infinity_option_get( 'infinity_easy_hook_open_footer' ) ): ?> 
	<div class="widget"><?php echo infinity_option_get( 'infinity_easy_hook_open_footer' ); ?></div>
<?php endif; ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('open_footer','infinity_easy_hook_open_footer');

function infinity_easy_hook_close_footer() { { ?>
<!-- html -->
<?php if ( infinity_option_get( 'infinity_easy_hook_close_footer' ) ): ?> 
	<div class="widget"><?php echo infinity_option_get( 'infinity_easy_hook_close_footer' ); ?></div>
<?php endif; ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('close_footer','infinity_easy_hook_close_footer');

function infinity_easy_hook_open_home() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_open_home' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('open_home','infinity_easy_hook_open_home');

function infinity_easy_hook_close_home() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_close_home' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('close_home','infinity_easy_hook_close_home');

function infinity_easy_hook_open_page() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_open_page' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('open_page','infinity_easy_hook_open_page');

function infinity_easy_hook_close_page() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_close_page' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('close_page','infinity_easy_hook_close_page');

function infinity_easy_hook_open_single() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_open_single' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('open_single','infinity_easy_hook_open_single');

function infinity_easy_hook_open_loop_single() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_open_loop_single' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('open_loop_single','infinity_easy_hook_open_loop_single');

function infinity_easy_hook_close_loop_single() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_close_loop_single' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('close_loop_single','infinity_easy_hook_close_loop_single');

function infinity_easy_hook_close_single() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_close_single' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('close_single','infinity_easy_hook_close_single');

function infinity_easy_hook_open_tag() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_open_tag' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('open_tag','infinity_easy_hook_open_tag');

function infinity_easy_hook_close_tag() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_close_tag' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('close_tag','infinity_easy_hook_close_tag');

function infinity_easy_hook_open_category() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_open_category' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('open_category','infinity_easy_hook_open_category');

function infinity_easy_hook_close_category() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_close_category' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('close_category','infinity_easy_hook_close_category');

function infinity_easy_hook_open_archive() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_open_archive' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('open_archive','infinity_easy_hook_open_archive');

function infinity_easy_hook_close_archive() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_close_archive' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('close_archive','infinity_easy_hook_close_archive');

function infinity_easy_hook_close_author() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_close_author' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('close_author','infinity_easy_hook_close_author');

function infinity_easy_hook_open_author() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_open_author' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('open_author','infinity_easy_hook_open_author');

function infinity_easy_hook_open_404() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_open_404' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('open_404','infinity_easy_hook_open_404');

function infinity_easy_hook_close_404() { { ?>
<!-- html -->
<?php echo infinity_option_get( 'infinity_easy_hook_close_404' ); ?>
<!-- end -->
<?php }} 
// Hook into action
add_action('close_404','infinity_easy_hook_close_404');
?>