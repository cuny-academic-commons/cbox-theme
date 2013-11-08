<?php
/**
 * Add new Post Thumbnail size for slider
 */
function cbox_thumb_sizes()
{
	if ( current_theme_supports( 'post-thumbnails' ) ) {
		add_image_size( 'slider-image', 635, 344, true );
	}
}
add_action( 'after_setup_theme', 'cbox_thumb_sizes', 20 );

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
		'menu_icon' => infinity_image_url( 'slides-icon.png' ),
		'supports' => array('title','editor', 'thumbnail' )
	);

	register_post_type( 'features', $args );
}
add_action( 'after_setup_theme', 'cbox_theme_feature_setup', 20 );

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( $meta_boxes = array() ) {

	// Check which slider option is set
	$slider_type = (int) infinity_option_get( 'cbox_flex_slider' );

	// Show meta boxes only on Features post type
	if ( $slider_type == 1 ) {
		$cbox_slider_type = 'features';
	}
	// Or show them on all posts when a Featured Category is used for the slider
	if ( $slider_type == 2 ) {
		$cbox_slider_type = 'post';
	}

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cbox_';

	$meta_boxes[] = array(
		'id'         => 'cbox_slider_options',
		'title'      => 'Slide Caption Text',
		'pages'      => array( $cbox_slider_type ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Slide Caption',
				'desc' => 'Write down the text you would like to display in the slider. You can leave this empty if you want to show an excerpt of the post you have written above.',
				'id'   => $prefix . 'slider_excerpt',
				'type' => 'wysiwyg',
						'options' => array(
					    'media_buttons' => false, // show insert/upload button(s)
					),
			),
			array(
				'name'    => 'Hide Caption?',
				'desc'    => 'Do you want to completely hide the caption for this slide? This will only display your slide image',
				'id'      => $prefix . 'hide_caption',
				'type'    => 'radio_inline',
				'std' => 'no',
				'options' => array(
					array( 'name' => 'Yes', 'value' => 'yes', ),
					array( 'name' => 'No', 'value' => 'no', ),
				),
			),
		),
	);

	// Add other metaboxes as needed

	$meta_boxes[] = array(
			'id'         => 'cbox_video_options',
			'title'      => 'Video Options',
			'pages'      => array( $cbox_slider_type ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
			array(
				'name'    => 'Embed a Video?',
				'desc'    => 'Do you want to display a video inside your slide? Note: The video will replace your caption text and slide image.',
				'id'      => $prefix . 'enable_custom_video',
				'type'    => 'radio_inline',
				'std' => 'no',
				'options' => array(
					array( 'name' => 'Yes', 'value' => 'yes', ),
					array( 'name' => 'No', 'value' => 'no', ),
				),
			),
			array(
				'name' => 'Video URL',
				'desc' => 'Enter a Youtube or Vimeo URL. example: http://www.youtube.com/watch?v=iMuFYnvSsZg',
				'id'   => $prefix . 'video_url',
				'type' => 'oembed',
			),
			)
		);

	$meta_boxes[] = array(
			'id'         => 'cbox_url_options',
			'title'      => 'Custom URL/Permalink',
			'pages'      => array( $cbox_slider_type ), // Post type
			'context'    => 'side',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
				'name'    => 'Use a Custom URL',
				'desc'    => 'Do you want to point your slide to a specific URL?',
				'id'      => $prefix . 'enable_custom_url',
				'type'    => 'radio_inline',
				'std' => 'no',
				'options' => array(
					array( 'name' => 'Yes', 'value' => 'yes', ),
					array( 'name' => 'No', 'value' => 'no', ),
				),
			),
				array(
					'name' => 'Custom URL',
					'desc' => 'The full URL you would like the slide to point to. Example: http://www.google.com',
					'id'   => $prefix . 'custom_url',
					'type' => 'text',
				),
				)
		);
	return $meta_boxes;
}

/**
 * Fetch slide image to show on the Site Features index
 */
function cbox_get_featured_slide($post_ID)
{
	$post_thumbnail_id = get_post_thumbnail_id($post_ID);
	 if ($post_thumbnail_id){
	  $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'width=200&height=110&crop=1&crop_from_position=center,left');
	  return $post_thumbnail_img[0];
	}
}

/**
 * Add new column to the Site Features index
 */
function cbox_site_features_column($defaults) 
{
	 $defaults['featured_image'] = 'Featured Image';
	 return $defaults;
}

/**
 * Show the slide image in the new column
 */
function cbox_site_features_column_content($column_name, $post_ID) 
{
	 if ($column_name == 'featured_image') {
	  $post_featured_image = cbox_get_featured_slide($post_ID);
	  if ($post_featured_image){
	   echo '<img src="' . $post_featured_image . '" />'; 
	  }
	 }
}

add_filter('manage_features_posts_columns', 'cbox_site_features_column', 10);
add_action('manage_features_posts_custom_column', 'cbox_site_features_column_content', 10, 2);

/**
 * Enqueues Slider JS at the bottom of the homepage
 */
function cbox_theme_flex_slider_script()
{
	if ( is_page_template('templates/homepage-template.php') ) {
		// render script tag ?>
		<script type="text/javascript">
			jQuery(document).ready(function(){

				jQuery('.slides').bxSlider({
					adaptiveHeight: true,
					auto: true,
	  				autoHover: true,
					mode: 'fade',
					video: true,
	  				useCSS: false,
	  				controls: false,
	  				pause : <?php echo infinity_option_get( 'cbox_flex_slider_time' ); ?>000,
	  				speed: <?php echo infinity_option_get( 'cbox_flex_slider_transition' ); ?>
				});

			});
		</script><?php
	}
}
add_action( 'close_body', 'cbox_theme_flex_slider_script' );
