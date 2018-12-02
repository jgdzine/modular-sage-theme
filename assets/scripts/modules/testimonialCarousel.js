/**
 *
 * TestimonialCarousel
 *
 */

;(function($){
	var TestimonialCarousel = function( carousel ){

		this.carousel = carousel;
		this.countCurrent = carousel.parent().find('[data-carousel-count-current]');
		this.countTotal = carousel.parent().find('[data-carousel-count-total]');
		this.prev = carousel.find('[data-carousel-prev]');
		this.next = carousel.find('[data-carousel-next]');

		this.options = {
			arrows: false,
			fade: true,
			slide: '[data-carousel-slide]'
		};

		this.init().bindEvents();
	};


	TestimonialCarousel.prototype.init = function(){
		var _this = this;

		this.carousel.slick( this.options );

		this.countTotal.html( this.carousel.find('[data-carousel-slide]').length );

		return this;
	};


	TestimonialCarousel.prototype.bindEvents = function() {
		var _this = this;

		this.carousel.on( 'afterChange', $.proxy(this.update, this) );

		this.carousel.on('beforeChange', function(event, slick, currentSlide){
			$(_this.carousel.find('.slick-slide')[ currentSlide ]).addClass('is-out');
		});

		this.carousel.on('afterChange', function(event, slick, currentSlide){
			_this.carousel.find('.slick-slide.is-out').removeClass('is-out');
		});

		this.prev.on('click', function(){
			_this.carousel.slick('slickPrev');
		});

		this.next.on('click', function(){
			_this.carousel.slick('slickNext');
		});
	};


	TestimonialCarousel.prototype.update = function(event, slick, currentSlide){
		this.countCurrent.html( currentSlide + 1 );
	};


	/**
	 * Instantiate the TestimonialCarousel object on document ready
	 */
	$(function(){
		var $carousel = $('[data-carousel]');

		$carousel.each( function( index, element) {
			new TestimonialCarousel( $(element) );
	    });
	});
}(jQuery));
