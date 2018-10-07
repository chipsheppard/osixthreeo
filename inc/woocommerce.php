<?php
/**
 * Custom functions for WooCommerce.
 * https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/
 * https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * http://www.wpexplorer.com/woocommerce-compatible-theme/
 *
 * @package kelso
 */

add_action( 'after_setup_theme', 'kelso_add_woocommerce_support' );
/**
 * Add theme support.
 */
function kelso_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

/**
 * Remove WooCommerce Styles
 *
 * @param array $styles An array of stylesheets added by WooCommerce.
function wpex_remove_woo_styles( $styles ) {
	unset( $styles['woocommerce-general'] );
	unset( $styles['woocommerce-layout'] );
	unset( $styles['woocommerce-smallscreen'] );
	return $styles;
}
add_filter( 'woocommerce_enqueue_styles', 'wpex_remove_woo_styles' );
 */

// add_theme_support( 'wc-product-gallery-slider' );.
// add_theme_support( 'wc-product-gallery-zoom' );.
// add_theme_support( 'wc-product-gallery-lightbox' );.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', 'kelso_theme_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'kelso_theme_wrapper_end', 10 );

/**
 * The opening wrapper.
 */
function kelso_theme_wrapper_start() {
	echo '<div id="primary" class="content-area">';
	tha_content_wrap_before();
	echo '<main id="main" class="site-main cf" role="main">';
	tha_content_top();
}

/**
 * The closing wrapper.
 */
function kelso_theme_wrapper_end() {
	tha_content_bottom();
	echo '</main>';
	tha_content_wrap_after();
	echo '</div>';
}

/**
 * Remove the sidebar.
 *
 * @link https://www.kadencethemes.com/support-forums/topic/woocommerce-single-product-move-title-above-page-and-make-fullwidth/
 */
function disable_woo_commerce_sidebar() {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
}
add_action( 'init', 'disable_woo_commerce_sidebar' );

/**
 * Move product entry title before image.
 */
function change_product_page_order() {
	if ( is_product() ) {
		// Move Product Title above page.
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
		add_action( 'woocommerce_before_main_content', 'woocommerce_template_single_title', 10 );
	}
}
add_action( 'wp','change_product_page_order' );
