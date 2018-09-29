<?php
/**
 * The template for displaying all single posts.
 *
 * @package kelso
 */

kelso_sidebar_bodyclass();

get_header();

kelso_get_left_sidebar();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', get_post_format() );

		the_post_navigation( array(
			'prev_text' => __( '<span>previous</span> %title', 'kelso' ),
			'next_text' => __( '<span>next</span> %title', 'kelso' ),
		) );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;
	?>

	</main>
</div>

<?php
kelso_get_right_sidebar();

get_footer();
