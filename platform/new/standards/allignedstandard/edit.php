<?php
$currentTab = "allignedstandard";
include_once "../../includes/header.php";
checkPermission();

$location='';
//get story info from database
if (isset($_GET["id"]) && $_GET["id"] != "") {
    if ($_GET["id"] == "new") {//create new
        $sql = "INSERT INTO `aligned_standards`(`as_cdate`, `status`, `deleted`) VALUES (NOW(),1,0)";
        $con->query($sql);
        $id = mysqli_insert_id($con);
        $location="edit.php?id=".$id;

    }else{//get story info from database
        $sql = "SELECT * FROM `aligned_standards` WHERE `as_id`=" . $_GET["id"];
        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $row= mysqli_fetch_assoc($result);
        }else{//Invalide URL
            $location="index.php";
        }
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
        $(".jq_save_as").click(function () {
            showLoader();
            as_id=$(this).attr('data-id');
            var data={
                as_id: as_id,
                as_title_ar:$("#as_title_ar").val(),
                as_title_en:$("#as_title_en").val()
            };
            $.ajax({
                url: "../ajax.php?process=savealignedstandarad",
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
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label><?=$Lang->titleAr;?></label>
                                <input name="as_title_ar" id="as_title_ar" placeholder="<?=$Lang->titleAr;?>" value="<?=$row['as_title_ar'];?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label><?=$Lang->titlEn;?></label>
                                <input name="as_title_en" id="as_title_en" placeholder="<?=$Lang->titlEn;?>" value="<?=$row['as_title_en'];?>" type="text" class="form-control">
                            </div>
                        <div class="col-md-12">
                            <button class="mt-2 btn btn-primary float-right jq_save_as" data-id="<?=$_GET['id'];?>"><?=$Lang->Save;?></button>
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
