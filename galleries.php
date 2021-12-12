<?php
$currentTab = "galleries";
include_once "platform/config.php";
include_once "includes/function.php";
include_once "platform/includes/function.php";
include_once "includes/header.php";
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/galleries.css<?=$cash;?>">

<?php
if($detect->isMobile() || $detect->isTablet())
{
    ?>
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/progalleries.css<?=$cash;?>">
    <?php
}
?>
<div class="inner-pages-main-container-galleries">
    <?= $breadCrumbs; ?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="image-header-container">
                        <h1><?= $Lang->Galleries; ?></h1>
                    </div>
                    <form class="galleries-search" METHOD="GET" id="books_search">

                        <div class="right-col-3 floating-left">

                            <div class="galleries-main-container-page clear-both">
                                <div class="top-black-col">
                                    <div class="right-search-container floating-left">
                                        <input type="text" class="txt-a floating-left" name="keywords"
                                               placeholder="<?= $Lang->SearchYourItem; ?>"
                                               value="<?php if (isset($_GET['keywords'])) {
                                                   echo $_GET['keywords'];
                                               } ?>">
                                        <input type="submit" class="btn btn-search floating-left" value="">
                                    </div>
                                </div>
                                <div class="ui-panels">
                                    <?php
                                    $keyword_filter = "";
                                    if (isset($_GET['keywords']) && $_GET['keywords'] != "") {
                                        $keyword_filter = " AND ( `title_ar` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `title_en` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `description_ar` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `description_en` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%'  )";
                                    }
                                    $sql = "SELECT * FROM `galleries` WHERE id>0 " . $keyword_filter . " ";
                                    $result = $con->query($sql);
                                    $num_rows = mysqli_num_rows($result);
                                    $link = $real_link;
                                    if (isset($_GET["page"]) && $_GET["page"] != "") {
                                        $link = str_replace("&page=" . $_GET["page"], "", $link);
                                    }
                                    $url = "galleries?";
                                    if (strpos($link, "?") === false) {
                                        $url = "galleries?";
                                    } else {
                                        $arr = explode("?", $link);

                                        $url = "galleries?" . $arr[1];
                                    }
                                    $pagination = getPagination($url, $num_rows);
                                    $sql = "SELECT * FROM `galleries` WHERE id>0" . $keyword_filter . $pagination[0];
                                    $result = $con->query($sql);
                                    while ($galleries = mysqli_fetch_assoc($result)) {
                                        echo Paintgalleries($galleries);
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



<?php
include_once "includes/footer.php";
?>




