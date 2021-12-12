<?php
include_once "includes/function.php";
include_once("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/aboutterm.css<?=$cash;?>">
<script>
    $(document).ready(function () {
        $("#back").click(function () {
            window.history.back();
        });
    });
</script>
<div class="inner-pages-main-container-priv">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="text-privacy-term-about">
                        <div class="paragraph-with-title">
                            <h2><?=$Lang->Dearcustomer?></h2>
                            <p><?=$Lang->Dearcustomer1?></p>
                            <p><?=$Lang->Dearcustomer2?></p>
                            <P><?=$Lang->Dearcustomer3?></P>
                            <P><?=$Lang->Dearcustomer4?></P>
                            <a id="back" class=" floating-right button back"><?= $Lang->Back;?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>
