<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package kelso
 */

kelso_sidebar_bodyclass();

get_header();

kelso_get_left_sidebar();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<section class="error-404 not-found">

			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Page not found.', 'kelso' ); ?></h1>
			</header>

			<div class="page-content">
				<div class="error-message"><?php esc_html_e( 'error... error... page not found... going doOown', 'kelso' ); ?></div>
				<p><?php esc_html_e( 'Please use the menu in the header or try a search.', 'kelso' ); ?></p>
				<?php get_search_form(); ?>
			</div>

		</section>

	</main>
</div>

<?php
kelso_get_right_sidebar();

get_footer();
