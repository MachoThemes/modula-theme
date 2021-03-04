/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 22);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */,
/* 1 */,
/* 2 */,
/* 3 */,
/* 4 */,
/* 5 */,
/* 6 */,
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Accordion = function () {
	function Accordion($element) {
		var _this = this;

		_classCallCheck(this, Accordion);

		this.$accordion = $element;
		this.$accordionTitle = this.$accordion.children('.accordion__title');
		this.$accordionContent = this.$accordion.children('.accordion__content');

		//events
		this.$accordionTitle.on('click', function (e) {
			return _this.onAccordionClick(e);
		});
	}

	_createClass(Accordion, [{
		key: 'onAccordionClick',
		value: function onAccordionClick(e) {
			var _this2 = this;

			e.preventDefault();

			this.$accordionContent.slideToggle(300, 'swing', function () {
				_this2.$accordion.toggleClass('accordion--opened');
			});
		}
	}]);

	return Accordion;
}();

exports.default = Accordion;

/***/ }),
/* 8 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var DocSearch = function () {
	function DocSearch($element) {
		var _this = this;

		_classCallCheck(this, DocSearch);

		this.$searchInput = $element.find('input');
		this.$searchResults = $element.find('.doc-search__results');
		this.nonce = this.$searchInput.attr('data-nonce');
		this.postType = this.$searchInput.attr('data-post-type');
		this.postCategory = this.$searchInput.attr('data-post-category');

		//events
		this.$searchInput.on('keyup', function (e) {
			return _this.onKeyUp(e);
		});
	}

	_createClass(DocSearch, [{
		key: 'onKeyUp',
		value: function onKeyUp(e) {
			var _this2 = this;

			e.preventDefault();

			var value = this.$searchInput.val();
			clearTimeout(this.timeout);

			if (value.length <= 3) {
				this.$searchResults.hide().html("");
			} else {
				this.$searchResults.show().html('<p class="mb-0">Searching for articles: <strong>' + value + '</strong></p>');
				this.timeout = setTimeout(function () {
					return _this2.makeAjaxCall();
				}, 500);
			}
		}
	}, {
		key: 'makeAjaxCall',
		value: function makeAjaxCall() {
			var _this3 = this;

			jQuery.ajax({
				type: "POST",
				data: { action: "modula_search_articles", nonce: this.nonce, post_type: this.postType, post_category: this.postCategory, s: this.$searchInput.val() },
				url: modula.ajaxurl,
				success: function success(html) {
					_this3.$searchResults.show().html(html);
				}
			});
		}
	}]);

	return DocSearch;
}();

exports.default = DocSearch;

/***/ }),
/* 9 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Events = function () {
	function Events($hero) {
		var _this = this;

		_classCallCheck(this, Events);

		//events
		document.addEventListener('modal-2-opened', function (e) {
			return _this.onModalVideoOpen(e);
		});
		document.addEventListener('modal-2-closed', function (e) {
			return _this.onModalVideoClosed(e);
		});
	}

	_createClass(Events, [{
		key: 'onModalVideoOpen',
		value: function onModalVideoOpen(e) {
			e.preventDefault();
			jQuery('.modal--video iframe').attr('src', "https://www.youtube.com/embed/NxrTXQNExh4?feature=oembed&autoplay=1");
		}
	}, {
		key: 'onModalVideoClosed',
		value: function onModalVideoClosed(e) {
			e.preventDefault();
			jQuery('.modal--video iframe').attr('src', "");
		}
	}]);

	return Events;
}();

exports.default = Events;

/***/ }),
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Header = function () {
	function Header($element) {
		_classCallCheck(this, Header);

		this.$header = $element;
		this.$mainMenu = this.$header.find('.main-menu');
		this.$menuIcon = this.$header.find('.menu-icon');
		this.$mainMenu.find('.menu-item-has-children').append('<div class="menu-arrow"></div>');
		this.$menuArrow = this.$mainMenu.find('.menu-arrow');

		//this.initSticky();
		this.initMenu();
	}

	_createClass(Header, [{
		key: 'initSticky',
		value: function initSticky() {
			var _this = this;

			if (jQuery('body').hasClass('page-template-checkout')) {
				return;
			}

			if (jQuery('body').hasClass('page-template-pricing')) {
				return;
			}

			if (jQuery('body').hasClass('page-template-pricing-2')) {
				return;
			}

			window.addEventListener('scroll', function () {
				return _this.makeSticky();
			});
		}
	}, {
		key: 'makeSticky',
		value: function makeSticky() {

			if (window.pageYOffset > 0) {
				this.$header.addClass('header--sticky');
			} else {
				this.$header.removeClass('header--sticky');
			}
		}
	}, {
		key: 'initMenu',
		value: function initMenu() {
			var _this2 = this;

			this.$menuArrow.on('click', function (e) {
				jQuery(e.target).toggleClass('menu-arrow--open');
				jQuery(e.target).siblings('.sub-menu').toggleClass('sub-menu--open');
			});

			this.$menuIcon.on('click', function () {
				_this2.$menuIcon.toggleClass('menu-icon--open');
				_this2.$mainMenu.toggleClass('main-menu--open');
			});
		}
	}]);

	return Header;
}();

