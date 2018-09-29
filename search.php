<?php
/**
 * The template for displaying search results pages.
 *
 * @package kelso
 */

kelso_sidebar_bodyclass();

get_header();

kelso_get_left_sidebar();
?>

<section id="primary" class="content-area">
	<main id="main" class="site-main cf" role="main">

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title">
				<?php
					/* translators: %$2s: is the search term */
					printf( '<span>' . esc_html__( 'Search Results for:%1$s %2$s', 'kelso' ), '</span>', get_search_query() );
				?>
			</h1>
		</header>

		<?php
		while ( have_posts() ) :

			the_post();

			get_template_part( 'template-parts/content', 'search' );

		endwhile;

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
</section>

<?php
kelso_get_right_sidebar();

get_footer();
