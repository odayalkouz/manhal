<?php
/**
 * Created by Dar Al-Manhal -Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 2/122/2017
 * Time: 9:43 AM
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}

include_once "platform/config.php";
include_once "includes/function.php";
$msg="";

if(isset($_GET["status"]) && $_GET["status"]!=""){
    if(isset($_GET["signature"]) && $_GET["signature"]!=""){
        if(isset($_GET["service_command"]) && $_GET["service_command"]=="TOKENIZATION"){//Tokenization Response
            if(isset($_GET["status"]) && $_GET["status"]!="00"){
                $data=getPayfortData($_GET);
                $signature=calculateSignature($data,"response");
                if($signature==$_GET["signature"]){
                    if($_GET["status"]==18){
                        $_SESSION["payfort"]["tokenization"]=$_GET;
                        doPaymentCard();
                    }else{
                        $msg="Error_Unexpected_Error_222170955_".$_GET["status"]."_".$_GET["response_message"];
                    }
                }else{
                    $msg="Error_Security_Issue_222170951";
                }
            }else{
                $msg="Error_Unexpected_Error_2802170844_".$_GET["status"]."_".$_GET["response_message"];
            }
        }elseif(isset($_GET["command"]) && $_GET["command"]=="PURCHASE"){//Payment Success Response
            $data=getPayfortData($_GET);
            $signature=calculateSignature($data,"response");
            if($signature==$_GET["signature"]){
                if($_GET["status"]==14){
                    $data=$_SESSION["payfort"];
                    $data["success"]=$_GET;
                    $data=json_encode($data);
                    if(isset($_SESSION["shipping_info"]["subscribe"]) && $_SESSION["shipping_info"]["subscribe"]==1){
                        savePaymentsubscribeToDB($data);
                    }elseif(isset($_SESSION["shipping_info"]["invoice"]) && $_SESSION["shipping_info"]["invoice"]==1){
                        savePaymentInvoiceToDB($data);
                    }else{
                        savePaymentToDB($data);
                    }
                }else{
                    $msg="Error_Unexpected_Error_222170405_".$_GET["status"]."_".$_GET["response_message"];
                }
            }else{
                $msg="Error_Security_Issue_222170404";
            }
        }else{
            $msg="Error_Data_Missing_222170936";
        }
    }else{
        $msg="Error_Data_Missing_222170941";
    }

}else{
    $msg="Error_Data_Missing_222170934";
}
if($msg!=""){
   $id=logError($msg."_3");//location 3
    file_put_contents("payyy.txt",$msg.">>3");
   include_once "includes/header.php";
    echo "<br><br>".$Lang->UnexpectedError."<br>";
    echo $Lang->ErrorNum." ".$id."<br>";
    echo $Lang->PleaseSaveErrorNumToSolve."<br><br>";
   include_once "includes/footer.php";
}

function doPaymentCard(){
    global $Lang;
    global $session_lang;
//    $total_price=$_SESSION["payment"]["items_price"]+$_SESSION["shipping_info"]["shipping"];
//    $total_price+=$_SESSION["shipping_info"]["tax"];
//    $_SESSION['GrandTotal']=$total_price;

    global $con;

    if(isset($_SESSION["lang"]) && $_SESSION["lang"]!=""){
        $lang_code=strtolower($_SESSION["lang"]);
    }else{
        $lang_code="en";
    }
    $_SESSION["shipping_info"]["cart_paymentmethod"]=$_SESSION["shipping_info"]["payment_option"];
    if(isset($_SESSION["user"]["userid"]) && ($_SESSION["user"]["userid"]==2 || $_SESSION["user"]["userid"]==24100 || $_SESSION["user"]["userid"]==24101 || $_SESSION["user"]["userid"]==24102 || $_SESSION["user"]["userid"]==24103)){
        $_SESSION["payment"]["GrandTotal"]=2;
        $_SESSION["shipping_info"]["GrandTotal"]=2;
    }
    if(!isset($_SESSION["shipping_info"]["GrandTotal"]) || $_SESSION["shipping_info"]["GrandTotal"]<1){
        $_SESSION["shipping_info"]["GrandTotal"]=$_SESSION["payment"]["GrandTotal"];
    }

    $postData = array(
        'command' => 'PURCHASE',
        'customer_ip' => $_SESSION["user"]["ip"],
        'remember_me' => "NO",
        'access_code' => Payfort_Access_Code,
        'merchant_identifier' => Payfort_Identifire,
        'merchant_reference' => $_GET["merchant_reference"],
        'amount' => round($_SESSION["shipping_info"]["GrandTotal"]*100),
       //'amount' => 3300,
        'currency' => 'USD',
        'language' =>$lang_code ,
        'customer_email' => $_SESSION["shipping_info"]["cart_email"],
        'token_name' => $_GET["token_name"],
        'payment_option' => $_SESSION["shipping_info"]["payment_option"],
        'return_url' => SITE_URL.'en/payment',
        'device_fingerprint' => $_SESSION["shipping_info"]["device_fingerprint"]
    );
    $postData['signature']=calculateSignature($postData,"request");


// Setup cURL
    $ch = curl_init(Payfort_Pay_URL);
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
        $id=logError("1");//location :1
        file_put_contents("payyy.txt",">>1");
        echo "<br><br>".$Lang->UnexpectedError."<br>";
        echo $Lang->ErrorNum." ".$id."<br>";
        echo $Lang->PleaseSaveErrorNumToSolve."<br><br>";
        die(curl_error($ch));
    }else{
        $responseData = json_decode($response, TRUE);

        if(isset($responseData["status"]) && $responseData["status"]!=""){
            if(isset($responseData["signature"]) && $responseData["signature"]!=""){
                if(isset($responseData["command"]) && $responseData["command"]=="PURCHASE"){
                    $data=getPayfortData($responseData);
                    $signature=calculateSignature($data,"response");
                    if($signature==$responseData["signature"]){
                        if($responseData["customer_ip"]==$_SESSION["user"]["ip"]){
                            $_SESSION["payfort"]["purchase"]=$responseData;
                            if($responseData["status"]==20){//3-D Secur => redirect user
                                $sql="INSERT INTO `payment_temp`(`id`, `payment_ref`, `data`, `status`) VALUES ('','".$_GET["merchant_reference"]."','".mysqli_real_escape_string($con,json_encode($_SESSION))."',0)";
                                if($con->query($sql)){
                                    header("location:".$responseData["3ds_url"]);
                                    exit();
                                }else{
                                    file_put_contents("pay_sql.txt",$sql);
                                    $msg="Error_Unexpected_Error_0203170903";
                                }
                            }else{
                                $msg="Error_Unexpected_Error_222170341_".$_GET["status"]."_".$_GET["response_message"];
                            }
                        }else{
                            $msg="Error_Security_Issue_222170321<br>User IP = ".$_SESSION["user"]["ip"]."<br>response IP =".$responseData["customer_ip"];
                        }
                    }else{
                        $msg="Error_Security_Issue_222170322";
                    }
                }else{
                    $msg="Error_Data_Missing_222170324";
                }
            }else{
                $msg="Error_Data_Missing_222170325";
            }

        }else{
            $msg="Error_Data_Missing_222170326";
        }
    }
    if($msg!=""){
        $id=logError("2");//location 2
        include_once "includes/header.php";
        echo "<br><br>".$Lang->UnexpectedError."<br>";
        echo $Lang->ErrorNum." ".$id."<br>";
        echo $Lang->PleaseSaveErrorNumToSolve."<br><br>";
        file_put_contents("payyy.txt",$msg.">>2");
        include_once "includes/footer.php";
    }
}

//Array (
//    [amount] => 5000
//[response_code] => 14000
//[card_number] => 512345******2346
//[signature] => 5b58c01a4909af6b27f2fafc390b2e1b44cbad79af72d970707c330d16de795c
//[merchant_identifier] => OjXrZdgn
//[expiry_date] => 1705
//[order_description] => Books payments
//[access_code] => 4yosctTk1BwEN9WMXObm
//[payment_option] => MASTERCARD
//[customer_ip] => 162.144.51.202
//[language] => en
//[eci] => ECOMMERCE
//[fort_id] => 148777149800048544
//[command] => PURCHASE
//[response_message] => Success
//[authorization_code] => 083258
//[merchant_reference] => ref0014
//[customer_email] => hussam@manhal.com
//[token_name] => Tok129
//[currency] => USD
//[customer_name] => Hussam Abu Khadijeh
//[status] => 14 )
//
//Array (
//    [amount] => 5000
//[response_code] => 20064
//[card_number] => 512345******2346
//[signature] => 9765ed3b6c2753b342c365b5c2ac2a3b37d7b2f99e1d38c454957dcbb3766c8d
//[merchant_identifier] => OjXrZdgn
//[expiry_date] => 1705
//[order_description] => Books payments
//[access_code] => 4yosctTk1BwEN9WMXObm
//[payment_option] => MASTERCARD
//[customer_ip] => 162.144.51.202
//[language] => en [eci] => ECOMMERCE
//[fort_id] => 148776901600048411
//[command] => PURCHASE
//[3ds_url] => https://testfort.payfort.com/secure3dsSimulator?FORTSESSIONID=iqgnlc6d7vib1l6l3n074pf701&paymentId=5740559166725965820&DOID=C70BAA4D83511CCADAEC071226C925FB&o=pt&action=retry
//[response_message] => 3-D Secure check requested
//[merchant_reference] => ref0013
//[customer_email] => hussam@manhal.com
//[token_name] => Tok129
//[currency] => USD
//[customer_name] => Hussam Abu Khadijeh
//[status] => 20 )
//
//
//Array (
//    [response_code] => 18063
//[card_number] => 400555******0001
//[signature] => eb70d33b78c4ce91ee65a3bfee2dde6bc675135ad8735762482e09f671bca039
//[merchant_identifier] => OjXrZdgn
//[expiry_date] => 1705
//[access_code] => 4yosctTk1BwEN9WMXObm
//[language] => en
//[service_command] => TOKENIZATION
//[response_message] => Token has been updated
//[merchant_reference] => ref0011
//[token_name] => Tok129
//[return_url] => https://www.manhal.com/payfort/response.php
//[card_bin] => 400555
//[status] => 18
//)



?>

