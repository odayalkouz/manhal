<?php




if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("../config.php");
if(isset($_POST['TypeProcesses']) && $_POST['TypeProcesses']!="") {
    eval($_POST['TypeProcesses'] . "();");
}

$MailTo='khalid.bilbisi@gmail.com';
function Feedback(){
    global $MailTo;
    $date = date('d/m/Y');
    $time = date('H:i:s');
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $emailbody = "<p>You have recieved a new message from the enquiries form on your website.</p>
                  <p><strong>Name: </strong> {$_POST['name']} </p>
                  <p><strong>Email Address: </strong> {$_POST['email']} </p>
                  <p><strong>Type: </strong> {$_POST['type']} </p>
                  <p><strong>Message: </strong> {$_POST['message']} </p>
                  <p>This message was sent from the IP Address: {$ipaddress} on {$date} at {$time}</p>";
    $to = $MailTo;
    $from = $_POST['email'];
    $reply = $_POST['email'];
    $subject=$_POST['type'];
    $headers = "From: $from\n";
    $headers .= "Reply-To: $reply\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    @mail($to, $subject, $emailbody, $headers);
    echo 'sendmailFeedback';
}
function addSubscribing(){
    global $con;
    $email= $_POST['email'];
    $sql = "select Count(email) As count from subscribe where `email`='" . $email."'" ;
    $result = $con->query($sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['count'] == 0) {
        $date = date("Y/m/d H:i:s", time());
        $sqlinsert = "INSERT INTO `subscribe`(`id`, `email`, `date`) VALUES (null,'".$email."','".$date."')";
        if ($con->query($sqlinsert) === TRUE) {
            echo 'registeredemail';
        }else{
            echo 'errorregisteredemail';
        }
    } else {
        echo 'emailalready';
    }
}
//first khalid 4-9-2016
function decreasIncreaseItem($itemType,$type,$id){
    global $con;
    switch($itemType){
        case "book":
            $sql="UPDATE `books` set `favorites`=`favorites`".$type."1 WHERE `bookid`=".$id;
            break;
        case "story":
            $sql="UPDATE `story` set `favorite_count`=`favorite_count`".$type."1 WHERE `storyid`=".$id;
            break;
        case "toy":
            $sql="UPDATE `products` set `favorite_count`=`favorite_count`".$type."1 WHERE `productid`=".$id;//added by Hussam 18-050-2020 ---covid 19
            break;
        case "games":
            $sql="UPDATE `media` set `favorites`=`favorites`".$type."1 WHERE type=11 and  `id`=".$id;
            break;
        case "worksheet":
            $sql="UPDATE `media` set `favorites`=`favorites`".$type."1 WHERE type=0 and  `id`=".$id;
            break;
        case "video":
            $sql="UPDATE `media` set `favorites`=`favorites`".$type."1 WHERE type=4 and  `id`=".$id;
            break;
        case "audio":
            $sql="UPDATE `media` set `favorites`=`favorites`".$type."1 WHERE type=3 and  `id`=".$id;
            break;
    }
    $con->query($sql);
}
function downloadworksheet(){
    global $con;
    if(!isset($_SESSION["user"]) || empty($_SESSION["user"])){
        echo -1;
    }else{
        $sql = "UPDATE `media` SET `download`=`download`+1 WHERE `id`=".$_POST['id'];
        $result = $con->query($sql);
        echo 'downloadworksheet';
    }
}
//end khalid 4-9-2016
function settofavorit(){
    global $con;
    if(!isset($_SESSION["user"]) || empty($_SESSION["user"])){
        echo -1;
    }else{
        $sql = "Select   count(wishs.userid) as count From   wishs where wishs.userid='" . $_SESSION["user"]['userid'] . "' and wishs.bookid=".$_POST['id']." and wishs.type='".$_POST['type']."' ";
        $result = $con->query($sql);
        $row = mysqli_fetch_assoc($result);
        if ($row['count'] > 0) {
            $sqldelete="DELETE FROM `wishs` WHERE `userid`='" . $_SESSION["user"]['userid'] . "' and `bookid`=".$_POST['id']." and type='".$_POST['type']."' ";
            if ($con->query($sqldelete) === TRUE) {
                decreasIncreaseItem($_POST['type'],"-",$_POST['id']);
                echo 'deletefavorit';
            }else{
                echo 'errordeletefavorit';
            }
        }else{
            $date = date("Y/m/d H:i:s", time());
            $sqlinsert = "INSERT INTO `wishs`(`userid`, `bookid`, `wish_date`, `type`) VALUES ('" . $_SESSION["user"]['userid'] . "',".$_POST['id'].",'".$date."','".$_POST['type']."' )";
            if ($con->query($sqlinsert) === TRUE) {
                decreasIncreaseItem($_POST['type'],"+",$_POST['id']);
                echo 'addfavorit';
            }else{
                echo 'erroraddfavorit';
            }
        }
    }

}


