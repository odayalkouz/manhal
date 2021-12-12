<?php
/**
 * Created by Dar Al-Manhal - Hussam Abu Khadijeh.
 * User: New Hussam Abu Khadijeh
 * Date: 1/29/2017
 * Time: 10:04 AM
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');

//for Test
define("Payfort_Auth_URL","https://sbcheckout.payfort.com/FortAPI/paymentPage");
//define("Payfort_Auth_URL","https://checkout.payfort.com/FortAPI/paymentPage");

define("Payfort_Access_Code","4yosctTk1BwEN9WMXObm");
define("Payfort_SHA_Request","dgdgd4564");
define("Payfort_SHA_Response","ggj567");
define("Payfort_Identifire","OjXrZdgn");

$amount=1000;
$merchant_reference="merchant_reference";
//$signature_queu=Payfort_SHA_Request.'access_code='.Payfort_Access_Code.'amount='.$amount.'command=AUTHORIZATION'.'currency='.'USD'.'customer_email='.'hussam@manhal.com'.'language='.'en'.'merchant_identifier='.Payfort_Identifire.'merchant_reference='.$merchant_reference.'order_description='.'Item'.Payfort_SHA_Request;
$signature_queu=Payfort_SHA_Request.'access_code='.Payfort_Access_Code.'amount='.$amount.'command=AUTHORIZATION'.'currency='.'USD'.'customer_email='.'hussam@manhal.com'.'language='.'en'.'merchant_identifier='.Payfort_Identifire.'merchant_reference='.$merchant_reference.'order_description='.'Item'.Payfort_SHA_Request;
$signature=hash('sha256', $signature_queu);

//Authorization
$requestParams = array(
    'access_code' => Payfort_Access_Code ,
    'amount' => $amount,
    'currency' => 'USD',
    'customer_email' => 'hussam@manhal.com',
    'merchant_reference' => $merchant_reference,
    'order_description' => 'Item',
    'language' => 'en',
    'merchant_identifier' => Payfort_Identifire,
    'signature' => $signature,
    'command' => 'AUTHORIZATION',
);
    $url="https://sbcheckout.payfort.com/FortAPI/paymentPage";
$ch = curl_init( $url );
# Setup request to send json via POST.
$data = json_encode($requestParams);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$result = curl_exec($ch);
curl_close($ch);
# Print response.
echo "<pre>$result</pre>";
?>

