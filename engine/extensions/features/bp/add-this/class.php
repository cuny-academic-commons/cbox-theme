<?php
/**
 * ICE API: feature extensions, BuddyPress "add this" feature class file
 *
 * This extension is PREMIUM and purchase is required to get support!
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
 * BuddyPress "add this" social sharing feature
 *
 * @package ICE-extensions
 * @subpackage features
 */
class ICE_Ext_Feature_Bp_Add_This
	extends ICE_Feature
{
	/**
	 */
	protected $suboptions = true;

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
		$this->title = __( 'Share This', infinity_text_domain );
		$this->description = __( 'Inject the Add This social sharing buttons into your theme', infinity_text_domain );
		$this->class = "addthis_toolbox addthis_default_style";
		
		// add actions on which to render
		add_action( 'bp_before_member_header_meta', array($this,'render') );
		add_action( 'bp_before_group_header_meta', array($this,'render') );
	}

	/**
	 */
	public function renderable()
	{
		// determine if template should be rendered
		if ( true === parent::renderable() ) {
			// grab toggle option from registry
			$opt_toggle = $this->get_suboption( 'toggle' );
			// check if toggle is on
			if ( $opt_toggle && true == $opt_toggle->get() ) {
				return true;
			}
		}

		// toggle is not set or set to false;
		return false;
	}
}

?>
