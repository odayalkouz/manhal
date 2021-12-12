<?php
/**
 * Created by PhpStorm.
 * User: khalid alomiri
 * Date: 24/09/2016
 * Time: 09:19 ص
 */
$cuerrentpage="shippinginfo.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["user"])) {
    header('Location: login.php');
}else if($_SESSION["user"]['permession']!="4" && $_SESSION["user"]['permession']!="1"){
    header('Location: login.php');
}
include_once('config.php');
include_once('includes/language.php');

include_once('includes/function.php');
include_once('../includes/function.php');

$bredcrumb = '<li class="floating-left"><a href="shippinginfo.php" class="floating-left active">'.$Lang->EditShipping.'</a></li>';

include "includes/header.php";

$sql = "SELECT * FROM `payments` WHERE  payments.shipping<>'none' AND `paymentid`=".$_GET['id']."  " ;
$result = $con->query($sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}else{
    echo "<script> document.location.href='shippingwarehouse.php';</script>";
}
?>

    <script type="text/javascript" >


        function saveshipping(){

            var data={
                TypeProcesses:'updateshippinginfo',
                id:$("#shipping_id").val(),
                manhal_ref:$("#manhal_ref").val(),
                RecieverCompanyName:$("#RecieverCompanyName").val(),
                userid:$("#userid").val(),
                RecieverAttention:$("#RecieverAttention").val(),
                Address1:$("#Address1").val(),
                Address2:$("#Address2").val(),
                Address3:$("#Address3").val(),
                City:$("#City").val(),
                StateProvince:$("#StateProvince").val(),
                Postcode:$("#Postcode").val(),
                Country:$("#Country").val(),
                Weight:$("#Weight").val(),
                Phone:$("#Phone").val(),
                Refrence:$("#Refrence").val(),
                Productcode:$("#Productcode").val(),
                Contents:$("#Contents").val(),
                DeclaredValue:$("#DeclaredValue").val(),
                ShippingNumber:$("#ShippingNumber").val(),

            };

            $.ajax({
                url: "ajax/process.php",
                type: "POST",
                cache: false,
                dataType: 'html',
                data: data,
                success: function (html) {
                    console.log(html)
                    //window.location=window.location
                }
            });


        }



    </script>

<div >
    <div class="title-pages text-left">
    </div>
    <div class="form-container">
        <form id="editshipping">
            <input type="hidden" name="shipping_id" id="shipping_id" value="<?= $_GET['id']; ?>">
            <div class="display-inline-block floating-left">
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->ShipperId ?></label>
                    <input type="text" readonly class="txt-a floating-left" id="manhal_ref" name="manhal_ref" placeholder="<?= $Lang->ShipperId ?>" value="<?=$row["manhal_ref"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->RecieverCompanyName ?></label>
                    <input type="text"  class="txt-a floating-left" id="RecieverCompanyName" name="RecieverCompanyName" placeholder="<?= $Lang->RecieverCompanyName ?>" value="<?=$row["RecieverCompanyName"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->RecieverId ?></label>
                    <input type="text" readonly class="txt-a floating-left" id="userid" name="userid" placeholder="<?= $Lang->RecieverId ?>" value="<?=$row["userid"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->RecieverAttention ?></label>
                    <input type="text"  class="txt-a floating-left" id="RecieverAttention" name="RecieverAttention" placeholder="<?= $Lang->RecieverAttention ?>" value="<?=$row["RecieverAttention"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Address1 ?></label>
                    <input type="text"  class="txt-a floating-left" id="Address1" name="Address1" placeholder="<?= $Lang->Address1 ?>" value="<?=$row["Address1"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Address2 ?></label>
                    <input type="text"  class="txt-a floating-left" id="Address2" name="Address2" placeholder="<?= $Lang->Address2 ?>" value="<?=$row["Address2"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Address3 ?></label>
                    <input type="text"  class="txt-a floating-left" id="Address3" name="Address3" placeholder="<?= $Lang->Address3 ?>" value="<?=$row["Address3"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->City ?></label>
                    <input type="text"  class="txt-a floating-left" id="City" name="City" placeholder="<?= $Lang->City ?>" value="<?=$row["City"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->StateProvince ?></label>
                    <input type="text"  class="txt-a floating-left" id="StateProvince" name="StateProvince" placeholder="<?= $Lang->StateProvince ?>" value="<?=$row["StateProvince"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->PostCode ?></label>
                    <input type="text"  class="txt-a floating-left" id="Postcode" name="Postcode" placeholder="<?= $Lang->PostCode ?>" value="<?=$row["Postcode"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->country ?></label>
                    <input type="text"  class="txt-a floating-left" id="Country" name="Country" placeholder="<?= $Lang->country ?>" value="<?=$row["Country"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Weight ?></label>
                    <input type="text" readonly  class="txt-a floating-left" id="Weight" name="Weight" placeholder="<?= $Lang->Weight ?>" value="<?=$row["Weight"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->ShippingPrice ?></label>
                    <input type="text" readonly  class="txt-a floating-left" id="shippingprice" name="shippingprice" placeholder="<?= $Lang->ShippingPrice ?>" value="<?=$row["shippingprice"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Phone ?></label>
                    <input type="text"  class="txt-a floating-left" id="Phone" name="Phone" placeholder="<?= $Lang->Phone ?>" value="<?=$row["Phone"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Refrence ?></label>
                    <input type="text"  class="txt-a floating-left" id="Refrence" name="Refrence" placeholder="<?= $Lang->Refrence ?>" value="<?=$row["Refrence"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Productcode ?></label>
                    <input type="text" readonly  class="txt-a floating-left" id="Productcode" name="Productcode" placeholder="<?= $Lang->Productcode ?>" value="<?=$row["Productcode"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Contents ?></label>
                    <input type="text" readonly  class="txt-a floating-left" id="Contents" name="Contents" placeholder="<?= $Lang->Contents ?>" value="<?=$row["Contents"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->DeclaredValue ?></label>
                    <input type="text" readonly  class="txt-a floating-left" id="DeclaredValue" name="DeclaredValue" placeholder="<?= $Lang->DeclaredValue ?>" value="<?=$row["DeclaredValue"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->ShippingNumber ?></label>
                    <input type="text"   class="txt-a floating-left" id="ShippingNumber" name="ShippingNumber" placeholder="<?= $Lang->ShippingNumber ?>" value="<?=$row["shipping_ref"];?>">
                </div>




    </div>

        <input name="commit" onclick="saveshipping()" type="button" value="<?= $Lang->Update;?>" class="btn-default-a floating-right clear-both">
</div>
</div>



<?php
include "includes/footer.php";
?>