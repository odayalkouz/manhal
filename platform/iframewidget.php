<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/6/2016
 * Time: 1:22 PM
 */

include_once "includes/language.php";

?>


<form id="video_form">
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->EnterURL;?></label>
        <input class="txt-a floating-left" type="text" name="iframev" id="iframev" placeholder="<?=$Lang->EnterURL;?>">
    </div>
    <div class="line-row-b">
        <input class="btn-default floating-right" type="button" id="update_iframev" value="<?=$Lang->Update;?>">
        <input type="hidden" id="iframe_id" value="<?=$_GET['id'];?>">
    </div>
</form>
