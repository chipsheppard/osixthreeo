/**
 * Customizer JS
 *
 * @package  osixthreeo
 * @subpackage osixthreeo/assets/js
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */
!function(t){wp.customize("blogname",function(e){e.bind(function(e){t(".site-title a").text(e)})}),wp.customize("blogdescription",function(e){e.bind(function(e){t(".site-description").text(e)})}),wp.customize("header_textcolor",function(e){e.bind(function(e){"blank"===e?t(".site-title, .site-description").css({clip:"rect(1px, 1px, 1px, 1px)",position:"absolute"}):(t(".site-title, .site-description").css({clip:"auto",position:"relative"}),t(".site-title a, .site-description").css({color:e}))})}),wp.customize("osixthreeo_settings[global_width_setting]",function(e){e.bind(function(e){"full"===e&&t("body").removeClass("contained"),"contained"===e&&t("body").addClass("contained")})}),wp.customize("osixthreeo_settings[header_layout]",function(e){e.bind(function(e){"headernormal"===e&&t("body").removeClass("headercentered"),"headercentered"===e&&t("body").addClass("headercentered")})}),wp.customize("osixthreeo_settings[content_contain]",function(e){e.bind(function(e){e?t("body").addClass("contentcontained"):t("body").removeClass("contentcontained")})})}(jQuery);