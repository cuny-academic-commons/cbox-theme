<?php
/**
 * Feature Slider setup
 */

/**
 * Register custom "Features" post type
 */
function cbox_theme_feature_setup()
{
	$labels = array(
		'name' => _x('Site Features', 'post type general name', 'infinity'),
		'singular_name' => _x('Site Features', 'post type singular name', 'infinity'),
		'add_new' => _x('Add Feature', 'infobox', 'infinity'),
		'add_new_item' => __('Add New Feature', 'infinity'),
		'edit_item' => __('Edit Feature', 'infinity'),
		'new_item' => __('New Feature', 'infinity'),
		'view_item' => __('View Feature', 'infinity'),
		'search_items' => __('Search Feature', 'infinity'),
		'not_found' =>  __('No Features fount', 'infinity'),
		'not_found_in_trash' => __('No Features are found in Trash', 'infinity'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => get_stylesheet_directory_uri() . '/engine/includes/feature-slider/assets/images/slides-icon.png',
		'supports' => array('title','excerpt','editor', 'thumbnail' )
	);

	register_post_type( 'features', $args );
}
add_action( 'init', 'cbox_theme_feature_setup' );

/**
 * Enqueues Slider JS at the bottom of the homepage
 */
function cbox_theme_flex_slider_script()
{
	if ( is_page_template('templates/homepage-template.php') ) {
		// render script tag ?>
		<script type="text/javascript">
			jQuery(window).load(function($){
				jQuery('.flexslider').flexslider({
					animation: "slide"
				});
			});
		</script><?php
	}
}
add_action( 'close_body', 'cbox_theme_flex_slider_script' );

?>
