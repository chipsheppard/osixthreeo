/**
 * Alpha Color Picker JS
 *
 * This file includes several helper functions and the core control JS.
 *
 * @package  osixthreeo
 * @subpackage osixthreeo/assets/js
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */
function acp_get_alpha_value_from_color(a){var o;return(a=a.replace(/ /g,"")).match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)?(o=100*parseFloat(a.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)[1]).toFixed(2),o=parseInt(o)):o=100,o}function acp_update_alpha_value_on_color_control(a,o,l,e){var r,t,i;r=o.data("a8cIris"),t=o.data("wpWpColorPicker"),r._color._alpha=a,i=r._color.toString(),o.val(i),t.toggler.css({"background-color":i}),e&&acp_update_alpha_value_on_alpha_slider(a,l),o.wpColorPicker("color",i)}function acp_update_alpha_value_on_alpha_slider(a,o){o.slider("value",a),o.find(".ui-slider-handle").text(a.toString())}Color.prototype.toString=function(a){if("no-alpha"===a)return this.toCSS("rgba","1").replace(/\s+/g,"");if(1>this._alpha)return this.toCSS("rgba",this._alpha).replace(/\s+/g,"");var o=parseInt(this._color,10).toString(16);if(this.error)return"";if(o.length<6)for(var l=6-o.length-1;l>=0;l--)o="0"+o;return"#"+o},jQuery(document).ready(function(a){a(".alpha-color-control").each(function(){var o,l,e,r,t,i,c,n,p,_,d;o=a(this),l=o.val().replace(/\s+/g,""),e=o.attr("data-palette"),r=o.attr("data-show-opacity"),t=o.attr("data-default-color"),c={change:function(a,l){var e,r,i,c;e=o.attr("data-customize-setting-link"),r=o.wpColorPicker("color"),t===r&&(i=acp_get_alpha_value_from_color(r),p.find(".ui-slider-handle").text(i)),wp.customize(e,function(a){a.set(r)}),(c=n.find(".transparency")).css("background-color",l.color.toString("no-alpha"))},palettes:i=-1!==e.indexOf("|")?e.split("|"):"false"!==e},o.wpColorPicker(c),n=o.parents(".wp-picker-container:first"),a('<div class="alpha-color-picker-container"><div class="min-click-zone click-zone"></div><div class="max-click-zone click-zone"></div><div class="alpha-slider"></div><div class="transparency"></div></div>').appendTo(n.find(".wp-picker-holder")),p=n.find(".alpha-slider"),d={create:function(o,e){var r=a(this).slider("value");a(this).find(".ui-slider-handle").text(r),a(this).siblings(".transparency").css("background-color",l)},value:_=acp_get_alpha_value_from_color(l),range:"max",step:1,min:0,max:100,animate:300},p.slider(d),"true"===r&&p.find(".ui-slider-handle").addClass("show-opacity"),n.find(".min-click-zone").on("click",function(){acp_update_alpha_value_on_color_control(0,o,p,!0)}),n.find(".max-click-zone").on("click",function(){acp_update_alpha_value_on_color_control(100,o,p,!0)}),n.find(".iris-palette").on("click",function(){var l,e;acp_update_alpha_value_on_alpha_slider(e=acp_get_alpha_value_from_color(l=a(this).css("background-color")),p),100!==e&&(l=l.replace(/[^,]+(?=\))/,(e/100).toFixed(2))),o.wpColorPicker("color",l)}),n.find(".button.wp-picker-clear").on("click",function(){var a=o.attr("data-customize-setting-link");o.wpColorPicker("color","#ffffff"),wp.customize(a,function(a){a.set("")}),acp_update_alpha_value_on_alpha_slider(100,p)}),n.find(".button.wp-picker-default").on("click",function(){var a;acp_update_alpha_value_on_alpha_slider(acp_get_alpha_value_from_color(t),p)}),o.on("input",function(){var o,l;acp_update_alpha_value_on_alpha_slider(acp_get_alpha_value_from_color(a(this).val()),p)}),p.slider().on("slide",function(l,e){var r;acp_update_alpha_value_on_color_control(parseFloat(e.value)/100,o,p,!1),a(this).find(".ui-slider-handle").text(e.value)})})});