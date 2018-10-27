/**
 * Navigation
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus. Mostly swiped from TwentySeventeen :)
 */
!function(a){function e(e){
// Add dropdown toggle that displays child menu items.
var n=a("<button />",{class:"dropdown-toggle","aria-expanded":!1}).append(a("<span />",{class:"screen-reader-text",text:"Expand child menu"}));e.find(".menu-item-has-children > a, .page_item_has_children > a").after(n),
// Set the active submenu dropdown toggle button initial state.
e.find(".current-menu-ancestor > button").addClass("not-toggled").attr("aria-expanded","false").find(".screen-reader-text").text("Expand child menu"),
// Set the active submenu initial state.
e.find(".current-menu-ancestor > .sub-menu").addClass("not-toggled"),e.find(".dropdown-toggle").click(function(e){var n=a(this),t=n.find(".screen-reader-text");e.preventDefault(),n.toggleClass("toggled-on"),n.next(".children, .sub-menu").toggleClass("toggled-on"),n.attr("aria-expanded","false"===n.attr("aria-expanded")?"true":"false"),t.text("Expand child menu"===t.text()?"Collapse child menu":"Expand child menu")})}var n,t,o,s;e(a(".site-navigation, .topbar-widget.widget_nav_menu")),n=a("#masthead"),t=n.find(".responsive-menu-icon"),o=n.find(".site-navigation"),s=n.find(".site-navigation > div > ul"),
// Return early if menuToggle is missing.
t.length&&(
// Add an initial value for the attribute.
t.attr("aria-expanded","false"),t.on("click",function(){o.toggleClass("toggled-on"),a(this).attr("aria-expanded",o.hasClass("toggled-on"))})),
// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
function(){
// Toggle `focus` class to allow submenu access on tablets.
function e(){"none"===a(".responsive-menu-icon").css("display")?(a(document.body).on("touchstart",function(e){a(e.target).closest(".site-navigation li").length||a(".site-navigation li").removeClass("focus")}),s.find(".menu-item-has-children > a, .page_item_has_children > a").on("touchstart",function(e){var n=a(this).parent("li");n.hasClass("focus")||(e.preventDefault(),n.toggleClass("focus"),n.siblings(".focus").removeClass("focus"))})):s.find(".menu-item-has-children > a, .page_item_has_children > a").unbind("touchstart")}s.length&&s.children().length&&("ontouchstart"in window&&(a(window).on("resize",e),e()),s.find("a").on("focus blur",function(){a(this).parents(".menu-item, .page_item").toggleClass("focus")}))}()}(jQuery),
/* Parallax */
jQuery(function(e){e(window).scroll(function(){e(".custom-header-image").css("background-position","center "+(50+-.125*e(this).scrollTop())+"%")}).scroll()}),
/* Sticky nav */
jQuery(function(e){var n=e(".header-wrap").offset();
// On load
e(document).scrollTop()>n.top&&e(".header-wrap").addClass("stuck"),
// On scroll
e(document).on("scroll",function(){e(document).scrollTop()>n.top?e(".header-wrap").addClass("stuck"):e(".header-wrap").removeClass("stuck")})}),
/* Back to top */
jQuery(function(e){e(".backtotop").click(function(){return e("html, body").animate({scrollTop:0},"slow"),!1})}),
/* Smooth scroll homebutton */
jQuery(function(t){
// Select all links for targeting
t(".scrollbutton").click(function(e){
// On-page links
if(location.pathname.replace(/^\//,"")===this.pathname.replace(/^\//,"")&&location.hostname===this.hostname){
// Figure out element to scroll to
var n=t(this.hash);
// Does a scroll target exist?
(n=n.length?n:t("[name="+this.hash.slice(1)+"]")).length&&(
// Only prevent default if animation is actually gonna happen
e.preventDefault(),t("html, body").animate({scrollTop:n.offset().top},600,function(){
// Callback after animation
// Must change focus!
var e=t(n);if(e.focus(),e.is(":focus"))// Checking if the target was focused
return!1;e.attr("tabindex","-1"),// Adding tabindex for elements not focusable
e.focus()}))}})});