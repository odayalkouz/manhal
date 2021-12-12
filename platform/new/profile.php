<?php
$currentTab="profile";
include_once "includes/header.php";
?>
<div class="app-main__inner">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body"><h5 class="card-title"><?=$Lang->Editaccount;?></h5>
                <div class="">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="Username" class=""><?=$Lang->LoginName;?></label>
                                <input name="Username" id="Username" placeholder="<?=$Lang->LoginName;?>" value="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="firstname" class=""><?=$Lang->FirstName;?></label>
                                <input name="firstname" id="firstname" placeholder="<?=$Lang->FirstName;?>" value="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="Password" class=""><?=$Lang->Password;?></label>
                                <input name="password" id="Password" placeholder="<?=$Lang->Password;?>" value="" type="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="email" class=""><?=$Lang->EMail;?></label>
                                <input name="email" id="email" placeholder="<?=$Lang->EMail;?>" value="" type="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="information_save" class="mt-2 btn btn-primary float-right"><?=$Lang->Save;?></button>
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
