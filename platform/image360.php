<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/6/2016
 * Time: 1:22 PM
 */

include_once "includes/language.php";

?>


<form id="image360_form"  method="POST" action="" enctype="multipart/form-data" target="upload_target">
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->Title;?></label>
        <input class="floating-left txt-a" id="image360title" type="text" name="image360title">
    </div>
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->images;?></label>
        <div class="fu-container-a floating-left">
            <label class="floating-left flaticon-cloud148 label-a"></label>
            <label class="floating-left label-b" id="lblimage360images"></label>
            <input id="image360images" type="file" multiple name="image360images[]">
        </div>
    </div>
    <div class="line-row-b">
        <input class="btn-default floating-right" type="button" id="update_image360" value="<?=$Lang->Update;?>">
        <input type="hidden" id="image360_id" name="image360_id" value="<?=$_GET['id'];?>">
        <input type="hidden" id="image360_id2" name="image360_id2" value="<?=$_GET['id2'];?>">
    </div>
</form>
