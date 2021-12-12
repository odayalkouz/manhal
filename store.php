<?php

$currentTab = "store";
include "includes/function.php";
include_once "platform/includes/function.php";
include("includes/header.php");
$real_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/worksheet.css<?= $cash; ?>">

<?php
if($detect->isMobile() || $detect->isTablet())
{
    ?>
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/proworksheet.css<?=$cash;?>">
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
                                                        <div id="subject1" class="jq_bookdropdown wrapper-dropdown-3"
                                                             tabindex="2">
                                                            <span id="category_spanAdv"
                                                                  style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-En/images/cat/books/all.svg);"
                                                                  class="floating-left"><?= $Lang->All; ?></span>
                                                            <ul id="category_adv_ul" class="dropdown scrollable">
                                                                <input type="hidden" class="hidden_input"
                                                                       name="category" id="search_category"
                                                                       value="<?php if (isset($_GET['category']) && $_GET['category'] != '') {
                                                                           echo $_GET['category'];
                                                                       } else {
                                                                           echo 0;
                                                                       } ?>">
                                                                <li><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->All; ?></i></a>
                                                                </li>
                                                                <?php
                                                                $cat_sql = "Select * From  categories WHERE `parent`=0";
                                                                $cat_result = $con->query($cat_sql);
                                                                if (mysqli_num_rows($cat_result) > 0) {
                                                                    while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                                                        echo getCategoriesDropDown($cat_row['catid'], "categories");
                                                                    }
                                                                }
                                                                ?>
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
                                                    <label class="lbl-data-a floating-left"><?= $Lang->ByGrade; ?></label>
                                                    <div class="wrapper-demo floating-left">
                                                        <div id="grade" class="wrapper-dropdown-3" tabindex="3">
                                                            <span id="search_grade_span"
                                                                  class="floating-left"><?= $Lang->all; ?></span>
                                                            <ul id="search_grade_ul" class="dropdown scrollable">
                                                                <input type="hidden" class="hidden_input"
                                                                       name="search_grade" id="search_grade"
                                                                       value="<?php if (isset($_GET['search_grade']) && $_GET['search_grade'] != '') {
                                                                           echo $_GET['search_grade'];
                                                                       } else {
                                                                           echo -1;
                                                                       } ?>">
                                                                <li class="acatli<?php if (isset($_GET['search_grade']) && $_GET['search_grade'] == '-1') {
                                                                    echo ' active';
                                                                } ?>" catid="-1"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->all; ?></i></a>
                                                                </li>
                                                                <li class="acatli<?php if (isset($_GET['search_grade']) && $_GET['search_grade'] == '0') {
                                                                    echo ' active';
                                                                } ?>" catid="0"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Kindergarten; ?></i></a>
                                                                </li>
                                                                <li class="acatli<?php if (isset($_GET['search_grade']) && $_GET['search_grade'] == '1') {
                                                                    echo ' active';
                                                                } ?>" catid="1"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            1</i></a></li>
                                                                <li class="acatli<?php if (isset($_GET['search_grade']) && $_GET['search_grade'] == '2') {
                                                                    echo ' active';
                                                                } ?>" catid="2"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            2</i></a></li>
                                                                <li class="acatli<?php if (isset($_GET['search_grade']) && $_GET['search_grade'] == '3') {
                                                                    echo ' active';
                                                                } ?>" catid="3"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            3</i></a></li>
                                                                <li class="acatli<?php if (isset($_GET['search_grade']) && $_GET['search_grade'] == '4') {
                                                                    echo ' active';
                                                                } ?>" catid="4"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            4</i></a></li>
                                                                <li class="acatli<?php if (isset($_GET['search_grade']) && $_GET['search_grade'] == '5') {
                                                                    echo ' active';
                                                                } ?>" catid="5"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            5</i></a></li>
                                                                <li class="acatli<?php if (isset($_GET['search_grade']) && $_GET['search_grade'] == '6') {
                                                                    echo ' active';
                                                                } ?>" catid="6"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            6</i></a></li>
                                                                <li class="acatli<?php if (isset($_GET['search_grade']) && $_GET['search_grade'] == '7') {
                                                                    echo ' active';
                                                                } ?>" catid="7"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            7</i></a></li>
                                                                <li class="acatli<?php if (isset($_GET['search_grade']) && $_GET['search_grade'] == '8') {
                                                                    echo ' active';
                                                                } ?>" catid="8"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            8</i></a></li>
                                                                <li class="acatli<?php if (isset($_GET['search_grade']) && $_GET['search_grade'] == '9') {
                                                                    echo ' active';
                                                                } ?>" catid="9"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            9</i></a></li>
                                                                <li class="acatli<?php if (isset($_GET['search_grade']) && $_GET['search_grade'] == '10') {
                                                                    echo ' active';
                                                                } ?>" catid="10"><a href="#"><i
                                                                                class="icon-truck icon-large"><?= $Lang->Grade; ?>
                                                                            10</i></a></li>
                                                            </ul>
                                                            <script>
                                                                txt = $("#search_grade_ul li.active").find("i").first().html();
                                                                $("#search_grade_span").html(txt);
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="line-row">
                                                    <label class="lbl-data-a floating-left"><?= $Lang->ByAge; ?></label>
                                                    <div class="wrapper-demo floating-left">
                                                        <div id="age" class="wrapper-dropdown-3" tabindex="3">
                                                            <span id="search_age_span"
                                                                  class="floating-left"><?= $Lang->all; ?></span>
                                                            <ul id="search_age_ul" class="dropdown scrollable">
                                                                <input type="hidden" class="hidden_input"
                                                                       name="search_age" id="search_age"
                                                                       value="<?php if (isset($_GET['search_age'])) {
                                                                           echo $_GET['search_age'];
                                                                       } else {
                                                                           echo '-1';
                                                                       } ?>">
                                                                <li class="<?php if (isset($_GET['search_age']) && $_GET['search_age'] == '-1') {
                                                                    echo ' active';
                                                                } ?>"><a href="#"><i
                                                                                class="icon-truck icon-large "><?= $Lang->all; ?></i></a>
                                                                </li>
                                                                <li class="<?php if (isset($_GET['search_age']) && $_GET['search_age'] == '1') {
                                                                    echo ' active';
                                                                } ?>" catid="1"><a href="#"><i
                                                                                class="icon-truck icon-large">4-5</i></a>
                                                                </li>
                                                                <li class="<?php if (isset($_GET['search_age']) && $_GET['search_age'] == '2') {
                                                                    echo ' active';
                                                                } ?>" catid="2"><a href="#"><i
                                                                                class="icon-truck icon-large ">6-8</i></a>
                                                                </li>
                                                                <li class="<?php if (isset($_GET['search_age']) && $_GET['search_age'] == '3') {
                                                                    echo ' active';
                                                                } ?>" catid="3"><a href="#"><i
                                                                                class="icon-truck icon-large ">9-11</i></a>
                                                                </li>
                                                                <li class="<?php if (isset($_GET['search_age']) && $_GET['search_age'] == '4') {
                                                                    echo ' active';
                                                                } ?>" catid="4"><a href="#"><i
                                                                                class="icon-truck icon-large ">12-15</i></a>
                                                                </li>
                                                            </ul>
                                                            <script>
                                                                txt = $("#search_age_ul li.active").find("i").first().html();
                                                                $("#search_age_span").html(txt);
                                                            </script>
                                                        </div>
                                                    </div>
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
                                                                           id="isArabic"


                                                                           value="<?php if (isset($_GET["language_arabic"])) {
                                                                               echo '1';
                                                                           } else if (!isset($_GET["search"])|| isset($_GET["search"]) && $_GET["search"] != 'advanced') {
                                                                               echo '1';
                                                                           } else {
                                                                               echo '';
                                                                           } ?>" <?php if (isset($_GET["language_arabic"]) || !isset($_GET["search"])||isset($_GET["search"]) && $_GET["search"] != 'advanced') {
                                                                        echo 'checked="checked"';
                                                                    } ?>><span class="check"></span> </label>
                                                                <label for="isArabic"
                                                                       class="text floating-left"><?= $Lang->Arabic; ?></label>
                                                            </li>
                                                            <li class="floating-left">
                                                                <label class="input-control checkbox floating-left">
                                                                    <input type="checkbox" name="language_english"
                                                                           id="isEnglish"
                                                                           value="<?php if (isset($_GET["language_english"])) {
                                                                               echo '1';
                                                                           } else if (!isset($_GET["search"])|| isset($_GET["search"]) && $_GET["search"] != 'advanced') {
                                                                               echo '1';
                                                                           } else {
                                                                               echo '';
                                                                           } ?>" <?php if (isset($_GET["language_english"])||!isset($_GET["search"])|| isset($_GET["search"]) && $_GET["search"] != 'advanced') {
                                                                        echo 'checked="checked"';
                                                                    } ?>><span class="check"></span> </label>
                                                                <label for="isEnglish"
                                                                       class="text floating-left"><?= $Lang->English; ?></label>
                                                            </li>
                                                            <li class="floating-left">
                                                                <label class="input-control checkbox floating-left">
                                                                    <input type="checkbox" name="language_french"
                                                                           id="isFrench"
                                                                           value="<?php if (isset($_GET["language_french"])) {
                                                                               echo '1';
                                                                           } else if (!isset($_GET["search"])|| isset($_GET["search"]) && $_GET["search"] != 'advanced') {
                                                                               echo '1';
                                                                           } else {
                                                                               echo '';
                                                                           } ?>" <?php if (isset($_GET["language_french"])|| !isset($_GET["search"])||isset($_GET["search"]) && $_GET["search"] != 'advanced') {
                                                                        echo 'checked="checked"';
                                                                    } ?>><span class="check"></span>
                                                                </label>
                                                                <label for="isFrench"
                                                                       class="text floating-left"><?= $Lang->France; ?></label>
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
<div class="inner-pages-main-container-worksheet with-out-bg" style="min-height:1000px">
    <?= $breadCrumbs; ?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <form class="worksheet-search" METHOD="GET" id="books_search">
                        <input type="hidden" name="type" value="<?=$_GET["type"];?>">
                        <input type="hidden" name="search" value="simple">
                        <div class="right-col-3 floating-left">
                            <div class="books-main-container-page clear-both">
                                <div class="top-black-col">

                                    <?php
                                    if($_GET["type"]=="books" || $_GET["type"]=="stories"){
                                        if($_GET["type"]=="books"){
                                            ?>
                                            <div class="floating-left">
                                                <label class="lbl-data-a floating-left stories"><?= $Lang->Bysubject; ?></label>
                                                <div class="wrapper-demo floating-left">
                                                    <div id="subject" class="jq_bookdropdown wrapper-dropdown-3" tabindex="2">
                                                <span style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-En/images/cat/books/all.svg);"
                                                      class="floating-left"><?= $Lang->All; ?></span>
                                                        <ul class="dropdown submit scrollable">
                                                            <input class="hidden_input" type="hidden" name="category"
                                                                   value="<?php if (isset($_GET['category'])) {
                                                                       echo $_GET['category'];
                                                                   } ?>" id="hidden_category_book">
                                                            <li class="catli sub-0 no-image" catid="0">
                                                                <a href="#"><i
                                                                            class="icon-truck icon-large"><?= $Lang->All; ?></i></a>
                                                            </li>
                                                            <?php
                                                            $cat_sql = "Select * From  categories WHERE `parent`=0";
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
                                            <?php
                                        }else{
                                            ?>
                                            <div class="floating-left">
                                                <label class="lbl-data-a floating-left stories"><?= $Lang->Bysubject; ?></label>
                                                <div class="wrapper-demo floating-left">
                                                    <div id="subject" class="jq_bookdropdown wrapper-dropdown-3" tabindex="2">
                                                <span style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-En/images/cat/books/all.svg);"
                                                      class="floating-left"><?= $Lang->All; ?></span>
                                                        <ul class="dropdown submit scrollable">
                                                            <input class="hidden_input" type="hidden" name="category"
                                                                   value="<?php if (isset($_GET['category'])) {
                                                                       echo $_GET['category'];
                                                                   } ?>" id="hidden_category_book">
                                                            <li class="catli sub-0 no-image" catid="0">
                                                                <a href="#"><i
                                                                            class="icon-truck icon-large"><?= $Lang->All; ?></i></a>
                                                            </li>
                                                            <?php
                                                            $cat_sql = "Select * From  stories_cat";
                                                            $cat_result = $con->query($cat_sql);
                                                            if (mysqli_num_rows($cat_result) > 0) {
                                                                while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                                                    echo  getCategoriesDropDown($cat_row['catid'], "stories_cat");
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                        ?>

                                        <div class="floating-left">
                                            <label class="lbl-data-a floating-left stories"><?= $Lang->ByPublisher; ?></label>
                                            <div class="wrapper-demo floating-left">
                                                <div id="publishers" class="wrapper-dropdown-3" tabindex="3">
                                                <span style=""
                                                      class="floating-left"><?= $Lang->All; ?></span>
                                                    <ul class="dropdown submit scrollable">
                                                        <input class="hidden_input" type="hidden" name="publisher"
                                                               value="<?php if (isset($_GET['publisher'])) {
                                                                   echo $_GET['publisher'];
                                                               } ?>" id="hidden_publisher_book">
                                                        <li class="catli sub-0 no-image" catid="0">
                                                            <a href="#"><i
                                                                        class="icon-truck icon-large"><?= $Lang->All; ?></i></a>
                                                        </li>
                                                        <?php
                                                        $cat_sql = "Select * From  publishers";
                                                        $cat_result = $con->query($cat_sql);
                                                        if (mysqli_num_rows($cat_result) > 0) {
                                                            while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                                                if(isset($_GET["publisher"]) && $_GET["publisher"]==$cat_row["pid"]){
                                                                    $selected=' selected ';
                                                                }else{
                                                                    $selected=' ';
                                                                }
                                                                $level=0;
                                                                echo '<li title="' . $cat_row['name_' . $cat_code] . '" index="' . $level . '" class="sub-' . $level . ' catli ' . $selected . ' no-image" catid="' . $cat_row['pid'] . '"><a title="' . $cat_row['pname_' . $cat_code] . '" href="#" ><i class="icon-truck icon-large"><label>' . $cat_row['pname_' . $cat_code] . '</label></i></a></li>';

                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }elseif($_GET["type"]=="toys"){

                                                        ?>


                                        <div class="floating-left">
                                            <label class="lbl-data-a floating-left stories"><?= $Lang->ByPublisher; ?></label>
                                            <div class="wrapper-demo floating-left">
                                                <div id="brand" class="wrapper-dropdown-3" tabindex="3">
                                                <span style=""
                                                      class="floating-left"><?= $Lang->All; ?></span>
                                                    <ul class="dropdown submit scrollable">
                                                        <input class="hidden_input" type="hidden" name="brand"
                                                               value="<?php if (isset($_GET['brand'])) {
                                                                   echo $_GET['brand'];
                                                               } ?>" id="hidden_brand_book">
                                                        <li class="catli sub-0 no-image" catid="0">
                                                            <a href="#"><i
                                                                        class="icon-truck icon-large"><?= $Lang->All; ?></i></a>
                                                        </li>
                                                        <?php
                                                        $cat_sql = "Select * From  brand";
                                                        $cat_result = $con->query($cat_sql);
                                                        if (mysqli_num_rows($cat_result) > 0) {
                                                            while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                                                if(isset($_GET["brand"]) && $_GET["brand"]==$cat_row["catid"]){
                                                                    $selected=' selected ';
                                                                }else{
                                                                    $selected=' ';
                                                                }
                                                                $level=0;
                                                                echo '<li title="' . $cat_row['name_' . $cat_code] . '" index="' . $level . '" class="sub-' . $level . ' catli ' . $selected . ' no-image" catid="' . $cat_row['catid'] . '"><a title="' . $cat_row['name_' . $cat_code] . '" href="#" ><i class="icon-truck icon-large"><label>' . $cat_row['name_' . $cat_code] . '</label></i></a></li>';

                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="floating-left">
                                            <label class="lbl-data-a floating-left stories"><?= $Lang->ByDepartment; ?></label>
                                            <div class="wrapper-demo floating-left">
                                                <div id="department" class="wrapper-dropdown-3" tabindex="3">
                                                <span style=""
                                                      class="floating-left"><?= $Lang->All; ?></span>
                                                    <ul class="dropdown submit scrollable">
                                                        <input class="hidden_input" type="hidden" name="department"
                                                               value="<?php if (isset($_GET['department'])) {
                                                                   echo $_GET['department'];
                                                               } ?>" id="hidden_department_book">
                                                        <li class="catli sub-0 no-image" catid="0">
                                                            <a href="#"><i
                                                                        class="icon-truck icon-large"><?= $Lang->All; ?></i></a>
                                                        </li>
                                                        <?php
                                                        $cat_sql = "Select * From  departments";
                                                        $cat_result = $con->query($cat_sql);
                                                        if (mysqli_num_rows($cat_result) > 0) {
                                                            while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                                                if(isset($_GET["department"]) && $_GET["department"]==$cat_row["catid"]){
                                                                    $selected=' selected ';
                                                                }else{
                                                                    $selected=' ';
                                                                }
                                                                $level=0;
                                                                echo '<li title="' . $cat_row['name_' . $cat_code] . '" index="' . $level . '" class="sub-' . $level . ' catli ' . $selected . ' no-image" catid="' . $cat_row['catid'] . '"><a title="' . $cat_row['name_' . $cat_code] . '" href="#" ><i class="icon-truck icon-large"><label>' . $cat_row['name_' . $cat_code] . '</label></i></a></li>';

                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>


                                    <div class="right-search-container floating-right">
                                        <input type="text" class="txt-a floating-left" name="keywords"
                                               placeholder="<?= $Lang->SearchYourItem; ?>"
                                               value="<?php if (isset($_GET['keywords'])) {
                                                   echo $_GET['keywords'];
                                               } ?>">
                                        <input type="submit" class="btn btn-search floating-left" value="">
                                    </div>
                                    <?php
                                    if(!$detect->isMobile() || $detect->isTablet()) {
                                        ?>
                                        <a style="display: none;" data-type="ContainersAdvansedSearchaaa "
                                           class="btn-popup-a advansd-search-button floating-right store" title="<?= $Lang->Advansedsearch;?>"></a>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="ui-panels-worksheet">
                                    <?php
                                    if(isset($_GET["type"]) && $_GET["type"]=="books"){
                                        $data=prepareBooks();
                                        while ($books = mysqli_fetch_assoc($data["result"])) {
                                            echo PaintStoreBook($books, 'StudentBook');
                                        }
                                    }elseif (isset($_GET["type"]) && $_GET["type"]=="stories"){
                                        $data=prepareStories();
                                        while ($books = mysqli_fetch_assoc($data["result"])) {
                                            echo PaintStoreBook($books, 'story');
                                        }
                                    }else{//toys
                                        $data=prepareToys();
                                        while ($books = mysqli_fetch_assoc($data["result"])) {
                                            echo PaintStoreToys($books, 'toy');
                                        }
                                    }





                                    ?>



                                    <div class="paging">
                                        <div class="content">
                                            <?php
                                            echo $data["pagination"][1];
                                            ?>
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
    <div id="Game-play-iframe">
        <div class="manhal-loader-main-container" style="display: none;">
            <div class="manhal-loader-content">
                <div class="sk-cube-grid">
                    <div class="sk-cube sk-cube1"></div>
                    <div class="sk-cube sk-cube2"></div>
                    <div class="sk-cube sk-cube3"></div>
                    <div class="sk-cube sk-cube4"></div>
                    <div class="sk-cube sk-cube5"></div>
                    <div class="sk-cube sk-cube6"></div>
                    <div class="sk-cube sk-cube7"></div>
                    <div class="sk-cube sk-cube8"></div>
                    <div class="sk-cube sk-cube9"></div>
                </div>
            </div>
        </div>
        <iframe id="jq-iframe" onload="hidePopLoader();" class="Game-play-iframe" src="" width="100%" height="100%" frameborder="0px"></iframe>
        <div class="exit-full-screen"></div>
    </div>
    <script>

        $(document).ready(function () {

            $('input[type="checkbox"]').change(function () {
                var val = "";
                if ($(this).is(':checked')) {
                    val = 1
                }
                $(this).val(val);
            });
        })
        $(".jq_bookdropdown span").css("background-image", $(".catli.active").children("a").css("background-image"));
        $(".jq_bookdropdown span").html($(".catli.active").find("i").html());
    </script>
    <?php

    include("includes/footer.php");

    function prepareBooks(){
        global $real_link;
        global $con;
        $grade_filter = "";
        if (isset($_GET["search_grade"]) && $_GET["search_grade"] != -1) {
            $grade_filter = " AND `books`.`grade`=" . $_GET["search_grade"];
        }

        $age_filter = "";
        if (isset($_GET["search_age"]) && $_GET["search_age"] != -1) {
            $age_filter = " AND `books`.`age`=" . $_GET["search_age"];
        }
        $year_filter = "";
        if (isset($_GET["search_year"]) && $_GET["search_year"] != -1) {
            $year_filter = " AND `books`.`year`=" . $_GET["search_year"];
        }

        $isbn_filter = "";
        if (isset($_GET["isbn"]) && trim($_GET["isbn"]) != "") {
            $isbn_filter = " AND `books`.`isbn`='" . $_GET["isbn"] . "'";
        }


        $lang_filter = "";
        $lang_filter2 = "";
        if (isset($_GET["search"]) && $_GET["search"] == "advanced") {
            $lang_filter = " AND (";
            if (isset($_GET["language_arabic"]) && $_GET["language_arabic"] == 1) {
                $lang_filter2 .= "`books`.`language`='Ar'";
            }
            if (isset($_GET["language_english"]) && $_GET["language_english"] == 1) {
                if ($lang_filter2 == "") {
                    $lang_filter2 = "`books`.`language`='En'";
                } else {
                    $lang_filter2 .= " OR `books`.`language`='En'";
                }


            }
            if (isset($_GET["language_french"]) && $_GET["language_french"] == 1) {
                if ($lang_filter2 == "") {
                    $lang_filter2 .= "`books`.`language`='Fr'";
                } else {
                    $lang_filter2 .= " OR `books`.`language`='Fr'";
                }

            }


            if (isset($_GET["language_french"]) || isset($_GET["language_english"]) || isset($_GET["language_arabic"])) {
                $lang_filter .= $lang_filter2 . ") ";
            } else {
                $lang_filter = "";
            }

        }

        $price_filter = "";
        if (isset($_GET["search"]) && $_GET["search"] == "advanced") {
            if (isset($_GET["price_from"]) && isset($_GET["price_to"])) {
                $price_filter = " AND `books`.`price` BETWEEN  " . $_GET["price_from"] . " AND " . $_GET["price_to"] . " ";
            }
        }




        $keyword_filter = "";
        if (isset($_GET['keywords']) && $_GET['keywords'] != "") {
            $keyword_filter = " AND ( `name` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `description_ar` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `description_en` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `author_en` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `author_ar` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `isbn` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' )";
        }
        $cat_filter = "";
        if (isset($_GET['category']) && $_GET['category'] != 0) {
            $cat_filter = " AND `catid` = " . $_GET['category'];
        }

        $publisher_filter = "";
        if (isset($_GET['publisher']) && $_GET['publisher'] != 0) {
            $publisher_filter = " AND `publisher` = " . $_GET['publisher'];
        }

        //$sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status` =1 AND( `books`.`bookid`>0 " . $keyword_filter . $cat_filter.$grade_filter.$age_filter.$year_filter.$isbn_filter.$lang_filter.$price_filter.$semester_filter.$booktype_filter.$type_filter." ) ORDER BY `books`.`name` DESC";
        $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status` =1 AND `books`.`store`=1 AND( `books`.`status`=1 " . $keyword_filter . $cat_filter . $grade_filter . $age_filter . $year_filter . $isbn_filter . $lang_filter . $price_filter . $publisher_filter. " ) ORDER BY `books`.`bookid` DESC";
        $result = $con->query($sql);
        $num_rows = mysqli_num_rows($result);

        $link = $real_link;
        if (isset($_GET["page"]) && $_GET["page"] != "") {
            $link = str_replace("&page=" . $_GET["page"], "", $link);
        }

        $url_arr = explode("/", $real_link);
        $url_arr = explode("?", $url_arr[count($url_arr) - 1]);
        $url = $url_arr[0] . "?";

        if (strpos($link, "?") === false) {
            $url = $url_arr[0] . "?";
        } else {
            $arr = explode("?", $link);
            $getData = explode("&", $arr[1]);
            $url = $url_arr[0] . "?" . $arr[1];
        }

        $pagination = getPagination($url, $num_rows);
        $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status` =1 AND `books`.`store`=1 AND( `books`.`status`=1 " . $keyword_filter . $cat_filter . $grade_filter . $age_filter . $year_filter . $isbn_filter . $lang_filter . $price_filter  . $publisher_filter. " ) " . " ORDER BY `books`.`bookid` DESC " . $pagination[0];
        $result = $con->query($sql);
        return array("pagination"=>$pagination,"result"=>$result);
    }

    function prepareToys(){
        global $real_link;
        global $con;

        $age_filter = "";
        if (isset($_GET["search_age"]) && $_GET["search_age"] != -1) {
            $age_filter = " AND `books`.`age`=" . $_GET["search_age"];
        }

        $isbn_filter = "";
        if (isset($_GET["isbn"]) && trim($_GET["isbn"]) != "") {
            $isbn_filter = " AND `books`.`isbn`='" . $_GET["isbn"] . "'";
        }

        $price_filter = "";
        if (isset($_GET["search"]) && $_GET["search"] == "advanced") {
            if (isset($_GET["price_from"]) && isset($_GET["price_to"])) {
                $price_filter = " AND `books`.`price` BETWEEN  " . $_GET["price_from"] . " AND " . $_GET["price_to"] . " ";
            }
        }


        $keyword_filter = "";
        if (isset($_GET['keywords']) && $_GET['keywords'] != "") {
            $keyword_filter = " AND ( `name_ar` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `name_en` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `description_ar` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `description_en` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `isbn` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' )";
        }
        $brand_filter = "";
        if (isset($_GET['brand']) && $_GET['brand'] != 0) {
            $brand_filter = " AND `brand` = " . $_GET['brand'];
        }

        $department_filter = "";
        if (isset($_GET['department']) && $_GET['department'] != 0) {
            $department_filter = " AND `department` = " . $_GET['department'];
        }

        //$sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status` =1 AND( `books`.`bookid`>0 " . $keyword_filter . $cat_filter.$grade_filter.$age_filter.$year_filter.$isbn_filter.$lang_filter.$price_filter.$semester_filter.$booktype_filter.$type_filter." ) ORDER BY `books`.`name` DESC";
        $sql = "SELECT `products`.*,`brand`.*,`products`.`name_ar` as title_ar,`products`.`name_en` as title_en ,`departments`.*, `brand`.`name_ar` as brand_ar, `brand`.`name_en` as brand_en, `departments`.`name_ar` as department_ar, `departments`.`name_en` as department_en FROM `products` left OUTER JOIN `brand` ON `products`.`brand`=`brand`.`catid` left OUTER JOIN `departments` ON `products`.`department`=`departments`.`catid` WHERE `products`.`status` =1 AND( `products`.`status`=1 " . $keyword_filter . $brand_filter . $department_filter . $age_filter . $isbn_filter . $price_filter . " ) ORDER BY `products`.`productid` DESC";
        $result = $con->query($sql);
        $num_rows = mysqli_num_rows($result);

        $link = $real_link;
        if (isset($_GET["page"]) && $_GET["page"] != "") {
            $link = str_replace("&page=" . $_GET["page"], "", $link);
        }

        $url_arr = explode("/", $real_link);
        $url_arr = explode("?", $url_arr[count($url_arr) - 1]);
        $url = $url_arr[0] . "?";

        if (strpos($link, "?") === false) {
            $url = $url_arr[0] . "?";
        } else {
            $arr = explode("?", $link);
            $getData = explode("&", $arr[1]);
            $url = $url_arr[0] . "?" . $arr[1];
        }

        $pagination = getPagination($url, $num_rows);
        $sql = "SELECT `products`.*,`brand`.*,`products`.`name_ar` as title_ar,`products`.`name_en` as title_en , `departments`.*,`brand`.`name_ar` as brand_ar, `brand`.`name_en` as brand_en, `departments`.`name_ar` as department_ar, `departments`.`name_en` as department_en FROM `products` left OUTER JOIN `brand` ON `products`.`brand`=`brand`.`catid` left OUTER JOIN `departments` ON `products`.`department`=`departments`.`catid` WHERE `products`.`status` =1 AND( `products`.`status`=1 " . $keyword_filter . $brand_filter . $department_filter . $age_filter . $isbn_filter . $price_filter . " ) ORDER BY `products`.`productid` DESC".$pagination[0];;

        $result = $con->query($sql);
        return array("pagination"=>$pagination,"result"=>$result);
    }

    function prepareStories(){
        global $real_link;
        global $con;
        $Lis = "";

        $age_filter = "";
        if (isset($_GET["search_age"]) && $_GET["search_age"] != -1) {
            $age_filter = " AND `story`.`age`=" . $_GET["search_age"];
        }
        $year_filter = "";
        if (isset($_GET["search_year"]) && $_GET["search_year"] != -1) {
            $year_filter = " AND `story`.`year`=" . $_GET["search_year"];
        }
        $isbn_filter = "";
        if (isset($_GET["isbn"]) && trim($_GET["isbn"]) != "") {
            $isbn_filter = " AND `story`.`isbn`='" . $_GET["isbn"] . "'";
        }
        $keyword_filter = "";
        if (isset($_GET['keywords']) && $_GET['keywords'] != "") {
            $keyword_filter = " AND (`story`.`title` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `story`.`description_ar` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `story`.`description_en` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `story`.`author_ar` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `story`.`author_en` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `story`.`isbn` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%')";
        }
        $cat_filter = "";
        $series_filter = "";
        if (isset($_GET['category']) && $_GET['category'] != 0) {
            $series_filter = " AND category=" . $_GET['category'];
            $cat_filter = " AND `stories_cat`.`catid` = " . $_GET['category'];
        }
        $series_filter_stories = "";
        if (isset($_GET['series']) && $_GET['series'] != 0) {
            $series_filter_stories = " AND `series`.`seriesid` = " . $_GET['series'];
        }

        $lang_filter = "";
        $lang_filter2 = "";
        if (isset($_GET["search"]) && $_GET["search"] == "advanced") {


            $lang_filter = " AND (";
            if (isset($_GET["language_arabic"]) && $_GET["language_arabic"] == 1) {
                $lang_filter2 .= "`story`.`language`='Ar'";
            }
            if (isset($_GET["language_english"]) && $_GET["language_english"] == 1) {
                if ($lang_filter2 == "") {
                    $lang_filter2 = "`story`.`language`='En'";
                } else {
                    $lang_filter2 .= " OR `story`.`language`='En'";
                }


            }
            if (isset($_GET["language_french"]) && $_GET["language_french"] == 1) {
                if ($lang_filter2 == "") {
                    $lang_filter2 .= "`story`.`language`='Fr'";
                } else {
                    $lang_filter2 .= " OR `story`.`language`='Fr'";
                }

            }


            if (isset($_GET["language_french"]) || isset($_GET["language_english"]) || isset($_GET["language_arabic"])) {
                $lang_filter .= $lang_filter2 . ") ";
            } else {
                $lang_filter = "";
            }

        }
        $price_filter = "";
        if (isset($_GET["search"]) && $_GET["search"] == "advanced") {
            if (isset($_GET["price_from"]) && isset($_GET["price_to"])) {
                $price_filter = " AND `story`.`price` BETWEEN  " . $_GET["price_from"] . " AND " . $_GET["price_to"] . " ";
            }
        }


        $publisher_filter = "";
        if (isset($_GET['publisher']) && $_GET['publisher'] != 0) {
            $publisher_filter = " AND `publisher` = " . $_GET['publisher'];
        }

        $sql = "SELECT `story`.*,`stories_cat`.*,`series`.*,`story`.`rating_count` as rate_count FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid`  WHERE `story`.`status`=1 AND `story`.`store`=1 AND `story`.`is_media`=0 AND( `story`.`storyid`>0  " . $keyword_filter . $cat_filter . $age_filter.$year_filter.$isbn_filter .$lang_filter.$price_filter. $series_filter_stories . $publisher_filter . " )";
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
        $sql = "SELECT `story`.*,`stories_cat`.*,`series`.*,`story`.`rating_count` as rate_count FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid` WHERE `story`.`status`=1 AND `story`.`store`=1 AND `story`.`is_media`=0  AND( `story`.`storyid`>0 " . $keyword_filter . $cat_filter . $age_filter.$year_filter .$isbn_filter.$lang_filter.$price_filter. $series_filter_stories . $publisher_filter . " ) " . $pagination[0];
        $result=$con->query($sql);

        return array("pagination"=>$pagination,"result"=>$result);
    }

    function PaintStoreBook($book, $type = "StudentBook"){
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
            $viewLink = SITE_URL . $lang_code . '/store/books/' . $book['bookid'] . '/' . str_replace(" ", "-", $book['name']);
            $linkbooks = ' <a href="' . SITE_URL . $lang_code . '/store/books/category/' . $book['category'] . '/' . str_replace(" ", "-", $book['name_' . $cat_code]) . '" class="text-left cat" title="' . $book['name_' . $cat_code] . '"><label class="floating-left">' . $Lang->Book . '</label><label class="floating-left">/</label><label class="floating-left">' . $book['name_' . $cat_code] . '</label></a>';
            $bg=SITE_URL."platform/books/".$book["bookid"]."/cover.jpg";
            $id=$book["bookid"];
            $buy="book_addtocart store";
            $title=$book['name'];
            $rating= '<div class="display-block top-container">
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
        } else if ($type == 'story') {
            $viewLink = SITE_URL . $lang_code . '/store/stories/' . $book['storyid'] . '/' . str_replace(" ", "-", $book['title'])."?s=1";
            $linkbooks = ' <a href="' . SITE_URL . $lang_code . 'store/stories/category/' . $book['category'] . '/' . str_replace(" ", "-", $book['name_' . $cat_code]) . '" class="text-left cat" title="' . $book['name_' . $cat_code] . '"><label class="floating-left">' . $Lang->Book . '</label><label class="floating-left">/</label><label class="floating-left">' . $book['name_' . $cat_code] . '</label></a>';
            $bg=SITE_URL.'platform/stories/'.$book['seriesid'] . '/story/' . $book['storyid'] . '/images/pic.jpg';
            $id=$book["storyid"];
            $buy="story_addtocart store";
            $title=$book['title'];
            $rating= '<div class="display-block top-container">
                                                    <div class="rating-container floating-left">
                                                            <div class="number floating-right">(' . $book['rate_count'] . ')</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input ' . disableRate($book['storyid'], $book, 'story') . ' prodect="story" rate="5" bookid="' . $book['storyid'] . '" ' . calcRate($book['rate'], 5) . ' class="star star-5" id="star-5-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($book['storyid'], $book, 'story')) . ' star star-5" for="star-5-' . $id . '"></label>
                                                                    <input ' . disableRate($book['storyid'], $book, 'story') . ' prodect="story" rate="4" bookid="' . $book['storyid'] . '" ' . calcRate($book['rate'], 4) . ' class="star star-4" id="star-4-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($book['storyid'], $book, 'story')) . ' star star-4" for="star-4-' . $id . '"></label>
                                                                    <input ' . disableRate($book['storyid'], $book, 'story') . ' prodect="story" rate="3" bookid="' . $book['storyid'] . '" ' . calcRate($book['rate'], 3) . ' class="star star-3" id="star-3-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($book['storyid'], $book, 'story')) . ' star star-3" for="star-3-' . $id . '"></label>
                                                                    <input ' . disableRate($book['storyid'], $book, 'story') . ' prodect="story" rate="2" bookid="' . $book['storyid'] . '" ' . calcRate($book['rate'], 2) . ' class="star star-2" id="star-2-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($book['storyid'], $book, 'story')) . ' star star-2" for="star-2-' . $id . '"></label>
                                                                    <input ' . disableRate($book['storyid'], $book, 'story') . ' prodect="story" rate="1" bookid="' . $book['storyid'] . '" ' . calcRate($book['rate'], 1) . ' class="star star-1" id="star-1-' . $id . '" type="radio" name="star"/>
                                                                    <label class="' . msglogin(disableRate($book['storyid'], $book, 'story')) . ' star star-1" for="star-1-' . $id . '"></label>
                                                                </form>
                                                            </div>
                                                        </div>';
        }

        $result = '<div class="item-container books-class jq_item_container floating-left">
                    <div class="inner-item-container">
                        <div class="media-thump-container game"
                             >
                            <a class="media-thump libro" style="background-image: url('.$bg.')"
                               href="'.$viewLink.'"></a>
                            <div class="bottom-thump"></div>
                        </div>
                        <div class="display-block secound-container">
                            <div class="title-sub-container clear-both floating-left">
                                <div class="floating-left display-inline-block">
                                    <a class="text-left title floating-left" href="'.$viewLink.'" title="'.$title.'">'.$title.'</a>
                                </div>
                            </div>
                        </div>
            <div class="display-block secound-container">
                <div class="title-sub-container clear-both floating-left">
                    <div class="floating-left display-inline-block"><a
                                class="text-left type"></a></div>
                    <div class="price floating-left">
                        <div class="display-inline-block">
                            <span class="floating-left text-left cat"></span>
                            <span class="floating-left text-left cat" title="'.$book['name_' . $cat_code].'">'.$book['name_' . $cat_code].'</span>
                        </div>
                    </div>
                    <div class="floating-right display-inline-block ">
                                                       <div class="right floating-right"><div class="display-inline-block"><span class="floating-right">'.$book['price'].'</span><span class="floating-right">$</span></div></div>
                                                    </div>
                </div>
                
            </div>'.$rating;
        $result.='<div class="hover-container floating-right">
                    <div class="buttons-container floating-left">
                        <a class="buy '.$buy.' floating-left" booktype="1" price="'.$book["price"].'" bookid="'.$id.'"></a>
                    </div>
                    <div style="display: none;" class="view-container floating-right">
                        <a href="'.$viewLink.'" title="Views" class="view-icon floating-left"></a>
                    </div>
                </div>
                <a class="addtofav floating-left text-left flag-Arabic"></a>
            </div>
        </div>
    </div>';
        return $result;


    }

    function PaintStoreToys($book, $type = "toy"){
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

            $viewLink = SITE_URL . $lang_code . '/store/toys/' . $book['productid'] . '/' . str_replace(" ", "-", $book['title_' . $cat_code])."?s=1";
            $bg=SITE_URL."platform/products/".$book["productid"]."/thumbnail_small.jpg";
            $id=$book["productid"];
            $buy="toy_addtocart store";
            $title=$book['title_' .strtolower($cat_code)];
            $rating= '<div class="display-block top-container">
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


        $result = '<div class="item-container jq_item_container floating-left">
                    <div class="inner-item-container">
                        <div class="media-thump-container game"
                             >
                            <a class="media-thump libro" style="background-image: url('.$bg.')"
                               href="'.$viewLink.'"></a>
                            <div class="bottom-thump"></div>
                        </div>
                        <div class="display-block secound-container">
                            <div class="title-sub-container clear-both floating-left">
                                <div class="floating-left display-inline-block">
                                    <a class="text-left title floating-left" href="'.$viewLink.'" title="'.$title.'">'.$title.'</a>
                                </div>
                            </div>
                        </div>
           <div class="display-block secound-container">
                <div class="title-sub-container clear-both floating-left">
                    <div class="floating-left display-inline-block"><a
                                class="text-left type">'.$book['brand_' . $cat_code].'</a></div>
                    <div class="price floating-left">
                        <div class="display-inline-block">
                            <span class="floating-left text-left cat">/</span>
                            <span class="floating-left text-left cat" title="'.$book['department_' . $cat_code].'">'.$book['department_' . $cat_code].'</span>
                        </div>
                    </div>
                        <div class="floating-right display-inline-block ">
                                                       <div class="right floating-right"><div class="display-inline-block"><span class="floating-right">'.$book['Price'].'</span><span class="floating-right">$</span></div></div>
                                                    </div>
                </div>
            </div>'.$rating;
        $result.='<div class="hover-container floating-right">
                    <div class="buttons-container floating-left">
                        <a class="buy '.$buy.' floating-left" booktype="1" price="'.$book["Price"].'" bookid="'.$id.'"></a>
                    </div>
                    <div  style="display: none;" class="view-container floating-right">
                        <a href="'.$viewLink.'" title="Views" class="view-icon floating-left"></a>
                    </div>
                </div>
                <a class="addtofav floating-left text-left flag-Arabic"></a>
            </div>
        </div>
    </div>';
        return $result;


    }
    ?>
