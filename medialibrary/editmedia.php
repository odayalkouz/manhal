<?php
include_once "includes/header.php";
?>

<link rel="stylesheet" href="<?=$prosses->URL;?>medialibrary/themes/en/css/admin.css">
<script>
    $("body").addClass("layout-fullwidth")
</script>

    <div class="panel panel-headline">
        <div class="panel-body">
            <div class="row">
                <h3 class="page-title m-t-10 m-b-20"><?=$prosses->lang('Edit_Media');?></h3>
                    <div class="col-md-6 m-b-30">
                        <div class="col-md-3">
                            <label><?=$prosses->lang('Title_ar');?></label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" placeholder="Title (Ar)" type="text" id="title_ar">
                        </div>
                    </div>
                    <div class="col-md-6 m-b-30">
                        <div class="col-md-3">
                            <label><?=$prosses->lang('Title_en');?></label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" placeholder="Title (En)" type="text" id="title_en">
                        </div>
                    </div>
                    <div class="col-md-6 m-b-30">
                        <div class="col-md-3">
                            <label><?=$prosses->lang('Type');?></label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" id="types">
                                <option value="audios">Audios</option>
                                <option value="Images">Images</option>
                                <option value="Videos">Videos</option>
                                <option value="photos">Photos</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 m-b-30">
                        <div class="col-md-3">
                            <label><?=$prosses->lang('Category');?></label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" id="category">
                                <option value="audios">1</option>
                                <option value="Images">2</option>
                                <option value="Videos">3</option>
                                <option value="photos">4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 m-b-30">
                        <div class="col-md-3">
                            <label><?=$prosses->lang('Upload_media');?></label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" placeholder="Upload thumb" type="file" id="media_upload">
                        </div>
                    </div>
                    <div class="col-md-6 m-b-30">
                        <div class="col-md-3">
                            <label><?=$prosses->lang('Tags');?></label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" placeholder="Tags" type="text" id="tags-input">
                        </div>
                    </div>
                    <div class="col-md-6 m-b-30 gallery-container" style="min-height: 60px" ></div>
                    <div class="col-md-6 m-b-30">
                        <div class="col-md-3"></div>
                        <div class="col-md-9 tags-container-admin"></div>
                    </div>
                    <div class="col-md-12">
                        <a class="btn-sm btn-primary pull-right"><?=$prosses->lang('save');?></a>
                    </div>
            </div>
        </div>
    </div>
<?php
include_once "includes/footer.php";
?>