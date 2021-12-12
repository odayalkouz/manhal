<?php
$currentTab="invoice";
include "includes/function.php";

$sql = "SELECT * FROM Invoices WHERE id=" . $_GET['id'];
$result = $con->query($sql);
if (mysqli_num_rows($result) > 0) {
    $data = '';
    $row = mysqli_fetch_assoc($result);
    $_SESSION["invoice"]=$row;
}else{
    header("location:".SITE_URL);
    die();
}

include("includes/header.php");
$_SESSION["payment"]["shipping"]='NONE';
$_SESSION["shipping_info"]["GrandTotal"]=$row["totalprice"];
$_SESSION["shipping_info"]["cart_email"]=$row["email"];

?>
<script>
    $(document).ready(function () {
        data={};
        $(".BtnNext").click(function () {
            if($("#cart_paymentmethod_credit2").prop("checked")){
                data["device_fingerprint"]=$("#device_fingerprint").val();

                data["payment_option"]=getCreditCardType($("#card_number").val());

                if(data["payment_option"]=="false"){
                    hideloader();
                    Lobibox.notify('error', {
                        title: window.Lang.WrongInfo,
                        msg: window.Lang.InvalidCreditCard
                    });
                    $("#card_number").focus();
                    return false;
                }else if(!checkCreditCard($("#card_number").val(),data["payment_option"])){
                    hideloader();
                    Lobibox.notify('error', {
                        title: window.Lang.WrongInfo,
                        msg: window.Lang.InvalidCreditCard
                    });
                    $("#card_number").focus();
                    return false;
                }


                if(!$("#cart_cvv").val().match(/^[0-9]{3,4}$/)){
                    hideloader();
                    Lobibox.notify('error', {
                        title: window.Lang.WrongInfo,
                        msg: window.Lang.InvalidSecurityCode
                    });
                    $("#cart_cvv").focus();
                    return false;
                }


                $("#paymentmethod").val("creditcard");
                console.log("begin",data);
                $.ajax({
                    url:SITE_URL+"platform/ajax/platform.php?process=payfort_invoice_tokenization",
                    type: "POST",
                    cache: false,
                    data:{"data":JSON.stringify(data)},
                    dataType:'json',
                    success: function(jsonData){

                        console.log("aaa",jsonData);
                        $("#service_command").val(jsonData.service_command);
                        $("#access_code").val(jsonData.access_code);
                        $("#merchant_identifier").val(jsonData.merchant_identifier);
                        $("#merchant_reference").val(jsonData.merchant_reference);
                        $("#language").val(jsonData.language);
                        $("#signature").val(jsonData.signature);
                        $("#expiry_date").val(String($("#cart_exp_year").val())+String($("#cart_exp_month").val()));
                        $("#token_name").val(jsonData.token_name);
                        $("#return_url").val(jsonData.return_url);
                        $("#card_form").submit();
                    }
                });
            }else if($("#cart_paymentmethod_paypal2").prop("checked")){
                window.location.href=SITE_URL+"paypal/subscribe.php";
            }
        });
        $(".shipping-main-container .section-check-row").click(function () {
            if ($("#ship_same_address").prop("checked")) {
                $("#ShippingAdress").slideUp();
            }
            else {
                $("#ShippingAdress").slideDown();
            }
        });
        $(".section-check-row").click(function () {
            if ($("#cart_paymentmethod_credit2").prop("checked")) {
                $("#credit").slideDown();
            }
            else {
                $("#credit").slideUp();
            }
        });
        $(".section-check-row").click(function () {
            if ($("#cart_paymentmethod_new").prop("checked")) {
                $("#new").slideDown();
            }
            else {
                $("#new").slideUp();
            }
        });
    })
