(function ($) {
    'use strict';

    var $window = $(window);


    /**
    * Document ready (jQuery)
    */
    $(function () {
        $('.wpz_pattern_16 .wp-block-query li .wp-block-group__inner-container, .wpz_pattern_17 .wp-block-query li .wp-block-group__inner-container').each(function(){
           $(this).children().not(':last').wrapAll("<div class='wpz-posts-inner-info'></div>");

        });
    });


})(jQuery);