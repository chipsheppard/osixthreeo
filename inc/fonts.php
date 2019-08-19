<?php
/**
 * FONTS
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
 * Theme Fonts URL
 */
function osixthreeo_theme_fonts_url() {

	$osixthreeo_settings = wp_parse_args(
		get_option( 'osixthreeo_settings', array() ),
		osixthreeo_get_defaults()
	);

	$gf1 = 'Playfair+Display:400,400i,700,700i';
	$gf2 = 'Source+Sans+Pro:400,400i,700,700i';
	$gf3 = 'Lato:400,400i,700,700i';
	$gf4 = 'Lora:400,400i,700,700i';
	$gf5 = 'Merriweather:400,400i,700,700i';
	$gf6 = 'Oswald:400,700';
	$gf7 = 'Raleway:400,400i,700,700i';
	$gf8 = 'Roboto:400,400i,700,700i';
	$gf9 = 'Roboto+Slab:400,700';

	$gfonts = '';

	if ( 'playfairdisplay' === $osixthreeo_settings['base_font'] ) {
		$f1 = $gf1;
	} elseif ( 'soursesanspro' === $osixthreeo_settings['base_font'] ) {
		$f1 = $gf2;
	} elseif ( 'lato' === $osixthreeo_settings['base_font'] ) {
		$f1 = $gf3;
	} elseif ( 'lora' === $osixthreeo_settings['base_font'] ) {
		$f1 = $gf4;
	} elseif ( 'merriweather' === $osixthreeo_settings['base_font'] ) {
		$f1 = $gf5;
	} elseif ( 'oswald' === $osixthreeo_settings['base_font'] ) {
		$f1 = $gf6;
	} elseif ( 'raleway' === $osixthreeo_settings['base_font'] ) {
		$f1 = $gf7;
	} elseif ( 'roboto' === $osixthreeo_settings['base_font'] ) {
		$f1 = $gf8;
	} elseif ( 'robotoslab' === $osixthreeo_settings['base_font'] ) {
		$f1 = $gf9;
	} else {
		$f1 = '';
	}

	if ( 'playfairdisplay' === $osixthreeo_settings['header_font'] ) {
		$f2 = $gf1;
	} elseif ( 'soursesanspro' === $osixthreeo_settings['header_font'] ) {
		$f2 = $gf2;
	} elseif ( 'lato' === $osixthreeo_settings['header_font'] ) {
		$f2 = $gf3;
	} elseif ( 'lora' === $osixthreeo_settings['header_font'] ) {
		$f2 = $gf4;
	} elseif ( 'merriweather' === $osixthreeo_settings['header_font'] ) {
		$f2 = $gf5;
	} elseif ( 'oswald' === $osixthreeo_settings['header_font'] ) {
		$f2 = $gf6;
	} elseif ( 'raleway' === $osixthreeo_settings['header_font'] ) {
		$f2 = $gf7;
	} elseif ( 'roboto' === $osixthreeo_settings['header_font'] ) {
		$f2 = $gf8;
	} elseif ( 'robotoslab' === $osixthreeo_settings['header_font'] ) {
		$f2 = $gf9;
	} else {
		$f2 = '';
	}

	if ( 'playfairdisplay' === $osixthreeo_settings['sitetitle_font'] ) {
		$f3 = $gf1;
	} elseif ( 'soursesanspro' === $osixthreeo_settings['sitetitle_font'] ) {
		$f3 = $gf2;
	} elseif ( 'lato' === $osixthreeo_settings['sitetitle_font'] ) {
		$f3 = $gf3;
	} elseif ( 'lora' === $osixthreeo_settings['sitetitle_font'] ) {
		$f3 = $gf4;
	} elseif ( 'merriweather' === $osixthreeo_settings['sitetitle_font'] ) {
		$f3 = $gf5;
	} elseif ( 'oswald' === $osixthreeo_settings['sitetitle_font'] ) {
		$f3 = $gf6;
	} elseif ( 'raleway' === $osixthreeo_settings['sitetitle_font'] ) {
		$f3 = $gf7;
	} elseif ( 'roboto' === $osixthreeo_settings['sitetitle_font'] ) {
		$f3 = $gf8;
	} elseif ( 'robotoslab' === $osixthreeo_settings['sitetitle_font'] ) {
		$f3 = $gf9;
	} else {
		$f3 = '';
	}

	if ( '' === $f1 && '' === $f2 && '' === $f3 ) {
		return;
	}

	if ( '' !== $f1 && '' !== $f2 && '' !== $f3 ) {
		if ( $f1 === $f2 && $f1 === $f3 ) {
			$gfonts = $f1;
		} elseif ( $f1 === $f2 && $f1 !== $f3 ) {
			$gfonts = $f1 . '|' . $f3;
		} elseif ( $f1 !== $f2 && $f1 === $f3 ) {
			$gfonts = $f1 . '|' . $f2;
		} elseif ( $f1 !== $f2 && $f1 !== $f3 && $f2 === $f3 ) {
			$gfonts = $f1 . '|' . $f2;
		} else {
			$gfonts = $f1 . '|' . $f2 . '|' . $f3;
		}
	}
	if ( '' !== $f1 && '' !== $f2 && '' === $f3 ) {
		if ( $f1 === $f2 ) {
			$gfonts = $f1;
		} else {
			$gfonts = $f1 . '|' . $f2;
		}
	}
	if ( '' !== $f1 && '' === $f2 && '' !== $f3 ) {
		if ( $f1 === $f3 ) {
			$gfonts = $f1;
		} else {
			$gfonts = $f1 . '|' . $f3;
		}
	}
	if ( '' === $f1 && '' !== $f2 && '' !== $f3 ) {
		if ( $f2 === $f3 ) {
			$gfonts = $f2;
		} else {
			$gfonts = $f2 . '|' . $f3;
		}
	}
	if ( '' !== $f1 && '' === $f2 && '' === $f3 ) {
		$gfonts = $f1;
	}
	if ( '' === $f1 && '' !== $f2 && '' === $f3 ) {
		$gfonts = $f2;
	}
	if ( '' === $f1 && '' === $f2 && '' !== $f3 ) {
		$gfonts = $f3;
	}

	$font_families = apply_filters( 'osixthreeo_theme_fonts', array( $gfonts ) );
	$query_args = array(
		'family' => implode( '|', $font_families ),
		// 'subset' = > 'latin,latin-ext',.
	);
	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	return $fonts_url;
}
