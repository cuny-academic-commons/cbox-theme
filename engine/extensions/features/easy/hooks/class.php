<?php
/**
 * ICE API: feature extensions, easy hooks feature class file
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

ICE_Loader::load_ext( 'features/echo' );

/**
 * Easy Hooks feature
 *
 * @package ICE-extensions
 * @subpackage features
 */
class ICE_Ext_Feature_Easy_Hooks
	extends ICE_Ext_Feature_Echo
{

	/**
	 */
	protected function init()
	{
		// run parent init method
		parent::init();

		// init properties
		$this->title = __( 'Easy Hooks', infinity_text_domain );
		$this->description = __( 'Easily inject content into themes which extend from Infinity Base', infinity_text_domain );
	}

	/**
	 */
	public function get_action_list()
	{
		return array(
			'open_content' => 'open-content',
			'close_content' => 'close-content',
			'open_sidebar' => 'open-sidebar',
			'close_sidebar' => 'close-sidebar',
			'open_footer' => 'open-footer',
			'close_footer' => 'close-footer',
			'open_home' => 'open-home',
			'close_home' => 'close-home',
			'open_page' => 'open-page',
			'close_page' => 'close-page',
			'open_single' => 'open-single',
			'close_single' => 'close-single',
			'open_loop_single' => 'open-loop-single',
			'close_loop_single' => 'close-loop-single',
			'open_tag' => 'open-tag',
			'close_tag' => 'close-tag',
			'open_category' => 'open-category',
			'close_category' => 'close-category',
			'open_archive' => 'open-archive',
			'close_archive' => 'close-archive',
			'open_author' => 'open-author',
			'close_author' => 'close-author',
			'open_search' => 'open-search',
			'close_search' => 'close-search',
			'open_404' => 'open-404',
			'close_404' => 'close-404'
		);
	}

}

?>
