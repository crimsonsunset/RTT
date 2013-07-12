<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/*
    Template Name: joeGrid
*/

get_header(); ?>

<link href="js/css/jq.css" rel="stylesheet">

<!-- Pick a theme, load the plugin & initialize plugin -->
<link href="js/css/theme.default.css" rel="stylesheet">

<!-- load jQuery and tablesorter scripts -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>

<!-- tablesorter widgets (optional) -->
<script type="text/javascript" src="js/jquery.tablesorter.widgets.min.js"></script>

<script>
    /*! tableSorter 2.8+ widgets - updated 6/4/2013 */
    ;(function(g){
        var f=g.tablesorter=g.tablesorter||{};
        f.themes={bootstrap:{table:"table table-bordered table-striped",header:"bootstrap-header",footerRow:"",footerCells:"",icons:"",sortNone:"bootstrap-icon-unsorted",sortAsc:"icon-chevron-up",sortDesc:"icon-chevron-down",active:"",hover:"",filterRow:"",even:"",odd:""},jui:{table:"ui-widget ui-widget-content ui-corner-all",header:"ui-widget-header ui-corner-all ui-state-default",footerRow:"",footerCells:"",icons:"ui-icon",sortNone:"ui-icon-carat-2-n-s", sortAsc:"ui-icon-carat-1-n",sortDesc:"ui-icon-carat-1-s",active:"ui-state-active",hover:"ui-state-hover",filterRow:"",even:"ui-widget-content",odd:"ui-state-default"}};
        f.storage=function(d,c,b){var a,e=!1;a={};var h=d.id||g(".tablesorter").index(g(d)),f=window.location.pathname;if("localStorage"in window)try{window.localStorage.setItem("_tmptest","temp"),e=!0,window.localStorage.removeItem("_tmptest")}catch(j){}g.parseJSON&&(e?a=g.parseJSON(localStorage[c]||"{}"):(a=document.cookie.split(/[;\s|=]/), d=g.inArray(c,a)+1,a=0!==d?g.parseJSON(a[d]||"{}"):{}));if((b||""===b)&&window.JSON&&JSON.hasOwnProperty("stringify"))a[f]||(a[f]={}),a[f][h]=b,e?localStorage[c]=JSON.stringify(a):(d=new Date,d.setTime(d.getTime()+31536E6),document.cookie=c+"="+JSON.stringify(a).replace(/\"/g,'"')+"; expires="+d.toGMTString()+"; path=/");else return a&&a[f]?a[f][h]:{}};
        f.addHeaderResizeEvent=function(d,c,b){b=g.extend({},{timer:250},b);var a=d.config,e=a.widgetOptions,f;clearInterval(e.resize_timer);if(c)return e.resize_flag= !1;a.$headers.each(function(){g.data(this,"savedSizes",[this.offsetWidth,this.offsetHeight])});e.resize_timer=setInterval(function(){e.resize_flag||(e.resize_flag=!0,f=[],a.$headers.each(function(){var a=g.data(this,"savedSizes"),b=this.offsetWidth,c=this.offsetHeight;if(b!==a[0]||c!==a[1])g.data(this,"savedSizes",[b,c]),f.push(this)}),f.length&&a.$table.trigger("resize",[f]),e.resize_flag=!1)},b.timer)};
        f.addWidget({id:"uitheme",priority:10,options:{uitheme:"jui"},format:function(d,c,b){var a,e, h,m,j=f.themes,p=c.$table,t="default"!==c.theme?c.theme:b.uitheme||"jui",k=j[j[t]?t:j[b.uitheme]?b.uitheme:"jui"],r=c.$headers,A="tr."+(b.stickyHeaders||"tablesorter-stickyHeader"),q=k.sortNone+" "+k.sortDesc+" "+k.sortAsc;c.debug&&(a=new Date);if(!p.hasClass("tablesorter-"+t)||c.theme===t||!d.hasInitialized)""!==k.even&&(b.zebra[0]+=" "+k.even),""!==k.odd&&(b.zebra[1]+=" "+k.odd),j=p.removeClass(""===c.theme?"":"tablesorter-"+c.theme).addClass("tablesorter-"+t+" "+k.table).find("tfoot"),j.length&& j.find("tr").addClass(k.footerRow).children("th, td").addClass(k.footerCells),r.addClass(k.header).filter(":not(.sorter-false)").bind("mouseenter.tsuitheme mouseleave.tsuitheme",function(a){g(this)["mouseenter"===a.type?"addClass":"removeClass"](k.hover)}),r.find(".tablesorter-wrapper").length||r.wrapInner('<div class="tablesorter-wrapper" style="position:relative;height:100%;width:100%"></div>'),c.cssIcon&&r.find("."+c.cssIcon).addClass(k.icons),p.hasClass("hasFilters")&&r.find(".tablesorter-filter-row").addClass(k.filterRow); g.each(r,function(a){h=g(this);m=c.cssIcon?h.find("."+c.cssIcon):h;this.sortDisabled?(h.removeClass(q),m.removeClass(q+" tablesorter-icon "+k.icons)):(j=p.hasClass("hasStickyHeaders")?p.find(A).find("th").eq(a).add(h):h,e=h.hasClass(c.cssAsc)?k.sortAsc:h.hasClass(c.cssDesc)?k.sortDesc:h.hasClass(c.cssHeader)?k.sortNone:"",h[e===k.sortNone?"removeClass":"addClass"](k.active),m.removeClass(q).addClass(e))});c.debug&&f.benchmark("Applying "+t+" theme",a)},remove:function(d,c,b){d=c.$table;var a="object"=== typeof b.uitheme?"jui":b.uitheme||"jui";b="object"===typeof b.uitheme?b.uitheme:f.themes[f.themes.hasOwnProperty(a)?a:"jui"];var e=d.children("thead").children(),g=b.sortNone+" "+b.sortDesc+" "+b.sortAsc;d.removeClass("tablesorter-"+a+" "+b.table).find(c.cssHeader).removeClass(b.header);e.unbind("mouseenter.tsuitheme mouseleave.tsuitheme").removeClass(b.hover+" "+g+" "+b.active).find(".tablesorter-filter-row").removeClass(b.filterRow);e.find(".tablesorter-icon").removeClass(b.icons)}});
        f.addWidget({id:"columns", priority:30,options:{columns:["primary","secondary","tertiary"]},format:function(d,c,b){var a,e,h,m,j,p,t,k,r,A=c.$table,q=c.$tbodies,l=c.sortList,w=l.length,u=c.widgetColumns&&c.widgetColumns.hasOwnProperty("css")?c.widgetColumns.css||u:b&&b.hasOwnProperty("columns")?b.columns||u:u;p=u.length-1;t=u.join(" ");c.debug&&(j=new Date);for(r=0;r<q.length;r++)a=f.processTbody(d,q.eq(r),!0),e=a.children("tr"),e.each(function(){m=g(this);if("none"!==this.style.display&&(h=m.children().removeClass(t),l&&l[0]&& (h.eq(l[0][0]).addClass(u[0]),1<w)))for(k=1;k<w;k++)h.eq(l[k][0]).addClass(u[k]||u[p])}),f.processTbody(d,a,!1);e=!1!==b.columns_thead?"thead tr":"";!1!==b.columns_tfoot&&(e+=(""===e?"":",")+"tfoot tr");if(e.length&&(m=A.find(e).children().removeClass(t),l&&l[0]&&(m.filter('[data-column="'+l[0][0]+'"]').addClass(u[0]),1<w)))for(k=1;k<w;k++)m.filter('[data-column="'+l[k][0]+'"]').addClass(u[k]||u[p]);c.debug&&f.benchmark("Applying Columns widget",j)},remove:function(d,c,b){var a=c.$tbodies,e=(b.columns|| ["primary","secondary","tertiary"]).join(" ");c.$headers.removeClass(e);c.$table.children("tfoot").children("tr").children("th, td").removeClass(e);for(c=0;c<a.length;c++)b=f.processTbody(d,a.eq(c),!0),b.children("tr").each(function(){g(this).children().removeClass(e)}),f.processTbody(d,b,!1)}});
        f.addWidget({id:"filter",priority:50,options:{filter_childRows:!1,filter_columnFilters:!0,filter_cssFilter:"tablesorter-filter",filter_filteredRow:"filtered",filter_formatter:null,filter_functions:null,filter_hideFilters:!1, filter_ignoreCase:!0,filter_liveSearch:!0,filter_onlyAvail:"filter-onlyAvail",filter_reset:null,filter_searchDelay:300,filter_startsWith:!1,filter_useParsedData:!1,filter_serversideFiltering:!1,filter_defaultAttrib:"data-value",filter_regex:{regex:/^\/((?:\\\/|[^\/])+)\/([mig]{0,3})?$/,child:/tablesorter-childRow/,filtered:/filtered/,type:/undefined|number/,exact:/(^[\"|\'|=])|([\"|\'|=]$)/g,nondigit:/[^\w,. \-()]/g,operators:/[<>=]/g}},format:function(d,c,b){if(c.parsers&&!c.$table.hasClass("hasFilters")){var a, e,h,m,j,p,t,k,r,A,q,l,w,u,v,s,n,D,z,F=f.formatFloat,M="",B=c.$headers,E=b.filter_cssFilter,x=c.$table.addClass("hasFilters"),H=x.find("tbody"),I=c.parsers.length,G,N,O,K=function(a){var e=g.isArray(a),s=e?a:f.getFilters(d),h=(s||[]).join("");e&&f.setFilters(x,s);b.filter_hideFilters&&x.find(".tablesorter-filter-row").trigger(""===h?"mouseleave":"mouseenter");if(!(M===h&&!1!==a))if(x.trigger("filterStart",[s]),c.showProcessing)setTimeout(function(){P(a,s,h);return!1},30);else return P(a,s,h),!1},P= function(J,m,p){var l,r,u,q,w,y,A,C,z,D;c.debug&&(A=new Date);for(h=0;h<H.length;h++)if(!H.eq(h).hasClass(c.cssInfoBlock)){J=f.processTbody(d,H.eq(h),!0);l=J.children("tr:not(."+c.cssChildRow+")");w=l.length;if(""===p||b.filter_serversideFiltering)J.children().show().removeClass(b.filter_filteredRow);else{D=!0;q=x.data("lastSearch")||[];g.each(m,function(a,b){D=0===(b||"").indexOf(q[a]||"")&&D&&!/(\s+or\s+|\|)/g.test(b||"")});D&&0===l.filter(":visible").length&&(D=!1);for(e=0;e<w;e++)if(q=l[e].className, !(b.filter_regex.child.test(q)||D&&b.filter_regex.filtered.test(q))){q=!0;u=l.eq(e).nextUntil("tr:not(."+c.cssChildRow+")");n=u.length&&b.filter_childRows?u.text():"";n=b.filter_ignoreCase?n.toLocaleLowerCase():n;r=l.eq(e).children("td");for(a=0;a<I;a++)if(m[a]){t=b.filter_useParsedData||G[a]?c.cache[h].normalized[e][a]:g.trim(r.eq(a).text());k=!b.filter_regex.type.test(typeof t)&&b.filter_ignoreCase?t.toLocaleLowerCase():t;y=q;j=b.filter_ignoreCase?m[a].toLocaleLowerCase():m[a];if(b.filter_functions&& b.filter_functions[a])!0===b.filter_functions[a]?y=B.filter('[data-column="'+a+'"]:last').hasClass("filter-match")?0<=k.search(j):m[a]===t:"function"===typeof b.filter_functions[a]?y=b.filter_functions[a](t,c.cache[h].normalized[e][a],m[a],a):"function"===typeof b.filter_functions[a][m[a]]&&(y=b.filter_functions[a][m[a]](t,c.cache[h].normalized[e][a],m[a],a));else if(b.filter_regex.regex.test(j)){v=b.filter_regex.regex.exec(j);try{y=RegExp(v[1],v[2]).test(k)}catch(E){y=!1}}else if(j.replace(b.filter_regex.exact, "")==k)y=!0;else if(/^\!/.test(j))j=j.replace("!",""),s=k.search(g.trim(j)),y=""===j?!0:!(b.filter_startsWith?0===s:0<=s);else if(/^[<>]=?/.test(j)){s=F(j.replace(b.filter_regex.nondigit,"").replace(b.filter_regex.operators,""),d);if(G[a]||"numeric"===c.parsers[a].type)v=c.parsers[a].format(""+j.replace(b.filter_regex.operators,""),d,B.eq(a),a),s=""!==v&&!isNaN(v)?v:s;v=(G[a]||"numeric"===c.parsers[a].type)&&!isNaN(s)&&c.cache[h].normalized[e]?c.cache[h].normalized[e][a]:isNaN(k)?F(k.replace(b.filter_regex.nondigit, ""),d):F(k,d);/>/.test(j)&&(y=/>=/.test(j)?v>=s:v>s);/</.test(j)&&(y=/<=/.test(j)?v<=s:v<s);""===s&&(y=!0)}else if(/\s+(AND|&&)\s+/g.test(m[a])){s=j.split(/(?:\s+(?:and|&&)\s+)/g);y=0<=k.search(g.trim(s[0]));for(C=s.length-1;y&&C;)y=y&&0<=k.search(g.trim(s[C])),C--}else if(/\s+(-|to)\s+/.test(j)){s=j.split(/(?: - | to )/);C=F(s[0].replace(b.filter_regex.nondigit,""),d);z=F(s[1].replace(b.filter_regex.nondigit,""),d);if(G[a]||"numeric"===c.parsers[a].type)v=c.parsers[a].format(""+s[0],d,B.eq(a),a), C=""!==v&&!isNaN(v)?v:C,v=c.parsers[a].format(""+s[1],d,B.eq(a),a),z=""!==v&&!isNaN(v)?v:z;v=(G[a]||"numeric"===c.parsers[a].type)&&!isNaN(C)&&!isNaN(z)?c.cache[h].normalized[e][a]:isNaN(k)?F(k.replace(b.filter_regex.nondigit,""),d):F(k,d);C>z&&(y=C,C=z,z=y);y=v>=C&&v<=z||""===C||""===z?!0:!1}else/[\?|\*]/.test(j)||/\s+OR\s+/.test(m[a])?(s=j.replace(/\s+OR\s+/gi,"|"),!B.filter('[data-column="'+a+'"]:last').hasClass("filter-match")&&/\|/.test(s)&&(s="^("+s+")$"),y=RegExp(s.replace(/\?/g,"\\S{1}").replace(/\*/g, "\\S*")).test(k)):(t=(k+n).indexOf(j),y=!b.filter_startsWith&&0<=t||b.filter_startsWith&&0===t);q=y?q?!0:!1:!1}l[e].style.display=q?"":"none";l.eq(e)[q?"removeClass":"addClass"](b.filter_filteredRow);if(u.length)u[q?"show":"hide"]()}}f.processTbody(d,J,!1)}M=p;x.data("lastSearch",m);c.debug&&f.benchmark("Completed filter widget search",A);x.trigger("applyWidgets");x.trigger("filterEnd")},Q=function(a,s,k){var n,j,l=[];a=parseInt(a,10);j=B.filter('[data-column="'+a+'"]:last');n='<option value="">'+ (j.data("placeholder")||j.attr("data-placeholder")||"")+"</option>";for(h=0;h<H.length;h++){m=c.cache[h].row.length;for(e=0;e<m;e++)if(!k||!c.cache[h].row[e][0].className.match(b.filter_filteredRow))b.filter_useParsedData?l.push(""+c.cache[h].normalized[e][a]):(j=c.cache[h].row[e][0].cells[a])&&l.push(g.trim(c.supportsTextContent?j.textContent:g(j).text()))}l=g.grep(l,function(a,b){return g.inArray(a,l)===b});l=f.sortText?l.sort(function(b,c){return f.sortText(d,b,c,a)}):l.sort(!0);k=x.find("thead").find("select."+ E+'[data-column="'+a+'"]').val();for(h=0;h<l.length;h++)j=l[h].replace(/\"/g,"&quot;"),n+=""!==l[h]?'<option value="'+j+'"'+(k===j?' selected="selected"':"")+">"+l[h]+"</option>":"";x.find("thead").find("select."+E+'[data-column="'+a+'"]')[s?"html":"append"](n)},L=function(c){for(a=0;a<I;a++)if(n=B.filter('[data-column="'+a+'"]:last'),(n.hasClass("filter-select")||b.filter_functions&&!0===b.filter_functions[a])&&!n.hasClass("filter-false"))b.filter_functions||(b.filter_functions={}),b.filter_functions[a]= !0,Q(a,c,n.hasClass(b.filter_onlyAvail))},R=function(a){"undefined"===typeof a||!0===a?(clearTimeout(O),O=setTimeout(function(){K(a)},b.filter_liveSearch?b.filter_searchDelay:10)):K(a)};c.debug&&(N=new Date);b.filter_regex.child=RegExp(c.cssChildRow);b.filter_regex.filtered=RegExp(b.filter_filteredRow);if(!1!==b.filter_columnFilters&&B.filter(".filter-false").length!==B.length){n='<tr class="tablesorter-filter-row">';for(a=0;a<I;a++)n+="<td></td>";c.$filters=g(n+="</tr>").appendTo(x.find("thead").eq(0)).find("td"); for(a=0;a<I;a++)D=!1,u=B.filter('[data-column="'+a+'"]:last'),A=b.filter_functions&&b.filter_functions[a]&&"function"!==typeof b.filter_functions[a]||u.hasClass("filter-select"),D=f.getData?"false"===f.getData(u[0],c.headers[a],"filter"):c.headers[a]&&c.headers[a].hasOwnProperty("filter")&&!1===c.headers[a].filter||u.hasClass("filter-false"),A?n=g("<select>").appendTo(c.$filters.eq(a)):(b.filter_formatter&&g.isFunction(b.filter_formatter[a])?((n=b.filter_formatter[a](c.$filters.eq(a),a))&&0===n.length&& (n=c.$filters.eq(a).children("input")),n&&(0===n.parent().length||n.parent().length&&n.parent()[0]!==c.$filters[a])&&c.$filters.eq(a).append(n)):n=g('<input type="search">').appendTo(c.$filters.eq(a)),n&&n.attr("placeholder",u.data("placeholder")||u.attr("data-placeholder")||"")),n&&(n.addClass(E).attr("data-column",a),D&&(n.addClass("disabled")[0].disabled=!0))}x.bind("addRows updateCell update updateRows updateComplete appendCache filterReset filterEnd search ".split(" ").join(".tsfilter "),function(a, b){/(search|filterReset|filterEnd)/.test(a.type)||(a.stopPropagation(),L(!0));"filterReset"===a.type&&x.find("."+E).val("");"filterEnd"===a.type?L(!0):(b="search"===a.type?b:"updateComplete"===a.type?x.data("lastSearch"):"",R(b));return!1}).find("input."+E).bind("keyup search",function(a,c){if(27===a.which)this.value="";else if("number"===typeof b.filter_liveSearch&&this.value.length<b.filter_liveSearch&&""!==this.value||"keyup"===a.type&&(32>a.which&&8!==a.which&&!0===b.filter_liveSearch&&13!==a.which|| 37<=a.which&&40>=a.which||13!==a.which&&!1===b.filter_liveSearch))return;R(c)});G=B.map(function(a){return f.getData?"parsed"===f.getData(B.filter('[data-column="'+a+'"]:last'),c.headers[a],"filter"):g(this).hasClass("filter-parsed")}).get();b.filter_reset&&g(b.filter_reset).length&&g(b.filter_reset).bind("click.tsfilter",function(){x.trigger("filterReset")});if(b.filter_functions)for(z in b.filter_functions)if(b.filter_functions.hasOwnProperty(z)&&"string"===typeof z)if(n=B.filter('[data-column="'+ z+'"]:last'),p="",!0===b.filter_functions[z]&&!n.hasClass("filter-false"))Q(z);else if("string"===typeof z&&!n.hasClass("filter-false")){for(q in b.filter_functions[z])"string"===typeof q&&(p+=""===p?'<option value="">'+(n.data("placeholder")||n.attr("data-placeholder")||"")+"</option>":"",p+='<option value="'+q+'">'+q+"</option>");x.find("thead").find("select."+E+'[data-column="'+z+'"]').append(p)}L(!0);x.find("select."+E).bind("change search",function(a,b){K(b)});b.filter_hideFilters&&x.find(".tablesorter-filter-row").addClass("hideme").bind("mouseenter mouseleave", function(a){var c;l=g(this);clearTimeout(r);r=setTimeout(function(){/enter|over/.test(a.type)?l.removeClass("hideme"):g(document.activeElement).closest("tr")[0]!==l[0]&&(c=x.find("."+b.filter_cssFilter).map(function(){return g(this).val()||""}).get().join(""),""===c&&l.addClass("hideme"))},200)}).find("input, select").bind("focus blur",function(a){w=g(this).closest("tr");clearTimeout(r);r=setTimeout(function(){if(""===x.find("."+b.filter_cssFilter).map(function(){return g(this).val()||""}).get().join(""))w["focus"=== a.type?"removeClass":"addClass"]("hideme")},200)});c.showProcessing&&x.bind("filterStart.tsfilter filterEnd.tsfilter",function(a,b){var e=b?x.find("."+c.cssHeader).filter("[data-column]").filter(function(){return""!==b[g(this).data("column")]}):"";f.isProcessing(x[0],"filterStart"===a.type,b?e:"")});c.debug&&f.benchmark("Applying Filter widget",N);x.bind("tablesorter-initialized",function(){p=f.getFilters(d);for(a=0;a<p.length;a++)p[a]=B.filter('[data-column="'+a+'"]:last').attr(b.filter_defaultAttrib)|| p[a];f.setFilters(d,p,!0)});x.trigger("filterInit");K()}},remove:function(d,c,b){var a,e=c.$tbodies;c.$table.removeClass("hasFilters").unbind("addRows updateCell update updateComplete appendCache search filterStart filterEnd ".split(" ").join(".tsfilter ")).find(".tablesorter-filter-row").remove();for(c=0;c<e.length;c++)a=f.processTbody(d,e.eq(c),!0),a.children().removeClass(b.filter_filteredRow).show(),f.processTbody(d,a,!1);b.filterreset&&g(b.filter_reset).unbind("click.tsfilter")}});
        f.getFilters=function(d){var c=d?g(d)[0].config:{};return c&&c.widgetOptions&&!c.widgetOptions.filter_columnFilters?g(d).data("lastSearch"):c&&c.$filters?c.$filters.find("."+c.widgetOptions.filter_cssFilter).map(function(b,a){return g(a).val()}).get()||[]:!1};
        f.setFilters=function(d,c,b){d=g(d);var a=d.length?d[0].config:{},a=a&&a.$filters?a.$filters.find("."+a.widgetOptions.filter_cssFilter).each(function(a,b){g(b).val(c[a]||"")}).trigger("change.tsfilter")||!1:!1;b&&d.trigger("search",[c,!1]);return!!a};
        f.addWidget({id:"stickyHeaders", priority:60,options:{stickyHeaders:"tablesorter-stickyHeader",stickyHeaders_offset:0,stickyHeaders_cloneId:"-sticky",stickyHeaders_addResizeEvent:!0,stickyHeaders_includeCaption:!0},format:function(d,c,b){if(!c.$table.hasClass("hasStickyHeaders")){var a=c.$table,e=g(window),h=a.children("thead:first"),m=h.children("tr:not(.sticky-false)").children(),j=a.find("tfoot"),p="."+(b.filter_cssFilter||"tablesorter-filter"),t=isNaN(b.stickyHeaders_offset)?g(b.stickyHeaders_offset):"",k=t.length?t.height()|| 0:parseInt(b.stickyHeaders_offset,10)||0,r=b.$sticky=a.clone().addClass("containsStickyHeaders").css({position:"fixed",margin:0,top:k,visibility:"hidden",zIndex:2}),A=r.children("thead:first").addClass(b.stickyHeaders),q,l="",w=0,u=!1,v=function(){k=t.length?t.height()||0:parseInt(b.stickyHeaders_offset,10)||0;var c=navigator.userAgent;w=0;"collapse"!==a.css("border-collapse")&&!/(webkit|msie)/i.test(c)&&(w=2*parseInt(m.eq(0).css("border-left-width"),10));r.css({left:h.offset().left-e.scrollLeft()- w,width:a.width()});q.filter(":visible").each(function(a){a=m.filter(":visible").eq(a);g(this).css({width:a.width()-w,height:a.height()}).find(".tablesorter-header-inner").width(a.find(".tablesorter-header-inner").width())})};r.attr("id")&&(r[0].id+=b.stickyHeaders_cloneId);r.find("thead:gt(0), tr.sticky-false, tbody, tfoot").remove();b.stickyHeaders_includeCaption||r.find("caption").remove();q=A.children().children();r.css({height:0,width:0,padding:0,margin:0,border:0});q.find(".tablesorter-resizer").remove(); a.addClass("hasStickyHeaders").bind("sortEnd.tsSticky",function(){m.filter(":visible").each(function(a){a=q.filter(":visible").eq(a);a.attr("class",g(this).attr("class")).removeClass(c.cssProcessing);c.cssIcon&&a.find("."+c.cssIcon).attr("class",g(this).find("."+c.cssIcon).attr("class"))})}).bind("pagerComplete.tsSticky",function(){v()});m.find(c.selectorSort).add(c.$headers.filter(c.selectorSort)).each(function(a){var b=g(this);a=A.children("tr.tablesorter-headerRow").children().eq(a).bind("mouseup", function(a){b.trigger(a,!0)});c.cancelSelection&&a.attr("unselectable","on").bind("selectstart",!1).css({"user-select":"none",MozUserSelect:"none"})});a.after(r);e.bind("scroll.tsSticky resize.tsSticky",function(c){if(a.is(":visible")){var d=a.offset(),f=-(b.stickyHeaders_includeCaption?0:a.find("caption").height()),g=e.scrollTop()+k,m=a.height()-(r.height()+(j.height()||0)),d=g>d.top-f&&g<d.top-f+m?"visible":"hidden";r.removeClass("tablesorter-sticky-visible tablesorter-sticky-hidden").addClass("tablesorter-sticky-"+ d).css({left:h.offset().left-e.scrollLeft()-w,visibility:d});if(d!==l||"resize"===c.type)v(),l=d}});b.stickyHeaders_addResizeEvent&&f.addHeaderResizeEvent(d);a.bind("filterEnd",function(){u||A.find(".tablesorter-filter-row").children().each(function(a){g(this).find(p).val(c.$filters.find(p).eq(a).val())})});q.find(p).bind("keyup search change",function(a){if(!(32>a.which&&8!==a.which||37<=a.which&&40>=a.which)){u=!0;a=g(this);var d=a.attr("data-column");c.$filters.find(p).eq(d).val(a.val()).trigger("search"); setTimeout(function(){u=!1},b.filter_searchDelay)}});a.trigger("stickyHeadersInit")}},remove:function(d,c,b){c.$table.removeClass("hasStickyHeaders").unbind("sortEnd.tsSticky pagerComplete.tsSticky").find("."+b.stickyHeaders).remove();b.$sticky&&b.$sticky.length&&b.$sticky.remove();g(".hasStickyHeaders").length||g(window).unbind("scroll.tsSticky resize.tsSticky");f.addHeaderResizeEvent(d,!1)}});
        f.addWidget({id:"resizable",priority:40,options:{resizable:!0,resizable_addLastColumn:!1},format:function(d, c,b){if(!c.$table.hasClass("hasResizable")){c.$table.addClass("hasResizable");var a,e,h,m,j={},p,t,k,r,A=c.$table,q=0,l=null,w=null,u=20>Math.abs(A.parent().width()-A.width()),v=function(){f.storage&&l&&(j[l.index()]=l.width(),j[w.index()]=w.width(),l.width(j[l.index()]),w.width(j[w.index()]),!1!==b.resizable&&f.storage(d,"tablesorter-resizable",j));q=0;l=w=null;g(window).trigger("resize")};if(j=f.storage&&!1!==b.resizable?f.storage(d,"tablesorter-resizable"):{})for(m in j)!isNaN(m)&&m<c.$headers.length&& c.$headers.eq(m).width(j[m]);a=A.children("thead:first").children("tr");a.children().each(function(){e=g(this);h=e.attr("data-column");m="false"===f.getData(e,c.headers[h],"resizable");a.children().filter('[data-column="'+h+'"]').toggleClass("resizable-false",m)});a.each(function(){p=g(this).children(":not(.resizable-false)");g(this).find(".tablesorter-wrapper").length||p.wrapInner('<div class="tablesorter-wrapper" style="position:relative;height:100%;width:100%"></div>');b.resizable_addLastColumn|| (p=p.slice(0,-1));t=t?t.add(p):p});t.each(function(){a=g(this);m=parseInt(a.css("padding-right"),10)+10;e='<div class="tablesorter-resizer" style="cursor:w-resize;position:absolute;z-index:1;right:-'+m+'px;top:0;height:100%;width:20px;"></div>';a.find(".tablesorter-wrapper").append(e)}).bind("mousemove.tsresize",function(a){0!==q&&l&&(k=a.pageX-q,r=l.width(),l.width(r+k),l.width()!==r&&u&&w.width(w.width()-k),q=a.pageX)}).bind("mouseup.tsresize",function(){v()}).find(".tablesorter-resizer,.tablesorter-resizer-grip").bind("mousedown", function(a){l=g(a.target).closest("th");e=c.$headers.filter('[data-column="'+l.attr("data-column")+'"]');1<e.length&&(l=l.add(e));w=a.shiftKey?l.parent().find("th:not(.resizable-false)").filter(":last"):l.nextAll(":not(.resizable-false)").eq(0);q=a.pageX});A.find("thead:first").bind("mouseup.tsresize mouseleave.tsresize",function(){v()}).bind("contextmenu.tsresize",function(){f.resizableReset(d);var a=g.isEmptyObject?g.isEmptyObject(j):j==={};j={};return a})}},remove:function(d,c){c.$table.removeClass("hasResizable").find("thead").unbind("mouseup.tsresize mouseleave.tsresize contextmenu.tsresize").find("tr").children().unbind("mousemove.tsresize mouseup.tsresize").find(".tablesorter-resizer,.tablesorter-resizer-grip").remove(); f.resizableReset(d)}});
        f.resizableReset=function(d){d.config.$headers.filter(":not(.resizable-false)").css("width","");f.storage&&f.storage(d,"tablesorter-resizable",{})};
        f.addWidget({id:"saveSort",priority:20,options:{saveSort:!0},init:function(d,c,b,a){c.format(d,b,a,!0)},format:function(d,c,b,a){var e,h=c.$table;b=!1!==b.saveSort;var m={sortList:c.sortList};c.debug&&(e=new Date);h.hasClass("hasSaveSort")?b&&(d.hasInitialized&&f.storage)&&(f.storage(d,"tablesorter-savesort",m),c.debug&&f.benchmark("saveSort widget: Saving last sort: "+ c.sortList,e)):(h.addClass("hasSaveSort"),m="",f.storage&&(m=(b=f.storage(d,"tablesorter-savesort"))&&b.hasOwnProperty("sortList")&&g.isArray(b.sortList)?b.sortList:"",c.debug&&f.benchmark('saveSort: Last sort loaded: "'+m+'"',e),h.bind("saveSortReset",function(a){a.stopPropagation();f.storage(d,"tablesorter-savesort","")})),a&&m&&0<m.length?c.sortList=m:d.hasInitialized&&(m&&0<m.length)&&h.trigger("sorton",[m]))},remove:function(d){f.storage&&f.storage(d,"tablesorter-savesort","")}})
    })(jQuery);

</script>

<script>
    /*!
     * TableSorter 2.10.8 min - Client-side table sorting with ease!
     * Copyright (c) 2007 Christian Bach
     */
    !function(f){f.extend({tablesorter:new function(){function c(d){"undefined"!==typeof console&&"undefined"!==typeof console.log?console.log(d):alert(d)}function t(d,b){c(d+" ("+((new Date).getTime()-b.getTime())+"ms)")}function r(d,b,a){if(!b)return"";var e=d.config,c=e.textExtraction,l="",l="simple"===c?e.supportsTextContent?b.textContent:f(b).text():"function"===typeof c?c(b,d,a):"object"===typeof c&&c.hasOwnProperty(a)?c[a](b,d,a):e.supportsTextContent?b.textContent:f(b).text();return f.trim(l)} function j(d){var b=d.config,a=b.$tbodies=b.$table.children("tbody:not(."+b.cssInfoBlock+")"),e,u,l,p,n,k,h="";if(0===a.length)return b.debug?c("*Empty table!* Not building a parser cache"):"";a=a[0].rows;if(a[0]){e=[];u=a[0].cells.length;for(l=0;l<u;l++){p=b.$headers.filter(":not([colspan])");p=p.add(b.$headers.filter('[colspan="1"]')).filter('[data-column="'+l+'"]:last');n=b.headers[l];k=g.getParserById(g.getData(p,n,"sorter"));b.empties[l]=g.getData(p,n,"empty")||b.emptyTo||(b.emptyToBottom?"bottom": "top");b.strings[l]=g.getData(p,n,"string")||b.stringTo||"max";if(!k)a:{p=d;n=a;k=-1;for(var f=l,m=void 0,t=g.parsers.length,F=!1,D="",m=!0;""===D&&m;)k++,n[k]?(F=n[k].cells[f],D=r(p,F,f),p.config.debug&&c("Checking if value was empty on row "+k+", column: "+f+': "'+D+'"')):m=!1;for(;0<=--t;)if((m=g.parsers[t])&&"text"!==m.id&&m.is&&m.is(D,p,F)){k=m;break a}k=g.getParserById("text")}b.debug&&(h+="column:"+l+"; parser:"+k.id+"; string:"+b.strings[l]+"; empty: "+b.empties[l]+"\n");e.push(k)}}b.debug&& c(h);b.parsers=e}function v(d){var b=d.tBodies,a=d.config,e,u,l=a.parsers,p,n,k,h,q,m,H,j=[];a.cache={};if(!l)return a.debug?c("*Empty table!* Not building a cache"):"";a.debug&&(H=new Date);a.showProcessing&&g.isProcessing(d,!0);for(h=0;h<b.length;h++)if(a.cache[h]={row:[],normalized:[]},!f(b[h]).hasClass(a.cssInfoBlock)){e=b[h]&&b[h].rows.length||0;u=b[h].rows[0]&&b[h].rows[0].cells.length||0;for(n=0;n<e;++n)if(q=f(b[h].rows[n]),m=[],q.hasClass(a.cssChildRow))a.cache[h].row[a.cache[h].row.length- 1]=a.cache[h].row[a.cache[h].row.length-1].add(q);else{a.cache[h].row.push(q);for(k=0;k<u;++k)if(p=r(d,q[0].cells[k],k),p=l[k].format(p,d,q[0].cells[k],k),m.push(p),"numeric"===(l[k].type||"").toLowerCase())j[k]=Math.max(Math.abs(p)||0,j[k]||0);m.push(a.cache[h].normalized.length);a.cache[h].normalized.push(m)}a.cache[h].colMax=j}a.showProcessing&&g.isProcessing(d);a.debug&&t("Building cache for "+e+" rows",H)}function x(d,b){var a=d.config,e=d.tBodies,c=[],l=a.cache,p,n,k,h,q,m,r,j,D,s,v;if(l[0]){a.debug&& (v=new Date);for(j=0;j<e.length;j++)if(p=f(e[j]),p.length&&!p.hasClass(a.cssInfoBlock)){q=g.processTbody(d,p,!0);p=l[j].row;n=l[j].normalized;h=(k=n.length)?n[0].length-1:0;for(m=0;m<k;m++)if(s=n[m][h],c.push(p[s]),!a.appender||!a.removeRows){D=p[s].length;for(r=0;r<D;r++)q.append(p[s][r])}g.processTbody(d,q,!1)}a.appender&&a.appender(d,c);a.debug&&t("Rebuilt table",v);b||g.applyWidget(d);f(d).trigger("sortEnd",d)}}function A(d){var b=[],a={},e=0,u=f(d).find("thead:eq(0), tfoot").children("tr"),l, p,n,k,h,q,m,j,r,s;for(l=0;l<u.length;l++){h=u[l].cells;for(p=0;p<h.length;p++){k=h[p];q=k.parentNode.rowIndex;m=q+"-"+k.cellIndex;j=k.rowSpan||1;r=k.colSpan||1;"undefined"===typeof b[q]&&(b[q]=[]);for(n=0;n<b[q].length+1;n++)if("undefined"===typeof b[q][n]){s=n;break}a[m]=s;e=Math.max(s,e);f(k).attr({"data-column":s});for(n=q;n<q+j;n++){"undefined"===typeof b[n]&&(b[n]=[]);m=b[n];for(k=s;k<s+r;k++)m[k]="x"}}}d.config.columns=e;var v,B,x,A,z,y,C,w=d.config;w.headerList=[];w.headerContent=[];w.debug&& (C=new Date);A=w.cssIcon?'<i class="'+w.cssIcon+'"></i>':"";w.$headers=f(d).find(w.selectorHeaders).each(function(d){B=f(this);v=w.headers[d];w.headerContent[d]=this.innerHTML;z=w.headerTemplate.replace(/\{content\}/g,this.innerHTML).replace(/\{icon\}/g,A);w.onRenderTemplate&&(x=w.onRenderTemplate.apply(B,[d,z]))&&"string"===typeof x&&(z=x);this.innerHTML='<div class="tablesorter-header-inner">'+z+"</div>";w.onRenderHeader&&w.onRenderHeader.apply(B,[d]);this.column=a[this.parentNode.rowIndex+"-"+ this.cellIndex];var b=g.getData(B,v,"sortInitialOrder")||w.sortInitialOrder;this.order=/^d/i.test(b)||1===b?[1,0,2]:[0,1,2];this.count=-1;this.lockedOrder=!1;y=g.getData(B,v,"lockedOrder")||!1;"undefined"!==typeof y&&!1!==y&&(this.order=this.lockedOrder=/^d/i.test(y)||1===y?[1,1,1]:[0,0,0]);B.addClass(w.cssHeader);w.headerList[d]=this;B.parent().addClass(w.cssHeaderRow);B.attr("tabindex",0)});E(d);w.debug&&(t("Built headers:",C),c(w.$headers))}function y(d,b,a){var e=d.config;e.$table.find(e.selectorRemove).remove(); j(d);v(d);G(e.$table,b,a)}function E(d){var b,a=d.config;a.$headers.each(function(d,c){b="false"===g.getData(c,a.headers[d],"sorter");c.sortDisabled=b;f(c)[b?"addClass":"removeClass"]("sorter-false")})}function C(d){var b,a,e,c=d.config,l=c.sortList,p=[c.cssAsc,c.cssDesc],g=f(d).find("tfoot tr").children().removeClass(p.join(" "));c.$headers.removeClass(p.join(" "));e=l.length;for(b=0;b<e;b++)if(2!==l[b][1]&&(d=c.$headers.not(".sorter-false").filter('[data-column="'+l[b][0]+'"]'+(1===e?":last":"")), d.length))for(a=0;a<d.length;a++)d[a].sortDisabled||(d.eq(a).addClass(p[l[b][1]]),g.length&&g.filter('[data-column="'+l[b][0]+'"]').eq(a).addClass(p[l[b][1]]))}function z(d){var b=0,a=d.config,e=a.sortList,c=e.length,l=d.tBodies.length,p,g,k,h,q,m,j,r,s;if(!a.serverSideSorting&&a.cache[0]){a.debug&&(p=new Date);for(k=0;k<l;k++)q=a.cache[k].colMax,s=(m=a.cache[k].normalized)&&m[0]?m[0].length-1:0,m.sort(function(l,p){for(g=0;g<c;g++){h=e[g][0];r=e[g][1];j=/n/i.test(a.parsers&&a.parsers[h]?a.parsers[h].type|| "":"")?"Numeric":"Text";j+=0===r?"":"Desc";/Numeric/.test(j)&&a.strings[h]&&(b="boolean"===typeof a.string[a.strings[h]]?(0===r?1:-1)*(a.string[a.strings[h]]?-1:1):a.strings[h]?a.string[a.strings[h]]||0:0);var k=f.tablesorter["sort"+j](d,l[h],p[h],h,q[h],b);if(k)return k}return l[s]-p[s]});a.debug&&t("Sorting on "+e.toString()+" and dir "+r+" time",p)}}function I(d,b){d.trigger("updateComplete");"function"===typeof b&&b(d[0])}function G(d,b,a){!1!==b&&!d[0].isProcessing?d.trigger("sorton",[d[0].config.sortList, function(){I(d,a)}]):I(d,a)}function J(d){var b=d.config,a=b.$table,e,c;b.$headers.find(b.selectorSort).add(b.$headers.filter(b.selectorSort)).unbind("mousedown.tablesorter mouseup.tablesorter sort.tablesorter keypress.tablesorter").bind("mousedown.tablesorter mouseup.tablesorter sort.tablesorter keypress.tablesorter",function(a,e){if(1!==(a.which||a.button)&&!/sort|keypress/.test(a.type)||"keypress"===a.type&&13!==a.which||"mouseup"===a.type&&!0!==e&&250<(new Date).getTime()-c)return!1;if("mousedown"=== a.type)return c=(new Date).getTime(),"INPUT"===a.target.tagName?"":!b.cancelSelection;b.delayInit&&!b.cache&&v(d);var n=(/TH|TD/.test(this.tagName)?f(this):f(this).parents("th, td").filter(":first"))[0];if(!n.sortDisabled){var k,h,q,m=d.config,j=!a[m.sortMultiSortKey],r=f(d);r.trigger("sortStart",d);n.count=a[m.sortResetKey]?2:(n.count+1)%(m.sortReset?3:2);m.sortRestart&&(h=n,m.$headers.each(function(){if(this!==h&&(j||!f(this).is("."+m.cssDesc+",."+m.cssAsc)))this.count=-1}));h=n.column;if(j){m.sortList= [];if(null!==m.sortForce){k=m.sortForce;for(q=0;q<k.length;q++)k[q][0]!==h&&m.sortList.push(k[q])}k=n.order[n.count];if(2>k&&(m.sortList.push([h,k]),1<n.colSpan))for(q=1;q<n.colSpan;q++)m.sortList.push([h+q,k])}else if(m.sortAppend&&1<m.sortList.length&&g.isValueInArray(m.sortAppend[0][0],m.sortList)&&m.sortList.pop(),g.isValueInArray(h,m.sortList))for(q=0;q<m.sortList.length;q++)n=m.sortList[q],k=m.headerList[n[0]],n[0]===h&&(n[1]=k.order[k.count],2===n[1]&&(m.sortList.splice(q,1),k.count=-1));else if(k= n.order[n.count],2>k&&(m.sortList.push([h,k]),1<n.colSpan))for(q=1;q<n.colSpan;q++)m.sortList.push([h+q,k]);if(null!==m.sortAppend){k=m.sortAppend;for(q=0;q<k.length;q++)k[q][0]!==h&&m.sortList.push(k[q])}r.trigger("sortBegin",d);setTimeout(function(){C(d);z(d);x(d)},1)}});b.cancelSelection&&b.$headers.attr("unselectable","on").bind("selectstart",!1).css({"user-select":"none",MozUserSelect:"none"});a.unbind("sortReset update updateRows updateCell updateAll addRows sorton appendCache applyWidgetId applyWidgets refreshWidgets destroy mouseup mouseleave ".split(" ").join(".tablesorter ")).bind("sortReset.tablesorter", function(a){a.stopPropagation();b.sortList=[];C(d);z(d);x(d)}).bind("updateAll.tablesorter",function(a,b,e){a.stopPropagation();g.refreshWidgets(d,!0,!0);g.restoreHeaders(d);A(d);J(d);y(d,b,e)}).bind("update.tablesorter updateRows.tablesorter",function(a,b,e){a.stopPropagation();E(d);y(d,b,e)}).bind("updateCell.tablesorter",function(e,c,g,k){e.stopPropagation();a.find(b.selectorRemove).remove();var h,q,m;h=a.find("tbody");e=h.index(f(c).parents("tbody").filter(":first"));var u=f(c).parents("tr").filter(":first"); c=f(c)[0];h.length&&0<=e&&(q=h.eq(e).find("tr").index(u),m=c.cellIndex,h=b.cache[e].normalized[q].length-1,b.cache[e].row[d.config.cache[e].normalized[q][h]]=u,b.cache[e].normalized[q][m]=b.parsers[m].format(r(d,c,m),d,c,m),G(a,g,k))}).bind("addRows.tablesorter",function(c,g,f,k){c.stopPropagation();var h=g.filter("tr").length,u=[],m=g[0].cells.length,t=a.find("tbody").index(g.parents("tbody").filter(":first"));b.parsers||j(d);for(c=0;c<h;c++){for(e=0;e<m;e++)u[e]=b.parsers[e].format(r(d,g[c].cells[e], e),d,g[c].cells[e],e);u.push(b.cache[t].row.length);b.cache[t].row.push([g[c]]);b.cache[t].normalized.push(u);u=[]}G(a,f,k)}).bind("sorton.tablesorter",function(b,e,c,g){b.stopPropagation();a.trigger("sortStart",this);var h,u,m,j=d.config;b=e||j.sortList;j.sortList=[];f.each(b,function(a,b){h=[parseInt(b[0],10),parseInt(b[1],10)];if(m=j.headerList[h[0]])j.sortList.push(h),u=f.inArray(h[1],m.order),m.count=0<=u?u:h[1]%(j.sortReset?3:2)});C(d);a.trigger("sortBegin",this);z(d);x(d,g);"function"===typeof c&& c(d)}).bind("appendCache.tablesorter",function(a,b,e){a.stopPropagation();x(d,e);"function"===typeof b&&b(d)}).bind("applyWidgetId.tablesorter",function(a,e){a.stopPropagation();g.getWidgetById(e).format(d,b,b.widgetOptions)}).bind("applyWidgets.tablesorter",function(a,b){a.stopPropagation();g.applyWidget(d,b)}).bind("refreshWidgets.tablesorter",function(a,b,e){a.stopPropagation();g.refreshWidgets(d,b,e)}).bind("destroy.tablesorter",function(a,b,e){a.stopPropagation();g.destroy(d,b,e)})}var g=this; g.version="2.10.8";g.parsers=[];g.widgets=[];g.defaults={theme:"default",widthFixed:!1,showProcessing:!1,headerTemplate:"{content}",onRenderTemplate:null,onRenderHeader:null,cancelSelection:!0,dateFormat:"mmddyyyy",sortMultiSortKey:"shiftKey",sortResetKey:"ctrlKey",usNumberFormat:!0,delayInit:!1,serverSideSorting:!1,headers:{},ignoreCase:!0,sortForce:null,sortList:[],sortAppend:null,sortInitialOrder:"asc",sortLocaleCompare:!1,sortReset:!1,sortRestart:!1,emptyTo:"bottom",stringTo:"max",textExtraction:"simple", textSorter:null,widgets:[],widgetOptions:{zebra:["even","odd"]},initWidgets:!0,initialized:null,tableClass:"tablesorter",cssAsc:"tablesorter-headerAsc",cssChildRow:"tablesorter-childRow",cssDesc:"tablesorter-headerDesc",cssHeader:"tablesorter-header",cssHeaderRow:"tablesorter-headerRow",cssIcon:"tablesorter-icon",cssInfoBlock:"tablesorter-infoOnly",cssProcessing:"tablesorter-processing",selectorHeaders:"> thead th, > thead td",selectorSort:"th, td",selectorRemove:".remove-me",debug:!1,headerList:[], empties:{},strings:{},parsers:[]};g.log=c;g.benchmark=t;g.construct=function(d){return this.each(function(){if(!this.tHead||0===this.tBodies.length||!0===this.hasInitialized)return this.config&&this.config.debug?c("stopping initialization! No thead, tbody or tablesorter has already been initialized"):"";var b=f(this),a=this,e,u="",l=f.metadata;a.hasInitialized=!1;a.isProcessing=!0;a.config={};e=f.extend(!0,a.config,g.defaults,d);f.data(a,"tablesorter",e);e.debug&&f.data(a,"startoveralltimer",new Date); e.supportsTextContent="x"===f("<span>x</span>")[0].textContent;e.supportsDataObject=1.4<=parseFloat(f.fn.jquery);e.string={max:1,min:-1,"max+":1,"max-":-1,zero:0,none:0,"null":0,top:!0,bottom:!1};/tablesorter\-/.test(b.attr("class"))||(u=""!==e.theme?" tablesorter-"+e.theme:"");e.$table=b.addClass(e.tableClass+u);e.$tbodies=b.children("tbody:not(."+e.cssInfoBlock+")");A(a);if(a.config.widthFixed&&0===f(a).find("colgroup").length){var p=f("<colgroup>"),n=f(a).width();f(a.tBodies[0]).find("tr:first").children("td").each(function(){p.append(f("<col>").css("width", parseInt(1E3*(f(this).width()/n),10)/10+"%"))});f(a).prepend(p)}j(a);e.delayInit||v(a);J(a);e.supportsDataObject&&"undefined"!==typeof b.data().sortlist?e.sortList=b.data().sortlist:l&&(b.metadata()&&b.metadata().sortlist)&&(e.sortList=b.metadata().sortlist);g.applyWidget(a,!0);0<e.sortList.length?b.trigger("sorton",[e.sortList,{},!e.initWidgets]):e.initWidgets&&g.applyWidget(a);e.showProcessing&&b.unbind("sortBegin.tablesorter sortEnd.tablesorter").bind("sortBegin.tablesorter sortEnd.tablesorter", function(b){g.isProcessing(a,"sortBegin"===b.type)});a.hasInitialized=!0;a.isProcessing=!1;e.debug&&g.benchmark("Overall initialization time",f.data(a,"startoveralltimer"));b.trigger("tablesorter-initialized",a);"function"===typeof e.initialized&&e.initialized(a)})};g.isProcessing=function(d,b,a){d=f(d);var e=d[0].config;d=a||d.find("."+e.cssHeader);b?(0<e.sortList.length&&(d=d.filter(function(){return this.sortDisabled?!1:g.isValueInArray(parseFloat(f(this).attr("data-column")),e.sortList)})),d.addClass(e.cssProcessing)): d.removeClass(e.cssProcessing)};g.processTbody=function(d,b,a){if(a)return d.isProcessing=!0,b.before('<span class="tablesorter-savemyplace"/>'),a=f.fn.detach?b.detach():b.remove();a=f(d).find("span.tablesorter-savemyplace");b.insertAfter(a);a.remove();d.isProcessing=!1};g.clearTableBody=function(d){f(d)[0].config.$tbodies.empty()};g.restoreHeaders=function(d){var b=d.config;b.$table.find(b.selectorHeaders).each(function(a){f(this).find(".tablesorter-header-inner").length&&f(this).html(b.headerContent[a])})}; g.destroy=function(d,b,a){d=f(d)[0];if(d.hasInitialized){g.refreshWidgets(d,!0,!0);var e=f(d),c=d.config,l=e.find("thead:first"),p=l.find("tr."+c.cssHeaderRow).removeClass(c.cssHeaderRow),n=e.find("tfoot:first > tr").children("th, td");l.find("tr").not(p).remove();e.removeData("tablesorter").unbind("sortReset update updateAll updateRows updateCell addRows sorton appendCache applyWidgetId applyWidgets refreshWidgets destroy mouseup mouseleave keypress sortBegin sortEnd ".split(" ").join(".tablesorter ")); c.$headers.add(n).removeClass(c.cssHeader+" "+c.cssAsc+" "+c.cssDesc).removeAttr("data-column");p.find(c.selectorSort).unbind("mousedown.tablesorter mouseup.tablesorter keypress.tablesorter");g.restoreHeaders(d);!1!==b&&e.removeClass(c.tableClass+" tablesorter-"+c.theme);d.hasInitialized=!1;"function"===typeof a&&a(d)}};g.regex=[/(^([+\-]?(?:0|[1-9]\d*)(?:\.\d*)?(?:[eE][+\-]?\d+)?)?$|^0x[0-9a-f]+$|\d+)/gi,/(^([\w ]+,?[\w ]+)?[\w ]+,?[\w ]+\d+:\d+(:\d+)?[\w ]?|^\d{1,4}[\/\-]\d{1,4}[\/\-]\d{1,4}|^\w+, \w+ \d+, \d{4})/, /^0x[0-9a-f]+$/i];g.sortText=function(d,b,a,e){if(b===a)return 0;var c=d.config,l=c.string[c.empties[e]||c.emptyTo],f=g.regex;if(""===b&&0!==l)return"boolean"===typeof l?l?-1:1:-l||-1;if(""===a&&0!==l)return"boolean"===typeof l?l?1:-1:l||1;if("function"===typeof c.textSorter)return c.textSorter(b,a,d,e);d=b.replace(f[0],"\\0$1\\0").replace(/\\0$/,"").replace(/^\\0/,"").split("\\0");e=a.replace(f[0],"\\0$1\\0").replace(/\\0$/,"").replace(/^\\0/,"").split("\\0");b=parseInt(b.match(f[2]),16)||1!==d.length&& b.match(f[1])&&Date.parse(b);if(a=parseInt(a.match(f[2]),16)||b&&a.match(f[1])&&Date.parse(a)||null){if(b<a)return-1;if(b>a)return 1}c=Math.max(d.length,e.length);for(b=0;b<c;b++){a=isNaN(d[b])?d[b]||0:parseFloat(d[b])||0;f=isNaN(e[b])?e[b]||0:parseFloat(e[b])||0;if(isNaN(a)!==isNaN(f))return isNaN(a)?1:-1;typeof a!==typeof f&&(a+="",f+="");if(a<f)return-1;if(a>f)return 1}return 0};g.sortTextDesc=function(d,b,a,e){if(b===a)return 0;var c=d.config,f=c.string[c.empties[e]||c.emptyTo];return""===b&& 0!==f?"boolean"===typeof f?f?-1:1:f||1:""===a&&0!==f?"boolean"===typeof f?f?1:-1:-f||-1:"function"===typeof c.textSorter?c.textSorter(a,b,d,e):g.sortText(d,a,b)};g.getTextValue=function(d,b,a){if(b){var c=d?d.length:0,g=b+a;for(b=0;b<c;b++)g+=d.charCodeAt(b);return a*g}return 0};g.sortNumeric=function(d,b,a,c,f,l){if(b===a)return 0;d=d.config;c=d.string[d.empties[c]||d.emptyTo];if(""===b&&0!==c)return"boolean"===typeof c?c?-1:1:-c||-1;if(""===a&&0!==c)return"boolean"===typeof c?c?1:-1:c||1;isNaN(b)&& (b=g.getTextValue(b,f,l));isNaN(a)&&(a=g.getTextValue(a,f,l));return b-a};g.sortNumericDesc=function(d,b,a,c,f,l){if(b===a)return 0;d=d.config;c=d.string[d.empties[c]||d.emptyTo];if(""===b&&0!==c)return"boolean"===typeof c?c?-1:1:c||1;if(""===a&&0!==c)return"boolean"===typeof c?c?1:-1:-c||-1;isNaN(b)&&(b=g.getTextValue(b,f,l));isNaN(a)&&(a=g.getTextValue(a,f,l));return a-b};g.characterEquivalents={a:"\u00e1\u00e0\u00e2\u00e3\u00e4\u0105\u00e5",A:"\u00c1\u00c0\u00c2\u00c3\u00c4\u0104\u00c5",c:"\u00e7\u0107\u010d", C:"\u00c7\u0106\u010c",e:"\u00e9\u00e8\u00ea\u00eb\u011b\u0119",E:"\u00c9\u00c8\u00ca\u00cb\u011a\u0118",i:"\u00ed\u00ec\u0130\u00ee\u00ef\u0131",I:"\u00cd\u00cc\u0130\u00ce\u00cf",o:"\u00f3\u00f2\u00f4\u00f5\u00f6",O:"\u00d3\u00d2\u00d4\u00d5\u00d6",ss:"\u00df",SS:"\u1e9e",u:"\u00fa\u00f9\u00fb\u00fc\u016f",U:"\u00da\u00d9\u00db\u00dc\u016e"};g.replaceAccents=function(d){var b,a="[",c=g.characterEquivalents;if(!g.characterRegex){g.characterRegexArray={};for(b in c)"string"===typeof b&&(a+=c[b],g.characterRegexArray[b]= RegExp("["+c[b]+"]","g"));g.characterRegex=RegExp(a+"]")}if(g.characterRegex.test(d))for(b in c)"string"===typeof b&&(d=d.replace(g.characterRegexArray[b],b));return d};g.isValueInArray=function(d,b){var a,c=b.length;for(a=0;a<c;a++)if(b[a][0]===d)return!0;return!1};g.addParser=function(d){var b,a=g.parsers.length,c=!0;for(b=0;b<a;b++)g.parsers[b].id.toLowerCase()===d.id.toLowerCase()&&(c=!1);c&&g.parsers.push(d)};g.getParserById=function(d){var b,a=g.parsers.length;for(b=0;b<a;b++)if(g.parsers[b].id.toLowerCase()=== d.toString().toLowerCase())return g.parsers[b];return!1};g.addWidget=function(d){g.widgets.push(d)};g.getWidgetById=function(d){var b,a,c=g.widgets.length;for(b=0;b<c;b++)if((a=g.widgets[b])&&a.hasOwnProperty("id")&&a.id.toLowerCase()===d.toLowerCase())return a};g.applyWidget=function(d,b){d=f(d)[0];var a=d.config,c=a.widgetOptions,j=[],l,p,n;a.debug&&(l=new Date);a.widgets.length&&(a.widgets=f.grep(a.widgets,function(b,d){return f.inArray(b,a.widgets)===d}),f.each(a.widgets||[],function(a,b){if((n= g.getWidgetById(b))&&n.id)n.priority||(n.priority=10),j[a]=n}),j.sort(function(a,b){return a.priority<b.priority?-1:a.priority===b.priority?0:1}),f.each(j,function(g,h){h&&(b?(h.hasOwnProperty("options")&&(c=d.config.widgetOptions=f.extend(!0,{},h.options,c)),h.hasOwnProperty("init")&&h.init(d,h,a,c)):!b&&h.hasOwnProperty("format")&&h.format(d,a,c,!1))}));a.debug&&(p=a.widgets.length,t("Completed "+(!0===b?"initializing ":"applying ")+p+" widget"+(1!==p?"s":""),l))};g.refreshWidgets=function(d,b, a){d=f(d)[0];var e,j=d.config,l=j.widgets,p=g.widgets,n=p.length;for(e=0;e<n;e++)if(p[e]&&p[e].id&&(b||0>f.inArray(p[e].id,l)))j.debug&&c("Refeshing widgets: Removing "+p[e].id),p[e].hasOwnProperty("remove")&&p[e].remove(d,j,j.widgetOptions);!0!==a&&g.applyWidget(d,b)};g.getData=function(d,b,a){var c="";d=f(d);var g,l;if(!d.length)return"";g=f.metadata?d.metadata():!1;l=" "+(d.attr("class")||"");"undefined"!==typeof d.data(a)||"undefined"!==typeof d.data(a.toLowerCase())?c+=d.data(a)||d.data(a.toLowerCase()): g&&"undefined"!==typeof g[a]?c+=g[a]:b&&"undefined"!==typeof b[a]?c+=b[a]:" "!==l&&l.match(" "+a+"-")&&(c=l.match(RegExp("\\s"+a+"-([\\w-]+)"))[1]||"");return f.trim(c)};g.formatFloat=function(c,b){if("string"!==typeof c||""===c)return c;var a;c=(b&&b.config?!1!==b.config.usNumberFormat:"undefined"!==typeof b?b:1)?c.replace(/,/g,""):c.replace(/[\s|\.]/g,"").replace(/,/g,".");/^\s*\([.\d]+\)/.test(c)&&(c=c.replace(/^\s*\(/,"-").replace(/\)/,""));a=parseFloat(c);return isNaN(a)?f.trim(c):a};g.isDigit= function(c){return isNaN(c)?/^[\-+(]?\d+[)]?$/.test(c.toString().replace(/[,.'"\s]/g,"")):!0}}});var j=f.tablesorter;f.fn.extend({tablesorter:j.construct});j.addParser({id:"text",is:function(){return!0},format:function(c,t){var r=t.config;c&&(c=f.trim(r.ignoreCase?c.toLocaleLowerCase():c),c=r.sortLocaleCompare?j.replaceAccents(c):c);return c},type:"text"});j.addParser({id:"digit",is:function(c){return j.isDigit(c)},format:function(c,t){var r=j.formatFloat((c||"").replace(/[^\w,. \-()]/g,""),t);return c&& "number"===typeof r?r:c?f.trim(c&&t.config.ignoreCase?c.toLocaleLowerCase():c):c},type:"numeric"});j.addParser({id:"currency",is:function(c){return/^\(?\d+[\u00a3$\u20ac\u00a4\u00a5\u00a2?.]|[\u00a3$\u20ac\u00a4\u00a5\u00a2?.]\d+\)?$/.test((c||"").replace(/[,. ]/g,""))},format:function(c,t){var r=j.formatFloat((c||"").replace(/[^\w,. \-()]/g,""),t);return c&&"number"===typeof r?r:c?f.trim(c&&t.config.ignoreCase?c.toLocaleLowerCase():c):c},type:"numeric"});j.addParser({id:"ipAddress",is:function(c){return/^\d{1,3}[\.]\d{1,3}[\.]\d{1,3}[\.]\d{1,3}$/.test(c)}, format:function(c,f){var r,s=c?c.split("."):"",v="",x=s.length;for(r=0;r<x;r++)v+=("00"+s[r]).slice(-3);return c?j.formatFloat(v,f):c},type:"numeric"});j.addParser({id:"url",is:function(c){return/^(https?|ftp|file):\/\//.test(c)},format:function(c){return c?f.trim(c.replace(/(https?|ftp|file):\/\//,"")):c},type:"text"});j.addParser({id:"isoDate",is:function(c){return/^\d{4}[\/\-]\d{1,2}[\/\-]\d{1,2}/.test(c)},format:function(c,f){return c?j.formatFloat(""!==c?(new Date(c.replace(/-/g,"/"))).getTime()|| "":"",f):c},type:"numeric"});j.addParser({id:"percent",is:function(c){return/(\d\s*?%|%\s*?\d)/.test(c)&&15>c.length},format:function(c,f){return c?j.formatFloat(c.replace(/%/g,""),f):c},type:"numeric"});j.addParser({id:"usLongDate",is:function(c){return/^[A-Z]{3,10}\.?\s+\d{1,2},?\s+(\d{4})(\s+\d{1,2}:\d{2}(:\d{2})?(\s+[AP]M)?)?$/i.test(c)||/^\d{1,2}\s+[A-Z]{3,10}\s+\d{4}/i.test(c)},format:function(c,f){return c?j.formatFloat((new Date(c.replace(/(\S)([AP]M)$/i,"$1 $2"))).getTime()||"",f):c},type:"numeric"}); j.addParser({id:"shortDate",is:function(c){return/(^\d{1,2}[\/\s]\d{1,2}[\/\s]\d{4})|(^\d{4}[\/\s]\d{1,2}[\/\s]\d{1,2})/.test((c||"").replace(/\s+/g," ").replace(/[\-.,]/g,"/"))},format:function(c,f,r,s){if(c){r=f.config;var v=r.headerList[s];s=v.dateFormat||j.getData(v,r.headers[s],"dateFormat")||r.dateFormat;c=c.replace(/\s+/g," ").replace(/[\-.,]/g,"/");"mmddyyyy"===s?c=c.replace(/(\d{1,2})[\/\s](\d{1,2})[\/\s](\d{4})/,"$3/$1/$2"):"ddmmyyyy"===s?c=c.replace(/(\d{1,2})[\/\s](\d{1,2})[\/\s](\d{4})/, "$3/$2/$1"):"yyyymmdd"===s&&(c=c.replace(/(\d{4})[\/\s](\d{1,2})[\/\s](\d{1,2})/,"$1/$2/$3"))}return c?j.formatFloat((new Date(c)).getTime()||"",f):c},type:"numeric"});j.addParser({id:"time",is:function(c){return/^(([0-2]?\d:[0-5]\d)|([0-1]?\d:[0-5]\d\s?([AP]M)))$/i.test(c)},format:function(c,f){return c?j.formatFloat((new Date("2000/01/01 "+c.replace(/(\S)([AP]M)$/i,"$1 $2"))).getTime()||"",f):c},type:"numeric"});j.addParser({id:"metadata",is:function(){return!1},format:function(c,j,r){c=j.config; c=!c.parserMetadataName?"sortValue":c.parserMetadataName;return f(r).metadata()[c]},type:"numeric"});j.addWidget({id:"zebra",priority:90,format:function(c,t,r){var s,v,x,A,y,E,C=RegExp(t.cssChildRow,"i"),z=t.$tbodies;t.debug&&(y=new Date);for(c=0;c<z.length;c++)s=z.eq(c),E=s.children("tr").length,1<E&&(x=0,s=s.children("tr:visible"),s.each(function(){v=f(this);C.test(this.className)||x++;A=0===x%2;v.removeClass(r.zebra[A?1:0]).addClass(r.zebra[A?0:1])}));t.debug&&j.benchmark("Applying Zebra widget", y)},remove:function(c,j,r){var s;j=j.$tbodies;var v=(r.zebra||["even","odd"]).join(" ");for(r=0;r<j.length;r++)s=f.tablesorter.processTbody(c,j.eq(r),!0),s.children().removeClass(v),f.tablesorter.processTbody(c,s,!1)}})}(jQuery);


</script>

<script>
    $(function(){

        var sort_by = function (field, reverse, primer) {
            var key = function (x) {
                return primer ? primer(x[field]) : x[field]
            };
            return function (a, b) {
                var A = key(a), B = key(b);
                //alert(A + " , " + B)
                return ((A < B) ? -1 :
                    (A > B) ? +1 : 0) * [-1, 1][+!!reverse];
            }
        };

        function encode_utf8(s) {
            return unescape(encodeURIComponent(s));
        }

        function decode_utf8(s) {
            return decodeURIComponent(escape(s));
        }

        var allTrucks = (function () {
            var allTrucks = {
                },
                privateVariable = 1;
            allTrucks.propArr = [
                {
                    "ranking": -1,
                    "name": "Diso's",
                    "score": -1,
                    "cuisine": "Italian",
                    "date": "6/28/13",
                    "url": "http://www.ratethattruck.com/disos/",
                    "breakdown": [4, 4, 3.25, 4.5]
                },
                {
                    "ranking": -1,
                    "name": "Fishing Shrimp",
                    "score": -1,
                    "cuisine": "Seafood",
                    "date": "5/30/13",
                    "url": "http://www.ratethattruck.com/fishing-shrimp/",
                    "breakdown": [4, 3.5, 3.5, 3]
                },
                {
                    "ranking": -1,
                    "name": "Milk Truck",
                    "score": -1,
                    "cuisine": "American",
                    "date": "6/7/13",
                    "url": "http://www.ratethattruck.com/milk-truck/",
                    "breakdown": [3, 3, 2.5, 4.25]
                },
                {
                    "ranking": -1,
                    "name": "Mac Truck",
                    "score": -1,
                    "cuisine": "American",
                    "date": "6/11/13",
                    "url": "http://www.ratethattruck.com/mac-truck/",
                    "breakdown": [3, 3.25, 4, 4]
                },
                {
                    "ranking": -1,
                    "name": "Comme Ci Comme Ca",
                    "score": -1,
                    "cuisine": "Mediterranean",
                    "date": "6/24/13",
                    "url": "http://www.ratethattruck.com/cscs/",
                    "breakdown": [4, 4, 3.25, 2.5]
                },
                {
                    "ranking": -1,
                    "name": "Taco Bite",
                    "score": -1,
                    "cuisine": "Mexican",
                    "date": "6/29/13",
                    "url": "http://www.ratethattruck.com/taco-bite/",
                    "breakdown": [1, 4, 4, 4]
                },
                {
                    "ranking": -1,
                    "name": "BobJo Korean Fusion",
                    "score": -1,
                    "cuisine": "Korean",
                    "date": "7/12/13",
                    "url": "http://www.ratethattruck.com/bobjo/",
                    "breakdown": [4,3.5,3.5,3.75]
                },
                {
                    "ranking": -1,
                    "name": "Wing'n It",
                    "score": -1,
                    "cuisine": "American",
                    "date": "7/12/13",
                    "url": "http://www.ratethattruck.com/wingn-it/",
                    "breakdown": [4.5, 3.5, 3.75, 4.5]
                }
            ]
            //0truck/service , 1portion/presentation, 2price, 3food
            calcMainScores = function () {
                for (var i = 0; i < allTrucks.propArr.length; i++) {
                    console.log("-------------------------")
                    var currTotal = 0;
                    for (var j = 0; j < allTrucks.propArr[i].breakdown.length; j++) {

//                        food - 4 price - 3 truck/service - 2 portion/presentation - 1
                        switch (j) {
                            case 0:
                                console.log('truck-service')
                                currTotal += (2 * allTrucks.propArr[i].breakdown[j])
                                break;
                            case 1:
                                console.log('por/pres')
                                currTotal += (1 * allTrucks.propArr[i].breakdown[j])
                                break;
                            case 2:
                                console.log('tr/serv')
                                currTotal += (3 * allTrucks.propArr[i].breakdown[j])
                                break;
                            case 3:
                                console.log('food')
                                currTotal += (4 * allTrucks.propArr[i].breakdown[j])
                                break;
                            default:
                                console.log('break o clock')
                        }


                    }
//                    console.log(currTotal/10)
                    currTotal = currTotal / 10
                    currTotal = Math.round(currTotal * 100) / 100;
                    console.log(currTotal)
                    allTrucks.propArr[i].score = currTotal;
                }
            };
            calcRanks = function () {

                allTrucks.propArr.sort(sort_by('score', false, function (a) {
                    return a;
                }));

                for (var i = 0; i < allTrucks.propArr.length; i++) {
                    allTrucks.propArr[i].ranking = i+1;
                }

                console.log(JSON.stringify(allTrucks.propArr))

            };
            allTrucks.main = function () {
                calcMainScores();
                calcRanks();
            };
            return allTrucks;
        }());

        function addRow2() {

            allTrucks.main();
            var tableBody = document.getElementsByTagName("TBODY").item(0);

            if (!document.getElementsByTagName)
                return;

            for (var i = 0; i < allTrucks.propArr.length; i++) {

                var row = document.createElement("TR");
                var i;
                for (j in allTrucks.propArr[i]) {
                    var newNode;

                    var newCell = document.createElement("TD");

                    if (j == "url") {
                        var a = document.createElement('a');
                        newNode = document.createTextNode(allTrucks.propArr[i]['name']);
                        a.appendChild((newNode));
                        a.title = allTrucks.propArr[i]['name'];
                        a.href = allTrucks.propArr[i][j];
                        a.target = "_blank";
                        newCell.appendChild(a);

                    } else if (Object.prototype.toString.call(allTrucks.propArr[i][j]) === '[object Array]') {
                        continue
                    }
                    else {
                        newNode = document.createTextNode(allTrucks.propArr[i][j]);
                        newCell.appendChild(newNode);
                    }
                    row.appendChild(newCell);

                }
                console.log('sss')
                tableBody.appendChild(row);
            }
        }
        addRow2();

        $('table').tablesorter({
            widgets        : ['zebra', 'columns'],
            usNumberFormat : false,
            sortReset      : true,
            sortList: [[0,0]]
        });
    });
</script>


<div id="content-full" class="grid col-940">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part( 'loop-header' ); ?>

            <?php responsive_entry_before(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php responsive_entry_top(); ?>

                <?php get_template_part( 'post-meta-page' ); ?>

                <div class="post-entry">
                    <?php the_content(__('Read more &#8250;', 'responsive')); ?>
                    <body>
                    <table id="myTable" class="tablesorter">
                        <thead>
                        <tr>
                            <th>Ranking</th>
                            <th>Truck Name</th>
                            <th>RTT Score</th>
                            <th>Cuisine</th>
                            <th>Date Reviewed</th>
                            <th>Link</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </body>
                    <?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'responsive'), 'after' => '</div>')); ?>
                </div><!-- end of .post-entry -->

                <?php get_template_part( 'post-data' ); ?>

                <?php responsive_entry_bottom(); ?>
            </div><!-- end of #post-<?php the_ID(); ?> -->
            <?php responsive_entry_after(); ?>

            <?php responsive_comments_before(); ?>
            <?php comments_template( '', true ); ?>
            <?php responsive_comments_after(); ?>

        <?php
        endwhile;

        get_template_part( 'loop-nav' );

    else :

        get_template_part( 'loop-no-posts' );

    endif;
    ?>

</div><!-- end of #content-full -->

<?php get_footer(); ?>
