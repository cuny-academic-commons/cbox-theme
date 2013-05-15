<?php

/**
 * Don't allow WordPress to move widgets over to this theme, as it messes with
 * our own widget setup routine
 */
remove_action( 'after_switch_theme', '_wp_sidebars_changed' );
add_action( 'after_switch_theme', 'retrieve_widgets' );

/**
 * Options page title and menu title
 */
function cbox_theme_menu_title()
{
	return __( 'CBOX Theme Options', 'cbox' );
}
add_filter( 'infinity_dashboard_menu_setup_page_title', 'cbox_theme_menu_title' );
add_filter( 'infinity_dashboard_menu_setup_menu_title', 'cbox_theme_menu_title' );

/**
 * Custom jQuery Buttons
 */
function cbox_theme_custom_buttons()
{
	// get button color option
	$cbox_button_color = infinity_option_get( 'cbox_button_color' );

	// render script tag ?>
	<script>
	// Adds color button classes to buttons depening on preset style/option
	jQuery(document).ready(function() {
			//buttons
			jQuery('.bp-primary-action,div.group-button').addClass('button white');
			jQuery('.generic-button .acomment-reply,div.not_friends').addClass('button white');
			jQuery('.bp-secondary-action, .view-post,.comment-reply-link').addClass('button white');
			jQuery('.standard-form .button,.not_friends,.group-button,.dir-form .button,.not-following,#item-buttons .group-button,#bp-create-doc-button').addClass('<?php echo $cbox_button_color ?>');
			jQuery('input[type="submit"],.submit,#item-buttons .generic-button,#aw-whats-new-submit,.activity-comments submit').addClass('button <?php echo $cbox_button_color ?>');
			jQuery('div.pending,.dir-list .group-button,.dir-list .friendship-button').removeClass('<?php echo $cbox_button_color ?>');
			jQuery('#previous-next,#upload, div.submit,div,reply,#groups_search_submit').removeClass('<?php echo $cbox_button_color ?> button');
			jQuery('div.pending,.dir-list .group-button,.dir-list .friendship-button').addClass('white');
			jQuery('#upload').addClass('button green');
	});
	</script><?php
}
add_action( 'close_body', 'cbox_theme_custom_buttons' );

//
// Slider
//

/**
 * Load metaboxes class callback
 */
function cbox_theme_init_cmb()
{
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'metaboxes/init.php' );
	}
}

/**
 * Slider setup
 */
function cbox_theme_slider_setup()
{
	// only run slider on main site
	if ( is_main_site() ) {
		// load slider setup
		require_once( 'feature-slider/setup.php' );
		// load meta box lib (a bit later)
		add_action( 'init', 'cbox_theme_init_cmb', 9999 );
	}
}
add_action( 'after_setup_theme', 'cbox_theme_slider_setup' );

//
// Template Tags
//

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
 * Automagically create a front page if one has not been set already
 */
function cbox_theme_auto_create_home_page()
{
	// page on front already set?
	if ( !get_option( 'page_on_front' ) ) {

		// nope, grab current auto created home page id
		$home_page_id = bp_get_option( '_cbox_theme_auto_create_home_page' );

		// get a page id?
		if ( false === is_numeric( $home_page_id ) ) {
			// nope, create a new dummy one
			$home_page_id = wp_insert_post( array(
				'post_type' => 'page',
				'post_title' => 'Home Page',
				'post_status' => 'publish',
			) );
		}

		// have an existing or new home page id?
		if ( is_numeric( $home_page_id ) ) {
			// yep, set the homepage template, and put the new page on front
			update_post_meta( $home_page_id, '_wp_page_template', 'templates/homepage-template.php' );
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home_page_id );
			update_option( '_cbox_theme_auto_create_home_page', $home_page_id );
		}
	}
}
add_action( 'after_setup_theme', 'cbox_theme_auto_create_home_page' );
