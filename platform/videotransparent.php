<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/6/2016
 * Time: 1:22 PM
 */

include_once "includes/language.php";

?>


<form id="vt_form"  method="POST" action="" enctype="multipart/form-data" target="upload_target">
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->Title;?></label>
        <input class="floating-left txt-a" id="vttitle" type="text" name="vttitle">
    </div>
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->Video;?></label>
        <div class="fu-container-a floating-left">
            <label class="floating-left flaticon-cloud148 label-a"></label>
            <label class="floating-left label-b" id="lblvtvideo"></label>
            <input id="vtvideo" type="file" name="vtvideo">
        </div>
    </div>
    <div class="line-row-b">
        <input class="btn-default floating-right" type="button" id="update_vt" value="<?=$Lang->Update;?>">
        <input type="hidden" id="vt_id" name="vt_id" value="<?=$_GET['id'];?>">
    </div>
</form>
