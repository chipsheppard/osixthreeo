/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

function kelso_colors_live_update( id, selector, property, default_value ) {
 	default_value = typeof default_value !== 'undefined' ? default_value : 'initial';
 	wp.customize( 'kelso_settings[' + id + ']', function( value ) {
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

// COLORS --------------------------------------------------------------- .
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

	// Header text color.
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
				$( '.site-title, .site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Body background color
	kelso_colors_live_update(
		'background_color',
		'body',
		'background-color',
		''
	);

	// HEADER ----------------------------------- .
	kelso_colors_live_update(
		'header_background_color',
		'.header-wrap',
		'background-color',
		'rgba(0,0,0,0.75)'
	);

	// STICKY HEADER ----------------------------------- .
	kelso_colors_live_update(
		'stickyheader_background_color',
		'.header-wrap.stuck,.contained .header-wrap.stuck .inner-wrap',
		'background-color',
		'#000000'
	);

	// SITE CONTENT --------------------------------- .
	// Content Area Background Color
	kelso_colors_live_update(
		'content_background_color',
		'.content-wrap',
		'background-color',
		'#fafafa'
	);

	// Text Color
	kelso_colors_live_update(
		'text_color',
		'body,button,input,select,textarea,h1 a,h2 a,h3 a,h4 a,h5 a,h6 a,.sidebar-widget ul a,.sidebar-widget .menu a,.comment-navigation .nav-previous a,.comment-navigation .nav-next a,.posts-navigation .nav-previous a,.posts-navigation .nav-next a,.post-navigation .nav-previous a,.post-navigation .nav-next a,.site-navigation .sub-menu a',
		'color',
		'#222222'
	);

	// Link Color
	wp.customize(
		'kelso_settings[link_color]', function( value ) {
			value.bind(
				function( newval ) {
					$( '.site-content a:not(.btn),h1 a:hover,h2 a:hover,h3 a:hover,h4 a:hover,h5 a:hover,h6 a:hover,.sidebar-widget ul a:hover,.sidebar-widget .menu a:hover,.comment-navigation .nav-previous a:hover,.comment-navigation .nav-next a:hover,.posts-navigation .nav-previous a:hover,.posts-navigation .nav-next a:hover,.post-navigation .nav-previous a:hover,.post-navigation .nav-next a:hover,.text-highlight' ).css( 'color', newval );
					$( 'input[type="button"],input[type="reset"],input[type="submit"],button:not(.responsive-menu-icon):not(.dropdown-toggle):not(.customize-partial-edit-shortcut-button),.site-content .btn:not(.secondary):not(.darklight):not(.white),.bg-highlight,.subscription-toggle' ).css( 'background-color', newval );
					$( '.bb-highlight,.sticky .entry-header' ).css( 'border-color', newval );
				}
			);
		}
	);

	// Link Color Hover
	wp.customize(
		'kelso_settings[link_color_hover]', function( value ) {
			value.bind(
				function( newval ) {
					$( '.site-content a:not(.btn):hover,.site-content a:not(.btn):focus,.site-content a:not(.btn):active,.text-secondary' ).css( 'color', newval );
					$( 'input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,.site-content .btn.secondary,.site-content button.secondary,.site-navigation li:not(.search-icon) a:before,.bg-secondary' ).css( 'background-color', newval );
					$( 'a.arrow:hover:after,a.arrow:focus:after,a.arrow:active:after,.site-navigation li.accent,.bb-secondary' ).css( 'border-color', newval );
				}
			);
		}
	);


	// FOOTERWIDGETS ----------------------------------- .
	// Background
	kelso_colors_live_update(
		'footerwidgets_background_color',
		'.footer-widgets',
		'background-color',
		'#494949'
	);

	// FW Title
	kelso_colors_live_update(
		'footerwidgets_widget_title_color',
		'.footer-widgets .widget-title',
		'color',
		'#dcdcdc'
	);

	// FW Text
	kelso_colors_live_update(
		'footerwidgets_text_color',
		'.footer-widgets',
		'color',
		'#dcdcdc'
	);

	// FW Link
	kelso_colors_live_update(
		'footerwidgets_link_color',
		'.footer-widgets a:not(.btn)',
		'color',
		'#c0c0c0'
	);

	// FW Link Hover
	kelso_colors_live_update(
		'footerwidgets_link_color_hover',
		'.footer-widgets a:not(.btn):hover',
		'color',
		'#f5f5f5'
	);


	// FOOTER ----------------------------------- .
	kelso_colors_live_update(
		'footer_background_color',
		'.site-footer',
		'background-color',
		'#525252'
	);
	kelso_colors_live_update(
		'footer_text_color',
		'.site-info',
		'color',
		'#c0c0c0'
	);
	kelso_colors_live_update(
		'footer_link_color',
		'.site-info a',
		'color',
		'#808080'
	);
	kelso_colors_live_update(
		'footer_link_color_hover',
		'.site-info a:hover',
		'color',
		'#c0c0c0'
	);

	// HERO TEXT ----------------------------------- .
	kelso_colors_live_update(
		'hero_text_primary_color',
		'.hero-primary',
		'color',
		'#ffffff'
	);
	kelso_colors_live_update(
		'hero_text_secondary_color',
		'.hero-secondary',
		'color',
		'#ffffff'
	);

	// GLOBAL WIDTH
	wp.customize( 'kelso_settings[global_width_setting]', function( value ) {
		value.bind( function( newval ) {
			if ( 'full' === newval ) {
				$( '.site' ).removeClass( 'contained' );
			}
			if ( 'contained' === newval ) {
				$( '.site' ).addClass( 'contained' );
			}
		} );
	} );

} )( jQuery );
