<?php
/**
 * Theme Functions.
 *
 * @package kelso
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Dont Update the Theme
 *
 * If there is a theme in the repo with the same name, this prevents WP from prompting an update.
 *
 * @since  1.0.0
 * @author Bill Erickson
 * @link   http://www.billerickson.net/excluding-theme-from-updates
 * @param  array  $r Existing request arguments.
 * @param  string $url Request URL.
 * @return array Amended request arguments
 */
function ea_dont_update_theme( $r, $url ) {
	if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) ) {
		return $r; // Not a theme update request. Bail immediately.
	}
	$themes = json_decode( $r['body']['themes'] );
	$child = get_option( 'stylesheet' );
	unset( $themes->themes->$child );
	$r['body']['themes'] = wp_json_encode( $themes );
	return $r;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param Array $classes the array of body classes.
 * @return array
 */
function kelso_body_classes( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'kelso_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function kelso_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'kelso_pingback_header' );

/**
 * Display Featured Image checkbox.
 *
 * Adds checkbox to Featured Image metabox to automatically add it to post header
 *
 * @link https://www.billerickson.net/code/add-checkbox-to-featured-image-metabox/
 * @param Object $content the image.
 * @param Object $post_id the id from the query.
 */
function kelso_add_featured_image_display_settings( $content, $post_id ) {
	$field_id    = 'show_featured_image';
	$field_value = esc_attr( get_post_meta( $post_id, $field_id, true ) );
	$field_text  = esc_html__( 'Display in header.', 'kelso' );
	$field_state = checked( $field_value, 1, false );

	$field_label = sprintf(
		'<p><label for="%1$s"><input type="checkbox" name="%1$s" id="%1$s" value="%2$s" %3$s> %4$s</label></p>',
		$field_id, $field_value, $field_state, $field_text
	);

	return $content .= $field_label;
}
add_filter( 'admin_post_thumbnail_html', 'kelso_add_featured_image_display_settings', 10, 2 );

/**
 * Sanitize user data and save/update the custom field value.
 *
 * @param String $post_id the image.
 * @param Object $post the post/page.
 * @param Object $update the post/page.
 */
function kelso_save_featured_image_display_settings( $post_id, $post, $update ) {
	$field_id    = 'show_featured_image';
	$field_value = isset( $_REQUEST[ $field_id ] ) ? 1 : 0; // WPCS: CSRF ok. WPCS: input var ok.

	update_post_meta( $post_id, $field_id, $field_value );
}
add_action( 'save_post', 'kelso_save_featured_image_display_settings', 10, 3 );
