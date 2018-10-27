jQuery(window).load(function() {
	var container = document.querySelector('.loop-wrap');
	var msnry = new Masonry( container, {
		itemSelector: '.hentry',
		columnWidth: '.hentry',
	});
});
