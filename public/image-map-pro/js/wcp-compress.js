!function(t,r,e,o){function n(t,r){var e={};for(var o in r)"[object Array]"===Object.prototype.toString.call(r[o])?e[o]=t[o].slice():"object"==typeof r[o]?(t[o]||(t[o]={}),e[o]=n(t[o],r[o])):r[o]!=t[o]&&(e[o]=t[o]);return e}function i(t){var r=o;if("[object Array]"===Object.prototype.toString.call(t)&&(r=0==t.length?o:t.slice()),"object"==typeof t)if(c(t))r=o;else for(var e in t){var n=i(t[e]);n!==o&&(r===o&&(r={}),r[e]=n)}else r=t;return r}function c(t){for(var r in t)if(t.hasOwnProperty(r))return!1;return JSON.stringify(t)===JSON.stringify({})}t.wcpCompress=function(r,e){objCopy=t.extend(!0,{},r),defaultsCopy=t.extend(!0,{},e);var o=n(objCopy,defaultsCopy),c=i(o);return c}}(jQuery,window,document);