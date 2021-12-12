<?php
$currentTab="imanhal";
include "includes/function.php";
include("includes/header.php");
?>
<script type="text/javascript" src="<?=SITE_URL?>viedoplayer/dist/plyr.js"></script>
<link rel="stylesheet" href="<?=SITE_URL?>viedoplayer/dist/plyr.css">
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/imanhal.css<?=$cash;?>">
<div class="inner-pages-main-container-stories">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="display-block top-text-content">
                        <h1><?=$Lang->toptitle?></h1>
                        <p><?=$Lang->topparagraph?></p>
                    </div>
                    <div class="display-block row-image-video">
                        <img class="floating-left right-image" src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/1.png"/>
                        <div class="video-content">
                            <img src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/ipadpro.png">
                            <video class="position-absolute manhal_video" controls crossorigin>
                                <source src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/videos/b.mp4" type="video/mp4">
                                <source src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/videos/b.mp4" type="video/ogg">
                            </video>
                        </div>
                    </div>
                    <div class="display-block row-image-text">
                        <div class="right floating-left">
                           <div class="right-content floating-left">
                               <img src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/2.svg">
                               <p><?=$Lang->imanhalparagraph1?></p>
                           </div>
                            <img class="left-content floating-left" src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/3.svg">
                        </div>
                        <div class="left floating-left">
                            <img class="left-content floating-left" src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/4.svg">
                            <div class="right-content floating-left">
                                <ul>
                                    <li><?=$Lang->advUL1?></li>
                                    <li><?=$Lang->advUL2?></li>
                                    <li><?=$Lang->advUL3?></li>
                                    <li><?=$Lang->advUL4?></li>
                                    <li><?=$Lang->advUL5?></li>
                                    <li><?=$Lang->advUL6?></li>
                                    <li><?=$Lang->advUL7?></li>
                                    <li><?=$Lang->advUL8?></li>
                                    <li><?=$Lang->advUL9?></li>
                                    <li><?=$Lang->advUL10?></li>
                                </ul>
                            </div>
                            <div class="display-block clear-both">
                                <img width="100%" height="100%" src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/5.png">
                            </div>
                        </div>
                    </div>
                    <div class="display-block row-video">
                        <video class="manhal_video1" src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/videos/a.mp4" controls crossorigin></video>
                    </div>

                    <div class="display-block row-image-text-with-title">
                        <div class="right floating-left">
                            <div class="right-content floating-left">
                                <h1 class="title"><?=$Lang->interactiveBook?></h1>
                                <p><?=$Lang->imanhalparagraph2?></p>
                                <a class="button floating-left" href="<?= SITE_URL . $lang_code; ?>/electronic-books"><?=$Lang->More1?></a>
                            </div>
                            <img class="left-content floating-left" src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/7.svg">
                        </div>
                        <div class="left floating-left">
                            <div class="right-content floating-left">
                                <h1 class="title"><?=$Lang->InteractiveStories?></h1>
                                <p><?=$Lang->imanhalparagraph3?></p>
                                <a class="button floating-left" href="<?= SITE_URL . $lang_code; ?>/electronic-stories"><?=$Lang->More1?></a>
                            </div>
                            <img class="left-content floating-left" src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/8.svg">
                        </div>
                    </div>





                    <div class="display-block row-image-text-with-title ">
                        <div class="right floating-left">
                            <div class="right-content floating-left">
                                <h1 class="title"><?=$Lang->ElectronicContent?></h1>
                                <p><?=$Lang->imanhalparagraph2?></p>
                                <a class="button floating-left" href="<?= SITE_URL . $lang_code; ?>/games"><?=$Lang->More1?></a>
                            </div>
                            <img class="left-content floating-left" src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/9.svg">
                        </div>
                        <div class="floating-left content-three-col">
                            <div class="item-container floating-left">
                                <h2 class="floating-left"><?=$Lang->ElectronicContenttitle1?></h2>
                                <img class="floating-left" src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/product/1.svg">
                            </div>
                            <div class="item-container floating-left">
                                <h2 class="floating-left"><?=$Lang->ElectronicContenttitle2?></h2>
                                <img class="floating-left" src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/product/2.svg">
                            </div>
                            <div class="item-container floating-left">
                                <h2 class="floating-left"><?=$Lang->ElectronicContenttitle3?></h2>
                                <img class="floating-left" src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/product/3.svg">
                            </div>
                            <div class="item-container floating-left">
                                <h2 class="floating-left"><?=$Lang->ElectronicContenttitle4?></h2>
                                <img class="floating-left" src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/product/4.svg">
                            </div>
                            <div class="item-container floating-left">
                                <h2 class="floating-left"><?=$Lang->ElectronicContenttitle5?></h2>
                                <img class="floating-left" src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/product/5.svg">
                            </div>
                            <div class="item-container floating-left">
                                <h2 class="floating-left"><?=$Lang->ElectronicContenttitle6?></h2>
                                <img class="floating-left" src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imanhal/product/6.svg">
                            </div>
                        </div>
                    </div>

                    <div class="display-block row-image-text-with-title can_contactus">
                        <h1><?=$Lang->can_contactus?></h1>
                        <div class="display-block itemAS-container">
                            <a href="https://wa.me/00962787000522" class="itemA floating-left">
                                <img src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/cancont/01.svg"/>
                                <p>+962 787 000 522</p>
                            </a>
                            <div class="itemB floating-left">
                                <img src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/cancont/02.svg"/>
                                <p>+962 (6) 553 3889</p>
                            </div>
                            <div class="itemC floating-left">
                                <img src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/cancont/03.svg"/>
                                <p>support@manhal.com</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            player = new Plyr('.manhal_video');
            player1 = new Plyr('.manhal_video1');
        });
    </script>
</div><?php include("includes/footer.php");?>
