<?php
include_once "includes/function.php";
mustLogin();
include_once("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/css/editaccount.css<?=$cash;?>">
<script>
    $(function()
    {
        $( "#vuser_date" ).datepicker();
    });
    $(function() {
        $( "#profile_birthdate").datepicker({
            defaultDate:+9,

            dayNamesMin: [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa" ],
            duration: "slow",
            dateFormat:"yy-mm-dd"
        });
    });
</script>
<div class="inner-pages-main-container-editaccount">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <form>
                        <div class="edit-account-main-container">
                            <h1><?= $Lang->Editaccount ?></h1>
                            <div class="top-container-account">
                                <div class="avatar floating-left">
                                    <img id="image_avatar" class="default_data" updated="0" src="<?=getAvatar();?>"/>
                                    <div class="upload">
                                        <input type="file" id="fuAvatar" onchange="readURL(this,'image_avatar');" name="fuAvatar">
                                    </div>
                                </div>
                                <div class="display-inline-block floating-right top-right-lbl">
                                    <div class="line-row-b">
                                        <input type="text" name="profile_username" id="profile_username" readonly value="<?=$_SESSION["user"]["uname"];?>" class="txt-a floating-left txt-username-a"  placeholder="<?= $Lang->LoginName?>">
                                    </div>
                                    <div class="line-row-b">
                                        <input name="profile_fullname" id="profile_fullname" value="<?=$_SESSION["user"]["fullname"];?>" type="text" class="txt-a floating-left txt-name-b" placeholder="<?= $Lang->FirstName?>">
                                    </div>
                                </div>
                            </div>
                            <div class="bottom-container">
                                <div class="display-inline-block text-left">
                                    <div class="line-row">
                                        <div class="ddl-container-a floating-left">
                                            <label id="lblddlCountry"></label>
                                            <select id="ddlCountry" onchange="$('#cmbCountry').val(this.options[this.selectedIndex].value);">
                                                <?php
                                                if(isset($session_lang) && $session_lang=="En"){
                                                    include "includes/countries.php";
                                                }else{

                                                    include "includes/countries_Ar.php";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                          <input name="profile_phone" id="profile_phone" maxlength="30" value="<?=$_SESSION["user"]["phone"];?>" size="30" type="tel" class="txt-b floating-left txt-phone-a" placeholder="<?= $Lang->Phone?>">
                                    </div>
                                   
                                    <div class="line-row">
                                        <div class="ddl-container-a floating-left">
                                            <label id="lblddlGender"><?= $Lang->Male?></label>
                                            <select id="ddlGender" name="ddlGender">

                                                <option <?php if($_SESSION["user"]["gender"]=="male"){echo 'selected="selected"';}?> value="male"><?= $Lang->Male?></option>
                                                <option <?php if($_SESSION["user"]["gender"]=="female"){echo 'selected="selected"';}?> value="female"><?= $Lang->Female?></option>
                                            </select>
                                        </div>
                                        <input value="<?=$_SESSION["user"]["email"];?>" name="profile_email" id="profile_email" maxlength="100" size="30" type="text" class="txt-b floating-left txt-email-a" placeholder="<?= $Lang->EmailAddress?>">

                                    </div>
                                    <div class="line-row">
                                        <input name="profile_address" value="<?=$_SESSION["user"]["address"];?>" id="profile_address" maxlength="200" size="30" type="text" class="txt-b floating-left txt-address-a" placeholder="<?= $Lang->AddressA?>">
                                        <input name="profile_birthdate" value="<?=$_SESSION["user"]["birthdate"];?>"  id="profile_birthdate" type="text" class="txt-c floating-left txt-password-d" placeholder="<?= $Lang->bodate?>">
                                    </div>
                                    <div class="line-row">
                                        <a id="update_account" class="floating-right"><?= $Lang->Update?></a>
                                    </div>
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
