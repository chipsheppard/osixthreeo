<?php
/**
 * The template for displaying a page with no sidebar.
 *
 * Template Name: No Sidebar
 *
 * @package kelso
 */

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
