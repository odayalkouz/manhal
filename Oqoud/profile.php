<?php
$currentTab="profile";
include_once "includes/header.php";
?>
<div class="app-main__inner">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body"><h5 class="card-title"><?=$prosses->lang('edit_profile');?></h5>
                <div class="">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="Username" class=""><?=$prosses->lang('username');?></label>
                                <input readonly disabled name="Username" id="Username" placeholder="<?=$prosses->lang('username');?>" value="<?php echo($prosses->informationUser()['data'][0]['uname'])?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="firstname" class=""><?=$prosses->lang('first_name');?></label>
                                <input name="firstname" id="firstname" placeholder="<?=$prosses->lang('first_name');?>" value="<?php echo($prosses->informationUser()['data'][0]['fullname'])?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="Password" class=""><?=$prosses->lang('password');?></label>
                                <input name="password" id="Password" placeholder="<?=$prosses->lang('password');?>" value="<?php echo($prosses->informationUser()['data'][0]['pass'])?>" type="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="email" class=""><?=$prosses->lang('email');?></label>
                                <input name="email" id="email" placeholder="<?=$prosses->lang('email');?>" value="<?php echo($prosses->informationUser()['data'][0]['email'])?>" type="email" class="form-control">
                            </div>
                        </div>




                        <div class="col-md-12">
                            <button id="information_save" class="mt-2 btn btn-primary float-right"><?=$prosses->lang('save');?></button>
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
