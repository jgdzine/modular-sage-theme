/**
 *
 * Ajax load more
 *
 */

;(function($){


        var linkNW = $('a[data-link-new-window]');
        var dest = linkNW.attr("data-link-new-window");
        var nWWidth = linkNW.attr("data-new-window-width");
        var nWHeight = linkNW.attr("data-new-window-height");
        var newWindowAtts = 'width=' + nWWidth + ',height=' + nWHeight;

        $(linkNW).click(function(e){
          e.preventDefault();
          window.open(dest, 'ExternalLinkWindow', newWindowAtts);
        });


}(jQuery));
