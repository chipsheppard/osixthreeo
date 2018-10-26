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
			'background_color' => '#f5f5f5',
			'content_background_color' => '',
			'content_inner_background_color' => '',
			'content_title_color' => '',
			'content_title_placement' => '',
			'text_color' => '#222222',
			'link_color' => '#1f9bde',
			'link_color_hover' => '#ff9900',

			'header_background_color' => '#ffffff',
			'nav_link_color' => '#222222',

			'stickyheader_background_color' => '#ffffff',
			'stickyheader_text_color' => '#000000',
			'stickyheader_link_color' => '#000000',

			'footerwidgets_background_color' => '#494949',
			'footerwidgets_widget_title_color' => '#dcdcdc',
			'footerwidgets_text_color' => '#dcdcdc',
			'footerwidgets_link_color' => '#c0c0c0',
			'footerwidgets_link_color_hover' => '#f5f5f5',

			'footer_background_color' => '#000000',
			'footer_text_color' => '#c0c0c0',
			'footer_link_color' => '#808080',
			'footer_link_color_hover' => '#c0c0c0',

			'topbar_background_color' => '#ffffff',
			'topbar_widget_title_color' => '#222222',
			'topbar_text_color' => '#222222',
			'topbar_link_color' => '#1f9bde',
			'topbar_link_color_hover' => '#ff9900',

			'global_width_setting' => 'full',

			'home_layout_setting' => 'layout-ns',
			'page_layout_setting' => 'layout-ns',
			'single_layout_setting' => 'layout-ns',
			'search_layout_setting' => 'layout-ns',
			'archive_layout_setting' => 'layout-ns',

			'header_bg_color_left' => '#5000aa',
			'header_bg_color_right' => '#aa0005',

			'header_layout' => '',
			'home_header_height' => '',
			'hero_text_primary' => '',
			'hero_text_secondary' => '',
			'hero_text_primary_color' => '#ffffff',
			'hero_text_secondary_color' => '#ffffff',

			'nav_search' => '',
			'do_masonry' => '',
			'back_to_top' => '',
		);

		return apply_filters( 'kelso_option_defaults', $kelso_defaults );
	}
}
