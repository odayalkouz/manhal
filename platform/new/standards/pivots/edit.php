<?php
$currentTab = "Pivots";
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
                                <label class=""><?=$Lang->Domains;?></label>
                                <select name="Domain" id="Domain" class="form-control">
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
                                <label class=""><?=$Lang->titleAr;?></label>
                                <input name=""  placeholder="<?=$Lang->titleAr;?>" value="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label class=""><?=$Lang->titlEn;?></label>
                                <input name=""  placeholder="<?=$Lang->titlEn;?>" value="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="code" class=""><?=$Lang->Code;?></label>
                                <input id="code" name=""  placeholder="Code" value="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group position-relative form-check form-check-inline mt-lg-4">
                                <label class="form-check-label"><input type="checkbox" class="form-check-input"><?=$Lang->Status;?></label>
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
