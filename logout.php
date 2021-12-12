<?php
/**
 * Created by Dar Almanhal- Hussam Abu khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 5/26/2016
 * Time: 10:36 AM
 */
session_start();
unset($_SESSION["user"]);
$_SESSION["user"]=array();
//session_unset();
//session_destroy();

//setcookie('tokenbasic', null, -1,"/");
//setcookie('ctime', null, -1,"/");
if(isset($_SESSION["lang"]) && $_SESSION["lang"]!=""){
    header("location:".SITE_URL.strtolower($_SESSION["lang"]));
}else{
    header("location:".SITE_URL);
}
exit();
?>