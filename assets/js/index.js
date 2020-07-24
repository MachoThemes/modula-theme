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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
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
/* 1 */
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
/* 2 */
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
		this.initMenu();
	}

	_createClass(Header, [{
		key: 'initMenu',
		value: function initMenu() {
			var _this = this;

			this.$menuArrow.on('click', function (e) {
				jQuery(e.target).toggleClass('menu-arrow--open');
				jQuery(e.target).siblings('.sub-menu').toggleClass('sub-menu--open');
			});

			this.$menuIcon.on('click', function () {
				_this.$menuIcon.toggleClass('menu-icon--open');
				_this.$mainMenu.toggleClass('main-menu--open');
			});
		}
	}]);

	return Header;
}();

exports.default = Header;

/***/ }),
/* 3 */
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

        // events
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
            document.dispatchEvent(new Event(this.id + '-opened'));
        }
    }, {
        key: 'closeModal',
        value: function closeModal(e) {
            e.preventDefault();
            this.$modal.removeClass('modal--open');
            document.dispatchEvent(new Event(this.id + '-closed'));
        }
    }]);

    return Modal;
}();

exports.default = Modal;

/***/ }),
/* 4 */,
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _Header = __webpack_require__(2);

var _Header2 = _interopRequireDefault(_Header);

var _Modal = __webpack_require__(3);

var _Modal2 = _interopRequireDefault(_Modal);

var _Events = __webpack_require__(1);

var _Events2 = _interopRequireDefault(_Events);

var _Accordion = __webpack_require__(0);

var _Accordion2 = _interopRequireDefault(_Accordion);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Modula = function () {
    function Modula() {
        _classCallCheck(this, Modula);

        this.initHeader();
        this.initScrollAnimation();
        this.initModals();
        this.initAccordions();
        this.initEvents();
    }

    _createClass(Modula, [{
        key: 'initHeader',
        value: function initHeader() {
            new _Header2.default(jQuery('.header'));
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
        key: 'initEvents',
        value: function initEvents() {
            new _Events2.default();
        }
    }]);

    return Modula;
}();

window.Modula = new Modula();

/***/ })
/******/ ]);