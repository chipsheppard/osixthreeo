<?php
/**
 * Kelso Customizer functions.
 *
 * @package kelso
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
function kelso_get_setting( $setting ) {
	$kelso_settings = wp_parse_args(
		get_option( 'kelso_settings', array() ),
		kelso_get_defaults()
	);

	return $kelso_settings[ $setting ];
}


/**
 * SIDEBAR LAYOUTS
 * -----------------------------------------------------------------
 *
 * @return string The sidebar layout location.
 */
function kelso_get_layout() {

	// Get Customizer options.
	$kelso_settings = wp_parse_args(
		get_option( 'kelso_settings', array() ),
		kelso_get_defaults()
	);

	// If on Homepage (page.php).
	if ( is_front_page() ) {
		$layout = null;
		$layout = $kelso_settings['home_layout_setting'];
	}

	// If on PAGE but not the homepage (page.php).
	if ( ! is_front_page() && ! is_search() && 'page' === get_post_type() ) {
		$layout = null;
		$layout = $kelso_settings['page_layout_setting'];
	}

	// If on SINGLE (single.php) - Works for any post type, except attachments and pages.
	if ( is_single() ) {
		$layout = null;
		$layout = $kelso_settings['single_layout_setting'];
	}

	// If on SEARCH (search.php).
	if ( is_search() ) {
		$layout = null;
		$layout = $kelso_settings['search_layout_setting'];
	}

	// If on ARCHIVE (archive.php), HOME-blog (index.php), 404 (404.php), attachment etc...
	if ( is_home() && ! is_front_page() || is_archive() || is_tax() || is_404() ) {
		$layout = null;
		$layout = $kelso_settings['archive_layout_setting'];
	}

	// Return the layout.
	return apply_filters( 'kelso_sidebar_layout', $layout );

}


/**
 * SITE CONTAINMENT
 * -----------------------------------------------------------------
 * Adds custom class to section containers.
 */
function kelso_sitecontain_class() {

	$kelso_settings = wp_parse_args(
		get_option( 'kelso_settings', array() ),
		kelso_get_defaults()
	);

	$site_layout = $kelso_settings['global_width_setting'];

	if ( 'contained' === $site_layout ) {
		add_filter( 'body_class', function( $classes ) {
			return array_merge( $classes, array( 'contained' ) );
		} );
	} else {
		return;
	}
}


/**
 * SIDEBAR Body Class.
 * -----------------------------------------------------------------
 * Write the body class for the Layout, left, right or no sidebar.
 */
function kelso_sidebar_bodyclass() {

	$layout = kelso_get_layout();

	if ( 'layout-ls' === $layout ) :

		add_filter( 'body_class', function( $classes ) {
			return array_merge( $classes, array( 'sidebar-left' ) );
		} );

	elseif ( 'layout-rs' === $layout ) :

		add_filter( 'body_class', function( $classes ) {
			return array_merge( $classes, array( 'sidebar-right' ) );
		} );

	elseif ( 'layout-c' === $layout ) :

		add_filter( 'body_class', function( $classes ) {
			return array_merge( $classes, array( 'nosidebar-silo' ) );
		} );

	endif;
}

/**
 * SIDEBAR RIGHT.
 * If layout is right sidebar...
 */
function kelso_get_right_sidebar() {

	$layout = kelso_get_layout();

	if ( 'layout-rs' === $layout ) :
		if ( is_page() ) :
			get_sidebar( 'page' );
		else :
			get_sidebar();
		endif;
	endif;
}

/**
 * SIDEBAR LEFT.
 * If layout is left sidebar...
 */
function kelso_get_left_sidebar() {

	$layout = kelso_get_layout();

	if ( 'layout-ls' === $layout ) :
		if ( is_page() ) :
			get_sidebar( 'page' );
		else :
			get_sidebar();
		endif;
	endif;
}


/**
 * HEADER LAYOUT
 * -----------------------------------------------------------------
 * Adds custom class to section containers.
 */
function kelso_header_layout_class() {

	$kelso_settings = wp_parse_args(
		get_option( 'kelso_settings', array() ),
		kelso_get_defaults()
	);

	$header_layout = $kelso_settings['header_layout'];

	if ( 'headercentered' === $header_layout ) {
		add_filter( 'body_class', function( $classes ) {
			return array_merge( $classes, array( 'headercentered' ) );
		} );
	} else {
		return;
	}
}


