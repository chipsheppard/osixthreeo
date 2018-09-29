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
