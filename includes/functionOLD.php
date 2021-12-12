<?php

/**
 * Created by Dar Al-Manhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 9/19/2016
 * Time: 9:41 AM
 */

//New Function for Platform

function getRecentStories($limit = 4)

{

    global $con;

    $sql = "SELECT `story`.*,`stories_cat`.*, `story`.`rating_count` as rate_count FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE `story`.`status`=1  GROUP BY `story`.`storyid` order by storyid DESC LIMIT " . $limit;

    $result = $con->query($sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo PaintStory($row);

    }


}


function getBestSellerStories($limit = 4)

{

    global $con;

    $sql = "Select  categories1.*,  story1.*,  story1.rating_count as rate_count From  books.story story1 Inner Join   books.stories_cat categories1 On story1.catid = categories1.catid WHERE story1.status=1  Order By   story1.sales_count Desc Limit " . $limit;

    $result = $con->query($sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo PaintStory($row);

    }


}


function getPopularStories($limit = 4)

{

    global $con;

    $sql = "Select   categories1.*,  story1.*,story1.rating_count As rate_count From  story story1 Inner Join   stories_cat categories1 On story1.catid = categories1.catid WHERE story1.status=1   Group By   story1.view_count Order By   view_count Desc Limit " . $limit;

    $result = $con->query($sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo PaintStory($row);

    }


}


function getTopRatedStories($limit = 4)

{

    global $con;

    $sql = "Select   categories1.*,  story1.*, story1.rating_count As rate_count From   story story1 Inner Join   stories_cat categories1 On story1.catid = categories1.catid WHERE story1.status=1  Group By   story1.storyid Order By   story1.rate Desc Limit  " . $limit;

    $result = $con->query($sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo PaintStory($row);

    }


}


function getTopFavoriteStories($limit = 4)

{

    global $con;

    $sql = "Select   categories1.*,  story1.*,story1.rating_count As rate_count From   story story1 Inner Join   stories_cat categories1 On story1.catid = categories1.catid  WHERE story1.status=1 Group By   story1.storyid Order By   story1.favorite_count Desc Limit  " . $limit;

    $result = $con->query($sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo PaintStory($row);

    }


}


function getTopFavoriteBooks($limit = 4)

{

    global $con;

    $sql = "SELECT `books`.*,`categories`.*, `books`.`rating_count` as rate_count FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1  GROUP BY `books`.`bookid` order by `books`.`favorites` DESC LIMIT " . $limit;

    $result = $con->query($sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo PaintBook($row);

    }


}


function getTopRatedBooks($limit = 4)

{

    global $con;

    $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1  GROUP BY `books`.`bookid` order by `books`.`rate` DESC LIMIT " . $limit;

    $result = $con->query($sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo PaintBook($row);

    }


}


function getRecentBooks($limit = 4)

{

    global $con;

    $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1  GROUP BY `books`.`bookid` order by bookid DESC LIMIT " . $limit;

    $result = $con->query($sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo PaintBook($row);

    }


}


function getBestSellerBooks($limit = 4)

{

    global $con;

    $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1  GROUP BY `books`.`bookid` order by `books`.`sales` DESC LIMIT " . $limit;

    $result = $con->query($sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo PaintBook($row);

    }


}


function getPopularBooks($limit = 4)

{

    global $con;

    $sql = "SELECT `books`.*,`categories`.*, `books`.`rating_count` as rate_count FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1  GROUP BY `books`.`bookid` order by `books`.`views` DESC LIMIT " . $limit;

    $result = $con->query($sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo PaintBook($row);

    }


}


function paintBooks($result)

{

    while ($row = mysqli_fetch_assoc($result)) {

        echo "<li class='floating-left'>" . PaintBook($row) . "</li>";

    }

}


function calcRate($rate, $e)

{

    if ($rate == $e) {

        return 'checked';

    }

}


function PaintBook($book, $type = "StudentBook")
{
    global $Lang;

    global $lang_code;

    if($lang_code!="ar" && $lang_code!="en"){
        $cat_code="ar";
    }else{
        $cat_code=$lang_code;
    }

    $id = uniqid(rand(10000, 99999), true);

    $id = explode(".", $id)[0];


    $active = isWished($book['bookid'], 'book');


    //  echo $book['language']."AA";

    if ($book['language'] == "En") {

        $righ_class = "";

        $direction = "ltr";

    } else {

        $direction = "rtl";

        $righ_class = "-ar";

    }
    if ($type == 'StudentBook') {
        $viewLink = SITE_URL . $lang_code . '/books/' . $book['bookid'] . '/' . str_replace(" ", "-", $book['name'])."?s=1";
        $linkbooks = ' <a href="' . SITE_URL . $lang_code . '/books/category/' . $book['category'] . '/' . str_replace(" ", "-", $book['name_' . $cat_code]) . '" class="text-left cat" title="' . $book['name_' . $cat_code] . '"><label class="floating-left">' . $Lang->Book . '</label><label class="floating-left">/</label><label class="floating-left">' . $book['name_' . $cat_code] . '</label></a>';
    } else if ($type == 'TeachertBook') {
        $viewLink = SITE_URL . $lang_code . '/teachers-guides/' . $book['bookid'] . '/' . str_replace(" ", "-", $book['name'])."?s=1";
        $linkbooks = ' <a href="' . SITE_URL . $lang_code . '/teachers-guides/category/' . $book['category'] . '/' . str_replace(" ", "-", $book['name_' . $cat_code]) . '" class="text-left cat" title="' . $book['name_' . $cat_code] . '"><label class="floating-left">' . $Lang->Book . '</label><label class="floating-left">/</label><label class="floating-left">' . $book['name_' . $cat_code] . '</label></a>';

    }


    $result = ' <div class="item-container' . $righ_class . ' jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="' . $viewLink . '" class="libro floating-left" title="' . $book['seodescription_' . $cat_code] . '">
                                                        <div class="backcover" style="background-color:#' . $book['color'] . '"></div>
                                                        <span></span>
                                                        <img src="' . SITE_URL . 'platform/books/' . $book['bookid'] . '/cover.jpg" alt="' . $book['name'] . '" />
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                        <a href="' . $viewLink . '" class="text-left title" style="direction:' . $direction . ';" title="' . $book['name'] . '">' . $book['name'] . '</a>


                                                       ' . $linkbooks . '
                                                    <div class="floating-right display-inline-block ">
                                                       <div class="right floating-right"><div class="display-inline-block"><span class="floating-right">' . $book['price'] . '</span><span class="floating-right">$</span></div></div>
                                                    </div>';
    if ($book['oldprice'] > 0) {
        $result .= '<div class="floating-right display-inline-block split"> - </div>
                                                    <div class="floating-right display-inline-block old-price">
                                                       <div class="right floating-right"><div class="display-inline-block"><span class="floating-right">' . $book['oldprice'] . '</span><span class="floating-right">$</span></div></div>
                                                    </div>';
    }

    $result .= '  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(' . $book['rate_count'] . ')</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input ' . disableRate($book['bookid'], $book, 'book') . ' prodect="book" rate="5" bookid="' . $book['bookid'] . '" ' . calcRate($book['rate'], 5) . ' class=" star star-5" id="star-5-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($book['bookid'], $book, 'book')) . ' star star-5" for="star-5-' . $id . '"></label>
                                                                    <input ' . disableRate($book['bookid'], $book, 'book') . ' prodect="book" rate="4" bookid="' . $book['bookid'] . '" ' . calcRate($book['rate'], 4) . ' class="star star-4" id="star-4-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($book['bookid'], $book, 'book')) . ' star star-4" for="star-4-' . $id . '"></label>
                                                                    <input ' . disableRate($book['bookid'], $book, 'book') . ' prodect="book" rate="3" bookid="' . $book['bookid'] . '" ' . calcRate($book['rate'], 3) . ' class="star star-3" id="star-3-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($book['bookid'], $book, 'book')) . ' star star-3" for="star-3-' . $id . '"></label>
                                                                    <input ' . disableRate($book['bookid'], $book, 'book') . ' prodect="book" rate="2" bookid="' . $book['bookid'] . '" ' . calcRate($book['rate'], 2) . ' class="star star-2" id="star-2-' . $id . '" type="radio" name="star"/>
                                                                    <label class="star star-2" for="star-2-' . $id . '"></label>
                                                                    <input ' . disableRate($book['bookid'], $book, 'book') . ' prodect="book" rate="1" bookid="' . $book['bookid'] . '" ' . calcRate($book['rate'], 1) . ' class="star star-1" id="star-1-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($book['bookid'], $book, 'book')) . ' star star-1" for="star-1-' . $id . '"></label>
                                                                </form>
                                                            </div>
                                                        </div>';

    if ($book['language'] == "En") {
        $result .= '<div class="addtofav floating-left text-left flag-english"></div>';
    } elseif ($book['language'] == "Fr") {
        $result .= '<div class="addtofav floating-left text-left flag-France" ></div>';
    } elseif ($book['language'] == "Ar") {
        $result .= '<div class="addtofav floating-left text-left flag-Arabic"></div>';

    }
    $result .= '
                                                    <div class="hover-container floating-right">
                                                        <div class="buttons-container floating-left">
                                                            <a class="buy book_addtocart floating-left" booktype="' . $book['booktype'] . '" price="' . $book['price'] . '" bookid="' . $book['bookid'] . '"></a>
                                                        </div>
                                                        <div class="view-container floating-right">
                                                            <a href="' . $viewLink . '" title="' . $Lang->Views . '" class="view-icon floating-left"></a>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>';

    //<a class="wash-list '.$active.'" id="book'.$book['bookid'].'_'.$id.'"  floating-left" onclick="sendprocess({'.chr(39).'TypeProcesses'.chr(39).':'.chr(39).'settofavorit'.chr(39).',id:'.chr(39).$book['bookid'].chr(39).' ,type:'.chr(39).'book'.chr(39).',random:'.chr(39).$id.chr(39).'})"></a>

    return $result;


}

/*
function PainTeachertBook($book)

{

    global $Lang;

    global $lang_code;

    $id = uniqid(rand(10000, 99999), true);

    $id = explode(".", $id)[0];


    $active = isWished($book['bookid'], 'book');


    //  echo $book['language']."AA";

    if ($book['language'] == "En") {

        $righ_class = "";

        $direction = "ltr";

    } else {

        $direction = "rtl";

        $righ_class = "-ar";

    }


    $viewLink = SITE_URL . $lang_code . '/teachers-guides/' . $book['bookid'] . '/' . str_replace(" ", "-", $book['name']);

    $result = ' <div class="item-container' . $righ_class . ' jq_item_container book floating-left reveal-bottom">

                                                <div class="book-container">

                                                    <a href="' . $viewLink . '" class="libro floating-left" title="' . $book['seodescription_' . $lang_code] . '">

                                                        <div class="backcover" style="background-color:#' . $book['color'] . '"></div>

                                                        <span></span>

                                                        <img src="' . SITE_URL . 'platform/books/' . $book['bookid'] . '/cover.jpg" alt="' . $book['name'] . '" />

                                                    </a>

                                                </div>

                                                <div class="title-sub-container clear-both">

                                                     <div class="floating-left display-inline-block">

                                                        <a href="' . $viewLink . '" class="text-left title" style="direction:' . $direction . ';" title="' . $book['name'] . '">' . $book['name'] . '</a>

                                                        <a href="' . SITE_URL . $lang_code . '/teachers-guides/category/' . $book['category'] . '/' . str_replace(" ", "-", $book['name_' . $lang_code]) . '" class="text-left cat" title="' . $book['name_' . $lang_code] . '">' . $book['name_' . $lang_code] . '</a>



                                                    </div>

                                                 </div>

                                                <div class="bottom-container">

                                                    <div class="center floating-left">

                                                        <div class="rating-container">

                                                            <div class="number floating-right">(' . $book['rate_count'] . ')</div>

                                                            <div class="stars floating-right">

                                                                <form action="">

                                                                    <input ' . disableRate($book['bookid'], $book, 'book') . ' prodect="book" rate="5" bookid="' . $book['bookid'] . '" ' . calcRate($book['rate'], 5) . ' class=" star star-5" id="star-5-' . $id . '" type="radio" name="star"/>

                                                                    <label class="' . msglogin(disableRate($book['bookid'], $book, 'book')) . ' star star-5" for="star-5-' . $id . '"></label>

                                                                    <input ' . disableRate($book['bookid'], $book, 'book') . ' prodect="book" rate="4" bookid="' . $book['bookid'] . '" ' . calcRate($book['rate'], 4) . ' class="star star-4" id="star-4-' . $id . '" type="radio" name="star"/>

                                                                    <label class="' . msglogin(disableRate($book['bookid'], $book, 'book')) . ' star star-4" for="star-4-' . $id . '"></label>

                                                                    <input ' . disableRate($book['bookid'], $book, 'book') . ' prodect="book" rate="3" bookid="' . $book['bookid'] . '" ' . calcRate($book['rate'], 3) . ' class="star star-3" id="star-3-' . $id . '" type="radio" name="star"/>

                                                                    <label class="' . msglogin(disableRate($book['bookid'], $book, 'book')) . ' star star-3" for="star-3-' . $id . '"></label>

                                                                    <input ' . disableRate($book['bookid'], $book, 'book') . ' prodect="book" rate="2" bookid="' . $book['bookid'] . '" ' . calcRate($book['rate'], 2) . ' class="star star-2" id="star-2-' . $id . '" type="radio" name="star"/>

                                                                    <label class="star star-2" for="star-2-' . $id . '"></label>

                                                                    <input ' . disableRate($book['bookid'], $book, 'book') . ' prodect="book" rate="1" bookid="' . $book['bookid'] . '" ' . calcRate($book['rate'], 1) . ' class="star star-1" id="star-1-' . $id . '" type="radio" name="star"/>

                                                                    <label class="' . msglogin(disableRate($book['bookid'], $book, 'book')) . ' star star-1" for="star-1-' . $id . '"></label>

                                                                </form>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="right floating-right"><div class="display-inline-block"><span class="floating-right">' . ($book['price'] + $book['eprice'] + $book['iprice']) . '</span><span class="floating-right">$</span></div></div>

                                                </div>

                                                <div class="hover-container">

                                                    <div class="buttons-container floating-left">

                                                        <a class="buy book_addtocart floating-left" booktype="' . $book['booktype'] . '" price="' . $book['price'] . '" bookid="' . $book['bookid'] . '"></a>

                                                        <a class="wash-list ' . $active . ' add_favorite floating-left" id="book' . $book['bookid'] . '_' . $id . '" data-id="' . $book['bookid'] . '" data-type="book" ></a>

                                                    </div>

                                                    <div class="view-container floating-right">

                                                        <a title="' . $Lang->Views . '" class="view-icon floating-left"></a>

                                                        <span class="view-number floating-left">' . $book['views'] . '</span>

                                                    </div>

                                                </div>

                                            </div>';

    //<a class="wash-list '.$active.'" id="book'.$book['bookid'].'_'.$id.'"  floating-left" onclick="sendprocess({'.chr(39).'TypeProcesses'.chr(39).':'.chr(39).'settofavorit'.chr(39).',id:'.chr(39).$book['bookid'].chr(39).' ,type:'.chr(39).'book'.chr(39).',random:'.chr(39).$id.chr(39).'})"></a>

    return $result;


}
*/

function msglogin($val)

{

    if ($val == 'disabled') {

        return 'msgerrorlogin';

    }

}


//end khalid [000002-17-9-2016]

function getTypeIcon($type)

{

//    switch($type){

//        case 1:

//

//        case 3:

//        case 5:

//        case 7:

//

//        break;

//        case 2:

//        case 3:

//        case 6:

//        case 7:

//

//        break;

//

//        case 4:

//        case 5:

//        case 6:

//        case 7:

//

//        break;

//

//    }

//    themes/main-Light-green-En/images/cat/product/books.svg

}


//start khalid [000002-17-9-2016]
function PaintStory($story)
{
    global $Lang;
    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    $id = uniqid(rand(10000, 99999), true);
    $id = explode(".", $id)[0];
    $active = isWished($story['storyid'], 'story');
    $viewLink = SITE_URL . $lang_code . '/stories/' . $story['storyid'] . '/' . str_replace(" ", "-", $story['title'])."?s=1";
    if ($story['language'] == "En") {
        $righ_class = "";
        $direction = "ltr";
    } else {
        $direction = "rtl";
        $righ_class = "-ar";
    }
    $result = '   <div class="item-container' . $righ_class . ' jq_item_container story floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="' . $viewLink . '" class="libro floating-left" title="' . $story['seodescription_' . $cat_code] . '">
                                                        <div class="backcover" style="background-color:#' . $story['color'] . '"></div>
                                                        <span></span>
                                                        <img src="' . SITE_URL . 'platform/stories/' . $story['seriesid'] . '/story/' . $story['storyid'] . '/images/pic.jpg" alt="' . $story['title'] . '"/>
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                        <a href="' . $viewLink . '" class="text-left title" style="direction:' . $direction . ';" title="' . $story['title'] . '">' . $story['title'] . '</a>
                                                        <a href="' . SITE_URL . $lang_code . '/stories/category/' . $story['catid'] . '/' . str_replace(" ", "-", $story['name_' . $cat_code]) . '" class="text-left cat" title="' . $story['name_' . $cat_code] . '"><label class="floating-left">' . $Lang->Story . '</label><label class="floating-left">/</label><label class="floating-left">' . $story['name_' . $cat_code] . '</label></a>
                                                        <div class="floating-right display-inline-block jq_hideprice">
                                                       <div class="right floating-right"><div class="display-inline-block"><span class="floating-right">' . $story['price'] . '</span><span class="floating-right">$</span></div></div>
                                                   ';
    if ($story['oldprice'] > 0) {
        $result .= '  <div class="floating-right display-inline-block split"> - </div>
                                                    <div class="floating-right display-inline-block old-price">
                                                       <div class="right floating-right"><div class="display-inline-block"><span class="floating-right">' . $story['oldprice'] . '</span><span class="floating-right">$</span></div></div>
                                                    </div>';
    }

    $result .= '</div>
                                                </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(' . $story['rate_count'] . ')</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input ' . disableRate($story['storyid'], $story, 'story') . ' prodect="story" rate="5" bookid="' . $story['storyid'] . '" ' . calcRate($story['rate'], 5) . ' class="star star-5" id="star-5-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($story['storyid'], $story, 'story')) . ' star star-5" for="star-5-' . $id . '"></label>
                                                                    <input ' . disableRate($story['storyid'], $story, 'story') . ' prodect="story" rate="4" bookid="' . $story['storyid'] . '" ' . calcRate($story['rate'], 4) . ' class="star star-4" id="star-4-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($story['storyid'], $story, 'story')) . ' star star-4" for="star-4-' . $id . '"></label>
                                                                    <input ' . disableRate($story['storyid'], $story, 'story') . ' prodect="story" rate="3" bookid="' . $story['storyid'] . '" ' . calcRate($story['rate'], 3) . ' class="star star-3" id="star-3-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($story['storyid'], $story, 'story')) . ' star star-3" for="star-3-' . $id . '"></label>
                                                                    <input ' . disableRate($story['storyid'], $story, 'story') . ' prodect="story" rate="2" bookid="' . $story['storyid'] . '" ' . calcRate($story['rate'], 2) . ' class="star star-2" id="star-2-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($story['storyid'], $story, 'story')) . ' star star-2" for="star-2-' . $id . '"></label>
                                                                    <input ' . disableRate($story['storyid'], $story, 'story') . ' prodect="story" rate="1" bookid="' . $story['storyid'] . '" ' . calcRate($story['rate'], 1) . ' class="star star-1" id="star-1-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($story['storyid'], $story, 'story')) . ' star star-1" for="star-1-' . $id . '"></label>
                                                                </form>
                                                            </div>
                                                        </div>';
    if ($story['language'] == "En") {
        $result .= '<div class="addtofav floating-left text-left flag-english"></div>';
    } elseif ($story['language'] == "Fr") {
        $result .= '<div class="addtofav floating-left text-left flag-France" ></div>';
    } elseif ($story['language'] == "Ar") {
        $result .= '<div class="addtofav floating-left text-left flag-Arabic"></div>';

    }
    $paper = array(1, 3, 5, 7);
    $result .= '<div class="hover-container floating-right">';
    if (in_array($story['type'], $paper)) {
        $result .= ' <div class="buttons-container floating-left">
                                                        <a class="buy story_addtocart  floating-left"  booktype="' . $story['type'] . '"  bookid="' . $story['storyid'] . '"></a>
                                                    </div>';
    }
    $result .= '<div class="view-container floating-right">
                                                        <a href="' . $viewLink . '" title="' . $Lang->Views . '" class="view-icon floating-left"></a>
                                                    </div>
                                                </div>
                                                </div>

                                                </div>

                                            </div>';
    //                                                        <a class="wash-list '.$active.'" id="story'.$story['storyid'].'_'.$id.'" floating-left" onclick="sendprocess({'.chr(39).'TypeProcesses'.chr(39).':'.chr(39).'settofavorit'.chr(39).',id:'.chr(39).$story['storyid'].chr(39).' ,type:'.chr(39).'story'.chr(39).',random:'.chr(39).$id.chr(39).'})"></a>


    return $result;


}



function PaintToy($toy)
{
    global $Lang;
    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    $id = uniqid(rand(10000, 99999), true);
    $id = explode(".", $id)[0];
    $active = isWished($toy['productid'], 'toy');
    $viewLink = SITE_URL . $lang_code . '/store/toys/' . $toy['productid'] . '/' . str_replace(" ", "-", $toy['title_' . $cat_code]);
    $bg=SITE_URL."platform/products/".$toy["productid"]."/thumbnail_small.jpg";


        $righ_class = "";
        $direction = "ltr";

    $result = '   <div class="item-container' . $righ_class . ' jq_item_container toy floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="' . $viewLink . '" class="libro floating-left" title="' . $toy['description_' . $cat_code] . '">
                                                        <div class="backcover" style="background-color:#' . $toy['color'] . '"></div>
                                                        <span></span>
                                                        <img src="' . $bg . '" alt="' . $toy['title_' . $cat_code] . '"/>
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                        <a href="' . $viewLink . '" class="text-left title" style="direction:' . $direction . ';" title="' . $toy['title_' . $cat_code] . '">' .$toy['title_' . $cat_code] . '</a>
                                                        <a  class="text-left cat" title="' . $toy['brand_' . $cat_code] . '"><label class="floating-left">' . $Lang->Product . '</label><label class="floating-left">/</label><label class="floating-left">' . $toy['brand_' . $cat_code] . '</label></a>
                                                        <div class="floating-right display-inline-block jq_hideprice">
                                                       <div class="right floating-right"><div class="display-inline-block"><span class="floating-right">' . $toy['Price'] . '</span><span class="floating-right">$</span></div></div>
                                                   ';

    $result .= '</div>
                                                </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right"></div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input ' . disableRate($toy['productid'], $toy, 'toy') . ' prodect="toy" rate="5" bookid="' . $toy['productid'] . '" ' . calcRate($toy['rate'], 5) . ' class="star star-5" id="star-5-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($toy['productid'], $toy, 'toy')) . ' star star-5" for="star-5-' . $id . '"></label>
                                                                    <input ' . disableRate($toy['productid'], $toy, 'toy') . ' prodect="toy" rate="4" bookid="' . $toy['productid'] . '" ' . calcRate($toy['rate'], 4) . ' class="star star-4" id="star-4-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($toy['productid'], $toy, 'toy')) . ' star star-4" for="star-4-' . $id . '"></label>
                                                                    <input ' . disableRate($toy['productid'], $toy, 'toy') . ' prodect="toy" rate="3" bookid="' . $toy['productid'] . '" ' . calcRate($toy['rate'], 3) . ' class="star star-3" id="star-3-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($toy['productid'], $toy, 'toy')) . ' star star-3" for="star-3-' . $id . '"></label>
                                                                    <input ' . disableRate($toy['productid'], $toy, 'toy') . ' prodect="toy" rate="2" bookid="' . $toy['productid'] . '" ' . calcRate($toy['rate'], 2) . ' class="star star-2" id="star-2-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($toy['productid'], $toy, 'toy')) . ' star star-2" for="star-2-' . $id . '"></label>
                                                                    <input ' . disableRate($toy['productid'], $toy, 'toy') . ' prodect="toy" rate="1" bookid="' . $toy['productid'] . '" ' . calcRate($toy['rate'], 1) . ' class="star star-1" id="star-1-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($toy['productid'], $toy, 'toy')) . ' star star-1" for="star-1-' . $id . '"></label>
                                                                </form>
                                                            </div>
                                                        </div>';

    $result .= '<div class="hover-container floating-right">';
        $result .= ' <div class="buttons-container floating-left">
                                                        <a class="buy toy_addtocart  floating-left"  booktype="1"  bookid="' . $toy['productid'] . '"></a>
                                                    </div>';

    $result .= '<div class="view-container floating-right">
                                                        <a href="' . $viewLink . '" title="' . $Lang->Views . '" class="view-icon floating-left"></a>
                                                    </div>
                                                </div>
                                                </div>

                                                </div>

                                            </div>';
    //                                                        <a class="wash-list '.$active.'" id="story'.$toy['storyid'].'_'.$id.'" floating-left" onclick="sendprocess({'.chr(39).'TypeProcesses'.chr(39).':'.chr(39).'settofavorit'.chr(39).',id:'.chr(39).$toy['storyid'].chr(39).' ,type:'.chr(39).'story'.chr(39).',random:'.chr(39).$id.chr(39).'})"></a>


    return $result;


}


//end khalid [000002-17-9-2016]

function getHtmlData($type)

{

    $sql = "SELECT * FROM `lookup` WHERE `lindex`='" . $type . "'";

    $row = mysql_fetch_array(mysql_query($sql));

    return $row["lvalue_" . $_COOKIE['language']];

}


function getBookInfo($id)

{

    $sql = "SELECT * FROM `books` WHERE bookid=" . $id;

    $result = mysql_query($sql);

    return mysql_fetch_array($result);

}


function isWished($id, $type)

{

    if (!isset($_SESSION["user"]['userid'])) {

        return '';

    }

    global $con;

    $sql = "Select `wishs`.`wishid` From `wishs` where `wishs`.`userid`='" . $_SESSION["user"]['userid'] . "' and `wishs`.`bookid`=" . $id . " and `wishs`.`type`='" . $type . "' ";

    $result = $con->query($sql);

    if (mysqli_num_rows($result) > 0) {

        return 'active';

    } else {

        return '';

    }

}


function isBought($bookid, $type)

{

    global $con;

    $sql = "SELECT `payments`.*,`payments_books`.* FROM `payments` JOIN `payments_books` on `payments`.`paymentid`=`payments_books`.`paymentid` WHERE `payments_books`.`itemtype`='" . $type . "' AND  `payments`.`userid`=" . $_SESSION["user"]["userid"] . " AND `bookid`=" . $bookid;


    $result = $con->query($sql);

    if (mysqli_num_rows($result) > 0) {

        return true;

    } else {

        return false;

    }

}


function Zip($source, $destination, $exeption = NULL)

{

    if (!extension_loaded('zip') || !file_exists($source)) {

        return false;

    }


    $zip = new ZipArchive();

    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {

        return false;

    }

    //  chdir($source);

    $source = str_replace('\\', '/', realpath($source));


    if (is_dir($source) === true) {

        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);


        foreach ($files as $file) {

            $file = str_replace('\\', '/', $file);


            // Ignore "." and ".." folders

            if (in_array(substr($file, strrpos($file, '/') + 1), array('.', '..')))

                continue;


            $file = realpath($file);


            if (is_dir($file) === true) {

                if (strpos($file, 'home') === false) {

                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));

                } else {

                    continue;

                }


            } else if (is_file($file) === true) {

                if ($exeption != NULL) {

                    if (end(explode('.', $file)) != $exeption) {

                        $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));


                    }

                } else {

                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));

                }

            }

        }

    } else if (is_file($source) === true) {

        if ($exeption != NULL) {

            if (end(explode('.', $source)) != $exeption) {

                $zip->addFromString(basename($source), file_get_contents($source));

            }

        } else {

            $zip->addFromString(basename($source), file_get_contents($source));

        }

    }

    // chdir(dirname(__FILE__));


    return $zip->close();

}


//start khalid [000002-17-9-2016]

function canRate($bookid, $bookInfo, $type)

{

    global $con;

    if (isset($_SESSION["user"]['userid']) && $_SESSION["user"]['userid'] != "") {

        $sql = "Select   count(userid) as `count` From rating where `rating`.`type`='" . $type . "' AND userid='" . $_SESSION["user"]['userid'] . "' and bookid=" . $bookid;

        $result = $con->query($sql);

        $rating = false;

        $row = mysqli_fetch_assoc($result);

        if ($row['count'] == 0) {

            $rating = true;

            /* if($bookInfo['price']==0){

                $rating=true;

            }else{

                $sql="SELECT `payments`.*,`payments_books`.* FROM `payments` INNER JOIN `payments_books` on `payments`.`paymentid`=`payments_books`.`paymentid` WHERE `payments`.`userid`=" . $_SESSION["user"]['userid'] . " AND `payments_books`.`bookid`=".$bookid;

                $result = $con->query($sql);

                if(mysqli_num_rows($result)>0){

                    $rating=true;

                }

            }*/

        }

    } else {

        $rating = false;

    }

    return $rating;

}


//end khalid [000002-17-9-2016]

//function canRateStory($storyid,$storyInfo){

