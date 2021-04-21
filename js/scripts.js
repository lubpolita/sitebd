/*!
    * Start Bootstrap - Creative v6.0.4 (https://startbootstrap.com/theme/creative)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-creative/blob/master/LICENSE)
    */
    (function($) {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 72)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#mainNav',
    offset: 75
  });

  // Collapse Navbar
  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-scrolled");
    } else {
      $("#mainNav").removeClass("navbar-scrolled");
    }
  };
  // Collapse now if page is not at top
  navbarCollapse();
  // Collapse the navbar when page is scrolled
  $(window).scroll(navbarCollapse);

  // Magnific popup calls
  $('#portfolio').magnificPopup({
    delegate: 'a',
    type: 'image',
    tLoading: 'Loading image #%curr%...',
    mainClass: 'mfp-img-mobile',
    gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0, 1]
    },
    image: {
      tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
    }
  });

})(jQuery); // End of use strict




(function (factory, jQuery, Zepto) {

  if (typeof define === 'function' && define.amd) {
      define(['jquery'], factory);
  } else if (typeof exports === 'object' && typeof Meteor === 'undefined') {
      module.exports = factory(require('jquery'));
  } else {
      factory(jQuery || Zepto);
  }

}(function ($) {
  'use strict';

  var Mask = function (el, mask, options) {

      var p = {
          invalid: [],
          getCaret: function () {
              try {
                  var sel,
                      pos = 0,
                      ctrl = el.get(0),
                      dSel = document.selection,
                      cSelStart = ctrl.selectionStart;

                  // IE Support
                  if (dSel && navigator.appVersion.indexOf('MSIE 10') === -1) {
                      sel = dSel.createRange();
                      sel.moveStart('character', -p.val().length);
                      pos = sel.text.length;
                  }
                  // Firefox support
                  else if (cSelStart || cSelStart === '0') {
                      pos = cSelStart;
                  }

                  return pos;
              } catch (e) {}
          },
          setCaret: function(pos) {
              try {
                  if (el.is(':focus')) {
                      var range, ctrl = el.get(0);

                      // Firefox, WebKit, etc..
                      if (ctrl.setSelectionRange) {
                          ctrl.setSelectionRange(pos, pos);
                      } else { // IE
                          range = ctrl.createTextRange();
                          range.collapse(true);
                          range.moveEnd('character', pos);
                          range.moveStart('character', pos);
                          range.select();
                      }
                  }
              } catch (e) {}
          },
          events: function() {
              el
              .on('keydown.mask', function(e) {
                  el.data('mask-keycode', e.keyCode || e.which);
                  el.data('mask-previus-value', el.val());
                  el.data('mask-previus-caret-pos', p.getCaret());
                  p.maskDigitPosMapOld = p.maskDigitPosMap;
              })
              .on($.jMaskGlobals.useInput ? 'input.mask' : 'keyup.mask', p.behaviour)
              .on('paste.mask drop.mask', function() {
                  setTimeout(function() {
                      el.keydown().keyup();
                  }, 100);
              })
              .on('change.mask', function(){
                  el.data('changed', true);
              })
              .on('blur.mask', function(){
                  if (oldValue !== p.val() && !el.data('changed')) {
                      el.trigger('change');
                  }
                  el.data('changed', false);
              })
              // it's very important that this callback remains in this position
              // otherwhise oldValue it's going to work buggy
              .on('blur.mask', function() {
                  oldValue = p.val();
              })
              // select all text on focus
              .on('focus.mask', function (e) {
                  if (options.selectOnFocus === true) {
                      $(e.target).select();
                  }
              })
              // clear the value if it not complete the mask
              .on('focusout.mask', function() {
                  if (options.clearIfNotMatch && !regexMask.test(p.val())) {
                     p.val('');
                 }
              });
          },
          getRegexMask: function() {
              var maskChunks = [], translation, pattern, optional, recursive, oRecursive, r;

              for (var i = 0; i < mask.length; i++) {
                  translation = jMask.translation[mask.charAt(i)];

                  if (translation) {

                      pattern = translation.pattern.toString().replace(/.{1}$|^.{1}/g, '');
                      optional = translation.optional;
                      recursive = translation.recursive;

                      if (recursive) {
                          maskChunks.push(mask.charAt(i));
                          oRecursive = {digit: mask.charAt(i), pattern: pattern};
                      } else {
                          maskChunks.push(!optional && !recursive ? pattern : (pattern + '?'));
                      }

                  } else {
                      maskChunks.push(mask.charAt(i).replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'));
                  }
              }

              r = maskChunks.join('');

              if (oRecursive) {
                  r = r.replace(new RegExp('(' + oRecursive.digit + '(.*' + oRecursive.digit + ')?)'), '($1)?')
                       .replace(new RegExp(oRecursive.digit, 'g'), oRecursive.pattern);
              }

              return new RegExp(r);
          },
          destroyEvents: function() {
              el.off(['input', 'keydown', 'keyup', 'paste', 'drop', 'blur', 'focusout', ''].join('.mask '));
          },
          val: function(v) {
              var isInput = el.is('input'),
                  method = isInput ? 'val' : 'text',
                  r;

              if (arguments.length > 0) {
                  if (el[method]() !== v) {
                      el[method](v);
                  }
                  r = el;
              } else {
                  r = el[method]();
              }

              return r;
          },
          calculateCaretPosition: function(oldVal) {
              var newVal = p.getMasked(),
                  caretPosNew = p.getCaret();
              if (oldVal !== newVal) {
                  var caretPosOld = el.data('mask-previus-caret-pos') || 0,
                      newValL = newVal.length,
                      oldValL = oldVal.length,
                      maskDigitsBeforeCaret = 0,
                      maskDigitsAfterCaret = 0,
                      maskDigitsBeforeCaretAll = 0,
                      maskDigitsBeforeCaretAllOld = 0,
                      i = 0;

                  for (i = caretPosNew; i < newValL; i++) {
                      if (!p.maskDigitPosMap[i]) {
                          break;
                      }
                      maskDigitsAfterCaret++;
                  }

                  for (i = caretPosNew - 1; i >= 0; i--) {
                      if (!p.maskDigitPosMap[i]) {
                          break;
                      }
                      maskDigitsBeforeCaret++;
                  }

                  for (i = caretPosNew - 1; i >= 0; i--) {
                      if (p.maskDigitPosMap[i]) {
                          maskDigitsBeforeCaretAll++;
                      }
                  }

                  for (i = caretPosOld - 1; i >= 0; i--) {
                      if (p.maskDigitPosMapOld[i]) {
                          maskDigitsBeforeCaretAllOld++;
                      }
                  }


                  if (caretPosNew > oldValL) {
                    caretPosNew = newValL * 10;
                  } else if (caretPosOld >= caretPosNew && caretPosOld !== oldValL) {
                      if (!p.maskDigitPosMapOld[caretPosNew])  {
                        var caretPos = caretPosNew;
                        caretPosNew -= maskDigitsBeforeCaretAllOld - maskDigitsBeforeCaretAll;
                        caretPosNew -= maskDigitsBeforeCaret;
                        if (p.maskDigitPosMap[caretPosNew])  {
                          caretPosNew = caretPos;
                        }
                      }
                  }
                  else if (caretPosNew > caretPosOld) {
                      caretPosNew += maskDigitsBeforeCaretAll - maskDigitsBeforeCaretAllOld;
                      caretPosNew += maskDigitsAfterCaret;
                  }
              }
              return caretPosNew;
          },
          behaviour: function(e) {
              e = e || window.event;
              p.invalid = [];

              var keyCode = el.data('mask-keycode');

              if ($.inArray(keyCode, jMask.byPassKeys) === -1) {
                  var newVal = p.getMasked(),
                      caretPos = p.getCaret(),
                      oldVal = el.data('mask-previus-value') || '';

                
                  setTimeout(function() {
                    p.setCaret(p.calculateCaretPosition(oldVal));
                  }, $.jMaskGlobals.keyStrokeCompensation);

                  p.val(newVal);
                  p.setCaret(caretPos);
                  return p.callbacks(e);
              }
          },
          getMasked: function(skipMaskChars, val) {
              var buf = [],
                  value = val === undefined ? p.val() : val + '',
                  m = 0, maskLen = mask.length,
                  v = 0, valLen = value.length,
                  offset = 1, addMethod = 'push',
                  resetPos = -1,
                  maskDigitCount = 0,
                  maskDigitPosArr = [],
                  lastMaskChar,
                  check;

              if (options.reverse) {
                  addMethod = 'unshift';
                  offset = -1;
                  lastMaskChar = 0;
                  m = maskLen - 1;
                  v = valLen - 1;
                  check = function () {
                      return m > -1 && v > -1;
                  };
              } else {
                  lastMaskChar = maskLen - 1;
                  check = function () {
                      return m < maskLen && v < valLen;
                  };
              }

              var lastUntranslatedMaskChar;
              while (check()) {
                  var maskDigit = mask.charAt(m),
                      valDigit = value.charAt(v),
                      translation = jMask.translation[maskDigit];

                  if (translation) {
                      if (valDigit.match(translation.pattern)) {
                          buf[addMethod](valDigit);
                           if (translation.recursive) {
                              if (resetPos === -1) {
                                  resetPos = m;
                              } else if (m === lastMaskChar && m !== resetPos) {
                                  m = resetPos - offset;
                              }

                              if (lastMaskChar === resetPos) {
                                  m -= offset;
                              }
                          }
                          m += offset;
                      } else if (valDigit === lastUntranslatedMaskChar) {
                       
                          maskDigitCount--;
                          lastUntranslatedMaskChar = undefined;
                      } else if (translation.optional) {
                          m += offset;
                          v -= offset;
                      } else if (translation.fallback) {
                          buf[addMethod](translation.fallback);
                          m += offset;
                          v -= offset;
                      } else {
                        p.invalid.push({p: v, v: valDigit, e: translation.pattern});
                      }
                      v += offset;
                  } else {
                      if (!skipMaskChars) {
                          buf[addMethod](maskDigit);
                      }

                      if (valDigit === maskDigit) {
                          maskDigitPosArr.push(v);
                          v += offset;
                      } else {
                          lastUntranslatedMaskChar = maskDigit;
                          maskDigitPosArr.push(v + maskDigitCount);
                          maskDigitCount++;
                      }

                      m += offset;
                  }
              }

              var lastMaskCharDigit = mask.charAt(lastMaskChar);
              if (maskLen === valLen + 1 && !jMask.translation[lastMaskCharDigit]) {
                  buf.push(lastMaskCharDigit);
              }

              var newVal = buf.join('');
              p.mapMaskdigitPositions(newVal, maskDigitPosArr, valLen);
              return newVal;
          },
          mapMaskdigitPositions: function(newVal, maskDigitPosArr, valLen) {
            var maskDiff = options.reverse ? newVal.length - valLen : 0;
            p.maskDigitPosMap = {};
            for (var i = 0; i < maskDigitPosArr.length; i++) {
              p.maskDigitPosMap[maskDigitPosArr[i] + maskDiff] = 1;
            }
          },
          callbacks: function (e) {
              var val = p.val(),
                  changed = val !== oldValue,
                  defaultArgs = [val, e, el, options],
                  callback = function(name, criteria, args) {
                      if (typeof options[name] === 'function' && criteria) {
                          options[name].apply(this, args);
                      }
                  };

              callback('onChange', changed === true, defaultArgs);
              callback('onKeyPress', changed === true, defaultArgs);
              callback('onComplete', val.length === mask.length, defaultArgs);
              callback('onInvalid', p.invalid.length > 0, [val, e, el, p.invalid, options]);
          }
      };

      el = $(el);
      var jMask = this, oldValue = p.val(), regexMask;

      mask = typeof mask === 'function' ? mask(p.val(), undefined, el,  options) : mask;


      jMask.mask = mask;
      jMask.options = options;
      jMask.remove = function() {
          var caret = p.getCaret();
          if (jMask.options.placeholder) {
              el.removeAttr('placeholder');
          }
          if (el.data('mask-maxlength')) {
              el.removeAttr('maxlength');
          }
          p.destroyEvents();
          p.val(jMask.getCleanVal());
          p.setCaret(caret);
          return el;
      };


      jMask.getCleanVal = function() {
         return p.getMasked(true);
      };


      jMask.getMaskedVal = function(val) {
         return p.getMasked(false, val);
      };

     jMask.init = function(onlyMask) {
          onlyMask = onlyMask || false;
          options = options || {};

          jMask.clearIfNotMatch  = $.jMaskGlobals.clearIfNotMatch;
          jMask.byPassKeys       = $.jMaskGlobals.byPassKeys;
          jMask.translation      = $.extend({}, $.jMaskGlobals.translation, options.translation);

          jMask = $.extend(true, {}, jMask, options);

          regexMask = p.getRegexMask();

          if (onlyMask) {
              p.events();
              p.val(p.getMasked());
          } else {
              if (options.placeholder) {
                  el.attr('placeholder' , options.placeholder);
              }

              if (el.data('mask')) {
                el.attr('autocomplete', 'off');
              }

              for (var i = 0, maxlength = true; i < mask.length; i++) {
                  var translation = jMask.translation[mask.charAt(i)];
                  if (translation && translation.recursive) {
                      maxlength = false;
                      break;
                  }
              }

              if (maxlength) {
                  el.attr('maxlength', mask.length).data('mask-maxlength', true);
              }

              p.destroyEvents();
              p.events();

              var caret = p.getCaret();
              p.val(p.getMasked());
              p.setCaret(caret);
          }
      };

      jMask.init(!el.is('input'));
  };

  $.maskWatchers = {};
  var HTMLAttributes = function () {
      var input = $(this),
          options = {},
          prefix = 'data-mask-',
          mask = input.attr('data-mask');

      if (input.attr(prefix + 'reverse')) {
          options.reverse = true;
      }

      if (input.attr(prefix + 'clearifnotmatch')) {
          options.clearIfNotMatch = true;
      }

      if (input.attr(prefix + 'selectonfocus') === 'true') {
         options.selectOnFocus = true;
      }

      if (notSameMaskObject(input, mask, options)) {
          return input.data('mask', new Mask(this, mask, options));
      }
  },
  notSameMaskObject = function(field, mask, options) {
      options = options || {};
      var maskObject = $(field).data('mask'),
          stringify = JSON.stringify,
          value = $(field).val() || $(field).text();
      try {
          if (typeof mask === 'function') {
              mask = mask(value);
          }
          return typeof maskObject !== 'object' || stringify(maskObject.options) !== stringify(options) || maskObject.mask !== mask;
      } catch (e) {}
  },
  eventSupported = function(eventName) {
      var el = document.createElement('div'), isSupported;

      eventName = 'on' + eventName;
      isSupported = (eventName in el);

      if ( !isSupported ) {
          el.setAttribute(eventName, 'return;');
          isSupported = typeof el[eventName] === 'function';
      }
      el = null;

      return isSupported;
  };

  $.fn.mask = function(mask, options) {
      options = options || {};
      var selector = this.selector,
          globals = $.jMaskGlobals,
          interval = globals.watchInterval,
          watchInputs = options.watchInputs || globals.watchInputs,
          maskFunction = function() {
              if (notSameMaskObject(this, mask, options)) {
                  return $(this).data('mask', new Mask(this, mask, options));
              }
          };

      $(this).each(maskFunction);

      if (selector && selector !== '' && watchInputs) {
          clearInterval($.maskWatchers[selector]);
          $.maskWatchers[selector] = setInterval(function(){
              $(document).find(selector).each(maskFunction);
          }, interval);
      }
      return this;
  };

  $.fn.masked = function(val) {
      return this.data('mask').getMaskedVal(val);
  };

  $.fn.unmask = function() {
      clearInterval($.maskWatchers[this.selector]);
      delete $.maskWatchers[this.selector];
      return this.each(function() {
          var dataMask = $(this).data('mask');
          if (dataMask) {
              dataMask.remove().removeData('mask');
          }
      });
  };

  $.fn.cleanVal = function() {
      return this.data('mask').getCleanVal();
  };

  $.applyDataMask = function(selector) {
      selector = selector || $.jMaskGlobals.maskElements;
      var $selector = (selector instanceof $) ? selector : $(selector);
      $selector.filter($.jMaskGlobals.dataMaskAttr).each(HTMLAttributes);
  };

  var globals = {
      maskElements: 'input,td,span,div',
      dataMaskAttr: '[data-mask]',
      dataMask: true,
      watchInterval: 300,
      watchInputs: true,
      keyStrokeCompensation: 10,

      useInput: !/Chrome\/[2-4][0-9]|SamsungBrowser/.test(window.navigator.userAgent) && eventSupported('input'),
      watchDataMask: false,
      byPassKeys: [9, 16, 17, 18, 36, 37, 38, 39, 40, 91],
      translation: {
          '0': {pattern: /\d/},
          '9': {pattern: /\d/, optional: true},
          '#': {pattern: /\d/, recursive: true},
          'A': {pattern: /[a-zA-Z0-9]/},
          'S': {pattern: /[a-zA-Z]/}
      }
  };

  $.jMaskGlobals = $.jMaskGlobals || {};
  globals = $.jMaskGlobals = $.extend(true, {}, globals, $.jMaskGlobals);

  if (globals.dataMask) {
      $.applyDataMask();
  }

  setInterval(function() {
      if ($.jMaskGlobals.watchDataMask) {
          $.applyDataMask();
      }
  }, globals.watchInterval);
}, window.jQuery, window.Zepto));


var $jscomp=$jscomp||{};$jscomp.scope={};$jscomp.findInternal=function(a,n,f){a instanceof String&&(a=String(a));for(var p=a.length,k=0;k<p;k++){var b=a[k];if(n.call(f,b,k,a))return{i:k,v:b}}return{i:-1,v:void 0}};$jscomp.ASSUME_ES5=!1;$jscomp.ASSUME_NO_NATIVE_MAP=!1;$jscomp.ASSUME_NO_NATIVE_SET=!1;$jscomp.SIMPLE_FROUND_POLYFILL=!1;
$jscomp.defineProperty=$jscomp.ASSUME_ES5||"function"==typeof Object.defineProperties?Object.defineProperty:function(a,n,f){a!=Array.prototype&&a!=Object.prototype&&(a[n]=f.value)};$jscomp.getGlobal=function(a){return"undefined"!=typeof window&&window===a?a:"undefined"!=typeof global&&null!=global?global:a};$jscomp.global=$jscomp.getGlobal(this);
$jscomp.polyfill=function(a,n,f,p){if(n){f=$jscomp.global;a=a.split(".");for(p=0;p<a.length-1;p++){var k=a[p];k in f||(f[k]={});f=f[k]}a=a[a.length-1];p=f[a];n=n(p);n!=p&&null!=n&&$jscomp.defineProperty(f,a,{configurable:!0,writable:!0,value:n})}};$jscomp.polyfill("Array.prototype.find",function(a){return a?a:function(a,f){return $jscomp.findInternal(this,a,f).v}},"es6","es3");
(function(a,n,f){"function"===typeof define&&define.amd?define(["jquery"],a):"object"===typeof exports&&"undefined"===typeof Meteor?module.exports=a(require("jquery")):a(n||f)})(function(a){var n=function(b,d,e){var c={invalid:[],getCaret:function(){try{var a=0,r=b.get(0),h=document.selection,d=r.selectionStart;if(h&&-1===navigator.appVersion.indexOf("MSIE 10")){var e=h.createRange();e.moveStart("character",-c.val().length);a=e.text.length}else if(d||"0"===d)a=d;return a}catch(C){}},setCaret:function(a){try{if(b.is(":focus")){var c=
b.get(0);if(c.setSelectionRange)c.setSelectionRange(a,a);else{var g=c.createTextRange();g.collapse(!0);g.moveEnd("character",a);g.moveStart("character",a);g.select()}}}catch(B){}},events:function(){b.on("keydown.mask",function(a){b.data("mask-keycode",a.keyCode||a.which);b.data("mask-previus-value",b.val());b.data("mask-previus-caret-pos",c.getCaret());c.maskDigitPosMapOld=c.maskDigitPosMap}).on(a.jMaskGlobals.useInput?"input.mask":"keyup.mask",c.behaviour).on("paste.mask drop.mask",function(){setTimeout(function(){b.keydown().keyup()},
100)}).on("change.mask",function(){b.data("changed",!0)}).on("blur.mask",function(){f===c.val()||b.data("changed")||b.trigger("change");b.data("changed",!1)}).on("blur.mask",function(){f=c.val()}).on("focus.mask",function(b){!0===e.selectOnFocus&&a(b.target).select()}).on("focusout.mask",function(){e.clearIfNotMatch&&!k.test(c.val())&&c.val("")})},getRegexMask:function(){for(var a=[],b,c,e,t,f=0;f<d.length;f++)(b=l.translation[d.charAt(f)])?(c=b.pattern.toString().replace(/.{1}$|^.{1}/g,""),e=b.optional,
(b=b.recursive)?(a.push(d.charAt(f)),t={digit:d.charAt(f),pattern:c}):a.push(e||b?c+"?":c)):a.push(d.charAt(f).replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&"));a=a.join("");t&&(a=a.replace(new RegExp("("+t.digit+"(.*"+t.digit+")?)"),"($1)?").replace(new RegExp(t.digit,"g"),t.pattern));return new RegExp(a)},destroyEvents:function(){b.off("input keydown keyup paste drop blur focusout ".split(" ").join(".mask "))},val:function(a){var c=b.is("input")?"val":"text";if(0<arguments.length){if(b[c]()!==a)b[c](a);
c=b}else c=b[c]();return c},calculateCaretPosition:function(a){var d=c.getMasked(),h=c.getCaret();if(a!==d){var e=b.data("mask-previus-caret-pos")||0;d=d.length;var g=a.length,f=a=0,l=0,k=0,m;for(m=h;m<d&&c.maskDigitPosMap[m];m++)f++;for(m=h-1;0<=m&&c.maskDigitPosMap[m];m--)a++;for(m=h-1;0<=m;m--)c.maskDigitPosMap[m]&&l++;for(m=e-1;0<=m;m--)c.maskDigitPosMapOld[m]&&k++;h>g?h=10*d:e>=h&&e!==g?c.maskDigitPosMapOld[h]||(e=h,h=h-(k-l)-a,c.maskDigitPosMap[h]&&(h=e)):h>e&&(h=h+(l-k)+f)}return h},behaviour:function(d){d=
d||window.event;c.invalid=[];var e=b.data("mask-keycode");if(-1===a.inArray(e,l.byPassKeys)){e=c.getMasked();var h=c.getCaret(),g=b.data("mask-previus-value")||"";setTimeout(function(){c.setCaret(c.calculateCaretPosition(g))},a.jMaskGlobals.keyStrokeCompensation);c.val(e);c.setCaret(h);return c.callbacks(d)}},getMasked:function(a,b){var h=[],f=void 0===b?c.val():b+"",g=0,k=d.length,n=0,p=f.length,m=1,r="push",u=-1,w=0;b=[];if(e.reverse){r="unshift";m=-1;var x=0;g=k-1;n=p-1;var A=function(){return-1<
g&&-1<n}}else x=k-1,A=function(){return g<k&&n<p};for(var z;A();){var y=d.charAt(g),v=f.charAt(n),q=l.translation[y];if(q)v.match(q.pattern)?(h[r](v),q.recursive&&(-1===u?u=g:g===x&&g!==u&&(g=u-m),x===u&&(g-=m)),g+=m):v===z?(w--,z=void 0):q.optional?(g+=m,n-=m):q.fallback?(h[r](q.fallback),g+=m,n-=m):c.invalid.push({p:n,v:v,e:q.pattern}),n+=m;else{if(!a)h[r](y);v===y?(b.push(n),n+=m):(z=y,b.push(n+w),w++);g+=m}}a=d.charAt(x);k!==p+1||l.translation[a]||h.push(a);h=h.join("");c.mapMaskdigitPositions(h,
b,p);return h},mapMaskdigitPositions:function(a,b,d){a=e.reverse?a.length-d:0;c.maskDigitPosMap={};for(d=0;d<b.length;d++)c.maskDigitPosMap[b[d]+a]=1},callbacks:function(a){var g=c.val(),h=g!==f,k=[g,a,b,e],l=function(a,b,c){"function"===typeof e[a]&&b&&e[a].apply(this,c)};l("onChange",!0===h,k);l("onKeyPress",!0===h,k);l("onComplete",g.length===d.length,k);l("onInvalid",0<c.invalid.length,[g,a,b,c.invalid,e])}};b=a(b);var l=this,f=c.val(),k;d="function"===typeof d?d(c.val(),void 0,b,e):d;l.mask=
d;l.options=e;l.remove=function(){var a=c.getCaret();l.options.placeholder&&b.removeAttr("placeholder");b.data("mask-maxlength")&&b.removeAttr("maxlength");c.destroyEvents();c.val(l.getCleanVal());c.setCaret(a);return b};l.getCleanVal=function(){return c.getMasked(!0)};l.getMaskedVal=function(a){return c.getMasked(!1,a)};l.init=function(g){g=g||!1;e=e||{};l.clearIfNotMatch=a.jMaskGlobals.clearIfNotMatch;l.byPassKeys=a.jMaskGlobals.byPassKeys;l.translation=a.extend({},a.jMaskGlobals.translation,e.translation);
l=a.extend(!0,{},l,e);k=c.getRegexMask();if(g)c.events(),c.val(c.getMasked());else{e.placeholder&&b.attr("placeholder",e.placeholder);b.data("mask")&&b.attr("autocomplete","off");g=0;for(var f=!0;g<d.length;g++){var h=l.translation[d.charAt(g)];if(h&&h.recursive){f=!1;break}}f&&b.attr("maxlength",d.length).data("mask-maxlength",!0);c.destroyEvents();c.events();g=c.getCaret();c.val(c.getMasked());c.setCaret(g)}};l.init(!b.is("input"))};a.maskWatchers={};var f=function(){var b=a(this),d={},e=b.attr("data-mask");
b.attr("data-mask-reverse")&&(d.reverse=!0);b.attr("data-mask-clearifnotmatch")&&(d.clearIfNotMatch=!0);"true"===b.attr("data-mask-selectonfocus")&&(d.selectOnFocus=!0);if(p(b,e,d))return b.data("mask",new n(this,e,d))},p=function(b,d,e){e=e||{};var c=a(b).data("mask"),f=JSON.stringify;b=a(b).val()||a(b).text();try{return"function"===typeof d&&(d=d(b)),"object"!==typeof c||f(c.options)!==f(e)||c.mask!==d}catch(w){}},k=function(a){var b=document.createElement("div");a="on"+a;var e=a in b;e||(b.setAttribute(a,
"return;"),e="function"===typeof b[a]);return e};a.fn.mask=function(b,d){d=d||{};var e=this.selector,c=a.jMaskGlobals,f=c.watchInterval;c=d.watchInputs||c.watchInputs;var k=function(){if(p(this,b,d))return a(this).data("mask",new n(this,b,d))};a(this).each(k);e&&""!==e&&c&&(clearInterval(a.maskWatchers[e]),a.maskWatchers[e]=setInterval(function(){a(document).find(e).each(k)},f));return this};a.fn.masked=function(a){return this.data("mask").getMaskedVal(a)};a.fn.unmask=function(){clearInterval(a.maskWatchers[this.selector]);
delete a.maskWatchers[this.selector];return this.each(function(){var b=a(this).data("mask");b&&b.remove().removeData("mask")})};a.fn.cleanVal=function(){return this.data("mask").getCleanVal()};a.applyDataMask=function(b){b=b||a.jMaskGlobals.maskElements;(b instanceof a?b:a(b)).filter(a.jMaskGlobals.dataMaskAttr).each(f)};k={maskElements:"input,td,span,div",dataMaskAttr:"*[data-mask]",dataMask:!0,watchInterval:300,watchInputs:!0,keyStrokeCompensation:10,useInput:!/Chrome\/[2-4][0-9]|SamsungBrowser/.test(window.navigator.userAgent)&&
k("input"),watchDataMask:!1,byPassKeys:[9,16,17,18,36,37,38,39,40,91],translation:{0:{pattern:/\d/},9:{pattern:/\d/,optional:!0},"#":{pattern:/\d/,recursive:!0},A:{pattern:/[a-zA-Z0-9]/},S:{pattern:/[a-zA-Z]/}}};a.jMaskGlobals=a.jMaskGlobals||{};k=a.jMaskGlobals=a.extend(!0,{},k,a.jMaskGlobals);k.dataMask&&a.applyDataMask();setInterval(function(){a.jMaskGlobals.watchDataMask&&a.applyDataMask()},k.watchInterval)},window.jQuery,window.Zepto);
