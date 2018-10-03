<?php
/**
 * The main sidebar - posts, post types, archives.
 *
 * @package kelso
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<?php tha_sidebars_before(); ?>
<aside id="secondary" class="widget-area" role="complementary">
<?php
	tha_sidebar_top();
	dynamic_sidebar( 'sidebar-1' );
	tha_sidebar_bottom();
?>
</aside>
<?php tha_sidebars_after(); ?>
