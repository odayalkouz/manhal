<?php
$currentTab="Edit Contract";

if(isset($_GET['id'])&& $_GET['id']=='new'){
    include_once "function.php";
    $result=$prosses->CreateOqoud($prosses->GetID());

    header('Location:'.$prosses->URL.'/Oqoud/editindex.php?id='.$result['number']);

    exit();
}
include_once "includes/header.php";
$result=$prosses->CreateOqoud($prosses->GetID());
$Readonly='';
if (!$prosses->CanEdit()) {
    $Readonly = 'readonly disabled ';
}
$num='';$act='';$name='';$email='';$country='';$city='';$address='';$IBAN='';$type=0;$t_contract='';$d_contract='';$s_date='';$e_date='';$v_contract='';$currency='';
$status=0;$monthly_amount=0;$p_date=0;$alarm=0;$email_to=0;$email_cc=0;$email_t=0;$phone=0;$IBAN=0;$action=0;
if (is_array($result) || is_object($result)) {
    if ($result['result'] == '1') {
        $resultData= $result['data'];
        foreach($result['data'] as $key => $value )
        {

            $id= $value['id'];
            $num=$value['num'];
            $act=$value['activity'];
            $name=$value['name'];
            $email=$value['email'];
            $country=$value['country'];
            $city=$value['city'];
            $address=$value['address'];
            $IBAN=$value['IBAN'];
            $type=$value['type'];
            $t_contract=$value['t_contract'];
            $d_contract=$value['d_contract'];
            $s_date=$value['s_date'];
            $e_date=$value['e_date'];
            $v_contract=$value['v_contract'];
            $currency=$value['currency'];
            $status=$value['status'];
            $monthly_amount=$value['monthly_amount'];
            $p_date=$value['p_date'];
            $alarm=$value['alarm'];
            $email_to=$value['email_to'];
            $email_cc=$value['email_cc'];
            $email_t=$value['email_t'];
            $phone=$value['phone'];
            $IBAN=$value['IBAN'];
            $action=$value['action'];


        }



    }
}
?>
<div class="app-main__inner">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body"><h5 class="card-title"><?=$prosses->lang('user_information');?></h5>
                <div action="api.php" method="post">
                    <input type="hidden" id="process" name="process" value="edit">
                    <input type="hidden" id="id" name="id" value="<?=$_GET['id']?>">

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">

                                <label for="name" class=""><?=$prosses->lang('name');?></label>
                                <input <?=$Readonly;?> name="name" id="name" placeholder="<?=$prosses->lang('name');?>" value="<?=$name?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">

                                <label for="email" class=""><?=$prosses->lang('email');?></label>
                                <input <?=$Readonly;?> name="email" id="email" placeholder="<?=$prosses->lang('email');?>" value="<?=$email?>" type="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">


                                <label for="country" class=""><?=$prosses->lang('country');?></label>
                                <input <?=$Readonly;?> name="country" id="country" placeholder="<?=$prosses->lang('country');?>" value="<?=$country?>" type="text" class="form-control">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="city" class=""><?=$prosses->lang('city');?></label>
                                <input <?=$Readonly;?> name="city" id="city" placeholder="<?=$prosses->lang('city');?>" value="<?=$city?>" type="text" class="form-control">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="address" class=""><?=$prosses->lang('address');?></label>
                                <textarea <?=$Readonly;?> id="address" name="address" class="form-control"  style="resize: none"><?=$address?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="phone" class=""><?=$prosses->lang('phone');?></label>
                                <input <?=$Readonly;?> name="phone" id="phone" placeholder="<?=$prosses->lang('phone');?>" value="<?=$phone?>" type="tel" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                        <h5 class="card-title"><?=$prosses->lang('contractInformation');?></h5>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="act" class=""><?=$prosses->lang('contract_number');?></label>
                                <input <?=$Readonly;?> name="num" id="num" placeholder="<?=$prosses->lang('contract_number');?>" value="<?=$num?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="act" class=""><?=$prosses->lang('customer_activity');?></label>
                                <input <?=$Readonly;?> name="act" id="act" placeholder="<?=$prosses->lang('customer_activity');?>" value="<?=$act?>" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="IBAN" class=""><?=$prosses->lang('IBAN');?></label>
                                <input <?=$Readonly;?> name="IBAN" id="IBAN" placeholder="<?=$prosses->lang('IBAN');?>" value="<?=$IBAN?>"  type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="type" class=""><?=$prosses->lang('contract_type');?></label>
                                <select <?=$Readonly;?> name="type" id="type" class="form-control">
                                    <?php
                                    $Category= json_decode($prosses->GetCategory(),true);
                                    if (is_array($Category) || is_object($Category))
                                    {
                                        foreach($Category['data'] as $key => $value )
                                        {
                                            $selected='';
                                            if($value['id']==$type){
                                                $selected='selected';
                                            }
                                            echo '<option '.$selected.'  value="'.$value['id'].'">'.$value['name_'.$prosses->Sessionlang()].'</option>';
                                        }
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <div class="custom-checkbox custom-control custom-control-inline">
                                    <?php
                                    $checked='';
                                    if($t_contract==1){
                                        $checked='checked';
                                    }
                                    ?>
                                    <input <?=$Readonly;?> type="checkbox" id="t_contract"  name="t_contract" class="custom-control-input" value="<?=$t_contract?>" <?=$checked?> >
                                    <label class="custom-control-label" for="t_contract"><?=$prosses->lang('notificationofterminationofcontract');?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="d_contract" class=""><?=$prosses->lang('contract_duration');?></label>
                                <input <?=$Readonly;?> name="d_contract" id="d_contract" placeholder="<?=$prosses->lang('contract_duration');?>" value="<?=$d_contract?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="s_date" class=""><?=$prosses->lang('start_date');?></label>
                                <input <?=$Readonly;?> type="text" name="s_date" id="s_date" class="datepicker form-control jq_formdata" placeholder="<?=$prosses->lang('start_date');?>"  data-dtp="dtp_ZYZzi" onclick="loadPicker()"  onfocus="loadPicker()" onmouseover="loadPicker()" value="<?=$s_date?>"  autocomplete="no"  />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="e_date" class=""><?=$prosses->lang('end_date');?></label>
                                <input <?=$Readonly;?> type="text" name="e_date" id="e_date" class="datepicker form-control jq_formdata" placeholder="<?=$prosses->lang('end_date');?>"  data-dtp="dtp_ZYZzi" onclick="loadPicker()"  onfocus="loadPicker()" onmouseover="loadPicker()" value="<?=$e_date?>"  autocomplete="no"  />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="v_contract" class=""><?=$prosses->lang('contract_value');?></label>
                                <input <?=$Readonly;?> name="v_contract" id="v_contract" placeholder="<?=$prosses->lang('contract_value');?>" value="<?=$v_contract?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="currency" class=""><?=$prosses->lang('currency');?></label>
                                <input <?=$Readonly;?> name="currency" id="currency" placeholder="<?=$prosses->lang('currency');?>" value="<?=$currency?>" type="text" class="form-control">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="status" class=""><?=$prosses->lang('status');?></label>

                                <select <?=$Readonly;?> name="status" id="status" class="form-control">
                                    <option <?php if($status==1){echo 'selected';}?> value="1"><?=$prosses->lang('active');?></option>
                                    <option <?php if($status==0){echo 'selected';}?> value="0"><?=$prosses->lang('inactive');?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="monthlyamount" class=""><?=$prosses->lang('The_monthly_amount');?></label>
                                <input <?=$Readonly;?> name="monthlyamount" id="monthlyamount" placeholder="<?=$prosses->lang('The_monthly_amount');?>" value="<?=$monthly_amount?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="p_date" class=""><?=$prosses->lang('payment_due_date');?></label>
                                <input <?=$Readonly;?> type="text" name="p_date" id="p_date" class="datepicker form-control jq_formdata" placeholder="<?=$prosses->lang('payment_due_date');?>"  data-dtp="dtp_ZYZzi" onclick="loadPicker()"  onfocus="loadPicker()" onmouseover="loadPicker()" value="<?=$p_date?>"  autocomplete="no"  />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="alarm" class=""><?=$prosses->lang('alarm');?></label>
                                <input <?=$Readonly;?> name="alarm" id="alarm" placeholder="<?=$prosses->lang('alarm');?>" value="<?=$alarm?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="email_to" class=""><?=$prosses->lang('send_email_to');?></label>
                                <input <?=$Readonly;?> name="email_to" id="email_to" placeholder="<?=$prosses->lang('send_email_to');?>" value="<?=$email_to?>" type="Email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="email_cc" class=""><?=$prosses->lang('CC');?></label>
                                <input <?=$Readonly;?> name="email_cc" id="email_cc" placeholder="<?=$prosses->lang('CC');?>" value="<?=$email_cc?>" type="Email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="email_t" class=""><?=$prosses->lang('email_text');?></label>
                                <textarea <?=$Readonly;?> id="email_t" name="email_t" class="form-control" style="resize: none"> <?=$email_t?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="action" class=""><?=$prosses->lang('actions');?></label>
                                <select <?=$Readonly;?> name="action" id="action" class="form-control">
                                    <?php
                                    $Action= json_decode($prosses->GetAction(),true);
                                    if (is_array($Action) || is_object($Action))
                                    {
                                        foreach($Action['data'] as $key => $value )
                                        {
                                            $selected='';
                                            if($value['id']==$action){
                                                $selected='selected';
                                            }
                                            echo '<option '.$selected.'  value="'.$value['id'].'">'.$value['name_'.$prosses->Sessionlang()].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form action="" method="post" id="formoqoud" name="formoqoud" target="hidden_iframe" enctype="multipart/form-data">
                                <input <?=$Readonly;?> name="process" type="hidden" value="uploadoqoud">
                                <input <?=$Readonly;?> name="oqoud" type="hidden" value="oqoud">
                                <input <?=$Readonly;?> name="IdFolder" type="hidden" value="<?=$_GET['id']?>">
                            <div class="position-relative form-group">
                                <?php
                                if ($prosses->CanEdit()) {
                                ?>
                                    <label for="contract" class=""><?=$prosses->lang('upload_contract_files');?></label>
                                    <input <?=$Readonly;?> onchange="javascript:uploadfiles('allfile_contract','contract',<?=$_GET['id']?>,'oqoud');" name="contract[]"    multiple id="contract" type="file" class="form-control-file upload-input">
                                    <?php
                                }
                                ?>
                                <div class="row image-upload-wrap" id="allfile_contract" style="display: ">
                                    <?php  echo $prosses->getImages("files/" . $_GET['id'] . '/oqoud/') ?>
                                </div>
                            </div>
                            </form>
                        </div>
                        <form action="api.php?process=uploadoqoud" method="post" target="hidden_iframe" id="formneeded" enctype="multipart/form-data">
                            <input  <?=$Readonly;?> name="oqoud" type="hidden" value="needed">
                            <input <?=$Readonly;?> name="process" type="hidden" value="uploadoqoud">
                            <input <?=$Readonly;?> name="IdFolder" type="hidden" value="<?=$_GET['id']?>">
                        <div class="col-md-6">
                            <div class="position-relative form-group" >
                                 <?php
                                if ($prosses->CanEdit()) {
                                    ?>
                                <label for="needed" class=""><?=$prosses->lang('upload_help_files');?></label>


                                <input <?=$Readonly;?> multiple id="needed" onchange="javascript:uploadfiles('allfile_needed','needed',<?=$_GET['id']?>,'needed');"  name="needed[]" type="file" class="form-control-file upload-input">
                                    <?php
                                }
                                ?>
                                <div class="row image-upload-wrap" id="allfile_needed" style="display: ">
                                    <?php echo $prosses->getImages("files/" . $_GET['id'] . '/needed/') ?>
                                </div>
                            </div>
                        </div>
                        </form>
                        <?php
                        if ($prosses->CanEdit()) {
                        ?>
                        <iframe id="hidden_iframe" name="hidden_iframe" style="width: 0px;height: 0px;"></iframe>
                        <div class="col-md-12">

                                <button id="save"
                                        class="mt-2 btn btn-primary float-right"><?= $prosses->lang('save'); ?></button>

                        </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "includes/footer.php";
?>
