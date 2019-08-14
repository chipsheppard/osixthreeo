/**
 * Customizer JS
 *
 * @package  osixthreeo
 * @subpackage osixthreeo/assets/js
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

/*
* Live Update
*/
function osixthreeo_colors_live_update( id, selector, property, default_value ) {
	default_value = typeof default_value !== 'undefined' ? default_value : 'initial';

	wp.customize( 'osixthreeo_settings[' + id + ']', function( value ) {
		value.bind( function( newval ) {
			newval = ( '' !== newval ) ? newval : default_value;

			if ( jQuery( 'style#' + id ).length ) {
				jQuery( 'style#' + id ).html( selector + '{' + property + ':' + newval + ';}' );
			} else {
				jQuery( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + newval + '}</style>' );
				setTimeout(function() {
					jQuery( 'style#' + id ).not( ':last' ).remove();
				}, 1000);
			}
		} );
	} );
}


/*
* Live Update elements
*/
( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	osixthreeo_colors_live_update(
		'hero_text_primary_color',
		'.hero-primary',
		'color',
		'#ffffff'
	);
	osixthreeo_colors_live_update(
		'hero_text_secondary_color',
		'.hero-secondary',
		'color',
		'#ffffff'
	);

	// Global Site Width.
	wp.customize( 'osixthreeo_settings[containment_setting]', function( value ) {
		value.bind( function( newval ) {
			if ( 'full' === newval ) {
				$( 'body' ).removeClass( 'contained' );
			}
			if ( 'contained' === newval ) {
				$( 'body' ).addClass( 'contained' );
			}
		} );
	} );

	// Header Layout.
	wp.customize( 'osixthreeo_settings[header_layout]', function( value ) {
		value.bind( function( newval ) {
			if ( 'headernormal' === newval ) {
				$( 'body' ).removeClass( 'headercentered' );
			}
			if ( 'headercentered' === newval ) {
				$( 'body' ).addClass( 'headercentered' );
			}
		} );
	} );

	// Header Top/Bottom Padding.
	wp.customize(
		'osixthreeo_settings[header_padding]', function( value ) {
			value.bind(
				function( newval ) {
					$( '.header-wrap .inner-wrap' ).css( 'padding-top', newval + 'px' );
					$( '.header-wrap .inner-wrap' ).css( 'padding-bottom', newval + 'px' );
				}
			);
		}
	);

	// Home Header FULL HEIGHT.
	wp.customize( 'osixthreeo_settings[home_header_fullheight]', function( value ) {
		value.bind( function( newval ) {
			if ( 'full' === newval ) {
				$( 'body' ).addClass( 'fullheight' );
			}
			if ( 'adjustable' === newval ) {
				$( 'body' ).removeClass( 'fullheight' );
			}
		} );
	} );

	// Home header height.
	wp.customize(
		'osixthreeo_settings[home_header_height]', function( value ) {
			value.bind(
				function( newval ) {
					$( '.home .site-header' ).css( 'min-height', newval + 'px' );
				}
			);
		}
	);

	// Subpage header height.
	wp.customize(
		'osixthreeo_settings[subpage_header_height]', function( value ) {
			value.bind(
				function( newval ) {
					$( '.site-header' ).css( 'min-height', newval + 'px' );
				}
			);
		}
	);

	// HEADER --------------------------------------------- .
	osixthreeo_colors_live_update(
		'header_background_color',
		'.header-wrap',
		'background-color',
		'transparent'
	);
	wp.customize(
		'osixthreeo_settings[nav_link_color]', function( value ) {
			value.bind(
				function( newval ) {
					$( '.site-navigation a, button.dropdown-toggle' ).css( 'color', newval );
					$( '.responsive-menu-icon .menu-icon,.responsive-menu-icon .menu-icon::before,.responsive-menu-icon .menu-icon::after, .site-navigation li.search-icon .theicon:before' ).css( 'background-color', newval );
					$( '.site-navigation li.search-icon .theicon,.site-navigation li.search-icon:hover,.site-navigation .sub-menu,.topbar-widget.widget_nav_menu .sub-menu' ).css( 'border-color', newval );
				}
			);
		}
	);

	// SUBNAV --------------------------------------------- .
	//osixthreeo_colors_live_update(
	//	'subnav_text_color',
	//	'.site-navigation .sub-menu a,.sub-menu button.dropdown-toggle',
	//	'color',
	//	''
	//);
	//osixthreeo_colors_live_update(
	//	'subnav_bg_color',
	//	'.site-navigation .sub-menu a',
	//	'background',
	//	''
	//);
	//osixthreeo_colors_live_update(
	//	'subnav_border_color',
	//	'.site-navigation .sub-menu li,.site-navigation .sub-menu li:first-of-type',
	//	'border-color',
	//	''
	//);
	//osixthreeo_colors_live_update(
	//	'subnav_hover_text_color',
	//	'.site-navigation .sub-menu a:hover,.site-navigation .sub-menu .current_page_item > a,.site-navigation .sub-menu .current-menu-item > a',
	//	'color',
	//	''
	//);
	//osixthreeo_colors_live_update(
	//	'subnav_hover_bg_color',
	//	'.site-navigation .sub-menu a:hover,.site-navigation .sub-menu .current_page_item > a,.site-navigation .sub-menu .current-menu-item > a',
	//	'background',
	//	''
	//);

	// CONTENT --------------------------------------------- .
	osixthreeo_colors_live_update(
		'content_bgcolor',
		'.site-content',
		'background-color',
		'transparent'
	);
	osixthreeo_colors_live_update(
		'text_color',
		'body,button,input,select,textarea,h1 a,h2 a,h3 a,h4 a,h5 a,h6 a,.sidebar-widget ul a,.sidebar-widget .menu a,.comment-navigation .nav-previous a,.comment-navigation .nav-next a,.posts-navigation .nav-previous a,.posts-navigation .nav-next a,.post-navigation .nav-previous a,.post-navigation .nav-next a,.site-navigation .sub-menu a',
		'color',
		'#222222'
	);
	wp.customize(
		'osixthreeo_settings[link_color]', function( value ) {
			value.bind(
				function( newval ) {
					$( '.site-content a:not(.btn),h1 a:hover,h2 a:hover,h3 a:hover,h4 a:hover,h5 a:hover,h6 a:hover,.sidebar-widget ul a:hover,.sidebar-widget .menu a:hover,.comment-navigation .nav-previous a:hover,.comment-navigation .nav-next a:hover,.posts-navigation .nav-previous a:hover,.posts-navigation .nav-next a:hover,.post-navigation .nav-previous a:hover,.post-navigation .nav-next a:hover,.text-highlight' ).css( 'color', newval );
					$( 'input[type="button"],input[type="reset"],input[type="submit"],.btn:not(.secondary):not(.dark):not(.white),.bg-highlight,.woocommerce a.button,.woocommerce button.button,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button,.woocommerce #respond input#submit' ).css( 'background-color', newval );
					$( '.bb-highlight,.sticky .entry-header,.hentry.sticky' ).css( 'border-color', newval );
				}
			);
		}
	);
	wp.customize(
		'osixthreeo_settings[link_color_hover]', function( value ) {
			value.bind(
				function( newval ) {
					$( '.site-content a:not(.btn):hover,.site-content a:not(.btn):focus,.site-content a:not(.btn):active,.text-secondary' ).css( 'color', newval );
					$( 'input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,.site-content .btn.secondary,.site-navigation li:not(.search-icon) a:before,.bg-secondary,.footer-widgets input[type="submit"],.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce #respond input#submit.alt,.woocommerce input.button.alt,.woocommerce input.button:hover,.woocommerce #respond input#submit:hover' ).css( 'background-color', newval );
					$( 'a.arrow:hover:after,a.arrow:focus:after,a.arrow:active:after,.site-navigation li.accent,.bb-secondary,.footer-widgets input[type="search"]:focus' ).css( 'border-color', newval );
				}
			);
		}
	);

	// FOOTER --------------------------------------------- .
	osixthreeo_colors_live_update(
		'footer_background_color',
		'.site-footer',
		'background-color',
		'#525252'
	);
	osixthreeo_colors_live_update(
		'footer_text_color',
		'.site-info',
		'color',
		'#c0c0c0'
	);
	osixthreeo_colors_live_update(
		'footer_link_color',
		'.site-info a',
		'color',
		'#808080'
	);
	osixthreeo_colors_live_update(
		'footer_link_color_hover',
		'.site-info a:hover',
		'color',
		'#c0c0c0'
	);

} )( jQuery );
