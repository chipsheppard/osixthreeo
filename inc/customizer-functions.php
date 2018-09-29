<?php
/**
 * Kelso Customizer functions.
 *
 * @package kelso
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if ( ! function_exists( 'kelso_get_setting' ) ) {
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
}

/*
 * CONTAINMENT
 -----------------------------------------------------------------
 */
if ( ! function_exists( 'kelso_sitecontain_class' ) ) {
	/**
	 * Adds custom class to section containers.
	 */
	function kelso_sitecontain_class() {

		$kelso_settings = wp_parse_args(
			get_option( 'kelso_settings', array() ),
			kelso_get_defaults()
		);

		$site_layout = $kelso_settings['global_width_setting'];

		if ( 'contained' === $site_layout ) {
			$contain_class = ' contained';
		} else {
			return;
		}

		echo esc_html( $contain_class );
	}
}

/*
 * SIDEBAR LAYOUTS
 -----------------------------------------------------------------
 */
if ( ! function_exists( 'kelso_get_layout' ) ) {
	/**
	 * Get the SIDEBAR layout for the current page.
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
}

// SIDEBAR Body Class.
if ( ! function_exists( 'kelso_sidebar_bodyclass' ) ) {
	/**
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
}

// SIDEBAR RIGHT.
if ( ! function_exists( 'kelso_get_right_sidebar' ) ) {
	/**
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
}

// SIDEBAR LEFT.
if ( ! function_exists( 'kelso_get_left_sidebar' ) ) {
	/**
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
}


/*
 * NAVIGATION
 -----------------------------------------------------------------
 */
if ( ! function_exists( 'kelso_display_nav' ) ) {
	/**
	 * Get the menu
	 * write the markup if conditions are met.
	 */
	function kelso_display_nav() {

		if ( ! has_nav_menu( 'primary' ) ) {
			return;
		}
		?>

		<nav id="primary-navigation" class="site-navigation" role="navigation">
			<button class="responsive-menu-icon" aria-controls="mobile-navigation" aria-expanded="false"><div class="menu-icon-wrap"><div class="menu-icon"></div></div></button>

			<div class="menu-wrap"><span>
				<?php

				do_action( 'kelso_inside_navigation' );

				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id' => 'primary-menu',
					'container' => '',
				) );

				?>
			</span></div>

		</nav>
		<?php
	}
}

// The form.
if ( ! function_exists( 'kelso_navigation_search' ) ) {
	add_action( 'kelso_inside_navigation', 'kelso_navigation_search' );
	/**
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
}

// Search button.
if ( ! function_exists( 'kelso_menu_search_icon' ) ) {
	add_filter( 'wp_nav_menu_items', 'kelso_menu_search_icon', 10, 2 );
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
}


/*
 * BACK TO TOP
 -----------------------------------------------------------------
 */
if ( ! function_exists( 'kelso_back_to_top' ) ) {
	/**
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
}
