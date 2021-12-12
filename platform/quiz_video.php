<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/26/2016
 * Time: 1:22 PM
 */

include_once "includes/language.php";

?>

<form id="video_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">
    <div class="line-row">
        <label class="lbl-data-a floating-left"><?=$Lang->YoutubeURL;?></label>
        <input class="txt-a floating-left" type="text" name="youtube" id="youtube" placeholder="<?=$Lang->YoutubeURL;?>">
    </div>
    <div class="line-row">
        <label class="lbl-data-a floating-left"><?=$Lang->uploadvideo;?></label>
        <div class="fu-container-a floating-left">
            <label class="floating-left flaticon-cloud148 label-a"></label>
            <label class="label-b floating-left" id="lblvideo"></label>
            <input id="video" type="file" name="video">
        </div>
    </div>
    <div class="line-row">
        <input class="btn-default floating-left" type="button" id="update_video" value="<?=$Lang->Update;?>">
        <input type="hidden" name="video_id" id="video_id" value="<?=$_GET['id'];?>">
    </div>
</form>
