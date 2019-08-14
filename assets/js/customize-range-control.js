/**
 * Customizer Range slider JS
 *
 * @package  osixthreeo
 * @subpackage osixthreeo/assets/js
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

(function ($) {
    $(document).ready(function ($) {
        $('input[data-input-type]').on('input change', function () {
            var val = $(this).val();
            $(this).prev('.osixthreeo-range-value').html(val);
            $(this).val(val);
        });
    });
})(jQuery);
