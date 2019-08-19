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

		$header_bg_color_left                  = $osixthreeo_settings['header_bg_color_left'];
		$header_bg_color_right                 = $osixthreeo_settings['header_bg_color_right'];
		$header_gradient_angle                 = $osixthreeo_settings['header_gradient_angle'];
		$header_left_stop                      = $osixthreeo_settings['header_left_stop'];
		$header_right_stop                     = $osixthreeo_settings['header_right_stop'];
		$default_header_bg_color_left          = $defaults['header_bg_color_left'];
		$default_header_bg_color_right         = $defaults['header_bg_color_right'];
		$default_header_gradient_angle         = $defaults['header_gradient_angle'];
		$default_header_left_stop              = $defaults['header_left_stop'];
		$default_header_right_stop             = $defaults['header_right_stop'];

		$hero_text_primary_color               = $osixthreeo_settings['hero_text_primary_color'];
		$hero_text_secondary_color             = $osixthreeo_settings['hero_text_secondary_color'];
		$default_hero_text_primary_color       = $defaults['hero_text_primary_color'];
		$default_hero_text_secondary_color     = $defaults['hero_text_secondary_color'];

		$home_header_height                    = $osixthreeo_settings['home_header_height'];
		$subpage_header_height                 = $osixthreeo_settings['subpage_header_height'];
		$home_mobile_header_height             = $osixthreeo_settings['home_mobile_header_height'];
		$subpage_mobile_header_height          = $osixthreeo_settings['subpage_mobile_header_height'];
		$default_home_header_height            = $defaults['home_header_height'];
		$default_subpage_header_height         = $defaults['subpage_header_height'];
		$default_home_mobile_header_height     = $defaults['home_mobile_header_height'];
		$default_subpage_mobile_header_height  = $defaults['subpage_mobile_header_height'];

		$header_bg_color                       = $osixthreeo_settings['header_background_color'];
		$header_padding                        = $osixthreeo_settings['header_padding'];
		$default_header_bg_color               = $defaults['header_background_color'];
		$default_header_padding                = $defaults['header_padding'];

		$nav_link_color                        = $osixthreeo_settings['nav_link_color'];
		$default_nav_link_color                = $defaults['nav_link_color'];

		$subnav_text_color                     = $osixthreeo_settings['subnav_text_color'];
		$subnav_bg_color                       = $osixthreeo_settings['subnav_bg_color'];
		$subnav_border_color                   = $osixthreeo_settings['subnav_border_color'];
		$subnav_hover_text_color               = $osixthreeo_settings['subnav_hover_text_color'];
		$subnav_hover_bg_color                 = $osixthreeo_settings['subnav_hover_bg_color'];
		$default_subnav_text_color             = $defaults['subnav_text_color'];
		$default_subnav_bg_color               = $defaults['subnav_bg_color'];
		$default_subnav_border_color           = $defaults['subnav_border_color'];
		$default_subnav_hover_text_color       = $defaults['subnav_hover_text_color'];
		$default_subnav_hover_bg_color         = $defaults['subnav_hover_bg_color'];

		$content_bgcolor                       = $osixthreeo_settings['content_bgcolor'];
		$text_color                            = $osixthreeo_settings['text_color'];
		$link_color                            = $osixthreeo_settings['link_color'];
		$link_color_hover                      = $osixthreeo_settings['link_color_hover'];
		$default_content_bgcolor               = $defaults['content_bgcolor'];
		$default_text_color                    = $defaults['text_color'];
		$default_link_color                    = $defaults['link_color'];
		$default_link_color_hover              = $defaults['link_color_hover'];

		$footer_bg_color                       = $osixthreeo_settings['footer_background_color'];
		$footer_text_color                     = $osixthreeo_settings['footer_text_color'];
		$footer_link_color                     = $osixthreeo_settings['footer_link_color'];
		$footer_link_color_hover               = $osixthreeo_settings['footer_link_color_hover'];
		$default_footer_bg_color               = $defaults['footer_background_color'];
		$default_footer_text_color             = $defaults['footer_text_color'];
		$default_footer_link_color             = $defaults['footer_link_color'];
		$default_footer_link_color_hover       = $defaults['footer_link_color_hover'];

		$hero_text_primary_font                = $osixthreeo_settings['hero_text_primary_font'];
		$hero_text_secondary_font              = $osixthreeo_settings['hero_text_secondary_font'];
		$default_hero_text_primary_font        = $defaults['hero_text_primary_font'];
		$default_hero_text_secondary_font      = $defaults['hero_text_secondary_font'];

		$base_font                             = $osixthreeo_settings['base_font'];
		$header_font                           = $osixthreeo_settings['header_font'];
		$highlite_font                         = $osixthreeo_settings['highlite_font'];
		$default_base_font                     = $defaults['base_font'];
		$default_header_font                   = $defaults['header_font'];
		$default_highlite_font                 = $defaults['highlite_font'];

		$sitetitle_font                        = $osixthreeo_settings['sitetitle_font'];
		$sitedescription_font                  = $osixthreeo_settings['sitedescription_font'];
		$menu_font                             = $osixthreeo_settings['menu_font'];
		$default_sitetitle_font                = $defaults['sitetitle_font'];
		$default_sitedescription_font          = $defaults['sitedescription_font'];
		$default_menu_font                     = $defaults['menu_font'];

		$header_font_weight                    = $osixthreeo_settings['header_font_weight'];
		$sitetitle_font_weight                 = $osixthreeo_settings['sitetitle_font_weight'];
		$sitedescription_font_weight           = $osixthreeo_settings['sitedescription_font_weight'];
		$menu_font_weight                      = $osixthreeo_settings['menu_font_weight'];
		$default_header_font_weight            = $defaults['header_font_weight'];
		$default_sitetitle_font_weight         = $defaults['sitetitle_font_weight'];
		$default_sitedescription_font_weight   = $defaults['sitedescription_font_weight'];
		$default_menu_font_weight              = $defaults['menu_font_weight'];

		$base_font_size                        = $osixthreeo_settings['base_font_size'];
		$sitetitle_font_size                   = $osixthreeo_settings['sitetitle_font_size'];
		$sitedescription_font_size             = $osixthreeo_settings['sitedescription_font_size'];
		$menu_font_size                        = $osixthreeo_settings['menu_font_size'];
		$hero_text_primary_font_size           = $osixthreeo_settings['hero_text_primary_font_size'];
		$hero_text_secondary_font_size         = $osixthreeo_settings['hero_text_secondary_font_size'];
		$default_base_font_size                = $defaults['base_font_size'];
		$default_sitetitle_font_size           = $defaults['sitetitle_font_size'];
		$default_sitedescription_font_size     = $defaults['sitedescription_font_size'];
		$default_menu_font_size                = $defaults['menu_font_size'];
		$default_hero_text_primary_font_size   = $defaults['hero_text_primary_font_size'];
		$default_hero_text_secondary_font_size = $defaults['hero_text_secondary_font_size'];

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
				'a,.site-content h2 a:hover,.site-content h3 a:hover,.site-content h4 a:hover,.site-content h5 a:hover,.site-content h6 a:hover,.sidebar-widget ul a:hover,.sidebar-widget menu a:hover,.comment-navigation .nav-previous a:hover,.posts-navigation .nav-previous a:hover,.post-navigation .nav-previous a:hover,.comment-navigation .nav-next a:hover,.posts-navigation .nav-next a:hover,.post-navigation .nav-next a:hover'
			);
			$css->add_property( 'color', esc_attr( $osixthreeo_settings['link_color'] ) );

			// Link Backgrounds.
			$css->set_selector(
				'input[type="button"],input[type="reset"],input[type="submit"],.btn,.woocommerce a.button,.woocommerce button.button,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button,.woocommerce #respond input#submit'
			);
			$css->add_property( 'background-color', esc_attr( $osixthreeo_settings['link_color'] ) );

			// Link Borders.
			$css->set_selector(
				'.sticky .entry-header,.blog .hentry.sticky,.archive .hentry.sticky'
			);
			$css->add_property( 'border-color', esc_attr( $osixthreeo_settings['link_color'] ) );
		endif;

		if ( $default_link_color_hover !== $link_color_hover ) :
			// Color.
			$css->set_selector(
				'.site-content a:not(.btn):hover,.site-content a:not(.btn):focus,.site-content a:not(.btn):active'
			);
			$css->add_property( 'color', esc_attr( $osixthreeo_settings['link_color_hover'] ) );

			// Backgrounds.
			$css->set_selector(
				'input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,.btn.secondary,.footer-widgets input[type="submit"],.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce #respond input#submit.alt,.woocommerce input.button.alt,.woocommerce input.button:hover,.woocommerce #respond input#submit:hover'
			);
			$css->add_property( 'background-color', esc_attr( $osixthreeo_settings['link_color_hover'] ) );
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

		/*
		 * Fonts --------------------------------
		 */
		if ( $default_base_font !== $base_font ) :
			$css->set_selector( 'body,button,input,select,textarea,blockquote,h1 div,h2 div,h3 div,h4 div,h5 div,h6 div,.search .page-title span' );
			if ( 'lato' === $base_font ) {
				$basefont = '"Lato", sans-serif';
			} elseif ( 'lora' === $base_font ) {
				$basefont = '"Lora", serif';
			} elseif ( 'merriweather' === $base_font ) {
				$basefont = '"Merriweather", serif';
			} elseif ( 'oswald' === $base_font ) {
				$basefont = '"Oswald", sans-serif';
			} elseif ( 'playfairdisplay' === $base_font ) {
				$basefont = '"Playfair Display", serif';
			} elseif ( 'raleway' === $base_font ) {
				$basefont = '"Raleway", sans-serif';
			} elseif ( 'roboto' === $base_font ) {
				$basefont = '"Roboto", sans-serif';
			} elseif ( 'robotoslab' === $base_font ) {
				$basefont = '"Roboto Slab", serif';
			} elseif ( 'playfairdisplay' === $base_font ) {
				$basefont = '"Playfair Display", serif';
			} elseif ( 'sourcesanspro' === $base_font ) {
				$basefont = '"Source Sans Pro", sans-serif';
			} elseif ( 'century' === $base_font ) {
				$basefont = 'Century Gothic, CenturyGothic, AppleGothic, sans-serif';
			} elseif ( 'verdana' === $base_font ) {
				$basefont = 'Verdana, Geneva, sans-serif';
			} elseif ( 'gillsans' === $base_font ) {
				$basefont = '"Gill Sans", "Gill Sans MT", Calibri, sans-serif';
			} elseif ( 'helvetica' === $base_font ) {
				$basefont = '"Helvetica Neue", Helvetica, Arial, sans-serif';
			} elseif ( 'impact' === $base_font ) {
				$basefont = 'Impact, Haettenschweiler , Charcoal, "Arial Black", sans serif';
			} elseif ( 'tahoma' === $base_font ) {
				$basefont = 'Tahoma, Arial, Helvetica, sans-serif';
			} elseif ( 'trebuchet' === $base_font ) {
				$basefont = '"Trebuchet MS", Tahoma, sans-serif';
			} elseif ( 'lucidagrande' === $base_font ) {
				$basefont = '"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif';
			} elseif ( 'georgia' === $base_font ) {
				$basefont = 'Georgia, "Times New Roman", Times, serif';
			} elseif ( 'times' === $base_font ) {
				$basefont = 'TimesNewRoman, "Times New Roman", Times, serif';
			} elseif ( 'bookantiqua' === $base_font ) {
				$basefont = '"Book Antiqua", Georgia, serif';
			} elseif ( 'lucidabright' === $base_font ) {
				$basefont = '"Lucida Bright", Georgia, serif';
			} elseif ( 'palatino' === $base_font ) {
				$basefont = 'Palatino, "Palatino Linotype", "Book Antiqua", Georgia, serif';
			} elseif ( 'courier' === $base_font ) {
				$basefont = '"Courier New", Courier, monospace';
			} elseif ( 'lucidatypewritter' === $base_font ) {
				$basefont = '"Lucida Sans Typewriter", "Lucida Console", monaco, monospace';
			} elseif ( 'copperplate' === $base_font ) {
				$basefont = 'Copperplate, "Copperplate Gothic Light", fantasy';
			} elseif ( 'papyrus' === $base_font ) {
				$basefont = 'Papyrus, fantasy';
			} elseif ( 'comicsans' === $base_font ) {
				$basefont = 'Comic Sans MS, cursive';
			}
			$css->add_property( 'font-family', $basefont );
		endif;

		if ( $default_header_font !== $header_font ) :
			$css->set_selector( 'h1:not(.site-title),h2,h3,h4,h5,h6' );
			if ( 'lato' === $header_font ) {
				$headerfont = '"Lato", sans-serif';
			} elseif ( 'lora' === $header_font ) {
				$headerfont = '"Lora", serif';
			} elseif ( 'merriweather' === $header_font ) {
				$headerfont = '"Merriweather", serif';
			} elseif ( 'oswald' === $header_font ) {
				$headerfont = '"Oswald", sans-serif';
			} elseif ( 'playfairdisplay' === $header_font ) {
				$headerfont = '"Playfair Display", serif';
			} elseif ( 'raleway' === $header_font ) {
				$headerfont = '"Raleway", sans-serif';
			} elseif ( 'roboto' === $header_font ) {
				$headerfont = '"Roboto", sans-serif';
			} elseif ( 'robotoslab' === $header_font ) {
				$headerfont = '"Roboto Slab", serif';
			} elseif ( 'playfairdisplay' === $header_font ) {
				$headerfont = '"Playfair Display", serif';
			} elseif ( 'sourcesanspro' === $header_font ) {
				$headerfont = '"Source Sans Pro", sans-serif';
			} elseif ( 'century' === $header_font ) {
				$headerfont = 'Century Gothic, CenturyGothic, AppleGothic, sans-serif';
			} elseif ( 'verdana' === $header_font ) {
				$headerfont = 'Verdana, Geneva, sans-serif';
			} elseif ( 'gillsans' === $header_font ) {
				$headerfont = '"Gill Sans", "Gill Sans MT", Calibri, sans-serif';
			} elseif ( 'helvetica' === $header_font ) {
				$headerfont = '"Helvetica Neue", Helvetica, Arial, sans-serif';
			} elseif ( 'impact' === $header_font ) {
				$headerfont = 'Impact, Haettenschweiler , Charcoal, "Arial Black", sans serif';
			} elseif ( 'tahoma' === $header_font ) {
				$headerfont = 'Tahoma, Arial, Helvetica, sans-serif';
			} elseif ( 'trebuchet' === $header_font ) {
				$headerfont = '"Trebuchet MS", Tahoma, sans-serif';
			} elseif ( 'lucidagrande' === $header_font ) {
				$headerfont = '"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif';
			} elseif ( 'georgia' === $header_font ) {
				$headerfont = 'Georgia, "Times New Roman", Times, serif';
			} elseif ( 'times' === $header_font ) {
				$headerfont = 'TimesNewRoman, "Times New Roman", Times, serif';
			} elseif ( 'bookantiqua' === $header_font ) {
				$headerfont = '"Book Antiqua", Georgia, serif';
			} elseif ( 'lucidabright' === $header_font ) {
				$headerfont = '"Lucida Bright", Georgia, serif';
			} elseif ( 'palatino' === $header_font ) {
				$headerfont = 'Palatino, "Palatino Linotype", "Book Antiqua", Georgia, serif';
			} elseif ( 'courier' === $header_font ) {
				$headerfont = '"Courier New", Courier, monospace';
			} elseif ( 'lucidatypewritter' === $header_font ) {
				$headerfont = '"Lucida Sans Typewriter", "Lucida Console", monaco, monospace';
			} elseif ( 'copperplate' === $header_font ) {
				$headerfont = 'Copperplate, "Copperplate Gothic Light", fantasy';
			} elseif ( 'papyrus' === $header_font ) {
				$headerfont = 'Papyrus, fantasy';
			} elseif ( 'comicsans' === $header_font ) {
				$headerfont = 'Comic Sans MS, cursive';
			}
			$css->add_property( 'font-family', $headerfont );
		endif;

		if ( $default_highlite_font !== $highlite_font ) :
			if ( 'lato' === $highlite_font ) {
				$highlitefont = '"Lato", sans-serif';
			} elseif ( 'lora' === $highlite_font ) {
				$highlitefont = '"Lora", serif';
			} elseif ( 'merriweather' === $highlite_font ) {
				$highlitefont = '"Merriweather", serif';
			} elseif ( 'oswald' === $highlite_font ) {
				$highlitefont = '"Oswald", sans-serif';
			} elseif ( 'playfairdisplay' === $highlite_font ) {
				$highlitefont = '"Playfair Display", serif';
			} elseif ( 'raleway' === $highlite_font ) {
				$highlitefont = '"Raleway", sans-serif';
			} elseif ( 'roboto' === $highlite_font ) {
				$highlitefont = '"Roboto", sans-serif';
			} elseif ( 'robotoslab' === $highlite_font ) {
				$highlitefont = '"Roboto Slab", serif';
			} elseif ( 'playfairdisplay' === $highlite_font ) {
				$highlitefont = '"Playfair Display", serif';
			} elseif ( 'sourcesanspro' === $highlite_font ) {
				$highlitefont = '"Source Sans Pro", sans-serif';
			} elseif ( 'century' === $highlite_font ) {
				$highlitefont = 'Century Gothic, CenturyGothic, AppleGothic, sans-serif';
			} elseif ( 'verdana' === $highlite_font ) {
				$highlitefont = 'Verdana, Geneva, sans-serif';
			} elseif ( 'gillsans' === $highlite_font ) {
				$highlitefont = '"Gill Sans", "Gill Sans MT", Calibri, sans-serif';
			} elseif ( 'helvetica' === $highlite_font ) {
				$highlitefont = '"Helvetica Neue", Helvetica, Arial, sans-serif';
			} elseif ( 'impact' === $highlite_font ) {
				$highlitefont = 'Impact, Haettenschweiler , Charcoal, "Arial Black", sans serif';
			} elseif ( 'tahoma' === $highlite_font ) {
				$highlitefont = 'Tahoma, Arial, Helvetica, sans-serif';
			} elseif ( 'trebuchet' === $highlite_font ) {
				$highlitefont = '"Trebuchet MS", Tahoma, sans-serif';
			} elseif ( 'lucidagrande' === $highlite_font ) {
				$highlitefont = '"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif';
			} elseif ( 'georgia' === $highlite_font ) {
				$highlitefont = 'Georgia, "Times New Roman", Times, serif';
			} elseif ( 'times' === $highlite_font ) {
				$highlitefont = 'TimesNewRoman, "Times New Roman", Times, serif';
			} elseif ( 'bookantiqua' === $highlite_font ) {
				$highlitefont = '"Book Antiqua", Georgia, serif';
			} elseif ( 'lucidabright' === $highlite_font ) {
				$highlitefont = '"Lucida Bright", Georgia, serif';
			} elseif ( 'palatino' === $highlite_font ) {
				$highlitefont = 'Palatino, "Palatino Linotype", "Book Antiqua", Georgia, serif';
			} elseif ( 'courier' === $highlite_font ) {
				$highlitefont = '"Courier New", Courier, monospace';
			} elseif ( 'lucidatypewritter' === $highlite_font ) {
				$highlitefont = '"Lucida Sans Typewriter", "Lucida Console", monaco, monospace';
			} elseif ( 'copperplate' === $highlite_font ) {
				$highlitefont = 'Copperplate, "Copperplate Gothic Light", fantasy';
			} elseif ( 'papyrus' === $highlite_font ) {
				$highlitefont = 'Papyrus, fantasy';
			} elseif ( 'comicsans' === $highlite_font ) {
				$highlitefont = 'Comic Sans MS, cursive';
			}
		endif;

		if ( $default_sitetitle_font !== $sitetitle_font ) :
			$css->set_selector( '.site-title' );
			if ( 'header' === $sitetitle_font && $default_header_font !== $header_font ) {
				$css->add_property( 'font-family', $headerfont );
			} elseif ( 'highlite' === $sitetitle_font && $default_highlite_font !== $highlite_font ) {
				$css->add_property( 'font-family', $highlitefont );
			}
		endif;

		if ( $default_sitedescription_font !== $sitedescription_font ) :
			$css->set_selector( '.site-description' );
			if ( 'header' === $sitedescription_font && $default_header_font !== $header_font ) {
				$css->add_property( 'font-family', $headerfont );
			} elseif ( 'highlite' === $sitedescription_font && $default_highlite_font !== $highlite_font ) {
				$css->add_property( 'font-family', $highlitefont );
			}
		endif;

		if ( $default_menu_font !== $menu_font ) :
			$css->set_selector( '.site-navigation' );
			if ( 'header' === $menu_font && $default_header_font !== $header_font ) {
				$css->add_property( 'font-family', $headerfont );
			} elseif ( 'highlite' === $menu_font && $default_highlite_font !== $highlite_font ) {
				$css->add_property( 'font-family', $highlitefont );
			}
		endif;

		if ( $default_header_font_weight !== $header_font_weight ) :
			$css->set_selector( 'h1:not(.site-title), h2, h3, h4, h5, h6' );
			$css->add_property( 'font-weight', 'bold' );
		endif;

		if ( $default_sitetitle_font_weight !== $sitetitle_font_weight ) :
			$css->set_selector( '.site-title' );
			$css->add_property( 'font-weight', 'bold' );
		endif;

		if ( $default_sitedescription_font_weight !== $sitedescription_font_weight ) :
			$css->set_selector( '.site-description' );
			$css->add_property( 'font-weight', 'bold' );
		endif;

		if ( $default_menu_font_weight !== $menu_font_weight ) :
			$css->set_selector( '.site-navigation a' );
			$css->add_property( 'font-weight', 'bold' );
		endif;

		if ( $default_hero_text_primary_font !== $hero_text_primary_font ) :
				$css->set_selector( '.hero-primary' );
			if ( 'header' === $hero_text_primary_font && $default_header_font !== $header_font ) {
				$css->add_property( 'font-family', $headerfont );
			} elseif ( 'highlite' === $hero_text_primary_font && $default_highlite_font !== $highlite_font ) {
				$css->add_property( 'font-family', $highlitefont );
			}
		endif;
		if ( $default_hero_text_secondary_font !== $hero_text_secondary_font ) :
				$css->set_selector( '.hero-secondary' );
			if ( 'header' === $hero_text_secondary_font && $default_header_font !== $header_font ) {
				$css->add_property( 'font-family', $headerfont );
			} elseif ( 'highlite' === $hero_text_secondary_font && $default_highlite_font !== $highlite_font ) {
				$css->add_property( 'font-family', $highlitefont );
			}
		endif;

		if ( absint( $default_base_font_size ) !== absint( $base_font_size ) ) :
			$css->set_selector( '.content-inner-wrap' );
			$css->add_property( 'font-size', esc_attr( $osixthreeo_settings['base_font_size'] . 'px' ) );
		endif;
		if ( absint( $default_sitetitle_font_size ) !== absint( $sitetitle_font_size ) ) :
			$css->set_selector( '.site-title' );
			$css->add_property( 'font-size', esc_attr( $osixthreeo_settings['sitetitle_font_size'] . 'px' ) );
		endif;
		if ( absint( $default_sitedescription_font_size ) !== absint( $sitedescription_font_size ) ) :
			$css->set_selector( '.site-description' );
			$css->add_property( 'font-size', esc_attr( $osixthreeo_settings['sitedescription_font_size'] . 'px' ) );
		endif;
		if ( absint( $default_menu_font_size ) !== absint( $menu_font_size ) ) :
			$css->set_selector( '#primary-navigation' );
			$css->add_property( 'font-size', esc_attr( $osixthreeo_settings['menu_font_size'] . 'px' ) );
		endif;
		if ( absint( $default_hero_text_primary_font_size ) !== absint( $hero_text_primary_font_size ) ) :
			$css->set_selector( '.hero-primary' );
			$css->add_property( 'font-size', esc_attr( $osixthreeo_settings['hero_text_primary_font_size'] . 'px' ) );
		endif;
		if ( absint( $default_hero_text_secondary_font_size ) !== absint( $hero_text_secondary_font_size ) ) :
			$css->set_selector( '.hero-secondary' );
			$css->add_property( 'font-size', esc_attr( $osixthreeo_settings['hero_text_secondary_font_size'] . 'px' ) );
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
