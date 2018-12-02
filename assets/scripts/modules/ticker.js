/**
 *
 * Ticker
 *
 *		Continuous logo parade in customers dropdown
 *
 * 		@todo
 * 		Change marginLeft to translateX for better performance
 *
 */

 // polyfill
 window.requestAnimationFrame = (function(){
	 return  window.requestAnimationFrame       ||
			 window.webkitRequestAnimationFrame ||
			 window.mozRequestAnimationFrame    ||

	 function( callback ){
		 window.setTimeout(callback, 1000 / 60);
	 };
 })();

;(function($){
	$(function(){

		var speed = 5000;

		(function ticker(){
		    var itemWidth = $('[ticker-item]:first-child').outerWidth();

			//
			// In order to change margin to translateX we need to change animate to css
			// and figure out a new timing and callback structure here
			//
	    $("[data-ticker] > div").animate({
				marginLeft: -itemWidth
			}, speed, 'linear', function(){
			$(this).css({
				marginLeft: 0
			}).find("[ticker-item]:last").after($(this).find("[ticker-item]:first"));
        });

		    requestAnimationFrame(ticker);
		})();

	});
}(jQuery));
