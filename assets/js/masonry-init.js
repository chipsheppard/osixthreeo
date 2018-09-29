jQuery(window).load(function() {
	// MASSONRY Without jquery
	var container = document.querySelector('.archive-content');
	var msnry = new Masonry( container, {
		itemSelector: '.hentry',
		columnWidth: '.hentry',
	});
});
