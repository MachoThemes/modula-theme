/******/ (function(modules) {
	// webpackBootstrap
	/******/ // The module cache
	/******/ var installedModules = {}; // The require function
	/******/
	/******/ /******/ function __webpack_require__(moduleId) {
		/******/
		/******/ // Check if module is in cache
		/******/ if (installedModules[moduleId]) {
			/******/ return installedModules[moduleId].exports;
			/******/
		} // Create a new module (and put it into the cache)
		/******/ /******/ var module = (installedModules[moduleId] = {
			/******/ i: moduleId,
			/******/ l: false,
			/******/ exports: {}
			/******/
		}); // Execute the module function
		/******/
		/******/ /******/ modules[moduleId].call(module.exports, module, module.exports, __webpack_require__); // Flag the module as loaded
		/******/
		/******/ /******/ module.l = true; // Return the exports of the module
		/******/
		/******/ /******/ return module.exports;
		/******/
	} // expose the modules object (__webpack_modules__)
	/******/
	/******/
	/******/ /******/ __webpack_require__.m = modules; // expose the module cache
	/******/
	/******/ /******/ __webpack_require__.c = installedModules; // identity function for calling harmony imports with the correct context
	/******/
	/******/ /******/ __webpack_require__.i = function(value) {
		return value;
	}; // define getter function for harmony exports
	/******/
	/******/ /******/ __webpack_require__.d = function(exports, name, getter) {
		/******/ if (!__webpack_require__.o(exports, name)) {
			/******/ Object.defineProperty(exports, name, {
				/******/ configurable: false,
				/******/ enumerable: true,
				/******/ get: getter
				/******/
			});
			/******/
		}
		/******/
	}; // getDefaultExport function for compatibility with non-harmony modules
	/******/
	/******/ /******/ __webpack_require__.n = function(module) {
		/******/ var getter =
			module && module.__esModule
				? /******/ function getDefault() {
						return module['default'];
					}
				: /******/ function getModuleExports() {
						return module;
					};
		/******/ __webpack_require__.d(getter, 'a', getter);
		/******/ return getter;
		/******/
	}; // Object.prototype.hasOwnProperty.call
	/******/
	/******/ /******/ __webpack_require__.o = function(object, property) {
		return Object.prototype.hasOwnProperty.call(object, property);
	}; // __webpack_public_path__
	/******/
	/******/ /******/ __webpack_require__.p = ''; // Load entry module and return exports
	/******/
	/******/ /******/ return __webpack_require__((__webpack_require__.s = 8));
	/******/
})(
	/************************************************************************/
	/******/ [
		/* 0 */
		/***/ function(module, __webpack_exports__, __webpack_require__) {
			'use strict';
			class Accordion {
				constructor($element) {
					this.$accordion = $element;
					this.$accordionTitle = this.$accordion.children('.accordion__title');
					this.$accordionContent = this.$accordion.children('.accordion__content');

					//events
					this.$accordionTitle.on('click', (e) => this.onAccordionClick(e));
				}

				onAccordionClick(e) {
					e.preventDefault();

					this.$accordionContent.slideToggle(300, 'swing', () => {
						this.$accordion.toggleClass('accordion--opened');
					});
				}
			}
			/* harmony export (immutable) */ __webpack_exports__['a'] = Accordion;

			/***/
		},
		/* 1 */
		/***/ function(module, __webpack_exports__, __webpack_require__) {
			'use strict';
			class DocSearch {
				constructor($element) {
					this.$searchInput = $element.find('input');
					this.$searchResults = $element.find('.doc-search__results');
					this.nonce = this.$searchInput.attr('data-nonce');
					this.postType = this.$searchInput.attr('data-post-type');
					this.postCategory = this.$searchInput.attr('data-post-category');

					//events
					this.$searchInput.on('keyup', (e) => this.onKeyUp(e));
				}

				onKeyUp(e) {
					e.preventDefault();

					let value = this.$searchInput.val();
					clearTimeout(this.timeout);

					if (value.length <= 3) {
						this.$searchResults.hide().html('');
					} else {
						this.$searchResults
							.show()
							.html('<p class="mb-0">Searching for articles: <strong>' + value + '</strong></p>');
						this.timeout = setTimeout(() => this.makeAjaxCall(), 500);
					}
				}

				makeAjaxCall() {
					jQuery.ajax({
						type: 'POST',
						data: {
							action: 'modula_search_articles',
							nonce: this.nonce,
							post_type: this.postType,
							post_category: this.postCategory,
							s: this.$searchInput.val()
						},
						url: modula.ajaxurl,
						success: (html) => {
							this.$searchResults.show().html(html);
						}
					});
				}
			}
			/* harmony export (immutable) */ __webpack_exports__['a'] = DocSearch;

			/***/
		},
		/* 2 */
		/***/ function(module, __webpack_exports__, __webpack_require__) {
			'use strict';
			class Events {
				constructor($hero) {
					//events
					document.addEventListener('modal-2-opened', (e) => this.onModalVideoOpen(e));
					document.addEventListener('modal-2-closed', (e) => this.onModalVideoClosed(e));
				}

				onModalVideoOpen(e) {
					e.preventDefault();
					jQuery('.modal--video iframe').attr(
						'src',
						'https://www.youtube.com/embed/NxrTXQNExh4?feature=oembed&autoplay=1'
					);
				}

				onModalVideoClosed(e) {
					e.preventDefault();
					jQuery('.modal--video iframe').attr('src', '');
				}
			}
			/* harmony export (immutable) */ __webpack_exports__['a'] = Events;

			/***/
		},
		/* 3 */
		/***/ function(module, __webpack_exports__, __webpack_require__) {
			'use strict';
			class Header {
				constructor($element) {
					this.$header = $element;
					this.$mainMenu = this.$header.find('.main-menu');
					this.$menuIcon = this.$header.find('.menu-icon');
					this.$mainMenu.find('.menu-item-has-children').append('<div class="menu-arrow"></div>');
					this.$menuArrow = this.$mainMenu.find('.menu-arrow');

					//this.initSticky();
					this.initMenu();
				}

				initSticky() {
					if (jQuery('body').hasClass('page-template-checkout')) {
						return;
					}

					if (jQuery('body').hasClass('page-template-pricing')) {
						return;
					}

					if (jQuery('body').hasClass('page-template-pricing-2')) {
						return;
					}

					window.addEventListener('scroll', () => this.makeSticky());
				}

				makeSticky() {
					if (window.pageYOffset > 0) {
						this.$header.addClass('header--sticky');
					} else {
						this.$header.removeClass('header--sticky');
					}
				}

				initMenu() {
					this.$menuArrow.on('click', (e) => {
						jQuery(e.target).toggleClass('menu-arrow--open');
						jQuery(e.target).siblings('.sub-menu').toggleClass('sub-menu--open');
					});

					this.$menuIcon.on('click', () => {
						this.$menuIcon.toggleClass('menu-icon--open');
						this.$mainMenu.toggleClass('main-menu--open');
					});
				}
			}
			/* harmony export (immutable) */ __webpack_exports__['a'] = Header;

			/***/
		},
		/* 4 */
		/***/ function(module, __webpack_exports__, __webpack_require__) {
			'use strict';
			class Modal {
				constructor(id, $element, $trigger) {
					this.id = id;
					this.$modal = $element;
					this.$trigger = $trigger;

					//events
					this.$trigger.on('click', (e) => this.openModal(e));
					this.$modal.find('.modal__overlay, .modal__close').on('click', (e) => this.closeModal(e));
				}

				openModal(e) {
					e.preventDefault();
					this.$modal.addClass('modal--open');
					jQuery('body').addClass('modal--open');
					document.dispatchEvent(new Event(this.id + '-opened'));
				}

				closeModal(e) {
					e.preventDefault();
					this.$modal.removeClass('modal--open');
					jQuery('body').removeClass('modal--open');
					document.dispatchEvent(new Event(this.id + '-closed'));
				}
			}
			/* harmony export (immutable) */ __webpack_exports__['a'] = Modal;

			/***/
		},
		/* 5 */
		/***/ function(module, __webpack_exports__, __webpack_require__) {
			'use strict';
			class PromotionSection {
				constructor($element) {
					this.$promotionSection = $element;

					this.initSticky();
				}

				initSticky() {
					if (!jQuery('body').hasClass('page-template-pricing')) {
						return;
					}

					window.addEventListener('scroll', () => this.makeSticky());
				}

				makeSticky() {
					if (window.pageYOffset > 0) {
						this.$promotionSection.addClass('promotion-section--sticky');
					} else {
						this.$promotionSection.removeClass('promotion-section--sticky');
					}
				}
			}
			/* harmony export (immutable) */ __webpack_exports__['a'] = PromotionSection;

			/***/
		},
		/* 6 */
		/***/ function(module, __webpack_exports__, __webpack_require__) {
			'use strict';
			const TRANSITION_END = 'transitionend';
			const MAX_UID = 1000000;
			const MILLISECONDS_MULTIPLIER = 1000;

			// Shoutout AngusCroll (https://goo.gl/pxwQGp)
			function toType(obj) {
				return {}.toString.call(obj).match(/\s([a-z]+)/i)[1].toLowerCase();
			}

			function getSpecialTransitionEndEvent() {
				return {
					bindType: TRANSITION_END,
					delegateType: TRANSITION_END,
					handle(event) {
						if (jQuery(event.target).is(this)) {
							return event.handleObj.handler.apply(this, arguments); // eslint-disable-line prefer-rest-params
						}
						return undefined; // eslint-disable-line no-undefined
					}
				};
			}

			function transitionEndEmulator(duration) {
				let called = false;

				jQuery(this).one(Util.TRANSITION_END, () => {
					called = true;
				});

				setTimeout(() => {
					if (!called) {
						Util.triggerTransitionEnd(this);
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

			const Util = {
				TRANSITION_END: 'bsTransitionEnd',

				getUID(prefix) {
					do {
						// eslint-disable-next-line no-bitwise
						prefix += ~~(Math.random() * MAX_UID); // "~~" acts like a faster Math.floor() here
					} while (document.getElementById(prefix));
					return prefix;
				},

				getSelectorFromElement(element) {
					let selector = element.getAttribute('data-target');

					if (!selector || selector === '#') {
						const hrefAttr = element.getAttribute('href');
						selector = hrefAttr && hrefAttr !== '#' ? hrefAttr.trim() : '';
					}

					try {
						return document.querySelector(selector) ? selector : null;
					} catch (err) {
						return null;
					}
				},

				getTransitionDurationFromElement(element) {
					if (!element) {
						return 0;
					}

					// Get transition-duration of the element
					let transitionDuration = jQuery(element).css('transition-duration');
					let transitionDelay = jQuery(element).css('transition-delay');

					const floatTransitionDuration = parseFloat(transitionDuration);
					const floatTransitionDelay = parseFloat(transitionDelay);

					// Return 0 if element or transition duration is not found
					if (!floatTransitionDuration && !floatTransitionDelay) {
						return 0;
					}

					// If multiple durations are defined, take the first
					transitionDuration = transitionDuration.split(',')[0];
					transitionDelay = transitionDelay.split(',')[0];

					return (parseFloat(transitionDuration) + parseFloat(transitionDelay)) * MILLISECONDS_MULTIPLIER;
				},

				reflow(element) {
					return element.offsetHeight;
				},

				triggerTransitionEnd(element) {
					jQuery(element).trigger(TRANSITION_END);
				},

				// TODO: Remove in v5
				supportsTransitionEnd() {
					return Boolean(TRANSITION_END);
				},

				isElement(obj) {
					return (obj[0] || obj).nodeType;
				},

				typeCheckConfig(componentName, config, configTypes) {
					for (const property in configTypes) {
						if (Object.prototype.hasOwnProperty.call(configTypes, property)) {
							const expectedTypes = configTypes[property];
							const value = config[property];
							const valueType = value && Util.isElement(value) ? 'element' : toType(value);

							if (!new RegExp(expectedTypes).test(valueType)) {
								throw new Error(
									`${componentName.toUpperCase()}: ` +
										`Option "${property}" provided type "${valueType}" ` +
										`but expected type "${expectedTypes}".`
								);
							}
						}
					}
				},

				findShadowRoot(element) {
					if (!document.documentElement.attachShadow) {
						return null;
					}

					// Can find the shadow root otherwise it'll return the document
					if (typeof element.getRootNode === 'function') {
						const root = element.getRootNode();
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

			const NAME = 'tab';
			const VERSION = '4.3.1';
			const DATA_KEY = 'bs.tab';
			const EVENT_KEY = `.${DATA_KEY}`;
			const DATA_API_KEY = '.data-api';
			const JQUERY_NO_CONFLICT = jQuery.fn[NAME];

			const Event = {
				HIDE: `hide${EVENT_KEY}`,
				HIDDEN: `hidden${EVENT_KEY}`,
				SHOW: `show${EVENT_KEY}`,
				SHOWN: `shown${EVENT_KEY}`,
				CLICK_DATA_API: `click${EVENT_KEY}${DATA_API_KEY}`
			};

			const ClassName = {
				DROPDOWN_MENU: 'dropdown-menu',
				ACTIVE: 'active',
				DISABLED: 'disabled',
				FADE: 'fade',
				SHOW: 'show'
			};

			const Selector = {
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
			class Tab {
				constructor(element) {
					this._element = element;
				}

				// Getters

				static get VERSION() {
					return VERSION;
				}

				// Public

				show() {
					if (
						(this._element.parentNode &&
							this._element.parentNode.nodeType === Node.ELEMENT_NODE &&
							jQuery(this._element).hasClass(ClassName.ACTIVE)) ||
						jQuery(this._element).hasClass(ClassName.DISABLED)
					) {
						return;
					}

					let target;
					let previous;
					const listElement = jQuery(this._element).closest(Selector.NAV_LIST_GROUP)[0];
					const selector = Util.getSelectorFromElement(this._element);

					if (listElement) {
						const itemSelector =
							listElement.nodeName === 'UL' || listElement.nodeName === 'OL'
								? Selector.ACTIVE_UL
								: Selector.ACTIVE;
						previous = jQuery.makeArray(jQuery(listElement).find(itemSelector));
						previous = previous[previous.length - 1];
					}

					const hideEvent = jQuery.Event(Event.HIDE, {
						relatedTarget: this._element
					});

					const showEvent = jQuery.Event(Event.SHOW, {
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

					const complete = () => {
						const hiddenEvent = jQuery.Event(Event.HIDDEN, {
							relatedTarget: this._element
						});

						const shownEvent = jQuery.Event(Event.SHOWN, {
							relatedTarget: previous
						});

						jQuery(previous).trigger(hiddenEvent);
						jQuery(this._element).trigger(shownEvent);
					};

					if (target) {
						this._activate(target, target.parentNode, complete);
					} else {
						complete();
					}
				}

				dispose() {
					jQuery.removeData(this._element, DATA_KEY);
					this._element = null;
				}

				// Private

				_activate(element, container, callback) {
					const activeElements =
						container && (container.nodeName === 'UL' || container.nodeName === 'OL')
							? jQuery(container).find(Selector.ACTIVE_UL)
							: jQuery(container).children(Selector.ACTIVE);

					const active = activeElements[0];
					const isTransitioning = callback && active && jQuery(active).hasClass(ClassName.FADE);
					const complete = () => this._transitionComplete(element, active, callback);

					if (active && isTransitioning) {
						const transitionDuration = Util.getTransitionDurationFromElement(active);

						jQuery(active)
							.removeClass(ClassName.SHOW)
							.one(Util.TRANSITION_END, complete)
							.emulateTransitionEnd(transitionDuration);
					} else {
						complete();
					}
				}

				_transitionComplete(element, active, callback) {
					if (active) {
						jQuery(active).removeClass(ClassName.ACTIVE);

						const dropdownChild = jQuery(active.parentNode).find(Selector.DROPDOWN_ACTIVE_CHILD)[0];

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
						const dropdownElement = jQuery(element).closest(Selector.DROPDOWN)[0];

						if (dropdownElement) {
							const dropdownToggleList = [].slice.call(
								dropdownElement.querySelectorAll(Selector.DROPDOWN_TOGGLE)
							);

							jQuery(dropdownToggleList).addClass(ClassName.ACTIVE);
						}

						element.setAttribute('aria-expanded', true);
					}

					if (callback) {
						callback();
					}
				}

				// Static

				static _jQueryInterface(config) {
					return this.each(function() {
						const $this = jQuery(this);
						let data = $this.data(DATA_KEY);

						if (!data) {
							data = new Tab(this);
							$this.data(DATA_KEY, data);
						}

						if (typeof config === 'string') {
							if (typeof data[config] === 'undefined') {
								throw new TypeError(`No method named "${config}"`);
							}
							data[config]();
						}
					});
				}
			}

			/**
 * ------------------------------------------------------------------------
 * Data Api implementation
 * ------------------------------------------------------------------------
 */

			jQuery(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function(event) {
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
			jQuery.fn[NAME].noConflict = () => {
				jQuery.fn[NAME] = JQUERY_NO_CONFLICT;
				return Tab._jQueryInterface;
			};

			/* unused harmony default export */ var _unused_webpack_default_export = Tab;

			/***/
		} /* 8 */,
		,
		/* 7 */ /***/ function(module, __webpack_exports__, __webpack_require__) {
			'use strict';
			Object.defineProperty(__webpack_exports__, '__esModule', { value: true });
			/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__modules_Header__ = __webpack_require__(3);
			/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__modules_PromotionSection__ = __webpack_require__(5);
			/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__modules_Modal__ = __webpack_require__(4);
			/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__modules_Events__ = __webpack_require__(2);
			/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__modules_Accordion__ = __webpack_require__(0);
			/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__modules_DocSearch__ = __webpack_require__(1);
			/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__modules_Tabs__ = __webpack_require__(6);

			class Modula {
				constructor() {
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

				initHeader() {
					new __WEBPACK_IMPORTED_MODULE_0__modules_Header__['a' /* default */](jQuery('.header'));
				}

				initPromotionSection() {
					new __WEBPACK_IMPORTED_MODULE_1__modules_PromotionSection__['a' /* default */](
						jQuery('.promotion-section')
					);
				}

				initScrollAnimation() {
					jQuery('a[href*="#"]:not([href="#"])').on('click', function(e) {
						let target;
						if (
							location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') &&
							location.hostname === this.hostname
						) {
							target = jQuery(this.hash);
							target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
							if (target.length) {
								e.preventDefault();
								jQuery('html, body').animate({ scrollTop: target.offset().top }, 1000, 'swing');
							}
						}
					});
				}

				initModals() {
					new __WEBPACK_IMPORTED_MODULE_2__modules_Modal__['a' /* default */](
						'modal-1',
						jQuery('.modal--login'),
						jQuery('.login-link')
					);
					new __WEBPACK_IMPORTED_MODULE_2__modules_Modal__['a' /* default */](
						'modal-2',
						jQuery('.modal--video'),
						jQuery('.banner-section .hero__img, .banner-section .hero__play-icon, .hero-section-2__hero')
					);
					jQuery('.changelog-link').each(function() {
						var count = jQuery(this).attr('data-count');
						new __WEBPACK_IMPORTED_MODULE_2__modules_Modal__[
							'a' /* default */
						]('modal-changelog-' + count, jQuery('#modal--changelog-' + count), jQuery('#changelog-link-' + count));
					});
				}

				initAccordions($elements = jQuery('.accordion')) {
					$elements.each(function(index) {
						new __WEBPACK_IMPORTED_MODULE_4__modules_Accordion__['a' /* default */](jQuery(this));
					});
				}

				initDocSearch($elements = jQuery('.doc-search')) {
					$elements.each(function() {
						new __WEBPACK_IMPORTED_MODULE_5__modules_DocSearch__['a' /* default */](jQuery(this));
					});
				}

				initEvents() {
					new __WEBPACK_IMPORTED_MODULE_3__modules_Events__['a' /* default */]();
				}

				initWaypoints() {
					if (typeof Waypoint === 'undefined') {
						return;
					}

					jQuery('.illustration').each(function() {
						let $illustration = jQuery(this);

						new Waypoint({
							element: $illustration,
							offset: '36%',
							handler: function(direction) {
								$illustration.addClass('illustration--animate');
							}
						});
					});

					jQuery('.waypoint').each(function() {
						let $element = jQuery(this);

						new Waypoint({
							element: $element,
							offset: '75%',
							handler: function(direction) {
								$element.addClass('in-viewport');
							}
						});
					});
				}

				initPostNavigation() {
					if (typeof Waypoint === 'undefined') {
						return;
					}

					if (jQuery('.post-navigation').length == 0) {
						return;
					}

					let $postNavigation = jQuery('.post-navigation');

					// make the post navigation stick
					new Waypoint({
						element: jQuery('.post-content'),
						offset: '200px',
						handler: function(direction) {
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
						handler: function(direction) {
							if ('down' === direction) {
								$postNavigation.addClass('invisible');
							}
							if ('up' === direction) {
								$postNavigation.removeClass('invisible');
							}
						}
					});

					// hide/show the post navigation when hovering over alignwide and alignfull elements
					jQuery('.post-content .alignwide, .post-content .alignfull').on('mouseenter', () => {
						$postNavigation.addClass('invisible');
					});

					jQuery('.post-content .alignwide, .post-content .alignfull').on('mouseleave', () => {
						$postNavigation.removeClass('invisible');
					});

					//strip dashes in toc links
					jQuery('.post-navigation').find('.ez-toc-list a').each(function(index) {
						var href = jQuery(this).attr('href');
						href = href.replace('-_', '');
						jQuery(this).attr('href', href);
					});
				}

				initCurrency() {
					var cpoSymbols = {
						EUR: '&euro;',
						GBP: '&pound;',
						USD: '&dollar;'
					};

					jQuery(window).on('ppeddfsAfterFsMarkup', function() {
						jQuery('span.fsc-currency').each(function() {
							var $span = jQuery(this),
								currency = $span.text();

							if (cpoSymbols[currency]) {
								$span.html(cpoSymbols[currency]);
							}
						});
					});
				}

				initCheckoutPage() {
					if (!jQuery('body').hasClass('page-template-checkout')) {
						return;
					}

					//new CheckoutPage();
				}
			}
			window.Modula = new Modula();

			/***/
		}
		/******/
	]
);
