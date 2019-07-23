<?php
/**
 * Sets all of our theme defaults.
 *
 * @package  osixthreeo
 * @subpackage osixthreeo/inc/customizer
 * @author   Chip Sheppard
 * @since    1.2.0
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'osixthreeo_get_defaults' ) ) {
	/**
	 * Set default options
	 *
	 * @since 1.0
	 */
	function osixthreeo_get_defaults() {
		$osixthreeo_defaults = array(
			'background_color'       => '#f3f5f7',
			'global_width_setting'   => 'full',
			'header_layout'          => '',
			'content_contain'        => '',
			'home_layout_setting'    => 'layout-ns',
			'page_layout_setting'    => 'layout-ns',
			'single_layout_setting'  => 'layout-ns',
			'search_layout_setting'  => 'layout-ns',
			'archive_layout_setting' => 'layout-ns',
		);

		return apply_filters( 'osixthreeo_option_defaults', $osixthreeo_defaults );
	}
}
