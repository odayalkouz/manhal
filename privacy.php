<?php
include_once "includes/function.php";
include_once("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/aboutterm.css<?=$cash;?>">
<div class="inner-pages-main-container-priv">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="text-privacy-term-about">
                        <div class="title-container">
                            <h1><?=$Lang->privacyPolicy?></h1>
                        </div>
                        <div class="paragraph-without-title">
                            <p><?=$Lang->privacyPolicy1?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Whatinformationwecollectaboutyou?></h2>
                            <p><?=$Lang->privacyPolicy2?></p>
                            <p><?=$Lang->privacyPolicy3?></p>
                            <P><?=$Lang->privacyPolicy4?></P>
                            <P><?=$Lang->privacyPolicy5?></P>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Sharingwiththirdparties?></h2>
                            <p><?=$Lang->privacyPolicy6?></p>
                            <p><?=$Lang->privacyPolicy7?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Thirdpartysites?></h2>
                            <ul>
                                <li><div class="cirlce floating-left"></div><span class="auto floating-left"><?=$Lang->privacyPolicLI1?></span><a target="_blank" href="https://support.google.com/analytics/answer/6004245?hl=en" class="floating-left"><?=$Lang->here?></a></li>
                                <li><div class="cirlce floating-left"></div><span class="auto floating-left"><?=$Lang->privacyPolicLI2?></span><a target="_blank" href="https://www.paypal.com/us/webapps/mpp/public-policy" class="floating-left"><?=$Lang->here?></a></li>
                            </ul>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Dataretentionpolicy?></h2>
                            <p><?=$Lang->privacyPolicy9?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->DataSecurity?></h2>
                            <p><?=$Lang->privacyPolicy10?></p>
                            <p><?=$Lang->privacyPolicy11?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Changestothisprivacypolicy?></h2>
                            <p><?=$Lang->privacyPolicy12?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->ContectUs?></h2>
                            <p><?=$Lang->privacyPolicy13?></p>
                            <h3 class="text-left"><?=$Lang->DarAlManhalPublishers?></h3>
                            <div><?=$Lang->TitleOne?></div>
                            <div><?=$Lang->Titletwo?></div>
                            <div><?=$Lang->Titlethree?></div>
                            <div><?=$Lang->Titlefour?></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>
