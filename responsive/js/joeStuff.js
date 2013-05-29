
// make console.log safe to use
window.console || (console = {log: function () {
}});

/*! jRespond.js v 0.10 | Author: Jeremy Fields [jeremy.fields@viget.com], 2013 | License: MIT */
(function (b, a, c) {
    b.jRespond = function (h) {
        var i = [];
        var n = [];
        var g = h;
        var t = "";
        var m = "";
        var d;
        var e = 0;
        var o = 100;
        var f = 500;
        var r = f;
        var k = function () {
            var v = 0;
            if (typeof(window.innerWidth) != "number") {
                if (!(document.documentElement.clientWidth === 0)) {
                    v = document.documentElement.clientWidth
                } else {
                    v = document.body.clientWidth
                }
            } else {
                v = window.innerWidth
            }
            return v
        };
        var j = function (w) {
            if (w.length === c) {
                u(w)
            } else {
                for (var v = 0; v < w.length; v++) {
                    u(w[v])
                }
            }
        };
        var u = function (x) {
            var w = x.breakpoint;
            var v = x.enter || c;
            i.push(x);
            n.push(false);
            if (q(w)) {
                if (v !== c) {
                    v.call(null, {entering: t, exiting: m})
                }
                n[(i.length - 1)] = true
            }
        };
        var s = function () {
            var A = [];
            var v = [];
            for (var C = 0; C < i.length; C++) {
                var D = i[C]["breakpoint"];
                var x = i[C]["enter"] || c;
                var w = i[C]["exit"] || c;
                if (D === "*") {
                    if (x !== c) {
                        A.push(x)
                    }
                    if (w !== c) {
                        v.push(w)
                    }
                } else {
                    if (q(D)) {
                        if (x !== c && !n[C]) {
                            A.push(x)
                        }
                        n[C] = true
                    } else {
                        if (w !== c && n[C]) {
                            v.push(w)
                        }
                        n[C] = false
                    }
                }
            }
            var y = {entering: t, exiting: m};
            for (var B = 0; B < v.length; B++) {
                v[B].call(null, y)
            }
            for (var z = 0; z < A.length; z++) {
                A[z].call(null, y)
            }
        };
        var p = function (w) {
            var x = false;
            for (var v = 0; v < g.length; v++) {
                if (w >= g[v]["enter"] && w <= g[v]["exit"]) {
                    x = true;
                    break
                }
            }
            if (x && t !== g[v]["label"]) {
                m = t;
                t = g[v]["label"];
                s()
            } else {
                if (!x && t !== "") {
                    t = "";
                    s()
                }
            }
        };
        var q = function (v) {
            if (typeof v === "object") {
                if (v.join().indexOf(t) >= 0) {
                    return true
                }
            } else {
                if (v === "*") {
                    return true
                } else {
                    if (typeof v === "string") {
                        if (t === v) {
                            return true
                        }
                    }
                }
            }
        };
        var l = function () {
            var v = k();
            if (v !== e) {
                r = o;
                p(v)
            } else {
                r = f
            }
            e = v;
            setTimeout(l, r)
        };
        l();
        return{addFunc: function (v) {
            j(v)
        }, getBreakpoint: function () {
            return t
        }}
    }
}(this, this.document));
// call jRespond and add breakpoints
var jRes = jRespond([
    {
        label: 'handheld',
        enter: 0,
        exit: 650
    },
    {
        label: 'tablet',
        enter: 768,
        exit: 979
    },
    {
        label: 'laptop',
        enter: 980,
        exit: 1199
    },
    {
        label: 'desktop',
        enter: 1200,
        exit: 10000
    }
]);


var styleObj = {

    checkSize:function (inSize) {

        var currSheet='';
        if (inSize != 'h') {
            //regular menu
            currSheet = 'http://ratethattruck.com/wp-content/themes/responsive-joe/style.css?ver=1.9.3.2'

        } else {
            //responsive menu
            currSheet = 'http://ratethattruck.com/wp-content/themes/responsive-joe/styleSmall.css?ver=1.9.3.2'
        }

        if(document.styleSheets){
            for(var i=0;i<document.styleSheets.length;i++){

                if(document.styleSheets[i].href != null && document.styleSheets[i].href.indexOf('http://ratethattruck.com/wp-content/themes/responsive') != -1 && inSize != 'h'){
                    //entering big
//                    document.styleSheets[i].disabled=true;
                    console.log("entering big" + document.styleSheets[i].href )
//                    document.getElementsByTagName("menu")[0].style.setProperty("background-color", "blue", "important");
                }else if (document.styleSheets[i].href != null && document.styleSheets[i].href.indexOf('http://ratethattruck.com/wp-content/themes/responsive') != -1 && inSize == 'h'){
                    //entering small
                    console.log("entering small" + document.styleSheets[i].href)
//                    document.styleSheets[i].disabled=true;
//                    document.getElementsByTagName("menu")[0].style.setProperty("background-color", "white", "important");
                }else{

                }
            }
        }

    }

}
jRes.addFunc({
    breakpoint: 'desktop',
    enter: function () {
        console.log('>>> run this for the DESKTOP breakpoint <<<');
        styleObj.checkSize('d');

    },
    exit: function () {
        console.log('<<< destroy this when exiting the DESKTOP breakpoint >>>');
    }
});

//jRes.addFunc({
//    breakpoint: ['laptop', 'tablet'],
//    enter: function () {
//        console.log('>>> run this for the LAPTOP/TABLET breakpoint <<<');
//        styleObj.checkSize('t');
//    },
//    exit: function () {
//        console.log('<<< destroy this when exiting the LAPTOP/TABLET breakpoint >>>');
//    }
//});

jRes.addFunc({
    breakpoint: 'laptop',
    enter: function () {
//        outputStr.innerHTML = 'Current breakpoint: laptop';
        styleObj.checkSize('l');
    },
    exit: function () {
    }
});

jRes.addFunc({
    breakpoint: 'tablet',
    enter: function () {
        styleObj.checkSize('t');
    },
    exit: function () {

    }
});

jRes.addFunc({
    breakpoint: 'handheld',
    enter: function () {
        console.log('>>> run this for the HANDHELD breakpoint <<<');
        styleObj.checkSize('h');
    },
    exit: function () {
        console.log('<<< destroy this when exiting the HANDHELD breakpoint >>>');
    }
});

jRes.addFunc({
    breakpoint: '*',
    enter: function () {
//        console.log('>>> run this when entering EVERY breakpoint <<<');
    },
    exit: function () {
//        console.log('<<< run this when exiting EVERY breakpoint >>>');
    }
});


