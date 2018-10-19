<?php
/**
 * Site footer
 *
 * @package kelso
 */

?>

		</div>
	</div>

	<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
	<div class="footer-widgets">

		<div class="inner-wrap">
			<?php kelso_display_footer_widgets(); ?>
		</div>

	</div>
	<?php endif; ?>

	<?php tha_footer_before(); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="inner-wrap">
			<?php
			tha_footer_top();
			kelso_display_site_footer();
			tha_footer_bottom();
			?>
		</div>
	</footer>

	<?php tha_footer_after(); ?>

</div>

<?php
wp_footer();
tha_body_bottom();
?>

</body>
</html>
