<?php
$currentTab="Edit Categories";


if(isset($_GET['id'])&& $_GET['id']=='new'){
    include_once "function.php";
    $result=$prosses->CreateCategory($prosses->GetID());
    header('Location:'.$prosses->URL.'/Oqoud/editcategory.php?id='.$result['number']);
    exit();
}



include_once "includes/header.php";
$result=$prosses->CreateCategory($prosses->GetID());
if (is_array($result) || is_object($result)) {
    if ($result['result'] == '0') {
        exit();
    }elseif ($result['result'] == '1'){

        foreach ($result['data'] as $key => $value) {
            $id = $value['id'];
            $name_ar = $value['name_ar'];
            $name_en = $value['name_en'];
        }
    }
}



?>
<div att="<?=$id?>" class="app-main__inner">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"><?=$prosses->lang('edit_category');?></h5>
                <div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="cat_ar" class=""><?=$prosses->lang('Category_Ar');?></label>
                                <input name="cat_ar" id="cat_ar" placeholder="<?=$prosses->lang('Category_Ar');?>" value="<?=$name_ar?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="cat_en" class=""><?=$prosses->lang('Category_En');?></label>
                                <input name="cat_en" id="cat_en" placeholder="<?=$prosses->lang('Category_En');?>" value="<?=$name_en?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="saveCat" att="<?=$id?>" class="mt-2 btn btn-primary float-right"><?=$prosses->lang('save');?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "includes/footer.php";
?>
