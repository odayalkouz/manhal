<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 13/05/2016
 * Time: 08:02 ص
 */

if(session_status()==PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION["lang"])){
    $_SESSION["lang"]="En";
}
$lang_code=strtolower($_SESSION["lang"]);
$Lang= simplexml_load_file("../../language/".$_SESSION["lang"].".xml");
include_once "../config.php";
include_once "../../includes/function.php";
include_once "../../includes/aramex_zones.php";
include_once "../includes/function.php";

if(isset($_GET['process']) && $_GET['process']!=""){
    $_GET['process']();
}

//function to activate books for users from admin panel - By Hussam
function activatebook(){
    global $con;
    //insert new code for book
    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`)
 VALUES ('','".date('Y-m-d', strtotime('-1 day'))."','".date('Y-m-d', strtotime('+1 years'))."','book',".$_POST["bookid"].",".$_POST["userid"].",1,'',CURDATE(),1)";
    $con->query($sql);
    $id=mysqli_insert_id($con);
    //generate activation code
    $code = substr($id, -4);
    $code=str_pad( $code, 4, '0', STR_PAD_LEFT);
    $month=date("m");
    $year=date("y");
    $digits = 3;
    $code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
    //update activation code
    $sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
    $con->query($sql);
    //insert new row for this usere to new book with activation code (join)
    $sql="INSERT INTO `codes_user`(`cuid`, `codeid`, `userid`, `regdate`) VALUES ('',".$id.",".$_POST["userid"].",CURDATE())";
    $con->query($sql);
    echo 1;

}
//function to deactivate books for users from admin panel - By Hussam
function deleteactivatebook(){
    global $con;
    $sql="SELECT `codes_user`.`cuid` FROM `codes_user` INNER JOIN `apps_codes` ON `apps_codes`.`codeid`=`codes_user`.`codeid` WHERE `apps_codes`.`type`='book' AND `apps_codes`.`refid`=".$_POST["bookid"]." AND `apps_codes`.`status`=1 AND `codes_user`.`userid`=".$_POST["userid"];
    $result = $con->query($sql);
    while($row=mysqli_fetch_assoc($result)){
        $sql="DELETE FROM `codes_user` WHERE `cuid`=".$row["cuid"];
        $con->query($sql);
    }
    echo 1;
}

function savedatacard(){
    global $con;
    global $Lang;

    if((!isset($_SESSION["user"]["userid"]) || $_SESSION["user"]["userid"]=='' || $_SESSION["user"]["userid"]==0) && isset($_POST['form']['i']) && $_POST['form']['i']==1){
      $sql="SELECT * FROM `users` WHERE `email`='".mysqli_real_escape_string($con,$_POST['form']['cart_email'])."' OR `phone`='".mysqli_real_escape_string($con,$_POST['form']['cart_mobile'])."' ";
      $result = $con->query($sql);
      if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $_SESSION["user"]=$row;
      }else{
        $sql="INSERT INTO `users`(`uname`,`email`, `password`, `status`,`cdate`, `views_count`, `sales_count`,`country`,`page`,`phone`) VALUES
        ('".mysqli_real_escape_string($con,$_POST['form']['cart_email'])."','".mysqli_real_escape_string($con,$_POST['form']['cart_email'])."','Manhal123',1,CURDATE(),0,0,'".mysqli_real_escape_string($con,$_POST['form']['cart_email'])."','checkout','".mysqli_real_escape_string($con,$_POST['form']['cart_mobile'])."')";
        echo $sql;
        if($con->query($sql)){
          $sql="SELECT * FROM `users` WHERE `userid`=".$con->insert_id;
          $result = $con->query($sql);
          $row = mysqli_fetch_assoc($result);
          $_SESSION["user"]=$row;
        }else{
            echo $Lang->ErrorNum."0610210232";
        }
      }
    }

    if(!isset($_SESSION["user"]["userid"]) || $_SESSION["user"]["userid"]!==''){
        $userid=0;
    }else{
        $userid=$_SESSION["user"]["userid"];
    }
    $sql="INSERT INTO `usercard`(`id`, `date`, `userid`, `session`, `cookie`, `form`) VALUES (null,NOW(),".$userid.",'".json_encode($_SESSION)."','".json_encode($_COOKIE)."','".json_encode($_POST['form'])."')";
    if($con->query($sql)){
        echo '1';
    }else{
        echo "Error : 0";
    }
}
function signout($page){
    global $con;
    $sql="UPDATE `users` SET `lastlogin`=NOW(),`page`='".$page."'  WHERE userid=".$_SESSION["userid"];
    $con->query($sql);
}
function signin(){
    global $con;
    $sql ="SELECT * FROM users WHERE (uname='".mysqli_real_escape_string($con,$_POST['email'])."' or email='".mysqli_real_escape_string($con,$_POST['email'])."') and password='".$_POST['pass']."' AND status=1";

    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["user"]=$row;

        if(isset($_POST["save_data"]) && $_POST["save_data"]==true){
            $tokenbasic=rand(11111,99999999);
            $ctime=time();
            $tokenNumber=($tokenbasic*3-465)*6;
            setcookie("tokenbasic",$tokenbasic,time()+COOKIE_EXPIRE,"/");
            setcookie("ctime",$ctime,time()+COOKIE_EXPIRE,"/");
            $sql="UPDATE `users` SET `token`=".$tokenNumber.",`ctime`=".$ctime." WHERE `userid`=".$_SESSION["user"]["userid"];
            $con->query($sql);
        }

        $sql="UPDATE `users` SET `lastlogin`=NOW(),`page`='".$_POST["page"]."'  WHERE userid=".$row["userid"];
        $con->query($sql);

        echo 1;
    }else{
        echo 0;
    }
}
function signup(){
    global $con;
    global $Lang;
    $msg="";
    if(!isset($_POST["email"]) || trim($_POST["email"])==""){
        $msg.=$Lang->pleaseInsertYourEmail."<br>";
    }

    if(!isset($_POST["pass"]) || trim($_POST["pass"])==""){
        $msg.=$Lang->CannotPasswordEmpty."<br>";
    }

    if(!isset($_POST["username"]) || trim($_POST["username"])==""){
        $msg.=$Lang->CannotUsernameEmpty."<br>";
    }

    $sql="SELECT * FROM `users` WHERE `email`='".mysqli_real_escape_string($con,$_POST['email'])."'";
    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        $msg.=$Lang->YourEmailExist."<br>";
    }

    $sql="SELECT * FROM `users` WHERE `uname`='".mysqli_real_escape_string($con,$_POST['username'])."'";
    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        $msg.=$Lang->UsernameExist."<br>";
    }

    if($msg==""){
        $countryCode=getIp("../../");
        $ad='';
        if(isset($_SESSION["ad"]) && $_SESSION["ad"]!=""){
            $ad=$_SESSION["ad"];
        }
        $sql="INSERT INTO `users`(`userid`,`uname`,`email`, `password`, `status`,`cdate`, `views_count`, `sales_count`,`country`,`page`,`ads`) VALUES ('','".mysqli_real_escape_string($con,$_POST['username'])."','".mysqli_real_escape_string($con,$_POST['email'])."','".$_POST['pass']."',1,CURDATE(),0,0,'".$countryCode."','".$_POST['page']."','".$ad."')";
        if($con->query($sql)){
            sendmailsignup($_POST['email']);
            signin();
        }else{
            echo $Lang->ErrorNum."2905160318";
            //file_put_contents("register.txt",$sql);
        }
    }else{
        echo $msg;
    }
}
function sendmailsignup($email){
    global $Lang;
    $message=file_get_contents("../../templates/mailsignup_".$_SESSION["lang"].".html");
    $logo=SITE_URL."images/logo.png";
    $message=str_replace("#Manhal_logo#",$logo,$message);
    $to=$email;
    $subject = 'manhal.com';
    $headers = "From: " . strip_tags(WEBMASTER_EMAIL) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($email) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    if(mail($to, $subject, $message, $headers)){
       // echo 1;
    }else{
        echo $Lang->CannotSendEmail;
    }
}
function sendfeedback(){
    global $Lang;
    $message=file_get_contents("../../templates/feedback_email_".$_SESSION["lang"].".html");
    $logo=SITE_URL."images/logo.png";
    $message=str_replace("#Manhal_logo#",$logo,$message);
    $message=str_replace("#Manhal_user_name#",$_POST['username'],$message);
    $message=str_replace("#Manhal_email#",$_POST['email'],$message);
    $message=str_replace("#Manhal_subject#",$_POST['subject'],$message);
    $message=str_replace("#Manhal_Idea#",$_POST['idea'],$message);
    $message=str_replace("#Manhal_MSG#",$_POST['message'],$message);


    $to=CONTACT_EMAIL;
    $subject = "Feedback - ".$_POST['subject'];

    $headers = "From: " . strip_tags($_POST['email']) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    if(mail($to, $subject, $message, $headers)){
        echo 1;
    }else{
        echo $Lang->CannotSendEmail;
    }
}
function sendContact(){
    global $Lang;


    if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
    }
    if(!$captcha){
        echo '<h2>Please check the the captcha form.</h2>';
        exit;
    }
    $secretKey = "6Lfnvj8UAAAAAGMIkj9n6Xi6qDq-FGkO3804EyKG";
    $ip = $_SERVER['REMOTE_ADDR'];
    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
    $responseKeys = json_decode($response,true);









    $message=file_get_contents("../../templates/mail_".$_SESSION["lang"].".html");
    $logo=SITE_URL."images/logo.png";
    $message=str_replace("#Manhal_logo#",$logo,$message);
    $message=str_replace("#Manhal_user_name#",$_POST['name'],$message);
    $message=str_replace("#Manhal_email#",$_POST['email'],$message);
    $message=str_replace("#Manhal_subject#",$_POST['subject'],$message);
    $message=str_replace("#Manhal_MSG#",$_POST['message'],$message);


    $to=CONTACT_EMAIL;
    $subject = "Contact - ".$_POST['subject'];

    $headers = "From: " . strip_tags($_POST['email']) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";



    if(mail($to, $subject, $message, $headers)&&intval($responseKeys["success"]) !== 1){
        echo 1;
    }else{
        echo $Lang->CannotSendEmail;
    }
}
function sendsubscrimemail(){
    global $Lang;
    $message=file_get_contents("../../templates/mail_".$_SESSION["lang"].".html");
    $logo=SITE_URL."images/logo.png";
    $message=str_replace("#Manhal_logo#",$logo,$message);
    $message=str_replace("#Manhal_user_name#",$_POST['name'],$message);
    $message=str_replace("#Manhal_email#",$_POST['email'],$message);
    $message=str_replace("#Manhal_subject#",$_POST['subject'],$message);
    $message=str_replace("#Manhal_MSG#",$_POST['message'],$message);


    $to=CONTACT_EMAIL;
    $subject = "Contact - ".$_POST['subject'];

    $headers = "From: " . strip_tags($_POST['email']) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    if(mail($to, $subject, $message, $headers)){
        echo 1;
    }else{
        echo $Lang->CannotSendEmail;
    }
}
function deletewish(){
    $sql="DELETE FROM `wishs` WHERE `wishid`=".$_GET['wishid']." AND `userid`=".$_SESSION["user"]["userid"];//user id for security issue

    if(mysql_query($sql)){
        echo 1;
    }else{
        echo 0;
    }
}
function changepassword(){
    global $con;
    if(isset($_POST["old_password"]) && $_POST["new_password"]!=""){
        if($_POST["new_password"]==$_POST["cpassword"]){
            $sql="SELECT * FROM `users` WHERE `userid`=".$_SESSION["user"]["userid"]." AND `password`='".$_POST['old_password']."'";
            $result=$con->query($sql);
            if(mysqli_num_rows($result)>0){
                if(isset($_POST["new_password"]) && trim($_POST['new_password'])!=""){
                    $sql="UPDATE `users` SET `password`='".$_POST['new_password']."' WHERE `userid`=".$_SESSION["user"]["userid"];
                    $con->query($sql);
                    echo 1;
                }
            }else{
                echo -1;
            }
        }else{
            echo -2;
        }

    }else{
        echo -3;
    }

}
function addtowish(){
    global $Lang;
    if(isset($_GET['bookid']) && $_GET['bookid']!=""){
        $sql="INSERT INTO `wishs`(`wishid`, `userid`, `bookid`, `wish_date`) VALUES ('',".$_SESSION["user"]["userid"].",".$_GET['bookid'].",CURDATE())";
        if(!mysql_query($sql)){
            echo $Lang->ErrorNum."1307150709";
        }else{
            echo 1;
        }
    }else{
        echo $Lang->ErrorNum."0710151114";
    }
}
function deletefromwish(){
    $sql="DELETE FROM `wishs` WHERE `bookid`=".$_GET['bookid']." AND `userid`=".$_SESSION["user"]["userid"];//user id for security issue

    if(mysql_query($sql)){
        echo 1;
    }else{
        echo 0;
    }
}
//first khalid 4-9-2016
function rate(){
    global $con;
    $bookID=$_POST['bookid'];
    switch($_POST['type']){
        case 'book':
            $sql="SELECT * FROM books WHERE bookid=".$bookID;
            break;
        case 'story':
            $sql="SELECT * FROM story WHERE storyid=".$bookID;
            break;
        case 'games':
            $sql="SELECT * FROM media WHERE id=".$bookID." AND type='11'";
            break;
        case 'worksheet':
            $sql="SELECT * FROM media WHERE id=".$bookID." AND type='0'";
            break;
        case 'video':
            $sql="SELECT * FROM media WHERE id=".$bookID." AND type='4'";
            break;
        case 'audio':
            $sql="SELECT * FROM media WHERE id=".$bookID." AND type='3'";
            break;
            case 'interactive-worksheets':
            $sql="SELECT * FROM media WHERE id=".$bookID." AND type='12'";
            break;

    }
    $result=$con->query($sql);
    $bookInfo=mysqli_fetch_assoc($result);
      if(canRate($_POST['bookid'],$bookInfo,$_POST['type'])){
        $sql="INSERT INTO `rating`(`ratingid`, `userid`, `bookid`, `rating`, `date`,`type`) VALUES ('',".$_SESSION["user"]["userid"].",".$_POST['bookid'].",".$_POST['rate'].",CURDATE(),'".$_POST['type']."')";

          if($con->query($sql)){
            echo setRating($_POST['bookid'],$_POST['type']);
        }else{
            echo 0;
        }
    }else{
        echo 0;
    }
}

function setRating($bookID,$type){
    global $con;
    $sql="SELECT *,count(`ratingid`) as rate_count from `rating` WHERE bookid=".$bookID." and `type`='".$type."' GROUP BY `rating`";
    $result=$con->query($sql);

    $sum=0;
    $count=0;
    while($row=mysqli_fetch_assoc($result)){
        if(isset($row['rating'])){
            $rating=$row['rating'];
        }else{
            $rating=0;
        }
        $sum+=  $row['rate_count']*$rating;
        $count+=$row['rate_count'];
    }
    $rate=round($sum/$count);
    switch($type){
        case 'book':
            $sql="UPDATE `books` set `rate`=".$rate.",`rating_count`=`rating_count`+1 WHERE bookid=".$bookID;
            break;
        case 'story':
            $sql="UPDATE `story` set `rate`=".$rate.",`rating_count`=`rating_count`+1 WHERE storyid=".$bookID;
            break;
        case 'games':
        case 'worksheet':
        case 'video':
        case 'audio':
       case 'interactive-worksheets':
        $sql="UPDATE `media` set `rate`=".$rate.",`rating_count`=`rating_count`+1 WHERE id=".$bookID;
            break;
    }

    $con->query($sql);
    return $rate."@manhal@seperator@".$count;
}
//end khalid 4-9-2016

function addtocart(){
//    print_r($_POST);
//    exit();
    if(isset($_GET["extra"]) && $_GET["extra"]=="clearall"){
        setcookie("items","",time()+COOKIE_EXPIRE,"/");
        unset($_COOKIE['items']);
    }

    if(isset($_POST['bookid']) && $_POST['bookid']!=""){
        $items=[];
        if(isset($_COOKIE['items']) && $_COOKIE['items']!="" && !empty($_COOKIE['items'])){
            $items=json_decode($_COOKIE['items'],true);
        }
        if(!isset($items[$_POST['type']]) || !is_array($items[$_POST['type']])){
            $items[$_POST['type']]=[];
        }
        $position=array_search($_POST['bookid'],array_keys($items[$_POST['type']]));

            if(isset($_POST["quantity"]) && $_POST["quantity"]!=""){
                $quantity=$_POST["quantity"];
            }else{
                $quantity=1;
            }
        if($position===false){
            $items[$_POST['type']][$_POST['bookid']]["quantity"]=$quantity;
            $items[$_POST['type']][$_POST['bookid']]["type"]=$_POST["booktype"];
            setcookie("items",json_encode($items),time()+COOKIE_EXPIRE,"/");
            echo 1;
        }else{
            $items[$_POST['type']][$_POST['bookid']]["quantity"]+=$quantity;
//            if(count($items[$_POST['type']])<2){
//                unset($items[$_POST['type']]);
//                $items[$_POST['type']]=[];
//            }else{
//                unset($items[$_POST['type']][$_POST['bookid']]);
//            }
            setcookie("items",json_encode($items),time()+COOKIE_EXPIRE,"/");
            echo 1;
        }
    }
}
function getcartinfo(){
    global $con;
    global $Lang;
    global $lang_code;
    $items=[];
    if(isset($_COOKIE['items']) && $_COOKIE['items']!=""){
        $items=json_decode($_COOKIE['items'],true);
    }
    if(!isset($items["book"]) || !is_array($items["book"])){
        $items["book"]=[];
    }
    if(!isset($items["story"]) || !is_array($items["story"])){
        $items["story"]=[];
    }
    if(!isset($items["toy"]) || !is_array($items["toy"])){
        $items["toy"]=[];
    }


    $values = array_keys($items["book"]);
    $itemsList = implode(',', $values);

    $sql="SELECT * FROM `books` WHERE `bookid` IN(".$itemsList.")";
    $result=$con->query($sql);
    $total_price=0;
    $html='<div class="top-container">
            <div class="display-inline-block">
            <span class="shoppercount">'.getCartItemCount().'</span> <span>'.$Lang->ItemsAdded.'</span>
            </div>
                </div><div class="items-container scrollable">';
    if(count($items["book"])>0){
        while($row=mysqli_fetch_assoc($result)){
            $price=calcItemPrice($row,$items["book"][$row['bookid']]["type"]);
            $html.='<div class="item-container">
                                <div class="thumb floating-left" style="background-image: url('.SITE_URL.'platform/books/'.$row['bookid'].'/cover.jpg)"></div>
                                <div class="center floating-left text-left">
                                    <label class="name floating-left">'.$row['name'].'</label>
                                    <div class="quantity"><span class="floating-left">'.$Lang->Quantity.' : </span> <span class="floating-left"> '.$items["book"][$row['bookid']]["quantity"].'</span></div>
                                </div>
                                <div class="right">
                                    <a class="delete delete_item_cart" type="book" bookid="'.$row['bookid'].'" price="'.$price.'"></a>
                                    <label class="price floating-left">$</label>
                                    <label class="price floating-left">'.$price.'</label>
                                </div>
                            </div>';
            $total_price+=$price*$items["book"][$row['bookid']]["quantity"];
        }
    }


    ///get stories Info
    $values = array_keys($items["story"]);
    $itemsList = implode(',', $values);

    $sql="SELECT * FROM `story` WHERE `storyid` IN(".$itemsList.")";
    $result=$con->query($sql);
    if(count($items["story"])>0){
        while($row=mysqli_fetch_assoc($result)){
            $price=calcItemPrice($row,$items["story"][$row['storyid']]["type"]);
            $html.='<div class="item-container">
                                <div class="thumb floating-left" style="  background-image: url('.SITE_URL.'platform/stories/'.$row["seriesid"]."/story/".$row['storyid'].'/images/pic.jpg)"></div>
                                <div class="center floating-left text-left">
                                    <label class="name floating-left">'.$row['title'].'</label>
                                    <div class="quantity"><span class="floating-left">'.$Lang->Quantity.' : </span> <span class="floating-left"> '.$items["story"][$row['storyid']]["quantity"].'</span></div>
                                </div>
                                <div class="right">
                                    <label class="price floating-left">$</label>
                                    <label class="price floating-left">'.$row['price'].'</label>
                                    <a class="delete delete_item_cart" type="story" bookid="'.$row['storyid'].'" price="'.$price.'"></a>
                                </div>
                            </div>';
            $total_price+=$price+($row['price']*($items["story"][$row['storyid']]["quantity"]-1));

        }
    }


    ///get toys Info
    $values = array_keys($items["toy"]);
    $itemsList = implode(',', $values);

    $sql="SELECT * FROM `products` WHERE `productid` IN(".$itemsList.")";
    $result=$con->query($sql);
    if(count($items["toy"])>0){
        while($row=mysqli_fetch_assoc($result)){
            $price=$row["Price"];
            $html.='<div class="item-container">
                                <div class="thumb floating-left" style="  background-image: url('.SITE_URL.'platform/products/'.$row["productid"].'/thumbnail_small.jpg)"></div>
                                <div class="center floating-left text-left">
                                    <label class="name floating-left">'.$row['name_'.strtolower($lang_code)].'</label>
                                    <div class="quantity"><span class="floating-left">'.$Lang->Quantity.' : </span> <span class="floating-left"> '.$items["toy"][$row['productid']]["quantity"].'</span></div>
                                </div>
                                <div class="right">
                                    <label class="price floating-left">$</label>
                                    <label class="price floating-left">'.$row['Price'].'</label>
                                    <a class="delete delete_item_cart" type="toy" bookid="'.$row['productid'].'" price="'.$price.'"></a>
                                </div>
                            </div>';
            $total_price+=$price+($row['Price']*($items["toy"][$row['productid']]["quantity"]-1));

        }
    }

    $html.='</div><div class="total-price">
                            <label class="floating-left">'.$Lang->TotalPrice.': </label>
                            <div class="floating-left">
                                <span class="floating-left cart_total_price">'.$total_price.'</span>
                                <span class="floating-left ">$</span>
                            </div>

                        </div>
                        <div class="buttons-container">
                            <a href="'.SITE_URL.$lang_code.'/check-out" class="button">'.$Lang->CheckOut.'</a>
                        </div>';

    echo $html;
}

function getMediaCart($items,$type){
    global $con;
    global $Lang;
    $html="";
    $total_price=0;
    $values = array_keys($items[$type]);
    $itemsList = implode(',', $values);

    $sql="SELECT * FROM `media` WHERE `id` IN(".$itemsList.")";
    $result=$con->query($sql);
    if(count($items["$type"])>0){
        while($row=mysqli_fetch_assoc($result)){
            $price=calcItemPrice($row,$items[$type][$row['id']]["type"]);
            $html.='<div class="item-container">
                                <div class="thumb floating-left" style="background-image: url('.SITE_URL.'platform/media/'.$row["id"].'/thumbnail_small.jpg)"></div>
                                <div class="center floating-left text-left">
                                    <label class="name floating-left">'.$row['title_'.strtolower($_SESSION["lang"])].'</label>
                                    <div class="quantity"><span class="floating-left">'.$Lang->Quantity.' : </span> <span class="floating-left"> '.$items[$type][$row['id']]["quantity"].'</span></div>
                                </div>
                                <div class="right">
                                    <label class="price floating-left">$</label>
                                    <label class="price floating-left">'.$row['price'].'</label>
                                    <a class="delete delete_item_cart" type="'.$type.'" bookid="'.$row['id'].'" price="'.$price.'"></a>
                                </div>
                            </div>';
            $total_price+=$price+($row['price']*($items[$type][$row['id']]["quantity"]-1));

        }
    }

    return array($total_price,$html);
}

function deletefromcart(){
    if(isset($_POST['bookid']) && $_POST['bookid']!=""){
        $items=array();
        if(isset($_COOKIE['items']) && $_COOKIE['items']!=""){
            $items=json_decode($_COOKIE['items'],true);
        }
        if(!isset($items[$_POST['type']]) || !is_array($items[$_POST['type']])){
            $items[$_POST['type']]=[];
        }
            unset($items[$_POST['type']][$_POST['bookid']]);

        setcookie("items",json_encode($items),time()+COOKIE_EXPIRE,"/");
            echo 1;
    }
}
function deletefromorders(){
    global $con;
    if(isset($_POST['orderid']) && $_POST['orderid']!=""){//need security
        $sql="UPDATE `payments` SET `status`=-1 WHERE `paymentid`=".$_POST['orderid'];
        $con->query($sql);
            echo 1;
    }
}
function facebooklogin(){
    global $con;
    if(isset($_POST['social']) && $_POST['social']!=""){
        $sql ="SELECT * FROM users WHERE social=".$_POST['social']." AND status=1";
        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION["user"]=$row;
            echo 1;

            $sql="UPDATE `users` SET `lastlogin`=NOW() WHERE userid=".$row["userid"];
            $con->query($sql);

        }else{
            $date=date("d/m/Y");
            $avatar="http://graph.facebook.com/".$_POST['social']."/picture";
            $vuser_login=$_POST['name'];
            $vuser_name=$_POST['fname'];
            $vuser_lastname=$_POST['lname'];
            $vuser_gender=$_POST['gender'];
            $fullName=$vuser_name." ".$vuser_lastname;
            $email=$_POST['email'];
            $countryCode=getIp("../../");
            $ad='';
            if(isset($_SESSION["ad"]) && $_SESSION["ad"]!=""){
                $ad=$_SESSION["ad"];
            }
            $sql="INSERT INTO `users`(`userid`, `uname`, `password`, `email`, `permession`, `cdate`, `fullname`, `status`, `token`, `ctime`, `social`, `avatar`, `views_count`, `sales_count`, `country`, `address`, `phone`, `birthdate`, `gender`,`ads`) VALUES ('','".mysqli_real_escape_string($con,$vuser_login)."','','".$email."','',CURDATE(),'".mysqli_real_escape_string($con,$vuser_name)."','1','','','".$_POST['social']."','".$avatar."','0','0','".$countryCode."','','','','','".$ad."')";

            if($con->query($sql)){
                facebooklogin();
            }else{
                echo "Error : 110720160911";
            }
        }
    }else{
        echo 0;
    }

}

function updateprofile(){
    global $con;
    if(isset($_POST) && !empty($_POST)){
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $fullname=mysqli_real_escape_string($con,$_POST['fullname']);
        $country=mysqli_real_escape_string($con,$_POST['country']);
        $address=mysqli_real_escape_string($con,$_POST['address']);
        $phone=mysqli_real_escape_string($con,$_POST['phone']);
        $birthdate=mysqli_real_escape_string($con,$_POST['birthdate']);
        $gender=mysqli_real_escape_string($con,$_POST['gender']);
        $avatar="";
        if(isset($_POST['avatar']) && $_POST['avatar']!="") {
            $img="users/images/".uniqid().".jpg";
            saveImageBase64($_POST['avatar'],"../../".$img);
            $avatar=", `avatar`='".$img."'";
        }
        $sql="UPDATE `users` SET `email`='".$email."',`fullname`='".$fullname."',`country`='".$country."',`address`='".$address."',`phone`='".$phone."',`birthdate`='".$birthdate."',`gender`='".$gender."'$avatar WHERE `userid`=".$_SESSION["user"]["userid"];
        if($con->query($sql)){
            $sql="SELECT * FROM `users` WHERE `userid`=".$_SESSION["user"]["userid"];
            $_SESSION["user"]=mysqli_fetch_assoc($con->query($sql));
            echo 1;
        }else{
            echo "Error : 030820160834";
        }
    }else{
        echo 0;
    }
}

function forgetpass(){
    global $con;
    global $Lang;
    global $lang_code;

    $sql ="SELECT * FROM users WHERE email='".$_POST['email']."' AND status=1 AND (`social` is Null or `social`='')";
    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $token=getToken(50);
        $sql="UPDATE `users` SET `token`='".$token."' WHERE `userid`=".$row['userid'];
        $con->query($sql);
    }else{
        echo -1;
        exit();
    }


    $message=file_get_contents("../../templates/forget_pass_".$_SESSION["lang"].".html");
    $logo=SITE_URL."images/logo.png";
    $message=str_replace("#Manhal_logo#",$logo,$message);
    $message=str_replace("#Manhal_Username#",$row['uname'],$message);
    $message=str_replace("#Link#",SITE_URL.$lang_code."/reset-password?token=".$token,$message);

    $to=$row["email"];
    $subject = $Lang->ForgetPasswordTitle;

    $headers = "From: ".CONTACT_EMAIL."\r\n";
    $headers .= "Reply-To: ".CONTACT_EMAIL."\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    if(mail($to, $subject, $message, $headers)){
        echo 1;
    }else{
        echo $Lang->CannotSendEmail;
    }
}
function resetpassword(){
    global $con;
    if(trim($_POST["new_password"])==""){
        echo -1;
        exit();
    }elseif($_POST["new_password"]!=$_POST["cpassword"]){
        echo -2;
        exit();
    }else{
        $sql ="SELECT * FROM users WHERE token='".$_POST['token']."' AND status=1";
        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $sql="UPDATE `users` SET `password`='".$_POST["new_password"]."',`token`='' WHERE userid=".$row["userid"];
            $con->query($sql);
            echo 1;
        }else{
            echo 0;
        }
    }

}




function screenshots(){
    if (isset($_FILES['book_shoots'])) {
        if(!is_dir("../books/".$_GET["bookid"])){
            mkdir("../books/".$_GET["bookid"]);
        }
        $target_path = "../books/".$_GET["bookid"]."/screenshoots/";     // Declaring Path for uploaded images.
        if(!is_dir($target_path)){
            mkdir($target_path);
        }
        for ($i = 0; $i < count($_FILES['book_shoots']['name']); $i++) {
            $validextensions = array("jpeg", "jpg", "png","gif","svg","pdf");      // Extensions which are allowed.
            $ext = explode('.', basename($_FILES['book_shoots']['name'][$i]));   // Explode file name from dot(.)
            $file_extension = end($ext); // Store extensions in the variable.
            $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
            if (in_array($file_extension, $validextensions)) {
                move_uploaded_file($_FILES['book_shoots']['tmp_name'][$i], $target_path);
            }
        }
    }
}


function Approvals(){
    if (isset($_FILES['Filemedia'])) {
        if(!is_dir("../books/".$_GET["id"]."/relatedbook")){
            mkdir("../books/".$_GET["id"]."/relatedbook");
        }
        $target_path = "../books/".$_GET["id"]."/relatedbook/";     // Declaring Path for uploaded images.
        if(!is_dir($target_path)){
            mkdir($target_path);
        }
        $validextensions = array("pdf","html","htm");      // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['Filemedia']['name']));   // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
                $target_path = $target_path .$_GET["filename"]. "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
                move_uploaded_file($_FILES['Filemedia']['tmp_name'], $target_path);
        }
    }
}
function Lessonplans(){
    if (isset($_FILES['Filemedia2'])) {
        if(!is_dir("../books/".$_GET["id"]."/relatedbook")){
            mkdir("../books/".$_GET["id"]."/relatedbook");
        }
        $target_path = "../books/".$_GET["id"]."/relatedbook/";     // Declaring Path for uploaded images.
        if(!is_dir($target_path)){
            mkdir($target_path);
        }
        $validextensions = array("pdf","html","htm");      // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['Filemedia2']['name']));   // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
                $target_path = $target_path .$_GET["filename"]. "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
                move_uploaded_file($_FILES['Filemedia2']['tmp_name'], $target_path);
        }
    }
}

function teacherpdf(){
    if (isset($_FILES['Filemedia3'])) {
        if(!is_dir("../books/secured/".$_GET["id"])){
            mkdir("../books/secured/".$_GET["id"]);
        }
        $target_path = "../books/secured/".$_GET["id"];     // Declaring Path for uploaded images.
        $validextensions = array("pdf");      // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['Filemedia3']['name']));   // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
            $target_path = $target_path ."/teacher.pdf";     // Set the target path with a new name of image.
            move_uploaded_file($_FILES['Filemedia3']['tmp_name'], $target_path);
        }
    }
}

function teacherexe(){
    if (isset($_FILES['Filemedia4'])) {
        if(!is_dir("../books/secured/".$_GET["id"])){
            mkdir("../books/secured/".$_GET["id"]);
        }
        $target_path = "../books/secured/".$_GET["id"];     // Declaring Path for uploaded images.
        $validextensions = array("exe");      // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['Filemedia4']['name']));   // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
            $target_path = $target_path ."/teacher.exe";     // Set the target path with a new name of image.
            move_uploaded_file($_FILES['Filemedia4']['tmp_name'], $target_path);
        }
    }
}

function mediafile(){
    if (isset($_FILES['Filemedia'])) {
        if(!is_dir("../media/".$_GET["id"])){
            mkdir("../media/".$_GET["id"]);
        }
        $target_path = "../media/".$_GET["id"]."/";     // Declaring Path for uploaded images.
        if(!is_dir($target_path)){
            mkdir($target_path);
        }
            $validextensions = array("pdf","mp3","webm","mp4","m4v","mov","swf","html","htm","zip","jpg","png");      // Extensions which are allowed.
            $ext = explode('.', basename($_FILES['Filemedia']['name']));   // Explode file name from dot(.)
            $file_extension = end($ext); // Store extensions in the variable.

            if (in_array($file_extension, $validextensions)) {
                if($file_extension=='zip'){

                    $pathIndex=extractFile($_FILES["Filemedia"]["name"],$_FILES["Filemedia"]["tmp_name"],$target_path.$_GET["filename"].'.'.$file_extension ,$file_extension,$target_path);

                }else{
                    $dir = $target_path;
                    $dh  = opendir($dir);
                    while (false !== ($fileName = readdir($dh))) {

                        if(strpos($fileName,$_GET["filename"])>-1){
                            if($file_extension!='pdf') {
                                unlink($target_path . '/' . $fileName);
                            }
                        }
                    }
if($file_extension=='pdf'){
    $target_path = $target_path .$_GET["filename"]. "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
}else{
    $target_path = $target_path .$_GET["filename"]. "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
}

                    $target_path= str_replace(" ","-",$target_path);
                    move_uploaded_file($_FILES['Filemedia']['tmp_name'], $target_path);
               }

            }
    }
}
function sendmailhr($email,$username,$file,$id){
    global $Lang;
    $message=file_get_contents("../../templates/HRmail_".$_SESSION["lang"].".html");
    $logo=SITE_URL."images/logo.png";
    $message=str_replace("#Manhal_logo#",$logo,$message);
    $message=str_replace("#Manhal_user_name#",$username,$message);
    $message=str_replace("#Manhal_email#",$email,$message);
    $message=str_replace("#Manhal_subject#","CV",$message);
    $message=str_replace("#Manhal_Idea#",$id,$message);
    $message=str_replace("#Manhal_MSG#",$file,$message);
    $to='HR@manhal.com';
    $subject = "careers";
    $headers = "From: " . strip_tags($_POST['email']) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    if(mail($to, $subject, $message, $headers)){
        echo 1;
    }else{
        echo $Lang->CannotSendEmail;
    }
}

function uploadcvfile(){

    if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
    }
    if(!$captcha){
        echo '<h2>Please check the the captcha form.</h2>';
        exit;
    }
    $secretKey = "6Lfnvj8UAAAAAGMIkj9n6Xi6qDq-FGkO3804EyKG";
    $ip = $_SERVER['REMOTE_ADDR'];
    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
    $responseKeys = json_decode($response,true);

    global $con;
    $sql="SELECT * FROM `careers_cv` WHERE `email`='".$_POST["emailaddress_"]."' and `id_job`=".$_GET["id"];
    $result=$con->query($sql);
    if(mysqli_num_rows($result)==0){
        $sql="INSERT INTO `careers_cv`(`id`, `id_job`, `date`, `Phone`, `firstname`, `lastname`, `email`) VALUES (null,".$_GET["id"].", CURDATE(),'".$_POST["Phone_"]."','".$_POST["firstname_"]."','".$_POST["lastname_"]."','".$_POST["emailaddress_"]."')";
        $con->query($sql);
        $newID=$con->insert_id;
    }else{
        $row = mysqli_fetch_assoc($result);
        $newID=$row['id'];
    }

    if (isset($_FILES['Filemedia'])) {
        if(!is_dir("../cv/".$_GET["id"])){
            mkdir("../cv/".$_GET["id"]);
        }
        $target_path = "../cv/".$_GET["id"]."/";     // Declaring Path for uploaded images.
        if(!is_dir($target_path)){
            mkdir($target_path);
        }
        $validextensions = array("pdf","jpg","png","docx","doc");      // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['Filemedia']['name']));   // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.

        if (in_array($file_extension, $validextensions)) {

            $dir = $target_path;
            $dh  = opendir($dir);
            while (false !== ($fileName = readdir($dh))) {

                if(strpos($fileName,$_GET["filename"])>-1)
                    unlink($target_path.'/'.$fileName);


                $target_path = $target_path .$newID. "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.


                $target_path= str_replace(" ","-",$target_path);
                move_uploaded_file($_FILES['Filemedia']['tmp_name'], $target_path);
            }

        }
    }
    sendmailhr($_POST["emailaddress_"],$_POST["firstname_"]." ".$_POST["lastname_"],SITE_URL."platform/cv/".$_GET["id"]."/".$newID. "." . $ext[count($ext) - 1],$_GET["id"]);
    echo 1;
}

function extractFile ($zip_file,$zip_fileTemp,$path,$type,$path_1){
    $filename = $zip_file;
    $type = $type;
    $source = $zip_fileTemp;
    $name = explode(".", $filename);
    $accepted_types = array('application/zip','application/x-zip-compressed','multipart/x-zip','application/x-compressed');
    foreach($accepted_types as $mime_type) {
        if($mime_type == $type) {
            $okay = true;
            break;
        }
    }
    $continue = strtolower($name[1]) == 'zip' ? true : false;
    if(!$continue) {
        $message = false;
    }
    $target_path = $path;  // change this to the correct site path

    $extractFolder = explode(".".pathinfo($target_path,PATHINFO_EXTENSION), $target_path);
    if(move_uploaded_file($source,$target_path)) {
        $zip = new ZipArchive();
        $x = $zip->open($target_path);
        if ($x === 'TRUE' || $x === true ) {
            $zip->extractTo($path_1); // change this to the correct site path
            $zip->close();
           unlink($target_path);
            rename($path_1."/index.html",$path_1."/".$_GET["filename"].".html");
            if(pathinfo($target_path,PATHINFO_EXTENSION)=='zip'){
                if(getfindex($extractFolder[0])==false){
                    deleteDirectory($extractFolder[0]);
                    return false;
                }else{
                    return  getfindex($extractFolder[0]);
                }
            }else if(pathinfo($target_path,PATHINFO_EXTENSION)=='epub'){
                return $extractFolder[0];
            }
        }
    } else {
        return false;
    }
}
function getfindex($path){
    $directory = new RecursiveDirectoryIterator($path);
    $Iterator = new RecursiveIteratorIterator($directory);
    $Regex = new RegexIterator($Iterator, '/^.+\index.htm|index.html/i', RecursiveRegexIterator::GET_MATCH);

    $chidx=999999999;
    $fileidx=false;

    foreach ($Regex as $filename=>$current) {
        if(strlen($current[0])<$chidx){
            $chidx=strlen($current[0]);
            $fileidx=$filename;
        }
        // file_put_contents('kk1.txt',  file_get_contents('kk1.txt')."     ".$filename);
    }
    return $fileidx;
}
function deleteDirectory($dir) {
    if (!file_exists($dir)) return true;
    if (!is_dir($dir) || is_link($dir)) return unlink($dir);
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') continue;
        if (!deleteDirectory($dir . "/" . $item)) {
            chmod($dir . "/" . $item, 0777);
            if (!deleteDirectory($dir . "/" . $item)) return false;
        };
    }
    return rmdir($dir);
}
function canread(){
    //covid-19 corona update :)
//    echo 1;
//    exit();

    global $con;
    if(isset($_SESSION["user"]) && $_SESSION["user"]["permession"]>0 && $_SESSION["user"]["permession"]<=9){
        echo 1;
        exit();
    }
    if(isset($_SESSION["user"]["userid"])){
        if($_SESSION["user"]["userid"]<=15){//for manhal users
            echo 1;
        }else{
            switch($_GET["type"]){
                case "book":
                    $sql="SELECT `bookid`,`price`,`eprice`,`iprice`,`booktype` from `books` WHERE `bookid`=".$_GET['bookid'];
                    $result=$con->query($sql);
                    $row=mysqli_fetch_assoc($result);
                    if(calcItemPrice($row,$row["booktype"])>0){
                        if(isset($_SESSION["user"]["userid"])){
                            $sql="SELECT `payments`.`userid`,`payments_books`.`paymentid`,`payments_books`.`bookid` FROM `payments` JOIN  `payments_books` on `payments`.`paymentid`=`payments_books`.`paymentid` where `payments`.`userid`=".$_SESSION["user"]["userid"]." AND `payments_books`.`itemtype`='book' AND `payments_books`.`bookid`=".$_GET["bookid"];
                            $result=$con->query($sql);
                            if(mysqli_num_rows($result)>0){
                                echo 1;
                            }else{//check for users activate books using activation code
                                $sql="SELECT `apps_codes`.*,`codes_user`.* FROM `apps_codes` INNER JOIN `codes_user` ON `apps_codes`.`codeid`=`codes_user`.`codeid` WHERE `apps_codes`.`startdate` < CURDATE() AND `apps_codes`.`enddate` > CURDATE() AND
 `apps_codes`.`type`='book' AND `apps_codes`.`refid`=".$_GET['bookid']." AND `apps_codes`.`status`=1 AND `codes_user`.`userid`=".$_SESSION["user"]["userid"];
                                $result=$con->query($sql);
                                if(mysqli_num_rows($result)>0){
                                    echo 1;
                                    exit();
                                }else{
                                    echo 0;
                                }
                            }
                        }else{
                            echo 0;
                        }
                    }else{
                        echo 1;
                    }
                    break;
                case "story":

                        if($_SESSION["user"]["permession"]>0 && $_SESSION["user"]["permession"]<=12){
                            echo 1;
                        }else{
                            if(isset($_SESSION["user"]["userid"])){
                                $sql="SELECT `payments`.`userid`,`payments_books`.`paymentid`,`payments_books`.`bookid` FROM `payments` JOIN  `payments_books` on `payments`.`paymentid`=`payments_books`.`paymentid` where `payments`.`userid`=".$_SESSION["user"]["userid"]." AND `payments_books`.`itemtype`='story' AND  `payments_books`.`bookid`=".$_GET["bookid"];
                                $result=$con->query($sql);
                                if(mysqli_num_rows($result)>0){
                                    echo 1;
                                }else{
                                    $sql="SELECT `apps_codes`.*,`codes_user`.* FROM `apps_codes` INNER JOIN `codes_user` ON `apps_codes`.`codeid`=`codes_user`.`codeid` WHERE `apps_codes`.`startdate` < CURDATE() AND `apps_codes`.`enddate` > CURDATE() AND
 `apps_codes`.`type`='story' AND `apps_codes`.`refid`=".$_GET['bookid']." AND `apps_codes`.`status`=1 AND `codes_user`.`userid`=".$_SESSION["user"]["userid"];
                                    $result=$con->query($sql);
                                    if(mysqli_num_rows($result)>0){
                                        echo 1;
                                        exit();
                                    }else{//check for series
                                        $sql="SELECT `apps_codes`.*,`codes_user`.* FROM `apps_codes` INNER JOIN `codes_user` ON `apps_codes`.`codeid`=`codes_user`.`codeid` WHERE `apps_codes`.`startdate` < CURDATE() AND `apps_codes`.`enddate` > CURDATE() AND
 `apps_codes`.`type`='series' AND `apps_codes`.`refid`=(SELECT `seriesid` from story where storyid=".$_GET["bookid"].") AND `apps_codes`.`status`=1 AND `codes_user`.`userid`=".$_SESSION["user"]["userid"];
                                        $result=$con->query($sql);
                                        if(mysqli_num_rows($result)>0){
                                            echo 1;
                                            exit();
                                        }else{
                                            echo -1;
                                            exit();
                                        }
                                    }
                                }
                            }else{
                                echo 0;
                                exit();
                            }
                        }
//                    }else{
//                        echo 1;
//                    }
                    break;
            }
        }
    }else{
        echo 0;
        exit();
    }
}
function getviewcomment(){
    $data=getComments($_GET["type"],$_GET["id"],$_GET["page"]);
    echo  json_encode($data);
}

function addqustion(){
    global $con;
    if(isset($_SESSION["user"]) && !empty($_SESSION["user"]) && isset($_POST["qustion"]) && $_POST["qustion"]!=""){
        $date = date("Y/m/d H:i:s", time());
        $sql="INSERT INTO `educationalinquiries`(`id`, `iduser`, `title`, `qustion`, `views`, `comments`, `date`, `state`, `state_q`) VALUES ('',".$_SESSION["user"]["userid"].",'".mysqli_real_escape_string($con,$_POST["title"])."','".mysqli_real_escape_string($con,$_POST["qustion"])."',0,0,'".$date."',0,1)";
        $con->query($sql);


        $category='';
        $page=''; $keywords='';

        if(isset($_POST["category"])&&$_POST["category"]!='undefined'){
            $category=$_POST["category"];
        }
        if(isset($_POST["page"])&&$_POST["page"]!='undefined'){
            $page=$_POST["page"];
        }
        if(isset($_POST["keywords"])&&$_POST["keywords"]!='undefined'){
            $keywords=$_POST["keywords"];
        }

        $data=drowEducationalInquiries($category,$page,$keywords);

        echo  json_encode($data);

    }else{
        echo 0;
    }

}

function addcomment(){
    global $con;
    if(isset($_SESSION["user"]) && !empty($_SESSION["user"]) && isset($_POST["comment"]) && $_POST["comment"]!=""){
        $sql="INSERT INTO `comments`(`idcomments`, `userid`, `comment`, `productid`, `state`, `type`) VALUES ('',".$_SESSION["user"]["userid"].",'".mysqli_real_escape_string($con,$_POST["comment"])."',".$_GET["id"].",1,'".$_GET["type"]."')";
        $con->query($sql);
        switch($_GET["type"]){
            case "book":
                $sql="UPDATE `books` SET `comments`=`comments`+1 WHERE `bookid`=".$_GET["id"];
                $con->query($sql);
                break;
            case "story":
                $sql="UPDATE `story` SET `comments`=`comments`+1 WHERE `storyid`=".$_GET["id"];
                $con->query($sql);
                break;
            case "toy"://added by Hussam Abu Khadijeh 18-05-2020 --- covid 19
                $sql="UPDATE `products` SET `comments`=`comments`+1 WHERE `productid`=".$_GET["id"];
                $con->query($sql);
                break;
            case "galleries":
                $sql="UPDATE `galleries` SET `comments`=`comments`+1 WHERE `id`=".$_GET["id"];
                $con->query($sql);
                break;
            case "events":
                $sql="UPDATE `events` SET `comments`=`comments`+1 WHERE `eventid`=".$_GET["id"];
                $con->query($sql);
                break;
        }
        $data=getComments($_GET["type"],$_GET["id"],"last");
        echo  json_encode($data);
    }else{
        echo 0;
    }

}
function addqustionanswer(){
    global $con;
    if(isset($_SESSION["user"]) && !empty($_SESSION["user"]) && isset($_POST["qustion"]) && $_POST["qustion"]!=""){
        $date = date("Y/m/d H:i:s", time());
        $sql="INSERT INTO `q_comment`(`id`, `iduser`, `qid`, `comment`, `date`, `state`) VALUES ('',".$_SESSION["user"]["userid"].",".$_GET["id"].",'".mysqli_real_escape_string($con,$_POST["qustion"])."','".$date."',1)";
        $con->query($sql);
        $sql="UPDATE `educationalinquiries` SET `comments`=`comments`+1 WHERE `id`=".$_GET["id"];
        $con->query($sql);
        echo  1;
    }else{
        echo 0;
    }

}





function getCities(){
    $soapClient = new SoapClient(SITE_URL.'APIs/aramex/Location-API-WSDL.wsdl');
    $params = array(
        'ClientInfo' => array(
            'AccountCountryCode' => 'JO',
            'AccountEntity' => Aramex_AccountEntity,
            'AccountNumber' => Aramex_account_number,
            'AccountPin' => Aramex_pin_number,
            'UserName' => Aramex_UserName,
            'Password' => Aramex_Password,
            'Version' => 'v1.0',
            'source'=>null
        ),

        'Transaction' 			=> array(
            'Reference1' => uniqid()
        ),
        'CountryCode'			=> $_GET["country"],

        'State'				=> NULL
    );

    // calling the method and printing results
    try {
        $auth_call = json_decode(json_encode($soapClient->FetchCities($params)),true);
        $options="";
        file_put_contents("api.tx",json_encode($auth_call));
        foreach($auth_call["Cities"]["string"] as $key=>$city){
            $options.='<option value="'.$city.'">'.$city.'</option>';
        }
        echo $options;

    } catch (SoapFault $fault) {
        die('Error : ' . $fault->faultstring);
    }
}

function subscribepay(){
    global $con;
    //just for renew
//    if(isset($_POST["renew"]) && (int)$_POST["renew"]==1){
//
//        $sql="SELECT `payments`.*,`payment_subscribe`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`userid`=".$_SESSION['user']['userid']." ORDER BY `payments`.`paymentid` DESC";
//        $result=$con->query($sql);
//        $oldsubscribe=mysqli_fetch_assoc($result);
//        if(strtotime($oldsubscribe["expire_date"])>=time()){
//            if((int)$_POST["usersAccounts"]<$oldsubscribe["students_allowed"]){
//                $freeUser=$oldsubscribe["students_allowed"]-$oldsubscribe["students_active"];
//                $downrageuser=$oldsubscribe["students_allowed"]-(int)$_POST["usersAccounts"];
//                if($downrageuser>$freeUser){
//                    $resultData["result"]=-2;
//                    $resultData["minimumuser"]=$oldsubscribe["students_allowed"]-$freeUser;
//                    echo json_encode($resultData);
//                    exit();
//                }
//            }
//        }
//    }elseif(isset($_POST["upgrade"]) && (int)$_POST["upgrade"]==1){
//        $sql="SELECT `payments`.*,`payment_subscribe`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`userid`=".$_SESSION['user']['userid']." ORDER BY `payments`.`paymentid` DESC";
//        $result=$con->query($sql);
//        $oldsubscribe=mysqli_fetch_assoc($result);
//        if(strtotime($oldsubscribe["expire_date"])>=time()){
//            if((int)$_POST["usersAccounts"]<$oldsubscribe["students_allowed"]){
//                $freeUser=$oldsubscribe["students_allowed"]-$oldsubscribe["students_active"];
//                $downrageuser=$oldsubscribe["students_allowed"]-(int)$_POST["usersAccounts"];
//                if($downrageuser>$freeUser){
//                    $resultData["result"]=-2;
//                    $resultData["minimumuser"]=$oldsubscribe["students_allowed"]-$freeUser;
//                    echo json_encode($resultData);
//                    exit();
//                }
//            }
//        }
//    }



    $_SESSION["subscribe_data"]=[];
    $_SESSION["subscribe_data"]["usersAccounts"]=(int)$_POST["usersAccounts"];
    $_SESSION["subscribe_data"]["months_years"]=(int)$_POST["months_years"];
    if($_POST["type"]=='Parents'){
        $type_user=0;
        if($_SESSION["subscribe_data"]["usersAccounts"]>3){
            $_SESSION["subscribe_data"]["usersAccounts"]=3;
        }elseif($_SESSION["subscribe_data"]["usersAccounts"]<1){
            $_SESSION["subscribe_data"]["usersAccounts"]=1;
        }
    }else{
        $type_user=1;
       if($_SESSION["subscribe_data"]["usersAccounts"]<10){
            $_SESSION["subscribe_data"]["usersAccounts"]=10;
        }
    }
    if($_POST["subscribe"]=='Monthly'){
        $type_cost=0;
    }else{
        $type_cost=1;
    }
    $sql = "SELECT * FROM `cost_subscribe` WHERE `type_user`=".$type_user." AND `type_cost`=".$type_cost;
    $result=$con->query($sql);
    $row=mysqli_fetch_assoc($result);


    $_SESSION["subscribe_data"]["id"]="subscribe".uniqid();
    $_SESSION["subscribe_data"]["type"]=$_POST["type"];
    $_SESSION["subscribe_data"]["total"]= $_SESSION["subscribe_data"]["usersAccounts"]*$row["cost"]*$_SESSION["subscribe_data"]["months_years"];
    $_SESSION["subscribe_data"]["GrandTotal"]=$_SESSION["subscribe_data"]["total"];
    $_SESSION["subscribe_data"]["cost"]=$row["cost"]*$_SESSION["subscribe_data"]["usersAccounts"];
    $_SESSION["subscribe_data"]["costperuser"]=$row["cost"];
    $_SESSION["subscribe_data"]["subscribe"]=$_POST["subscribe"];

    $_SESSION["shipping_info"]["GrandTotal"]=$_SESSION["subscribe_data"]["total"];
    $resultData["result"]=1;
    echo json_encode($resultData);
    exit();
   // $_SESSION["shipping_info"]["payment_option"]="MASTERCARD";
}

function payfort_tokenization(){

    global  $lang_code;

    $_SESSION["shipping_info"]=json_decode($_POST["data"],true);
    $_SESSION["shipping_info"]["subscribe"]=0;
    $_SESSION["payment"]["items_price"]=prepareProductsPayment($_SESSION["shipping_info"]["items"]);
    validateCart($_SESSION["shipping_info"]);
    $_SESSION["user"]["ip"]=getIPAddress();
    $_SESSION["tokenization_data"]=[];
    $_SESSION["tokenization_data"]["service_command"]="TOKENIZATION";
    $_SESSION["tokenization_data"]["access_code"]=Payfort_Access_Code;
    $_SESSION["tokenization_data"]["merchant_identifier"]=Payfort_Identifire;
    $_SESSION["tokenization_data"]["merchant_reference"]="Mp".uniqid();
    //$_SESSION["tokenization_data"]["merchant_reference"]="Mp1";
    $_SESSION["tokenization_data"]["language"]=$lang_code;
    $_SESSION["tokenization_data"]["return_url"]=Payfort_Return_URL;
    $_SESSION["tokenization_data"]["token_name"]=Payfort_Token_Name;
    $_SESSION["tokenization_data"]["signature"]=calculateSignature($_SESSION["tokenization_data"],"request");
    //$_SESSION["tokenization_data"]["expiry_date"]=$_SESSION["shipping_info"]["exp_date"];

    echo json_encode($_SESSION["tokenization_data"]);
}
function payfort_sub_tokenization(){

    global  $lang_code;

    $_SESSION["shipping_info"]=json_decode($_POST["data"],true);
    $_SESSION["shipping_info"]["subscribe"]=1;
   // validateCart($_SESSION["shipping_info"]);
    $_SESSION["user"]["ip"]=getIPAddress();
    $_SESSION["tokenization_data"]=[];
    $_SESSION["tokenization_data"]["service_command"]="TOKENIZATION";
    $_SESSION["tokenization_data"]["access_code"]=Payfort_Access_Code;
    $_SESSION["tokenization_data"]["merchant_identifier"]=Payfort_Identifire;
    $_SESSION["tokenization_data"]["merchant_reference"]="subscribe".uniqid();
    $_SESSION["tokenization_data"]["language"]=$lang_code;
    $_SESSION["tokenization_data"]["return_url"]=Payfort_Return_URL;
    $_SESSION["tokenization_data"]["token_name"]=Payfort_Token_Name;
    $_SESSION["tokenization_data"]["signature"]=calculateSignature($_SESSION["tokenization_data"],"request");
    //$_SESSION["tokenization_data"]["expiry_date"]=$_SESSION["shipping_info"]["exp_date"];
    if(isset($_GET["type"]) && $_GET["type"]=="subscribe"){
        getUserInfo();
    }
    echo json_encode($_SESSION["tokenization_data"]);
}
function payfort_invoice_tokenization(){
    global  $lang_code;

    $_SESSION["shipping_info"]=json_decode($_POST["data"],true);
    $_SESSION["shipping_info"]["invoice"]=1;
   // validateCart($_SESSION["shipping_info"]);
    $_SESSION["invoice"]["payment_option"]= $_SESSION["shipping_info"]["payment_option"];
    $_SESSION["user"]["ip"]=getIPAddress();
    $_SESSION["tokenization_data"]=[];
    $_SESSION["tokenization_data"]["service_command"]="TOKENIZATION";
    $_SESSION["tokenization_data"]["access_code"]=Payfort_Access_Code;
    $_SESSION["tokenization_data"]["merchant_identifier"]=Payfort_Identifire;
    $_SESSION["tokenization_data"]["merchant_reference"]="subscribe".uniqid();
    $_SESSION["tokenization_data"]["language"]=$lang_code;
    $_SESSION["tokenization_data"]["return_url"]=Payfort_Return_URL;
    $_SESSION["tokenization_data"]["token_name"]=Payfort_Token_Name;
    $_SESSION["tokenization_data"]["signature"]=calculateSignature($_SESSION["tokenization_data"],"request");
    //$_SESSION["tokenization_data"]["expiry_date"]=$_SESSION["shipping_info"]["exp_date"];
    echo json_encode($_SESSION["tokenization_data"]);
}
function getUserInfo(){
    $_SESSION["shipping_info"]["Shipping"]=0;
    $_SESSION["payment"]["shipping"]='NONE';
    $_SESSION["shipping_info"]["GrandTotal"]=$_SESSION["subscribe_data"]["GrandTotal"];
    $_SESSION["shipping_info"]["shipping_fullname"]=$_SESSION["user"]["fullname"];
    $_SESSION["shipping_info"]["shipping_address2"]="";
    $_SESSION["shipping_info"]["shipping_city"]="";
    $_SESSION["shipping_info"]["shipping_state"]="";
    $_SESSION["shipping_info"]["shipping_post"]="";
    $_SESSION["shipping_info"]["shipping_country"]=$_SESSION["user"]["country"];
    $_SESSION["shipping_info"]["weight"]=0;
    $_SESSION["shipping_info"]["shipping_mobile"]=$_SESSION["user"]["phone"];
    $_SESSION["shipping_info"]["contents"]='soft';
    $_SESSION["shipping_info"]["shipping_country_code"]=$_SESSION["user"]["country"];
    $_SESSION["shipping_info"]["shipping_phone"]=$_SESSION["user"]["phone"];
    $_SESSION["shipping_info"]["cart_fullname"]=$_SESSION["user"]["fullname"];
    $_SESSION["shipping_info"]["cart_email"]=$_SESSION["user"]["email"];
    $_SESSION["shipping_info"]["cart_mobile"]=$_SESSION["user"]["phone"];
    $_SESSION["shipping_info"]["cart_phone"]=$_SESSION["user"]["cart_phone"];
    $_SESSION["shipping_info"]["cart_country"]=$_SESSION["user"]["country"];
    $_SESSION["shipping_info"]["cart_city"]="";
    $_SESSION["shipping_info"]["cart_state"]="";
    $_SESSION["shipping_info"]["cart_post"]="";
    $_SESSION["shipping_info"]["cart_address1"]="";
    $_SESSION["shipping_info"]["cart_address2"]="";
    $_SESSION["shipping_info"]["total"]=$_SESSION["subscribe_data"]["GrandTotal"];
    $_SESSION["shipping_info"]["tax"]=0;
    $_SESSION["shipping_info"]["cod"]=0;
}

function getIPAddress(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function downloadteacherbook(){
    global $con;
    if(!isset($_SESSION["user"]) || empty($_SESSION["user"])){
        echo "-1";
        exit();
    }

    if(isset($_SESSION["user"]["permession"]) && in_array($_SESSION["user"]["permession"], array(2, 6, 11,10, 1,9))){//allow teachers , admins , special users , data entry to download
        $_SESSION["allow_download"]["book"]=$_POST["bookid"];
        echo 1;
        exit();
    }

    $sql="SELECT `codes_user`.*,`apps_codes`.* FROM `apps_codes` INNER JOIN `codes_user` ON `apps_codes`.`codeid`=`codes_user`.`codeid` WHERE `apps_codes`.`type`='teacherbook' AND `apps_codes`.`refid`=".$_POST["bookid"]." AND `apps_codes`.`startdate` < CURDATE() AND  `apps_codes`.`enddate`>CURDATE() AND `apps_codes`.`code`=".$_POST["code"]." AND `codes_user`.`userid`=".$_SESSION["user"]["userid"];
    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        //download
        $_SESSION["allow_download"]["book"]=$_POST["bookid"];
        echo 1;
    }else{
        $sql="SELECT `codes_user`.*,`apps_codes`.* FROM `apps_codes` INNER  JOIN `codes_user` ON `apps_codes`.`codeid`=`codes_user`.`codeid` WHERE `apps_codes`.`code`=".$_POST["code"]." AND `codes_user`.`userid`=".$_SESSION["user"]["userid"];
        $result=$con->query($sql);
        if(mysqli_num_rows($result)>0){
            $_SESSION["allow_download"]["book"]=$_POST["bookid"];
            echo 1;
        }else{
            $sql="SELECT COUNT(`codes_user`.`cuid`) as codescount,`apps_codes`.* FROM `apps_codes` LEFT OUTER JOIN `codes_user` ON `apps_codes`.`codeid`=`codes_user`.`codeid` WHERE `apps_codes`.`code`=".$_POST["code"]." GROUP BY `apps_codes`.`codeid`";
            $result=$con->query($sql);
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                if($row["codescount"]<$row["countofuser"]){
                    $sql="INSERT INTO `codes_user`(`cuid`, `codeid`, `userid`, `regdate`) VALUES ('',".$row["codeid"].",".$_SESSION["user"]["userid"].",CURDATE())";
                    $con->query($sql);
                    $_SESSION["allow_download"]["book"]=$_POST["bookid"];
                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                echo 0;
            }
        }
    }
}

function schoolorder(){
    global $con;
    global $session_lang;
    global $lang_code;
    $ref="subscribe_".uniqid();
    $data= json_decode($_POST["data"],true);
    if(isset($data["donate"]) && $data["donate"]>0){
        $_SESSION["subscribe_data"]["donate"]=1;
    }else{
        $_SESSION["subscribe_data"]["donate"]=0;
    }
    $grandTotal= $_SESSION["subscribe_data"]["GrandTotal"]+ $_SESSION["subscribe_data"]["donate"];
    $sql = "INSERT INTO `payments`(`paymentid`, `userid`, `total_price`, `status`, `payment_date`,`manhal_ref`, `payment_type`, `RecieverCompanyName`, `RecieverAttention`, `Address1`,
 `City`, `Country`,`Phone`, `DeclaredValue`, `exported`, `Countrycode`,`billing_mobile`, `products_price`) VALUES (''," . $_SESSION["user"]["userid"] . "," . $grandTotal . ",0,NOW(),'".$ref."','cash','".mysqli_real_escape_string($con,$data["school_name"])."',
 '".mysqli_real_escape_string($con,$data["full_name"])."', '".mysqli_real_escape_string($con,$data["address"])."','".mysqli_real_escape_string($con,$data["city"])."',
 '".mysqli_real_escape_string($con,$data["country"])."','".mysqli_real_escape_string($con,$data["phone"])."'," . $grandTotal . ",0,'".mysqli_real_escape_string($con,$data["countrycode"])."',
 '".mysqli_real_escape_string($con,$data["mobile"])."'," . $grandTotal . ")";

    //echo $sql;$_SESSION["shipping_info"]["shipping"]
    $result=[];
    if ($con->query($sql)) {
        $paymentid = mysqli_insert_id($con);
        $sql = "UPDATE `payments` SET `Productcode`='" . $paymentid . "' WHERE `paymentid`=" . $paymentid;
        $con->query($sql);
        inserPaymentSubscribe($paymentid);
        $_SESSION["checkout"] = "success";
        $result["result"]=1;
    }else{
        $result["result"]=0;
        $result["sql"]=$sql;
        $result["error"]="Unexpected error occurred Err:051020170230";
    }
    echo json_encode($result);
}



function activateuser(){
    global $con;
    global $Lang;
    $resultData=array("result"=>0,"msg"=>"");
    $sql="SELECT `payment_subscribe`.*,`payments`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`status`=1 AND `payment_subscribe`.`users_code`='".mysqli_real_escape_string($con,$_POST["code"])."'";

    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        if(strtotime($row["expire_date"])>time()){
            if($row["students_active"]<$row["students_allowed"]){
                $sql="UPDATE `users` SET `permession`=10,`activation_code`='".mysqli_real_escape_string($con,$_POST["code"])."' WHERE `userid`=".$_SESSION["user"]["userid"];
                if($con->query($sql)){
                    $_SESSION["user"]["permession"]=10;
                    $sql="UPDATE `payment_subscribe` SET `students_active`=`students_active`+1 WHERE `psid`=".$row["psid"];
                    if($con->query($sql)){
                        $resultData["result"]=1;
                    }else{//Unexpected Error
                        $resultData["result"]=0;
                        $resultData["msg"]=(string)$Lang->UnexpectedError." Err: 1910171135";
                    }
                }else{//Unexpected Error
                    $resultData["result"]=0;
                    $resultData["msg"]=(string)$Lang->UnexpectedError." Err: 1910171136";
                }
            }else{//account reach maximum allowed
                $resultData["result"]=0;
                $resultData["msg"]=(string)$Lang->AccountMaximumReachStudent;
            }
        }else{//code expiered
            $resultData["result"]=0;
            $resultData["msg"]=(string)$Lang->AccountCodeExpiered;
        }
    }else{//invalid code for studen check for teacher
        $sql="SELECT `payment_subscribe`.*,`payments`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`status`=1 AND `payment_subscribe`.`teachers_code`='".mysqli_real_escape_string($con,$_POST["code"])."'";
        $result=$con->query($sql);
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            if(strtotime($row["expire_date"])>time()){
                if($row["teachers_active"]<$row["teachers_allowed"]){
                    $sql="UPDATE `users` SET `permession`=11,`activation_code`='".mysqli_real_escape_string($con,$_POST["code"])."' WHERE `userid`=".$_SESSION["user"]["userid"];
                    if($con->query($sql)){
                        $_SESSION["user"]["permession"]=11;
                        $sql="UPDATE `payment_subscribe` SET `teachers_active`=`teachers_active`+1 WHERE `psid`=".$row["psid"];
                        if($con->query($sql)){
                            $resultData["result"]=1;
                        }else{//Unexpected Error
                            $resultData["result"]=0;
                            $resultData["msg"]=(string)$Lang->UnexpectedError." Err: 1910171135";
                        }
                    }else{//Unexpected Error
                        $resultData["result"]=0;
                        $resultData["msg"]=(string)$Lang->UnexpectedError." Err: 1910171136";
                    }
                }else{//account reach maximum allowed
                    $resultData["result"]=0;
                    $resultData["msg"]=(string)$Lang->AccountMaximumReachTeacher;
                }
            }else{//code expiered
                $resultData["result"]=0;
                $resultData["msg"]=(string)$Lang->AccountCodeExpiered;
            }
        }else{//invalid code for studen check for app_codes
            $sql="SELECT * FROM `apps_codes` WHERE `type`='subscribe' AND `status`=1 AND `code`='".mysqli_real_escape_string($con,$_POST["code"])."'";
            $result=$con->query($sql);
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                if(strtotime($row["enddate"])>time()){
                    $sql2="SELECT * FROM `codes_user` WHERE `codeid`=".$row["codeid"];
                    $result2=$con->query($sql2);
                    if(mysqli_num_rows($result2)<$row["countofuser"]){
                        $sql="INSERT INTO `codes_user`(`cuid`, `codeid`, `userid`, `regdate`) VALUES ('',".$row["codeid"].",".$_SESSION["user"]["userid"].",CURDATE())";
                        if($con->query($sql)){
                            $sql="UPDATE `users` SET `permession`=11,`activation_code`='".mysqli_real_escape_string($con,$_POST["code"])."' WHERE `userid`=".$_SESSION["user"]["userid"];
                            $_SESSION["user"]["permession"]=11;
                            $con->query($sql);
                            if(mysqli_num_rows($result2)<1){
                                $days=$row["refid"]*30;
                                $sql="UPDATE `apps_codes` SET `enddate`=ADDDATE(CURDATE(), INTERVAL ".$days." DAY),`activation_code`='".mysqli_real_escape_string($con,$_POST["code"])."' WHERE `userid`=".$_SESSION["user"]["userid"];
                                $con->query($sql);
                            }
                            $resultData["result"]=1;
                        }else{//Unexpected Error
                            $resultData["result"]=0;
                            $resultData["msg"]=(string)$Lang->UnexpectedError." Err: 2103180237";
                        }
                    }else{
                        $resultData["result"]=0;
                        $resultData["msg"]=(string)$Lang->AccountMaximumReachStudent;
                    }
                }else{
                    $resultData["result"]=0;
                    $resultData["msg"]=(string)$Lang->AccountCodeExpiered;
                }
            }else{
                $resultData["result"]=0;
                $resultData["msg"]=(string)$Lang->InvalidActivationCode;
            }


        }
    }

    echo json_encode($resultData);
}
function deletequiz(){
    global $con;
    if ($_SESSION['user']['permession'] == 1) {
        $weruser = '';
    } else {
        $weruser = " and userid=".$_SESSION['user']['userid'];
    }
    $sql = "Select * FROM `quiz` WHERE `quizid`=".$_POST['quizid'].$weruser;
    $result = $con->query($sql);
    $num_rows=mysqli_num_rows($result);
    if($num_rows>0){
        if($con->query("DELETE FROM `quiz` WHERE `quizid`=".$_POST['quizid'])){
            $con->query("DELETE FROM `questions` WHERE `quizid`=".$_POST['quizid']);
            if(is_dir("../quiz/".$_POST['quizid']."/")){
                removeDirectory("../quiz/".$_POST['quizid']."/");
            }
            $resultData["result"]=1;
        }else{
            $resultData["result"]=0;
            $resultData["msg"]="sqlerror";
        }
    }else{
        $resultData["result"]=-1;
        $resultData["msg"]="no permession";
    }

    echo json_encode($resultData);
}

function ViewMediaFullscreen(){

    global $con;
    global $lang_code;
    global $cat_code;
    $sql = "Select media.*, categories.name_ar, categories.name_en From media Inner Join categories On media.category = categories.catid   where  media.status=1 and media.id=" . $_GET['id'];
    $result = $con->query($sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['price'] > 0 && Areyousubscribe() == 0) {
        echo json_encode(array("href"=>0));
        //return 0;
    }
    $sql2 = "UPDATE `media` SET `download`=`download`+1 WHERE id=" .  $_GET['id'];

    $con->query($sql2);



    if($row["is_playlist"]==1){
        $hrf =SITE_URL.$lang_code.'/playlist/'.$row['id'].'/'.str_replace(" ","-",$row['title_'.$cat_code]);
    }elseif ($row["is_story"]){
        $hrf = "".SITE_URL . $lang_code . '/story/' . $row['productid'] . '/' . str_replace(" ", "-", $row['title_'.$lang_code]);
    }elseif($row["path"] == "") {
        if($row['filename']!=''){
            $hrf = "" . SITE_URL . 'platform/media/' . $row['id'] . '/' . $row['filename'] . ".html";
        }else{
            $hrf = "" . SITE_URL . 'platform/media/' . $row['id'] . '/index.html';
        }

    } else {
        $hrf = "" . SITE_URL . '/' . $row["path"];
    }
    insertShowMedia($_GET['id'],'media',$hrf);
    //echo $hrf;
    echo json_encode(array("href"=>$hrf,"newtab"=>$row['is_newtab'],"is_playlist"=>$row['is_playlist']));
}

function insertShowMedia($id,$type,$href){
    global $con;
    if(session_status()==PHP_SESSION_NONE){
        session_start();
    }
    $userid=-1;
    if(isset($_SESSION['user'])){
        $userid=$_SESSION['user']['userid'];
    }
    $sql = "INSERT INTO `users_views`(`userid`, `media`, `type`, `date`,`href`) VALUES ($userid,".$id.",'".$type."',NOW(),'".mysqli_real_escape_string($con,$href)."')";
    $con->query($sql);

}

?>
