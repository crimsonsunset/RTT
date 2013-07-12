<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * Blog Template
 *
 * @file           home.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.1.0
 * @filesource     wp-content/themes/responsive/home.php
 * @link           http://codex.wordpress.org/Templates
 * @since          available since Release 1.0
 */

get_header();

global $more;
$more = 0;
?>
    <head>

    <style>
        body {
            height: 2000px;
        }

        #sidebar {
            float: left;
        }

        #catcher {

        }

        #sticky {
            width: 250px;
            height: 192px;
            border: 1px solid #000;
            margin: 5px;
        }

        #footer {
        }

        #content {
            float: right;
        }
    </style>
    <!-- Demo styling -->
    <link href="js/css/jq.css" rel="stylesheet">

    <!-- Pick a theme, load the plugin & initialize plugin -->
    <link href="js/css/theme.default.css" rel="stylesheet">


    <!-- load jQuery and tablesorter scripts -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>

    <!-- tablesorter widgets (optional) -->
    <script type="text/javascript" src="js/jquery.tablesorter.widgets.min.js"></script>
    <script>
    $(function () {

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
                        newNode = document.createTextNode(allTrucks.propArr[i][j]);
                        a.appendChild((newNode));
                        a.title = allTrucks.propArr[i][j];
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
                tableBody.appendChild(row);
            }
        }

//        addRow2();


        function createWidget() {
            var NUM_RANKINGS = 5;

            allTrucks.main();
            var tableBody = document.getElementsByTagName("TBODY").item(0);

            if (!document.getElementsByTagName)
                return;

//            alert(allTrucks.propArr.length)
            for (var i = 0; i < allTrucks.propArr.length; i++) {
                if (i + 1 > NUM_RANKINGS)break;

                var row = document.createElement("TR");
                for (j in allTrucks.propArr[i]) {
                    var newNode;
                    var newCell = document.createElement("TD");

                    if (j == "name") {
                        console.log(JSON.stringify(allTrucks.propArr[i][j]))
                        var a = document.createElement('a');
                        newNode = document.createTextNode(allTrucks.propArr[i][j]);
                        a.appendChild((newNode));
                        a.title = allTrucks.propArr[i][j];
                        a.href = allTrucks.propArr[i]['url'];
                        a.target = "_blank";
                        newCell.appendChild(a);

                    } else if (j == "ranking") {
                        newNode = document.createTextNode(allTrucks.propArr[i][j]);
                        newCell.appendChild(newNode);
                    }
                    else {
                        continue
                    }
                    row.appendChild(newCell);

                }
                tableBody.appendChild(row);
            }
        }

        createWidget();


        $('table').tablesorter({
            widgets: ['zebra', 'columns'],
            usNumberFormat: false,
            sortReset: true,
            sortList: [
                [0, 0]
            ]
        });
    });
    </script>
    <script>
        $(document).ready(function () {
            function isScrolledTo(elem) {
                var docViewTop = $(window).scrollTop(); //num of pixels hidden above current screen
                var docViewBottom = docViewTop + $(window).height();

                var elemTop = $(elem).offset().top; //num of pixels above the elem
                var elemBottom = elemTop + $(elem).height();

                return ((elemTop <= docViewTop));
            }

            var catcher = $('#catcher');
            var sticky = $('#sticky');
            var footer = $('#footer');

            $(window).scroll(function () {
                if (isScrolledTo(sticky) | !isScrolledTo(footer)) { // stick to window
                    sticky.css('position', 'fixed');
                    sticky.css('top', '0px');
                }
//            var topStopHeight = catcher.offset().top + catcher.height();
//            if ( topStopHeight > sticky.offset().top) { // stick back to top
//                sticky.css('position','absolute');
//                sticky.css('top', topStopHeight);
//            }
//            var bottomStopHeight = footer.offset().top;
//            if ( bottomStopHeight < sticky.offset().top + sticky.height()) { // stop above footer
//                sticky.css('position','absolute');
//                sticky.css('top', bottomStopHeight - sticky.outerHeight() - 10); // a bit of padding
//            }
            });
        });
    </script>

    </head>


    <div id="content-blog" class="<?php echo implode(' ', responsive_get_content_classes()); ?>">

        <?php get_template_part('loop-header'); ?>

        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>

                <?php responsive_entry_before(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php responsive_entry_top(); ?>

                    <?php get_template_part('post-meta'); ?>

                    <div class="post-entry">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail(); ?>
                            </a>
                        <?php endif; ?>
                        <?php the_content(__('Read more &#8250;', 'responsive')); ?>
                        <?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'responsive'), 'after' => '</div>')); ?>
                    </div>
                    <!-- end of .post-entry -->

                    <?php get_template_part('post-data'); ?>

                    <?php responsive_entry_bottom(); ?>
                </div><!-- end of #post-<?php the_ID(); ?> -->
                <?php responsive_entry_after(); ?>

            <?php
            endwhile;

            get_template_part('loop-nav'); else :

            get_template_part('loop-no-posts');

        endif;
        ?>

    </div><!-- end of #content-blog -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>