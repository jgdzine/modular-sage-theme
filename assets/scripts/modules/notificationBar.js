/**
 *
 * Notification Bar
 *
 */

;(function($){
    'use strict';

    var NotificationBar = function( parent, local ) {

        this.parent = parent;

        this.closer = parent.find('[data-notification-close]');

        this.bindEvents();

        this.hasSessionStorage = local;

        this.init();



    };



    NotificationBar.prototype.init = function(){
        var height = this.parent.outerHeight();
        $('body').css('margin-bottom' , height);
        if (this.hasSessionStorage ) {
            if (sessionStorage.getItem('showBanner') != "true") {
                sessionStorage.setItem('showBanner', true);
            }
        }
        // The element starts with a hidden class and is removed to slide it in
        this.parent.removeClass('is-hidden');
    };



    NotificationBar.prototype.bindEvents = function(){
        this.closer.on('click', $.proxy(this.closeBar, this));
    };


    NotificationBar.prototype.closeBar = function(){
        $('body').animate({ marginBottom: '0px' }, 500);
        if (this.hasSessionStorage ) {

            // Setting the cookie would go here.
            sessionStorage.setItem('showBanner', "false");

        }
        this.parent.addClass('is-hidden');


    };


    $(function(){
       function supports_html5_storage(){
           var mod = 'modernizr';
           try {
               sessionStorage.setItem(mod, mod);
               sessionStorage.removeItem(mod);
               return true;
           } catch(e) {
               return false;
           }
        }

        var notification = $('#notification');
        var show;
        if (supports_html5_storage()) {
            if (php_vars.notification_hash.localeCompare(sessionStorage.getItem('bannerHash')) === 0) {
                    show = sessionStorage.getItem('showBanner');
            } else {
                show = "true";
                sessionStorage.setItem('bannerHash', php_vars.notification_hash);
            }

            if (notification.length && show == "true") {
                new NotificationBar(notification, true);
            }

        } else {
            new NotificationBar(notification, false);
        }

    });
}( jQuery ));
