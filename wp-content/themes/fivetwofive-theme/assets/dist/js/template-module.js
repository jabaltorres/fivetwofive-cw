(function ($) {
  'use strict';

  const announcementModule = (function () {
    const makeSticky = function() {
      if ($('.module-announcement').hasClass('js-is-sticky-yes')) {
        let height = $('.module-announcement').outerHeight(true);
        $('.module-announcement').wrap('<div class="sticky-announcement-spacer"></div>');
        $('.sticky-announcement-spacer').css({
          "height": height
        });
        $('body').prepend($('.sticky-announcement-spacer'));
      }
    }

    const closeModule = function() {
      $('.module-announcement__close').on( 'click', function (e) {
        e.preventDefault();
        $(this).parent('.module-announcement').slideUp(400);

        if ($('.sticky-announcement-spacer').length) {
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

  const testimonialCarouselModule = (function () {
    const init = function() {
      // eslint-disable-next-line no-undef
      new Swiper('.module-testimonials-carousel .swiper-container', {
        loop: true,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });
    }
    return {
      init: init
    }
  })();

  $(function () {
    announcementModule.init();
    testimonialCarouselModule.init();
  });

// eslint-disable-next-line no-undef
})(jQuery);
