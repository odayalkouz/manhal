<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/7/2016
 * Time: 1:45 PM
 */
include_once "includes/language.php";
?>

<form id="imagelink_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->Title;?></label>
        <input class="floating-left txt-a" id="aimagetitle" type="text" name="aimagetitle">
    </div>

    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->UpdateURL;?></label>
        <input class="txt-a floating-left" type="text" name="aurlvalue" id="aurlvalue" placeholder="<?=$Lang->URL;?>">
    </div>

    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->uploadImage;?></label>
        <div class="fu-container-a floating-left">
            <label class="floating-left flaticon-cloud148 label-a"></label>
            <label class="floating-left label-b" id="lblaimagef"></label>
            <input id="aimagef" type="file" name="aimage">
        </div>
    </div>

    <div class="line-row-b">
        <input type="button" class="btn-default floating-right" id="update_imagelink" value="<?=$Lang->Update;?>">
        <input type="hidden" id="aimage_id" name="aimage_id" value="<?=$_GET['id'];?>">
    </div>
</form>


