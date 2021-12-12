<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$sql = "SELECT * FROM `galleries` WHERE `id`>0 and id=" . $_GET['id'];
$result = $con->query($sql);
$row = mysqli_fetch_assoc($result);
$id = uniqid(rand(10000, 99999), true);
include "includes/function.php";
include("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/galleries.css<?=$cash;?>">
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/swiper.min.css<?=$cash;?>">
<?php
if($detect->isMobile() || $detect->isTablet())
{
    ?>
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/progalleries.css<?=$cash;?>">
    <?php
}
?>
<style>
    .swiper-container {
        width: 100%;
        height: 100%;
    }
    .swiper-slide {
        overflow: hidden;
    }
</style>
<?php
$drowalbum = '';
$thumbs='';
$nuimage=0;
$numviedo=0;
$i=0;
$dir = "platform/galleries/" . $_GET["id"] . "/media/";
if (file_exists($dir)) {
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') continue;
        $ext = pathinfo($item, PATHINFO_EXTENSION);
        $newname = explode('.', $item);
        if ($ext == 'jpg') {
            $nuimage++;
            $drowalbum .= '<div class="swiper-slide"><div class="swiper-zoom-container"><img src="' . SITE_URL . '/platform/galleries/' . $_GET["id"] . "/media/" . $newname[0] . '.jpg"> </div></div>';
        } else if ($ext == 'mp4') {
            $numviedo++;
            $drowalbum .= '<div class="swiper-slide"><div class="swiper-zoom-container"><video controls><source src="' . SITE_URL . '/platform/galleries/' . $_GET["id"] . "/media/" . $newname[0] . '.mp4" type="video/mp4"></video></div></div>';
        }
        $thumbs.= '<div onclick="showalbum();" class="item-container jq_item_container floating-left">
                        <div class="inner-item-container">
                            <div fileext="' . $ext . '"  class="galleries-thumb" style="background-image: url(' . SITE_URL . '/platform/galleries/' . $_GET["id"] . "/thumbnail/" . $newname[0] . '.jpg);"></div>
                        </div>
                    </div>';

        $i++;
    }
}

?>
<div class="inner-pages-main-container-galleries-inner">
    <?= $breadCrumbs; ?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="image-header-container">
                        <h1><?= $row["title_".$cat_code]; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="galleries-inner-content">
        <div class="center-piece">
            <div class="time-share-top-container">
                <div class="inner-silver-container">
                    <div class="time-side floating-left">
                        <div class="time-container floating-left">
                            <i class="floating-left"></i>
                            <span class="floating-left"><?= $row["date"]; ?></span>
                        </div>
                        <div class="galleries-count floating-left">
                            <span class="text-left floating-left"><?= $nuimage." ".$Lang->Photos; ?> </span>
                            <span class="comma text-left floating-left">,</span>
                            <span class="text-left floating-left"><?=$numviedo." ".$Lang->video?></span>

                        </div>

                    </div>
                    <!-- AddToAny BEGIN -->
                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style share-side floating-right">
                        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                        <a class="a2a_button_facebook"></a>
                        <a class="a2a_button_twitter"></a>
                        <a class="a2a_button_google_plus"></a>
                        <a class="a2a_button_linkedin"></a>
                        <a class="a2a_button_pinterest"></a>
                    </div>
                    <script>
                        var a2a_config = a2a_config || {};
                        a2a_config.onclick = 1;
                        a2a_config.color_main = "D7E5ED";
                        a2a_config.color_border = "AECADB";
                        a2a_config.color_link_text = "333333";
                        a2a_config.color_link_text_hover = "333333";
                    </script>
                    <script async src="<?= SITE_URL; ?>js/shared.js"></script>
                    <!-- AddToAny END -->
                </div>
            </div>
            <div class="main-galleries-container">
                <p>
                    <?= $row["description_" .$cat_code]; ?>
                </p>
                <div class="galleries-content">
                    <?=$thumbs?>
                </div>
            </div>

            <div class="write-comment-container">
                <?php
                if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
                    ?>
                    <textarea class="textaria" placeholder="<?= $Lang->writecomment; ?>"></textarea>
                    <a id="addcomment" data-type="galleries" data-id="<?= $row["id"]; ?>"
                       class="floating-right comment"><?= $Lang->Comment; ?></a>
                    <?php
                } else {
                    ?>
                    <a class="floating-right comment login-btn btn-popup"
                       data-type="Container"><?= $Lang->SignInToAddComment; ?></a>
                    <?php
                }
                ?>
                <div class="floating-left number-of-comments">
                    <label class="floating-left"><?= $Lang->Comments; ?></label>
                    <label class="floating-left jq_comments_count">(<?= $row["comments"]; ?>)</label>
                </div>

                <div class="post-comment-container scrollable">
                    <?php

                    $coment_array = getComments("galleries", $row["id"], 1);
                    echo $coment_array[0];
                    ?>
                </div>

                <div class="pagination-container">
                    <div class="paging">
                        <div class="content" data-type="galleries" data-id="<?= $row["id"]; ?>">
                            <?php
                            echo $coment_array[1];
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--<div class="popup-main-container-a" >-->
<!--    <div class="popup-tabel-a">-->
<!--        <div class="popup-row-a">-->
<!--            <div class="popup-cell-a">-->
<!--                <div class="popup-container-a change-prop" >-->
<!--                    <div class="popup-content-b galleries-slider" >-->
<!--                        <div class="close-container floating-right">-->
<!--                            <a class="close floating-right"><i></i></a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<div class="galleries-slider" style="display: none">

    <div class="swiper-container">
        <div class="close-container-gall floating-right">
            <a class="close11 floating-right"><i></i></a>
        </div>
    <div class="swiper-wrapper">
        <?php echo $drowalbum;?>
    </div>
    <div class="swiper-pagination swiper-pagination-white"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>
</div>
<script src="<?= SITE_URL . '/platform/galleries/' ?>dist/js/swiper.min.js"></script>
<script>
    $(document).ready(function(){
        $(document).on("click",".close-container-gall",function()
        {
            $(".galleries-slider").hide();
        });
    });
    function showalbum(){
        $(".galleries-slider").show();
        innershow();
    }
    function innershow()
    {
        if(swiper!=undefined){
            swiper=null;
        }
        console.log(swiper)
        var swiper = new Swiper('.swiper-container', {
            zoom: true,
            pagination: '.swiper-pagination',
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev'
        });
    }
    innershow();


</script>
<?php include("includes/footer.php"); ?>
