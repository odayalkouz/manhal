<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/7/2016
 * Time: 8:29 AM
 */
$currentTab = "stories";

include_once "includes/function.php";
include_once "platform/includes/function.php";
include_once "includes/header.php";
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/stories.css<?=$cash;?>">

<?php
if($detect->isMobile() || $detect->isTablet())
{
    ?>
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/prostories.css<?=$cash;?>">
    <?php
}
?>

<?php
$sql = "Select * From  series WHERE Publishers=2 " . $series_filter;
$result = $con->query($sql);
$LisSeries = "";
$span = $Lang->AllSeries;
if (mysqli_num_rows($result) > 0) {
    while ($series = mysqli_fetch_assoc($result)) {
        $selected = "";
        if (isset($_GET['series']) && $_GET['series'] == $series["seriesid"]) {
            $selected = 'active';
            $span = $series["name"];
        }
        $LisSeries .= "<li class='$selected' catid='" . $series["seriesid"] . "'><a title='" . $series["name"] . "' href='#'><i class='icon-truck icon-large'>" . $series["name"] . "</i></a></li>";
    }
}
$cat_sql = "Select * From  stories_cat WHERE `parent`=0";
$cat_result = $con->query($cat_sql);
if (mysqli_num_rows($cat_result) > 0) {
    while ($cat_row = mysqli_fetch_assoc($cat_result)) {
        $LisStories_cat .= getCategoriesDropDown($cat_row['catid'], "stories_cat");
    }
}
?>


<?php

