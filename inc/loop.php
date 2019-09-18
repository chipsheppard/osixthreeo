<?php
/**
 * The Loop
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
 * Default Loop
 */
function osixthreeo_default_loop() {

	if ( have_posts() ) :

		tha_content_while_before();

		echo '<div class="loop-wrap">';

		while ( have_posts() ) :
			the_post();
			tha_entry_before();
			get_template_part( 'template-parts/content', get_post_format() );
			tha_entry_after();
		endwhile;

		echo '</div>';

		tha_content_while_after();

		else :

			tha_entry_before();
			get_template_part( 'template-parts/content', 'none' );
			tha_entry_after();

		endif;
}
add_action( 'tha_content_loop', 'osixthreeo_default_loop' );


/**
 * Archive Page Titles
 */
function osixthreeo_archive_page_titles() {
	if ( is_home() && ! is_front_page() || is_archive() || is_search() ) :
		echo '<header class="page-header">';

		if ( is_search() ) :
			echo '<h1 class="page-title">';
			/* translators: %$2s: is the search term */
			printf( '<span>' . esc_html__( 'Search Results for:%1$s %2$s', 'osixthreeo' ), '</span>', get_search_query() );
			echo '</h1>';
		else :
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
		endif;

		echo '</header>';
	endif;
}
add_action( 'tha_content_while_before', 'osixthreeo_archive_page_titles' );


/**
 * Archive Pagination (<< 1 of 10 >>)
 */
function osixthreeo_postpagination() {

	if ( is_archive() || is_home() ) :
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => __( '&laquo; Previous', 'osixthreeo' ),
				'next_text' => __( 'Next &raquo;', 'osixthreeo' ),
			)
		);
	endif;

}
add_action( 'tha_content_while_after', 'osixthreeo_postpagination' );


/**
 * Post Navigation (prev - next)
 */
function osixthreeo_postnav() {

	if ( is_single() ) :
		the_post_navigation(
			array(
				'prev_text' => __( '<span>previous</span> %title', 'osixthreeo' ),
				'next_text' => __( '<span>next</span> %title', 'osixthreeo' ),
			)
		);
	endif;

}
add_action( 'tha_entry_after', 'osixthreeo_postnav' );


/**
 * Post Comments
 */
function osixthreeo_comments() {

	if ( is_singular() && ( comments_open() || get_comments_number() ) ) {
		comments_template();
	}

}
add_action( 'tha_content_while_after', 'osixthreeo_comments' );
