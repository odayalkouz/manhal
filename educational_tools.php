<?php
$currentTab = "educational_tools";
include_once "platform/config.php";
include_once "includes/function.php";
include_once "platform/includes/function.php";
include_once "includes/header.php";
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/educational_tools.css<?=$cash;?>">
<div class="inner-pages-main-container-educational_tools">
    <?= $breadCrumbs; ?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <form class="educational_tools-search" METHOD="GET" id="books_search">

                        <div class="right-col-3 floating-left">
                            <div class="books-main-container-page clear-both">
                                <div class="top-black-col">
                                    <div class="floating-left">
                                        <label class="lbl-data-a floating-left"><?= $Lang->Bysubject; ?></label>
                                        <div class="wrapper-demo">
                                            <div id="subject" class="jq_bookdropdown wrapper-dropdown-3" tabindex="2">
                                                <span
                                                    style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-En/images/cat/books/all.svg);"
                                                    class="floating-left"><?= $Lang->All; ?></span>
                                                <ul class="dropdown submit scrollable">
                                                    <input class="hidden_input" type="hidden" name="category"
                                                           value="<?php if(isset($_GET['category'])){ echo $_GET['category'];} ?>" id="hidden_category_book">
                                                    <li class="catli sub-0 no-image" catid="0"><a href="#"><i
                                                                class="icon-truck icon-large"><?= $Lang->All; ?></i></a>
                                                    </li>
                                                    <?php
                                                    if($_GET['type']=="educationaltools"){
                                                        $cat_sql = "Select * From  educationaltools_cat WHERE `parent`=0";
                                                    }else if($_GET['type']==""){

                                                    }else if($_GET['type']==""){

                                                    }

                                                    $cat_result = $con->query($cat_sql);
                                                    if (mysqli_num_rows($cat_result) > 0) {
                                                        while ($cat_row = mysqli_fetch_assoc($cat_result)) {

                                                            echo'<li title="' . $cat_row['name_' .$cat_code] . '" index="' . $level . '" class="sub-' . $level . ' catli ' . $selected . ' no-image" catid="' . $cat_row['catid'] . '"><a title="' . $cat_row['name_' . $cat_code] . '" href="#" style="background-image:url(' . SITE_URL . 'themes/main-Light-green-' .$session_lang. '/images/cat/' . $folder . '/' . $cat_row["catid"] . '.svg)"><i class="icon-truck icon-large"><label>' . $cat_row['name_' . $cat_code] . '</label></i></a></li>';
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != "") {

                                    ?>
                                    <div class="floating-left">
                                        <label class="lbl-data-a floating-left"><?= $Lang->favpurch; ?></label>
                                        <div class="wrapper-demo floating-left">
                                            <div id="favpurch" class="wrapper-dropdown-3" tabindex="3">

                                                <span
                                                    class="floating-left"><?php if (!isset($_GET['favpurch_t']) || $_GET['favpurch_t'] == -1 || $_GET['favpurch_t'] == '') {
                                                        echo $Lang->all;
                                                    } elseif (isset($_GET['favpurch_t'])&&$_GET['favpurch_t'] == 0) {
                                                        echo $Lang->Favorites;
                                                    } elseif (isset($_GET['favpurch_t'])&&$_GET['favpurch_t'] == 1) {
                                                        echo $Lang->Purchased;
                                                    } ?></span>
                                                <ul class="dropdown submit scrollable ">
                                                    <input type="hidden" class="hidden_input" name="favpurch_t"
                                                           id="favpurch_t"
                                                           value="<?php if (!isset($_GET['favpurch_t']) || $_GET['favpurch_t'] == -1 || $_GET['favpurch_t'] == '') {
                                                               echo -1;
                                                           } else {
                                                               echo $_GET['favpurch_t'];
                                                           } ?>">
                                                    <li class="catli " catid="-1"><a href="#"><i
                                                                class="icon-truck icon-large"><?= $Lang->all; ?></i></a>
                                                    </li>
                                                    <li <?php if (isset($_GET['favpurch_t'])&&$_GET['favpurch_t'] == 0) {
                                                        echo 'selected';
                                                    } ?> class="catli " catid="0"><a href="#"><i
                                                                class="icon-truck icon-large"><?= $Lang->Favorites; ?></i></a>
                                                    </li>
                                                    <li <?php if (isset($_GET['favpurch_t'])&& $_GET['favpurch_t'] == 1) {
                                                        echo 'selected';
                                                    } ?> class="catli" catid="1"><a href="#"><i
                                                                class="icon-truck icon-large"><?= $Lang->Purchased; ?></i></a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="right-search-container floating-right">
                                        <input type="text" class="txt-a floating-left" name="keywords"
                                               placeholder="<?= $Lang->SearchYourItem; ?>"
                                               value="<?php if (isset($_GET['keywords'])) {
                                                   echo $_GET['keywords'];
                                               } ?>">




                                        <input type="submit" class="btn btn-search floating-left" value="">
                                    </div>
                                    <div class="floating-right sort-by-list-container">
                                        <label class="lbl-data-b floating-left"><?= $Lang->SortBy; ?></label>
                                        <div class="wrapper-demo">
                                            <div id="sortby" class="wrapper-dropdown-3" tabindex="1">
                                                <span class="floating-left"><?= $Lang->Sortalphabetically; ?></span>
                                                <ul class="dropdown scrollable">
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
                                                    <li><a href="#"><i
                                                                class="icon-plane icon-large"></i><?= $Lang->Sortbypricehightolow; ?>
                                                        </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui-panels-educational_tools">

                                    <?php
                                    $keyword_filter = "";
                                    $cat_filter = "";
                                    if (isset($_GET['keywords']) && $_GET['keywords'] != "") {
                                        $keyword_filter = " AND ( `title_ar` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `title_en` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `description_ar` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `description_en` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%'  )";
                                    }
                                    if (isset($_GET['category']) && $_GET['category'] != 0) {
                                        $cat_filter = " AND `category` = " . $_GET['category'];
                                    }
                                    $sql = "Select media.*,educationaltools_cat.name_ar, educationaltools_cat.name_en From media Inner Join educationaltools_cat On media.category = educationaltools_cat.catid Where media.status = 1 And media.id > 0 And media.type=13 " . $keyword_filter . $cat_filter ." ORDER BY `media`.`title_en` ASC ";
                                    if (isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != "") {

                                        if (isset($_GET['favpurch_t']) && $_GET['favpurch_t'] == 0 || isset($_GET['favpurch_t']) && $_GET['favpurch_t'] == 1) {
                                            $keyword_filter = " AND ( media.title_ar LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR media.title_en LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR media.description_ar LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR media.description_en LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%'  )";
                                        }
                                        if (isset($_GET['favpurch_t']) && $_GET['favpurch_t'] == 0 || isset($_GET['favpurch_t']) && $_GET['favpurch_t'] == 1) {
                                            if (isset($_GET['category']) && $_GET['category'] != 0) {
                                                $cat_filter = " AND media.category = " . $_GET['category'];
                                            }
                                        }
                                        if (isset($_GET['favpurch_t']) && $_GET['favpurch_t'] == 0) {
                                            $sql = "Select * From wishs Inner Join media On wishs.bookid = media.id Inner Join educationaltools_cat On media.category = educationaltools_cat.catid Where wishs.bookid = media.id and  wishs.type = '".$_GET['type']."' and wishs.userid=" . $_SESSION['user']['userid'] . $keyword_filter . $cat_filter ." ORDER BY `media`.`title_ar` ASC ";
                                        } else if (isset($_GET['favpurch_t']) && $_GET['favpurch_t'] == 1) {
                                            $sql = "Select *, payments.paymentid As paymentid1, media.*, educationaltools_cat.* From payments Inner Join payments_books On payments.paymentid = payments_books.paymentid Inner Join media On payments_books.bookid = media.id Inner Join educationaltools_cat On media.category = educationaltools_cat.catid Where payments_books.itemtype = '".$_GET['type']."' and payments.`userid`= " . $_SESSION['user']['userid'] . $keyword_filter . $cat_filter." ORDER BY `media`.`title_ar` ASC ";
                                        }
                                    }


                                    $result = $con->query($sql);
                                    $num_rows = mysqli_num_rows($result);
                                    $link = $real_link;
                                    if (isset($_GET["page"]) && $_GET["page"] != "") {
                                        $link = str_replace("&page=" . $_GET["page"], "", $link);
                                    }
                                    $url = "educationaltools?";
                                    if (strpos($link, "?") === false) {
                                        $url = "educationaltools?";
                                    } else {
                                        $arr = explode("?", $link);
                                        $getData = explode("&", $arr[1]);
                                        $url = "educationaltools?" . $arr[1];
                                    }
                                    $pagination = getPagination($url, $num_rows);
                                    $sql = "Select media.*,educationaltools_cat.name_ar, educationaltools_cat.name_en From media Inner Join educationaltools_cat On media.category = educationaltools_cat.catid Where media.status = 1 And media.id > 0 And media.type=13 " . $keyword_filter . $cat_filter . " ORDER BY media.title_ar ASC ".$pagination[0];

                                    if (isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != "") {

                                        if (isset($_GET['favpurch_t']) && $_GET['favpurch_t'] == 0 || isset($_GET['favpurch_t']) && $_GET['favpurch_t'] == 1) {
                                            $keyword_filter = " AND ( media.title_ar LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR media.title_en LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR media.description_ar LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR media.description_en LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%'  )";
                                        }
                                        if (isset($_GET['favpurch_t']) && $_GET['favpurch_t'] == 0 || isset($_GET['favpurch_t']) && $_GET['favpurch_t'] == 1) {
                                            if (isset($_GET['category']) && $_GET['category'] != 0) {
                                                $cat_filter = " AND media.category = " . $_GET['category'];
                                            }
                                        }
                                        if (isset($_GET['favpurch_t']) && $_GET['favpurch_t'] == 0) {
                                            $sql = "Select * From wishs Inner Join media On wishs.bookid = media.id Inner Join educationaltools_cat On media.category = educationaltools_cat.catid Where wishs.bookid = media.id and  wishs.type = '".$_GET['type']."' and wishs.userid=" . $_SESSION['user']['userid'] . $keyword_filter . $cat_filter . $pagination[0]." ORDER BY `media`.`title_ar` ASC";
                                        } else if (isset($_GET['favpurch_t']) && $_GET['favpurch_t'] == 1) {
                                            $sql = "Select *, payments.paymentid As paymentid1, media.*, educationaltools_cat.* From payments Inner Join payments_books On payments.paymentid = payments_books.paymentid Inner Join media On payments_books.bookid = media.id Inner Join educationaltools_cat On media.category = educationaltools_cat.catid Where payments_books.itemtype = '".$_GET['type']."' and payments.`userid`= " . $_SESSION['user']['userid'] . $keyword_filter . $cat_filter. $pagination[0]." ORDER BY `media`.`title_ar` ASC";

                                        }
                                    }

                                    $result = $con->query($sql);
                                    while ($educationaltools = mysqli_fetch_assoc($result)) {

                                     echo Painteducationaltools($educationaltools);
                                    }
                                    ?>
                                    <div class="paging">
                                        <div class="content">
                                            <?php
                                            echo $pagination[1];
                                            ?>
                                        </div></div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".jq_bookdropdown span").css("background-image", $(".catli.active").children("a").css("background-image"));
    $(".jq_bookdropdown span").html($(".catli.active").find("i").html());
</script>

<?php
include_once "includes/footer.php";
?>

