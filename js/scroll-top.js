jQuery(document).ready(function($) {
	var upperScrollLimit = 200;
	var scrollElem = $('div#scroll-to-top');
	scrollElem.hide();
	// Show/hide based on scroll position
	$(window).scroll(function () {
		var scrollTop = $(document).scrollTop();
		if (scrollTop > upperScrollLimit) {
			// fade in
			$(scrollElem).stop().fadeTo(250, 0.8);
			// dim after 5 sec
			clearTimeout($.data(this, 'sttScrollTimer'));
			$.data(this, 'sttScrollTimer', setTimeout(function() {
				$(scrollElem).stop().fadeTo(250, 0.2);
			}, 4500));
		} else {
			// fade out and hide
			clearTimeout($.data(this, 'sttScrollTimer'));
			$(scrollElem).stop().fadeTo(250, 0, function(){scrollElem.hide()});
		}
	});
	// Scroll to top on click
	$(scrollElem).click(function(){
		$('html, body').animate({scrollTop:0}, 500);
		return false;
	});
})