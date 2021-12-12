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
require_once 'includes/language.php';


use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;


if(isset($_GET['lang']) && $_GET['lang']=="En"){
    $langURL="lang=En";
    setcookie("lang","En");
    $_SESSION["lang"]="En";
}elseif(isset($_GET['lang']) && $_GET['lang']=="Ar"){
    $langURL="lang=Ar";
    setcookie("lang","Ar");
    $_SESSION["lang"]="Ar";
}else{
    if(isset($_COOKIE['lang']) && $_COOKIE['lang']=="Ar") {
        $langURL="lang=Ar";
        setcookie("lang","Ar");
        $_SESSION["lang"]="Ar";
    }else{
        $langURL="lang=En";
        setcookie("lang","En");
        $_SESSION["lang"]="En";
    }
}
$Lang = simplexml_load_file("language/".$_SESSION["lang"].".xml");

if(isset($_POST["data"]) && !empty($_POST["data"])) {
    checkout();
}
function checkout(){

    global $Lang;
    global $con;
    $items_list=json_decode($_POST["data"],true);
    $books=$items_list["book"];
    $items=[];

    if(count($books)>0){
        $values = array_keys($books);
        $booksList = implode(',', $values);

        $sql="SELECT * FROM `books` WHERE `bookid` IN(".$booksList.")";
        $result=$con->query($sql);

        while($row=mysqli_fetch_assoc($result)){
            if($books[$row["bookid"]]["qty"]>1 && ($books[$row["bookid"]]["type"]==1 || $books[$row["bookid"]]["type"]==3 || $books[$row["bookid"]]["type"]==5 || $books[$row["bookid"]]["type"]==7)){
                $items[]=  array("name"=>$row["name"]." ".$Lang->PaperCopy,"quantity"=>$books[$row["bookid"]]["qty"],"id"=>"book_".$row['bookid']."_1","price"=>$row['price']);
                $books[$row["bookid"]]["type"]-=1;
            }
            switch($books[$row["bookid"]]["type"]){
                case 1:
                    $name=" ".$Lang->PaperCopy;
                    $price=$row['price'];
                    break;
                case 2:
                    $name=" ".$Lang->ElectronicCopy;
                    $price=$row['eprice'];
                    break;
                case 3:
                    $name=" ".$Lang->PaperCopy." - ".$Lang->ElectronicCopy;
                    $price=$row['price']+$row['eprice'];
                    break;
                case 4:
                    $name=" ".$Lang->EnrichmentCopy;
                    $price=$row['iprice'];
                    break;
                case 5:
                    $name=" ".$Lang->PaperCopy." - ".$Lang->EnrichmentCopy;
                    $price=$row['price']+$row['iprice'];
                    break;
                case 6:
                    $name=" ".$Lang->ElectronicCopy." - ".$Lang->EnrichmentCopy;
                    $price=$row['eprice']+$row['iprice'];
                    break;
                case 7:
                    $name=" ".$Lang->PaperCopy." - ".$Lang->ElectronicCopy." - ".$Lang->EnrichmentCopy;
                    $price=$row['price']+$row['eprice']+$row['iprice'];
                    break;
            }
            if($books[$row["bookid"]]["type"]>0){
                $items[]=  array("name"=>$row["name"].$name,"quantity"=>1,"id"=>$row['isbn'],"price"=>$price);
            }

        }
    }

    ///get stories Info
    $stories=$items_list["story"];
    $values = array_keys($stories);

    if(count($stories)>0){
        $storiesList = implode(',', $values);
        $sql="SELECT * FROM `story` WHERE `storyid` IN(".$storiesList.")";
        $result=$con->query($sql);
        $items=[];
        while($row=mysqli_fetch_assoc($result)){
            if($stories[$row["bookid"]]["qty"]>1 && ($stories[$row["bookid"]]["type"]==1 || $stories[$row["bookid"]]["type"]==3 || $stories[$row["bookid"]]["type"]==5 || $stories[$row["bookid"]]["type"]==7)){
                $items[]=  array("name"=>$row["name"]." ".$Lang->PaperCopy,"quantity"=>$stories[$row["bookid"]]["qty"],"id"=>"book_".$row['bookid']."_1","price"=>$row['price']);
                $stories[$row["bookid"]]["type"]-=1;
            }
            switch($stories[$row["storyid"]]["type"]){
                case 1:
                    $name=" ".$Lang->PaperCopy;
                    $price=$row['price'];
                    break;
                case 2:
                    $name=" ".$Lang->ElectronicCopy;
                    $price=$row['eprice'];
                    break;
                case 3:
                    $name=" ".$Lang->PaperCopy." - ".$Lang->ElectronicCopy;
                    $price=$row['price']+$row['eprice'];
                    break;
                case 4:
                    $name=" ".$Lang->EnrichmentCopy;
                    $price=$row['iprice'];
                    break;
                case 5:
                    $name=" ".$Lang->PaperCopy." - ".$Lang->EnrichmentCopy;
                    $price=$row['price']+$row['iprice'];
                    break;
                case 6:
                    $name=" ".$Lang->ElectronicCopy." - ".$Lang->EnrichmentCopy;
                    $price=$row['eprice']+$row['iprice'];
                    break;
                case 7:
                    $name=" ".$Lang->PaperCopy." - ".$Lang->ElectronicCopy." - ".$Lang->EnrichmentCopy;
                    $price=$row['price']+$row['eprice']+$row['iprice'];
                    break;
            }
            if($stories[$row["bookid"]]["type"]>0){
                $items[]=  array("name"=>$row["name"].$name,"quantity"=>1,"id"=>"story_".$row['storyid']."_".$stories[$row["storyid"]]["type"],"price"=>$price);
            }
        }
    }

    $_SESSION["items"]=$items;
    $_SESSION["shipping_info"]=$_POST;
    if(!isset($_SESSION["shipping"])){
        $_SESSION["shipping"]=0;
    }
    if($_POST["cart_paymentmethod"]=="cod"){
        savePaymentToDB("");
    }else{
        $re=doPayment($items,$_SESSION["shipping"],$Lang->DarManhalPayments);
    }

}


