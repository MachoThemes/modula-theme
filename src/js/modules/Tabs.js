const TRANSITION_END = 'transitionend'
const MAX_UID = 1000000
const MILLISECONDS_MULTIPLIER = 1000

// Shoutout AngusCroll (https://goo.gl/pxwQGp)
function toType(obj) {
  return {}.toString.call(obj).match(/\s([a-z]+)/i)[1].toLowerCase()
}

function getSpecialTransitionEndEvent() {
  return {
    bindType: TRANSITION_END,
    delegateType: TRANSITION_END,
    handle(event) {
      if (jQuery(event.target).is(this)) {
        return event.handleObj.handler.apply(this, arguments) // eslint-disable-line prefer-rest-params
      }
      return undefined // eslint-disable-line no-undefined
    }
  }
}

function transitionEndEmulator(duration) {
  let called = false

  jQuery(this).one(Util.TRANSITION_END, () => {
    called = true
  })

  setTimeout(() => {
    if (!called) {
      Util.triggerTransitionEnd(this)
    }
  }, duration)

  return this
}

function setTransitionEndSupport() {
  jQuery.fn.emulateTransitionEnd = transitionEndEmulator
  jQuery.event.special[Util.TRANSITION_END] = getSpecialTransitionEndEvent()
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
      prefix += ~~(Math.random() * MAX_UID) // "~~" acts like a faster Math.floor() here
    } while (document.getElementById(prefix))
    return prefix
  },

  getSelectorFromElement(element) {
    let selector = element.getAttribute('data-target')

    if (!selector || selector === '#') {
      const hrefAttr = element.getAttribute('href')
      selector = hrefAttr && hrefAttr !== '#' ? hrefAttr.trim() : ''
    }

    try {
      return document.querySelector(selector) ? selector : null
    } catch (err) {
      return null
    }
  },

  getTransitionDurationFromElement(element) {
    if (!element) {
      return 0
    }

    // Get transition-duration of the element
    let transitionDuration = jQuery(element).css('transition-duration')
    let transitionDelay = jQuery(element).css('transition-delay')

    const floatTransitionDuration = parseFloat(transitionDuration)
    const floatTransitionDelay = parseFloat(transitionDelay)

    // Return 0 if element or transition duration is not found
    if (!floatTransitionDuration && !floatTransitionDelay) {
      return 0
    }

    // If multiple durations are defined, take the first
    transitionDuration = transitionDuration.split(',')[0]
    transitionDelay = transitionDelay.split(',')[0]

    return (parseFloat(transitionDuration) + parseFloat(transitionDelay)) * MILLISECONDS_MULTIPLIER
  },

  reflow(element) {
    return element.offsetHeight
  },

  triggerTransitionEnd(element) {
    jQuery(element).trigger(TRANSITION_END)
  },

  // TODO: Remove in v5
  supportsTransitionEnd() {
    return Boolean(TRANSITION_END)
  },

  isElement(obj) {
    return (obj[0] || obj).nodeType
  },

  typeCheckConfig(componentName, config, configTypes) {
    for (const property in configTypes) {
      if (Object.prototype.hasOwnProperty.call(configTypes, property)) {
        const expectedTypes = configTypes[property]
        const value         = config[property]
        const valueType     = value && Util.isElement(value)
          ? 'element' : toType(value)

        if (!new RegExp(expectedTypes).test(valueType)) {
          throw new Error(
            `${componentName.toUpperCase()}: ` +
            `Option "${property}" provided type "${valueType}" ` +
            `but expected type "${expectedTypes}".`)
        }
      }
    }
  },

  findShadowRoot(element) {
    if (!document.documentElement.attachShadow) {
      return null
    }

    // Can find the shadow root otherwise it'll return the document
    if (typeof element.getRootNode === 'function') {
      const root = element.getRootNode()
      return root instanceof ShadowRoot ? root : null
    }

    if (element instanceof ShadowRoot) {
      return element
    }

    // when we don't find a shadow root
    if (!element.parentNode) {
      return null
    }

    return Util.findShadowRoot(element.parentNode)
  }
}

setTransitionEndSupport()

/**
 * ------------------------------------------------------------------------
 * Constants
 * ------------------------------------------------------------------------
 */

const NAME               = 'tab'
const VERSION            = '4.3.1'
const DATA_KEY           = 'bs.tab'
const EVENT_KEY          = `.${DATA_KEY}`
const DATA_API_KEY       = '.data-api'
const JQUERY_NO_CONFLICT = jQuery.fn[NAME]

const Event = {
  HIDE           : `hide${EVENT_KEY}`,
  HIDDEN         : `hidden${EVENT_KEY}`,
  SHOW           : `show${EVENT_KEY}`,
  SHOWN          : `shown${EVENT_KEY}`,
  CLICK_DATA_API : `click${EVENT_KEY}${DATA_API_KEY}`
}

const ClassName = {
  DROPDOWN_MENU : 'dropdown-menu',
  ACTIVE        : 'active',
  DISABLED      : 'disabled',
  FADE          : 'fade',
  SHOW          : 'show'
}

const Selector = {
  DROPDOWN              : '.dropdown',
  NAV_LIST_GROUP        : '.nav, .list-group',
  ACTIVE                : '.active',
  ACTIVE_UL             : 'li > .active',
  DATA_TOGGLE           : '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]',
  DROPDOWN_TOGGLE       : '.dropdown-toggle',
  DROPDOWN_ACTIVE_CHILD : '> .dropdown-menu .active'
}

