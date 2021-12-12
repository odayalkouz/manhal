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
                            <h1><?=$Lang->Return_Policy?></h1>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Shippinginfo?></h2>
                            <p><?=$Lang->ShippinginfoParag?></p>
                            <p style="margin-bottom: 0"><?=$Lang->Shippinginfopoint1?></p>
                            <p><?=$Lang->Shippinginfopoint2?></p>

                            <p><?=$Lang->ShippinginfoParag1?></p>
                            <p><a style="color: #00a951;text-decoration: underline" href="mailto:support@manhal.com">support@manhal.com</a></p>
                            <p>+962787000410</p>
                        </div>

                        <div class="paragraph-with-title">
                            <h2><?=$Lang->OrderCancellation?></h2>
                            <p><?=$Lang->OrderCancellationParag1?></p>
                            <p><?=$Lang->OrderCancellationParag2?></p>
                        </div>

                        <div class="paragraph-with-title">
                            <h2><?=$Lang->DamagedBooks?></h2>
                            <p><?=$Lang->DamagedBooksParag1?></p>
                            <p><?=$Lang->DamagedBooksParag2?></p>
                            <p><?=$Lang->DamagedBooksParag3?></p>
                            <p><?=$Lang->DamagedBooksParag4?></p>
                            <p><a style="color: #00a951;text-decoration: underline" href="mailto:support@manhal.com">support@manhal.com</a></p>
                            <p>+962787000410</p>
                        </div>
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->ReturnProcedure?></h2>
                            <p><?=$Lang->ReturnProcedureParag1?></p>
                            <p><?=$Lang->ReturnProcedureParag2?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>
