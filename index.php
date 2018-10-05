<?php
/**
 * The main template file.
 *
 * @package kelso
 */

kelso_sidebar_bodyclass();
kelso_home_header_height();
get_header();
tha_content_before();
kelso_get_left_sidebar();
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
kelso_get_right_sidebar();
tha_content_after();
get_footer();
