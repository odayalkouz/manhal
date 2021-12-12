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
        <input class="floating-left txt-a" id="scratchertitle" type="text" name="scratchertitle">
    </div>
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->FontSize;?></label>
        <input class="floating-left txt-a" id="fontsize" type="text" name="fontsize">
    </div>
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->BackgroundIMG;?></label>
        <div class="fu-container-a floating-left">
            <label class="floating-left flaticon-cloud148 label-a"></label>
            <label class="floating-left label-b" id="lblbgimage"></label>
            <input id="bgimage" type="file" name="bgimage">
        </div>
    </div>
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->FrontIMG;?></label>
        <div class="fu-container-a floating-left">
            <label class="floating-left flaticon-cloud148 label-a"></label>
            <label class="floating-left label-b" id="lblfgimage"></label>
            <input id="fgimage" type="file" name="fgimage">
        </div>
    </div>
    <div class="line-row-b">
        <input class="btn-default floating-right" type="button" id="update_scratcher" value="<?=$Lang->Update;?>">
        <input type="hidden" id="scratcher_id" name="scratcher_id" value="<?=$_GET['id'];?>">
    </div>
</form>
