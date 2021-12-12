<?php
/**
 * Created by Dar Al-Manhal -Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 2/15/2017
 * Time: 8:43 AM
 */

//for Test
define("Payfort_Auth_URL","https://sbcheckout.payfort.com/FortAPI/paymentPage");
//define("Payfort_Auth_URL","https://checkout.payfort.com/FortAPI/paymentPage");

define("Payfort_Access_Code","4yosctTk1BwEN9WMXObm");
define("Payfort_SHA_Request","dgdgd4564");
define("Payfort_SHA_Response","ggj567");
define("Payfort_Identifire","OjXrZdgn");

$amount=50*100;
$merchant_reference="ref0014";

if(isset($_GET["service_command"]) && $_GET["service_command"]=="TOKENIZATION"){
    $_SESSION["first_response"]=$_GET;
}


$postData = array(
    'command' => 'PURCHASE',
    'access_code' => Payfort_Access_Code,
    'merchant_identifier' => Payfort_Identifire,
    'merchant_reference' => $merchant_reference,
    'amount' => $amount,
    'currency' => 'USD',
    'language' => 'en',
    'customer_email' => 'hussam@manhal.com',
    'token_name' => $_GET["token_name"],
    'payment_option' => 'MASTERCARD',
    'eci' => 'ECOMMERCE',
    'order_description' => 'Books payments',
    'customer_name' => 'Hussam Abu Khadijeh',
    'return_url' => 'https://www.manhal.com/payfort/response.php'
);
$postData['signature']=calculateSignature($postData,"request");


// Setup cURL
$ch = curl_init('https://sbpaymentservices.payfort.com/FortAPI/paymentApi');
curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));

// Send the request
$response = curl_exec($ch);

// Check for errors
if($response === FALSE){
    die(curl_error($ch));
}else{
    $responseData = json_decode($response, TRUE);
    print_r($responseData);
    echo  "<br><br><br>";
    print_r($_SESSION["first_response"]);
    echo  "<br><br><br>";
    print_r($_GET);

}


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
