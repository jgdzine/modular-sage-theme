/**
 *
 * Poster
 *
 */
;var c42 = c42 || {};
(function ($) {
    
    c42.populatePoster = function (customer) {
        
        if (customer.logo && customer.logo.startsWith('<svg')) {
            $('#posterLogo').html(customer.logo);
        } else {
            $('#posterLogo').html('<img class="logo__image" src="' + customer.fallbackImage + '" alt="' + customer.name + ' logo">');
        }
        $('#poster').css('background-image', 'url(' + customer.background + ')');
        $('#posterName').html(customer.name);
    };

    $(document).ready(function () {
        if (typeof c42.poster_data === 'object' && c42.poster_data){
            var customer = c42.poster_data[Math.floor(Math.random() * c42.poster_data.length)];
            c42.populatePoster(customer);
        }
        else if (typeof poster_data === 'object' && poster_data){
            var customer = poster_data[Math.floor(Math.random() * poster_data.length)];
            c42.populatePoster(customer);
        }
    });
}(jQuery));