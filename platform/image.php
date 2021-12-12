<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/7/2016
 * Time: 12:48 PM
 */
include_once "includes/language.php";
?>

<form id="image_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->Title;?></label>
        <input class="floating-left txt-a" id="imagetitle" type="text" name="imagetitle">
    </div>
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->uploadImage;?></label>
        <div class="fu-container-a floating-left">
            <label class="floating-left flaticon-cloud148 label-a"></label>
            <label class="floating-left label-b" id="lblimage"></label>
            <input id="image" type="file" name="image">
        </div>
    </div>
    <div class="line-row-b">
        <input type="button" class="btn-default floating-right" id="update_image" value="<?=$Lang->Update;?>">
        <input type="hidden" id="image_id" name="image_id" value="<?=$_GET['id'];?>">
    </div>
</form>


