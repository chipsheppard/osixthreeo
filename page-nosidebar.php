<?php
/**
 * The template for displaying a page with no sidebar.
 *
 * Template Name: No Sidebar
 *
 * @package kelso
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'page' );

		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;
	?>

	</main>
</div>

<?php
get_footer();
