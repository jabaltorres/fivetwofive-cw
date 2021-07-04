!function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=22)}([function(e,t){!function(){e.exports=this.wp.element}()},function(e,t){!function(){e.exports=this.wp.i18n}()},function(e,t){!function(){e.exports=this.wp.data}()},function(e,t){!function(){e.exports=this.wp.components}()},function(e,t){e.exports=function(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}},function(e,t){!function(){e.exports=this.wp.compose}()},function(e,t){!function(){e.exports=this.wp.plugins}()},function(e,t,n){"use strict";n.d(t,"a",(function(){return u}));var r=n(4),o=n.n(r),i=n(2);function c(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}
/**
 * Builds new meta for use when saving post data.
 *
 * @since   3.1.3
 * @package Genesis\JS
 * @author  StudioPress
 * @license GPL-2.0-or-later
 */
function u(e,t){var n=Object(i.select)("core/editor").getEditedPostAttribute("meta");return function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?c(Object(n),!0).forEach((function(t){o()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):c(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({},Object.keys(n).filter((function(e){return e.startsWith("_genesis")})).reduce((function(e,t){return e[t]=n[t],null===e[t]&&(e[t]=!1),e}),{}),o()({},e,t))}},,,,,,,,,,,,,,,function(e,t,n){"use strict";n.r(t);var r=n(0),o=n(1),i=n(5),c=n(2),u=n(3),s=n(6),f=n(7);var l=Object(i.compose)([Object(c.withSelect)((function(){return{hideFooterWidgets:Object(c.select)("core/editor").getEditedPostAttribute("meta")._genesis_hide_footer_widgets}})),Object(c.withDispatch)((function(e){return{onUpdate:function(t){e("core/editor").editPost({meta:Object(f.a)("_genesis_hide_footer_widgets",!!t)})}}}))])((
/**
 * Adds a “hide footer widgets” checkbox to Genesis Block Editor sidebar in a
 * Footer Widgets panel. Unchecked by default.
 *
 * If checked and the post is updated or published, `_genesis_hide_footer_widgets`
 * is set to true in post meta.
 *
 * To disable the checkbox, use the PHP `genesis_footer_widgets_toggle_enabled`
 * filter: `add_filter( 'genesis_footer_widgets_toggle_enabled', '__return_false' );`.
 *
 * @since   3.2.0
 * @package Genesis\JS
 * @author  StudioPress
 * @license GPL-2.0-or-later
 */
function(e){var t=e.hideFooterWidgets,n=void 0!==t&&t,i=e.onUpdate;return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(u.Fill,{name:"GenesisSidebar"},Object(r.createElement)(u.PanelBody,{initialOpen:!0,title:Object(o.__)("Footer Widgets","genesis")},Object(r.createElement)(u.PanelRow,null,Object(r.createElement)(u.CheckboxControl,{label:Object(o.__)("Hide Footer Widgets","genesis"),checked:!!n,onChange:function(){return i(!n)}})))))}));Object(s.registerPlugin)("genesis-footer-widgets-toggle",{render:l})}]);