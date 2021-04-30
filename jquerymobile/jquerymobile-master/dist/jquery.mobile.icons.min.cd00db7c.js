// modules are defined as an array
// [ module function, map of requires ]
//
// map of requires is short require name -> numeric require
//
// anything defined in a previous bundle is accessed via the
// orig method which is the require for previous bundles
parcelRequire = (function (modules, cache, entry, globalName) {
  // Save the require from previous bundle to this closure if any
  var previousRequire = typeof parcelRequire === 'function' && parcelRequire;
  var nodeRequire = typeof require === 'function' && require;

  function newRequire(name, jumped) {
    if (!cache[name]) {
      if (!modules[name]) {
        // if we cannot find the module within our internal map or
        // cache jump to the current global require ie. the last bundle
        // that was added to the page.
        var currentRequire = typeof parcelRequire === 'function' && parcelRequire;
        if (!jumped && currentRequire) {
          return currentRequire(name, true);
        }

        // If there are other bundles on this page the require from the
        // previous one is saved to 'previousRequire'. Repeat this as
        // many times as there are bundles until the module is found or
        // we exhaust the require chain.
        if (previousRequire) {
          return previousRequire(name, true);
        }

        // Try the node require function if it exists.
        if (nodeRequire && typeof name === 'string') {
          return nodeRequire(name);
        }

        var err = new Error('Cannot find module \'' + name + '\'');
        err.code = 'MODULE_NOT_FOUND';
        throw err;
      }

      localRequire.resolve = resolve;
      localRequire.cache = {};

      var module = cache[name] = new newRequire.Module(name);

      modules[name][0].call(module.exports, localRequire, module, module.exports, this);
    }

    return cache[name].exports;

    function localRequire(x){
      return newRequire(localRequire.resolve(x));
    }

    function resolve(x){
      return modules[name][1][x] || x;
    }
  }

  function Module(moduleName) {
    this.id = moduleName;
    this.bundle = newRequire;
    this.exports = {};
  }

  newRequire.isParcelRequire = true;
  newRequire.Module = Module;
  newRequire.modules = modules;
  newRequire.cache = cache;
  newRequire.parent = previousRequire;
  newRequire.register = function (id, exports) {
    modules[id] = [function (require, module) {
      module.exports = exports;
    }, {}];
  };

  var error;
  for (var i = 0; i < entry.length; i++) {
    try {
      newRequire(entry[i]);
    } catch (e) {
      // Save first error but execute all entries
      if (!error) {
        error = e;
      }
    }
  }

  if (entry.length) {
    // Expose entry point to Node, AMD or browser globals
    // Based on https://github.com/ForbesLindesay/umd/blob/master/template.js
    var mainExports = newRequire(entry[entry.length - 1]);

    // CommonJS
    if (typeof exports === "object" && typeof module !== "undefined") {
      module.exports = mainExports;

    // RequireJS
    } else if (typeof define === "function" && define.amd) {
     define(function () {
       return mainExports;
     });

    // <script>
    } else if (globalName) {
      this[globalName] = mainExports;
    }
  }

  // Override the current require with this new one
  parcelRequire = newRequire;

  if (error) {
    // throw error from earlier, _after updating parcelRequire_
    throw error;
  }

  return newRequire;
})({"C:/Users/gvim/AppData/Roaming/JetBrains/WebStorm2020.2/node/node-v12.13.1-win-x64/node_modules/parcel-bundler/src/builtins/bundle-url.js":[function(require,module,exports) {
var bundleURL = null;

function getBundleURLCached() {
  if (!bundleURL) {
    bundleURL = getBundleURL();
  }

  return bundleURL;
}

function getBundleURL() {
  // Attempt to find the URL of the current script and use that as the base URL
  try {
    throw new Error();
  } catch (err) {
    var matches = ('' + err.stack).match(/(https?|file|ftp|chrome-extension|moz-extension):\/\/[^)\n]+/g);

    if (matches) {
      return getBaseURL(matches[0]);
    }
  }

  return '/';
}

function getBaseURL(url) {
  return ('' + url).replace(/^((?:https?|file|ftp|chrome-extension|moz-extension):\/\/.+)\/[^/]+$/, '$1') + '/';
}

exports.getBundleURL = getBundleURLCached;
exports.getBaseURL = getBaseURL;
},{}],"C:/Users/gvim/AppData/Roaming/JetBrains/WebStorm2020.2/node/node-v12.13.1-win-x64/node_modules/parcel-bundler/src/builtins/css-loader.js":[function(require,module,exports) {
var bundle = require('./bundle-url');

function updateLink(link) {
  var newLink = link.cloneNode();

  newLink.onload = function () {
    link.remove();
  };

  newLink.href = link.href.split('?')[0] + '?' + Date.now();
  link.parentNode.insertBefore(newLink, link.nextSibling);
}

var cssTimeout = null;

function reloadCSS() {
  if (cssTimeout) {
    return;
  }

  cssTimeout = setTimeout(function () {
    var links = document.querySelectorAll('link[rel="stylesheet"]');

    for (var i = 0; i < links.length; i++) {
      if (bundle.getBaseURL(links[i].href) === bundle.getBundleURL()) {
        updateLink(links[i]);
      }
    }

    cssTimeout = null;
  }, 50);
}

module.exports = reloadCSS;
},{"./bundle-url":"C:/Users/gvim/AppData/Roaming/JetBrains/WebStorm2020.2/node/node-v12.13.1-win-x64/node_modules/parcel-bundler/src/builtins/bundle-url.js"}],"css/themes/jquery.mobile.icons.min.css":[function(require,module,exports) {
var reloadCSS = require('_css_loader');

module.hot.dispose(reloadCSS);
module.hot.accept(reloadCSS);
},{"./images\\icons-png\\action-white.png":[["action-white.2f786b9c.png","css/themes/images/icons-png/action-white.png"],"css/themes/images/icons-png/action-white.png"],"./images\\icons-png\\alert-white.png":[["alert-white.6c44597f.png","css/themes/images/icons-png/alert-white.png"],"css/themes/images/icons-png/alert-white.png"],"./images\\icons-png\\arrow-d-l-white.png":[["arrow-d-l-white.d23ce639.png","css/themes/images/icons-png/arrow-d-l-white.png"],"css/themes/images/icons-png/arrow-d-l-white.png"],"./images\\icons-png\\arrow-d-r-white.png":[["arrow-d-r-white.b36e043f.png","css/themes/images/icons-png/arrow-d-r-white.png"],"css/themes/images/icons-png/arrow-d-r-white.png"],"./images\\icons-png\\arrow-d-white.png":[["arrow-d-white.60226125.png","css/themes/images/icons-png/arrow-d-white.png"],"css/themes/images/icons-png/arrow-d-white.png"],"./images\\icons-png\\arrow-l-white.png":[["arrow-l-white.6f8def4d.png","css/themes/images/icons-png/arrow-l-white.png"],"css/themes/images/icons-png/arrow-l-white.png"],"./images\\icons-png\\arrow-r-white.png":[["arrow-r-white.c9b23bf0.png","css/themes/images/icons-png/arrow-r-white.png"],"css/themes/images/icons-png/arrow-r-white.png"],"./images\\icons-png\\arrow-u-l-white.png":[["arrow-u-l-white.71560650.png","css/themes/images/icons-png/arrow-u-l-white.png"],"css/themes/images/icons-png/arrow-u-l-white.png"],"./images\\icons-png\\arrow-u-r-white.png":[["arrow-u-r-white.6af42015.png","css/themes/images/icons-png/arrow-u-r-white.png"],"css/themes/images/icons-png/arrow-u-r-white.png"],"./images\\icons-png\\arrow-u-white.png":[["arrow-u-white.2a40a395.png","css/themes/images/icons-png/arrow-u-white.png"],"css/themes/images/icons-png/arrow-u-white.png"],"./images\\icons-png\\audio-white.png":[["audio-white.ae8bfd89.png","css/themes/images/icons-png/audio-white.png"],"css/themes/images/icons-png/audio-white.png"],"./images\\icons-png\\back-white.png":[["back-white.f97ebd1c.png","css/themes/images/icons-png/back-white.png"],"css/themes/images/icons-png/back-white.png"],"./images\\icons-png\\bars-white.png":[["bars-white.e94251c5.png","css/themes/images/icons-png/bars-white.png"],"css/themes/images/icons-png/bars-white.png"],"./images\\icons-png\\bullets-white.png":[["bullets-white.d04bf349.png","css/themes/images/icons-png/bullets-white.png"],"css/themes/images/icons-png/bullets-white.png"],"./images\\icons-png\\calendar-white.png":[["calendar-white.e4f3a954.png","css/themes/images/icons-png/calendar-white.png"],"css/themes/images/icons-png/calendar-white.png"],"./images\\icons-png\\camera-white.png":[["camera-white.9f37a928.png","css/themes/images/icons-png/camera-white.png"],"css/themes/images/icons-png/camera-white.png"],"./images\\icons-png\\carat-d-white.png":[["carat-d-white.99d373a3.png","css/themes/images/icons-png/carat-d-white.png"],"css/themes/images/icons-png/carat-d-white.png"],"./images\\icons-png\\carat-l-white.png":[["carat-l-white.451a2893.png","css/themes/images/icons-png/carat-l-white.png"],"css/themes/images/icons-png/carat-l-white.png"],"./images\\icons-png\\carat-r-white.png":[["carat-r-white.7d6366c2.png","css/themes/images/icons-png/carat-r-white.png"],"css/themes/images/icons-png/carat-r-white.png"],"./images\\icons-png\\carat-u-white.png":[["carat-u-white.1698ae47.png","css/themes/images/icons-png/carat-u-white.png"],"css/themes/images/icons-png/carat-u-white.png"],"./images\\icons-png\\check-white.png":[["check-white.cea0e6a0.png","css/themes/images/icons-png/check-white.png"],"css/themes/images/icons-png/check-white.png"],"./images\\icons-png\\clock-white.png":[["clock-white.10414993.png","css/themes/images/icons-png/clock-white.png"],"css/themes/images/icons-png/clock-white.png"],"./images\\icons-png\\cloud-white.png":[["cloud-white.ee236026.png","css/themes/images/icons-png/cloud-white.png"],"css/themes/images/icons-png/cloud-white.png"],"./images\\icons-png\\comment-white.png":[["comment-white.fb707b98.png","css/themes/images/icons-png/comment-white.png"],"css/themes/images/icons-png/comment-white.png"],"./images\\icons-png\\delete-white.png":[["delete-white.141dcffe.png","css/themes/images/icons-png/delete-white.png"],"css/themes/images/icons-png/delete-white.png"],"./images\\icons-png\\edit-white.png":[["edit-white.82f49e97.png","css/themes/images/icons-png/edit-white.png"],"css/themes/images/icons-png/edit-white.png"],"./images\\icons-png\\eye-white.png":[["eye-white.39ec0a10.png","css/themes/images/icons-png/eye-white.png"],"css/themes/images/icons-png/eye-white.png"],"./images\\icons-png\\forbidden-white.png":[["forbidden-white.b9db897b.png","css/themes/images/icons-png/forbidden-white.png"],"css/themes/images/icons-png/forbidden-white.png"],"./images\\icons-png\\forward-white.png":[["forward-white.d30b3aad.png","css/themes/images/icons-png/forward-white.png"],"css/themes/images/icons-png/forward-white.png"],"./images\\icons-png\\gear-white.png":[["gear-white.06bda36c.png","css/themes/images/icons-png/gear-white.png"],"css/themes/images/icons-png/gear-white.png"],"./images\\icons-png\\grid-white.png":[["grid-white.855e9842.png","css/themes/images/icons-png/grid-white.png"],"css/themes/images/icons-png/grid-white.png"],"./images\\icons-png\\heart-white.png":[["heart-white.cb2ad39d.png","css/themes/images/icons-png/heart-white.png"],"css/themes/images/icons-png/heart-white.png"],"./images\\icons-png\\home-white.png":[["home-white.5b46cced.png","css/themes/images/icons-png/home-white.png"],"css/themes/images/icons-png/home-white.png"],"./images\\icons-png\\info-white.png":[["info-white.592468f9.png","css/themes/images/icons-png/info-white.png"],"css/themes/images/icons-png/info-white.png"],"./images\\icons-png\\location-white.png":[["location-white.43dd9bd2.png","css/themes/images/icons-png/location-white.png"],"css/themes/images/icons-png/location-white.png"],"./images\\icons-png\\lock-white.png":[["lock-white.06148a54.png","css/themes/images/icons-png/lock-white.png"],"css/themes/images/icons-png/lock-white.png"],"./images\\icons-png\\mail-white.png":[["mail-white.b23c8e81.png","css/themes/images/icons-png/mail-white.png"],"css/themes/images/icons-png/mail-white.png"],"./images\\icons-png\\minus-white.png":[["minus-white.101997c3.png","css/themes/images/icons-png/minus-white.png"],"css/themes/images/icons-png/minus-white.png"],"./images\\icons-png\\navigation-white.png":[["navigation-white.fac4e71a.png","css/themes/images/icons-png/navigation-white.png"],"css/themes/images/icons-png/navigation-white.png"],"./images\\icons-png\\phone-white.png":[["phone-white.a3afd872.png","css/themes/images/icons-png/phone-white.png"],"css/themes/images/icons-png/phone-white.png"],"./images\\icons-png\\plus-white.png":[["plus-white.865b920b.png","css/themes/images/icons-png/plus-white.png"],"css/themes/images/icons-png/plus-white.png"],"./images\\icons-png\\power-white.png":[["power-white.cc678d8e.png","css/themes/images/icons-png/power-white.png"],"css/themes/images/icons-png/power-white.png"],"./images\\icons-png\\recycle-white.png":[["recycle-white.022eea86.png","css/themes/images/icons-png/recycle-white.png"],"css/themes/images/icons-png/recycle-white.png"],"./images\\icons-png\\refresh-white.png":[["refresh-white.56fa98e5.png","css/themes/images/icons-png/refresh-white.png"],"css/themes/images/icons-png/refresh-white.png"],"./images\\icons-png\\search-white.png":[["search-white.8a1d9331.png","css/themes/images/icons-png/search-white.png"],"css/themes/images/icons-png/search-white.png"],"./images\\icons-png\\shop-white.png":[["shop-white.5862bac0.png","css/themes/images/icons-png/shop-white.png"],"css/themes/images/icons-png/shop-white.png"],"./images\\icons-png\\star-white.png":[["star-white.67e038be.png","css/themes/images/icons-png/star-white.png"],"css/themes/images/icons-png/star-white.png"],"./images\\icons-png\\tag-white.png":[["tag-white.031bf3de.png","css/themes/images/icons-png/tag-white.png"],"css/themes/images/icons-png/tag-white.png"],"./images\\icons-png\\user-white.png":[["user-white.4d3b0450.png","css/themes/images/icons-png/user-white.png"],"css/themes/images/icons-png/user-white.png"],"./images\\icons-png\\video-white.png":[["video-white.42b25195.png","css/themes/images/icons-png/video-white.png"],"css/themes/images/icons-png/video-white.png"],"./images\\icons-png\\action-black.png":[["action-black.100a46bb.png","css/themes/images/icons-png/action-black.png"],"css/themes/images/icons-png/action-black.png"],"./images\\icons-png\\alert-black.png":[["alert-black.a059cceb.png","css/themes/images/icons-png/alert-black.png"],"css/themes/images/icons-png/alert-black.png"],"./images\\icons-png\\arrow-d-black.png":[["arrow-d-black.093b9002.png","css/themes/images/icons-png/arrow-d-black.png"],"css/themes/images/icons-png/arrow-d-black.png"],"./images\\icons-png\\arrow-d-l-black.png":[["arrow-d-l-black.c89f4b2b.png","css/themes/images/icons-png/arrow-d-l-black.png"],"css/themes/images/icons-png/arrow-d-l-black.png"],"./images\\icons-png\\arrow-d-r-black.png":[["arrow-d-r-black.20b9541e.png","css/themes/images/icons-png/arrow-d-r-black.png"],"css/themes/images/icons-png/arrow-d-r-black.png"],"./images\\icons-png\\arrow-l-black.png":[["arrow-l-black.b9b9a6de.png","css/themes/images/icons-png/arrow-l-black.png"],"css/themes/images/icons-png/arrow-l-black.png"],"./images\\icons-png\\arrow-r-black.png":[["arrow-r-black.ac9f8212.png","css/themes/images/icons-png/arrow-r-black.png"],"css/themes/images/icons-png/arrow-r-black.png"],"./images\\icons-png\\arrow-u-black.png":[["arrow-u-black.e96a6673.png","css/themes/images/icons-png/arrow-u-black.png"],"css/themes/images/icons-png/arrow-u-black.png"],"./images\\icons-png\\arrow-u-l-black.png":[["arrow-u-l-black.957e42c1.png","css/themes/images/icons-png/arrow-u-l-black.png"],"css/themes/images/icons-png/arrow-u-l-black.png"],"./images\\icons-png\\arrow-u-r-black.png":[["arrow-u-r-black.e09d5603.png","css/themes/images/icons-png/arrow-u-r-black.png"],"css/themes/images/icons-png/arrow-u-r-black.png"],"./images\\icons-png\\audio-black.png":[["audio-black.807ea8f6.png","css/themes/images/icons-png/audio-black.png"],"css/themes/images/icons-png/audio-black.png"],"./images\\icons-png\\back-black.png":[["back-black.af6b098f.png","css/themes/images/icons-png/back-black.png"],"css/themes/images/icons-png/back-black.png"],"./images\\icons-png\\bars-black.png":[["bars-black.1e424fc9.png","css/themes/images/icons-png/bars-black.png"],"css/themes/images/icons-png/bars-black.png"],"./images\\icons-png\\bullets-black.png":[["bullets-black.3433e2f3.png","css/themes/images/icons-png/bullets-black.png"],"css/themes/images/icons-png/bullets-black.png"],"./images\\icons-png\\calendar-black.png":[["calendar-black.bf9a5c15.png","css/themes/images/icons-png/calendar-black.png"],"css/themes/images/icons-png/calendar-black.png"],"./images\\icons-png\\camera-black.png":[["camera-black.defe142f.png","css/themes/images/icons-png/camera-black.png"],"css/themes/images/icons-png/camera-black.png"],"./images\\icons-png\\carat-d-black.png":[["carat-d-black.3371bff6.png","css/themes/images/icons-png/carat-d-black.png"],"css/themes/images/icons-png/carat-d-black.png"],"./images\\icons-png\\carat-l-black.png":[["carat-l-black.9c4cfb4d.png","css/themes/images/icons-png/carat-l-black.png"],"css/themes/images/icons-png/carat-l-black.png"],"./images\\icons-png\\carat-r-black.png":[["carat-r-black.fc828b15.png","css/themes/images/icons-png/carat-r-black.png"],"css/themes/images/icons-png/carat-r-black.png"],"./images\\icons-png\\carat-u-black.png":[["carat-u-black.6e2ed3c7.png","css/themes/images/icons-png/carat-u-black.png"],"css/themes/images/icons-png/carat-u-black.png"],"./images\\icons-png\\check-black.png":[["check-black.86f8d78c.png","css/themes/images/icons-png/check-black.png"],"css/themes/images/icons-png/check-black.png"],"./images\\icons-png\\clock-black.png":[["clock-black.91d74ad6.png","css/themes/images/icons-png/clock-black.png"],"css/themes/images/icons-png/clock-black.png"],"./images\\icons-png\\cloud-black.png":[["cloud-black.fc4faa39.png","css/themes/images/icons-png/cloud-black.png"],"css/themes/images/icons-png/cloud-black.png"],"./images\\icons-png\\comment-black.png":[["comment-black.d89ade76.png","css/themes/images/icons-png/comment-black.png"],"css/themes/images/icons-png/comment-black.png"],"./images\\icons-png\\delete-black.png":[["delete-black.53c74f7d.png","css/themes/images/icons-png/delete-black.png"],"css/themes/images/icons-png/delete-black.png"],"./images\\icons-png\\edit-black.png":[["edit-black.aa759e0f.png","css/themes/images/icons-png/edit-black.png"],"css/themes/images/icons-png/edit-black.png"],"./images\\icons-png\\eye-black.png":[["eye-black.464a3be3.png","css/themes/images/icons-png/eye-black.png"],"css/themes/images/icons-png/eye-black.png"],"./images\\icons-png\\forbidden-black.png":[["forbidden-black.a8a9f05e.png","css/themes/images/icons-png/forbidden-black.png"],"css/themes/images/icons-png/forbidden-black.png"],"./images\\icons-png\\forward-black.png":[["forward-black.824833eb.png","css/themes/images/icons-png/forward-black.png"],"css/themes/images/icons-png/forward-black.png"],"./images\\icons-png\\gear-black.png":[["gear-black.bae7c47a.png","css/themes/images/icons-png/gear-black.png"],"css/themes/images/icons-png/gear-black.png"],"./images\\icons-png\\grid-black.png":[["grid-black.ccb454ba.png","css/themes/images/icons-png/grid-black.png"],"css/themes/images/icons-png/grid-black.png"],"./images\\icons-png\\heart-black.png":[["heart-black.c136c698.png","css/themes/images/icons-png/heart-black.png"],"css/themes/images/icons-png/heart-black.png"],"./images\\icons-png\\home-black.png":[["home-black.7b8804f7.png","css/themes/images/icons-png/home-black.png"],"css/themes/images/icons-png/home-black.png"],"./images\\icons-png\\info-black.png":[["info-black.9f917876.png","css/themes/images/icons-png/info-black.png"],"css/themes/images/icons-png/info-black.png"],"./images\\icons-png\\location-black.png":[["location-black.0a5048f4.png","css/themes/images/icons-png/location-black.png"],"css/themes/images/icons-png/location-black.png"],"./images\\icons-png\\lock-black.png":[["lock-black.f8e3ea1f.png","css/themes/images/icons-png/lock-black.png"],"css/themes/images/icons-png/lock-black.png"],"./images\\icons-png\\mail-black.png":[["mail-black.bc52c683.png","css/themes/images/icons-png/mail-black.png"],"css/themes/images/icons-png/mail-black.png"],"./images\\icons-png\\minus-black.png":[["minus-black.edc635bc.png","css/themes/images/icons-png/minus-black.png"],"css/themes/images/icons-png/minus-black.png"],"./images\\icons-png\\navigation-black.png":[["navigation-black.576ef909.png","css/themes/images/icons-png/navigation-black.png"],"css/themes/images/icons-png/navigation-black.png"],"./images\\icons-png\\phone-black.png":[["phone-black.ca1c2213.png","css/themes/images/icons-png/phone-black.png"],"css/themes/images/icons-png/phone-black.png"],"./images\\icons-png\\plus-black.png":[["plus-black.1090ad2d.png","css/themes/images/icons-png/plus-black.png"],"css/themes/images/icons-png/plus-black.png"],"./images\\icons-png\\power-black.png":[["power-black.89888e72.png","css/themes/images/icons-png/power-black.png"],"css/themes/images/icons-png/power-black.png"],"./images\\icons-png\\recycle-black.png":[["recycle-black.07f62f27.png","css/themes/images/icons-png/recycle-black.png"],"css/themes/images/icons-png/recycle-black.png"],"./images\\icons-png\\refresh-black.png":[["refresh-black.a3c88fe1.png","css/themes/images/icons-png/refresh-black.png"],"css/themes/images/icons-png/refresh-black.png"],"./images\\icons-png\\search-black.png":[["search-black.8a65d9e7.png","css/themes/images/icons-png/search-black.png"],"css/themes/images/icons-png/search-black.png"],"./images\\icons-png\\shop-black.png":[["shop-black.8d6efbb8.png","css/themes/images/icons-png/shop-black.png"],"css/themes/images/icons-png/shop-black.png"],"./images\\icons-png\\star-black.png":[["star-black.a8e9f725.png","css/themes/images/icons-png/star-black.png"],"css/themes/images/icons-png/star-black.png"],"./images\\icons-png\\tag-black.png":[["tag-black.174f4514.png","css/themes/images/icons-png/tag-black.png"],"css/themes/images/icons-png/tag-black.png"],"./images\\icons-png\\user-black.png":[["user-black.f5b0f020.png","css/themes/images/icons-png/user-black.png"],"css/themes/images/icons-png/user-black.png"],"./images\\icons-png\\video-black.png":[["video-black.43360805.png","css/themes/images/icons-png/video-black.png"],"css/themes/images/icons-png/video-black.png"],"_css_loader":"C:/Users/gvim/AppData/Roaming/JetBrains/WebStorm2020.2/node/node-v12.13.1-win-x64/node_modules/parcel-bundler/src/builtins/css-loader.js"}],"C:/Users/gvim/AppData/Roaming/JetBrains/WebStorm2020.2/node/node-v12.13.1-win-x64/node_modules/parcel-bundler/src/builtins/hmr-runtime.js":[function(require,module,exports) {
var global = arguments[3];
var OVERLAY_ID = '__parcel__error__overlay__';
var OldModule = module.bundle.Module;

function Module(moduleName) {
  OldModule.call(this, moduleName);
  this.hot = {
    data: module.bundle.hotData,
    _acceptCallbacks: [],
    _disposeCallbacks: [],
    accept: function (fn) {
      this._acceptCallbacks.push(fn || function () {});
    },
    dispose: function (fn) {
      this._disposeCallbacks.push(fn);
    }
  };
  module.bundle.hotData = null;
}

module.bundle.Module = Module;
var checkedAssets, assetsToAccept;
var parent = module.bundle.parent;

if ((!parent || !parent.isParcelRequire) && typeof WebSocket !== 'undefined') {
  var hostname = "" || location.hostname;
  var protocol = location.protocol === 'https:' ? 'wss' : 'ws';
  var ws = new WebSocket(protocol + '://' + hostname + ':' + "53470" + '/');

  ws.onmessage = function (event) {
    checkedAssets = {};
    assetsToAccept = [];
    var data = JSON.parse(event.data);

    if (data.type === 'update') {
      var handled = false;
      data.assets.forEach(function (asset) {
        if (!asset.isNew) {
          var didAccept = hmrAcceptCheck(global.parcelRequire, asset.id);

          if (didAccept) {
            handled = true;
          }
        }
      }); // Enable HMR for CSS by default.

      handled = handled || data.assets.every(function (asset) {
        return asset.type === 'css' && asset.generated.js;
      });

      if (handled) {
        console.clear();
        data.assets.forEach(function (asset) {
          hmrApply(global.parcelRequire, asset);
        });
        assetsToAccept.forEach(function (v) {
          hmrAcceptRun(v[0], v[1]);
        });
      } else if (location.reload) {
        // `location` global exists in a web worker context but lacks `.reload()` function.
        location.reload();
      }
    }

    if (data.type === 'reload') {
      ws.close();

      ws.onclose = function () {
        location.reload();
      };
    }

    if (data.type === 'error-resolved') {
      console.log('[parcel] ✨ Error resolved');
      removeErrorOverlay();
    }

    if (data.type === 'error') {
      console.error('[parcel] 🚨  ' + data.error.message + '\n' + data.error.stack);
      removeErrorOverlay();
      var overlay = createErrorOverlay(data);
      document.body.appendChild(overlay);
    }
  };
}

function removeErrorOverlay() {
  var overlay = document.getElementById(OVERLAY_ID);

  if (overlay) {
    overlay.remove();
  }
}

function createErrorOverlay(data) {
  var overlay = document.createElement('div');
  overlay.id = OVERLAY_ID; // html encode message and stack trace

  var message = document.createElement('div');
  var stackTrace = document.createElement('pre');
  message.innerText = data.error.message;
  stackTrace.innerText = data.error.stack;
  overlay.innerHTML = '<div style="background: black; font-size: 16px; color: white; position: fixed; height: 100%; width: 100%; top: 0px; left: 0px; padding: 30px; opacity: 0.85; font-family: Menlo, Consolas, monospace; z-index: 9999;">' + '<span style="background: red; padding: 2px 4px; border-radius: 2px;">ERROR</span>' + '<span style="top: 2px; margin-left: 5px; position: relative;">🚨</span>' + '<div style="font-size: 18px; font-weight: bold; margin-top: 20px;">' + message.innerHTML + '</div>' + '<pre>' + stackTrace.innerHTML + '</pre>' + '</div>';
  return overlay;
}

function getParents(bundle, id) {
  var modules = bundle.modules;

  if (!modules) {
    return [];
  }

  var parents = [];
  var k, d, dep;

  for (k in modules) {
    for (d in modules[k][1]) {
      dep = modules[k][1][d];

      if (dep === id || Array.isArray(dep) && dep[dep.length - 1] === id) {
        parents.push(k);
      }
    }
  }

  if (bundle.parent) {
    parents = parents.concat(getParents(bundle.parent, id));
  }

  return parents;
}

function hmrApply(bundle, asset) {
  var modules = bundle.modules;

  if (!modules) {
    return;
  }

  if (modules[asset.id] || !bundle.parent) {
    var fn = new Function('require', 'module', 'exports', asset.generated.js);
    asset.isNew = !modules[asset.id];
    modules[asset.id] = [fn, asset.deps];
  } else if (bundle.parent) {
    hmrApply(bundle.parent, asset);
  }
}

function hmrAcceptCheck(bundle, id) {
  var modules = bundle.modules;

  if (!modules) {
    return;
  }

  if (!modules[id] && bundle.parent) {
    return hmrAcceptCheck(bundle.parent, id);
  }

  if (checkedAssets[id]) {
    return;
  }

  checkedAssets[id] = true;
  var cached = bundle.cache[id];
  assetsToAccept.push([bundle, id]);

  if (cached && cached.hot && cached.hot._acceptCallbacks.length) {
    return true;
  }

  return getParents(global.parcelRequire, id).some(function (id) {
    return hmrAcceptCheck(global.parcelRequire, id);
  });
}

function hmrAcceptRun(bundle, id) {
  var cached = bundle.cache[id];
  bundle.hotData = {};

  if (cached) {
    cached.hot.data = bundle.hotData;
  }

  if (cached && cached.hot && cached.hot._disposeCallbacks.length) {
    cached.hot._disposeCallbacks.forEach(function (cb) {
      cb(bundle.hotData);
    });
  }

  delete bundle.cache[id];
  bundle(id);
  cached = bundle.cache[id];

  if (cached && cached.hot && cached.hot._acceptCallbacks.length) {
    cached.hot._acceptCallbacks.forEach(function (cb) {
      cb();
    });

    return true;
  }
}
},{}]},{},["C:/Users/gvim/AppData/Roaming/JetBrains/WebStorm2020.2/node/node-v12.13.1-win-x64/node_modules/parcel-bundler/src/builtins/hmr-runtime.js"], null)
//# sourceMappingURL=/jquery.mobile.icons.min.cd00db7c.js.map