<?php
/**
 * Main Functions File
 *
 * @package  osixthreeo
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Theme data.
 */
define( 'OSIXTHREEO_VERSION', '1.2.0' );
define( 'OSIXTHREEO_THEME_NAME', 'OsixthreeO' );
define( 'OSIXTHREEO_AUTHOR_NAME', 'Sheppco' );
define( 'OSIXTHREEO_AUTHOR_LINK', 'https://sheppco.com' );

/**
 * Load the extra stuff.
 */
require get_template_directory() . '/inc/tha-theme-hooks.php';
require get_template_directory() . '/inc/wordpress-cleanup.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/entry-meta.php';
require get_template_directory() . '/inc/theme-functions.php';
require get_template_directory() . '/inc/loop.php';
require get_template_directory() . '/inc/class-fi-checkbox.php';
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer/defaults.php';
require get_template_directory() . '/inc/customizer/customizer-functions.php';
require get_template_directory() . '/inc/customizer/class-customizer-css.php';
require get_template_directory() . '/inc/customizer/css-output.php';

/**
 * Enqueue scripts and styles.
 */
function osixthreeo_scripts() {
	wp_enqueue_style( 'osixthreeo-style', get_stylesheet_uri(), array(), OSIXTHREEO_VERSION );
	wp_enqueue_script( 'osixthreeo-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), OSIXTHREEO_VERSION, true );
	wp_enqueue_script( 'osixthreeo-globaljs', get_template_directory_uri() . '/assets/js/global.js', array( 'jquery' ), OSIXTHREEO_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'osixthreeo_scripts' );

/**
 * Enqueue editor styles for the customizer
 */
function osixthreeo_customizer_custom_css() {
	wp_enqueue_style( 'osixthreeo-customizer-css', get_stylesheet_directory_uri() . '/assets/css/customizer.css', array(), OSIXTHREEO_VERSION );
}
add_action( 'customize_controls_enqueue_scripts', 'osixthreeo_customizer_custom_css' );

/**
 * Enqueue editor styles for Gutenberg
 */
function osixthreeo_gutenberg_editor_styles() {
	wp_enqueue_style( 'osixthreeo-gutenberg-editor-style', get_template_directory_uri() . '/assets/css/editor-style.css', array(), OSIXTHREEO_VERSION );
}
add_action( 'enqueue_block_editor_assets', 'osixthreeo_gutenberg_editor_styles' );



if ( ! function_exists( 'osixthreeo_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since 0.1
	 */
	function osixthreeo_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'osixthreeo', get_template_directory() . '/languages' );

		// Theme styles for the visual editor.
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/editor-style.css' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Body open hook.
		add_theme_support( 'body-open' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Set the content width in pixels, based on the theme's design and stylesheet.
		// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( 'osixthreeo_content_width', 1024 );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// wp_nav_menu() in 1 location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'osixthreeo' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'post-formats', array( 'aside', 'status' ) );

		// Gutenberg.
		// -- Responsive embeds.
		add_theme_support( 'responsive-embeds' );
		// -- Wide Images.
		add_theme_support( 'align-wide' );

		// Customizer.
		// -- Custom Logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 40,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		) );

		// -- WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'osixthreeo_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// -- Enable selective refresh in the customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'osixthreeo_setup' );


// Load Jetpack compatibility file.
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/*
 * Add Theme support for WooCommerce
 * http://www.wpexplorer.com/woocommerce-compatible-theme/
 */
define( 'OSIXTHREEO_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );
// Checking if WooCommerce is active.
if ( OSIXTHREEO_WOOCOMMERCE_ACTIVE ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
