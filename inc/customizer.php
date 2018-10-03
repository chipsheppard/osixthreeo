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
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

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
		'default'     => '',
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

	/*
	* NAVIGATION -----------------------
	*/

	// Colors Nav Link.
	$wp_customize->add_setting(
		'kelso_settings[nav_link_color]', array(
			'default' => $defaults['nav_link_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[nav_link_color]',
			array(
				'label' => __( 'Navigation Link Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[nav_link_color]',
				'priority' => 20,
			)
		)
	);

	/*
	 * STICKY HEADER -----------------------
	 */

	 // Colors Sticky Background.
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
				'priority' => 26,
				'show_opacity' => true,
			)
		)
	);

	// Sticky Link.
	$wp_customize->add_setting(
		'kelso_settings[stickyheader_link_color]', array(
			'default' => $defaults['stickyheader_link_color'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
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
				'priority' => 27,
			)
		)
	);

	/*
	 * CUSTOM HEADER ----------------------------------------------------
	 * ------------------------------------------------------------------
	 */

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
				 'description'   => __( 'Set or change the left gradient starting color.', 'kelso' ),
				 'settings' => 'kelso_settings[header_bg_color_left]',
				 'priority' => 30,
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
				 'description'   => __( 'Set or change the right gradient starting color.', 'kelso' ),
				 'settings' => 'kelso_settings[header_bg_color_right]',
				 'priority' => 40,
			 )
		 )
	 );

	// Homepage Custom Header Primary Text Area.
	$wp_customize->add_setting(
		'kelso_settings[hero_text_primary]',
		array(
			'default' => $defaults['hero_text_primary'],
			'type' => 'option',
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control(
		'kelso_settings[hero_text_primary]',
		array(
			'type'     => 'textarea',
			'label'    => __( 'Homepage Header Text - Primary', 'kelso' ),
			'section'  => 'header_image',
			'priority' => 50,
		)
	);

	// Homepage Custom Header Primary Text Color.
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
				'priority' => 60,
			)
		)
	);

	// Homepage Custom Header Secondary Text Area.
	$wp_customize->add_setting(
		'kelso_settings[hero_text_secondary]',
		array(
			'default' => $defaults['hero_text_secondary'],
			'type' => 'option',
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control(
		'kelso_settings[hero_text_secondary]',
		array(
			'type'     => 'textarea',
			'label'    => __( 'Homepage Header Text - Secondary', 'kelso' ),
			'section'  => 'header_image',
			'priority' => 70,
		)
	);

	// Homepage Custom Header Secondary Text Color.
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
				'priority' => 80,
			)
		)
	);

	/*
	 * CONTENT AREA -----------------------
	 */

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
				'priority' => 90,
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
				'priority' => 100,
			)
		)
	);

	// Colors Link.
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
				'priority' => 110,
			)
		)
	);

	// Colors Link-Hover.
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
				'description' => __( 'Link hover states, Menu "accent" border, "secondary" buttons', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[link_color_hover]',
				'priority' => 120,
			)
		)
	);

	/*
	 * FOOTER WIDGETS -----------------------
	 */

	 // Colors Footer Widgets Background.
	$wp_customize->add_setting(
		'kelso_settings[footerwidgets_background_color]', array(
			'default' => $defaults['footerwidgets_background_color'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_rgba',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'kelso_settings[footerwidgets_background_color]',
			array(
				'label' => __( 'Footer Widgets Background Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[footerwidgets_background_color]',
				'priority' => 130,
			)
		)
	);

	// Colors Footer Widgets Text.
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
				'label' => __( 'Footer Widgets Text Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[footerwidgets_text_color]',
				'priority' => 140,
			)
		)
	);

	// Colors Footer Widgets Link.
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
				'label' => __( 'Footer Widgets Link Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[footerwidgets_link_color]',
				'priority' => 150,
			)
		)
	);

	// Colors Footer Widgets Link-Hover.
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
				'label' => __( 'Footer Widgets Link Hover Color', 'kelso' ),
				'section' => 'colors',
				'settings' => 'kelso_settings[footerwidgets_link_color_hover]',
				'priority' => 160,
			)
		)
	);

	/*
	 * SITE FOOTER -----------------------
	 */

	 // Colors Footer Background.
	$wp_customize->add_setting(
		'kelso_settings[footer_background_color]', array(
			'default' => $defaults['footer_background_color'],
			'type' => 'option',
			'sanitize_callback' => 'kelso_sanitize_rgba',
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
				'priority' => 170,
			)
		)
	);

	// Colors Footer Text.
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
				'priority' => 180,
			)
		)
	);

	// Colors Footer Link.
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
				'priority' => 190,
			)
		)
	);

	// Colors Footer Link-Hover.
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
				'priority' => 200,
			)
		)
	);

	/*
	 * SITE LAYOUT / SIDEBARS -----------------------------------
	 * ----------------------------------------------------------
	 */
	$wp_customize->add_section(
		'kelso_layout_settings',
		array(
			'title' => __( 'Site Layout', 'kelso' ),
			'priority' => 80,
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
			'section' => 'kelso_layout_settings',
			'choices' => array(
				'full' => __( 'Full', 'kelso' ),
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
				'section' => 'kelso_layout_settings',
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
				'label' => __( 'Page Layout', 'kelso' ),
				'description' => __( 'This can be overridden using the Page Template drop-down', 'kelso' ),
				'section' => 'kelso_layout_settings',
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
				'section' => 'kelso_layout_settings',
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
				'section' => 'kelso_layout_settings',
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
				'section' => 'kelso_layout_settings',
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
	 * THEME OPTIONS -------------------------------------------------------
	 * ---------------------------------------------------------------------
	 */
	$wp_customize->add_section(
		'kelso_options_settings',
		array(
			'title' => __( 'Theme Options', 'kelso' ),
			'priority' => 90,
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
			'label' => __( 'Back to Top Button', 'kelso' ),
			'description' => __( 'Add a button to the right side of the lower footer. Note: The lower footer widget must be activated.', 'kelso' ),
			'section' => 'kelso_options_settings',
			'settings' => 'kelso_settings[back_to_top]',
			'priority' => 10,
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
			'label' => __( 'Navigation Search', 'kelso' ),
			'description' => __( 'Append search functionality to the menu.', 'kelso' ),
			'section' => 'kelso_options_settings',
			'settings' => 'kelso_settings[nav_search]',
			'priority' => 20,
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
