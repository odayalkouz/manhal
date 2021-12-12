<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "includes/function.php";
include_once "platform/includes/function.php";
include("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/newsevent.css<?=$cash;?>">
<?php
if($detect->isMobile() || $detect->isTablet())
{
    ?>
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/pronewsevent.css<?=$cash;?>">
    <?php
}
?>
<div class=" inner-pages-main-container-news" xmlns="http://www.w3.org/1999/html">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="image-header-container">
                        <h1><?= $Lang->News; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="get"  >
    <div class="news-content">

        <div class="center-piece">
            <div class="inner-main-content-height">
                <div class="header">
                    <label class="lbl-data-a floating-left"><?= $Lang->Year; ?></label>
                    <div class="wrapper-demo floating-left">
                        <div id="NewsYaer" class="jq_bookdropdown wrapper-dropdown-3" tabindex="1">
                            <?php

                            if(isset($_GET['year'])&&is_numeric($_GET['year'])) {
                                $selectyear = $_GET['year'];
                                if($_GET['year']>2009 && $_GET['year']<date("Y")+1) {
                                    $selectyear = $_GET['year'];
                                }else{
                                    $selectyear= date("Y");
                                }
                            }else{
                                $selectyear= date("Y");
                            }

                            ?>
                            <span class="floating-left"><?php echo $selectyear;?></span>

                            <ul class="dropdown submit scrollable">
                                <input class="hidden_input" type="hidden" name="year" value="<?php if(isset($_GET['year'])){ echo $_GET['year'];}else{echo $selectyear;} ?>" id="year">
                                <?php
                                $year=2010;
                                while($year<date("Y")+1){

                                    $selected='';
                                    if($selectyear==$year){
                                        $selected='selected' ;
                                    }

                                    echo  '<li ".$selected." catid="'.$year.'"><a title="'.$year.'" href="#"><i class="icon-truck icon-large"></i><span>'.$year.'</span></a></li>';
                                    $year++;
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <?php
                    $year_filter = " AND `news_date` LIKE  '%" . $selectyear . "%' ";
                    if(isset($_GET["month"]) && $_GET["month"]>0&&$_GET["month"]<13&&is_numeric($_GET['month'])) {
                        $month = $_GET["month"];
                        if ($month < 10 && strlen($month)<2) {
                            $month = '0' . $month;
                        }
                        $month_filter = " AND `news_date` LIKE  '%".$month."%' ";
                    }else{
                        $month=date("m");
                        $month_filter="";
                    }

                    $sql = "SELECT * FROM `news` WHERE `newsid` >0 " .$year_filter.$month_filter;

                    $result = $con->query($sql);
                    $num_rows = mysqli_num_rows($result);

                    $url = "news?";

                    if (isset($_GET['year']) && $_GET['year'] != "0" && $_GET['year'] != "") {
                        $url.="year=".$_GET['year'].'&';
                        }
                    if (isset($_GET['month']) && $_GET['month'] != "0" && $_GET['month'] != "") {
                        $url.="month=".$_GET['month'];
                    }

                    $pagination = getPagination($url,$num_rows);
                    $sql = "SELECT * FROM `news` WHERE `newsid` >0  ".$year_filter.$month_filter.$pagination[0];
                    $result = $con->query($sql);
                    ?>
                    <label class="lbl-data-a floating-left"><?= $Lang->Month; ?></label>
                    <div class="wrapper-demo floating-left">
                    <div id="NewsMonth" class="wrapper-dropdown-3" tabindex="2">
                            <span class="floating-left"><?php if($month_filter==''){echo '-----------';}else{echo $month;} ?></span>

                            <ul class="jq_bookdropdown dropdown submit scrollable">

                                <?php
                                $month=1;
                                while($month<13){

                                    $selected='';
                                    if(isset($_GET['month'])&&$_GET['month']==$month){
                                        $selected='selected' ;
                                    }

                                    echo  '<li "'.$selected.'" catid="'.$month.'"><a title="'.$month.'" href="#"><i class="icon-truck icon-large"></i><span>'.$month.'</span></a></li>';
                                    $month++;
                                }
                                ?>
                                <input class="hidden_input" type="hidden" name="month" value="<?php if(isset($_GET['month'])){ echo $_GET['month'];}else{echo $selected;} ?>" id="month">
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="items-container">

                    <?php
                    while ($news = mysqli_fetch_assoc($result)) {
                        echo PaintNews($news);
                    }
                    ?>
                </div>
                <div class="paging">
                    <div class="content">
                        <?php
                        echo $pagination[1];
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
</div>
<?php include("includes/footer.php"); ?>


