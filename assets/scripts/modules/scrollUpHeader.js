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

        this.header = header;

        this.utilityNav = header.find('#utilityNav');

        // this.offset = $(window).outerHeight() * .8;
        this.offset = 500;

        this.hasPassedOffset = false;

        this.timer = null;

        this.bindEvents();
    };


    HeadroomManager.prototype.bindEvents = function(){
        var _this = this;

        this.timer = window.setInterval( $.proxy( _this.checkScroll, _this ), 50);
    };


    HeadroomManager.prototype.checkScroll = function() {
        var currentScrolltop = $(window).scrollTop(),
            headerHeight = this.header.outerHeight(),
            translateValue = (this.utilityNav.outerHeight() / headerHeight) * 100,
            isPassedOffset = (currentScrolltop > this.offset),
            // This is if we've scrolled beyond the offset but are returning up to the top
            isReturningHome = ((currentScrolltop < this.offset) && this.hasPassedOffset === true);

        // Slide the whole nav up after we scroll past so that we can slide it in
        if ( currentScrolltop > headerHeight ) {
            this.header.addClass('is-below-header');
        } else {
            this.header.removeClass('is-below-header');
        }

        if ( (currentScrolltop !== 0) && (isPassedOffset || isReturningHome) ) {
            this.header.addClass('is-fixed');
            this.header.css({
                '-webkit-transform': 'translateY(-' + translateValue + '%)',
                '-moz-transform': 'translateY(-' + translateValue + '%)',
                '-ms-transform': 'translateY(-' + translateValue + '%)',
                '-o-transform': 'translateY(-' + translateValue + '%)',
                'transform': 'translateY(-' + translateValue + '%)'
            });
            this.hasPassedOffset = true;
        } else {
            this.header.removeClass('is-fixed');
            this.header.css({
                '-webkit-transform': '',
                '-moz-transform': '',
                '-ms-transform': '',
                '-o-transform': '',
                'transform': ''
            });
            this.hasPassedOffset = false;
        }

    };


    HeadroomManager.prototype.onTop = function(){};


    HeadroomManager.prototype.onNotTop = function(){};





    /**
     * Instantiate the HeadroomManager object on document ready
     */
    $(function(){
        var $header = $('#header');

        if ( $header.length ) {
            new HeadroomManager( $header );
        }
    });
}(jQuery));
