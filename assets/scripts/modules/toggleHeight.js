/**
 *
 * Toggle Height
 *
 * 	 Instantiate this class on all [data-toggle-height] elements. This will bind
 * 	 an event on the [data-toggle-height-trigger] element within it. When clicked
 * 	 it will animate the opening of the [data-toggle-height-content] element. This
 * 	 is a more-reliable way to consistently animate height than CSS gives us.
 *
 * 	 Should someone be resizing their browser in/out of this breakpoint CSS will
 * 	 override this with `height: auto !important` so that it will always be visible
 * 	 above the breakpoint.
 *
 * 	 Also, we will reset `height: auto;` on elements when the animation is
 * 	 complete so that any resize within this breakpoint will automatically.
 *
 */

;(function($){
	var ToggleHeight = function( parent ){

		this.parent = $(parent);
		this.trigger = this.parent.find('[data-toggle-height-trigger]');
		this.content = this.parent.find('[data-toggle-height-content]');
		this.contentHeight = this.content.outerHeight();

		this.windowWidth = $(window).outerWidth();
		this.windowHeight = $(window).outerHeight();

		// Close all of them after getting the height
		this.content.css('height', 0);

		this.bindEvents();
	};


	ToggleHeight.prototype.bindEvents = function(){
		var _this = this;

		this.trigger.on('click', $.proxy(this.toggle, this));

		//
		// Might be minor problems to resolve w/small screen window resizing
		//
		// window.setInterval(function(){
		// 	var windowWidth = $(window).outerWidth(),
		// 			windowHeight = $(window).outerHeight();
		//
		// 	if ((_this.windowWidth !== windowWidth) || (_this.windowHeight !== windowHeight)) {
		// 		_this.remeasureContent();
		// 	}
		//
		// }, 200);
	};


	ToggleHeight.prototype.toggle = function( event ){
		var currentHeight = this.content.outerHeight();

		if(currentHeight < 1) {
			this.open();
		} else {
			this.close();
		}
	};


	ToggleHeight.prototype.open = function() {
		this.content.animate({
			height: this.contentHeight
		}, 100, function(){
			$(this).css('height', '');
		});

		// Toggles active state on the trigger element with CSS
		this.parent.addClass('is-open');
	};


	ToggleHeight.prototype.close = function() {
		this.content.animate({
			height: 0
		}, 100);

		// Toggles active state on the trigger element with CSS
		this.parent.removeClass('is-open');
	};


	// ToggleHeight.prototype.remeasureContent = function() {
	//
	// };


	/**
	 * Instantiate each ToggleHeight object on document ready
	 */
	$(function(){

		var $parent = $('[data-toggle-height]');

		$parent.each( function( index, element) {
			new ToggleHeight( $(element) );
	    });

	});
}(jQuery));
