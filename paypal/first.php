<?php
// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
require __DIR__  . '/PayPal-PHP-SDK/autoload.php';
// 2. Provide your Secret Key. Replace the given one with your app clientId, and Secret
// https://developer.paypal.com/webapps/developer/applications/myapps

$apiContext = new \PayPal\Api\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'Ae52VSswu8dDZH2e2Nwcg3TP17oYSNb9mZBZM_RdZu1IW4nfVtAVL5aKWZ6Df5on-QsevbBQbcaURrNm',     // ClientID
        'EI6n-68aNOmVDQYLt471d3_jl-rnQPg0zJHRw2r7HAtcUPi_0bvHyBYZ2POg7uLVNgwsHOW-sbaxIqQx'      // ClientSecret
    )
);
$apiContext->setConfig(
//    array('mode' => 'live')
    array('mode' => 'sandbox')
);
// 3. Lets try to save a credit card to Vault using Vault API mentioned here
// https://developer.paypal.com/webapps/developer/docs/api/#store-a-credit-card
$creditCard = new \PayPal\Api\CreditCard();
$creditCard->setType("visa")
    ->setNumber("4417119669820331")
    ->setExpireMonth("11")
    ->setExpireYear("2019")
    ->setCvv2("012")
    ->setFirstName("Joe")
    ->setLastName("Shopper");
// 4. Make a Create Call and Print the Card
try {
    $creditCard->create($apiContext);
    echo $creditCard;
}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
}