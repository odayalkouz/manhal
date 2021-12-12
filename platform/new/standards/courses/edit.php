<?php
$currentTab = "Courses";
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
                                <label class=""><?=$Lang->Grade;?></label>
                                <select name="Grade" id="Grade" class="form-control">
                                    <option  value="1">1</option>
                                    <option  value="2">2</option>
                                    <option  value="3">3</option>
                                    <option  value="4">4</option>
                                    <option  value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label class=""><?=$Lang->Subject;?></label>
                                <select name="Subject" id="Subject" class="form-control">
                                    <option  value="1">1</option>
                                    <option  value="2">2</option>
                                    <option  value="3">3</option>
                                    <option  value="4">4</option>
                                    <option  value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label class=""><?=$Lang->Alignedstandards;?></label>
                                <select name="Aligned_standards" id="Aligned_standards" class="form-control">
                                    <option  value="1">1</option>
                                    <option  value="2">2</option>
                                    <option  value="3">3</option>
                                    <option  value="4">4</option>
                                    <option  value="5">5</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label class=""><?=$Lang->Units;?></label>
                                <input name=""  placeholder="<?=$Lang->Units;?>" value="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label class=""><?=$Lang->DescriptionAr;?></label>
                                <textarea class="form-control" placeholder="<?=$Lang->DescriptionAr;?>"></textarea>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label class=""><?=$Lang->DescriptionEn;?></label>
                                <textarea class="form-control" placeholder="<?=$Lang->DescriptionEn;?>"></textarea>
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
