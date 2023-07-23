/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/app.js":
/*!***********************!*\
  !*** ./src/js/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _list__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./list */ "./src/js/list.js");
/**
 * Main app file
 *
 * @package WP_Plugin_Boilerplate
 * */


new _list__WEBPACK_IMPORTED_MODULE_0__["default"]();

/***/ }),

/***/ "./src/js/list.js":
/*!************************!*\
  !*** ./src/js/list.js ***!
  \************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _url_helper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./url-helper */ "./src/js/url-helper.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
/**
 * Handles the messages list
 *
 * @package WP_Plugin_Boilerplate
 * */


var $ = jQuery;

/**
 * Class Form
 * */
var List = /*#__PURE__*/function () {
  function List() {
    var _this = this;
    _classCallCheck(this, List);
    document.addEventListener("DOMContentLoaded", function () {
      _this.data = boilerplateData;
      _this.$container = $('.js-example-list');
      if (!_this.$container.length) {
        return;
      }
      _this.initProperties();
      _this.initPagination();
      _this.fetchList(_this.$pagination.data('page'));
      _this.urlHelper = new _url_helper__WEBPACK_IMPORTED_MODULE_0__["default"]();
    });
  }
  _createClass(List, [{
    key: "initProperties",
    value: function initProperties() {
      this.$listContainer = this.$container.find('.js-list-container');
      this.$pagination = this.$container.find('.js-pagination');
      this.$listItemTmpl = this.$container.find('.js-list-item-tmpl');
      this.$msg = this.$container.find('.js-msg');
      this.$detailsContainer = this.$container.find('.js-details-container');
      this.$detailsTmpl = this.$container.find('.js-details-tmpl');
    }
  }, {
    key: "validatePageNumber",
    value: function validatePageNumber(pageNumber) {
      return pageNumber > 0 && pageNumber <= this.$pagination.data('last-page') && pageNumber !== this.$pagination.data('page');
    }
  }, {
    key: "initPagination",
    value: function initPagination() {
      this.listenPaginationBtns();
      this.listenUrlChange();
    }
  }, {
    key: "listenUrlChange",
    value: function listenUrlChange() {
      var _this2 = this;
      window.onpopstate = function () {
        var page = _this2.urlHelper.getUrlParameter(window.location.href, 'pag');
        _this2.fetchList(page);
      };
    }
  }, {
    key: "syncPaginationBtns",
    value: function syncPaginationBtns(page, lastPage) {
      this.$pagination.data('page', page);
      this.enablePaginationBtns();
      if (1 === page) {
        this.disablePaginationBtn(this.$pagination.find('.js-first'));
        this.disablePaginationBtn(this.$pagination.find('.js-prev'));
      }
      if (page === lastPage) {
        this.disablePaginationBtn(this.$pagination.find('.js-next'));
        this.disablePaginationBtn(this.$pagination.find('.js-last'));
      }
    }
  }, {
    key: "disablePaginationBtn",
    value: function disablePaginationBtn($btn) {
      $btn.addClass('disabled js-disabled');
    }
  }, {
    key: "enablePaginationBtns",
    value: function enablePaginationBtns() {
      this.$pagination.find('button').removeClass('disabled js-disabled');
    }
  }, {
    key: "listenPaginationBtns",
    value: function listenPaginationBtns() {
      var _this3 = this;
      this.$pagination.find('.js-first').click(function (e) {
        if (!$(e.currentTarget).hasClass('js-disabled') && _this3.validatePageNumber(1)) {
          _this3.fetchList(1);
        }
      });
      this.$pagination.find('.js-prev').click(function (e) {
        var page = _this3.$pagination.data('page') - 1;
        if (!$(e.currentTarget).hasClass('js-disabled') && _this3.validatePageNumber(page)) {
          _this3.fetchList(page);
        }
      });
      this.$pagination.find('.js-next').click(function (e) {
        var page = _this3.$pagination.data('page') + 1;
        if (!$(e.currentTarget).hasClass('js-disabled') && _this3.validatePageNumber(page)) {
          _this3.fetchList(page);
        }
      });
      this.$pagination.find('.js-last').not('.disabled').click(function (e) {
        var page = _this3.$pagination.data('last-page');
        if (!$(e.currentTarget).hasClass('js-disabled') && _this3.validatePageNumber(page)) {
          _this3.fetchList(page);
        }
      });
    }
  }, {
    key: "fetchList",
    value: function fetchList(page) {
      var _this4 = this;
      // If another request was sent already, do nothing.
      if (this.$listContainer.hasClass('loader')) {
        return;
      }
      var data = {
        action: 'get_example_list',
        page: page,
        nonce: this.data.getListNonce
      };
      this.$listContainer.addClass('loader');
      $.get(this.data.ajaxUrl, data, function (res) {
        _this4.$listContainer.removeClass('loader');
        _this4.$listContainer.find('.js-list-item').remove();
        if (true === res.success) {
          var url = window.location.href;
          if (page > 1) {
            url = _this4.urlHelper.updateURLParameter(url, 'pag', page);
          } else {
            url = _this4.urlHelper.removeUrlParameter(url, 'pag');
          }
          if (url !== window.location.href) {
            window.history.pushState({}, null, url);
          }
          if ('msg' in res.data) {
            _this4.$msg.removeClass('error').html(res.data.msg);
          }
          if ('items' in res.data) {
            _this4.renderListItems(res.data.items);
          }
          if (res.data.pages > 1) {
            _this4.$pagination.show().find('.js-pages-info').html(res.data.pagesInfo);
            _this4.syncPaginationBtns(page, res.data.pages);
          }
        } else {
          _this4.$msg.addClass('error');
          _this4.$msg.html(res.data);
        }
      });
    }
  }, {
    key: "renderListItems",
    value: function renderListItems(items) {
      var _this5 = this;
      this.$listContainer.show();
      items.forEach(function (data) {
        var $listItem = _this5.$listItemTmpl.clone();
        $listItem.removeClass('js-list-item-tmpl').addClass('js-list-item').show();
        $.each(_this5.getElementClasses(), function (property, elClass) {
          var $el = $listItem.find('.' + elClass);
          $el.html(data[property]).attr('title', data[property]);
        });
        _this5.$listContainer.append($listItem);
        $listItem.data('id', data.id);
      });
    }
  }, {
    key: "renderDetails",
    value: function renderDetails(data) {
      var $details = this.$detailsTmpl.clone();
      $details.removeClass('js-details-tmpl').addClass('js-details').show();
      $.each(this.getElementClasses(), function (property, elClass) {
        var $container = $details.find('.' + elClass),
          $el = $('<p></p>');
        $el.html(data[property]).attr('title', data[property]).appendTo($container);
      });
      this.$detailsContainer.find('.js-details').remove(); // Remove the old details.
      this.$detailsContainer.append($details);
      $details.data('id', data.id);
    }
  }, {
    key: "getElementClasses",
    value: function getElementClasses() {
      return {
        name: 'js-name',
        date: 'js-date'
      };
    }
  }]);
  return List;
}();
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (List);

