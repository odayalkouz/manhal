<?php
$currentTab = "myquizzes";
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
                                <?php
                                $sql = "SELECT `quiz`.*,`categories`.* FROM `quiz` left OUTER JOIN `categories` ON `quiz`.`category`=`categories`.`catid` WHERE `quiz`.`userid`=" . $_SESSION['user']['userid'];
                                $result = $con->query($sql);
                                $num_rows = mysqli_num_rows($result);

                                $url = "myquizzes?";
                                $pagination = getPagination($url, $num_rows, 11);
                                $sql = "SELECT `quiz`.*,`categories`.* FROM `quiz`  left OUTER JOIN `categories` ON `quiz`.`category`=`categories`.`catid` WHERE  `quiz`.`userid`=" . $_SESSION['user']['userid'] . " " . $pagination[0];
                                $result = $con->query($sql);
                                ?>
                                <div class="ui-panels-worksheet">
                                    <div class="item-container jq_item_container floating-left tsc_ribbon_wrap reveal-bottom">
                                        <?php
                                        if($_SESSION['user']["permession"]>0 && $_SESSION['user']["permession"]<13){
                                            ?>
                                            <a class="inner-item-container addquiz"   href="<?= SITE_URL . $lang_code . "/quiz-editor?id=new"; ?>">
                                                <?= $Lang->AddQuiz; ?>
                                            </a>
                                            <?php
                                        }else{
                                            ?>
                                            <a class="inner-item-container addquiz"   href="<?= SITE_URL . $lang_code . "/subscribe"; ?>">
                                                <?= $Lang->AddQuiz; ?>
                                            </a>
                                            <?php
                                        }
                                        ?>


                                    </div>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo paintQuiz($row);
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