//    global $con;

//    if(isset($_SESSION["user"]['userid']) && $_SESSION["user"]['userid']!=""){

//        $sql = "Select count(userid) as count From rating where `type`='story' userid='" . $_SESSION["user"]['userid'] . "' and bookid=".$storyid;

//        $result = $con->query($sql);

//        $rating=false;

//        if($result){

//            $row = mysqli_fetch_assoc($result);

//            if ($row['count'] == 0) {

//                if($storyInfo['price']==0){

//                    $rating=true;

//                }else{

//                    $sql="SELECT `payments`.*,`payments_books`.* FROM `payments` INNER JOIN `payments_books` on `payments`.`paymentid`=`payments_books`.`paymentid` WHERE `payments`.`userid`=" . $_SESSION["user"]['userid'] . " AND `payments_books`.`type`='story' AND `payments_books`.`bookid`=".$storyid;

//                    $result = $con->query($sql);

//                    if(mysqli_num_rows($result)>0){

//                        $rating=true;

//                    }

//                }

//            }

//        }else{

//            $rating=false;

//        }

//

//    }else{

//        $rating=false;

//    }

//    return $rating;

//}

//start khalid [000002-17-9-2016]

function disableRate($bookid, $bookInfo, $type)

{

    if (!canRate($bookid, $bookInfo, $type)) {

        return "disabled";

    }

}


//end khalid [000002-17-9-2016]

//function disableRateStory($storyid,$storyInfo){

//    if(!canRateStory($storyid,$storyInfo)){

//        return "disabled";

//    }

//}

function getAvatar($avatar = "")

{

    if ($avatar == "") {

        if (isset($_SESSION['user']['avatar']) && $_SESSION['user']['avatar'] != "") {

            if (strpos($_SESSION['user']['avatar'], "http") === false) {

                return SITE_URL . $_SESSION['user']['avatar'];

            } else {

                return $_SESSION['user']['avatar'];

            }


        } else {

            return SITE_URL . "themes/main-Light-green-En/images/avatar.svg";

        }

    } else {

        if ($avatar != "") {

            if (strpos($avatar, "http") === false) {

                return SITE_URL . $avatar;

            } else {

                return $avatar;

            }

        } else {

            return SITE_URL . "themes/main-Light-green-En/images/avatar.svg";

        }

    }

}

function getUserAvatar($avatar = "")

{

    if ($avatar == "") {


        return SITE_URL . "themes/main-Light-green-En/images/avatar.svg";


    } else {

        if (strpos($avatar, "http") === false) {

            return SITE_URL . $avatar;

        } else {

            return $avatar;

        }

    }

}

function switch_category_lan($id,$type){
    global $con;
    if($type==1){
        $tabel='stories_cat';
    }else{
        $tabel='categories';
    }
    $sql = "SELECT `name_ar`,`name_en` FROM `".$tabel."` WHERE `catid`=".$id;
    $result= $con->query($sql);
    $category = mysqli_fetch_assoc($result);
    if($type==1){
       $ar=str_replace(" ", "-", $category['name_ar']);
        $en=str_replace(" ", "-", $category['name_en']);
        return [$ar,$en];
    }else{
        return [strtolower($category['name_ar']),strtolower($category['name_en'])];
    }

}
function getLangLink($real_link)  {

    global $lang_code;
    global $session_lang;
    if (!isset($session_lang) || $session_lang == "") {
        $session_lang = "En";
        $_SESSION["session_style"] = "main-Light-green";
    }


    $parm_2='';
    $type=0;
    $parm_3='';
    if(strpos($real_link, "/stories/") !== false){
     $type=1;
    }
    if(strpos($real_link, "/category/") !== false ){
        $parm_1=explode("/category",$real_link);
        $parm_2=explode("/",$parm_1[1]);
        if(strpos($real_link, "?") !== false){
            $parm_3="?".explode("?",$real_link)[1];
        }
    }


    if ($session_lang == "Ar") {

        if (strpos($real_link, "/ar/") !== false) {
            $final_link = str_replace("/ar/", "/en/", $real_link);
            echo "<a id='English' href='" . $final_link . "' class='button'>English</a>";

            $final_link = str_replace("/ar/", "/fr/", $real_link);
            echo "<a id='french' href='" . $final_link . "' class='button'>français</a>";
        } elseif (strpos($real_link, "/ar") !== false) {
            $final_link = str_replace("/ar", "/", $real_link);
            echo "<a id='English' href='" . $final_link . "' class='button'>English</a>";

            $final_link = str_replace("/ar", "/fr", $real_link);
            echo "<a id='french' href='" . $final_link . "' class='button'>français</a>";

        }

        if($parm_2!=''){
            $cat=switch_category_lan($parm_2[1],$type);
            echo "<script>history.pushState({urlPath:'".$cat[1]."'},'','".$cat[0].$parm_3."')</script>";
        }
    } elseif($session_lang == "En") {

        if (strpos($real_link, "/en/") !== false) {

            $final_link = str_replace("/en/", "/ar/", $real_link);
            echo "<a id='Arabic' class='button' href='" . $final_link . "'>عربي</a>";

            $final_link = str_replace("/en/", "/fr/", $real_link);
            echo "<a id='french' href='" . $final_link . "' class='button'>français</a>";

        } elseif (strpos($real_link, "/en") != false) {

            $final_link = str_replace("/en", "/ar", $real_link);
            echo "<a id='Arabic' class='button' href='" . $final_link . "'>عربي</a>";

            $final_link = str_replace("/en", "/fr", $real_link);
            echo "<a id='french' href='" . $final_link . "' class='button'>français</a>";


        } else {

            echo "<a id='Arabic' class='button' href='" . $real_link . "ar'>عربي</a>";
            echo "<a id='french' class='button' href='" . $real_link . "fr'>français</a>";

        }
        if($parm_2!=''){
            $cat=switch_category_lan($parm_2[1],$type);
            echo "<script>history.pushState({urlPath:'".$cat[0]."'},'','".$cat[1].$parm_3."')</script>";
        }
    }else{//french

        if (strpos($real_link, "/fr/") !== false) {

            $final_link = str_replace("/fr/", "/ar/", $real_link);
            echo "<a id='Arabic' class='button' href='" . $final_link . "'>عربي</a>";

            $final_link = str_replace("/fr/", "/en/", $real_link);
            echo "<a id='Arabic' class='button' href='" . $final_link . "'>English</a>";

        } elseif (strpos($real_link, "/fr") != false) {

            $final_link = str_replace("/fr", "/ar", $real_link);
            echo "<a id='Arabic' class='button' href='" . $final_link . "'>عربي</a>";

            $final_link = str_replace("/fr", "/en", $real_link);
            echo "<a id='Arabic' class='button' href='" . $final_link . "'>English</a>";
        } else {

            echo "<a id='Arabic' class='button' href='" . $real_link . "ar'>عربي</a>";
            echo "<a id='Arabic' class='button' href='" . $real_link . "en'>English</a>";

        }
        if($parm_2!=''){
            $cat=switch_category_lan($parm_2[1],$type);
            echo "<script>history.pushState({urlPath:'".$cat[0]."'},'','".$cat[1].$parm_3."')</script>";
        }

    }

}


function getBooksCount()
{

    global $con;

    $result = $con->query("SELECT count(bookid) as bookscount FROM `books` WHERE `books`.`status`=1 AND booktype in(1,3,5,7)");

    $row = mysqli_fetch_assoc($result);

    return $row['bookscount'];

}


function getEbooksCount()

{

    global $con;

    $result = $con->query("SELECT count(bookid) as bookscount FROM `books` WHERE `books`.`status`=1 AND  booktype in(2,3,6,7)");

    $row = mysqli_fetch_assoc($result);

    return $row['bookscount'];

}


function getEnbooksCount()

{

    global $con;

    $result = $con->query("SELECT count(bookid) as bookscount FROM `books` WHERE `books`.`status`=1 AND  booktype in(4,5,6,7)");

    $row = mysqli_fetch_assoc($result);

    return $row['bookscount'];

}


function getStoriesCount()

{

    global $con;

    $result = $con->query("SELECT count(storyid) as storiescount FROM `story` WHERE `story`.`status`=1 AND  `type` in(1,3,5,7)");

    $row = mysqli_fetch_assoc($result);

    return $row['storiescount'];

}


function getEStoriesCount()

{

    global $con;

    $result = $con->query("SELECT count(storyid) as storiescount FROM `story` WHERE  `story`.`status`=1 AND `type` in(2,3,6,7)");

    $row = mysqli_fetch_assoc($result);

    return $row['storiescount'];

}


function getInstoriesCount()

{

    global $con;

    $result = $con->query("SELECT count(storyid) as storiescount FROM `story` WHERE `story`.`status`=1 AND  `type` in(4,5,6,7)");

    $row = mysqli_fetch_assoc($result);

    return $row['storiescount'];

}

function getInWorksheetCount()

{

    global $con;

    $result = $con->query("SELECT count(countworksheetid) as storiescount FROM `worksheet` WHERE `worksheet`.`status`=1 AND  `type` in(4,5,6,7)");

//    $result = "Select media.*,categories.name_ar, categories.name_en From media Inner Join categories On media.category = categories.catid Where ( media.status = 1 And media.id > 0 " . $filter . " ) AND media.id NOT IN(" . $notIn . ") LIMIT 8";


    $row = mysqli_fetch_assoc($result);

    return $row['Worksheetcount'];

}


function getCategories($catid, $table)

{

    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }

    global $con;

    $cat_sql = "Select * From  $table WHERE `parent`=" . $catid;

    $result = $con->query($cat_sql);

    $html = "";

    if (mysqli_num_rows($result) > 0) {

        $cat_sql2 = "Select * From  $table WHERE `catid`=" . $catid;

        $result2 = $con->query($cat_sql2);

        $cat_row2 = mysqli_fetch_assoc($result2);

        $html .= "<optgroup label='" . $cat_row2['name_' . $cat_code] . "'>";

        while ($cat_row = mysqli_fetch_assoc($result)) {

            $html .= getCategories($cat_row['catid'], $table);

        }

        $html .= "</optgroup>";

    } else {

        $cat_sql = "Select * From  $table WHERE `catid`=" . $catid;

        $result = $con->query($cat_sql);

        $cat_row = mysqli_fetch_assoc($result);

        $selected = '';

        if (isset($_GET["category"]) && $cat_row['catid'] == $_GET["category"]) {

            $selected = 'selected';

        }

        $html .= "<option " . $selected . " value='" . $cat_row['catid'] . "'>" . $cat_row['name_' . $cat_code] . "</option>";

    }

    return $html;

}


function getCategoriesDropDown($catid, $table, $level = 0){

    global $session_lang;

    global $lang_code;
    if($lang_code!="ar" && $lang_code!="en"){
        $cat_code="ar";
    }else{
        $cat_code=$lang_code;
    }

    if ($table == "categories") {
        $folder = "books";
    } else if ($table == "faq_categories") {
        $folder = "faq";
    } else {

        $folder = "stories";

    }

    global $con;

    $cat_sql = "Select * From  $table WHERE `parent`=" . $catid;

    $result = $con->query($cat_sql);

    $html = "";

    if (mysqli_num_rows($result) > 0) {

        $cat_sql2 = "Select * From  $table WHERE `catid`=" . $catid;

        $result2 = $con->query($cat_sql2);

        $cat_row2 = mysqli_fetch_assoc($result2);

        $html .= "<li index='$level' class='sub-$level main-dropdown'><a href='#' style='background-image:url(" . SITE_URL . "themes/main-Light-green-" . ucfirst($cat_code) . "/images/cat/$folder/" . $cat_row2["catid"] . ".svg)'><i class='icon-truck icon-large'><label>" . $cat_row2['name_' . $cat_code] . "</label></i></a></li>";

        while ($cat_row = mysqli_fetch_assoc($result)) {

            $html .= getCategoriesDropDown($cat_row['catid'], $table, $level + 1);

        }

    } else {

        $cat_sql = "Select * From  $table WHERE `catid`=" . $catid;

        $result = $con->query($cat_sql);

        $cat_row = mysqli_fetch_assoc($result);

        $selected = '';

        if (isset($_GET["category"]) && $cat_row['catid'] == $_GET["category"]) {

            $selected = "active";

        }

        $html .= '<li title="' . $cat_row['name_' . $cat_code] . '" index="' . $level . '" class="sub-' . $level . ' catli ' . $selected . ' no-image" catid="' . $cat_row['catid'] . '"><a title="' . $cat_row['name_' . $cat_code] . '" href="#" style="background-image:url(' . SITE_URL . 'themes/main-Light-green-' . ucfirst($cat_code) . '/images/cat/' . $folder . '/' .$cat_row["catid"]. '.svg)"><i class="icon-truck icon-large"><label>' . $cat_row['name_' . $cat_code] . '</label></i></a></li>';

    }

    return $html;

}


function getCartItemCount(){

    $items = array();
    if (isset($_COOKIE['items']) && $_COOKIE['items'] != "") {
        $items = json_decode($_COOKIE['items'], true);
    }

    if (!isset($items["book"]) || !is_array($items["book"])) {
        $items["book"] = [];
    }

    if (!isset($items["story"]) || !is_array($items["story"])) {
        $items["story"] = [];
    }

    if (!isset($items["toy"]) || !is_array($items["toy"])) {
        $items["toy"] = [];
    }

    return count($items["book"]) + count($items["story"]) + count($items["toy"]);
}

function mustLogin()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
        header("location:" . SITE_URL);
        exit();
    }
}


function removeNUll($array){

    foreach ($array as $key => $value) {

        if ($value == null) {

            $new[$key] = $value;

        }

    }

    return $new;

}


function drawiconsetting($row_A)
{

    if (isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != "") {

        if (isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"] == 4 || isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"] == 1) {


            return '<a id="control_' . $row_A['qid'] . "_" . $row_A['id'] . '" class="post-setting-btn floating-right"></a>';


        }

    }

    return '';

}

function drowEducationalInquiries($category, $page, $keywords)
{

    global $Lang;

    global $real_link;

    global $con;


    $val = -1;


    if (isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != "") {

        if (isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"] == 4 || isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"] == 1) {

            if (isset($category) && $category != "") {

                if ($category == 5) {


                    $val = 5;

                } else if ($category == 1) {


                    $val = 1;

                } else if ($category == 2) {


                    $val = 2;

                } else if ($category == 3) {


                    $val = 3;

                } else if ($category == 4) {


                    $val = 4;

                }

            } else {


                $val = 5;

            }

        } else if (isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"] == 0) {

            if (isset($category) && $category != "") {

                if ($category == 6) {


                    $val = 6;

                } else if ($category == 0) {


                    $val = 0;

                } else if ($category == 1) {


                    $val = 1;

                } else if ($category == 2) {


                    $val = 2;

                }

            } else {


                $val = 6;


            }

        }


    } else {

        if (isset($category) && $category != "") {

            if ($category == -1) {


                $val = -1;

            } else if ($category == 1) {


                $val = 1;

            } else if ($category == 2) {


                $val = 2;

            }

        } else {


            $val = -1;

        }

    }


    $keyword_filter = "";

    $cat_filter = "";

    if (isset($keywords) && $keywords != "") {

        $keyword_filter = " AND ( `qustion` LIKE '%" . mysqli_real_escape_string($con, $keywords) . "%'   )";

    }

    if (isset($category) && $category != "" && $val != -1) {

        if ($val == 1 || $val == 2) {

            $cat_filter = " AND `state_q` = " . $val;

        } else if ($val == 3 && ($_SESSION["user"]["permession"] == 4) || $val == 3 && $_SESSION["user"]["permession"] == 1) {

            $cat_filter = " AND `state_q` = " . $val;

        } else if ($val == 0) {

            $cat_filter = " AND iduser = " . $_SESSION["user"]['userid'] . " AND `state_q` !=3 ";

        } else if ($val == 4) {

            $cat_filter = " AND views = 0 ";

        } else if ($val == 6) {

            $cat_filter = " AND ( `state_q` = 1 || `state_q` = 2 ||  iduser = " . $_SESSION["user"]['userid'] . " )  AND `state_q` !=3 ";

        } else if ($_SESSION["user"]["permession"] != 4 && $_SESSION["user"]["permession"] != 1) {

            $cat_filter = " AND  `state_q` !=3 ";

        }

    } else if (isset($_SESSION["user"]) && $_SESSION["user"]["permession"] != 4 && $_SESSION["user"]["permession"] != 1) {

        $cat_filter = " AND  `state_q` !=3 ";

    } else {

        $cat_filter = " AND  `state_q` !=3 ";

    }

    $sql = "Select educationalinquiries.*,users.fullname, users.avatar From educationalinquiries Inner Join users On educationalinquiries.iduser = users.userid WHERE  id > 0  " . $keyword_filter . $cat_filter;


    $result = $con->query($sql);

    $num_rows = mysqli_num_rows($result);

    if ($page == "last") {

        $page = ceil($num_rows / 10);

    }

    $link = $real_link;

    if (isset($page) && $page != "") {

        $link = str_replace("&page=" . $page, "", $link);

    }

    $url = "educationalinquiries?";

    if (strpos($link, "?") === false) {

        $url = "educationalinquiries?";

    } else {

        $arr = explode("?", $link);

        $getData = explode("&", $arr[1]);

        $url = "educationalinquiries?" . $arr[1];

    }


    $pagination = getPagination($url, $num_rows);


    $sql = "Select educationalinquiries.*,users.fullname, users.avatar From educationalinquiries Inner Join users On educationalinquiries.iduser = users.userid WHERE  id > 0  " . $keyword_filter . $cat_filter . " ORDER BY educationalinquiries.date DESC " . $pagination[0];


    $result = $con->query($sql);

    $data = "";

    while ($question = mysqli_fetch_assoc($result)) {

        $data .= PaintEducationalInquiries($question);

    }

    return array($data, $pagination[1], $num_rows);

}

function ControlQuestions($type, $id, $stat, $iduser)
{

    global $Lang;

    $data = '';

    if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {

        if ($_SESSION["user"]['permession'] == 1 || $_SESSION["user"]['permession'] == 4) {

            $data .= '<div id="controlsetting_' . $id . '" class="post-setting-container">';

            if ($type == 'main') {

                if ($stat == 2) {

                    $data .= '<a onclick="ControlQuestion(this);" type="' . $type . '" att="' . $id . '" con="unclosed" class="text-left">' . $Lang->UNCLOSED . '</a>';

                } else {

                    $data .= '<a onclick="ControlQuestion(this);" type="' . $type . '" att="' . $id . '" con="closed" class="text-left">' . $Lang->CLOSED . '</a>';

                }

            }

            if ($iduser == $_SESSION["user"]['userid']) {

                $data .= '<a onclick="ControlQuestion(this);" type="' . $type . '"  att="' . $id . '" con="edit" class="text-left">' . $Lang->Edit . '</a>';

            }

            $data .= '<a onclick="ControlQuestion(this);" type="' . $type . '" att="' . $id . '" con="delete" class="text-left">' . $Lang->Delete . '</a>';

            if ($stat == 3) {

                $data .= ' <a onclick="ControlQuestion(this);" type="' . $type . '" att="' . $id . '" con="unhide" class="text-left">' . $Lang->UnHide . '</a> </div>';

            } else {

                $data .= ' <a onclick="ControlQuestion(this);" type="' . $type . '" att="' . $id . '" con="hide" class="text-left">' . $Lang->Hide . '</a> </div>';

            }


        }

    }

    return $data;

}

function getComments($type, $id, $page)

{

    global $con;


    $result = $con->query("SELECT `comments`.*,`users`.* FROM `comments` INNER JOIN `users` ON `comments`.`userid`=`users`.`userid` WHERE `comments`.`productid`=" . $id . " AND `comments`.`type`='" . $type . "'");

    $num_rows = mysqli_num_rows($result);


    if ($page == "last") {

        $page = ceil($num_rows / 10);

    }


    $pagination = getAjaxPagination("jq_comments_page", $num_rows, $page);


    $result = $con->query("SELECT `comments`.*,`users`.* FROM `comments` INNER JOIN `users` ON `comments`.`userid`=`users`.`userid` WHERE `comments`.`productid`=" . $id . " AND `comments`.`type`='" . $type . "'" . $pagination[0]);

    $comments = "";

    while ($row = mysqli_fetch_assoc($result)) {

        if ($row["fullname"] == "") {

            $uname = $row["fullname"];

        } else {

            $uname = $row["uname"];

        }


        $comments .= '<div class="item-container">

                                        <div class="left-content floating-left">

                                            <div class="avatar-container">

                                                <label style="background-image: url(' . getUserAvatar($row["avatar"]) . ');" class=""></label>

                                            </div>

                                        </div>

                                        <div class="right-content floating-left">

                                            <div class="top floating-left">

                                                <label>' . $uname . '</label>

                                                <div class="time-container">

                                                    <span class="floating-left">' . $row["date"] . '</span>

                                                </div>

                                            </div>

                                            <div class="bottom">' . $row['comment'] . '</div>

                                        </div>

                                    </div>';

    }

    return array($comments, $pagination[1], $num_rows);

}


function getAjaxPagination($class, $num_rows, $current = 1){

    $result1[0] = "";

    $result1[1] = "";

    $prev = $current - 1;

    $next = $current + 1;

    $Pages_number = ceil($num_rows / 10);

    if ($Pages_number > 1) {

        if ($current > 9 / 2) {

            $pageBegin = ($current - ceil(9 / 2)) + 1;

            if ($Pages_number > 9) {

                $pageEnd = ($current + ceil(9 / 2)) - 1;

            } else {

                $pageEnd = $Pages_number;

            }

        } else {

            $pageBegin = 1;

            if ($Pages_number > 9) {

                $pageEnd = 9;

            } else {

                $pageEnd = $Pages_number;

            }

        }

        if ($pageEnd > $Pages_number) {

            $pageEnd = $Pages_number;

            if ($Pages_number - 9 + 1 > 0) {

                $pageBegin = $Pages_number - 9 + 1;

            } else {

                $pageBegin = 1;

            }

        }

        if ($pageBegin > 1 && $Pages_number - $pageBegin < 9 - 1) {

            $pageBegin = 1;

        }


        //echo "<script>alert('".$pageBegin.'>>'.$pageEnd."');</script>";

        $result = "";

        for ($i = $pageBegin; $i <= $pageEnd; $i++) {

            if ($current == $i) {

                $result .= "<a class='selected page floating-left $class'  page='" . $i . "' >$i</a>";

            } else {

                $result .= "<a class='page floating-left $class' page='" . $i . "' >$i</a>";

            }

        }

        if ($current != 1) {

            $first = "<a page='1' class='first floating-left $class'><i class='flaticon-arrowheads3'></i></a>";

        } else {

            $first = "";

        }

        if ($prev > 0) {

            $previus = "<a  page='" . $prev . "' class='prev floating-left $class'><i class='flaticon-last-track '></i></a>";

        } else {

            $previus = "";

        }


        if ($Pages_number != $current) {

            $last = "<a page='$Pages_number' class='last floating-left $class'><i class='flaticon-right39'></i></a>";

        } else {

            $last = "";

        }

        if ($next <= $Pages_number) {

            $next_link = " <a page='$next' class='next floating-left $class'><i class='flaticon-right-arrow26'></i></a>";

        } else {

            $next_link = "";

        }

        $begin = $current * 10 - (10);

        $result1[0] = " LIMIT " . $begin . ", " . 10;

        $result1[1] = $first . $previus . $result . $next_link . $last;

    }

    return $result1;

}


function getItemType($cat, $type)

{

    global $Lang;

    switch ($cat) {

        case "book":

            return $Lang->Book;

            break;

        case "story":

            return $Lang->Story;

            break;

        case "Game":

            return $Lang->Game;

            break;

    }

}


function getProductAge($age)
{

    switch ($age) {

        case 5:

            $value = "+22";

            break;
        case 4:

            $value = "12-15";

            break;

        case 3:

            $value = "9-11";

            break;

        case 2:

            $value = "6-8";

            break;

        case 1:

        default :

            $value = "4-5";

            break;

    }

    return $value;

}


function getGrade($grade){

    global $Lang;

    switch ($grade) {

        case 0:

            $value = $Lang->Kindergarten;

            break;

        case 1:

        case 2:

        case 3:

        case 4:

        case 5:

        case 6:

        case 7:

        case 8:

        case 9:

        case 10:

            $value = $grade;

            break;

    }

    return $value;

}


function getSemester($semester){

    global $Lang;

    switch ($semester) {

        case -1:

            $value = $Lang->Other;

            break;

        case 1:

            $value = $Lang->One;

            break;

        case 2:

            $value = $Lang->Tow;

            break;

    }

    return $value;

}


function getBinding($coverType)

{

    global $Lang;

    if ($coverType == 0) {

        return $Lang->SoftCover;

    } else {

        return $Lang->HardCover;

    }

}


function queryBook($filter, $notIn, $Limit = true)
{

    global $con;
    if (!$Limit) {
        $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status` =1 AND ( `books`.`bookid`>0 " . $filter . " ) AND `books`.`bookid` NOT IN(" . $notIn . ") ORDER BY `books`.`name` DESC ";
    } else {
        $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status` =1 AND ( `books`.`bookid`>0 " . $filter . " ) AND `books`.`bookid` NOT IN(" . $notIn . ") ORDER BY `books`.`name` DESC  LIMIT 8";
    }

    //file_put_contents("relatedbooks.txt",file_get_contents("relatedbooks.txt")."\r\n".$sql);

    $result = $con->query($sql);

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $rows;

}


function queryStoreBook($filter, $notIn, $Limit = true)
{

    global $con;
    if (!$Limit) {
        $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status` =1 AND `books`.`store` =1 AND ( `books`.`bookid`>0 " . $filter . " ) AND `books`.`bookid` NOT IN(" . $notIn . ") ORDER BY `books`.`name` DESC ";
    } else {
        $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status` =1 AND `books`.`store` =1 ( `books`.`bookid`>0 " . $filter . " ) AND `books`.`bookid` NOT IN(" . $notIn . ") ORDER BY `books`.`name` DESC  LIMIT 8";
    }

    //file_put_contents("relatedbooks.txt",file_get_contents("relatedbooks.txt")."\r\n".$sql);

    $result = $con->query($sql);

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $rows;

}



function queryWorksheet($filter, $notIn)

{

    global $con;

    $sql = "Select media.*,categories.name_ar, categories.name_en From media Inner Join categories On media.category = categories.catid Where ( media.status = 1 And media.id > 0 " . $filter . " ) AND media.id NOT IN(" . $notIn . ") LIMIT 8";

    $result = $con->query($sql);

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $rows;

}


function fetchRelatedBooks($rows, $exist){

    global $lang_code;

    if (!is_array($exist)) {

        $exist = array($exist);

    }


    foreach ($rows as $book) {

        if (array_search($book['bookid'], $exist) === false && count($exist < 9)) {


            if ($book['language'] == "En") {

                $righ_class = "";

            } else {

                $righ_class = "-ar";

            }

            $data = '<article class="item">

                            <div class="inset">

                                <div class="item-container-book' . $righ_class . ' floating-left reveal-zoom reveal_visible">

                                    <div class="book-container">
                                   
                                        <a href="' . SITE_URL . $lang_code . '/books/' . $book['bookid'] . "/" . str_replace(" ", "-", $book['name']) . '?s=1" class="libro floating-left" title="' . $book['name'] . '">

                                            <div class="backcover" style="background-color:#' . $book['color'] . '"></div>

                                            <span></span>

                                            <img src="' . SITE_URL . 'platform/books/' . $book['bookid'] . '/cover.jpg" alt="' . $book['name'] . '">

                                        </a>

                                    </div>

                                    <div class="title-sub-container clear-both">

                                        <div class="floating-left display-inline-block">

                                            <a href="' . SITE_URL . $lang_code . '/books/' . $book['bookid'] . "/" . str_replace(" ", "-", $book['name']) . '?s=1" class="text-left title" title="' . $book['name'] . '">' . $book['name'] . '</a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </article>';

            echo $data;

            $exist[] = $book["bookid"];

        }

    }

    return $exist;

}


function fetchRelatedStoreBooks($rows, $exist){

    global $lang_code;
    if (!is_array($exist)) {
        $exist = array($exist);
    }


    foreach ($rows as $book) {

        if (array_search($book['bookid'], $exist) === false && count($exist < 9)) {


            if ($book['language'] == "En") {

                $righ_class = "";

            } else {

                $righ_class = "-ar";

            }

            $viewLink = SITE_URL . $lang_code . '/store/books/' . $book['bookid'] . '/' . str_replace(" ", "-", $book['name']);
            $bg=SITE_URL."platform/books/".$book["bookid"]."/cover.jpg";

            $data = '<article class="item tsc_ribbon_wrap slick-slide slick-current slick-active" style="left: 0px; width: 293px;" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00">
                            <div class="inset">
                            <div class="inner-items">
                             <a href="'.$viewLink.'" tabindex="0"></a>
                               <div class="games-item books-class">
                                <a href="'.$viewLink.'" tabindex="0">
                                  <div class="game-thumb" style="background-image: url('.$bg.')"></div>
                                    <div class="game-title">
                                                <label>'.$book['name'].'</label>
                                            </div>
                                            <div class="title-sub-container clear-both floating-left">
                                                <div class="floating-right display-inline-block ">
                                                       <div class="right floating-right"><div class="display-inline-block"><span class="floating-right">'. $book['price'].'</span><span class="floating-right">$</span></div></div>
                                                    </div>
                                            </div>
                                            <div class="display-block top-container">
                                                <div class="hover-container floating-right">
                                                    <div class="buttons-container floating-left">
                                                        <a class="buy book_addtocart store floating-left" booktype="1" price="'. $book['price'].'" bookid="'. $book['bookid'].'"></a>
                                                    </div>
                                                </div>
                                            </div>
                               </a>
                               <div class="display-block secound-container" style="display: none">
                                            <a href="'.$viewLink.'" tabindex="0"></a>
                                            <div class="title-sub-container clear-both floating-left">
                                                <a href="'.$viewLink.'" tabindex="0"></a>
                                                <div class="floating-left display-inline-block"><a tabindex="0"></a>
                                                    <a class="text-left type" tabindex="0">'.$book['name_' . $cat_code].'</a>
                                                </div>                                        
                                            </div>
                                        </div>
                                    </div>

                                </div>
                        </article>';


            echo $data;

            $exist[] = $book["bookid"];

        }

    }

    return $exist;

}


