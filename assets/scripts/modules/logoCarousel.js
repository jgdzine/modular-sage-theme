

/**
 *
 * LogoCarousel
 *
 */

;(function($){
	var LogoCarousel = function( carousel ){

		this.carousel = carousel;

		this.options = {
			"fade": true,
			"autoplay": true,
			"autoplaySpeed": 2000,
			"arrows": false,
			"draggable": false,
			"pauseOnFocus": false,
			"pauseOnHover": false,
			"speed": 200,
			"touchMove": false
		};

		this.init();
	};


	LogoCarousel.prototype.init = function(){

		this.carousel.slick( this.options );

	};


	/**
	 * Instantiate the LogoCarousel object on document ready
	 */
	$(function(){
		var $carousel = $('[data-logo-carousel]');

		$carousel.each( function( index, element) {
			new LogoCarousel( $(element) );
	    });
	});
}(jQuery));
