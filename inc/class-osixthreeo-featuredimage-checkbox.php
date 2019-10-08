<?php
/**
 * Display Featured Image checkbox.
 *
 * @package  osixthreeo
 * @subpackage osixthreeo/inc
 * @author   Chip Sheppard
 * @since    1.2.0
 * @license  GPL-2.0+
 *
 * @link https://www.pmg.com/blog/wordpress-how-to-adding-a-custom-checkbox-to-the-post-publish-box/
 */

/**
 * Calls the class on the post edit screen.
 */
function osixthreeo_fi_checkbox() {
	new Osixthreeo_Featuredimage_Checkbox();
}

if ( is_admin() ) {
	add_action( 'load-post.php', 'osixthreeo_fi_checkbox' );
	add_action( 'load-post-new.php', 'osixthreeo_fi_checkbox' );
}

/**
 * The Class.
 */
class Osixthreeo_Featuredimage_Checkbox {

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_fi_checkbox' ) );
		add_action( 'save_post', array( $this, 'save_fi_checkbox' ) );
	}

	/**
	 * Adds a checkbox.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
	 * @link https://wordpress.org/ideas/topic/add-meta-box-to-multiple-post-types
	 * @param Array $post_type Post Types to target.
	 */
	public function add_fi_checkbox( $post_type ) {
		$types = array( 'post', 'page' );
		if ( in_array( $post_type, $types, true ) ) {
			add_meta_box(
				'fi_checkbox_id',
				__( 'Featured Image Display', 'osixthreeo' ),
				array( $this, 'render_fi_checkbox' ),
				$post_type,
				'side',
				'high'
			);
		}
	}


	/**
	 * Renders the meta box.
	 *
	 * @param WP_Post $post Post Types to target.
	 */
	public function render_metabox( $post ) {
		// Add nonce for security and authentication.
		wp_nonce_field( 'osixthreeo_nonce_action', 'osixthreeo_nonce' );
	}

	/**
	 * Handles saving the meta box.
	 *
	 * @param int $post_id Post ID.
	 * @return null
	 */
	public function save_fi_checkbox( $post_id ) {
		// Add nonce for security and authentication.
		$nonce_name   = isset( $_POST['osixthreeo_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['osixthreeo_nonce'] ) ) : '';
		$nonce_action = 'osixthreeo_nonce_action';

		// Check if nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
			return;
		}

		// Check if user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Check if not an autosave.
		if ( wp_is_post_autosave( $post_id ) ) {
			return;
		}

		// Check if not a revision.
		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		// check if there was a multisite switch before.
		if ( is_multisite() && ms_is_switched() ) {
			return $post_id;
		}

		if ( has_post_thumbnail() ) {
			if ( isset( $_POST['show_featured_image'] ) ) {
				update_post_meta( $post_id, '_show_featured_image', sanitize_text_field( wp_unslash( $_POST['show_featured_image'] ) ) );
			} else {
				update_post_meta( $post_id, '_show_featured_image', sanitize_text_field( wp_unslash( $_POST['show_featured_image'] ) ) );
			}
		} else {
			return $post_id;
		}
	}

	/**
	 * Callback.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_fi_checkbox( $post ) {
		// Add an nonce field so we can check for it later - $action, $name.
		wp_nonce_field( 'osixthreeo_nonce_action', 'osixthreeo_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$isfeatured = get_post_meta( $post->ID, '_show_featured_image', true );
		?>
		<label><input type="checkbox" name="show_featured_image" value="yes" <?php echo ( ( 'yes' === $isfeatured ) ? 'checked="checked"' : '' ); ?>/> Display in the page header.<label>
		<?php
	}
}
