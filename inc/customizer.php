<?php
/**
 * Theme Customizer.
 *
 * @package kelso
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'customize_register', 'kelso_set_customizer_helpers', 1 );
/**
 * Set up helpers early so they're always available.
 * Other modules might need access to them at some point.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kelso_set_customizer_helpers( $wp_customize ) {
	// Load helpers.
	require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';
	// Inlcude the Alpha Color Picker Class file.
	require_once trailingslashit( get_template_directory() ) . 'inc/customizer/class-customize-alpha-color-control.php';
	// Inlcude the Radio Image Class file.
	require_once trailingslashit( get_template_directory() ) . 'inc/customizer/class-customize-radio-image-control.php';
}


add_action( 'customize_register', 'kelso_customize_register' );
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kelso_customize_register( $wp_customize ) {

	$defaults = kelso_get_defaults();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	// $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_control( 'header_textcolor' )->priority = 20;

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'kelso_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'kelso_customize_partial_blogdescription',
		) );
	}
	/**
	 * Render the site title for the selective refresh partial.
	 */
	function kelso_customize_partial_blogname() {
		bloginfo( 'name' );
	}
	/**
	 * Render the site tagline for the selective refresh partial.
	 */
	function kelso_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

	// header image.
	$wp_customize->add_setting( 'header_image' , array(
		'transport'   => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	) );

	/*
	 * COLORS ---------------------------------------------------
	 * ----------------------------------------------------------
	 */

	/*
	 * HEADER - nav / logo -----------------------
	 */

	 // Header Background Color.
	$wp_customize->add_setting(
		'kelso_settings[header_background_color]', array(
			'default' => $defaults['header_background_color'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_rgba',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new Customize_Alpha_Color_Control(
			$wp_customize,
			'kelso_settings[header_background_color]',
			array(
				'label' => __( 'Header Background Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[header_background_color]',
				'priority' => 10,
				'show_opacity' => true,
			)
		)
	);

	// Nav Link Color.
	$wp_customize->add_setting(
		'kelso_settings[nav_link_color]', array(
			'default' => $defaults['nav_link_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			// 'transport' => 'postMessage', // psuedo elements in menu-search
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[nav_link_color]',
			array(
				'label' => __( 'Header Navigation Link Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[nav_link_color]',
				'priority' => 25,
			)
		)
	);

	 // Sticky Header Background.
	$wp_customize->add_setting(
		'kelso_settings[stickyheader_background_color]', array(
			'default' => $defaults['stickyheader_background_color'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_rgba',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new Customize_Alpha_Color_Control(
			$wp_customize,
			'kelso_settings[stickyheader_background_color]',
			array(
				'label' => __( 'Sticky Header Background Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[stickyheader_background_color]',
				'priority' => 30,
				'show_opacity' => true,
			)
		)
	);

	// Sticky Text Color.
	$wp_customize->add_setting(
		'kelso_settings[stickyheader_text_color]', array(
			'default' => $defaults['stickyheader_text_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			// 'transport' => 'postMessage', // gets overridden by non-sticky.
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[stickyheader_text_color]',
			array(
				'label' => __( 'Sticky Header Text Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[stickyheader_text_color]',
				'priority' => 35,
			)
		)
	);

	// Sticky Link.
	$wp_customize->add_setting(
		'kelso_settings[stickyheader_link_color]', array(
			'default' => $defaults['stickyheader_link_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			// 'transport' => 'postMessage', // gets overridden & psudo elements in menu-search
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[stickyheader_link_color]',
			array(
				'label' => __( 'Sticky Header Navigation Link Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[stickyheader_link_color]',
				'priority' => 40,
			)
		)
	);

	// Colors Content Background.
	$wp_customize->add_setting(
		'kelso_settings[content_background_color]', array(
			'default' => $defaults['content_background_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[content_background_color]',
			array(
				'label' => __( 'Content Area Background Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[content_background_color]',
				'priority' => 50,
			)
		)
	);

	 // Content Inner Background Color.
	$wp_customize->add_setting(
		'kelso_settings[content_inner_background_color]', array(
			'default' => $defaults['content_inner_background_color'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_rgba',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new Customize_Alpha_Color_Control(
			$wp_customize,
			'kelso_settings[content_inner_background_color]',
			array(
				'label' => __( 'Inner Content Area Background Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[content_inner_background_color]',
				'priority' => 60,
			)
		)
	);

	// Content Title Color.
	$wp_customize->add_setting(
		'kelso_settings[content_title_color]', array(
			'default' => $defaults['content_title_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[content_title_color]',
			array(
				'label' => __( 'Post/Page Title Color', 'kelso' ),
				'description' => __( 'Page and Post titles (not homepage).', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[content_title_color]',
				'priority' => 70,
			)
		)
	);

	// Colors Text.
	$wp_customize->add_setting(
		'kelso_settings[text_color]', array(
			'default' => $defaults['text_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[text_color]',
			array(
				'label' => __( 'Text Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[text_color]',
				'priority' => 80,
			)
		)
	);

	// Color Primary - Link.
	$wp_customize->add_setting(
		'kelso_settings[link_color]', array(
			'default' => $defaults['link_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[link_color]',
			array(
				'label' => __( 'Primary Highlight Color', 'kelso' ),
				'description' => __( 'Links & Buttons', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[link_color]',
				'priority' => 90,
			)
		)
	);

	// Color Secondary - Link-Hover.
	$wp_customize->add_setting(
		'kelso_settings[link_color_hover]', array(
			'default' => $defaults['link_color_hover'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[link_color_hover]',
			array(
				'label' => __( 'Secondary Highlight Color', 'kelso' ),
				'description' => __( 'Link hover states & "secondary" buttons', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[link_color_hover]',
				'priority' => 100,
			)
		)
	);

	// FOOTER WIDGETS
	 // FW - Background Color.
	$wp_customize->add_setting(
		'kelso_settings[footerwidgets_background_color]', array(
			'default' => $defaults['footerwidgets_background_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[footerwidgets_background_color]',
			array(
				'label' => __( 'Sub-Footer Background Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[footerwidgets_background_color]',
				'priority' => 110,
			)
		)
	);

	// FW - Widget Title Color.
	$wp_customize->add_setting(
		'kelso_settings[footerwidgets_widget_title_color]', array(
			'default' => $defaults['footerwidgets_widget_title_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[footerwidgets_widget_title_color]',
			array(
				'label' => __( 'Sub-Footer Title Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[footerwidgets_widget_title_color]',
				'priority' => 120,
			)
		)
	);

	// FW - Text Color.
	$wp_customize->add_setting(
		'kelso_settings[footerwidgets_text_color]', array(
			'default' => $defaults['footerwidgets_text_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[footerwidgets_text_color]',
			array(
				'label' => __( 'Sub-Footer Text Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[footerwidgets_text_color]',
				'priority' => 130,
			)
		)
	);

	// FW - Link Color.
	$wp_customize->add_setting(
		'kelso_settings[footerwidgets_link_color]', array(
			'default' => $defaults['footerwidgets_link_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[footerwidgets_link_color]',
			array(
				'label' => __( 'Sub-Footer Link Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[footerwidgets_link_color]',
				'priority' => 140,
			)
		)
	);

	// FW - Link Hover Color.
	$wp_customize->add_setting(
		'kelso_settings[footerwidgets_link_color_hover]', array(
			'default' => $defaults['footerwidgets_link_color_hover'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[footerwidgets_link_color_hover]',
			array(
				'label' => __( 'Sub-Footer Link Hover Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[footerwidgets_link_color_hover]',
				'priority' => 150,
			)
		)
	);

	// SITE FOOTER
	// SF - Background Color.
	$wp_customize->add_setting(
		'kelso_settings[footer_background_color]', array(
			'default' => $defaults['footer_background_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[footer_background_color]',
			array(
				'label' => __( 'Footer Background Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[footer_background_color]',
				'priority' => 160,
			)
		)
	);

	// SF - Text Color.
	$wp_customize->add_setting(
		'kelso_settings[footer_text_color]', array(
			'default' => $defaults['footer_text_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[footer_text_color]',
			array(
				'label' => __( 'Footer Text Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[footer_text_color]',
				'priority' => 170,
			)
		)
	);

	// SF - Link Color.
	$wp_customize->add_setting(
		'kelso_settings[footer_link_color]', array(
			'default' => $defaults['footer_link_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[footer_link_color]',
			array(
				'label' => __( 'Footer Link Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[footer_link_color]',
				'priority' => 180,
			)
		)
	);

	// SF - Link Hover Color.
	$wp_customize->add_setting(
		'kelso_settings[footer_link_color_hover]', array(
			'default' => $defaults['footer_link_color_hover'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[footer_link_color_hover]',
			array(
				'label' => __( 'Footer Link Hover Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[footer_link_color_hover]',
				'priority' => 190,
			)
		)
	);

	// TOP BAR --------------------------------------------------
	// TB - Background Color.
	$wp_customize->add_setting(
		'kelso_settings[topbar_background_color]', array(
			'default' => $defaults['topbar_background_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[topbar_background_color]',
			array(
				'label' => __( 'Topbar Background Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[topbar_background_color]',
				'priority' => 200,
			)
		)
	);

	// TB - Widget Title Color.
	$wp_customize->add_setting(
		'kelso_settings[topbar_widget_title_color]', array(
			'default' => $defaults['topbar_widget_title_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[topbar_widget_title_color]',
			array(
				'label' => __( 'Topbar Widget Title Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[topbar_widget_title_color]',
				'priority' => 210,
			)
		)
	);

	// TB - Text Color.
	$wp_customize->add_setting(
		'kelso_settings[topbar_text_color]', array(
			'default' => $defaults['topbar_text_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[topbar_text_color]',
			array(
				'label' => __( 'Topbar Text Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[topbar_text_color]',
				'priority' => 220,
			)
		)
	);

	// TB - Link Color.
	$wp_customize->add_setting(
		'kelso_settings[topbar_link_color]', array(
			'default' => $defaults['topbar_link_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[topbar_link_color]',
			array(
				'label' => __( 'Topbar Link Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[topbar_link_color]',
				'priority' => 230,
			)
		)
	);

	// TB - Link Hover Color.
	$wp_customize->add_setting(
		'kelso_settings[topbar_link_color_hover]', array(
			'default' => $defaults['topbar_link_color_hover'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[topbar_link_color_hover]',
			array(
				'label' => __( 'Topbar Link Hover Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[topbar_link_color_hover]',
				'priority' => 240,
			)
		)
	);

	/*
	 * CUSTOM HEADER ----------------------------------------------------
	 * ------------------------------------------------------------------
	 */

	// Homepage Header Height.
	$wp_customize->add_setting(
		'kelso_settings[home_header_height]',
		array(
			'default' => $defaults['home_header_height'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'kelso_settings[home_header_height]',
		array(
			'type' => 'checkbox',
			'label' => __( 'FULL HEIGHT Homepage Header', 'kelso' ),
			'description' => __( 'Fills the whole browser on the homepage.', 'kelso' ),
			'section' => 'header_image',
			'settings' => 'kelso_settings[home_header_height]',
			'priority' => 40,
		)
	);

	 // Header Background Color - Left.
	 $wp_customize->add_setting(
		 'kelso_settings[header_bg_color_left]', array(
			 'default' => $defaults['header_bg_color_left'],
			 'type' => 'option',
			 'sanitize_callback' => 'sanitize_hex_color',
		 )
	 );
	 $wp_customize->add_control(
		 new WP_Customize_Color_Control(
			 $wp_customize,
			 'kelso_settings[header_bg_color_left]',
			 array(
				 'label' => __( 'Header Background Color - Left', 'kelso' ),
				 'section' => 'header_image',
				 'description'   => __( 'Gradient start color.', 'kelso' ),
				 'settings' => 'kelso_settings[header_bg_color_left]',
				 'priority' => 50,
			 )
		 )
	 );

	 // Header Background Color - Right.
	 $wp_customize->add_setting(
		 'kelso_settings[header_bg_color_right]', array(
			 'default' => $defaults['header_bg_color_right'],
			 'type' => 'option',
			 'sanitize_callback' => 'sanitize_hex_color',
		 )
	 );
	 $wp_customize->add_control(
		 new WP_Customize_Color_Control(
			 $wp_customize,
			 'kelso_settings[header_bg_color_right]',
			 array(
				 'label' => __( 'Header Background Color - Right', 'kelso' ),
				 'section' => 'header_image',
				 'description'   => __( 'Gradient finish color.', 'kelso' ),
				 'settings' => 'kelso_settings[header_bg_color_right]',
				 'priority' => 60,
			 )
		 )
	 );

	// Homepage Header Primary Text Area.
	$wp_customize->add_setting(
		'kelso_settings[hero_text_primary]',
		array(
			'default' => $defaults['hero_text_primary'],
			'type' => 'option',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		'kelso_settings[hero_text_primary]',
		array(
			'type'     => 'textarea',
			'label'    => __( 'Homepage Header Text - Primary', 'kelso' ),
			'section'  => 'header_image',
			'priority' => 70,
		)
	);

	// Homepage Header Primary Text Color.
	$wp_customize->add_setting(
		'kelso_settings[hero_text_primary_color]',
		array(
			'default' => $defaults['hero_text_primary_color'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_rgba',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new Customize_Alpha_Color_Control(
			$wp_customize,
			'kelso_settings[hero_text_primary_color]',
			array(
				'label' => __( 'Color', 'kelso' ),
				'section' => 'header_image',
				'settings' => 'kelso_settings[hero_text_primary_color]',
				'priority' => 80,
			)
		)
	);

	// Homepage Header Secondary Text Area.
	$wp_customize->add_setting(
		'kelso_settings[hero_text_secondary]',
		array(
			'default' => $defaults['hero_text_secondary'],
			'type' => 'option',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		'kelso_settings[hero_text_secondary]',
		array(
			'type'     => 'textarea',
			'label'    => __( 'Homepage Header Text - Secondary', 'kelso' ),
			'section'  => 'header_image',
			'priority' => 90,
		)
	);

	// Homepage Header Secondary Text Color.
	$wp_customize->add_setting(
		'kelso_settings[hero_text_secondary_color]',
		array(
			'default' => $defaults['hero_text_secondary_color'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_rgba',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new Customize_Alpha_Color_Control(
			$wp_customize,
			'kelso_settings[hero_text_secondary_color]',
			array(
				'label' => __( 'Color', 'kelso' ),
				'section' => 'header_image',
				'settings' => 'kelso_settings[hero_text_secondary_color]',
				'priority' => 100,
			)
		)
	);

	/*
	 * LAYOUT OPTIONS -------------------------------------------
	 * ----------------------------------------------------------
	 */
	if ( class_exists( 'WP_Customize_Panel' ) ) {
		if ( ! $wp_customize->get_panel( 'kelso_layout_panel' ) ) {
			$wp_customize->add_panel( 'kelso_layout_panel', array(
				'priority' => 30,
				'title' => __( 'Site Layout', 'kelso' ),
			) );
		}
	}

	/*
	 * LAYOUT / SIDEBARS -----------------------------------
	 */
	$wp_customize->add_section(
		'kelso_page_layouts',
		array(
			'title' => __( 'Page Layout', 'kelso' ),
			'priority' => 10,
			'panel' => 'kelso_layout_panel',
		)
	);

	// Layout Site Width.
	$wp_customize->add_setting(
		'kelso_settings[global_width_setting]',
		array(
			'default' => $defaults['global_width_setting'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_choices',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'kelso_settings[global_width_setting]',
		array(
			'type' => 'radio',
			'label' => __( 'Site Width', 'kelso' ),
			'section' => 'kelso_page_layouts',
			'choices' => array(
				'full' => __( 'Full Width', 'kelso' ),
				'contained' => __( 'Contained', 'kelso' ),
			),
			'settings' => 'kelso_settings[global_width_setting]',
			'priority' => 10,
		)
	);

	// Layout Home.
	$wp_customize->add_setting(
		'kelso_settings[home_layout_setting]',
		array(
			'default' => $defaults['home_layout_setting'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		new Customize_Radio_Image_Control(
			$wp_customize,
			'kelso_settings[home_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Homepage Layout', 'kelso' ),
				'description' => __( 'normal - left sidebar - right sidebar - narrow', 'kelso' ),
				'section' => 'kelso_page_layouts',
				'choices' => array(
					'layout-ns' => __( 'layout-ns', 'kelso' ),
					'layout-ls' => __( 'layout-ls', 'kelso' ),
					'layout-rs' => __( 'layout-rs', 'kelso' ),
					'layout-c' => __( 'layout-c', 'kelso' ),
				),
				'settings' => 'kelso_settings[home_layout_setting]',
				'priority' => 20,
			)
		)
	);

	// Layout Pages.
	$wp_customize->add_setting(
		'kelso_settings[page_layout_setting]',
		array(
			'default' => $defaults['page_layout_setting'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		new Customize_Radio_Image_Control(
			$wp_customize,
			'kelso_settings[page_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Pages Layout', 'kelso' ),
				'description' => __( 'Override individual pages using the Page Template drop-down', 'kelso' ),
				'section' => 'kelso_page_layouts',
				'choices' => array(
					'layout-ns' => __( 'layout-ns', 'kelso' ),
					'layout-ls' => __( 'layout-ls', 'kelso' ),
					'layout-rs' => __( 'layout-rs', 'kelso' ),
					'layout-c' => __( 'layout-c', 'kelso' ),
				),
				'settings' => 'kelso_settings[page_layout_setting]',
				'priority' => 30,
			)
		)
	);

	// Layout Single Posts.
	$wp_customize->add_setting(
		'kelso_settings[single_layout_setting]',
		array(
			'default' => $defaults['single_layout_setting'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		new Customize_Radio_Image_Control(
			$wp_customize,
			'kelso_settings[single_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Single Post Layout', 'kelso' ),
				'section' => 'kelso_page_layouts',
				'choices' => array(
					'layout-ns' => __( 'layout-ns', 'kelso' ),
					'layout-ls' => __( 'layout-ls', 'kelso' ),
					'layout-rs' => __( 'layout-rs', 'kelso' ),
					'layout-c' => __( 'layout-c', 'kelso' ),
				),
				'settings' => 'kelso_settings[single_layout_setting]',
				'priority' => 40,
			)
		)
	);

	// Layout Archive, Index & 404.
	$wp_customize->add_setting(
		'kelso_settings[archive_layout_setting]',
		array(
			'default' => $defaults['archive_layout_setting'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		new Customize_Radio_Image_Control(
			$wp_customize,
			'kelso_settings[archive_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Archive/Blog Layout', 'kelso' ),
				'section' => 'kelso_page_layouts',
				'choices' => array(
					'layout-ns' => __( 'layout-ns', 'kelso' ),
					'layout-ls' => __( 'layout-ls', 'kelso' ),
					'layout-rs' => __( 'layout-rs', 'kelso' ),
					'layout-c' => __( 'layout-c', 'kelso' ),
				),
				'settings' => 'kelso_settings[archive_layout_setting]',
				'priority' => 50,
			)
		)
	);

	// Layout Search.
	$wp_customize->add_setting(
		'kelso_settings[search_layout_setting]',
		array(
			'default' => $defaults['search_layout_setting'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		new Customize_Radio_Image_Control(
			$wp_customize,
			'kelso_settings[search_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Search Results Layout', 'kelso' ),
				'section' => 'kelso_page_layouts',
				'choices' => array(
					'layout-ns' => __( 'layout-ns', 'kelso' ),
					'layout-ls' => __( 'layout-ls', 'kelso' ),
					'layout-rs' => __( 'layout-rs', 'kelso' ),
					'layout-c' => __( 'layout-c', 'kelso' ),
				),
				'settings' => 'kelso_settings[search_layout_setting]',
				'priority' => 60,
			)
		)
	);

	/*
	 * Header Layout - tab.
	 */
	$wp_customize->add_section(
		'kelso_header_layouts',
		array(
			'title' => __( 'Header Layout', 'kelso' ),
			'priority' => 20,
			'panel' => 'kelso_layout_panel',
		)
	);

	 // Header Layout.
	$wp_customize->add_setting(
		'kelso_settings[header_layout]',
		array(
			'default' => $defaults['header_layout'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_choices',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new Customize_Radio_Image_Control(
			$wp_customize,
			'kelso_settings[header_layout]',
			array(
				'type' => 'select',
				'label' => __( 'Logo/Navigation Layout.', 'kelso' ),
				'description' => __( 'left & right - centered', 'kelso' ),
				'section' => 'kelso_header_layouts',
				'choices' => array(
					'headernormal' => __( 'headernormal', 'kelso' ),
					'headercentered' => __( 'headercentered', 'kelso' ),
				),
				'settings' => 'kelso_settings[header_layout]',
				'priority' => 10,
			)
		)
	);

	// Append Search to Menu.
	$wp_customize->add_setting(
		'kelso_settings[nav_search]',
		array(
			'default' => $defaults['nav_search'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'kelso_settings[nav_search]',
		array(
			'type' => 'checkbox',
			'label' => __( 'MENU SEARCH', 'kelso' ),
			'description' => __( 'Append search functionality to the menu.', 'kelso' ),
			'section' => 'kelso_header_layouts',
			'settings' => 'kelso_settings[nav_search]',
			'priority' => 20,
		)
	);

	/*
	 * Content Layout - tab.
	 */
	$wp_customize->add_section(
		'kelso_content_layouts',
		array(
			'title' => __( 'Content Layout', 'kelso' ),
			'priority' => 30,
			'panel' => 'kelso_layout_panel',
		)
	);

	// Title/Content Placement.
	$wp_customize->add_setting(
		'kelso_settings[content_title_placement]',
		array(
			'default' => $defaults['content_title_placement'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_choices',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new Customize_Radio_Image_Control(
			$wp_customize,
			'kelso_settings[content_title_placement]',
			array(
				'type' => 'select',
				'label' => __( 'Page/Post Title Placement', 'kelso' ),
				'description' => __( 'normal - title lifted - content lifted.', 'kelso' ),
				'section' => 'kelso_content_layouts',
				'choices' => array(
					'normal' => __( 'titlenormal', 'kelso' ),
					'titlelifted' => __( 'titlelifted', 'kelso' ),
					'contentlifted' => __( 'contentlifted', 'kelso' ),
				),
				'settings' => 'kelso_settings[content_title_placement]',
				'priority' => 10,
			)
		)
	);

	/*
	 * Archive Layout - tab.
	 */
	$wp_customize->add_section(
		'kelso_archive_layouts',
		array(
			'title' => __( 'Archive/Blog Layout', 'kelso' ),
			'priority' => 40,
			'panel' => 'kelso_layout_panel',
		)
	);

	// Masonry.
	$wp_customize->add_setting(
		'kelso_settings[do_masonry]',
		array(
			'default' => $defaults['do_masonry'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'kelso_settings[do_masonry]',
		array(
			'type' => 'checkbox',
			'label' => __( 'MASONRY', 'kelso' ),
			'description' => __( 'Display post archives in "masonry" blocks layout.', 'kelso' ),
			'section' => 'kelso_archive_layouts',
			'settings' => 'kelso_settings[do_masonry]',
			'priority' => 10,
		)
	);

	/*
	 * Site Footer Options - tab.
	 */
	$wp_customize->add_section(
		'kelso_footer_layouts',
		array(
			'title' => __( 'Footer Layout', 'kelso' ),
			'priority' => 50,
			'panel' => 'kelso_layout_panel',
		)
	);

	// Back To Top.
	$wp_customize->add_setting(
		'kelso_settings[back_to_top]',
		array(
			'default' => $defaults['back_to_top'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'kelso_settings[back_to_top]',
		array(
			'type' => 'checkbox',
			'label' => __( 'BACK TO TOP', 'kelso' ),
			'description' => __( 'Add a Back To Top button to the right side of the site footer.', 'kelso' ),
			'section' => 'kelso_footer_layouts',
			'settings' => 'kelso_settings[back_to_top]',
			'priority' => 10,
		)
	);

}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'kelso_customizer_live_preview' ) ) {
	add_action( 'customize_preview_init', 'kelso_customizer_live_preview', 100 );
	/**
	 * Add our live preview scripts
	 *
	 * @since 0.1
	 */
	function kelso_customizer_live_preview() {
		wp_enqueue_script( 'kelso-themecustomizer', trailingslashit( get_template_directory_uri() ) . 'assets/js/customizer.js', array( 'customize-preview' ), KELSO_VERSION, true );
	}
}
