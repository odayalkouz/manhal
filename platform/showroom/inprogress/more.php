<?php
include_once '../includes/functions.php';
$MoreInformation=$prosses->GetMoreInformationCompletedOrder();
function issetMoreInformation($par){
    global $MoreInformation;
    $reteurnval=0;
    if(isset($MoreInformation[$par])&&$MoreInformation[$par]!=''){
        $reteurnval=$MoreInformation[$par];
    }
    return $reteurnval;
}
$paymentid=issetMoreInformation('paymentid');
$userid=issetMoreInformation('userid');
$total_price=issetMoreInformation('total_price');
$Address1=issetMoreInformation('Address1');
$telephone=issetMoreInformation('telephone');
$payment_date=issetMoreInformation('payment_date');
$shippingprice=issetMoreInformation('shippingprice');
$StateProvince=issetMoreInformation('StateProvince');
$shipping=issetMoreInformation('shipping');
$Postcode=issetMoreInformation('Postcode');
$products_price=issetMoreInformation('products_price');
$City=issetMoreInformation('City');
$Country=issetMoreInformation('Country');
$shipping_close_date=issetMoreInformation('shipping_close_date');
$confirmed_by=issetMoreInformation('confirmed_by');
$RecieverCompanyName=issetMoreInformation('RecieverCompanyName');
$RecieverAttention=issetMoreInformation('RecieverAttention');
$Weight=issetMoreInformation('Weight');
$Phone=issetMoreInformation('Phone');
$Refrence=issetMoreInformation('Refrence');
$Contents=issetMoreInformation('Contents');
$DeclaredValue=issetMoreInformation('DeclaredValue');
$Productcode=issetMoreInformation('Productcode');
$Countrycode=issetMoreInformation('Countrycode');
$fax=issetMoreInformation('fax');
$manhal_ref=issetMoreInformation('manhal_ref');
$billing_fullname=issetMoreInformation('billing_fullname');
$billing_email=issetMoreInformation('billing_email');
$billing_mobile=issetMoreInformation('billing_mobile');
$billing_telephone=issetMoreInformation('billing_telephone');
$billing_fax=issetMoreInformation('billing_fax');
$billing_country=issetMoreInformation('billing_country');
$billing_city=issetMoreInformation('billing_city');
$billing_state=issetMoreInformation('billing_state');
$billing_zipcode=issetMoreInformation('billing_zipcode');
$billing_address1=issetMoreInformation('billing_address1');
$billing_address2=issetMoreInformation('billing_address2');
$tax=issetMoreInformation('tax');
$cod=issetMoreInformation('cod');
?>
<div class="card"style="box-shadow: none;">
    <div class="card-header" style="margin-bottom: 0">
        <ul class="nav nav-justified">
            <li class="nav-item"><a data-toggle="tab" href="#tab-eg7-0" class="active nav-link"><?=$prosses->getlang('Order_information');?></a></li>
            <li class="nav-item"><a data-toggle="tab" href="#tab-eg7-1" class="nav-link"><?=$prosses->getlang('Billing_address');?></a></li>
            <li class="nav-item"><a data-toggle="tab" href="#tab-eg7-2" class="nav-link"><?=$prosses->getlang('Shipping_address');?></a></li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active" id="tab-eg7-0" role="tabpanel">
                <div class="row">
                    <div class="col-md-6 col-sm-12">

                        <ul class="list-group list-group-flush">
                            <li class="disabled list-group-item pupups"><?=$prosses->getlang('OrderID');?> :<label><?=$paymentid?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('TotalPrice');?> :<label><?=$total_price?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('Custumer');?> :<label><?=$billing_fullname?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('Address');?> :<label><?=$Address1?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('Mobile');?> :<label><?=$telephone?> / <?=$Phone?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('Country');?> :<label><?=$Country?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('City');?> :<label><?=$City?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('shipping_close_date');?> :<label><?=$shipping_close_date?></label></li>

                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item pupups"><?=$prosses->getlang('orderdate');?> :<label><?=$payment_date?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('ShippingPrice');?> :<label><?=$products_price?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('destination');?> :<label><?=$StateProvince?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('Weight');?> :<label><?=$Weight?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('shipping');?> :<label><?=$shipping?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('PostCode');?> :<label><?=$Postcode?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('confirmed_by');?> :<label><?=$confirmed_by?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('manhal_ref');?> :<label><?=$manhal_ref?></label></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab-eg7-1" role="tabpanel">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <ul class="list-group list-group-flush">
                            <li class="disabled list-group-item pupups"><?=$prosses->getlang('billing_fullname');?> :<label><?=$billing_fullname?></label></li>
                            <li class="disabled list-group-item pupups"><?=$prosses->getlang('billing_mobile');?> :<label><?=$billing_telephone?> / <?=$billing_mobile?></label></li>
                            <li class="disabled list-group-item pupups"><?=$prosses->getlang('billing_city');?> :<label><?=$billing_city?></label></li>
                            <li class="disabled list-group-item pupups"><?=$prosses->getlang('billing_zipcode');?> :<label><?=$billing_zipcode?></label></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item pupups"><?=$prosses->getlang('billing_email');?> :<label><?=$billing_email?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('billing_country');?> :<label><?=$billing_country?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('billing_state');?> :<label><?=$billing_state?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('billing_address1');?> :<label><?=$billing_address1?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('Code');?> :<label><?=$cod?></label></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab-eg7-2" role="tabpanel">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item pupups"><?=$prosses->getlang('Refrence');?> :<label><?=$Refrence?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('Contents');?> :<label><?=$Contents?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('DeclaredValue');?> :<label><?=$DeclaredValue?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('fax');?> :<label><?=$fax?></label></li>

                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item pupups"><?=$prosses->getlang('RecieverCompany');?> :<label><?=$RecieverCompanyName?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('Productcode');?> :<label><?=$DeclaredValue?></label></li>
                            <li class="list-group-item pupups"><?=$prosses->getlang('Countrycode');?> :<label><?=$Countrycode?></label></li>
                            <li class="disabled list-group-item pupups"><?=$prosses->getlang('Tax');?> :<label><?=$tax?></label></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

