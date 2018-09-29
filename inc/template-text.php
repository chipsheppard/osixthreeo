<?php
/**
 * Template Text
 *
 * Customization of text in WordPress generated areas
 *
 * @package kelso
 */

/**
 * ARCHIVE TITLE
 * puts a span around "Category:, Tag:, etc...
 *
 * @param string $title The title.
 */
function wrap_archive_title_part( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = __( '<div>written by:</div><span class="vcard">', 'kelso' ) . get_the_author() . '</span>';
	} elseif ( is_year() ) {
		$title = __( '<div>archive by year:</div>', 'kelso' ) . get_the_date( 'Y', 'yearly archives date format' );
	} elseif ( is_month() ) {
		$title = __( '<div>archive by month:</div>', 'kelso' ) . get_the_date( 'F Y', 'monthly archives date format' );
	} elseif ( is_day() ) {
		$title = __( '<div>archive by day:</div>', 'kelso' ) . get_the_date( 'F j, Y', 'daily archives date format' );
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_home() ) {
		$title = get_the_title( get_option( 'page_for_posts', true ) );
	} else {
		$title = __( 'Archives', 'kelso' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'wrap_archive_title_part' );


/**
 * Change Text in Search Submit Button
 *
 * @param string $text string of text.
 * @link https://wordpress.org/support/topic/how-do-i-change-some-details-of-the-search-widget
 */
function kelso_search_button( $text ) {
	$text = str_replace( 'value="Search"', 'value="go"', $text );
	return $text;
}
add_filter( 'get_search_form', 'kelso_search_button' );


/**
 * EXCERPT LENGTH FILTER - to 16 words.
 *
 * @param int $length Excerpt length.
 * @return int modified excerpt length.
 */
function kelso_custom_excerpt_length( $length ) {
	if ( has_post_format( 'aside' ) || has_post_format( 'status' ) ) :
		return 48;
	elseif ( is_search() ) :
		return 32;
	else :
		return 16;
	endif;
}
add_filter( 'excerpt_length', 'kelso_custom_excerpt_length', 999 );
