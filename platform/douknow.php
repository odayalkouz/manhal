<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/7/2016
 * Time: 1:45 PM
 */
include_once "includes/language.php";

?>

<form id="doyouknow_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->Title;?></label>
        <input class="floating-left txt-a" id="doyouknowtitle" type="text" name="doyouknowtitle">
    </div>
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->Description;?></label>
        <div class="txtaria-a floating-left poplinable"  id="doyouknowdesc" name="doyouknowdesc"></div>
<!--        <textarea class="txtaria-a floating-left poplinable" id="doyouknowdesc" name="doyouknowdesc"></textarea>-->
    </div>
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->uploadImage;?></label>
        <div class="fu-container-a floating-left">
            <label class="floating-left flaticon-cloud148 label-a"></label>
            <label class="floating-left label-b" id="lblaimagef"></label>
            <input id="douknowimage" type="file" name="douknowimage">
        </div>
    </div>
    <div class="line-row-b">
        <input type="button" class="btn-default floating-right" id="update_douknow" value="<?=$Lang->Update;?>">
        <input type="hidden" id="douknowimage_id" name="douknowimage_id" value="<?=$_GET['id'];?>">
    </div>
</form>


