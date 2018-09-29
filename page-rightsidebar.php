<?php
/**
 * The template for displaying a page with a right sidebar.
 *
 * Template Name: Right Sidebar
 *
 * @package kelso
 */

add_filter( 'body_class', function( $classes ) {
	return array_merge( $classes, array( 'sidebar-right' ) );
} );

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
get_sidebar( 'page' );

get_footer();
