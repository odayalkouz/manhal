<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 5/10/2016
 * Time: 9:10 AM
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}

require_once 'PayPal-PHP-SDK/paypal/rest-api-sdk-php/sample/bootstrap.php';
require_once 'platform/config.php';
require_once 'includes/function.php';
require_once 'includes/language.php';


use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
//
//
//if(isset($_GET['lang']) && $_GET['lang']=="En"){
//    $langURL="lang=En";
//    setcookie("lang","En",time()+COOKIE_EXPIRE,"/");
//    $_SESSION["lang"]="En";
//}elseif(isset($_GET['lang']) && $_GET['lang']=="Ar"){
//    $langURL="lang=Ar";
//    setcookie("lang","Ar",time()+COOKIE_EXPIRE,"/");
//    $_SESSION["lang"]="Ar";
//}else{
//    if(isset($_COOKIE['lang']) && $_COOKIE['lang']=="Ar") {
//        $langURL="lang=Ar";
//        setcookie("lang","Ar",time()+COOKIE_EXPIRE,"/");
//        $_SESSION["lang"]="Ar";
//    }else{
//        $langURL="lang=En";
//        setcookie("lang","En",time()+COOKIE_EXPIRE,"/");
//        $_SESSION["lang"]="En";
//    }
//}
//$Lang = simplexml_load_file("language/".$_SESSION["lang"].".xml");

if(isset($_POST["data"]) && !empty($_POST["data"])) {
    checkout();
}
function checkout(){
    global $Lang;
    global $con;
    $_SESSION["shipping_info"]=json_decode($_POST["data"],true);
    validateCart($_SESSION["shipping_info"]);

    if($_SESSION["shipping_info"]["payment_option"]=="cod"){
        savePaymentToDB("");
    }else{

        doPayment($_SESSION["items"],$_SESSION["payment"]["shipping"],$Lang->DarManhalPayments);
    }
}
function doPayment($items,$shipping=0,$description="Books and Stories"){
    global $lang_code;
    global $apiContext;
// ### Payer
// A resource representing a Payer that funds a payment
// For paypal account payments, set payment method
// to 'paypal'.
    $payer = new Payer();
    $payer->setPaymentMethod("paypal");

// ### Itemized information
// (Optional) Lets you specify item wise
// information
    $itemsArray=array();
    $i=1;
    $totalPrice=0;


    foreach($items as $itemTemp){
        ${"item".$i} = new Item();
        ${"item".$i}->setName($itemTemp["name"])
            ->setCurrency(CURRENCY)
            ->setQuantity($itemTemp["quantity"])
            ->setSku($itemTemp["id"]) // Similar to `item_number` in Classic API
            ->setPrice($itemTemp["price"]);
        $totalPrice+=$itemTemp["price"]*$itemTemp["quantity"];

        array_push($itemsArray,${"item".$i});
        $i++;
    }
//    $item1 = new Item();
//    $item1->setName('Ground Coffee 40 oz')
//        ->setCurrency('USD')
//        ->setQuantity(1)
//        ->setSku("123123") // Similar to `item_number` in Classic API
//        ->setPrice(7.5);
//    $item2 = new Item();
//    $item2->setName('Granola bars')
//        ->setCurrency('USD')
//        ->setQuantity(5)
//        ->setSku("321321") // Similar to `item_number` in Classic API
//        ->setPrice(2);

    $itemList = new ItemList();
    $itemList->setItems($itemsArray);

// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.





    $details = new Details();
    $details->setShipping($_SESSION["payment"]["shipping"])
        ->setTax($_SESSION["payment"]["tax"])
        ->setSubtotal($_SESSION["payment"]["total_price"]);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
    $amount = new Amount();
    $amount->setCurrency(CURRENCY)
        ->setTotal($_SESSION["payment"]["GrandTotal"])
        ->setDetails($details);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
    $InvoiceID=date("Y").date("m").date("d").uniqid();
    $transaction = new Transaction();
    $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription("Books and Stories")
        ->setInvoiceNumber($InvoiceID);

// ### Redirect urls
// Set the urls that the buyer must be redirected to after
// payment approval/ cancellation.

   // $baseUrl = getBaseUrl();
    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl(BaseURL.$lang_code."/ExecutePayment?success=true")
        ->setCancelUrl(BaseURL.$lang_code."/ExecutePayment?success=false");

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
    $payment = new Payment();
    $payment->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions(array($transaction));


// For Sample Purposes Only.
    $request = clone $payment;

// ### Create Payment
// Create a payment by calling the 'create' method
// passing it a valid apiContext.
// (See bootstrap.php for more on `ApiContext`)
// The return object contains the state and the
// url to which the buyer must be redirected to
// for payment approval
    try {
        $payment->create($apiContext);
    } catch (Exception $ex) {
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
        exit(1);
    }

// ### Get redirect url
// The API response provides the url that you must redirect
// the buyer to. Retrieve the url from the $payment->getApprovalLink()
// method
    $approvalUrl = $payment->getApprovalLink();

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    //ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

    header("location:".$approvalUrl);
    exit();
//    return $payment;
}

function payPalMedia($items_list,$type){
    global $lang_code;
    global $con;
    global $Lang;
    global $items;
    $media=$items_list[$type];

    if(count($media)>0){
        $values = array_keys($media);
        $mediaList = implode(',', $values);

        $sql="SELECT * FROM `media` WHERE `id` IN(".$mediaList.")";
        $result=$con->query($sql);

        while($row=mysqli_fetch_assoc($result)){
            if($media[$row["id"]]["qty"]>1){
                $items[]=  array("name"=>$row["title_".$lang_code]." ".$Lang->Online,"quantity"=>$media[$row["id"]]["qty"],"id"=>$type."_".$row['id']."_1","price"=>$row['price']);
            }
        }
    }
}




