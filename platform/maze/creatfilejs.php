<?php
/**
 * Created by PhpStorm.
 * User: khalid
 * Date: 31/10/2018
 * Time: 12:35 م
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
if(!(isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"]>0)){
  //  exit("secured");
}
$url=$_POST['url'].'js/';
include_once('../config.php') ;

if(!is_dir($url)){
    @mkdir($url);
}
if(isset($url)&&isset($_POST['FileName'])&&isset($_POST['json'])&&isset($_POST['id'])){

    global $con;
    $data=$_POST['json'];
    if ($con->query("UPDATE `editors` SET `data`='".mysqli_real_escape_string($con,$data)."' WHERE `gameid`=".$_POST['id'])) {
        echo 1;
    }else{
        echo 0;
    }
    file_put_contents($url.$_POST['FileName'],"var game=".$_POST['json']  );
}
