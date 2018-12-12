/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 *
 * @package  osixthreeo
 * @subpackage osixthreeo/assets/js
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */
!function(){var e=-1<navigator.userAgent.toLowerCase().indexOf("webkit"),t=-1<navigator.userAgent.toLowerCase().indexOf("opera"),n=-1<navigator.userAgent.toLowerCase().indexOf("msie");(e||t||n)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var e=location.hash.substring(1),t;/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1)}();