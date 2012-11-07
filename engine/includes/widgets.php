<?php

add_action( 'infinity_dashboard_activated', 'cbox_set_widgets' );
function cbox_set_widgets() {

	// Homepage Top Right
	CBox_Widget_Setter::clear_sidebar( 'homepage-top-right' );

	$welcome_text = sprintf( __( '<p><a class="button green" href="%s">Join us</a> or <a class="button white" href="%s">Login</a></p>', 'cbox-theme' ), bp_get_root_domain() . '/' . bp_get_signup_slug() . '/', wp_login_url() );

	if ( current_user_can( 'edit_theme_options' ) ) {
		$welcome_text = sprintf( __( '<p>To modify the text of this widget, and other widgets you see throughout the site, visit <a href="%s">Dashboard > Appearance > Widgets</a>.', 'cbox-theme' ), admin_url( 'widgets.php' ) ) . $welcome_text;
	}

	CBox_Widget_Setter::set_widget( array(
		'id_base'    => 'text',
		'sidebar_id' => 'homepage-top-right',
		'settings'   => array(
			'title' => __( 'Welcome', 'cbox-theme' ),
			'text'  => $welcome_text,
			'filter' => false,
		),
	) );

	// Pull up a random member to populate
	global $wpdb;
	$username = $wpdb->get_var( $wpdb->prepare( "SELECT user_login FROM $wpdb->users ORDER BY RAND()" ) );

	CBox_Widget_Setter::set_widget( array(
		'id_base'    => 'cac_featured_content_widget',
		'sidebar_id' => 'homepage-top-right',
		'settings'   => array(
			'title' => __( 'Featured Member', 'cbox-theme' ),
			'featured_content_type' => 'member',
			'featured_member' => $username,
			'custom_description' => __( 'Use the Featured Content widget to show off outstanding content from your community.', 'cbox-theme' ),
			'display_images' => '1',
			'crop_length' => '250',
			'image_width' => '50',
			'image_height' => '50',
			'image_url' => '',
			'read_more' => '',
			'filter' => false,
		),
	) );

	// Homepage Center Widget
	CBox_Widget_Setter::clear_sidebar( 'homepage-center-widget' );

	CBox_Widget_Setter::set_widget( array(
		'id_base'    => 'bp_core_recently_active_widget',
		'sidebar_id' => 'homepage-center-widget',
		'settings'   => array(
			'title' => __( 'Recently Active Members', 'cbox-theme' ),
			'max_members' => 15,
			'filter' => false,
		),
	) );

	// Homepage Left
	CBox_Widget_Setter::clear_sidebar( 'homepage-left' );

	if ( bp_is_active( 'groups' ) ) {
		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'bp_groups_widget',
			'sidebar_id' => 'homepage-left',
			'settings'   => array(
				'title' => __( 'Groups', 'cbox-theme' ),
				'max_groups'  => 20,
				'link_title' => 1,
				'group_default' => 'newest',
				'filter' => false,
			),
		) );
	}

	// Homepage Middle
	CBox_Widget_Setter::clear_sidebar( 'homepage-middle' );

	CBox_Widget_Setter::set_widget( array(
		'id_base'    => 'bp_core_members_widget',
		'sidebar_id' => 'homepage-middle',
		'settings'   => array(
			'title' => __( 'Members', 'cbox-theme' ),
			'max_members' => 20,
			'link_title' => 1,
			'member_default' => 'newest',
			'filter' => false,
		),
	) );

	// Homepage Right
	CBox_Widget_Setter::clear_sidebar( 'homepage-right' );

	if ( bp_is_active( 'blogs' ) && is_multisite() && CBox_Widget_Setter::widget_exists( 'cbox_bp_blogs_recent_posts_widget' ) ) {
		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'cbox_bp_blogs_recent_posts_widget',
			'sidebar_id' => 'homepage-right',
			'settings'   => array(
				'title' => __( 'Recent Blog Posts', 'cbox-theme' ),
				'filter' => false,
			),
		) );
	} else {
		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'recent-posts',
			'sidebar_id' => 'homepage-right',
			'settings'   => array(
				'title' => __( 'Recent Blog Posts', 'cbox-theme' ),
				'filter' => false,
			),
		) );
	}

	// Blog Sidebar
	CBox_Widget_Setter::clear_sidebar( 'blog-sidebar' );

	if ( bp_is_active( 'blogs' ) && is_multisite() && CBox_Widget_Setter::widget_exists( 'cbox_bp_blogs_recent_posts_widget' ) ) {
		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'cbox_bp_blogs_recent_posts_widget',
			'sidebar_id' => 'blog-sidebar',
			'settings'   => array(
				'title' => __( 'Recent Blog Posts', 'cbox-theme' ),
				'filter' => false,
			),
		) );
	} else {

		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'search',
			'sidebar_id' => 'blog-sidebar',
			'settings'   => array(
				'title' => __( 'Search', 'cbox-theme' ),
				'filter' => false,
			),
		) );

		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'archives',
			'sidebar_id' => 'blog-sidebar',
			'settings'   => array(
				'title' => __( 'Archives', 'cbox-theme' ),
				'filter' => false,
			),
		) );

		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'recent-posts',
			'sidebar_id' => 'blog-sidebar',
			'settings'   => array(
				'title' => __( 'Recent Blog Posts', 'cbox-theme' ),
				'filter' => false,
			),
		) );
	}

	// Page Sidebar
	CBox_Widget_Setter::clear_sidebar( 'page-sidebar' );

	CBox_Widget_Setter::set_widget( array(
		'id_base'    => 'pages',
		'sidebar_id' => 'page-sidebar',
		'settings'   => array(
			'title' => __( 'Pages', 'cbox-theme' ),
			'filter' => false,
		),
	) );

	// Footer Left
	CBox_Widget_Setter::clear_sidebar( 'footer-left' );

	CBox_Widget_Setter::set_widget( array(
		'id_base'    => 'text',
		'sidebar_id' => 'footer-left',
		'settings'   => array(
			'title' => __( 'Contact Us', 'cbox-theme' ),
			'text'  => __( 'Put your contact information in this widget.', 'cbox-theme' ),
			'filter' => false,
		),
	) );

	// Footer Middle
	CBox_Widget_Setter::clear_sidebar( 'footer-middle' );

	CBox_Widget_Setter::set_widget( array(
		'id_base'    => 'text',
		'sidebar_id' => 'footer-middle',
		'settings'   => array(
			'title' => __( 'About', 'cbox-theme' ),
			'text'  => __( 'Some brief information about your site.', 'cbox-theme' ),
			'filter' => false,
		),
	) );

	// Footer Right
	CBox_Widget_Setter::clear_sidebar( 'footer-right' );

	CBox_Widget_Setter::set_widget( array(
		'id_base'    => 'pages',
		'sidebar_id' => 'footer-right',
		'settings'   => array(
			'title' => __( 'Sitemap', 'cbox-theme' ),
			'text'  => __( 'You might use this space to thank ', 'cbox-theme' ),
			'filter' => false,
		),
	) );

	// Activity Sidebar
	CBox_Widget_Setter::clear_sidebar( 'activity-sidebar' );

	CBox_Widget_Setter::set_widget( array(
		'id_base'    => 'bp_core_whos_online_widget',
		'sidebar_id' => 'activity-sidebar',
		'settings'   => array(
			'title' => __( 'Who\'s Online', 'cbox-theme' ),
			'max_members'  => 20,
			'filter' => false,
		),
	) );

	// Activity Sidebar
	CBox_Widget_Setter::clear_sidebar( 'member-sidebar' );

	CBox_Widget_Setter::set_widget( array(
		'id_base'    => 'bp_core_whos_online_widget',
		'sidebar_id' => 'member-sidebar',
		'settings'   => array(
			'title' => __( 'Who\'s Online', 'cbox-theme' ),
			'max_members'  => 20,
			'filter' => false,
		),
	) );

	CBox_Widget_Setter::set_widget( array(
		'id_base'    => 'bp_core_recently_active_widget',
		'sidebar_id' => 'member-sidebar',
		'settings'   => array(
			'title' => __( 'Recently Active Members', 'cbox-theme' ),
			'max_members'  => 20,
			'filter' => false,
		),
	) );

	// Group Sidebar
	CBox_Widget_Setter::clear_sidebar( 'groups-sidebar' );

	if ( bp_is_active( 'groups' ) ) {
		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'bp_groups_widget',
			'sidebar_id' => 'groups-sidebar',
			'settings'   => array(
				'title' => __( 'Groups', 'cbox-theme' ),
				'max_groups'  => 5,
				'link_title' => '1',
				'filter' => false,
			),
		) );
	}

	// Homepage Right
	CBox_Widget_Setter::clear_sidebar( 'forums-sidebar' );

	if ( function_exists( 'bbpress' ) ) {
		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'bbp_views_widget',
			'sidebar_id' => 'forums-sidebar',
			'settings'   => array(
				'title' => __( 'Topic View List', 'cbox-theme' ),
				'filter' => false,
			),
		) );

		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'bbp_topics_widget',
			'sidebar_id' => 'forums-sidebar',
			'settings'   => array(
				'title' => __( 'Recent Topics', 'cbox-theme' ),
				'max_shown' => 6,
				'filter' => false,
			),
		) );

		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'bbp_replies_widget',
			'sidebar_id' => 'forums-sidebar',
			'settings'   => array(
				'title' => __( 'Recent Replies', 'cbox-theme' ),
				'max_shown' => 6,
				'filter' => false,
			),
		) );
	}

	if ( function_exists( 'bpdw_slug' ) ) {
		$create_url = trailingslashit( home_url( bpdw_slug() ) ) . trailingslashit( BP_DOCS_CREATE_SLUG );

		// Wiki Sidebar
		CBox_Widget_Setter::clear_sidebar( 'wiki-sidebar' );
		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'text',
			'sidebar_id' => 'wiki-sidebar',
			'settings'   => array(
				'title'  => __( 'Welcome To The Wiki', 'cbox-theme' ),
				'text'   => '<p>' . sprintf( __( 'This sidebar appears on all Wiki pages. Use it to display content that you want your users to see whenever viewing the Wiki, such as a brief description of how wikis work, or a link to <a href="%s">create a new wiki page</a>.', 'cbox-theme' ), $create_url ) . '</p><p>' . sprintf( __( 'To edit this widget, or to add more widgets to the sidebar, visit <a href="%s">Dashboard > Appearance > Widgets</a> and look for the Wiki Sidebar.', 'cbox-theme' ), admin_url( 'widgets.php' ) ) . '</p>',
				'filter' => false,
			),
		) );

		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'text',
			'sidebar_id' => 'wiki-sidebar',
			'settings'   => array(
				'title'  => '',
				'text'   => '<a href="' . $create_url . '" class="button">' . __( 'Create New Wiki Page', 'cbox-theme' ) . '</a>',
				'filter' => false,
			),
		) );

		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'bpdw_tag_cloud',
			'sidebar_id' => 'wiki-sidebar',
			'settings'   => array(
				'title'  => __( 'Wiki Tags', 'bp-docs-wiki' ),
				'filter' => false,
			),
		) );

		// Wiki Top
		CBox_Widget_Setter::clear_sidebar( 'wiki-top' );
		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'text',
			'sidebar_id' => 'wiki-top',
			'settings'   => array(
				'title'  => __( 'Welcome To The Wiki', 'bp-docs-wiki' ),
				'text'   => '<p>' . __( 'This is a text widget that you can use to introduce your users to the wiki, and perhaps to feature some outstanding wiki content.', 'bp-docs-wiki' ) . '</p><p>' . sprintf( __( 'Edit this widget, or add others to the Wiki Top sidebar, at <a href="%s">Dashboard > Appearance > Widgets</a>.', 'cbox-theme' ), admin_url( 'widgets.php' ) ) . '</p>',
				'filter' => false,
			),
		) );

		// Wiki Bottom Left
		CBox_Widget_Setter::clear_sidebar( 'wiki-bottom-left' );
		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'bpdw_recently_active',
			'sidebar_id' => 'wiki-bottom-left',
			'settings'   => array(
				'title'  => __( 'Recently Active', 'bp-docs-wiki' ),
				'filter' => false,
			),
		) );

		// Wiki Bottom Right
		CBox_Widget_Setter::clear_sidebar( 'wiki-bottom-right' );
		CBox_Widget_Setter::set_widget( array(
			'id_base'    => 'bpdw_most_active',
			'sidebar_id' => 'wiki-bottom-right',
			'settings'   => array(
				'title'  => __( 'Most Active', 'bp-docs-wiki' ),
				'filter' => false,
			),
		) );
	}
}