exports.default = Header;

/***/ }),
/* 11 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Modal = function () {
	function Modal(id, $element, $trigger) {
		var _this = this;

		_classCallCheck(this, Modal);

		this.id = id;
		this.$modal = $element;
		this.$trigger = $trigger;

		//events
		this.$trigger.on('click', function (e) {
			return _this.openModal(e);
		});
		this.$modal.find('.modal__overlay, .modal__close').on('click', function (e) {
			return _this.closeModal(e);
		});
	}

	_createClass(Modal, [{
		key: 'openModal',
		value: function openModal(e) {
			e.preventDefault();
			this.$modal.addClass('modal--open');
			jQuery('body').addClass('modal--open');
			document.dispatchEvent(new Event(this.id + '-opened'));
		}
	}, {
		key: 'closeModal',
		value: function closeModal(e) {
			e.preventDefault();
			this.$modal.removeClass('modal--open');
			jQuery('body').removeClass('modal--open');
			document.dispatchEvent(new Event(this.id + '-closed'));
		}
	}]);

	return Modal;
}();

exports.default = Modal;

/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var PromotionSection = function () {
	function PromotionSection($element) {
		_classCallCheck(this, PromotionSection);

		this.$promotionSection = $element;

		this.initSticky();
	}

	_createClass(PromotionSection, [{
		key: 'initSticky',
		value: function initSticky() {
			var _this = this;

			if (!jQuery('body').hasClass('page-template-pricing')) {
				return;
			}

			window.addEventListener('scroll', function () {
				return _this.makeSticky();
			});
		}
	}, {
		key: 'makeSticky',
		value: function makeSticky() {

			if (window.pageYOffset > 0) {
				this.$promotionSection.addClass('promotion-section--sticky');
			} else {
				this.$promotionSection.removeClass('promotion-section--sticky');
			}
		}
	}]);

	return PromotionSection;
}();

exports.default = PromotionSection;

/***/ }),
/* 13 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var TRANSITION_END = 'transitionend';
var MAX_UID = 1000000;
var MILLISECONDS_MULTIPLIER = 1000;

// Shoutout AngusCroll (https://goo.gl/pxwQGp)
function toType(obj) {
  return {}.toString.call(obj).match(/\s([a-z]+)/i)[1].toLowerCase();
}

function getSpecialTransitionEndEvent() {
  return {
    bindType: TRANSITION_END,
    delegateType: TRANSITION_END,
    handle: function handle(event) {
      if (jQuery(event.target).is(this)) {
        return event.handleObj.handler.apply(this, arguments); // eslint-disable-line prefer-rest-params
      }
      return undefined; // eslint-disable-line no-undefined
    }
  };
}

function transitionEndEmulator(duration) {
  var _this = this;

  var called = false;

  jQuery(this).one(Util.TRANSITION_END, function () {
    called = true;
  });

  setTimeout(function () {
    if (!called) {
      Util.triggerTransitionEnd(_this);
    }
  }, duration);

  return this;
}

function setTransitionEndSupport() {
  jQuery.fn.emulateTransitionEnd = transitionEndEmulator;
  jQuery.event.special[Util.TRANSITION_END] = getSpecialTransitionEndEvent();
}

/**
 * --------------------------------------------------------------------------
 * Public Util Api
 * --------------------------------------------------------------------------
 */