/***/ }),

/***/ "./src/js/url-helper.js":
/*!******************************!*\
  !*** ./src/js/url-helper.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
/**
 * UrlHelper
 *
 * @package WP_Plugin_Boilerplate
 * */
/**
 * Class UrlHelper
 * */
var UrlHelper = /*#__PURE__*/function () {
  function UrlHelper() {
    _classCallCheck(this, UrlHelper);
  }
  _createClass(UrlHelper, [{
    key: "getUrlParameter",
    value: function getUrlParameter(url, param) {
      var urlParts = url.split("?"),
        args = urlParts[1],
        argsArray,
        paramArray;
      if (!args) {
        return '';
      }
      argsArray = args.split("&");
      var arrayLength = argsArray.length;
      for (var i = 0; i < arrayLength; i++) {
        paramArray = argsArray[i].split('=');
        if (paramArray[0] === param) {
          return paramArray[1];
        }
      }
      return '';
    }
  }, {
    key: "updateURLParameter",
    value: function updateURLParameter(url, param, paramVal) {
      var urlParts = url.split("?"),
        baseURL = urlParts[0],
        args = urlParts[1],
        newArgs = this.filterUrlArgsParameter(args, param),
        temp = newArgs ? '&' : "";
      var updatedParam = paramVal ? temp + "" + param + "=" + paramVal : '';
      return newArgs || updatedParam ? baseURL + "?" + newArgs + updatedParam : baseURL;
    }
  }, {
    key: "removeUrlParameter",
    value: function removeUrlParameter(url, param) {
      var urlParts = url.split("?"),
        baseURL = urlParts[0],
        args = urlParts[1],
        newArgs = this.filterUrlArgsParameter(args, param);
      return newArgs ? baseURL + "?" + newArgs : baseURL;
    }
  }, {
    key: "filterUrlArgsParameter",
    value: function filterUrlArgsParameter(args, param) {
      if (!args) {
        return '';
      }
      var argsArray = args.split("&"),
        newArgs = "",
        temp = "",
        arrayLength = argsArray.length;
      for (var i = 0; i < arrayLength; i++) {
        if (argsArray[i].split('=')[0] !== param) {
          newArgs += temp + argsArray[i];
          temp = "&";
        }
      }
      return newArgs;
    }
  }]);
  return UrlHelper;
}();
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (UrlHelper);

/***/ }),

/***/ "./src/scss/app.scss":
/*!***************************!*\
  !*** ./src/scss/app.scss ***!
  \***************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/all": 0,
/******/ 			"css/all": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkwp_plugin_boilerplate"] = self["webpackChunkwp_plugin_boilerplate"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/all"], () => (__webpack_require__("./src/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/all"], () => (__webpack_require__("./src/scss/app.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;