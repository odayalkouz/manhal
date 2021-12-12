<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/6/2016
 * Time: 1:22 PM
 */

include_once "includes/language.php";

?>


<form id="video_form"  method="POST" action="" enctype="multipart/form-data" target="upload_target">
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->Title;?></label>
            <input class="floating-left txt-a" id="videotitle" type="text" name="videotitle">
    </div>
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->uploadvideo;?></label>
        <input class="txt-a floating-left" type="text" name="youtube" id="youtube" placeholder="<?=$Lang->YoutubeURL;?>">
        </div>
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->uploadvideo;?></label>
        <div class="fu-container-a floating-left">
            <label class="floating-left flaticon-cloud148 label-a"></label>
            <label class="floating-left label-b" id="lblaimagef"></label>
            <input id="uvideo" type="file" name="uvideo">
        </div>
    </div>
    <div class="line-row-b">
    <input class="btn-default floating-right" type="button" id="update_video" value="<?=$Lang->Update;?>">
        <input type="hidden" id="video_id" value="<?=$_GET['id'];?>">
    </div>
</form>
