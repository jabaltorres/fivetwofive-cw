"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

(function ($, FTF, ScrollReveal) {
  'use strict';

  var resourceModule = /*#__PURE__*/function () {
    function resourceModule(module) {
      _classCallCheck(this, resourceModule);

      this.module = module;
      this.itemPerPage = module.dataset.itemPerPage;
      this.paginationContainer = module.querySelector('.ftf-module__pagination-container');
      this.animationConfig = {
        mobile: false,
        duration: 1000,
        interval: 300,
        reset: false,
        distance: '10px'
      };
    }

    _createClass(resourceModule, [{
      key: "init",
      value: function init() {
        this.formInit();
        this.paginationInit();
      }
    }, {
      key: "animateResources",
      value: function animateResources() {
        ScrollReveal().reveal(this.module.querySelectorAll('.card'), this.animationConfig);
      }
    }, {
      key: "formInit",
      value: function formInit() {
        var _this = this;

        this.module.querySelector('.ftf-form').addEventListener('submit', function (event) {
          event.preventDefault();

          _this.fetchResources(1);
        });
      }
    }, {
      key: "fetchResources",
      value: function fetchResources(page) {
        var _this$module$querySel,
            _this$module$querySel2,
            _this2 = this;

        var requestURL = new URL(FTF.restBase);
        requestURL.searchParams.append('_fields', 'id,date_gmt,ftf_formatted_date,title,link,_links,_embedded');
        requestURL.searchParams.append('per_page', this.itemPerPage);
        requestURL.searchParams.append('page', page);
        requestURL.searchParams.append('_embed', 'wp:featuredmedia');
        var search = this.module.querySelector('[name="ftf-search-resource"]').value;
        var category = (_this$module$querySel = (_this$module$querySel2 = this.module.querySelector('[name="ftf-category-resource"]')) === null || _this$module$querySel2 === void 0 ? void 0 : _this$module$querySel2.value) !== null && _this$module$querySel !== void 0 ? _this$module$querySel : null;

        if (search) {
          requestURL.searchParams.append('search', search);
        }

        if (category && category !== '0') {
          requestURL.searchParams.append('ftf-resource-categories', category);
        }

        this.isLoading();
        $.ajax({
          url: requestURL.href
        }).done(function (data, textStatus, request) {
          if ('success' === textStatus) {
            _this2.updateResources(data);

            _this2.generatePagination(request.getResponseHeader('X-WP-TotalPages'));
          }
        }).always(function () {
          _this2.isComplete();
        });
      }
    }, {
      key: "updateResources",
      value: function updateResources(data) {
        var _this3 = this;

        var resourcesWrap = this.module.querySelector('.ftf-resources-wrap');
        resourcesWrap.innerHTML = '';
        data.forEach(function (resource) {
          resourcesWrap.insertAdjacentHTML('beforeend', _this3.createResource(resource));
        });
        this.animateResources();
      }
    }, {
      key: "createResource",
      value: function createResource(resource) {
        var resourceHTML = '';

        if (resource) {
          var _resource$_embedded, _resource$_embedded$w, _resource$_embedded$w2, _resource$_embedded$w3, _resource$_embedded$w4, _resource$_embedded$w5;

          resourceHTML = "\n          <div class=\"col-md-4 mb-3 mb-md-5\">\n            <article id=\"card-".concat(resource.id, "\" class=\"card post-2990 ftf_resource type-ftf_resource status-publish has-post-thumbnail hentry load-hidden\">");

          if ((_resource$_embedded = resource._embedded) !== null && _resource$_embedded !== void 0 && (_resource$_embedded$w = _resource$_embedded['wp:featuredmedia']) !== null && _resource$_embedded$w !== void 0 && (_resource$_embedded$w2 = _resource$_embedded$w[0]) !== null && _resource$_embedded$w2 !== void 0 && (_resource$_embedded$w3 = _resource$_embedded$w2.media_details) !== null && _resource$_embedded$w3 !== void 0 && (_resource$_embedded$w4 = _resource$_embedded$w3.sizes) !== null && _resource$_embedded$w4 !== void 0 && (_resource$_embedded$w5 = _resource$_embedded$w4['ftf-resource-thumb']) !== null && _resource$_embedded$w5 !== void 0 && _resource$_embedded$w5.source_url) {
            resourceHTML += "\n            <div class=\"card__top\">\n              <a class=\"card__image-link\" href=\"".concat(resource.link, "\" aria-hidden=\"true\" tabindex=\"-1\">\n                <img width=\"415\" height=\"245\" src=\"").concat(resource._embedded['wp:featuredmedia'][0].media_details.sizes['ftf-resource-thumb'].source_url, "\" class=\"card__image img-responsive wp-post-image\" alt=\"").concat(resource.title.rendered, "\" loading=\"lazy\">\n              </a>\n            </div>");
          }

          resourceHTML += "\n              <div class=\"card__bottom\">\n                <header class=\"card__header m-0\">\n                  <div class=\"ftf-post-meta entry-meta\"><span class=\"posted-on\"><a href=\"".concat(resource.link, "\" rel=\"bookmark\"><time class=\"entry-date published\" datetime=\"").concat(resource.date, "\">").concat(resource.ftf_formatted_date, "</time></a></span></div>\n                  <h3 class=\"card__title mt-2\"><a href=\"").concat(resource.link, "\">").concat(resource.title.rendered, "</a></h3>\n                </header>\n\n                <footer class=\"card__footer mt-4\">\n                  <a class=\"button card__button\" href=\"").concat(resource.link, "\" aria-hidden=\"true\" tabindex=\"-1\">Read More</a>\n                </footer>\n              </div>\n            </article>\n          </div>\n        ");
        }

        return resourceHTML;
      }
    }, {
      key: "generatePagination",
      value: function generatePagination(totalPages) {
        this.paginationContainer.innerHTML = '';

        if (totalPages <= 1) {
          return;
        }

        var currentPage = this.module.dataset.currentPage;
        var paginationNav = this.setupPaginationNav();
        paginationNav.querySelector('.nav-links').innerHTML = this.generatePaginationLinks(currentPage, totalPages);
        this.paginationContainer.insertAdjacentElement('beforeend', paginationNav);
        this.paginationInit();
      }
    }, {
      key: "setupPaginationNav",
      value: function setupPaginationNav() {
        var paginationNav = document.createElement('nav');
        paginationNav.classList.add('navigation', 'pagination');
        paginationNav.setAttribute('role', 'navigation');
        paginationNav.setAttribute('aria-label', 'Resources');
        var paginationHeading = document.createElement('h2');
        paginationHeading.classList.add('screen-reader-text');
        paginationHeading.textContent = 'Resources navigation';
        var paginationLinks = document.createElement('div');
        paginationLinks.classList.add('nav-links');
        paginationNav.insertAdjacentElement('afterbegin', paginationHeading);
        paginationNav.insertAdjacentElement('beforeend', paginationLinks);
        return paginationNav;
      }
    }, {
      key: "generatePaginationLinks",
      value: function generatePaginationLinks() {
        var current = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
        var totalPages = arguments.length > 1 ? arguments[1] : undefined;
        var paginationLinks = '';
        current = Number.parseInt(current, 10);

        for (var index = 1; index <= totalPages; index++) {
          if (index === current) {
            paginationLinks += "<span aria-current=\"page\" class=\"page-numbers current\">".concat(index, "</span>");
          } else {
            paginationLinks += "<a class=\"page-numbers\" data-page=\"".concat(index, "\" href=\"#\">").concat(index, "</a>");
          }
        }

        return paginationLinks;
      }
    }, {
      key: "paginationInit",
      value: function paginationInit() {
        var _this4 = this;

        this.module.querySelectorAll('.page-numbers').forEach(function (link) {
          link.addEventListener('click', function (event) {
            event.preventDefault();
            var currentPage = Number.parseInt(event.currentTarget.dataset.page, 10);
            _this4.module.dataset.currentPage = currentPage;

            _this4.fetchResources(currentPage);
          });
        });
      }
    }, {
      key: "generateSpinner",
      value: function generateSpinner() {
        return "<div class=\"fivetwofive-spinner\"><div></div><div></div></div>";
      }
    }, {
      key: "isLoading",
      value: function isLoading() {
        var resourcesWrap = this.module.querySelector('.ftf-resources-wrap');
        this.module.querySelector('input[type="submit"]').setAttribute('disabled', 'disabled');
        resourcesWrap.innerHTML = this.generateSpinner();
      }
    }, {
      key: "isComplete",
      value: function isComplete() {
        this.module.querySelector('input[type="submit"]').removeAttribute('disabled');
      }
    }]);

    return resourceModule;
  }();

  $(function () {
    var modules = document.querySelectorAll('.ftf-module-resources');
    modules.forEach(function (module) {
      var singleResourceModule = new resourceModule(module);
      singleResourceModule.init();
    });
  });
})(jQuery, FiveTwoFive, ScrollReveal);