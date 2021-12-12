<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/6/2016
 * Time: 1:22 PM
 */

include_once "includes/language.php";

?>


<form id="textlink_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->Title;?></label>
        <input class="floating-left txt-a" id="aurltitle" type="text" name="aurltitle">
    </div>
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->UpdateURL;?></label>
        <input class="txt-a floating-left" type="text" name="aurlvalue" id="aurlvalue" placeholder="<?=$Lang->URL;?>">
    </div>
    <div class="line-row-b">
        <input class="btn-default floating-right" type="button" id="update_textlink" value="<?=$Lang->Update;?>">
        <input type="hidden" id="aurl_id" name="aurl_id" value="<?=$_GET['id'];?>">
    </div>
</form>
