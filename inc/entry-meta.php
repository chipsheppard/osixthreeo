<?php
/**
 * Entry Meta functions
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
 * Date - Posted on.
 */
function osixthreeo_posted_on() {

	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	$time_string = sprintf(
		$time_string,
		esc_attr(
			get_the_date( 'c' )
		),
		esc_html(
			get_the_date( 'M j, Y' )
		)
	);

	$posted_on = sprintf(
		esc_html( '%s', 'post date', 'osixthreeo' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . wp_kses_post( $posted_on ) . '</span> ';
}

/**
 * Date - Updated.
 */
function osixthreeo_updated_on() {

	if ( get_the_time( 'U' ) === get_the_modified_time( 'U' ) ) {
		return;
	}

	$updated_string = '<time class="entry-date updated" datetime="%1$s">%2$s</time>';

	$updated_string = sprintf(
		$updated_string,
		esc_attr(
			get_the_modified_date( 'c' )
		),
		esc_html(
			get_the_modified_date( 'm/d/Y' )
		)
	);
	$updated_on     = sprintf(
		/* translators: %s: modified date. */
		esc_html_x( 'updated %s', 'modified date', 'osixthreeo' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $updated_string . '</a>'
	);

	echo '<span class="updated-on">' . wp_kses_post( $updated_on ) . '</span>';
}

/**
 * Current Author.
 */
function osixthreeo_posted_by() {

	$byline = sprintf(
		/* translators: %s: post author */
		esc_html_x( 'by %s', 'post author', 'osixthreeo' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline">' . wp_kses_post( $byline ) . '</span>';
}

/**
 * Comments Count.
 */
function osixthreeo_comment_count() {

	$num_comments = get_comments_number();

	if ( ! is_single() && ! post_password_required() && comments_open() && ( $num_comments > 0 ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Comment<span class="screen-reader-text"> on %s</span>', 'osixthreeo' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}
}

/**
 * DISPLAY the entry meta
 */
function osixthreeo_display_entry_meta() {
	if ( 'post' === get_post_type() ) :
		echo '<div class="entry-meta">';
		osixthreeo_posted_on();
		osixthreeo_posted_by();
		osixthreeo_comment_count();
		osixthreeo_updated_on();
		echo '</div>';
	endif;
}
add_action( 'tha_entry_top', 'osixthreeo_display_entry_meta' );
