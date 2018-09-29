<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kelso
 */

?>

		</div>
	</div>

	<?php do_action( 'kelso_after_content' ); ?>

	<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
	<div class="footer-widgets">

		<div class="wrap<?php kelso_sitecontain_class(); ?>">
			<div class="inner-wrap">
				<div class="footer-widget-area">
					<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>

						<div class="col-1-4 first">
							<?php
							if ( is_active_sidebar( 'footer-1' ) ) :
								dynamic_sidebar( 'footer-1' );
							else :
							?>
							&nbsp;
							<?php endif; ?>
						</div>
						<div class="col-1-4">
							<?php
							if ( is_active_sidebar( 'footer-2' ) ) :
								dynamic_sidebar( 'footer-2' );
							else :
							?>
							&nbsp;
							<?php endif; ?>
						</div>
						<div class="col-1-4">
							<?php
							if ( is_active_sidebar( 'footer-3' ) ) :
								dynamic_sidebar( 'footer-3' );
							else :
							?>
							&nbsp;
							<?php endif; ?>
						</div>
						<div class="col-1-4">
							<?php
							if ( is_active_sidebar( 'footer-4' ) ) :
								dynamic_sidebar( 'footer-4' );
							else :
							?>
							&nbsp;
							<?php endif; ?>
						</div>

					<?php elseif ( is_active_sidebar( 'footer-3' ) ) : ?>

						<div class="col-1-3 first">
							<?php
							if ( is_active_sidebar( 'footer-1' ) ) :
								dynamic_sidebar( 'footer-1' );
							else :
							?>
							&nbsp;
							<?php endif; ?>
						</div>
						<div class="col-1-3">
							<?php
							if ( is_active_sidebar( 'footer-2' ) ) :
								dynamic_sidebar( 'footer-2' );
							else :
							?>
							&nbsp;
							<?php endif; ?>
						</div>
						<div class="col-1-3">
							<?php
							if ( is_active_sidebar( 'footer-3' ) ) :
								dynamic_sidebar( 'footer-3' );
							else :
							?>
							&nbsp;
							<?php endif; ?>
						</div>

					<?php elseif ( is_active_sidebar( 'footer-2' ) ) : ?>

						<div class="col-1-2 first">
							<?php
							if ( is_active_sidebar( 'footer-1' ) ) :
								dynamic_sidebar( 'footer-1' );
							else :
							?>
							&nbsp;
							<?php endif; ?>
						</div>
						<div class="col-1-2">
							<?php
							if ( is_active_sidebar( 'footer-2' ) ) :
								dynamic_sidebar( 'footer-2' );
							else :
							?>
							&nbsp;
							<?php endif; ?>
						</div>

					<?php elseif ( is_active_sidebar( 'footer-1' ) ) : ?>

						<div>
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div>

					<?php endif; ?>
					<div class="cf"></div>
				</div>
			</div>
		</div>

	</div>
	<?php endif; ?>


	<footer id="colophon" class="site-footer" role="contentinfo">
	<?php
	if ( is_active_sidebar( 'site-footer' ) ) {
	?>
		<div class="wrap<?php kelso_sitecontain_class(); ?>">
			<div class="inner-wrap">
				<div class="site-info">
					<?php dynamic_sidebar( 'site-footer' ); ?>
					<?php kelso_back_to_top(); ?>
				</div>
			</div>
		</div>
	<?php } ?>
	</footer>

	<?php do_action( 'kelso_after_footer' ); ?>

</div>

<?php wp_footer(); ?>

</body>
</html>
