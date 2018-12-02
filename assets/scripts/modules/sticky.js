/**
 *
 * 	Sticky
 *
 */

;(function($){
    $('[data-sticky]').Stickyfill();

    'use strict';

    var Sticky = function( stickyItem ) {

        this.stickyItem = stickyItem;

        this.distFromTop = 0;
        this.itemTopPosition = 0;
        this.triggerPoint = 0;

        this.stickyItem.Stickyfill();

        this.bindEvents();
        this.measureAll();
    };


    Sticky.prototype.bindEvents = function() {

        this.timer = setInterval( $.proxy( this.checkScroll, this ), 50 );

        $(window).on( 'resize', $.proxy( this.measureAll, this ) );

    };

    Sticky.prototype.measureAll = function() {

        this.distFromTop = this.stickyItem.offset().top;
        this.itemTopPosition = parseInt(this.stickyItem.css('top'), 10);
        this.triggerPoint = this.distFromTop - (this.itemTopPosition/2);

        this.checkScroll();
    };


    Sticky.prototype.checkScroll = function () {

        var scrollTop = $(window).scrollTop();

        if( scrollTop >= this.triggerPoint ) {
            this.stickyItem.addClass('is-stuck');
        } else {
            this.stickyItem.removeClass('is-stuck');
        }

    };

    $(function(){
        var stickyItem = $('[data-sticky]');

        stickyItem.each( function() {
            new Sticky( $(this) );
        });
    });
}(jQuery));

