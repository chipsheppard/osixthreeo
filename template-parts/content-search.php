<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package kelso
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
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

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<?php kelso_read_more(); ?>

</article>
