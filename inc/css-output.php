<?php
/**
 * Output all of our dynamic CSS.
 *
 * @package kelso
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'kelso_base_css' ) ) {
	/**
	 * Generate the CSS in the <head> section using the Theme Customizer.
	 *
	 * @since 0.1
	 */
	function kelso_base_css() {
		// Get our settings.
		$kelso_settings = wp_parse_args(
			get_option( 'kelso_settings', array() ),
			kelso_get_defaults()
		);
		$defaults = kelso_get_defaults();

		$bg_color = $kelso_settings['background_color'];
		$content_bg_color = $kelso_settings['content_background_color'];
		$text_color = $kelso_settings['text_color'];
		$link_color = $kelso_settings['link_color'];
		$link_color_hover = $kelso_settings['link_color_hover'];

		$default_bg_color = $defaults['background_color'];
		$default_content_bg_color = $defaults['content_background_color'];
		$default_text_color = $defaults['text_color'];
		$default_link_color = $defaults['link_color'];
		$default_link_color_hover = $defaults['link_color_hover'];

		$nav_link_color = $kelso_settings['nav_link_color'];
		$default_nav_link_color = $defaults['nav_link_color'];

		$header_bg_color = $kelso_settings['header_background_color'];
		$default_header_bg_color = $defaults['header_background_color'];

		$header_bg_color_left = $kelso_settings['header_bg_color_left'];
		$header_bg_color_right = $kelso_settings['header_bg_color_right'];
		$default_header_bg_color_left = $defaults['header_bg_color_left'];
		$default_header_bg_color_right = $defaults['header_bg_color_right'];

		$stickyheader_bg_color = $kelso_settings['stickyheader_background_color'];
		$stickyheader_link_color = $kelso_settings['stickyheader_link_color'];
		$default_stickyheader_bg_color = $defaults['stickyheader_background_color'];
		$default_stickyheader_link_color = $defaults['stickyheader_link_color'];

		$hero_text_primary_color = $kelso_settings['hero_text_primary_color'];
		$hero_text_secondary_color = $kelso_settings['hero_text_secondary_color'];
		$default_hero_text_primary_color = $defaults['hero_text_primary_color'];
		$default_hero_text_secondary_color = $defaults['hero_text_secondary_color'];

		$content_inner_bg_color = $kelso_settings['content_inner_background_color'];
		$default_content_inner_bg_color = $defaults['content_inner_background_color'];
		$content_title_color = $kelso_settings['content_title_color'];
		$default_content_title_color = $defaults['content_title_color'];

		$footerwidgets_bg_color = $kelso_settings['footerwidgets_background_color'];
		$footerwidgets_widget_title_color = $kelso_settings['footerwidgets_widget_title_color'];
		$footerwidgets_text_color = $kelso_settings['footerwidgets_text_color'];
		$footerwidgets_link_color = $kelso_settings['footerwidgets_link_color'];
		$footerwidgets_link_color_hover = $kelso_settings['footerwidgets_link_color_hover'];
		$default_footerwidgets_bg_color = $defaults['footerwidgets_background_color'];
		$default_footerwidgets_widget_title_color = $defaults['footerwidgets_widget_title_color'];
		$default_footerwidgets_text_color = $defaults['footerwidgets_text_color'];
		$default_footerwidgets_link_color = $defaults['footerwidgets_link_color'];
		$default_footerwidgets_link_color_hover = $defaults['footerwidgets_link_color_hover'];

		$footer_bg_color = $kelso_settings['footer_background_color'];
		$footer_text_color = $kelso_settings['footer_text_color'];
		$footer_link_color = $kelso_settings['footer_link_color'];
		$footer_link_color_hover = $kelso_settings['footer_link_color_hover'];
		$default_footer_bg_color = $defaults['footer_background_color'];
		$default_footer_text_color = $defaults['footer_text_color'];
		$default_footer_link_color = $defaults['footer_link_color'];
		$default_footer_link_color_hover = $defaults['footer_link_color_hover'];

		// Initiate our class.
		$css = new Kelso_CSS();

		/*
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
		 */
		$title_text_color = get_header_textcolor();

		if ( HEADER_TEXTCOLOR !== $title_text_color ) :
			$ht_color = ( '#' . $title_text_color );
			if ( ! display_header_text() ) :
				$css->set_selector( '.site-title,.site-description' );
				$css->add_property( 'position', 'absolute' );
				$css->add_property( 'clip', 'rect(1px, 1px, 1px, 1px)' );
			else :
				$css->set_selector( '.site-title,.site-title a,.site-title a:hover,.site-description' );
				$css->add_property( 'color', esc_attr( $ht_color ) );
			endif;
		endif;

		if ( $default_bg_color !== $bg_color ) :
			$css->set_selector( 'body' );
			$css->add_property( 'background-color', esc_attr( $kelso_settings['background_color'] ) );
		endif;

		if ( $default_content_bg_color !== $content_bg_color ) :
			$css->set_selector( '.content-wrap' );
			$css->add_property( 'background-color', esc_attr( $kelso_settings['content_background_color'] ) );
		endif;

		if ( $default_text_color !== $text_color ) :
			// Color.
			$css->set_selector(
				'body,button,input,select,textarea,h1 a,h2 a,h3 a,h4 a,h5 a,h6 a,.sidebar-widget ul a,.sidebar-widget .menu a,.comment-navigation .nav-previous a,.posts-navigation .nav-previous a,.post-navigation .nav-previous a,.comment-navigation .nav-next a,.posts-navigation .nav-next a,.post-navigation .nav-next a'
			);
			$css->add_property( 'color', esc_attr( $kelso_settings['text_color'] ) );
		endif;

		/*
		 * HIGHLIGHT COLORS -----------------------------
		 */
		if ( $default_link_color !== $link_color ) :
			// Link Color.
			$css->set_selector(
				'a,h1 a:hover,h2 a:hover,h3 a:hover,h4 a:hover,h5 a:hover,h6 a:hover,.sidebar-widget ul a:hover,.sidebar-widget menu a:hover,.comment-navigation .nav-previous a:hover,.posts-navigation .nav-previous a:hover,.post-navigation .nav-previous a:hover,.comment-navigation .nav-next a:hover,.posts-navigation .nav-next a:hover,.post-navigation .nav-next a:hover,.text-highlight'
			);
			$css->add_property( 'color', esc_attr( $kelso_settings['link_color'] ) );
			// Link Bg.
			$css->set_selector(
				'input[type="button"],input[type="reset"],input[type="submit"],.btn,button,.bg-highlight,.subscription-toggle'
			);
			$css->add_property( 'background-color', esc_attr( $kelso_settings['link_color'] ) );
			// Link Borders.
			$css->set_selector(
				'.bb-highlight,.sticky .entry-header'
			);
			$css->add_property( 'border-color', esc_attr( $kelso_settings['link_color'] ) );
		endif;
		if ( $default_link_color_hover !== $link_color_hover ) :
			// Secondary Color.
			$css->set_selector(
				'.site-content a:hover,.site-content a:focus,.site-content a:active,a.arrow:hover,a.arrow:focus,a.arrow:active,.text-secondary'
			);
			$css->add_property( 'color', esc_attr( $kelso_settings['link_color_hover'] ) );
			// Secondary Backgrounds.
			$css->set_selector(
				'.btn.secondary,button.secondary,.site-navigation li:not(.search-icon) a:before,.bg-secondary'
			);
			$css->add_property( 'background-color', esc_attr( $kelso_settings['link_color_hover'] ) );
			// Secondary Borders.
			$css->set_selector(
				'a.arrow:hover,a.arrow:focus,a.arrow:active,a.arrow:hover:after,a.arrow:focus:after,a.arrow:active:after,.site-navigation li.accent,.bb-secondary'
			);
			$css->add_property( 'border-color', esc_attr( $kelso_settings['link_color_hover'] ) );
		endif;

		/*
		 * Header --------------------------------
		 */
		if ( $default_header_bg_color !== $header_bg_color ) :
			$css->set_selector(
				'.header-wrap'
			);
			$css->add_property( 'background-color', esc_attr( $kelso_settings['header_background_color'] ) );
		endif;

		/*
		 * Navigation --------------------------------
		 */
		if ( $default_nav_link_color !== $nav_link_color ) :
			$css->set_selector(
				'.site-navigation a, button.dropdown-toggle'
			);
			$css->add_property( 'color', esc_attr( $kelso_settings['nav_link_color'] ) );
			// Backgrounds.
			$css->set_selector(
				'.responsive-menu-icon .menu-icon,.responsive-menu-icon .menu-icon::before,.responsive-menu-icon .menu-icon::after, .site-navigation li.search-icon .theicon:before'
			);
			$css->add_property( 'background-color', esc_attr( $kelso_settings['nav_link_color'] ) );
			// Borders.
			$css->set_selector(
				'.site-navigation li.search-icon .theicon'
			);
			$css->add_property( 'border-color', esc_attr( $kelso_settings['nav_link_color'] ) );

		endif;

		/*
		 * Sticky Navigation --------------------------------
		 */
		if ( $default_stickyheader_bg_color !== $stickyheader_bg_color ) :
			$css->set_selector(
				'.header-wrap.stuck, .contained .header-wrap.stuck .inner-wrap'
			);
			$css->add_property( 'background-color', esc_attr( $kelso_settings['stickyheader_background_color'] ) );
		endif;
		if ( $default_stickyheader_link_color !== $stickyheader_link_color ) :
			// Color.
			$css->set_selector(
				'.header-wrap.stuck .site-navigation ul:not(.sub-menu) a,.header-wrap.stuck button.dropdown-toggle'
			);
			$css->add_property( 'color', esc_attr( $kelso_settings['stickyheader_link_color'] ) );
			// Background.
			$css->set_selector(
				'.header-wrap.stuck .responsive-menu-icon .menu-icon,.header-wrap.stuck .responsive-menu-icon .menu-icon::before,.header-wrap.stuck .responsive-menu-icon .menu-icon::after,.header-wrap.stuck .site-navigation li.search-icon .theicon:before'
			);
			$css->add_property( 'background-color', esc_attr( $kelso_settings['stickyheader_link_color'] ) );
			// Borders.
			$css->set_selector(
				'.header-wrap.stuck .site-navigation li.search-icon .theicon'
			);
			$css->add_property( 'border-color', esc_attr( $kelso_settings['stickyheader_link_color'] ) );
		endif;

		/*
		 * Custom Header --------------------------------
		 */
		if ( $default_header_bg_color_left !== $header_bg_color_left || $default_header_bg_color_right !== $header_bg_color_right ) :
			$clr1 = $kelso_settings['header_bg_color_left'];
			$clr2 = $kelso_settings['header_bg_color_right'];
			$prop = sprintf( 'linear-gradient(90deg, %1$s 10%%, %2$s 100%%)', $clr1, $clr2 );
			$css->set_selector( '.custom-header' );
			$css->add_property( 'background', $prop );
		endif;

		if ( $default_hero_text_primary_color !== $hero_text_primary_color ) :
			$css->set_selector( '.hero-primary' );
			$css->add_property( 'color', esc_attr( $kelso_settings['hero_text_primary_color'] ) );
		endif;
		if ( $default_hero_text_secondary_color !== $hero_text_secondary_color ) :
			$css->set_selector( '.hero-secondary' );
			$css->add_property( 'color', esc_attr( $kelso_settings['hero_text_secondary_color'] ) );
		endif;

		/*
		 * Content Area --------------------------------
		 */
		if ( $default_content_inner_bg_color !== $content_inner_bg_color ) :
			$css->set_selector( '.site-main' );
			$css->add_property( 'background-color', esc_attr( $kelso_settings['content_inner_background_color'] ) );
		endif;
		if ( $default_content_title_color !== $content_title_color ) :
			$css->set_selector( 'body.page .entry-title,body.single .entry-title,body.blog .page-title,body.archive .page-title,body.search .page-title,body.error404 .page-title,.single .entry-meta a,.single .entry-meta .posted-on,.single .entry-meta .updated-on,.single .entry-meta .byline,.woocommerce-products-header,.product_title.entry-title,body.page .titlelifted .entry-title,body.single .titlelifted .entry-title,body.blog .titlelifted .page-title,body.archive .titlelifted .page-title,body.search .titlelifted .page-title,body.error404 .titlelifted .page-title,.single .titlelifted .entry-meta a,.single .titlelifted .entry-meta .posted-on,.single .titlelifted .entry-meta .updated-on,.single .titlelifted .entry-meta .byline,.titlelifted .woocommerce-products-header,.titlelifted .product_title.entry-title' );
			$css->add_property( 'color', esc_attr( $kelso_settings['content_title_color'] ) );
		endif;

		/*
		 * Footer Widgets --------------------------------
		 */
		if ( $default_footerwidgets_bg_color !== $footerwidgets_bg_color ) :
			$css->set_selector( '.footer-widgets' );
			$css->add_property( 'background-color', esc_attr( $kelso_settings['footerwidgets_background_color'] ) );
		endif;
		if ( $default_footerwidgets_widget_title_color !== $footerwidgets_widget_title_color ) :
			$css->set_selector( '.footer-widgets .widget-title' );
			$css->add_property( 'color', esc_attr( $kelso_settings['footerwidgets_widget_title_color'] ) );
		endif;
		if ( $default_footerwidgets_text_color !== $footerwidgets_text_color ) :
			$css->set_selector( '.footer-widgets' );
			$css->add_property( 'color', esc_attr( $kelso_settings['footerwidgets_text_color'] ) );
		endif;
		if ( $default_footerwidgets_link_color !== $footerwidgets_link_color ) :
			$css->set_selector( '.footer-widgets a:not(.btn)' );
			$css->add_property( 'color', esc_attr( $kelso_settings['footerwidgets_link_color'] ) );
		endif;
		if ( $default_footerwidgets_link_color_hover !== $footerwidgets_link_color_hover ) :
			$css->set_selector( '.footer-widgets a:not(.btn):hover' );
			$css->add_property( 'color', esc_attr( $kelso_settings['footerwidgets_link_color_hover'] ) );
		endif;

		/*
		 * Site Footer --------------------------------
		 */
		if ( $default_footer_bg_color !== $footer_bg_color ) :
			$css->set_selector( '.site-footer' );
			$css->add_property( 'background-color', esc_attr( $kelso_settings['footer_background_color'] ) );
		endif;
		if ( $default_footer_text_color !== $footer_text_color ) :
			$css->set_selector( '.site-info' );
			$css->add_property( 'color', esc_attr( $kelso_settings['footer_text_color'] ) );
		endif;
		if ( $default_footer_link_color !== $footer_link_color ) :
			$css->set_selector( '.site-info a' );
			$css->add_property( 'color', esc_attr( $kelso_settings['footer_link_color'] ) );
		endif;
		if ( $default_footer_link_color_hover !== $footer_link_color_hover ) :
			$css->set_selector( '.site-info a:hover' );
			$css->add_property( 'color', esc_attr( $kelso_settings['footer_link_color_hover'] ) );
		endif;

		// Allow us to hook CSS into our output.
		do_action( 'kelso_base_css', $css );

		return apply_filters( 'kelso_base_css_output', $css->css_output() );
	}
}


add_action( 'wp_enqueue_scripts', 'kelso_enqueue_dynamic_css', 50 );
/**
 * Enqueue our dynamic CSS.
 *
 * @since 2.0
 */
function kelso_enqueue_dynamic_css() {
	$handle = 'kelso-style';
	if ( ! get_option( 'kelso_dynamic_css_output', false ) || is_customize_preview() || apply_filters( 'kelso_dynamic_css_skip_cache', false ) ) {
		$css = kelso_base_css();
	} else {
		$css = get_option( 'kelso_dynamic_css_output' ) . '/* End WP Customizer CSS */';
	}

	wp_add_inline_style( $handle, $css );
}

add_action( 'customize_save_after', 'kelso_update_dynamic_css_cache' );
/**
 * Update our CSS cache when done saving Customizer options.
 *
 * @since 2.0
 */
function kelso_update_dynamic_css_cache() {
	if ( apply_filters( 'kelso_dynamic_css_skip_cache', false ) ) {
		return;
	}

	$css = kelso_base_css();
	update_option( 'kelso_dynamic_css_output', $css );
}
