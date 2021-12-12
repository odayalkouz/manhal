<?php
include_once "includes/function.php";
mustLogin();
include_once("includes/header.php");

?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/editaccount.css<?=$cash;?>">

<div class="inner-pages-main-container-changepassword">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <form>
                        <div class="change-password-main-container">
                            <h1><?= $Lang->changepass?></h1>
                            <div class="display-inline-block text-left">
                                <!-- start khalid 21-9-2016  -->
                                <?php  if($_SESSION["user"]['social']==''||$_SESSION["user"]['social']==null){
                                ?>
                                <div class="line-row">
                                    <input type="password" name="old_password" id="old_password" class="txt-a" placeholder="<?=$Lang->OldPassword?>" maxlength="50" value="" size="30">
                                </div>
                                <?php } ?>
                                <!-- end khalid 21-9-2016  -->
                                <div class="line-row">
                                    <input type="password" name="new_password" id="new_password" class="txt-a" placeholder="<?=$Lang->NewPassword?>" maxlength="50" value="" size="30">
                                </div>
                                <div class="line-row">
                                    <input type="password" name="cpassword" id="cpassword" class="txt-a" placeholder="<?=$Lang->Cpassword?>" maxlength="50" value="" size="30">
                                </div>
                                <div class="line-row">
                                    <a id="update_password" class="floating-right"><?= $Lang->Update?></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
