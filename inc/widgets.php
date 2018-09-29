<?php
/**
 * Widgets.
 *
 * @package kelso
 */

/**
 * Register widget areas.
 */
function kelso_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Posts Sidebar Widget Area', 'kelso' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Posts Sidebar Widget', 'kelso' ),
		'before_widget' => '<section id="%1$s" class="sidebar-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Pages Sidebar Widget Area', 'kelso' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Page Sidebar Widget', 'kelso' ),
		'before_widget' => '<section id="%1$s" class="sidebar-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name' => esc_html__( '1st Sub-Footer Widget Area', 'kelso' ),
		'id' => 'footer-1',
		'description' => esc_html__( '1st widget area for the sub-footer. Placing a widget here and leaving the other 3 empty will create a single full width widget area.', 'kelso' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	register_sidebar( array(
		'name' => esc_html__( '2nd Sub-Footer Widget Area', 'kelso' ),
		'id' => 'footer-2',
		'description' => esc_html__( '2nd widget area for the sub-footer. Placing widget here and leaving the 3rd and 4th areas empty will create 2 half width widget areas.', 'kelso' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	register_sidebar( array(
		'name' => esc_html__( '3rd Sub-Footer Widget Area', 'kelso' ),
		'id' => 'footer-3',
		'description' => esc_html__( '3rd widget area for the sub-footer. Placing a widget here and leaving the 4th area empty will create 3 one-third width widget areas.', 'kelso' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	register_sidebar( array(
		'name' => esc_html__( '4th Sub-Footer Widget Area', 'kelso' ),
		'id' => 'footer-4',
		'description' => esc_html__( '4th widget area for the sub-footer. Placing a widget here will create 4 one-fourth width widget areas.', 'kelso' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Lower Footer Widget Area', 'kelso' ),
		'id' => 'site-footer',
		'description' => esc_html__( 'An optional widget area for your site footer. Displays at the very bottom of your website.', 'kelso' ),
		'before_widget' => '<div id="%1$s" class="site-footer %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

}

add_action( 'widgets_init', 'kelso_widgets_init' );
