<?php
/**
 * Output all of our dynamic CSS.
 *
 * @package  osixthreeo
 * @subpackage osixthreeo/inc/customizer
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'osixthreeo_base_css' ) ) {
	/**
	 * Generate the CSS in the <head> section using the Theme Customizer.
	 *
	 * @since 0.1
	 */
	function osixthreeo_base_css() {
		// Get our settings.
		$osixthreeo_settings = wp_parse_args(
			get_option( 'osixthreeo_settings', array() ),
			osixthreeo_get_defaults()
		);
		$defaults            = osixthreeo_get_defaults();

		$header_bg_color_left                 = $osixthreeo_settings['header_bg_color_left'];
		$header_bg_color_right                = $osixthreeo_settings['header_bg_color_right'];
		$header_gradient_angle                = $osixthreeo_settings['header_gradient_angle'];
		$header_left_stop                     = $osixthreeo_settings['header_left_stop'];
		$header_right_stop                    = $osixthreeo_settings['header_right_stop'];
		$default_header_bg_color_left         = $defaults['header_bg_color_left'];
		$default_header_bg_color_right        = $defaults['header_bg_color_right'];
		$default_header_gradient_angle        = $defaults['header_gradient_angle'];
		$default_header_left_stop             = $defaults['header_left_stop'];
		$default_header_right_stop            = $defaults['header_right_stop'];
		$hero_text_primary_color              = $osixthreeo_settings['hero_text_primary_color'];
		$hero_text_secondary_color            = $osixthreeo_settings['hero_text_secondary_color'];
		$default_hero_text_primary_color      = $defaults['hero_text_primary_color'];
		$default_hero_text_secondary_color    = $defaults['hero_text_secondary_color'];
		$home_header_height                   = $osixthreeo_settings['home_header_height'];
		$subpage_header_height                = $osixthreeo_settings['subpage_header_height'];
		$default_home_header_height           = $defaults['home_header_height'];
		$default_subpage_header_height        = $defaults['subpage_header_height'];
		$home_mobile_header_height            = $osixthreeo_settings['home_mobile_header_height'];
		$subpage_mobile_header_height         = $osixthreeo_settings['subpage_mobile_header_height'];
		$default_home_mobile_header_height    = $defaults['home_mobile_header_height'];
		$default_subpage_mobile_header_height = $defaults['subpage_mobile_header_height'];
		$header_padding                       = $osixthreeo_settings['header_padding'];
		$default_header_padding               = $defaults['header_padding'];
		$header_bg_color                      = $osixthreeo_settings['header_background_color'];
		$default_header_bg_color              = $defaults['header_background_color'];
		$nav_link_color                       = $osixthreeo_settings['nav_link_color'];
		$default_nav_link_color               = $defaults['nav_link_color'];
		$subnav_text_color                    = $osixthreeo_settings['subnav_text_color'];
		$default_subnav_text_color            = $defaults['subnav_text_color'];
		$subnav_bg_color                      = $osixthreeo_settings['subnav_bg_color'];
		$default_subnav_bg_color              = $defaults['subnav_bg_color'];
		$subnav_border_color                  = $osixthreeo_settings['subnav_border_color'];
		$default_subnav_border_color          = $defaults['subnav_border_color'];
		$subnav_hover_text_color              = $osixthreeo_settings['subnav_hover_text_color'];
		$default_subnav_hover_text_color      = $defaults['subnav_hover_text_color'];
		$subnav_hover_bg_color                = $osixthreeo_settings['subnav_hover_bg_color'];
		$default_subnav_hover_bg_color        = $defaults['subnav_hover_bg_color'];
		$content_bgcolor                      = $osixthreeo_settings['content_bgcolor'];
		$default_content_bgcolor              = $defaults['content_bgcolor'];
		$text_color                           = $osixthreeo_settings['text_color'];
		$link_color                           = $osixthreeo_settings['link_color'];
		$link_color_hover                     = $osixthreeo_settings['link_color_hover'];
		$default_text_color                   = $defaults['text_color'];
		$default_link_color                   = $defaults['link_color'];
		$default_link_color_hover             = $defaults['link_color_hover'];
		$footer_bg_color                      = $osixthreeo_settings['footer_background_color'];
		$footer_text_color                    = $osixthreeo_settings['footer_text_color'];
		$footer_link_color                    = $osixthreeo_settings['footer_link_color'];
		$footer_link_color_hover              = $osixthreeo_settings['footer_link_color_hover'];
		$default_footer_bg_color              = $defaults['footer_background_color'];
		$default_footer_text_color            = $defaults['footer_text_color'];
		$default_footer_link_color            = $defaults['footer_link_color'];
		$default_footer_link_color_hover      = $defaults['footer_link_color_hover'];

		// Initiate our class.
		$css = new Customizer_CSS();

		/*
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
		 */
		$title_text_color = get_header_textcolor();

		if ( get_theme_support( 'custom-header', 'default-text-color' ) !== $title_text_color ) :
			$ht_color = ( '#' . $title_text_color );
			if ( ! display_header_text() ) :
				$css->set_selector( '.site-title,.site-description' );
				$css->add_property( 'position', 'absolute' );
				$css->add_property( 'clip', 'rect(1px, 1px, 1px, 1px)' );
			else :
				$css->set_selector( '.site-title,.site-title a,.site-description' );
				$css->add_property( 'color', esc_attr( $ht_color ) );
			endif;
		endif;

		/*
		 * Custom Header --------------------------------
		 */
		if ( $default_header_bg_color_left !== $header_bg_color_left ||
		$default_header_bg_color_right !== $header_bg_color_right ||
		absint( $default_header_gradient_angle ) !== absint( $header_gradient_angle ) ||
		absint( $default_header_left_stop ) !== absint( $header_left_stop ) ||
		absint( $default_header_right_stop ) !== absint( $header_right_stop ) ) :
			$clr1      = $osixthreeo_settings['header_bg_color_left'];
			$clr2      = $osixthreeo_settings['header_bg_color_right'];
			$angle     = absint( $osixthreeo_settings['header_gradient_angle'] );
			$stopleft  = absint( $osixthreeo_settings['header_left_stop'] );
			$stopright = absint( $osixthreeo_settings['header_right_stop'] );
			$prop      = sprintf( 'linear-gradient(%1$sdeg, %2$s %3$s%%, %4$s %5$s%%)', $angle, $clr1, $stopleft, $clr2, $stopright );
			$css->set_selector( '.custom-header' );
			$css->add_property( 'background', $prop );
		endif;

		if ( $default_hero_text_primary_color !== $hero_text_primary_color ) :
			$css->set_selector( '.hero-primary' );
			$css->add_property( 'color', esc_attr( $osixthreeo_settings['hero_text_primary_color'] ) );
		endif;
		if ( $default_hero_text_secondary_color !== $hero_text_secondary_color ) :
			$css->set_selector( '.hero-secondary' );
			$css->add_property( 'color', esc_attr( $osixthreeo_settings['hero_text_secondary_color'] ) );
		endif;

		if ( absint( $default_subpage_header_height ) !== absint( $subpage_header_height ) ) :
			$css->set_selector( '.site-header' );
			$css->add_property( 'min-height', esc_attr( $osixthreeo_settings['subpage_header_height'] . 'px' ) );
		endif;
		if ( absint( $default_home_header_height ) !== absint( $home_header_height ) ) :
			$css->set_selector( '.home .site-header' );
			$css->add_property( 'min-height', esc_attr( $osixthreeo_settings['home_header_height'] . 'px' ) );
		endif;
		if ( absint( $default_subpage_mobile_header_height ) !== absint( $subpage_mobile_header_height ) ) :
			$css->start_media_query( apply_filters( 'osixthreeo_mobile_media_query', '(max-width:768px)' ) );
				$css->set_selector( '.site-header' );
				$css->add_property( 'min-height', esc_attr( $osixthreeo_settings['subpage_mobile_header_height'] . 'px' ) );
			$css->stop_media_query();
		endif;
		if ( absint( $default_home_mobile_header_height ) !== absint( $home_mobile_header_height ) ) :
			$css->start_media_query( apply_filters( 'osixthreeo_mobile_media_query', '(max-width:768px)' ) );
				$css->set_selector( '.home .site-header' );
				$css->add_property( 'min-height', esc_attr( $osixthreeo_settings['home_mobile_header_height'] . 'px' ) );
			$css->stop_media_query();
		endif;

		/*
		 * Header Background Color --------------------------------
		 */
		if ( $default_header_bg_color !== $header_bg_color ) :
			$css->set_selector( '.header-wrap' );
			$css->add_property( 'background-color', esc_attr( $osixthreeo_settings['header_background_color'] ) );
		endif;

		/*
		 * Header Top/Bottom Padding --------------------------------
		 */
		if ( absint( $default_header_padding ) !== absint( $header_padding ) ) :
			$css->set_selector( '.header-wrap .inner-wrap' );
			$css->add_property( 'padding-top', esc_attr( $osixthreeo_settings['header_padding'] . 'px' ) );
			$css->add_property( 'padding-bottom', esc_attr( $osixthreeo_settings['header_padding'] . 'px' ) );
			$css->set_selector( 'responsive-menu-icon' );
			$css->add_property( 'margin-top', esc_attr( $osixthreeo_settings['header_padding'] . 'px' ) );
		endif;

		/*
		 * Navigation Link Color --------------------------------
		 */
		if ( $default_nav_link_color !== $nav_link_color ) :
			// Color.
			$css->set_selector( '.site-navigation a, button.dropdown-toggle' );
			$css->add_property( 'color', esc_attr( $osixthreeo_settings['nav_link_color'] ) );
			// Background.
			$css->set_selector( '.responsive-menu-icon .menu-icon,.responsive-menu-icon .menu-icon::before,.responsive-menu-icon .menu-icon::after, .site-navigation li.search-icon .theicon:before' );
			$css->add_property( 'background-color', esc_attr( $osixthreeo_settings['nav_link_color'] ) );
			// Borders.
			$css->set_selector( '.site-navigation li.search-icon .theicon,.site-navigation li.search-icon:hover,.site-navigation .sub-menu,.topbar-widget.widget_nav_menu .sub-menu' );
			$css->add_property( 'border-color', esc_attr( $osixthreeo_settings['nav_link_color'] ) );

		endif;

		/*
		 * SubNav/Mobile Colors --------------------------------
		 */

		// Text Color.
		if ( $default_subnav_text_color !== $subnav_text_color ) :
			$css->set_selector( '.site-navigation .sub-menu a,.sub-menu button.dropdown-toggle' );
			$css->add_property( 'color', esc_attr( $osixthreeo_settings['subnav_text_color'] ) );
			$css->start_media_query( apply_filters( 'osixthreeo_mobile_media_query', '(max-width:768px)' ) );
				$css->set_selector( '.site-navigation a, button.dropdown-toggle' );
				$css->add_property( 'color', esc_attr( $osixthreeo_settings['subnav_text_color'] ) . '!important' );
			$css->stop_media_query();
		endif;

		 // BG Color.
		if ( $default_subnav_bg_color !== $subnav_bg_color ) :
			$css->set_selector( '.site-navigation .sub-menu a' );
			$css->add_property( 'background', esc_attr( $osixthreeo_settings['subnav_bg_color'] ) );
			$css->start_media_query( apply_filters( 'osixthreeo_mobile_media_query', '(max-width:768px)' ) );
				$css->set_selector( '.site-navigation a' );
				$css->add_property( 'background-color', esc_attr( $osixthreeo_settings['subnav_bg_color'] ) );
			$css->stop_media_query();
		endif;

		 // Border Color.
		if ( $default_subnav_border_color !== $subnav_border_color ) :
			$css->set_selector(
				'.site-navigation .sub-menu li,.site-navigation .sub-menu li:first-of-type'
			);
			$css->add_property( 'border-color', esc_attr( $osixthreeo_settings['subnav_border_color'] ) );
			$css->start_media_query( apply_filters( 'osixthreeo_mobile_media_query', '(max-width:768px)' ) );
				$css->set_selector( '.site-navigation li' );
				$css->add_property( 'border-color', esc_attr( $osixthreeo_settings['subnav_border_color'] ) . '!important' );
			$css->stop_media_query();
		endif;

		 // Hover Text Color.
		if ( $default_subnav_hover_text_color !== $subnav_hover_text_color ) :
			$css->set_selector(
				'.site-navigation .sub-menu a:hover,.site-navigation .sub-menu .current_page_item > a,.site-navigation .sub-menu .current-menu-item > a'
			);
			$css->add_property( 'color', esc_attr( $osixthreeo_settings['subnav_hover_text_color'] ) );
			$css->start_media_query( apply_filters( 'osixthreeo_mobile_media_query', '(max-width:768px)' ) );
				$css->set_selector( '.site-navigation a:hover' );
				$css->add_property( 'color', esc_attr( $osixthreeo_settings['subnav_hover_text_color'] ) . '!important' );
			$css->stop_media_query();
		endif;

		 // Hover BG Color.
		if ( $default_subnav_hover_bg_color !== $subnav_hover_bg_color ) :
			$css->set_selector(
				'.site-navigation .sub-menu a:hover,.site-navigation .sub-menu .current_page_item > a,.site-navigation .sub-menu .current-menu-item > a'
			);
			$css->add_property( 'background', esc_attr( $osixthreeo_settings['subnav_hover_bg_color'] ) );
			$css->start_media_query( apply_filters( 'osixthreeo_mobile_media_query', '(max-width:768px)' ) );
				$css->set_selector( '.site-navigation a:hover,.site-navigation .current_page_item > a,.site-navigation .current-menu-item > a' );
				$css->add_property( 'background-color', esc_attr( $osixthreeo_settings['subnav_hover_bg_color'] ) );
			$css->stop_media_query();
		endif;

		/*
		 * Content Area --------------------------------
		 */
		if ( $default_content_bgcolor !== $content_bgcolor ) :
			$css->set_selector( '.site-content' );
			$css->add_property( 'background-color', esc_attr( $osixthreeo_settings['content_bgcolor'] ) );
		endif;

		if ( $default_text_color !== $text_color ) :
			// Base Color.
			$css->set_selector(
				'body,button,input,select,textarea,h1 a,h2 a,h3 a,h4 a,h5 a,h6 a,.sidebar-widget ul a,.sidebar-widget .menu a,.comment-navigation .nav-previous a,.posts-navigation .nav-previous a,.post-navigation .nav-previous a,.comment-navigation .nav-next a,.posts-navigation .nav-next a,.post-navigation .nav-next a'
			);
			$css->add_property( 'color', esc_attr( $osixthreeo_settings['text_color'] ) );
		endif;

		if ( $default_link_color !== $link_color ) :
			// Link Color.
			$css->set_selector(
				'a,.site-content h2 a:hover,.site-content h3 a:hover,.site-content h4 a:hover,.site-content h5 a:hover,.site-content h6 a:hover,.sidebar-widget ul a:hover,.sidebar-widget menu a:hover,.comment-navigation .nav-previous a:hover,.posts-navigation .nav-previous a:hover,.post-navigation .nav-previous a:hover,.comment-navigation .nav-next a:hover,.posts-navigation .nav-next a:hover,.post-navigation .nav-next a:hover,.text-highlight'
			);
			$css->add_property( 'color', esc_attr( $osixthreeo_settings['link_color'] ) );

			// Link Backgrounds.
			$css->set_selector(
				'input[type="button"],input[type="reset"],input[type="submit"],.btn,.bg-highlight,.woocommerce a.button,.woocommerce button.button,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button,.woocommerce #respond input#submit'
			);
			$css->add_property( 'background-color', esc_attr( $osixthreeo_settings['link_color'] ) );

			// Link Borders.
			$css->set_selector(
				'.bb-highlight,.sticky .entry-header,.blog .hentry.sticky,.archive .hentry.sticky'
			);
			$css->add_property( 'border-color', esc_attr( $osixthreeo_settings['link_color'] ) );
		endif;
		if ( $default_link_color_hover !== $link_color_hover ) :
			// Hover Color.
			$css->set_selector(
				'.site-content a:not(.btn):hover,.site-content a:not(.btn):focus,.site-content a:not(.btn):active,a.arrow:hover,a.arrow:focus,a.arrow:active,.text-secondary'
			);
			$css->add_property( 'color', esc_attr( $osixthreeo_settings['link_color_hover'] ) );

			// Hover Backgrounds.
			$css->set_selector(
				'input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,.btn.secondary,.site-navigation li:not(.search-icon) a:before,.bg-secondary,.footer-widgets input[type="submit"],.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce #respond input#submit.alt,.woocommerce input.button.alt,.woocommerce input.button:hover,.woocommerce #respond input#submit:hover'
			);
			$css->add_property( 'background-color', esc_attr( $osixthreeo_settings['link_color_hover'] ) );

			// Hover Borders.
			$css->set_selector(
				'a.arrow:hover,a.arrow:focus,a.arrow:active,a.arrow:hover:after,a.arrow:focus:after,a.arrow:active:after,.site-navigation li.accent,.bb-secondary,.footer-widgets input[type="search"]:focus'
			);
			$css->add_property( 'border-color', esc_attr( $osixthreeo_settings['link_color_hover'] ) );
		endif;

		/*
		 * Site Footer --------------------------------
		 */
		if ( $default_footer_bg_color !== $footer_bg_color ) :
			$css->set_selector( '.site-footer' );
			$css->add_property( 'background-color', esc_attr( $osixthreeo_settings['footer_background_color'] ) );
		endif;
		if ( $default_footer_text_color !== $footer_text_color ) :
			$css->set_selector( '.site-info' );
			$css->add_property( 'color', esc_attr( $osixthreeo_settings['footer_text_color'] ) );
		endif;
		if ( $default_footer_link_color !== $footer_link_color ) :
			$css->set_selector( '.site-info a' );
			$css->add_property( 'color', esc_attr( $osixthreeo_settings['footer_link_color'] ) );
		endif;
		if ( $default_footer_link_color_hover !== $footer_link_color_hover ) :
			$css->set_selector( '.site-info a:hover' );
			$css->add_property( 'color', esc_attr( $osixthreeo_settings['footer_link_color_hover'] ) );
		endif;

		// Allow us to hook CSS into our output - where we would hook our "Pro" features?
		do_action( 'osixthreeo_base_css', $css );

		return apply_filters( 'osixthreeo_base_css_output', $css->css_output() );
	}
}


/**
 * Enqueue our customizer CSS.
 *
 * @since 1.0.0
 */
function osixthreeo_enqueue_customizer_css() {
	$handle = 'osixthreeo-style';
	// If there are no settings set Or if we're in the customizer.
	if ( ! get_option( 'osixthreeo_customizer_css_output', true ) || is_customize_preview() ) {
		$css = osixthreeo_base_css();
	} else {
		$css = get_option( 'osixthreeo_customizer_css_output' ) . '/* OsixthreeO customizer CSS */';
	}
	wp_add_inline_style( $handle, $css );
}
add_action( 'wp_enqueue_scripts', 'osixthreeo_enqueue_customizer_css', 50 );

/**
 * Save our generated CSS as a WP Option which gets cached.
 *
 * @since 1.0.0
 */
function osixthreeo_update_customizer_css_cache() {
	$css = osixthreeo_base_css();
	update_option( 'osixthreeo_customizer_css_output', $css );
}
add_action( 'customize_save_after', 'osixthreeo_update_customizer_css_cache' );
