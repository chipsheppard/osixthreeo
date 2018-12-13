<?php
/**
 * WordPress Cleanup
 *
 * @package  osixthreeo
 * @subpackage osixthreeo/inc
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Don't Update the Theme
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
function osixthreeo_dont_update_theme( $r, $url ) {
	if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) ) {
		return $r; // Not a theme update request. Bail immediately.
	}
	$themes = json_decode( $r['body']['themes'] );
	$child = get_option( 'stylesheet' );
	unset( $themes->themes->$child );
	$r['body']['themes'] = wp_json_encode( $themes );
	return $r;
}
add_filter( 'http_request_args', 'osixthreeo_dont_update_theme', 5, 2 );

/**
 * Header Meta Tags
 */
function osixthreeo_header_meta_tags() {
	echo '<meta charset="' . esc_html( get_bloginfo( 'charset' ) ) . '">';
	echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
	echo '<link rel="profile" href="http://gmpg.org/xfn/11">';
	echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">';
}
add_action( 'wp_head', 'osixthreeo_header_meta_tags' );


/**
 * Remove injected styles from recent comments widget.
 *
 * @link http://www.narga.net/how-to-remove-or-disable-comment-reply-js-and-recentcomments-from-wordpress-header
 */
function osixthreeo_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'osixthreeo_remove_recent_comments_style' );


/**
 * ARCHIVE TITLE
 * puts a div around prefix or deletes it.
 *
 * @param string $title The title.
 */
function wrap_archive_title_part( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = __( '<div>written by:</div><span class="vcard">', 'osixthreeo' ) . get_the_author() . '</span>';
	} elseif ( is_year() ) {
		$title = __( '<div>archive by year:</div>', 'osixthreeo' ) . get_the_date( 'Y' );
	} elseif ( is_month() ) {
		$title = __( '<div>archive by month:</div>', 'osixthreeo' ) . get_the_date( 'F Y' );
	} elseif ( is_day() ) {
		$title = __( '<div>archive by day:</div>', 'osixthreeo' ) . get_the_date( 'F j, Y' );
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_home() ) {
		$title = get_the_title( get_option( 'page_for_posts', true ) );
	} else {
		$title = __( 'Archives', 'osixthreeo' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'wrap_archive_title_part' );


/**
 * EXCERPT LENGTH FILTER - to 16 words.
 *
 * @param int $length Excerpt length.
 * @return int modified excerpt length.
 */
function osixthreeo_custom_excerpt_length( $length ) {
	if ( has_post_format( 'aside' ) || has_post_format( 'status' ) ) :
		return 48;
	elseif ( is_search() ) :
		return 32;
	else :
		return 16;
	endif;
}
add_filter( 'excerpt_length', 'osixthreeo_custom_excerpt_length', 999 );


/**
 * SEARCH Change Text in Submit Button
 *
 * @param string $text string of text.
 * @link https://wordpress.org/support/topic/how-do-i-change-some-details-of-the-search-widget
 */
function osixthreeo_search_button( $text ) {
	$text = str_replace( 'value="Search"', 'value="go"', $text );
	return $text;
}
add_filter( 'get_search_form', 'osixthreeo_search_button' );
