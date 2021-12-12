<?php
$currentTab="features";
include "includes/function.php";
include("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/features.css<?=$cash;?>">

<div class="inner-pages-main-container-features">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="image-header-container">
                        <h1><?= $Lang->Features;?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="features-content">
        <div class="center-piece" style="overflow: visible">
            <div class="inner-container">
                <p class="paragraph"><?=$Lang->FeaturesTitle;?></p>
                <p class="paragraph"><?=$Lang->FeaturesParagraph;?></p>
            <div class="items-main-container">
                <div class="item-container" id="crosos-platform">
                    <div class="inner-item-container">
                        <p class="inner-paragraph"><?=$Lang->CrossPlatformDesc?></p>
                    </div>
                    <div class="note rounded" >
                        <label class="image floating-left"></label>
                        <h2 class="floating-left title"><?=$Lang->CrossPlatform?></h2>
                    </div>
                </div>
                <div class="item-container" id="shopping-online">
                    <div class="inner-item-container">
                        <p class="inner-paragraph"><?=$Lang->EShopDesc?></p>
                    </div>
                    <div class="note rounded" >
                        <label class="image floating-left"></label>
                        <h2 class="floating-left title"><?=$Lang->EShop?></h2>
                    </div>
                </div>
                <div class="item-container" id="reading-online">
                    <div class="inner-item-container">
                        <p class="inner-paragraph"><?=$Lang->ReadingOnlineDesc?></p>
                    </div>
                    <div class="note rounded" >
                        <label class="image floating-left"></label>
                        <h2 class="floating-left title"><?=$Lang->ReadingOnline?></h2>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
