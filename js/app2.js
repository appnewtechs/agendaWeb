(function(e){function t(t){for(var a,r,l=t[0],n=t[1],c=t[2],u=0,m=[];u<l.length;u++)r=l[u],o[r]&&m.push(o[r][0]),o[r]=0;for(a in n)Object.prototype.hasOwnProperty.call(n,a)&&(e[a]=n[a]);d&&d(t);while(m.length)m.shift()();return i.push.apply(i,c||[]),s()}function s(){for(var e,t=0;t<i.length;t++){for(var s=i[t],a=!0,l=1;l<s.length;l++){var n=s[l];0!==o[n]&&(a=!1)}a&&(i.splice(t--,1),e=r(r.s=s[0]))}return e}var a={},o={app:0},i=[];function r(t){if(a[t])return a[t].exports;var s=a[t]={i:t,l:!1,exports:{}};return e[t].call(s.exports,s,s.exports,r),s.l=!0,s.exports}r.m=e,r.c=a,r.d=function(e,t,s){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:s})},r.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var s=Object.create(null);if(r.r(s),Object.defineProperty(s,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var a in e)r.d(s,a,function(t){return e[t]}.bind(null,a));return s},r.n=function(e){var t=e&&e.__esModule?function(){return e["default"]}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="/";var l=window["webpackJsonp"]=window["webpackJsonp"]||[],n=l.push.bind(l);l.push=t,l=l.slice();for(var c=0;c<l.length;c++)t(l[c]);var d=n;i.push([0,"chunk-vendors"]),s()})({0:function(e,t,s){e.exports=s("56d7")},"2ae0":function(e,t,s){},4678:function(e,t,s){var a={"./af":"2bfb","./af.js":"2bfb","./ar":"8e73","./ar-dz":"a356","./ar-dz.js":"a356","./ar-kw":"423e","./ar-kw.js":"423e","./ar-ly":"1cfd","./ar-ly.js":"1cfd","./ar-ma":"0a84","./ar-ma.js":"0a84","./ar-sa":"8230","./ar-sa.js":"8230","./ar-tn":"6d83","./ar-tn.js":"6d83","./ar.js":"8e73","./az":"485c","./az.js":"485c","./be":"1fc1","./be.js":"1fc1","./bg":"84aa","./bg.js":"84aa","./bm":"a7fa","./bm.js":"a7fa","./bn":"9043","./bn.js":"9043","./bo":"d26a","./bo.js":"d26a","./br":"6887","./br.js":"6887","./bs":"2554","./bs.js":"2554","./ca":"d716","./ca.js":"d716","./cs":"3c0d","./cs.js":"3c0d","./cv":"03ec","./cv.js":"03ec","./cy":"9797","./cy.js":"9797","./da":"0f14","./da.js":"0f14","./de":"b469","./de-at":"b3eb","./de-at.js":"b3eb","./de-ch":"bb71","./de-ch.js":"bb71","./de.js":"b469","./dv":"598a","./dv.js":"598a","./el":"8d47","./el.js":"8d47","./en-SG":"cdab","./en-SG.js":"cdab","./en-au":"0e6b","./en-au.js":"0e6b","./en-ca":"3886","./en-ca.js":"3886","./en-gb":"39a6","./en-gb.js":"39a6","./en-ie":"e1d3","./en-ie.js":"e1d3","./en-il":"7333","./en-il.js":"7333","./en-nz":"6f50","./en-nz.js":"6f50","./eo":"65db","./eo.js":"65db","./es":"898b","./es-do":"0a3c","./es-do.js":"0a3c","./es-us":"55c9","./es-us.js":"55c9","./es.js":"898b","./et":"ec18","./et.js":"ec18","./eu":"0ff2","./eu.js":"0ff2","./fa":"8df4","./fa.js":"8df4","./fi":"81e9","./fi.js":"81e9","./fo":"0721","./fo.js":"0721","./fr":"9f26","./fr-ca":"d9f8","./fr-ca.js":"d9f8","./fr-ch":"0e49","./fr-ch.js":"0e49","./fr.js":"9f26","./fy":"7118","./fy.js":"7118","./ga":"5120","./ga.js":"5120","./gd":"f6b4","./gd.js":"f6b4","./gl":"8840","./gl.js":"8840","./gom-latn":"0caa","./gom-latn.js":"0caa","./gu":"e0c5","./gu.js":"e0c5","./he":"c7aa","./he.js":"c7aa","./hi":"dc4d","./hi.js":"dc4d","./hr":"4ba9","./hr.js":"4ba9","./hu":"5b14","./hu.js":"5b14","./hy-am":"d6b6","./hy-am.js":"d6b6","./id":"5038","./id.js":"5038","./is":"0558","./is.js":"0558","./it":"6e98","./it-ch":"6f12","./it-ch.js":"6f12","./it.js":"6e98","./ja":"079e","./ja.js":"079e","./jv":"b540","./jv.js":"b540","./ka":"201b","./ka.js":"201b","./kk":"6d79","./kk.js":"6d79","./km":"e81d","./km.js":"e81d","./kn":"3e92","./kn.js":"3e92","./ko":"22f8","./ko.js":"22f8","./ku":"2421","./ku.js":"2421","./ky":"9609","./ky.js":"9609","./lb":"440c","./lb.js":"440c","./lo":"b29d","./lo.js":"b29d","./lt":"26f9","./lt.js":"26f9","./lv":"b97c","./lv.js":"b97c","./me":"293c","./me.js":"293c","./mi":"688b","./mi.js":"688b","./mk":"6909","./mk.js":"6909","./ml":"02fb","./ml.js":"02fb","./mn":"958b","./mn.js":"958b","./mr":"39bd","./mr.js":"39bd","./ms":"ebe4","./ms-my":"6403","./ms-my.js":"6403","./ms.js":"ebe4","./mt":"1b45","./mt.js":"1b45","./my":"8689","./my.js":"8689","./nb":"6ce3","./nb.js":"6ce3","./ne":"3a39","./ne.js":"3a39","./nl":"facd","./nl-be":"db29","./nl-be.js":"db29","./nl.js":"facd","./nn":"b84c","./nn.js":"b84c","./pa-in":"f3ff","./pa-in.js":"f3ff","./pl":"8d57","./pl.js":"8d57","./pt":"f260","./pt-br":"d2d4","./pt-br.js":"d2d4","./pt.js":"f260","./ro":"972c","./ro.js":"972c","./ru":"957c","./ru.js":"957c","./sd":"6784","./sd.js":"6784","./se":"ffff","./se.js":"ffff","./si":"eda5","./si.js":"eda5","./sk":"7be6","./sk.js":"7be6","./sl":"8155","./sl.js":"8155","./sq":"c8f3","./sq.js":"c8f3","./sr":"cf1e","./sr-cyrl":"13e9","./sr-cyrl.js":"13e9","./sr.js":"cf1e","./ss":"52bd","./ss.js":"52bd","./sv":"5fbd","./sv.js":"5fbd","./sw":"74dc","./sw.js":"74dc","./ta":"3de5","./ta.js":"3de5","./te":"5cbb","./te.js":"5cbb","./tet":"576c","./tet.js":"576c","./tg":"3b1b","./tg.js":"3b1b","./th":"10e8","./th.js":"10e8","./tl-ph":"0f38","./tl-ph.js":"0f38","./tlh":"cf75","./tlh.js":"cf75","./tr":"0e81","./tr.js":"0e81","./tzl":"cf51","./tzl.js":"cf51","./tzm":"c109","./tzm-latn":"b53d","./tzm-latn.js":"b53d","./tzm.js":"c109","./ug-cn":"6117","./ug-cn.js":"6117","./uk":"ada2","./uk.js":"ada2","./ur":"5294","./ur.js":"5294","./uz":"2e8c","./uz-latn":"010e","./uz-latn.js":"010e","./uz.js":"2e8c","./vi":"2921","./vi.js":"2921","./x-pseudo":"fd7e","./x-pseudo.js":"fd7e","./yo":"7f33","./yo.js":"7f33","./zh-cn":"5c3a","./zh-cn.js":"5c3a","./zh-hk":"49ab","./zh-hk.js":"49ab","./zh-tw":"90ea","./zh-tw.js":"90ea"};function o(e){var t=i(e);return s(t)}function i(e){var t=a[e];if(!(t+1)){var s=new Error("Cannot find module '"+e+"'");throw s.code="MODULE_NOT_FOUND",s}return t}o.keys=function(){return Object.keys(a)},o.resolve=i,e.exports=o,o.id="4678"},4721:function(e,t,s){"use strict";var a=s("2ae0"),o=s.n(a);o.a},"56d7":function(e,t,s){"use strict";s.r(t);s("cadf"),s("551c"),s("f751"),s("097d");var a=s("2b0e"),o=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"container"},[1==e.modo?s("div",{staticClass:"col-sm-2"},[s("div",{staticClass:"row filtros"},[e._m(0),s("div",{staticClass:"row filtro-toggle"},[s("div",{staticClass:"row"},[s("span",{staticClass:"filtro-toggle__title",on:{click:function(t){return e.handleFiltro("usuario")}}},[e._v("\n\t\t\t\t\t\tUsuário\n\t\t\t\t\t\t"),s("i",{staticClass:"fa fa-arrow-down",class:{open:e.menu.usuario},attrs:{id:"icon"}})])]),e.menu.usuario?s("input",{directives:[{name:"model",rawName:"v-model",value:e.buscaUsuario,expression:"buscaUsuario"}],staticClass:"form-control",attrs:{type:"text",required:"true",autocomplete:"off",name:"usuarios",placeholder:"Consultor.."},domProps:{value:e.buscaUsuario},on:{input:function(t){t.target.composing||(e.buscaUsuario=t.target.value)}}}):e._e(),e.menu.usuario?s("div",{staticClass:"filtro-toggle__checkbox filtro"},[s("div",{staticClass:"limpar-filtro"},[s("a",{on:{click:function(t){return e.limparFiltro("usuario")}}},[e._v("Limpar Filtro")])]),e._l(e.usuariosSelecionados,function(t){return s("div",{key:t.id_usuario,staticClass:"form-check row"},[s("label",{staticClass:"form-check-label"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.selected_usuarios[t.id_usuario],expression:"selected_usuarios[usuario.id_usuario]"}],staticClass:"form-check-input",attrs:{type:"checkbox",name:"checkbox[]"},domProps:{value:t.id_usuario,checked:Array.isArray(e.selected_usuarios[t.id_usuario])?e._i(e.selected_usuarios[t.id_usuario],t.id_usuario)>-1:e.selected_usuarios[t.id_usuario]},on:{change:function(s){var a=e.selected_usuarios[t.id_usuario],o=s.target,i=!!o.checked;if(Array.isArray(a)){var r=t.id_usuario,l=e._i(a,r);o.checked?l<0&&e.$set(e.selected_usuarios,t.id_usuario,a.concat([r])):l>-1&&e.$set(e.selected_usuarios,t.id_usuario,a.slice(0,l).concat(a.slice(l+1)))}else e.$set(e.selected_usuarios,t.id_usuario,i)}}}),e._v("\n\t\t\t\t\t\t\t"+e._s(t.nome)+"\n\t\t\t\t\t\t")])])})],2):e._e()]),s("div",{staticClass:"row filtro-toggle"},[s("div",{staticClass:"row"},[s("span",{staticClass:"filtro-toggle__title",on:{click:function(t){return e.handleFiltro("tipo_trabalho")}}},[e._v("\n\t\t\t\t\t\tTipos de Trabalho\n\t\t\t\t\t\t"),s("i",{staticClass:"fa fa-arrow-down",class:{open:e.menu.tipo_trabalho},attrs:{id:"icon"}})])]),e.menu.tipo_trabalho?s("div",{staticClass:"row filtro-toggle__checkbox"},[s("div",{staticClass:"limpar-filtro"},[s("a",{on:{click:function(t){return e.limparFiltro("tipo_trabalho")}}},[e._v("Limpar Filtro")])]),e._l(e.filtroTrabalho,function(t){return s("div",{key:t.id_tipo_trabalho,staticClass:"form-check row"},[s("label",{staticClass:"form-check-label"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.selected_trabalhos[t.id_trabalho],expression:"selected_trabalhos[trabalho.id_trabalho]"}],staticClass:"form-check-input",attrs:{type:"checkbox",name:"checkbox[]"},domProps:{value:t.id_tipo_trabalho,checked:Array.isArray(e.selected_trabalhos[t.id_trabalho])?e._i(e.selected_trabalhos[t.id_trabalho],t.id_tipo_trabalho)>-1:e.selected_trabalhos[t.id_trabalho]},on:{change:function(s){var a=e.selected_trabalhos[t.id_trabalho],o=s.target,i=!!o.checked;if(Array.isArray(a)){var r=t.id_tipo_trabalho,l=e._i(a,r);o.checked?l<0&&e.$set(e.selected_trabalhos,t.id_trabalho,a.concat([r])):l>-1&&e.$set(e.selected_trabalhos,t.id_trabalho,a.slice(0,l).concat(a.slice(l+1)))}else e.$set(e.selected_trabalhos,t.id_trabalho,i)}}}),s("div",{staticClass:"calListSquare",style:{"background-color":"#"+t.cor,"border-color":t.cor}}),e._v("\n\t\t\t\t\t\t\t"+e._s(t.descricao)+"\n\t\t\t\t\t\t")])])})],2):e._e()]),s("div",{staticClass:"row filtro-toggle"},[s("div",{staticClass:"row"},[s("span",{staticClass:"filtro-toggle__title",on:{click:function(t){return e.handleFiltro("empresa")}}},[e._v("\n\t\t\t\t\t\tEmpresas\n\t\t\t\t\t\t"),s("i",{staticClass:"fa fa-arrow-down",class:{open:e.menu.empresa},attrs:{id:"icon"}})])]),e.menu.empresa?s("div",{staticClass:"row filtro-toggle__checkbox"},[s("div",{staticClass:"limpar-filtro"},[s("a",{on:{click:function(t){return e.limparFiltro("empresa")}}},[e._v("Limpar Filtro")])]),e._l(e.filtroEmpresa,function(t){return s("div",{key:t.id_empresa,staticClass:"form-check row"},[s("label",{staticClass:"form-check-label"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.selected_empresas[t.id_empresa],expression:"selected_empresas[empresa.id_empresa]"}],staticClass:"form-check-input",attrs:{type:"checkbox",name:"checkbox[]"},domProps:{value:t.id_empresa,checked:Array.isArray(e.selected_empresas[t.id_empresa])?e._i(e.selected_empresas[t.id_empresa],t.id_empresa)>-1:e.selected_empresas[t.id_empresa]},on:{change:function(s){var a=e.selected_empresas[t.id_empresa],o=s.target,i=!!o.checked;if(Array.isArray(a)){var r=t.id_empresa,l=e._i(a,r);o.checked?l<0&&e.$set(e.selected_empresas,t.id_empresa,a.concat([r])):l>-1&&e.$set(e.selected_empresas,t.id_empresa,a.slice(0,l).concat(a.slice(l+1)))}else e.$set(e.selected_empresas,t.id_empresa,i)}}}),e._v("\n\t\t\t\t\t\t\t"+e._s(t.nome_fantasia)+"\n\t\t\t\t\t\t")])])})],2):e._e()]),s("div",{staticClass:"row filtro-toggle"},[s("div",{staticClass:"row"},[s("span",{staticClass:"filtro-toggle__title",on:{click:function(t){return e.handleFiltro("cliente")}}},[e._v("\n\t\t\t\t\t\tClientes\n\t\t\t\t\t\t"),s("i",{staticClass:"fa fa-arrow-down",class:{open:e.menu.cliente},attrs:{id:"icon"}})])]),e.menu.cliente?s("div",{staticClass:"row filtro-toggle__checkbox"},[s("div",{staticClass:"limpar-filtro"},[s("a",{on:{click:function(t){return e.limparFiltro("cliente")}}},[e._v("Limpar Filtro")])]),e._l(e.filtroCliente,function(t){return s("div",{key:t.id_cliente,staticClass:"form-check row"},[s("label",{staticClass:"form-check-label"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.selected_clientes[t.id_cliente],expression:"selected_clientes[cliente.id_cliente]"}],staticClass:"form-check-input",attrs:{type:"checkbox",name:"checkbox[]"},domProps:{value:t.id_cliente,checked:Array.isArray(e.selected_clientes[t.id_cliente])?e._i(e.selected_clientes[t.id_cliente],t.id_cliente)>-1:e.selected_clientes[t.id_cliente]},on:{change:function(s){var a=e.selected_clientes[t.id_cliente],o=s.target,i=!!o.checked;if(Array.isArray(a)){var r=t.id_cliente,l=e._i(a,r);o.checked?l<0&&e.$set(e.selected_clientes,t.id_cliente,a.concat([r])):l>-1&&e.$set(e.selected_clientes,t.id_cliente,a.slice(0,l).concat(a.slice(l+1)))}else e.$set(e.selected_clientes,t.id_cliente,i)}}}),e._v("\n\t\t\t\t\t\t\t"+e._s(t.nome_fantasia)+"\n\t\t\t\t\t\t")])])})],2):e._e()]),e._e()]),s("div",{staticClass:"row filtro-relatorio"},[s("form",{ref:"form_relatorio",attrs:{action:"relatorio.php",method:"post",target:"_blank"}},[s("span",{staticClass:"filtro-relatorio__title"},[e._v("Datas pro relatório")]),e._m(1),s("input",{attrs:{name:"filtro",type:"hidden"}}),s("button",{staticClass:"btn btn-success",attrs:{type:"submit"},on:{click:e.handleRelatorio}},[e._v("Gerar Relatório")])])])]):e._e(),1==e.modo?s("div",{staticClass:"col-sm-10"},[1==e.modo?s("div",{staticClass:"novoEventoDiv"},[s("a",{staticClass:"btn btn-primary pull-left h2 btn-novo novoEvento",attrs:{href:"javascript:void(0);"},on:{click:e.handleNovoEvento}},[s("i",{staticClass:"glyphicon glyphicon-plus"}),e._v(" Novo evento\n\t\t\t")])]):e._e(),s("FullCalendar",{ref:"Calendar",attrs:{events:e.eventosFiltrados||e.eventos,config:e.fullCalendarConfig},on:{"view-render":e.viewRender,"event-selected":e.handleSelectEvent}})],1):e._e(),0==e.modo?s("div",{staticClass:"col-sm-12"},[1==e.modo?s("div",{staticClass:"novoEventoDiv"},[s("a",{staticClass:"btn btn-primary pull-left h2 btn-novo novoEvento",attrs:{href:"javascript:void(0);"},on:{click:e.handleNovoEvento}},[s("i",{staticClass:"glyphicon glyphicon-plus"}),e._v(" Novo evento\n\t\t\t")])]):e._e(),s("FullCalendar",{ref:"Calendar",attrs:{events:e.eventosFiltrados||e.eventos,config:e.fullCalendarConfig},on:{"view-render":e.viewRender,"event-selected":e.handleSelectEvent}})],1):e._e(),e.showModal?s("Modal",{attrs:{evento:e.evento,modo:e.modo},on:{close:function(t){e.showModal=!1,e.evento={}},"novo-evento":e.loadEventos}}):e._e()],1)},i=[function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"filtros__titulo"},[s("h3",[e._v("Filtros")])])},function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"filtro-relatorio__data"},[s("input",{staticClass:"form-control duasdatas dates",attrs:{type:"text",required:"true",autocomplete:"off",name:"datas_evento",placeholder:"Datas do Evento"}})])}],r=(s("28a5"),s("f499")),l=s.n(r),n=(s("3b2b"),s("bd86")),c=(s("7f7f"),s("25cc")),d=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"modal fade in",staticStyle:{display:"block","margin-top":"100px"},attrs:{id:"ModalAdd",tabindex:"-1",role:"dialog","aria-labelledby":"myModalLabel"}},[s("div",{staticClass:"modal-dialog",attrs:{role:"document"}},[s("div",{staticClass:"modal-content"},[s("form",{staticClass:"form-horizontal formulario0",attrs:{name:"fEvento"}},[s("div",{staticClass:"modal-header"},[s("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal","aria-label":"Close"},on:{click:function(t){return e.$emit("close")}}},[s("span",{attrs:{"aria-hidden":"true"}},[e._v("×")])]),s("h4",{staticClass:"modal-title",attrs:{id:"myModalLabel"}},[e._v("Evento")])]),s("div",{staticClass:"modal-body"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.dados.id_evento,expression:"dados.id_evento"}],attrs:{type:"hidden",name:"id_evento"},domProps:{value:e.dados.id_evento},on:{input:function(t){t.target.composing||e.$set(e.dados,"id_evento",t.target.value)}}}),s("div",{staticClass:"form-group"},[s("label",{staticClass:"control-label col-sm-2 required"},[e._v("Usuário")]),s("div",{staticClass:"col-sm-10"},[s("select",{directives:[{name:"model",rawName:"v-model",value:e.dados.id_usuario,expression:"dados.id_usuario"}],staticClass:"custom-select form-control",attrs:{disabled:0==e.modo,name:"id_usuario",required:"true"},on:{change:function(t){var s=Array.prototype.filter.call(t.target.options,function(e){return e.selected}).map(function(e){var t="_value"in e?e._value:e.value;return t});e.$set(e.dados,"id_usuario",t.target.multiple?s:s[0])}}},e._l(e.usuariosSelect,function(t){return s("option",{key:t.id_usuario,domProps:{value:t.id_usuario}},[e._v(e._s(t.nome))])}),0)])]),s("div",{staticClass:"form-group"},[s("label",{staticClass:"control-label col-sm-2"},[e._v("Empresa")]),s("div",{staticClass:"col-sm-10"},[s("select",{directives:[{name:"model",rawName:"v-model",value:e.dados.id_empresa,expression:"dados.id_empresa"}],staticClass:"custom-select form-control",attrs:{disabled:0==e.modo,name:"empresa"},on:{change:function(t){var s=Array.prototype.filter.call(t.target.options,function(e){return e.selected}).map(function(e){var t="_value"in e?e._value:e.value;return t});e.$set(e.dados,"id_empresa",t.target.multiple?s:s[0])}}},e._l(e.empresasSelect,function(t){return s("option",{key:t.id_empresa,domProps:{value:t.id_empresa}},[e._v(e._s(t.nome_fantasia))])}),0)])]),s("div",{staticClass:"form-group"},[s("label",{staticClass:"control-label col-sm-2 required"},[e._v("Tipo de Trabalho")]),s("div",{staticClass:"col-sm-10"},[s("select",{directives:[{name:"model",rawName:"v-model",value:e.dados.tipo_trabalho,expression:"dados.tipo_trabalho"}],staticClass:"custom-select form-control",attrs:{disabled:0==e.modo,name:"tipo_trabalho",required:"true"},on:{change:function(t){var s=Array.prototype.filter.call(t.target.options,function(e){return e.selected}).map(function(e){var t="_value"in e?e._value:e.value;return t});e.$set(e.dados,"tipo_trabalho",t.target.multiple?s:s[0])}}},e._l(e.tiposTrabalhoSelect,function(t){return s("option",{key:t.id_trabalho,domProps:{value:t.id_trabalho}},[e._v(e._s(t.descricao))])}),0)])]),s("div",{staticClass:"form-group"},[s("label",{staticClass:"col-sm-2 control-label required",attrs:{for:"title"}},[e._v("Titulo")]),s("div",{staticClass:"col-sm-10"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.dados.titleEdit,expression:"dados.titleEdit"}],staticClass:"form-control",attrs:{disabled:0==e.modo,type:"text",name:"titleEdit",id:"title",placeholder:"Titulo",required:"true"},domProps:{value:e.dados.titleEdit},on:{input:function(t){t.target.composing||e.$set(e.dados,"titleEdit",t.target.value)}}})])]),s("div",{staticClass:"form-group"},[s("label",{staticClass:"col-sm-2 control-label required",attrs:{for:"title"}},[e._v("Datas do Evento")]),s("div",{staticClass:"col-sm-10"},[s("input",{staticClass:"form-control multipledates dates",attrs:{disabled:0==e.modo,type:"text",required:"true",autocomplete:"off",name:"datas_trabalho",placeholder:"Datas do Evento"},domProps:{value:e.dados.datas_trabalho},on:{blur:function(t){e.dados.datas_trabalho=t.target.value}}})])]),s("div",{staticClass:"form-group"},[s("label",{staticClass:"col-sm-2 control-label",attrs:{for:"title"}},[e._v("Status")]),s("div",{staticClass:"col-sm-10"},[s("select",{directives:[{name:"model",rawName:"v-model",value:e.dados.status,expression:"dados.status"}],staticClass:"form-control",attrs:{disabled:0==e.modo,name:"status"},on:{change:function(t){var s=Array.prototype.filter.call(t.target.options,function(e){return e.selected}).map(function(e){var t="_value"in e?e._value:e.value;return t});e.$set(e.dados,"status",t.target.multiple?s:s[0])}}},[s("option",{attrs:{value:"1"}},[e._v("Confirmado")]),s("option",{attrs:{value:"0"}},[e._v("A confirmar")])])])]),s("div",{staticClass:"form-group"},[s("label",{staticClass:"col-sm-2 control-label",attrs:{for:"title"}},[e._v("Fechar dia")]),s("div",{staticClass:"col-sm-10"},[s("select",{directives:[{name:"model",rawName:"v-model",value:e.dados.fechado,expression:"dados.fechado"}],staticClass:"form-control",attrs:{disabled:0==e.modo,name:"fechado"},on:{change:function(t){var s=Array.prototype.filter.call(t.target.options,function(e){return e.selected}).map(function(e){var t="_value"in e?e._value:e.value;return t});e.$set(e.dados,"fechado",t.target.multiple?s:s[0])}}},[s("option",{attrs:{value:"0"}},[e._v("Dia aberto")]),s("option",{attrs:{value:"1"}},[e._v("Bloquar dia inteiro")])])])]),s("div",{staticClass:"form-group"},[s("label",{staticClass:"control-label col-sm-2"},[e._v("Cliente")]),s("div",{staticClass:"col-sm-10"},[s("select",{directives:[{name:"model",rawName:"v-model",value:e.dados.cliente,expression:"dados.cliente"}],staticClass:"custom-select form-control",attrs:{disabled:0==e.modo,name:"cliente"},on:{change:function(t){var s=Array.prototype.filter.call(t.target.options,function(e){return e.selected}).map(function(e){var t="_value"in e?e._value:e.value;return t});e.$set(e.dados,"cliente",t.target.multiple?s:s[0])}}},e._l(e.clientesSelect,function(t){return s("option",{key:t.id_cliente,domProps:{value:t.id_cliente}},[e._v(e._s(t.nome_fantasia))])}),0)])]),s("div",{staticClass:"form-group"},[s("div",{staticClass:"col-sm-offset-2 col-sm-10"},[s("div",{staticClass:"checkbox"},[s("label",{staticClass:"text-danger"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.dados.delete,expression:"dados.delete"}],attrs:{disabled:0==e.modo,type:"checkbox",name:"delete"},domProps:{checked:Array.isArray(e.dados.delete)?e._i(e.dados.delete,null)>-1:e.dados.delete},on:{change:function(t){var s=e.dados.delete,a=t.target,o=!!a.checked;if(Array.isArray(s)){var i=null,r=e._i(s,i);a.checked?r<0&&e.$set(e.dados,"delete",s.concat([i])):r>-1&&e.$set(e.dados,"delete",s.slice(0,r).concat(s.slice(r+1)))}else e.$set(e.dados,"delete",o)}}}),e._v(" Deletar Evento\n\t\t\t\t\t\t\t\t")])])])])]),s("div",{staticClass:"modal-footer"},[s("button",{staticClass:"btn btn-default",attrs:{type:"button","data-dismiss":"modal"},on:{click:function(t){return e.$emit("close")}}},[e._v("Fechar")]),1==e.modo?s("button",{staticClass:"btn btn-primary",attrs:{type:"submit",id:"addEvent"},on:{click:function(t){return t.preventDefault(),e.handleSalvar(t)}}},[e._v("Salvar")]):e._e()])])])])])},u=[],m=s("cebc"),f={props:{evento:{type:Object,default:function(){return{}}},form:String,modo:String},data:function(){return{action:"addEvent",dados:{id_evento:this.evento.id_evento,titleEdit:this.evento.titleEdit,id_usuario:this.evento.id_usuario||"",id_empresa:this.evento.empresa||"",tipo_trabalho:this.evento.tipo_trabalho||"",title:this.evento.title,datas_trabalho:this.evento.datas_trabalho,status:this.evento.status||1,fechado:this.evento.fechado||1,cliente:this.evento.cliente||"",delete:null},usuariosSelect:[],empresasSelect:[],clientesSelect:[],tiposTrabalhoSelect:[]}},methods:{handleSalvar:function(){var e=this;console.log("Salvando dados"),"string"!=typeof this.dados.datas_trabalho&&(this.dados.datas_trabalho=this.dados.datas_trabalho.join(",")),$.ajax({url:"../eventos/".concat(this.action,".php"),method:"POST",async:!1,data:Object(m["a"])({},this.dados),success:function(t){e.$emit("novo-evento"),e.$emit("close")}})}},created:function(){this.usuariosSelect=_DADOS.usuarios_select,this.empresasSelect=_DADOS.empresas_select,this.clientesSelect=_DADOS.clientes_select,this.tiposTrabalhoSelect=_DADOS.tipos_trabalho_select,this.evento.datas_trabalho=this.evento.datas_trabalho?this.evento.datas_trabalho.join(","):"",this.evento.id_evento?this.action="editEventTitle":this.action="addEvent",console.log(this.modo)},mounted:function(){$(".multipledates").datepick({multiSelect:999})}},h=f,_=s("2877"),v=Object(_["a"])(h,d,u,!1,null,null,null),p=v.exports;function b(e){var t=[];for(var s in e)e.hasOwnProperty(s)&&e[s]&&t.push(s);return t}var j={components:{FullCalendar:c["a"],Modal:p},data:function(){return{startDate:null,endDate:null,showModal:!1,evento:{},consultaUsuario:"",tiposEmpresas:null,filtroEmpresa:null,filtroTrabalho:null,filtroCliente:null,filtroLinhaProduto:null,usuariosSelect:null,empresasSelect:null,clientesSelect:null,linhaProdutosSelect:null,tiposTrabalhoSelect:null,usuarios:null,modo:null,eventos:null,buscaUsuario:"",selected_usuarios:{},selected_trabalhos:{},selected_clientes:{},selected_empresas:{},selected_produtos:{},menu:{usuario:!0,tipo_trabalho:!1,empresa:!1,cliente:!1,linha_produto:!1}}},computed:{eventosFiltrados:function(){var e=this,t=this.eventos;return this.hasUsuariosSelected&&(t=t.map(function(t){return!!e.selected_usuarios[t.id_usuario]&&t})),this.hasTrabalhosSelected&&(t=t.map(function(t){return!!e.selected_trabalhos[t.tipo_trabalho]&&t})),this.hasClientesSelected&&(t=t.map(function(t){return!!e.selected_clientes[t.cliente]&&t})),this.hasEmpresasSelected&&(t=t.map(function(t){return!!e.selected_empresas[t.empresa]&&t})),this.hasProtudosSelected&&(t=t.map(function(t){return!!e.selected_produtos[t.id_linha_produto]&&t})),t},fullCalendarConfig:function(){var e,t=this;return e={displayEventTime:!1,locale:"pt-BR",defaultView:"month",header:{left:"prev,next today",center:"title",right:"month,basicWeek,basicDay"},buttonText:{today:"Hoje",month:"Mês",week:"Semana",day:"Dia"},height:650,slotEventOverlap:!1},Object(n["a"])(e,"displayEventTime",!1),Object(n["a"])(e,"eventLimit",!1),Object(n["a"])(e,"eventRender",function(e,s){return t.hasUsuariosSelected?!!t.selected_usuarios[e.id_usuario]:t.hasTrabalhosSelected?!!t.selected_trabalhos[e.tipo_trabalho]:t.hasClientesSelected?!!t.selected_clientes[e.cliente]:t.hasEmpresasSelected?!!t.selected_empresas[e.empresa]:!t.hasProtudosSelected||!!t.selected_produtos[e.id_linha_produto]}),Object(n["a"])(e,"dayClick",function(e,s){t.showModal=!0}),Object(n["a"])(e,"dayRender",function(e,t){for(var s=0;s<feriados.length;s++)if(e.isSame(moment(feriados[s].date),"day")){t.css("background-color","#FFCF7A"),t.html("<span class='feriado'>"+feriados[s].name+"</span>"),!0;break}}),e},hasUsuariosSelected:function(){for(var e in this.selected_usuarios)if(this.selected_usuarios[e])return!0;return!1},hasTrabalhosSelected:function(){for(var e in this.selected_trabalhos)if(this.selected_trabalhos[e])return!0;return!1},hasClientesSelected:function(){for(var e in this.selected_clientes)if(this.selected_clientes[e])return!0;return!1},hasEmpresasSelected:function(){for(var e in this.selected_empresas)if(this.selected_empresas[e])return!0;return!1},hasProtudosSelected:function(){for(var e in this.selected_produtos)if(this.selected_produtos[e])return!0;return!1},usuariosSelecionados:function(){var e=this,t=this.usuarios;return this.buscaUsuario?(t=t.filter(function(t){var s=new RegExp("".concat(e.buscaUsuario),"gi");return s.test(t.nome)||!!e.selected_usuarios[t.id_usuario]}),t):t}},methods:{viewRender:function(e,t){this.startDate=moment(e.start).format("YYYY/MM/DD"),this.endDate=moment(e.end).format("YYYY/MM/DD"),this.loadEventos()},loadEventos:function(){var e;$.ajax({url:"../eventos/eventos.php",method:"POST",async:!1,data:{start:this.startDate,end:this.endDate},success:function(t){e=t}}),this.eventos=JSON.parse(e)},handleRelatorio:function(){var e=this.$refs.form_relatorio,t=b(this.selected_usuarios),s=b(this.selected_empresas),a=b(this.selected_clientes),o=b(this.selected_trabalhos),i=b(this.selected_linhas);e.filtro.value=l()({usuarios:t,empresas:s,clientes:a,trabalhos:o,linhas:i})},handleSelectEvent:function(e){var t=this;$.ajax({url:"../eventos/select-datas.php",method:"POST",data:{id_evento:e.id_evento},success:function(s){var a="";a=s.split(","),e.datas_trabalho=a,t.evento=e,t.showModal=!0}})},handleNovoEvento:function(){this.showModal=!0},limparFiltro:function(e){"usuario"==e&&(this.selected_usuarios=[]),"tipo_trabalho"==e&&(this.selected_trabalhos=[]),"cliente"==e&&(this.selected_clientes=[]),"empresa"==e&&(this.selected_empresas=[]),"linha_produto"==e&&(this.selected_produtos=[])},handleFiltro:function(e){"usuario"==e&&(this.menu.usuario=!this.menu.usuario),"tipo_trabalho"==e&&(this.menu.tipo_trabalho=!this.menu.tipo_trabalho),"empresa"==e&&(this.menu.empresa=!this.menu.empresa),"cliente"==e&&(this.menu.cliente=!this.menu.cliente),"linha_produto"==e&&(this.menu.linha_produto=!this.menu.linha_produto)}},created:function(){this.tiposEmpresas=_DADOS.tipos_empresa,this.filtroEmpresa=_DADOS.filtro_empresa,this.filtroTrabalho=_DADOS.filtro_trabalho,this.filtroCliente=_DADOS.filtro_cliente,this.filtroLinhaProduto=_DADOS.filtro_linha_produto,this.usuariosSelect=_DADOS.usuarios_select,this.empresasSelect=_DADOS.empresas_select,this.clientesSelect=_DADOS.clientes_select,this.linhaProdutosSelect=_DADOS.linha_produtos_select,this.tiposTrabalhoSelect=_DADOS.tipos_trabalho_select,this.usuarios=_DADOS.usuarios,this.modo=_DADOS.modo},mounted:function(){$(".duasdatas").datepick({multiSelect:2})}},g=j,C=(s("4721"),Object(_["a"])(g,o,i,!1,null,null,null)),y=C.exports,k=s("2f62");a["a"].use(k["a"]);var S=new k["a"].Store({state:{},mutations:{},actions:{}});s("1157"),s("2ead");a["a"].config.productionTip=!1,a["a"].use(c["b"]),new a["a"]({store:S,render:function(e){return e(y)}}).$mount("#Agenda")}});
//# sourceMappingURL=app.fd1d6f63.js.map