<?php
$currentTab="products";
include "includes/function.php";
include("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/products.css<?=$cash;?>">
<div class="inner-pages-main-container-products">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="image-header-container">
                        <h1><?= $Lang->InteractiveBooks;?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="products-content">
        <div class="center-piece" style="overflow:visible">
            <div class="inner-container">
                <div class="items-main-container">
                    <div class="display-block-a-info" id="interactive_books">
                        <div class="item-container">
                            <div class="inner-item-container">
                                <?=$Lang->interactivebooksinfoDesc1?>
                                <a href="<?= SITE_URL . $lang_code;?>/books">
                                <?=$Lang->interactivebooksinfoDesc2?>
                            </div>
                            <div class="note rounded">
                                <label class="image floating-left"></label>
                                <h2 class="floating-left title"><?=$Lang->daralmanhainteractivebooksinformations?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>

