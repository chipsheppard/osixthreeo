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

		require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';

		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		$wp_customize->get_control( 'header_textcolor' )->label = 'Site title & Description';
		$wp_customize->get_control( 'header_textcolor' )->priority = 20;

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector'        => '.site-title a',
				'render_callback' => 'osixthreeo_customize_partial_blogname',
			) );
			$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
				'selector'        => '.site-description',
				'render_callback' => 'osixthreeo_customize_partial_blogdescription',
			) );
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
		if ( class_exists( 'WP_Customize_Panel' ) ) {
			if ( ! $wp_customize->get_panel( 'osixthreeo_layout_panel' ) ) {
				$wp_customize->add_panel(
					'osixthreeo_layout_panel',
					array(
						'priority' => 30,
						'title'    => __( 'Layouts', 'osixthreeo' ),
					)
				);
			}
		}

		/*
		 * Content - tab -----------------------
		 */
		$wp_customize->add_section(
			'osixthreeo_site_layout',
			array(
				'title'    => __( 'Global', 'osixthreeo' ),
				'priority' => 10,
				'panel'    => 'osixthreeo_layout_panel',
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
				'label'    => __( 'Site Containment', 'osixthreeo' ),
				'section'  => 'osixthreeo_site_layout',
				'choices'  => array(
					'full'      => __( 'Full Width', 'osixthreeo' ),
					'contained' => __( 'Contained', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[containment_setting]',
				'priority' => 10,
			)
		);

		/*
		 * Header Layout - tab -----------------
		 */
		$wp_customize->add_section(
			'osixthreeo_header_layouts',
			array(
				'title'    => __( 'Header', 'osixthreeo' ),
				'priority' => 20,
				'panel'    => 'osixthreeo_layout_panel',
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
					'label'       => __( 'Logo & Navigation.', 'osixthreeo' ),
					'description' => __( 'left & right &nbsp; &nbsp; &nbsp; &nbsp; centered', 'osixthreeo' ),
					'section'     => 'osixthreeo_header_layouts',
					'choices'     => array(
						'headernormal'   => __( 'headernormal', 'osixthreeo' ),
						'headercentered' => __( 'headercentered', 'osixthreeo' ),
					),
					'settings'    => 'osixthreeo_settings[header_layout]',
					'priority'    => 10,
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
					'label'       => __( 'Top/Bottom Padding', 'osixthreeo' ),
					'description' => __( 'Set the top & bottom padding', 'osixthreeo' ),
					'section'     => 'osixthreeo_header_layouts',
					'settings'    => 'osixthreeo_settings[header_padding]',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 2,
					),
					'priority'    => 20,
				)
			)
		);

		/*
		 * Sidebars - tab -----------------------
		 */
		$wp_customize->add_section(
			'osixthreeo_sidebar_layouts',
			array(
				'title'    => __( 'Sidebars', 'osixthreeo' ),
				'priority' => 20,
				'panel'    => 'osixthreeo_layout_panel',
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
					'label'    => __( 'Homepage', 'osixthreeo' ),
					'section'  => 'osixthreeo_sidebar_layouts',
					'choices'  => array(
						'layout-ns' => __( 'layout-ns', 'osixthreeo' ),
						'layout-ls' => __( 'layout-ls', 'osixthreeo' ),
						'layout-rs' => __( 'layout-rs', 'osixthreeo' ),
						'layout-c'  => __( 'layout-c', 'osixthreeo' ),
					),
					'settings' => 'osixthreeo_settings[home_layout_setting]',
					'priority' => 30,
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
					'label'    => __( 'Pages', 'osixthreeo' ),
					'section'  => 'osixthreeo_sidebar_layouts',
					'choices'  => array(
						'layout-ns' => __( 'layout-ns', 'osixthreeo' ),
						'layout-ls' => __( 'layout-ls', 'osixthreeo' ),
						'layout-rs' => __( 'layout-rs', 'osixthreeo' ),
						'layout-c'  => __( 'layout-c', 'osixthreeo' ),
					),
					'settings' => 'osixthreeo_settings[page_layout_setting]',
					'priority' => 40,
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
					'label'    => __( 'Single Post', 'osixthreeo' ),
					'section'  => 'osixthreeo_sidebar_layouts',
					'choices'  => array(
						'layout-ns' => __( 'layout-ns', 'osixthreeo' ),
						'layout-ls' => __( 'layout-ls', 'osixthreeo' ),
						'layout-rs' => __( 'layout-rs', 'osixthreeo' ),
						'layout-c'  => __( 'layout-c', 'osixthreeo' ),
					),
					'settings' => 'osixthreeo_settings[single_layout_setting]',
					'priority' => 50,
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
					'label'    => __( 'Archive/Blog', 'osixthreeo' ),
					'section'  => 'osixthreeo_sidebar_layouts',
					'choices'  => array(
						'layout-ns' => __( 'layout-ns', 'osixthreeo' ),
						'layout-ls' => __( 'layout-ls', 'osixthreeo' ),
						'layout-rs' => __( 'layout-rs', 'osixthreeo' ),
						'layout-c'  => __( 'layout-c', 'osixthreeo' ),
					),
					'settings' => 'osixthreeo_settings[archive_layout_setting]',
					'priority' => 60,
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
					'label'    => __( 'Search Results', 'osixthreeo' ),
					'section'  => 'osixthreeo_sidebar_layouts',
					'choices'  => array(
						'layout-ns' => __( 'layout-ns', 'osixthreeo' ),
						'layout-ls' => __( 'layout-ls', 'osixthreeo' ),
						'layout-rs' => __( 'layout-rs', 'osixthreeo' ),
						'layout-c'  => __( 'layout-c', 'osixthreeo' ),
					),
					'settings' => 'osixthreeo_settings[search_layout_setting]',
					'priority' => 70,
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
		// HTML section - section message.
		$wp_customize->add_setting(
			'header-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'header-message',
				array(
					'section'  => 'colors',
					'priority' => 10,
					'label'  => __( 'The Header', 'osixthreeo' ) . '</p>',
					'content'  => __( 'Select colors for the site title and main navigation.', 'osixthreeo' ) . '</p>',
				)
			)
		);

		// Header Background.
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
					'label'        => __( 'Background', 'osixthreeo' ),
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
					'label'    => __( 'Menu link text', 'osixthreeo' ),
					'section'  => 'colors',
					'settings' => 'osixthreeo_settings[nav_link_color]',
					'priority' => 30,
				)
			)
		);

		// SUBNAV -----------------------
		// HTML section - section message.
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
					'label'  => __( 'Mobile menu / Desktop submenus', 'osixthreeo' ) . '</p>',
					'content'  => __( 'Select colors for the "mobile" menu AND the drop-down submenus (if any) on large screens.', 'osixthreeo' ) . '</p>',
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
				// 'transport'         = > 'postMessage',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[subnav_bg_color]',
				array(
					'label'        => __( 'Background', 'osixthreeo' ),
					'section'      => 'colors',
					'settings'     => 'osixthreeo_settings[subnav_bg_color]',
					'priority'     => 41,
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
				// 'transport'         = > 'postMessage',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[subnav_hover_bg_color]',
				array(
					'label'    => __( 'Hover background', 'osixthreeo' ),
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
				// 'transport'         = > 'postMessage',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[subnav_text_color]',
				array(
					'label'    => __( 'Link text', 'osixthreeo' ),
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
				// 'transport'         = > 'postMessage',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[subnav_hover_text_color]',
				array(
					'label'    => __( 'Hover link text', 'osixthreeo' ),
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
				// 'transport'         = > 'postMessage',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[subnav_border_color]',
				array(
					'label'        => __( 'Border', 'osixthreeo' ),
					'section'      => 'colors',
					'settings'     => 'osixthreeo_settings[subnav_border_color]',
					'priority'     => 45,
				)
			)
		);

		// CONTENT AREA --------------------------------------------------
		// HTML section - section message.
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
					'section'  => 'colors',
					'priority' => 50,
					'label'  => __( 'Content Area.', 'osixthreeo' ) . '</p>',
					'content'  => __( 'Select colors for the content area.', 'osixthreeo' ) . '</p>',
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
					'label'        => __( 'Background', 'osixthreeo' ),
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
					'label'    => __( 'Text', 'osixthreeo' ),
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
				// 'transport'         = > 'postMessage',.
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[link_color]',
				array(
					'label'       => __( 'Links', 'osixthreeo' ),
					'section'     => 'colors',
					'settings'    => 'osixthreeo_settings[link_color]',
					'priority'    => 53,
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
				// 'transport'         = > 'postMessage',.
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'osixthreeo_settings[link_color_hover]',
				array(
					'label'       => __( 'Hover links', 'osixthreeo' ),
					'section'     => 'colors',
					'settings'    => 'osixthreeo_settings[link_color_hover]',
					'priority'    => 54,
				)
			)
		);

		// FOOTER ---------------------------------------------------------
		// HTML section - section message.
		$wp_customize->add_setting(
			'footer-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'footer-message',
				array(
					'section'  => 'colors',
					'priority' => 70,
					'label'  => __( 'The Footer', 'osixthreeo' ) . '</p>',
					'content'  => __( 'Select colors for the site footer.', 'osixthreeo' ) . '</p>',
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
					'label'    => __( 'Background', 'osixthreeo' ),
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
					'label'    => __( 'Text', 'osixthreeo' ),
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
					'label'    => __( 'Links', 'osixthreeo' ),
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
					'label'    => __( 'Hover links', 'osixthreeo' ),
					'section'  => 'colors',
					'settings' => 'osixthreeo_settings[footer_link_color_hover]',
					'priority' => 74,
				)
			)
		);

		/*
		 * TYPOGRAPHY tab --------------------------------------------------------------------------
		 * ------------------------------------------------------------------------------------
		 * ------------------------------------------------------------------------------------
		 * ------------------------------------------------------------------------------------
		 */

		$wp_customize->add_section(
			'osixthreeo_typography',
			array(
				'title'    => __( 'Typography', 'osixthreeo' ),
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
				'type'        => 'select',
				'label'       => __( 'Base font', 'osixthreeo' ),
				'section'     => 'osixthreeo_typography',
				'choices'     => array(
					''                  => __( 'Arial - default', 'osixthreeo' ),
					'lato'              => __( 'Lato - google', 'osixthreeo' ),
					'lora'              => __( 'Lora - google', 'osixthreeo' ),
					'merriweather'      => __( 'Merriweather - google', 'osixthreeo' ),
					'oswald'            => __( 'Oswald - google', 'osixthreeo' ),
					'playfairdisplay'   => __( 'Playfair Display - google', 'osixthreeo' ),
					'raleway'           => __( 'Raleway - google', 'osixthreeo' ),
					'roboto'            => __( 'Roboto - google', 'osixthreeo' ),
					'robotoslab'        => __( 'Roboto Slab - google', 'osixthreeo' ),
					'sourcesanspro'     => __( 'Source Sans Pro - google', 'osixthreeo' ),
					'century'           => __( 'Century Gothic', 'osixthreeo' ),
					'verdana'           => __( 'Verdana', 'osixthreeo' ),
					'gillsans'          => __( 'Gill Sans', 'osixthreeo' ),
					'helvetica'         => __( 'Helvetica', 'osixthreeo' ),
					'impact'            => __( 'Impact', 'osixthreeo' ),
					'tahoma'            => __( 'Tahoma', 'osixthreeo' ),
					'trebuchet'         => __( 'Trebuchet', 'osixthreeo' ),
					'lucidagrande'      => __( 'Lucida Grande', 'osixthreeo' ),
					'georgia'           => __( 'Georgia', 'osixthreeo' ),
					'times'             => __( 'Times', 'osixthreeo' ),
					'bookantiqua'       => __( 'Book Antiqua', 'osixthreeo' ),
					'lucidabright'      => __( 'Lucida Bright', 'osixthreeo' ),
					'palatino'          => __( 'Palatino', 'osixthreeo' ),
					'courier'           => __( 'Courier', 'osixthreeo' ),
					'lucidatypewritter' => __( 'Lucida Typewritter', 'osixthreeo' ),
					'copperplate'       => __( 'Copperplate', 'osixthreeo' ),
					'papyrus'           => __( 'Papyrus', 'osixthreeo' ),
					'comicsans'         => __( 'Comic Sans', 'osixthreeo' ),
				),
				'settings'    => 'osixthreeo_settings[base_font]',
				'priority'    => 10,
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
					'label'       => __( 'Base font size', 'osixthreeo' ),
					'section'     => 'osixthreeo_typography',
					'settings'    => 'osixthreeo_settings[base_font_size]',
					'input_attrs' => array(
						'min'  => 12,
						'max'  => 20,
						'step' => 1,
					),
					'priority'    => 15,
				)
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
				'type'        => 'select',
				'label'       => __( 'Header font', 'osixthreeo' ),
				'section'     => 'osixthreeo_typography',
				'choices'     => array(
					''                  => __( 'Inherit base font', 'osixthreeo' ),
					'lato'              => __( 'Lato - google', 'osixthreeo' ),
					'lora'              => __( 'Lora - google', 'osixthreeo' ),
					'merriweather'      => __( 'Merriweather - google', 'osixthreeo' ),
					'oswald'            => __( 'Oswald - google', 'osixthreeo' ),
					'playfairdisplay'   => __( 'Playfair Display - google', 'osixthreeo' ),
					'raleway'           => __( 'Raleway - google', 'osixthreeo' ),
					'roboto'            => __( 'Roboto - google', 'osixthreeo' ),
					'robotoslab'        => __( 'Roboto Slab - google', 'osixthreeo' ),
					'sourcesanspro'     => __( 'Source Sans Pro - google', 'osixthreeo' ),
					'century'           => __( 'Century Gothic', 'osixthreeo' ),
					'verdana'           => __( 'Verdana', 'osixthreeo' ),
					'gillsans'          => __( 'Gill Sans', 'osixthreeo' ),
					'helvetica'         => __( 'Helvetica', 'osixthreeo' ),
					'impact'            => __( 'Impact', 'osixthreeo' ),
					'tahoma'            => __( 'Tahoma', 'osixthreeo' ),
					'trebuchet'         => __( 'Trebuchet', 'osixthreeo' ),
					'lucidagrande'      => __( 'Lucida Grande', 'osixthreeo' ),
					'georgia'           => __( 'Georgia', 'osixthreeo' ),
					'times'             => __( 'Times', 'osixthreeo' ),
					'bookantiqua'       => __( 'Book Antiqua', 'osixthreeo' ),
					'lucidabright'      => __( 'Lucida Bright', 'osixthreeo' ),
					'palatino'          => __( 'Palatino', 'osixthreeo' ),
					'courier'           => __( 'Courier', 'osixthreeo' ),
					'lucidatypewritter' => __( 'Lucida Typewritter', 'osixthreeo' ),
					'copperplate'       => __( 'Copperplate', 'osixthreeo' ),
					'papyrus'           => __( 'Papyrus', 'osixthreeo' ),
					'comicsans'         => __( 'Comic Sans', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[header_font]',
				'priority' => 20,
			)
		);

		// HEADERs bold checkbox.
		$wp_customize->add_setting(
			'osixthreeo_settings[header_font_weight]',
			array(
				'default'           => $defaults['header_font_weight'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_checkbox',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[header_font_weight]',
			array(
				'type'     => 'checkbox',
				'label'    => __( 'BOLD the headers', 'osixthreeo' ),
				'section'  => 'osixthreeo_typography',
				'settings' => 'osixthreeo_settings[header_font_weight]',
				'priority' => 30,
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
				'type'    => 'select',
				'label'   => __( 'Highlite font', 'osixthreeo' ),
				'section' => 'osixthreeo_typography',
				'choices' => array(
					''                  => __( 'Inherit base font', 'osixthreeo' ),
					'lato'              => __( 'Lato - google', 'osixthreeo' ),
					'lora'              => __( 'Lora - google', 'osixthreeo' ),
					'merriweather'      => __( 'Merriweather - google', 'osixthreeo' ),
					'oswald'            => __( 'Oswald - google', 'osixthreeo' ),
					'playfairdisplay'   => __( 'Playfair Display - google', 'osixthreeo' ),
					'raleway'           => __( 'Raleway - google', 'osixthreeo' ),
					'roboto'            => __( 'Roboto - google', 'osixthreeo' ),
					'robotoslab'        => __( 'Roboto Slab - google', 'osixthreeo' ),
					'sourcesanspro'     => __( 'Source Sans Pro - google', 'osixthreeo' ),
					'century'           => __( 'Century Gothic', 'osixthreeo' ),
					'verdana'           => __( 'Verdana', 'osixthreeo' ),
					'gillsans'          => __( 'Gill Sans', 'osixthreeo' ),
					'helvetica'         => __( 'Helvetica', 'osixthreeo' ),
					'impact'            => __( 'Impact', 'osixthreeo' ),
					'tahoma'            => __( 'Tahoma', 'osixthreeo' ),
					'trebuchet'         => __( 'Trebuchet', 'osixthreeo' ),
					'lucidagrande'      => __( 'Lucida Grande', 'osixthreeo' ),
					'georgia'           => __( 'Georgia', 'osixthreeo' ),
					'times'             => __( 'Times', 'osixthreeo' ),
					'bookantiqua'       => __( 'Book Antiqua', 'osixthreeo' ),
					'lucidabright'      => __( 'Lucida Bright', 'osixthreeo' ),
					'palatino'          => __( 'Palatino', 'osixthreeo' ),
					'courier'           => __( 'Courier', 'osixthreeo' ),
					'lucidatypewritter' => __( 'Lucida Typewritter', 'osixthreeo' ),
					'copperplate'       => __( 'Copperplate', 'osixthreeo' ),
					'papyrus'           => __( 'Papyrus', 'osixthreeo' ),
					'comicsans'         => __( 'Comic Sans', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[highlite_font]',
				'priority' => 40,
			)
		);

		// section message.
		$wp_customize->add_setting(
			'font-message', array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize, 'font-message',
				array(
					'section'     => 'osixthreeo_typography',
					'priority'    => 50,
					'content'     => __( 'To avoid theme bloat a maximum of 3 fonts can be used.<br /><br />Using the controls below, the fonts selected above are assigned areas of the site.', 'osixthreeo' ) . '</p>',
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
				'type'    => 'select',
				'label'   => __( 'Site Title font', 'osixthreeo' ),
				'description' => __( 'Choose one of the three fonts loaded above.', 'osixthreeo' ),
				'section' => 'osixthreeo_typography',
				'choices' => array(
					''       => __( 'Base font', 'osixthreeo' ),
					'header' => __( 'Header font', 'osixthreeo' ),
					'highlite'  => __( 'Highlite font', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[sitetitle_font]',
				'priority' => 60,
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
					'label'       => __( 'Site Title font size', 'osixthreeo' ),
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

		// SITE TITLE bold checkbox.
		$wp_customize->add_setting(
			'osixthreeo_settings[sitetitle_font_weight]',
			array(
				'default'           => $defaults['sitetitle_font_weight'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_checkbox',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[sitetitle_font_weight]',
			array(
				'type'     => 'checkbox',
				'label'    => __( 'BOLD the site title', 'osixthreeo' ),
				'section'  => 'osixthreeo_typography',
				'settings' => 'osixthreeo_settings[sitetitle_font_weight]',
				'priority' => 65,
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
				'type'    => 'select',
				'label'   => __( 'Site Description font', 'osixthreeo' ),
				'description' => __( 'Choose one of the three fonts loaded above.', 'osixthreeo' ),
				'section' => 'osixthreeo_typography',
				'choices' => array(
					''       => __( 'Base font', 'osixthreeo' ),
					'header' => __( 'Header font', 'osixthreeo' ),
					'highlite'  => __( 'Highlite font', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[sitedescription_font]',
				'priority' => 70,
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
					'label'       => __( 'Description font size', 'osixthreeo' ),
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

		// SITE DESCRIPTION bold checkbox.
		$wp_customize->add_setting(
			'osixthreeo_settings[sitedescription_font_weight]',
			array(
				'default'           => $defaults['sitedescription_font_weight'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_checkbox',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[sitedescription_font_weight]',
			array(
				'type'     => 'checkbox',
				'label'    => __( 'BOLD the site description', 'osixthreeo' ),
				'section'  => 'osixthreeo_typography',
				'settings' => 'osixthreeo_settings[sitedescription_font_weight]',
				'priority' => 75,
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
				'type'    => 'select',
				'label'   => __( 'Menu font', 'osixthreeo' ),
				'description' => __( 'Choose one of the three fonts loaded above.', 'osixthreeo' ),
				'section' => 'osixthreeo_typography',
				'choices' => array(
					''       => __( 'Base font', 'osixthreeo' ),
					'header' => __( 'Header font', 'osixthreeo' ),
					'highlite'  => __( 'Highlite font', 'osixthreeo' ),
				),
				'settings' => 'osixthreeo_settings[menu_font]',
				'priority' => 80,
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
					'label'       => __( 'Menu font size', 'osixthreeo' ),
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

		// MENU bold checkbox.
		$wp_customize->add_setting(
			'osixthreeo_settings[menu_font_weight]',
			array(
				'default'           => $defaults['menu_font_weight'],
				'type'              => 'option',
				'sanitize_callback' => 'osixthreeo_sanitize_checkbox',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'osixthreeo_settings[menu_font_weight]',
			array(
				'type'     => 'checkbox',
				'label'    => __( 'BOLD the menu', 'osixthreeo' ),
				'section'  => 'osixthreeo_typography',
				'settings' => 'osixthreeo_settings[menu_font_weight]',
				'priority' => 85,
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
						'title'    => __( 'Theme Options', 'osixthreeo' ),
					)
				);
			}
		}

		// First tab.
		$wp_customize->add_section( 'osixthreeo_themeops_general', array(
			'title'    => __( 'General', 'osixthreeo' ),
			'priority' => 10,
			'panel'    => 'osixthreeo_themeops_panel',
		) );

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
					'label'    => __( 'Post Meta Data', 'osixthreeo' ),
					'content'  => __( 'Choose what to display under post titles.', 'osixthreeo' ) . '</p>',
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
				'label'    => __( 'Show Publish Date', 'osixthreeo' ),
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
				'label'    => __( 'Show Author', 'osixthreeo' ),
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
				'label'    => __( 'Show Comments', 'osixthreeo' ),
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
				'label'    => __( 'Show Last Update', 'osixthreeo' ),
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
						'title'    => __( 'Header', 'osixthreeo' ),
					)
				);
			}
		}

		/*
		 * BG COLOR --------------------------
		 */
		$wp_customize->add_section( 'osixthreeo_ch_bgcolor', array(
			'title'    => __( 'Background Colors', 'osixthreeo' ),
			'priority' => 10,
			'panel'    => 'osixthreeo_header_panel',
		) );

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
					'label'    => __( 'Header Background Color - Left', 'osixthreeo' ),
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
					'label'    => __( 'Header Background Color - Right', 'osixthreeo' ),
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
					'label'       => __( 'Gradient Angle (0-180&deg;)', 'osixthreeo' ),
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
					'label'       => __( 'Gradient Left Blend Point', 'osixthreeo' ),
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
					'label'       => __( 'Gradient Right Blend Point', 'osixthreeo' ),
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

		 $wp_customize->add_section( 'header_image' , array(
			 'title'    => esc_html__( 'Background Image/Video', 'oceanwp' ),
			 'priority' => 20,
			 'panel'    => 'osixthreeo_header_panel',
		 ) );

		// HTML section in the Header Image tab - section message.
		$wp_customize->add_setting(
			'header-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Osixthreeo_Content_Area(
				$wp_customize,
				'header-message',
				array(
					'section'  => 'header_image',
					'priority' => 5,
					'content'  => __( 'A <strong>video</strong> (optional) will only display on the homepage on screens larger than 900 pixels!<br><br>An <strong>image</strong> (also optional) will display on ALL pages AND act as a fallback for the video.', 'osixthreeo' ) . '</p>',
				)
			)
		);

		/*
		 * HEIGHT ------------------------------
		 */
		$wp_customize->add_section(
			'osixthreeo_ch_height',
			array(
				'title'    => __( 'Height', 'osixthreeo' ),
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
				'label'    => __( 'Homepage Header Height', 'osixthreeo' ),
				'section'  => 'osixthreeo_ch_height',
				'choices'  => array(
					'full'       => __( 'Full Height', 'osixthreeo' ),
					'adjustable' => __( 'Adjustable', 'osixthreeo' ),
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
					'description' => __( 'Desktop & large screens', 'osixthreeo' ),
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
					'description' => __( 'Mobile & small screens', 'osixthreeo' ),
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
					'label'       => __( 'Subpage Header Height', 'osixthreeo' ),
					'description' => __( 'Desktop & large screens', 'osixthreeo' ),
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
					'description' => __( 'Mobile & small screens', 'osixthreeo' ),
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
				'title'    => __( 'Overlay Text', 'osixthreeo' ),
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
				'label'    => __( 'Primary text', 'osixthreeo' ),
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
				'type'        => 'select',
				'label'       => __( 'Primary text font', 'osixthreeo' ),
				'section'     => 'osixthreeo_ch_text',
				'choices'     => array(
					''       => __( 'Base font', 'osixthreeo' ),
					'header' => __( 'Header font', 'osixthreeo' ),
					'highlite'  => __( 'Highlite font', 'osixthreeo' ),
				),
				'settings'    => 'osixthreeo_settings[hero_text_primary_font]',
				'priority'    => 15,
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
					'label'       => __( 'Primary text font size', 'osixthreeo' ),
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
					'label'    => __( 'Primary text color', 'osixthreeo' ),
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
				'label'    => __( 'Secondary text', 'osixthreeo' ),
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
				'type'        => 'select',
				'label'       => __( 'Secondary text font', 'osixthreeo' ),
				'section'     => 'osixthreeo_ch_text',
				'choices'     => array(
					''       => __( 'Base font', 'osixthreeo' ),
					'header' => __( 'Header font', 'osixthreeo' ),
					'highlite'  => __( 'Highlite font', 'osixthreeo' ),
				),
				'settings'     => 'osixthreeo_settings[hero_text_secondary_font]',
				'priority'     => 35,
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
					'label'       => __( 'Secondary text font size', 'osixthreeo' ),
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
					'label'    => __( 'Secondary text color', 'osixthreeo' ),
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
					'label'    => __( 'Note:', 'osixthreeo' ),
					'content'  => __( 'Text entered above only displays on the homepage.', 'osixthreeo' ) . '</p>',
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
