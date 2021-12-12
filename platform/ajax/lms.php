<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 04/02/2019
 * Time: 03:00 PM
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
if(!(isset($_SESSION['user']['permession']) || ($_SESSION['user']['permession']!=1))){
    echo "Secured";
    exit();
}

include_once "../config.php";
include_once "../includes/function.php";

$Lang = simplexml_load_file("../../language/".$_SESSION["lang"].".xml");

if(isset($_GET['process']) && $_GET['process']!=""){
    $_GET['process']();
}
//function to handle post data from user to create lms Instance - we use this beacause may be we need to create
//new instance from admin panel or from another way - By Hussam
function creatSchoolLMS(){
    global $con;
    global $Lang;
    $result=array();
    if(isset($_POST["title_ar"]) && $_POST["title_ar"]!=""){
        $title_ar=$_POST["title_ar"];
        if(isset($_POST["title_en"]) && $_POST["title_en"]!=""){
            $title_en=$_POST["title_en"];

            if(isset($_POST["subdomain"]) && $_POST["subdomain"]!=""){
                $flag=validateSubdomain($_POST["subdomain"]);
                if($flag==true){
                    $subdomain=$_POST["subdomain"];
                    $sql="SELECT `payment_subscribe`.*,`payments`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`status`=1 AND `payments`.`userid`='".$_SESSION["user"]["userid"]."' AND `payment_subscribe`.`subscribe_usertype`='Schools' ";
                    $resultSql=$con->query($sql);
                    if(mysqli_num_rows($resultSql)>0 || true) {//user has subscription but need to check if lms already exist or not
                        $subscribe=mysqli_fetch_assoc($resultSql);
                        $sql="SELECT * FROM `lms_instances` WHERE `owner`=".$_SESSION["user"]["userid"];
                        $resultSql=$con->query($sql);
                        if(mysqli_num_rows($resultSql)==0) {// every thing good
                            $username=generateUsername();
                            if(isset($_SESSION["user"]["email"]) && $_SESSION["user"]["email"]!=''){
                                $email=$_SESSION["user"]["email"];
                            }else{
                                $email=WEBMASTER_EMAIL;
                            }
                            $result= createLMSInstance($title_ar,$title_en,$subscribe["expire_date"],$subscribe["teachers_allowed"],$subscribe["students_allowed"],$_SESSION["user"]["userid"],$username,$email,$subdomain);
                        }else{//lms already exist
                            $result["status"]="-1";
                            $result["message"]=(string)$Lang->ThisAcctHaveLMS;
                        }
                    }else{//user has no subscription
                        $result["status"]="-1";
                        $result["message"]=(string)$Lang->UserHaveNoSubscription;
                    }
                }else{
                    $result=$flag;
                }
            }else{//invalid subdomain
                $result["status"]="-2";
                $result["message"]=(string)$Lang->InvalidSubDomainFormat;
            }

        }else{
            $result["status"]="0";
            $result["message"]=(string)$Lang->InvalidEnTitle;
        }
    }else{
        $result["status"]="0";
        $result["message"]=(string)$Lang->InvalidArTitle;
    }
    echo json_encode($result);
}

