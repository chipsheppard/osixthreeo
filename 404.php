<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package kelso
 */

kelso_sidebar_bodyclass();
get_header();
tha_content_before();
kelso_get_left_sidebar();
?>

<div id="primary" class="content-area">
	<?php tha_content_wrap_before(); ?>

	<main id="main" class="site-main<?php kelso_title_placement_class(); ?>" role="main">
		<?php tha_content_top(); ?>

		<section class="error-404 not-found">

			<header class="page-header">
				<div class="title-wrap">
					<h1 class="page-title"><?php esc_html_e( 'Page not found.', 'kelso' ); ?></h1>
				</div>
			</header>

			<div class="page-content">
				<div class="error-message"><?php esc_html_e( 'error... error... page not found... going doOown', 'kelso' ); ?></div>
				<p><?php esc_html_e( 'Please use the menu in the header or try a search.', 'kelso' ); ?></p>
				<?php get_search_form(); ?>
			</div>

		</section>

		<?php tha_content_bottom(); ?>
	</main>
</div>

<?php
kelso_get_right_sidebar();
tha_content_after();
get_footer();
