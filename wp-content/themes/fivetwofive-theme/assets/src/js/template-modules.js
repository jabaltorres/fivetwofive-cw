(function($){
    'use strict';

    var announcementModule = (function(){
        function makeSticky() {
            if( $('.module-announcement').hasClass('js-is-sticky-yes') ) {
                var height = $('.module-announcement').outerHeight(true);
                $('.module-announcement').wrap('<div class="sticky-announcement-spacer"></div>');
                $('.sticky-announcement-spacer').css({ "height" : height });
                $('body').prepend($('.sticky-announcement-spacer'));
            }
        }

        function closeModule() {
            $('.module-announcement__close').click(function(e) {
                e.preventDefault();
                $(this).parent('.module-announcement').slideUp(400);

                if($('.sticky-announcement-spacer').length) {
                    $('.sticky-announcement-spacer').slideUp(400);
                }
            });
        }

        function init() {
            makeSticky();
            closeModule();
        }

        return {
            init: init
        };
    })();

    $(function() {
        announcementModule.init();
    });

})(jQuery);