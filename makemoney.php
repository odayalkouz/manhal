<?php
include "includes/function.php";
include("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/makemony.css<?=$cash;?>">
<div class="inner-pages-main-container-makemony">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="image-header-container">
                        <h1><?= $Lang->MakeMoney;?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="makemony-content">
        <div class="center-piece">
            <div class="inner-container">
                <div class="title1"><?=$Lang->MakeMoneyTitle1;?></div>
                <div class="title2"><?=$Lang->MakeMoneyTitle2;?></div>
                <p class="paragraph"><?=$Lang->MakeMoneyParagraph1;?></p>
                <p class="paragraph"><?=$Lang->MakeMoneyParagraph2;?></p>
                <p class="paragraph"><?=$Lang->MakeMoneyParagraph3;?></p>
                <p class="paragraph"><?=$Lang->MakeMoneyParagraph4;?></p>
                <p class="paragraph"><?=$Lang->MakeMoneyParagraph5;?></p>
                <p class="paragraph"><?=$Lang->MakeMoneyParagraph6;?></p>
                <p class="paragraph-bottom"><?=$Lang->MakeMoneyParagraph7;?></p>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
