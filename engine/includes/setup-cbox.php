<?php

/**
 * Suppress notices created by CBOX Theme.
 *
 * Currently suppresses strict standards notices created by CBOX Theme and
 * the 'bp_setup_current_user' and 'bbp_setup_current_user' notices caused by
 * older versions of BuddyPress and bbPress.
 *
 * @param  int    $errno   The error number. See http://php.net/manual/en/errorfunc.constants.php.
 * @param  string $errstr  The error message.
 * @param  string $errfile Path to the file that caused the error.
 * @return bool   True to suppress error reporting; false to use default error handler.
 */
function cbox_theme_error_handler( $errno, $errstr, $errfile ) {
	// Suppress strict standards notices by cbox-theme.
	if ( E_STRICT === $errno && false !== strpos( $errfile, 'cbox-theme' ) ) {
		return true;
	}

	/*
	 * Suppress older 'bp_setup_current_user' messages.
	 *
	 * Only applicable in older versions of BuddyPress and bbPress.
	 */
	if ( false !== strpos( $errfile, 'cbox-theme' ) && false !== strpos( $errstr, 'bp_setup_current_user' ) ) {
		return true;
	}

	return false;
}
set_error_handler( 'cbox_theme_error_handler' );

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
 * Hotfix to deal with WP 3.6 using newer versions of jQuery and jQuery UI.
 *
 * The CBOX Theme / Infinity theme options page currently works with older
 * versions of jQuery and jQuery UI bundled with WP 3.5.
 *
 * This function downgrades jQuery and jQuery UI if the current site is using
 * WP 3.6+ so the theme options page will work again.
 *
 * This is a temporary fix until we can migrate CBOX Theme / Infinity's JS to
 * work with the newer versions of jQuery and jQuery UI.
 *
 * @link https://github.com/cuny-academic-commons/cbox-theme/issues/169
 * @link https://github.com/PressCrew/infinity/issues/88
 */
function cbox_jqueryui_hotfix( $page ) {
	// if we're not on the CBOX Theme options page, stop now!
	if ( $page != 'appearance_page_' . INFINITY_ADMIN_PAGE ) {
		return;
	}

	global $wp_version;

	// stop if WP version is less than 3.6
	if ( version_compare( $wp_version, '3.6' ) < 0 ) {
		return;
	}

	// remove jQuery core and register the older version from WP 3.5
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', "//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js", array(), '1.8.3' );

	// remove jQuery UI core and register the older version from WP 3.5
	wp_deregister_script( 'jquery-ui-core' );
	wp_register_script( 'jquery-ui-core', '//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js', array('jquery'), '1.9.2', 1 );

	// Google's jQuery UI already includes all UI widgets
	//
	// so now, we need to trick WP into thinking that the accordion widget is
	// active so CBOX Theme will detect accordion properly
	//
	// to do this, enqueue a small CDN JS file - min.js - as a filler
	// this will not be used at all (hackety mchack-hack)
	wp_deregister_script( 'jquery-ui-accordion' );
	wp_register_script( 'jquery-ui-accordion', '//cdnjs.cloudflare.com/ajax/libs/min.js/0.2.3/$.min.js', array('jquery-ui-core'), '1.9.2', 1 );

	// remove some other jQuery UI scripts that might be in use
	$jquery_ui_handles = array(
		// header additions
		'widget',
		'mouse',
		'slider',
		'sortable',
		'position',
		'resizable',
		'menu',

		// footer additions
		'dialog',
		'draggable',
		'progressbar',

		// misc
		'button',
		'tabs',
	);

	foreach ( $jquery_ui_handles as $handle ) {
		wp_deregister_script( "jquery-ui-{$handle}" );
		wp_register_script( "jquery-ui-{$handle}", '' );
	}
}
add_action( 'admin_enqueue_scripts', 'cbox_jqueryui_hotfix', 20 );

/**
 * Custom jQuery Buttons
 */
