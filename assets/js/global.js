/**
 * Navigation
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus. Mostly swiped from TwentySeventeen :)
 */

(function( $ ) {
	var masthead, menuToggle, siteNavContain, siteNavigation;

	function initMainNavigation( container ) {

		// Add dropdown toggle that displays child menu items.
		var dropdownToggle = $( '<button />', { 'class': 'dropdown-toggle', 'aria-expanded': false })
			.append( $( '<span />', { 'class': 'screen-reader-text', 'text': 'Expand child menu' }) );

		container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( dropdownToggle );

		// Set the active submenu dropdown toggle button initial state.
		container.find( '.current-menu-ancestor > button' )
			.addClass( 'not-toggled' )
			.attr( 'aria-expanded', 'false' )
			.find( '.screen-reader-text' )
			.text( 'Expand child menu');
		// Set the active submenu initial state.
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'not-toggled' );

		container.find( '.dropdown-toggle' ).click( function( e ) {
			var _this = $( this ),
				screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );

			screenReaderSpan.text( screenReaderSpan.text() === 'Expand child menu' ? 'Collapse child menu' : 'Expand child menu' );
		});
	}

	initMainNavigation( $( '.site-navigation, .topbar-widget.widget_nav_menu' ) );

	masthead       = $( '#masthead' );
	menuToggle     = masthead.find( '.responsive-menu-icon' );
	siteNavContain = masthead.find( '.site-navigation' );
	siteNavigation = masthead.find( '.site-navigation > div > ul' );

	// Enable menuToggle.
	(function() {

		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}

		// Add an initial value for the attribute.
		menuToggle.attr( 'aria-expanded', 'false' );

		menuToggle.on( 'click', function() {
			siteNavContain.toggleClass( 'toggled-on' );

			$( this ).attr( 'aria-expanded', siteNavContain.hasClass( 'toggled-on' ) );
		});
	})();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	(function() {
		if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( 'none' === $( '.responsive-menu-icon' ).css( 'display' ) ) {

				$( document.body ).on( 'touchstart', function( e ) {
					if ( ! $( e.target ).closest( '.site-navigation li' ).length ) {
						$( '.site-navigation li' ).removeClass( 'focus' );
					}
				});

				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' )
					.on( 'touchstart', function( e ) {
						var el = $( this ).parent( 'li' );

						if ( ! el.hasClass( 'focus' ) ) {
							e.preventDefault();
							el.toggleClass( 'focus' );
							el.siblings( '.focus' ).removeClass( 'focus' );
						}
					});

			} else {
				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		siteNavigation.find( 'a' ).on( 'focus blur', function() {
			$( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
		});
	})();
})( jQuery );


 /**
  * Parallax
 */
jQuery(function( $ ){
	$( window ).scroll(function() {
		$('.custom-header-image').css('background-position', 'center ' + (50 + $(this).scrollTop()*-0.125) + '%');
	}).scroll();
});


/**
 * Sticky nav
 */
jQuery(function( $ ){
	var headerposition = $('.header-wrap').offset();
	// On load
	if( $( document ).scrollTop() > headerposition.top ){
		$( '.header-wrap' ).addClass( 'stuck' );
	}
	// On scroll
	$( document ).on('scroll', function(){

		if ( $( document ).scrollTop() > headerposition.top ){
			$( '.header-wrap' ).addClass( 'stuck' );
		} else {
			$( '.header-wrap' ).removeClass( 'stuck' );
		}
	});
});


/**
 * Back to top
 */
jQuery(function( $ ){
	$( '.backtotop' ).click(function() {
		$( 'html, body' ).animate({ scrollTop: 0 }, 'slow');
		return false;
	});
});


/**
 * Smooth scroll homebutton
 */
jQuery(function( $ ){
	// Select all links for targeting
	$('.scrollbutton')
	.click(function(event) {
	// On-page links
		if (
			location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname
		) {
		// Figure out element to scroll to
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			// Does a scroll target exist?
			if (target.length) {
				// Only prevent default if animation is actually gonna happen
				event.preventDefault();
				$('html, body').animate({
				  scrollTop: target.offset().top
			  }, 600, function() {
					// Callback after animation
					// Must change focus!
					var $target = $(target);
					$target.focus();
					if ($target.is(":focus")) { // Checking if the target was focused
						return false;
					} else {
						$target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
						$target.focus(); // Set focus again
					}
				});
			}
		}
	});
});