/**
 * ------------------------------------------------------------------------
 * Class Definition
 * ------------------------------------------------------------------------
 */

class Tab {
  constructor(element) {
    this._element = element
  }

  // Getters

  static get VERSION() {
    return VERSION
  }

  // Public

  show() {
    if (this._element.parentNode &&
        this._element.parentNode.nodeType === Node.ELEMENT_NODE &&
        jQuery(this._element).hasClass(ClassName.ACTIVE) ||
        jQuery(this._element).hasClass(ClassName.DISABLED)) {
      return
    }

    let target
    let previous
    const listElement = jQuery(this._element).closest(Selector.NAV_LIST_GROUP)[0]
    const selector = Util.getSelectorFromElement(this._element)

    if (listElement) {
      const itemSelector = listElement.nodeName === 'UL' || listElement.nodeName === 'OL' ? Selector.ACTIVE_UL : Selector.ACTIVE
      previous = jQuery.makeArray(jQuery(listElement).find(itemSelector))
      previous = previous[previous.length - 1]
    }

    const hideEvent = jQuery.Event(Event.HIDE, {
      relatedTarget: this._element
    })

    const showEvent = jQuery.Event(Event.SHOW, {
      relatedTarget: previous
    })

    if (previous) {
      jQuery(previous).trigger(hideEvent)
    }

    jQuery(this._element).trigger(showEvent)

    if (showEvent.isDefaultPrevented() ||
        hideEvent.isDefaultPrevented()) {
      return
    }

    if (selector) {
      target = document.querySelector(selector)
    }

    this._activate(
      this._element,
      listElement
    )

    const complete = () => {
      const hiddenEvent = jQuery.Event(Event.HIDDEN, {
        relatedTarget: this._element
      })

      const shownEvent = jQuery.Event(Event.SHOWN, {
        relatedTarget: previous
      })

      jQuery(previous).trigger(hiddenEvent)
      jQuery(this._element).trigger(shownEvent)
    }

    if (target) {
      this._activate(target, target.parentNode, complete)
    } else {
      complete()
    }
  }

  dispose() {
    jQuery.removeData(this._element, DATA_KEY)
    this._element = null
  }

  // Private

  _activate(element, container, callback) {
    const activeElements = container && (container.nodeName === 'UL' || container.nodeName === 'OL')
      ? jQuery(container).find(Selector.ACTIVE_UL)
      : jQuery(container).children(Selector.ACTIVE)

    const active = activeElements[0]
    const isTransitioning = callback && (active && jQuery(active).hasClass(ClassName.FADE))
    const complete = () => this._transitionComplete(
      element,
      active,
      callback
    )

    if (active && isTransitioning) {
      const transitionDuration = Util.getTransitionDurationFromElement(active)

      jQuery(active)
        .removeClass(ClassName.SHOW)
        .one(Util.TRANSITION_END, complete)
        .emulateTransitionEnd(transitionDuration)
    } else {
      complete()
    }
  }

  _transitionComplete(element, active, callback) {
    if (active) {
      jQuery(active).removeClass(ClassName.ACTIVE)

      const dropdownChild = jQuery(active.parentNode).find(
        Selector.DROPDOWN_ACTIVE_CHILD
      )[0]

      if (dropdownChild) {
        jQuery(dropdownChild).removeClass(ClassName.ACTIVE)
      }

      if (active.getAttribute('role') === 'tab') {
        active.setAttribute('aria-selected', false)
      }
    }

    jQuery(element).addClass(ClassName.ACTIVE)
    if (element.getAttribute('role') === 'tab') {
      element.setAttribute('aria-selected', true)
    }

    Util.reflow(element)

    if (element.classList.contains(ClassName.FADE)) {
      element.classList.add(ClassName.SHOW)
    }

    if (element.parentNode && jQuery(element.parentNode).hasClass(ClassName.DROPDOWN_MENU)) {
      const dropdownElement = jQuery(element).closest(Selector.DROPDOWN)[0]

      if (dropdownElement) {
        const dropdownToggleList = [].slice.call(dropdownElement.querySelectorAll(Selector.DROPDOWN_TOGGLE))

        jQuery(dropdownToggleList).addClass(ClassName.ACTIVE)
      }

      element.setAttribute('aria-expanded', true)
    }

    if (callback) {
      callback()
    }
  }

  // Static

  static _jQueryInterface(config) {
    return this.each(function () {
      const $this = jQuery(this)
      let data = $this.data(DATA_KEY)

      if (!data) {
        data = new Tab(this)
        $this.data(DATA_KEY, data)
      }

      if (typeof config === 'string') {
        if (typeof data[config] === 'undefined') {
          throw new TypeError(`No method named "${config}"`)
        }
        data[config]()
      }
    })
  }
}

/**
 * ------------------------------------------------------------------------
 * Data Api implementation
 * ------------------------------------------------------------------------
 */

jQuery(document)
  .on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function (event) {
    event.preventDefault()
    Tab._jQueryInterface.call(jQuery(this), 'show')
  })

/**
 * ------------------------------------------------------------------------
 * jQuery
 * ------------------------------------------------------------------------
 */

jQuery.fn[NAME] = Tab._jQueryInterface
jQuery.fn[NAME].Constructor = Tab
jQuery.fn[NAME].noConflict = () => {
  jQuery.fn[NAME] = JQUERY_NO_CONFLICT
  return Tab._jQueryInterface
}

export default Tab
