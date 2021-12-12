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
                        <div class="title-container-a">
                            <h1><?=$Lang->TermsConditions?></h1>
                        </div>
                        <div class="paragraph-without-title">
                            <p><?=$Lang->TermsConditionsp1?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Copyrightandownership?></h2>
                            <p><?=$Lang->TermsConditionsp2?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Siteaccesslicense?></h2>
                            <p><?=$Lang->TermsConditionsp3?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Corporateidentificationtrademarks?></h2>
                            <p><?=$Lang->TermsConditionsp4?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Linkstothirdpartiesnoendorsement?></h2>
                            <p><?=$Lang->TermsConditionsp5?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Fees?></h2>
                            <p><?=$Lang->TermsConditionsp6?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->privacyPolicy?></h2>
                            <p><?=$Lang->TermsConditionsp7?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Usersubmissions?></h2>
                            <p><?=$Lang->TermsConditionsp8?></p>
                            <p><?=$Lang->TermsConditionsp9?></p>
                            <ul>
                                <li><div class="cirlce floating-left"></div><span class="floating-left"><?=$Lang->TermsConditionsp10?></span><a class="floating-left"></a></li>
                                <li><div class="cirlce floating-left"></div><span class="floating-left"><?=$Lang->TermsConditionsp11?></span><a class="floating-left"></a></li>
                                <li><div class="cirlce floating-left"></div><span class="floating-left"><?=$Lang->TermsConditionsp12?></span><a class="floating-left"></a></li>
                                <li><div class="cirlce floating-left"></div><span class="floating-left"><?=$Lang->TermsConditionsp13?></span><a class="floating-left"></a></li>
                                <li><div class="cirlce floating-left"></div><span class="floating-left"><?=$Lang->TermsConditionsp14?></span><a class="floating-left"></a></li>
                                <li><div class="cirlce floating-left"></div><span class="floating-left"><?=$Lang->TermsConditionsp15?></span><a class="floating-left"></a></li>
                                <li><div class="cirlce floating-left"></div><span class="floating-left"><?=$Lang->TermsConditionsp16?></span><a class="floating-left"></a></li>
                            </ul>
                            <p><?=$Lang->TermsConditionsp17?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Removalofusersubmissions?></h2>
                            <p><?=$Lang->TermsConditionsp18?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Accountregistrationandsecurity?></h2>
                            <p><?=$Lang->TermsConditionsp19?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Termination?></h2>
                            <p><?=$Lang->TermsConditionsp20?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Forcemajeure?></h2>
                            <p><?=$Lang->TermsConditionsp21?></p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Entireagreement?></h2>
                            <p><?=$Lang->TermsConditionsp22?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>