function fetchRelatedStoreStories($rows, $exist){

    global $lang_code;
    if (!is_array($exist)) {
        $exist = array($exist);
    }


    foreach ($rows as $book) {

        if (array_search($book['storyid'], $exist) === false && count($exist < 9)) {


            if ($book['language'] == "En") {

                $righ_class = "";

            } else {

                $righ_class = "-ar";

            }

            $viewLink = SITE_URL . $lang_code . '/store/stories/' . $book['storyid'] . '/' . str_replace(" ", "-", $book['title'])."?s=1";
            $bg=SITE_URL.'platform/stories/'.$book['seriesid'] . '/story/' . $book['storyid'] . '/images/pic.jpg';


            $data = '<article class="item tsc_ribbon_wrap slick-slide slick-current slick-active" style="left: 0px; width: 293px;" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00">
                            <div class="inset">
                            <div class="inner-items">
                             <a href="'.$viewLink.'" tabindex="0"></a>
                               <div class="games-item books-class">
                                <a href="'.$viewLink.'" tabindex="0">
                                  <div class="game-thumb" style="background-image: url('.$bg.')"></div>
                                    <div class="game-title">
                                                <label>'.$book['title'].'</label>
                                            </div>
                                            <div class="title-sub-container clear-both floating-left">
                                                <div class="floating-right display-inline-block ">
                                                       <div class="right floating-right"><div class="display-inline-block"><span class="floating-right">'. $book['price'].'</span><span class="floating-right">$</span></div></div>
                                                    </div>
                                            </div>
                                            <div class="display-block top-container">
                                                <div class="hover-container floating-right">
                                                    <div class="buttons-container floating-left">
                                                        <a class="buy story_addtocart store floating-left" booktype="1" price="'. $book['price'].'" bookid="'. $book['storyid'].'"></a>
                                                    </div>
                                                </div>
                                            </div>
                               </a>
                               <div class="display-block secound-container" style="display: none">
                                            <a href="'.$viewLink.'" tabindex="0"></a>
                                            <div class="title-sub-container clear-both floating-left">
                                                <a href="'.$viewLink.'" tabindex="0"></a>
                                                <div class="floating-left display-inline-block"><a tabindex="0"></a>
                                                    <a class="text-left type" tabindex="0">'.$book['name_' . $lang_code].'</a>
                                                </div>                                        
                                            </div>
                                        </div>
                                    </div>

                                </div>
                        </article>';


            echo $data;

            $exist[] = $book["bookid"];

        }

    }

    return $exist;

}

function fetchRelatedStoreToys($rows, $exist){

    global $lang_code;
    if (!is_array($exist)) {
        $exist = array($exist);
    }


    foreach ($rows as $book) {

        if (array_search($book['productid'], $exist) === false && count($exist < 9)) {


                $righ_class = "";


            $viewLink = SITE_URL . $lang_code . '/store/toys/' . $book['productid'] . '/' . str_replace(" ", "-", $book['title_' . $lang_code])."";
            $bg=SITE_URL."platform/products/".$book["productid"]."/thumbnail_small.jpg";

            $data = '<article class="item tsc_ribbon_wrap slick-slide slick-current slick-active" style="left: 0px; width: 293px;" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00">
                            <div class="inset">
                            <div class="inner-items">
                             <a href="'.$viewLink.'" tabindex="0"></a>
                               <div class="games-item books-class">
                                <a href="'.$viewLink.'" tabindex="0">
                                  <div class="game-thumb" style="background-image: url('.$bg.')"></div>
                                    <div class="game-title">
                                                <label>'.$book['title_' . $lang_code].'</label>
                                            </div>
                                            <div class="title-sub-container clear-both floating-left">
                                                <div class="floating-right display-inline-block ">
                                                       <div class="right floating-right"><div class="display-inline-block"><span class="floating-right">'. $book['Price'].'</span><span class="floating-right">$</span></div></div>
                                                    </div>
                                            </div>
                                            <div class="display-block top-container">
                                                <div class="hover-container floating-right">
                                                    <div class="buttons-container floating-left">
                                                        <a class="buy toy_addtocart store floating-left" booktype="1" price="'. $book['Price'].'" bookid="'. $book['productid'].'"></a>
                                                    </div>
                                                </div>
                                            </div>
                               </a>
                               <div class="display-block secound-container" style="display: none">
                                            <a href="'.$viewLink.'" tabindex="0"></a>
                                            <div class="title-sub-container clear-both floating-left">
                                                <a href="'.$viewLink.'" tabindex="0"></a>
                                                <div class="floating-left display-inline-block"><a tabindex="0"></a>
                                                    <a class="text-left type" tabindex="0">'.$book['brand_' . $lang_code].'</a>
                                                </div>                                        
                                            </div>
                                        </div>
                                    </div>

                                </div>
                        </article>';


            echo $data;

            $exist[] = $book["bookid"];

        }

    }

    return $exist;

}


function queryStory($filter, $notIn)

{

    global $con;

    $sql = "SELECT `story`.*,`stories_cat`.*,`series`.*,`story`.`rating_count` as rate_count FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid`  WHERE `story`.`status`=1 AND `story`.`is_media`=0 " . $filter . "  AND `story`.`storyid` NOT IN(" . $notIn . ") LIMIT 8 ";

    $result = $con->query($sql);

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $rows;

}
function queryStoreStory($filter, $notIn)

{

    global $con;

    $sql = "SELECT `story`.*,`stories_cat`.*,`series`.*,`story`.`rating_count` as rate_count FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid`  WHERE `story`.`status`=1  AND `story`.`is_media`=0  AND `story`.`store`=1 " . $filter . "  AND `story`.`storyid` NOT IN(" . $notIn . ") LIMIT 8";

    $result = $con->query($sql);

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $rows;

}

function queryStoreToy($filter, $notIn)
{

    global $con;
    $sql = "SELECT `products`.*,`brand`.*,`products`.`name_ar` as title_ar,`products`.`name_en` as title_en ,`departments`.*, `brand`.`name_ar` as brand_ar, `brand`.`name_en` as brand_en, `departments`.`name_ar` as department_ar, `departments`.`name_en` as department_en FROM `products` left OUTER JOIN `brand` ON `products`.`brand`=`brand`.`catid` left OUTER JOIN `departments` ON `products`.`department`=`departments`.`catid` WHERE `products`.`status` =1  " . $filter . "  AND `products`.`productid` NOT IN(" . $notIn . ") LIMIT 8 ";

    $result = $con->query($sql);

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $rows;

}


function fetchRelatedWorksheet($rows, $exist){

    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    global $Lang;
    if (!is_array($exist)) {

        $exist = array($exist);

    }


    foreach ($rows as $worksheet) {

        if (array_search($worksheet['id'], $exist) === false && count($exist < 9)) {
            $viewLink = SITE_URL . $lang_code . "/worksheet/" . $worksheet['id'] . "/" . $worksheet['title_' . $cat_code];
            if ($worksheet['language'] == "En") {
                $righ_class = "";
            } else {

                $righ_class = "-ar";

            }

            $data = '<article class="item" style="left: 0px;">

                            <div class="inset">
                                <div class="item-container-work-sheet jq_item_container floating-left tsc_ribbon_wrap">';
            if ($worksheet['price'] == 0) {
                $data .= '<div class="ribbon-wrap right-edge fork lblue free-ribbon worksheet"><span>' . $Lang->Free . '</span></div>';
            }
            $data .= '<div class="inner-item-container">
                                        <a class="worksheet-thump libro" href="' . $viewLink . '" style="background-image: url(' . SITE_URL . '/platform/media/' . $worksheet['id'] . '/thumbnail_small.jpg)"></a>

                                        <div class="display-block secound-container">

                                            <div class="title-sub-container clear-both floating-left">

                                                <div class="floating-left display-inline-block">

                                                    <a href="' . $viewLink . '" class="text-left title" title="' . $worksheet['title_' . $cat_code] . '">' . $worksheet['title_' . $cat_code] . '</a>

                                                    <a href="' . $viewLink . '" class="text-left cat" title="' . $worksheet['name_' . $cat_code] . '">' . $worksheet['name_' . $cat_code] . '</a>

                                                </div>

                                            </div>

                                        </div>
                                        <div class="display-block secound-container">
                                            <div class="title-sub-container clear-both floating-left">
                                                <div class="floating-left display-inline-block">
                                                    <a class="text-left type">' . $Lang->Worksheet . '</a>
                                                </div>
                                                <div class="price floating-left">
                                                    <div class="display-inline-block">
                                                        <span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $worksheet['name_' . $cat_code] . '">' . $worksheet['name_' . $cat_code] . '</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                </div>

                            </div>

                        </article>';

            echo $data;

            $exist[] = $worksheet["id"];

        }

    }

    return $exist;

}


function fetchRelatedGames($rows, $exist)
{


    global $lang_code;
    global $cat_code;

    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    global $Lang;

    if (!is_array($exist)) {

        $exist = array($exist);

    }


    foreach ($rows as $games) {

        if (array_search($games['id'], $exist) === false && count($exist < 9)) {

            $viewLink = SITE_URL . $lang_code . "/games/" . $games['id'] . "/" . $games['title_' . $cat_code];

            if ($games['language'] == "En") {

                $righ_class = "";

            } else {

                $righ_class = "-ar";

            }


            if ($games['path'] == '') {

                $paththumb = SITE_URL . 'platform/media/' . $games['id'] . '/thumbnail_small.jpg';

            } else {

                $idpath = explode("?id=", $games['path']);

                $paththumb = SITE_URL . 'platform/games/' . $idpath[1] . '/images/thumb.jpg';

            }
            $data = ' <article class="item tsc_ribbon_wrap" style="left: 0px;"><div class="inset"><div class="inner-items">';
            if ($games['price'] == 0) {
                $data .= '<div class="ribbon-wrap right-edge fork lblue free-ribbon game"><span>' . $Lang->Free . '</span></div>';
            }
            $data .= '<a href="' . $viewLink . '"><div class="games-item">
                                     <div class="game-thumb" style="background-image: url(' . $paththumb . ')"></div>
                                        <div class="game-title">
                                        <label>' . $games['title_' . $cat_code] . '</label>

                                    </div>
                                    <div class="display-block secound-container">
                                    <div class="title-sub-container clear-both floating-left">
                                    <div class="floating-left display-inline-block">
                                    <a class="text-left type">' . $Lang->Games . '</a>
                                    </div>
                                    <div class="price floating-left">
                                    <div class="display-inline-block">
                                    <span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $games['name_' . $cat_code] . '">' . $games['name_' . $cat_code] . '</span>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                            </a>
                            </div>
                            </div>
                        </article>';


            echo $data;

            $exist[] = $games["id"];

        }

    }

    return $exist;

}

function fetchRelatedinteractive_worksheets($rows, $exist)

{


    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    global $Lang;

    if (!is_array($exist)) {

        $exist = array($exist);

    }


    foreach ($rows as $games) {

        if (array_search($games['id'], $exist) === false && count($exist < 9)) {

            $viewLink = SITE_URL . $lang_code . "/interactive-worksheets/" . $games['id'] . "/" . $games['title_' . $cat_code];

            if ($games['language'] == "En") {

                $righ_class = "";

            } else {

                $righ_class = "-ar";

            }


            $paththumb = SITE_URL . 'platform/media/' . $games['id'] . '/thumbnail_small.jpg';


            $data = ' <article class="item tsc_ribbon_wrap" style="left: 0px;"><div class="inset"><div class="inner-items">';
            if ($games['price'] == 0) {
                $data .= '<div class="ribbon-wrap right-edge fork lblue free-ribbon game"><span>' . $Lang->Free . '</span></div>';
            }
            $data .= '<a href="' . $viewLink . '"><div class="games-item">
                                     <div class="game-thumb" style="background-image: url(' . $paththumb . ')"></div>
                                        <div class="game-title">
                                        <label>' . $games['title_' . $cat_code] . '</label>

                                    </div>
                                    <div class="display-block secound-container">
                                    <div class="title-sub-container clear-both floating-left">
                                    <div class="floating-left display-inline-block">
                                    <a class="text-left type">' . $Lang->Games . '</a>
                                    </div>
                                    <div class="price floating-left">
                                    <div class="display-inline-block">
                                    <span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $games['name_' . $cat_code] . '">' . $games['name_' . $cat_code] . '</span>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                            </a>
                            </div>
                            </div>
                        </article>';


            echo $data;

            $exist[] = $games["id"];

        }

    }

    return $exist;

}


function fetchRelatedVideo($rows, $exist)

{

    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    global $Lang;

    if (!is_array($exist)) {

        $exist = array($exist);

    }


    foreach ($rows as $video) {

        if (array_search($video['id'], $exist) === false && count($exist < 9)) {

            $viewLink = SITE_URL . $lang_code . "/video/" . $video['id'] . "/" . $video['title_' . $cat_code];

            if ($video['language'] == "En") {

                $righ_class = "";

            } else {

                $righ_class = "-ar";

            }

            $data = ' <article class="item tsc_ribbon_wrap" style="left: 0px;"><div class="inset"><div class="inner-items">';
            if ($video['price'] == 0) {
                $data .= '<div class="ribbon-wrap right-edge fork lblue free-ribbon video"><span>' . $Lang->Free . '</span></div>';
            }
            $data .= '<a href="' . $viewLink . '"><div class="media-item">
                                      <div class="media-thumb video" style="background-image: url(' . SITE_URL . '/platform/media/' . $video['id'] . '/thumbnail_small.jpg)">
                                           <a class="play-on-hover" href="' . $viewLink . '"><span class="icon-play "><div></div></span></a>
                                       </div>
                                        <div class="media-title">

                                        <label>' . $video['title_' . $cat_code] . '</label>

                                    </div>
                                    <div class="display-block secound-container">
                                    <div class="title-sub-container clear-both floating-left">
                                    <div class="floating-left display-inline-block">
                                    <a class="text-left type">' . $Lang->video . '</a>
                                    </div>
                                    <div class="price floating-left">
                                    <div class="display-inline-block">
                                    <span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $video['name_' . $cat_code] . '">' . $video['name_' . $cat_code] . '</span>
                                    </div>
                                    </div>
                                    </div>
                                    </div>

                                </div>

                            </a>
                            </div>
                            </div>

                        </article>';


            echo $data;

            $exist[] = $video["id"];

        }

    }

    return $exist;

}


function fetchRelatedAudio($rows, $exist)

{

    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    global $Lang;

    if (!is_array($exist)) {

        $exist = array($exist);

    }


    foreach ($rows as $audio) {

        if (array_search($audio['id'], $exist) === false && count($exist < 9)) {

            $viewLink = SITE_URL . $lang_code . "/audio/" . $audio['id'] . "/" . $audio['title_' . $cat_code];

            if ($audio['language'] == "En") {

                $righ_class = "";

            } else {

                $righ_class = "-ar";

            }
            $data = ' <article class="item tsc_ribbon_wrap" style="left: 0px;"><div class="inset"><div class="inner-items">';
            if ($audio['price'] == 0) {
                $data .= '<div class="ribbon-wrap right-edge fork lblue free-ribbon sound"><span>' . $Lang->Free . '</span></div>';
            }
            $data .= '<a href="' . $viewLink . '"><div class="media-item">
                                      <div class="media-thumb audio" style="background-image: url(' . SITE_URL . '/platform/media/' . $audio['id'] . '/thumbnail_small.jpg)">
                                           <a class="play-on-hover" href="' . $viewLink . '"><span class="icon-play sound"><div></div></span></a>
                                       </div>
                                        <div class="media-title">
                                        <label>' . $audio['title_' . $cat_code] . '</label>

                                    </div>
                                    <div class="display-block secound-container">
                                    <div class="title-sub-container clear-both floating-left">
                                    <div class="floating-left display-inline-block">
                                    <a class="text-left type">' . $Lang->audio . '</a>
                                    </div>
                                    <div class="price floating-left">
                                    <div class="display-inline-block">
                                    <span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $audio['name_' . $cat_code] . '">' . $audio['name_' . $cat_code] . '</span>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                            </a>
                            </div>
                            </div>

                        </article>';


            echo $data;

            $exist[] = $audio["id"];

        }

    }

    return $exist;

}


function fetchRelatedStories($rows, $exist)

{

    global $lang_code;

    if (!is_array($exist)) {

        $exist = array($exist);

    }


    foreach ($rows as $story) {

        if (array_search($story['storyid'], $exist) === false && count($exist < 9)) {

            $viewLink = SITE_URL . $lang_code . "/stories/" . $story['storyid'] . "/" . $story['title']."?s=1";

            if ($story['language'] == "En") {
                $righ_class = "";
            } else {
                $righ_class = "-ar";
            }

            $data = '<article class="item">

                            <div class="inset">

                                <div class="item-container-book' . $righ_class . ' floating-left reveal-zoom reveal_visible">

                                    <div class="book-container">

                                        <a href="' . $viewLink . '" class="libro floating-left" title="' . $story['title'] . '">

                                            <div class="backcover" style="background-color:#' . $story['color'] . '"></div>

                                            <span></span>

                                            <img src="' . SITE_URL . 'platform/stories/' . $story['seriesid'] . "/story/" . $story['storyid'] . '/images/pic.jpg" alt="' . $story['name'] . '">

                                        </a>

                                    </div>

                                    <div class="title-sub-container clear-both">

                                        <div class="floating-left display-inline-block">

                                            <a href="' . $viewLink . '" class="text-left title" title="' . $story['title'] . '">' . $story['title'] . '</a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </article>';

            echo $data;

            $exist[] = $story["storyid"];

        }

    }

    return $exist;

}


function getNotIn($array)

{

    if (is_array($array)) {

        $notIn = implode(",", $array);

    } else {

        $notIn = $array;

    }

    return $notIn;

}
function getEXT($type){
    $ext="";
    switch($type){
        case 0:
           $ext="pdf";
            break;
        case 12:
        case 11:
            $ext="html";
            break;
        case 3:
            $ext="mp3";
            break;
        case 4:
            $ext="mp4";
            break;
    }
    return $ext;
}
function getPlaylistMedia($row){
    global $con;
    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    global $Lang;
    $playlist_link =SITE_URL.$lang_code.'/playlist/'.$row['id'].'/'.str_replace(" ","-",$row['title_'.$cat_code]);


    $sql="SELECT `playlist_media`.*,`media`.*,`categories`.`name_ar`,`categories`.`name_en` from `playlist_media` INNER JOIN `media` ON `playlist_media`.`mediaid`=`media`.`id` JOIN `categories` ON `media`.`category`=`categories`.`catid` WHERE `playlist_media`.`playlistid`=".$row["id"];
    $result=$con->query($sql);
    while($media=mysqli_fetch_assoc($result)){
        if($media["path"] == "") {
            $hrf =SITE_URL.'platform/media/' . $media['id'] . '/' . $media['filename'] . ".html";
        } else {
            $hrf =SITE_URL.$media["path"];
        }

        if ($media['language'] == "En") {
            $righ_class = "";
            $direction = "ltr";
        } else {
            $direction = "rtl";
            $righ_class = "-ar";
        }
        $subscribe="";
        if($media['price']!=0 && !Areyousubscribe()){
            $subscribe=" jq_subscribe";
        }
        switch($media["type"]){
            case 0:
                $data = '<article class="item" style="left: 0px;"><div class="inset"><div class="item-container-work-sheet jq_item_container floating-left tsc_ribbon_wrap">';
                $data .= '<div class="inner-item-container">
                                        <a class="worksheet-thump libro jq_viewplaylist '.$subscribe.'"  data-href="' . $playlist_link.'?selected='.$media["id"].'" style="background-image: url(' . SITE_URL . '/platform/media/' . $media['id'] . '/thumbnail_small.jpg)"></a>
                                        <div class="display-block secound-container">
                                            <div class="title-sub-container clear-both floating-left">
                                                <div class="floating-left display-inline-block">
                                                    <a data-href="' . $playlist_link.'?selected='.$media["id"].'" class="text-left title jq_viewplaylist '.$subscribe.'" title="' . $media['title_' . $cat_code] . '">' . $media['title_' . $cat_code] . '</a>
                                                    <a data-href="' . $playlist_link.'?selected='.$media["id"].'" class="text-left cat jq_viewplaylist '.$subscribe.'" title="' . $media['name_' . $cat_code] . '">' . $media['name_' . $cat_code] . '</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="display-block secound-container">
                                            <div class="title-sub-container clear-both floating-left">
                                                <div class="floating-left display-inline-block">
                                                    <a class="text-left type">' . $Lang->Worksheet . '</a>
                                                </div>
                                                <div class="price floating-left">
                                                    <div class="display-inline-block">
                                                        <span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $media['name_' . $cat_code] . '">' . $media['name_' . $cat_code] . '</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                </div>

                            </div>

                        </article>';
                break;
            case 12:
            case 11:
            $data = ' <article class="item tsc_ribbon_wrap" style="left: 0px;"><div class="inset"><div class="inner-items">';
            if ($media['price'] == 0) {
                $data .= '<div class="ribbon-wrap right-edge fork lblue free-ribbon game"><span>' . $Lang->Free . '</span></div>';
            }
            $data .= '<a  class="jq_viewplaylist '.$subscribe.'"  data-href="' . $playlist_link.'?selected='.$media["id"].'"><div class="games-item">
                                     <div class="game-thumb" style="background-image: url('.getThumb($media).')"></div>
                                        <div class="game-title">
                                        <label>' . $media['title_' . $cat_code] . '</label>

                                    </div>
                                    <div class="display-block secound-container">
                                    <div class="title-sub-container clear-both floating-left">
                                    <div class="floating-left display-inline-block">
                                    <a class="text-left type">' . $Lang->Games . '</a>
                                    </div>
                                    <div class="price floating-left">
                                    <div class="display-inline-block">
                                    <span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $media['name_' . $cat_code] . '">' . $media['name_' . $cat_code] . '</span>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                            </a>
                            </div>
                            </div>
                        </article>';
                break;
            case 3:
                $data = ' <article class="item tsc_ribbon_wrap" style="left: 0px;"><div class="inset"><div class="inner-items">';
                if ($media['price'] == 0) {
                    $data .= '<div class="ribbon-wrap right-edge fork lblue free-ribbon sound"><span>' . $Lang->Free . '</span></div>';
                }
                $data .= '<a  class="jq_viewplaylist '.$subscribe.'"  data-href="' . $playlist_link.'?selected='.$media["id"].'"><div class="media-item">
                                      <div class="media-thumb audio" style="background-image: url(' . SITE_URL . '/platform/media/' . $media['id'] . '/thumbnail_small.jpg)">
                                           <a class="play-on-hover jq_viewplaylist '.$subscribe.'" data-href="' . $playlist_link.'?selected='.$media["id"].'"><span class="icon-play sound"><div></div></span></a>
                                       </div>
                                        <div class="media-title">
                                        <label>' . $media['title_' . $cat_code] . '</label>

                                    </div>
                                    <div class="display-block secound-container">
                                    <div class="title-sub-container clear-both floating-left">
                                    <div class="floating-left display-inline-block">
                                    <a class="text-left type">' . $Lang->audio . '</a>
                                    </div>
                                    <div class="price floating-left">
                                    <div class="display-inline-block">
                                    <span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $media['name_' . $cat_code] . '">' . $media['name_' . $cat_code] . '</span>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                            </a>
                            </div>
                            </div>

                        </article>';
                break;
            case 4:
                $data = ' <article class="item tsc_ribbon_wrap" style="left: 0px;"><div class="inset"><div class="inner-items">';
                if ($media['price'] == 0) {
                    $data .= '<div class="ribbon-wrap right-edge fork lblue free-ribbon video"><span>' . $Lang->Free . '</span></div>';
                }
                $data .= '<a class="jq_viewplaylist '.$subscribe.'"  data-href="' . $playlist_link.'?selected='.$media["id"].'"><div class="media-item">
                                      <div class="media-thumb video" style="background-image: url(' . SITE_URL . '/platform/media/' . $media['id'] . '/thumbnail_small.jpg)">
                                           <a class="play-on-hover jq_viewplaylist '.$subscribe.'"  data-href="' . $playlist_link.'?selected='.$media["id"].'"><span class="icon-play "><div></div></span></a>
                                       </div>
                                        <div class="media-title">

                                        <label>' . $media['title_' . $cat_code] . '</label>

                                    </div>
                                    <div class="display-block secound-container">
                                    <div class="title-sub-container clear-both floating-left">
                                    <div class="floating-left display-inline-block">
                                    <a class="text-left type">' . $Lang->video . '</a>
                                    </div>
                                    <div class="price floating-left">
                                    <div class="display-inline-block">
                                    <span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $media['name_' . $cat_code] . '">' . $media['name_' . $cat_code] . '</span>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                            </a>
                            </div>
                            </div>
                        </article>';
                break;
        }
        echo $data;
    }
}

