<?php
/**
 * The template for displaying archive pages.
 *
 * @package kelso
 */

kelso_sidebar_bodyclass();

get_header();

kelso_get_left_sidebar();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main cf" role="main">

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header>

		<div class="archive-content cf">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_format() );

		endwhile;
		?>

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
