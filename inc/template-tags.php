<?php
/**
 * Custom template tags for this theme.
 *
 * @package kelso
 */

if ( ! function_exists( 'kelso_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function kelso_posted_on() {

		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date( 'm/d/Y' ) )
		);

		$posted_on = sprintf(
			/* translators: %s: puvlished date. */
			esc_html_x( 'published %s', 'post date', 'kelso' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'kelso_updated_on' ) ) :
	/**
	 * Prints HTML with meta information for the modified post-date/time.
	 */
	function kelso_updated_on() {

		if ( get_the_time( 'U' ) === get_the_modified_time( 'U' ) ) {
			return;
		}

		$updated_string = '<time class="entry-date updated" datetime="%1$s">%2$s</time>';

		$updated_string = sprintf( $updated_string,
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date( 'm/d/Y' ) )
		);
		$updated_on = sprintf(
			/* translators: %s: modified date. */
			esc_html_x( 'updated &nbsp;&nbsp; %s', 'modified date', 'kelso' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $updated_string . '</a>'
		);

		echo '<span class="updated-on">' . $updated_on . '</span>'; // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'kelso_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function kelso_posted_by() {

		$byline = sprintf(
			/* translators: %s: post author */
			esc_html_x( 'by %s', 'post author', 'kelso' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline">' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'kelso_comment_count' ) ) :
	/**
	 * Prints HTML with meta information for comments count.
	 */
	function kelso_comment_count() {

		$num_comments = get_comments_number();

		if ( ! is_single() && ! post_password_required() && comments_open() && ( $num_comments > 0 ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Comment<span class="screen-reader-text"> on %s</span>', 'kelso' ),
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
endif;


if ( ! function_exists( 'kelso_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function kelso_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'kelso' ) );
			if ( $categories_list && kelso_categorized_blog() ) {
				/* translators: 1$s: category list */
				printf( '<span class="cat-links">' . esc_html__( 'Filed under %1$s', 'kelso' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'kelso' ) );
			if ( $tags_list ) {
				/* translators: 1$s: tag list */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'kelso' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'kelso' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;


if ( ! function_exists( 'kelso_read_more' ) ) :
	/**
	 * Makes the Read More link on Archive templates.
	 */
	function kelso_read_more() {
		 $link = sprintf( '<footer class="link-more"><a href="%1$s" class="more-link arrow">%2$s</a></footer>',
			 get_permalink( get_the_ID() ),
			 /* translators: %s: Name of current post */
			 sprintf( __( 'Full Article<span class="screen-reader-text"> "%s"</span>', 'kelso' ), get_the_title( get_the_ID() ) )
		 );
		echo wp_kses_post( $link );
	}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function kelso_categorized_blog() {
	if ( false === (
		$all_the_cool_cats = get_transient( 'kelso_categories'
		) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'kelso_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so kelso_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so kelso_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in kelso_categorized_blog.
 */
function kelso_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'kelso_categories' );
}
add_action( 'edit_category', 'kelso_category_transient_flusher' );
add_action( 'save_post',     'kelso_category_transient_flusher' );
