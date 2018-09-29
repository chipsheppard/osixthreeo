<?php
/**
 * Template part for single.php & archive.php.
 *
 * @package kelso
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( ! is_single() && ! has_post_format( 'aside' ) && ! has_post_format( 'status' ) && has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
	<?php endif; ?>

	<header class="entry-header">
		<?php
		if ( is_single() ) :

			the_title( '<h1 class="entry-title">', '</h1>' );

		else :

			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		endif;

		if ( 'post' === get_post_type() ) :
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
	</header>

	<div class="entry-content">
		<?php
		if ( is_single() ) :

			do_action( 'kelso_single_before_entry' );

			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'kelso' ), array(
					'span' => array(
						'class' => array(),
					),
				) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			do_action( 'kelso_single_after_entry' );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kelso' ),
				'after'  => '</div>',
			) );

		else :

			the_excerpt();

		endif;
		?>

	</div>


	<?php if ( is_single() ) : ?>
		<footer class="entry-footer">
			<?php kelso_entry_footer(); ?>
		</footer>
	<?php else : ?>
		<?php kelso_read_more(); ?>
	<?php endif; ?>

</article>
