<?php
/**
 * Site header
 *
 * @package  osixthreeo
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

echo '<!DOCTYPE html>';
tha_html_before();
echo '<html ' . get_language_attributes() . '>'; // WPCS: XSS OK.

echo '<head>';
	tha_head_top();
	wp_head();
	tha_head_bottom();
echo '</head>';

echo '<body class="' . join( ' ', get_body_class() ) . '">'; // WPCS: XSS OK.
tha_body_top();
echo '<div id="page" class="site">';
	echo '<a class="skip-link screen-reader-text" href="#content">' . esc_html__( 'Skip to content', 'osixthreeo' ) . '</a>';

	tha_header_before();
	echo '<header id="masthead" class="site-header">';
		echo '<div class="header-wrap">';
			echo '<div class="inner-wrap">';
				tha_header_top();
				tha_header_bottom();
			echo '</div>';
		echo '</div>';
	echo '</header>';
	tha_header_after();

	echo '<div id="content" class="site-content">';
		echo '<div class="content-inner-wrap">';