function cbox_theme_custom_buttons()
{
	// get button color option
	$cbox_button_color = esc_html( infinity_option_get( 'cbox_button_color' ) );

	// render script tag ?>
	<script>
	// Adds color button classes to buttons depening on preset style/option
	jQuery(document).ready(function() {
			//buttons
			jQuery('.bp-primary-action,div.group-button').addClass('button white');
			jQuery('.generic-button .acomment-reply,div.not_friends').addClass('button white');
			jQuery('.bp-secondary-action, .view-post,.comment-reply-link').addClass('button white');
			jQuery('.standard-form .button,.dir-form .button,#bp-create-doc-button').addClass('<?php echo $cbox_button_color ?>');
			jQuery('input[type="submit"],.submit,#aw-whats-new-submit,.activity-comments submit').addClass('button <?php echo $cbox_button_color ?>');
			jQuery('div.pending, .dir-search input[type="submit"]').removeClass('<?php echo $cbox_button_color ?>');
			jQuery('#previous-next,#upload, div.submit,div.reply,.ignore-color').removeClass('<?php echo $cbox_button_color ?> button');
			jQuery('#upload').addClass('button green');
	});
	</script><?php
}
add_action( 'close_body', 'cbox_theme_custom_buttons' );

/**
 * Create an excerpt
 *
 * Uses bp_create_excerpt() when available. Otherwise falls back on a very
 * rough approximation, ignoring the fancy params passed.
 *
 * @since 1.0.5
 */
function cbox_create_excerpt( $text, $length = 425, $options = array() ) {
	if ( function_exists( 'bp_create_excerpt' ) ) {
		return bp_create_excerpt( $text, $length, $options );
	} else {
		return substr( $text, 0, $length ) . ' [&hellip;]';
	}
}

//
// Slider
//

/**
 * Load metaboxes class callback: https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */
function cbox_theme_init_cmb()
{
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'metaboxes/init.php' );
	}
}

/**
 * add WP Thumb for dynamic thumbnails across the theme: https://github.com/humanmade/WPThumb
 */
if( !class_exists( 'WP_Thumb' ) ){
	require_once( 'WPThumb/wpthumb.php' );
}

/**
 * Slider setup
 */
function cbox_theme_slider_setup()
{
	// load slider setup
	require_once( 'feature-slider/setup.php' );

	// load meta box lib (a bit later)
	add_action( 'init', 'cbox_theme_init_cmb', 9999 );
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
	$is_root_blog = function_exists( 'bp_is_root_blog' ) ? bp_is_root_blog() : is_main_site();

	// if we're not on the root blog, do not auto create the homepage
	if ( ! $is_root_blog ) {
		return;
	}

	// get frontpage ID
	$front_page = get_option( 'page_on_front' );

	// no frontpage?
	if ( ! $front_page ) {

		// set our flag to create a page to true by default
		$create_page = true;

		// grab current auto-created home page id
		$home_page_id = get_option( '_cbox_theme_auto_create_home_page' );

		// we have a page ID, but does it still exist?
		if ( is_numeric( $home_page_id ) ) {
			// page exists, so set $create_page flag to false
			if ( get_post( $home_page_id ) ) {
				$create_page = false;
			}

		}

		// we need to create a new page
		if ( $create_page ) {
			// create the new page
			$home_page_id = wp_insert_post( array(
				'post_type'   => 'page',
				'post_title'  => 'Home Page',
				'post_status' => 'publish',
			) );

			// set the new page as the frontpage and use our homepage template
			update_post_meta( $home_page_id, '_wp_page_template', 'templates/homepage-template.php' );
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home_page_id );
			update_option( '_cbox_theme_auto_create_home_page', $home_page_id );
		}

	// check if front page still exists
	} else {
		// do this check only on 404 pages b/c if the front page doesn't exist,
		// the front page will 404, so we can run our check then to prevent
		// unnecessary DB queries on other pages
		if ( is_404() && get_post( $front_page ) === NULL ) {
			// front page no longer exists so purge the following options
			delete_option( 'page_on_front' );
			delete_option( '_cbox_theme_auto_create_home_page' );

			// redirect back to homepage
			wp_redirect( get_home_url() ); die();
		}
	}
}
add_action( 'wp', 'cbox_theme_auto_create_home_page' );
