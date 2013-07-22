var dynaLogo = (function () {
    var dynaLogo = {},
        privateVariable = 1;

    function privateMethod() {
        // ...
    }

    dynaLogo.srcArr = {
        "smallcell":"http://ratethattruck.com/wp-content/uploads/2013/07/rateThatTruck_logo_compact.png",
        "cell":"http://ratethattruck.com/wp-content/uploads/2013/07/rateThatTruck_logo_compact.png",
        "handheld":"http://ratethattruck.com/wp-content/uploads/2013/07/rateThatTruck_logo_compact.png",
        "smalltablet":"http://ratethattruck.com/wp-content/uploads/2013/07/rateThatTruck_logo_compact.png",
        "tablet":"http://ratethattruck.com/wp-content/uploads/2013/07/RTTmidSize1.png",
        "laptop":"http://ratethattruck.com/wp-content/uploads/2013/07/RTTmidSize1.png",
        "desktop":"http://ratethattruck.com/wp-content/uploads/2013/07/cropped-RTTfullSize.png"

    };
    dynaLogo.onChange = function (inSize) {

        if(inSize <241){
            console.log('smallcell')
            jQuery('#logo a img').attr('src', this.srcArr['smallcell'] );
        }
        else if(inSize <321){
            console.log('cell')
            jQuery('#logo a img').attr('src', this.srcArr['cell'] );
        }
        else if(inSize <481){
            console.log('handheld')
            jQuery('#logo a img').attr('src', this.srcArr['handheld'] );
        }
        else if(inSize <651){
            console.log('smalltablet')
            jQuery('#logo a img').attr('src', this.srcArr['smalltablet'] );

        }
        else if(inSize <801){
            console.log('tablet')
            jQuery('#logo a img').attr('src', this.srcArr['tablet'] );
        }
        else if(inSize <981){
            console.log('laptop')
            jQuery('#logo a img').attr('src', this.srcArr['laptop'] );

        }
        else{
            console.log('desktop')
            jQuery('#logo a img').attr('src', this.srcArr['desktop'] );
        }

    };

    return dynaLogo;
}());

jQuery(document).ready(function ($) {

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

    allTrucks = (function () {
        var allTrucks = {
            },
            privateVariable = 1;
        allTrucks.nameArr = {}
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
                "breakdown": [4, 3.5, 3.5, 3.75]
            },
            {
                "ranking": -1,
                "name": "Wing'n It",
                "score": -1,
                "cuisine": "American",
                "date": "7/12/13",
                "url": "http://www.ratethattruck.com/wingn-it/",
                "breakdown": [4.5, 3.5, 3.75, 4.5]
            },
            {
                "ranking": -1,
                "name": "Supreme Burger/Rhong-Tiam",
                "score": -1,
                "cuisine": "Korean Fusion/American",
                "date": "7/22/13",
                "url": "http://www.ratethattruck.com/supreme-burger/",
                "breakdown": [4.5, 3.5, 2.75, 4.5]
            },
            {
                "ranking": -1,
                "name": "Comme Ci Comme Ca",
                "score": -1,
                "cuisine": "Mediterranean",
                "date": "6/24/13",
                "url": "http://www.ratethattruck.com/cscs/",
                "breakdown": [4, 3.5, 3.25, 2.5]
            }
        ]
//0truck/service , 1portion/presentation, 2price, 3food
        calcMainScores = function () {
            for (var i = 0; i < allTrucks.propArr.length; i++) {
                allTrucks.propArr['name'] = allTrucks.propArr[i];
                console.log("-------------------------")
                var currTotal = 0;
                for (var j = 0; j < allTrucks.propArr[i].breakdown.length; j++) {

//                        food - 4 price - 3 truck/service - 2 portion/presentation - 1
                    switch (j) {
                        case 0:
//                            console.log('truck-service')
                            currTotal += (2 * allTrucks.propArr[i].breakdown[j])
                            break;
                        case 1:
//                            console.log('por/pres')
                            currTotal += (1 * allTrucks.propArr[i].breakdown[j])
                            break;
                        case 2:
//                            console.log('tr/serv')
                            currTotal += (3 * allTrucks.propArr[i].breakdown[j])
                            break;
                        case 3:
//                            console.log('food')
                            currTotal += (4 * allTrucks.propArr[i].breakdown[j])
                            break;
                        default:
//                            console.log('break o clock')
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
                allTrucks.propArr[i].ranking = i + 1;
            }

//            console.log(JSON.stringify(allTrucks.propArr))

        };
        allTrucks.main = function () {
            calcMainScores();
            calcRanks();
        };
        return allTrucks;
    }());
    allTrucks.main();
    dynaLogo.onChange(jQuery(window).width());

});