if (!$detect->isMobile() || $detect->isTablet()) {
    ?>
    <div class="popup-main-container-a">
        <div class="popup-tabel-a">
            <div class="popup-row-a">
                <div class="popup-cell-a">
                    <div class="popup-container-a">
                        <div class="popup-content-a PopupAdvansedSearch PopupsAdvansedSearchaaa">
                            <form name="advanced_search" id="advanced_search_story" method="get">
                                <input type="hidden" name="search" value="advanced">
                                <div class="padding-container">
                                    <div class="close-container floating-right">
                                        <a class="close floating-right"><i></i></a>
                                    </div>
                                    <div class="top-container">
                                        <div class="box-container-top">
                                            <div class="search-container floating-left">
                                                <input type="text" class="txt-a floating-left" name="keywords"
                                                       placeholder="<?= $Lang->SearchYourItem; ?>" value="">
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
                                                        <div id="subject1" class="jq_bookdropdown wrapper-dropdown-3" tabindex="2">
                                                            <span id="category_spanAdv" style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-En/images/cat/books/all.svg);"
                                                                  class="floating-left"><?= $Lang->All; ?></span>
                                                            <ul class="dropdown scrollable" id="category_adv_ul">
                                                                <input type="hidden" class="hidden_input" name="category" id="category" value="<?php if (isset($_GET['category']) && $_GET['category'] != '') { echo $_GET['category']; } else { echo 0; } ?>">
                                                                <li class="sub-0 no-image" catid="0"><a href="#"><i class="icon-truck icon-large"><label><?= $Lang->All; ?></label></i></a> </li>
                                                                <?= $LisStories_cat; ?>

                                                            </ul>
                                                            <script>
                                                                txt = $("#category_adv_ul li.active").find("label").first().html();
                                                                $("#category_spanAdv").html(txt);
                                                                $("#category_spanAdv").css("background-image", $("#category_adv_ul li.active").find("a").first().css("background-image"));
                                                                $(".jq_bookdropdown span").css("background-image", $(this).children("a").css("background-image"));
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="line-row">
                                                    <label class="lbl-data-a floating-left"><?= $Lang->ByAge; ?></label>
                                                    <div class="wrapper-demo floating-left">
                                                        <div id="age" class="wrapper-dropdown-3" tabindex="3">
                                                            <span id="search_age_span" class="floating-left"><?= $Lang->all; ?></span>
                                                            <ul id="search_age_ul" class="dropdown scrollable">
                                                                <input type="hidden" class="hidden_input" name="search_age" id="search_age" value="<?php if (isset($_GET['search_age']) && $_GET['search_age'] != '') { echo $_GET['search_age']; } else { echo -1; } ?>">
                                                                <li  class="catli <?php  if (isset($_GET['search_age']) && $_GET['search_age'] == '-1'){echo 'active';} ?>" catid="-1"><a href="#"><i class="icon-truck icon-large "><?= $Lang->all; ?></i></a> </li>
                                                                <li class="catli <?php  if (isset($_GET['search_age']) && $_GET['search_age'] == '1'){echo 'active';} ?>" catid="1"><a href="#"><i class="icon-truck icon-large" >4-5</i></a> </li>
                                                                <li class="catli <?php  if (isset($_GET['search_age']) && $_GET['search_age'] == '2'){echo 'active';} ?>" catid="2"><a href="#"><i class="icon-truck icon-large ">6-8</i></a> </li>
                                                                <li class="catli <?php  if (isset($_GET['search_age']) && $_GET['search_age'] == '3'){echo 'active';} ?>" catid="3"><a href="#"><i class="icon-truck icon-large ">9-11</i></a> </li>
                                                                <li class="catli <?php  if (isset($_GET['search_age']) && $_GET['search_age'] == '4'){echo 'active';} ?>" catid="4"><a href="#"><i class="icon-truck icon-large ">12-15</i></a> </li>
                                                            </ul>
                                                            <script>
                                                                txt = $("#search_age_ul li.active").find("i").first().html();
                                                                $("#search_age_span").html(txt);
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="line-row">
                                                    <label class="lbl-data-a floating-left"><?= $Lang->byseries; ?></label>
                                                    <div class="wrapper-demo floating-left">
                                                        <div id="series" class="wrapper-dropdown-3" tabindex="3">
                                                            <span id="series_spanAdv" class="floating-left"><?= $Lang->all; ?></span>
                                                            <ul id="series_ul" class="dropdown scrollable">
                                                                <input type="hidden" class="hidden_input" name="series" id="series" value="<?php if (isset($_GET['series']) && $_GET['series'] != 0) { echo $_GET['series']; } ?>">
                                                                <li><a class="no-images" href="#"><i class="icon-truck icon-large"><?= $Lang->AllSeries; ?></i> </a></li>
                                                                <?= $LisSeries; ?>
                                                            </ul>
                                                            <script>
                                                                txt = $("#series_ul li.active").find("i").first().html();
                                                                $("#series_spanAdv").html(txt);

                                                            </script>
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
                                                            <span id="year_span" class="floating-left"><?= $Lang->all; ?></span>
                                                            <ul id="year_ul" class="dropdown scrollable" style="max-height: 186px">
                                                                <input type="hidden" class="hidden_input" name="search_year" id="search_uear" value="<?php if (isset($_GET['search_year']) && $_GET['search_year'] != 0) { echo $_GET['search_year']; }else{echo '-1';} ?>">
                                                                <li class="catli" catid="-1"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->all; ?></i></a>
                                                                </li>
                                                                <?php
                                                                $earliest_year = 1990;
                                                                $latest_year = date('Y');
                                                                foreach (range($latest_year, $earliest_year) as $i) {
                                                                    $active='';
                                                                    if (isset($_GET['search_year']) && $_GET['search_year'] == $i) {
                                                                        $active='active';
                                                                    }
                                                                    echo ' <li class="catli '.$active.' " catid="' . $i . '"><a href="#"><i class="icon-truck icon-large">' . $i . '</i></a> </li>';
                                                                }
                                                                ?>
                                                            </ul>
                                                            <script>
                                                                txt = $("#year_ul li.active").find("i").first().html();
                                                                $("#year_span").html(txt);

                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ISBN-Number title-tag"><?= $Lang->ISBNNumber; ?></div>
                                            <div class="box-container years">
                                                <div class="line-row">
                                                    <label class="lbl-data-a floating-left"><?= $Lang->ISBNNo; ?></label>
                                                    <input type="text" class="txt-a floating-left" name="isbn" placeholder="<?= $Lang->ISBN; ?>" value="<?php if (isset($_GET['isbn']) ) { echo $_GET['isbn']; } ?>">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-container-filter floating-left">
                                            <div class="language title-tag"><?= $Lang->Language; ?></div>
                                            <div class="box-container years">
                                                <div class="line-row">
                                                    <div class="section-check floating-left">
                                                        <ul>
                                                            <li class="floating-left"><label class="input-control checkbox floating-left">
                                                                    <input type="checkbox" name="language_arabic" id="isArabic" value="<?php if (isset($_GET["language_arabic"]) ) { echo  1;} else if (!isset($_GET["search"])|| isset($_GET["search"]) && $_GET["search"] != 'advanced') { echo  1; }else{echo '0';} ?>" <?php if (isset($_GET["language_arabic"])||!isset($_GET["search"])|| isset($_GET["search"]) && $_GET["search"] != 'advanced' ) { echo 'checked="checked"'; } ?>><span class="check"></span>
                                                                </label> <label for="isArabic" class="text floating-left"><?= $Lang->Arabic; ?></label>
                                                            </li>
                                                            <li class="floating-left"><label
                                                                        class="input-control checkbox floating-left">
                                                                    <input type="checkbox" name="language_english" id="isEnglish" value="<?php if (isset($_GET["language_english"]) ) { echo  1;} else if (!isset($_GET["search"])|| isset($_GET["search"]) && $_GET["search"] != 'advanced') { echo  1;  }else{echo '0';} ?>" <?php if (isset($_GET["language_english"])||!isset($_GET["search"])|| isset($_GET["search"]) && $_GET["search"] != 'advanced' ) { echo 'checked="checked"'; } ?>><span class="check"></span>
                                                                </label> <label for="isEnglish"
                                                                                class="text floating-left"><?= $Lang->English; ?></label>
                                                            </li>
                                                            <li class="floating-left"><label
                                                                        class="input-control checkbox floating-left">
                                                                    <input type="checkbox" name="language_french" id="isFrench" value="<?php if (isset($_GET["language_french"]) ) { echo  1;} else if (!isset($_GET["search"])|| isset($_GET["search"]) && $_GET["search"] != 'advanced') { echo  1;  }else{echo '0';} ?>" <?php if (isset($_GET["language_french"])||!isset($_GET["search"])|| isset($_GET["search"]) && $_GET["search"] != 'advanced' ) { echo 'checked="checked"'; } ?>><span class="check"></span>
                                                                </label> <label for="isFrench"
                                                                                class="text floating-left"><?= $Lang->France; ?></label>
                                                            </li>
                                                        </ul>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="price floating-left title-tag"><?= $Lang->Price; ?></div>
                                            <div class="box-container years2">
                                                <div class="line-row">
                                                    <label class="lbl-data-b floating-left text-left"><?= $Lang->From; ?></label>
                                                    <label class="lbl-data-c floating-left">$</label>
                                                    <input type="number" name="price_from" class="floating-left" value="<?php if (isset($_GET["price_from"]) ) { echo  $_GET["price_from"]; }else{echo '0';} ?>" min="0" max="1000">
                                                    <label class="lbl-data-b floating-left"><?= $Lang->TO; ?></label>
                                                    <label class="lbl-data-c floating-left">$</label>
                                                    <input type="number" name="price_to" class="floating-left" value="<?php if (isset($_GET["price_to"]) ) { echo  $_GET["price_to"]; }else{echo '1000';} ?>" min="0" max="1000">
                                                </div>
                                            </div>
                                            <div class="option title-tag"><?= $Lang->Option; ?></div>
                                            <div class="box-container">
                                                <div class="line-row">
                                                    <div class="section-check-row floating-left">
                                                        <ul>
                                                            <li class="floating-left">
                                                                <label class="input-control checkbox floating-left">
                                                                    <input type="checkbox" name="paperbook" id="isBooks" value="<?php if (isset($_GET["paperbook"]) ) { echo  1; }else{echo '0';} ?>" <?php if (isset($_GET["paperbook"]) ) { echo 'checked="checked"'; } ?>><span class="check"></span>
                                                                </label>
                                                                <label for="isBooks"
                                                                       class="text floating-left"><?= $Lang->PaperStory; ?></label>
                                                            </li>
                                                            <li class="floating-left">
                                                                <label class="input-control checkbox floating-left">
                                                                    <input type="checkbox" name="ebook" id="isEbooks" value="<?php if (isset($_GET["ebook"]) ) { echo  2; }else{echo '0';} ?>" <?php if (isset($_GET["ebook"]) ) { echo 'checked="checked"'; } ?>><span class="check"></span>
                                                                </label>
                                                                <label for="isEbooks"
                                                                       class="text floating-left"><?= $Lang->estories; ?></label>
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
<div class="inner-pages-main-container-stories">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <form class="stories-search text-left" METHOD="GET" id="Books_search">
                        <div class="right-col-3 floating-left">
                        <div class="stories-main-container-page clear-both">
                            <div class="top-black-col">
                                <div class="floating-left">
                                    <label class="lbl-data-a floating-left"><?=$Lang->Category;?></label>
                                    <div class="wrapper-demo">
                                        <div id="subject" class="wrapper-dropdown-3" tabindex="2">
                                            <?php
                                            $Lis="";

                                                $age_filter = "";
                                                if (isset($_GET["search_age"]) && $_GET["search_age"] != -1) {
                                                    $age_filter = " AND `story`.`age`=" . $_GET["search_age"];
                                                }
                                                $year_filter="";
                                                if(isset($_GET["search_year"]) && $_GET["search_year"]!=-1){
                                                    $year_filter = " AND `story`.`year`=".$_GET["search_year"];
                                                }
                                                $isbn_filter="";
                                                if(isset($_GET["isbn"]) && trim($_GET["isbn"])!=""){
                                                    $isbn_filter = " AND `story`.`isbn`='".$_GET["isbn"]."'";
                                                }
                                            $keyword_filter="";
                                            if(isset($_GET['keywords']) && $_GET['keywords']!=""){
                                                $keyword_filter=" AND (`story`.`title` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%' OR `story`.`isbn` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%' OR `series`.`name` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%')";
                                            }
                                            $cat_filter="";
                                            $series_filter="";
                                            if(isset($_GET['category']) && $_GET['category']!=0){
                                                $series_filter=" AND category=".$_GET['category'];
                                                $cat_filter=" AND `stories_cat`.`catid` = ".$_GET['category'];
                                            }
                                            $series_filter_stories="";
                                            if(isset($_GET['series']) && $_GET['series']!=0){
                                                $series_filter_stories=" AND `series`.`seriesid` = ".$_GET['series'];
                                            }

                                                $lang_filter="";
                                                $lang_filter2="";
                                                if(isset($_GET["search"]) && $_GET["search"]=="advanced"){


                                                    $lang_filter=" AND (";
                                                    if(isset($_GET["language_arabic"]) && $_GET["language_arabic"]==1){
                                                        $lang_filter2.="`story`.`language`='Ar'";
                                                }
                                                    if(isset($_GET["language_english"]) && $_GET["language_english"]==1){
                                                        if($lang_filter2==""){
                                                            $lang_filter2="`story`.`language`='En'";
                                                        }else{
                                                            $lang_filter2.=" OR `story`.`language`='En'";
                                            }


                                                    }
                                                    if(isset($_GET["language_french"]) && $_GET["language_french"]==1){
                                                        if($lang_filter2==""){
                                                            $lang_filter2.="`story`.`language`='Fr'";
                                                        }else{
                                                            $lang_filter2.=" OR `story`.`language`='Fr'";
                                                        }

                                                    }


                                                    if(isset($_GET["language_french"])||isset($_GET["language_english"])||isset($_GET["language_arabic"])) {
                                                        $lang_filter .= $lang_filter2 . ") ";
                                                    }else{
                                                        $lang_filter="";
                                                    }

                                                }
                                                $price_filter="";
                                                if(isset($_GET["search"]) && $_GET["search"]=="advanced") {
                                                    if (isset($_GET["price_from"]) && isset($_GET["price_to"])) {
                                                        $price_filter = " AND `story`.`price` BETWEEN  " . $_GET["price_from"] . " AND " . $_GET["price_to"] . " ";
                                                    }
                                                }

                                            $type_filter="";
                                            if(isset($_GET["book_type"]) && trim($_GET["book_type"])!=""){
                                                switch($_GET["book_type"]){
                                                    case "electronic":
                                                        $type_filter = " AND `story`.`type` in(2,3,6,7)";
                                                        break;
                                                    case "interactive":
                                                        $type_filter = " AND `story`.`type` in(4,5,6,7)";
                                                        break;
                                                    case "paper";
                                                        $type_filter = " AND `story`.`type` in(1,3,5,7)";
                                                        break;
                                                    default :
                                                        $type_filter = " AND `story`.`type` in(1,3,5,7)";
                                                        break;
                                                }
                                            }


                                            ?>
                                            <span style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-En/images/cat/books/all.svg);" class="floating-left" id="category_span"><?= $Lang->All; ?></span>
                                            <ul class="dropdown submit scrollable" id="category_ul">
                                                <input type="hidden" class="hidden_input" name="category" id="category" value="<?php if(isset($_GET['category']) && $_GET['category']!=''){echo $_GET['category'];}else{echo 0;}?>">
                                                <li class="sub-0 no-image" catid="0"><a href="#"><i class="icon-truck icon-large"></i><label><?= $Lang->All; ?></label></a></li>
                                                    <?= $LisStories_cat; ?>
                                            </ul>
                                            <script>
                                                txt=$("#category_ul li.active").find("label").first().html();
                                                $("#category_span").html(txt);
                                                $("#category_span").css("background-image",$("#category_ul li.active").find("a").first().css("background-image"));
                                                $(".jq_bookdropdown span").css("background-image",$(this).children("a").css("background-image"));
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="floating-left">
                                    <label class="lbl-data-a floating-left stories"><?=$Lang->Series;?></label>
                                    <div class="wrapper-demo">
                                            <div id="subject2" class="wrapper-dropdown-3" tabindex="2">
                                                <span id="series_spanAdv2" class="floating-left"><?= $span; ?></span>
                                                <ul id="series_ul2" class="dropdown submit scrollable">
                                                <input type="hidden" class="hidden_input" name="series" id="series" value="<?php if(isset($_GET['series']) && $_GET['series']!=0){echo $_GET['series'];}?>">
                                                <li><a class="no-images" href="#"><i class="icon-truck icon-large"></i><?= $Lang->AllSeries; ?></a></li>
                                                    <?= $LisSeries; ?>
                                            </ul>
                                                <script>
                                                    txt = $("#series_ul2 li.active").find("i").first().html();

                                                    $("#series_spanAdv2").html(txt);

                                                </script>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    $sql = "SELECT `story`.*,`stories_cat`.*,`series`.*,`story`.`rating_count` as rate_count FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid`  WHERE `story`.`status`=1 AND `story`.`store`=0 AND `story`.`is_media`=0 AND( `story`.`storyid`>0  " . $keyword_filter . $cat_filter . $age_filter.$year_filter.$isbn_filter .$lang_filter.$price_filter. $series_filter_stories . $type_filter . " ) ";
                                $result=$con->query($sql);
                                $num_rows=mysqli_num_rows($result);
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





                                $pagination=getPagination($url,$num_rows);
                                    $sql = "SELECT `story`.*,`stories_cat`.*,`series`.*,`story`.`rating_count` as rate_count FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid` WHERE `story`.`status`=1 AND `story`.`store`=0 AND `story`.`is_media`=0  AND( `story`.`storyid`>0 " . $keyword_filter . $cat_filter . $age_filter.$year_filter .$isbn_filter.$lang_filter.$price_filter. $series_filter_stories . $type_filter . " ) ORDER BY `series`.`seriesid` DESC ,`story`.`storyid` DESC " . $pagination[0];
                                $result=$con->query($sql);
                                ?>
                                <div class="floating-right">
                                    <div class="right-search-container floating-left">
                                        <input placeholder="<?= $Lang->SearchYourItem; ?>" type="text" class="txt-a floating-left" name="keywords" value="<?php if(isset($_GET['keywords'])){echo $_GET['keywords'];}?>">
                                        <input type="submit" class="btn btn-search floating-left" value="">
                                    </div>
                                </div>
                                    <?php
                                    if (!$detect->isMobile() || $detect->isTablet()) {
                                        ?>
                                        <a data-type="ContainersAdvansedSearchaaa"
                                           class="btn-popup-a advansd-search-button floating-right"
                                           title="<?= $Lang->Advansedsearch; ?>"><?= $Lang->Advansedsearch; ?></a>
                                        <?php
                                    }
                                    ?>
                                <div class="floating-right sort-by-list-container">
                                    <label class="lbl-data-b floating-left"><?= $Lang->SortBy;?></label>
                                    <div class="wrapper-demo">
                                        <div id="sortby" class="wrapper-dropdown-3" tabindex="1">
                                            <span class="floating-left"><?= $Lang->Sortalphabetically;?></span>
                                            <ul class="dropdown scrollable">
                                                <li><a href="#"><i class="icon-truck icon-large"></i><?= $Lang->DefaultSorting;?></a></li>
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

                                    if(((isset($_GET['page']) && $_GET['page']<2) || !isset($_GET['page']) || $_GET['page']=='') && !isset($_GET['search']) && !isset($_GET['category'])){
                                        include_once ("stories_campain.php");
                                    }


                                    while($story=mysqli_fetch_assoc($result)){
                                        echo PaintStory($story);
                                    }
                                    ?>
                            </div>
                            </div>
                    </form>
                    <section class="paging">
                        <div class="content">
                            <?php
                            echo $pagination[1];
                            ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
//    $(document).ready(function() {
//
//        $('input[type="checkbox"]').change(function () {
//            var val="";
//            if($(this).is(':checked')){
//                val=1
//            }
//            $(this).val(val);
//        });
//    })

</script>
<?php

include_once "includes/footer.php";
?>


