<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 25/12/2018
 * Time: 11:22 AM
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
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;


// ### Approval Status
// Determine if the user approved the payment or not
if (isset($_GET['success']) && $_GET['success'] == 'true') {

    // Get the payment Object by passing paymentId
    // payment id was previously stored in session in
    // CreatePaymentUsingPayPal.php
    $paymentId = $_GET['paymentId'];
    $payment = Payment::get($paymentId, $apiContext);

    // ### Payment Execute
    // PaymentExecution object includes information necessary
    // to execute a PayPal account payment.
    // The payer_id is added to the request query parameters
    // when the user is redirected from paypal back to your site
    $execution = new PaymentExecution();
    $execution->setPayerId($_GET['PayerID']);

    // ### Optional Changes to Amount
    // If you wish to update the amount that you wish to charge the customer,
    // based on the shipping address or any other reason, you could
    // do that by passing the transaction object with just `amount` field in it.
    // Here is the example on how we changed the shipping to $1 more than before.
    $transaction = new Transaction();
    $amount = new Amount();
    $details = new Details();

    //$_SESSION['GrandTotal']=$_SESSION['shipping_info']['total']+$_SESSION['shipping_info']['shipping']+$_SESSION['shipping_info']['tax'];
    $amount->setCurrency('USD');
    $amount->setTotal($_SESSION["invoice"]["totalprice"]);

    $transaction->setAmount($amount);

    // Add the above transaction object inside our Execution object.
    $execution->addTransaction($transaction);
    try {
        // Execute the payment
        // (See bootstrap.php for more on `ApiContext`)
        $result = $payment->execute($execution, $apiContext);
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        //ResultPrinter::printResult("Executed Payment", "Payment0", $payment->getId(), $execution, $result);
        try {
            $payment = Payment::get($paymentId, $apiContext);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            ResultPrinter::printError("Get Payment", "Payment1", null, null, $ex);
            exit(1);
        }
    } catch (Exception $ex) {
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        ResultPrinter::printError("Executed Payment", "Payment2", null, null, $ex);
        exit(1);
    }
    $_SESSION["invoice"]["payment_option"]="paypal";
    savePaymentInvoiceToDB($payment);

    // header("location:".SITE_URL.$lang_code."/purchased?success=1");
    exit();
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    //ResultPrinter::printResult("Get Payment", "Payment3", $payment->getId(), null, $payment);



    //return $payment;
}else{
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    header("location:".SITE_URL.$lang_code."/invoice?id=".$_SESSION["invoice"]["id"]);

//    ResultPrinter::printResult("User Cancelled the Approval", null);
    exit;
}