function doPayment($items,$shipping=0,$description=""){

    global  $apiContext;
    $payer = new Payer();
    $payer->setPaymentMethod("paypal");

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

    $itemList = new ItemList();
    $itemList->setItems($itemsArray);

    $tax=$totalPrice*TAX;
    $_SESSION['payment']['tax']=$tax;
    $_SESSION['payment']['shipping']=$shipping;
    $_SESSION['payment']['subtotle']=$totalPrice;

    $details = new Details();
    $details->setShipping($shipping)
        ->setTax($tax)
        ->setSubtotal($totalPrice);

    $amount = new Amount();
    $amount->setCurrency(CURRENCY)
        ->setTotal($totalPrice+$shipping+$tax)
        ->setDetails($details);

    $InvoiceID=date("Y").date("m").date("d").uniqid();
    $transaction = new Transaction();
    $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription("Payment description")
        ->setInvoiceNumber($InvoiceID);


//    $transaction = new Transaction();
//$transaction->setAmount($amount)
//    ->setItemList($itemList)
//    ->setDescription("Payment description")
//    ->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl("http://www.manhal.com/en/ExecutePayment?success=true")
        ->setCancelUrl("http://www.manhal.com/en/ExecutePayment?success=false");


$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));
$request = clone $payment;

    try {
        $payment->create($apiContext);
    } catch (Exception $ex) {
    ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
    exit(1);
}

$approvalUrl = $payment->getApprovalLink();
 ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

}
function doPayment1($items,$shipping=0,$description=""){

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

    $tax=$totalPrice*TAX;
    $_SESSION['payment']['tax']=$tax;
    $_SESSION['payment']['shipping']=$shipping;
    $_SESSION['payment']['subtotle']=$totalPrice;

    $details = new Details();
    $details->setShipping($shipping)
        ->setTax($tax)
        ->setSubtotal($totalPrice);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
    $amount = new Amount();
    $amount->setCurrency(CURRENCY)
        ->setTotal($totalPrice+$shipping+$tax)
        ->setDetails($details);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
    $InvoiceID=date("Y").date("m").date("d").uniqid();
    $transaction = new Transaction();
    $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription($description)
        ->setInvoiceNumber($InvoiceID);

// ### Redirect urls
// Set the urls that the buyer must be redirected to after
// payment approval/ cancellation.

    // $baseUrl = getBaseUrl();
    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl(BaseURL."ExecutePayment?success=true")
        ->setCancelUrl(BaseURL."ExecutePayment?success=false");

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



