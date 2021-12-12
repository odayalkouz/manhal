<?php
include_once '../includes/functions.php';
?>
<div class="">
    <div class="position-relative form-group">
        <label for="exampleEmail" class=""><?=$prosses->getlang('URL');?></label>
        <input name="email" id="exampleEmail" placeholder="<?=$prosses->getlang('URL');?>" type="url" class="form-control">
    </div>
    <div class="position-relative form-group">
        <label for="exampleFile" class=""><?=$prosses->getlang('UploadImage');?></label>
        <input name="file" id="exampleFile" type="file" class="form-control-file">
    </div>
    <button type="button" class="mt-1 btn btn-primary float-right" id="action_url" onclick="saveImageSlider();"><?=$prosses->getlang('Save');?></button>
</div>
