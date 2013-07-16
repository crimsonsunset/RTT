$(

    function () {

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
                allTrucks.propArr[i].ranking = i + 1;
            }

            console.log(JSON.stringify(allTrucks.propArr))

        };
        allTrucks.main = function () {
            calcMainScores();
            calcRanks();
        };
        return allTrucks;
    }());

});
