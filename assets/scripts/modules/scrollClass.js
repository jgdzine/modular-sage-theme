/**
 *
 *		ScrollClass
 *
 */

;(function($){

    'use strict';

    var ScrollClass = function( module ) {

        this.ELEMENTS = {
            module: module
        };

        this.SETTINGS = {
            className: 'is-in-view',
            scrollTop: $(window).scrollTop(),
            moduleOffsetTop: module.offset().top,
            moduleHeight: module.height(),
            viewportHeight: $(window).outerHeight()
        };

        this.bindEvents();
        this.measureAll();
    };



    ScrollClass.prototype.bindEvents = function() {

        this.timer = setInterval( $.proxy( this.checkScroll, this ), 200 );

        $(window).on( 'resize', $.proxy( this.measureAll, this ) );


    };


    ScrollClass.prototype.checkScroll = function() {

        var moduleOffsetTop = this.SETTINGS.moduleOffsetTop,
            viewportHeight = this.SETTINGS.viewportHeight,
            moduleHeight = this.SETTINGS.moduleHeight,
            activationValue;

        // trigger: .6 the height of the viewport height
        activationValue = moduleOffsetTop - (viewportHeight * 0.6);

        this.SETTINGS.scrollTop = $(window).scrollTop();

        if ( this.SETTINGS.scrollTop >= activationValue ) {

            this.ELEMENTS.module.addClass( this.SETTINGS.className );
            this.stopTimer();

        }

    };


    ScrollClass.prototype.measureAll = function () {

        var $win = $(window);

        this.SETTINGS.scrollTop       = $win.scrollTop();
        this.SETTINGS.viewportHeight  = $win.outerHeight();
        this.SETTINGS.moduleHeight    = this.ELEMENTS.module.height();
        this.SETTINGS.moduleOffsetTop = this.ELEMENTS.module.offset().top;

    };


    // Get rid of the timer once this image is loaded. No memory leaks pls.
    ScrollClass.prototype.stopTimer = function() {

        clearInterval(this.timer);
        this.timer = null;

    };



    $(function(){

        // Adding an arbitrary .5s before instantiating for better
        // measurements with images loading. Didn't want to force it to wait
        // for all images in case something gets stuck content will be hidden,
        // but ~.5 seconds should give us plenty of time in most cases.
        window.setTimeout(function(){
            var scrollClassModules = $('[data-scroll-class]');

            scrollClassModules.each( function() {

                new ScrollClass( $(this) );

            });
        }, 500);

    });



}(jQuery));