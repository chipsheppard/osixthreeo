<?php
/**
 * Display Featured Image checkbox.
 *
 * @package kelso
 */

/**
 *
 * Adds a checkbox below the Featured Image metabox - "Display in header".
 *
 * @link https://www.billerickson.net/code/add-checkbox-to-featured-image-metabox/
 * @param Object $content the image.
 * @param Object $post_id the id from the query.
 */
function kelso_add_featured_image_display_settings( $content, $post_id ) {
	$field_id    = 'show_featured_image';
	$field_value = esc_attr( get_post_meta( $post_id, $field_id, true ) );
	$field_text  = esc_html__( 'Display in header.', 'kelso' );
	$field_state = checked( $field_value, 1, false );

	$field_label = sprintf(
		'<p><label for="%1$s"><input type="checkbox" name="%1$s" id="%1$s" value="%2$s" %3$s> %4$s</label></p>',
		$field_id, $field_value, $field_state, $field_text
	);

	return $content .= $field_label;
}
add_filter( 'admin_post_thumbnail_html', 'kelso_add_featured_image_display_settings', 10, 2 );

/**
 * Sanitize user data and save/update the custom field value.
 *
 * @param String $post_id the image.
 * @param Object $post the post/page.
 * @param Object $update the post/page.
 */
function kelso_save_featured_image_display_settings( $post_id, $post, $update ) {
	$field_id    = 'show_featured_image';
	$field_value = isset( $_REQUEST[ $field_id ] ) ? 1 : 0; // WPCS: CSRF ok. WPCS: input var ok.

	update_post_meta( $post_id, $field_id, $field_value );
}
add_action( 'save_post', 'kelso_save_featured_image_display_settings', 10, 3 );
