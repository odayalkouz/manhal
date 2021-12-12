<?php
$currentTab = "books";
include_once "platform/config.php";
include_once "includes/function.php";
include_once "platform/includes/function.php";
include_once "includes/header.php";
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/books.css<?=$cash;?>">
<?php
if($detect->isMobile() || $detect->isTablet())
{
    ?>
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/probooks.css<?=$cash;?>">
    <?php
}
?>
<?php
if(!$detect->isMobile() || $detect->isTablet()) {
    ?>
    <div class="popup-main-container-a">
        <div class="popup-tabel-a">
            <div class="popup-row-a">
                <div class="popup-cell-a">
                    <div class="popup-container-a">
                        <div class="popup-content-a PopupAdvansedSearch PopupsAdvansedSearchaaa">
                            <form name="advanced_search" id="advanced_search_book" method="get">
                                <input type="hidden" name="search" value="advanced">
                                <div class="padding-container">
                                    <div class="close-container floating-right">
                                        <a class="close floating-right"><i></i></a>
                                    </div>
                                    <div class="top-container">
                                        <div class="box-container-top">
                                            <div class="search-container floating-left">
                                                <input type="text" class="txt-a floating-left" name="keywords" placeholder="<?= $Lang->SearchYourItem; ?>" value="">
                                                <input type="submit" class="btn btn-search floating-left" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-container-all floating-left">
                                        <div class="left-container-filter floating-left">
                                            <div class="category title-tag"><?= $Lang->Categories; ?></div>
                                            <div class="box-container">
                                                <div class="line-row">
                                                    <label class="lbl-data-a floating-left"><?= $Lang->Bysubject; ?></label>
                                                    <div class="wrapper-demo floating-left">
                                                        <div id="subject1" class="jq_bookdropdown wrapper-dropdown-3"
                                                             tabindex="2">
                                                            <span style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-En/images/cat/books/all.svg);"
                                                                  class="floating-left"><?= $Lang->All; ?></span>
                                                            <ul class="dropdown scrollable">
                                                                <input type="hidden" class="hidden_input"
                                                                       name="category" id="search_category" value="0">
                                                                <li><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->All; ?></i></a>
                                                                </li>
                                                                <?php
                                                                $cat_sql = "Select * From  categories WHERE `parent`=0  ORDER BY `categories`.`name_" . $cat_code . "`";
                                                                $cat_result = $con->query($cat_sql);
                                                                if (mysqli_num_rows($cat_result) > 0) {
                                                                    while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                                                        echo getCategoriesDropDown($cat_row['catid'], "categories");
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="line-row">
                                                    <label class="lbl-data-a floating-left"><?= $Lang->ByGrade; ?></label>
                                                    <div class="wrapper-demo floating-left">
                                                        <div id="grade" class="wrapper-dropdown-3" tabindex="3">
                                                            <span class="floating-left"><?= $Lang->all; ?></span>
                                                            <ul class="dropdown scrollable">
                                                                <input type="hidden" class="hidden_input"
                                                                       name="search_grade" id="search_grade" value="-1">
                                                                <li class="catli" catid="-1"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->all; ?></i></a>
                                                                </li>
                                                                <li class="catli" catid="0"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Kindergarten; ?></i></a>
                                                                </li>
                                                                <li class="catli" catid="1"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            1</i></a></li>
                                                                <li class="catli" catid="2"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            2</i></a></li>
                                                                <li class="catli" catid="3"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            3</i></a></li>
                                                                <li class="catli" catid="4"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            4</i></a></li>
                                                                <li class="catli" catid="5"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            5</i></a></li>
                                                                <li class="catli" catid="6"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            6</i></a></li>
                                                                <li class="catli" catid="7"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            7</i></a></li>
                                                                <li class="catli" catid="8"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            8</i></a></li>
                                                                <li class="catli" catid="9"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            9</i></a></li>
                                                                <li class="catli" catid="10"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            10</i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="line-row">
                                                    <label class="lbl-data-a floating-left"><?= $Lang->ByAge; ?></label>
                                                    <div class="wrapper-demo floating-left">
                                                        <div id="age" class="wrapper-dropdown-3" tabindex="3">
                                                            <span class="floating-left"><?= $Lang->all; ?></span>
                                                            <ul class="dropdown scrollable">
                                                                <input type="hidden" class="hidden_input"
                                                                       name="search_age" id="search_age" value="-1">
                                                                <li class="catli" catid="-1"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->all; ?></i></a>
                                                                </li>
                                                                <li class="catli" catid="1"><a href="#"><i
                                                                                class="icon-truck icon-large">4-5</i></a>
                                                                </li>
                                                                <li class="catli" catid="2"><a href="#"><i
                                                                                class="icon-truck icon-large">6-8</i></a>
                                                                </li>
                                                                <li class="catli" catid="3"><a href="#"><i
                                                                                class="icon-truck icon-large">9-11</i></a>
                                                                </li>
                                                                <li class="catli" catid="4"><a href="#"><i
                                                                                class="icon-truck icon-large">12-15</i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="Publishing-years title-tag"><?= $Lang->Publishingyears; ?></div>
                                            <div class="box-container years">
                                                <div class="line-row">
                                                    <label class="lbl-data-a floating-left"><?= $Lang->Years; ?></label>
                                                    <div class="wrapper-demo floating-left">
                                                        <div id="year" class="wrapper-dropdown-3" tabindex="5">
                                                            <span class="floating-left"><?= $Lang->all; ?></span>
                                                            <ul class="dropdown scrollable" style="max-height: 186px">
                                                                <input type="hidden" class="hidden_input"
                                                                       name="search_year" id="search_uear" value="-1">
                                                                <li class="catli" catid="-1"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->all; ?></i></a>
                                                                </li>
                                                                <li class="catli" catid="2016"><a href="#"><i
                                                                                class="icon-truck icon-large">2016</i></a>
                                                                </li>
                                                                <li class="catli" catid="2015"><a href="#"><i
                                                                                class="icon-truck icon-large">2015</i></a>
                                                                </li>
                                                                <li class="catli" catid="2014"><a href="#"><i
                                                                                class="icon-truck icon-large">2014</i></a>
                                                                </li>
                                                                <li class="catli" catid="2013"><a href="#"><i
                                                                                class="icon-truck icon-large">2013</i></a>
                                                                </li>
                                                                <li class="catli" catid="2012"><a href="#"><i
                                                                                class="icon-truck icon-large">2012</i></a>
                                                                </li>
                                                                <li class="catli" catid="2011"><a href="#"><i
                                                                                class="icon-truck icon-large">2011</i></a>
                                                                </li>
                                                                <li class="catli" catid="2010"><a href="#"><i
                                                                                class="icon-truck icon-large">2010</i></a>
                                                                </li>
                                                                <li class="catli" catid="2009"><a href="#"><i
                                                                                class="icon-truck icon-large">2009</i></a>
                                                                </li>
                                                                <li class="catli" catid="2008"><a href="#"><i
                                                                                class="icon-truck icon-large">2008</i></a>
                                                                </li>
                                                                <li class="catli" catid="2007"><a href="#"><i
                                                                                class="icon-truck icon-large">2007</i></a>
                                                                </li>
                                                                <li class="catli" catid="2006"><a href="#"><i
                                                                                class="icon-truck icon-large">2006</i></a>
                                                                </li>
                                                                <li class="catli" catid="2005"><a href="#"><i
                                                                                class="icon-truck icon-large">2005</i></a>
                                                                </li>
                                                                <li class="catli" catid="2004"><a href="#"><i
                                                                                class="icon-truck icon-large">2004</i></a>
                                                                </li>
                                                                <li class="catli" catid="2003"><a href="#"><i
                                                                                class="icon-truck icon-large">2003</i></a>
                                                                </li>
                                                                <li class="catli" catid="2002"><a href="#"><i
                                                                                class="icon-truck icon-large">2002</i></a>
                                                                </li>
                                                                <li class="catli" catid="2001"><a href="#"><i
                                                                                class="icon-truck icon-large">2001</i></a>
                                                                </li>
                                                                <li class="catli" catid="2000"><a href="#"><i
                                                                                class="icon-truck icon-large">2000</i></a>
                                                                </li>
                                                                <li class="catli" catid="1999"><a href="#"><i
                                                                                class="icon-truck icon-large">1999</i></a>
                                                                </li>
                                                                <li class="catli" catid="1998"><a href="#"><i
                                                                                class="icon-truck icon-large">1998</i></a>
                                                                </li>
                                                                <li class="catli" catid="1997"><a href="#"><i
                                                                                class="icon-truck icon-large">1997</i></a>
                                                                </li>
                                                                <li class="catli" catid="1996"><a href="#"><i
                                                                                class="icon-truck icon-large">1996</i></a>
                                                                </li>
                                                                <li class="catli" catid="1995"><a href="#"><i
                                                                                class="icon-truck icon-large">1995</i></a>
                                                                </li>
                                                                <li class="catli" catid="1994"><a href="#"><i
                                                                                class="icon-truck icon-large">1994</i></a>
                                                                </li>
                                                                <li class="catli" catid="1993"><a href="#"><i
                                                                                class="icon-truck icon-large">1993</i></a>
                                                                </li>
                                                                <li class="catli" catid="1992"><a href="#"><i
                                                                                class="icon-truck icon-large">1992</i></a>
                                                                </li>
                                                                <li class="catli" catid="1991"><a href="#"><i
                                                                                class="icon-truck icon-large">1991</i></a>
                                                                </li>
                                                                <li class="catli" catid="1990"><a href="#"><i
                                                                                class="icon-truck icon-large">1990</i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ISBN-Number title-tag"><?= $Lang->ISBNNumber; ?></div>
                                            <div class="box-container years">
                                                <div class="line-row">
                                                    <label class="lbl-data-a floating-left"><?= $Lang->ISBNNo; ?></label>
                                                    <input type="text" class="txt-a floating-left" name="isbn"
                                                           placeholder="<?= $Lang->ISBN; ?>">
                                                </div>
                                            </div>
                                            <div class="language title-tag"><?= $Lang->Language; ?></div>
                                            <div class="box-container years">
                                                <div class="line-row">
                                                    <div class="section-check floating-left">
                                                        <ul>
                                                            <li class="floating-left">
                                                                <label class="input-control checkbox floating-left">
                                                                    <input type="checkbox" name="language_arabic"
                                                                           id="isArabic" value="1"
                                                                           checked="checked"><span class="check"></span>
                                                                </label>
                                                                <label for="isArabic"
                                                                       class="text floating-left"><?= $Lang->Arabic; ?></label>
                                                            </li>
                                                            <li class="floating-left">
                                                                <label class="input-control checkbox floating-left">
                                                                    <input type="checkbox" name="language_english"
                                                                           id="isEnglish" value="1"
                                                                           checked="checked"><span class="check"></span>
                                                                </label>
                                                                <label for="isEnglish"
                                                                       class="text floating-left"><?= $Lang->English; ?></label>
                                                            </li>
                                                            <li class="floating-left">
                                                                <label class="input-control checkbox floating-left">
                                                                    <input type="checkbox" name="language_french"
                                                                           id="isFrench" value="1"
                                                                           checked="checked"><span class="check"></span>
                                                                </label>
                                                                <label for="isFrench"
                                                                       class="text floating-left"><?= $Lang->France; ?></label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-container-filter floating-left">
                                            <div class="price floating-left title-tag"><?= $Lang->Price; ?></div>
                                            <div class="box-container years2">
                                                <div class="line-row">
                                                    <label class="lbl-data-b floating-left text-left"><?= $Lang->From; ?></label>
                                                    <label class="lbl-data-c floating-left">$</label>
                                                    <input type="number" name="price_from" class="floating-left"
                                                           value="0" min="0" max="1000">
                                                    <label class="lbl-data-b floating-left"><?= $Lang->TO; ?></label>
                                                    <label class="lbl-data-c floating-left">$</label>
                                                    <input type="number" name="price_to" class="floating-left"
                                                           value="1000" min="0" max="1000">
                                                </div>
                                            </div>
                                            <div class="type title-tag"><?= $Lang->Semester; ?></div>
                                            <div class="box-container">
                                                <div class="line-row">
                                                    <div class="line-row">
                                                        <div class="section-check-row floating-left">
                                                            <ul>
                                                                <li class="floating-left">
                                                                    <label class="input-control checkbox floating-left">
                                                                        <input type="checkbox" name="semester1"
                                                                               id="isFirst" value="1" checked><span
                                                                                class="check"></span>
                                                                    </label>
                                                                    <label for="isFirst"
                                                                           class="text floating-left"><?= $Lang->FirstSemester; ?></label>
                                                                </li>
                                                                <li class="floating-left">
                                                                    <label class="input-control checkbox floating-left">
                                                                        <input type="checkbox" name="semester2"
                                                                               id="isSecond" value="1" checked><span
                                                                                class="check"></span>
                                                                    </label>
                                                                    <label for="isSecond"
                                                                           class="text floating-left"><?= $Lang->SecondSemester; ?></label>
                                                                </li>
                                                                <li class="floating-left">
                                                                    <label class="input-control checkbox floating-left">
                                                                        <input type="checkbox" name="semester3"
                                                                               id="isThird" value="1" checked><span
                                                                                class="check"></span>
                                                                    </label>
                                                                    <label for="isThird"
                                                                           class="text floating-left"><?= $Lang->ThirdSemester; ?></label>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="option title-tag"><?= $Lang->Option; ?></div>
                                            <div class="box-container">
                                                <div class="line-row">
                                                    <div class="section-check-row floating-left">
                                                        <ul>
                                                            <li class="floating-left">
                                                                <label class="input-control checkbox floating-left">
                                                                    <input type="checkbox" name="paperbook" id="isBooks"
                                                                           value="1" checked><span class="check"></span>
                                                                </label>
                                                                <label for="isBooks"
                                                                       class="text floating-left"><?= $Lang->Paperbooks; ?></label>
                                                            </li>
                                                            <li class="floating-left">
                                                                <label class="input-control checkbox floating-left">
                                                                    <input type="checkbox" name="ebook" id="isEbooks"
                                                                           value="2" checked><span class="check"></span>
                                                                </label>
                                                                <label for="isEbooks"
                                                                       class="text floating-left"><?= $Lang->Ebooks; ?></label>
                                                            </li>
                                                            <li class="floating-left">
                                                                <label class="input-control checkbox floating-left">
                                                                    <input type="checkbox" name="enrichment"
                                                                           id="isEnrichment" value="4" checked><span
                                                                            class="check"></span>
                                                                </label>
                                                                <label for="isEnrichment"
                                                                       class="text floating-left"><?= $Lang->Enrichmentbook; ?></label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<div class="inner-pages-main-container-books">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <form class="books-search" METHOD="GET" id="books_search">
                        <input type="hidden" name="search" value="simple">
                        <div class="right-col-3 floating-left">
                            <?php

                            $grade_filter="";
                            if(isset($_GET["search_grade"]) && $_GET["search_grade"]!=-1){
                                $grade_filter = " AND `books`.`grade`=".$_GET["search_grade"];
                            }

                            $age_filter="";
                            if(isset($_GET["search_age"]) && $_GET["search_age"]!=-1){
                                $age_filter = " AND `books`.`age`=".$_GET["search_age"];
                            }
                            $year_filter="";
                            if(isset($_GET["search_year"]) && $_GET["search_year"]!=-1){
                                $year_filter = " AND `books`.`year`=".$_GET["search_year"];
                            }


                            $isbn_filter="";
                            if(isset($_GET["isbn"]) && trim($_GET["isbn"])!=""){
                                $isbn_filter = " AND `books`.`isbn`='".$_GET["isbn"]."'";
                            }


                            $lang_filter="";
                            $lang_filter2="";
                            if(isset($_GET["search"]) && $_GET["search"]=="advanced"){


                                $lang_filter=" AND (";
                                if(isset($_GET["language_arabic"]) && $_GET["language_arabic"]==1){
                                    $lang_filter2.="`books`.`language`='Ar'";
                                }
                                if(isset($_GET["language_english"]) && $_GET["language_english"]==1){
                                    if($lang_filter2==""){
                                        $lang_filter2="`books`.`language`='En'";
                                    }else{
                                        $lang_filter2.=" OR `books`.`language`='En'";
                                    }


                                }
                                if(isset($_GET["language_french"]) && $_GET["language_french"]==1){
                                    if($lang_filter2==""){
                                        $lang_filter2.="`books`.`language`='Fr'";
                                    }else{
                                        $lang_filter2.=" OR `books`.`language`='Fr'";
                                    }

                                }


                                if(isset($_GET["language_french"])||isset($_GET["language_english"])||isset($_GET["language_arabic"])) {
                                    $lang_filter .= $lang_filter2 . ") ";
                                }else{
                                    $lang_filter="";
                                }

                            }


                          /*  $price_filter="";
                            if(isset($_GET["price_from"]) && isset($_GET["price_to"])){
                                $price_filter=" AND `books`.`price` BETWEEN ".$_GET["price_from"]." AND ".$_GET["price_to"]." ";
                            }*/

                            $price_filter="";
                            if(isset($_GET["search"]) && $_GET["search"]=="advanced") {
                                if (isset($_GET["price_from"]) && isset($_GET["price_to"])) {
                                    $price_filter = " AND `books`.`price` BETWEEN  " . $_GET["price_from"] . " AND " . $_GET["price_to"] . " ";
                                }
                            }


                            $semester_filter="";
                            $semester_filter2="";
                            if(isset($_GET["search"]) && $_GET["search"]=="advanced"){
                                $semester_filter=" AND (";
                                if(isset($_GET["semester1"]) && $_GET["semester1"]==1){
                                    $semester_filter2.="`books`.`semester`=1";
                                }
                                if(isset($_GET["semester2"]) && $_GET["semester2"]==1){
                                    if($semester_filter2==""){
                                        $semester_filter2="`books`.`semester`=2";
                                    }else{
                                        $semester_filter2.=" OR `books`.`semester`=2";
                                    }


                                }
                                if(isset($_GET["semester3"]) && $_GET["semester3"]==1){
                                    if($semester_filter2==""){
                                        $semester_filter2.="`books`.`semester`=3";
                                    }else{
                                        $semester_filter2.=" OR `books`.`semester`=3";
                                    }

                                }
                                $semester_filter.=$semester_filter2.") ";
                            }


                            $booktype_filter="";
                            if(isset($_GET["search"]) && $_GET["search"]=="advanced"){
                                $booktype_filter1="";
                                if(isset($_GET["paperbook"]) && $_GET["paperbook"]==1){
                                    $booktype_filter1="1,3,5,7";
                                }
                                if(isset($_GET["ebook"]) && $_GET["ebook"]==2){
                                    $booktype_filter1.="2,3,6,7";
                                }
                                if(isset($_GET["enrichment"]) && $_GET["enrichment"]==4){
                                    $booktype_filter1.="4,5,6,7";
                                }
                                if($booktype_filter1!=""){
                                    $booktype_filter=" AND `books`.`booktype` IN (".$booktype_filter1.")";
                                }

                            }

                            $keyword_filter = "";
                            if (isset($_GET['keywords']) && $_GET['keywords'] != "") {
                                $keyword_filter = " AND ( `name` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `description_ar` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords'])  . "%' OR `description_en` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `author_en` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `author_ar` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `isbn` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' )";
                            }
                            $cat_filter = "";
                            if (isset($_GET['category']) && $_GET['category'] != 0) {
                                $cat_filter = " AND `catid` = " . $_GET['category'];
                            }
                            $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status` =1 AND `books`.`isteacherbook`=1 AND( `books`.`bookid`>0 " . $keyword_filter . $cat_filter.$grade_filter.$age_filter.$year_filter.$isbn_filter.$lang_filter.$price_filter.$semester_filter.$booktype_filter." )";
                            $result = $con->query($sql);
                            $num_rows = mysqli_num_rows($result);




                            $link=$real_link;
                            if(isset($_GET["page"]) && $_GET["page"]!=""){
                                $link=str_replace("&page=".$_GET["page"],"",$link);
                            }

                            $url_arr=explode("/",$real_link);
                            $url_arr=explode("?",$url_arr[count($url_arr)-1]);
                            $url = $url_arr[0]."?";

                            if(strpos($link,"?")===false){
                                $url = $url_arr[0]."?";
                            }else{
                                $arr=explode("?",$link);
                                $getData=explode("&",$arr[1]);
                                $url = $url_arr[0]."?".$arr[1];
                            }

//                            $url = "books?";
//                            if(strpos($link,"?")===false){
//                                $url = "books?";
//                            }else{
//                                $arr=explode("?",$link);
//                                $getData=explode("&",$arr[1]);
//                                $url = "books?".$arr[1];
//                            }

                            $pagination = getPagination($url, $num_rows);
                            $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status` =1 AND `books`.`isteacherbook`=1  AND( `books`.`bookid`>0 " . $keyword_filter . $cat_filter .$grade_filter.$age_filter.$year_filter.$isbn_filter.$lang_filter.$price_filter.$semester_filter.$booktype_filter." ) ".$pagination[0];
                            $result = $con->query($sql);

                            ?>
                            <div class="books-main-container-page clear-both">
                                <div class="top-black-col">
                                    <div class="floating-left">
                                        <label class="lbl-data-a floating-left"><?= $Lang->Bysubject;?></label>
                                        <div class="wrapper-demo">
                                            <div id="subject" class="jq_bookdropdown wrapper-dropdown-3" tabindex="2">
                                                <span style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-En/images/cat/books/all.svg);" class="floating-left"><?= $Lang->All; ?></span>
                                                <ul class="dropdown submit scrollable">
                                                    <input class="hidden_input" type="hidden" name="category" value="0" id="hidden_category_book">
                                                    <li class="catli sub-0 no-image" catid="0"><a href="#"><i class="icon-truck icon-large"><?= $Lang->All; ?></i></a></li>
                                                    <?php
                                                    $cat_sql = "Select * From  categories WHERE `parent`=0 ORDER BY `categories`.`name_" . $cat_code . "`";
                                                    $cat_result = $con->query($cat_sql);
                                                    if (mysqli_num_rows($cat_result) > 0)
                                                    {
                                                        while ($cat_row = mysqli_fetch_assoc($cat_result))
                                                        {
                                                            echo getCategoriesDropDown($cat_row['catid'], "categories");
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-search-container floating-right">
                                        <input type="text" class="txt-a floating-left" name="keywords"
                                               placeholder="<?= $Lang->SearchYourItem; ?>"
                                               value="<?php if (isset($_GET['keywords'])) {
                                                   echo $_GET['keywords'];
                                               } ?>">
                                        <input type="submit" class="btn btn-search floating-left" value="" title="<?= $Lang->search;?>">
                                    </div>
                                    <?php
                                    if(!$detect->isMobile() || $detect->isTablet()) {
                                        ?>
                                        <a data-type="ContainersAdvansedSearchaaa"
                                           class="btn-popup-a advansd-search-button floating-right" title="<?= $Lang->Advansedsearch;?>"><?= $Lang->Advansedsearch;?></a>
                                        <?php
                                    }
                                    ?>
                                    <div class="floating-right sort-by-list-container">
                                        <label class="lbl-data-b floating-left"><?= $Lang->SortBy;?></label>
                                        <div class="wrapper-demo">
                                            <div id="sortby" class="wrapper-dropdown-3" tabindex="1">
                                                <span class="floating-left"><?= $Lang->Sortalphabetically;?></span>
                                                <ul class="dropdown scrollable">
                                                    <li><a href="#"><i class="icon-truck icon-large"></i><?= $Lang->DefaultSorting?></a></li>
                                                    <li><a href="#"><i class="icon-plane icon-large"></i><?= $Lang->Sortalphabetically;?></a></li>
                                                    <li><a href="#"><i class="icon-plane icon-large"></i><?= $Lang->Sortbypopularity;?></a></li>
                                                    <li><a href="#"><i class="icon-plane icon-large"></i><?= $Lang->Sortbyaveragerating;?></a></li>
                                                    <li><a href="#"><i class="icon-plane icon-large"></i><?= $Lang->Sortbynewness;?></a></li>
                                                    <li><a href="#"><i class="icon-plane icon-large"></i><?= $Lang->Sortbypricelowtohigh;?></a></li>
                                                    <li><a href="#"><i class="icon-plane icon-large"></i><?= $Lang->Sortbypricehightolow;?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui-panels">
                                    <?php
                                    while ($books = mysqli_fetch_assoc($result)) {
                                        echo PaintBook($books,'TeachertBook');
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="paging">
                                <div class="content">
                                    <?php
                                    echo $pagination[1];
                                    ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".jq_bookdropdown span").css("background-image",$(".catli.active").children("a").css("background-image"));
    $(".jq_bookdropdown span").html($(".catli.active").find("i").html());
</script>

<?php
include_once "includes/footer.php";
?>

