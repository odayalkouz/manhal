<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/26/2016
 * Time: 1:22 PM
 */
include_once "includes/language.php";
?>

<form id="sound_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">
    <div class="line-row-a">
        <label class="lbl-data-a floating-left"><?=$Lang->uploadSound;?></label>
    <div class="fu-container-a floating-left">
        <label class="floating-left flaticon-cloud148 label-a"></label>
        <label class="label-b floating-left" id="lblsound"></label>
        <input id="sound" type="file" name="sound">
    </div>
    <input type="button" class="btn-default" id="update_sound" value="<?=$Lang->Update;?>">
    <input type="hidden" id="sound_id" name="sound_id" value="<?=$_GET['id'];?>">
    </div>
</form>


