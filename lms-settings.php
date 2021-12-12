<?php
include_once "includes/function.php";
mustLogin();
include_once("includes/header.php");

?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/editaccount.css<?=$cash;?>">

<div class="configuration-Lms">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <form>
                        <div class="change-password-main-container">
                            <h1><?= $Lang->Configurationsetting?></h1>
                            <div class="display-block text-left">
                                <div class="description-container text-left">
                                    <?=$Lang->LMSSettingsDesc?>
                                </div>
                                <div class="display-inline-block text-left floating-left">
                                <div class="line-row-lms">
                                    <label class="floating-left lbl-text-a text-left"><?=$Lang->SchoolNameEn?></label>
                                    <input type="text" name="title_en" id="title_en"  value="" class="floating-left txt-a" placeholder="<?=$Lang->SchoolNameEn?>">
                                </div>
                                <div class="line-row-lms">
                                    <label class="floating-left lbl-text-a text-left"><?=$Lang->SchoolNameAr?></label>
                                    <input type="text" name="title_ar" id="title_ar"  value="" class="floating-left txt-a" placeholder="<?=$Lang->SchoolNameAr?>">
                                </div>
                                <div class="line-row-lms">
                                    <label class="floating-left lbl-text-a text-left"><?=$Lang->Logo?></label>
                                    <div class="fu-container-a floating-left">
                                        <label class="floating-left flaticon-cloud148 label-a"></label>
                                        <label class="floating-left label-b" id="lblimage_txt"></label>
                                            <input id="image_txt" type="file" name="image" onchange="readURL(this,'default-image');">
                                    </div>
                                </div>
                                <div class="line-row-lms">
                                    <label class="floating-left lbl-text-a text-left">
                                        <div class="floating-left"><?=$Lang->Link?></div>
                                        <a class="tooltip-lms floating-left">
                                            <div class="images-click"></div>
                                            <span class="custom help" style="display: none;">
                                                <label><?=$Lang->LMSSettingsNote?></label>
                                            </span>
                                        </a></label>
                                    <input type="text" name="subdomain" id="subdomain"  value="" class="floating-left txt-a" placeholder="<?=$Lang->Link?>">
                                    <span class="link floating-left text-left">.manhal.com</span>
                                </div>
                                </div>
                                <div class="display-inline-block text-left floating-left">
                                    <img src="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/imagedef.svg" id="default-image" class="default-image floating-left" style="background-size: contain;background-position: center"/>
                                </div>
                                <div class="line-row-lms clear-both">
                                    <a id="create-lms" class="floating-right create"><?=$Lang->Create?></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
