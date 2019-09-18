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
				$( '.site-title, .site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

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
					$( '.header-wrap' ).css( 'padding-top', newval + 'px' );
					$( '.header-wrap' ).css( 'padding-bottom', newval + 'px' );
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

	// HEADER COLORS --------------------------------------------- .
	osixthreeo_colors_live_update(
		'header_background_color',
		'.header-wrap',
		'background-color',
		'transparent'
	);

	// CUSTOM HEADER TEXT COLORS ---------------------------------------------
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

	// CONTENT AREA COLORS ---------------------------------------------
	osixthreeo_colors_live_update(
		'content_bgcolor',
		'.site-content',
		'background-color',
		'transparent'
	);
	osixthreeo_colors_live_update(
		'text_color',
		'body,button,input,select,textarea,.sidebar-widget ul a,.sidebar-widget .menu a,.comment-navigation .nav-previous a,.comment-navigation .nav-next a,.posts-navigation .nav-previous a,.posts-navigation .nav-next a,.post-navigation .nav-previous a,.post-navigation .nav-next a,.site-navigation .sub-menu a',
		'color',
		'#222222'
	);

	// FOOTER COLORS ---------------------------------------------
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
	osixthreeo_colors_live_update(
		'meta_color',
		'.entry-meta, .entry-meta a, .entry-footer, .entry-footer a',
		'color',
		'#c0c0c0'
	);

    // FONT SIZE ----------------------------------------------------------
	// base font size.
	wp.customize(
		'osixthreeo_settings[base_font_size]', function( value ) {
			value.bind(
				function( newval ) {
					$( '.content-inner-wrap' ).css( 'font-size', newval + 'px' );
				}
			);
		}
	);
	// site title
	wp.customize(
		'osixthreeo_settings[sitetitle_font_size]', function( value ) {
			value.bind(
				function( newval ) {
					$( '.site-title' ).css( 'font-size', newval + 'px' );
				}
			);
		}
	);
	// site description
	wp.customize(
		'osixthreeo_settings[sitedescription_font_size]', function( value ) {
			value.bind(
				function( newval ) {
					$( '.site-description' ).css( 'font-size', newval + 'px' );
				}
			);
		}
	);
	// menu
	wp.customize(
		'osixthreeo_settings[menu_font_size]', function( value ) {
			value.bind(
				function( newval ) {
					$( '#primary-navigation' ).css( 'font-size', newval + 'px' );
				}
			);
		}
	);
	// hero primary
	wp.customize(
		'osixthreeo_settings[hero_text_primary_font_size]', function( value ) {
			value.bind(
				function( newval ) {
					$( '.hero-primary' ).css( 'font-size', newval + 'px' );
				}
			);
		}
	);
	// hero secondary
	wp.customize(
		'osixthreeo_settings[hero_text_secondary_font_size]', function( value ) {
			value.bind(
				function( newval ) {
					$( '.hero-secondary' ).css( 'font-size', newval + 'px' );
				}
			);
		}
	);
	// post meta
	wp.customize(
		'osixthreeo_settings[meta_font_size]', function( value ) {
			value.bind(
				function( newval ) {
					$( '.entry-meta, .entry-footer' ).css( 'font-size', newval + 'px' );
				}
			);
		}
	);

    // FONT WEIGHT -------------------------------------------------------------
	// header
	wp.customize(
		'osixthreeo_settings[header_font_weight]', function( value ) {
			value.bind( function( newval ) {
				if ( newval ) {
					$( 'h1:not(.site-title), h2, h3, h4, h5, h6' ).css( 'font-weight', newval );
				} else {
					$( 'h1:not(.site-title), h2, h3, h4, h5, h6' ).css( 'font-weight', 'normal' );
				}
			} );
		}
	);
	// site title
	wp.customize(
		'osixthreeo_settings[sitetitle_font_weight]', function( value ) {
			value.bind( function( newval ) {
				if ( newval ) {
					$( '.site-title' ).css( 'font-weight', newval );
				} else {
					$( '.site-title' ).css( 'font-weight', 'normal' );
				}
			} );
		}
	);
	// site description
	wp.customize(
		'osixthreeo_settings[sitedescription_font_weight]', function( value ) {
			value.bind( function( newval ) {
				if ( newval ) {
					$( '.site-description' ).css( 'font-weight', newval );
				} else {
					$( '.site-description' ).css( 'font-weight', 'normal' );
				}
			} );
		}
	);
	// menu
	wp.customize(
		'osixthreeo_settings[menu_font_weight]', function( value ) {
			value.bind( function( newval ) {
				if ( newval ) {
					$( '.site-navigation a' ).css( 'font-weight', newval );
				} else {
					$( '.site-navigation a' ).css( 'font-weight', 'normal' );
				}
			} );
		}
	);
	// post meta
	wp.customize(
		'osixthreeo_settings[meta_font_weight]', function( value ) {
			value.bind( function( newval ) {
				if ( newval ) {
					$( '.entry-meta, .entry-footer' ).css( 'font-weight', newval );
				} else {
					$( '.entry-meta, .entry-footer' ).css( 'font-weight', 'normal' );
				}
			} );
		}
	);

} )( jQuery );
