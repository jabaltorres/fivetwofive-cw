!function(){"use strict";var e,t={780:function(){var e=window.wp.blocks,t=window.wp.element,n=window.wp.blockEditor,r=JSON.parse('{"u2":"fivetwofive-blocks/panel"}');(0,e.registerBlockType)(r.u2,{edit:function(e){const{attributes:{title:r},setAttributes:o}=e;return(0,t.createElement)("div",(0,n.useBlockProps)(),(0,t.createElement)(n.RichText,{placeholder:"Enter panel title here..",tagName:"h2",value:r,onChange:e=>{console.log(e),o({title:e})}}),(0,t.createElement)(n.InnerBlocks,null))},save:function(){return null}})}},n={};function r(e){var o=n[e];if(void 0!==o)return o.exports;var i=n[e]={exports:{}};return t[e](i,i.exports,r),i.exports}r.m=t,e=[],r.O=function(t,n,o,i){if(!n){var l=1/0;for(a=0;a<e.length;a++){n=e[a][0],o=e[a][1],i=e[a][2];for(var u=!0,c=0;c<n.length;c++)(!1&i||l>=i)&&Object.keys(r.O).every((function(e){return r.O[e](n[c])}))?n.splice(c--,1):(u=!1,i<l&&(l=i));if(u){e.splice(a--,1);var f=o();void 0!==f&&(t=f)}}return t}i=i||0;for(var a=e.length;a>0&&e[a-1][2]>i;a--)e[a]=e[a-1];e[a]=[n,o,i]},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){var e={361:0,10:0};r.O.j=function(t){return 0===e[t]};var t=function(t,n){var o,i,l=n[0],u=n[1],c=n[2],f=0;if(l.some((function(t){return 0!==e[t]}))){for(o in u)r.o(u,o)&&(r.m[o]=u[o]);if(c)var a=c(r)}for(t&&t(n);f<l.length;f++)i=l[f],r.o(e,i)&&e[i]&&e[i][0](),e[i]=0;return r.O(a)},n=self.webpackChunkfivetwofive_blocks=self.webpackChunkfivetwofive_blocks||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))}();var o=r.O(void 0,[10],(function(){return r(780)}));o=r.O(o)}();