<?php
/**
 * Customize Range Slider.
 *
 * @package  osixthreeo
 * @subpackage osixthreeo/inc/customizer
 * @author   Chip Sheppard
 * @since    1.2.0
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Osixthreeo_Range_Control' ) ) :
	/**
	 * Creates HTML section in customizer.
	 */
	class Osixthreeo_Range_Control extends WP_Customize_Control {

		/**
		 * Official control name.
		 *
		 * @var $type string.
		 */
		public $type = 'custom_range';

		/**
		 * Enqueue the JS.
		 */
		public function enqueue() {
			wp_enqueue_script(
				'osixthreeo-range-control-js',
				get_template_directory_uri() . '/assets/js/customize-range-control.js',
				array( 'jquery' ),
				OSIXTHREEO_VERSION,
				true
			);
		}

		/**
		 * Write the HTML.
		 */
		public function render_content() {
			?>
			<label>
				<?php if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>
				<div class="osixthreeo-range-text">pixels</div>
				<div class="osixthreeo-range-value"><?php echo esc_attr( $this->value() ); ?></div>
				<input data-input-type="range" type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
				<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
			</label>
			<?php
		}
	}
endif;
