<?php
$currentTab = "Grades";
include_once "../../includes/header.php";
?>
<div class="app-main__inner">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"><?=$Lang->Edit;?></h5>
                <div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label class=""><?=$Lang->titleAr;?></label>
                                <input name=""  placeholder="Title (En)" value="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label class=""><?=$Lang->titlEn;?></label>
                                <input name=""  placeholder="Title (En)" value="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="mt-2 btn btn-primary float-right"><?=$Lang->Save;?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "../../includes/footer.php";
?>
