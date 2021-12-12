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
            <h3 class="page-title m-t-10 m-b-20"><?=$prosses->lang('Sort_Category');?></h3>
            <div class="col-md-12">
                <div class="dd nestable-with-handle">
                    <ol id="sortable" class="dd-list">
                        <li class="dd-item dd3-item">
                            <div class="dd-handle dd3-handle"><i>&#x2195;</i></div>
                            <div class="dd3-content">1</div>
                        </li>
                        <li class="dd-item dd3-item">
                            <div class="dd-handle dd3-handle"><i>&#x2195;</i></div>
                            <div class="dd3-content">2</div>
                        </li>
                        <li class="dd-item dd3-item">
                            <div class="dd-handle dd3-handle"><i>&#x2195;</i></div>
                            <div class="dd3-content">3</div>
                        </li>
                        <li class="dd-item dd3-item">
                            <div class="dd-handle dd3-handle"><i>&#x2195;</i></div>
                            <div class="dd3-content">4</div>
                        </li>
                        <li class="dd-item dd3-item">
                            <div class="dd-handle dd3-handle"><i>&#x2195;</i></div>
                            <div class="dd3-content">5</div>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="col-md-12 m-t-20">
                <a class="btn-sm btn-primary pull-right"><?=$prosses->lang('save');?></a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
    });
</script>
<?php
include_once "includes/footer.php";
?>
