<?php
$currentTab = "myquizzes";
include_once "includes/function.php";
include_once "platform/includes/function.php";
include_once "includes/header.php";
?>
<link rel="stylesheet" type="text/css"
      href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/worksheet.css<?= $cash; ?>">

<?php
if (!$detect->isMobile() || $detect->isTablet()) {
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
<div class="inner-pages-main-container-worksheet with-out-bg">
    <?= $breadCrumbs; ?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <form class="worksheet-search text-left" METHOD="GET">
                        <div class="right-col-3 floating-left">
                            <div class="books-main-container-page clear-both">
                                <div class="top-black-col">
                                    <div class="floating-left">
                                        <label class="lbl-data-a floating-left stories"><?= $Lang->Bysubject;?></label>
                                        <div class="wrapper-demo">
                                            <div id="subject" class="jq_bookdropdown wrapper-dropdown-3" tabindex="2">
                                                <span style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-En/images/cat/books/all.svg);" class="floating-left"><?= $Lang->All; ?></span>
                                                <ul class="dropdown submit scrollable">
                                                    <input class="hidden_input" type="hidden" name="category"  value="<?php if(isset($_GET['category'])){ echo $_GET['category'];} ?>" id="hidden_category_book">
                                                    <li class="catli sub-0 no-image" catid="0"><a href="#"><i
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
                                        <a data-type="ContainersAdvansedSearchaaa"
                                           class="btn-popup-a advansd-search-button floating-right" title="<?= $Lang->Advansedsearch;?>"><?= $Lang->Advansedsearch;?></a>
                                        <?php
                                    }
                                    ?>
                                    <div class="floating-right sort-by-list-container">
                                        <label class="lbl-data-b floating-left"><?= $Lang->SortBy; ?></label>
                                        <div class="wrapper-demo">
                                            <div id="sortby" class="wrapper-dropdown-3" tabindex="1">
                                                <span class="floating-left"><?= $Lang->Sortalphabetically; ?></span>
                                                <ul class="dropdow
                                                n scrollable">
                                                    <li><a href="#"><i
                                                                class="icon-truck icon-large"></i><?= $Lang->DefaultSorting ?>
                                                        </a></li>
                                                    <li><a href="#"><i
                                                                class="icon-plane icon-large"></i><?= $Lang->Sortalphabetically; ?>
                                                        </a></li>
                                                    <li><a href="#"><i
                                                                class="icon-plane icon-large"></i><?= $Lang->Sortbypopularity; ?>
                                                        </a></li>
                                                    <li><a href="#"><i
                                                                class="icon-plane icon-large"></i><?= $Lang->Sortbyaveragerating; ?>
                                                        </a></li>
                                                    <li><a href="#"><i
                                                                class="icon-plane icon-large"></i><?= $Lang->Sortbynewness; ?>
                                                        </a></li>
                                                    <li><a href="#"><i
                                                                class="icon-plane icon-large"></i><?= $Lang->Sortbypricelowtohigh; ?>
                                                        </a></li>
                                                    <li><a href="#"><i class="icon-plane icon-large"></i><?= $Lang->Sortbypricehightolow; ?> </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $keyword_filter = "";
                                $cat_filter = "";
                                $lang_filter = "";
                                $lang_filter2 = "";
                                $age_filter = "";
                                $grade_filter = "";
                                if (isset($_GET["search"]) && $_GET["search"] == "advanced") {
                                    $lang_filter = " AND (";
                                    if (isset($_GET["language_arabic"]) && $_GET["language_arabic"] == '1') {
                                        $lang_filter2 .= "`quiz`.`language`='Ar'";
                                    }
                                    if (isset($_GET["language_english"]) && $_GET["language_english"] == '1') {
                                        if ($lang_filter2 == "") {
                                            $lang_filter2 = "`quiz`.`language`='En' OR `quiz`.`language`='' ";
                                        } else {
                                            $lang_filter2 .= " OR `quiz`.`language`='En' OR `quiz`.`language`='' ";
                                        }
                                    }
                                    if (isset($_GET["language_french"]) && $_GET["language_french"] == '1') {
                                        if ($lang_filter2 == "") {
                                            $lang_filter2 .= "`quiz`.`language`='Fr'";
                                        } else {
                                            $lang_filter2 .= " OR `quiz`.`language`='Fr'";
                                        }
                                    }

                                    if (isset($_GET["language_french"]) || isset($_GET["language_english"]) || isset($_GET["language_arabic"]) && $lang_filter2 != '') {
                                        $lang_filter .= $lang_filter2 . ") ";
                                    } else {
                                        $lang_filter = "";
                                    }
                                    if (isset($_GET["search_age"]) && $_GET["search_age"] > 0) {
                                        $age_filter = " AND `quiz`.`age`=" . $_GET["search_age"];
                                    }

                                    if (isset($_GET["search_grade"]) && $_GET["search_grade"] > 0) {
                                        $grade_filter = "";
                                        //$grade_filter = " AND `quiz`.`grade`=" . $_GET["search_grade"];
                                    }
                                }
                                if (isset($_GET['keywords']) && $_GET['keywords'] != "") {
                                    $keyword_filter = " AND ( `quiz`.`title` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `quiz`.`Introduction` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' ) ";
                                }

                                if (isset($_GET['category']) && $_GET['category'] != 0) {
                                    $cat_filter = " AND `quiz`.`category` = " . $_GET['category'];
                                }

                                $sql = "SELECT `quiz`.*,`categories`.* FROM `quiz`  left OUTER JOIN `categories` ON `quiz`.`category`=`categories`.`catid` WHERE `quiz`.`is_public`=1 ".$keyword_filter . $cat_filter . $lang_filter . $age_filter." ";
                                $result = $con->query($sql);
                                $num_rows = mysqli_num_rows($result);

                                $url = "exercises?";
                                $pagination = getPagination($url, $num_rows, 12);
                                $sql = "SELECT `quiz`.*,`categories`.* FROM `quiz` left OUTER JOIN `categories` ON `quiz`.`category`=`categories`.`catid` WHERE `quiz`.`is_public`=1 ".$keyword_filter . $cat_filter . $lang_filter . $age_filter. $pagination[0];
                                $result = $con->query($sql);
                                ?>
                                <div class="ui-panels-worksheet">
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo paintQuiz($row,"quiz",true);
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
include_once "includes/footer.php";
?>