var Util = {

  TRANSITION_END: 'bsTransitionEnd',

  getUID: function getUID(prefix) {
    do {
      // eslint-disable-next-line no-bitwise
      prefix += ~~(Math.random() * MAX_UID); // "~~" acts like a faster Math.floor() here
    } while (document.getElementById(prefix));
    return prefix;
  },
  getSelectorFromElement: function getSelectorFromElement(element) {
    var selector = element.getAttribute('data-target');

    if (!selector || selector === '#') {
      var hrefAttr = element.getAttribute('href');
      selector = hrefAttr && hrefAttr !== '#' ? hrefAttr.trim() : '';
    }

    try {
      return document.querySelector(selector) ? selector : null;
    } catch (err) {
      return null;
    }
  },
  getTransitionDurationFromElement: function getTransitionDurationFromElement(element) {
    if (!element) {
      return 0;
    }

    // Get transition-duration of the element
    var transitionDuration = jQuery(element).css('transition-duration');
    var transitionDelay = jQuery(element).css('transition-delay');

    var floatTransitionDuration = parseFloat(transitionDuration);
    var floatTransitionDelay = parseFloat(transitionDelay);

    // Return 0 if element or transition duration is not found
    if (!floatTransitionDuration && !floatTransitionDelay) {
      return 0;
    }

    // If multiple durations are defined, take the first
    transitionDuration = transitionDuration.split(',')[0];
    transitionDelay = transitionDelay.split(',')[0];

    return (parseFloat(transitionDuration) + parseFloat(transitionDelay)) * MILLISECONDS_MULTIPLIER;
  },
  reflow: function reflow(element) {
    return element.offsetHeight;
  },
  triggerTransitionEnd: function triggerTransitionEnd(element) {
    jQuery(element).trigger(TRANSITION_END);
  },


  // TODO: Remove in v5
  supportsTransitionEnd: function supportsTransitionEnd() {
    return Boolean(TRANSITION_END);
  },
  isElement: function isElement(obj) {
    return (obj[0] || obj).nodeType;
  },
  typeCheckConfig: function typeCheckConfig(componentName, config, configTypes) {
    for (var property in configTypes) {
      if (Object.prototype.hasOwnProperty.call(configTypes, property)) {
        var expectedTypes = configTypes[property];
        var value = config[property];
        var valueType = value && Util.isElement(value) ? 'element' : toType(value);

        if (!new RegExp(expectedTypes).test(valueType)) {
          throw new Error(componentName.toUpperCase() + ': ' + ('Option "' + property + '" provided type "' + valueType + '" ') + ('but expected type "' + expectedTypes + '".'));
        }
      }
    }
  },
  findShadowRoot: function findShadowRoot(element) {
    if (!document.documentElement.attachShadow) {
      return null;
    }

    // Can find the shadow root otherwise it'll return the document
    if (typeof element.getRootNode === 'function') {
      var root = element.getRootNode();
      return root instanceof ShadowRoot ? root : null;
    }

    if (element instanceof ShadowRoot) {
      return element;
    }

    // when we don't find a shadow root
    if (!element.parentNode) {
      return null;
    }

    return Util.findShadowRoot(element.parentNode);
  }
};

setTransitionEndSupport();

/**
 * ------------------------------------------------------------------------
 * Constants
 * ------------------------------------------------------------------------
 */

var NAME = 'tab';
var VERSION = '4.3.1';
var DATA_KEY = 'bs.tab';
var EVENT_KEY = '.' + DATA_KEY;
var DATA_API_KEY = '.data-api';
var JQUERY_NO_CONFLICT = jQuery.fn[NAME];

var Event = {
  HIDE: 'hide' + EVENT_KEY,
  HIDDEN: 'hidden' + EVENT_KEY,
  SHOW: 'show' + EVENT_KEY,
  SHOWN: 'shown' + EVENT_KEY,
  CLICK_DATA_API: 'click' + EVENT_KEY + DATA_API_KEY
};

