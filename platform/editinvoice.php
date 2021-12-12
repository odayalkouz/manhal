<?php
/**
 * User: khalid alomiri
 * Date: 28/12/2017
 * Time: 1:17 PM
 */
$cuerrentpage="invoice.php";

if(session_status()==PHP_SESSION_NONE){ session_start();}
if (!isset($_SESSION["user"])) {
    header('Location: login.php');
}elseif($_SESSION["user"]['permession']!="1" &&$_SESSION["user"]['permession']!="5"  ) {
    header('Location: logout.php');
}
include_once('config.php') ;
include_once('includes/language.php') ;


if (isset($_GET['id']) && $_GET['id'] == "new") {
   // $random=$con->insert_id;;
    $sql = "INSERT INTO `invoices`(`id`) VALUES (null)";
    $con->query($sql);
    $id = mysqli_insert_id($con);
    header("location:editinvoice.php?id=" . $id);
    exit();
}

$sql = "SELECT * FROM invoices WHERE id=" . $_GET['id'];
$result = $con->query($sql);
if (mysqli_num_rows($result) > 0) {
    $data = '';
    $row = mysqli_fetch_assoc($result);
}
?>
<?php

$bredcrumb = '<li class="floating-left"><a href="invoice.php" class="floating-left">'.$Lang->invoices.'</a></li><span class="floating-left">/</span><li class="floating-left"><a href="editinvoice.php" class="floating-left active">'.$Lang->editinvoice.'</a></li>';

include "includes/header.php";

?>
<script type="text/javascript">
    function saveinvoice() {
        var data = {
            invoice_id: <?=$_GET['id']?>,
            invoice_name: $("#invoice_name").val(),
            invoice_AddressA: $("#invoice_AddressA").val(),
            invoice_city: $("#invoice_city").val(),
            invoice_price: $("#invoice_price").val(),
            invoice_Shippingmethod: $("#invoice_Shippingmethod").val(),
            Invoicenumber: $("#Invoicenumber").val(),
            invoice_Description: $("#invoice_Description").val(),
            invoice_EMail: $("#invoice_EMail").val(),
            invoice_country: $("#invoice_country").val(),
            invoice_productname: $("#invoice_productname").val(),
            invoice_shippingprice: $("#invoice_shippingprice").val(),
            invoice_totalprice: $("#invoice_totalprice").val(),
            TypeProcesses: 'updateinvoice'
        };
        setdatafunction('updateinvoice',data);
    }


    function sendinvoice(){

        $.ajax({
            url: "ajax/function.php",
            type: "POST",
            data:{id:<?=$_GET['id']?>,TypeProcesses: 'sendmailinvoice'},
            cache: false,
            dataType: 'html',
            success: function (html) {
console.log(html)

            }

        });
    }


</script>
<div class="edit-book">
    <div class="form-container">
        <form id="editinvoice">
            <input type="hidden" name="invoice_id" id="invoice_id">
        <div class="line-row">
            <label class="lbl-data-a floating-left"><?= $Lang->FullName?></label>
            <input type="text" class="txt-a floating-left" id="invoice_name" name="invoice_name" placeholder="<?=$Lang->FullName;?>" value="<?=$row['name'];?>">
            <label class="lbl-data-a floating-left"><?= $Lang->EMail?></label>
            <input type="text" class="txt-a floating-left" id="invoice_EMail" name="invoice_EMail" placeholder="<?=$Lang->EMail?>" value="<?=$row['email']?>">
        </div>
        <div class="line-row">
            <label class="lbl-data-a floating-left"><?=$Lang->AddressA?></label>
            <input type="text" class="txt-a floating-left" id="invoice_AddressA" name="invoice_age" placeholder="<?=$Lang->AddressA ?>" value="<?=$row['address']?>">
            <label class="lbl-data-a floating-left"><?=$Lang->country?></label>
            <input type="text" class="txt-a floating-left" id="invoice_country" name="invoice_country" placeholder="<?=$Lang->country ?>" value="<?=$row['country']?>">
        </div>
        <div class="line-row">
            <label class="lbl-data-a floating-left"><?=$Lang->City?></label>
            <input type="text" class="txt-a floating-left" id="invoice_city" name="invoice_city" placeholder="<?=$Lang->City ?>" value="<?=$row['city']?>">
            <label class="lbl-data-a floating-left"><?=$Lang->productname?></label>
            <input type="text" class="txt-a floating-left" id="invoice_productname" name="invoice_productname" placeholder="<?=$Lang->productname ?>" value="<?=$row['productname']?>">
        </div>
        <div class="line-row">
            <label class="lbl-data-a floating-left"><?=$Lang->Price?></label>
            <input type="text" class="txt-a floating-left" id="invoice_price" name="invoice_price" placeholder="<?=$Lang->Price ?>" value="<?=$row['price']?>">
            <label class="lbl-data-a floating-left"><?=$Lang->ShippingPrice?></label>
            <input type="text" class="txt-a floating-left" id="invoice_shippingprice" name="invoice_shippingprice" placeholder="<?=$Lang->ShippingPrice ?>" value="<?=$row['shippingprice']?>">
        </div>
        <div class="line-row">
            <label class="lbl-data-a floating-left"><?=$Lang->Shippingmethod?></label>
            <input type="text" class="txt-a floating-left" id="invoice_Shippingmethod" name="invoice_Shippingmethod" placeholder="<?=$Lang->Shippingmethod ?>" value="<?=$row['shippingmethod']?>">
            <label class="lbl-data-a floating-left"><?=$Lang->TotalPrice?></label>
            <input type="text" class="txt-a floating-left" id="invoice_totalprice" name="invoice_totalprice" placeholder="<?=$Lang->TotalPrice ?>" value="<?=$row['totalprice']?>">
        </div>
            <div class="line-row">
            <label class="lbl-data-a floating-left"><?=$Lang->Invoicenumber?></label>
            <input type="text" class="txt-a floating-left" id="Invoicenumber" name="Invoicenumber" placeholder="<?=$Lang->Invoicestatus ?>" value="<?=$row['number']?>">
                <label class="lbl-data-a floating-left"><?=$Lang->Invoicestatus?></label>
            <input  type="text" readonly class="txt-a floating-left" id="invoice_status" name="invoice_status" placeholder="<?=$Lang->Invoicestatus ?>" value="<?=$row['status']?>">

        </div>
        <div class="line-row">
            <label class="lbl-data-a floating-left"><?=$Lang->Description?></label>
            <textarea type="text" class="txt-b floating-left" id="invoice_Description" name="invoice_Description" placeholder="<?=$Lang->Description ?>"><?=$row['description']?></textarea>
            <input name="commit" onclick="saveinvoice()" type="button" value="<?=$Lang->Save?>" class="btn-default-c floating-left">
            <input  onclick="sendinvoice()" id="send_invoice" type="button" value="<?= $Lang->Send ?>" class="btn-default-d floating-left">
        </div>
    </div>
    </form>
    </div>
</div>
<?php
include "includes/footer.php";
?>
