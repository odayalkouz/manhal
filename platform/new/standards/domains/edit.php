<?php
$currentTab = "domains";
include_once "../../includes/header.php";
checkPermission();

$location='';
//get story info from database
if (isset($_GET["id"]) && $_GET["id"] != "") {
    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    if ($_GET["id"] == "new") {//create new
        $sql = "INSERT INTO `domains`(`dn_code`, `dn_astandard`,`dn_category`, `dn_cdate`, `status`, `deleted`) VALUES ('1',0,0,NOW(),1,0)";
        $mysqli->query($sql);
        $id = mysqli_insert_id($mysqli);
        $location="edit.php?id=".$id;
    }else{//get story info from database
        $sql="SELECT `aligned_standards`.*,`domains`.*,`categories`.`name_ar` as subject FROM `domains` LEFT JOIN `aligned_standards` ON `domains`.`dn_astandard`=`aligned_standards`.`as_id` LEFT JOIN `categories` ON `domains`.`dn_category`=`categories`.`catid` WHERE `domains`.`dn_id`=".$_GET["id"];
        $result = $mysqli->query($sql);
        $row=mysqli_fetch_assoc($result);
    }
}else{// invalid URL
    $location="index.php";
}
if($location!=""){
    ?>
    <script type="text/javascript">
        window.location.href='<?=$location;?>';
    </script>
    <?php
    exit();
}
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.jq_change_domain_code').change(function () {
            $("#jq_domain_code").html($("#astandard").val()+'.'+$("#subject").val()+'.');
        });

        $(".jq_save_domain").click(function () {
            showLoader();
            as_id=$(this).attr('data-id');
            var data=$("#domain_form").serialize();
            $.ajax({
                url: "../ajax.php?process=savedomain",
                type: "POST",
                data:data,
                cache: false,
                dataType: 'json',
                success: function (jsonData) {
                    hideLoader();
                    if(jsonData.result){
                        window.location.href='index.php';
                    }else{
                        console.log("result",jsonData);
                        Lobibox.notify('error', {
                            showClass: 'zoomInUp',
                            hideClass: 'zoomOutDown',
                            icon: false,
                            msg: jsonData.msg
                        });

                    }
                }
            });
        });
    });
</script>
<div class="app-main__inner">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"><?=$Lang->Edit;?></h5>
                <div>
                    <form id="domain_form">
                        <input type="hidden" name="dn_id" id="dn_id" value="<?=$row["dn_id"];?>">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label><?=$Lang->Alignedstandards;?></label>
                                <?php
                                getAlignedStandard("jq_change_domain_code",$row["dn_astandard"]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label><?=$Lang->Subject;?></label>
                                <?php
                                getCategories("jq_change_domain_code",$row["dn_category"]);
                                ?>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label><?=$Lang->titleAr;?></label>
                                <input name="dn_title_ar" id="dn_title_ar"  placeholder="<?=$Lang->titleAr;?>" value="<?=$row["dn_title_ar"];?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label><?=$Lang->titlEn;?></label>
                                <input name="dn_title_en" id="dn_title_en"  placeholder="<?=$Lang->titlEn;?>" value="<?=$row["dn_title_en"];?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="code"><?=$Lang->Code;?></label>
                                <span id="jq_domain_code"><?=$row["dn_astandard"];?>.<?=$row["dn_category"];?>.</span><input id="code" name="code" placeholder="Code" value="<?=$row["dn_code"];?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group position-relative form-check form-check-inline mt-lg-4">
                                <label class="form-check-label"><input name="status" id="status" value="1" type="checkbox" <?php if($row["status"]==1){echo 'checked';} ?> class="form-check-input"><?=$Lang->Status;?></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="mt-2 btn btn-primary float-right jq_save_domain"><?=$Lang->Save;?></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "../../includes/footer.php";
?>
