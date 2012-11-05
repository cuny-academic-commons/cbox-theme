<?php

/**
 * Register and create a default menu in CBOX.
 *
 * @param str $menu_name The internal menu name we should give our new menu.
 * @param str $location The nav menu location we want our new menu to reside.
 * @todo Make this less specific to BP's directory pages for generic use
 */
function cbox_theme_register_default_menu( $menu_name, $location )
{
	global $blog_id;

	// check BP reqs and if our custom default menu already exists
	if (
		function_exists( 'bp_core_get_directory_pages' ) &&
		BP_ROOT_BLOG == $blog_id &&
		! is_nav_menu( $menu_name )
	) {
		// doesn't exist, create it
		$menu_id = wp_create_nav_menu( $menu_name );

		// get bp pages
		$pages = bp_core_get_directory_pages();

		// allowed pages
		// key = BP component
		$pages_ok = array(
			'members'  => array(
				'title'    => _x( 'People', 'the link in the header navigation bar', 'cbox-theme' ),
				'position' => 1
			),
			'groups'   => array(
				'title'    => _x( 'Groups', 'the link in the header navigation bar', 'cbox-theme' ),
				'position' => 2
			),
			'blogs'    => array(
				'title'    => _x( 'Blogs', 'the link in the header navigation bar', 'cbox-theme' ),
				'position' => 3
			),
			'bp_docs'  => array(
				'title'    => _x( 'Docs', 'the link in the header navigation bar', 'cbox-theme' ),
				'position' => 4
			),
			'activity' => array(
				'title'    => _x( 'Activity', 'the link in the header navigation bar', 'cbox-theme' ),
				'position' => 5
			),
		);

		// create "Home" nav item first
		wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'   =>  _x( 'Home', 'the link in the header navigation bar', 'cbox-theme' ),
			'menu-item-classes' => 'icon-home',
			'menu-item-url'     => home_url( '/' ), 
			'menu-item-status'  => 'publish'
		) );

		// now, add the rest of our bp pages from $pages_ok
		foreach( $pages as $component => $page ) {
			// make sure we support this page
			if ( array_key_exists( $component, $pages_ok ) ) {
				// yep, add page as a nav item
				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-type'       => 'post_type',
					'menu-item-status'     => 'publish',
					'menu-item-object'     => 'page',
					'menu-item-object-id'  => $page->id,
					'menu-item-title'      => ! empty( $pages_ok[ $component ]['title'] ) ? $pages_ok[ $component ]['title'] : $page->title,
					//'menu-item-attr-title' => ! empty( $pages_ok[ $component ]['attr-title'] ) ? $pages_ok[ $component ]['attr-title'] : $page->title,
					'menu-item-classes'    => 'icon-' . $component,
					'menu-item-position'   => $pages_ok[ $component ]['position']
				) );
			}
		}

		// get location settings
		$locations = get_theme_mod( 'nav_menu_locations' );

		// is our menu location set yet?
		if ( empty( $locations[ $location ] ) ) {
			// nope, set it
			$locations[ $location ] = $menu_id;

			// update theme mode
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}
}

// run this on get_header() on the frontend to give CBOX components a chance 
// to configure from the admin area (like BP Docs)
add_action( 'get_header', create_function( '', "
	cbox_theme_register_default_menu( 'cbox-sub-menu', 'sub-menu' );
" ) );