function getRelatedProduct($data, $type){

    $totalRowsCount = 0;
    global $con;
    switch ($type) {
        case "book":
            $title = substr($data["name"], 0, strpos($data["name"], " ", strpos($data["name"], " ") + 1));
            $filter = " AND `category`=" . $data["category"] . " AND `name` LIKE '%" . mysqli_real_escape_string($con, $title) . "%'";
            $result = queryBook($filter, $data["bookid"], false);
            $totalRowsCount = count($result);
            $exist = fetchRelatedBooks($result, $data["bookid"]);
            // file_put_contents("related.txt",$filter);

            if ($totalRowsCount < 8) {
                $filter = " AND `category`=" . $data["category"] . " AND `semester`='" . $data["semester"] . "' AND `age`=" . $data["age"] . " AND `grade`=" . $data["grade"];

                $result = queryBook($filter, $data["bookid"]);

                $totalRowsCount = count($result);

                $exist = fetchRelatedBooks($result, $data["bookid"]);
                if ($totalRowsCount < 8) {

                    $filter = " AND `category`=" . $data["category"] . " AND `semester`='" . $data["semester"] . "' AND `grade`=" . $data["grade"];

                    $result = queryBook($filter, getNotIn($exist));

                    $totalRowsCount += count($result);

                    $exist = fetchRelatedBooks($result, $exist);

                    if ($totalRowsCount < 8) {

                        $filter = " AND `category`=" . $data["category"] . "  AND `semester`='" . $data["semester"] . "' AND `age`=" . $data["age"];

                        $result = queryBook($filter, getNotIn($exist));

                        $totalRowsCount += count($result);

                        $exist = fetchRelatedBooks($result, $exist);

                        if ($totalRowsCount < 8) {

                            $filter = " AND `category`=" . $data["category"] . "  AND `age`=" . $data["age"] . " AND `grade`=" . $data["grade"];

                            $result = queryBook($filter, getNotIn($exist));

                            $totalRowsCount += count($result);

                            $exist = fetchRelatedBooks($result, $exist);

                            if ($totalRowsCount < 8) {

                                $filter = " AND `category`=" . $data["category"] . " AND `grade`=" . $data["grade"];

                                $result = queryBook($filter, getNotIn($exist));

                                $totalRowsCount += count($result);

                                $exist = fetchRelatedBooks($result, $exist);

                                if ($totalRowsCount < 8) {

                                    $filter = " AND `category`=" . $data["category"] . "  AND `age`=" . $data["age"];

                                    $result = queryBook($filter, getNotIn($exist));

                                    $totalRowsCount += count($result);

                                    $exist = fetchRelatedBooks($result, $exist);

                                    if ($totalRowsCount < 8) {

                                        $filter = " AND `category`=" . $data["category"] . "  AND `semester`=" . $data["semester"];

                                        $result = queryBook($filter, getNotIn($exist));

                                        $totalRowsCount += count($result);

                                        $exist = fetchRelatedBooks($result, $exist);

                                        if ($totalRowsCount < 8) {

                                            $filter = " AND `category`=" . $data["category"];

                                            $result = queryBook($filter, getNotIn($exist));

                                            $totalRowsCount += count($result);

                                            $exist = fetchRelatedBooks($result, $exist);

                                        }

                                    }

                                }

                            }

                        }

                    }

                }
            }
            break;

    case "storebook":
            $title = substr($data["name"], 0, strpos($data["name"], " ", strpos($data["name"], " ") + 1));
            $filter = " AND `category`=" . $data["category"] . " AND `name` LIKE '%" . mysqli_real_escape_string($con, $title) . "%'";
            $result = queryStoreBook($filter, $data["bookid"], false);
            $totalRowsCount = count($result);
            $exist = fetchRelatedStoreBooks($result, $data["bookid"]);
            // file_put_contents("related.txt",$filter);

            if ($totalRowsCount < 8) {
                $filter = " AND `category`=" . $data["category"] . " AND `semester`='" . $data["semester"] . "' AND `age`=" . $data["age"] . " AND `grade`=" . $data["grade"];

                $result = queryStoreBook($filter, $data["bookid"]);

                $totalRowsCount = count($result);

                $exist = fetchRelatedStoreBooks($result, $data["bookid"]);
                if ($totalRowsCount < 8) {

                    $filter = " AND `category`=" . $data["category"] . " AND `semester`='" . $data["semester"] . "' AND `grade`=" . $data["grade"];

                    $result = queryStoreBook($filter, getNotIn($exist));

                    $totalRowsCount += count($result);

                    $exist = fetchRelatedStoreBooks($result, $exist);

                    if ($totalRowsCount < 8) {

                        $filter = " AND `category`=" . $data["category"] . "  AND `semester`='" . $data["semester"] . "' AND `age`=" . $data["age"];

                        $result = queryStoreBook($filter, getNotIn($exist));

                        $totalRowsCount += count($result);

                        $exist = fetchRelatedStoreBooks($result, $exist);

                        if ($totalRowsCount < 8) {

                            $filter = " AND `category`=" . $data["category"] . "  AND `age`=" . $data["age"] . " AND `grade`=" . $data["grade"];

                            $result = queryStoreBook($filter, getNotIn($exist));

                            $totalRowsCount += count($result);

                            $exist = fetchRelatedStoreBooks($result, $exist);

                            if ($totalRowsCount < 8) {

                                $filter = " AND `category`=" . $data["category"] . " AND `grade`=" . $data["grade"];

                                $result = queryStoreBook($filter, getNotIn($exist));

                                $totalRowsCount += count($result);

                                $exist = fetchRelatedStoreBooks($result, $exist);

                                if ($totalRowsCount < 8) {

                                    $filter = " AND `category`=" . $data["category"] . "  AND `age`=" . $data["age"];

                                    $result = queryStoreBook($filter, getNotIn($exist));

                                    $totalRowsCount += count($result);

                                    $exist = fetchRelatedStoreBooks($result, $exist);

                                    if ($totalRowsCount < 8) {

                                        $filter = " AND `category`=" . $data["category"] . "  AND `semester`=" . $data["semester"];

                                        $result = queryStoreBook($filter, getNotIn($exist));

                                        $totalRowsCount += count($result);

                                        $exist = fetchRelatedStoreBooks($result, $exist);

                                        if ($totalRowsCount < 8) {

                                            $filter = " AND `category`=" . $data["category"];

                                            $result = queryStoreBook($filter, getNotIn($exist));

                                            $totalRowsCount += count($result);

                                            $exist = fetchRelatedStoreBooks($result, $exist);

                                        }

                                    }

                                }

                            }

                        }

                    }

                }
            }
            break;

        case "story":

            $totalRowsCount = 0;

            $filter = " AND `series`.`category`=" . $data["category"] . " AND `series`.`seriesid`=" . $data["seriesid"] . " AND `story`.`age`=" . $data["age"];

            $result = queryStory($filter, $data["storyid"]);

            $totalRowsCount += count($result);

            $exist = fetchRelatedStories($result, $data["storyid"]);

            if ($totalRowsCount < 8) {

                $filter = " AND `series`.`category`=" . $data["category"] . " AND `series`.`seriesid`=" . $data["seriesid"];

                $result = queryStory($filter, getNotIn($exist));

                $totalRowsCount += count($result);

                $exist = fetchRelatedStories($result, $exist);

                if ($totalRowsCount < 8) {

                    $filter = " AND `series`.`category`=" . $data["category"] . " AND `series`.`seriesid`=" . $data["seriesid"];

                    $result = queryStory($filter, getNotIn($exist));

                    $totalRowsCount += count($result);

                    $exist = fetchRelatedStories($result, $exist);

                    if ($totalRowsCount < 8) {

                        $filter = " AND `series`.`category`=" . $data["category"] . "  AND `story`.`age`=" . $data["age"];

                        $result = queryStory($filter, getNotIn($exist));

                        $totalRowsCount += count($result);

                        $exist = fetchRelatedStories($result, $exist);

                        if ($totalRowsCount < 8) {

                            $filter = " AND`series`.`category`=" . $data["category"];

                            $result = queryStory($filter, getNotIn($exist));

                            $totalRowsCount += count($result);

                            $exist = fetchRelatedStories($result, $exist);

                        }

                    }

                }

            }

            break;
        case "storestory":

            $totalRowsCount = 0;

            $filter = " AND `series`.`category`=" . $data["category"] . " AND `series`.`seriesid`=" . $data["seriesid"] . " AND `story`.`age`=" . $data["age"];

            $result = queryStoreStory($filter, $data["storyid"]);

            $totalRowsCount += count($result);

            $exist = fetchRelatedStoreStories($result, $data["storyid"]);

            if ($totalRowsCount < 8) {

                $filter = " AND `series`.`category`=" . $data["category"] . " AND `series`.`seriesid`=" . $data["seriesid"];

                $result = queryStoreStory($filter, getNotIn($exist));

                $totalRowsCount += count($result);

                $exist = fetchRelatedStoreStories($result, $exist);

                if ($totalRowsCount < 8) {

                    $filter = " AND `series`.`category`=" . $data["category"] . " AND `series`.`seriesid`=" . $data["seriesid"];

                    $result = queryStoreStory($filter, getNotIn($exist));

                    $totalRowsCount += count($result);

                    $exist = fetchRelatedStoreStories($result, $exist);

                    if ($totalRowsCount < 8) {

                        $filter = " AND `series`.`category`=" . $data["category"] . "  AND `story`.`age`=" . $data["age"];

                        $result = queryStoreStory($filter, getNotIn($exist));

                        $totalRowsCount += count($result);

                        $exist = fetchRelatedStoreStories($result, $exist);

                        if ($totalRowsCount < 8) {

                            $filter = " AND`series`.`category`=" . $data["category"];

                            $result = queryStoreStory($filter, getNotIn($exist));

                            $totalRowsCount += count($result);

                            $exist = fetchRelatedStoreStories($result, $exist);

                        }

                    }

                }

            }

            break;
        case "storetoy":

            $totalRowsCount = 0;

            $filter = " AND `products`.`brand`=" . $data["brand"] . " AND `products`.`department`=" . $data["department"] . " AND `products`.`age`=" . $data["age"];

            $result = queryStoreToy($filter, $data["productid"]);

            $totalRowsCount += count($result);

            $exist = fetchRelatedStoreToys($result, $data["storyid"]);

            if ($totalRowsCount < 8) {

                $filter = " AND `products`.`department`=" . $data["department"] . " AND `products`.`age`=" . $data["age"];

                $result = queryStoreToy($filter, getNotIn($exist));

                $totalRowsCount += count($result);

                $exist = fetchRelatedStoreToys($result, $exist);

                if ($totalRowsCount < 8) {

                    $filter = " AND `products`.`brand`=" . $data["brand"] . "  AND `products`.`age`=" . $data["age"];

                    $result = queryStoreToy($filter, getNotIn($exist));

                    $totalRowsCount += count($result);

                    $exist = fetchRelatedStoreToys($result, $exist);

                    if ($totalRowsCount < 8) {

                        $filter = " AND `products`.`age`=" . $data["age"];

                        $result = queryStoreToy($filter, getNotIn($exist));

                        $totalRowsCount += count($result);

                        $exist = fetchRelatedStoreToys($result, $exist);

                    }

                }

            }

            break;

        case "worksheet":

            $totalRowsCount = 0;

            $filter = " AND  media.type='0' AND media.category=" . $data["category"] . " AND media.grade=" . $data["grade"] . " AND media.age=" . $data["age"];

            $result = queryWorksheet($filter, $data["id"]);

            $totalRowsCount = count($result);

            $exist = fetchRelatedWorksheet($result, $data["id"]);

            if ($totalRowsCount < 8) {

                $filter = " AND  media.type='0' AND media.category=" . $data["category"] . " AND media.grade=" . $data["grade"];

                $result = queryWorksheet($filter, getNotIn($exist));

                $totalRowsCount = count($result);

                $exist = fetchRelatedWorksheet($result, $exist);

                if ($totalRowsCount < 8) {

                    $filter = " AND  media.type='0' AND media.category=" . $data["category"];

                    $result = queryWorksheet($filter, getNotIn($exist));

                    $totalRowsCount = count($result);

                    $exist = fetchRelatedWorksheet($result, $exist);

                }

            }

            break;

        case "games":

            $totalRowsCount = 0;

            $filter = " AND  media.type='11' AND media.category=" . $data["category"] . " AND media.grade=" . $data["grade"] . " AND media.age=" . $data["age"];

            $result = queryWorksheet($filter, $data["id"]);

            $totalRowsCount = count($result);

            $exist = fetchRelatedGames($result, $data["id"]);

            if ($totalRowsCount < 8) {

                $filter = " AND  media.type='11' AND media.category=" . $data["category"] . " AND media.grade=" . $data["grade"];

                $result = queryWorksheet($filter, getNotIn($exist));

                $totalRowsCount = count($result);

                $exist = fetchRelatedGames($result, $exist);

                if ($totalRowsCount < 8) {

                    $filter = " AND  media.type='11' AND media.category=" . $data["category"];

                    $result = queryWorksheet($filter, getNotIn($exist));

                    $totalRowsCount = count($result);

                    $exist = fetchRelatedGames($result, $exist);

                }

            }

            break;
        case "interactive-worksheets":

            $totalRowsCount = 0;

            $filter = " AND  media.type='12' AND media.category=" . $data["category"] . " AND media.grade=" . $data["grade"] . " AND media.age=" . $data["age"];

            $result = queryWorksheet($filter, $data["id"]);

            $totalRowsCount = count($result);

            $exist = fetchRelatedinteractive_worksheets($result, $data["id"]);

            if ($totalRowsCount < 8) {

                $filter = " AND  media.type='12' AND media.category=" . $data["category"] . " AND media.grade=" . $data["grade"];

                $result = queryWorksheet($filter, getNotIn($exist));

                $totalRowsCount = count($result);

                $exist = fetchRelatedinteractive_worksheets($result, $exist);

                if ($totalRowsCount < 8) {

                    $filter = " AND  media.type='12' AND media.category=" . $data["category"];

                    $result = queryWorksheet($filter, getNotIn($exist));

                    $totalRowsCount = count($result);

                    $exist = fetchRelatedinteractive_worksheets($result, $exist);

                }

            }

            break;

        case "video":

            $totalRowsCount = 0;

            $filter = " AND  media.type='4' AND media.category=" . $data["category"] . " AND media.grade=" . $data["grade"] . " AND media.age=" . $data["age"];

            $result = queryWorksheet($filter, $data["id"]);

            $totalRowsCount = count($result);

            $exist = fetchRelatedVideo($result, $data["id"]);

            if ($totalRowsCount < 8) {

                $filter = " AND  media.type='4' AND media.category=" . $data["category"] . " AND media.grade=" . $data["grade"];

                $result = queryWorksheet($filter, getNotIn($exist));

                $totalRowsCount = count($result);

                $exist = fetchRelatedVideo($result, $exist);

                if ($totalRowsCount < 8) {

                    $filter = " AND  media.type='4' AND media.category=" . $data["category"];

                    $result = queryWorksheet($filter, getNotIn($exist));

                    $totalRowsCount = count($result);

                    $exist = fetchRelatedVideo($result, $exist);

                }

            }

            break;

        case "audio":

            $totalRowsCount = 0;

            $filter = " AND  media.type='3' AND media.category=" . $data["category"] . " AND media.grade=" . $data["grade"] . " AND media.age=" . $data["age"];

            $result = queryWorksheet($filter, $data["id"]);

            $totalRowsCount = count($result);

            $exist = fetchRelatedAudio($result, $data["id"]);

            if ($totalRowsCount < 8) {

                $filter = " AND  media.type='3' AND media.category=" . $data["category"] . " AND media.grade=" . $data["grade"];

                $result = queryWorksheet($filter, getNotIn($exist));

                $totalRowsCount = count($result);

                $exist = fetchRelatedAudio($result, $exist);

                if ($totalRowsCount < 8) {
                    $filter = " AND  media.type='3' AND media.category=" . $data["category"];
                    $result = queryWorksheet($filter, getNotIn($exist));
                    $totalRowsCount = count($result);
                    $exist = fetchRelatedAudio($result, $exist);
                }
            }
            break;
    }
}


function calcItemPrice($row, $type)
{

//    return $row["price"];
    $price = $row["price"];

//     if($type=="book"){
        switch ($type) {
            case 1:
            case 2:
            case 3:
                $price = $row["price"];
                break;
//            case 2:
//                $price = $row["eprice"];
//                break;
//            case 3:
//                $price = $row["price"] + $row["eprice"];
//                break;
            case 4:
                $price = $row["iprice"];
                break;
            case 5:
            case 6:
            case 7:
                $price = $row["iprice"] + $row["price"];
                break;
//            case 6:
//
//                $price = $row["iprice"] + $row["eprice"];
//
//                break;
//
//            case 7:
//
//                $price = $row["price"] + $row["eprice"] + $row["iprice"];
//
//                break;

        }
//    }


    return $price;

}


function isPaperCopy($type)

{

    if ($type == 1 || $type == 3 || $type == 5 || $type == 7) {

        return true;

    } else {

        return false;

    }

}


function isElectronicCopy($type)

{

    if ($type == 2 || $type == 3 || $type == 6 || $type == 7) {

        return true;

    } else {

        return false;

    }

}


function isInteractiveCopy($type)

{

    if ($type == 4 || $type == 5 || $type == 6 || $type == 7) {

        return true;

    } else {

        return false;

    }

}


function isCanRead($type, $id)

{

    global $con;

    switch ($type) {

        case "book":

            $sql = "SELECT `bookid`,`price`,`eprice`,`iprice`,`booktype` from `books` WHERE `bookid`=" . $id;

            $result = $con->query($sql);

            $row = mysqli_fetch_assoc($result);

            if (calcItemPrice($row, $row["booktype"]) > 0) {

                if (isset($_SESSION["user"]["userid"])) {

                    $sql = "SELECT `payments`.`userid`,`payments_books`.`paymentid`,`payments_books`.`bookid` FROM `payments` JOIN  `payments_books` on `payments`.`paymentid`=`payments_books`.`paymentid` where `payments`.`userid`=" . $_SESSION["user"]["userid"] . " AND `payments_books`.`itemtype`='book' AND `payments_books`.`bookid`=" . $id;

                    $result = $con->query($sql);

                    if (mysqli_num_rows($result) > 0) {

                        return true;

                    } else {

                        return false;

                    }

                } else {

                    return false;

                }

            } else {

                return true;

            }

            break;

        case "story":

            $sql = "SELECT `storyid`,`price`,`eprice`,`iprice`,`booktype` from `story` WHERE `storyid`=" . $id;

            $result = $con->query($sql);

            $row = mysqli_fetch_assoc($result);

            if (calcItemPrice($row, $row["type"]) > 0) {

                if (isset($_SESSION["user"]["userid"])) {

                    $sql = "SELECT `payments`.`userid`,`payments_books`.`paymentid`,`payments_books`.`bookid` FROM `payments` JOIN  `payments_books` on `payments`.`paymentid`=`payments_books`.`paymentid` where `payments`.`userid`=" . $_SESSION["user"]["userid"] . " AND `payments_books`.`itemtype`='story' AND `payments_books`.`bookid`=" . $id;

                    $result = $con->query($sql);

                    if (mysqli_num_rows($result) > 0) {

                        return true;

                    } else {

                        return false;

                    }

                } else {

                    return false;

                }

            } else {

                return true;

            }

            break;

    }

}


function inCart($type, $id)

{

    $items = [];

    if (isset($_COOKIE['items']) && $_COOKIE['items'] != "") {

        $items = json_decode($_COOKIE['items'], true);

    }

    if (!isset($items[$type]) || !is_array($items[$type])) {

        $items[$type] = [];

    }

    $position = array_search($id, array_keys($items[$type]));

    if ($position === false) {

        return false;

    } else {

        return true;

    }

}


function getTypeText($type, $id = '', $itemtype = '')

{

    global $Lang;

    $text = "";

    switch ($type) {

        case 1:

            $text = "<div class='display-block' id='summary_" . $itemtype . "_paper_" . $id . "'><div class='image-a floating-left'></div><div class='text floating-left'>" . $Lang->PaperCopy . '</div></div>';

            break;

        case 2:

            $text = "<div class='display-block' id='summary_" . $itemtype . "_electronic_" . $id . "'><div class='image-b floating-left'></div><div class='text floating-left'>" . $Lang->ElectronicCopy . '</div></div>';

            break;

        case 3:

            $text = "<div class='display-block' id='summary_" . $itemtype . "_paper_" . $id . "'><div class='image-a floating-left'></div><div class='text floating-left'>" . $Lang->PaperCopy . '</div></div>' . "<div class='display-block' id='summary_" . $itemtype . "_electronic_" . $id . "'><div class='image-b floating-left'></div><div class='text floating-left'>" . $Lang->ElectronicCopy . '</div></div>';

            break;

        case 4:

            $text = "<div class='display-block' id='summary_" . $itemtype . "_interactive_" . $id . "'><div class='image-c floating-left'></div><div class='text floating-left'>" . $Lang->EnrichmentCopy . '</div></div>';

            break;

        case 5:

            $text = "<div class='display-block' id='summary_" . $itemtype . "_paper_" . $id . "'><div class='image-a floating-left'></div><div class='text floating-left'>" . $Lang->PaperCopy . '</div></div>' . "<div class='display-block' id='summary_" . $itemtype . "_interactive_" . $id . "'><div class='image-c floating-left'></div><div class='text floating-left'>" . $Lang->EnrichmentCopy . '</div></div>';

            //$text=$Lang->PaperCopy." , ".$Lang->EnrichmentCopy;

            break;

        case 6:

            $text = "<div class='display-block' id='summary_" . $itemtype . "_electronic_" . $id . "'><div class='image-b floating-left'></div><div class='text floating-left'>" . $Lang->ElectronicCopy . '</div></div>' . "<div class='display-block' id='summary_" . $itemtype . "_interactive_" . $id . "'><div class='image-c floating-left'></div><div class='text floating-left'>" . $Lang->EnrichmentCopy . '</div></div>';

            //$text=$Lang->ElectronicCopy." , ".$Lang->EnrichmentCopy;

            break;

        case 7:

            $text = "<div class='display-block' id='summary_" . $itemtype . "_paper_" . $id . "'><div class='image-a floating-left'></div><div class='text floating-left'>" . $Lang->PaperCopy . '</div></div>' . "<div class='display-block' id='summary_" . $itemtype . "_electronic_" . $id . "'><div class='image-b floating-left'></div><div class='text floating-left'>" . $Lang->ElectronicCopy . '</div></div>' . "<div class='display-block' id='summary_" . $itemtype . "_interactive_" . $id . "'><div class='image-c floating-left'></div><div class='text floating-left'>" . $Lang->EnrichmentCopy . '</div></div>';

            //$text=$Lang->PaperCopy." , ".$Lang->ElectronicCopy." , ".$Lang->EnrichmentCopy;

            break;

    }

    return $text;

}


function getShippingPrice($total_weight)
{
    $price = 0.00;
    $dhl_price_array = unserialize(DHL_PRICES);


    switch ($total_weight) {
        case $total_weight <= 0.5:
            $price = $dhl_price_array["0.5"];
            break;
        case $total_weight <= 1.0:
            $price = $dhl_price_array["1.0"];
            break;
        case $total_weight <= 1.5:
            $price = $dhl_price_array["1.5"];
            break;

        case $total_weight <= 2.0:

            $price = $dhl_price_array["2.0"];

            break;

        case $total_weight <= 2.5:

            $price = $dhl_price_array["2.5"];

            break;

        case $total_weight <= 3.0:

            $price = $dhl_price_array["3.0"];

            break;

        case $total_weight <= 3.5:

            $price = $dhl_price_array["3.5"];

            break;

        case $total_weight <= 4.0:

            $price = $dhl_price_array["4.0"];

            break;

        case $total_weight <= 4.5:

            $price = $dhl_price_array["4.5"];

            break;

        case $total_weight <= 5.0:

            $price = $dhl_price_array["5.0"];

            break;

        case $total_weight <= 5.5:

            $price = $dhl_price_array["5.5"];

            break;

        case $total_weight <= 6.0:

            $price = $dhl_price_array["6.0"];

            break;

        case $total_weight <= 6.5:

            $price = $dhl_price_array["6.5"];

            break;

        case $total_weight <= 7.0:

            $price = $dhl_price_array["7.0"];

            break;

        case $total_weight <= 7.5:

            $price = $dhl_price_array["7.5"];

            break;

        case $total_weight <= 8.0:

            $price = $dhl_price_array["8.0"];

            break;

        case $total_weight <= 8.5:

            $price = $dhl_price_array["8.5"];

            break;

        case $total_weight <= 9.0:

            $price = $dhl_price_array["9.0"];

            break;

        case $total_weight <= 9.5:

            $price = $dhl_price_array["9.5"];

            break;

        case $total_weight <= 10:

            $price = $dhl_price_array["10"];

            break;

        case $total_weight <= 11:

            $price = $dhl_price_array["11"];

            break;

        case $total_weight <= 12:

            $price = $dhl_price_array["12"];

            break;

        case $total_weight <= 13:

            $price = $dhl_price_array["13"];

            break;

        case $total_weight <= 14:

            $price = $dhl_price_array["14"];

            break;

        case $total_weight <= 15:

            $price = $dhl_price_array["15"];

            break;

        case $total_weight <= 16:

            $price = $dhl_price_array["16"];

            break;

        case $total_weight <= 17:

            $price = $dhl_price_array["17"];

            break;

        case $total_weight <= 18:

            $price = $dhl_price_array["18"];

            break;

        case $total_weight <= 19:

            $price = $dhl_price_array["19"];

            break;

        case $total_weight <= 20:

            $price = $dhl_price_array["20"];

            break;
        case $total_weight <= 21:

            $price = $dhl_price_array["21"];

            break;
        case $total_weight <= 22:

            $price = $dhl_price_array["22"];

            break;
        case $total_weight <= 23:

            $price = $dhl_price_array["23"];

            break;
        case $total_weight <= 24:

            $price = $dhl_price_array["24"];

            break;
        case $total_weight <= 25:

            $price = $dhl_price_array["25"];

            break;
        case $total_weight <= 26:

            $price = $dhl_price_array["26"];

            break;
        case $total_weight <= 27:

            $price = $dhl_price_array["27"];

            break;
        case $total_weight <= 28:

            $price = $dhl_price_array["28"];

            break;
  case $total_weight <= 29:

            $price = $dhl_price_array["29"];

            break;

        case $total_weight <= 30:

            $price = $dhl_price_array["30"];

            break;

        case $total_weight <= 40:

            $price = $dhl_price_array["40"];

            break;

        case $total_weight <= 50:

            $price = $dhl_price_array["50"];

            break;
        case $total_weight <= 60:

            $price = $dhl_price_array["60"];

            break;

        case $total_weight <= 70:

            $price = $dhl_price_array["70"];

            break;

        default :// >70
            $price = $dhl_price_array["70"]+($total_weight-70)* $dhl_price_arrayp['71'];

            break;

    }
    $price+=2.5;//new price update 03-05-2020


    $price = $price / 0.71;//convert to dollar

    $price = $price + $price * 0.15;//calc fuel

    $price = $price + $price * 0.16;//calc TAX

    $price = $price + $price * 0.05;//calc payment Gateway

    $price = round($price, 2);//round tow decimel


    $_SESSION["payment"]["shipping"] = $price;

    $_SESSION["payment"]["cod"] = 0;


    return json_encode(array("shipping" => $price, "cod" => 0));

}


function Paintgalleries($galleries)

{

    global $Lang;

    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }

    $id = uniqid(rand(10000, 99999), true);

    $id = explode(".", $id)[0];


    $viewLink = SITE_URL . $lang_code . '/galleries/' . $galleries['id'] . '/' . str_replace(" ", "-", $galleries['title_' . $cat_code]);

    $result = '';

    $result .= '<div class="item-container jq_item_container galleries floating-left reveal-bottom">';

    $result .= '<a  href="' . $viewLink . '"><div class="top-container">';

    $result .= '<span>' . $galleries['date'] . '</span></div>';

    $result .= ' <div class="galleries-container" style="background-image: url(' . SITE_URL . 'platform/galleries/' . $galleries['id'] . '/thumbnail.jpg)"></div>';

    $result .= '<div class="display-block secound-container">';

    $result .= ' <div class="title-sub-container clear-both floating-left">';

    $result .= '<div class="floating-left display-inline-block" style="width: 100%">';

    $result .= '<a class="title ' . $cat_code . '" title="' . $galleries['title_' . $cat_code] . '">' . $galleries['title_' . $cat_code] . '</a>';

    $result .= '</div></div> </div></a></div>';

    return $result;


}

function PaintEducationalInquiries($discussions)
{

    global $Lang;

    global $lang_code;

    $id = uniqid(rand(10000, 99999), true);

    $id = explode(".", $id)[0];

    $active = isWished($discussions['id'], 'educationalinquiries');

    $viewLink = SITE_URL . $lang_code . '/educationalinquiries/' . $discussions['id'] . '/' . str_replace(" ", "-", $discussions['qustion']);


    $result = '';

    $modification = '';

    if ($discussions['views'] == 0) {

        $modification = 'modification';

    }

    $result .= '<div class="item-container ' . $modification . '">';

    if ($modification != '') {

        $result .= '<div class="top-modification"> <i class="floating-left"></i> <span class="floating-left">' . $Lang->Youhavenewmodification . '</span> </div>';

    }

    $result .= '<div class="left-content floating-left">';

    $result .= '<div class="avatar-container">';

    $Avatar = "";

    if ($discussions['avatar'] != "") {

        $Avatar = getAvatar($discussions['avatar']);

    }


    if ($discussions['views'] == 0 && isset($_SESSION["user"]["permession"])) {

        if ($_SESSION["user"]["permession"] != 4 && $_SESSION["user"]["permession"] != 1) {

            $viewLink = "#";

        }


    } else if ($discussions['views'] == 0) {

        $viewLink = "#";


    }


    $result .= '<a href="' . $viewLink . '"><label style="background-image: url(' . $Avatar . ');" class=""></label></a> </div> ';

    if ($discussions['state_q'] == 2) {

        $result .= '<div class="lock-container"> <span>' . $Lang->Close . ' </span> </div>';

    }

    $result .= '</div><div class="right-content floating-left">';

    $result .= '<div class="top floating-left">';

    if (isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != "") {

        if (isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"] == 4 || isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"] == 1) {

            $result .= '<a id="control_' . $discussions['id'] . '" class="post-setting-btn floating-right"></a>';

        }

    }

    $result .= '<label class="floating-left">' . $discussions['fullname'] . '</label>';

    $result .= '<div class="time-container floating-left">';


    $result .= ' <span class="floating-left">' . $discussions['date'] . '</span>';

    $result .= '<i class="border-left floating-left"></i>';

    $result .= '<span class="floating-left">' . $discussions['views'] . '</span>';

    $result .= '<i class="border-left floating-left"></i>';

    $result .= '<span class="floating-left">' . $discussions['comments'] . '</span></div> </div>';

    if (isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != "") {

        if (isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"] == 4 || isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"] == 1) {

            $result .= ControlQuestions("main", $discussions['id'], $discussions['state_q'], $discussions['iduser']);

        }
    }

    $result .= '<div class="titleQustion"><a>' . $discussions['title'] . '</a> </div>';

    $result .= '<div id="text_' . $discussions['id'] . '" class="bottom">' . $discussions['qustion'] . ' </div> </div></div>';

    return $result;


}

function Areyousubscribe($isWorksheet=false){
    //covid-19 corona update :)
//    if(!$isWorksheet){
//        return true;
//    }



    global $row;
    if (isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"] != "") {
        $validpermession = array("1", "2", "10", "11", "6","9");
        $userpermession = $_SESSION["user"]["permession"];
        if (in_array($userpermession, $validpermession)) {
            return true;
        } else {
            //check if user access from qrcode in books By Hussam
            if(isset($row["id"]) && $row["id"]!="" && isset($_SESSION["canshow"][$row["id"]]) && $_SESSION["canshow"][$row["id"]]==1){
                return true;
            }else{
                return false;
            }
        }
    } else {
        //check if user access from qrcode in books By Hussam
        if(isset($row["id"]) && $row["id"]!="" && isset($_SESSION["canshow"][$row["id"]]) && $_SESSION["canshow"][$row["id"]]==1){
            return true;
        }else{
            return false;
        }
    }
}

