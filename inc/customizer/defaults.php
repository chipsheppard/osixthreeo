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
			'background_color'              => '#f3f5f7',
			'containment_setting'           => 'full',
			'header_layout'                 => '',
			'header_padding'                => '16',
			'home_layout_setting'           => 'layout-ns',
			'page_layout_setting'           => 'layout-ns',
			'single_layout_setting'         => 'layout-ns',
			'search_layout_setting'         => 'layout-ns',
			'archive_layout_setting'        => 'layout-ns',
			'header_bg_color_left'          => '#9046ea',
			'header_bg_color_right'         => '#c868d0',
			'header_gradient_angle'         => '90',
			'header_left_stop'              => '0',
			'header_right_stop'             => '100',
			'home_header_fullheight'        => 'adjustable',
			'home_header_height'            => '640',
			'home_mobile_header_height'     => '400',
			'subpage_header_height'         => '360',
			'subpage_mobile_header_height'  => '270',
			'hero_text_primary'             => 'Hello from OsixthreeO',
			'hero_text_secondary'           => '',
			'hero_text_primary_color'       => '#ffffff',
			'hero_text_secondary_color'     => '#ffffff',
			'meta_date'                     => true,
			'meta_author'                   => true,
			'meta_comments'                 => true,
			'meta_updated'                  => true,
			'header_background_color'       => '',
			'nav_link_color'                => '#222222',
			'subnav_text_color'             => '',
			'subnav_bg_color'               => '',
			'subnav_border_color'           => '',
			'subnav_hover_text_color'       => '',
			'subnav_hover_bg_color'         => '',
			'content_bgcolor'               => '',
			'text_color'                    => '#222222',
			'link_color'                    => '#1e90ff',
			'link_color_hover'              => '#b22222',
			'footer_background_color'       => '#000000',
			'footer_text_color'             => '#c0c0c0',
			'footer_link_color'             => '#808080',
			'footer_link_color_hover'       => '#c0c0c0',

			'base_font'                     => '',
			'header_font'                   => '',
			'header_font_weight'            => false,
			'highlite_font'                 => '',

			'sitetitle_font'                => '',
			'sitetitle_font_weight'         => false,
			'sitedescription_font'          => '',
			'sitedescription_font_weight'   => false,
			'menu_font'                     => '',
			'menu_font_weight'              => false,

			'hero_text_primary_font'        => '',
			'hero_text_secondary_font'      => '',

			'base_font_size'                => '16',
			'sitetitle_font_size'           => '48',
			'sitedescription_font_size'     => '16',
			'menu_font_size'                => '16',
			'hero_text_primary_font_size'   => '60',
			'hero_text_secondary_font_size' => '40',
		);

		return apply_filters( 'osixthreeo_option_defaults', $osixthreeo_defaults );
	}
}
