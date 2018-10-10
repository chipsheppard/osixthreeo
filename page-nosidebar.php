<?php
/**
 * The template for displaying a page with no sidebar.
 *
 * Template Name: No Sidebar - Fullwidth
 *
 * @package kelso
 */

 /**
  * Filter the body classes to override Customizer settings.
  *
  * @param array $wp_classes WordPress body classes.
  */
function kelso_sidebar_class_helper( $wp_classes ) {
	$blacklist = array( 'sidebar-right', 'sidebar-left', 'nosidebar-silo' );
	$wp_classes = array_diff( $wp_classes, $blacklist );
	return $wp_classes;
}
add_filter( 'body_class', 'kelso_sidebar_class_helper', 10, 2 );


get_header();
tha_content_before();
?>

<div id="primary" class="content-area">
	<?php tha_content_wrap_before(); ?>

	<main id="main" class="site-main cf" role="main">
		<?php
		tha_content_top();
		tha_content_loop();
		tha_content_bottom();
		?>
	</main>

	<?php tha_content_wrap_after(); ?>
</div>

<?php
tha_content_after();
get_footer();
