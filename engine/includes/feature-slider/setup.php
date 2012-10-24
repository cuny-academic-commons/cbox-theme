<?php
/**
 * Register custom "Features" post type
 *
 * @package Infinity
 * @subpackage cbox
 */
function cbox_feature_setup()
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
		'menu_icon' => get_stylesheet_directory_uri() . '/base/feature-slider/assets/images/slides-icon.png',
		'supports' => array('title','excerpt','editor', 'thumbnail' )
	);

	register_post_type( 'features', $args );
}
add_action( 'init', 'cbox_feature_setup' );

/**
 * Enqueues Slider JS at the bottom of the homepage
 * @package Infinity
 * @subpackage cbox
 */
function cbox_flex_slider_script() { { ?>
<?php if ( is_front_page() ) : ?>
<!-- html -->
<script type="text/javascript">
// Can also be used with $(document).ready()
jQuery(window).load(function() {
  jQuery('.flexslider').flexslider({
    animation: "slide"
  });
});
</script>
<?php endif; // end primary widget area ?>
<?php }} 
// Hook into action
add_action('close_body','cbox_flex_slider_script');
?>