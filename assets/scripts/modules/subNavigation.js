/**
 *
 *subNavigation adds information and functionally to anchor links to create a onepage scrolling interface
 *
 */

;(function($){


    'use strict';

    var Link = function( anchorItem ) {
        this.hash = anchorItem.attr("href");
        if($(this.hash).length == 0) {
            return;
        }
        this.anchorItem = anchorItem;


        this.distFromTop = 0;
        this.itemTopPosition = 0;
        this.triggerPoint = 0;

        this.bindEvents();
        this.measureAll();

    };


    Link.prototype.bindEvents = function() {

        this.anchorItem.on( 'click', $.proxy( this.onClick, this ) );
        this.timer = setInterval( $.proxy( this.onScroll , this ), 50 );

    };

    Link.prototype.measureAll = function() {



        var offset = parseInt($(this.hash).position().top);
        var currentLink = $(this.hash);
        var navOffset = parseInt(($("#header").length?$("#header").outerHeight():0)+($("#sub-nav").length?$("#sub-nav").outerHeight():0));


        this.distFromTop = offset;
        this.itemHeight = currentLink.innerHeight();
        this.triggerPoint = this.distFromTop - navOffset;


        this.onScroll();
    };


    Link.prototype.onScroll = function() {
        var scrollPos = $(window).scrollTop();


        if( scrollPos >= this.triggerPoint && this.triggerPoint + this.itemHeight > scrollPos ) {
            this.anchorItem.addClass('active');
        } else {
            this.anchorItem.removeClass('active');
        }

    };


    Link.prototype.onClick = function () {
        var currentItem = this.anchorItem;
        var currentSrollTo = this.triggerPoint;
        var target = this.hash;
        console.log(currentSrollTo);

        $(document).off("scroll");


        $('html, body').stop().animate({
            'scrollTop':   currentSrollTo
        }, 500, 'swing', function () {
            $('[data-anchor]').each(function () {
                $(this).removeClass('active');
            });
            $(currentItem).addClass('active');
            if(history.pushState) {
                history.pushState(null, null, target );
            }
            else {
                location.hash = target ;
            }
            $(document).on("scroll", this.onScroll);

        });

    };


    $( window ).load(function() {
        var anchor = $('[data-anchor]');

        anchor.each( function() {
            new Link( $(this) );

        });

    });
}(jQuery));
