<?php
/**
 * Sets all of our theme defaults.
 *
 * @package kelso
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'kelso_get_defaults' ) ) {
	/**
	 * Set default options
	 *
	 * @since 0.1
	 */
	function kelso_get_defaults() {
		$kelso_defaults = array(
			'background_color' => '#ffffff',
			'content_background_color' => '#f3f3f3',
			'text_color' => '#222222',
			'link_color' => '#1f9bde',
			'link_color_hover' => '#ff9900',

			'header_background_color' => '#ffffff',
			'nav_link_color' => '#222222',

			'footerwidgets_background_color' => '#494949',
			'footerwidgets_text_color' => '#c0c0c0',
			'footerwidgets_link_color' => '#808080',
			'footerwidgets_link_color_hover' => '#c0c0c0',

			'footer_background_color' => '#000000',
			'footer_text_color' => '#c0c0c0',
			'footer_link_color' => '#808080',
			'footer_link_color_hover' => '#c0c0c0',

			'global_width_setting' => 'full',

			'home_layout_setting' => 'layout-ns',
			'page_layout_setting' => 'layout-ns',
			'single_layout_setting' => 'layout-ns',
			'search_layout_setting' => 'layout-ns',
			'archive_layout_setting' => 'layout-ns',

			'back_to_top' => '',
			'nav_search' => '',

			'header_bg_color_left' => '#5000aa',
			'header_bg_color_right' => '#bb0005',

			'hero_text_primary' => '',
			'hero_text_secondary' => '',
			'hero_text_primary_color' => '#ffffff',
			'hero_text_secondary_color' => '#ffffff',
		);

		return apply_filters( 'kelso_option_defaults', $kelso_defaults );
	}
}
