/**
 * Global JS functions
 *
 * Handles parallax headers - Sticky Nav - Back to Top
 */

// Parallax
jQuery(function( $ ){
	$( window ).scroll(function() {
		$('.custom-header-image').css('background-position', 'center ' + (50 + $(this).scrollTop()*-0.125) + '%');
	}).scroll();
});

// Sticky nav
jQuery(function( $ ){
	// On load
	if( $( document ).scrollTop() > 0 ){
		$( '.header-wrap' ).addClass( 'stuck' );
	}
	// On scroll
	$( document ).on('scroll', function(){

		if ( $( document ).scrollTop() > 0 ){
			$( '.header-wrap' ).addClass( 'stuck' );
		} else {
			$( '.header-wrap' ).removeClass( 'stuck' );
		}
	});
});

// Back to top
jQuery(function( $ ){
	$( '.backtotop' ).click(function() {
		$( 'html, body' ).animate({ scrollTop: 0 }, 'slow');
		return false;
	});
});

// Smooth scroll homebutton
jQuery(function( $ ){
	// Select all links for targeting
	$('.scrollbutton')
	.click(function(event) {
	// On-page links
		if (
			location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
			&&
			location.hostname == this.hostname
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
					};
				});
			}
		}
	});
});
