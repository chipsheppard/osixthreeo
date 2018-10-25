jQuery(window).load(function() {
	// MASSONRY Without jquery
	var container = document.querySelector('.loop-wrap');
	var msnry = new Masonry( container, {
		itemSelector: '.hentry',
		columnWidth: '.hentry',
	});
});