/**
 * NAVIGATION SEARCH FORM.
 * -----------------------------------------------------------------
 * Add search to primary menu if set.
 */
function kelso_navigation_search() {

	// Get Customizer options.
	$kelso_settings = wp_parse_args(
		get_option( 'kelso_settings', array() ),
		kelso_get_defaults()
	);

	if ( ! $kelso_settings['nav_search'] ) {
		return;
	}

	get_search_form();
}
add_action( 'kelso_inside_navigation', 'kelso_navigation_search' );

/**
 * Add search icon to menu
 *
 * @param string   $nav The HTML list of menu items.
 * @param stdClass $args Object containing wp_nav_menu() arguments.
 * @return string The search icon.
 */
function kelso_menu_search_icon( $nav, $args ) {

	if ( ! has_nav_menu( 'primary' ) ) {
		return;
	}

	// Get Customizer options.
	$kelso_settings = wp_parse_args(
		get_option( 'kelso_settings', array() ),
		kelso_get_defaults()
	);

	if ( ! $kelso_settings['nav_search'] ) {
		return $nav;
	}

	// only for primary menu.
	if ( 'primary' === $args->theme_location ) {
		return $nav . '<li class="search-icon" title="' . esc_attr_x( 'Search', 'submit button', 'kelso' ) . '"><div class="theicon"><span class="screen-reader-text">' . _x( 'Search', 'submit button', 'kelso' ) . '</span></div></li>';
	}

	return $nav;
}
add_filter( 'wp_nav_menu_items', 'kelso_menu_search_icon', 10, 2 );


/**
 * HOMEPAGE HEADER HEIGHT.
 * -----------------------------------------------------------------
 * Check if full-height is selected, write a body class if it is..
 *
 * @return string The sidebar layout location.
 */
function kelso_home_header_height() {

	if ( ! is_front_page() ) {
		return;
	}

	// Get Customizer options.
	$kelso_settings = wp_parse_args(
		get_option( 'kelso_settings', array() ),
		kelso_get_defaults()
	);

	if ( ! $kelso_settings['home_header_height'] ) {
		return;
	}

	add_filter( 'body_class', function( $classes ) {
		return array_merge( $classes, array( 'fullheight' ) );
	} );
}


/**
 * TITLE PLACEMENT
 * -----------------------------------------------------------------
 * Adds custom class to section containers.
 */
function kelso_title_placement_class() {

	if ( is_front_page() ) {
		return;
	}

	$kelso_settings = wp_parse_args(
		get_option( 'kelso_settings', array() ),
		kelso_get_defaults()
	);

	$title_placement = $kelso_settings['content_title_placement'];

	if ( 'titlelifted' === $title_placement ) {
		add_filter( 'body_class', function( $classes ) {
			return array_merge( $classes, array( 'titlelifted' ) );
		} );
	} elseif ( 'contentlifted' === $title_placement ) {
		add_filter( 'body_class', function( $classes ) {
			return array_merge( $classes, array( 'contentlifted' ) );
		} );
	} else {
		return;
	}
}


/**
 * DO MASONRY
 * -----------------------------------------------------------------
 * Adds custom class to section containers.
 */
function kelso_masonry_class() {

	$kelso_settings = wp_parse_args(
		get_option( 'kelso_settings', array() ),
		kelso_get_defaults()
	);

	if ( ! is_archive() && ! is_home() || ! $kelso_settings['do_masonry'] ) {
		return;
	}

	add_filter( 'body_class', function( $classes ) {
		return array_merge( $classes, array( 'do-masonry' ) );
	} );
}


/**
 * BACK TO TOP
 * -----------------------------------------------------------------
 * Build the back to top button
 */
function kelso_back_to_top() {

	$kelso_settings = wp_parse_args(
		get_option( 'kelso_settings', array() ),
		kelso_get_defaults()
	);

	if ( ! $kelso_settings['back_to_top'] ) {
		return;
	}

	echo '<div class="backtotop"></div>';
}
