<?php
/**
 * Custom Header.
 *
 * @package kelso
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*
 * CUSTOM HEADER
 -----------------------------------------------------------------
 */
if ( ! function_exists( 'kelso_display_customheader' ) ) {
	/**
	 * Get the Custom Header
	 * Uses  kelso_customheader_image_url()
	 *       kelso_customheader_content()
	 */
	function kelso_display_customheader() {
	?>

		<div class="custom-header">
			<div class="wrap">
				<div class="custom-header-image"<?php kelso_customheader_image_url(); ?>>

					<?php kelso_customheader_content(); ?>

				</div>
			</div>
		</div>
		<?php
	}
}


if ( ! function_exists( 'kelso_customheader_image_url' ) ) {
	/**
	 * Write out the custom header image URL for the function above.
	 *
	 * @link https://www.billerickson.net/code/add-checkbox-to-featured-image-metabox/
	 */
	function kelso_customheader_image_url() {

		$blog_id = get_option( 'page_for_posts' );
		$_post = get_queried_object();
		$key_value = get_post_meta( get_the_ID(), 'show_featured_image', true );
		$blog_key_value = get_post_meta( $blog_id, 'show_featured_image', true );

		if ( is_home() && ! is_front_page() && has_post_thumbnail( $blog_id ) && $blog_key_value ) : // For blog page.
			echo ' style="background-image:url(' . esc_url( get_the_post_thumbnail_url( $blog_id, 'full' ) ) . ')"';
		elseif ( ! is_home() && ! is_search() && ! is_archive() && get_the_post_thumbnail( $_post->ID ) && $key_value ) : // Pages & Posts that have a featured image with checkbox checked.
			echo ' style="background-image:url(' . esc_url( get_the_post_thumbnail_url( $_post->ID, 'full' ) ) . ')"';
		else :
			echo ' style="background-image:url(' . esc_url( get_header_image() ) . ')"';
		endif;
	}
}


if ( ! function_exists( 'kelso_customheader_content' ) ) {
	/**
	 * Put Video or Header Image and the Text into the Custom Header.
	 */
	function kelso_customheader_content() {

		if ( ! is_front_page() ) :
			return;
		endif;

		// Get Customizer options.
		$kelso_settings = wp_parse_args(
			get_option( 'kelso_settings', array() ),
			kelso_get_defaults()
		);

		$herotextprimary = $kelso_settings['hero_text_primary'];
		$herotextsecondary = $kelso_settings['hero_text_secondary'];
		?>

		<?php
		// Get the video if there is one.
		if ( is_header_video_active() && ( has_header_video() || is_customize_preview() ) ) {
		?>
			<div class="custom-header-media">
				<?php the_custom_header_markup(); ?>
			</div>
		<?php } ?>

		<div class="custom-header-image-text">
			<?php if ( '' !== $herotextprimary ) : ?>
				<div class="hero-primary"><?php echo esc_html( $herotextprimary ); ?></div>
			<?php endif; ?>
			<?php if ( '' !== $herotextsecondary ) : ?>
				<div class="hero-secondary"><?php echo esc_html( $herotextsecondary ); ?></div>
			<?php endif; ?>
		</div>
		<?php
	}
}
