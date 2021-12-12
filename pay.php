<?php
$currentTab = "cart";
include_once "platform/config.php";
include_once "includes/function.php";
include_once "platform/includes/function.php";
mustLogin();
include_once "includes/header.php";



?>
<link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?=$session_lang;?>/css/cart.css<?=$cash;?>">
<link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?=$session_lang;?>/css/pay.css<?=$cash;?>">
<script>
    $(document).ready(function () {
        data={};
        if($("#donate").prop("checked")){
            data["donate"]=1;
        }else{
            data["donate"]=0;
        }
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
                    url:SITE_URL+"platform/ajax/platform.php?process=payfort_sub_tokenization&type=subscribe",
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
                window.location.href=SITE_URL+"paypal/subscribe.php?donate="+data["donate"];
            }else{
                if(!isEmail($("#email").val())){
                    hideloader();
                    Lobibox.notify('error', {
                        title: window.Lang.WrongInfo,
                        msg: window.Lang.InvalidEmailAddress
                    });
                    $("#email").focus();
                    return false;
                }
                data["payment_option"]="cash";
                data["full_name"]=$("#full_name").val();
                data["school_name"]=$("#school_name").val();
                data["country"]=$("#lblddlCountry").html();
                data["city"]=$("#city").val();
                data["city"]=$("#city").val();
                data["email"]=$("#email").val();
                data["phone"]=$("#phone").val();
                data["mobile"]=$("#mobile").val();
                data["address"]=$("#address").val();
                data["countrycode"]=$("#ddlCountry").val();
                $.ajax({
                    url:SITE_URL+"platform/ajax/platform.php?process=schoolorder",
                    type: "POST",
                    cache: false,
                    data:{"data":JSON.stringify(data)},
                    dataType:'json',
                    success: function(jsonData){
                        console.log("jsonData",jsonData);
                        if(jsonData.result==1){
                            window.location.href=SITE_URL+window.Lang.Lang+"/check-out?success=1&type=subscribe";
                        }else{
                            hideloader();
                            Lobibox.notify('error', {
                                title: window.Lang.error,
                                msg: window.Lang.UnexpectedError
                            });
                        }

                    }
                });
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
<div class="inner-pages-main-container-a cart-main-container">
    <?= $breadCrumbs; ?>
    <div class="center-piece">
        <div class="shipping-main-container floating-left">
            <div class="information-container floating-left ">
                <div class="floating-left payment-method">
                    <h1><?= $Lang->PaymentMethod; ?></h1>
                    <div class="section-check-row floating-left">
                        <label class="input-control checkbox floating-left">
                            <input class="floating-left" type="radio" name="cart_paymentmethod" id="cart_paymentmethod_credit2" value="credit" checked="checked">
                            <span class="check radius"></span>
                        </label>
                        <label for="cart_paymentmethod_credit2" class="image-c floating-left"></label>
                        <label for="cart_paymentmethod_credit2" class="text floating-left"><?= $Lang->CreditCards;?></label>
                    </div>
                    <div id="credit" class="credit-card-inner">
                        <form action="<?= Payfort_token_URL; ?>" METHOD="POST" id="card_form" name="card_form">
                            <div class="line-row">
                                <label class="lbl-data-a floating-left text-left"><?= $Lang->CardNumber; ?></label>
                                <input class="floating-left" type="text" name="card_number" value="" id="card_number" placeholder="<?= $Lang->CardNumber; ?>">
                            </div>
                            <div class="line-row">
                                <label class="lbl-data-a floating-left text-left"><?= $Lang->ExpDate;?></label>
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
                                <label class="lbl-data-a floating-left text-left" style="overflow: visible"><?= $Lang->CVCNumber; ?>
                                    <a class="tooltip">
                                        <div class="images-click"></div>
                                        <span class="custom help">
                                            <label><?= $Lang->TheCVVtext; ?></label>
                                            <div class="big-help-image"></div>
                                        </span>
                                    </a>
                                </label>
                                <input class="floating-left" type="text" name="card_security_code" value="" id="cart_cvv" placeholder="<?= $Lang->CVCNumber; ?>">
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
                    <div class="section-check-row floating-left">
                        <label class="input-control checkbox floating-left">
                            <input class="floating-left" type="radio" name="cart_paymentmethod" id="cart_paymentmethod_paypal2" value="paypal">
                            <span class="check radius"></span></label>
                        <label for="cart_paymentmethod_paypal" class="image-a floating-left"></label>
                        <label for="cart_paymentmethod_paypal2" class="text floating-left"><?= $Lang->Paypal; ?></label>
                    </div>
                    <?php
                    if($_SESSION["subscribe_data"]["type"]=='Schools'){
?>

                    <div class="section-check-row floating-left">
                        <label class="input-control checkbox floating-left">
                            <input class="floating-left" type="radio" name="cart_paymentmethod" id="cart_paymentmethod_new" value="CashOnDelivery"><span class="check radius"></span>
                        </label>
                        <label for="cart_paymentmethod_new" class="image-b floating-left"></label>
                        <label for="cart_paymentmethod_new" class="text floating-left"><?= $Lang->CashOnDeliverySubscribe; ?></label>
                    </div>
                    <div class="credit-card-inner" id="new" style="display: none">
                        <form action="<?= Payfort_token_URL; ?>" METHOD="POST" id="card_form" name="card_form">
                            <div class="line-row">
                                <label class="lbl-data-a floating-left text-left"><?= $Lang->FullName; ?></label>
                                <input class="floating-left" type="text" name="full_name" value="" id="full_name" placeholder="<?= $Lang->FullName; ?>">
                            </div>
                            <div class="line-row">
                                <label class="lbl-data-a floating-left text-left"><?= $Lang->SchoolName; ?></label>
                                <input class="floating-left" type="text" name="school_name" value="" id="school_name" placeholder="<?= $Lang->SchoolName; ?>">
                            </div>
                            <div class="line-row">
                                <label class="lbl-data-a floating-left text-left"><?= $Lang->country; ?></label>
                                <div class="ddl-container-b floating-left">
                                    <label class="texr-left" id="lblddlCountry"></label>
                                    <select id="ddlCountry" onchange="$('#cmbCountry').val(this.options[this.selectedIndex].value);">
                                        <?php
                                        if(isset($session_lang) && $session_lang=="En"){
                                            include "includes/countries.php";
                                        }else{

                                            include "includes/countries_Ar.php";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="line-row">
                                <label class="lbl-data-a floating-left text-left"><?= $Lang->City;?></label>
                                <input class="floating-left" type="text" name="city" value="" id="city" placeholder="<?= $Lang->City;?>">
                            </div>
                            <div class="line-row">
                                <label class="lbl-data-a floating-left text-left"><?= $Lang->EMail;?></label>
                                <input class="floating-left" type="text" name="email" value="" id="email" placeholder="<?= $Lang->EMail;?>">
                            </div>
                            <div class="line-row">
                                <label class="lbl-data-a floating-left text-left"><?= $Lang->Phone;?></label>
                                <input class="floating-left" type="text" name="email" value="" id="phone" placeholder="<?= $Lang->Phone;?>">
                            </div>
                            <div class="line-row">
                                <label class="lbl-data-a floating-left text-left"><?= $Lang->Mobile;?></label>
                                <input class="floating-left" type="text" name="mobile" value="" id="mobile" placeholder="<?= $Lang->Mobile;?>">
                            </div>
                            <div class="line-row">
                                <label class="lbl-data-a floating-left text-left"><?= $Lang->Address;?></label>
                                <input class="floating-left" type="text" name="address" value="" id="address" placeholder="<?= $Lang->Address;?>">
                            </div>
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
                    }
                    ?>
                </div>
            </div>
            <div class="viewer-container floating-left">
                <div class="bill-table-container">
                    <div class="bill-row">
                        <h1><?=$Lang->YourMembership;?></h1>
                    </div>
                    <div class="parent-schools-container">
                        <?php
                        if($_SESSION["subscribe_data"]["type"]=='Parents'&&$_SESSION["subscribe_data"]["subscribe"]=='Monthly'){

                            ?>
                            <div class="parent-monthly">
                                <div class="title-head">
                                    <h3 class="floating-left"><?=$Lang->Monthly;?> - <?=$Lang->Families1;?></h3>
                                </div>
                                <div class="lists">
                                    <div class="list-item">
                                        <div class="number floating-left"><?=$Lang->costperusers;?></div>
                                        <div class="month floating-left">
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left">$</span>
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["costperuser"];?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-item">
                                        <div class="number floating-left"><?=$Lang->UsersAccounts;?></div>
                                        <div class="month floating-left">
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["usersAccounts"];?></span>
                                            </div>
                                            <div class="hit floating-left">X</div>
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left">$</span>
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["costperuser"];?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-item">
                                        <div class="number floating-left"><?=$Lang->NumberOfMonths;?></div>
                                        <div class="month floating-left">
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["months_years"];?></span>
                                            </div>
                                            <div class="hit floating-left">X</div>
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left">$</span>
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["cost"];?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }else if($_SESSION["subscribe_data"]["type"]=='Parents'&&$_SESSION["subscribe_data"]["subscribe"]=='Annual'){

                          ?>
                            <div class="parent-Annual">
                                <div class="title-head">
                                    <h3 class="floating-left"><?=$Lang->Annual;?> - <?=$Lang->Families1;?></h3>
                                </div>
                                <div class="lists">
                                    <div class="list-item">
                                        <div class="number floating-left"><?=$Lang->costperusers;?></div>
                                        <div class="month floating-left">
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left">$</span>
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["costperuser"]?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-item">
                                        <div class="number floating-left"><?=$Lang->UsersAccounts;?></div>
                                        <div class="month floating-left">
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left"></span>
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["usersAccounts"]?></span>
                                            </div>
                                            <div class="hit floating-left">X</div>
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left">$</span>
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["costperuser"]?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-item">
                                        <div class="number floating-left"><?=$Lang->NumberOfYears;?></div>
                                        <div class="month floating-left">
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["months_years"];?></span>
                                            </div>
                                            <div class="hit floating-left">X</div>
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left">$</span>
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["cost"];?></span>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        <?php
                        }else if($_SESSION["subscribe_data"]["type"]=='Schools'&&$_SESSION["subscribe_data"]["subscribe"]=='Monthly'){

                        ?>
                            <div class="schools-monthly">
                                <div class="title-head">
                                    <h3 class="floating-left"><?=$Lang->Monthly;?> - <?=$Lang->Schools;?></h3>
                                </div>
                                <div class="lists">
                                    <div class="list-item">
                                        <div class="number floating-left"><?=$Lang->costperusers;?></div>
                                        <div class="month floating-left">
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left">$</span>
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["costperuser"]?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-item">
                                        <div class="number floating-left"><?=$Lang->UsersAccounts;?></div>
                                        <div class="month floating-left">
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left"></span>
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["usersAccounts"]?></span>
                                            </div>
                                            <div class="hit floating-left">X</div>
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left">$</span>
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["costperuser"]?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-item">
                                        <div class="number floating-left"><?=$Lang->NumberOfMonths;?></div>
                                        <div class="month floating-left">
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["months_years"];?></span>
                                            </div>
                                            <div class="hit floating-left">X</div>
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left">$</span>
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["cost"];?></span>
                                            </div>
                                        </div>
                                    </div>


                                </div></div>
                            <?php

                        }else if($_SESSION["subscribe_data"]["type"]=='Schools'&&$_SESSION["subscribe_data"]["subscribe"]=='Annual'){

                            ?>
                            <div class="schools-Annual">
                                <div class="title-head">
                                    <h3 class="floating-left"><?=$Lang->Annual;?> - <?=$Lang->Schools;?></h3>
                                </div>
                                <div class="lists">
                                    <div class="list-item">
                                        <div class="number floating-left"><?=$Lang->costperusers;?></div>
                                        <div class="month floating-left">
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left">$</span>
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["costperuser"]?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-item">
                                        <div class="number floating-left"><?=$Lang->UsersAccounts;?></div>
                                        <div class="month floating-left">
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left"></span>
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["usersAccounts"]?></span>
                                            </div>
                                            <div class="hit floating-left">X</div>
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left">$</span>
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["costperuser"]?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-item">
                                        <div class="number floating-left"><?=$Lang->NumberOfYears;?></div>
                                        <div class="month floating-left">
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["months_years"];?></span>
                                            </div>
                                            <div class="hit floating-left">X</div>
                                            <div class="display-inline-block floating-left">
                                                <span class="floating-left">$</span>
                                                <span class="floating-left"><?=$_SESSION["subscribe_data"]["cost"];?></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php
                        }
                        ?>




                    </div>

                <label class="bill-row">
                    <label class="floating-left" for="donate"><?= $Lang->donateForAlhussain;?></label>
                    <a class="floating-left" target="_blank" href="http://www.khcc.jo/en"><?= $Lang->KingHussein;?></a>
                    <span class="floating-left">($1)</span>
                    <input class="floating-left" type="checkbox" value="1" id="donate" name="donate">
                </label>
                    <div class="bill-row">
                        <label class="floating-left"><?= $Lang->GrandTotal; ?></label>
                        <span class="floating-right"><div class="floating-left">$</div><div
                                    class="floating-left cart_grand_total"><?=$_SESSION["subscribe_data"]["total"]?></div class="floating-left"><span>
                    </div>
                </div>
                <div class="safe-secure-container">
                    <div class="text-container">
                        <label>Safe &amp; Secure </label>
                        <p>The transaction is safe and secured, using the latest encryption technologies</p>
                    </div>
                    <div class="bottom-container floating-right">
                        <!--                                <div class="images images-a floating-right"></div>-->
                        <!--                                <div class="images images-b floating-right"></div>-->
                        <!--                                <div class="images images-c floating-right"></div>-->
                        <div class="images images-d floating-right"></div>
                        <div class="images images-e floating-right"></div>
                        <div class="images images-f floating-right"></div>
                    </div>
                </div>
        </div>
        <a class="floating-right button BtnNext paycheckOut"><?=$Lang->Continue;?></a>
        <a href="<?=SITE_URL.$lang_code."/subscribe";?>" class=" floating-right button BtnBack"><?=$Lang->Back;?></a>
    </div>
</div>
<?php
include_once "includes/footer.php";
?>