/*
function Paintworksheet($worksheet)

{


    global $Lang;

    global $lang_code;

    $id = uniqid(rand(10000, 99999), true);

    $id = explode(".", $id)[0];

    $active = isWished($worksheet['id'], 'worksheet');

    $viewLink = SITE_URL . $lang_code . '/worksheet/' . $worksheet['id'] . '/' . str_replace(" ", "-", $worksheet['title_' . $lang_code]);

    $result = '';

    $result .= '<div class="item-container jq_item_container floating-left tsc_ribbon_wrap">';

//    $result .= '<div class="new-rebbon-container floating-left">' . $Lang->Free . '</div>';

    if ($worksheet['price'] == 0) {

        $result .= '<div class="ribbon-wrap right-edge fork lblue free-ribbon"><span>' . $Lang->Free . '</span></div>';
    }

    $result .= '<div class="inner-item-container">';

    $result .= '<a class="worksheet-thump libro" href="' . $viewLink . '" style="background-image: url(' . SITE_URL . 'platform/media/' . $worksheet['id'] . '/thumbnail_small.jpg)"></a>';

    $result .= '<div class="display-block secound-container">';

    $result .= '<div class="title-sub-container clear-both floating-left">';

    $result .= '<div class="floating-left display-inline-block">';

    $result .= '<a class="text-left title floating-left" href="' . $viewLink . '" title="' . $worksheet['title_' . $lang_code] . '">' . $worksheet['title_' . $lang_code] . '</a>';

    $result .= '</div></div>';

    $result .= '</div>';

    $result .= '<div class="display-block secound-container">';

    $result .= '<div class="title-sub-container clear-both floating-left">';

    $result .= '<div class="floating-left display-inline-block">';

    $result .= '<a class="text-left type">' . $Lang->Worksheet . '</a>';

    $result .= '</div>';
    $result .= '';

    $result .= '<div class="price floating-left">';

    $result .= '<div class="display-inline-block">';

    $result .= '<span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $worksheet['name_' . $lang_code] . '">' . $worksheet['name_' . $lang_code] . '</span>';

    $result .= '</div>';

    $result .= '</div></div></div>';

    $result .= '<div class="display-block top-container">';

    $result .= '<div class="rating-container floating-left">';

    $result .= '<div class="number floating-right">(' . $worksheet['rating_count'] . ')</div>';

    $result .= '<div class="stars floating-right">';

    $result .= '<form action="">';

    $result .= '<input ' . disableRate($worksheet['id'], $worksheet, "worksheet") . ' rate="5" prodect="worksheet" bookid="' . $worksheet['id'] . '" ' . calcRate($worksheet['rate'], 5) . '  class="star star-5" id="star-5' . $id . '" type="radio" name="star">';

    $result .= '<label class="' . msglogin(disableRate($worksheet['id'], $worksheet, "worksheet")) . ' star star-5" for="star-5' . $id . '"></label>';

    $result .= '<input ' . disableRate($worksheet['id'], $worksheet, "worksheet") . ' rate="4" prodect="worksheet" bookid="' . $worksheet['id'] . '" ' . calcRate($worksheet['rate'], 4) . ' class="star star-4" id="star-4' . $id . '" type="radio" name="star">';

    $result .= '<label  class="' . msglogin(disableRate($worksheet['id'], $worksheet, "worksheet")) . ' star star-4" for="star-4' . $id . '"></label>';

    $result .= '<input ' . disableRate($worksheet['id'], $worksheet, "worksheet") . ' rate="3" prodect="worksheet" bookid="' . $worksheet['id'] . '" ' . calcRate($worksheet['rate'], 3) . ' class="star star-3" id="star-3' . $id . '" type="radio" name="star">';

    $result .= '<label class="' . msglogin(disableRate($worksheet['id'], $worksheet, "worksheet")) . ' star star-3" for="star-3' . $id . '"></label>';

    $result .= '<input ' . disableRate($worksheet['id'], $worksheet, "worksheet") . ' rate="2" prodect="worksheet" bookid="' . $worksheet['id'] . '" ' . calcRate($worksheet['rate'], 2) . ' class="star star-2" id="star-2' . $id . '" type="radio" name="star">';

    $result .= '<label class="' . msglogin(disableRate($worksheet['id'], $worksheet, "worksheet")) . ' star star-2" for="star-2' . $id . '"></label>';

    $result .= '<input ' . disableRate($worksheet['id'], $worksheet, "worksheet") . ' rate="1" prodect="worksheet" bookid="' . $worksheet['id'] . '" ' . calcRate($worksheet['rate'], 1) . ' class="star star-1" id="star-1' . $id . '" type="radio" name="star">';

    $result .= '<label class="' . msglogin(disableRate($worksheet['id'], $worksheet, "worksheet")) . ' star star-1" for="star-1' . $id . '"></label>';


    $result .= '</form></div></div>';

    if ($worksheet['language'] == "En")
    {
        $result .= '<a class="addtofav floating-left text-left flag-english"></a>';
    }
    elseif ($worksheet['language'] == "Fr")
    {
        $result .= '<a class="addtofav floating-left text-left flag-France" ></a>';
    }
    elseif ($worksheet['language'] == "Ar")
    {
        $result .= '<a class="addtofav floating-left text-left flag-Arabic"></a>';
    }

    if ($worksheet['price'] > 0 && Areyousubscribe()==0) {

        $result .= '<a href="'.SITE_URL.$lang_code.'/subscribe" class="download-btn floating-right" >';

    } else {

        $class = 'btn-popup';

        $Cl2 = 'data-type="Container"';

        $href = '';

        if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {

            $class = '';

            $Cl2 = '';

            $href = 'href=' . SITE_URL .$lang_code. '/worksheet/' . $worksheet['id'] . '/' . str_replace(" ", "-", $worksheet["title_en"]) . '/view';


        }

        $result .= '<a ' . $Cl2 . ' class="download-btn floating-right ' . $class . '" bookid="' . $worksheet['id'] . '" ' . $href . '  target="_blank" >';

    }


    $result .= ' ' . $Lang->View . '</a>';


    $result .= '</div>';

    $result .= '</div></div>';

    return $result;

}


function Paintvideo($video)

{

    global $Lang;

    global $lang_code;

    $id = uniqid(rand(10000, 99999), true);

    $id = explode(".", $id)[0];

    $active = isWished($video['id'], 'video');

    $viewLink = SITE_URL . $lang_code . '/video/' . $video['id'] . '/' . str_replace(" ", "-", $video['title_' . $lang_code]);

    $result = '';

    $result .= '<div class="item-container jq_item_container floating-left tsc_ribbon_wrap">';

    if ($video['price'] == 0) {

        $result .= '<div class="ribbon-wrap right-edge fork lblue free-ribbon"><span>' . $Lang->Free . '</span></div>';
    }

    $result .= '<div class="inner-item-container">';

    $result .= '<div class="media-thump-container video" style="background-image: url(' . SITE_URL . 'platform/media/' . $video['id'] . '/thumbnail_small.jpg)">';

    $result .= '<a class="media-thump libro" href="' . $viewLink . '"></a>';

    $result .= '<a class="play-on-hover" href="' . $viewLink . '"><span class="icon-play "><div></div></span></a>';

    $result .= '<div class="bottom-thump"></div></div>';

    $result .= '<div class="display-block secound-container">';

    $result .= '<div class="title-sub-container clear-both floating-left">';

    $result .= '<div class="floating-left display-inline-block">';

    $result .= '<a class="text-left title" href="' . $viewLink . '" title="' . $video['title_' . $lang_code] . '">' . $video['title_' . $lang_code] . '</a>';

    $result .= '</div></div>';

    $result .= '</div>';

    $result .= '<div class="display-block secound-container">';

    $result .= '<div class="title-sub-container clear-both floating-left">';

    $result .= '<div class="floating-left display-inline-block">';

    $result .= '<a class="text-left type floating-left">' . $Lang->video . '</a>';

    $result .= '</div>';

    $result .= '<div class="price floating-left">';

    $result .= '<div class="display-inline-block">';

    $result .= '<span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $video['name_' . $lang_code] . '">' . $video['name_' . $lang_code] . '</span>';

    $result .= '</div>';

    $result .= '</div></div></div>';

    $result .= '<div class="display-block top-container">';

    $result .= '<div class="rating-container floating-left">';

    $result .= '<div class="number floating-right">(' . $video['rating_count'] . ')</div>';

    $result .= '<div class="stars floating-right">';

    $result .= '<form action="">';

    $result .= '<input ' . disableRate($video['id'], $video, "video") . ' rate="5" prodect="video" bookid="' . $video['id'] . '" ' . calcRate($video['rate'], 5) . '  class="star star-5" id="star-5' . $id . '" type="radio" name="star">';

    $result .= '<label class="' . msglogin(disableRate($video['id'], $video, "video")) . ' star star-5" for="star-5' . $id . '"></label>';

    $result .= '<input ' . disableRate($video['id'], $video, "video") . ' rate="4" prodect="video" bookid="' . $video['id'] . '" ' . calcRate($video['rate'], 4) . ' class="star star-4" id="star-4' . $id . '" type="radio" name="star">';

    $result .= '<label  class="' . msglogin(disableRate($video['id'], $video, "video")) . ' star star-4" for="star-4' . $id . '"></label>';

    $result .= '<input ' . disableRate($video['id'], $video, "video") . ' rate="3" prodect="video" bookid="' . $video['id'] . '" ' . calcRate($video['rate'], 3) . ' class="star star-3" id="star-3' . $id . '" type="radio" name="star">';

    $result .= '<label class="' . msglogin(disableRate($video['id'], $video, "video")) . ' star star-3" for="star-3' . $id . '"></label>';

    $result .= '<input ' . disableRate($video['id'], $video, "video") . ' rate="2" prodect="video" bookid="' . $video['id'] . '" ' . calcRate($video['rate'], 2) . ' class="star star-2" id="star-2' . $id . '" type="radio" name="star">';

    $result .= '<label class="' . msglogin(disableRate($video['id'], $video, "video")) . ' star star-2" for="star-2' . $id . '"></label>';

    $result .= '<input ' . disableRate($video['id'], $video, "video") . ' rate="1" prodect="video" bookid="' . $video['id'] . '" ' . calcRate($video['rate'], 1) . ' class="star star-1" id="star-1' . $id . '" type="radio" name="star">';

    $result .= '<label class="' . msglogin(disableRate($video['id'], $video, "video")) . ' star star-1" for="star-1' . $id . '"></label>';

    $result .= '</form></div></div>';

    if ($video['language'] == "En")
    {
        $result .= '<a class="addtofav floating-left text-left flag-english"></a>';
    }
    elseif ($video['language'] == "Fr")
    {
        $result .= '<a class="addtofav floating-left text-left flag-France" ></a>';
    }
    elseif ($video['language'] == "Ar")
    {
        $result .= '<a class="addtofav floating-left text-left flag-Arabic"></a>';
    }
    $result .= '</div></div></div>';

    return $result;

}
*/

function getThumb($row){
    if ($row['path'] == '') {
        $paththumb = SITE_URL . 'platform/media/' . $row['id'] . '/thumbnail_small.jpg';
    } else {
        switch ($row["type"]) {
            case 0:
                $typemedia = 'worksheet';
                break;
            case 12:
                $typemedia = 'interactive-worksheets';
                break;
            case 3:
                $typemedia = 'sound';
                break;
            case 4:
                $typemedia = 'video';
                break;
            case 11:
                $typemedia = 'games';
                break;
        }
        $idpath = explode("?id=", $row['path']);
        $paththumb = SITE_URL . 'platform/' . $typemedia . '/' . $idpath[1] . '/images/thumb.jpg';
    }
return $paththumb;
}

function paintmedia($data, $type)
{

    global $Lang;
    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    if ($data['path'] == '') {
        $paththumb = SITE_URL . 'platform/media/' . $data['id'] . '/thumbnail_small.jpg';
    } else {
        $idpath = explode("?id=", $data['path']);
        $paththumb = SITE_URL . 'platform/' . $type . '/' . $idpath[1] . '/images/thumb.jpg';
    }
    $id = uniqid(rand(10000, 99999), true);
    $id = explode(".", $id)[0];
    // $active = isWished($data['id'],$type);
    $viewLink = SITE_URL . $lang_code . '/' . $type . '/' . $data['id'] . '/' . str_replace(" ", "-", $data['title_'.$cat_code]);
    $result = '';
    $icon_play = '';
    switch ($type) {
        case 'worksheet':
            $class = '';
            $category = $Lang->Worksheet;
            break;
        case 'games':
            $class = 'game aa';
            $category = $Lang->Games;
            break;
        case 'interactive-worksheets':
            $class = 'game aa';
            $category = $Lang->InteractiveWorksheet;
            if($data["is_story"]){
                $story_path="platform/stories/".$data["productid"];
                if (is_file($story_path."/images/pic.jpg")) {
                    $paththumb = SITE_URL.$story_path."/images/pic.jpg";
                } else {
                    $paththumb = SITE_URL . 'images/story.png';
                }
            }


            break;
        case 'video':
            $class = 'video';
            $category = $Lang->video;
            $icon_play = '<a class="play-on-hover" href="' . $viewLink . '"><span class="icon-play "><div></div></span></a>';
            break;
        case 'audio':
            $class = 'audio';
            $category = $Lang->Audio;
            $icon_play = '<a class="play-on-hover" href="' . $viewLink . '"><span class="icon-play sound"><div></div></span></a>';
            break;
        case 'playlist':
            $class = 'audio';
            $category = $Lang->Playlist;
            $icon_play = '<a class="play-on-hover" href="' . $viewLink . '"><span class="icon-play sound"><div></div></span></a>';
            break;
    }

    $result .= '<div class="item-container jq_item_container floating-left tsc_ribbon_wrap reveal-bottom">';
    if ($data['price'] == 0) {
        $result .= '<div class="ribbon-wrap right-edge fork lblue free-ribbon"><span>' . $Lang->Free . '</span></div>';
    }
    $result .= '<div class="inner-item-container">';
    if ($type == 'worksheet') {
        $result .= '<a class="worksheet-thump libro" href="' . $viewLink . '" style="background-image: url(' . SITE_URL . 'platform/media/' . $data['id'] . '/thumbnail_small.jpg)"></a>';
    } else {
        $result .= '<div class="media-thump-container ' . $class . '" style="background-image: url(' . $paththumb . ')">';
        $result .= '<a class="media-thump libro" href="' . $viewLink . '"></a>';
        $result .= $icon_play;
        $result .= '<div class="bottom-thump"></div> </div>';
    }
    $result .= '<div class="display-block secound-container">';
    $result .= '<div class="title-sub-container clear-both floating-left">';
    $result .= '<div class="floating-left display-inline-block">';
    $result .= '<a class="text-left title floating-left" href="' . $viewLink . '" title="' . $data['title_' . $cat_code] . '">' . $data['title_' . $cat_code] . '</a>';
    $result .= '</div></div>';
    $result .= '</div>';
    $result .= '<div class="display-block secound-container">';
    $result .= '<div class="title-sub-container clear-both floating-left">';
    $result .= '<div class="floating-left display-inline-block">';
    $result .= '<a class="text-left type">' . $category . '</a>';
    $result .= '</div>';
    $result .= '<div class="price floating-left">';
    $result .= '<div class="display-inline-block">';
    $result .= '<span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $data['name_' . $cat_code] . '">' . $data['name_' . $cat_code] . '</span>';
    $result .= '</div>';
    $result .= '</div></div></div>';
    $result .= '<div class="display-block top-container">';
    $result .= '<div class="rating-container floating-left">';
    $result .= '<div class="number floating-right">(' . $data['rating_count'] . ')</div>';
    $result .= '<div class="stars floating-right">';
    $result .= '<form action="">';
    $result .= '<input ' . disableRate($data['id'], $data, $type) . ' rate="5" prodect="' . $type . '" bookid="' . $data['id'] . '" ' . calcRate($data['rate'], 5) . '  class="star star-5" id="star-5' . $id . '" type="radio" name="star">';
    $result .= '<label class="' . msglogin(disableRate($data['id'], $data, $type)) . ' star star-5" for="star-5' . $id . '"></label>';
    $result .= '<input ' . disableRate($data['id'], $data, $type) . ' rate="4" prodect="' . $type . '" bookid="' . $data['id'] . '" ' . calcRate($data['rate'], 4) . ' class="star star-4" id="star-4' . $id . '" type="radio" name="star">';
    $result .= '<label  class="' . msglogin(disableRate($data['id'], $data, $type)) . ' star star-4" for="star-4' . $id . '"></label>';
    $result .= '<input ' . disableRate($data['id'], $data, $type) . ' rate="3" prodect="' . $type . '" bookid="' . $data['id'] . '" ' . calcRate($data['rate'], 3) . ' class="star star-3" id="star-3' . $id . '" type="radio" name="star">';
    $result .= '<label class="' . msglogin(disableRate($data['id'], $data, $type)) . ' star star-3" for="star-3' . $id . '"></label>';
    $result .= '<input ' . disableRate($data['id'], $data, $type) . ' rate="2" prodect="' . $type . '" bookid="' . $data['id'] . '" ' . calcRate($data['rate'], 2) . ' class="star star-2" id="star-2' . $id . '" type="radio" name="star">';
    $result .= '<label class="' . msglogin(disableRate($data['id'], $data, $type)) . ' star star-2" for="star-2' . $id . '"></label>';
    $result .= '<input ' . disableRate($data['id'], $data, $type) . ' rate="1" prodect="' . $type . '" bookid="' . $data['id'] . '" ' . calcRate($data['rate'], 1) . ' class="star star-1" id="star-1' . $id . '" type="radio" name="star">';
    $result .= '<label class="' . msglogin(disableRate($data['id'], $data, $type)) . ' star star-1" for="star-1' . $id . '"></label>';
    $result .= '</form></div></div>';
    if ($data['price'] > 0 && Areyousubscribe() == 0) {
        $result .= '<a href="' . SITE_URL . $lang_code . '/subscribe" class="buy-btn download-btn floating-right">' . $Lang->View . '</a>';
    } else {
        $hrf = "" . SITE_URL . $lang_code . '/' . $type . '/' . $data['id'] . '/' . $data['title_en'] . "/play";
        if ($type == 'games' || $type == 'interactive-worksheets') {
//            if($data["is_story"]){
//                $hrf = SITE_URL . $lang_code . '/story/' . $data['productid'] . '/' . str_replace(" ", "-", $data['title_'.$cat_code]);
//                $result .= '<a href="' . $hrf . '" class="buy-btn download-btn floating-right">' . $Lang->View . '</a>';
//            }else{
                if(isset($data['is_newtab']) && $data['is_newtab']==1){
                    $fullscreen='';
                }else{
                    $fullscreen='javascript:launchFullscreen()';
                }

                $result .= '<a onclick="javascript:viewMedia(' . $data['id'] . ');'.$fullscreen.'" class="buy-btn download-btn floating-right">' . $Lang->View . '</a>';
//            }

        } else {
            $result .= '<a href="' . $hrf . '" class="buy-btn download-btn floating-right">' . $Lang->View . '</a>';
        }

    }
    if ($data['path'] == '') {
        $paththumb = SITE_URL . 'platform/media/' . $data['id'] . '/thumbnail_small.jpg';
    } else {
        $idpath = explode("?id=", $data['path']);
        $paththumb = SITE_URL . 'platform/' . $type . '/' . $idpath[1] . '/images/thumb.jpg';
    }
    if ($data['language'] == "En") {
        $result .= '<a class="addtofav floating-left text-left flag-english"></a>';
    } elseif ($data['language'] == "Fr") {
        $result .= '<a class="addtofav floating-left text-left flag-France" ></a>';
    } elseif ($data['language'] == "Ar") {
        $result .= '<a class="addtofav floating-left text-left flag-Arabic"></a>';
    }
    $playlist_link =SITE_URL.$lang_code.'/playlist/'.$data['id'].'/'.str_replace(" ","-",$data['title_'.$cat_code]);
    if($data['is_playlist']==1){
        if($data['is_newtab']){
            $result .= '<a class="addtofav floating-left text-left" style="background:url('.SITE_URL.'images/playlis-icon01.svg) center no-repeat;background-size: contain;transition: all .5s;padding: 0 10px;" title="'.$Lang->Playlist.'"></a>';
        }else{
            $subscribe="";
            if($data['price']!=0 && !Areyousubscribe()){
                $subscribe=" jq_subscribe";
            }
            $result .= '<a class="addtofav floating-left text-left jq_viewplaylist '.$subscribe.'" data-href="'.$playlist_link.'" style="background:url('.SITE_URL.'images/playlis-icon01.svg) center no-repeat;background-size: contain;transition: all .5s;padding: 0 10px;" title="'.$Lang->Playlist.'"></a>';
        }
    }
    $result .= '</div></div></div>';
    return $result;

}

function paintQuiz($data, $type = "quiz", $public = false)
{

    global $Lang;
    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    if (isset($data['category']) && $data['category'] != '' && $data['category'] != -1) {
        $paththumb = SITE_URL . 'images/quiz/' . $data['category'] . $cat_code . ".jpg";
    } else {
        $paththumb = SITE_URL . 'images/quiz/' . $lang_code . '.jpg';
    }

    $id = uniqid(rand(10000, 99999), true);
    $id = explode(".", $id)[0];


    if (strtolower($data["language"]) == "ar") {
        $quiz_lang = "ar";
    } else {
        $quiz_lang = "en";
    }

    $viewLink = SITE_URL . 'platform/quiz/view/' . $lang_code . '/index.php?id=' . $data['quizid'];
    $result = '';
    $icon_play = '';

    $result .= '<div class="item-container jq_item_container floating-left tsc_ribbon_wrap reveal-bottom">';
    $result .= '<div class="inner-item-container">';

    $result .= '<div class="media-thump-container game quiz" style="background-image: url(' . $paththumb . ')">';
    $result .= '<a class="media-thump libro" href="' . $viewLink . '"></a>';
    $result .= '<div class="bottom-thump"></div> </div>';

    $result .= '<div class="display-block secound-container">';
    $result .= '<div class="title-sub-container clear-both floating-left">';
    $result .= '<div class="floating-left display-inline-block">';
    $result .= '<a class="text-left title floating-left" href="' . $viewLink . '" title="' . $data['title'] . '">' . $data['title'] . '</a>';
    $result .= '</div></div>';
    $result .= '</div>';
    $result .= '<div class="display-block secound-container">';
    $result .= '<div class="title-sub-container clear-both floating-left">';
    $result .= '<div class="floating-left display-inline-block">';
    $result .= '<a class="text-left type">' . $Lang->Quiz . '</a>';
    $result .= '</div>';
    $result .= '<div class="price floating-left">';
    $result .= '<div class="display-inline-block">';
    $result .= '<span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $data['name_' . $cat_code] . '">' . $data['name_' . $cat_code] . '</span>';
    $result .= '</div>';
    $result .= '</div></div></div>';
    $result .= '<div class="display-block top-container">';
    $result .= '<div class="rating-container floating-left">';
    $result .= '<div class="number floating-right">(' . $data['rating_count'] . ')</div>';
    $result .= '<div class="stars floating-right">';
    $result .= '<form action="">';
    $result .= '<input ' . disableRate($data['quizid'], $data, $type) . ' rate="5" prodect="' . $type . '" bookid="' . $data['quizid'] . '" ' . calcRate($data['rate'], 5) . '  class="star star-5" id="star-5' . $id . '" type="radio" name="star">';
    $result .= '<label class="' . msglogin(disableRate($data['quizid'], $data, $type)) . ' star star-5" for="star-5' . $id . '"></label>';
    $result .= '<input ' . disableRate($data['quizid'], $data, $type) . ' rate="4" prodect="' . $type . '" bookid="' . $data['quizid'] . '" ' . calcRate($data['rate'], 4) . ' class="star star-4" id="star-4' . $id . '" type="radio" name="star">';
    $result .= '<label  class="' . msglogin(disableRate($data['quizid'], $data, $type)) . ' star star-4" for="star-4' . $id . '"></label>';
    $result .= '<input ' . disableRate($data['quizid'], $data, $type) . ' rate="3" prodect="' . $type . '" bookid="' . $data['quizid'] . '" ' . calcRate($data['rate'], 3) . ' class="star star-3" id="star-3' . $id . '" type="radio" name="star">';
    $result .= '<label class="' . msglogin(disableRate($data['quizid'], $data, $type)) . ' star star-3" for="star-3' . $id . '"></label>';
    $result .= '<input ' . disableRate($data['quizid'], $data, $type) . ' rate="2" prodect="' . $type . '" bookid="' . $data['quizid'] . '" ' . calcRate($data['rate'], 2) . ' class="star star-2" id="star-2' . $id . '" type="radio" name="star">';
    $result .= '<label class="' . msglogin(disableRate($data['quizid'], $data, $type)) . ' star star-2" for="star-2' . $id . '"></label>';
    $result .= '<input ' . disableRate($data['quizid'], $data, $type) . ' rate="1" prodect="' . $type . '" bookid="' . $data['quizid'] . '" ' . calcRate($data['rate'], 1) . ' class="star star-1" id="star-1' . $id . '" type="radio" name="star">';
    $result .= '<label class="' . msglogin(disableRate($data['quizid'], $data, $type)) . ' star star-1" for="star-1' . $id . '"></label>';
    $result .= '</form></div></div>';
    if ($data['price'] > 0 && Areyousubscribe() == 0) {
        $result .= '<a href="' . SITE_URL . $lang_code . '/subscribe" class="quiz-view floating-right" title="' . $Lang->View . '"><i></i></a>';
    } else {
        $hrf = "" . SITE_URL . 'platform/quiz/view/' . $quiz_lang . "/index.php?id=" . $data['quizid'];
        $result .= '<a target="_blank" href="' . $hrf . '" class="quiz-view floating-right" title="' . $Lang->View . '"><i></i></a>';
    }
    if (!$public) {
        $result .= '<a href="' . SITE_URL . $lang_code . '/quiz-editor?id=' . $data["quizid"] . '" class="quiz-edit floating-right" title="' . $Lang->Edit . '"><i></i></a>';
        $result .= '<a data-id="' . $data["quizid"] . '" class="quiz-delete floating-right jq_deletequiz" title="' . $Lang->Delete . '" ><i></i></a>';
        $result .= '<a href="' . SITE_URL . $lang_code . '/quiz-result/' . $data["quizid"] . '/' . $data["title"] . '" class="quiz-result floating-right jq_quizresult" title="' . $Lang->Result . '" ><i></i></a> ';
    }

    if ($data['language'] == "En") {
        $result .= '<a class="addtofav floating-left text-left flag-english"></a>';
    } elseif ($data['language'] == "Fr") {
        $result .= '<a class="addtofav floating-left text-left flag-France" ></a>';
    } elseif ($data['language'] == "Ar") {
        $result .= '<a class="addtofav floating-left text-left flag-Arabic"></a>';
    }
    $result .= '</div></div></div>';
    return $result;

}



function paintMyStory($data, $type = "story", $public = false)
{

    global $Lang;
    global $lang_code;
    global $cat_code;
    $story_path="platform/stories/".$data["storyid"];
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    if (is_file($story_path."/images/pic.jpg")) {
        $paththumb = SITE_URL.$story_path."/images/pic.jpg";
    } else {
        $paththumb = SITE_URL . 'images/story.png';
    }

    $id = uniqid(rand(10000, 99999), true);
    $id = explode(".", $id)[0];


    if (strtolower($data["language"]) == "ar") {
        $quiz_lang = "ar";
    } else {
        $quiz_lang = "en";
    }

    $viewLink = SITE_URL. $lang_code . '/story/' . $data['storyid']."/". $data['title'];

    $result = '';
    $icon_play = '';

    $result .= '<div class="item-container jq_item_container floating-left tsc_ribbon_wrap reveal-bottom">';
    $result .= '<div class="inner-item-container">';

    $result .= '<div class="media-thump-container game quiz" style="background-image: url(' . $paththumb . ')">';
    $result .= '<a class="media-thump libro" href="' . $viewLink . '"></a>';
    $result .= '<div class="bottom-thump"></div> </div>';

    $result .= '<div class="display-block secound-container">';
    $result .= '<div class="title-sub-container clear-both floating-left">';
    $result .= '<div class="floating-left display-inline-block">';
    $result .= '<a class="text-left title floating-left" href="' . $viewLink . '" title="' . $data['title'] . '">' . $data['title'] . '</a>';
    $result .= '</div></div>';
    $result .= '</div>';
    $result .= '<div class="display-block secound-container">';
    $result .= '<div class="title-sub-container clear-both floating-left">';
    $result .= '<div class="floating-left display-inline-block">';
    $result .= '<a class="text-left type">' . $Lang->Story . '</a>';
    $result .= '</div>';
    $result .= '<div class="price floating-left">';
    $result .= '<div class="display-inline-block">';
    $result .= '<span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $data['name_' . $cat_code] . '">' . $data['name_' . $cat_code] . '</span>';
    $result .= '</div>';
    $result .= '</div></div></div>';
    $result .= '<div class="display-block top-container">';
    $result .= '<div class="rating-container floating-left">';
    $result .= '<div class="number floating-right">(' . $data['rating_count'] . ')</div>';
    $result .= '<div class="stars floating-right">';
    $result .= '<form action="">';
    $result .= '<input ' . disableRate($data['storyid'], $data, $type) . ' rate="5" prodect="' . $type . '" bookid="' . $data['storyid'] . '" ' . calcRate($data['rate'], 5) . '  class="star star-5" id="star-5' . $id . '" type="radio" name="star">';
    $result .= '<label class="' . msglogin(disableRate($data['storyid'], $data, $type)) . ' star star-5" for="star-5' . $id . '"></label>';
    $result .= '<input ' . disableRate($data['storyid'], $data, $type) . ' rate="4" prodect="' . $type . '" bookid="' . $data['storyid'] . '" ' . calcRate($data['rate'], 4) . ' class="star star-4" id="star-4' . $id . '" type="radio" name="star">';
    $result .= '<label  class="' . msglogin(disableRate($data['storyid'], $data, $type)) . ' star star-4" for="star-4' . $id . '"></label>';
    $result .= '<input ' . disableRate($data['storyid'], $data, $type) . ' rate="3" prodect="' . $type . '" bookid="' . $data['storyid'] . '" ' . calcRate($data['rate'], 3) . ' class="star star-3" id="star-3' . $id . '" type="radio" name="star">';
    $result .= '<label class="' . msglogin(disableRate($data['storyid'], $data, $type)) . ' star star-3" for="star-3' . $id . '"></label>';
    $result .= '<input ' . disableRate($data['storyid'], $data, $type) . ' rate="2" prodect="' . $type . '" bookid="' . $data['storyid'] . '" ' . calcRate($data['rate'], 2) . ' class="star star-2" id="star-2' . $id . '" type="radio" name="star">';
    $result .= '<label class="' . msglogin(disableRate($data['storyid'], $data, $type)) . ' star star-2" for="star-2' . $id . '"></label>';
    $result .= '<input ' . disableRate($data['storyid'], $data, $type) . ' rate="1" prodect="' . $type . '" bookid="' . $data['storyid'] . '" ' . calcRate($data['rate'], 1) . ' class="star star-1" id="star-1' . $id . '" type="radio" name="star">';
    $result .= '<label class="' . msglogin(disableRate($data['storyid'], $data, $type)) . ' star star-1" for="star-1' . $id . '"></label>';
    $result .= '</form></div></div>';

        $hrf = $viewLink;
        $result .= '<a target="_blank" href="' . $hrf . '" class="quiz-view floating-right" title="' . $Lang->View . '"><i></i></a>';

    if (!$public) {
        $result .= '<a href="' . SITE_URL . $lang_code . '/story-editor?id=' . $data["storyid"] . '" class="quiz-edit floating-right" title="' . $Lang->Edit . '"><i></i></a>';
        $result .= '<a data-id="' . $data["storyid"] . '" class="quiz-delete floating-right jq_deletestory" title="' . $Lang->Delete . '" ><i></i></a>';
    }

    if (ucfirst($data['language']) == "En") {
        $result .= '<a class="addtofav floating-left text-left flag-english"></a>';
    } elseif (ucfirst($data['language']) == "Fr") {
        $result .= '<a class="addtofav floating-left text-left flag-France" ></a>';
    } elseif (ucfirst($data['language']) == "Ar") {
        $result .= '<a class="addtofav floating-left text-left flag-Arabic"></a>';
    }else{
        $result .= '<a class="addtofav floating-left text-left flag-english"></a>';
    }
    $result .= '</div></div></div>';
    return $result;

}

