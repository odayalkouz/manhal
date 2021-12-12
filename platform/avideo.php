<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/6/2016
 * Time: 1:22 PM
 */

include_once "includes/language.php";

?>


<form id="avideo_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->Title;?></label>
        <input class="floating-left txt-a" id="avideotitle" type="text" name="avideotitle">
    </div>
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->uploadvideo;?></label>
        <input class="txt-a floating-left" type="text" name="ayoutube" id="ayoutube" placeholder="<?=$Lang->YoutubeURL;?>">
    </div>
    <div class="line-row-b">
        <input type="hidden" id="avideo_id" name="avideo_id" value="<?=$_GET['id'];?>">

        <input class="btn-default floating-right" type="button" id="update_avideo" value="<?=$Lang->Update;?>">
    </div>

</form>


