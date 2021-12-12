<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
$server_root=$_SERVER['DOCUMENT_ROOT']."/manhal/";
include_once($server_root.'platform/config.php');
include_once $server_root."platform/new/includes/db.php";
include_once $server_root."platform/new/includes/functions.php";
$URL="http://localhost/Manhal/platform/new";
$real_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(isset($_SESSION["lang"]) && $_SESSION["lang"]!=""){
    $db_lang=strtolower($_SESSION["lang"]);
    $Lang = simplexml_load_file($server_root."language/".ucfirst($_SESSION["lang"]).".xml");
}else{
    $db_lang="en";
    $_SESSION["lang"]="en";
    $Lang = simplexml_load_file($server_root."language/En.xml");
}

if(isset($_GET["process"]) && $_GET["process"]!=""){
    $_GET["process"]();
}

function deletedomain(){
    if($_SESSION["user"]["permession"]==1 || $_SESSION["user"]["permession"]==3){
        if(isset($_POST["domainid"]) && $_POST["domainid"]!=""){
            $sql="UPDATE `domains` SET `deleted`=1 WHERE `dn_id`=".$_POST["domainid"].";";//domains
            $sql.="UPDATE `pivotes` SET deleted`=1 WHERE `pt_domain`=".$_POST["domainid"].";";//pivotes
            $sql.="UPDATE `standards` SET deleted`=1 WHERE `sd_pivot` in( SELECT `pt_id` FROM `pivotes` WHERE `pt_domain`=".$_POST["domainid"].");";//standards
            $sql.="UPDATE `units` SET deleted`=1 WHERE `un_standard` in( SELECT `sd_id` FROM `standards` WHERE `sd_pivot` in( SELECT `pt_id` FROM `pivotes` WHERE `pt_domain`=".$_POST["domainid"]."));";//unites
            $sql.="UPDATE `outcomes` SET deleted`=1 WHERE `oc_standard` in( SELECT `sd_id` FROM `standards` WHERE `sd_pivot` in( SELECT `pt_id` FROM `pivotes` WHERE `pt_domain`=".$_POST["domainid"]."));";//outcomes
            $sql.="UPDATE `lessons` SET deleted`=1 WHERE `ln_unit` in(SELECT `un_id` FROM `units` WHERE `un_standard` in( SELECT `sd_id` FROM `standards` WHERE `sd_pivot` in( SELECT `pt_id` FROM `pivotes` WHERE `pt_domain`=".$_POST["domainid"].")));";//lessons

            $db = Database::getInstance();
            $mysqli = $db->getConnection();
            $result = $mysqli->multi_query($sql);
            if($result){
                returnAjax(true,"done");
            }else{
                returnAjax(false,"error in delete process");
            }
        }else{
            returnAjax(false,"invalid domain id");
        }
    }else{
        returnAjax(false,"no permission");
    }
}
function deletealignedstandarad(){
    if(isset($_SESSION["user"]) && $_SESSION["user"]["permession"]>0 && $_SESSION["user"]["permession"]<4){
        if(isset($_POST["as_id"]) && $_POST["as_id"]!=""){
            $sql="UPDATE `aligned_standards` SET `deleted`=1 WHERE `as_id`=".$_POST["as_id"].";";//aligned standard
            $sql.="UPDATE `domains` SET `deleted`=1 WHERE `dn_astandard`=".$_POST["as_id"].";";//domains
            $sql.="UPDATE `pivotes` SET deleted`=1 WHERE `pt_domain`in( SELECT `dn_id` FROM `domains` WHERE `dn_astandard`=".$_POST["as_id"].");";//pivotes
            $sql.="UPDATE `standards` SET deleted`=1 WHERE `sd_pivot` in( SELECT `pt_id` FROM `pivotes` WHERE `pt_domain` in( SELECT `dn_id` FROM `domains` WHERE `dn_astandard`=".$_POST["as_id"]."));";//standards
            $sql.="UPDATE `units` SET deleted`=1 WHERE `un_standard` in( SELECT `sd_id` FROM `standards` WHERE `sd_pivot` in( SELECT `pt_id` FROM `pivotes` WHERE `pt_domain` in( SELECT `dn_id` FROM `domains` WHERE `dn_astandard`=".$_POST["as_id"].")));";//unites
            $sql.="UPDATE `outcomes` SET deleted`=1 WHERE `oc_standard` in( SELECT `sd_id` FROM `standards` WHERE `sd_pivot` in( SELECT `pt_id` FROM `pivotes` WHERE `pt_domain`in( SELECT `dn_id` FROM `domains` WHERE `dn_astandard`=".$_POST["as_id"].")));";//outcomes
            $sql.="UPDATE `lessons` SET deleted`=1 WHERE `ln_unit` in(SELECT `un_id` FROM `units` WHERE `un_standard` in( SELECT `sd_id` FROM `standards` WHERE `sd_pivot` in( SELECT `pt_id` FROM `pivotes` WHERE `pt_domain`in( SELECT `dn_id` FROM `domains` WHERE `dn_astandard`=".$_POST["as_id"]."))));";//lessons

            $db = Database::getInstance();
            $mysqli = $db->getConnection();
            $result = $mysqli->multi_query($sql);
            if($result){
                returnAjax(true,"done");
            }else{
                returnAjax(false,"error in delete process");
            }
        }else{
            returnAjax(false,"invalid Aligned standard id");
        }
    }else{
        returnAjax(false,"no permission");
    }
}
function savealignedstandarad(){
    if(isset($_SESSION["user"]) && $_SESSION["user"]["permession"]>0 && $_SESSION["user"]["permession"]<4){
        if(isset($_POST["as_id"]) && $_POST["as_id"]!=""){
            $db = Database::getInstance();
            $mysqli = $db->getConnection();

            $sql="UPDATE `aligned_standards` SET `as_title_ar`='".mysqli_real_escape_string($mysqli,$_POST["as_title_ar"])."', `as_title_en`='".mysqli_real_escape_string($mysqli,$_POST["as_title_en"])."' WHERE `as_id`=".$_POST["as_id"].";";//aligned standard

            $result = $mysqli->query($sql);
            if($result){
                returnAjax(true,"done");
            }else{
                returnAjax(false,"error in update process 2601200226");
            }
        }else{
            returnAjax(false,"invalid Aligned standard id 2601200226");
        }
    }else{
        returnAjax(false,"no permission 2601200226");
    }
}
function savedomain(){
    if(isset($_SESSION["user"]) && $_SESSION["user"]["permession"]>0 && $_SESSION["user"]["permession"]<4){
        if(isset($_POST["dn_id"]) && $_POST["dn_id"]!=""){
            $db = Database::getInstance();
            $mysqli = $db->getConnection();

            if(isset($_POST['status']) && $_POST['status']==1){
                $status=1;
            }else{
                $status=0;
            }

            $sql="UPDATE `domains` SET `dn_code`='".mysqli_real_escape_string($mysqli,$_POST["code"])."',`dn_astandard`=".$_POST["astandard"].",`dn_title_ar`='".mysqli_real_escape_string($mysqli,$_POST["dn_title_ar"])."',`dn_title_en`='".mysqli_real_escape_string($mysqli,$_POST["dn_title_en"])."',`dn_category`=".$_POST["subject"].",`status`=".$status." WHERE `dn_id`=".$_POST['dn_id'];//aligned standard
            $result = $mysqli->query($sql);
            if($result){
                returnAjax(true,"done");
            }else{
                returnAjax(false,"error in update process 2701211111");
            }
        }else{
            returnAjax(false,"invalid Aligned standard id 2701211111");
        }
    }else{
        returnAjax(false,"no permission 2701211111");
    }
}
function returnAjax($result=true,$msg=""){
    $data=array("result"=>$result,"msg"=>$msg);
    echo json_encode($data);
    exit();
}