//create LMS instance for school or account - By Hussam
function createLMSInstance($title_ar,$title_en,$expire_at,$teachers_count,$students_count,$userid,$username,$email,$subdomain){
    global $Lang;
    $db=$username."_lmsdb";
    $domain=$subdomain.".".LMS_MainDomain;
    $password="Q!".uniqid()."12@";
    $result=array();
    if(saveLMSinstant($title_ar,$title_en,$expire_at,$teachers_count,$students_count,$domain,$userid,$username,$password,$db,$email)){
        if(createCpanelAccount($username,$domain,$password,$email)){
            if(createSubDomain($subdomain)){
                if(createLMSDatabase($username,$password,$db)){
                    if(copyLMSFiles($username,$password)){
                        if(configLMStemplate($domain,$username,$password,$db,$title_ar,$title_en)){
                            if(installSSL($domain,$username,$password)){
                                sleep(20);
                                $result["status"]="1";
                                $result["message"]="success";
                                $result["url"]="https://".$domain;
                            }else{
                                $result["status"]="0";
                                $result["message"]=(string)$Lang->CannotinstallSSL;
                            }
                        }else{
                            $result["status"]="0";
                            $result["message"]=(string)$Lang->CannotConfigLMS;
                        }
                    }else{
                        $result["status"]="0";
                        $result["message"]=(string)$Lang->CannotCopyLMS;
                    }
                }else{
                    $result["status"]="0";
                    $result["message"]=(string)$Lang->CannotCreateDB;
                }
            }else{
                $result["status"]="0";
                $result["message"]=(string)$Lang->CannotCreateSubdomain;
            }

        }else{
            $result["status"]="0";
            $result["message"]=(string)$Lang->CannotCreateLMSAcct;
        }
    }else{
        $result["status"]="0";
        $result["message"]=(string)$Lang->CannotSaveToDB;
    }
    return $result;
}

//create Cpanel account for LMS instance - By Hussam
function createCpanelAccount($username,$domain,$password,$email){
    global $Lang;
    $API=CLOUD_WHM_URL.":2087/cpsess".rand(1111111111,9999999999)."/json-api/createacct?api.version=1&username=".$username."&domain=".$domain."&plan=lms&password=".$password."&ip=n&cgi=1&hasshell=1&contactemail=".$email."&cpmod=paper_lantern&maxftp=1&maxsql=1&maxpop=2&maxlst=2&maxsub=1&maxpark=1&maxaddon=1&bwlimit=500&language=en&useregns=1&hasuseregns=1&reseller=0&forcedns=1&mailbox_format=mdbox&mxcheck=local&max_email_per_hour=500&max_defer_fail_percentage=80&owner=root";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $header[0] = "Authorization: whm root:".CLOUD_WHM_Token;
    curl_setopt($ch,CURLOPT_HTTPHEADER,$header);

    curl_setopt($ch, CURLOPT_URL,$API);

    $jsonResult = curl_exec ($ch);
    curl_close ($ch);
    $result=json_decode($jsonResult,true);
    if(isset($result["metadata"]["result"]) && $result["metadata"]["result"]==1){
        return true;
    }else{
        $final_result["status"]="0";
        $final_result["message"]=(string)$Lang->CannotCreateLMSAcct;
        $final_result["api_result"]=$result;
        echo json_encode($final_result);
        exit();
    }
}

//create LMS Database from template for LMS instance - By Hussam
function createLMSDatabase($username,$password,$db){
    global $Lang;
    $API=CLOUD_WHM_URL.":2083/cpsess".rand(1111111111,9999999999)."/execute/Mysql/create_database?name=".$db;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);       // Allow self-signed certs
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);       // Allow certs that do not match the hostname
    curl_setopt($ch, CURLOPT_HEADER,0);               // Do not include header in output
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

    $header[0] = "Authorization: Basic " . base64_encode($username.":".$password) . "\n\r";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);    // set the username and password
    curl_setopt($ch, CURLOPT_URL,$API);
    $jsonResult = curl_exec ($ch); // this API just return metadata
    curl_close ($ch);
    $result=json_decode($jsonResult,true);
    if(isset($result["status"]) && $result["status"]==1){
        return true;
    }else {
        $final_result["status"] = "0";
        $final_result["message"] = (string)$Lang->CannotCreateDB;
        $final_result["api_result"] = $result;
        echo json_encode($final_result);
        exit();
    }

}

