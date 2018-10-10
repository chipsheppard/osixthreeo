<?php
/**
 * GlenRidge functions and definitions.
 *
 * @package kelso
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Set our theme version.
define( 'KELSO_VERSION', '1.0.0' );

/**
 * Load the extra stuff.
 */
require get_template_directory() . '/inc/tha-theme-hooks.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/theme-functions.php';
require get_template_directory() . '/inc/featured-image-checkbox.php';
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/loop.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/defaults.php';
require get_template_directory() . '/inc/customizer-functions.php';
require get_template_directory() . '/inc/class-kelso-css.php';
require get_template_directory() . '/inc/css-output.php';

/**
 * Enqueue scripts and styles.
 */
function kelso_scripts() {
	$kelso_settings = wp_parse_args(
		get_option( 'kelso_settings', array() ),
		kelso_get_defaults()
	);
	wp_enqueue_style( 'kelso-style', get_stylesheet_uri(), array(), KELSO_VERSION );
	wp_enqueue_style( 'kelso-fonts', kelso_theme_fonts_url() );
	wp_enqueue_script( 'kelso-navigationjs', get_template_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), KELSO_VERSION, true );
	wp_enqueue_script( 'kelso-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), KELSO_VERSION, true );
	wp_enqueue_script( 'kelso-globaljs', get_template_directory_uri() . '/assets/js/global.js', array( 'jquery' ), KELSO_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( '' !== $kelso_settings['nav_search'] ) {
		wp_enqueue_script( 'kelso-navigation-search', get_template_directory_uri() . '/assets/js/navsearch.js', array(), KELSO_VERSION, true );
	}
	if ( is_archive() && ! is_woocommerce() || is_home() ) {
		wp_enqueue_script( 'masonry' );
		wp_enqueue_script( 'masonry-init-js', get_template_directory_uri() . '/assets/js/masonry-init.js', array( 'jquery', 'masonry' ), KELSO_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'kelso_scripts' );

/**
 * Theme Fonts URL
 */
function kelso_theme_fonts_url() {
	$font_families = apply_filters( 'kelso_theme_fonts', array( 'Source+Sans+Pro:400,400i,600,600i,700,700i' ) );
	$query_args = array(
		'family' => implode( '|', $font_families ),
		'subset' => 'latin,latin-ext',
	);
	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue script for custom customize control.
 */
function kelso_customizer_custom_css() {
	wp_enqueue_style( 'customizer-css', get_stylesheet_directory_uri() . '/assets/css/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'kelso_customizer_custom_css' );


if ( ! function_exists( 'kelso_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since 0.1
	 */
	function kelso_setup() {

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array( 'aside', 'status' ) );
		add_theme_support( 'align-wide' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Set the content width in pixels, based on the theme's design and stylesheet.
		$GLOBALS['content_width'] = apply_filters( 'kelso_content_width', 1200 );

		// Custom Logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 300,
			'width'       => 600,
			'flex-height' => true,
			'flex-width'  => true,
		) );

		// Custom header.
		add_theme_support( 'custom-header', apply_filters( 'kelso_custom_header_args', array(
			'default-image'          => '',
			'default-text-color'     => '000000',
			'height'                 => 1500,
			'width'                  => 2000,
			'flex-height'            => true,
			'flex-width'             => true,
			'video'                  => true,
			'wp-head-callback'       => 'kelso_base_css', // inc/css-output.php.
		) ) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'kelso_custom_background_args', array(
			'default-color' => 'f5f5f5',
			'default-image' => '',
		) ) );

		// Jetpack infinite scroll.
		add_theme_support( 'infinite-scroll', array(
			'type'      => 'click',
			'container' => 'posts',
			'footer'    => false,
		) );

		// This theme uses wp_nav_menu() in 1 location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'kelso' ),
		) );

		// Make theme available for translation.
		load_theme_textdomain( 'kelso', get_template_directory() . '/languages' );

		// Theme styles for the visual editor.
		add_editor_style( 'assets/css/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'kelso_setup' );


/**
 * Make the TEXT editor the default.
 */
 add_filter( 'wp_default_editor', create_function( '', 'return "html";' ) );


/**
 * Limit the number of post revisions.
 *
 * @param string $num The number of post revisions to keep.
 * @param object $post The post object.
 */
function kelso_set_revision_max( $num, $post ) {
	$num = 10;
	return $num;
}
add_filter( 'wp_revisions_to_keep', 'kelso_set_revision_max', 10, 2 );


// Load Jetpack compatibility file.
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/*
 * Add Theme support for WooCommerce
 * http://www.wpexplorer.com/woocommerce-compatible-theme/
 */
define( 'WPEX_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );
// Checking if WooCommerce is active.
if ( WPEX_WOOCOMMERCE_ACTIVE ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
