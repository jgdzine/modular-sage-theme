/**
 *
 * HeadroomManager calls the Headroom plugin on our header to add different
 * effects to our sticky header at different scroll points.
 *
 */

;(function($){
	/**
	 * Set up HeadroomManager class to call on #header on document ready
	 */
	var HeadroomManager = function( header ){
		var _this = this,
			headroom,
			options;

		this.header = header;

		options = {
			offset: 200,
			classes : {
				initial : "headroom",
				pinned : "is-pinned",
				unpinned : "is-unpinned",
				top : "is-top",
				notTop : "is-not-top",
				bottom : "is-bottom",
				notBottom : "is-not-bottom"
			},
			onTop: $.proxy(this.showUtilityNav, _this),
			onNotTop: $.proxy(this.hideUtilityNav, _this)
		};


		headroom = new Headroom( this.header[0], options );

		headroom.init();

		this.bindEvents();
	};


	HeadroomManager.prototype.bindEvents = function(){
		// Handle updates to the UI when screen size changes
	};


	HeadroomManager.prototype.showUtilityNav = function(){
		this.header.css({
			'transform': 'translateY(0)'
		});
	};


	HeadroomManager.prototype.hideUtilityNav = function(){
		var utilityHeight = $('#headroomDisappear').outerHeight();

		this.header.css({
			'transform': 'translateY(-' + utilityHeight + 'px)'
		});
	};


	/**
	 * Instantiate the HeadroomManager object on document ready
	 */
	$(function(){
		var $header = $('#header');

		if ($header.length) {
			new HeadroomManager( $header );
		}
	});
}(jQuery));
