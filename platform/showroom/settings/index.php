<?php
$currentTab = "settings";
include_once '../includes/breadcrumb.php';
$bredcrumb="<li class='breadcrumb-item'><a href='../index.php'>".$Breadcrumbs->getlang('Dashboard')."</a></li><li class='breadcrumb-item active' aria-current='page'>".$Breadcrumbs->getlang('settings')."</li>";
include_once "../includes/header.php";
?>
<form  id="manhlform1" class="app-main__inner">
    <div class="col-lg-12 text-center">
        <div class="main-card mb-3 card">
            <div class="card-body ">
                <div class="row">
                    <div class="col-lg-10 float-right">
                        <h5 class="card-title text-left"><?=$prosses->getlang('settings');?></h5>
                    </div>
                    <div class="col-lg-2 float-right">
                        <a class="btn-add-image" title="<?=$prosses->getlang('addimage');?>" data-toggle="modal" data-target="#exampleModal"><i class="metismenu-icon pe-7s-plus"></i></a>
                        <a class="btn-view-slider" title="<?=$prosses->getlang('addimage');?>" data-toggle="modal" data-target="#exampleModal"><i class="metismenu-icon pe-7s-look"></i></a>
                    </div>
                </div>
                <div class="row" id="sortable">
                    <?php echo $prosses->GetAllSliders()
                    ;?>
                </div>
                <div class="row">
                    <a class="btn btn-primary float-right text-white saveestting" onclick="SaveSortImageSlider();" style="display: none"><?=$prosses->getlang('Save');?></a>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
include_once "../includes/footer.php";
?>




