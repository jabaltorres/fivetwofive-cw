!function(){"use strict";var e,t={226:function(){var e=window.wp.blocks,t=window.wp.element,n=window.wp.blockEditor,r=window.wp.i18n,o=JSON.parse('{"u2":"fivetwofive-blocks/panel"}');(0,e.registerBlockType)(o.u2,{edit:function(e){const{attributes:o,setAttributes:i,context:l}=e,{title:a}=o;return(0,t.createElement)("div",(0,n.useBlockProps)(),(0,t.createElement)(n.RichText,{className:"ftfb-panel-title",placeholder:(0,r.__)("Enter panel title here.."),tagName:l["fivetwofive-blocks/accordion/panelTitleTag"],value:a,onChange:e=>{i({title:e})}}),(0,t.createElement)("div",{className:"ftfb-panel-collapse"},(0,t.createElement)("div",{className:"ftfb-panel-body"},(0,t.createElement)(n.InnerBlocks,{template:[["core/paragraph",{}]]}))))},save:function(){return(0,t.createElement)(n.InnerBlocks.Content,null)}})}},n={};function r(e){var o=n[e];if(void 0!==o)return o.exports;var i=n[e]={exports:{}};return t[e](i,i.exports,r),i.exports}r.m=t,e=[],r.O=function(t,n,o,i){if(!n){var l=1/0;for(s=0;s<e.length;s++){n=e[s][0],o=e[s][1],i=e[s][2];for(var a=!0,c=0;c<n.length;c++)(!1&i||l>=i)&&Object.keys(r.O).every((function(e){return r.O[e](n[c])}))?n.splice(c--,1):(a=!1,i<l&&(l=i));if(a){e.splice(s--,1);var f=o();void 0!==f&&(t=f)}}return t}i=i||0;for(var s=e.length;s>0&&e[s-1][2]>i;s--)e[s]=e[s-1];e[s]=[n,o,i]},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){var e={361:0,10:0};r.O.j=function(t){return 0===e[t]};var t=function(t,n){var o,i,l=n[0],a=n[1],c=n[2],f=0;if(l.some((function(t){return 0!==e[t]}))){for(o in a)r.o(a,o)&&(r.m[o]=a[o]);if(c)var s=c(r)}for(t&&t(n);f<l.length;f++)i=l[f],r.o(e,i)&&e[i]&&e[i][0](),e[i]=0;return r.O(s)},n=self.webpackChunkfivetwofive_blocks=self.webpackChunkfivetwofive_blocks||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))}();var o=r.O(void 0,[10],(function(){return r(226)}));o=r.O(o)}();