var jRes = jRespond([
    {
        label: 'smallcell',
        enter: 0,
        exit: 240
    },
    {
        label: 'cell',
        enter: 241,
        exit: 320
    },
    {
        label: 'handheld',
        enter: 321,
        exit: 480
    },
    {
        label: 'smalltablet',
        enter: 481,
        exit: 650
    },
    {
        label: 'tablet',
        enter: 651,
        exit: 800
    },
    {
        label: 'laptop',
        enter: 801,
        exit: 980
    },
    {
        label: 'desktop',
        enter: 981,
        exit: 10000
    }
]);

jRes.addFunc([
    {
        breakpoint: 'desktop',
        enter: function () {
//            console.log('Enter Desktop');
        },
        exit: function () {
//            console.log('Exit Desktop');
        }
    },
    {
        breakpoint: 'laptop',
        enter: function () {
//            console.log('Enter laptop');
        },
        exit: function () {
//            console.log('Exit laptop');
        }
    },
    {
        breakpoint: 'tablet',
        enter: function () {
//            console.log('Enter tablet');
        },
        exit: function () {
//            console.log('Exit tablet');
        }
    },
    {
        breakpoint: 'smalltablet',
        enter: function () {
//            console.log('Enter smalltablet');
        },
        exit: function () {
//            console.log('Exit smalltablet');
        }
    },
    {
        breakpoint: 'handheld',
        enter: function () {
//            console.log('Enter handheld');
        },
        exit: function () {
//            console.log('Exit handheld');
        }
    },
    {
        breakpoint: 'cell',
        enter: function () {
//            console.log('Enter cell');
        },
        exit: function () {
//            console.log('Exit cell');
        }
    },
    {
        breakpoint: 'smallcell',
        enter: function () {
//            console.log('Enter smallcell');
        },
        exit: function () {
//            console.log('Exit smallcell');
        }
    },
    {
        breakpoint: '*',
        enter: function() {
            console.log(jQuery(window).width())
            dynaLogo.onChange(jQuery(window).width());
        },
        exit: function() {
//            myUnInitFunc();
        }
    }
]);

console.log('loadedlibs')


//var styleObj = {
//
//    checkSize:function (inSize) {
//
//        var currSheet='';
//        if (inSize != 'h') {
//            //regular menu
//            currSheet = 'http://ratethattruck.com/wp-content/themes/responsive-joe/style.css?ver=1.9.3.2'
//
//        } else {
//            //responsive menu
//            currSheet = 'http://ratethattruck.com/wp-content/themes/responsive-joe/styleSmall.css?ver=1.9.3.2'
//        }
//
//        if(document.styleSheets){
//            for(var i=0;i<document.styleSheets.length;i++){
//
//                if(document.styleSheets[i].href != null && document.styleSheets[i].href.indexOf('http://ratethattruck.com/wp-content/themes/responsive') != -1 && inSize != 'h'){
//                    //entering big
////                    document.styleSheets[i].disabled=true;
//                    console.log("entering big" + document.styleSheets[i].href )
////                    document.getElementsByTagName("menu")[0].style.setProperty("background-color", "blue", "important");
//                }else if (document.styleSheets[i].href != null && document.styleSheets[i].href.indexOf('http://ratethattruck.com/wp-content/themes/responsive') != -1 && inSize == 'h'){
//                    //entering small
//                    console.log("entering small" + document.styleSheets[i].href)
////                    document.styleSheets[i].disabled=true;
////                    document.getElementsByTagName("menu")[0].style.setProperty("background-color", "white", "important");
//                }else{
//
//                }
//            }
//        }
//
//    }
//
//}
//jRes.addFunc({
//    breakpoint: 'desktop',
//    enter: function () {
//        console.log('>>> run this for the DESKTOP breakpoint <<<');
////        styleObj.checkSize('d');
//
//    },
//    exit: function () {
////        console.log('<<< destroy this when exiting the DESKTOP breakpoint >>>');
//    }
//});
//
//jRes.addFunc({
//    breakpoint: 'laptop',
//    enter: function () {
//        console.log('>>> run this for the LAPTOP breakpoint <<<');
////        styleObj.checkSize('l');
//    },
//    exit: function () {
//    }
//});
//
//jRes.addFunc({
//    breakpoint: 'tablet',
//    enter: function () {
//        console.log('>>> run this for the TABLET breakpoint <<<');
////        styleObj.checkSize('t');
//    },
//    exit: function () {
//
//    }
//});
//
//jRes.addFunc({
//    breakpoint: 'handheld',
//    enter: function () {
//        console.log('>>> run this for the HANDHELD breakpoint <<<');
////        styleObj.checkSize('h');
//    },
//    exit: function () {
////        console.log('<<< destroy this when exiting the HANDHELD breakpoint >>>');
//    }
//});
//
//jRes.addFunc({
//    breakpoint: '*',
//    enter: function () {
////        console.log('>>> run this when entering EVERY breakpoint <<<');
//    },
//    exit: function () {
////        console.log('<<< run this when exiting EVERY breakpoint >>>');
//    }
//});