function settorating(){
    global $con;
    $sql = "Select   count(userid) as count From   rating where userid='" . $_SESSION["user"]['userid'] . "' and bookid=".$_POST['id']." ";
    $result = $con->query($sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['count'] == 0) {
        $date = date("Y/m/d H:i:s", time());
        $sqlinsert = "INSERT INTO `rating`(`ratingid`, `userid`, `bookid`, `rating`, `date`) VALUES (null,'" . $_SESSION["user"]['userid'] . "',".$_POST['id'].",".$_POST['rating'].",'".$date."')";
        if ($con->query($sqlinsert) === TRUE) {
            echo 'addrating';
        }else{
            echo 'erroraddrating';
        }
    }
}
function Addacomment(){
    global $con;
    $date = date("Y/m/d H:i:s", time());

    $sql = "INSERT INTO `comments`(`idcomments`, `userid`,`comment`, `prodectid`, `date`, `state`, `type`) VALUES (null,'" . $_SESSION["user"]['userid'] . "','".$_POST['comment']."','".$_POST['id']."','".$date."','0','".$_POST['type']."')";

    if ($con->query($sql) === TRUE) {

        $sql = "SELECT comments.*,users.* FROM comments Inner Join   users On comments.userid = users.userid WHERE `prodectid`=".$_POST['id']." ";
        $result = $con->query($sql);
        $array=[];
        $i=0;
           while ($row = mysqli_fetch_assoc($result)) {
            $array[$i]=$row;
               $i++;
        }
        echo json_encode($array);
    }else{
        echo 'errorAddacomment';
    }
}
function updateDiscussionsAnswer(){
    global $con;
    $sql = "UPDATE `q_comment` SET `comment`='".mysqli_real_escape_string($con,$_POST['txt'] )."' WHERE `id`=".$_POST['id'];

    if ($con->query($sql) === TRUE) {
        echo 'updateDiscussionsAnswer';
    }else{
        echo 'error';
    }
}
function CloseStock(){
    global $con;
    $date = date("Y/m/d H:i:s", time());
    $sql = "SELECT `store_close_user` as count FROM `payments` WHERE `paymentid`=".$_POST['id']." and `store_close_user`=-1";
    $result = $con->query($sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['count'] == -1) {
        $date = date("Y/m/d H:i:s", time());
        if(isset($_POST['cartons']) || is_array($_POST['cartons'])){
            if($_POST['cartons']!=null) {
                for ($i = 1; $i <= count($_POST['cartons']); $i++) {
                    $chsql = "SELECT * FROM `pkt` WHERE `idpayment`='" . $_POST['id'] . "' AND `cartons`='" . $i . "' ";
                    $chresult = $con->query($chsql);
                    if (mysqli_num_rows($chresult) < 1) {
                        $sql = "INSERT INTO `pkt`(`id`, `idpayment`, `cartons`, `weightcartons`) VALUES ('','" . $_POST['id'] . "','" . $i . "','" . $_POST['cartons'][$i - 1] . "')";
                        $con->query($sql);
                    }
                }
            }}

        if(isset($_POST['prodects']) || is_array($_POST['prodects'])){
            if($_POST['prodects']!=null) {
                for ($i = 0; $i < count($_POST['prodects']); $i++) {
                    $chsql = "SELECT * FROM `cartoons` WHERE `idpayments`='" . $_POST['id'] . "' AND `idprodect`='" .  $_POST['prodects'][$i]['id'] . "' AND `prodecttype`='" .  $_POST['prodects'][$i]['type'] . "' AND `carton`='" .  $_POST['prodects'][$i]['Carton'] . "' ";
                    $chresult = $con->query($chsql);
                    if (mysqli_num_rows($chresult) < 1) {
                        $sql = "INSERT INTO `cartoons`(`id`, `idpayments`, `quantity`, `idprodect`, `prodecttype`, `carton`) VALUES ('','" . $_POST['id'] . "','" . $_POST['prodects'][$i]['Quantity'] . "','" . $_POST['prodects'][$i]['id'] . "','" . $_POST['prodects'][$i]['type'] . "','" . $_POST['prodects'][$i]['Carton'] . "')";
                        $con->query($sql);
                    }
                }
            }}


        $sql = "UPDATE `payments` SET `store_close_user`='" . $_SESSION["user"]['userid'] . "',`store_close_date`='".$date."' WHERE `paymentid`='".$_POST['id']."'";

        if ($con->query($sql) === TRUE) {
            echo 'close';
        }else{
            echo 'error';
        }
    }else{
        echo 'oldclose';
    }
}
function ReserveShipping(){
    global $con;


        $date = date("Y/m/d H:i:s", time());
        $sql = "UPDATE `payments` SET `exported`='2' WHERE `paymentid`='".$_POST['id']."'";

        if ($con->query($sql) === TRUE) {
            echo 'close';
        }else{
            echo 'error';
        }

}
function shipToAramex($payment){
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	$soapClient = new SoapClient('Shipping.wsdl');
	echo '<pre>';
	print_r($soapClient->__getFunctions());

	$params = array(
        'Shipments' => array(
            'Shipment' => array(
                'Shipper'	=> array(
                    'Reference1' 	=> 'Ref 111111',
                    'Reference2' 	=> 'Ref 222222',
                    'AccountNumber' => '20016',
                    'PartyAddress'	=> array(
                        'Line1'					=> 'Mecca St',
                        'Line2' 				=> '',
                        'Line3' 				=> '',
                        'City'					=> 'Amman',
                        'StateOrProvinceCode'	=> '',
                        'PostCode'				=> '',
                        'CountryCode'			=> 'Jo'
                    ),
                    'Contact'		=> array(
                        'Department'			=> '',
                        'PersonName'			=> 'Michael',
                        'Title'					=> '',
                        'CompanyName'			=> 'Aramex',
                        'PhoneNumber1'			=> '5555555',
                        'PhoneNumber1Ext'		=> '125',
                        'PhoneNumber2'			=> '',
                        'PhoneNumber2Ext'		=> '',
                        'FaxNumber'				=> '',
                        'CellPhone'				=> '07777777',
                        'EmailAddress'			=> 'michael@aramex.com',
                        'Type'					=> ''
                    ),
                ),

                'Consignee'	=> array(
                    'Reference1'	=> 'Ref 333333',
                    'Reference2'	=> 'Ref 444444',
                    'AccountNumber' => '',
                    'PartyAddress'	=> array(
                        'Line1'					=> '15 ABC St',
                        'Line2'					=> '',
                        'Line3'					=> '',
                        'City'					=> 'Dubai',
                        'StateOrProvinceCode'	=> '',
                        'PostCode'				=> '',
                        'CountryCode'			=> 'AE'
                    ),

                    'Contact'		=> array(
                        'Department'			=> '',
                        'PersonName'			=> 'Mazen',
                        'Title'					=> '',
                        'CompanyName'			=> 'Aramex',
                        'PhoneNumber1'			=> '6666666',
                        'PhoneNumber1Ext'		=> '155',
                        'PhoneNumber2'			=> '',
                        'PhoneNumber2Ext'		=> '',
                        'FaxNumber'				=> '',
                        'CellPhone'				=> '',
                        'EmailAddress'			=> 'mazen@aramex.com',
                        'Type'					=> ''
                    ),
                ),

                'ThirdParty' => array(
                    'Reference1' 	=> '',
                    'Reference2' 	=> '',
                    'AccountNumber' => '',
                    'PartyAddress'	=> array(
                        'Line1'					=> '',
                        'Line2'					=> '',
                        'Line3'					=> '',
                        'City'					=> '',
                        'StateOrProvinceCode'	=> '',
                        'PostCode'				=> '',
                        'CountryCode'			=> ''
                    ),
                    'Contact'		=> array(
                        'Department'			=> '',
                        'PersonName'			=> '',
                        'Title'					=> '',
                        'CompanyName'			=> '',
                        'PhoneNumber1'			=> '',
                        'PhoneNumber1Ext'		=> '',
                        'PhoneNumber2'			=> '',
                        'PhoneNumber2Ext'		=> '',
                        'FaxNumber'				=> '',
                        'CellPhone'				=> '',
                        'EmailAddress'			=> '',
                        'Type'					=> ''
                    ),
                ),

                'Reference1' 				=> 'Shpt 0001',
                'Reference2' 				=> '',
                'Reference3' 				=> '',
                'ForeignHAWB'				=> 'ABC 000111',
                'TransportType'				=> 0,
                'ShippingDateTime' 			=> time(),
                'DueDate'					=> time(),
                'PickupLocation'			=> 'Reception',
                'PickupGUID'				=> '',
                'Comments'					=> 'Shpt 0001',
                'AccountingInstrcutions' 	=> '',
                'OperationsInstructions'	=> '',

                'Details' => array(
                    'Dimensions' => array(
                        'Length'				=> 10,
                        'Width'					=> 10,
                        'Height'				=> 10,
                        'Unit'					=> 'cm',

                    ),

                    'ActualWeight' => array(
                        'Value'					=> 0.5,
                        'Unit'					=> 'Kg'
                    ),

                    'ProductGroup' 			=> 'EXP',
                    'ProductType'			=> 'PDX',
                    'PaymentType'			=> 'P',
                    'PaymentOptions' 		=> '',
                    'Services'				=> '',
                    'NumberOfPieces'		=> 1,
                    'DescriptionOfGoods' 	=> 'Docs',
                    'GoodsOriginCountry' 	=> 'Jo',

                    'CashOnDeliveryAmount' 	=> array(
                        'Value'					=> 0,
                        'CurrencyCode'			=> ''
                    ),

                    'InsuranceAmount'		=> array(
                        'Value'					=> 0,
                        'CurrencyCode'			=> ''
                    ),

                    'CollectAmount'			=> array(
                        'Value'					=> 0,
                        'CurrencyCode'			=> ''
                    ),

                    'CashAdditionalAmount'	=> array(
                        'Value'					=> 0,
                        'CurrencyCode'			=> ''
                    ),

                    'CashAdditionalAmountDescription' => '',

                    'CustomsValueAmount' => array(
                        'Value'					=> 0,
                        'CurrencyCode'			=> ''
                    ),

                    'Items' 				=> array(

                    )
                ),
            ),
        ),

        'ClientInfo'  			=> array(
            'AccountCountryCode'	=> 'JO',
            'AccountEntity'		 	=> 'AMM',
            'AccountNumber'		 	=> '20016',
            'AccountPin'		 	=> '221321',
            'UserName'			 	=> 'reem@reem.com',
            'Password'			 	=> '123456789',
            'Version'			 	=> '1.0'
        ),

        'Transaction' 			=> array(
            'Reference1'			=> '001',
            'Reference2'			=> '',
            'Reference3'			=> '',
            'Reference4'			=> '',
            'Reference5'			=> '',
        ),
        'LabelInfo'				=> array(
            'ReportID' 				=> 9201,
            'ReportType'			=> 'URL',
        ),
    );

	$params['Shipments']['Shipment']['Details']['Items'][] = array(
        'PackageType' 	=> 'Box',
        'Quantity'		=> 1,
        'Weight'		=> array(
            'Value'		=> 0.5,
            'Unit'		=> 'Kg',
        ),
        'Comments'		=> 'Docs',
        'Reference'		=> ''
    );

	print_r($params);

	try {
        $auth_call = $soapClient->CreateShipments($params);
        echo '<pre>';
        print_r($auth_call);
        die();
    } catch (SoapFault $fault) {
        die('Error : ' . $fault->faultstring);
    }

}

