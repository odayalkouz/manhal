<?php
/**
 * Created by Dar Al-Manhal - Hussam Abu KHadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 10/24/2016
 * Time: 11:57 AM
 */
include_once "includes/function.php";
include_once("includes/header.php");
$msg="";
if(isset($_GET["token"]) && $_GET["token"]!=''){
    $sql="SELECT * FROM `users` WHERE `token`='".$_GET['token']."'";
    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
    }else{
        $msg=$Lang->ExpierResetLink;
    }
}else{
    $msg=$Lang->ExpierResetLink;
}

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
                            <h1><?= $Lang->PasswordReset?></h1>
                            <?php
                            if($msg=="" || 1){
                                ?>
                                <div class="display-inline-block text-left">
                                    <div class="line-row">
                                        <input type="password" name="new_password" id="new_password" class="txt-a" placeholder="<?=$Lang->NewPassword?>" maxlength="50" value="" size="30">
                                    </div>
                                    <div class="line-row">
                                        <input type="password" name="cpassword" id="cpassword" class="txt-a" placeholder="<?=$Lang->Cpassword?>" maxlength="50" value="" size="30">
                                    </div>
                                    <div class="line-row">
                                        <a id="reset_password" class="floating-right"><?= $Lang->ResetPassword;?></a>
                                    </div>
                                    <input type="hidden" id="token" value="<?=$_GET["token"];?>">
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="reset-password-message">
                                <?=$msg;?>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
