<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/6/2016
 * Time: 1:22 PM
 */

include_once "includes/language.php";

?>


<form id="slider_form"  method="POST" action="" enctype="multipart/form-data" target="upload_target">
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->Title;?></label>
        <input class="floating-left txt-a" id="slidertitle" type="text" name="slidertitle">
    </div>
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->uploadvideo;?></label>
        <div class="fu-container-a floating-left">
            <label class="floating-left flaticon-cloud148 label-a"></label>
            <label class="floating-left label-b" id="lblaimagef"></label>
            <input id="sliderimage" type="file" multiple name="sliderimage[]">
        </div>
    </div>
    <div class="line-row-b">
        <input class="btn-default floating-right" type="button" id="update_slider" value="<?=$Lang->Update;?>">
        <input type="hidden" id="slider_id" name="slider_id" value="<?=$_GET['id'];?>">
    </div>
</form>
