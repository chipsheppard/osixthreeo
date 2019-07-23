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
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function osixthreeo_set_customizer_helpers( $wp_customize ) {
	// Load helpers.
	require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';
	// Load custom HTML section.
	// - require_once trailingslashit( get_template_directory() ) . 'inc/customizer/class-custom-content-area.php';
	// Inlcude the Alpha Color Picker Class file.
	// - require_once trailingslashit( get_template_directory() ) . 'inc/customizer/class-customize-alpha-color-control.php';
	// Inlcude the Radio Image Class file.
	require_once trailingslashit( get_template_directory() ) . 'inc/customizer/class-customize-radio-image-control.php';
}

add_action( 'customize_register', 'osixthreeo_customize_register' );
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function osixthreeo_customize_register( $wp_customize ) {

	$defaults = osixthreeo_get_defaults();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_control( 'header_textcolor' )->transport = 20;

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
	 * LAYOUT OPTIONS -------------------------------------------
	 * ----------------------------------------------------------
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
	 * Header Layout - tab -----------------
	 */
	$wp_customize->add_section(
		'osixthreeo_header_layouts',
		array(
			'title'    => __( 'Header', 'osixthreeo' ),
			'priority' => 10,
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
		new Customize_Radio_Image_Control(
			$wp_customize,
			'osixthreeo_settings[header_layout]',
			array(
				'type'        => 'select',
				'label'       => __( 'Logo & Navigation.', 'osixthreeo' ),
				'description' => __( 'left & right - centered', 'osixthreeo' ),
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

	/*
	 * Content/Sidebar Layouts - tab -----------------------
	 */
	$wp_customize->add_section(
		'osixthreeo_page_layouts',
		array(
			'title'    => __( 'Content & Sidebars', 'osixthreeo' ),
			'priority' => 20,
			'panel'    => 'osixthreeo_layout_panel',
		)
	);

	// Layout Site Width.
	$wp_customize->add_setting(
		'osixthreeo_settings[global_width_setting]',
		array(
			'default'           => $defaults['global_width_setting'],
			'type'              => 'option',
			'sanitize_callback' => 'osixthreeo_sanitize_choices',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'osixthreeo_settings[global_width_setting]',
		array(
			'type'     => 'radio',
			'label'    => __( 'Site Width', 'osixthreeo' ),
			'section'  => 'osixthreeo_page_layouts',
			'choices'  => array(
				'full'      => __( 'Full Width', 'osixthreeo' ),
				'contained' => __( 'Contained', 'osixthreeo' ),
			),
			'settings' => 'osixthreeo_settings[global_width_setting]',
			'priority' => 10,
		)
	);

	// Checkbox for contained inner content area.
	$wp_customize->add_setting(
		'osixthreeo_settings[content_contain]',
		array(
			'default'           => $defaults['content_contain'],
			'type'              => 'option',
			'sanitize_callback' => 'osixthreeo_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'osixthreeo_settings[content_contain]',
		array(
			'type'        => 'checkbox',
			'label'       => __( 'Contain the content area', 'osixthreeo' ),
			'description' => __( 'Add padding and a border around the inner content area.', 'osixthreeo' ),
			'section'     => 'osixthreeo_page_layouts',
			'settings'    => 'osixthreeo_settings[content_contain]',
			'priority'    => 20,
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
		new Customize_Radio_Image_Control(
			$wp_customize,
			'osixthreeo_settings[home_layout_setting]',
			array(
				'type'        => 'select',
				'label'       => __( 'Homepage Layout', 'osixthreeo' ),
				'description' => __( 'normal - left sidebar - right sidebar - narrow', 'osixthreeo' ),
				'section'     => 'osixthreeo_page_layouts',
				'choices'     => array(
					'layout-ns' => __( 'layout-ns', 'osixthreeo' ),
					'layout-ls' => __( 'layout-ls', 'osixthreeo' ),
					'layout-rs' => __( 'layout-rs', 'osixthreeo' ),
					'layout-c'  => __( 'layout-c', 'osixthreeo' ),
				),
				'settings'    => 'osixthreeo_settings[home_layout_setting]',
				'priority'    => 30,
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
		new Customize_Radio_Image_Control(
			$wp_customize,
			'osixthreeo_settings[page_layout_setting]',
			array(
				'type'        => 'select',
				'label'       => __( 'Pages Layout', 'osixthreeo' ),
				'description' => __( 'Override individual pages using the Page Template drop-down', 'osixthreeo' ),
				'section'     => 'osixthreeo_page_layouts',
				'choices'     => array(
					'layout-ns' => __( 'layout-ns', 'osixthreeo' ),
					'layout-ls' => __( 'layout-ls', 'osixthreeo' ),
					'layout-rs' => __( 'layout-rs', 'osixthreeo' ),
					'layout-c'  => __( 'layout-c', 'osixthreeo' ),
				),
				'settings'    => 'osixthreeo_settings[page_layout_setting]',
				'priority'    => 40,
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
		new Customize_Radio_Image_Control(
			$wp_customize,
			'osixthreeo_settings[single_layout_setting]',
			array(
				'type'     => 'select',
				'label'    => __( 'Single Post Layout', 'osixthreeo' ),
				'section'  => 'osixthreeo_page_layouts',
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
		new Customize_Radio_Image_Control(
			$wp_customize,
			'osixthreeo_settings[archive_layout_setting]',
			array(
				'type'     => 'select',
				'label'    => __( 'Archive/Blog Layout', 'osixthreeo' ),
				'section'  => 'osixthreeo_page_layouts',
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
		new Customize_Radio_Image_Control(
			$wp_customize,
			'osixthreeo_settings[search_layout_setting]',
			array(
				'type'     => 'select',
				'label'    => __( 'Search Results Layout', 'osixthreeo' ),
				'section'  => 'osixthreeo_page_layouts',
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
}



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 0.1
 */
function osixthreeo_customizer_live_preview() {
	wp_enqueue_script( 'osixthreeo-themecustomizer', trailingslashit( get_template_directory_uri() ) . 'assets/js/customizer-min.js', array( 'customize-preview' ), OSIXTHREEO_VERSION, true );
}
add_action( 'customize_preview_init', 'osixthreeo_customizer_live_preview' );
