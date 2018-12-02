/**
 *
 * Testimonial Load More
 *
 */

;(function($){

        var $button = $('.button.load--more');
        var $grid = $('.grid--loadmore');
        var $hiddenCustomers = $('.grid--loadmore .with--initially-hidden');

        $button.click(function() {
            $button.text('Loading...');
            $hiddenCustomers.removeClass("with--visually-hidden");

            setTimeout(function() {
                $button.remove();
                $grid.addClass("all-active");
            }, 400);
        });

}(jQuery));
