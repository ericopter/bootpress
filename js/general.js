$(document).ready(function() {
	// calculate distance from top
	var topHeight = $('#site-header').outerHeight();
	
	if ($('#title-bar:visible')) {
		topHeight += $('#title-bar').outerHeight();
	};
	
	$('#side-nav').affix({
		offset: {
			top : topHeight,
			bottom : function() { return $('#site-footer').height() }
		}
	});
});