<?php
$currentTab = "my-activities";
include_once "includes/function.php";
mustLogin();
include_once "platform/includes/function.php";
include_once "includes/header.php";

?>
<link rel="stylesheet" type="text/css"
      href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/worksheet.css<?= $cash; ?>">

<?php
if($detect->isMobile() || $detect->isTablet())
{
    ?>
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/proworksheet.css<?=$cash;?>">
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
                                    <?php ?>
                                    <form class="" METHOD="GET" id="">
                                        <div class="right-search-container floating-left">
                                            <input type="text" class="txt-a floating-left" name="keywords"
                                                   placeholder="<?= $Lang->SearchYourItem; ?>"
                                                   value="<?php if (isset($_GET['keywords'])) {
                                                       echo $_GET['keywords'];
                                                   } ?>">
                                            <input type="submit" class="btn btn-search floating-left" value="">
                                        </div>
                                    </form>
                                </div>
                                <?php
                                if($_SESSION['user']['permession'] < 6 && $_SESSION['user']['permession']>0  || $_SESSION['user']['userid']<5){
                                    $whereUser="`media`.`userid` > 0 ";
                                }else{
                                    $whereUser="`media`.`userid`=" . $_SESSION['user']['userid'];
                                }
                                $keyword_filter = "";
                                if (isset($_GET['keywords']) && $_GET['keywords'] != "") {
                                    $keyword=mysqli_real_escape_string($con,str_replace(" ","%",$_GET['keywords']));
                                    $keyword_filter = " AND ( `title_ar` LIKE '%".$keyword."%' OR `title_en` LIKE '%".$keyword."%' OR `description_ar` LIKE '%" . $keyword. "%' OR `description_en` LIKE '%" . $keyword. "%' )";
                                }

                                $sql = "SELECT `media`.*,`categories`.* FROM `media` left OUTER JOIN `categories` ON `media`.`category`=`categories`.`catid` WHERE `media`.`type`=13 AND(".$whereUser.$keyword_filter.")";
                                $result = $con->query($sql);
                                $num_rows = mysqli_num_rows($result);

                                $url = "my-activities?";
                                $pagination = getPagination($url, $num_rows, 11);
                                $sql = "SELECT `media`.*,`categories`.* FROM `media` left OUTER JOIN `categories` ON `media`.`category`=`categories`.`catid` WHERE  `media`.`type`=13 AND(".$whereUser.$keyword_filter. ") " . $pagination[0];
                                $result = $con->query($sql);

                                ?>
                                <div class="ui-panels-worksheet">
                                    <div class="item-container jq_item_container floating-left tsc_ribbon_wrap reveal-bottom">
                                        <?php
                                        if($_SESSION['user']["permession"]>0 && $_SESSION['user']["permession"]<=11){
                                            ?>
                                            <a class="inner-item-container addquiz"   href="<?= SITE_URL . $lang_code . "/editor?id=new"; ?>">
                                                <?= $Lang->AddActivity; ?>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo paintMyActivities($row);
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