function paintMyActivities($data, $type = "story", $public = false){

    global $Lang;
    global $lang_code;
    global $cat_code;
    $media_path="platform/media/".$data["id"];
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    if (is_file($media_path."/thumbnail.jpg")) {
        $paththumb = SITE_URL.$media_path."/thumbnail.jpg";
    } else {
        $paththumb = SITE_URL . 'images/story.png';
    }

    $id = uniqid(rand(10000, 99999), true);
    $id = explode(".", $id)[0];


    if (strtolower($data["language"]) == "ar") {
        $quiz_lang = "ar";
    } else {
        $quiz_lang = "en";
    }

    $viewLink = SITE_URL.'platform/media/'.$data['id']."/index.html";

    $result = '';
    $icon_play = '';

    $result .= '<div class="item-container jq_item_container floating-left tsc_ribbon_wrap reveal-bottom">';
    $result .= '<div class="inner-item-container">';

    $result .= '<div class="media-thump-container game quiz" style="background-image: url(' . $paththumb . ')">';
    $result .= '<a class="media-thump libro" href="' . $viewLink . '"></a>';
    $result .= '<div class="bottom-thump"></div> </div>';

    $result .= '<div class="display-block secound-container">';
    $result .= '<div class="title-sub-container clear-both floating-left">';
    $result .= '<div class="floating-left display-inline-block">';
    $result .= '<a class="text-left title floating-left" href="' . $viewLink . '" title="' . $data['title_'.$cat_code] . '">' . $data['title_'.$cat_code] . '</a>';
    $result .= '</div></div>';
    $result .= '</div>';
    $result .= '<div class="display-block secound-container">';
    $result .= '<div class="title-sub-container clear-both floating-left">';
    $result .= '<div class="floating-left display-inline-block">';
    $result .= '<a class="text-left type">' . $Lang->Activity . '</a>';
    $result .= '</div>';
    $result .= '<div class="price floating-left">';
    $result .= '<div class="display-inline-block">';
    $result .= '<span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $data['name_' . $cat_code] . '">' . $data['name_' . $cat_code] . '</span>';
    $result .= '</div>';
    $result .= '</div></div></div>';
    $result .= '<div class="display-block top-container">';
    $hrf = $viewLink;
    $result .= '<a target="_blank" href="' . $hrf . '" class="quiz-view floating-right" title="' . $Lang->View . '"><i></i></a>';

    if (!$public) {
        $result .= '<a href="' . SITE_URL . $lang_code . '/editor?id=' . $data["id"] . '" class="quiz-edit floating-right" title="' . $Lang->Edit . '"><i></i></a>';
        $result .= '<a data-id="' . $data["id"] . '" class="quiz-delete floating-right jq_deletemedia" title="' . $Lang->Delete . '" ><i></i></a>';
    }

    if (ucfirst($data['language']) == "En") {
        $result .= '<a class="addtofav floating-left text-left flag-english"></a>';
    } elseif (ucfirst($data['language']) == "Fr") {
        $result .= '<a class="addtofav floating-left text-left flag-France" ></a>';
    } elseif (ucfirst($data['language']) == "Ar") {
        $result .= '<a class="addtofav floating-left text-left flag-Arabic"></a>';
    }else{
        $result .= '<a class="addtofav floating-left text-left flag-english"></a>';
    }
    $result .= '</div></div></div>';
    return $result;
}


/*
function PaintGames($game){

    global $Lang;

    global $lang_code;
    if ($game['path'] == '') {
        $paththumb = SITE_URL . 'platform/media/' . $game['id'] . '/thumbnail_small.jpg';
    } else {
        $idpath = explode("?id=", $game['path']);
        $paththumb = SITE_URL . 'platform/games/' . $idpath[1] . '/images/thumb.jpg';
    }

    $id = uniqid(rand(10000, 99999), true);

    $id = explode(".", $id)[0];

    $active = isWished($game['id'], 'games');

    $viewLink = SITE_URL . $lang_code . '/games/' . $game['id'] . '/' . str_replace(" ", "-", $game['title_' . $lang_code]);

    $result = '';

    $result .= '<div class="item-container jq_item_container floating-left tsc_ribbon_wrap">';

    if ($game['price'] == 0) {

        $result .= '<div class="ribbon-wrap right-edge fork lblue free-ribbon"><span>' . $Lang->Free . '</span></div>';
    }

    $result .= '<div class="inner-item-container">';

    $result .= '<div class="media-thump-container game" style="background-image: url(' . $paththumb . ')">';

    $result .= '<a class="media-thump libro" href="' . $viewLink . '"></a>';

    $result .= '<div class="bottom-thump"></div> </div>';

    $result .= '<div class="display-block secound-container">';

    $result .= '<div class="title-sub-container clear-both floating-left">';

    $result .= '<div class="floating-left display-inline-block">';

    $result .= '<a class="text-left title floating-left" href="' . $viewLink . '" title="' . $game['title_' . $lang_code] . '">' . $game['title_' . $lang_code] . '</a>';

    $result .= '</div></div>';

    $result .= '</div>';

    $result .= '<div class="display-block secound-container">';

    $result .= '<div class="title-sub-container clear-both floating-left">';

    $result .= '<div class="floating-left display-inline-block">';

    $result .= '<a class="text-left type">' . $Lang->Games . '</a>';

    $result .= '</div>';

    $result .= '<div class="price floating-left">';

    $result .= '<div class="display-inline-block">';

    $result .= '<span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $game['name_' . $lang_code] . '">' . $game['name_' . $lang_code] . '</span>';

    $result .= '</div>';

    $result .= '</div></div></div>';


    $result .= '<div class="display-block top-container">';

    $result .= '<div class="rating-container floating-left">';

    $result .= '<div class="number floating-right">(' . $game['rating_count'] . ')</div>';

    $result .= '<div class="stars floating-right">';

    $result .= '<form action="">';

    $result .= '<input ' . disableRate($game['id'], $game, "games") . ' rate="5" prodect="games" bookid="' . $game['id'] . '" ' . calcRate($game['rate'], 5) . '  class="star star-5" id="star-5' . $id . '" type="radio" name="star">';

    $result .= '<label class="' . msglogin(disableRate($game['id'], $game, "games")) . ' star star-5" for="star-5' . $id . '"></label>';

    $result .= '<input ' . disableRate($game['id'], $game, "games") . ' rate="4" prodect="games" bookid="' . $game['id'] . '" ' . calcRate($game['rate'], 4) . ' class="star star-4" id="star-4' . $id . '" type="radio" name="star">';

    $result .= '<label  class="' . msglogin(disableRate($game['id'], $game, "games")) . ' star star-4" for="star-4' . $id . '"></label>';

    $result .= '<input ' . disableRate($game['id'], $game, "games") . ' rate="3" prodect="games" bookid="' . $game['id'] . '" ' . calcRate($game['rate'], 3) . ' class="star star-3" id="star-3' . $id . '" type="radio" name="star">';

    $result .= '<label class="' . msglogin(disableRate($game['id'], $game, "games")) . ' star star-3" for="star-3' . $id . '"></label>';

    $result .= '<input ' . disableRate($game['id'], $game, "games") . ' rate="2" prodect="games" bookid="' . $game['id'] . '" ' . calcRate($game['rate'], 2) . ' class="star star-2" id="star-2' . $id . '" type="radio" name="star">';

    $result .= '<label class="' . msglogin(disableRate($game['id'], $game, "games")) . ' star star-2" for="star-2' . $id . '"></label>';

    $result .= '<input ' . disableRate($game['id'], $game, "games") . ' rate="1" prodect="games" bookid="' . $game['id'] . '" ' . calcRate($game['rate'], 1) . ' class="star star-1" id="star-1' . $id . '" type="radio" name="star">';

    $result .= '<label class="' . msglogin(disableRate($game['id'], $game, "games")) . ' star star-1" for="star-1' . $id . '"></label>';

    $result .= '</form></div></div>';


    if ($game['price'] > 0 && Areyousubscribe()==0) {

        $result .= '<a href="'.SITE_URL.$lang_code.'/subscribe" class="buy-btn download-btn floating-right">' . $Lang->View . '</a>';

    } else {
        $hrf = "" . SITE_URL .$lang_code. '/games/' . $game['id'] . '/' . $game['title_' . $lang_code] . "/play";
        $result .= '<a href="'.$hrf.'" class="buy-btn download-btn floating-right">' . $Lang->View . '</a>';

    }

    if ($game['path'] == '') {

        $paththumb = SITE_URL . 'platform/media/' . $game['id'] . '/thumbnail_small.jpg';

    } else {

        $idpath = explode("?id=", $game['path']);


        $paththumb = SITE_URL . 'platform/games/' . $idpath[1] . '/images/thumb.jpg';

    }
    if ($game['language'] == "En")
    {
        $result .= '<a class="addtofav floating-left text-left flag-english"></a>';
    }
    elseif ($game['language'] == "Fr")
    {
        $result .= '<a class="addtofav floating-left text-left flag-France" ></a>';
    }
    elseif ($game['language'] == "Ar")
    {
        $result .= '<a class="addtofav floating-left text-left flag-Arabic"></a>';
    }

    $result .= '</div></div></div>';

    return $result;

}

function Paintaudio($audio)

{

    global $lang_code;

    global $Lang;

    $id = uniqid(rand(10000, 99999), true);

    $id = explode(".", $id)[0];

    $active = isWished($audio['id'], 'audio');

    $viewLink = SITE_URL . $lang_code . '/audio/' . $audio['id'] . '/' . str_replace(" ", "-", $audio['title_' . $lang_code]);

    $result = '';

    $result .= '<div class="item-container jq_item_container floating-left tsc_ribbon_wrap">';

    if ($audio['price'] == 0) {

        $result .= '<div class="ribbon-wrap right-edge fork lblue free-ribbon"><span>' . $Lang->Free . '</span></div>';
    }

    $result .= '<div class="inner-item-container">';

    $result .= '<div class="media-thump-container audio" style="background-image: url(' . SITE_URL . 'platform/media/' . $audio['id'] . '/thumbnail_small.jpg)" >';

    $result .= '<a class="media-thump libro" href="' . $viewLink . '"></a>';

    $result .= '<a class="play-on-hover" href="' . $viewLink . '"><span class="icon-play sound"><div></div></span></a>';

    $result .= ' </div>';

    $result .= '<div class="display-block secound-container">';

    $result .= '<div class="title-sub-container clear-both floating-left">';

    $result .= '<div class="floating-left display-inline-block">';

    $result .= '<a class="text-left title floating-left" href="' . $viewLink . '" title="' . $audio['title_' . $lang_code] . '">' . $audio['title_' . $lang_code] . '</a>';

    $result .= '</div></div>';

    $result .= '</div>';

    $result .= '<div class="display-block secound-container">';

    $result .= '<div class="title-sub-container clear-both floating-left">';

    $result .= '<div class="floating-left display-inline-block">';

    $result .= '<a class="text-left type floating-left">' . $Lang->Audio . '</a>';

    $result .= '</div>';
    $result .= '';

    $result .= '<div class="price floating-left">';

    $result .= '<div class="display-inline-block">';

    $result .= '<span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="' . $audio['name_' . $lang_code] . '">' . $audio['name_' . $lang_code] . '</span>';

    $result .= '</div>';

    $result .= '</div></div></div>';

    $result .= '<div class="display-block top-container">';

    $result .= '<div class="rating-container floating-left">';

    $result .= '<div class="number floating-right">(' . $audio['rating_count'] . ')</div>';

    $result .= '<div class="stars floating-right">';

    $result .= '<form action="">';

    $result .= '<input ' . disableRate($audio['id'], $audio, "audio") . ' rate="5" prodect="audio" bookid="' . $audio['id'] . '" ' . calcRate($audio['rate'], 5) . '  class="star star-5" id="star-5' . $id . '" type="radio" name="star">';

    $result .= '<label class="' . msglogin(disableRate($audio['id'], $audio, "audio")) . ' star star-5" for="star-5' . $id . '"></label>';

    $result .= '<input ' . disableRate($audio['id'], $audio, "audio") . ' rate="4" prodect="audio" bookid="' . $audio['id'] . '" ' . calcRate($audio['rate'], 4) . ' class="star star-4" id="star-4' . $id . '" type="radio" name="star">';

    $result .= '<label  class="' . msglogin(disableRate($audio['id'], $audio, "audio")) . ' star star-4" for="star-4' . $id . '"></label>';

    $result .= '<input ' . disableRate($audio['id'], $audio, "audio") . ' rate="3" prodect="audio" bookid="' . $audio['id'] . '" ' . calcRate($audio['rate'], 3) . ' class="star star-3" id="star-3' . $id . '" type="radio" name="star">';

    $result .= '<label class="' . msglogin(disableRate($audio['id'], $audio, "audio")) . ' star star-3" for="star-3' . $id . '"></label>';

    $result .= '<input ' . disableRate($audio['id'], $audio, "audio") . ' rate="2" prodect="audio" bookid="' . $audio['id'] . '" ' . calcRate($audio['rate'], 2) . ' class="star star-2" id="star-2' . $id . '" type="radio" name="star">';

    $result .= '<label class="' . msglogin(disableRate($audio['id'], $audio, "audio")) . ' star star-2" for="star-2' . $id . '"></label>';

    $result .= '<input ' . disableRate($audio['id'], $audio, "audio") . ' rate="1" prodect="audio" bookid="' . $audio['id'] . '" ' . calcRate($audio['rate'], 1) . ' class="star star-1" id="star-1' . $id . '" type="radio" name="star">';

    $result .= '<label class="' . msglogin(disableRate($audio['id'], $audio, "audio")) . ' star star-1" for="star-1' . $id . '"></label>';

    $result .= '</form></div></div>';

    if ($audio['language'] == "En")
    {
        $result .= '<a class="addtofav floating-left text-left flag-english"></a>';
    }
    elseif ($audio['language'] == "Fr")
    {
        $result .= '<a class="addtofav floating-left text-left flag-France" ></a>';
    }
    elseif ($audio['language'] == "Ar")
    {
        $result .= '<a class="addtofav floating-left text-left flag-Arabic"></a>';
    }

    $result .= '</div></div></div>';
    return $result;

}

*/
//khalid 5-9-2016

function PaintNews($News)

{

    global $Lang;

    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }

    $id = uniqid(rand(10000, 99999), true);

    $id = explode(".", $id)[0];

    $active = isWished($News['newsid'], 'news');

    $viewLink = SITE_URL . $lang_code . "/news/" . $News['newsid'] . "/" . str_replace(" ", "-", $News['title_' . $cat_code]);

    $result = '

     <div class="item-container">

                    <a href="' . $viewLink . '" class="left floating-left"

                       style="background: url(' . SITE_URL . $News['image'] . '"></a>

                    <div class="right floating-left">

                        <div class="top">

                            <div class="time-side floating-left">

                                <span class="floating-left">' . date('H:i:s', strtotime($News['news_date'])) . '</span>

                                <span class="floating-left">' . date('D', strtotime($News['news_date'])) . '</span>

                                <span class="floating-left">' . date('d-M', strtotime($News['news_date'])) . '</span>

                            </div>



                        </div>

                        <div class="bottom">

                            <a href="' . $viewLink . '" class="title">' . $News['title_' . $cat_code] . '</a>';
    if($News['newsid']!=23){
        $result.='<p>' .substr($News['news_' . $cat_code]). '<a href="' . $viewLink . '" class="more">' . $Lang->ReadMores . '</a></p>';
    }


    $result.=' </div>

                    </div>

                </div>
    ';

    return $result;

}


function getPageDescription($page)

{

    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }

    global $session_lang;

    global $Lang;

    global $row;

    global $catName;

    switch ($page) {

        case "index.php":

            $description = $Lang->indexDescription;

            break;

        case "books.php":

            if (isset($_GET["category"]) && $_GET["category"] > 0 && (!isset($_GET["keywords"]) || $_GET["keywords"] == "")) {

                $description = str_replace("****", $catName, $Lang->booksDescriptionT1);

            } else if (isset($_GET["category"]) && $_GET["category"] > 0 && (isset($_GET["keywords"]) && $_GET["keywords"] != "")) {

                $description = str_replace("****", $catName, $Lang->booksDescriptionT2);

                $description = str_replace("----", $_GET["keywords"], $description);

            } else if ((isset($_GET["keywords"]) && $_GET["keywords"] != "")) {

                $description = str_replace("----", $_GET["keywords"], $Lang->booksDescriptionT3);

            } else {

                $description = $Lang->booksDescription;

            }


            break;
            case "teacher_books.php":

            if (isset($_GET["category"]) && $_GET["category"] > 0 && (!isset($_GET["keywords"]) || $_GET["keywords"] == "")) {

                $description = str_replace("****", $catName, $Lang->teacherbooksDescriptionT1);

            } else if (isset($_GET["category"]) && $_GET["category"] > 0 && (isset($_GET["keywords"]) && $_GET["keywords"] != "")) {

                $description = str_replace("****", $catName, $Lang->teacherbooksDescriptionT2);

                $description = str_replace("----", $_GET["keywords"], $description);

            } else if ((isset($_GET["keywords"]) && $_GET["keywords"] != "")) {

                $description = str_replace("----", $_GET["keywords"], $Lang->teacherbooksDescriptionT3);

            } else {

                $description = $Lang->teacherbooksDescription;

            }


            break;

        case "stories.php":


            $catName = getCatName("story", $_GET["category"]);

            global $seriesName;

            if (isset($_GET["category"]) && $_GET["category"] > 0 && ((!isset($_GET["series"])) || $_GET["series"] == '') && (!isset($_GET["keywords"]) || $_GET["keywords"] == "")) {

                $description = str_replace("****", $catName, $Lang->storyDescriptionT1);


            } else if (isset($_GET["series"]) && $_GET["series"] > 0 && ((!isset($_GET["category"])) || $_GET["category"] == '' || $_GET["category"] == 0) && ((!isset($_GET["keywords"]) || $_GET["keywords"] == ""))) {

                $description = str_replace("====", $seriesName, $Lang->storyDescriptionT2);

            } else if (isset($_GET["series"]) && $_GET["series"] > 0 && ((isset($_GET["category"])) && $_GET["category"] > 0) && ((!isset($_GET["keywords"]) || $_GET["keywords"] == ""))) {

                $description = str_replace("****", $catName, $Lang->storyDescriptionT3);

                $description = str_replace("====", $seriesName, $description);

            } else if (isset($_GET["category"]) && $_GET["category"] > 0 && ((!isset($_GET["series"])) || $_GET["series"] == '') && (isset($_GET["keywords"]) && $_GET["keywords"] != "")) {

                $description = str_replace("****", $catName, $Lang->storyDescriptionT4);

                $description = str_replace("----", $_GET["keywords"], $description);

            } else if (isset($_GET["series"]) && $_GET["series"] > 0 && ((!isset($_GET["category"])) || $_GET["category"] == '' || $_GET["category"] == 0) && ((isset($_GET["keywords"]) && $_GET["keywords"] != ""))) {

                $description = str_replace("====", $seriesName, $Lang->storyDescriptionT5);

                $description = str_replace("----", $_GET["keywords"], $description);

            } else if (isset($_GET["series"]) && $_GET["series"] > 0 && ((isset($_GET["category"])) && $_GET["category"] != '') && ((isset($_GET["keywords"]) && $_GET["keywords"] != ""))) {

                $description = str_replace("====", $seriesName, $Lang->storyDescriptionT6);

                $description = str_replace("----", $_GET["keywords"], $description);

                $description = str_replace("****", $catName, $description);

            } else if ((!isset($_GET["series"]) || $_GET["series"] == '') && ((!isset($_GET["category"])) || $_GET["category"] == '' || $_GET["category"] == 0) && ((isset($_GET["keywords"]) && $_GET["keywords"] != ""))) {

                $description = str_replace("----", $_GET["keywords"], $Lang->storyDescriptionT7);

            } else {

                $description = $Lang->storyDescription;

            }


            break;

        case "editors.php":

            $description = $Lang->editorDescription;

            break;

        case "products.php":

            $description = $Lang->productsDescription;

            break;

        case "services.php":

            $description = $Lang->servicesDescription;

            break;

        case "games.php":

            if (isset($_GET["category"]) && $_GET["category"] > 0 && (!isset($_GET["keywords"]) || $_GET["keywords"] == "")) {

                $description = str_replace("****", $catName, $Lang->gamesDescriptionT1);

            } else if (isset($_GET["category"]) && $_GET["category"] > 0 && (isset($_GET["keywords"]) && $_GET["keywords"] != "")) {

                $description = str_replace("****", $catName, $Lang->gamesDescriptionT2);

                $description = str_replace("----", $_GET["keywords"], $description);

            } else if ((isset($_GET["keywords"]) && $_GET["keywords"] != "")) {

                $description = str_replace("----", $_GET["keywords"], $Lang->gamesDescriptionT3);

            } else {

                $description = $Lang->gamesDescription;

            }

            break;

        case "contactus.php":

            $description = $Lang->contactusDescription;

            break;

        case "aboutus.php":

            $description = $Lang->aboutusDescription;

            break;

        case "sitemap.php":

            $description = $Lang->sitemapDescription;

            break;

        case "news.php":

            $description = $Lang->newsDescription;

            break;

        case "innernews.php":

            $description = strip_tags($row["news_" . $cat_code]);

            break;

        case "galleries.php":

            $description = $Lang->galleriesDescription;

            break;

        case "innergalleries.php":

            $description = strip_tags($row["description_" . $cat_code]);

            break;

        case "view_video.php":

            $description = strip_tags($row["description_" . $cat_code]);

            break;

        case "events.php":

            $description = $Lang->eventsDescription;

            break;

        case "innerevents.php":

            $description = substr(strip_tags($row["title_" . ucfirst($cat_code)]) . ", " . strip_tags($row["description_" . ucfirst($cat_code)]), 0, 150);

            break;

        case "applications.php":

            $description = $Lang->applicationsDescription;

            break;

        case "privacy.php":

            $description = $Lang->privacyDescription;

            break;

        case "terms_conditions.php":

            $description = $Lang->termsDescription;

            break;

        case "favorites.php":

            $description = $Lang->favoritesDescription;

            break;

        case "purchased.php":

            $description = $Lang->purchasedDescription;

            break;

        case "editaccount.php":

            $description = $Lang->editaccountDescription;

            break;

        case "changepass.php":

            $description = $Lang->changepassDescription;

            break;

        case "cart.php":

            $description = $Lang->cartDescription;

            break;

        case "benifits.php":

            $description = $Lang->benifitsDescription;

            break;

        case "features.php":

            $description = $Lang->featuresDescription;

            break;


        case "makemoney.php":

            $description = $Lang->makeMoneyDescription;

            break;

        case "ourpartners.php":

            $description = $Lang->ourpartnersDescription;

            break;

        case "whatoffer.php":

            $description = $Lang->whatofferDescription;

            break;

        case "worksheet.php":
            if (isset($_GET["category"]) && $_GET["category"] > 0 && (!isset($_GET["keywords"]) || $_GET["keywords"] == "")) {
                $description = str_replace("****", $catName, $Lang->worksheetsDescriptionT1);
            } else if (isset($_GET["category"]) && $_GET["category"] > 0 && (isset($_GET["keywords"]) && $_GET["keywords"] != "")) {
                $description = str_replace("****", $catName, $Lang->worksheetsDescriptionT2);
                $description = str_replace("----", $_GET["keywords"], $description);
            } else if ((isset($_GET["keywords"]) && $_GET["keywords"] != "")) {
                $description = str_replace("----", $_GET["keywords"], $Lang->worksheetsDescriptionT3);
            } else {
                $description = $Lang->worksheetsDescription;
            }
            break;
        case "interactive_worksheets.php":
            if (isset($_GET["category"]) && $_GET["category"] > 0 && (!isset($_GET["keywords"]) || $_GET["keywords"] == "")) {
                $description = str_replace("****", $catName, $Lang->InteractiveWorksheetsDescriptionT1);
            } else if (isset($_GET["category"]) && $_GET["category"] > 0 && (isset($_GET["keywords"]) && $_GET["keywords"] != "")) {
                $description = str_replace("****", $catName, $Lang->InteractiveWorksheetsDescriptionT2);
                $description = str_replace("----", $_GET["keywords"], $description);
            } else if ((isset($_GET["keywords"]) && $_GET["keywords"] != "")) {
                $description = str_replace("----", $_GET["keywords"], $Lang->InteractiveWorksheetsDescriptionT3);
            } else {
                $description = $Lang->InteractiveWorksheetsDescription;
            }
            break;

        case "audio.php":


            if (isset($_GET["category"]) && $_GET["category"] > 0 && (!isset($_GET["keywords"]) || $_GET["keywords"] == "")) {

                $description = str_replace("****", $catName, $Lang->audioDescriptionT1);

            } else if (isset($_GET["category"]) && $_GET["category"] > 0 && (isset($_GET["keywords"]) && $_GET["keywords"] != "")) {

                $description = str_replace("****", $catName, $Lang->audioDescriptionT2);

                $description = str_replace("----", $_GET["keywords"], $description);

            } else if ((isset($_GET["keywords"]) && $_GET["keywords"] != "")) {

                $description = str_replace("----", $_GET["keywords"], $Lang->audioDescriptionT3);

            } else {

                $description = $Lang->audioDescription;

            }

            break;

        case "video.php":


            if (isset($_GET["category"]) && $_GET["category"] > 0 && (!isset($_GET["keywords"]) || $_GET["keywords"] == "")) {

                $description = str_replace("****", $catName, $Lang->videoDescriptionT1);

            } else if (isset($_GET["category"]) && $_GET["category"] > 0 && (isset($_GET["keywords"]) && $_GET["keywords"] != "")) {

                $description = str_replace("****", $catName, $Lang->videoDescriptionT2);

                $description = str_replace("----", $_GET["keywords"], $description);

            } else if ((isset($_GET["keywords"]) && $_GET["keywords"] != "")) {

                $description = str_replace("----", $_GET["keywords"], $Lang->videoDescriptionT3);

            } else {

                $description = $Lang->videoDescription;

            }

            break;


        case "view.php":

            switch ($_GET["type"]) {

                case "book":

                    $description = strip_tags($row["description_" . $cat_code]);

                    break;

                case "story":

                    $description = strip_tags($row["description_" . $cat_code]);

                    break;

                case "games":
                case "playgame":

                case "worksheet":
                case "interactive-worksheets":
                case "playinteractiveworksheets":
                case "video":

                case "audio":

                    $description = strip_tags($row["description_" . $cat_code]);

                    break;

                default:

                    $description = $Lang->DarAlManhalPublishers;

            }

            break;

        default:

            $description = $Lang->DarAlManhalPublishers;

    }

    $description = str_replace('"', "'", $description);

    return $description;

}


function getPageThumb($page)