/**
 * Utility class for dealing with sidebar widgets
 */
class CBox_Widget_Setter {
	public static function set_widget( $args ) {
		$r = wp_parse_args( $args, array(
			'id_base' => '',
			'sidebar_id' => '',
			'settings' => array(),
		) );

		$id_base    = $r['id_base'];
		$sidebar_id = $r['sidebar_id'];
		$settings   = (array) $r['settings'];

		// Don't try to set a widget if it hasn't been registered
		if ( ! self::widget_exists( $id_base ) ) {
			return new WP_Error( 'widget_does_not_exist', 'Widget does not exist' );
		}

		global $wp_registered_sidebars;
		if ( ! isset( $wp_registered_sidebars[ $sidebar_id ] ) ) {
			return new WP_Error( 'sidebar_does_not_exist', 'Sidebar does not exist' );
		}

		$sidebars = wp_get_sidebars_widgets();
		$sidebar = (array) $sidebars[ $sidebar_id ];

		// Multi-widgets can only be detected by looking at their settings
		$option_name  = 'widget_' . $id_base;

		// Don't let it get pulled from the cache
		wp_cache_delete( $option_name, 'options' );
		$all_settings = get_option( $option_name );

		if ( is_array( $all_settings ) ) {
			$skeys = array_keys( $all_settings );

			// Find the highest numeric key
			rsort( $skeys );

			foreach ( $skeys as $k ) {
				if ( is_numeric( $k ) ) {
					$multi_number = $k + 1;
					break;
				}
			}

			if ( ! isset( $multi_number ) ) {
				$multi_number = 1;
			}

			$all_settings[ $multi_number ] = $settings;
			//$all_settings = array( $multi_number => $settings );
		} else {
			$multi_number = 1;
			$all_settings = array( $multi_number => $settings );
		}

		$widget_id = $id_base . '-' . $multi_number;
		$sidebar[] = $widget_id;

		// Because of the way WP_Widget::update_callback() works, gotta fake the $_POST
		$_POST['widget-' . $id_base] = $all_settings;

		global $wp_registered_widget_updates, $wp_registered_widget_controls;
		foreach ( (array) $wp_registered_widget_updates as $name => $control ) {

			if ( $name == $id_base ) {
				if ( !is_callable( $control['callback'] ) )
					continue;

				ob_start();
					call_user_func_array( $control['callback'], $control['params'] );
				ob_end_clean();
				break;
			}
		}

		$sidebars[ $sidebar_id ] = $sidebar;
		wp_set_sidebars_widgets( $sidebars );

		update_option( $option_name, $all_settings );
	}

	/**
	 * Moves all active widgets from a given sidebar into the inactive array
	 */
	public static function clear_sidebar( $sidebar_id, $delete_to = 'inactive' ) {
		$sidebars = wp_get_sidebars_widgets();
		if ( ! isset( $sidebars[ $sidebar_id ] ) ) {
			return new WP_Error( 'sidebar_does_not_exist', 'Sidebar does not exist' );
		}

		if ( 'inactive' == $delete_to ) {
			$sidebars['wp_inactive_widgets'] = array_unique( array_merge( $sidebars['wp_inactive_widgets'], $sidebars[ $sidebar_id ] ) );
		}

		$sidebars[ $sidebar_id ] = array();
		wp_set_sidebars_widgets( $sidebars );
	}

	/**
	 * Check to see whether a widget has been registered
	 *
	 * @param string $id_base
	 * @return bool
	 */
	public static function widget_exists( $id_base ) {
		global $wp_widget_factory;

		foreach ( $wp_widget_factory->widgets as $w ) {
			if ( $id_base == $w->id_base ) {
				return true;
			}
		}

		return false;
	}
}

