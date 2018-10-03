<?php
/**
 * The template for displaying a page with a left sidebar.
 *
 * Template Name: Left Sidebar
 *
 * @package kelso
 */

add_filter( 'body_class', function( $classes ) {
	return array_merge( $classes, array( 'sidebar-left' ) );
} );

get_header();
tha_content_before();
get_sidebar( 'page' );
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
