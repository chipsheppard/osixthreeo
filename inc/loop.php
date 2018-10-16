<?php
/**
 * Loop
 *
 * @package      kelso
 **/

/**
 * Default Loop
 */
function kelso_default_loop() {

	if ( have_posts() ) :

		// archives and the "blog" page?
		if ( is_home() && ! is_front_page() || is_archive() ) :
		?>
		<header class="page-header">
			<div class="inner-wrap title-wrap">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
			?>
			</div>
		</header>
		<?php endif; ?>

		<?php if ( is_search() ) : ?>
		<header class="page-header">
			<div class="inner-wrap title-wrap">
				<h1 class="page-title">
					<?php
						/* translators: %$2s: is the search term */
						printf( '<span>' . esc_html__( 'Search Results for:%1$s %2$s', 'kelso' ), '</span>', get_search_query() );
					?>
				</h1>
			</div>
		</header>
		<?php endif; ?>

		<?php
		if ( is_archive() && ! function_exists( 'is_woocommerce' ) || is_home() ) {
			$m = ' do-masonry';
		} else {
			$m = null;
		}
		?>
		<div class="loop-wrap<?php echo esc_attr( $m ); ?>">

			<?php
			tha_content_while_before();

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				tha_entry_before();

				get_template_part( 'template-parts/content', get_post_format() );

				if ( is_single() ) :
					the_post_navigation( array(
						'prev_text' => __( '<span>previous</span> %title', 'kelso' ),
						'next_text' => __( '<span>next</span> %title', 'kelso' ),
					) );
				endif;

				if ( is_single() && comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				tha_entry_after();

			endwhile;

			tha_content_while_after();
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

		tha_entry_before();
		get_template_part( 'template-parts/content', 'none' );
		tha_entry_after();

	endif;
}
add_action( 'tha_content_loop', 'kelso_default_loop' );
