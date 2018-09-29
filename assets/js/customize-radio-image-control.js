/**
 * Customizer Radio Image
 */
jQuery(document).ready(function () {
    jQuery('#kelso-img-container.controls label img').click(function () {
        jQuery(this).parents('#kelso-img-container.controls').find('img').removeClass('kelso-radio-img-selected');
        jQuery(this).addClass('kelso-radio-img-selected');
    });
});
