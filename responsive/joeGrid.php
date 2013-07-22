<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/*
    Template Name: joeGrid
*/

get_header(); ?>

    <link href="/wp-content/themes/responsive/core/js/css/jq.css" rel="stylesheet">

    <!-- Pick a theme, load the plugin & initialize plugin -->
    <link href="/wp-content/themes/responsive/core/js/css/theme.default.css" rel="stylesheet">

    <!-- load jQuery and tablesorter scripts -->


    <script>
    jQuery(function(){

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
                tableBody.appendChild(row);
            }
        }
        function addRowMobile() {

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
                tableBody.appendChild(row);
            }
        }

        if (jQuery(window).width() < 590) {
            addRowMobile();

        } else {
            addRow2();
        }

        jQuery('table').tablesorter({
            widgets        : ['zebra', 'columns'],
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