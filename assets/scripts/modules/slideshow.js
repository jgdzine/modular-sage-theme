/**
 *
 * Slideshow
 *
 * 		Image slideshow when more than one image is entered
 *
 */

;(function($){
	'use strict';

	var Slideshow = function( slideshow ) {

		this.slideshow = slideshow;

		this.parent = this.slideshow.closest('[data-slideshow-outer]');
		this.slides = this.slideshow.find('[data-slideshow-slide]');
		this.currentSlide = 0;

		this.prev = this.parent.find('[data-slideshow-prev]');
		this.next = this.parent.find('[data-slideshow-next]');

		this.countCurrent = this.parent.find('[data-slideshow-count="current"]');
		this.countTotal = this.parent.find('[data-slideshow-count="total"]');
		this.resizeTimer;

		this.init().bindEvents();
	};

	Slideshow.prototype.init = function(){
		this.countTotal.html( this.slideshow.find('[data-slideshow-slide]').length );
		$(this.slides[this.currentSlide]).addClass('active');
		return this;
	};

	Slideshow.prototype.bindEvents = function(){

		this.prev.on('click', $.proxy(this.prevSlide, this));
		this.next.on('click', $.proxy(this.nextSlide, this));

		$(window).on('load resize', function(e) {
			clearTimeout(this.resizeTimer);
			this.resizeTimer = setTimeout(function() {
				var slideHeights = $('.slideshow--slide picture img').map(function(){
						return $(this).height();
				});
				var tallest = Array.from(slideHeights).reduce(function(a, b) {
				    return Math.max(a, b);
				});
				$('.slideshow, .slideshow--slide picture').height(tallest);

			}, 250);

		});

	};

	Slideshow.prototype.prevSlide = function(){
		$(this.slides[this.currentSlide]).removeClass('active');
		if(this.currentSlide > 0){
			this.currentSlide -= 1;
		}
		else{
			this.currentSlide = this.slides.length - 1;
		}
		$(this.slides[this.currentSlide]).addClass('active');
		this.countCurrent.html( this.currentSlide + 1 );
	};


	Slideshow.prototype.nextSlide = function(){
		$(this.slides[this.currentSlide]).removeClass('active');
		if(this.currentSlide < this.slides.length - 1){
			this.currentSlide += 1;
		}
		else{
			this.currentSlide = 0;
		}
		$(this.slides[this.currentSlide]).addClass('active');
		this.countCurrent.html( this.currentSlide + 1 );
	};

	$(function(){

		var slideshows = $('[data-image-slideshow]');

		slideshows.each( function() {

			new Slideshow( $(this) );

		});

	});
}(jQuery));
