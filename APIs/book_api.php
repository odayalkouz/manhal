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
}elseif(isset($_GET["bookid"]) && isset($_GET["page"])){
    getPageContents();
}

//function to save paint sent from e-book as image for current user
function savebookimg(){
    $result["result"]=1;

    if(!isset($_SESSION["user"]) || !isset($_SESSION["user"]["userid"]) || $_SESSION["user"]["userid"]==''){
        $result["result"]=-1;
        $result["msg"]="user not logged in";
    }
    if(!isset($_POST["bookid"]) || $_POST["bookid"]==""){
        $result["result"]=-2;
        $result["msg"]="invalid bookid";
    }
    if(!isset($_POST["pageid"]) || $_POST["pageid"]==""){
        $result["result"]=-3;
        $result["msg"]="invalid pageid";
    }
    if(!isset($_POST["img"]) || $_POST["img"]==""){
        $result["result"]=0;
        $result["msg"]="invalid image data";
    }

    if($result["result"]==1){
        if(!is_dir("users/images/".$_SESSION["user"]["userid"])){
            @mkdir("users/images/".$_SESSION["user"]["userid"]);
        }

        if(!is_dir("users/images/".$_SESSION["user"]["userid"]."/books")){
            @mkdir("users/images/".$_SESSION["user"]["userid"]."/books");
        }

        if(!is_dir("users/images/".$_SESSION["user"]["userid"]."/books/".$_POST['bookid'])){
            @mkdir("users/images/".$_SESSION["user"]["userid"]."/books/".$_POST['bookid']);
        }

        saveUserImageBase64($_POST["img"],"users/images/".$_SESSION["user"]["userid"]."/books/".$_POST['bookid']."/".$_POST['pageid'].".png");
        $result["msg"]="success";
    }
    echo json_encode($result);
}

//get saved image from server for ebook page for current user
function getbookimg(){
    $result["result"]=1;
    if(!isset($_SESSION["user"]) || !isset($_SESSION["user"]["userid"]) || $_SESSION["user"]["userid"]==''){
        $result["result"]=-1;
        $result["msg"]="user not logged in";
    }else{
        if(!isset($_POST["bookid"]) || $_POST["bookid"]==""){
            $result["result"]=-2;
            $result["msg"]="invalid bookid";
        }else{
            if(!isset($_POST["pageid"]) || $_POST["pageid"]==""){
                $result["result"]=-3;
                $result["msg"]="invalid pageid";
            }else{
                if(is_file("users/images/".$_SESSION["user"]["userid"]."/books/".$_POST['bookid']."/".$_POST['pageid'].".png")){
                    $data = file_get_contents("users/images/".$_SESSION["user"]["userid"]."/books/".$_POST['bookid']."/".$_POST['pageid'].".png");
                    $base64 = 'data:image/png;base64,' . base64_encode($data);
                    $result["imgData"]=$base64;
                }
            }
        }
    }

    echo json_encode($result);

}