function CloseShipping(){
    global $con;

    $sql="SELECT `shipping` FROM `payments` WHERE `paymentid`=".$_POST['id'];
    $result=$con->query($sql);
    $row=mysqli_fetch_assoc($result);
    if($row["shipping"]=="ARAMEX"){
        //shipToAramex();
    }

    $date = date("Y/m/d H:i:s", time());
    $sql = "SELECT `shipping_close_user` as count FROM `payments` WHERE `paymentid`=".$_POST['id']." and `shipping_close_user`=-1";
    $result = $con->query($sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['count'] == -1) {
        $date = date("Y/m/d H:i:s", time());
        $sql = "UPDATE `payments` SET `shipping_close_user`='" . $_SESSION["user"]['userid'] . "',`shipping_close_date`='".$date."' WHERE `paymentid`='".$_POST['id']."'";

        if ($con->query($sql) === TRUE) {
            echo 'close';
        }else{
            echo 'error';
        }
    }else{
        echo 'oldclose';
    }
}
function ShippingExport(){
    global $con;
    $sql = "SELECT * FROM `payments` WHERE `shipping_close_user`!=-1 and `exported`=0 and `shipping`='DHL'";
    $result = $con->query($sql);
    $data='';
    while ($row = mysqli_fetch_assoc($result)) {
        $data.= $row[''];
    }
}
function updateshippinginfo(){
    global $con;
    $sql = "UPDATE `payments` SET `RecieverCompanyName`='".$_POST['RecieverCompanyName']."',`RecieverAttention`='".$_POST['RecieverAttention']."',`Address1`='".$_POST['Address1']."',`Address2`='".$_POST['Address2']."',`Address3`='".$_POST['Address3']."',`City`='".$_POST['City']."',`StateProvince`='".$_POST['StateProvince']."',`Postcode`='".$_POST['Postcode']."',`Country`='".$_POST['Country']."',`Weight`='".$_POST['Weight']."',`Phone`='".$_POST['Phone']."',`Refrence`='".$_POST['Refrence']."',`Contents`='".$_POST['Contents']."',`DeclaredValue`='".$_POST['DeclaredValue']."',`Productcode`='".$_POST['Productcode']."',`shipping_ref`='".$_POST['ShippingNumber']."' WHERE `paymentid`=".$_POST['id'];

    if ($con->query($sql) === TRUE) {
        echo 'update';
    }else{
        echo 'error';
    }
}
function ControlQuestion(){
    global $con;
    if($_POST['qtype']=='main'){
        switch($_POST['type']){
            case 'closed':
                $sql="UPDATE `educationalinquiries` SET `state_q`='2' WHERE `id`=".$_POST['id'];
                break;
            case 'unclosed':
                $sql="UPDATE `educationalinquiries` SET `state_q`='1' WHERE `id`=".$_POST['id'];
                break;
            case 'hide':
                $sql="UPDATE `educationalinquiries` SET `state_q`='3' WHERE `id`=".$_POST['id'];
                break;
            case 'unhide':
                $sql="UPDATE `educationalinquiries` SET `state_q`='2' WHERE `id`=".$_POST['id'];
                break;
            case 'delete':
                $sql="DELETE FROM `educationalinquiries` WHERE id=".$_POST['id'];
                break;
        }
        if ($con->query($sql) === TRUE) {
            if($_POST['type']=='delete'){
                $sql="DELETE FROM `q_comment` WHERE`qid`=".$_POST['id'];
                $con->query($sql);
                echo 'deleteControlQuestion';
            }else{
                echo 'updateControlQuestion';
            }

        }else{
            echo 'error';
        }

    }else if($_POST['qtype']=='sub'){
        $ida=explode("_", $_POST['id'])[1];
        switch($_POST['type']){
            case 'delete':

                $sql="DELETE FROM `q_comment` WHERE id=".$ida;
                break;
            case 'hide':
                $sql="UPDATE `q_comment` SET `state_q`=3 WHERE  `id`=".$ida;
                break;
            case 'unhide':
                $sql="UPDATE `q_comment` SET `state_q`=1 WHERE   `id`=".$ida;
                break;
        }
        if ($con->query($sql) === TRUE) {

                echo 'updateControlQuestion';


        }else{
            echo 'error';
        }
}
}



?>