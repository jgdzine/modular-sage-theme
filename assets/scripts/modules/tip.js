/**
 *
 * 	(tool)Tip
 *
 */

;(function($){

	var Tip = function( tip ){

		this.tip = tip;

		this.trigger = this.tip.find('[data-tip-trigger]');

		this.closer = this.tip.find('[data-tip-closer]');

		this.breakpoint = 780;

		this.bindEvents();

	};


	Tip.prototype.bindEvents = function() {



		var _this = this;

		this.trigger.on( 'click', $.proxy( this.openTip, this ) );

		this.closer.on( 'click', $.proxy( this.closeTip, this ) );

		$('body').click(function( event ) {
			var isInsideTooltip = $(event.target).closest('[data-tip]').length === 0,
				isAboveBreakpoint = $(window).outerWidth() > _this.breakpoint;

			if ( isInsideTooltip && isAboveBreakpoint ) {
		        _this.closeTip();
		    }

		});

	};


	Tip.prototype.openTip = function() {
		var isAboveBreakpoint = $(window).outerWidth() > this.breakpoint;

        if ('ontouchstart' in window) {
           $('[data-tip].is-visible').removeClass('is-visible');
            this.tip.toggleClass('is-visible');
        }

		if ( !isAboveBreakpoint ) {
			this.tip.addClass('is-visible');
			$('body').css('overflow', 'hidden');
		}
	};


	Tip.prototype.closeTip = function() {

		this.tip.removeClass('is-visible');
		$('body').css('overflow', '');

	};


	/**
	 * Instantiate the Tip object on document ready
	 */
	$(function(){
		var triggers = $('[data-tip]');

		triggers.each( function() {

			new Tip( $(this) );

		});
	});
}(jQuery));
