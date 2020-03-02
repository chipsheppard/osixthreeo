<?php
/**
 * The template for displaying a page with no sidebar.
 *
 * Template Name: Blank
 *
 * @since      1.0.0
 *
 * @package    osixthreeo
 * @subpackage osixthreeo/public/partials/templates
 */

remove_action( 'tha_header_before', 'osixthreeo_display_header' );
remove_action( 'tha_footer_before', 'osixthreeo_display_site_footer' );
remove_action( 'tha_content_before', 'osixthreeo_get_left_sidebar' );
remove_action( 'tha_content_after', 'osixthreeo_get_right_sidebar' );
remove_action( 'tha_header_before', 'osixthreeo_widgets_display_preheader' );
remove_action( 'tha_footer_before', 'osixthreeo_widgets_display_prefooter' );
remove_filter( 'body_class', 'osixthreeo_sidebar_bodyclass' );

/**
 * Whitelist certain WP body classes.
 *
 * @param Array $wp_classes body classes generated by WordPress.
 * @param Array $extra_classes the updated array of body classes.
 */
function osixthreeo_templates_body_class( $wp_classes, $extra_classes ) {
	// List of the only WP generated classes allowed.
	$whitelist  = array( 'page-template-osixthreeo-blank' );
	$wp_classes = array_intersect( $wp_classes, $whitelist );
	return array_merge( $wp_classes, array( 'osixthreeo-blank' ) );
}
add_filter( 'body_class', 'osixthreeo_templates_body_class', 10, 2 );

// Build the page.
get_template_part( 'index' );