<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @package kelso
 */

?>

<section class="no-results not-found">

	<header class="page-header">
		<div class="title-wrap">
			<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'kelso' ); ?></h1>
		</div>
	</header>

	<div class="page-content">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php esc_html_e( 'No posts to display.', 'kelso' ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'kelso' ); ?></p>
			<?php
			get_search_form();

		else :
		?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'kelso' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div>

</section>