var ClassName = {
  DROPDOWN_MENU: 'dropdown-menu',
  ACTIVE: 'active',
  DISABLED: 'disabled',
  FADE: 'fade',
  SHOW: 'show'
};

var Selector = {
  DROPDOWN: '.dropdown',
  NAV_LIST_GROUP: '.nav, .list-group',
  ACTIVE: '.active',
  ACTIVE_UL: 'li > .active',
  DATA_TOGGLE: '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]',
  DROPDOWN_TOGGLE: '.dropdown-toggle',
  DROPDOWN_ACTIVE_CHILD: '> .dropdown-menu .active'

  /**
   * ------------------------------------------------------------------------
   * Class Definition
   * ------------------------------------------------------------------------
   */

};
var Tab = function () {
  function Tab(element) {
    _classCallCheck(this, Tab);

    this._element = element;
  }

  // Getters

  _createClass(Tab, [{
    key: 'show',


    // Public

    value: function show() {
      var _this2 = this;

      if (this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE && jQuery(this._element).hasClass(ClassName.ACTIVE) || jQuery(this._element).hasClass(ClassName.DISABLED)) {
        return;
      }

      var target = void 0;
      var previous = void 0;
      var listElement = jQuery(this._element).closest(Selector.NAV_LIST_GROUP)[0];
      var selector = Util.getSelectorFromElement(this._element);

      if (listElement) {
        var itemSelector = listElement.nodeName === 'UL' || listElement.nodeName === 'OL' ? Selector.ACTIVE_UL : Selector.ACTIVE;
        previous = jQuery.makeArray(jQuery(listElement).find(itemSelector));
        previous = previous[previous.length - 1];
      }

      var hideEvent = jQuery.Event(Event.HIDE, {
        relatedTarget: this._element
      });

      var showEvent = jQuery.Event(Event.SHOW, {
        relatedTarget: previous
      });

      if (previous) {
        jQuery(previous).trigger(hideEvent);
      }

      jQuery(this._element).trigger(showEvent);

      if (showEvent.isDefaultPrevented() || hideEvent.isDefaultPrevented()) {
        return;
      }

      if (selector) {
        target = document.querySelector(selector);
      }

      this._activate(this._element, listElement);

      var complete = function complete() {
        var hiddenEvent = jQuery.Event(Event.HIDDEN, {
          relatedTarget: _this2._element
        });

        var shownEvent = jQuery.Event(Event.SHOWN, {
          relatedTarget: previous
        });

        jQuery(previous).trigger(hiddenEvent);
        jQuery(_this2._element).trigger(shownEvent);
      };

      if (target) {
        this._activate(target, target.parentNode, complete);
      } else {
        complete();
      }
    }
  }, {
    key: 'dispose',
    value: function dispose() {
      jQuery.removeData(this._element, DATA_KEY);
      this._element = null;
    }

    // Private

  }, {
    key: '_activate',
    value: function _activate(element, container, callback) {
      var _this3 = this;

      var activeElements = container && (container.nodeName === 'UL' || container.nodeName === 'OL') ? jQuery(container).find(Selector.ACTIVE_UL) : jQuery(container).children(Selector.ACTIVE);

      var active = activeElements[0];
      var isTransitioning = callback && active && jQuery(active).hasClass(ClassName.FADE);
      var complete = function complete() {
        return _this3._transitionComplete(element, active, callback);
      };

      if (active && isTransitioning) {
        var transitionDuration = Util.getTransitionDurationFromElement(active);

        jQuery(active).removeClass(ClassName.SHOW).one(Util.TRANSITION_END, complete).emulateTransitionEnd(transitionDuration);
      } else {
        complete();
      }
    }
  }, {
    key: '_transitionComplete',
    value: function _transitionComplete(element, active, callback) {
      if (active) {
        jQuery(active).removeClass(ClassName.ACTIVE);

        var dropdownChild = jQuery(active.parentNode).find(Selector.DROPDOWN_ACTIVE_CHILD)[0];

        if (dropdownChild) {
          jQuery(dropdownChild).removeClass(ClassName.ACTIVE);
        }

        if (active.getAttribute('role') === 'tab') {
          active.setAttribute('aria-selected', false);
        }
      }

      jQuery(element).addClass(ClassName.ACTIVE);
      if (element.getAttribute('role') === 'tab') {
        element.setAttribute('aria-selected', true);
      }

      Util.reflow(element);

      if (element.classList.contains(ClassName.FADE)) {
        element.classList.add(ClassName.SHOW);
      }

      if (element.parentNode && jQuery(element.parentNode).hasClass(ClassName.DROPDOWN_MENU)) {
        var dropdownElement = jQuery(element).closest(Selector.DROPDOWN)[0];

        if (dropdownElement) {
          var dropdownToggleList = [].slice.call(dropdownElement.querySelectorAll(Selector.DROPDOWN_TOGGLE));

          jQuery(dropdownToggleList).addClass(ClassName.ACTIVE);
        }

        element.setAttribute('aria-expanded', true);
      }

      if (callback) {
        callback();
      }
    }

    // Static

  }], [{
    key: '_jQueryInterface',
    value: function _jQueryInterface(config) {
      return this.each(function () {
        var $this = jQuery(this);
        var data = $this.data(DATA_KEY);

        if (!data) {
          data = new Tab(this);
          $this.data(DATA_KEY, data);
        }

        if (typeof config === 'string') {
          if (typeof data[config] === 'undefined') {
            throw new TypeError('No method named "' + config + '"');
          }
          data[config]();
        }
      });
    }
  }, {
    key: 'VERSION',
    get: function get() {
      return VERSION;
    }
  }]);

  return Tab;
}();

