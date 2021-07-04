!function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=23)}([function(e,t){!function(){e.exports=this.wp.element}()},function(e,t){!function(){e.exports=this.wp.i18n}()},function(e,t){!function(){e.exports=this.wp.data}()},function(e,t){!function(){e.exports=this.wp.components}()},function(e,t){e.exports=function(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}},function(e,t){!function(){e.exports=this.wp.compose}()},function(e,t){!function(){e.exports=this.wp.plugins}()},function(e,t,n){"use strict";n.d(t,"a",(function(){return s}));var r=n(4),o=n.n(r),c=n(2);function i(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}
/**
 * Builds new meta for use when saving post data.
 *
 * @since   3.1.3
 * @package Genesis\JS
 * @author  StudioPress
 * @license GPL-2.0-or-later
 */
function s(e,t){var n=Object(c.select)("core/editor").getEditedPostAttribute("meta");return function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?i(Object(n),!0).forEach((function(t){o()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):i(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({},Object.keys(n).filter((function(e){return e.startsWith("_genesis")})).reduce((function(e,t){return e[t]=n[t],null===e[t]&&(e[t]=!1),e}),{}),o()({},e,t))}},,,,,,,,,,,,,,,,function(e,t,n){"use strict";n.r(t);var r=n(0),o=n(1),c=n(3),i=n(6),s=n(5),u=n(2),l=n(7);var a=Object(s.compose)([Object(u.withSelect)((function(){return{bodyClass:Object(u.select)("core/editor").getEditedPostAttribute("meta")._genesis_custom_body_class}})),Object(u.withDispatch)((function(e){return{onUpdate:function(t){e("core/editor").editPost({meta:Object(l.a)("_genesis_custom_body_class",t)})}}}))])((
/**
 * The BodyClassTextControl component for use in the Custom Classes panel.
 *
 * @since   3.1.0
 * @package Genesis\JS
 * @author  StudioPress
 * @license GPL-2.0-or-later
 */
function(e){var t=e.bodyClass,n=e.onUpdate;return Object(r.createElement)(c.TextControl,{label:Object(o.__)("Body Class","genesis"),value:t,onChange:function(e){return n(e)}})}));
/**
 * The PostClassTextControl component for use in the Custom Classes panel.
 *
 * @since   3.1.0
 * @package Genesis\JS
 * @author  StudioPress
 * @license GPL-2.0-or-later
 */var f=Object(s.compose)([Object(u.withSelect)((function(){return{postClass:Object(u.select)("core/editor").getEditedPostAttribute("meta")._genesis_custom_post_class}})),Object(u.withDispatch)((function(e){return{onUpdate:function(t){e("core/editor").editPost({meta:Object(l.a)("_genesis_custom_post_class",t)})}}}))])((function(e){var t=e.postClass,n=e.onUpdate;return Object(r.createElement)(c.TextControl,{label:Object(o.__)("Post Class","genesis"),value:t,onChange:function(e){return n(e)}})}));
/**
 * Adds a Classes panel to the Genesis Block Editor sidebar with body class
 * and post class input fields.
 *
 * Fields are stored in post meta as:
 *
 * - `_genesis_custom_body_class`
 * - `_genesis_custom_post_class`
 *
 * These are the same fields used by the original Layout Settings meta box.
 *
 * @since   3.1.0
 * @package Genesis\JS
 * @author  StudioPress
 * @license GPL-2.0-or-later
 */Object(i.registerPlugin)("genesis-custom-classes",{render:function(){return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(c.Fill,{name:"GenesisSidebar"},Object(r.createElement)(c.Panel,null,Object(r.createElement)(c.PanelBody,{initialOpen:!0,title:Object(o.__)("Custom Classes","genesis")},Object(r.createElement)(a,null),Object(r.createElement)(f,null)))))}})}]);