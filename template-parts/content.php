<?php
/**
 * Template part for the content area.
 *
 * @package kelso
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( ! is_singular() && ! has_post_format( 'aside' ) && ! has_post_format( 'status' ) && has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="featured-image"><?php the_post_thumbnail( 'medium' ); ?></a>
	<?php endif; ?>

	<header class="entry-header">

		<?php
		if ( is_singular() ) : // post, attachment, page, custom post types.

			the_title( '<div class="inner-wrap title-wrap"><h1 class="entry-title">', '</h1>' );

		else : // archive.

			the_title( '<div class="title-wrap"><h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		endif;

		if ( 'post' === get_post_type() ) : // post - single or archive.
		?>
			<div class="entry-meta">
				<?php
				kelso_posted_on();
				kelso_posted_by();
				kelso_comment_count();
				kelso_updated_on();
				?>
			</div>
		<?php endif; ?>
		<?php tha_entry_top(); ?>
		</div>
	</header>

	<div class="entry-content">
		<?php
		tha_entry_content_before();

		if ( is_singular() ) : // single post, attachment, page, custom post types.

			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'kelso' ), array(
					'span' => array(
						'class' => array(),
					),
				) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kelso' ),
				'after'  => '</div>',
			) );

		else : // archive.

			the_excerpt();

		endif;

		tha_entry_content_after();
		?>
	</div>


	<?php if ( is_single() && 'post' === get_post_type() ) : // single posts only. ?>
		<footer class="entry-footer">
		<?php
			kelso_entry_footer();
			tha_entry_bottom();
		?>
		</footer>
	<?php endif; ?>

	<?php if ( is_archive() || is_home() || is_search() ) : // archive page? ?>
		<?php kelso_read_more(); ?>
		<div class="cf"></div>
	<?php endif; ?>

</article>
