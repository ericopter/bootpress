$(document).ready(function() {
	$('#side-nav').affix({
		offset: {
			top : function() { return $('#site-header').height() },
			bottom : function() { return $('#site-footer').height() }
		}
	});
});