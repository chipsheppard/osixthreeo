<?php
/**
 * Helper functions for the Customizer.
 *
 * @package kelso
 */

if ( ! function_exists( 'kelso_get_default_color_palettes' ) ) {
	/**
	 * Set up our colors for the color picker palettes and filter them so you can change them.
	 *
	 * @since 0.1
	 */
	function kelso_get_default_color_palettes() {
		$palettes = array(
			'#000000',
			'#ffffff',
			'#1e90ff',
			'#ff8c00',
			'#9acd32',
			'#cc0000',
			'#ffee00',
			'#993399',
		);
		return apply_filters( 'kelso_default_color_palettes', $palettes );
	}
}

if ( ! function_exists( 'kelso_enqueue_color_palettes' ) ) {
	add_action( 'customize_controls_enqueue_scripts', 'kelso_enqueue_color_palettes' );
	/**
	 * Add our custom color palettes to the color pickers in the Customizer.
	 */
	function kelso_enqueue_color_palettes() {
		// Old versions of WP don't get nice things.
		if ( ! function_exists( 'wp_add_inline_script' ) ) :
			return;
		endif;

		// Grab our palette array and turn it into JS.
		$palettes = wp_json_encode( kelso_get_default_color_palettes() );

		// Add our custom palettes
		// json_encode takes care of escaping.
		wp_add_inline_script( 'wp-color-picker', 'jQuery.wp.wpColorPicker.prototype.options.palettes = ' . $palettes . ';' );
	}
}

if ( ! function_exists( 'kelso_sanitize_integer' ) ) {
	/**
	 * Sanitize integers.
	 *
	 * @param Int $input number.
	 */
	function kelso_sanitize_integer( $input ) {
		return absint( $input );
	}
}

if ( ! function_exists( 'kelso_sanitize_checkbox' ) ) {
	/**
	 * Sanitize checkbox values.
	 *
	 * @param Bool $checked True or False.
	 */
	function kelso_sanitize_checkbox( $checked ) {
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}
}

if ( ! function_exists( 'kelso_sanitize_choices' ) ) {
	/**
	 * Sanitize choices.
	 *
	 * @param String $input number.
	 * @param String $setting number.
	 */
	function kelso_sanitize_choices( $input, $setting ) {
		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
}


if ( ! function_exists( 'kelso_sanitize_rgba' ) ) {
	/**
	 * Sanitize RGBA colors.
	 *
	 * @param String $color number.
	 */
	function kelso_sanitize_rgba( $color ) {
		if ( '' === $color ) {
			return '';
		}

		// If string does not start with 'rgba', then treat as hex.
		// sanitize the hex color and finally convert hex to rgba.
		if ( false === strpos( $color, 'rgba' ) ) {
			return sanitize_hex_color( $color );
		}

		// By now we know the string is formatted as an rgba color so we need to further sanitize it.
		$color = str_replace( ' ', '', $color );
		sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
		return 'rgba( ' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ' )';
	}
}
