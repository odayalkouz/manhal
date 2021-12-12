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

$amount=1000;
$merchant_reference="ref".uniqid();
//$signature_queu=Payfort_SHA_Request.'access_code='.Payfort_Access_Code.'amount='.$amount.'command=AUTHORIZATION'.'currency='.'USD'.'customer_email='.'hussam@manhal.com'.'language='.'en'.'merchant_identifier='.Payfort_Identifire.'merchant_reference='.$merchant_reference.'order_description='.'Item'.Payfort_SHA_Request;
//    $signature_queu=Payfort_SHA_Request.'access_code='.Payfort_Access_Code.'amount='.$amount.'command=AUTHORIZATION'.'currency='.'USD'.'customer_email='.'hussam@manhal.com'.'language='.'en'.'merchant_identifier='.Payfort_Identifire.'merchant_reference='.$merchant_reference.'order_description='.'Item'.Payfort_SHA_Request;
//    $signature=hash('sha256', $signature_queu);
//$data=array(
//    "service_command"=>"TOKENIZATION",
//    "access_code"=>Payfort_Access_Code,
//    "merchant_identifier"=>Payfort_Identifire,
//    "merchant_reference"=>$merchant_reference,
//    "language"=>"en",
//    "return_url"=>"https://www.manhal.com/payfort/index.php",
//    "token_name"=>"Tok123"
//);
//$signature=calculateSignature($data,"request");


//$postData = array(
//    'command' => 'PURCHASE',
//    'access_code' => Payfort_Access_Code,
//    'merchant_identifier' => Payfort_Identifire,
//    'merchant_reference' => $_GET["merchant_reference"],
//    'amount' => 100,
//    'currency' => 'USD',
//    'language' => 'en',
//    'customer_email' => 'hussam@manhal.com',
//    'token_name' => $_GET["token_name"],
//    'payment_option' => 'MASTERCARD',
//    'order_description' => 'Books Payment',
//    'customer_name' => 'Hussam Abu Khadijeh',
//    'return_url' => ''
//);


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
$data=array();
foreach($_GET as $key=>$value){
    echo $key." = ".$value."<br>";
    if($key!="card_number" && $key!="signature" && $key!="expiry_date" && $key!="card_holder_name"){
        $data[$key]=$value;
    }
}
$signature=calculateSignature($data,"response");
if($signature==$_GET["signature"]){
    echo "safe data <br>";
}else{
    echo "fake data <br>";
}
echo "clalc signature = ".$signature."<br>";
echo "s_get signature = ".$_GET["signature"]."<br>";

?>