/**
 * ------------------------------------------------------------------------
 * Data Api implementation
 * ------------------------------------------------------------------------
 */

jQuery(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function (event) {
  event.preventDefault();
  Tab._jQueryInterface.call(jQuery(this), 'show');
});

/**
 * ------------------------------------------------------------------------
 * jQuery
 * ------------------------------------------------------------------------
 */

jQuery.fn[NAME] = Tab._jQueryInterface;
jQuery.fn[NAME].Constructor = Tab;
jQuery.fn[NAME].noConflict = function () {
  jQuery.fn[NAME] = JQUERY_NO_CONFLICT;
  return Tab._jQueryInterface;
};

exports.default = Tab;

/***/ }),
/* 14 */,
/* 15 */,
/* 16 */,
/* 17 */,
/* 18 */,
/* 19 */,
/* 20 */,
/* 21 */,
/* 22 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _Header = __webpack_require__(10);

var _Header2 = _interopRequireDefault(_Header);

var _PromotionSection = __webpack_require__(12);

var _PromotionSection2 = _interopRequireDefault(_PromotionSection);

var _Modal = __webpack_require__(11);

var _Modal2 = _interopRequireDefault(_Modal);

var _Events = __webpack_require__(9);

var _Events2 = _interopRequireDefault(_Events);

var _Accordion = __webpack_require__(7);

var _Accordion2 = _interopRequireDefault(_Accordion);

var _DocSearch = __webpack_require__(8);

var _DocSearch2 = _interopRequireDefault(_DocSearch);

var _Tabs = __webpack_require__(13);

var _Tabs2 = _interopRequireDefault(_Tabs);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Modula = function () {
	function Modula() {
		_classCallCheck(this, Modula);

		this.initHeader();
		this.initScrollAnimation();
		this.initModals();
		this.initAccordions();
		this.initDocSearch();
		this.initEvents();
		this.initWaypoints();
		this.initPromotionSection();
		this.initCurrency();
		this.initPostNavigation();
		this.initCheckoutPage();
	}

	_createClass(Modula, [{
		key: 'initHeader',
		value: function initHeader() {
			new _Header2.default(jQuery('.header'));
		}
	}, {
		key: 'initPromotionSection',
		value: function initPromotionSection() {
			new _PromotionSection2.default(jQuery('.promotion-section'));
		}
	}, {
		key: 'initScrollAnimation',
		value: function initScrollAnimation() {

			jQuery('a[href*="#"]:not([href="#"])').on('click', function (e) {
				var target = void 0;
				if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
					target = jQuery(this.hash);
					target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
					if (target.length) {
						e.preventDefault();
						jQuery('html, body').animate({ scrollTop: target.offset().top }, 1000, 'swing');
					}
				}
			});
		}
	}, {
		key: 'initModals',
		value: function initModals() {
			new _Modal2.default('modal-1', jQuery('.modal--login'), jQuery('.login-link'));
			new _Modal2.default('modal-2', jQuery('.modal--video'), jQuery('.banner-section .hero__img, .banner-section .hero__play-icon, .hero-section-2__hero'));
			jQuery('.changelog-link').each(function () {
				var count = jQuery(this).attr('data-count');
				new _Modal2.default('modal-changelog-' + count, jQuery('#modal--changelog-' + count), jQuery('#changelog-link-' + count));
			});
		}
	}, {
		key: 'initAccordions',
		value: function initAccordions() {
			var $elements = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : jQuery(".accordion");

			$elements.each(function (index) {
				new _Accordion2.default(jQuery(this));
			});
		}
	}, {
		key: 'initDocSearch',
		value: function initDocSearch() {
			var $elements = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : jQuery(".doc-search");

			$elements.each(function () {
				new _DocSearch2.default(jQuery(this));
			});
		}
	}, {
		key: 'initEvents',
		value: function initEvents() {
			new _Events2.default();
		}
	}, {
		key: 'initWaypoints',
		value: function initWaypoints() {

			if (typeof Waypoint === "undefined") {
				return;
			}

			jQuery('.illustration').each(function () {

				var $illustration = jQuery(this);

				new Waypoint({
					element: $illustration,
					offset: '36%',
					handler: function handler(direction) {
						$illustration.addClass('illustration--animate');
					}
				});
			});

			jQuery('.waypoint').each(function () {

				var $element = jQuery(this);

				new Waypoint({
					element: $element,
					offset: '75%',
					handler: function handler(direction) {
						$element.addClass('in-viewport');
					}
				});
			});
		}
	}, {
		key: 'initPostNavigation',
		value: function initPostNavigation() {

			if (typeof Waypoint === "undefined") {
				return;
			}

			if (jQuery('.post-navigation').length == 0) {
				return;
			}

			var $postNavigation = jQuery('.post-navigation');

			// make the post navigation stick
			new Waypoint({
				element: jQuery('.post-content'),
				offset: '200px',
				handler: function handler(direction) {
					if ('down' === direction) {
						$postNavigation.addClass('stick');
					}
					if ('up' === direction) {
						$postNavigation.removeClass('stick');
					}
				}
			});

			// hide the post navigation when reaching the bottom of the post
			new Waypoint({
				element: jQuery('.post-content > *:last-child'),
				offset: '200px',
				handler: function handler(direction) {
					if ('down' === direction) {
						$postNavigation.addClass('invisible');
					}
					if ('up' === direction) {
						$postNavigation.removeClass('invisible');
					}
				}
			});

			// hide/show the post navigation when hovering over alignwide and alignfull elements
			jQuery('.post-content .alignwide, .post-content .alignfull').on('mouseenter', function () {
				$postNavigation.addClass('invisible');
			});

			jQuery('.post-content .alignwide, .post-content .alignfull').on('mouseleave', function () {
				$postNavigation.removeClass('invisible');
			});

			//strip dashes in toc links
			jQuery('.post-navigation').find('.ez-toc-list a').each(function (index) {
				var href = jQuery(this).attr('href');
				href = href.replace('-_', '');
				jQuery(this).attr('href', href);
			});
		}
	}, {
		key: 'initCurrency',
		value: function initCurrency() {

			var cpoSymbols = {
				'EUR': '&euro;',
				'GBP': '&pound;',
				'USD': '&dollar;'
			};

			jQuery(window).on('ppeddfsAfterFsMarkup', function () {
				jQuery('span.fsc-currency').each(function () {
					var $span = jQuery(this),
					    currency = $span.text();

					if (cpoSymbols[currency]) {
						$span.html(cpoSymbols[currency]);
					}
				});
			});
		}
	}, {
		key: 'initCheckoutPage',
		value: function initCheckoutPage() {

			if (!jQuery('body').hasClass('page-template-checkout')) {
				return;
			}

			//new CheckoutPage();
		}
	}]);

	return Modula;
}();

window.Modula = new Modula();

/***/ })
/******/ ]);