//copy LMS file from template for LMS instance - By Hussam
function copyLMSFiles($username,$password){
    global $Lang;
    $API=CLOUD_WHM_URL.":2083/cpsess".rand(1111111111,9999999999)."/execute/Fileman/upload_files?dir=/home/".$username."/public_html&file-1=template.zip&file-2=database.sql&file-3=operator.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);       // Allow self-signed certs
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);       // Allow certs that do not match the hostname
    curl_setopt($ch, CURLOPT_HEADER,0);               // Do not include header in output
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

    curl_setopt($ch, CURLOPT_POST, 1);
    $args['file-1'] = new CurlFile('../lms/template.zip', 'application/zip');
    $args['file-2'] = new CurlFile('../lms/database.sql', 'text/plain');
    $args['file-3'] = new CurlFile('../lms/operator.php', 'text/php');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args);

    $header[0] = "Authorization: Basic " . base64_encode($username.":".$password) . "\n\r";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);    // set the username and password
    curl_setopt($ch, CURLOPT_URL,$API);

    $jsonResult = curl_exec ($ch);
    curl_close ($ch);
    $result=json_decode($jsonResult,true);
    if(isset($result["status"]) && $result["status"]==1){
        return true;
    }else{
        $final_result["status"] = "0";
        $final_result["message"] = (string)$Lang->CannotCopyLMS;
        $final_result["api_result"] = $result;
        echo json_encode($final_result);
        exit();
    }
}

//Install SSl licenseto new cloud Cpanel Account - By Hussam
function installSSL($domain,$username,$password){
    global $Lang;
    //$API=CLOUD_WHM_URL.":2083/cpsess".rand(1111111111,9999999999)."/execute/SSL/install_ssl?domain=".$domain."&cert=".urlencode(MANHAL_SSL_CER)."&key=".urlencode(MANHAL_SSL_KEY)."&cabundle=".urlencode(MANHAL_SSL_BUNDLE);
    $API=CLOUD_WHM_URL.":2083/cpsess".rand(1111111111,9999999999)."/execute/SSL/install_ssl";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);       // Allow self-signed certs
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);       // Allow certs that do not match the hostname
    curl_setopt($ch, CURLOPT_HEADER,0);               // Do not include header in output
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

    curl_setopt($ch, CURLOPT_POST, 1);
    $args['domain'] =$domain;
    $args['cert'] = MANHAL_SSL_CER;
    $args['key'] =MANHAL_SSL_KEY;
    $args['cabundle'] = MANHAL_SSL_BUNDLE;
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args);

    $header[0] = "Authorization: Basic " . base64_encode($username.":".$password) . "\n\r";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);    // set the username and password
    curl_setopt($ch, CURLOPT_URL,$API);
    $jsonResult = curl_exec ($ch); // this API just return metadata
    curl_close ($ch);
    $result=json_decode($jsonResult,true);
    if(isset($result["status"]) && $result["status"]==1){
        return true;
    }else {
        $final_result["status"] = "0";
        $final_result["message"] = (string)$Lang->CannotinstallSSL;
        $final_result["api_result"] = $result;
        echo json_encode($final_result);
        exit();
    }
}

//create subdomain for new lmsInstance point to cloud server for new instance - By Hussam - on Manhal.com
//this function based on WHM API - which create dns record as subdomain point to lms server
function createSubDomain($subdomain){
    global $Lang;
    $API=Manhal_WHM_URL.":2087/cpsess".rand(1111111111,9999999999)."/json-api/addzonerecord?api.version=1&domain=".LMS_MainDomain."&name=".$subdomain."&class=IN&ttl=14400&type=A&address=".LMS_SERVER_IP;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $header[0] = "Authorization: whm root:".Manhal_WHM_Token;
    curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
    curl_setopt($ch, CURLOPT_URL,$API);
    $jsonResult = curl_exec ($ch);
    curl_close ($ch);
    $result=json_decode($jsonResult,true);
    if(isset($result["metadata"]["result"]) && $result["metadata"]["result"]==1){
        return true;
    }else{
        $final_result["status"] = "0";
        $final_result["message"] = (string)$Lang->CannotCreateSubdomain;
        $final_result["api_result"] = $result;
        echo json_encode($final_result);
        exit();
    }
}


