<?php
/**
 * Created by PhpStorm.
 * User: New Dept5
 * Date: 2/28/2017
 * Time: 8:54 AM
 */
//print_r($_POST);

include_once "../platform/config.php";
include_once "../includes/function.php";

//$response=array(
//    "card_number" => "5123456789012346 ",
//    "card_security_code" => "123",
//    "service_command" => "TOKENIZATION",
//    "access_code" => "4yosctTk1BwEN9WMXObm",
//    "merchant_identifier" => "OjXrZdgn",
//    "merchant_reference" => "Mp1",
//    "language" => "en",
//    "signature" => "d979f303f738354a6f09e0d4189859e82dae5db0421bd3fb67c8b4055dbc969a",
//    "expiry_date" => "1705",
//    "token_name" => "Pay852Tok22Man8574utyrt00TYFv247F54",
//    "return_url" => "http://localhost/Manhal/en/payment"
//);
//
//$data=array(
//    "service_command" => "TOKENIZATION",
//    "access_code" => "4yosctTk1BwEN9WMXObm",
//    "merchant_identifier" => "OjXrZdgn",
//    "merchant_reference" => "Mp1",
//    "language" => "en",
//    "token_name" => "Pay852Tok22Man8574utyrt00TYFv247F54",
//    "return_url" => "http://localhost/Manhal/en/payment"
//);

function getPayfortData($data){
    if(isset($data['r'])){
        unset($data['r']);
    }
    if(isset($data['signature'])){
        unset($data['signature']);
    }
    if(isset($data['integration_type'])){
        unset($data['integration_type']);
    }
    if(isset($data['3ds'])){
        unset($data['3ds']);
    }
    return $data;
}

$data=getPayfortData($_GET);

//?response_code=18000&card_number=512345******2346&signature=d120ca3a3f6d43503a6d9cc8ed87a86a180cf3b43e3717b317cc43b5fe0a6d7b&merchant_identifier=OjXrZdgn&expiry_date=1705&access_code=4yosctTk1BwEN9WMXObm&language=en&service_command=TOKENIZATION&response_message=Success&merchant_reference=Mp58b5472fa1d81&token_name=Pay852Tok22Man8574utyrt00TYFv247F54&return_url=https%3A%2F%2Fwww.manhal.com%2Fen%2Fpayment&card_bin=512345&status=18
$signature=calculateSignature($data,"response");
echo $_GET["signature"]."<br>";
echo $signature."<br>";


?>