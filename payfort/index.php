<?php
/**
 * Created by Dar Al-manhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/22/2017
 * Time: 4:02 PM
 */

//for Test
define("Payfort_Auth_URL","https://sbcheckout.payfort.com/FortAPI/paymentPage");
//define("Payfort_Auth_URL","https://checkout.payfort.com/FortAPI/paymentPage");

define("Payfort_Access_Code","4yosctTk1BwEN9WMXObm");
define("Payfort_SHA_Request","dgdgd4564");
define("Payfort_SHA_Response","ggj567");
define("Payfort_Identifire","OjXrZdgn");

    $amount=50;
    $merchant_reference="ref0014";
    //$signature_queu=Payfort_SHA_Request.'access_code='.Payfort_Access_Code.'amount='.$amount.'command=AUTHORIZATION'.'currency='.'USD'.'customer_email='.'hussam@manhal.com'.'language='.'en'.'merchant_identifier='.Payfort_Identifire.'merchant_reference='.$merchant_reference.'order_description='.'Item'.Payfort_SHA_Request;
//    $signature_queu=Payfort_SHA_Request.'access_code='.Payfort_Access_Code.'amount='.$amount.'command=AUTHORIZATION'.'currency='.'USD'.'customer_email='.'hussam@manhal.com'.'language='.'en'.'merchant_identifier='.Payfort_Identifire.'merchant_reference='.$merchant_reference.'order_description='.'Item'.Payfort_SHA_Request;
//    $signature=hash('sha256', $signature_queu);
$data=array(
    "service_command"=>"TOKENIZATION",
    "access_code"=>Payfort_Access_Code,
    "merchant_identifier"=>Payfort_Identifire,
    "merchant_reference"=>$merchant_reference,
    "language"=>"en",
    "return_url"=>"https://www.manhal.com/payfort/response.php",
    "token_name"=>"Tok129"
);
$signature=calculateSignature($data,"request");

function calculateSignature($arrData, $signType = 'request'){
    $shaString= '';
    ksort($arrData);
    foreach ($arrData as $k => $v) {
        $shaString.="$k=$v";
    }


    if ($signType == 'request') {
        $shaString = Payfort_SHA_Request.$shaString.Payfort_SHA_Request;
    }
    else {
        $shaString = Payfort_SHA_Response . $shaString .Payfort_SHA_Response;
    }
    echo "<br>".$shaString."<br>";
    $signature = hash("sha256",$shaString);
    return $signature;
}

?>
<form action="https://sbcheckout.payfort.com/FortAPI/paymentPage" METHOD="POST"  id="form1" name="form1">
    <div class="credit-card-inner">
        <div class="line-row">
            <label class="lbl-data-a floating-left text-left">Card Number</label>
            <input class="floating-left" type="text" value="" name="card_number" id="card_number" placeholder="Card Numbers">
        </div>
        <div class="line-row">
            <label class="lbl-data-a floating-left text-left">Exp . Date</label>
            <div class="ddl-container-b floating-left">
                <label class="texr-left" id="lblcart_country">Jan01</label>
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
                <label class="texr-left" id="lblcart_country">2017</label>
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
                    <option value="26">2026</option>
                    <option value="27">2027</option>
                    <option value="28">2028</option>
                    <option value="29">2029</option>
                    <option value="30">2030</option>
                    <option value="31">2031</option>
                    <option value="32">2032</option>
                    <option value="33">2033</option>
                    <option value="34">2034</option>
                    <option value="35">2035</option>
                    <option value="36">2036</option>
                    <option value="37">2037</option>
                </select>
            </div>
        </div>
        <div class="line-row">
            <label class="lbl-data-a floating-left text-left">CVC Number</label>
            <input class="floating-left" type="text" value="" name="card_security_code" id="card_security_code" placeholder="">
        </div>
    </div>
<!--    <input type="hidden" NAME="card_number" value="5361220000306171">-->
<!--    <INPUT type="hidden" NAME="card_security_code" value="061">-->

    <input type="hidden" name="service_command" id="service_command" value="TOKENIZATION">
    <input type="hidden" name="access_code" id="access_code" value="<?=Payfort_Access_Code;?>">
    <input type="hidden" name="merchant_identifier" id="merchant_identifier" value="<?=Payfort_Identifire;?>">
    <input type="hidden" name="merchant_reference" id="merchant_reference" value="<?=$merchant_reference;?>">
    <input type="hidden" name="language" id="language" value="en">
    <input type="hidden" name="signature" id="signature" value="<?=$signature;?>">
    <input type="hidden" name="expiry_date" id="expiry_date" value="1705">
    <input type="hidden" name="token_name" id="token_name" value="Tok129">
    <input type="hidden" name="return_url" id="return_url" value="https://www.manhal.com/payfort/response.php">
    <input type="submit" value="submit">
</form>