//call configuration file on user account - By Hussam
function  configLMStemplate($domain,$username,$password,$db,$title_ar,$title_en){
    sleep(10);
    global $Lang;
    $API='http://'.$domain."/operator.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);       // Allow self-signed certs
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);       // Allow certs that do not match the hostname
    curl_setopt($ch, CURLOPT_HEADER,0);               // Do not include header in output
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

    curl_setopt($ch, CURLOPT_POST, 1);
    $args['URL'] = 'https://'.$domain;
    $args['db_name'] = $db;
    $args['db_user'] =$username;
    $args['db_password'] = $password;
    $args['lms_id'] =  $_SESSION["lms_id"];
    $args['title_ar'] =  $title_ar;
    $args['title_en'] =  $title_en;
    if(isset($_POST["logo"]) && $_POST["logo"]!=""){
        $args['logo'] =  $_POST["logo"];
    }

    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
    curl_setopt($ch, CURLOPT_URL,$API);

    $jsonResult = curl_exec ($ch);
    curl_close ($ch);
    $result=json_decode($jsonResult,true);
    if(isset($result["status"]) && $result["status"]==1){
        return true;
    }else{
        $final_result["status"] = "0";
        $final_result["message"] = (string)$Lang->CannotConfigLMS;
        $final_result["api_result"] = $result;
        echo json_encode($final_result);
        exit();
    }
}


//save LMS instant info to DB - By Hussam
function saveLMSinstant($title_ar,$title_en,$expire_at,$teachers_count,$students_count,$domain,$userid,$username,$password,$db,$email){
    global $Lang;
    global $con;
    if($expire_at==''){
        $expire_at=date("Y-m-d",strtotime('+1 months'));
    }
    if($teachers_count=='' || $teachers_count==0){
        $teachers_count=1;
    }
    if($students_count=='' || $students_count==0){
        $students_count=1;
    }


    $sql="INSERT INTO `lms_instances`(`title_ar`, `title_en`, `status`, `created_at`, `expire_at`, `teachers`, `students`, `owner`,`subdomain`,`cpanel_username`,`cpanel_password`,`dbname`,`email`)
 VALUES ('".mysqli_real_escape_string($con,$title_ar)."','".mysqli_real_escape_string($con,$title_en)."',1,CURDATE(),'".$expire_at."',".$teachers_count.",".$students_count.",".$userid.",
'".mysqli_real_escape_string($con,$domain)."', '".mysqli_real_escape_string($con,$username)."', '".mysqli_real_escape_string($con,$password)."','".mysqli_real_escape_string($con,$db)."','".mysqli_real_escape_string($con,$email)."')";
    if($con->query($sql)){
        $_SESSION["lms_id"]=$con->insert_id;
        return true;
    }else{
        $final_result["status"] = "0";
        $final_result["message"] = (string)$Lang->CannotSaveToDB;
        $final_result["sql"] = $sql;
        echo json_encode($final_result);
        exit();
        //return false;
    }
}

//validate subdomain - By Hussam
function validateSubdomain($subdomain){
    global $con;
    global $Lang;
    if(preg_match('/^[a-zA-Z]+[a-zA-Z0-9-]+[a-zA-Z0-9]$/', $subdomain)){
        $sql="SELECT * FROM `lms_instances` WHERE `subdomain`=".$subdomain;
        $resultSql=$con->query($sql);
        if(mysqli_num_rows($resultSql)==0) {
            return true;
        }else{
            $result["status"]="-4";
            $result["message"]=(string)$Lang->SubdomainExist;
        }
    }else{
        $result["status"]="-3";
        $result["message"]=(string)$Lang->InvalidSubDomainFormat;
    }


}

//function to generate username - By Hussam
function generateUsername(){
    $username="u".$_SESSION["user"]["userid"];
    if(strlen($username)<5){
        $username.="123";
    }
    return $username;
}