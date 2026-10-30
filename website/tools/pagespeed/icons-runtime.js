/**
 * Template for assets/js/icons.js (build_icons.js fills in __VERSION__ and
 * __ICONS__). createIcons() and replaceElement() follow lucide's own UMD
 * code line for line, so the SVGs get the same attributes and classes.
 */
(function () {
  'use strict';
  var VERSION = '__VERSION__';
  var ICONS = __ICONS__;
  var FULL = 'https://unpkg.com/lucide@' + VERSION + '/dist/umd/lucide.min.js';
  var SVG_NS = 'http://www.w3.org/2000/svg';
  var defaultAttributes = {
    xmlns: SVG_NS, width: 24, height: 24, viewBox: '0 0 24 24', fill: 'none',
    stroke: 'currentColor', 'stroke-width': 2, 'stroke-linecap': 'round', 'stroke-linejoin': 'round'
  };

  // Object spread ({...a, ...b}): later keys win, first insertion sets the order.
  function assign(target) {
    for (var i = 1; i < arguments.length; i++) {
      for (var k in arguments[i]) {
        if (Object.prototype.hasOwnProperty.call(arguments[i], k)) target[k] = arguments[i][k];
      }
    }
    return target;
  }

  function createSVGElement(tag, attrs, children) {
    var el = document.createElementNS(SVG_NS, tag);
    Object.keys(attrs).forEach(function (name) { el.setAttribute(name, String(attrs[name])); });
    (children || []).forEach(function (c) { el.appendChild(createSVGElement(c[0], c[1], c[2])); });
    return el;
  }

  function mergeClasses(classes) {
    return classes.filter(function (c, i, a) {
      return Boolean(c) && c.trim() !== '' && a.indexOf(c) === i;
    }).join(' ').trim();
  }

  function hasA11yProp(props) {
    for (var p in props) {
      if (p.indexOf('aria-') === 0 || p === 'role' || p === 'title') return true;
    }
    return false;
  }

  function toPascalCase(s) {
    var out = '', upperNext = false;
    for (var i = 0; i < s.length; i++) {
      var ch = s.charAt(i);
      if (ch === '-' || ch === '_' || ch <= ' ') { upperNext = out.length > 0; continue; }
      out += out.length === 0 ? ch.toLowerCase() : (upperNext ? ch.toUpperCase() : ch);
      upperNext = false;
    }
    return out.charAt(0).toUpperCase() + out.slice(1);
  }

  function getAttrs(el) {
    var attrs = {};
    Array.prototype.forEach.call(el.attributes, function (a) { attrs[a.name] = a.value; });
    return attrs;
  }

  function getClassNames(attrs) {
    if (!attrs || !attrs['class']) return [];
    return typeof attrs['class'] === 'string' ? attrs['class'].split(' ') : attrs['class'];
  }

  // Returns false when the icon is not in this subset.
  function replaceElement(el, nameAttr, icons, attrs) {
    var iconName = el.getAttribute(nameAttr);
    if (iconName == null) return true;
    var iconNode = icons[toPascalCase(iconName)];
    if (!iconNode) return false;
    var elementAttrs = getAttrs(el);
    var ariaProps = hasA11yProp(elementAttrs) ? {} : { 'aria-hidden': 'true' };
    var iconAttrs = assign({}, defaultAttributes, { 'data-lucide': iconName }, ariaProps, attrs, elementAttrs);
    var classNames = mergeClasses(['lucide', 'lucide-' + iconName].concat(getClassNames(elementAttrs), getClassNames(attrs)));
    if (classNames) iconAttrs['class'] = classNames;
    var svg = createSVGElement('svg', assign({}, defaultAttributes, iconAttrs), iconNode);
    if (el.parentNode) el.parentNode.replaceChild(svg, el);
    return true;
  }

  // An icon name that is not in the subset (added without re-running
  // build_icons.js) makes the page load the full pinned bundle, which then
  // takes over window.lucide and draws everything.
  var loadingFull = false;
  function loadFull(attrs) {
    if (loadingFull) return;
    loadingFull = true;
    var s = document.createElement('script');
    s.src = FULL;
    s.onload = function () {
      if (window.lucide && window.lucide.createIcons !== createIcons) window.lucide.createIcons({ attrs: attrs });
    };
    document.head.appendChild(s);
  }

  function createIcons(options) {
    var o = options || {};
    var icons = o.icons || ICONS;
    var nameAttr = o.nameAttr || 'data-lucide';
    var attrs = o.attrs || {};
    var root = o.root || document;
    var missing = false;
    Array.prototype.slice.call(root.querySelectorAll('[' + nameAttr + ']')).forEach(function (el) {
      if (!replaceElement(el, nameAttr, icons, attrs)) missing = true;
    });
    if (nameAttr === 'data-lucide') {
      Array.prototype.slice.call(root.querySelectorAll('[icon-name]')).forEach(function (el) {
        if (!replaceElement(el, 'icon-name', icons, attrs)) missing = true;
      });
    }
    if (missing && !o.icons) loadFull(attrs);
  }

  window.lucide = { createIcons: createIcons, icons: ICONS, version: VERSION };
})();
