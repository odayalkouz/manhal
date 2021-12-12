<?php
/**
 * User: khalid alomiri
 * Date: 1/4/2016
 * Time: 1:17 PM
 */
$cuerrentpage="index.php";
if(session_status()==PHP_SESSION_NONE){ session_start();}

include_once('config.php') ;
include_once('includes/language.php') ;
include_once('../includes/function.php');
include "includes/header.php";
?>
<link rel="stylesheet" type="text/css" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/fonts/font-awesome/css/font-awesome.min.css"/>
<script type="text/javascript" src="../js/jquery.popline.min.js"></script>
<link rel="stylesheet" type="text/css" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/css/default.css">
<script type="text/javascript">
    $(document).ready(function () {
        $(".color-pallet a").click(function () {
            $(this).addClass("active").siblings().removeClass("active");
            alert($(this).attr("color-val"));
        });
    });
</script>
<div class="edit-book">
    <div class="title-pages text-left">
        <h1><?= $Lang->editsubscription ?></h1>
    </div>
    <div class="form-container">
        <form id="editbook">
            <input type="hidden" name="book_id" id="book_id" value="<?= $_GET['id']; ?>">
            <div class="display-inline-block floating-left">
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->User ?></label>
                    <input type="text" class="txt-a floating-left" id="User" name="User" placeholder="<?= $Lang->User ?>" value="oday alkouz">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Cost ?></label>
                    <input type="text" class="txt-a floating-left" id="Cost" name="Cost" placeholder="<?= $Lang->Cost ?>" value="$100">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->ExpirationDate?></label>
                    <input type="date" class="txt-a floating-left" id="ExpirationDate" name="ExpirationDate" placeholder="<?= $Lang->ExpirationDate ?>" value="13-2-2018">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->accountnumber?></label>
                    <input type="text" class="txt-a floating-left" id="accountnumber" name="accountnumber" placeholder="<?= $Lang->accountnumber;?>" value="#10">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Price ?></label>
                    <input type="text" class="txt-a floating-left" id="Price" name="Price" placeholder="<?= $Lang->Price;?>" value="$100">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?=$Lang->AllowedTeachers?></label>
                    <input type="text" class="txt-a floating-left" id="AllowedTeachers" name="AllowedTeachers" placeholder="<?=$Lang->AllowedTeachers;?>" value="5">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?=$Lang->AllowedStudents?></label>
                    <input type="text" class="txt-a floating-left" id="AllowedStudents" name="AllowedStudents" placeholder="<?=$Lang->AllowedStudents;?>" value="20">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?=$Lang->ActiveTeachers?></label>
                    <input type="text" class="txt-a floating-left" id="ActiveTeachers" name="ActiveTeachers" placeholder="<?=$Lang->ActiveTeachers;?>" value="2">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?=$Lang->ActiveStudents?></label>
                    <input type="text" class="txt-a floating-left" id="ActiveStudents" name="ActiveStudents" placeholder="<?=$Lang->ActiveStudents;?>" value="13">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?=$Lang->UserCode?></label>
                    <input type="text" class="txt-a floating-left" id="UserCode" name="UserCode" placeholder="<?=$Lang->UserCode;?>" value="123123">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?=$Lang->TeacherCode?></label>
                    <input type="text" class="txt-a floating-left" id="TeacherCode" name="TeacherCode" placeholder="<?=$Lang->TeacherCode;?>" value="959823">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?=$Lang->StartDate?></label>
                    <input type="date" class="txt-a floating-left" id="StartDate" name="StartDate" placeholder="<?=$Lang->StartDate;?>" value="1-1-2018">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->paymenttype?></label>
                    <input class="floating-left check-box" type="radio" name="paymenttype" id="Monthly" value='' checked="checked">
                    <label class="floating-left lbl-data-b" for="Monthly"><?=$Lang->Monthly;?></label>
                    <input class="floating-left check-box" type="radio" name="paymenttype" id="yearly" value=''>
                    <label class="floating-left lbl-data-b" for="yearly"><?=$Lang->yearly;?></label>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Subscribetype?></label>
                    <input class="floating-left check-box" type="radio" name="Subscribetype" id="Families1" value='' checked="checked">
                    <label class="floating-left lbl-data-b" for="Families1"><?=$Lang->Families1;?></label>
                    <input class="floating-left check-box" type="radio" name="Subscribetype" id="Schools" value=''>
                    <label class="floating-left lbl-data-b" for="Schools"><?=$Lang->Schools;?></label>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Status?></label>
                    <input class="floating-left check-box" type="radio" name="Status" id="Active" value='' checked="checked">
                    <label class="floating-left lbl-data-b" for="Active"><?=$Lang->Active;?></label>
                    <input class="floating-left check-box" type="radio" name="Status" id="Expired" value=''>
                    <label class="floating-left lbl-data-b" for="Expired"><?=$Lang->Expired;?></label>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->PaymentMethods?></label>
                    <input class="floating-left check-box" type="radio" name="PaymentMethods" id="MASTERCARD" value='' checked="checked">
                    <label class="floating-left lbl-data-b" for="MASTERCARD"><?=$Lang->MASTERCARD;?></label>
                    <input class="floating-left check-box" type="radio" name="PaymentMethods" id="paypal" value=''>
                    <label class="floating-left lbl-data-b" for="paypal"><?=$Lang->Paypal;?></label>
                    <input class="floating-left check-box" type="radio" name="PaymentMethods" id="VISA" value=''>
                    <label class="floating-left lbl-data-b" for="VISA"><?=$Lang->VISA;?></label>
                    <input class="floating-left check-box" type="radio" name="PaymentMethods" id="cod" value=''>
                    <label class="floating-left lbl-data-b" for="cod"><?=$Lang->cod;?></label>
                    <input class="floating-left check-box" type="radio" name="PaymentMethods" id="ios" value=''>
                    <label class="floating-left lbl-data-b" for="ios"><?=$Lang->ios;?></label>
                    <input class="floating-left check-box" type="radio" name="PaymentMethods" id="android" value=''>
                    <label class="floating-left lbl-data-b" for="android"><?=$Lang->android;?></label>
                </div>
            </div>
            <div class="display-inline-block floating-left">
         </form>
    </div>
    <input name="commit" type="button" value="<?= $Lang->Update;?>" class="btn-default-a floating-right clear-both">
</div>
</div>
<?php
include "includes/footer.php";
?>
