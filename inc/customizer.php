<?php
/**
 * Theme Customizer.
 *
 * @package  osixthreeo
 * @subpackage osixthreeo/inc
 * @author   Chip Sheppard
 * @since    1.2.0
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'customize_register', 'osixthreeo_set_customizer_helpers', 1 );
/**
 * Set up helpers early so they're always available.
 * Other modules might need access to them at some point.
 *
 * @since 1.0
 */
function osixthreeo_set_customizer_helpers() {
	// Load helper customizer functions.
	// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';
}

if ( ! function_exists( 'osixthreeo_customize_register' ) ) {
	add_action( 'customize_register', 'osixthreeo_customize_register' );
	/**
	 * Add the Customizer options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function osixthreeo_customize_register( $wp_customize ) {

		$defaults = osixthreeo_get_defaults();

		// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';

		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		$wp_customize->get_control( 'header_textcolor' )->label     = 'Site title & description';
		$wp_customize->get_control( 'header_textcolor' )->priority  = 20;

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title a',
					'render_callback' => 'osixthreeo_customize_partial_blogname',
				)
			);
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => 'osixthreeo_customize_partial_blogdescription',
				)
			);
		}

		/**
		 * Render the site title for the selective refresh partial.
		 */
		function osixthreeo_customize_partial_blogname() {
			bloginfo( 'name' );
		}

		/**
		 * Render the site tagline for the selective refresh partial.
		 */
		function osixthreeo_customize_partial_blogdescription() {
			bloginfo( 'description' );
		}

		/*
		 * LAYOUTS -----------------------------------------------------------------------------
		 * new tab -----------------------------------------------------------------------------
		 * -------------------------------------------------------------------------------------
		 * -------------------------------------------------------------------------------------
		 */
		$wp_customize->add_section(
			'osixthreeo_site_layout',
			array(
				'title'    => esc_html__( 'Layouts', 'osixthreeo' ),
				'priority' => 20,
			)
		);

		// section message.
		$wp_customize->add_setting(
			'layout-global-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'layout-global-message',
				array(
					'section'  => 'osixthreeo_site_layout',
					'priority' => 10,
					'label'    => esc_html__( 'Global', 'osixthreeo' ),
				)
			)
		);

		// Layout Site Width.
		$wp_customize->add_setting(
			'osixthreeo_settings[containment_setting]',
			array(
				'default'           => $defaults['containment_setting'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[containment_setting]',
			array(
				'type'     => 'radio',
				'label'    => esc_html__( 'Site Containment', 'osixthreeo' ),
				'section'  => 'osixthreeo_site_layout',
				'choices'  => array(
					'full'      => esc_html__( 'Full Width', 'osixthreeo' ),
					'contained' => esc_html__( 'Contained', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[containment_setting]',
				'priority' => 15,
			)
		);

		/*
		 * Header Layout-----------------
		 */

		// section message.
		$wp_customize->add_setting(
			'layout-header-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'layout-header-message',
				array(
					'label'    => esc_html__( 'Header', 'osixthreeo' ),
					'section'  => 'osixthreeo_site_layout',
					'priority' => 20,
				)
			)
		);

		// Header Layout.
		$wp_customize->add_setting(
			'osixthreeo_settings[header_layout]',
			array(
				'default'           => $defaults['header_layout'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Radio_Image_Control(
				$wp_customize,
				'osixthreeo_settings[header_layout]',
				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Logo & Navigation.', 'osixthreeo' ),
					'description' => esc_html__( 'left & right &nbsp; &nbsp; &nbsp; &nbsp; centered', 'osixthreeo' ),
					'section'     => 'osixthreeo_site_layout',
					'choices'     => array(
						'headernormal'   => esc_html__( 'headernormal', 'osixthreeo' ),
						'headercentered' => esc_html__( 'headercentered', 'osixthreeo' ),
					),
					'settings'    => 'osixthreeo_settings[header_layout]',
					'priority'    => 22,
				)
			)
		);

		// Header Padding.
		$wp_customize->add_setting(
			'osixthreeo_settings[header_padding]',
			array(
				'default'           => $defaults['header_padding'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_integer',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Range_Control(
				$wp_customize,
				'osixthreeo_settings[header_padding]',
				array(
					'type'        => 'range',
					'label'       => esc_html__( 'Top/Bottom Padding', 'osixthreeo' ),
					'section'     => 'osixthreeo_site_layout',
					'settings'    => 'osixthreeo_settings[header_padding]',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 2,
					),
					'priority'    => 25,
				)
			)
		);

		/*
		 * Sidebars -----------------------
		 */

		// section message.
		$wp_customize->add_setting(
			'layout-sidebars-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'layout-sidebars-message',
				array(
					'section'  => 'osixthreeo_site_layout',
					'priority' => 30,
					'label'    => esc_html__( 'Sidebars', 'osixthreeo' ),
				)
			)
		);

		// Layout Home.
		$wp_customize->add_setting(
			'osixthreeo_settings[home_layout_setting]',
			array(
				'default'           => $defaults['home_layout_setting'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Radio_Image_Control(
				$wp_customize,
				'osixthreeo_settings[home_layout_setting]',
				array(
					'type'     => 'select',
					'label'    => esc_html__( 'Homepage', 'osixthreeo' ),
					'section'  => 'osixthreeo_site_layout',
					'choices'  => array(
						'layout-ns' => esc_html__( 'layout-ns', 'osixthreeo' ),
						'layout-ls' => esc_html__( 'layout-ls', 'osixthreeo' ),
						'layout-rs' => esc_html__( 'layout-rs', 'osixthreeo' ),
						'layout-c'  => esc_html__( 'layout-c', 'osixthreeo' ),
					),
					'settings' => 'osixthreeo_settings[home_layout_setting]',
					'priority' => 32,
				)
			)
		);

		// Layout Pages.
		$wp_customize->add_setting(
			'osixthreeo_settings[page_layout_setting]',
			array(
				'default'           => $defaults['page_layout_setting'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Radio_Image_Control(
				$wp_customize,
				'osixthreeo_settings[page_layout_setting]',
				array(
					'type'     => 'select',
					'label'    => esc_html__( 'Pages', 'osixthreeo' ),
					'section'  => 'osixthreeo_site_layout',
					'choices'  => array(
						'layout-ns' => esc_html__( 'layout-ns', 'osixthreeo' ),
						'layout-ls' => esc_html__( 'layout-ls', 'osixthreeo' ),
						'layout-rs' => esc_html__( 'layout-rs', 'osixthreeo' ),
						'layout-c'  => esc_html__( 'layout-c', 'osixthreeo' ),
					),
					'settings' => 'osixthreeo_settings[page_layout_setting]',
					'priority' => 34,
				)
			)
		);

		// Layout Single Posts.
		$wp_customize->add_setting(
			'osixthreeo_settings[single_layout_setting]',
			array(
				'default'           => $defaults['single_layout_setting'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Radio_Image_Control(
				$wp_customize,
				'osixthreeo_settings[single_layout_setting]',
				array(
					'type'     => 'select',
					'label'    => esc_html__( 'Single Post', 'osixthreeo' ),
					'section'  => 'osixthreeo_site_layout',
					'choices'  => array(
						'layout-ns' => esc_html__( 'layout-ns', 'osixthreeo' ),
						'layout-ls' => esc_html__( 'layout-ls', 'osixthreeo' ),
						'layout-rs' => esc_html__( 'layout-rs', 'osixthreeo' ),
						'layout-c'  => esc_html__( 'layout-c', 'osixthreeo' ),
					),
					'settings' => 'osixthreeo_settings[single_layout_setting]',
					'priority' => 36,
				)
			)
		);

		// Layout Archive, Index & 404.
		$wp_customize->add_setting(
			'osixthreeo_settings[archive_layout_setting]',
			array(
				'default'           => $defaults['archive_layout_setting'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Radio_Image_Control(
				$wp_customize,
				'osixthreeo_settings[archive_layout_setting]',
				array(
					'type'     => 'select',
					'label'    => esc_html__( 'Archive/Blog', 'osixthreeo' ),
					'section'  => 'osixthreeo_site_layout',
					'choices'  => array(
						'layout-ns' => esc_html__( 'layout-ns', 'osixthreeo' ),
						'layout-ls' => esc_html__( 'layout-ls', 'osixthreeo' ),
						'layout-rs' => esc_html__( 'layout-rs', 'osixthreeo' ),
						'layout-c'  => esc_html__( 'layout-c', 'osixthreeo' ),
					),
					'settings' => 'osixthreeo_settings[archive_layout_setting]',
					'priority' => 38,
				)
			)
		);

		// Layout Search.
		$wp_customize->add_setting(
			'osixthreeo_settings[search_layout_setting]',
			array(
				'default'           => $defaults['search_layout_setting'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Radio_Image_Control(
				$wp_customize,
				'osixthreeo_settings[search_layout_setting]',
				array(
					'type'     => 'select',
					'label'    => esc_html__( 'Search Results', 'osixthreeo' ),
					'section'  => 'osixthreeo_site_layout',
					'choices'  => array(
						'layout-ns' => esc_html__( 'layout-ns', 'osixthreeo' ),
						'layout-ls' => esc_html__( 'layout-ls', 'osixthreeo' ),
						'layout-rs' => esc_html__( 'layout-rs', 'osixthreeo' ),
						'layout-c'  => esc_html__( 'layout-c', 'osixthreeo' ),
					),
					'settings' => 'osixthreeo_settings[search_layout_setting]',
					'priority' => 40,
				)
			)
		);

		/*
		 * COLORS tab ------------------------------------------------------------------------
		 * -----------------------------------------------------------------------------------
		 * -----------------------------------------------------------------------------------
		 * -----------------------------------------------------------------------------------
		 */

		// HEADER ---------------------------------------------------
		// section message.
		$wp_customize->add_setting(
			'header-colors-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'header-colors-message',
				array(
					'section'  => 'colors',
					'priority' => 12,
					'label'    => esc_html__( 'Header', 'osixthreeo' ),
				)
			)
		);

		// Branding/Nav Background.
		$wp_customize->add_setting(
			'osixthreeo_settings[header_background_color]',
			array(
				'default'           => $defaults['header_background_color'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_rgba',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Alpha_Color_Control(
				$wp_customize,
				'osixthreeo_settings[header_background_color]',
				array(
					'label'        => esc_html__( 'Background', 'osixthreeo' ),
					'section'      => 'colors',
					'settings'     => 'osixthreeo_settings[header_background_color]',
					'priority'     => 15,
					'show_opacity' => true,
				)
			)
		);

		// Nav Link.
		$wp_customize->add_setting(
			'osixthreeo_settings[nav_link_color]',
			array(
				'default'           => $defaults['nav_link_color'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[nav_link_color]',
				array(
					'label'    => esc_html__( 'Menu links', 'osixthreeo' ),
					'section'  => 'colors',
					'settings' => 'osixthreeo_settings[nav_link_color]',
					'priority' => 30,
				)
			)
		);

		// SUBNAV -----------------------
		// section message.
		$wp_customize->add_setting(
			'subnav-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'subnav-message',
				array(
					'section'  => 'colors',
					'priority' => 40,
					'label'    => esc_html__( 'Mobile menu / submenus', 'osixthreeo' ),
				)
			)
		);

		// SubNav link bg-color.
		$wp_customize->add_setting(
			'osixthreeo_settings[subnav_bg_color]',
			array(
				'default'           => $defaults['subnav_bg_color'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[subnav_bg_color]',
				array(
					'label'    => esc_html__( 'Background', 'osixthreeo' ),
					'section'  => 'colors',
					'settings' => 'osixthreeo_settings[subnav_bg_color]',
					'priority' => 41,
				)
			)
		);
		// SubNav Hover bg-color.
		$wp_customize->add_setting(
			'osixthreeo_settings[subnav_hover_bg_color]',
			array(
				'default'           => $defaults['subnav_hover_bg_color'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[subnav_hover_bg_color]',
				array(
					'label'    => esc_html__( 'Hover background', 'osixthreeo' ),
					'section'  => 'colors',
					'settings' => 'osixthreeo_settings[subnav_hover_bg_color]',
					'priority' => 42,
				)
			)
		);

		// SubNav link text color.
		$wp_customize->add_setting(
			'osixthreeo_settings[subnav_text_color]',
			array(
				'default'           => $defaults['subnav_text_color'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[subnav_text_color]',
				array(
					'label'    => esc_html__( 'Links', 'osixthreeo' ),
					'section'  => 'colors',
					'settings' => 'osixthreeo_settings[subnav_text_color]',
					'priority' => 43,
				)
			)
		);
		// SubNav Hover text color.
		$wp_customize->add_setting(
			'osixthreeo_settings[subnav_hover_text_color]',
			array(
				'default'           => $defaults['subnav_hover_text_color'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[subnav_hover_text_color]',
				array(
					'label'    => esc_html__( 'Hover links', 'osixthreeo' ),
					'section'  => 'colors',
					'settings' => 'osixthreeo_settings[subnav_hover_text_color]',
					'priority' => 44,
				)
			)
		);

		// SubNav link border color.
		$wp_customize->add_setting(
			'osixthreeo_settings[subnav_border_color]',
			array(
				'default'           => $defaults['subnav_border_color'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[subnav_border_color]',
				array(
					'label'    => esc_html__( 'Border', 'osixthreeo' ),
					'section'  => 'colors',
					'settings' => 'osixthreeo_settings[subnav_border_color]',
					'priority' => 45,
				)
			)
		);

		// CONTENT AREA --------------------------------------------------
		// section message.
		$wp_customize->add_setting(
			'content-colors-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'content-colors-message',
				array(
					'section'  => 'colors',
					'priority' => 50,
					'label'    => esc_html__( 'Content Area', 'osixthreeo' ),
				)
			)
		);

		// Content area bg.
		$wp_customize->add_setting(
			'osixthreeo_settings[content_bgcolor]',
			array(
				'default'           => $defaults['content_bgcolor'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_rgba',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Alpha_Color_Control(
				$wp_customize,
				'osixthreeo_settings[content_bgcolor]',
				array(
					'label'        => esc_html__( 'Background', 'osixthreeo' ),
					'section'      => 'colors',
					'settings'     => 'osixthreeo_settings[content_bgcolor]',
					'priority'     => 51,
					'show_opacity' => true,
				)
			)
		);

		// Text.
		$wp_customize->add_setting(
			'osixthreeo_settings[text_color]',
			array(
				'default'           => $defaults['text_color'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[text_color]',
				array(
					'label'    => esc_html__( 'Text', 'osixthreeo' ),
					'section'  => 'colors',
					'settings' => 'osixthreeo_settings[text_color]',
					'priority' => 52,
				)
			)
		);

		// Primary Highlight.
		$wp_customize->add_setting(
			'osixthreeo_settings[link_color]',
			array(
				'default'           => $defaults['link_color'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[link_color]',
				array(
					'label'    => esc_html__( 'Links', 'osixthreeo' ),
					'section'  => 'colors',
					'settings' => 'osixthreeo_settings[link_color]',
					'priority' => 53,
				)
			)
		);

		// Secondary Highlight.
		$wp_customize->add_setting(
			'osixthreeo_settings[link_color_hover]',
			array(
				'default'           => $defaults['link_color_hover'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[link_color_hover]',
				array(
					'label'    => esc_html__( 'Hover links', 'osixthreeo' ),
					'section'  => 'colors',
					'settings' => 'osixthreeo_settings[link_color_hover]',
					'priority' => 54,
				)
			)
		);

		// FOOTER ---------------------------------------------------------
		// HTML section - section message.
		$wp_customize->add_setting(
			'footer-color-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'footer-color-message',
				array(
					'section'  => 'colors',
					'priority' => 70,
					'label'    => esc_html__( 'Footer', 'osixthreeo' ),
				)
			)
		);

		// Footer - Background.
		$wp_customize->add_setting(
			'osixthreeo_settings[footer_background_color]',
			array(
				'default'           => $defaults['footer_background_color'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[footer_background_color]',
				array(
					'label'    => esc_html__( 'Background', 'osixthreeo' ),
					'section'  => 'colors',
					'settings' => 'osixthreeo_settings[footer_background_color]',
					'priority' => 71,
				)
			)
		);

		// Footer - Text.
		$wp_customize->add_setting(
			'osixthreeo_settings[footer_text_color]',
			array(
				'default'           => $defaults['footer_text_color'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[footer_text_color]',
				array(
					'label'    => esc_html__( 'Text', 'osixthreeo' ),
					'section'  => 'colors',
					'settings' => 'osixthreeo_settings[footer_text_color]',
					'priority' => 72,
				)
			)
		);

		// Footer - Link.
		$wp_customize->add_setting(
			'osixthreeo_settings[footer_link_color]',
			array(
				'default'           => $defaults['footer_link_color'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[footer_link_color]',
				array(
					'label'    => esc_html__( 'Links', 'osixthreeo' ),
					'section'  => 'colors',
					'settings' => 'osixthreeo_settings[footer_link_color]',
					'priority' => 73,
				)
			)
		);

		// Footer - Link Hover.
		$wp_customize->add_setting(
			'osixthreeo_settings[footer_link_color_hover]',
			array(
				'default'           => $defaults['footer_link_color_hover'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[footer_link_color_hover]',
				array(
					'label'    => esc_html__( 'Hover links', 'osixthreeo' ),
					'section'  => 'colors',
					'settings' => 'osixthreeo_settings[footer_link_color_hover]',
					'priority' => 74,
				)
			)
		);

		/*
		 * Typography - tab -------------------------------------------------------------------
		 * ------------------------------------------------------------------------------------
		 * ------------------------------------------------------------------------------------
		 * ------------------------------------------------------------------------------------
		 */

		$wp_customize->add_section(
			'osixthreeo_typography',
			array(
				'title'    => esc_html__( 'Typography', 'osixthreeo' ),
				'priority' => 40,
			)
		);

		// BASE Font.
		$wp_customize->add_setting(
			'osixthreeo_settings[base_font]',
			array(
				'default'           => $defaults['base_font'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[base_font]',
			array(
				'type'     => 'select',
				'label'    => esc_html__( 'Base font', 'osixthreeo' ),
				'section'  => 'osixthreeo_typography',
				'choices'  => array(
					''                     => esc_html__( 'Arial - default', 'osixthreeo' ),
					'georgia'              => esc_html__( 'Georgia', 'osixthreeo' ),
					'verdana'              => esc_html__( 'Verdana', 'osixthreeo' ),
					'trebuchet'            => esc_html__( 'Trebuchet', 'osixthreeo' ),
					'palatino'             => esc_html__( 'Palatino', 'osixthreeo' ),
					'tahoma'               => esc_html__( 'Tahoma', 'osixthreeo' ),
					'times'                => esc_html__( 'Times', 'osixthreeo' ),
					'arialblack'           => esc_html__( 'Arial Black', 'osixthreeo' ),
					'impact'               => esc_html__( 'Impact', 'osixthreeo' ),
					'copperplate'          => esc_html__( 'Copperplate', 'osixthreeo' ),
					'papyrus'              => esc_html__( 'Papyrus', 'osixthreeo' ),
					'courier'              => esc_html__( 'Courier', 'osixthreeo' ),
					'lucidatypewritter'    => esc_html__( 'Lucida Typewritter', 'osixthreeo' ),
					'comicsans'            => esc_html__( 'Comic Sans', 'osixthreeo' ),

					'alegreya'             => esc_html__( 'Alegreya', 'osixthreeo' ),
					'alegreyasc'           => esc_html__( 'Alegreya SC', 'osixthreeo' ),
					'alegreyasans'         => esc_html__( 'Alegreya Sans', 'osixthreeo' ),
					'alegreyasanssc'       => esc_html__( 'Alegreya Sans SC', 'osixthreeo' ),
					'archivo'              => esc_html__( 'Archivo', 'osixthreeo' ),
					'archivonarrow'        => esc_html__( 'Archivo Narrow', 'osixthreeo' ),
					'arvo'                 => esc_html__( 'Arvo', 'osixthreeo' ),
					'abrilfatface'         => esc_html__( 'Abril Fatface', 'osixthreeo' ),
					'alfaslabone'          => esc_html__( 'Alfa Slab One', 'osixthreeo' ),

					'b612'                 => esc_html__( 'B612', 'osixthreeo' ),
					'biothyme'             => esc_html__( 'BioRhyme', 'osixthreeo' ),
					'baloo'                => esc_html__( 'Baloo', 'osixthreeo' ),
					'barrio'               => esc_html__( 'Barrio', 'osixthreeo' ),
					'blackopsone'          => esc_html__( 'Black Ops One', 'osixthreeo' ),

					'cabin'                => esc_html__( 'Cabin', 'osixthreeo' ),
					'cairo'                => esc_html__( 'Cairo', 'osixthreeo' ),
					'chivo'                => esc_html__( 'Chivo', 'osixthreeo' ),
					'cardo'                => esc_html__( 'Cardo', 'osixthreeo' ),
					'cormorant'            => esc_html__( 'Cormorant', 'osixthreeo' ),
					'crimsontext'          => esc_html__( 'Crimson Text', 'osixthreeo' ),
					'cabinsketch'          => esc_html__( 'Cabin Sketch', 'osixthreeo' ),
					'chelaone'             => esc_html__( 'Chela One', 'osixthreeo' ),
					'concertone'           => esc_html__( 'Concert One', 'osixthreeo' ),

					'domine'               => esc_html__( 'Domine', 'osixthreeo' ),

					'exo2'                 => esc_html__( 'Exo 2', 'osixthreeo' ),
					'eczar'                => esc_html__( 'Eczar', 'osixthreeo' ),
					'ericaone'             => esc_html__( 'Erica One', 'osixthreeo' ),

					'fjallaone'            => esc_html__( 'Fjalla One', 'osixthreeo' ),
					'firasans'             => esc_html__( 'Fira Sans', 'osixthreeo' ),
					'frankruhllibre'       => esc_html__( 'Frank Ruhl Libre', 'osixthreeo' ),
					'fascinate'            => esc_html__( 'Fascinate', 'osixthreeo' ),
					'flamenco'             => esc_html__( 'Flamenco', 'osixthreeo' ),
					'frederickathegreat'   => esc_html__( 'Fredericka the Great', 'osixthreeo' ),

					'ibmplexsans'          => esc_html__( 'IBM Plex Sans', 'osixthreeo' ),
					'ibmplexserif'         => esc_html__( 'IBM Plex Serif', 'osixthreeo' ),
					'inknutantiqua'        => esc_html__( 'Inknut Antiqua', 'osixthreeo' ),
					'inconsolata'          => esc_html__( 'Inconsolata', 'osixthreeo' ),

					'karla'                => esc_html__( 'Karla', 'osixthreeo' ),

					'lato'                 => esc_html__( 'Lato', 'osixthreeo' ),
					'librefranklin'        => esc_html__( 'Libre Franklin', 'osixthreeo' ),
					'librebaskerville'     => esc_html__( 'Libre Baskerville', 'osixthreeo' ),
					'lora'                 => esc_html__( 'Lora', 'osixthreeo' ),
					'lilyscriptone'        => esc_html__( 'Lily Script One', 'osixthreeo' ),
					'lobster'              => esc_html__( 'Lobster', 'osixthreeo' ),
					'lobstertwo'           => esc_html__( 'Lobster Two', 'osixthreeo' ),

					'montserrat'           => esc_html__( 'Montserrat', 'osixthreeo' ),
					'montserratalternates' => esc_html__( 'Montserrat Alternates', 'osixthreeo' ),
					'muli'                 => esc_html__( 'Muli', 'osixthreeo' ),
					'merriweather'         => esc_html__( 'Merriweather', 'osixthreeo' ),
					'monoton'              => esc_html__( 'Monoton', 'osixthreeo' ),

					'notosans'             => esc_html__( 'Noto Sans', 'osixthreeo' ),
					'nunito'               => esc_html__( 'Nunito', 'osixthreeo' ),
					'neuton'               => esc_html__( 'Neuton', 'osixthreeo' ),
					'nixieone'             => esc_html__( 'Nixie One', 'osixthreeo' ),

					'opensans'             => esc_html__( 'Open Sans', 'osixthreeo' ),
					'oswald'               => esc_html__( 'Oswald', 'osixthreeo' ),
					'oxygen'               => esc_html__( 'Oxygen', 'osixthreeo' ),
					'oldstandardtt'        => esc_html__( 'Old Standard TT', 'osixthreeo' ),
					'oleoscript'           => esc_html__( 'Oleo Script', 'osixthreeo' ),
					'oleoscriptswashcaps'  => esc_html__( 'Oleo Script Swash Caps', 'osixthreeo' ),

					'poppins'              => esc_html__( 'Poppins', 'osixthreeo' ),
					'prozalibre'           => esc_html__( 'Proza Libre', 'osixthreeo' ),
					'ptsans'               => esc_html__( 'PT Sans', 'osixthreeo' ),
					'playfairdisplay'      => esc_html__( 'Playfair Display', 'osixthreeo' ),
					'ptserif'              => esc_html__( 'PT Serif', 'osixthreeo' ),

					'raleway'              => esc_html__( 'Raleway', 'osixthreeo' ),
					'roboto'               => esc_html__( 'Roboto', 'osixthreeo' ),
					'rubik'                => esc_html__( 'Rubik', 'osixthreeo' ),
					'robotoslab'           => esc_html__( 'Roboto Slab','osixthreeo' ),
					'rokkitt'              => esc_html__( 'Rokkitt', 'osixthreeo' ),
					'ranchers'             => esc_html__( 'Ranchers', 'osixthreeo' ),
					'rakkas'               => esc_html__( 'Rakkas',  'osixthreeo' ),

					'sourcesanspro'        => esc_html__( 'Source Sans Pro', 'osixthreeo' ),
					'sourceserifpro'       => esc_html__( 'Source Serif Pro', 'osixthreeo' ),
					'spectral'             => esc_html__( 'Spectral', 'osixthreeo' ),
					'specialelite'         => esc_html__( 'Special Elite', 'osixthreeo' ),
					'spacemono'            => esc_html__( 'Space Mono', 'osixthreeo' ),

					'titilliumweb'         => esc_html__( 'Titillium Web', 'osixthreeo' ),
					'ubuntu'               => esc_html__( 'Ubuntu', 'osixthreeo' ),
					'varela'               => esc_html__( 'Varela', 'osixthreeo' ),
					'varelaround'          => esc_html__( 'Varela Round', 'osixthreeo' ),
					'vollkorn'             => esc_html__( 'Vollkorn', 'osixthreeo' ),
					'vollkornsc'           => esc_html__( 'Vollkorn SC', 'osixthreeo' ),
					'worksans'             => esc_html__( 'Work Sans', 'osixthreeo' ),
					'yatraone'             => esc_html__( 'Yatra One', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[base_font]',
				'priority' => 10,
			)
		);

		// HEADERs Font.
		$wp_customize->add_setting(
			'osixthreeo_settings[header_font]',
			array(
				'default'           => $defaults['header_font'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[header_font]',
			array(
				'type'     => 'select',
				'label'    => esc_html__( 'Header font', 'osixthreeo' ),
				'section'  => 'osixthreeo_typography',
				'optgroup'          => true,
				'choices'  => array(
					''                     => esc_html__( 'Arial - default', 'osixthreeo' ),
					'georgia'              => esc_html__( 'Georgia', 'osixthreeo' ),
					'verdana'              => esc_html__( 'Verdana', 'osixthreeo' ),
					'trebuchet'            => esc_html__( 'Trebuchet', 'osixthreeo' ),
					'palatino'             => esc_html__( 'Palatino', 'osixthreeo' ),
					'tahoma'               => esc_html__( 'Tahoma', 'osixthreeo' ),
					'times'                => esc_html__( 'Times', 'osixthreeo' ),
					'arialblack'           => esc_html__( 'Arial Black', 'osixthreeo' ),
					'impact'               => esc_html__( 'Impact', 'osixthreeo' ),
					'copperplate'          => esc_html__( 'Copperplate', 'osixthreeo' ),
					'papyrus'              => esc_html__( 'Papyrus', 'osixthreeo' ),
					'courier'              => esc_html__( 'Courier', 'osixthreeo' ),
					'lucidatypewritter'    => esc_html__( 'Lucida Typewritter', 'osixthreeo' ),
					'comicsans'            => esc_html__( 'Comic Sans', 'osixthreeo' ),
					'alegreya'             => esc_html__( 'Alegreya', 'osixthreeo' ),
					'alegreyasc'           => esc_html__( 'Alegreya SC', 'osixthreeo' ),
					'alegreyasans'         => esc_html__( 'Alegreya Sans', 'osixthreeo' ),
					'alegreyasanssc'       => esc_html__( 'Alegreya Sans SC', 'osixthreeo' ),
					'archivo'              => esc_html__( 'Archivo', 'osixthreeo' ),
					'archivonarrow'        => esc_html__( 'Archivo Narrow', 'osixthreeo' ),
					'arvo'                 => esc_html__( 'Arvo', 'osixthreeo' ),
					'abrilfatface'         => esc_html__( 'Abril Fatface', 'osixthreeo' ),
					'alfaslabone'          => esc_html__( 'Alfa Slab One', 'osixthreeo' ),
					'b612'                 => esc_html__( 'B612', 'osixthreeo' ),
					'biothyme'             => esc_html__( 'BioRhyme', 'osixthreeo' ),
					'baloo'                => esc_html__( 'Baloo', 'osixthreeo' ),
					'barrio'               => esc_html__( 'Barrio', 'osixthreeo' ),
					'blackopsone'          => esc_html__( 'Black Ops One', 'osixthreeo' ),
					'cabin'                => esc_html__( 'Cabin', 'osixthreeo' ),
					'cairo'                => esc_html__( 'Cairo', 'osixthreeo' ),
					'chivo'                => esc_html__( 'Chivo', 'osixthreeo' ),
					'cardo'                => esc_html__( 'Cardo', 'osixthreeo' ),
					'cormorant'            => esc_html__( 'Cormorant', 'osixthreeo' ),
					'crimsontext'          => esc_html__( 'Crimson Text', 'osixthreeo' ),
					'cabinsketch'          => esc_html__( 'Cabin Sketch', 'osixthreeo' ),
					'chelaone'             => esc_html__( 'Chela One', 'osixthreeo' ),
					'concertone'           => esc_html__( 'Concert One', 'osixthreeo' ),
					'domine'               => esc_html__( 'Domine', 'osixthreeo' ),
					'exo2'                 => esc_html__( 'Exo 2', 'osixthreeo' ),
					'eczar'                => esc_html__( 'Eczar', 'osixthreeo' ),
					'ericaone'             => esc_html__( 'Erica One', 'osixthreeo' ),
					'fjallaone'            => esc_html__( 'Fjalla One', 'osixthreeo' ),
					'firasans'             => esc_html__( 'Fira Sans', 'osixthreeo' ),
					'frankruhllibre'       => esc_html__( 'Frank Ruhl Libre', 'osixthreeo' ),
					'fascinate'            => esc_html__( 'Fascinate', 'osixthreeo' ),
					'flamenco'             => esc_html__( 'Flamenco', 'osixthreeo' ),
					'frederickathegreat'   => esc_html__( 'Fredericka the Great', 'osixthreeo' ),
					'ibmplexsans'          => esc_html__( 'IBM Plex Sans', 'osixthreeo' ),
					'ibmplexserif'         => esc_html__( 'IBM Plex Serif', 'osixthreeo' ),
					'inknutantiqua'        => esc_html__( 'Inknut Antiqua', 'osixthreeo' ),
					'inconsolata'          => esc_html__( 'Inconsolata', 'osixthreeo' ),
					'karla'                => esc_html__( 'Karla', 'osixthreeo' ),
					'lato'                 => esc_html__( 'Lato', 'osixthreeo' ),
					'librefranklin'        => esc_html__( 'Libre Franklin', 'osixthreeo' ),
					'librebaskerville'     => esc_html__( 'Libre Baskerville', 'osixthreeo' ),
					'lora'                 => esc_html__( 'Lora', 'osixthreeo' ),
					'lilyscriptone'        => esc_html__( 'Lily Script One', 'osixthreeo' ),
					'lobster'              => esc_html__( 'Lobster', 'osixthreeo' ),
					'lobstertwo'           => esc_html__( 'Lobster Two', 'osixthreeo' ),
					'montserrat'           => esc_html__( 'Montserrat', 'osixthreeo' ),
					'montserratalternates' => esc_html__( 'Montserrat Alternates', 'osixthreeo' ),
					'muli'                 => esc_html__( 'Muli', 'osixthreeo' ),
					'merriweather'         => esc_html__( 'Merriweather', 'osixthreeo' ),
					'monoton'              => esc_html__( 'Monoton', 'osixthreeo' ),
					'notosans'             => esc_html__( 'Noto Sans', 'osixthreeo' ),
					'nunito'               => esc_html__( 'Nunito', 'osixthreeo' ),
					'neuton'               => esc_html__( 'Neuton', 'osixthreeo' ),
					'nixieone'             => esc_html__( 'Nixie One', 'osixthreeo' ),
					'opensans'             => esc_html__( 'Open Sans', 'osixthreeo' ),
					'oswald'               => esc_html__( 'Oswald', 'osixthreeo' ),
					'oxygen'               => esc_html__( 'Oxygen', 'osixthreeo' ),
					'oldstandardtt'        => esc_html__( 'Old Standard TT', 'osixthreeo' ),
					'oleoscript'           => esc_html__( 'Oleo Script', 'osixthreeo' ),
					'oleoscriptswashcaps'  => esc_html__( 'Oleo Script Swash Caps', 'osixthreeo' ),
					'poppins'              => esc_html__( 'Poppins', 'osixthreeo' ),
					'prozalibre'           => esc_html__( 'Proza Libre', 'osixthreeo' ),
					'ptsans'               => esc_html__( 'PT Sans', 'osixthreeo' ),
					'playfairdisplay'      => esc_html__( 'Playfair Display', 'osixthreeo' ),
					'ptserif'              => esc_html__( 'PT Serif', 'osixthreeo' ),
					'raleway'              => esc_html__( 'Raleway', 'osixthreeo' ),
					'roboto'               => esc_html__( 'Roboto', 'osixthreeo' ),
					'rubik'                => esc_html__( 'Rubik', 'osixthreeo' ),
					'robotoslab'           => esc_html__( 'Roboto Slab','osixthreeo' ),
					'rokkitt'              => esc_html__( 'Rokkitt', 'osixthreeo' ),
					'ranchers'             => esc_html__( 'Ranchers', 'osixthreeo' ),
					'rakkas'               => esc_html__( 'Rakkas',  'osixthreeo' ),
					'sourcesanspro'        => esc_html__( 'Source Sans Pro', 'osixthreeo' ),
					'sourceserifpro'       => esc_html__( 'Source Serif Pro', 'osixthreeo' ),
					'spectral'             => esc_html__( 'Spectral', 'osixthreeo' ),
					'specialelite'         => esc_html__( 'Special Elite', 'osixthreeo' ),
					'spacemono'            => esc_html__( 'Space Mono', 'osixthreeo' ),
					'titilliumweb'         => esc_html__( 'Titillium Web', 'osixthreeo' ),
					'ubuntu'               => esc_html__( 'Ubuntu', 'osixthreeo' ),
					'varela'               => esc_html__( 'Varela', 'osixthreeo' ),
					'varelaround'          => esc_html__( 'Varela Round', 'osixthreeo' ),
					'vollkorn'             => esc_html__( 'Vollkorn', 'osixthreeo' ),
					'vollkornsc'           => esc_html__( 'Vollkorn SC', 'osixthreeo' ),
					'worksans'             => esc_html__( 'Work Sans', 'osixthreeo' ),
					'yatraone'             => esc_html__( 'Yatra One', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[header_font]',
				'priority' => 20,
			)
		);

		// HIGHLITE Font.
		$wp_customize->add_setting(
			'osixthreeo_settings[highlite_font]',
			array(
				'default'           => $defaults['highlite_font'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[highlite_font]',
			array(
				'type'     => 'select',
				'label'    => esc_html__( 'Highlite font', 'osixthreeo' ),
				'section'  => 'osixthreeo_typography',
				'choices'  => array(
					''                     => esc_html__( 'Arial - default', 'osixthreeo' ),
					'georgia'              => esc_html__( 'Georgia', 'osixthreeo' ),
					'verdana'              => esc_html__( 'Verdana', 'osixthreeo' ),
					'trebuchet'            => esc_html__( 'Trebuchet', 'osixthreeo' ),
					'palatino'             => esc_html__( 'Palatino', 'osixthreeo' ),
					'tahoma'               => esc_html__( 'Tahoma', 'osixthreeo' ),
					'times'                => esc_html__( 'Times', 'osixthreeo' ),
					'arialblack'           => esc_html__( 'Arial Black', 'osixthreeo' ),
					'impact'               => esc_html__( 'Impact', 'osixthreeo' ),
					'copperplate'          => esc_html__( 'Copperplate', 'osixthreeo' ),
					'papyrus'              => esc_html__( 'Papyrus', 'osixthreeo' ),
					'courier'              => esc_html__( 'Courier', 'osixthreeo' ),
					'lucidatypewritter'    => esc_html__( 'Lucida Typewritter', 'osixthreeo' ),
					'comicsans'            => esc_html__( 'Comic Sans', 'osixthreeo' ),
					'alegreya'             => esc_html__( 'Alegreya', 'osixthreeo' ),
					'alegreyasc'           => esc_html__( 'Alegreya SC', 'osixthreeo' ),
					'alegreyasans'         => esc_html__( 'Alegreya Sans', 'osixthreeo' ),
					'alegreyasanssc'       => esc_html__( 'Alegreya Sans SC', 'osixthreeo' ),
					'archivo'              => esc_html__( 'Archivo', 'osixthreeo' ),
					'archivonarrow'        => esc_html__( 'Archivo Narrow', 'osixthreeo' ),
					'arvo'                 => esc_html__( 'Arvo', 'osixthreeo' ),
					'abrilfatface'         => esc_html__( 'Abril Fatface', 'osixthreeo' ),
					'alfaslabone'          => esc_html__( 'Alfa Slab One', 'osixthreeo' ),
					'b612'                 => esc_html__( 'B612', 'osixthreeo' ),
					'biothyme'             => esc_html__( 'BioRhyme', 'osixthreeo' ),
					'baloo'                => esc_html__( 'Baloo', 'osixthreeo' ),
					'barrio'               => esc_html__( 'Barrio', 'osixthreeo' ),
					'blackopsone'          => esc_html__( 'Black Ops One', 'osixthreeo' ),
					'cabin'                => esc_html__( 'Cabin', 'osixthreeo' ),
					'cairo'                => esc_html__( 'Cairo', 'osixthreeo' ),
					'chivo'                => esc_html__( 'Chivo', 'osixthreeo' ),
					'cardo'                => esc_html__( 'Cardo', 'osixthreeo' ),
					'cormorant'            => esc_html__( 'Cormorant', 'osixthreeo' ),
					'crimsontext'          => esc_html__( 'Crimson Text', 'osixthreeo' ),
					'cabinsketch'          => esc_html__( 'Cabin Sketch', 'osixthreeo' ),
					'chelaone'             => esc_html__( 'Chela One', 'osixthreeo' ),
					'concertone'           => esc_html__( 'Concert One', 'osixthreeo' ),
					'domine'               => esc_html__( 'Domine', 'osixthreeo' ),
					'exo2'                 => esc_html__( 'Exo 2', 'osixthreeo' ),
					'eczar'                => esc_html__( 'Eczar', 'osixthreeo' ),
					'ericaone'             => esc_html__( 'Erica One', 'osixthreeo' ),
					'fjallaone'            => esc_html__( 'Fjalla One', 'osixthreeo' ),
					'firasans'             => esc_html__( 'Fira Sans', 'osixthreeo' ),
					'frankruhllibre'       => esc_html__( 'Frank Ruhl Libre', 'osixthreeo' ),
					'fascinate'            => esc_html__( 'Fascinate', 'osixthreeo' ),
					'flamenco'             => esc_html__( 'Flamenco', 'osixthreeo' ),
					'frederickathegreat'   => esc_html__( 'Fredericka the Great', 'osixthreeo' ),
					'ibmplexsans'          => esc_html__( 'IBM Plex Sans', 'osixthreeo' ),
					'ibmplexserif'         => esc_html__( 'IBM Plex Serif', 'osixthreeo' ),
					'inknutantiqua'        => esc_html__( 'Inknut Antiqua', 'osixthreeo' ),
					'inconsolata'          => esc_html__( 'Inconsolata', 'osixthreeo' ),
					'karla'                => esc_html__( 'Karla', 'osixthreeo' ),
					'lato'                 => esc_html__( 'Lato', 'osixthreeo' ),
					'librefranklin'        => esc_html__( 'Libre Franklin', 'osixthreeo' ),
					'librebaskerville'     => esc_html__( 'Libre Baskerville', 'osixthreeo' ),
					'lora'                 => esc_html__( 'Lora', 'osixthreeo' ),
					'lilyscriptone'        => esc_html__( 'Lily Script One', 'osixthreeo' ),
					'lobster'              => esc_html__( 'Lobster', 'osixthreeo' ),
					'lobstertwo'           => esc_html__( 'Lobster Two', 'osixthreeo' ),
					'montserrat'           => esc_html__( 'Montserrat', 'osixthreeo' ),
					'montserratalternates' => esc_html__( 'Montserrat Alternates', 'osixthreeo' ),
					'muli'                 => esc_html__( 'Muli', 'osixthreeo' ),
					'merriweather'         => esc_html__( 'Merriweather', 'osixthreeo' ),
					'monoton'              => esc_html__( 'Monoton', 'osixthreeo' ),
					'notosans'             => esc_html__( 'Noto Sans', 'osixthreeo' ),
					'nunito'               => esc_html__( 'Nunito', 'osixthreeo' ),
					'neuton'               => esc_html__( 'Neuton', 'osixthreeo' ),
					'nixieone'             => esc_html__( 'Nixie One', 'osixthreeo' ),
					'opensans'             => esc_html__( 'Open Sans', 'osixthreeo' ),
					'oswald'               => esc_html__( 'Oswald', 'osixthreeo' ),
					'oxygen'               => esc_html__( 'Oxygen', 'osixthreeo' ),
					'oldstandardtt'        => esc_html__( 'Old Standard TT', 'osixthreeo' ),
					'oleoscript'           => esc_html__( 'Oleo Script', 'osixthreeo' ),
					'oleoscriptswashcaps'  => esc_html__( 'Oleo Script Swash Caps', 'osixthreeo' ),
					'poppins'              => esc_html__( 'Poppins', 'osixthreeo' ),
					'prozalibre'           => esc_html__( 'Proza Libre', 'osixthreeo' ),
					'ptsans'               => esc_html__( 'PT Sans', 'osixthreeo' ),
					'playfairdisplay'      => esc_html__( 'Playfair Display', 'osixthreeo' ),
					'ptserif'              => esc_html__( 'PT Serif', 'osixthreeo' ),
					'raleway'              => esc_html__( 'Raleway', 'osixthreeo' ),
					'roboto'               => esc_html__( 'Roboto', 'osixthreeo' ),
					'rubik'                => esc_html__( 'Rubik', 'osixthreeo' ),
					'robotoslab'           => esc_html__( 'Roboto Slab','osixthreeo' ),
					'rokkitt'              => esc_html__( 'Rokkitt', 'osixthreeo' ),
					'ranchers'             => esc_html__( 'Ranchers', 'osixthreeo' ),
					'rakkas'               => esc_html__( 'Rakkas',  'osixthreeo' ),
					'sourcesanspro'        => esc_html__( 'Source Sans Pro', 'osixthreeo' ),
					'sourceserifpro'       => esc_html__( 'Source Serif Pro', 'osixthreeo' ),
					'spectral'             => esc_html__( 'Spectral', 'osixthreeo' ),
					'specialelite'         => esc_html__( 'Special Elite', 'osixthreeo' ),
					'spacemono'            => esc_html__( 'Space Mono', 'osixthreeo' ),
					'titilliumweb'         => esc_html__( 'Titillium Web', 'osixthreeo' ),
					'ubuntu'               => esc_html__( 'Ubuntu', 'osixthreeo' ),
					'varela'               => esc_html__( 'Varela', 'osixthreeo' ),
					'varelaround'          => esc_html__( 'Varela Round', 'osixthreeo' ),
					'vollkorn'             => esc_html__( 'Vollkorn', 'osixthreeo' ),
					'vollkornsc'           => esc_html__( 'Vollkorn SC', 'osixthreeo' ),
					'worksans'             => esc_html__( 'Work Sans', 'osixthreeo' ),
					'yatraone'             => esc_html__( 'Yatra One', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[highlite_font]',
				'priority' => 40,
			)
		);

		// section message.
		$wp_customize->add_setting(
			'font-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'font-message',
				array(
					'section'  => 'osixthreeo_typography',
					'priority' => 50,
					'content'  => __( 'To avoid theme bloat a maximum of 3 fonts can be used.<br /><br />Using the controls below assign them to areas of the site.', 'osixthreeo' ) . '</p>',
				)
			)
		);

		// section message.
		$wp_customize->add_setting(
			'title-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'title-message',
				array(
					'section'  => 'osixthreeo_typography',
					'priority' => 55,
					'label'  => esc_html__( 'Site Title', 'osixthreeo' ),
				)
			)
		);

		// SITE TITLE Font.
		$wp_customize->add_setting(
			'osixthreeo_settings[sitetitle_font]',
			array(
				'default'           => $defaults['sitetitle_font'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[sitetitle_font]',
			array(
				'type'        => 'select',
				'label'       => esc_html__( 'Site Title font', 'osixthreeo' ),
				'section'     => 'osixthreeo_typography',
				'choices'     => array(
					''         => esc_html__( 'Base font', 'osixthreeo' ),
					'header'   => esc_html__( 'Header font', 'osixthreeo' ),
					'highlite' => esc_html__( 'Highlite font', 'osixthreeo' ),
				),
				'settings'    => 'osixthreeo_settings[sitetitle_font]',
				'priority'    => 60,
			)
		);

		// SITE TITLE font size.
		$wp_customize->add_setting(
			'osixthreeo_settings[sitetitle_font_size]',
			array(
				'default'           => $defaults['sitetitle_font_size'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_integer',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Range_Control(
				$wp_customize,
				'osixthreeo_settings[sitetitle_font_size]',
				array(
					'type'        => 'range',
					'label'       => esc_html__( 'Site Title font size', 'osixthreeo' ),
					'section'     => 'osixthreeo_typography',
					'settings'    => 'osixthreeo_settings[sitetitle_font_size]',
					'input_attrs' => array(
						'min'  => 24,
						'max'  => 72,
						'step' => 1,
					),
					'priority'    => 63,
				)
			)
		);

		// SITE TITLE bold.
		$wp_customize->add_setting(
			'osixthreeo_settings[sitetitle_font_weight]',
			array(
				'default'           => $defaults['sitetitle_font_weight'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[sitetitle_font_weight]',
			array(
				'type'     => 'select',
				'label'    => esc_html__( 'Site Title font weight', 'osixthreeo' ),
				'section'  => 'osixthreeo_typography',
				'choices'  => array(
					'' => esc_html__( 'Default', 'osixthreeo' ),
					'100' => esc_html__( 'Thin: 100', 'osixthreeo' ),
					'200' => esc_html__( 'Light: 200', 'osixthreeo' ),
					'300' => esc_html__( 'Book: 300', 'osixthreeo' ),
					'400' => esc_html__( 'Normal: 400', 'osixthreeo' ),
					'500' => esc_html__( 'Medium: 500', 'osixthreeo' ),
					'600' => esc_html__( 'Semibold: 600', 'osixthreeo' ),
					'700' => esc_html__( 'Bold: 700', 'osixthreeo' ),
					'800' => esc_html__( 'Extra Bold: 800', 'osixthreeo' ),
					'900' => esc_html__( 'Black: 900', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[sitetitle_font_weight]',
				'priority' => 65,
			)
		);

		// section message.
		$wp_customize->add_setting(
			'description-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'description-message',
				array(
					'section'  => 'osixthreeo_typography',
					'priority' => 67,
					'label'  => esc_html__( 'Site Description', 'osixthreeo' ),
				)
			)
		);

		// SITE DESCRIPTION Font.
		$wp_customize->add_setting(
			'osixthreeo_settings[sitedescription_font]',
			array(
				'default'           => $defaults['sitedescription_font'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[sitedescription_font]',
			array(
				'type'        => 'select',
				'label'       => esc_html__( 'Description font', 'osixthreeo' ),
				'section'     => 'osixthreeo_typography',
				'choices'     => array(
					''         => esc_html__( 'Base font', 'osixthreeo' ),
					'header'   => esc_html__( 'Header font', 'osixthreeo' ),
					'highlite' => esc_html__( 'Highlite font', 'osixthreeo' ),
				),
				'settings'    => 'osixthreeo_settings[sitedescription_font]',
				'priority'    => 70,
			)
		);

		// SITE DESCRIPTION font size.
		$wp_customize->add_setting(
			'osixthreeo_settings[sitedescription_font_size]',
			array(
				'default'           => $defaults['sitedescription_font_size'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_integer',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Range_Control(
				$wp_customize,
				'osixthreeo_settings[sitedescription_font_size]',
				array(
					'type'        => 'range',
					'label'       => esc_html__( 'Description font size', 'osixthreeo' ),
					'section'     => 'osixthreeo_typography',
					'settings'    => 'osixthreeo_settings[sitedescription_font_size]',
					'input_attrs' => array(
						'min'  => 12,
						'max'  => 20,
						'step' => 1,
					),
					'priority'    => 73,
				)
			)
		);

		// SITE DESCRIPTION weight.
		$wp_customize->add_setting(
			'osixthreeo_settings[sitedescription_font_weight]',
			array(
				'default'           => $defaults['sitedescription_font_weight'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[sitedescription_font_weight]',
			array(
				'type'     => 'select',
				'label'    => esc_html__( 'Description font weight', 'osixthreeo' ),
				'section'  => 'osixthreeo_typography',
				'choices'  => array(
					'' => esc_html__( 'Default', 'osixthreeo' ),
					'100' => esc_html__( 'Thin: 100', 'osixthreeo' ),
					'200' => esc_html__( 'Light: 200', 'osixthreeo' ),
					'300' => esc_html__( 'Book: 300', 'osixthreeo' ),
					'400' => esc_html__( 'Normal: 400', 'osixthreeo' ),
					'500' => esc_html__( 'Medium: 500', 'osixthreeo' ),
					'600' => esc_html__( 'Semibold: 600', 'osixthreeo' ),
					'700' => esc_html__( 'Bold: 700', 'osixthreeo' ),
					'800' => esc_html__( 'Extra Bold: 800', 'osixthreeo' ),
					'900' => esc_html__( 'Black: 900', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[sitedescription_font_weight]',
				'priority' => 75,
			)
		);

		// section message.
		$wp_customize->add_setting(
			'menu-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'menu-message',
				array(
					'section'  => 'osixthreeo_typography',
					'priority' => 77,
					'label'  => esc_html__( 'Menu', 'osixthreeo' ),
				)
			)
		);

		// MENU Font --------------------------------.
		$wp_customize->add_setting(
			'osixthreeo_settings[menu_font]',
			array(
				'default'           => $defaults['menu_font'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[menu_font]',
			array(
				'type'        => 'select',
				'label'       => esc_html__( 'Menu font', 'osixthreeo' ),
				'section'     => 'osixthreeo_typography',
				'choices'     => array(
					''         => esc_html__( 'Base font', 'osixthreeo' ),
					'header'   => esc_html__( 'Header font', 'osixthreeo' ),
					'highlite' => esc_html__( 'Highlite font', 'osixthreeo' ),
				),
				'settings'    => 'osixthreeo_settings[menu_font]',
				'priority'    => 80,
			)
		);

		// MENU font size.
		$wp_customize->add_setting(
			'osixthreeo_settings[menu_font_size]',
			array(
				'default'           => $defaults['menu_font_size'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_integer',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Range_Control(
				$wp_customize,
				'osixthreeo_settings[menu_font_size]',
				array(
					'type'        => 'range',
					'label'       => esc_html__( 'Menu font size', 'osixthreeo' ),
					'section'     => 'osixthreeo_typography',
					'settings'    => 'osixthreeo_settings[menu_font_size]',
					'input_attrs' => array(
						'min'  => 12,
						'max'  => 24,
						'step' => 1,
					),
					'priority'    => 83,
				)
			)
		);

		// MENU font weight.
		$wp_customize->add_setting(
			'osixthreeo_settings[menu_font_weight]',
			array(
				'default'           => $defaults['menu_font_weight'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[menu_font_weight]',
			array(
				'type'     => 'select',
				'label'    => esc_html__( 'Menu font weight', 'osixthreeo' ),
				'section'  => 'osixthreeo_typography',
				'choices'  => array(
					'' => esc_html__( 'Default', 'osixthreeo' ),
					'100' => esc_html__( 'Thin: 100', 'osixthreeo' ),
					'200' => esc_html__( 'Light: 200', 'osixthreeo' ),
					'300' => esc_html__( 'Book: 300', 'osixthreeo' ),
					'400' => esc_html__( 'Normal: 400', 'osixthreeo' ),
					'500' => esc_html__( 'Medium: 500', 'osixthreeo' ),
					'600' => esc_html__( 'Semibold: 600', 'osixthreeo' ),
					'700' => esc_html__( 'Bold: 700', 'osixthreeo' ),
					'800' => esc_html__( 'Extra Bold: 800', 'osixthreeo' ),
					'900' => esc_html__( 'Black: 900', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[menu_font_weight]',
				'priority' => 85,
			)
		);

		// section message.
		$wp_customize->add_setting(
			'content-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'content-message',
				array(
					'section'  => 'osixthreeo_typography',
					'priority' => 90,
					'label'  => esc_html__( 'Content Area', 'osixthreeo' ),
				)
			)
		);

		// BASE font size.
		$wp_customize->add_setting(
			'osixthreeo_settings[base_font_size]',
			array(
				'default'           => $defaults['base_font_size'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_integer',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Range_Control(
				$wp_customize,
				'osixthreeo_settings[base_font_size]',
				array(
					'type'        => 'range',
					'label'       => esc_html__( 'Base font size', 'osixthreeo' ),
					'section'     => 'osixthreeo_typography',
					'settings'    => 'osixthreeo_settings[base_font_size]',
					'input_attrs' => array(
						'min'  => 12,
						'max'  => 20,
						'step' => 1,
					),
					'priority'    => 95,
				)
			)
		);

		// HEADER font weight.
		$wp_customize->add_setting(
			'osixthreeo_settings[header_font_weight]',
			array(
				'default'           => $defaults['header_font_weight'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[header_font_weight]',
			array(
				'type'     => 'select',
				'label'    => esc_html__( 'Heading font weight', 'osixthreeo' ),
				'section'  => 'osixthreeo_typography',
				'choices'  => array(
					'' => esc_html__( 'Default', 'osixthreeo' ),
					'100' => esc_html__( 'Thin: 100', 'osixthreeo' ),
					'200' => esc_html__( 'Light: 200', 'osixthreeo' ),
					'300' => esc_html__( 'Book: 300', 'osixthreeo' ),
					'400' => esc_html__( 'Normal: 400', 'osixthreeo' ),
					'500' => esc_html__( 'Medium: 500', 'osixthreeo' ),
					'600' => esc_html__( 'Semibold: 600', 'osixthreeo' ),
					'700' => esc_html__( 'Bold: 700', 'osixthreeo' ),
					'800' => esc_html__( 'Extra Bold: 800', 'osixthreeo' ),
					'900' => esc_html__( 'Black: 900', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[header_font_weight]',
				'priority' => 96,
			)
		);

		/*
		 * THEME OPTIONS ------------------------------------------------------------------------
		 * new tab ------------------------------------------------------------------------------
		 * --------------------------------------------------------------------------------------
		 * --------------------------------------------------------------------------------------
		 */

		// NEW PANEL ------------------------------------------.
		if ( class_exists( 'WP_Customize_Panel' ) ) {
			if ( ! $wp_customize->get_panel( 'osixthreeo_themeops_panel' ) ) {
				$wp_customize->add_panel(
					'osixthreeo_themeops_panel',
					array(
						'priority' => 70,
						'title'    => esc_html__( 'Theme Options', 'osixthreeo' ),
					)
				);
			}
		}

		// First tab.
		$wp_customize->add_section(
			'osixthreeo_themeops_general',
			array(
				'title'    => esc_html__( 'General', 'osixthreeo' ),
				'priority' => 10,
				'panel'    => 'osixthreeo_themeops_panel',
			)
		);

		// HTML section - section message.
		$wp_customize->add_setting(
			'meta-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'meta-message',
				array(
					'section'  => 'osixthreeo_themeops_general',
					'priority' => 10,
					'label'    => esc_html__( 'Post Meta Data', 'osixthreeo' ),
					'content'  => esc_html__( 'Choose what to display under post titles.', 'osixthreeo' ) . '</p>',
				)
			)
		);

		// Show meta date.
		$wp_customize->add_setting(
			'osixthreeo_settings[meta_date]',
			array(
				'default'           => $defaults['meta_date'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[meta_date]',
			array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Show Publish Date', 'osixthreeo' ),
				'section'  => 'osixthreeo_themeops_general',
				'settings' => 'osixthreeo_settings[meta_date]',
				'priority' => 20,
			)
		);

		// Show meta author.
		$wp_customize->add_setting(
			'osixthreeo_settings[meta_author]',
			array(
				'default'           => $defaults['meta_author'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[meta_author]',
			array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Show Author', 'osixthreeo' ),
				'section'  => 'osixthreeo_themeops_general',
				'settings' => 'osixthreeo_settings[meta_author]',
				'priority' => 30,
			)
		);

		// Show meta comments.
		$wp_customize->add_setting(
			'osixthreeo_settings[meta_comments]',
			array(
				'default'           => $defaults['meta_comments'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[meta_comments]',
			array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Show Comments', 'osixthreeo' ),
				'section'  => 'osixthreeo_themeops_general',
				'settings' => 'osixthreeo_settings[meta_comments]',
				'priority' => 40,
			)
		);

		// Show meta updated.
		$wp_customize->add_setting(
			'osixthreeo_settings[meta_updated]',
			array(
				'default'           => $defaults['meta_updated'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[meta_updated]',
			array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Show Last Update', 'osixthreeo' ),
				'section'  => 'osixthreeo_themeops_general',
				'settings' => 'osixthreeo_settings[meta_updated]',
				'priority' => 50,
			)
		);

		/*
		 * HEADER --------------------------------------------------------------------------
		 * new tab  ------------------------------------------------------------------------
		 * ---------------------------------------------------------------------------------
		 * ---------------------------------------------------------------------------------
		 */

		if ( class_exists( 'WP_Customize_Panel' ) ) {
			if ( ! $wp_customize->get_panel( 'osixthreeo_header_panel' ) ) {
				$wp_customize->add_panel(
					'osixthreeo_header_panel',
					array(
						'priority' => 50,
						'title'    => esc_html__( 'Header', 'osixthreeo' ),
					)
				);
			}
		}

		/*
		 * BG COLOR --------------------------
		 */
		$wp_customize->add_section(
			'osixthreeo_ch_bgcolor',
			array(
				'title'    => esc_html__( 'Background Colors', 'osixthreeo' ),
				'priority' => 10,
				'panel'    => 'osixthreeo_header_panel',
			)
		);

		// Header Background Gradient - Left.
		$wp_customize->add_setting(
			'osixthreeo_settings[header_bg_color_left]',
			array(
				'default'           => $defaults['header_bg_color_left'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[header_bg_color_left]',
				array(
					'label'    => esc_html__( 'Header background gradient - Left', 'osixthreeo' ),
					'section'  => 'osixthreeo_ch_bgcolor',
					'settings' => 'osixthreeo_settings[header_bg_color_left]',
					'priority' => 10,
				)
			)
		);

		// Header Background Gradient - Right.
		$wp_customize->add_setting(
			'osixthreeo_settings[header_bg_color_right]',
			array(
				'default'           => $defaults['header_bg_color_right'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[header_bg_color_right]',
				array(
					'label'    => esc_html__( 'Header Background Color - Right', 'osixthreeo' ),
					'section'  => 'osixthreeo_ch_bgcolor',
					'settings' => 'osixthreeo_settings[header_bg_color_right]',
					'priority' => 20,
				)
			)
		);

		// Header Background Gradient Angle.
		$wp_customize->add_setting(
			'osixthreeo_settings[header_gradient_angle]',
			array(
				'default'           => $defaults['header_gradient_angle'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_integer',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Range_Control(
				$wp_customize,
				'osixthreeo_settings[header_gradient_angle]',
				array(
					'type'        => 'range',
					'label'       => esc_html__( 'Gradient Angle (0-180&deg;)', 'osixthreeo' ),
					'section'     => 'osixthreeo_ch_bgcolor',
					'settings'    => 'osixthreeo_settings[header_gradient_angle]',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 180,
						'step' => 5,
					),
					'priority'    => 30,
				)
			)
		);

		// Header Gradient Left Stop Point.
		$wp_customize->add_setting(
			'osixthreeo_settings[header_left_stop]',
			array(
				'default'           => $defaults['header_left_stop'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_integer',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Range_Control(
				$wp_customize,
				'osixthreeo_settings[header_left_stop]',
				array(
					'type'        => 'range',
					'label'       => esc_html__( 'Gradient Left Blend Point', 'osixthreeo' ),
					'section'     => 'osixthreeo_ch_bgcolor',
					'settings'    => 'osixthreeo_settings[header_left_stop]',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					),
					'priority'    => 40,
				)
			)
		);

		// Header Gradient Right Stop Point.
		$wp_customize->add_setting(
			'osixthreeo_settings[header_right_stop]',
			array(
				'default'           => $defaults['header_right_stop'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_integer',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Range_Control(
				$wp_customize,
				'osixthreeo_settings[header_right_stop]',
				array(
					'type'        => 'range',
					'label'       => esc_html__( 'Gradient Right Blend Point', 'osixthreeo' ),
					'section'     => 'osixthreeo_ch_bgcolor',
					'settings'    => 'osixthreeo_settings[header_right_stop]',
					'input_attrs' => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 5,
					),
					'priority'    => 50,
				)
			)
		);

		/*
		 * Header Media --------------------------------------
		 * Section where header images options are automatically added
		 */

		$wp_customize->add_section(
			'header_image',
			array(
				'title'    => esc_html__( 'Background Image/Video', 'osixthreeo' ),
				'priority' => 20,
				'panel'    => 'osixthreeo_header_panel',
			)
		);

		/*
		 * HEIGHT ------------------------------
		 */
		$wp_customize->add_section(
			'osixthreeo_ch_height',
			array(
				'title'    => esc_html__( 'Height', 'osixthreeo' ),
				'panel'    => 'osixthreeo_header_panel',
				'priority' => 30,
			)
		);

		// Homepage Header Full Height.
		$wp_customize->add_setting(
			'osixthreeo_settings[home_header_fullheight]',
			array(
				'default'           => $defaults['home_header_fullheight'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[home_header_fullheight]',
			array(
				'type'     => 'radio',
				'label'    => esc_html__( 'Homepage Header Height', 'osixthreeo' ),
				'section'  => 'osixthreeo_ch_height',
				'choices'  => array(
					'full'       => esc_html__( 'Full Height', 'osixthreeo' ),
					'adjustable' => esc_html__( 'Adjustable', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[home_header_fullheight]',
				'priority' => 10,
			)
		);

		// Homepage Header Height.
		$wp_customize->add_setting(
			'osixthreeo_settings[home_header_height]',
			array(
				'default'           => $defaults['home_header_height'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_integer',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Range_Control(
				$wp_customize,
				'osixthreeo_settings[home_header_height]',
				array(
					'type'        => 'range',
					'description' => esc_html__( 'Desktop & large screens', 'osixthreeo' ),
					'section'     => 'osixthreeo_ch_height',
					'settings'    => 'osixthreeo_settings[home_header_height]',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
					'priority'    => 20,
				)
			)
		);
		// Homepage MOBILE Header Height.
		$wp_customize->add_setting(
			'osixthreeo_settings[home_mobile_header_height]',
			array(
				'default'           => $defaults['home_mobile_header_height'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_integer',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Range_Control(
				$wp_customize,
				'osixthreeo_settings[home_mobile_header_height]',
				array(
					'type'        => 'range',
					'description' => esc_html__( 'Mobile & small screens', 'osixthreeo' ),
					'section'     => 'osixthreeo_ch_height',
					'settings'    => 'osixthreeo_settings[home_mobile_header_height]',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 600,
						'step' => 10,
					),
					'priority'    => 30,
				)
			)
		);

		// SubPage Header Height.
		$wp_customize->add_setting(
			'osixthreeo_settings[subpage_header_height]',
			array(
				'default'           => $defaults['subpage_header_height'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_integer',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Range_Control(
				$wp_customize,
				'osixthreeo_settings[subpage_header_height]',
				array(
					'type'        => 'range',
					'label'       => esc_html__( 'Subpage Header Height', 'osixthreeo' ),
					'description' => esc_html__( 'Desktop & large screens', 'osixthreeo' ),
					'section'     => 'osixthreeo_ch_height',
					'settings'    => 'osixthreeo_settings[subpage_header_height]',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 800,
						'step' => 5,
					),
					'priority'    => 40,
				)
			)
		);
		// SubPage MOBILE Header Height.
		$wp_customize->add_setting(
			'osixthreeo_settings[subpage_mobile_header_height]',
			array(
				'default'           => $defaults['subpage_mobile_header_height'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_integer',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Range_Control(
				$wp_customize,
				'osixthreeo_settings[subpage_mobile_header_height]',
				array(
					'type'        => 'range',
					'description' => esc_html__( 'Mobile & small screens', 'osixthreeo' ),
					'section'     => 'osixthreeo_ch_height',
					'settings'    => 'osixthreeo_settings[subpage_mobile_header_height]',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 400,
						'step' => 5,
					),
					'priority'    => 50,
				)
			)
		);

		/*
		 * OVERLAY TEXT ------------------------------
		 */
		$wp_customize->add_section(
			'osixthreeo_ch_text',
			array(
				'title'    => esc_html__( 'Overlay Text', 'osixthreeo' ),
				'priority' => 30,
				'panel'    => 'osixthreeo_header_panel',
			)
		);

		// Homepage Header Primary Text Area.
		$wp_customize->add_setting(
			'osixthreeo_settings[hero_text_primary]',
			array(
				'default'           => $defaults['hero_text_primary'],
				'type'              => 'option',
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[hero_text_primary]',
			array(
				'type'     => 'textarea',
				'label'    => esc_html__( 'Primary text', 'osixthreeo' ),
				'section'  => 'osixthreeo_ch_text',
				'priority' => 10,
			)
		);

		// Homepage Header Primary Font.
		$wp_customize->add_setting(
			'osixthreeo_settings[hero_text_primary_font]',
			array(
				'default'           => $defaults['hero_text_primary_font'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[hero_text_primary_font]',
			array(
				'type'     => 'select',
				'label'    => esc_html__( 'Primary text font', 'osixthreeo' ),
				'section'  => 'osixthreeo_ch_text',
				'choices'  => array(
					''         => esc_html__( 'Base font', 'osixthreeo' ),
					'header'   => esc_html__( 'Header font', 'osixthreeo' ),
					'highlite' => esc_html__( 'Highlite font', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[hero_text_primary_font]',
				'priority' => 15,
			)
		);

		// HOME HEADER Primary font size.
		$wp_customize->add_setting(
			'osixthreeo_settings[hero_text_primary_font_size]',
			array(
				'default'           => $defaults['hero_text_primary_font_size'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_integer',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Range_Control(
				$wp_customize,
				'osixthreeo_settings[hero_text_primary_font_size]',
				array(
					'type'        => 'range',
					'label'       => esc_html__( 'Primary text font size', 'osixthreeo' ),
					'section'     => 'osixthreeo_ch_text',
					'settings'    => 'osixthreeo_settings[hero_text_primary_font_size]',
					'input_attrs' => array(
						'min'  => 40,
						'max'  => 80,
						'step' => 1,
					),
					'priority'    => 18,
				)
			)
		);

		// Homepage Header Primary Text Color.
		$wp_customize->add_setting(
			'osixthreeo_settings[hero_text_primary_color]',
			array(
				'default'           => $defaults['hero_text_primary_color'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_rgba',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Alpha_Color_Control(
				$wp_customize,
				'osixthreeo_settings[hero_text_primary_color]',
				array(
					'label'    => esc_html__( 'Primary text color', 'osixthreeo' ),
					'section'  => 'osixthreeo_ch_text',
					'settings' => 'osixthreeo_settings[hero_text_primary_color]',
					'priority' => 20,
				)
			)
		);

		// Homepage Header Secondary Text Area.
		$wp_customize->add_setting(
			'osixthreeo_settings[hero_text_secondary]',
			array(
				'default'           => $defaults['hero_text_secondary'],
				'type'              => 'option',
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[hero_text_secondary]',
			array(
				'type'     => 'textarea',
				'label'    => esc_html__( 'Secondary text', 'osixthreeo' ),
				'section'  => 'osixthreeo_ch_text',
				'priority' => 30,
			)
		);

		// Homepage Header Secondary Font.
		$wp_customize->add_setting(
			'osixthreeo_settings[hero_text_secondary_font]',
			array(
				'default'           => $defaults['hero_text_secondary_font'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_choices',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[hero_text_secondary_font]',
			array(
				'type'     => 'select',
				'label'    => esc_html__( 'Secondary text font', 'osixthreeo' ),
				'section'  => 'osixthreeo_ch_text',
				'choices'  => array(
					''         => esc_html__( 'Base font', 'osixthreeo' ),
					'header'   => esc_html__( 'Header font', 'osixthreeo' ),
					'highlite' => esc_html__( 'Highlite font', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[hero_text_secondary_font]',
				'priority' => 35,
			)
		);

		// HOME HEADER Secondary font size.
		$wp_customize->add_setting(
			'osixthreeo_settings[hero_text_secondary_font_size]',
			array(
				'default'           => $defaults['hero_text_secondary_font_size'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_integer',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Range_Control(
				$wp_customize,
				'osixthreeo_settings[hero_text_secondary_font_size]',
				array(
					'type'        => 'range',
					'label'       => esc_html__( 'Secondary text font size', 'osixthreeo' ),
					'section'     => 'osixthreeo_ch_text',
					'settings'    => 'osixthreeo_settings[hero_text_secondary_font_size]',
					'input_attrs' => array(
						'min'  => 20,
						'max'  => 60,
						'step' => 1,
					),
					'priority'    => 38,
				)
			)
		);

		// Homepage Header Secondary Text Color.
		$wp_customize->add_setting(
			'osixthreeo_settings[hero_text_secondary_color]',
			array(
				'default'           => $defaults['hero_text_secondary_color'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_rgba',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Alpha_Color_Control(
				$wp_customize,
				'osixthreeo_settings[hero_text_secondary_color]',
				array(
					'label'    => esc_html__( 'Secondary text color', 'osixthreeo' ),
					'section'  => 'osixthreeo_ch_text',
					'settings' => 'osixthreeo_settings[hero_text_secondary_color]',
					'priority' => 40,
				)
			)
		);

		// HTML section - section message.
		$wp_customize->add_setting(
			'hometext-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'hometext-message',
				array(
					'section'  => 'osixthreeo_ch_text',
					'priority' => 50,
					'label'    => esc_html__( 'Note:', 'osixthreeo' ),
					'content'  => esc_html__( 'Text entered above only displays on the homepage.', 'osixthreeo' ) . '</p>',
				)
			)
		);

	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 0.1
 */
function osixthreeo_customizer_live_preview() {
	wp_enqueue_script( 'osixthreeo-themecustomizer', trailingslashit( get_template_directory_uri() ) . 'assets/js/customizer-min.js', array( 'jquery', 'customize-preview' ), OSIXTHREEO_VERSION, true );
}
add_action( 'customize_preview_init', 'osixthreeo_customizer_live_preview' );

/**
 * Custom contextual controls
 *
 * @since 1.0.0
 */
function osixthreeo_customizer_panel() {
	wp_enqueue_script( 'osixthreeo-customizer-panel', trailingslashit( get_template_directory_uri() ) . 'assets/js/customizer-panel-min.js', array( 'customize-controls' ), OSIXTHREEO_VERSION, false );
}
add_action( 'customize_controls_enqueue_scripts', 'osixthreeo_customizer_panel' );