function saveUserImageBase64($data,$path){
    $data=explode(";",$data);
    if(count($data)>1){
        $data = str_replace('base64,', '', $data[1]);
        $data = str_replace(' ', '+', $data);
        $data = base64_decode($data);
        file_put_contents($path, $data);
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
        if(isset($_POST["bookid"]) && $_POST["bookid"]!=""){
            //$sql="SELECT * FROM `apps_codes` WHERE `startdate` < CURDATE() AND `type`='book' AND `refid`=".$_POST["bookid"]." AND `status`=1 AND `code`='".mysqli_real_escape_string($con,$_POST["code"])."'";
            $sql="SELECT * FROM `apps_codes` WHERE `type`='book' AND `refid`=".$_POST["bookid"]." AND `status`=1 AND `code`='".mysqli_real_escape_string($con,$_POST["code"])."'";
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
 VALUES ('','".mysqli_real_escape_string($con,$_POST['email'])."','".$_POST['pass']."',1,CURDATE(),0,0,'".$countryCode."','ebook',0,'".mysqli_real_escape_string($con,$_POST["code"])."')";
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
                            $resultData["result"]=0;
                            $resultData["msg"]=(string)$Lang->UnexpectedError." Err: 2103180238".$sql;
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
        }else{
            $resultData["result"]=0;
            $resultData["msg"]=(string)$Lang->InvalidActivationCode;
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
    if(!isset($_SESSION["user"]["userid"])){
        $data=checklogin(1);
    }

    if(!isset($_GET['bookid']) && isset($_POST['bookid'])){
        $_GET['bookid']=$_POST['bookid'];
    }
    if(!isset($_GET['type']) && isset($_POST['type'])){
        $_GET['type']=$_POST['type'];
    }
    if(isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"]>0 && $_SESSION["user"]["permession"]<=9){
        echo 1;
        exit();
    }
    if(isset($_SESSION["user"]["userid"])){

        if($_SESSION["user"]["permession"]>0 && $_SESSION["user"]["permession"]<=9){
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
                                echo 0;
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
        if($_SESSION["user"]["permession"]>0 && $_SESSION["user"]["permession"]<=10){
            $resultData["result"]=1;
            $_SESSION["user"]=$row;
            $resultData["user"]=$row;
            $sql="UPDATE `users` SET `lastlogin`=NOW() WHERE userid=".$row["userid"];
            $con->query($sql);
        }else{
            $sql="SELECT `apps_codes`.*, `codes_user`.* FROM `apps_codes` INNER JOIN `codes_user` ON `apps_codes`.`codeid`=`codes_user`.`codeid` WHERE `apps_codes`.`type`='book'
 AND `apps_codes`.`refid`=".$_POST["bookid"]." AND `apps_codes`.`enddate` > NOW() AND status=1 AND `codes_user`.`userid`=".$row["userid"];
            $result=$con->query($sql);
            if(mysqli_num_rows($result)>0){
                $resultData["result"]=1;
                $_SESSION["user"]=$row;
                $resultData["user"]=$row;
                $sql="UPDATE `users` SET `lastlogin`=NOW() WHERE userid=".$row["userid"];
                $con->query($sql);
            }else{
                $resultData["result"]=-2;
            }

        }
    }else{
        $resultData["result"]=-1;
    }
    echo json_encode($resultData);
}

function checklogin($api=0){
    //covid-19 corona update :)
//    echo 1;
//    exit();

    global $con;
    if(isset($_POST["userid"]) && $_POST["userid"]!=null && $_POST["userid"]!="null" && $_POST["userid"]!="" && isset($_POST["app_secret"])){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,SITE_URL."APIs/manhal/secret.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "process=secret");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_secret = curl_exec ($ch);
        curl_close ($ch);
        if($_POST["app_secret"]==$server_secret || $_POST["app_secret"]==API_SECRET){
            $sql="SELECT `userid`,`uname`,`email`,`permession`,`avatar`,`activation_code` FROM `users` WHERE `userid`=".$_POST["userid"];
            $result=$con->query($sql);
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                $_SESSION["user"]=$row;
                $resultData["result"]=1;
                if($api==1){
                    echo 1;
                    exit();
                }
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
    if(isset($_POST["bookid"]) && $_POST["bookid"]!=""){
        //$sql="SELECT * FROM `apps_codes` WHERE `startdate` < CURDATE() AND `type`='book' AND `refid`=".$_POST["bookid"]." AND `status`=1 AND `code`='".mysqli_real_escape_string($con,$_POST["code"])."'";
        $sql="SELECT * FROM `apps_codes` WHERE `type`='book' AND `refid`=".$_POST["bookid"]." AND `status`=1 AND `code`='".mysqli_real_escape_string($con,$_POST["code"])."'";
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
    }else{
        $resultData["result"]=0;
        $resultData["msg"]=(string)$Lang->InvalidActivationCode;
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

function getpages(){
    global $con;
    global $Lang;
    global $lang_code;
    if(isset($_POST["bookid"]) && $_POST["bookid"]!=""){
        $dir="platform/books/".$_POST["bookid"];
        $pages_aray=array();
        if(is_dir($dir)){
            $pages = scandir($dir);
            foreach($pages as $key=>$page)
            {
                if(!($page == '.' || $page == '..')) {
                    if(substr($page,0,1)=="p" && substr($page,5)==".html"){
                        $pages_aray[]=SITE_URL.$lang_code."/api/books/?bookid=".$_POST["bookid"]."&page=".$page;
                    }
                }
            }
            $resultData["result"]=1;
            $resultData["msg"]="success";
            $resultData["pages"]=$pages_aray;
           // $resultData["scanned"]=$pages;
        }else{//book not found
            $resultData["result"]=0;
            $resultData["msg"]="book not found";
        }
    }else{//wrong bookid
        $resultData["result"]=0;
        $resultData["msg"]="invalid bookid";
    }

    echo json_encode($resultData);
}

function getPageContents(){
    if(isset($_GET["bookid"]) && $_GET["bookid"]!="" && isset($_GET["page"]) && $_GET["page"]!=""){
        $file="platform/books/".$_GET["bookid"]."/".$_GET["page"];
        if(is_file($file)){
            $contents=file_get_contents("platform/books/yearly/fix.html");
            $contents.=file_get_contents(changeImgsPath($file));
            ob_clean();
            header('Content-Type: text/html; charset=utf-8');
            echo $contents;
        }else{//book not found
            echo "page not found";
        }
    }else{//wrong bookid
        echo "invalid page URL";
    }
}
function changeImgsPath($html){
    $doc = new DOMDocument();
    $doc->loadHTML($html);

}
?>
