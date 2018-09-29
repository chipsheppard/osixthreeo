<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package kelso
 */

kelso_sidebar_bodyclass();

get_header();

kelso_get_left_sidebar();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main cf" role="main">

	<?php
	if ( have_posts() ) :

		if ( is_home() && ! is_front_page() ) :
		?>
			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header>

		<?php endif; ?>

			<div class="archive-content cf">

		<?php
		while ( have_posts() ) :
			the_post();

			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'template-parts/content', get_post_format() );

		endwhile;
		?>

		<div class="cf"></div>
		</div>

		<?php
		the_posts_pagination( array(
			'mid_size' => 2,
			'prev_text' => __( '&laquo; Previous', 'kelso' ),
			'next_text' => __( 'Next &raquo;', 'kelso' ),
		) );

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

	</main>
</div>

<?php
kelso_get_right_sidebar();

get_footer();
