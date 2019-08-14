<?php
/**
 * Site header
 *
 * @package  osixthreeo
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

?><!doctype html>
<?php tha_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
	<?php
	tha_head_top();
	wp_head();
	tha_head_bottom();
	?>
</head>
<body <?php body_class(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}

	tha_body_top();
	?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'osixthreeo' ); ?></a>

	<?php tha_header_before(); ?>
	<header id="masthead" class="site-header">
		<div class="header-wrap">
			<div class="inner-wrap">
				<?php
				tha_header_top();
				tha_header_bottom();
				?>
			</div>
		</div>
		<?php
		/**
		 * Write the Custom Header markup
		 */
		osixthreeo_display_customheader();
		?>
	</header>
	<?php tha_header_after(); ?>

	<div id="content" class="site-content">
		<div class="content-inner-wrap">
