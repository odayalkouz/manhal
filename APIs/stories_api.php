<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 12/11/2017
 * Time: 03:02 م
 */

if(session_status()==PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION["lang"])){
    $_SESSION["lang"]="En";
}
if(isset($_POST["lang"]) && $_POST["lang"]!=""){
    $lang_code=strtolower($_SESSION["lang"]);
    $Lang= simplexml_load_file("language/".$_SESSION["lang"].".xml");
}

include_once "platform/config.php";
include_once "includes/function.php";

if(isset($_POST['process'])){
    if(isset($_POST["secret"]) && $_POST["secret"]==API_SECRET){
        $_POST['process']();
    }else{
        $result["result"]=-5;
        $result["msg"]="invalid API secret";
        echo json_encode($result);
    }
}
function signup(){
    global $con;
    global $Lang;
    $msg="";
    $countryCode=getIp("");
    if(!isset($_POST["email"]) || trim($_POST["email"])==""){
        $msg.=$Lang->pleaseInsertYourEmail."<br>";
    }

    if(!isset($_POST["pass"]) || trim($_POST["pass"])==""){
        $msg.=$Lang->CannotPasswordEmpty."<br>";
    }

    $sql="SELECT * FROM `users` WHERE `email`='".mysqli_real_escape_string($con,$_POST['email'])."'";
    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        $resultData["result"]=-2;
        $resultData["msg"]=-2;
    }else{
        $sql="SELECT `payment_subscribe`.*,`payments`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`status`=1 AND `payment_subscribe`.`users_code`='".mysqli_real_escape_string($con,$_POST["code"])."'";
        $sql2="SELECT `payment_subscribe`.*,`payments`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`status`=1 AND `payment_subscribe`.`users_code`='".mysqli_real_escape_string($con,$_POST["code"])."'";
        $result=$con->query($sql);
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            if(strtotime($row["expire_date"])>time()){
                if($row["students_active"]<$row["students_allowed"]){
                    $ad='';
                    if(isset($_SESSION["ad"]) && $_SESSION["ad"]!=""){
                        $ad=$_SESSION["ad"];
                    }

                    $sql="INSERT INTO `users`(`userid`,`email`, `password`, `status`,`cdate`, `views_count`, `sales_count`,`country`,`page`,`permession`,`activation_code`,`ads`) VALUES ('','".mysqli_real_escape_string($con,$_POST['email'])."','".$_POST['pass']."',1,CURDATE(),0,0,'".$countryCode."','ebook',10,'".mysqli_real_escape_string($con,$_POST["code"])."','".$ad."')";
                    if($con->query($sql)){
                        $userid=$con->insert_id;
                        $_SESSION["user"]["permession"]=10;
                        $sql="UPDATE `payment_subscribe` SET `students_active`=`students_active`+1 WHERE `psid`=".$row["psid"];
                        if($con->query($sql)){
                            $resultData["result"]=1;

                        }else{//Unexpected Error
                            $resultData["result"]=0;
                            $resultData["msg"]=(string)$Lang->UnexpectedError." Err: 1311171135";
                        }
                    }else{//Unexpected Error
                        $resultData["result"]=-2;
                        $resultData["msg"]=(string)$Lang->UnexpectedError." Err: 1311171136";
                    }
                }else{//account reach maximum allowed
                    $resultData["result"]=-3;
                    $resultData["msg"]=(string)$Lang->AccountMaximumReachStudent;
                }
            }else{//code expiered
                $resultData["result"]=-4;
                $resultData["msg"]=(string)$Lang->AccountCodeExpiered;
            }
        }else{//invalid code for studen check for teacher
            $sql="SELECT `payment_subscribe`.*,`payments`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`status`=1 AND `payment_subscribe`.`teachers_code`='".mysqli_real_escape_string($con,$_POST["code"])."'";
            $result=$con->query($sql);
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                if(strtotime($row["expire_date"])>time()){
                    if($row["teachers_active"]<$row["teachers_allowed"]){
                        $sql="INSERT INTO `users`(`userid`,`email`, `password`, `status`,`cdate`, `views_count`, `sales_count`,`country`,`page`,`permession`,`activation_code`) VALUES ('','".mysqli_real_escape_string($con,$_POST['email'])."','".$_POST['pass']."',1,CURDATE(),0,0,'".$countryCode."','ebook',11,'".mysqli_real_escape_string($con,$_POST["code"])."')";
                        if($con->query($sql)){
                            $userid=$con->insert_id;
                            $_SESSION["user"]["permession"]=11;
                            $sql="UPDATE `payment_subscribe` SET `teachers_active`=`teachers_active`+1 WHERE `psid`=".$row["psid"];
                            if($con->query($sql)){
                                $resultData["result"]=1;
                            }else{//Unexpected Error
                                $resultData["result"]=-5;
                                $resultData["msg"]=(string)$Lang->UnexpectedError." Err: 1311171135";
                            }
                        }else{//Unexpected Error
                            $resultData["result"]=-6;
                            $resultData["msg"]=(string)$Lang->UnexpectedError." Err: 1311171136";
                        }
                    }else{//account reach maximum allowed
                        $resultData["result"]=-7;
                        $resultData["msg"]=(string)$Lang->AccountMaximumReachTeacher;
                    }
                }else{//code expiered
                    $resultData["result"]=-8;
                    $resultData["msg"]=(string)$Lang->AccountCodeExpiered;
                }

            }else{//invalid code for teacher and student check code

                if(isset($_POST["bookid"]) && $_POST["bookid"]!=""){
                    //$sql="SELECT * FROM `apps_codes` WHERE `startdate` < CURDATE() AND `type`='book' AND `refid`=".$_POST["bookid"]." AND `status`=1 AND `code`='".mysqli_real_escape_string($con,$_POST["code"])."'";
                    $sql="SELECT * FROM `apps_codes` WHERE `type`='story' AND `refid`=".$_POST["bookid"]." AND `status`=1 AND `code`='".mysqli_real_escape_string($con,$_POST["code"])."'";
                    $result=$con->query($sql);
                    if(mysqli_num_rows($result)>0){
                        $row=mysqli_fetch_assoc($result);
                        $codeid=$row["codeid"];
                        if(strtotime($row["enddate"])>time()){
                            $sql2="SELECT * FROM `codes_user` WHERE `codeid`=".$row["codeid"];
                            $result2=$con->query($sql2);
                            if(mysqli_num_rows($result2)<$row["countofuser"]){
                                //signup
                                $sql="INSERT INTO `users`(`userid`,`email`, `password`, `status`,`cdate`, `views_count`, `sales_count`,`country`,`page`,`permession`,`activation_code`)
 VALUES ('','".mysqli_real_escape_string($con,$_POST['email'])."','".$_POST['pass']."',1,CURDATE(),0,0,'".$countryCode."','estories',0,'".mysqli_real_escape_string($con,$_POST["code"])."')";
                                $con->query($sql);
                                    $userid=$con->insert_id;

                                $sql ="SELECT * FROM users WHERE `userid`=".$userid;

                                $result = $con->query($sql);
                                $row = mysqli_fetch_assoc($result);
                                $_SESSION["user"]=$row;

                                $sql="INSERT INTO `codes_user`(`cuid`, `codeid`, `userid`, `regdate`) VALUES ('',".$codeid.",".$_SESSION["user"]["userid"].",CURDATE())";
                                if($con->query($sql)){
                                    $resultData["result"]=1;
                                }else{//Unexpected Error
                                    $resultData["result"]=-9;
                                    $resultData["msg"]=(string)$Lang->UnexpectedError." Err: 2103180238".$sql;
                                }
                            }else{
                                $resultData["result"]=-10;
                                $resultData["msg"]=(string)$Lang->AccountMaximumReachTeacher;
                            }
                        }else{
                            $resultData["result"]=-11;
                            $resultData["msg"]=(string)$Lang->AccountCodeExpiered;
                        }
                    }else{//check for series code

                        $sql="SELECT * FROM `apps_codes` WHERE `type`='series' AND `refid`=(SELECT `seriesid` from story where storyid=".$_POST["bookid"].") AND `status`=1 AND `code`='".mysqli_real_escape_string($con,$_POST["code"])."'";
                        $result=$con->query($sql);
                        if(mysqli_num_rows($result)>0){
                            $row=mysqli_fetch_assoc($result);
                            $codeid=$row["codeid"];
                            if(strtotime($row["enddate"])>time()){
                                $sql2="SELECT * FROM `codes_user` WHERE `codeid`=".$row["codeid"];
                                $result2=$con->query($sql2);
                                if(mysqli_num_rows($result2)<$row["countofuser"]){
                                    //signup
                                    $sql="INSERT INTO `users`(`userid`,`email`, `password`, `status`,`cdate`, `views_count`, `sales_count`,`country`,`page`,`permession`,`activation_code`)
 VALUES ('','".mysqli_real_escape_string($con,$_POST['email'])."','".$_POST['pass']."',1,CURDATE(),0,0,'".$countryCode."','estories',0,'".mysqli_real_escape_string($con,$_POST["code"])."')";
                                    $con->query($sql);
                                    $userid=$con->insert_id;

                                    $sql ="SELECT * FROM users WHERE `userid`=".$userid;

                                    $result = $con->query($sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $_SESSION["user"]=$row;

                                    $sql="INSERT INTO `codes_user`(`cuid`, `codeid`, `userid`, `regdate`) VALUES ('',".$codeid.",".$_SESSION["user"]["userid"].",CURDATE())";
                                    if($con->query($sql)){
                                        $resultData["result"]=1;
                                    }else{//Unexpected Error
                                        $resultData["result"]=-12;
                                        $resultData["msg"]=(string)$Lang->UnexpectedError." Err: 2103180238".$sql;
                                    }
                                }else{
                                    $resultData["result"]=-13;
                                    $resultData["msg"]=(string)$Lang->AccountMaximumReachTeacher;
                                }
                            }else{
                                $resultData["result"]=-14;
                                $resultData["msg"]=(string)$Lang->AccountCodeExpiered;
                            }
                        }else{
                            $resultData["result"]="-15".$sql;
                            $resultData["msg"]=(string)$Lang->InvalidActivationCode;
                        }
                    }
                }else{
                    $resultData["result"]=-16;
                    $resultData["msg"]=(string)$Lang->InvalidActivationCode;
                    $resultData["sql"]=$sql2;
                }

            }
        }
    }

    if(isset($resultData["result"]) && $resultData["result"]==1){
        $sql="SELECT `userid`,`uname`,`email`,`permession`,`avatar`,`activation_code` FROM `users` WHERE `userid`=".$userid;
        $result=$con->query($sql);
        $resultData["user"]=mysqli_fetch_assoc($result);
    }
    echo json_encode($resultData);
}
function canread(){
    //covid-19 corona update :)
//    echo 1;
//    exit();

    global $con;
    if($_SESSION["user"]["permession"]>0 && $_SESSION["user"]["permession"]<=12){
        echo 1;
        exit();
    }
    if(isset($_SESSION["user"]["userid"])){
        if($_SESSION["user"]["userid"]<=15){
            echo 1;
        }else{
            switch($_GET["type"]){
                case "book":
                    $sql="SELECT `bookid`,`price`,`eprice`,`iprice`,`booktype` from `books` WHERE `bookid`=".$_GET['bookid'];
                    $result=$con->query($sql);
                    $row=mysqli_fetch_assoc($result);
                    if(calcItemPrice($row,$row["booktype"])>0){
                        if(isset($_SESSION["user"]["userid"])){
                            if($_SESSION["user"]["userid"]==6){//for hayat
                                echo 1;
                                exit();
                            }
                            $sql="SELECT `payments`.`userid`,`payments_books`.`paymentid`,`payments_books`.`bookid` FROM `payments` JOIN  `payments_books` on `payments`.`paymentid`=`payments_books`.`paymentid` where `payments`.`userid`=".$_SESSION["user"]["userid"]." AND `payments_books`.`itemtype`='book' AND `payments_books`.`bookid`=".$_GET["bookid"];
                            $result=$con->query($sql);
                            if(mysqli_num_rows($result)>0){
                                echo 1;
                            }else{
                                $sql="SELECT `apps_codes`.*, `codes_user`.* FROM `apps_codes` INNER JOIN `codes_user` ON `apps_codes`.`codeid`=`codes_user`.`codeid` WHERE `apps_codes`.`type`='book'
 AND `apps_codes`.`refid`=".$_GET["bookid"]." AND `apps_codes`.`enddate` > NOW() AND status=1 AND `codes_user`.`userid`=".$_SESSION["user"]["userid"];
                                    $result=$con->query($sql);
                                    if(mysqli_num_rows($result)>0){
                                        echo 1;
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
//                    $sql="SELECT `storyid`,`price`,`eprice`,`iprice`,`booktype` from `story` WHERE `storyid`=".$_GET['bookid'];
//                    $result=$con->query($sql);
//                    $row=mysqli_fetch_assoc($result);
//                    if(calcItemPrice($row,$row["booktype"])>0){

                    if($_SESSION["user"]["permession"]>0 && $_SESSION["user"]["permession"]<=12){
                        echo 1;
                    }else{
                        if(isset($_SESSION["user"]["userid"])){
                            $sql="SELECT `payments`.`userid`,`payments_books`.`paymentid`,`payments_books`.`bookid` FROM `payments` JOIN  `payments_books` on `payments`.`paymentid`=`payments_books`.`paymentid` where `payments`.`userid`=".$_SESSION["user"]["userid"]." AND `payments_books`.`itemtype`='story' AND  `payments_books`.`bookid`=".$_GET["bookid"];
                            $result=$con->query($sql);
                            if(mysqli_num_rows($result)>0){
                                echo 1;
                            }else{
                                $sql="SELECT `apps_codes`.*, `codes_user`.* FROM `apps_codes` INNER JOIN `codes_user` ON `apps_codes`.`codeid`=`codes_user`.`codeid` WHERE `apps_codes`.`type`='book'
 AND `apps_codes`.`refid`=".$_GET["bookid"]." AND `apps_codes`.`enddate` > NOW() AND status=1 AND `codes_user`.`userid`=".$_SESSION["user"]["userid"];
                                $result=$con->query($sql);
                                if(mysqli_num_rows($result)>0){
                                    echo 1;
                                }else{
                                    echo 0;
                                }
                            }
                        }else{
                            echo 0;
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

        $message=file_get_contents("templates/forget_pass_".ucfirst($_POST["lang"]).".html");
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
            $resultData["result"]=1;
        }else{
            $resultData["result"]=-1;
            $resultData["msg"]=$Lang->CannotSendEmail;
        }
    }else{
        $resultData["result"]=0;
    }
    echo json_encode($resultData);
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
function login(){
    global $con;
    $sql="SELECT `userid`,`uname`,`email`,`permession`,`avatar`,`activation_code` FROM `users` WHERE  (email='".mysqli_real_escape_string($con,$_POST['email'])."' OR uname='".mysqli_real_escape_string($con,$_POST['email'])."') and password='".$_POST['pass']."'";

    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["user"]=$row;
        if($_SESSION["user"]["permession"]>0 && $_SESSION["user"]["permession"]<=12){
            $resultData["result"]=1;
            $_SESSION["user"]=$row;
            $resultData["user"]=$row;
            $sql="UPDATE `users` SET `lastlogin`=NOW() WHERE userid=".$row["userid"];
            $con->query($sql);
        }else{
            $sql="SELECT `apps_codes`.*, `codes_user`.* FROM `apps_codes` INNER JOIN `codes_user` ON `apps_codes`.`codeid`=`codes_user`.`codeid` WHERE `apps_codes`.`type`='story'
 AND `apps_codes`.`refid`=".$_POST["bookid"]." AND `apps_codes`.`enddate` > NOW() AND status=1 AND `codes_user`.`userid`=".$row["userid"];
            $resultData["sql"]=$sql;
            $result=$con->query($sql);
            if(mysqli_num_rows($result)>0){
                $resultData["result"]=1;
                $_SESSION["user"]=$row;
                $resultData["user"]=$row;
                $sql="UPDATE `users` SET `lastlogin`=NOW() WHERE userid=".$row["userid"];
                $con->query($sql);
            }else{//check for series
                $sql="SELECT `apps_codes`.*, `codes_user`.* FROM `apps_codes` INNER JOIN `codes_user` ON `apps_codes`.`codeid`=`codes_user`.`codeid` WHERE `apps_codes`.`type`='series'
 AND `apps_codes`.`refid`=(SELECT `seriesid` from story where storyid=".$_POST["bookid"].") AND `apps_codes`.`enddate` > NOW() AND status=1 AND `codes_user`.`userid`=".$row["userid"];
                $resultData["sql"]=$sql;
                $result=$con->query($sql);
                if(mysqli_num_rows($result)>0){
                    $resultData["result"]=1;
                    $_SESSION["user"]=$row;
                    $resultData["user"]=$row;
                    $sql="UPDATE `users` SET `lastlogin`=NOW() WHERE userid=".$row["userid"];
                    $con->query($sql);
                }else{//check for series
                    $resultData["result"]=-2;
                }
            }
        }
    }else{
        $resultData["result"]=-1;
    }
    echo json_encode($resultData);
}
function checklogin(){
    global $con;
    if(isset($_POST["userid"]) && $_POST["userid"]!=null && $_POST["userid"]!="null" && $_POST["userid"]!="" && isset($_POST["app_secret"])){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,SITE_URL."APIs/manhal/secret.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "process=secret");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_secret = curl_exec ($ch);
        curl_close ($ch);
        if($_POST["app_secret"]==$server_secret){
            $sql="SELECT `userid`,`uname`,`email`,`permession`,`avatar`,`activation_code` FROM `users` WHERE `userid`=".$_POST["userid"];
            $result=$con->query($sql);
            $row=mysqli_fetch_assoc($result);
            $_SESSION["user"]=$row;
            if($_SESSION["user"]["permession"]>0 && $_SESSION["user"]["permession"]<=12){
                $resultData["result"]=1;
                $resultData["user"]=$row;
            }else{
                $resultData["result"]=-1;
            }
        }else{
            $resultData["result"]=-2;
            $resultData["msg"]="invalid secret";
            $resultData["server_secret"]=$server_secret;
        }
    }else{
        if(isset($_SESSION["user"]) && !empty($_SESSION["user"])){
            $resultData["result"]=1;
            $resultData["user"]=$_SESSION["user"];
        }else{
            $resultData["result"]=-1;
        }
    }
    echo json_encode($resultData);
}
function activateuser(){
    global $con;
    global $Lang;
    $resultData=array("result"=>0,"msg"=>"");
    $sql="SELECT `payment_subscribe`.*,`payments`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`status`=1 AND `payment_subscribe`.`users_code`='".mysqli_real_escape_string($con,$_POST["code"])."'";

    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){//check for user
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
    }else{//invalid code for student check for teacher
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
        }else{//invalid code for student & teacher check for code
            if(isset($_POST["bookid"]) && $_POST["bookid"]!=""){
                //$sql="SELECT * FROM `apps_codes` WHERE `startdate` < CURDATE() AND `type`='book' AND `refid`=".$_POST["bookid"]." AND `status`=1 AND `code`='".mysqli_real_escape_string($con,$_POST["code"])."'";
                $sql="SELECT * FROM `apps_codes` WHERE `type`='story' AND `refid`=".$_POST["bookid"]." AND `status`=1 AND `code`='".mysqli_real_escape_string($con,$_POST["code"])."'";
                $result=$con->query($sql);
                if(mysqli_num_rows($result)>0){
                    $row=mysqli_fetch_assoc($result);
                    if(strtotime($row["enddate"])>time()){
                        $sql2="SELECT * FROM `codes_user` WHERE `codeid`=".$row["codeid"];
                        $result2=$con->query($sql2);
                        if(mysqli_num_rows($result2)<$row["countofuser"]){
                            $sql="INSERT INTO `codes_user`(`cuid`, `codeid`, `userid`, `regdate`) VALUES ('',".$row["codeid"].",".$_SESSION["user"]["userid"].",CURDATE())";
                            if($con->query($sql)){
                                $resultData["result"]=1;
                            }else{//Unexpected Error
                                $resultData["result"]=0;
                                $resultData["msg"]=(string)$Lang->UnexpectedError." Err: 2103180237";
                            }
                        }else{
                            $resultData["result"]=0;
                            $resultData["msg"]=(string)$Lang->AccountMaximumReachTeacher;
                        }
                    }else{
                        $resultData["result"]=0;
                        $resultData["msg"]=(string)$Lang->AccountCodeExpiered;
                    }
                }else{//check for series
                    $sql="SELECT * FROM `apps_codes` WHERE `type`='series' AND `refid`=(SELECT `seriesid` from story where storyid=".$_POST["bookid"].") AND `status`=1 AND `code`='".mysqli_real_escape_string($con,$_POST["code"])."'";
                    $result=$con->query($sql);
                    if(mysqli_num_rows($result)>0){
                        $row=mysqli_fetch_assoc($result);
                        if(strtotime($row["enddate"])>time()){
                            $sql2="SELECT * FROM `codes_user` WHERE `codeid`=".$row["codeid"];
                            $result2=$con->query($sql2);
                            if(mysqli_num_rows($result2)<$row["countofuser"]){
                                $sql="INSERT INTO `codes_user`(`cuid`, `codeid`, `userid`, `regdate`) VALUES ('',".$row["codeid"].",".$_SESSION["user"]["userid"].",CURDATE())";
                                if($con->query($sql)){
                                    $resultData["result"]=1;
                                }else{//Unexpected Error
                                    $resultData["result"]=0;
                                    $resultData["msg"]=(string)$Lang->UnexpectedError." Err: 2103180237";
                                }
                            }else{
                                $resultData["result"]=0;
                                $resultData["msg"]=(string)$Lang->AccountMaximumReachTeacher;
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
            }else{
                $resultData["result"]=0;
                $resultData["msg"]=(string)$Lang->InvalidActivationCode;
            }
        }
    }

    echo json_encode($resultData);
}
function saveuserdata(){
    global $con;
    global $Lang;
    if(isset($_POST["data"]) && !empty($_POST["data"])){
        $data=json_decode($_POST["data"],true);
        if(isset($data["user"]["userid"])){
            $userid=$data["user"]["userid"];
            $bookid=$data["bookid"];
            $sql="SELECT userebookid FROM `users_ebooks` WHERE `userid`=$userid AND `bookid`=$bookid";
            $result=$con->query($sql);
            if(mysqli_num_rows($result)>0){
                $sql="UPDATE `users_ebooks` SET `data`='".mysqli_real_escape_string($con,$_POST["data"])."' WHERE `userid`=$userid AND `bookid`=$bookid";
                $con->query($sql);
            }else{
                $sql="INSERT INTO `users_ebooks`(`userebookid`, `userid`, `bookid`, `data`) VALUES ('',$userid,$bookid,'".mysqli_real_escape_string($con,$_POST["data"])."')";
                $con->query($sql);
            }
            $resultData["result"]=1;
            $resultData["msg"]="success";
        }else{
            $resultData["result"]=-1;
            $resultData["msg"]="no userid";
        }
    }else{
        $resultData["result"]=0;
        $resultData["msg"]="no data";
    }
}
?>