{

    global $row;

    switch ($page) {

        case "innernews.php":

            $thumb = SITE_URL . $row['image'];

            break;

        case "innerevents.php":

            $thumb = SITE_URL . $row['thumb'];

            break;

        case "innergalleries.php":

            $thumb = SITE_URL . 'platform/galleries/' . $_GET['id'] . "/thumbnail.jpg";

            break;

        case "view.php":

            global $row;

            switch ($_GET["type"]) {

                case "book":

                    $thumb = SITE_URL . 'platform/books/' . $row['bookid'] . '/cover.jpg';

                    break;

                case "story":

                    $thumb = SITE_URL . 'platform/stories/' . $row['seriesid'] . '/story/' . $row['storyid'] . '/images/pic.jpg';

                    break;

                case "games":
                case "playgame":
                case "video":

                case "audio":

                case "worksheet":
                case "interactive-worksheets":
                case "playinteractiveworksheets":

                    $thumb = SITE_URL . 'platform/media/' . $row['id'] . '/thumbnail_small.jpg';

                    break;

                default:

                    $thumb = SITE_URL . "images/logo.png";

            }

            break;

        default:

            $thumb = SITE_URL . "images/logo.png";

    }

    $thumb .= "?2";

    return $thumb;

}


function getPageKeyWords($page)

{

    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }

    global $session_lang;

    global $Lang;

    global $row;

    $L = $lang_code;

    switch ($page) {

        case "index.php":

            $Keywords = $Lang->indexKeywords;

            break;

        case "books.php":

            $Keywords = $Lang->booksKeywords;

            break;

        case "stories.php":

            $Keywords = $Lang->storyKeywords;

            break;

        case "editors.php":

            $Keywords = $Lang->editorKeywords;

            break;

        case "products.php":

            $Keywords = $Lang->productsKeywords;

            break;

        case "services.php":

            $Keywords = $Lang->servicesKeywords;

            break;

        case "games.php":

            $Keywords = $Lang->gamesKeywords;

            break;

        case "contactus.php":

            $Keywords = $Lang->contactusKeywords;

            break;

        case "aboutus.php":

            $Keywords = $Lang->aboutusKeywords;

            break;

        case "sitemap.php":

            $Keywords = $Lang->sitemapKeywords;

            break;

        case "news.php":

            $Keywords = $Lang->newsKeywords;

            break;

        case "innernews.php":

            $Keywords = $Lang->News . "," . $Lang->newsKeywords . "," . $row["title_" . $L];

            break;

        case "galleries.php":

            $Keywords = $Lang->galleriesKeywords;

            break;

        case "innergalleries.php":

            $Keywords = $Lang->Galleries . "," . $Lang->galleriesKeywords . "," . $row["title_" . $L];

            break;

        case "events.php":

            $Keywords = $Lang->eventsKeywords;

            break;

        case "innerevents.php":

            $Keywords = $Lang->eventsKeywords . "," . $Lang->eventsDetailsKeywords . "," . $row["title_" . $session_lang];

            break;

        case "applications.php":

            $Keywords = $Lang->applicationsKeywords;

            break;

        case "privacy.php":

            $Keywords = $Lang->privacyKeywords;

            break;

        case "terms_conditions.php":

            $Keywords = $Lang->termsKeywords;

            break;

        case "favorites.php":

            $Keywords = $Lang->favoritesKeywords;

            break;

        case "purchased.php":

            $Keywords = $Lang->purchasedKeywords;

            break;

        case "editaccount.php":

            $Keywords = $Lang->editaccountKeywords;

            break;

        case "changepass.php":

            $Keywords = $Lang->changepassKeywords;

            break;

        case "cart.php":

            $Keywords = $Lang->cartKeywords;

            break;

        case "benifits.php":

            $Keywords = $Lang->benifitsKeywords;

            break;

        case "features.php":

            $Keywords = $Lang->featuresKeywords;

            break;

        case "makemoney.php":

            $Keywords = $Lang->makeMoneyKeywords;

            break;

        case "ourpartners.php":

            $Keywords = $Lang->ourpartnersKeywords;

            break;

        case "whatoffer.php":

            $Keywords = $Lang->whatofferKeywords;

            break;

        case "worksheet.php":
        case "interactive_worksheets.php":

            $Keywords = $Lang->worksheetKeywords;

            break;

        case "audio.php":

            $Keywords = $Lang->audioKeywords;

            break;

        case "video.php":

            $Keywords = $Lang->videoKeywords;

            break;

        case "view.php":

            switch ($_GET["type"]) {

                case "book":

                    $Keywords = $Lang->Book . "," . $Lang->ElectronicBook . "," . $Lang->InteractiveBook . "," . $Lang->Enrichmentbook . "," . $row["name"] . "," . $row["author_" . $cat_code];

                    break;

                case "story":

                    $Keywords = $Lang->Story . "," . $Lang->ElectronicStory . "," . $Lang->InteractiveStory . "," . $Lang->EnrichmentStory . "," . $Lang->OnlineStory . "," . $row["title"] . "," . $row["author_" . $cat_code];

                    break;

                case "games":
                case "playgame":

                    $Keywords = $Lang->Game . "," . $Lang->OnlineGame . "," . $Lang->InteractiveGame . "," . $row["title_" . $L];

                    break;

                case "worksheet":
                case "interactive-worksheets":
                case "playinteractiveworksheets":
                    $Keywords = $Lang->Worksheet . "," . $Lang->OnlineWorksheet . "," . $Lang->InteractiveWorksheet . "," . $row["title_" . $L];

                    break;

                case "video":

                    $Keywords = $Lang->video . "," . $Lang->Onlinevideo . "," . $Lang->Interactivevideo . "," . $row["title_" . $L];

                    break;

                case "audio":

                    $Keywords = $Lang->audio . "," . $Lang->Onlineaudio . "," . $Lang->Interactiveaudio . "," . $row["title_" . $L];

                    break;

                default:

                    $Keywords = $Lang->DarAlManhalPublishers;

            }

            break;

        default:

            $Keywords = $Lang->DarAlManhalPublishers;

    }

    return $Keywords;

}


function getPageTitle($page)

{

    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    global $Lang;

    global $row;

    global $catName;

    switch ($page) {

        case "index.php":

            $title = $Lang->indexTitle;

            break;

        case "books.php":
            if(isset($_GET["book_type"]) && $_GET["book_type"]=="electronic") {
                if (isset($_GET["category"]) && $_GET["category"] != "") {
                    if ($lang_code == "ar") {
                        $title = $Lang->BooksT . " " . $catName." | ".$Lang->Ebooks." ".$Lang->DarAlmanhal;
                    } else {
                        $title = $catName . " " . $Lang->BooksT." | ".$Lang->DarAlmanhal." ".$Lang->Ebooks;
                    }
                } else {
                    $title = $Lang->EbooksTitle;
                }
            }else{
                if (isset($_GET["category"]) && $_GET["category"] != "") {
                    if ($lang_code == "ar") {
                        $title = $Lang->BooksT . " " . $catName." | ".$Lang->Booksh1." ".$Lang->DarAlmanhal;
                    } else {
                        $title = $catName . " " . $Lang->BooksT." | ".$Lang->DarAlmanhal." ".$Lang->Booksh1;
                    }
                } else {
                    $title = $Lang->booksTitle;
                }
            }

            break;
        case "teacher_books.php":
            if (isset($_GET["category"]) && $_GET["category"] != "") {
                if ($lang_code == "ar") {
                    $title = $Lang->teacherBooksT . " " . $catName;
                } else {
                    $title = $catName . " " . $Lang->teacherBooksT;
                }
            } else {
                $title = $Lang->teacherbooksTitle . " | " . $Lang->DarAlManhalPublishers;
            }
            break;
        case "stories.php":
            if (isset($_GET["category"]) && $_GET["category"] != "") {
                if ($lang_code == "ar") {
                    $title = $catName . " | " . $Lang->KidsStories;
                } else {
                    $title = $catName . " | " . $Lang->KidsStories;
                }
            } else {
                $title = $Lang->storyTitle . " | " . $Lang->DarAlManhalPublishers;
            }
            break;
        case "worksheet.php":
            if (isset($_GET["category"]) && $_GET["category"] != "") {
                if ($lang_code == "ar") {
                    $title = $Lang->WorksheetsT . " " . $catName . " | " . $Lang->DarAlmanhalWorksheet;
                } else {
                    $title = $catName . " " . $Lang->WorksheetsT . " | " . $Lang->DarAlmanhalWorksheet;
                }
            } else {
                $title = $Lang->WorksheetsT . " | " . $Lang->DarAlManhalPublishers;
            }
            break;
        case "interactive_worksheets.php":

            if (isset($_GET["category"]) && $_GET["category"] != "") {
                if ($lang_code == "ar") {
                    $title = $Lang->InteractiveWorksheetsT . " " . $catName . " | " . $Lang->DarAlmanhalIWorksheet;
                } else {
                    $title = $catName . " " . $Lang->InteractiveWorksheetsT . " | " . $Lang->DarAlmanhalIWorksheet;
                }
            } else {
                $title = $Lang->InteractiveWorksheetsT . " | " . $Lang->DarAlManhalPublishers;
            }

            break;
        case "audio.php":

            if (isset($_GET["category"]) && $_GET["category"] != "") {


                if ($lang_code == "ar") {

                    $title = $Lang->AudiosT . " " . $catName . " | " . $Lang->DarAlmanhalAudio;

                } else {

                    $title = $catName . " " . $Lang->AudiosT . " | " . $Lang->DarAlmanhalAudio;

                }

            } else {

                $title = $Lang->AudiosT . " | " . $Lang->DarAlManhalPublishers;;

            }

            break;

        case "video.php":

            if (isset($_GET["category"]) && $_GET["category"] != "") {


                if ($lang_code == "ar") {

                    $title = $Lang->VideoT . " " . $catName . " | " . $Lang->DarAlmanhalVideo;

                } else {

                    $title = $catName . " " . $Lang->VideoT . " | " . $Lang->DarAlmanhalVideo;

                }

            } else {

                $title = $Lang->VideoT . " | " . $Lang->DarAlManhalPublishers;;

            }

            break;


        case "editors.php":

            $title = $Lang->editorTitle;

            break;

        case "products.php":

            $title = $Lang->productsTitle;

            break;

        case "services.php":

            $title = $Lang->servicesTitle;

            break;

        case "games.php":

            $title = $Lang->gamesTitle . " | " . $Lang->DarAlManhalPublishers;;

            break;

        case "contactus.php":

            $title = $Lang->contactusTitle;

            break;

        case "aboutus.php":

            $title = $Lang->aboutusTitle;

            break;

        case "sitemap.php":

            $title = $Lang->sitemapTitle;

            break;

        case "news.php":

            $title = $Lang->newsTitle;

            break;

        case "innernews.php":

            $title = $row["title_" . $cat_code];

            break;

        case "galleries.php":

            $title = $Lang->galleriesTitle;

            break;

        case "innergalleries.php":

            $title = $row["title_" . $cat_code];

            break;

        case "events.php":

            $title = $Lang->eventsTitle;

            break;

        case "innerevents.php":

            $title = $row["title_" . ucfirst($cat_code)];

            break;

        case "applications.php":

            $title = $Lang->applicationsTitle;

            break;

        case "privacy.php":

            $title = $Lang->privacyTitle;

            break;

        case "terms_conditions.php":

            $title = $Lang->termsTitle;

            break;

        case "favorites.php":

            $title = $Lang->favoritesTitle;

            break;

        case "purchased.php":

            $title = $Lang->purchasedTitle;

            break;

        case "editaccount.php":

            $title = $Lang->editaccountTitle;

            break;

        case "changepass.php":

            $title = $Lang->changepassTitle;

            break;

        case "cart.php":

            $title = $Lang->cartTitle;

            break;

        case "benifits.php":

            $title = $Lang->benifitsTitle;

            break;

        case "features.php":

            $title = $Lang->featuresTitle;

            break;
        case "makemoney.php":
            $title = $Lang->makeMoneyTitle;
            break;
        case "ourpartners.php":
            $title = $Lang->ourpartnersTitle;
            break;
        case "whatoffer.php":
            $title = $Lang->whatofferTitle;
            break;
        case "bookseditor.php":
            $title = $Lang->bookEditor;
            break;
        case "storieseditor.php":
            $title = $Lang->StoriesEditor;
            break;
        case "interactivestorieseditors.php":
            $title = $Lang->InteractiveStoriesBuilder;
            break;
        case "interactive-books-info.php":
            $title = $Lang->interactivebooksinfo;
            break;
        case "interactives-stories-info.php":
            case "interactive-stories-info.php":

            $title = $Lang->interactivestoriesinfo;
            break;
        case "books-info.php":
            $title = $Lang->booksinfo;
            break;
        case "electronic-books-info.php":
            $title = $Lang->electronicbooksinfo;
            break;
        case "stories-info.php":
            $title = $Lang->storiesinfo;
            break;
        case "electronic-stories-info.php":
            $title = $Lang->electronicstoriesinfo;
            break;
        case "educational-games-info.php":
            $title = $Lang->educationalgamesinfo;
            break;
        case "educational-tools-info.php":
            $title = $Lang->educationaltoolsinfo;
            break;
        case "application-info.php":
            $title = $Lang->applicationinfo;
            break;
        case "childrens-furniture-info.php":
            $title = $Lang->childrensfurnitureinfo;
            break;
        case "worksheets-info.php":
            $title = $Lang->worksheetsinfo;
            break;
        case "interactive-worksheets-info.php":
            $title = $Lang->interactiveworksheetsinfo;
            break;
        case "sound-info.php":
            $title = $Lang->soundinfo;
            break;
        case "video-info.php":
            $title = $Lang->videoinfo;
            break;
        case "teachers-guides-info.php":
            $title = $Lang->teachersguidesinfo;
            break;
        case "coloring-worksheet-info.php":
            $title = $Lang->coloringworksheetinfo;
            break;
        case "exercises-info.php":
            $title = $Lang->exercisesinfo;
            break;
        case "educationalinquiries.php":
            $title = $Lang->Educationalinquiries;
            break;
        case "subscribe.php":
            $title = $Lang->subscribe;
            break;
        case "subscribe-tutorial.php":
            $title = $Lang->subscribe;
            break;
        case "faq.php":
            $title = $Lang->FAQ;
            break;
        case "careers.php":
            $title = $Lang->careers;
            break;
            case "quizeditor.php":
                case "quizeditor.php":
            $title = $Lang->QuizCreator;
            break;
            case "exercises.php":
            $title = $Lang->exercises;
            break;
            case "furniture.php":
            $title = $Lang->furniture;
            break;

        case "view.php":
            global $row;
            switch ($_GET["type"]) {
                case "book":
                    if(strtolower($row["language"])=="ar"){
                       if($lang_code=="ar"){
                           $title = "كتاب ".$row["name"] . " | ".$Lang->Booksh1." ".$row["name_" . $cat_code];
                       }else{
                           $title = "كتاب ".$row["name"] . " | ".$row["name_" . $cat_code]." ".$Lang->Booksh1;
                       }
                    }else{
                        if($lang_code=="ar"){
                            $title = $row["name"]." book". " | ".$Lang->Booksh1." ".$row["name_" . $cat_code];
                        }else{
                            $title = $row["name"]." book". " | ".$row["name_" . $cat_code]." ".$Lang->Booksh1;
                        }
                    }
                    //$title = $row["name"] . " | " . $row["name_" . $lang_code];
                    break;
                case "teacher_book":
                    $title = $row["name"] . " | " . $row["name_" . $cat_code];
                    break;
                case "story":
                    $title = $row["title"] . " | " . $row["name_" . $cat_code];
                    break;
                case "games":
                case "playgame":
                    $title = $row["title_" . $cat_code] . " | " . $row["name_" . $cat_code] . "  " . $Lang->gamesTitle;
                    break;
                case "worksheet":
                case "playworksheet":
                    $title = $row["title_" . $cat_code] . " | " . $row["name_" . $cat_code] . "  " . $Lang->WorksheetsT;
                    break;
                case "interactive-worksheets":
                case "playinteractiveworksheets":
                    $title = $row["title_" . $cat_code] . " | " . $row["name_" . $cat_code] . "  " . $Lang->InteractiveWorksheetsT;
                    break;
                case "video":
                    $title = $row["title_" . $cat_code] . " | " . $row["name_" . $cat_code] . "  " . $Lang->VideoT;
                    break;
                case "audio":
                    $title = $row["title_" . $cat_code] . " | " . $row["name_" . $cat_code] . "  " . $Lang->AudiosT;
                    break;
                default:
                    // $title = $Lang->DarAlManhalPublishers;
            }
            break;
        default:
            $title = $Lang->DarAlManhalPublishers;
    }

    return $title;

}

function sendPaymentEmail($id)
{
    global $Lang;
    global $con;
    $sql = "SELECT `payments_books`.*,`books`.* FROM `payments_books` INNER JOIN `books` ON `payments_books`.`bookid`=`books`.`bookid` WHERE `payments_books`.`itemtype`='book' AND `payments_books`.`paymentid`=" . $id;
    $result = $con->query($sql);
    $table = "";
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $i++;
        if ($i % 2 === 0) {
            $class = "bg-row";
        } else {
            $class = "";
        }
        $table .= '
        <div  class="display-table-row' . $class . '" style=" display: block; overflow: hidden; height: 40px; line-height: 40px; font-size: 14px;">
                    <div class="display-table-cell number" style="vertical-align: middle; text-align: center; float: left; font-size: 12px; display: inline-block; overflow: hidden; width: 3%; ">' . $i . '</div>
                    <div class="display-table-cell ISBN " style="vertical-align: middle; text-align: center; float: left; font-size: 12px;  display: inline-block; overflow: hidden; width: 17%; float: left;">' . $row["isbn"] . '</div>
                    <div class="display-table-cell Quantity1" style="vertical-align: middle; text-align: center; float: left; font-size: 12px; display: inline-block; overflow: hidden; width: 8%;">' . $row["quantity"] . '</div>
                    <div class="display-table-cell book-title2" style="vertical-align: middle; text-align: center; float: left; font-size: 12px;display: inline-block; overflow: hidden; width: 23%; float: left;">' . $row["name"] . '</div>
                    <div class="display-table-cell Quantity1" style="vertical-align: middle; text-align: center; float: left; font-size: 12px; display: inline-block; overflow: hidden; width: 8%;">' . $row["book_price"] . '</div>
                    <div class="display-table-cell Quantity1" style="vertical-align: middle; text-align: center; float: left; font-size: 12px; display: inline-block; overflow: hidden; width: 8%;">0</div>
                    <div class="display-table-cell Quantity1" style="vertical-align: middle; text-align: center; float: left; font-size: 12px; display: inline-block; overflow: hidden; width: 8%;">0</div>
                    <div class="display-table-cell WEIGHT1" style="vertical-align: middle; text-align: center; float: left; font-size: 12px;display: inline-block; overflow: hidden; width: 10%; float: left;" >' . $row["totalprice"] . '</div>
                </div>';
    }

    $sql = "SELECT `payments_books`.*,`story`.* FROM `payments_books` INNER JOIN `story` ON `payments_books`.`bookid`=`story`.`storyid` WHERE `payments_books`.`itemtype`='story' AND `payments_books`.`paymentid`=" . $id;
    $result = $con->query($sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $i++;
        if ($i % 2 === 0) {
            $class = "bg-row";
        } else {
            $class = "";
        }
        $table .= '
        <div  class="display-table-row' . $class . '" style=" display: block; overflow: hidden; height: 40px; line-height: 40px; font-size: 14px;">
                    <div class="display-table-cell number" style="vertical-align: middle; text-align: center; float: left; font-size: 12px; display: inline-block; overflow: hidden; width: 3%; ">' . $i . '</div>
                    <div class="display-table-cell ISBN " style="vertical-align: middle; text-align: center; float: left; font-size: 12px;  display: inline-block; overflow: hidden; width: 17%; float: left;">' . $row["isbn"] . '</div>
                    <div class="display-table-cell Quantity1" style="vertical-align: middle; text-align: center; float: left; font-size: 12px; display: inline-block; overflow: hidden; width: 8%;">' . $row["quantity"] . '</div>
                    <div class="display-table-cell book-title2" style="vertical-align: middle; text-align: center; float: left; font-size: 12px;display: inline-block; overflow: hidden; width: 23%; float: left;">' . $row["title"] . '</div>
                    <div class="display-table-cell Quantity1" style="vertical-align: middle; text-align: center; float: left; font-size: 12px; display: inline-block; overflow: hidden; width: 8%;">' . $row["book_price"] . '</div>
                    <div class="display-table-cell Quantity1" style="vertical-align: middle; text-align: center; float: left; font-size: 12px; display: inline-block; overflow: hidden; width: 8%;">0</div>
                    <div class="display-table-cell Quantity1" style="vertical-align: middle; text-align: center; float: left; font-size: 12px; display: inline-block; overflow: hidden; width: 8%;">0</div>
                    <div class="display-table-cell WEIGHT1" style="vertical-align: middle; text-align: center; float: left; font-size: 12px;display: inline-block; overflow: hidden; width: 10%; float: left;" >' . $row["totalprice"] . '</div>
                </div>';
    }


    $message = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/templates/shipping_" . $_SESSION["lang"] . ".html");
    $logo = SITE_URL . "images/logo.png";
    $message = str_replace("#Manhal_logo#", $logo, $message);
    $message = str_replace("#Manhal_User_fullname", $_SESSION["shipping_info"]["shipping_fullname"], $message);
    $message = str_replace("#Manhal_Products_Details", $table, $message);
    $message = str_replace("#Manhal_Total", $_SESSION["shipping_info"]["total"], $message);
    $message = str_replace("#Manhal_Discount", 0, $message);
    $message = str_replace("#Manhal_Sipping_Cost", $_SESSION["shipping_info"]["Shipping"], $message);
    $message = str_replace("#Manhal_COD", $_SESSION["shipping_info"]["cod"], $message);
    $message = str_replace("#Manhal_Grand_Total", $_SESSION["shipping_info"]["GrandTotal"], $message);
    $message = str_replace("#Manhal_Shiping_Name", $_SESSION["shipping_info"]["shipping_fullname"], $message);
    $message = str_replace("#Manhal_Shiping_Country", $_SESSION["shipping_info"]["shipping_country"], $message);
    $message = str_replace("#Manhal_Shiping_City", $_SESSION["shipping_info"]["shipping_city"], $message);
    $message = str_replace("#Manhal_Shiping_State", $_SESSION["shipping_info"]["shipping_state"], $message);
    $message = str_replace("#Manhal_Shiping_Address1", $_SESSION["shipping_info"]["shipping_address1"], $message);
    $message = str_replace("#Manhal_Shiping_Address2", $_SESSION["shipping_info"]["shipping_address2"], $message);
    $message = str_replace("#Manhal_Shiping_Phone", $_SESSION["shipping_info"]["shipping_phone"], $message);
    $message = str_replace("#Manhal_Shiping_Mobile", $_SESSION["shipping_info"]["shipping_mobile"], $message);
    $message = str_replace("#Manhal_Shiping_Email", $_SESSION["shipping_info"]["cart_email"], $message);
    $message = str_replace("#Manhal_Shiping_Postcode", $_SESSION["shipping_info"]["shipping_post"], $message);
    file_put_contents("emailp.html", $message);
    $to = $_SESSION["shipping_info"]["cart_email"];
    $subject = 'manhal.com - ' . $Lang["Purchase_Details"];
    $headers = "From: " . strip_tags(WEBMASTER_EMAIL) . "\r\n";
    $headers .= "Reply-To: " . strip_tags(WEBMASTER_EMAIL) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail($to, $subject, $message, $headers);
}

function savePaymentToDB($data)
{
    global $session_lang;
    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    if (isset($_SESSION["shipping_info"]["payment_option"]) && $_SESSION["shipping_info"]["payment_option"] == "cod") {
        $_SESSION["payment"]["shipping"] = $_SESSION["shipping_info"]["Shipping"];
        $status = 0;
        if($_SESSION["shipping_info"]["shipping_country_code"]=="JO"){
            $shipping = "Manhal";
        }else{
            $shipping = "ARAMEX";
        }
    }elseif($_SESSION["shipping_info"]["shipping_country_code"]=="JO"){
        $_SESSION["payment"]["shipping"] = $_SESSION["shipping_info"]["Shipping"];
        $status = 1;
        $shipping = "ARAMEX";
    } else {
        $_SESSION["payment"]["shipping"] = $_SESSION["shipping_info"]["Shipping"];
        $status = 1;
        $shipping = "DHL";
    }
    if ($_SESSION["payment"]["shipping"] == 0) {
        $shipping = "NONE";
    }

    global $con;

    $sql = "INSERT INTO `payments`(`paymentid`, `userid`, `total_price`, `status`, `payment_date`, `transaction`, `shipping`, `manhal_ref`, `payment_type`, `RecieverCompanyName`, `RecieverAttention`, `Address1`,`Address2`,

 `City`, `StateProvince`, `Postcode`, `Country`, `Weight`,`Phone`, `Contents`, `DeclaredValue`, `exported`, `shippingprice`, `Countrycode`, `telephone`,  `billing_fullname`,

 `billing_email`,`billing_mobile`, `billing_telephone`,`billing_country`, `billing_city`, `billing_state`, `billing_zipcode`, `billing_address1`, `billing_address2`, `products_price`,`tax`,`cod`)

 VALUES (''," . $_SESSION["user"]["userid"] . "," . $_SESSION["shipping_info"]["GrandTotal"] . "," . $status . ",NOW(),'" . $data . "','" . $shipping . "','0','" . $_SESSION["shipping_info"]["payment_option"] . "',

 '" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["shipping_fullname"]) . "','" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["shipping_fullname"]) . "',

 '" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["shipping_address1"]) . "','" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["shipping_address2"]) . "',

 '" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["shipping_city"]) . "','" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["shipping_state"]) . "',

 '" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["shipping_post"]) . "','" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["shipping_country"]) . "', " . $_SESSION["shipping_info"]["weight"] . ",

 '" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["shipping_mobile"]) . "','" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["contents"]) . "',

 '" . $_SESSION["shipping_info"]["Shipping"] . "',0,'" . $_SESSION["shipping_info"]["Shipping"] . "','" . $_SESSION["shipping_info"]["shipping_country_code"] . "','" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["shipping_phone"]) . "',

 '" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["cart_fullname"]) . "',

 '" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["cart_email"]) . "','" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["cart_mobile"]) . "','" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["cart_phone"]) . "',

'" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["cart_country"]) . "','" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["cart_city"]) . "',

 '" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["cart_state"]) . "','" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["cart_post"]) . "','" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["cart_address1"]) . "',

 '" . mysqli_real_escape_string($con, $_SESSION["shipping_info"]["cart_address2"]) . "'," . $_SESSION["shipping_info"]["total"] . "," . $_SESSION["shipping_info"]["tax"] . "," . $_SESSION["shipping_info"]["cod"] . ")";


    //echo $sql;$_SESSION["shipping_info"]["shipping"]

    if ($con->query($sql)) {

        $paymentid = mysqli_insert_id($con);

        $sql = "UPDATE `payments` SET `Productcode`='" . $paymentid . "' WHERE `paymentid`=" . $paymentid;

        $con->query($sql);

        $sql = "UPDATE `payments` SET `manhal_ref`='MP" . $paymentid . "' WHERE `paymentid`=" . $paymentid;

        $con->query($sql);


        foreach ($_SESSION["items"] as $item) {


            $types = explode("_", $item["id"]);

            $sql = "INSERT INTO `payments_books`(`pbid`, `paymentid`, `bookid`, `quantity`, `book_price`, `totalprice`,`type`,`itemtype`) VALUES ('',$paymentid," . $types[1] . "," . $item["quantity"] . "," . $item["price"] . "," . $item["quantity"] * $item["price"] . "," . $types[2] . ",'" . $types[0] . "')";

            $con->query($sql);


            if ($types[0] == "book") {
                $sql = "UPDATE `books` SET `sales`=`sales`+1 WHERE `bookid`=" . $types[0];
                generateActivationCode("book",$types[1],$item["quantity"], $types[2]);
                $con->query($sql);

            } elseif ($types[0] == "story") {

                $sql = "UPDATE `story` SET `sales_count`=`sales_count`+1 WHERE `storyid`=" . $types[1];
                $con->query($sql);

            } elseif ($types[0] == "toy") {
                $sql = "UPDATE `products` SET `sales_count`=`sales_count`+1 WHERE `productid`=" . $types[1];
                $con->query($sql);
            }

        }

        sendPaymentEmail($paymentid);
        $_SESSION["checkout"] = "success";

        header("location:" . SITE_URL . $lang_code . "/check-out");

    } else {

        //  echo $sql;

        echo "Unexpected error occured Err: 230217045055";

        return false;

    }

    setcookie("items", json_encode([]), time() + COOKIE_EXPIRE, "/");

    unset($_COOKIE['items']);

}

