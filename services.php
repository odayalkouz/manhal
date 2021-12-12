<?php
$currentTab="services";
include_once "includes/function.php";
include_once("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/services.css<?=$cash;?>">
<div class="inner-pages-main-container-services">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="image-header-container">
                        <h1><?= $Lang->Services;?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="services-content">
        <div class="center-piece" style="overflow: visible">
            <div class="inner-container">
                <p class="paragraph"><?=$Lang->WhatweofferParagraph1;?></p>
                <p class="paragraph"><?=$Lang->WhatweofferParagraph2;?></p>
                <p class="paragraph"><?=$Lang->WhatweofferParagraph3;?></p>
                <p class="paragraph"><?=$Lang->WhatweofferParagraph4;?></p>
            <div class="items-main-container">
                <div class="display-block-a" id="School">
                    <div class="item-container" >
                        <div class="inner-item-container">
                            <p class="inner-paragraph"><?=$Lang->schooldesc?></p>
                        </div>
                        <div class="note rounded">
                            <label class="image1 floating-left"></label>
                            <h2 class="floating-left title"><?=$Lang->Schools?></h2>
                        </div>
                    </div>
                </div>
                <div class="display-block-a" id="Families">
                    <div class="item-container" >
                        <div class="inner-item-container" >
                            <p class="inner-paragraph"><?=$Lang->Familiesdesc?></p>
                        </div>
                        <div class="note rounded" >
                            <label class="image2 floating-left"></label>
                            <h2 class="floating-left title"><?=$Lang->Families?></h2>
                        </div>
                    </div>
                </div>
                <div class="display-block-a" id="Publishers">
                    <div class="item-container">
                        <div class="inner-item-container" >
                            <p class="inner-paragraph"><?=$Lang->Publishersdesc?></p>
                        </div>
                        <div class="note rounded">
                            <label class="image3 floating-left"></label>
                            <h2 class="floating-left title"><?=$Lang->Publishers?></h2>
                        </div>
                    </div>
                </div>
                <div class="display-block-a" id="Authors">
                    <div class="item-container">
                        <div class="inner-item-container" >
                            <p class="inner-paragraph"><?=$Lang->Authorsdesc?></p>
                        </div>
                        <div class="note rounded" >
                            <label class="image4 floating-left"></label>
                            <h2 class="floating-left title"><?=$Lang->Authors?></h2>
                        </div>
                    </div>
                </div>
                <div class="display-block-a" id="Ipad-and-Mobile-Apps">
                    <div class="item-container">
                        <div class="inner-item-container">
                            <p class="inner-paragraph"><?=$Lang->IpadandMobileAppsdesc?></p>
                        </div>
                        <div class="note rounded">
                            <label class="image5 floating-left"></label>
                            <h2 class="floating-left title"><?=$Lang->IpadandMobileApps?></h2>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>
