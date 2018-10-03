<?php
/**
 * The sidebar containing the Page sidebar widget area.
 *
 * @package kelso
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<?php tha_sidebars_before(); ?>
<aside id="secondary" class="widget-area" role="complementary">
<?php
	tha_sidebar_top();
	dynamic_sidebar( 'sidebar-2' );
	tha_sidebar_bottom();
?>
</aside>
<?php tha_sidebars_after(); ?>
