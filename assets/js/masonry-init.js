jQuery(window).load(function() {
	// MASSONRY Without jquery
	var container = document.querySelector('.do-masonry');
	var msnry = new Masonry( container, {
		itemSelector: '.hentry',
		columnWidth: '.hentry',
	});
});
