<?php
/**
 * Created by PhpStorm.
 * User: khalid alomiri
 * Date: 1/4/2016
 * Time: 1:17 PM
 */
$cuerrentpage="user.php";

if(session_status()==PHP_SESSION_NONE){ session_start();}

if($_SESSION["user"]['permession']!='1'){
    die();
}

include_once('config.php') ;
include_once('includes/language.php') ;
?>
<!--    <script type="text/javascript" src="js/jquery.js"></script>-->
<!--    <script type="text/javascript" src="js/ajax.js"></script>-->
    <script type="text/javascript" >
        function saveuser(){
            var msg="";
            if($("#user_name").val().trim()==""){
                msg+=window.Lang.PleaseInsertUsername;
            }else if($("#user_password").val().trim()==""){
                msg+=window.Lang.PleaseInsertPassword;
            }else if(!validateEmail($("#user_email").val().trim())){
                msg+=window.Lang.InvalidEmailAddress;
            }else if($("#user_fullname").val().trim()==""){
                msg+=window.Lang.PleaseInsertFullName;
            }

            if(msg==""){
                var data={
                    user_name:$("#user_name").val(),
                    user_password:$("#user_password").val(),
                    user_email:$("#user_email").val(),
                    user_permession:$("#user_permession").prop("selectedIndex")+1,
                    user_fullname:$("#user_fullname").val(),
                    user_status:$("#user_status").prop("selectedIndex"),
                    TypeProcesses:'createuser'
                };

                setdatafunction('createuser',data);
            }else{
                swal(window.Lang['Error'],msg,'error');
            }

        }


    </script>
<?php
$bredcrumb = '<li class="floating-left"><a href="user.php" class="floating-left">'.$Lang->Users.'</a></li><span class="floating-left">/</span><li class="floating-left"><a href="createuser.php" class="floating-left active">'.$Lang->CreateUser.'</a></li>';

include "includes/header.php";
?>
    <div class="edit-book">
        <div class="form-container">
            <form id="edituser">
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->UserName ?></label>
                    <input type="text" class="txt-a floating-left" id="user_name" name="user_name" placeholder="<?= $Lang->UserName ?>" value="">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Password ?></label>
                    <input type="text" class="txt-a floating-left" id="user_password" name="user_password" placeholder="<?= $Lang->Password ?>" value="">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Mail ?></label>
                    <input type="text" class="txt-a floating-left" id="user_email" name="user_email" placeholder="<?= $Lang->Mail ?>" value="">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->FullName ?></label>
                    <input type="text" class="txt-a floating-left" id="user_fullname" name="user_fullname" placeholder="<?= $Lang->FullName ?>" value="">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?= $Lang->Permession ?>
                    </label>
                    <select class="txt-a floating-left" id="user_permession" name="user_permession">
                        <option value="1" ><?= $Lang->Admin ?></option>
                        <option value="2" selected ><?= $Lang->User ?></option>
                    </select>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?= $Lang->Status ?>
                    </label>
                    <select class="txt-a floating-left" id="user_status" name="user_status">
                        <option value="0"  ><?= $Lang->Disable ?></option>
                        <option value="1" selected  ><?= $Lang->Enabled ?></option>
                    </select>
                </div>
            </form>
        </div>
        <input name="commit" onclick="saveuser()" type="button" value="<?= $Lang->Save ?>" class="btn-default-a floating-left">
    </div>
<?php
include "includes/footer.php";
?>