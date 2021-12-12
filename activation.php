<?php
include_once "includes/function.php";
mustLogin();
include_once("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/css/activation.css<?=$cash;?>">
<div class="inner-pages-main-container-editaccount">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="activation-main-container">
                        <h1><?=$Lang->Activation?></h1>
                        <p><?=$Lang->Activationparagraph?></p>
                        <?php
                        if(isset($_SESSION["user"]["permession"]) && ($_SESSION["user"]["permession"]==1 || $_SESSION["user"]["permession"]==2 || $_SESSION["user"]["permession"]==10 || $_SESSION["user"]["permession"]==11)){
                            echo "<div class='bolder'>".$Lang->AccountCannotActivate."</div>";
                        }else{
                            ?>
                        <div class="box-container">
                            <div class="left floating-left">
                                <label class="lbl-data-a"><?= $Lang->PleaseEntertheActivationCode?></label>
                                <input type="text" id="activation_code" class="txt-a floating-left txt-username-a" placeholder="<?=$Lang->ActivationCode?>">
                                <a class="go floating-left" id="activate_user"><?= $Lang->GO?></a>
                                <a class="link floating-left" href="<?=SITE_URL.$lang_code;?>/subscribe"><?=$Lang->NeedtoActivationCodeGETIT?></a>
                            </div>
                            <div class="right floating-right"></div>
                        </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>
