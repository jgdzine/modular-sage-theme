/**
 *
 * HeadroomManager calls the Headroom plugin on our header to add different
 * effects to our sticky header at different scroll points.
 *
 */

;(function($){
	$(window).on('keyup', function( event ) {
		var isVisible = $('#gridOverlay').css('opacity') === "1";

		if ( event.keyCode === 71 ) {
			if ( isVisible ) {
				$('#gridOverlay').css('opacity', 0);
			} else {
				$('#gridOverlay').css('opacity', 1);
			}
		}

	});
}(jQuery));
