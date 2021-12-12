<?php
$currentTab = "Type";
include_once "includes/header.php";
?>
    <link rel="stylesheet" href="<?=$prosses->URL;?>medialibrary/themes/en/css/admin.css">
    <script>
        $("body").addClass("layout-fullwidth")
    </script>
    <div class="panel panel-headline">
        <div class="panel-body">
            <div class="row">
                <h3 class="page-title m-t-10 m-b-20"><?=$prosses->lang('Edit_Type');?></h3>
                <div class="col-md-6 m-b-30">
                    <div class="col-md-3">
                        <label><?=$prosses->lang('name');?></label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="<?=$prosses->lang('name');?>" type="text">
                    </div>
                </div>
                <div class="col-md-6 m-b-30">
                    <div class="col-md-3">
                        <label><?=$prosses->lang('Directory');?></label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="<?=$prosses->lang('Directory');?>" type="text">
                    </div>
                </div>
                <div class="col-md-6 m-b-30">
                    <div class="col-md-3">
                        <label><?=$prosses->lang('Extention');?></label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="<?=$prosses->lang('Extention');?>" type="text">
                    </div>
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