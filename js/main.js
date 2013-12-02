(function ($) {
	$( document ).ready(function() {
		$("#navigation").children('.menu-responsive').attr('data-breakpoint', 800).flexNav({'hoverIntent': true});
	});
	
}(jQuery));