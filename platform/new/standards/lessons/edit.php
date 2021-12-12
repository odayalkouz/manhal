<?php
$currentTab = "Lessons";
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
                                <label><?=$Lang->Alignedstandards;?></label>
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
                                <label><?=$Lang->Grades;?></label>
                                <select name="Grades" id="Grades" class="form-control">
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
                                <label><?=$Lang->Subject;?></label>
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
                                <label><?=$Lang->Units;?></label>
                                <select name="Units" id="Units" class="form-control">
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
                                <label><?=$Lang->Outcomes;?></label>
                                <select name="Outcomes" id="Outcomes_multiple_select" class="form-control" multiple="multiple">
                                    <option  value="1">Outcomes Outcomes Outcomes Outcomes Outcomes</option>
                                    <option  value="2">Outcomes Outcomes Outcomes Outcomes Outcomes</option>
                                    <option  value="3">Outcomes Outcomes Outcomes Outcomes Outcomes</option>
                                    <option  value="4">Outcomes Outcomes Outcomes Outcomes Outcomes</option>
                                    <option  value="5">Outcomes Outcomes Outcomes Outcomes Outcomes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label><?=$Lang->title;?></label>
                                <input name=""  placeholder="<?=$Lang->title;?>" value="" type="text" class="form-control">
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