function generateActivationCode($type,$refID,$quantity,$itemType){
    global $con;
    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`,`itemtype`)
 VALUES ('',DATE_SUB(CURDATE(), INTERVAL 1 DAY),DATE_ADD(CURDATE(), INTERVAL 1 YEAR) ,'".$type."',".$refID.",".$_SESSION["user"]["userid"].",".$quantity.",'".$_SESSION["user"]["email"]."',CURDATE(),1,$itemType)";
    $con->query($sql);

    $id=mysqli_insert_id($con);

    $code = substr($id, -4);
    $code=str_pad($code, 4, '0', STR_PAD_LEFT);
    $month=date("m");
    $year=date("y");
    $digits = 3;
    $code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
    $sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
    $con->query($sql);
}

function savePaymentsubscribeToDB($data)
{
    global $session_lang;
    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    global $con;

    $ref = "subscribe_" . uniqid();
    $sql = "INSERT INTO `payments`(`paymentid`, `userid`, `total_price`, `status`, `payment_date`, `transaction`, `manhal_ref`, `payment_type`, `exported`, `products_price`)
 VALUES (''," . $_SESSION["user"]["userid"] . "," . $_SESSION["subscribe_data"]["total"] . ",1,NOW(),'" . $data . "','" . $ref . "','" . $_SESSION["shipping_info"]["payment_option"] . "',1," . $_SESSION["subscribe_data"]["total"] . ")";

    //echo $sql;$_SESSION["shipping_info"]["shipping"]
    if ($con->query($sql)) {
        $paymentid = mysqli_insert_id($con);
        inserPaymentSubscribe($paymentid);
        $_SESSION["checkout"] = "success";

        $sql = "UPDATE users set `permession`=10 WHERE `userid`=" . $_SESSION["user"]["userid"];
        $con->query($sql);
        $_SESSION["user"]["permession"] = 10;

        header("location:" . SITE_URL . $lang_code . "/check-out?success=1&type=subscribe&subscribetype=" . $_SESSION["subscribe_data"]["type"]);
    } else {
        file_put_contents("error_payments.txt", $sql);
        //  echo $sql;
        echo "Unexpected error occured Err: 2302170454";
        return false;
    }
}

function savePaymentInvoiceToDB($data){
    global $session_lang;
    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    global $con;

    if (isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != "") {
        $userid = $_SESSION["user"]["userid"];
    } else {
        $userid = -1;
    }

    $ref = "invoice_" . uniqid();
    $sql = "INSERT INTO `payments`(`paymentid`, `userid`, `total_price`, `status`, `payment_date`, `transaction`, `manhal_ref`, `payment_type`, `exported`, `products_price`,`pay_date`)
 VALUES (''," . $userid . "," . $_SESSION["invoice"]["totalprice"] . ",1,NOW(),'" . $data . "','" . $ref . "','" . $_SESSION["invoice"]["payment_option"] . "',1," . $_SESSION["invoice"]["totalprice"] . ",NOW())";

    //echo $sql;$_SESSION["shipping_info"]["shipping"]
    if ($con->query($sql)) {
        $paymentid = mysqli_insert_id($con);
        $sql = "UPDATE `invoices` SET `status`=1,`pay_date`=NOW(),`paymentid`=" . $paymentid . " WHERE `id`=" . $_SESSION["invoice"]["id"];
        $con->query($sql);
        $_SESSION["checkout"] = "success";
        header("location:" . SITE_URL . $lang_code . "/check-out?success=1&type=invoice");
    } else {
        file_put_contents("error_payments.txt", $sql);
        //  echo $sql;
        echo "Unexpected error occured Err: 2302170454";
        return false;
    }
}

function inserPaymentSubscribe($paymentid)
{
    global $con;


    if ($_SESSION["subscribe_data"]["subscribe"] == "Monthly") {
        $qtyDays = $_SESSION["subscribe_data"]["months_years"] * 30;
        $expire = date('Y-m-d', strtotime("+" . $qtyDays . " days"));
    } else {
        $qtyDays = $_SESSION["subscribe_data"]["months_years"] * 365;
        $expire = date('Y-m-d', strtotime("+" . $qtyDays . " days"));
    }
    $teachers = floor($_SESSION["subscribe_data"]["usersAccounts"] / 10);

    if (isset($_SESSION["subscribe_type"]) && $_SESSION["subscribe_type"] == "renew") {
        $sql = "SELECT `payments`.*,`payment_subscribe`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`userid`=" . $_SESSION['user']['userid'] . " ORDER BY `payments`.`paymentid` DESC";
        $result = $con->query($sql);
        $oldsubscribe = mysqli_fetch_assoc($result);

        if ($_SESSION["subscribe_data"]["subscribe"] == "Monthly") {
            $qtyDays = $_SESSION["subscribe_data"]["months_years"] * 30;
            $expire = date('Y-m-d', strtotime("+" . $qtyDays . " days", strtotime($oldsubscribe["expire_date"])));
        } else {
            $qtyDays = $_SESSION["subscribe_data"]["months_years"] * 365;
            $expire = date('Y-m-d', strtotime("+" . $qtyDays . " days", strtotime($oldsubscribe["expire_date"])));
        }
        $sql = "UPDATE `payment_subscribe` SET `paymentid`=" . $paymentid . ",`price`=" . $_SESSION["subscribe_data"]["cost"] . ",`total_price`=`total_price`+" . $_SESSION["subscribe_data"]["GrandTotal"] . ",
        `subscribe_type`='" . $_SESSION["subscribe_data"]["subscribe"] . "',`expire_date`='" . $expire . "',`status`=1,`qty`=" . $_SESSION["subscribe_data"]["months_years"] . " WHERE `psid`=" . $oldsubscribe["psid"];
        $con->query($sql);

    } elseif (isset($_SESSION["subscribe_type"]) && $_SESSION["subscribe_type"] == "upgrade") {
        $sql = "SELECT `payments`.*,`payment_subscribe`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`userid`=" . $_SESSION['user']['userid'] . " ORDER BY `payments`.`paymentid` DESC";
        $result = $con->query($sql);
        $oldsubscribe = mysqli_fetch_assoc($result);

        $sql = "UPDATE `payment_subscribe` SET `paymentid`=" . $paymentid . ",`accounts_number`=" . $_SESSION["subscribe_data"]["usersAccounts"] . ",`price`=" . $_SESSION["subscribe_data"]["cost"] . ",
        `total_price`=`total_price`+" . $_SESSION["subscribe_data"]["GrandTotal"] . ",`subscribe_type`='" . $_SESSION["subscribe_data"]["subscribe"] . "',`teachers_allowed`=" . $teachers . ",
        `students_allowed`=" . $_SESSION["subscribe_data"]["usersAccounts"] . ",`status`=1,`qty`=`qty`+" . $_SESSION["subscribe_data"]["months_years"] . " WHERE `psid`=" . $oldsubscribe["psid"];
        $con->query($sql);
    } else {
        $sql = "INSERT INTO `payment_subscribe`(`psid`, `paymentid`, `userid`, `accounts_number`, `price`, `total_price`, `subscribe_type`, `teachers_allowed`, `students_allowed`, `teachers_active`, `students_active`,
                `users_code`,`teachers_code`, `expire_date`,`subscribe_usertype`,`status`,`qty`)
                VALUES (''," . $paymentid . "," . $_SESSION["user"]["userid"] . "," . $_SESSION["subscribe_data"]["usersAccounts"] . "," . $_SESSION["subscribe_data"]["cost"] . "," . $_SESSION["subscribe_data"]["GrandTotal"] . ",
                '" . $_SESSION["subscribe_data"]["subscribe"] . "'," . $teachers . "," . $_SESSION["subscribe_data"]["usersAccounts"] . ",0,0,'" . generateStrongPassword(12, false, "lud") . "','" . generateStrongPassword(12, false, "lud") . "','" . $expire . "','" . $_SESSION["subscribe_data"]["type"] . "',1," . $_SESSION["subscribe_data"]["months_years"] . ")";
        $con->query($sql);
    }

    if(isset($_SESSION["subscribe_data"]["donate"]) && $_SESSION["subscribe_data"]["donate"]>0){
        $sql = "INSERT INTO `payments_books`( `paymentid`, `bookid`, `quantity`, `book_price`, `totalprice`, `type`, `itemtype`) VALUES (" . $paymentid . ",0,1,1,1,0,'donate')";
        $con->query($sql);
    }


}

function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
{
    $sets = array();
    if (strpos($available_sets, 'l') !== false)
        $sets[] = 'abcdefghjkmnpqrstuvwxyz';
    if (strpos($available_sets, 'u') !== false)
        $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
    if (strpos($available_sets, 'd') !== false)
        $sets[] = '23456789';
    if (strpos($available_sets, 's') !== false)
        $sets[] = '!@#$%&*?';
    $all = '';
    $password = '';
    foreach ($sets as $set) {
        $password .= $set[array_rand(str_split($set))];
        $all .= $set;
    }
    $all = str_split($all);
    for ($i = 0; $i < $length - count($sets); $i++)
        $password .= $all[array_rand($all)];
    $password = str_shuffle($password);
    if (!$add_dashes)
        return $password;
    $dash_len = floor(sqrt($length));
    $dash_str = '';
    while (strlen($password) > $dash_len) {
        $dash_str .= substr($password, 0, $dash_len) . '-';
        $password = substr($password, $dash_len);
    }
    $dash_str .= $password;
    return $dash_str;
}

function getReadingOption($itemType, $id)
{

    global $con;

    if (!isset($_SESSION["user"]["userid"]) || $_SESSION["user"]["userid"] == "") {

        $canRead = 0;

    } else {

        $sql = "SELECT `payments`.*,`payments_books`.* FROM `payments` INNER JOIN `payments_books` ON `payments`.`paymentid`=`payments_books`.`paymentid` WHERE `payments`.`userid`=" . $_SESSION["user"]["userid"] . " AND `payments_books`.`bookid`=" . $id . " AND `payments_books`.`itemtype`='$itemType'";

        $result = $con->query($sql);

        if (mysqli_num_rows($result) > 0) {

            $read_row = mysqli_fetch_assoc($result);

            $canRead = $read_row["type"];
        } else {
            $canRead = 0;
        }
    }
    return $canRead;
}


function AreyouPurchased($type, $id)

{

    if (!isset($_SESSION["user"]["userid"]) || $_SESSION["user"]["userid"] == "") {

        return 0;

    }

    global $con;

    switch ($type) {

        case 'worksheet':

            $sql = "Select count(payments.paymentid) as count From payments Inner Join payments_books On payments.paymentid = payments_books.paymentid Where payments_books.itemtype = 'worksheet'  and userid=" . $_SESSION["user"]["userid"] . " and  payments_books.bookid=" . $id;

            $result = $con->query($sql);

            $read_row = mysqli_fetch_assoc($result);

            return $read_row['count'];

            break;

        case 'video':

            $sql = "Select count(payments.paymentid) as count From payments Inner Join payments_books On payments.paymentid = payments_books.paymentid Where payments_books.itemtype = 'video'  and userid=" . $_SESSION["user"]["userid"] . " and  payments_books.bookid=" . $id;

            $result = $con->query($sql);

            $read_row = mysqli_fetch_assoc($result);

            return $read_row['count'];

            break;

        case 'audio':

            $sql = "Select count(payments.paymentid) as count From payments Inner Join payments_books On payments.paymentid = payments_books.paymentid Where payments_books.itemtype = 'audio'  and userid=" . $_SESSION["user"]["userid"] . " and  payments_books.bookid=" . $id;

            $result = $con->query($sql);

            $read_row = mysqli_fetch_assoc($result);

            return $read_row['count'];

            break;

        case 'games':

            $sql = "Select count(payments.paymentid) as count From payments Inner Join payments_books On payments.paymentid = payments_books.paymentid Where payments_books.itemtype = 'games'  and userid=" . $_SESSION["user"]["userid"] . " and  payments_books.bookid=" . $id;

            $result = $con->query($sql);

            $read_row = mysqli_fetch_assoc($result);

            return $read_row['count'];

            break;

    }

}


function getMediaItems($items, $type)
{

    global $con;

    global $Lang;

    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }

    global $total_Items;

    global $total_price;

    global $shipping_cart;


    $values = array_keys($items[$type]);

    $itemsList = implode(',', $values);

    $sql = "SELECT `media`.*,`categories`.* FROM `media` INNER JOIN `categories` on `media`.`category`=`categories`.`catid` WHERE `id` IN(" . $itemsList . ")";

    $result = $con->query($sql);

    if (count($items[$type]) > 0) {

        $i = 0;

        while ($row = mysqli_fetch_assoc($result)) {

            $i++;

            $total_Items++;

            $item_price = $row["price"] * $items[$type][$row["id"]]["quantity"];

            $total_price += $item_price;


            $shipping_cart .= '<div class="row-container" id="order_media_' . $row["id"] . '">

                        <div class="cell-container floating-left No" title="' . $total_Items . '"><label class="number">' . $total_Items . '</label></div>

                        <div class="cell-container floating-left Product" title="' . $row['title_' . $cat_code] . '">' . $row['title_' . $cat_code] . '</div>

                        <div class="cell-container floating-left Type" title=""><label class="floating-left">' . $Lang->Online . '</label></div>

                        <div class="oreder_quantity cell-container floating-left QTY" title="' . $items[$type][$row["id"]]["quantity"] . '">' . $items[$type][$row["id"]]["quantity"] . '</div>

                        <div class="order_subtotal cell-container floating-left subTotal" title="' . $item_price . '"><label><span class="floating-left">$</span><span class="floating-left">' . $item_price . '</span></label></div>

                    </div>';

            $viewLink = SITE_URL . $lang_code . '/' . $type . '/' . $row['id'] . '/' . str_replace(" ", "-", $row['title_' . $cat_code]);


            echo '<div class="display-table-row bg-row table-title cart_row" data-type="' . $type . '" data-id="' . $row["id"] . '" data-weight="0">

                            <div class="display-table-cell number-thump">

                                <div class="number">' . $total_Items . '</div>

                                <a class="thump-container" href="' . $viewLink . '">

                                    <div class="thump" style="background-image:url(' . SITE_URL . 'platform/media/' . $row['id'] . '/thumbnail_small.jpg );">

                                    </div>

                                </a>

                            </div>

                            <a href="' . $viewLink . '" class="display-table-cell title" title="' . $row['title_' . $cat_code] . '">' . $row['title_' . $cat_code] . '</a>

                            <div class="display-table-cell type">

                                <div class="line-row-type">

                                    <div class="section-check">

                                    </div>

                                </div>

                            </div>

                            <div class="display-table-cell category">' . $row["title_" . $cat_code] . '</div>

                            <div class="display-table-cell price"><div class="display-inline-block"><span class="floating-left">$</span><span class="floating-left">' . $item_price . '</span></div></div>

                            <div class="display-table-cell quantity">

                                <input type="number" class="book_qty" item_type="' . $type . '" item_id="' . $row['id'] . '" item_price="' . $item_price . '" value="' . $items[$type][$row["id"]]["quantity"] . '">

                            </div>

                            <div class="display-table-cell total-price ">

                                <div class="display-inline-block"><span class="floating-left">$</span><span class="floating-left carts_row_sum">' . $item_price . '</span></div>

                            </div>

                            <div class="display-table-cell  delete_carts_item-style"><a class="delete_carts_item" title="' . $Lang->Delete . '"></a></div>

                        </div>';


        }

    }


}

function getIp($path)
{

    include_once($path . 'includes/ip2locationlite.class.php');

    //Load the class

    $ipLite = new ip2location_lite;

    $ipLite->setKey('ee0ae4326f966ea90705cd8a0d36e7a0e1cdd5a9fe4ab3c724c68fa0d9d8a6a2');

    //Get errors and locations

    $locations = $ipLite->getCity($_SERVER['REMOTE_ADDR']);

    $countryCode = $locations['countryCode'];

    return $countryCode;

}

function getEnglishWord($w)
{

    if (strtolower($w) == "ar") {

        $word = "Arabic";

    } elseif (strtolower($w) == "en") {

        $word = "English";

    } else {

        $word = "France";

    }

    return $word;

}


function calculateSignature($arrData, $signType = 'request')
{
    $shaString = '';
    ksort($arrData);
    foreach ($arrData as $k => $v) {
        $shaString .= "$k=$v";
    }

    if ($signType == 'request') {
        $shaString = Payfort_SHA_Request . $shaString . Payfort_SHA_Request;
    } else {
        $shaString = Payfort_SHA_Response . $shaString . Payfort_SHA_Response;
    }
    $signature = hash("sha256", $shaString);
    return $signature;
}

function prepareProductsPayment($data)
{

    global $Lang;
    global $lang_code;
    $tbl_code=strtolower($lang_code);
    global $con;

    $data = json_decode($data, true);
    $_SESSION["items"] = array();
    $books = $data["book"];
    $items = [];
    $total_price = 0;
    $weight = 0;
    $pieces = 0;
    $name = " " . $Lang->PaperCopy . " - " . $Lang->EnrichmentCopy;
    if (count($books) > 0) {
        $values = array_keys($books);
        $booksList = implode(',', $values);
        $sql = "SELECT * FROM `books` WHERE `bookid` IN(" . $booksList . ")";
        $result = $con->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $total_price += $row['price'] * $books[$row["bookid"]]["qty"];
            $weight += $row['weight'] * $books[$row["bookid"]]["qty"];
            $pieces += $books[$row["bookid"]]["qty"];
            $price = $row['price'];
            $_SESSION["items"][] = array("name" => $row["name"] . $name, "id" => "book_" . $row['bookid'] . "_1", "price" => $price, "quantity" => $books[$row["bookid"]]["qty"]);
            $items[] = array("name" => $row["name"] . " " . $name, "quantity" => $books[$row["bookid"]]["qty"], "id" => "book_" . $row['bookid'] . "_1", "price" => $row['price']);
        }
    }

    ///get stories Info
    $stories = $data["story"];
    $values = array_keys($stories);
    if (count($stories) > 0) {
        $storiesList = implode(',', $values);
        $sql = "SELECT * FROM `story` WHERE `storyid` IN(" . $storiesList . ")";
        $result = $con->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = array("name" => $row["title"] . $name, "quantity" => $stories[$row["storyid"]]["qty"], "id" => "story_" . $row['storyid'] . "_1", "price" => $row['price']);
            $total_price += $row['price'] * $stories[$row["storyid"]]["qty"];
            $weight += $row['weight'] * $stories[$row["storyid"]]["qty"];
            $pieces += $stories[$row["storyid"]]["qty"];
            $_SESSION["items"][] = array("name" => $row["title"] . $name, "id" => "story_" . $row['storyid'] . "_1", "price" => $row['price'], "quantity" => $stories[$row["storyid"]]["qty"]);
        }
    }

    ///get stories toys
    $stories = $data["toy"];
    $values = array_keys($stories);
    if (count($stories) > 0) {
        $storiesList = implode(',', $values);
        $sql = "SELECT * FROM `products` WHERE `productid` IN(" . $storiesList . ")";
        $result = $con->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = array("name" => $row["name_".$tbl_code] , "quantity" => $stories[$row["productid"]]["qty"], "id" => "toy_" . $row['productid'] . "_1", "price" => $row['Price']);
            $total_price += $row['Price'] * $stories[$row["productid"]]["qty"];
            $weight += $row['Weight'] * $stories[$row["productid"]]["qty"];
            $pieces += $stories[$row["productid"]]["qty"];
            $_SESSION["items"][] = array("name" => $row["name_".$tbl_code], "id" => "toy_" . $row['productid'] . "_1", "price" => $row['Price'], "quantity" => $stories[$row["productid"]]["qty"]);
        }
    }

    //$_SESSION["payment"]["total_weight"] = $weight / 1000;
    $_SESSION["payment"]["total_weight"] = $weight;
    $_SESSION["payment"]["pieces"] = $pieces;
    $_SESSION["payment"]["total_price"] = $total_price;
    return $total_price;
}

function prepareMedia($items_list, $type)
{

    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    global $con;
    global $Lang;
    global $items;

    $total_price = 0;
    $media = $items_list[$type];


    if (count($media) > 0) {
        $values = array_keys($media);
        $mediaList = implode(',', $values);
        $sql = "SELECT * FROM `media` WHERE `id` IN(" . $mediaList . ")";
        $result = $con->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            if ($media[$row["id"]]["qty"] > 1) {
                $items[] = array("name" => $row["title_" . $cat_code] . " " . $Lang->Online, "quantity" => $media[$row["id"]]["qty"], "id" => $type . "_" . $row['id'] . "_1", "price" => $row['price']);
                $_SESSION["items"][] = array("name" => $row["title_" . $cat_code] . " " . $Lang->Online, "quantity" => $media[$row["id"]]["qty"], "id" => $type . "_" . $row['id'] . "_1", "price" => $row['price']);;
                $total_price += $row['price'] * $media[$row["id"]]["qty"];
            }
        }
    }

    return $total_price;
}

function validateCart($data)
{

    $totalPrice = prepareProductsPayment($data["items"]);

    if(!isset($data["donate"])){
        $data["donate"]=0;
    }
    if ($data["payment_option"] == "cod") {

        $shipping_method = "aramex";

        $_SESSION["payment"]["shipping_method"] = "aramex";

    } else {

        $shipping_method = "DHL";

        $_SESSION["payment"]["shipping_method"] = "DHL";

    }

    $shipping = calcShippingPrice($shipping_method, $_SESSION["payment"]["total_weight"] / 1000, $_SESSION["shipping_info"]["shipping_country"], $_SESSION["shipping_info"]["shipping_city"], $_SESSION["payment"]["pieces"], true);

    $_SESSION["payment"]["contents"] = "docs";

    $_SESSION["payment"]["tax"] = ($_SESSION["payment"]["shipping"] + $_SESSION["payment"]["total_price"] +$data["donate"]+ $_SESSION["payment"]["cod"]) * TAX;

    $_SESSION["payment"]["GrandTotal"] = $_SESSION["payment"]["shipping"] + $_SESSION["payment"]["total_price"] +$data["donate"]+ $_SESSION["payment"]["cod"] + $_SESSION["payment"]["tax"];


//    $_SESSION["payment"]["total_price"]

//    $_SESSION["payment"]["total_weight"];

//    $_SESSION["payment"]["shipping"];

//    $_SESSION["payment"]["cod"];

//    $_SESSION["payment"]["pieces"];

//    $_SESSION["payment"]["contents"];

//    $_SESSION["payment"]["tax"];

//    $_SESSION["payment"]["GrandTotal"];


}

function calcShippingPrice($type = "", $weight = 0, $country = "", $city = "", $pieces = 0, $Call = false)
{
    if (isset($_GET["type"])) {
        $type = $_GET["type"];
    }

    if (isset($_GET["weight"])) {
        $weight = $_GET["weight"];
    }

    if (isset($_POST["dest_country"])) {
        $country = $_POST["dest_country"];
    }

    if (isset($_POST["dest_city"])) {
        $city = $_POST["dest_city"];
    }

    if (isset($_POST["pieces"])) {
        $pieces = $_POST["pieces"];
    }

    $result = "";
    switch ($type) {
        case "DHL":
            $result = getShippingPrice($weight);
            break;
        case "aramex":
            if (isset($_POST["total_price"]) && $_POST["total_price"] != '') {
                $_SESSION["payment"]["total_price"] = $_POST["total_price"];
            }
            if (isset($_POST["donate"]) && $_POST["donate"] >0) {
                $_SESSION["payment"]["total_price"] = $_POST["total_price"]+$_POST["donate"];
            }

            $result = getAramexRate($city, $country, $weight, $pieces, $_SESSION["payment"]["total_price"]);
            //
            break;
    }

    if ($Call) {
        return $result;
    } else {
        echo $result;
    }
}


function getAramexRate($dest_city, $dist_country, $weight, $pieces, $total_price)
{
    global $zones;
    global $zones_price;
    $data = [];
    $zone_number = $zones[$dist_country];
    $data["shipping"] = $zones_price[$zone_number]["main"];
    if ($weight > 0.5) {
        $data["shipping"] += ceil(($weight - 0.5) * 2) * $zones_price[$zone_number]["add"];
    }
    $cost = $total_price + $data["shipping"];
    $data["cod"] = 7;
    if ($cost > 100) {
        //$data["cod"] = ceil(($cost - 100) / 100) * 5;
        $data["cod"]+= ceil(($cost - 100) / 100) * 5;
    }

    if($dist_country=="JO"){
        $data["cod"]=0;
        if(strtolower($dest_city)=="amman" || strtolower($dest_city)=="aman" || $dest_city=="عمان"){
            $data["shipping"]=3;
        }elseif (strtolower($dest_city)=="aqaba" || $dest_city=="العقبة" || $dest_city=="العقبه"){
            $data["shipping"]=6;
        }else{
            $data["shipping"]=4;
        }
    }

    $_SESSION["payment"]["shipping"] = $data["shipping"];

    $_SESSION["payment"]["cod"] = $data["cod"];

    if(isset($_POST["is_cod"]) && $_POST["is_cod"]==0){
        $_SESSION["payment"]["cod"]=0;
        $data["cod"]=0;
    }

    return json_encode($data);
}


function logError($msg = "")
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    global $con;
    $real_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $sql = "INSERT INTO `errors_logs`(`id`, `url`, `session`,`post`,`getd`,`msg`,`procees_date`) VALUES ('','" . $real_link . "','" . mysqli_real_escape_string($con, json_encode($_SESSION)) . "','" . mysqli_real_escape_string($con, json_encode($_POST)) . "','" . mysqli_real_escape_string($con, json_encode($_GET)) . "','" . $msg . "',NOW())";
    $con->query($sql);
    return $con->insert_id;
}

function getPayfortData($data){

    if (isset($data['r'])) {
        unset($data['r']);
    }

    if (isset($data['signature'])) {
        unset($data['signature']);
    }

    if (isset($data['integration_type'])) {
        unset($data['integration_type']);
    }

    if (isset($data['3ds'])) {
        unset($data['3ds']);
    }

    if (isset($data['lang'])) {
        unset($data['lang']);
    }

    return $data;
}
function getToken($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    $max = strlen($codeAlphabet) - 1;
    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max)];
    }
    return $token;
}
function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int)($log / 8) + 1; // length in bytes
    $bits = (int)$log + 1; // length in bits
    $filter = (int)(1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd >= $range);
    return $min + $rnd;
}

//get LMS true link for current user
function getLMSLink(){
    global $con;
    global $Lang;
    global $lang_code;
    global $cat_code;
    if(!isset($cat_code) || $cat_code==""){
        if($lang_code!="ar" && $lang_code!="en"){
            $cat_code="ar";
        }else{
            $cat_code=$lang_code;
        }
    }
    if(isset($_SESSION["user"]["permession"]) && ($_SESSION["user"]["permession"]==11 || $_SESSION["user"]["permession"]==10)){
        $sql="SELECT `payment_subscribe`.*,`payments`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payment_subscribe`.`subscribe_usertype`='Schools' AND `payments`.`status`=1 AND `payments`.`userid`=".$_SESSION["user"]["userid"];
        $resultSql=$con->query($sql);
        if(mysqli_num_rows($resultSql)>0){//user is owner check for LMS instant
            $sql="SELECT * FROM `lms_instances` WHERE `owner`=".$_SESSION["user"]["userid"];
            $resultSql=$con->query($sql);
            if(mysqli_num_rows($resultSql)>0){//LMS exist
                $LMSrow=mysqli_fetch_assoc($resultSql);
                $link='<a href="https://'.$LMSrow["subdomain"].LMS_MainDomain.'" class="button">'.$Lang->LMS.'</a>';
            }else{//LMS not configured
                $link='<a href="'.SITE_URL.$lang_code.'/lms-settings" class="button">'.$Lang->LMS.'</a>';
            }
        }else{//check of user in school Account (teacher or sudent)
            $sql="SELECT `activation_code` FROM `users` where `userid`=".$_SESSION["user"]["userid"];
            $Sqlrow=mysqli_fetch_assoc($con->query($sql));
            if($Sqlrow["activation_code"]!=""){
                if($_SESSION["user"]["permession"]==10){//query for student code
                    $sql="SELECT * FROM `lms_instances` WHERE `owner` in(SELECT `payments`.`userid` FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payment_subscribe`.`subscribe_usertype`='Schools' AND `payments`.`status`=1 AND `payment_subscribe`.`users_code`='".$Sqlrow["activation_code"]."')";
                    $resultSql=$con->query($sql);
                    if(mysqli_num_rows($resultSql)>0){//LMS exist
                        $LMSrow=mysqli_fetch_assoc($resultSql);
                        $link='<a href="https://'.$LMSrow["subdomain"].LMS_MainDomain.'" class="button">'.$Lang->LMS.'</a>';
                    }else{//LMS not configured user must contact admin
                        $link='<a class="button jq_showlms_contactadmin">'.$Lang->LMS.'</a>';
                    }
                }else{//query for teacher code
                    $sql="SELECT * FROM `lms_instances` WHERE `owner` in(SELECT `payments`.`userid` FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payment_subscribe`.`subscribe_usertype`='Schools' AND `payments`.`status`=1 AND `payment_subscribe`.`teachers_code`='".$Sqlrow["activation_code"]."')";
                    $resultSql=$con->query($sql);
                    if(mysqli_num_rows($resultSql)>0){//LMS exist
                        $LMSrow=mysqli_fetch_assoc($resultSql);
                        $link="https://".$LMSrow["subdomain"].LMS_MainDomain;
                    }else{//LMS not configured user must contact admin
                        $link='<a class="button jq_showlms_contactadmin">'.$Lang->LMS.'</a>';
                    }
                }
            }else{//user not in school account
                $link='<a class="button jq_showlms_subscribe">'.$Lang->LMS.'</a>';
            }
        }
    }else{
        $link='<a class="button jq_showlms_subscribe">'.$Lang->LMS.'</a>';
    }
    return $link;

}

function isSubscribed($id){
    global $con;
    $sql="SELECT * FROM `users` WHERE `userid`=".$id;
    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        if($row["permession"]>0 && $row["permession"]<=12){
            return 1;
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}

?>