</script>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/invoice.css<?=$cash;?>">
<div class="inner-pages-main-container-priv">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="cart-main-container">
                        <div class="shipping-main-container floating-left">
                            <?php
                            if(isset($row["status"]) && $row["status"]!=1){
                                ?>
                            <div class="information-container floating-left ">
                                <div class="floating-left payment-method">
                                    <h1><?= $Lang->PaymentMethod; ?></h1>
                                    <?php
                                    //if(isset($_GET["pass"]) && $_GET["pass"]=="yth79785"){
                                    ?>
                                    <div class="section-check-row floating-left">
                                        <label class="input-control checkbox floating-left">
                                            <input class="floating-left" type="radio" name="cart_paymentmethod"
                                                   id="cart_paymentmethod_credit2" value="credit" checked="checked"><span
                                                    class="check radius"></span>
                                        </label>
                                        <label for="cart_paymentmethod_credit" class="image-c floating-left"></label>
                                        <label for="cart_paymentmethod_credit"
                                               class="text floating-left"><?= $Lang->CreditCards; ?></label>
                                    </div>
                                    <div class="credit-card-inner">
                                        <form action="<?= Payfort_token_URL; ?>" METHOD="POST" id="card_form" name="card_form">
                                            <div class="line-row">
                                                <label
                                                        class="lbl-data-a floating-left text-left"><?= $Lang->CardNumber; ?></label>
                                                <input class="floating-left" maxlength="16" type="text" name="card_number"
                                                       value="" id="card_number" placeholder="<?= $Lang->CardNumber; ?>">
                                            </div>
                                            <div class="line-row">
                                                <label
                                                        class="lbl-data-a floating-left text-left"><?= $Lang->ExpDate; ?></label>
                                                <div class="ddl-container-b floating-left">
                                                    <label class="texr-left" id="lblcart_exp_month">01</label>
                                                    <select id="cart_exp_month">
                                                        <option value="01">01</option>
                                                        <option value="02">02</option>
                                                        <option value="03">03</option>
                                                        <option value="04">04</option>
                                                        <option value="05">05</option>
                                                        <option value="06">06</option>
                                                        <option value="07">07</option>
                                                        <option value="08">08</option>
                                                        <option value="09">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                                <div class="ddl-container-b floating-left">
                                                    <label class="texr-left" id="lblcart_exp_year">2017</label>
                                                    <select id="cart_exp_year">
                                                        <option value="17">2017</option>
                                                        <option value="18">2018</option>
                                                        <option value="19">2019</option>
                                                        <option value="20">2020</option>
                                                        <option value="21">2021</option>
                                                        <option value="22">2022</option>
                                                        <option value="23">2023</option>
                                                        <option value="24">2024</option>
                                                        <option value="25">2025</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="line-row" style="overflow: visible">
                                                <label class="lbl-data-a floating-left text-left"
                                                       style="overflow: visible"><?= $Lang->CVCNumber; ?>
                                                    <a class="tooltip">
                                                        <div class="images-click"></div>
                                                        <span class="custom help" style="display: none">
                                                    <label><?= $Lang->TheCVVtext; ?></label>
                                                    <div class="big-help-image"></div>
                                                </span>
                                                    </a>
                                                </label>
                                                <input class="floating-left" type="text" name="card_security_code" value=""
                                                       id="cart_cvv" placeholder="<?= $Lang->CVCNumber; ?>">
                                            </div>
                                            <input type="hidden" name="service_command" id="service_command" value="">
                                            <input type="hidden" name="access_code" id="access_code" value="">
                                            <input type="hidden" name="merchant_identifier" id="merchant_identifier"
                                                   value="">
                                            <input type="hidden" name="merchant_reference" id="merchant_reference" value="">
                                            <input type="hidden" name="language" id="language" value="">
                                            <input type="hidden" name="signature" id="signature" value="">
                                            <input type="hidden" name="expiry_date" id="expiry_date" value="">
                                            <input type="hidden" name="token_name" id="token_name" value="">
                                            <input type="hidden" name="return_url" id="return_url" value="">
                                        </form>
                                        <input type="hidden" id="device_fingerprint" name="device_fingerprint"/>
                                        <script type="text/javascript">
                                            var io_bbout_element_id = 'device_fingerprint';
                                            //the input id will be used to collect the device finger
                                            //print value
                                            var io_install_stm = false;
                                            var io_exclude_stm = 0;
                                            //prevent the iovation Active X control from running on either Windows

                                            var io_install_flash = false;
                                            var io_enable_rip = true; // collect real ip information
                                        </script>
                                        <script type="text/javascript" src="https://mpsnare.iesnare.com/snare.js"></script>
                                    </div>

                                    <?php
                                    ?>
                                    <div class="section-check-row floating-left">
                                        <label class="input-control checkbox floating-left">
                                            <input class="floating-left" type="radio" name="cart_paymentmethod"
                                                   id="cart_paymentmethod_paypal2" value="paypal"><span
                                                    class="check radius"></span></label>
                                        <label for="cart_paymentmethod_paypal" class="image-a floating-left"></label>
                                        <label for="cart_paymentmethod_paypal"
                                               class="text floating-left"><?= $Lang->Paypal; ?></label>
                                    </div>
                                    <?php


                                    if (isset($_GET["pass2"]) && $_GET["pass"] == "yth5634") {
                                        ?>
                                        <div class="section-check-row floating-left">
                                            <label class="input-control checkbox floating-left">
                                                <input class="floating-left" type="radio" name="cart_paymentmethod"
                                                       id="cart_paymentmethod_sadad" value="sadad"><span
                                                        class="check radius"></span>
                                            </label>
                                            <label for="cart_paymentmethod_sadad" class="image-d floating-left"></label>
                                            <label for="cart_paymentmethod_sadad"
                                                   class="text floating-left"><?= $Lang->Sadad; ?></label>
                                        </div>
                                        <div class="section-check-row floating-left">
                                            <label class="input-control checkbox floating-left">
                                                <input class="floating-left" type="radio" name="cart_paymentmethod"
                                                       id="cart_paymentmethod_Installments" value="Installments"><span
                                                        class="check radius"></span></label>
                                            <label for="cart_paymentmethod_Installments" class="image-e floating-left"></label>
                                            <label for="cart_paymentmethod_Installments"
                                                   class="text floating-left"><?= $Lang->Installments; ?></label>
                                        </div>
                                        <div class="section-check-row floating-left">
                                            <label class="input-control checkbox floating-left">
                                                <input class="floating-left" type="radio" name="cart_paymentmethod" id="cart_paymentmethod_NAPS" value="NAPS">
                                                <span class="check radius"></span>
                                            </label>
                                            <label for="cart_paymentmethod_NAPS" class="image-f floating-left"></label>
                                            <label for="cart_paymentmethod_NAPS" class="text floating-left"><?= $Lang->NAPS; ?></label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                   <!-- <div class="section-check-row floating-left" id="cod_option">
                                        <label class="input-control checkbox floating-left">
                                            <input class="floating-left" type="radio" name="cart_paymentmethod"
                                                   id="cart_paymentmethod_CashOnDelivery" value="CashOnDelivery"><span
                                                    class="check radius"></span>
                                        </label>
                                        <label for="cart_paymentmethod_CashOnDelivery" class="image-b floating-left"></label>
                                        <label for="cart_paymentmethod_CashOnDelivery"
                                               class="text floating-left"><?= $Lang->CashOnDelivery; ?>
                                            <span><?= $Lang->Extrachargingonyourinvoice; ?></span></label>
                                    </div>-->
                                </div>
                            </div>

                                <?php
                            }else{
                                ?>
                            <div class="information-container floating-left ">
                                <div class="InvoiceHasbeenDone-message">
                                    <?=$Lang->InvoiceHasbeenDone;?>
                                </div>
                            </div>

                            <?php
                            }
                            ?>

                            <div class="viewer-container floating-left">
                                <div class="bill-table-container">
                                    <div class="bill-row">
                                        <h1><?= $Lang->YourInvoice;?> #<?=$row['number']?></h1>
                                    </div>
                                    <div class="bill-row">
                                        <label class="floating-left"><?= $Lang->FullName; ?></label>
                                        <span class="floating-right"><div class="floating-right cart_total_price"><?=$row['name']?></div><span>
                                    </div>
                                    <div class="bill-row">
                                        <label class="floating-left"><?= $Lang->EMail; ?></label>
                                        <span class="floating-right"><div class="floating-right order_shipping"><?=$row['email']?></div><span>
                                    </div>
                                    <div class="bill-row">
                                        <label class="floating-left"><?= $Lang->AddressA; ?></label>
                                        <span class="floating-right"><div class="floating-right cash_cost"><?=$row['address']?> </div class="floating-left"><span>
                                    </div>
                                    <div class="bill-row">
                                        <label class="floating-left"><?= $Lang->country; ?></label>
                                        <span class="floating-right"><div class="floating-right cart_tax"><?=$row['country']?></div><span>
                                    </div>
                                    <div class="bill-row">
                                        <label class="floating-left"><?= $Lang->City; ?></label>
                                        <span class="floating-right"><div class="floating-right cart_tax"><?=$row['city']?></div><span>
                                    </div>
                                    <div class="bill-row">
                                        <label class="floating-left"><?= $Lang->productname; ?></label>
                                        <span class="floating-right"><div class="floating-right cart_tax"><?=$row['productname']?></div><span>
                                    </div>
                                    <div class="bill-row">
                                        <label class="floating-left"><?= $Lang->Price; ?></label>
                                        <span class="floating-right"><div class="floating-right cart_tax"><?=$row['price']?></div><div class="floating-right">$</div></span>
                                    </div>
                                    <div class="bill-row">
                                        <label class="floating-left"><?= $Lang->ShippingPrice; ?></label>
                                        <span class="floating-right"><div class="floating-right cart_tax"><?=$row['shippingprice']?></div><div class="floating-right">$</div></span>
                                    </div>
                                    <div class="bill-row">
                                        <label class="floating-left"><?= $Lang->Shippingmethod; ?></label>
                                        <span class="floating-right"> <div class="floating-right cart_tax"><?=$row['shippingmethod']?></div><span>
                                    </div>
                                    <div class="bill-row">
                                        <label class="floating-left"><?= $Lang->Description; ?></label>
                                        <span class="floating-right description"><div class="floating-right cart_tax"><?=$row['description']?> </div><span>
                                    </div>
                                    <div class="bill-row">
                                        <label class="floating-left"><?= $Lang->GrandTotal; ?></label>
                                        <span class="floating-right"><div class="floating-right cart_grand_total"><?=$row['totalprice']?></div><div class="floating-right">$</div><span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        if(isset($row["status"]) && $row["status"]!=1){
                            ?>
                            <a class="floating-right button BtnNext  checkout"><?= $Lang->Continue; ?></a>

                            <?php
                        }
                            ?>




                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>
