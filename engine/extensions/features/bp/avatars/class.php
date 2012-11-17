<?php
/**
 * ICE API: feature extensions, BuddyPress default avatars feature class file
 *
 * @author Marshall Sorenson <marshall@presscrew.com>
 * @link http://infinity.presscrew.com/
 * @copyright Copyright (C) 2010-2011 Marshall Sorenson
 * @license http://www.gnu.org/licenses/gpl.html GPLv2 or later
 * @package ICE-extensions
 * @subpackage features
 * @since 1.0
 */

ICE_Loader::load( 'components/features/component' );

/**
 * BuddyPress custom default avatars feature
 *
 * @package ICE-extensions
 * @subpackage features
 */
class ICE_Ext_Feature_Bp_Avatars
	extends ICE_Feature
{
	/**
	 */
	protected $suboptions = true;

	/**
	 * Cached overriding URL(s) to avoid multiple lookups
	 *
	 * @var array
	 */
	private $__avatars__ =
		array(
			'image-user' => null,
			'image-group' => null,
			'image-blog' => null
		);

	/**
	 * List of filters and their corresponding sub-options
	 *
	 * @var array
	 */
	private $__filters__ = array(
		// members
		'bp_user_gravatar_default' => 'image-user',
		'bp_core_default_avatar_user' => 'image-user',
		// groups
		'bp_group_gravatar_default' => 'image-group',
		'bp_core_default_avatar_group' => 'image-group',
		// blogs
		'bp_blog_gravatar_default' => 'image-blog',
		'bp_core_default_avatar_blog' => 'image-blog',
	);

	/**
	 */
	public function check_reqs()
	{
		// is buddypress active?
		if ( true === parent::check_reqs() ) {
			return class_exists( 'BP_Component' );
		}

		return false;
	}
	
	/**
	 */
	protected function init()
	{
		// run parent init method
		parent::init();

		// init properties
		$this->title = __( 'Default Avatars', infinity_text_domain );
		$this->description = __( 'Set a custom default BuddyPress avatar for the core components', infinity_text_domain );

		// add filter for every hook
		foreach ( $this->__filters__ as $filter_name => $option_name ) {
			add_filter( $filter_name, array( $this, 'fetch_avatar' ) );
		}
	}

	/**
	 * Return URL to the custom avatar image
	 *
	 * @param string $src The original source URL
	 */
	public function fetch_avatar( $src )
	{
		// current filter is sub option name
		$filter = current_filter();
		
		// is current filter in list of actions?
		if ( ( $filter ) && isset( $this->__filters__[ $filter ] ) ) {
			// grab option name
			$option_name = $this->__filters__[ $filter ];
		} else {
			// return original src
			return $src;
		}

		// handle cached results of previous lookup
		if ( is_string( $this->__avatars__[ $option_name ] ) ) {
			// its a string, use that!
			return $this->__avatars__[ $option_name ];
		// handle failed lookup
		} elseif ( $this->__avatars__[ $option_name ] === false ) {
			// previous lookup failed, return original src
			return $src;
		}
		
		// grab image option from registry
		$opt_image = $this->get_suboption( $option_name );

		// get an option?
		if ( $opt_image ) {
			// yes, get the URL
			$url = $opt_image->get_image_url();
			// get a URL?
			if ( $url ) {
				// yes, cache it
				$this->__avatars__[ $option_name ] = $url;
				// return it
				return $url;
			}
		}

		// lookup failed, cache as false
		$this->__avatars__[ $option_name ] = false;

		// return original src
		return $src;
	}
}

?>
