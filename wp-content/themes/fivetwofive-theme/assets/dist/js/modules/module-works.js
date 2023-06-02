"use strict";

(function ($) {
  'use strict';

  var workModule = function () {
    var init = function init(module) {
      if (hasForm(module)) {
        searchFilterInit(module);
      }
    };

    var hasForm = function hasForm(module) {
      return module.find('.ftf-form').length > 0;
    };

    var generateTokens = function generateTokens(module) {
      var items = module.find('.ftf_work');
      var tokens = [];

      if (items.length > 0) {
        items.each(function () {
          var item = $(this);
          var itemId = item.attr('id');
          var itemTermLinks = item.find('.card__categories a');
          var itemTitle = item.find('.card__title').text().toLowerCase();
          var itemTermIds = [];

          if (itemTermLinks.length > 0) {
            itemTermLinks.each(function () {
              itemTermIds.push(parseInt($(this).attr('data-id'), 10));
            });
          }

          tokens.push({
            id: itemId,
            title: itemTitle,
            terms: itemTermIds
          });
        });
      }

      return tokens;
    };

    var searchFilterInit = function searchFilterInit(module) {
      var searchForm = module.find('.ftf-form');
      searchForm.on('submit', function (e) {
        e.preventDefault();

        var _this = $(this);

        var search = _this.find('input[type="search"]').val().trim().toLowerCase();

        var term = parseInt(_this.find('select[name="ftf-work-category"]').val());
        hideItems(module.find('.ftf_work'));
        var filteredWorks = filterWorks(search, term, module);

        if (filteredWorks.length > 0) {
          hideEmptyMessage(module);
          animateItems(filteredWorks, module);
        } else {
          showEmptyMessage(module);
        }
      });
    };

    var filterWorks = function filterWorks(search, term, module) {
      var filteredWorks = generateTokens(module);
      var filteredWorksElems = [];

      if ('' !== search) {
        filteredWorks = filteredWorks.filter(function (token) {
          return token.title.includes(search);
        });
      }

      if (0 !== term) {
        filteredWorks = filteredWorks.filter(function (token) {
          return token.terms.includes(term);
        });
      }

      filteredWorks.forEach(function (item) {
        filteredWorksElems.push($("#".concat(item.id)));
      });
      return filteredWorksElems;
    };

    var hideItems = function hideItems(items) {
      items.each(function () {
        $(this).css('display', 'none');
        $(this).removeClass('active');
      });
    };

    var animateItems = function animateItems(items, module) {
      items.forEach(function (item) {
        $(item).addClass('active');
      });
      module.find('.ftf_work.active').each(function (i) {
        var $item = $(this);
        setTimeout(function () {
          $item.fadeIn(400);
        }, 300 * i);
      });
    };

    var showEmptyMessage = function showEmptyMessage(module) {
      module.find('.ftf-module-works__empty-results').fadeIn();
    };

    var hideEmptyMessage = function hideEmptyMessage(module) {
      module.find('.ftf-module-works__empty-results').fadeOut();
    };

    return {
      init: init
    };
  }();

  $(function () {
    var modules = $('.ftf-module-works');
    modules.each(function () {
      workModule.init($(this));
    });
  });
})(jQuery);