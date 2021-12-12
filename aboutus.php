<?php
$currentTab="aboutus";
include "includes/function.php";
include("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/aboutterm.css<?=$cash;?>">
<div class="inner-pages-main-container-priv">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="text-privacy-term-about">
                        <div class="title-container-about">
                            <h1><?=$Lang->AboutUs?></h1>
                        </div>
                        <div class="paragraph-without-title">
                            <p><?=$Lang->AboutUs1?></p>
                        </div>
                        <div class="paragraph-without-title">
                            <p><?=$Lang->AboutUs2?></p>
                        </div>
                        <div class="paragraph-without-title">
                            <p><?=$Lang->AboutUs3?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>
