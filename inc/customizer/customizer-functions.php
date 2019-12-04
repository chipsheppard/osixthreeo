<?php
/**
 * Customizer functions.
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

/**
 * A wrapper function to get our settings.
 *
 * @since 1.3.40
 *
 * @param string $setting The option name to look up.
 * @return string The option value.
 * @todo Ability to specify different option name and defaults.
 */
function osixthreeo_get_setting( $setting ) {
	$defaults = osixthreeo_get_defaults();

	if ( ! isset( $defaults[ $setting ] ) ) {
		return;
	}

	$osixthreeo_settings = wp_parse_args(
		get_option( 'osixthreeo_settings', array() ),
		$defaults
	);
	return $osixthreeo_settings[ $setting ];
}

/**
 * SIDEBAR LAYOUTS
 * -----------------------------------------------------------------
 *
 * @return string The sidebar layout location.
 */
function osixthreeo_get_layout() {
	$layout = null;

	// Get Customizer options.
	$osixthreeo_settings = wp_parse_args(
		get_option( 'osixthreeo_settings', array() ),
		osixthreeo_get_defaults()
	);

	// If on Homepage (page.php).
	if ( is_front_page() ) {
		$layout = $osixthreeo_settings['home_layout_setting'];
	}

	// If on PAGE but not the homepage (page.php).
	if ( ! is_front_page() && ! is_search() && 'page' === get_post_type() ) {
		$layout = $osixthreeo_settings['page_layout_setting'];
	}

	// If on SINGLE (single.php) - Works for any post type, except attachments and pages.
	if ( is_single() ) {
		$layout = $osixthreeo_settings['single_layout_setting'];
	}

	// If on SEARCH (search.php).
	if ( is_search() ) {
		$layout = $osixthreeo_settings['search_layout_setting'];
	}

	// If on ARCHIVE (archive.php), HOME-blog (index.php), 404 (404.php), attachment etc...
	if ( is_home() && ! is_front_page() || is_archive() || is_tax() || is_404() ) {
		$layout = $osixthreeo_settings['archive_layout_setting'];
	}

	// Return the layout.
	return apply_filters( 'osixthreeo_sidebar_layout', $layout );
}
add_action( 'osixthreeo_init', 'osixthreeo_get_layout' );

/**
 * SIDEBAR Body Classes
 * -----------------------------------------------------------------
 *
 * @param array $classes The body classes.
 */
function osixthreeo_sidebar_bodyclass( $classes ) {
	$layout = osixthreeo_get_layout();
	if ( 'layout-ls' === $layout ) :
		$classes[] = 'sidebar-left';
	elseif ( 'layout-rs' === $layout ) :
		$classes[] = 'sidebar-right';
	elseif ( 'layout-c' === $layout ) :
		$classes[] = 'nosidebar-silo';
	endif;
	return $classes;
}
add_filter( 'body_class', 'osixthreeo_sidebar_bodyclass' );

/**
 * SIDEBAR LEFT ------------------------
 * If layout is left sidebar...
 */
function osixthreeo_get_left_sidebar() {
	$layout = osixthreeo_get_layout();
	if ( 'layout-ls' !== $layout ) :
		return;
	endif;
	get_sidebar();
}
add_action( 'tha_content_before', 'osixthreeo_get_left_sidebar' );

/**
 * SIDEBAR RIGHT ----------------------
 * If layout is right sidebar...
 */
function osixthreeo_get_right_sidebar() {
	$layout = osixthreeo_get_layout();
	if ( 'layout-rs' !== $layout ) :
		return;
	endif;
	get_sidebar();
}
add_action( 'tha_content_after', 'osixthreeo_get_right_sidebar' );


/**
 * SITE CONTAINMENT
 * -----------------------------------------------------------------
 * Adds custom class to section containers.
 */
function osixthreeo_sitecontain_class() {

	$osixthreeo_settings = wp_parse_args(
		get_option( 'osixthreeo_settings', array() ),
		osixthreeo_get_defaults()
	);

	$site_layout = $osixthreeo_settings['containment_setting'];

	if ( 'contained' === $site_layout ) {
		add_filter(
			'body_class',
			function( $classes ) {
				return array_merge( $classes, array( 'contained' ) );
			}
		);
	} else {
		return;
	}
}
add_action( 'osixthreeo_init', 'osixthreeo_sitecontain_class' );


/**
 * HEADER LAYOUT
 * -----------------------------------------------------------------
 * Adds custom class to section containers.
 */
function osixthreeo_header_layout_class() {

	$osixthreeo_settings = wp_parse_args(
		get_option( 'osixthreeo_settings', array() ),
		osixthreeo_get_defaults()
	);

	$header_layout = $osixthreeo_settings['header_layout'];

	if ( 'headercentered' === $header_layout ) {
		add_filter(
			'body_class',
			function( $classes ) {
				return array_merge( $classes, array( 'headercentered' ) );
			}
		);
	} else {
		return;
	}
}
add_action( 'osixthreeo_init', 'osixthreeo_header_layout_class' );


/**
 * HOMEPAGE HEADER FULL-HEIGHT Checkbox
 * -----------------------------------------------------------------
 * Check if full-height is selected, write a body class if it is..
 */
function osixthreeo_home_header_fullheight() {

	if ( ! is_front_page() ) {
		return;
	}

	$osixthreeo_settings = wp_parse_args(
		get_option( 'osixthreeo_settings', array() ),
		osixthreeo_get_defaults()
	);

	$header_height = $osixthreeo_settings['home_header_fullheight'];

	if ( 'full' === $header_height ) {
		add_filter(
			'body_class',
			function( $classes ) {
				return array_merge( $classes, array( 'fullheight' ) );
			}
		);
	} else {
		return;
	}
}
add_action( 'osixthreeo_init', 'osixthreeo_home_header_fullheight' );
